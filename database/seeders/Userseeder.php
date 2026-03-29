<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
       DB::table('users')->delete();
       DB::table('users')->insert([
[
    
  
    'username' => 'admin',
    'password' => Hash::make('123'),
    'role' => 'admin',
],
[
   
    
    'username' => '1987654321', // NIP
    'password' => Hash::make('123'),
    'role' => 'guru',
],
[
   
    
    'username' => '1987654322', // NIP
    'password' => Hash::make('123'),
    'role' => 'guru',
],
[
   
    
    'username' => '1987654324', // NIP
    'password' => Hash::make('123'),
    'role' => 'guru',
],
[
   
    
    'username' => '1234567890', // NIS
    'password' => Hash::make('123'),
    'role' => 'siswa',
],
[
   
    
    'username' => '1234567893', // NIS
    'password' => Hash::make('123'),
    'role' => 'siswa',
],
]);
    }
}