<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kelas')->insert([
            [
                'id_kelas' => 'X_RPL_1',
                'nama_kelas' => 'X RPL 1',
                'id_guru' => 3,
                'jurusan' => 'RPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
              [
        'id_kelas' => 'XI_RPL_1',
        'nama_kelas' => 'XI RPL 1',
        'id_guru' => 1,
        'jurusan' => 'RPL',
        'created_at' => now(),
        'updated_at' => now(),
    ],
            [
                'id_kelas' => 'XI_RPL_2',
                'nama_kelas' => 'XI RPL 2',
                'id_guru' => 2,
                'jurusan' => 'RPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelas' => 'XI_TKJ_1',
                'nama_kelas' => 'XI TKJ 1',
                'id_guru' => 4,
                'jurusan' => 'TKJ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}