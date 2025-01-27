<?php

namespace App\Http\Livewire;

use App\Models\Pegawai;
use App\Models\DataCuti;
use App\Models\JenisCuti;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Detail Pegawai')]
class PegawaiDetail extends Component
{
    public $pegawaiId;
    public $namaPegawai;
    public $NIP;
    public $unitKerjaPegawai;
    public $jabatanPegawai;
    public $masaKerjaPegawai;
    public $jenisCuti = [];
    public $jenisCutiFields = [];
    public $selectedJenisCuti = [
        1 => 'Cuti Tahunan',
        4 => 'Cuti Besar',
    ];
    public $sisaCuti = [];
    public $tahun = [];

    public function mount($pegawaiId)
    {
        // Inisialisasi jenis cuti
        $this->jenisCuti = [
            [
                'id' => '1',
                'jenis_cuti' => "Cuti Tahunan",
            ],
            [
                'id' => '4',
                'jenis_cuti' => "Cuti Besar",
            ]
        ];

        // Tambahkan tahun dinamis untuk Cuti Tahunan
        foreach ($this->jenisCuti as &$cuti) {
            if ($cuti['jenis_cuti'] === 'Cuti Tahunan') {
                $currentYear = now()->year;
                $cuti['tahun'] = range($currentYear - 2, $currentYear); // 3 tahun ke belakang + tahun sekarang
            }
        }

        $pegawai = Pegawai::find($pegawaiId);

        if ($pegawai) {
            $this->pegawaiId = $pegawaiId;
            $this->namaPegawai = $pegawai->nama;
            $this->NIP = $pegawai->nip;
            $this->unitKerjaPegawai = $pegawai->unitKerja;
            $this->jabatanPegawai = $pegawai->jabatan;
            $this->masaKerjaPegawai = $pegawai->masaKerja;

            // Initialize data cuti
            $dataCuti = DataCuti::where('pegawais_id', $pegawaiId)->get();

            foreach ($dataCuti as $cuti) {
                if (isset($cuti->jenis_cuti_id) && isset($cuti->sisa_cuti)) {
                    $this->jenisCutiFields[$cuti->jenis_cuti_id] = $cuti->jenis_cuti_id;
                    $this->sisaCuti[$cuti->jenis_cuti_id] = $cuti->sisa_cuti;
                    $this->tahun[$cuti->jenis_cuti_id] =  $cuti->tahun;
                }
            }
        } else {
            Log::error("Data pegawai dengan ID {$pegawaiId} tidak ditemukan.");
            session()->flash('error', 'Data pegawai tidak ditemukan.');
            return redirect()->route('admin.daftar-pegawai');
        }
        if (empty($this->jenisCutiFields)) {
            $this->jenisCutiFields[] = '';
            $this->sisaCuti[] = '';
            $this->tahun[] = '';
        }
    }

    public function addJenisCuti()
    {
        $this->jenisCutiFields[] = count($this->jenisCutiFields); // Tambahkan indeks baru
    }

    public function removeJenisCuti()
    {
        if (count($this->jenisCutiFields) > 1) {
            array_pop($this->jenisCutiFields); // Hapus elemen terakhir
            array_pop($this->selectedJenisCuti); // Hapus jenis cuti terkait
            array_pop($this->sisaCuti); // Hapus sisa cuti terkait
        }
    }

    public function updatePegawai()
    {
        $this->validate([
            'namaPegawai' => 'required|string|max:255',
            'NIP' => 'required|string|max:20',
            'unitKerjaPegawai' => 'required|string|max:255',
            'jabatanPegawai' => 'required|string|max:255',
            'masaKerjaPegawai' => 'required|int|max:255',
        ]);

        $pegawai = Pegawai::find($this->pegawaiId);
        if ($pegawai) {
            $pegawai->update([
                'nama' => $this->namaPegawai,
                'nip' => $this->NIP,
                'unitKerja' => $this->unitKerjaPegawai,
                'jabatan' => $this->jabatanPegawai,
                'masaKerja' => $this->masaKerjaPegawai,
            ]);

            foreach ($this->jenisCutiFields as $index => $jenisCutiId) {
                if ($jenisCutiId && isset($this->sisaCuti[$index]) && is_numeric($this->sisaCuti[$index])) {
                    DataCuti::updateOrCreate(
                        [
                            'pegawais_id' => $this->pegawaiId,
                            'jenis_cuti_id' => $jenisCutiId,
                        ],
                        [
                            'sisa_cuti' => $this->sisaCuti[$index],
                        ]
                    );
                }
            }

            $this->dispatch('custom-alert', type: 'success', title: 'Data Pegawai Berhasil Diperbarui', position: 'center', timer: 3000);
            $this->dispatch('redirect-after-alert', [
                'url' => request()->header('Referer'),
                'delay' => 3000, // Waktu tunggu sebelum redirect (ms)
            ]);
        } else {
            session()->flash('error', 'Data pegawai tidak ditemukan!');
        }
    }

    public function deletePegawai()
    {
        try {
            $pegawai = Pegawai::find($this->pegawaiId);
            if ($pegawai) {
                $pegawai->dataCuti()->delete();
                $pegawai->delete();

                session()->flash('success', 'Data pegawai berhasil dihapus!');
                return redirect()->route('admin.daftar-pegawai');
            } else {
                session()->flash('error', 'Data pegawai tidak ditemukan!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus data pegawai.');
        }
    }
    public function goBack()
    {
        return redirect()->route('admin.daftar-pegawai');
    }

    public function render()
    {
        return view('livewire.pegawai-detail');
    }
}
