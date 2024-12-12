<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pengajuan;

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

    public $pages = [
        1 => ['heading' => 'Detail Cuti', 'subheading' => 'Berikut adalah detail cuti yang telah anda ajukan.'],
    ];

    public function mount($idPengajuan)
    {
        $this->idPengajuan = $idPengajuan;

        $pengajuan = Pengajuan::find($idPengajuan);

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
}
