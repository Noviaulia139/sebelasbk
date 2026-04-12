<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konseling;
class KonselingController extends Controller
{
public function index()
{
    $query = Konseling::with(['siswa', 'guru']);

    if (request('q')) {
        $keyword = request('q');
        $query->where(function ($q) use ($keyword) {
            $q->whereHas('siswa', function ($sub) use ($keyword) {
                $sub->where('nama', 'like', '%' . $keyword . '%');
            })->orWhere('status', 'like', '%' . $keyword . '%');
        });
    }

    $konseling = $query->latest()->paginate(5)->withQueryString();
    return view('admin.konseling.index', compact('konseling'));
}
public function show($id)
{
    $konseling = Konseling::with(['siswa','guru','riwayat'])
        ->findOrFail($id);

    return view('admin.konseling.detail', compact('konseling'));
}

}
