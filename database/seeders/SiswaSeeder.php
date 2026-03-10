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
                'kelas' => 'XI RPL 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Siti Aisyah',
                'nis' => '1234567891',
                'kelas' => 'XI RPL 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Budi Santoso',
                'nis' => '1234567892',
                'kelas' => 'XI RPL 2',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}