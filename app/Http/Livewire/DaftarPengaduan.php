<?php

namespace App\Http\Livewire;

use App\Models\Pengaduan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Daftar Pengaduan')]
class DaftarPengaduan extends Component
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

    public function mount()
    {
        $this->dataPegawai = [
            'nama' => Auth::user()->pegawai->nama,
            'email' => Auth::user()->email,
            'jabatan' => Auth::user()->pegawai->jabatan
        ];
        $this->pengaduans = Pengaduan::getAllWithRelations();
        $this->totalPengaduan = Pengaduan::count();
        $this->daftartungguCount = Pengaduan::countDaftarTunggu();
        $this->ditanggapiCount = Pengaduan::countDitanggapi();
    }

    public function openModal($pengaduanId)
    {
        try {
            $this->selectedPengaduan = Pengaduan::find($pengaduanId);
            if ($this->selectedPengaduan->status_pengaduan === 'ditanggapi') {
                $this->tanggapan = $this->selectedPengaduan->reply ?? ''; // Jika ada reply, set ke tanggapan
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
        $this->reset('tanggapan');
        Log::info("Modal closed");
    }

    protected $validationRules = [
        'tanggapan' => 'required|string|max:255',
    ];

    protected $messages = [
        'tanggapan.required' => 'Tanggapan pengaduan harus diisi.',
        'tanggapan.max' => 'Tanggapan pengaduan tidak boleh lebih dari 255 karakter.',
    ];

    public function submitTanggapan()
    {
        // Validasi input
        $this->validate($this->validationRules);

        try {
            $data = [
                'id' => $this->selectedPengaduan->id,
                'admin_id' => Auth::user()->id,
                'status' => 'ditanggapi',
                'reply' => $this->tanggapan
            ];
            Pengaduan::updateStatusReply($data);
            Log::info("Membalas pengaduan dengan id: {$this->selectedPengaduan->id}");
            $this->closeModal();
            $this->dispatch(
                'custom-alert',
                type: 'success',
                title: 'Berhasil menanggapi',
                position: 'center',
                timer: 3000
            );
            $this->dispatch('redirect-after-alert', [
                'url' => request()->header('Referer'),
                'delay' => 3000, // Waktu tunggu sebelum redirect (ms)
            ]);
        } catch (\Exception $e) {
            Log::error("Error saat membalas pengaduan dengan id: {$this->selectedPengaduan->id}");
            $this->dispatch(
                'custom-alert',
                type: 'error',
                title: 'Terjadi Kesalahan',
                position: 'center',
                timer: 3000
            );
        }
    }
    public function searchAction()
    {
        // Filter berdasarkan kata kunci pencarian
        if (!empty($this->search)) {
            $this->pengaduans = Pengaduan::getAllWithRelationsByTitle($this->search);
        } else {
            // Jika tidak ada kata kunci pencarian, ambil semua pengaduan dengan relasi
            $this->pengaduans = Pengaduan::getAllWithRelations();
        }
    }

    public function render()
    {
        return view('livewire.daftar-pengaduan');
    }
}
