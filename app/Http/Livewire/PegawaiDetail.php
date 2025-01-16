<?php

namespace App\Http\Livewire;

use App\Models\DataCuti;
use App\Models\JenisCuti;
use App\Models\Pegawai;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class PegawaiDetail extends Component
{
    public $currentPage = 1;
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

    public $pages = [
        1 => ['heading' => 'Detail Data Pegawai', 'subheading' => 'Berikut adalah detail dari data pegawai PPSDM BMKG'],
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

    public function render()
    {
        return view('livewire.pegawai-detail');
    }

    public function mount()
    {
        // Asumsi kolom 'nama' memiliki nilai 'Cuti Tahunan' dan 'Cuti Besar'
        $this->jenisCuti = JenisCuti::whereIn('jenis_cuti', ['Cuti Tahunan', 'Cuti Besar'])->get()->toArray();

        // Jika 'Cuti Tahunan' memiliki tahun dinamis
        foreach ($this->jenisCuti as &$cuti) {
            if ($cuti['jenis_cuti'] === 'Cuti Tahunan') {
                $currentYear = now()->year;
                $cuti['tahun'] = range($currentYear - 3, $currentYear); // 3 tahun ke belakang + tahun sekarang
            }
        }
    }
}
