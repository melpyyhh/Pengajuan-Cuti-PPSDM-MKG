<?php

namespace App\Http\Livewire;

use App\Models\Pengajuan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

use function PHPSTORM_META\type;

class PenyetujuDetail extends Component
{

    public $currentPage = 1;
    public $tanggalMulai;
    public $tanggalSelesai;
    public $alasan;
    public $dokumen;
    public $isOpen = false; // Status modal
    public $modalAlasan = ''; // Alasan untuk penolakan
    public $idPengajuan;

    public $pages = [
        1 => ['heading' => 'Detail Pengajuan', 'subheading' => 'Berikut adalah detail pengajuan cuti pegawai'],
    ];

    public function mount($idPengajuan)
    {
        $this->idPengajuan = $idPengajuan;

        $pengajuan = Pengajuan::find($idPengajuan);

        if ($pengajuan) {
            $this->tanggalMulai = $pengajuan->tanggal_awal ? \Carbon\Carbon::parse($pengajuan->tanggal_awal)->format('Y-m-d') : '';
            $this->tanggalSelesai = $pengajuan->tanggal_akhir ? \Carbon\Carbon::parse($pengajuan->tanggal_akhir)->format('Y-m-d') : '';
            $this->alasan = $pengajuan->alasan;
        } else {
            $this->dispatchBrowserEvent('custom-alert', [
                'type' => 'error',
                'title' => 'Data Pengajuan Tidak Ditemukan',
                'position' => 'center',
                'timer' => 3000
            ]);
        }
    }
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
        try {
            $data = [
                'id' => $this->idPengajuan,
                'status' => 'ditolak'
            ];
            Pengajuan::updateStatus($data);
            $this->closeModal(); // Tutup modal setelah penolakan
            $this->dispatch(
                'custom-alert',
                type: 'success',
                title: 'Pengajuan Berhasil ditolak',
                position: 'center',
                timer: 3000
            );
        } catch (\Throwable $th) {
            $this->dispatch(
                'custom-alert',
                type: 'error',
                title: 'Terjadi Kesalahan Mohon dicoba ulang atau hubungi Admin',
                position: 'center',
                timer: 3000
            );
        }
    }

    public function render()
    {
        return view('livewire.penyetuju-detail');
    }

    public function submitPenyetuju()
    {
        try {
            $data = [
                'id' => $this->idPengajuan,
                'status' => 'disetujui'
            ];
            Pengajuan::updateStatus($data);
            $this->dispatch(
                'custom-alert',
                type: 'success',
                title: 'Pengajuan Berhasil disetujui',
                position: 'center',
                timer: 3000
            );
        } catch (\Throwable $th) {
            Log::error('Error saat menyetujui pengajuan: ' . $th->getMessage());
            $this->dispatch(
                'custom-alert',
                type: 'error',
                title: 'Terjadi Kesalahan Mohon dicoba ulang atau hubungi Admin',
                position: 'center',
                timer: 3000
            );
        }
    }
}
