<?php

namespace App\Http\Livewire;

use App\Mail\PengajuanDisetujuiMail;
use App\Models\DataCuti;
use App\Models\JenisCuti;
use App\Models\Pengajuan;
use App\Models\RiwayatCuti;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

#[Title('Form Pengajuan')]
class PengajuanForm extends Component
{
    use WithFileUploads;
    public $currentPage = 1;
    public $success;

    // Properti form
    public $tanggalMulai;
    public $tanggalAkhir;
    public $dokumen;
    public $progress = 0; //Progress bar
    public $uploadedFilesCount = 0; //Jumlah file yang berhasil diupload
    public $nomorHp;
    public $alamatCuti;
    public $alasan;
    public $durasiCuti;
    public $jenisCutiList; // Untuk data dropdown
    public $jenisCutiTerpilih; // Untuk nilai yang dipilih pengguna
    public $sisaCuti;
    public $statusCutiBesar;
    public $pegawaiId;

    public $pages = [
        1 => ['heading' => 'Jenis Cuti', 'subheading' => 'Pilih jenis cuti anda'],
        2 => ['heading' => 'Tanggal Cuti', 'subheading' => 'Masukkan detail pengajuan cuti anda'],
        3 => ['heading' => 'Unggah Dokumen', 'subheading' => 'Unggah informasi tambahan melalui dokumen (jika ada)'],
        4 => ['heading' => 'Crosscheck', 'subheading' => 'Periksa kembali form pengajuan cuti anda'],
    ];

    protected $validationRules = [
        1 => ['jenisCutiTerpilih' => 'required'],
        2 => [
            'alasan' => 'required|string|max:255',
            'alamatCuti' => 'required|string',
            'nomorHp' => 'required|string|regex:/^08\d{8,12}$/|min:10|max:14',
            'tanggalMulai' => 'required|date',
        ],
        3 => ['dokumen' => 'nullable|file|max:2048'],
    ];

    protected $messages = [
        'jenisCutiTerpilih.required' => 'Jenis cuti wajib dipilih!',
        'tanggalMulai.required' => 'Tanggal mulai wajib diisi!',
        'tanggalMulai.date' => 'Tanggal mulai harus dalam format yang benar!',
        'alasan.required' => 'Alasan wajib diisi!',
        'alasan.string' => 'Alasan harus berupa teks!',
        'alasan.max' => 'Alasan tidak boleh lebih dari 255 karakter!',
        'alamatCuti.required' => 'Alamat cuti wajib diisi!',
        'alamatCuti.string' => 'Alamat cuti harus berupa teks!',
        'nomorHp.required' => 'Nomor HP wajib diisi!',
        'nomorHp.string' => 'Nomor HP harus berupa teks!',
        'nomorHp.regex' => 'Nomor HP tidak sesuai format!',
        'nomorHp.min' => 'Nomor HP minimal terdiri dari 10 angka!',
        'nomorHp.max' => 'Nomor HP maksimal terdiri dari 15 angka!',
    ];

    public function goToNextPage()
    {
        // Validasi berdasarkan halaman saat ini
        $this->pegawaiId = Auth::user()->pegawai->id;
        if (isset($this->validationRules[$this->currentPage])) {
            $this->validate($this->validationRules[$this->currentPage], $this->messages);
        }

        // Proses khusus untuk halaman 1
        if ($this->currentPage === 1) {
            $data = [
                'cuti_id' => intval($this->jenisCutiTerpilih),
                'pegawai_id' => $this->pegawaiId,
            ];

            $result = $this->cekKetersediaanCuti($data);

            if (!$result['status']) {
                $this->dispatch(
                    'custom-alert',
                    type: 'error',
                    title: $result['message'],
                    position: 'center',
                    timer: 3000,
                );

                return;
            }
        }

        if ($this->currentPage === 2) {
            $tahunan = DataCuti::cekCutiTahunan($this->pegawaiId);
            // Validasi untuk jenis cuti tahunan
            if ($this->jenisCutiTerpilih === "1") {
                if ($this->durasiCuti > $tahunan['sisa_cuti']) {
                    $this->dispatch(
                        'custom-alert',
                        type: 'error',
                        title: 'Durasi cuti melebihi total sisa cuti tahunan.',
                        position: 'center',
                        timer: 3000,
                    );
                    return;
                }
            }

            if ($this->jenisCutiTerpilih === "3") {
                $maksimumCutiBersalin = 90; // Misalnya, 90 hari
                if ($this->durasiCuti > $maksimumCutiBersalin) {
                    $this->dispatch(
                        'custom-alert',
                        type: 'error',
                        title: 'Durasi cuti bersalin melebihi batas maksimum.',
                        position: 'center',
                        timer: 3000,
                    );
                    return;
                }
            }

            // Validasi untuk jenis cuti lainnya
            if ($this->jenisCutiTerpilih === "4") {
                $batasMaksimumCuti = 90; // Batas maksimum durasi cuti jenis 3
                if ($this->durasiCuti > $batasMaksimumCuti) {
                    $this->dispatch(
                        'custom-alert',
                        type: 'error',
                        title: 'Durasi cuti melebihi batas maksimum untuk cuti ini.',
                        position: 'center',
                        timer: 3000,
                    );
                    return;
                }
            }
        }

        // Proses khusus untuk halaman 3 (Unggah Dokumen)
        if ($this->currentPage === 3) {
            // Jika jenis cuti adalah 6 (cuti yang memerlukan dokumen)
            if ($this->jenisCutiTerpilih == 6) {
                $this->validate([
                    'dokumen' => 'required|file|max:2048', // dokumen wajib
                ]);
            } else {
                $this->validate([
                    'dokumen' => 'nullable|file|max:2048', // dokumen opsional
                ]);
            }

            // Tampilkan alert hanya jika ada dokumen yang diupload
            if ($this->dokumen) {
                $this->dispatch(
                    'custom-alert',
                    type: 'success',
                    title: 'Dokumen valid!',
                    position: 'center',
                    timer: 3000,
                );
            }
        }

        // Lanjut ke halaman berikutnya
        $this->currentPage++;
    }


    public function goToPreviousPage()
    {
        if ($this->currentPage === 2) {
            $this->loadSisaCuti();
        }

        $this->currentPage--;
    }

    // Atur lagi aja bang ini submit"annya, ini cuman sementara karena viewnya gabisa dinext kalo gaada submit
    public function submitForm()
    {
        try {
            $dokumenPath = null;
            if ($this->dokumen) {
                // Generate nama file yang unik
                $fileName = time() . '_' . $this->dokumen->getClientOriginalName();

                // Simpan file langsung ke storage/app/dokumen-cuti
                $dokumenPath = Storage::putFileAs(
                    'dokumen-cuti',
                    $this->dokumen,
                    $fileName
                );

                // Log untuk debugging
                Log::info('File path: ' . $dokumenPath);
            }
            // Logika pengajuan cuti
            $selama = $this->hitungHariKerja($this->tanggalMulai, $this->tanggalAkhir);
            $pengajuan = Pengajuan::ajukanCuti([
                'pengaju_id' => Auth::user()->pegawai->id,
                'penyetuju_id' => Auth::user()->atasan_id,
                'cuti_id' => $this->jenisCutiTerpilih,
                'tanggal_awal' => $this->tanggalMulai,
                'selama' => $selama,
                'alasan' => $this->alasan,
                'alamat' => $this->alamatCuti,
                'nomorHp' => $this->nomorHp,
                'tanggal_akhir' => $this->tanggalAkhir,
                'dokumen' => $dokumenPath
            ]);

            // Use $pengajuan->id instead of undefined $id
            $pengajuan = Pengajuan::with(['pengaju', 'penyetuju', 'cuti'])->findOrFail($pengajuan->id);

            // Kirim email ke semua pengguna dengan role "penyetuju"
            $atasanId = Auth::user()->atasan_id;
            $penyetujuUsers = User::where('pegawai_id', $atasanId)->get();
            $penyetujuUsersEmail = $penyetujuUsers->pluck('email');

            foreach ($penyetujuUsersEmail as $email) {
                try {
                    Mail::to($email)->later(now()->addMinute(), new PengajuanDisetujuiMail($pengajuan));
                } catch (\Throwable $e) {
                    Log::error("Gagal mengirim email ke {$email}: " . $e->getMessage());
                }
            }

            // Dispatch alert untuk sukses
            $this->dispatch('custom-alert', type: 'success', title: 'Pengajuan Berhasil', position: 'center', timer: 3000);

            // Reset form
            $this->reset(['jenisCutiTerpilih', 'tanggalMulai', 'alasan', 'durasiCuti', 'alamatCuti', 'nomorHp', 'currentPage']);

            // Redirect ke route pengaju.riwayat
            $this->dispatch('redirect-after-alert', [
                'url' => request()->header('Referer'),
                'delay' => 3000, // Waktu tunggu sebelum redirect (ms)
            ]);
        } catch (\Throwable $e) {
            // Log the error message for debugging
            Log::error('Error in submitForm: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            // Dispatch alert untuk error
            $this->dispatch('custom-alert', type: 'error', title: 'Terjadi Kesalahan', position: 'center', timer: 3000);
        }
    }

    public function resetSuccess()
    {
        $this->success = null;
    }

    public function render()
    {
        if ($this->jenisCutiTerpilih) {
            $this->loadSisaCuti();
        }
        return view('livewire.pengajuan-form');
    }

    public function mount()
    {
        $this->pegawaiId = Auth::user()->pegawai->id;

        $this->jenisCutiList = JenisCuti::getAllCuti();
    }


    public function loadSisaCuti()
    {
        if (!$this->pegawaiId || !$this->jenisCutiTerpilih) {
            return;
        }

        $this->sisaCuti = DataCuti::where('pegawais_id', $this->pegawaiId)
            ->where('jenis_cuti_id', intval($this->jenisCutiTerpilih))
            ->orderBy('tahun', 'desc')
            ->get(['tahun', 'sisa_cuti'])
            ->take(3);
    }

    public function updatedJenisCutiTerpilih()
    {
        $this->loadSisaCuti();
    }


    private function hitungHariKerja($tanggalMulai, $tanggalAkhir)
    {
        $tanggalMulai = Carbon::parse($tanggalMulai);
        $tanggalAkhir = Carbon::parse($tanggalAkhir);
        $jumlahHariKerja = 0;

        while ($tanggalMulai->lte($tanggalAkhir)) {
            if (!$tanggalMulai->isWeekend()) { // Hanya tambahkan jika bukan Sabtu atau Minggu
                $jumlahHariKerja++;
            }
            $tanggalMulai->addDay();
        }

        return $jumlahHariKerja;
    }


    public function cekKetersediaanCuti($data)
    {
        $tahunan = DataCuti::cekCutiTahunan($data["pegawai_id"]);
        if ($data["cuti_id"] === 1 && !$tahunan['status']) {
            return [
                'status' => false,
                'message' => 'Cuti Tahunan Habis', // Pesan khusus untuk cuti tahunan
            ]; // Tidak tersedia
        }
        if ($data['cuti_id'] === 4 && !RiwayatCuti::cekCutiBesar($data["pegawai_id"])) {
            return [
                'status' => false,
                'message' => 'Cuti Besar tidak dapat diajukan karena pernah mengajukan sebelumnya dalam 5 tahun terakhir', // Pesan khusus untuk cuti besar
            ]; // Tidak tersedia
        }

        return [
            'status' => true,
            'message' => 'Cuti tersedia', // Optional jika diperlukan
        ]; // Tersedia
    }
}
