<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
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
            ],
            [
                'name' => 'Penyetuju',
                'pegawai_id' => 2,
                'email' => 'penyetuju@gmail.com',
                'role' => 'penyetuju',
                'password' => bcrypt('penyetuju'),
            ],
            [
                'name' => 'Pengaju',
                'pegawai_id' => 3,
                'email' => 'pengaju@gmail.com',
                'role' => 'dual_role',
                'password' => bcrypt('pengaju'),
                'atasan_id' => 2
            ]
        ];

        foreach ($userData as $key => $var) {
            User::create($var);
        }
    }
}
