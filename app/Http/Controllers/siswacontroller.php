<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konseling;
use Illuminate\Support\Facades\Auth;

// Controller untuk fitur siswa (dashboard & profil)
class SiswaController extends Controller
{
    // Menampilkan dashboard siswa (ringkasan data konseling)
    public function dashboard()
    {
        $siswa = Auth::user()->siswa;

        // Validasi jika data siswa tidak ditemukan
        if (!$siswa) {
            abort(403,'Data siswa tidak ditemukan');
        }

        // Kirim data statistik konseling ke dashboard
        return view('siswa.dashboard', [
            'terjadwal' => Konseling::where('id_siswa', $siswa->id_siswa)
                ->where('status','terjadwal')
                ->count(),

            'selesai' => Konseling::where('id_siswa', $siswa->id_siswa)
                ->where('status','selesai')
                ->count(),

            'batal' => Konseling::where('id_siswa', $siswa->id_siswa)
                ->where('status','batal')
                ->count(),

            'lastKonseling' => Konseling::where('id_siswa', $siswa->id_siswa)
                ->latest('tanggal')
                ->first(),
        ]);
    }

    // Menampilkan halaman profil siswa
    public function profil()
    {
        $siswa = Auth::user()->siswa;

        // Validasi jika data siswa tidak ditemukan
        if (!$siswa) {
            abort(403,'Data siswa tidak ditemukan');
        }

        return view('siswa.profil',[
            'title' => 'Profil Siswa',
            'siswa' => $siswa
        ]);
    }

    // Update foto profil siswa
    public function updateProfil(Request $request)
    {
        // Validasi file foto
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $siswa = Auth::user()->siswa;

        // Jika data siswa tidak ditemukan
        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan');
        }

        // Upload foto baru + hapus foto lama
        if ($request->hasFile('foto')) {

            if ($siswa->foto && file_exists(public_path('uploads/siswa/'.$siswa->foto))) {
                unlink(public_path('uploads/siswa/'.$siswa->foto));
            }

            $file = $request->file('foto');
            $nama = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads/siswa'), $nama);

            $siswa->update([
                'foto' => $nama
            ]);
        }

        return back()->with('success','Foto berhasil diupdate');
    }
}