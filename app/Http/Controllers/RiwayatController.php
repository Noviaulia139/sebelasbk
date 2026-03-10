<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
     // ============================
    // SISWA - RIWAYAT
    // ============================
public function indexSiswa()
{
    // 🔥 sementara ambil siswa pertama
    $siswa = \App\Models\Siswa::first();

    if (!$siswa) {
        abort(404, 'Data siswa belum ada');
    }

    $riwayat = Konseling::where('id_siswa', $siswa->id_siswa)
        ->orderByDesc('tanggal')
        ->get();

    return view('siswa.riwayat.index', compact('riwayat'));
}


    // ============================
    // GURU - RIWAYAT
    // ============================
    public function indexGuru()
    {
        $riwayat = Konseling::with('siswa')
            
            ->orderBy('id_konseling', 'desc')
            ->get();

        return view('guru.riwayat.index', compact('riwayat'));
    }

    public function showGuru($id)
    {
        $konseling = Konseling::with('siswa')->findOrFail($id);
        return view('guru.riwayat.show', compact('konseling'));
    }
}
