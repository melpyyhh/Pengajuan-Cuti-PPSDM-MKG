<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PengaduanForm extends Component
{
    // Properti form
    public $currentPage = 1;
    public $subjek;
    public $isi;
    public $nama;
    public $email;

    public function goBack()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login

        if ($user->role === 'pengaju') {
            return redirect('/pengaju');
        } elseif ($user->role === 'penyetuju') {
            return redirect('/penyetuju');
        }

        // Jika tidak ada role yang cocok, redirect ke halaman default
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.pengaduan-form');
    }

    public function mount()
    {
        // Mendapatkan nama pengguna dari user yang sedang login
        $this->nama = Auth::user()->name;
        $this->email = Auth::user()->email;
    }
    public function submit()
    {
        // belum ada isinya bang
    }
}
