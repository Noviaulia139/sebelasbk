<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('guru_bk')->insert([
            [
                'nama' => 'Dra. Wening Wigati, SE, M.Si',
                'nip' => '1987654321',
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Siti Rahma',
                'nip' => '1987654322',
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ahmad Hidayat',
                'nip' => '1987654323',
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Agung Setya',
                'nip' => '1987654324',
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}