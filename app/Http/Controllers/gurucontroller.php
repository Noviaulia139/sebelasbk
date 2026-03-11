<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use App\Models\RiwayatKonseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    // ================= DASHBOARD =================
    public function dashboard()
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan');
        }

        return view('guru.dashboard', [
            'terjadwal' => Konseling::where('id_guru', $guru->id_guru)
                ->where('status', 'terjadwal')
                ->count(),

            'selesai' => Konseling::where('id_guru', $guru->id_guru)
                ->where('status', 'selesai')
                ->count(),

            'batal' => Konseling::where('id_guru', $guru->id_guru)
                ->where('status', 'batal')
                ->count(),

            'latest' => Konseling::with('siswa')
                ->where('id_guru', $guru->id_guru)
                ->latest('id_konseling')
                ->limit(10)
                ->get(),
        ]);
    }

    // ================= LIST KONSELING =================
    public function index()
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru tidak ditemukan');
        }

        $konseling = Konseling::with('siswa')
            ->where('id_guru', $guru->id_guru)
            ->where('status', 'terjadwal')
            ->latest('tanggal')
            ->get();

        return view('guru.konseling.index', compact('konseling'));
    }

    // ================= DETAIL =================
    public function show($id)
    {
        $guru = Auth::user()->guru;

        $konseling = Konseling::with('siswa')
            ->where('id_guru', $guru->id_guru)
            ->findOrFail($id);

        return view('guru.konseling.show', compact('konseling'));
    }

    // ================= RIWAYAT DETAIL =================
    public function showRiwayat($id)
    {
        $konseling = Konseling::with('siswa')->findOrFail($id);
        $riwayat = RiwayatKonseling::where('id_konseling', $id)->first();

        return view('guru.riwayat.show', compact('konseling', 'riwayat'));
    }

    // ================= SIMPAN CATATAN =================
    public function storeCatatan(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string'
        ]);

        $guru = Auth::user()->guru;

        $riwayat = RiwayatKonseling::where('id_konseling', $id)->first();

        if ($riwayat) {

            $riwayat->update([
                'catatan' => $request->catatan,
                'tanggal' => now()
            ]);

        } else {

            RiwayatKonseling::create([
                'id_konseling' => $id,
                'id_guru' => $guru->id_guru,
                'tanggal' => now(),
                'catatan' => $request->catatan
            ]);
        }

        return redirect('/guru/riwayat')
            ->with('success', 'Catatan berhasil disimpan');
    }

    // ================= PROSES KONSELING =================
    public function solusi(Request $request, $id)
    {
        $guru = Auth::user()->guru;

        $konseling = Konseling::where('id_guru', $guru->id_guru)
            ->findOrFail($id);

        if ($request->has('tolak')) {

            $konseling->update([
                'status' => 'batal'
            ]);

            return redirect('/guru/konseling')
                ->with('success', 'Konseling ditolak');
        }

        $request->validate([
            'solusi' => 'required|string'
        ]);

        $konseling->update([
            'solusi' => $request->solusi,
            'status' => 'selesai'
        ]);

        return redirect('/guru/konseling')
            ->with('success', 'Solusi berhasil dikirim');
    }

    // ================= RIWAYAT =================
    public function riwayat()
    {
        $guru = Auth::user()->guru;

        $riwayat = Konseling::with('siswa','riwayatKonseling')
            ->where('id_guru', $guru->id_guru)
            ->latest('tanggal')
            ->get();

        return view('guru.riwayat.index', compact('riwayat'));
    }

    // ================= PROFIL =================
    public function profil()
    {
        $guru = Auth::user()->guru;

        return view('guru.profile', [
            'title' => 'Profil Guru',
            'guru' => $guru
        ]);
    }

    // ================= UPDATE FOTO =================
    public function updateProfil(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $guru = Auth::user()->guru;

        if ($request->hasFile('foto')) {

            if ($guru->foto && file_exists(public_path('foto_guru/'.$guru->foto))) {
                unlink(public_path('foto_guru/'.$guru->foto));
            }

            $file = $request->file('foto');
            $nama = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('foto_guru'), $nama);

            $guru->update([
                'foto' => $nama
            ]);
        }

        return back()->with('success','Foto berhasil diupdate');
    }
}