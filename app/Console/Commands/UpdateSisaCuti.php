<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateSisaCuti extends Command
{
    protected $signature = 'update:sisa-cuti';
    protected $description = 'Memperbarui sisa cuti pegawai jika lebih dari 6 pada tahun sebelumnya';

    public function handle()
    {
        // Ambil tahun saat ini
        $tahunSekarang = Carbon::now()->year;

        // Ambil data cuti di tahun sebelumnya (misalnya 2024)
        $cutis = DB::table('data_cutis')
                    ->where('tahun', $tahunSekarang - 1) // Ambil cuti untuk tahun sebelumnya
                    ->where('jenis_cuti_id', 1) // Hanya jenis cuti dengan id 1
                    ->get();

        foreach ($cutis as $cuti) {
            // Jika sisa cuti lebih dari 6, ubah menjadi 6
            if ($cuti->sisa_cuti > 6) {
                DB::table('data_cutis')
                    ->where('id', $cuti->id)
                    ->update(['sisa_cuti' => 6]);
            }
        }

        $this->info("Sisa cuti tahun $tahunSekarang berhasil diperbarui!");
    }
}
