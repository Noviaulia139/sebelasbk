<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konseling;
use App\Models\Guru; 
use Illuminate\Support\Facades\Auth;

class KonselingController extends Controller
{
    // =================================================
    // SISWA - MENAMPILKAN FORM AJUKAN KONSELING
    // =================================================
    public function create()
    {
        // Ambil data siswa dari user yang login
        $siswa = Auth::user()->siswa;

        // Validasi: jika data siswa tidak ditemukan
        if (!$siswa) {
            abort(403, 'Data siswa tidak ditemukan');
        }

        // Ambil relasi kelas dan guru dari siswa
        $kelas = $siswa->kelas;
        $guru  = $kelas->guru;

        // Kirim data ke halaman form pengajuan
        return view('siswa.konseling.ajukan', compact('siswa', 'kelas', 'guru'));
    }


    // =================================================
    // SISWA - MENYIMPAN DATA KONSELING
    // =================================================
    public function store(Request $request)
    {
        // Validasi input masalah dari siswa
        $request->validate([
            'masalah' => 'required|string|min:20'
        ]);

        // Ambil data siswa, kelas, dan guru
        $siswa = Auth::user()->siswa;
        $kelas = $siswa->kelas;
        $guru  = $kelas->guru;

        // Cegah duplikasi:
        // cek apakah siswa masih punya konseling aktif (status terjadwal)
        $sudahAda = Konseling::where('id_siswa', $siswa->id_siswa)
            ->where('status', 'terjadwal')
            ->exists();

        // Jika masih ada → tidak boleh ajukan lagi
        if ($sudahAda) {
            return redirect()->back()
                ->with('error', 'Anda masih memiliki konseling yang sedang dalam proses. Tunggu hingga selesai sebelum mengajukan lagi.');
        }

        // Simpan data konseling baru ke database
        Konseling::create([
            'id_siswa' => $siswa->id_siswa,
            'id_guru'  => $guru->id_guru,
            'masalah'  => $request->masalah,
            'status'   => 'terjadwal',
            'tanggal'  => now(),
        ]);

        // Redirect ke dashboard siswa
        return redirect()->route('siswa.dashboard')
            ->with('success', 'Konseling berhasil diajukan');
    }


    // =================================================
    // GURU - MENAMPILKAN DAFTAR KONSELING MASUK
    // =================================================
    public function index()
    {
        // Ambil semua konseling dengan status terjadwal + relasi siswa
        $konseling = Konseling::with('siswa')
            ->where('status', 'terjadwal') 
            ->orderBy('tanggal', 'desc')
            ->get();

        // Kirim ke halaman guru
        return view('guru.konseling.index', compact('konseling')); 
    }


    // =================================================
    // GURU - MENAMPILKAN DETAIL KONSELING
    // =================================================
    public function show($id)
    {
        // Ambil data konseling berdasarkan ID + relasi siswa
        $konseling = Konseling::with('siswa')->findOrFail($id);

        // Tampilkan ke halaman detail
        return view('guru.konseling.show', compact('konseling')); 
    }


    // =================================================
    // GURU - MENYIMPAN SOLUSI KONSELING
    // =================================================
    public function solusi(Request $request, $id)
    {
        // Validasi input solusi dari guru
        $request->validate([
            'solusi' => 'required|min:10'
        ], [
            'solusi.required' => 'Solusi wajib diisi!',
            'solusi.min' => 'Minimal 10 karakter!'
        ]);

        // Ambil data konseling berdasarkan ID
        $konseling = Konseling::findOrFail($id);

        // Update solusi ke database
        $konseling->update([
            'solusi' => $request->solusi
        ]);

        // Kembali ke halaman sebelumnya
        return back()->with('success', 'Solusi berhasil disimpan!');
    }


    // =================================================
    // GURU - MEMBATALKAN / MENOLAK KONSELING
    // =================================================
    public function batal($id)
    {
        // Ambil data konseling
        $konseling = Konseling::findOrFail($id);

        // Update status menjadi batal + simpan id guru
        $konseling->update([
            'status' => 'batal',
            'id_guru' => Auth::user()->guru->id_guru ?? null
        ]);

        // Redirect ke halaman konseling guru
        return redirect('/guru/konseling')
            ->with('success', 'Konseling berhasil ditolak');
    }
}