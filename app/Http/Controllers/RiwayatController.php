<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Controller untuk menampilkan riwayat konseling (siswa & guru)
class RiwayatController extends Controller
{
    // Menampilkan riwayat konseling milik siswa (berdasarkan NIS login)
    public function indexSiswa()
    {
        $siswa = \App\Models\Siswa::where('nis', auth()->user()->username)->first();

        // Jika data siswa tidak ditemukan
        if (!$siswa) {
            abort(404, 'Data siswa belum ada');
        }

        // Ambil riwayat konseling milik siswa + pagination
        $riwayat = Konseling::where('id_siswa', $siswa->id_siswa)
            ->orderByDesc('tanggal')
            ->paginate(2); 

        return view('siswa.riwayat.index', compact('riwayat'));
    }

    // hanya tampilkan konseling milik guru yang sedang login
    public function indexGuru()
    {
        $guru = Auth::user()->guru; // ambil data guru yang login

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan');
        }

        $riwayat = Konseling::with('siswa')
            ->where('id_guru', $guru->id_guru) // filter by guru login
            ->orderBy('id_konseling', 'desc')
            ->paginate(10);

        return view('guru.riwayat.index', compact('riwayat'));
    }

    // Menampilkan detail riwayat konseling untuk guru
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