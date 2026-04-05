<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konseling;
use App\Models\Guru; 
use Illuminate\Support\Facades\Auth;

class KonselingController extends Controller
{
    // =================================================
    // SISWA - FORM AJUKAN KONSELING
    // =================================================
    public function create()
    {
        return view('siswa.konseling.ajukan');
    }

    // =================================================
    // SISWA - SIMPAN KONSELING
    // =================================================
    public function store(Request $request)
    {
        $request->validate([
            'masalah' => 'required|string|min:20'
        ]);

        $siswa = Auth::user()->siswa;
        $kelas = $siswa->kelas;
        $guru  = $kelas->guru;

        // Cegah duplikat: cek apakah siswa ini sudah punya konseling
        // dengan status 'terjadwal' yang belum selesai
        $sudahAda = Konseling::where('id_siswa', $siswa->id_siswa)
            ->where('status', 'terjadwal')
            ->exists();

        if ($sudahAda) {
            return redirect()->back()
                ->with('error', 'Anda masih memiliki konseling yang sedang dalam proses. Tunggu hingga selesai sebelum mengajukan lagi.');
        }

        Konseling::create([
            'id_siswa' => $siswa->id_siswa,
            'id_guru'  => $guru->id_guru,
            'masalah'  => $request->masalah,
            'status'   => 'terjadwal',
            'tanggal'  => now(),
        ]);

        return redirect()->route('siswa.dashboard')
            ->with('success', 'Konseling berhasil diajukan');
    }
    // =================================================
    // GURU - LIST KONSELING MASUK
    // =================================================
    public function index()
    {
        $konseling = Konseling::with('siswa')
            ->where('status', 'terjadwal') 
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('guru.konseling.index', compact('konseling')); 
    }

    // =================================================
    // GURU - DETAIL/FORM SOLUSI KONSELING
    // =================================================
    public function show($id)
    {
        $konseling = Konseling::with('siswa')->findOrFail($id);
        return view('guru.konseling.show', compact('konseling')); 
    }

    // =================================================
    // GURU - PROSES KONSELING (SIMPAN SOLUSI ATAU TOLAK)
    // =================================================
    public function solusi(Request $request, $id)
    {
        $konseling = Konseling::findOrFail($id);

       
        if ($request->has('tolak')) {
            // TOLAK - ubah status jadi batal
            $konseling->update([
                'status' => 'batal',
                'id_guru' => Auth::user()->guru->id_guru ?? null // Set guru yang tolak
            ]);
            
            return redirect('/guru/konseling')
                ->with('success', 'Konseling berhasil ditolak');
        } else {
            // SIMPAN SOLUSI - validasi dan simpan
            $request->validate([
                'solusi' => 'required|string'
            ]);

            $konseling->update([
                'solusi' => $request->solusi,
                'status' => 'selesai', 
                'id_guru' => Auth::user()->guru->id_guru ?? null //  Set guru yang handle
            ]);

            return redirect('/guru/konseling')
                ->with('success', 'Solusi berhasil dikirim');
        }
    }

    public function batal($id)
    {
        $konseling = Konseling::findOrFail($id);

        $konseling->update([
            'status' => 'batal',
            'id_guru' => Auth::user()->guru->id_guru ?? null
        ]);

        return redirect('/guru/konseling')
            ->with('success', 'Konseling berhasil ditolak');
    }
}