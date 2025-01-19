<?php

namespace App\Http\Livewire;

use App\Models\DataCuti;
use App\Models\Pengajuan;
use App\Models\RiwayatCuti;
use App\Models\Pegawai;
use App\Mail\PenyetujuSetuju;
use App\Mail\PenyetujuTolak;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
    public $statusAjuan;

    public $pages = [
        1 => ['heading' => 'Detail Pengajuan', 'subheading' => 'Berikut adalah detail pengajuan cuti pegawai'],
    ];

    public function mount($idPengajuan)
    {
        $this->idPengajuan = $idPengajuan;
        $pengajuan = Pengajuan::find($idPengajuan);
        $riwayat = RiwayatCuti::getByPengajuanId($idPengajuan)->first();
        $this->statusAjuan = $riwayat->status_ajuan;
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
            // Step 1: Retrieve the pengajuan data using id
            $pengajuan = Pengajuan::findOrFail($this->idPengajuan);
    
            // Step 2: Update the status to 'ditolak'
            $data = [
                'id' => $this->idPengajuan,
                'status' => 'ditolak'
            ];
            Pengajuan::updateStatus($data);
    
            // Step 3: Get the email of the user who submitted the request
            $email = Pegawai::findOrFail($pengajuan->pengaju_id)->user->email;
    
            // Step 4: Send the rejection email to the user
            Mail::to($email)->send(new PenyetujuTolak($pengajuan));
    
            // Close the modal after rejection
            $this->closeModal();
    
            // Dispatch a success alert
            $this->dispatch(
                'custom-alert',
                type: 'success',
                title: 'Pengajuan Berhasil ditolak',
                position: 'center',
                timer: 3000
            );
        } catch (\Throwable $th) {
            // Dispatch an error alert if something goes wrong
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
            // Step 1: Update status to 'disetujui'
            $data = [
                'id' => $this->idPengajuan,
                'status' => 'disetujui'
            ];
            Pengajuan::updateStatus($data);

            // Step 2: Retrieve the pengajuan object after updating
            $pengajuan = Pengajuan::find($this->idPengajuan);

            // Step 3: Update the DataCuti table with the approved data
            $updatedData = [
                'pegawai_id' => $pengajuan->pengaju_id,
                'cuti_id' => $pengajuan->cuti_id,
                'selama' => $pengajuan->selama,
                'tahun' => Carbon::now()->year
            ];
            DataCuti::updateDataCuti($updatedData);

            // Step 4: Get the email of the user who made the request (using pengaju_id)
            $email = Pegawai::findOrFail($pengajuan->pengaju_id)->user->email;

            // Step 5: Send the approval email to the user
            Mail::to($email)->send(new PenyetujuSetuju($pengajuan));

            // Step 6: Dispatch success alert
            $this->dispatch(
                'custom-alert',
                type: 'success',
                title: 'Pengajuan Berhasil disetujui',
                position: 'center',
                timer: 3000
            );
            return redirect()->route('penyetuju.daftar-cuti');
        } catch (\Throwable $th) {
            // Log error and dispatch error alert
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
