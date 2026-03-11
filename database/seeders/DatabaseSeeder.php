<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\UserSeeder;
use Database\Seeders\KelasSeeder;
use Database\Seeders\SiswaSeeder;
use Database\Seeders\GuruSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
        UserSeeder::class,
        GuruSeeder::class,
        KelasSeeder::class,
        SiswaSeeder::class,
    ]);
    }
}