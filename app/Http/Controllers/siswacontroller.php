<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Konseling;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function dashboard()
{
    // sementara (1 siswa dulu)
    $siswa = Siswa::first();

    return view('siswa.dashboard', [
    'terjadwal' => Konseling::where('status', 'terjadwal')->count(),
    'selesai'   => Konseling::where('status', 'selesai')->count(),
    'batal'     => Konseling::where('status', 'batal')->count(),
    'lastKonseling' => Konseling::latest()->first(),
]);

}
    /* ======================
     * PROFIL
     * ====================== */
    public function profil()
    {
        // Pakai auth kalau sudah login
        $siswa = Auth::user()->siswa ?? Siswa::first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa belum ada di database');
        }

        return view('siswa.profil', [
            'title' => 'Profil Siswa',
            'siswa' => $siswa
        ]);
    }

    // UPDATE PROFIL
    public function updateProfil(Request $request)
    {
        // Validasi input
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $siswa = Siswa::find($request->id_siswa);

        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan');
        }

        // HANYA UPDATE FOTO (nama dan data lain tidak diubah)
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($siswa->foto && file_exists(public_path('foto_siswa/' . $siswa->foto))) {
                unlink(public_path('foto_siswa/' . $siswa->foto));
            }

            // Upload foto baru
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_siswa'), $namaFile);
            $siswa->foto = $namaFile;
            
            $siswa->save();
            
            return back()->with('success', 'Foto profil berhasil diperbarui!');
        }

        return back()->with('info', 'Tidak ada perubahan yang disimpan.');
    }
}