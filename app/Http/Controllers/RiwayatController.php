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
   $siswa = Auth::user()->siswa;

    if (!$siswa) {
        abort(404, 'Data siswa belum ada');
    }

    $riwayat = Konseling::where('id_siswa', $siswa->id_siswa)
        ->orderByDesc('tanggal')
        ->paginate(5);

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

    public function showSiswa($id)
{
    $siswa = Auth::user()->siswa;

    if (!$siswa) {
        abort(403, 'Data siswa tidak ditemukan');
    }

    $konseling = Konseling::where('id_konseling', $id)
        ->where('id_siswa', $siswa->id_siswa)
        ->firstOrFail();

    return view('siswa.riwayat.detail', compact('konseling'));
}
}