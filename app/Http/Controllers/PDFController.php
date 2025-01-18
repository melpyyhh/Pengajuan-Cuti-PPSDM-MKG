<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PDFController extends Controller
{

    public function exportPDF($id)
    {
        $pengajuan = DB::table('pengajuans')
            ->join('pegawais', 'pengajuans.pengaju_id', '=', 'pegawais.id')
            ->join('jenis_cuti', 'pengajuans.cuti_id', '=', 'jenis_cuti.id')
            ->join('riwayat_cutis', 'pengajuans.id', '=', 'riwayat_cutis.pengajuan_id')
            ->select(
                'pengajuans.id',
                'pegawais.nama as nama_pengaju',
                'pegawais.nip as nip_pengaju',
                'pegawais.jabatan as jabatan_pengaju',
                'pegawais.unitKerja as unitKerja_pengaju',
                'pegawais.masaKerja as masaKerja_pengaju',
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
            ->where('pengajuans.id', '=', $id)
            ->first();

        // Pastikan data ditemukan sebelum membuat PDF
        if (!$pengajuan) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Format Tanggal Surat
        $pengajuan->tanggalDiajukanFormatted = Carbon::parse($pengajuan->tanggalDiajukan)
            ->translatedFormat('l, d F Y');

        // Kirim data ke tampilan PDF
        $pdf = PDF::loadView('pdf.report', ['pengajuan' => $pengajuan]);

        // Unduh PDF
        return $pdf->download('laporan-pengajuan-' . $pengajuan->id . '.pdf');
    }
}
