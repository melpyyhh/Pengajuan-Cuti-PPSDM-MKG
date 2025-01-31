<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateMasaKerja extends Command
{
    protected $signature = 'update:masa-kerja';
    protected $description = 'Menambah masa kerja karyawan tiap awal tahun';

    public function handle()
    {
        DB::table('pegawais')->update(['masaKerja' => DB::raw('masaKerja + 1')]);
        $this->info('Masa kerja berhasil diperbarui!');
    }
}
