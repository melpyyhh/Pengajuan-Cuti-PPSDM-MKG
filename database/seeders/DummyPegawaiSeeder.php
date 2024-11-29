<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pegawaiData = [
            [
                'nip' => '1234',
                'jabatan' => 'Kepala Projek Cuti',
                'nama' => 'Adit',
                'unitKerja' => 'STIS',
                'masaKerja' => 10,
            ],
            [
                'nip' => '1224',
                'jabatan' => 'Wakil Kepala Projek Cuti',
                'nama' => 'Jekiboi',
                'unitKerja' => 'STIS',
                'masaKerja' => 10,
            ],
            [
                'nip' => '1232',
                'jabatan' => 'Kepala Developer',
                'nama' => 'Syawal',
                'unitKerja' => 'DevOps',
                'masaKerja' => 10,
            ],
        ];
        foreach ($pegawaiData as $key => $var) {
            Pegawai::create($var);
        }
    }
}
