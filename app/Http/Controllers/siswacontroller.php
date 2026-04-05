<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konseling;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(403,'Data siswa tidak ditemukan');
        }

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

    public function profil()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(403,'Data siswa tidak ditemukan');
        }

        return view('siswa.profil',[
            'title' => 'Profil Siswa',
            'siswa' => $siswa
        ]);
    }

    // ================= UPDATE FOTO =================
    public function updateProfil(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $siswa = Auth::user()->siswa;

        if ($request->hasFile('foto')) {

            // Hapus foto lama jika ada
            if ($siswa->foto && file_exists(public_path('foto_siswa/'.$siswa->foto))) {
                unlink(public_path('foto_siswa/'.$siswa->foto));
            }

            $file = $request->file('foto');
            $nama = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('foto_siswa'), $nama);

            $siswa->update([
                'foto' => $nama
            ]);
        }

        return back()->with('success','Foto berhasil diupdate');
    }
}