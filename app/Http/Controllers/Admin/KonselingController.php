<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konseling;
class KonselingController extends Controller
{
   public function index()
{
    $query = Konseling::with(['siswa','guru']);

    if (request('q')) {
        $query->whereHas('siswa', function ($q) {
            $q->where('nama', 'like', '%'.request('q').'%');
        })->orWhere('status', 'like', '%'.request('q').'%');
    }

    $konseling = $query->latest()->get();
    return view('admin.konseling.index', compact('konseling'));
}

public function show($id)
{
    $konseling = Konseling::with(['siswa','guru','riwayat'])
        ->findOrFail($id);

    return view('admin.konseling.detail', compact('konseling'));
}

}
