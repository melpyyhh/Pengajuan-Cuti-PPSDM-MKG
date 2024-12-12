<?php

namespace App\Http\Livewire;

use App\Models\DataCuti;
use App\Models\JenisCuti;
use App\Models\Pengajuan;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PengajuanForm extends Component
{
    public $currentPage = 1;
    public $success;

    // Properti form
    public $tanggalMulai;
    public $tanggalAkhir;
    public $dokumen;
    public $nomorHp;
    public $alamatCuti;
    public $alasan;
    public $durasiCuti;
    public $jenisCutiList; // Untuk data dropdown
    public $selectedJenisCuti; // Untuk nilai yang dipilih pengguna


    public $pages = [
        1 => ['heading' => 'Jenis Cuti', 'subheading' => 'Pilih jenis cuti.'],
        2 => ['heading' => 'Tanggal Cuti', 'subheading' => 'Masukkan tanggal mulai dan selesai cuti.'],
        3 => ['heading' => 'Unggah Dokumen', 'subheading' => 'Unggah informasi tambahan melalui dokumen (jika ada).'],
        4 => ['heading' => 'Crosscheck', 'subheading' => 'Periksa kembali form pengajuan cuti anda.'],
    ];

    // inin validasinya baru ngetes doang bang, nanti tambahin lagi ajaa
    protected $validationRules = [
        1 => ['selectedJenisCuti' => 'required'],
        2 => [
            'tanggalMulai' => 'required|date',
        ],
        3 => ['alasan' => 'required|string|max:255'],
        4 => ['alamatCuti' => 'required|string'],
        5 => ['nomorHp' => 'required|string'],
        6 => ['durasiCuti' => 'required|integer|min:1']
    ];

    public function goToNextPage()
    {
        if ($this->currentPage === 1) {
            $this->validate([
                'selectedJenisCuti' => 'required',
            ]);
            $data = [
                'cuti_id' => intval($this->selectedJenisCuti),
                'pegawai_id' => Auth::user()->pegawai->id,
            ];
            // Jika cekKetersediaanCuti mengembalikan false, hentikan proses
            if (!$this->cekKetersediaanCuti($data)) {
                $this->dispatch(
                    'custom-alert',
                    type: 'error',
                    title: 'Cuti Tahunan Habis',
                    position: 'center',
                    timer: 3000,
                );
                return;
            }
        }

        $this->currentPage++;
    }


    public function goToPreviousPage()
    {
        $this->currentPage--;
    }

    // Atur lagi aja bang ini submit"annya, ini cuman sementara karena viewnya gabisa dinext kalo gaada submit
    public function submitForm()
    {
        try {
            // Validasi akhir
            $this->validate(array_merge(...array_values($this->validationRules)));
            // Logika pengajuan cuti
            $tanggalAkhir = $this->hitungTanggalAkhir($this->tanggalMulai, $this->durasiCuti);
            Pengajuan::ajukanCuti([
                'pengaju_id' => Auth::user()->pegawai->id,
                'penyetuju_id' => 2,
                'cuti_id' => $this->selectedJenisCuti,
                'tanggal_awal' => $this->tanggalMulai,
                'selama' => $this->durasiCuti,
                'alasan' => $this->alasan,
                'alamat' => $this->alamatCuti,
                'nomorHp' => $this->nomorHp,
                'tanggal_akhir' => $tanggalAkhir,
            ]);
            // Contoh: Simpan ke database atau proses lainnya
            $this->dispatch('custom-alert', type: 'success', title: 'Pengajuan Berhasil', position: 'center', timer: 1500);
            $this->reset(['selectedJenisCuti', 'tanggalMulai', 'alasan', 'durasiCuti', 'alamatCuti', 'nomorHp', 'currentPage']);
        } catch (\Throwable $e) {
            $this->dispatch('custom-alert', type: 'error', title: 'Terjadi Kesalahan', position: 'center', timer: 1500);
        }
    }

    public function resetSuccess()
    {
        $this->success = null;
    }

    public function render()
    {
        return view('livewire.pengajuan-form');
    }

    public function mount()
    {
        $this->jenisCutiList = JenisCuti::getAllCuti();
    }

    private function hitungTanggalAkhir($tanggalMulai, $durasiCuti)
    {
        $tanggal = Carbon::parse($tanggalMulai);

        // Tambahkan durasi hanya untuk hari kerja
        for ($i = 0; $i < $durasiCuti; $i++) {
            // Tambahkan satu hari ke tanggal, jika itu hari Sabtu atau Minggu, tambahkan lagi
            do {
                $tanggal->addDay();
            } while ($tanggal->isWeekend()); // Mengecek apakah hari tersebut Sabtu atau Minggu
        }

        return $tanggal;
    }

    public function cekKetersediaanCuti($data)
    {
        if ($data["cuti_id"] === 1 && !DataCuti::cekDataCuti($data["pegawai_id"])) {
            return false; // Tidak tersedia
        }
        return true; // Tersedia
    }
}
