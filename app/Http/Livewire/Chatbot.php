<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Chatbot extends Component
{
    public $showModal = false; // Properti untuk mengontrol tampilan modal
    public $question;          // Properti untuk pertanyaan pengguna
    public $chats = [];        // Array untuk menyimpan percakapan

    public function toggleModal()
    {
        // Jika modal dibuka, tambahkan pesan default dari bot
        if (!$this->showModal) {
            $this->chats = []; // Kosongkan percakapan jika modal ditutup dan dibuka kembali
            $this->chats[] = [
                'sender' => 'bot',
                'message' => "Halo, apa ada yang ingin ditanyakan? Anda dapat menanyakan terkait Prosedur Pengajuan Cuti, Prosedur Penyetujuan Cuti, Prosedur Pengaduan ke Admin, dan Memeriksa Sisa Cuti",
            ];
        }


        // Toggle status modal
        $this->showModal = !$this->showModal;
    }

    public function ask()
    {
        if ($this->question) {
            $this->chats[] = [
                'sender' => 'user',
                'message' => $this->question,
            ];

            $response = 'Maaf, saya tidak mengerti pertanyaan Anda. Silakan ajukan pengaduan ke admin.';

            if (stripos($this->question, 'Prosedur Pengajuan') !== false || stripos($this->question, 'Prosedur Pengajuan Cuti') !== false) {
                $response = 'Untuk mengajukan cuti, anda dapat klik menu Pengajuan -> Pilih Jenis Cuti -> Isi Form Cuti -> Tambahkan Dokumen (jika ada) -> Crosscheck Form -> Submit -> Selesai! Pengajuan anda telah sampai ke atasan.';
            } elseif (stripos($this->question, 'Prosedur Penyetuju') !== false || stripos($this->question, 'Prosedur Penyetuju Cuti') !== false) {
                $response = 'Untuk menyetujui cuti, anda dapat klik menu Daftar Ajuan Cuti Pegawai -> Klik Icon (i) Detail -> Lihat Detail Pengajuan -> Klik Setuju/Tolak -> Jika Tolak, Isikan Alasannya -> Selesai! Cuti Berhasil Disetujui/tolak.';
            } elseif (stripos($this->question, 'Prosedur Pengaduan') !== false || stripos($this->question, 'Prosedur Pengaduan ke Admin') !== false) {
                $response = 'Untuk Mengadukan ke Admin, anda dapat klik menu Ajukan Pengaduan ke Admin -> Buat Pengaduan -> Isikan Subjek dan Rincian Pengaduan -> Kirim Pengaduan -> Selesai! Pengaduan anda telah sampai ke Admin.';
            }



            $this->chats[] = [
                'sender' => 'bot',
                'message' => $response,
            ];

            $this->reset('question'); // Reset input

            // Kirim event untuk trigger scroll
            $this->dispatch('chats-updated');
        }
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}
