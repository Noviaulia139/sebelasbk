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
}