<?php

namespace App\Http\Livewire;

use App\Models\DataCuti;
use App\Models\JenisCuti;
use App\Models\Pegawai;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;

#[Title('Input Pegawai Form')]
class InputPegawaiForm extends Component
{
    public $currentPage = 1;

    // Properti form
    public $namaPegawai;
    public $NIP;
    public $unitKerjaPegawai;
    public $jabatanPegawai;
    public $masaKerjaPegawai;
    public $tanggalInputPegawai;
    public $jenisCuti = [];
    public $selectedJenisCuti = [];
    public $sisaCuti = [];
    public $jenisCutiFields = [0]; // Mengelola input
    public $tahun = [];

    public $pages = [
        1 => ['heading' => 'Data Pegawai', 'subheading' => 'Isikan Data Pegawai'],
    ];

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

    protected $validationRules = [
        1 => ['namaPegawai' => 'required|string'],
        2 => ['NIP' => 'required|string'],
        3 => ['unitKerjaPegawai' => 'required|string'],
        4 => ['masaKerjaPegawai' => 'required|integer|min:0'],
        5 => ['jabatanPegawai' => 'required|string'],
        6 => ['sisaCuti.*' => 'required|integer|min:0'],
        7 => ['selectedJenisCuti.*' => 'required|exists:jenis_cuti,id'],
        8 => ['tahun.*' => 'nullable|integer']
    ];

    public function submitForm()
    {
        try {
            $this->sisaCuti = is_array($this->sisaCuti) ? array_map('intval', $this->sisaCuti) : [];
            $this->tahun = is_array($this->tahun) ? array_map('intval', $this->tahun) : [];
            $masaKerjaPegawai = intval(trim($this->masaKerjaPegawai));
            // Validasi akhir
            $this->validate(array_merge(...array_values($this->validationRules)));
            // Simpan data pegawai
            $pegawaiBaru = Pegawai::tambahPegawai([
                'nama' => $this->namaPegawai,
                'nip' => $this->NIP,
                'jabatan' => $this->jabatanPegawai,
                'unitKerja' => $this->unitKerjaPegawai,
                'masaKerja' => $masaKerjaPegawai,
            ]);
            // Simpan data cuti
            $pegawaiId = $pegawaiBaru->id;
            foreach ($this->jenisCutiFields as $index) {
                DataCuti::tambahDataCuti([
                    'pegawai_id' => $pegawaiId,
                    'jenis_cuti_id' => $this->selectedJenisCuti[$index] ?? null,
                    'jumlah_cuti' => $this->sisaCuti[$index] ?? null,
                    'sisa_cuti' => $this->sisaCuti[$index] ?? null,
                    'tahun' => $this->tahun[$index] ?? null
                ]);
            }

            // Notifikasi sukses
            $this->dispatch('custom-alert', type: 'success', title: 'Tambah Pegawai Berhasil', position: 'center', timer: 3000);
            // Reset form setelah sukses submit
            $this->reset([
                'namaPegawai',
                'NIP',
                'jabatanPegawai',
                'unitKerjaPegawai',
                'masaKerjaPegawai',
                'jenisCuti',
                'sisaCuti',
                'jenisCutiFields',
                'selectedJenisCuti',
                'currentPage',  // Reset selectedJenisCuti juga
                'tahun'
            ]);
            $this->dispatch('redirect-after-alert', [
                'url' => request()->header('Referer'),
                'delay' => 3000, // Waktu tunggu sebelum redirect (ms)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->dispatch('custom-alert', type: 'error', title: 'Terjadi Kesalahan', position: 'center', timer: 3000);
        }
    }

    public function render()
    {
        return view('livewire.input-pegawai-form');
    }

    public function mount()
    {
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
        // Jika 'Cuti Tahunan' memiliki tahun dinamis
        foreach ($this->jenisCuti as &$cuti) {
            if ($cuti['jenis_cuti'] === 'Cuti Tahunan') {
                $currentYear = now()->year;
                $cuti['tahun'] = range($currentYear - 2, $currentYear); // 3 tahun ke belakang + tahun sekarang
            }
        }
    }
}
