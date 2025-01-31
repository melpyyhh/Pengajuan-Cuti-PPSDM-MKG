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
    public $selectedJenisCuti = [];
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

        $currentYear = now()->year;
        // Generate 3 tahun terakhir untuk Cuti Tahunan
        $this->tahun = [
            $currentYear,
            $currentYear - 1,
            $currentYear - 2
        ];

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
                    if ($cuti->jenis_cuti_id == '1') {
                        // Untuk Cuti Tahunan
                        $this->sisaCuti[$cuti->tahun] = $cuti->sisa_cuti;
                    } elseif ($cuti->jenis_cuti_id == '4') {
                        // Untuk Cuti Besar
                        $this->sisaCuti['cutiBesar'] = $cuti->sisa_cuti;
                    }
                }
            }
        } else {
            Log::error("Data pegawai dengan ID {$pegawaiId} tidak ditemukan.");
            session()->flash('error', 'Data pegawai tidak ditemukan.');
            return redirect()->route('admin.daftar-pegawai');
        }
    }

    public function messages()
{
    return [
        'sisaCuti.*.max' => 'Sisa cuti tidak boleh lebih dari :max hari.'
    ];
}

    public function updatePegawai()
    {
        try {
            $rules = [
                'namaPegawai' => 'required|string|max:255',
                'NIP' => 'required|string|max:20',
                'unitKerjaPegawai' => 'required|string|max:255',
                'jabatanPegawai' => 'required|string|max:255',
                'masaKerjaPegawai' => 'required|int|max:255',
            ];

            // Tambahkan validasi untuk setiap tahun cuti tahunan
            foreach ($this->tahun as $index => $tahun) {
                if ($index === 0) {
                    // Tahun saat ini, boleh sampai 12 hari
                    $rules['sisaCuti.' . $tahun] = 'nullable|numeric|max:12';
                } else {
                    // Tahun sebelumnya, maksimal 6 hari
                    $rules['sisaCuti.' . $tahun] = 'nullable|numeric|max:6';
                }
            }

            // Validasi untuk cuti besar
            $rules['sisaCuti.cutiBesar'] = 'nullable|numeric|max:90';

            $this->validate($rules);
            $pegawai = Pegawai::find($this->pegawaiId);
            if ($pegawai) {
                $pegawai->update([
                    'nama' => $this->namaPegawai,
                    'nip' => $this->NIP,
                    'unitKerja' => $this->unitKerjaPegawai,
                    'jabatan' => $this->jabatanPegawai,
                    'masaKerja' => $this->masaKerjaPegawai,
                ]);

                // Simpan data cuti tahunan
                foreach ($this->tahun as $tahun) {
                    DataCuti::updateOrCreate(
                        [
                            'pegawais_id' => $this->pegawaiId,
                            'jenis_cuti_id' => '1', // ID untuk Cuti Tahunan
                            'tahun' => $tahun
                        ],
                        [
                            'sisa_cuti' => $this->sisaCuti[$tahun] ?? 0
                        ]
                    );
                }

                // Simpan data cuti besar
                DataCuti::updateOrCreate(
                    [
                        'pegawais_id' => $this->pegawaiId,
                        'jenis_cuti_id' => '4', // ID untuk Cuti Besar
                    ],
                    [
                        'sisa_cuti' => $this->sisaCuti['cutiBesar'] ?? 0
                    ]
                );

                $this->dispatch('custom-alert', type: 'success', title: 'Data Pegawai Berhasil Diperbarui', position: 'center', timer: 3000);
                $this->dispatch('redirect-after-alert', [
                    'url' => request()->header('Referer'),
                    'delay' => 3000,
                ]);
            } else {
                $this->dispatch('custom-alert', type: 'error', title: 'Data Pegawai Tidak Ditemukan', position: 'center', timer: 3000);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->dispatch('custom-alert', type: 'error', title: 'Terjadi Kesalahan', position: 'center', timer: 3000);
        }
    }
    public function deletePegawai()
    {
        try {
            $pegawai = Pegawai::find($this->pegawaiId);
            if ($pegawai) {
                $pegawai->delete();
                $this->dispatch('custom-alert', type: 'success', title: 'Data Pegawai Berhasil Dihapus', position: 'center', timer: 3000);
                $this->dispatch('redirect-after-alert', [
                    'url' => route('admin.daftar-pegawai'),
                    'delay' => 3000
                ]);
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
