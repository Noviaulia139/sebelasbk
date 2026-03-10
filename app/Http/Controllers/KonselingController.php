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
            'masalah' => 'required|string'
        ]);

        // ✅ Ambil guru pertama atau guru BK default
        $guru = Guru::first(); 

        Konseling::create([
            'id_siswa' => Auth::user()->id,
            'id_guru'  => $guru->id_guru, // ✅ Auto assign guru
            'masalah'  => $request->masalah,
            'status'   => 'terjadwal',
            'tanggal'  => now(),
        ]);

        return redirect()
            ->route('siswa.dashboard')
            ->with('success', 'Konseling berhasil diajukan');
    }

    // =================================================
    // GURU - LIST KONSELING MASUK
    // =================================================
    public function index()
    {
        $konseling = Konseling::with('siswa')
            ->where('status', 'terjadwal') // ✅ Filter hanya yang terjadwal
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('guru.konseling.index', compact('konseling')); // ✅ Variable name konsisten
    }

    // =================================================
    // GURU - DETAIL/FORM SOLUSI KONSELING
    // =================================================
    public function show($id)
    {
        $konseling = Konseling::with('siswa')->findOrFail($id);
        return view('guru.konseling.show', compact('konseling')); // ✅ Variable name konsisten
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
                'id_guru' => Auth::user()->guru->id_guru ?? null // ✅ Set guru yang tolak
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
                'id_guru' => Auth::user()->guru->id_guru ?? null // ✅ Set guru yang handle
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