<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin',
                'pegawai_id' => 1,
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('admin'),
                'atasan_id' => 1
            ],
            [
                'name' => 'Penyetuju',
                'pegawai_id' => 2,
                'email' => 'penyetuju@gmail.com',
                'role' => 'penyetuju',
                'password' => bcrypt('penyetuju'),
                'atasan_id' => 1
            ],
            [
                'name' => 'Pengaju2',
                'pegawai_id' => 4,
                'email' => 'pengaju2@gmail.com',
                'role' => 'pengaju',
                'password' => bcrypt('pengaju2'),
                'atasan_id' => 3
            ],
            [
                'name' => 'Pengaju3',
                'pegawai_id' => 5,
                'email' => 'pengaju3@gmail.com',
                'role' => 'pengaju',
                'password' => bcrypt('pengaju3'),
                'atasan_id' => 2
            ],
        ];
        foreach ($userData as $key => $var) {
            User::create($var);
        }
    }
}
