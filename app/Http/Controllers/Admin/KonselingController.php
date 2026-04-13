<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konseling;

// Controller untuk menampilkan data konseling (list + detail)
class KonselingController extends Controller
{
    // Menampilkan daftar konseling + relasi siswa dan guru + fitur search
    public function index()
    {
        // Query awal dengan relasi
        $query = Konseling::with(['siswa','guru']);

        // Filter pencarian berdasarkan nama siswa atau status
        if (request('q')) {
            $query->whereHas('siswa', function ($q) {
                $q->where('nama', 'like', '%'.request('q').'%');
            })->orWhere('status', 'like', '%'.request('q').'%');
        }

        // Urutkan terbaru + pagination + mempertahankan query string
        $konseling = $query->latest()->paginate(5)->withQueryString();

        return view('admin.konseling.index', compact('konseling'));
    }

    // Menampilkan detail konseling beserta relasi siswa, guru, dan riwayat
    public function show($id)
    {
        $konseling = Konseling::with(['siswa','guru','riwayat'])
            ->findOrFail($id);

        return view('admin.konseling.detail', compact('konseling'));
    }
}
