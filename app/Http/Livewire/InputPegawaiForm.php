<?php

namespace App\Http\Livewire;

use Livewire\Component;

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
    public $sisaCuti = [];
    public $jenisCutiFields = [0]; // Mengelola input

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
            array_pop($this->jenisCuti); // Hapus jenis cuti terkait
            array_pop($this->sisaCuti); // Hapus sisa cuti terkait
        }
    }

    public function render()
    {
        return view('livewire.input-pegawai-form');
    }
}
