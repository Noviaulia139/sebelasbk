<?php

// Menentukan namespace controller ini berada di folder Admin
namespace App\Http\Controllers\Admin;

// Mengimpor Controller utama Laravel
use App\Http\Controllers\Controller;

// Mengimpor DB facade untuk akses database secara langsung
use Illuminate\Support\Facades\DB;

// Mendefinisikan class DashboardController yang mewarisi Controller
class DashboardController extends Controller
{
    // Method index untuk menampilkan halaman dashboard admin
    public function index()
    {
        // Mengembalikan view 'admin.dashboard' dengan data yang dikirim ke view
        return view('admin.dashboard', [

            // Judul halaman dashboard
            'title'          => 'Dashboard Admin',

            // Menghitung total data siswa dari tabel 'siswa'
            'totalSiswa'     => DB::table('siswa')->count(),

            // Menghitung total data guru BK dari tabel 'guru_bk'
            'totalGuru'      => DB::table('guru_bk')->count(),

            // Menghitung total data konseling dari tabel 'konseling'
            'totalKonseling' => DB::table('konseling')->count(),
        ]);
    }
}