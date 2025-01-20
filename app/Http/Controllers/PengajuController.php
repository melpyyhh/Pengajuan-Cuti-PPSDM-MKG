<?php

// app/Http/Controllers/PengajuanController.php

namespace App\Http\Controllers;

use App\Mail\PengajuanDisetujui;
use Illuminate\Support\Facades\Mail;
use App\Models\Pengajuan;
use App\Mail\PengajuanDisetujuiMail;
use App\Models\RiwayatCuti;
use Illuminate\Support\Facades\Auth;

class PengajuController extends Controller
{

    public function riwayatCuti()
    {
        $listRiwayat = RiwayatCuti::getByPegawaiId(Auth::user()->pegawai_id)->paginate(5);
        return view('pengaju.riwayat', compact('listRiwayat'));
    }
    public function submitPenyetuju($id)
    {
        try {
            // Ambil data pengajuan berdasarkan ID
            $pengajuan = Pengajuan::find($id);

            // Cek apakah data pengajuan ditemukan
            if ($pengajuan) {
                // Ubah status pengajuan menjadi 'disetujui'
                $pengajuan->update(['status' => 'disetujui']);

                // Kirim email ke pengaju
                Mail::to($pengajuan->email_pengaju)->send(new PengajuanDisetujui($pengajuan));

                // Tampilkan notifikasi berhasil
                return redirect()->back()->with('success', 'Pengajuan berhasil disetujui dan email telah dikirim!');
            }

            return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
        } catch (\Exception $e) {
            // Logging kesalahan dan notifikasi gagal
            logger()->error($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba lagi nanti.');
        }
    }
}
