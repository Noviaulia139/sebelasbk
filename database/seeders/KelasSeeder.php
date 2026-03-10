<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $jurusan = ['RPL','PM','TKJ','AKL','MPLB','DKV','MLOG'];
        $tingkat = ['X','XI','XII'];

        foreach ($tingkat as $t) {
            foreach ($jurusan as $j) {
                for ($i = 1; $i <= 4; $i++) {

                    DB::table('kelas')->insert([
                        'id_kelas' => $t . '_' . $j . '_' . $i,
                        'nama_kelas' => $t . ' ' . $j . ' ' . $i,
                        'jurusan' => $j,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                }
            }
        }
    }
}