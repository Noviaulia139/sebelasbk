<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use App\Models\Guru;
use App\Models\RiwayatKonseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    // ================= DASHBOARD =================
    public function dashboard()
    {
        return view('guru.dashboard', [
            'terjadwal' => Konseling::where('status', 'terjadwal')->count(), 
            'selesai'   => Konseling::where('status', 'selesai')->count(),
            'batal'     => Konseling::where('status', 'batal')->count(), 
            'latest'    => Konseling::with('siswa')
                            ->orderByDesc('id_konseling')
                            ->limit(10) 
                            ->get(),
        ]);
    }

    // ================= KONSELING MASUK =================
    public function index()
    {
        $konseling = Konseling::with('siswa')
            ->where('status', 'terjadwal') // ✅ Hanya yang terjadwal
            ->orderByDesc('id_konseling')
            ->get();

        return view('guru.konseling.index', compact('konseling'));
    }

    // ================= DETAIL/FORM SOLUSI =================
    public function show($id)
    {
        $konseling = Konseling::with('siswa')->findOrFail($id);
        return view('guru.konseling.show', compact('konseling'));
    }

        
    // Method show untuk riwayat (read only + form catatan)
    public function showRiwayat($id)
    {
        $konseling = Konseling::with('siswa')->findOrFail($id);
        
        // Ambil catatan riwayat jika ada
        $riwayat = RiwayatKonseling::where('id_konseling', $id)->first();
        
        return view('guru.riwayat.show', compact('konseling', 'riwayat'));
    }

    // Method untuk simpan/update catatan
    public function storeCatatan(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string'
        ]);

        $konseling = Konseling::findOrFail($id);
        $guru = Auth::user()->guru;
        // Cek apakah sudah ada catatan
        $riwayat = RiwayatKonseling::where('id_konseling', $id)->first();

        if ($riwayat) {
            // Update catatan yang sudah ada
            $riwayat->update([
                'catatan' => $request->catatan,
                'tanggal' => now()
            ]);                                                                                                                                                                                                   
            $message = 'Catatan berhasil diperbarui';
        } else {
            // Buat catatan baru
            RiwayatKonseling::create([
                'id_konseling' => $id,
                'tanggal' => now(),
                'catatan' => $request->catatan,
                'id_guru' => $guru->id_guru 
            ]);
            $message = 'Catatan berhasil ditambahkan';
        }

        return redirect('/guru/riwayat')
            ->with('success', $message);
    }
    // ================= PROSES KONSELING (SIMPAN SOLUSI ATAU TOLAK) =================
    public function solusi(Request $request, $id)
    {
        $konseling = Konseling::findOrFail($id);

        // CEK APAKAH INI TOLAK ATAU SIMPAN SOLUSI
        if ($request->has('tolak')) {
            $konseling->update([
                'status' => 'batal',
                'id_guru' => Auth::user()->guru->id_guru ?? null // ✅ Set guru yang tolak
            ]);
            
            return redirect('/guru/konseling')
                ->with('success', 'Konseling berhasil ditolak');
        } else {
            $request->validate([
                'solusi' => 'required'
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

    // ================= RIWAYAT (STATUS: SELESAI & BATAL) =================
    public function riwayat()
    {
        // ✅ Ambil data langsung dari tabel konseling (yang sudah selesai & batal)
        $riwayat = Konseling::with('siswa', 'riwayatKonseling')
        
            ->whereIn('status', ['terjadwal', 'selesai', 'batal']) 
            ->orderByDesc('tanggal')
            ->get();

        return view('guru.riwayat.index', compact('riwayat'));
        
        // ✅ ATAU jika mau pakai tabel RiwayatKonseling:
        // $riwayat = RiwayatKonseling::with('konseling.siswa')
        //     ->orderByDesc('tanggal')
        //     ->get();
        // return view('guru.riwayat.index', compact('riwayat'));
    }

    /* ======================
     * PROFIL
     * ====================== */
    public function profil()
    {
        $guru = Auth::user()->guru ?? Guru::first();

        if (!$guru) {
            return redirect()->back()
                ->with('error', 'Data guru belum ada di database');
        }

        return view('guru.profile', [
            'title' => 'Profil Guru',
            'guru'  => $guru
        ]);
    }

    // ================= UPDATE PROFIL =================
    public function updateProfil(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $guru = Guru::find($request->id_guru);

        if (!$guru) {
            return back()->with('error', 'Data guru tidak ditemukan');
        }

        if ($request->hasFile('foto')) {
            if ($guru->foto && file_exists(public_path('foto_guru/' . $guru->foto))) {
                unlink(public_path('foto_guru/' . $guru->foto));
            }

            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_guru'), $namaFile);

            $guru->foto = $namaFile;
            $guru->save();

            return back()->with('success', 'Foto profil berhasil diperbarui!');
        }

        return back()->with('info', 'Tidak ada perubahan yang disimpan.');
    }
}