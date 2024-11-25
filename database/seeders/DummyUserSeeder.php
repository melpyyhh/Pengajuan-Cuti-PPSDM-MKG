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
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'penyetuju',
                'email' => 'penyetuju@gmail.com',
                'role' => 'penyetuju',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'pengaju',
                'email' => 'pengaju@gmail.com',
                'role' => 'pengaju',
                'password' => bcrypt('12345678'),
            ]
            ];

            foreach($userData as $key => $var) {
                User::create($var);
            }
    }
}
