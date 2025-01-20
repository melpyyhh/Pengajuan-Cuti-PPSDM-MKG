<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pengajuan;
use App\Models\RiwayatCuti;

class PengajuanDetail extends Component
{
    public $currentPage = 1;
    public $jenisCuti;
    public $alasanCuti;
    public $tanggalMulai;
    public $tanggalSelesai;
    public $nomorHp;
    public $alamatCuti;
    public $dokumen;
    public $idPengajuan;
    public $idRiwayat;
    public $statusAjuan;
    public $feedback;


    public $pages = [
        1 => ['heading' => 'Detail Cuti', 'subheading' => 'Berikut adalah detail cuti yang telah anda ajukan.'],
    ];

    public function mount($idPengajuan)
    {
        $this->idPengajuan = $idPengajuan;

        $pengajuan = Pengajuan::find($idPengajuan);
        $riwayat = RiwayatCuti::getByPengajuanId($idPengajuan)->first();
        if ($riwayat) {
            $this->statusAjuan = strtolower($riwayat->status_ajuan); // Simpan status pengajuan (lowercase untuk konsistensi)
            $this->idRiwayat = $riwayat->id;
            $this->feedback = $riwayat->feedback;
        }

        if ($pengajuan) {
            $this->jenisCuti = $pengajuan->cuti->jenis_cuti;
            $this->alasanCuti = $pengajuan->alasan;
            $this->tanggalMulai = $pengajuan->tanggal_awal ? \Carbon\Carbon::parse($pengajuan->tanggal_awal)->format('Y-m-d') : '';
            $this->tanggalSelesai = $pengajuan->tanggal_akhir ? \Carbon\Carbon::parse($pengajuan->tanggal_akhir)->format('Y-m-d') : '';
            $this->nomorHp = $pengajuan->nomorHp;
            $this->alamatCuti = $pengajuan->alamatCuti;
        } else {
            $this->dispatchBrowserEvent('custom-alert', [
                'type' => 'error',
                'title' => 'Data Pengajuan Tidak Ditemukan',
                'position' => 'center',
                'timer' => 3000
            ]);
        }
    }


    public function render()
    {
        return view('livewire.pengajuan-detail');
    }

    public function buttonDelete()
    {
        try {
            // Panggil method deletePengajuan di model
            $isDeleted = Pengajuan::deletePengajuan($this->idRiwayat);
            if ($isDeleted) {
                // Notifikasi sukses
                $this->dispatch(
                    'custom-alert',
                    type: 'success',
                    title: 'Pengajuan Berhasil dihapus',
                    position: 'center',
                    timer: 3000
                );
                // Redirect setelah berhasil
                return redirect()->route('pengaju.riwayat');
            } else {
                // Notifikasi gagal jika data tidak valid
                $this->dispatch(
                    'custom-alert',
                    type: 'error',
                    title: 'Pengajuan yang sudah disetujui atau ditolak tidak bisa dihapus',
                    position: 'center',
                    timer: 3000
                );
            }
        } catch (\Throwable $e) {
            // Tangani error yang terjadi
            $this->dispatch(
                'custom-alert',
                type: 'error',
                title: 'Terjadi kesalahan: ' . $e->getMessage(),
                position: 'center',
                timer: 3000
            );
        }
    }
}
