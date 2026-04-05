<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 


class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswa')->insert([
            [
                'nama' => 'Ahmad Fauzan',
                'nis' => '1234567890',
                'id_kelas' => 'XI_RPL_1',
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Siti Aisyah',
                'nis' => '1234567891',
                'id_kelas' => 'XI_RPL_1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Rajat',
                'nis' => '1234567892',
                'id_kelas' => 'X_RPL_1',
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now()
            ],    
            [
                'nama' => 'Zach Muhammad',
                'nis' => '1234567893',
                'id_kelas' => 'XI_TKJ_1',
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
    }
}