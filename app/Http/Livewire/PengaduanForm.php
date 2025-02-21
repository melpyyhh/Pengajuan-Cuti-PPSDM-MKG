<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Pengaduan;
use Livewire\Attributes\Title;

#[Title('Form Pengaduan')]
class PengaduanForm extends Component
{
    // Properti form
    public $currentPage = 1;
    public $subjek;
    public $isi;

    public $dataPegawai = [];
    public $nama;
    public $email;
    public $sudahReset;

    public function render()
    {
        return view('livewire.pengaduan-form');
    }

    public function mount()
    {
        // Mendapatkan nama pengguna dari user yang sedang login
        $this->dataPegawai = [
            'nama' => Auth::user()->pegawai->nama,
            'email' => Auth::user()->email,
            'unitKerja' => Auth::user()->pegawai->unitKerja

        ];
    }

    protected $validationRules = [
        'subjek' => 'required|string|max:20',
        'isi' => 'required|string|max:255',
    ];

    protected $messages = [
        'subjek.required' => 'Subjek harus diisi.',
        'isi.required' => 'Isi pengaduan harus diisi.',
        'subjek.max' => 'Subjek pengaduan tidak boleh lebih dari 20 karakter.',
        'isi.max' => 'Isi pengaduan tidak boleh lebih dari 255 karakter.',
    ];

    public function submitPengaduan()
    {
        try {
            if ($this->sudahReset == 0) {
                // Validasi input
                $this->validate($this->validationRules);
                Log::info('Validasi berhasil.');

                Pengaduan::aduan([
                    'admin_id' => 2,
                    'pegawai_id' => Auth::user()->pegawai->id,
                    'name' => $this->nama,
                    'title' => $this->subjek,
                    'descriptions' => $this->isi,
                ]);
                // Dispatch alert untuk sukses
                $this->dispatch('custom-alert', type: 'success', title: 'Pengaduan Berhasil', position: 'center', timer: 3000);
                // Reset form
                $this->reset(['subjek', 'isi']);
                $this->sudahReset = 1;
            }
            // Kembali ke riwayat-pengaduan
            $this->dispatch('redirect-after-alert', [
                'url' => request()->header('Referer'),
                'delay' => 3000, // Waktu tunggu sebelum redirect (ms)
            ]);
        } catch (\Throwable $e) {
            Log::error('Error: ' . $e->getMessage());
            // Dispatch alert untuk error
            $this->dispatch('custom-alert', type: 'error', title: 'Terjadi Kesalahan', position: 'center', timer: 3000);
        }
    }
}
