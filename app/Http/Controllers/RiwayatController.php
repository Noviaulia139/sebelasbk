<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    // ============================
    // SISWA - MENAMPILKAN RIWAYAT KONSELING
    // ============================
    public function indexSiswa()
    {
        // Ambil data siswa dari user yang login
        $siswa = Auth::user()->siswa;

        // Jika data siswa tidak ditemukan → tampilkan error
        if (!$siswa) {
            abort(404, 'Data siswa belum ada');
        }

        // Ambil data riwayat konseling berdasarkan id siswa
        // Diurutkan dari yang terbaru dan menggunakan pagination
        $riwayat = Konseling::where('id_siswa', $siswa->id_siswa)
            ->orderByDesc('tanggal')
            ->paginate(5);

        // Kirim data ke view siswa
        return view('siswa.riwayat.index', compact('riwayat'));
    }


    // ============================
    // GURU - MENAMPILKAN SEMUA RIWAYAT KONSELING
    // ============================
    public function indexGuru()
    {
        // Ambil semua data konseling beserta relasi siswa (Eager Loading)
        $riwayat = Konseling::with('siswa')
            ->orderBy('id_konseling', 'desc')
            ->get();

        // Kirim data ke view guru
        return view('guru.riwayat.index', compact('riwayat'));
    }


    // ============================
    // GURU - DETAIL KONSELING
    // ============================
    public function showGuru($id)
    {
        // Ambil data konseling berdasarkan ID + relasi siswa
        // Jika tidak ditemukan → otomatis error (404)
        $konseling = Konseling::with('siswa')->findOrFail($id);

        // Tampilkan ke halaman detail guru
        return view('guru.riwayat.show', compact('konseling'));
    }


    // ============================
    // SISWA - DETAIL RIWAYAT KONSELING
    // ============================
    public function showSiswa($id)
    {
        // Ambil data siswa dari user login
        $siswa = Auth::user()->siswa;

        // Validasi: jika siswa tidak ada
        if (!$siswa) {
            abort(403, 'Data siswa tidak ditemukan');
        }

        // Ambil data konseling sesuai ID dan milik siswa tersebut
        // Untuk keamanan agar siswa tidak bisa akses data orang lain
        $konseling = Konseling::where('id_konseling', $id)
            ->where('id_siswa', $siswa->id_siswa)
            ->firstOrFail();

        // Kirim ke view detail siswa
        return view('siswa.riwayat.detail', compact('konseling'));
    }
}