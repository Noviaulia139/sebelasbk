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
                'nama' => 'Budi Santoso',
                'nip' => '1987654321',
                'password' => Hash::make('123'),
                'id_kelas' => 'XI_RPL_1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Siti Rahma',
                'nip' => '1987654322',
                'password' => Hash::make('123'),
                'id_kelas' => 'XI_RPL_2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ahmad Hidayat',
                'nip' => '1987654323',
                'password' => Hash::make('123'),
                'id_kelas' => 'X_RPL_1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}