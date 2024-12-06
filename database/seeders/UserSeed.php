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
                'name' => 'Pengaju2',
                'pegawai_id' => 4,
                'email' => 'pengaju2@gmail.com',
                'role' => 'pengaju',
                'password' => bcrypt('pengaju2'),
            ],
            [
                'name' => 'Pengaju3',
                'pegawai_id' => 5,
                'email' => 'pengaju3@gmail.com',
                'role' => 'pengaju',
                'password' => bcrypt('pengaju3'),
            ],
        ];
        foreach ($userData as $key => $var) {
            User::create($var);
        }
    }
}
