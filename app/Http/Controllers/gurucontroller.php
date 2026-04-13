<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use App\Models\RiwayatKonseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

// Controller untuk guru (dashboard, konseling, riwayat, profil, dll)
class GuruController extends Controller
{
    // Menampilkan dashboard guru (ringkasan data konseling)
    public function dashboard()
    {
        try {
            $guru = Auth::user()->guru;

            if (!$guru) {
                abort(403, 'Data guru tidak ditemukan');
            }

            return view('guru.dashboard', [
                'terjadwal' => Konseling::where('id_guru', $guru->id_guru)->where('status', 'terjadwal')->count(),
                'selesai' => Konseling::where('id_guru', $guru->id_guru)->where('status', 'selesai')->count(),
                'batal' => Konseling::where('id_guru', $guru->id_guru)->where('status', 'batal')->count(),
                'latest' => Konseling::with('siswa')
                    ->where('id_guru', $guru->id_guru)
                    ->latest('id_konseling')
                    ->limit(10)
                    ->get(),
            ]);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal load dashboard: ' . $e->getMessage());
        }
    }

    // Menampilkan list konseling dengan status terjadwal
    public function index()
    {
        try {
            $guru = Auth::user()->guru;

            if (!$guru) {
                abort(403, 'Data guru tidak ditemukan');
            }

            $konseling = Konseling::with('siswa')
                ->where('id_guru', $guru->id_guru)
                ->where('status', 'terjadwal')
                ->latest('tanggal')
                ->paginate(3);

            return view('guru.konseling.index', compact('konseling'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal load data: ' . $e->getMessage());
        }
    }

    // Menampilkan detail satu data konseling
    public function show($id)
    {
        try {
            $guru = Auth::user()->guru;

            $konseling = Konseling::with('siswa')
                ->where('id_guru', $guru->id_guru)
                ->findOrFail($id);

            return view('guru.konseling.show', compact('konseling'));

        } catch (\Exception $e) {
            return back()->with('error', 'Data tidak ditemukan!');
        }
    }

    // Menampilkan detail riwayat konseling
    public function showRiwayat($id)
    {
        try {
            $konseling = Konseling::with('siswa')->findOrFail($id);
            $riwayat = RiwayatKonseling::where('id_konseling', $id)->first();

            return view('guru.riwayat.show', compact('konseling', 'riwayat'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal load riwayat!');
        }
    }

    // Menyimpan atau update catatan konseling
    public function storeCatatan(Request $request, $id)
{
    try {
        $request->validate([
            'catatan' => 'required|string'
        ]);

        $guru = Auth::user()->guru;

        // 🔥 AMBIL DATA KONSELING
        $konseling = Konseling::findOrFail($id);

        // 🚨 CEK PEMILIK ASLI
        if ($konseling->id_guru != $guru->id_guru) {
            return back()->with('error', 'Anda tidak bisa menambah catatan pada konseling ini! (Hanya bisa melihat)');
        }

        $riwayat = RiwayatKonseling::where('id_konseling', $id)->first();

        // Jika sudah ada riwayat → update, jika belum → create
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

        return redirect('/guru/riwayat')->with('success', 'Catatan berhasil disimpan');

            } catch (\Exception $e) {
                return back()->with('error', 'Gagal simpan catatan: ' . $e->getMessage());
            }
        }
        public function solusi(Request $request, $id)
        {
            try {
        $guru = Auth::user()->guru;

        $konseling = Konseling::findOrFail($id);

        // 🚨 CEK PEMILIK ASLI (INI KUNCI)
        if ($konseling->id_guru != $guru->id_guru) {
            return back()->with('error', 'Konseling ini bukan milik Anda! Anda hanya bisa melihat.');
        }

        $request->validate([
            'solusi' => 'required|string'
        ]);

        // Jika tombol tolak ditekan
        if ($request->has('tolak')) {
            $konseling->update([
                'status' => 'batal'
            ]);

            return redirect('/guru/konseling')
                ->with('success', 'Konseling ditolak');
        }

        // Validasi dan simpan solusi
        $request->validate([
            'solusi' => 'required|string'
        ]);

        $konseling->update([
            'solusi' => $request->solusi,
            'status' => 'selesai'
        ]);

        return redirect('/guru/konseling')
            ->with('success', 'Solusi berhasil dikirim');

    } catch (\Illuminate\Validation\ValidationException $e) {
        throw $e;

    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
    public function batal($id)
{
    try {
        $guru = Auth::user()->guru;

        $konseling = Konseling::findOrFail($id);

        // 🚨 CEK PEMILIK ASLI
        if ($konseling->id_guru != $guru->id_guru) {
            return back()->with('error', 'Anda tidak bisa membatalkan konseling ini! (Hanya bisa melihat)');
        }

        $konseling->update([
            'status' => 'batal'
        ]);

        return redirect('/guru/konseling')->with('success', 'Konseling berhasil ditolak');

    } catch (\Exception $e) {
        return back()->with('error', 'Gagal membatalkan: ' . $e->getMessage());
    }
}

    public function riwayat(Request $request)
    {
        try {
            $guru = Auth::user()->guru;

            $bulan = $request->get('bulan');
            $tahun = $request->get('tahun', now()->year);

            $query = Konseling::with('siswa', 'riwayatKonseling')
                ->whereHas('siswa.kelas', function($q) use ($guru) {
                    $q->where('id_guru', $guru->id_guru);
                })
                ->latest('tanggal');

            if ($bulan) {
                $query->whereMonth('tanggal', $bulan);
            }

            $query->whereYear('tanggal', $tahun);

            $riwayat = $query->paginate(3)->appends($request->query());

            return view('guru.riwayat.index', compact('riwayat', 'bulan', 'tahun'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal load riwayat: ' . $e->getMessage());
        }
    }

    // Menampilkan profil guru
    public function profil()
    {
        try {
            $guru = Auth::user()->guru;

            return view('guru.profile', [
                'title' => 'Profil Guru',
                'guru' => $guru
            ]);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal load profil');
        }
    }

    public function updateProfil(Request $request)
    {
        try {
            $request->validate([
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $guru = Auth::user()->guru;

            if ($request->hasFile('foto')) {
                if ($guru->foto && file_exists(public_path('uploads/guru/'.$guru->foto))) {
                    unlink(public_path('uploads/guru/'.$guru->foto));
                }

                $file = $request->file('foto');
                $nama = time().'_'.$file->getClientOriginalName();

                $file->move(public_path('uploads/guru'), $nama);

                $guru->update(['foto' => $nama]);
            }

            return back()->with('success','Foto berhasil diupdate');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update foto: ' . $e->getMessage());
        }
    }

    public function downloadPDF(Request $request)
    {
        try {
            $guru = Auth::user()->guru;

            if (!$guru) abort(403);

            $bulan = $request->get('bulan');
            $tahun = $request->get('tahun', now()->year);

            $query = Konseling::with(['siswa.kelas', 'riwayatKonseling'])
                ->where('id_guru', $guru->id_guru)
                ->latest('tanggal');

            if ($bulan) {
                $query->whereMonth('tanggal', $bulan);
            }

            $query->whereYear('tanggal', $tahun);

            $riwayat = $query->get();

            $namaBulanList = [
                1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
            ];

            $namaBulan = ($bulan && isset($namaBulanList[(int)$bulan]))
                ? $namaBulanList[(int)$bulan]
                : 'Semua Periode';

            $pdf = Pdf::loadView('guru.riwayat.pdf', compact('riwayat', 'guru', 'namaBulan', 'tahun'))
                ->setPaper('a4', 'landscape');

            return $pdf->download("laporan-konseling-{$namaBulan}-{$tahun}.pdf");

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal download PDF: ' . $e->getMessage());
        }
    }

}