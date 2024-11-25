<?php

namespace Database\Seeders;

use App\Models\JenisCuti;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisCuti::create(['jenis_cuti' => 'Cuti Tahunan']);
        JenisCuti::create(['jenis_cuti' => 'Cuti Sakit']);
        JenisCuti::create(['jenis_cuti' => 'Cuti Bersalin']);
        JenisCuti::create(['jenis_cuti' => 'Cuti Besar']);
        JenisCuti::create(['jenis_cuti' => 'Cuti Alasan Penting']);
        JenisCuti::create(['jenis_cuti' => 'Cuti di Luar Tanggungan Negara (CLTN)']);
    }
}
