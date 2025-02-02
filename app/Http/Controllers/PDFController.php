<?php

namespace App\Http\Controllers;

use App\Models\DataCuti;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{

    public function exportPDF($idPengajuan)
    {
        // Query data pengajuan berdasarkan idPengajuan
        $pengajuan = DB::table('pengajuans')
            ->join('pegawais as pengaju', 'pengajuans.pengaju_id', '=', 'pengaju.id')
            ->join('pegawais as penyetuju', 'pengajuans.penyetuju_id', '=', 'penyetuju.id')
            ->join('jenis_cuti', 'pengajuans.cuti_id', '=', 'jenis_cuti.id')
            ->join('riwayat_cutis', 'pengajuans.id', '=', 'riwayat_cutis.pengajuan_id')
            ->join('pegawais as atasan', 'atasan.id', '=', DB::raw(Auth::user()->atasan_id)) // Join ke tabel pegawais berdasarkan atasan_id
            ->select(
                'pengajuans.id',
                'pengaju.id as id_pengaju',
                'pengaju.nama as nama_pengaju',
                'pengaju.nip as nip_pengaju',
                'pengaju.jabatan as jabatan_pengaju',
                'pengaju.unitKerja as unitKerja_pengaju',
                'pengaju.masaKerja as masaKerja_pengaju',
                'penyetuju.nama as nama_penyetuju',
                'penyetuju.nip as nip_penyetuju',
                'atasan.nama as nama_atasan',
                'atasan.nip as nip_atasan',
                'jenis_cuti.jenis_cuti as jenis_cuti',
                'pengajuans.alasan as alasan',
                'pengajuans.selama as lama_cuti',
                'pengajuans.tanggal_awal as start_cuti',
                'pengajuans.alamatCuti as alamat_cuti',
                'pengajuans.nomorHp as nomor_hp',
                'pengajuans.created_at',
                'pengajuans.updated_at as tanggalDiajukan',
                'riwayat_cutis.status_ajuan as riwayat_status_ajuan'
            )
            ->where('pengajuans.id', '=', $idPengajuan)
            ->first();
        $sisaCuti = DataCuti::where('pegawais_id', $pengajuan->id_pengaju)
            ->where('jenis_cuti_id', 1)
            ->orderBy('tahun', 'desc') // Urutkan berdasarkan tahun
            ->take(3) // Ambil hanya 3 data teratas
            ->get(['tahun', 'sisa_cuti']);
        // Pastikan data ditemukan sebelum membuat PDF
        if (!$pengajuan) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        // Format Tanggal Surat
        $pengajuan->tanggalDiajukanFormatted = Carbon::parse($pengajuan->tanggalDiajukan)
            ->translatedFormat('l, d F Y');
        // Format Tanggal Section IV
        $pengajuan->startCutiFormatted = Carbon::parse($pengajuan->start_cuti)
        ->translatedFormat('d F Y');
        // Kirim data ke tampilan PDF
        $pdf = Pdf::loadView('pdf.report', ['pengajuan' => $pengajuan, 'ttd' => public_path('img/dummy.jpg'), 'sisaCuti' => $sisaCuti]);
        // Unduh PDF
        return $pdf->download('laporan-pengajuan-' . $pengajuan->id . '.pdf');
    }
}
