<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function download($id)
    {
        try {
            $pengajuan = Pengajuan::findOrFail($id);

            // Cek apakah dokumen ada
            if (!$pengajuan->dokumen || !Storage::disk('public')->exists($pengajuan->dokumen)) {
                return response()->json([
                    'message' => 'Dokumen tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            // Ambil file dari storage
            return Storage::disk('public')->download(
                $pengajuan->dokumen,
                // Nama file original (opsional)
                'dokumen_cuti_' . $pengajuan->id . '.' . pathinfo($pengajuan->dokumen, PATHINFO_EXTENSION)
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengunduh dokumen'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Method untuk preview dokumen (opsional)
    public function preview($id)
    {
        try {
            $pengajuan = Pengajuan::findOrFail($id);

            if (!$pengajuan->dokumen || !Storage::disk('public')->exists($pengajuan->dokumen)) {
                return response()->json([
                    'message' => 'Dokumen tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            // Stream file untuk preview
            return Storage::disk('public')->response($pengajuan->dokumen);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menampilkan dokumen'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
