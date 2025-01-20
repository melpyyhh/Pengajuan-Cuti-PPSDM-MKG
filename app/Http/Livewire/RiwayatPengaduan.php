<?php

namespace App\Http\Livewire;

use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

use Livewire\Attributes\Title;

#[Title('Riwayat Pengaduan')]
class RiwayatPengaduan extends Component
{
    public $dataPegawai = [];
    public $pengaduans;
    public $search = '';
    public $totalPengaduan;
    public $daftartungguCount;
    public $ditanggapiCount;
    public $isOpen = false;
    public $selectedPengaduan;
    public $tanggapan;
    public $modalFeedback;
    public $pegawaiId;
    public $user;

    public function mount()
    {
        $this->pegawaiId = Auth::user()->pegawai->id;
        $this->user = Auth::user(); // Mendapatkan user yang sedang login
        $this->pengaduans = Pengaduan::getByPegawaiId($this->pegawaiId);
        $this->totalPengaduan = Pengaduan::countAllByPegawaiId($this->pegawaiId);
        $this->daftartungguCount = Pengaduan::countDaftarTungguByPegawaiId($this->pegawaiId);
        $this->ditanggapiCount = Pengaduan::countDitanggapiByPegawaiId($this->pegawaiId);
    }

    public function openModal($pengaduanId)
    {
        try {
            // $this->selectedPengaduan = Pengaduan::findOrFail($pengaduanId)->pegawai_id;
            $this->selectedPengaduan = Pengaduan::find($pengaduanId);
            if ($this->selectedPengaduan && $this->selectedPengaduan->admin) {
                $admin = $this->selectedPengaduan->admin;
                $this->dataPegawai = [
                    'nama' => $admin->nama ?? 'Tidak ditemukan',
                    'email' => $admin->user->email ?? 'Tidak ditemukan',
                    'jabatan' => $admin->jabatan ?? 'Tidak ditemukan',
                ];
            } else {
                $this->dataPegawai = [
                    'nama' => 'Tidak ditemukan',
                    'email' => 'Tidak ditemukan',
                    'jabatan' => 'Tidak ditemukan',
                ];
            }
            $this->isOpen = true;
            Log::info("Modal opened for pengaduan ID: {$this->selectedPengaduan->id}");
        } catch (\Exception $e) {
            Log::error("Error opening modal: " . $e->getMessage());
            session()->flash('error', 'Pengaduan tidak ditemukan.');
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->selectedPengaduan = null;
        Log::info("Modal closed");
    }
    public function searchAction()
    {
        // Filter berdasarkan kata kunci pencarian
        if (!empty($this->search)) {
            $this->pengaduans = Pengaduan::getAllWithRelationsByTitleAndPegawaiId($this->search, $this->pegawaiId);
        } else {
            // Jika tidak ada kata kunci pencarian, ambil semua pengaduan dengan relasi
            $this->pengaduans = Pengaduan::getByPegawaiId($this->pegawaiId);
        }
    }
    public function render()
    {
        return view('livewire.riwayat-pengaduan');
    }
}
