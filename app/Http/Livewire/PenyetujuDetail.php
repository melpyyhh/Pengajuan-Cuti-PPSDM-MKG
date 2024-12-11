<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class PenyetujuDetail extends Component
{

    public $currentPage = 1;
    public $tanggalMulai;
    public $tanggalSelesai;
    public $dokumen;
    public $isOpen = false; // Status modal
    public $modalAlasan = ''; // Alasan untuk penolakan

    public $pages = [
        1 => ['heading' => 'Detail Pengajuan', 'subheading' => 'Berikut adalah detail pengajuan cuti pegawai'],
    ];

    // Metode untuk membuka modal
    public function openModal()
    {
        $this->isOpen = true; // Ubah status modal menjadi terbuka
    }

    // Metode untuk menutup modal
    public function closeModal()
    {
        $this->isOpen = false; // Ubah status modal menjadi tertutup
    }

    // Metode untuk mengirim penolakan
    public function submitTolak()
    {
        // Lakukan aksi penolakan, misalnya simpan alasan penolakan
        session()->flash('message', 'Pengajuan cuti ditolak!');

        $this->closeModal(); // Tutup modal setelah penolakan
    }

    public function render()
    {
        return view('livewire.penyetuju-detail');
    }
}
