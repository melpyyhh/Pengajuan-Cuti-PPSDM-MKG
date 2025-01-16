<?php

// app/Http/Livewire/PengajuanLivewire.php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Mail\PengajuanDisetujuiMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Pengajuan;

class PengajuanLivewire extends Component
{
    public $pengajuan;
    
    public function mount($id)
    {
        $this->pengajuan = Pengajuan::find($id);
    }

    public function submitPenyetuju()
    {
        try {
            // Ubah status pengajuan menjadi 'disetujui'
            $this->pengajuan->update(['status' => 'disetujui']);
    
            // Kirim email ke semua pengguna dengan role "pengaju"
            $pengajuUser = User::find($this->pengajuan->pengaju_id); // Assuming pengaju_id is related to the user
    
            if ($pengajuUser) {
                // Send email to the pengaju user (the one who made the request)
                Mail::to($pengajuUser->email)->send(new PengajuanDisetujuiMail($this->pengajuan));
            }
    
            // Kirim email ke semua pengguna dengan role "penyetuju"
            $penyetujuUsers = User::where('role', 'penyetuju')->get();
            foreach ($penyetujuUsers as $user) {
                Mail::to($user->email)->send(new PengajuanDisetujuiMail($this->pengajuan));
            }
    
            // Notifikasi berhasil
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success', 
                'message' => 'Pengajuan berhasil disetujui dan email telah dikirim!'
            ]);
        } catch (\Exception $e) {
            // Logging error dan notifikasi gagal
            logger()->error($e->getMessage());
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error', 
                'message' => 'Terjadi kesalahan, coba lagi nanti.'
            ]);
        }
    }
    

    public function render()
    {
        return view('livewire.pengajuan-livewire');
    }
}
