<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswa')->insert([
            [
                'nama' => 'Ahmad Fauzan',
                'nis' => '1234567890',
                'id_kelas' => 'XI_RPL_1',
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
                'nama' => 'Budi Santoso',
                'nis' => '1234567892',
                'id_kelas' => 'X_RPL_1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}