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
                'message' => 'Halo, apa ada yang ingin ditanyakan?',
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

            $response = 'Maaf, saya tidak mengerti pertanyaan Anda. Silakan coba lagi.';
            if (stripos($this->question, 'cuti') !== false) {
                $response = 'Informasi tentang cuti: Anda dapat mengajukan cuti melalui HRD atau aplikasi.';
            } elseif (stripos($this->question, 'jadwal') !== false) {
                $response = 'Jadwal kerja: Senin-Jumat, 08:00-17:00.';
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
