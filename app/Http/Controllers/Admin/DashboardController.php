<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'title'          => 'Dashboard Admin',
            'totalSiswa'     => DB::table('siswa')->count(),
            'totalGuru'      => DB::table('guru_bk')->count(),
            'totalKonseling' => DB::table('konseling')->count(),
        ]);
    }
}
