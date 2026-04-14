<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use App\Models\RiwayatKonseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class GuruController extends Controller
{
    // Menampilkan halaman dashboard guru
    public function dashboard()
    {
        try {
            // Ambil data guru dari user login
            $guru = Auth::user()->guru;

            // Jika tidak ada data guru → tampilkan error
            if (!$guru) {
                abort(403, 'Data guru tidak ditemukan');
            }

            // Kirim data ke dashboard
            return view('guru.dashboard', [

                // Hitung jumlah konseling terjadwal
                'terjadwal' => Konseling::where('id_guru', $guru->id_guru)
                    ->where('status', 'terjadwal')
                    ->count(),

                // Hitung jumlah konseling selesai
                'selesai' => Konseling::where('id_guru', $guru->id_guru)
                    ->where('status', 'selesai')
                    ->count(),

                // Hitung jumlah konseling batal
                'batal' => Konseling::where('id_guru', $guru->id_guru)
                    ->where('status', 'batal')
                    ->count(),

                // Ambil 10 data terbaru
                'latest' => Konseling::with('siswa')
                    ->where('id_guru', $guru->id_guru)
                    ->latest('id_konseling')
                    ->limit(10)
                    ->get(),
            ]);

        } catch (\Exception $e) {
            // Jika error → kembali ke halaman sebelumnya
            return back()->with('error', 'Gagal load dashboard');
        }
    }
    // Menampilkan daftar konseling yang masuk ke guru
    public function index()
    {
        try {
            // Ambil data guru login
            $guru = Auth::user()->guru;

            // Jika tidak ada → error
            if (!$guru) {
                abort(403, 'Data guru tidak ditemukan');
            }

            // Ambil konseling status terjadwal
            $konseling = Konseling::with('siswa')
                ->where('id_guru', $guru->id_guru)
                ->where('status', 'terjadwal')
                ->latest('tanggal')
                ->paginate(3);

            // Kirim ke view
            return view('guru.konseling.index', compact('konseling'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal load data');
        }
    }

    // Menampilkan detail konseling berdasarkan ID
    public function show($id)
    {
        try {
            // Ambil data guru login
            $guru = Auth::user()->guru;

            // Ambil konseling milik guru tersebut
            $konseling = Konseling::with('siswa')
                ->where('id_guru', $guru->id_guru)
                ->findOrFail($id);

            // Tampilkan ke view
            return view('guru.konseling.show', compact('konseling'));

        } catch (\Exception $e) {
            return back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function showRiwayat($id)
    {
        try {
            // Ambil data konseling
            $konseling = Konseling::with('siswa')->findOrFail($id);

            // Ambil data riwayat (catatan guru)
            $riwayat = RiwayatKonseling::where('id_konseling', $id)->first();

            // Kirim ke view
            return view('guru.riwayat.show', compact('konseling', 'riwayat'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal load riwayat');
        }
    }

    public function storeCatatan(Request $request, $id)
    {
        try {
            // Validasi input catatan
            $request->validate([
                'catatan' => 'required|string'
            ]);

            // Ambil data guru login
            $guru = Auth::user()->guru;

            // Ambil data konseling
            $konseling = Konseling::findOrFail($id);

            // Jika bukan milik guru → tidak boleh edit
            if ($konseling->id_guru != $guru->id_guru) {
                return back()->with('error', 'Tidak memiliki akses');
            }

            // Cek apakah sudah ada catatan sebelumnya
            $riwayat = RiwayatKonseling::where('id_konseling', $id)->first();

            // Jika sudah ada → update
            if ($riwayat) {
                $riwayat->update([
                    'catatan' => $request->catatan,
                    'tanggal' => now()
                ]);
            } else {
                // Jika belum → buat baru
                RiwayatKonseling::create([
                    'id_konseling' => $id,
                    'id_guru' => $guru->id_guru,
                    'tanggal' => now(),
                    'catatan' => $request->catatan
                ]);
            }

            // Redirect ke halaman riwayat
            return redirect('/guru/riwayat')->with('success', 'Catatan berhasil disimpan');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal simpan catatan');
        }
    }

    // Menyimpan solusi dari guru atau menolak konseling
    public function solusi(Request $request, $id)
    {
        try {
            // Ambil data guru login
            $guru = Auth::user()->guru;

            // Ambil data konseling
            $konseling = Konseling::findOrFail($id);

            // Jika bukan milik guru → tidak boleh proses
            if ($konseling->id_guru != $guru->id_guru) {
                return back()->with('error', 'Bukan milik Anda');
            }

            // Validasi input solusi
            $request->validate([
                'solusi' => 'required|string'
            ]);

            // Jika tombol tolak ditekan
            if ($request->has('tolak')) {
                $konseling->update([
                    'status' => 'batal'
                ]);

                return redirect('/guru/konseling')->with('success', 'Konseling ditolak');
            }

            // Jika isi solusi → update data
            $konseling->update([
                'solusi' => $request->solusi,
                'status' => 'selesai'
            ]);

            return redirect('/guru/konseling')->with('success', 'Solusi berhasil dikirim');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan');
        }
    }

    public function batal($id)
    {
        try {
            // Ambil data guru login
            $guru = Auth::user()->guru;

            // Ambil data konseling
            $konseling = Konseling::findOrFail($id);

            // Validasi kepemilikan
            if ($konseling->id_guru != $guru->id_guru) {
                return back()->with('error', 'Tidak memiliki akses');
            }

            // Update status menjadi batal
            $konseling->update([
                'status' => 'batal'
            ]);

            return redirect('/guru/konseling')->with('success', 'Konseling berhasil ditolak');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membatalkan');
        }
    }

    public function riwayat(Request $request)
    {
        try {
            // Ambil data guru login
            $guru = Auth::user()->guru;

            // Ambil filter bulan & tahun
            $bulan = $request->get('bulan');
            $tahun = $request->get('tahun', now()->year);

            // Query data riwayat konseling
            $query = Konseling::with('siswa', 'riwayatKonseling')
                ->whereHas('siswa.kelas', function($q) use ($guru) {
                    $q->where('id_guru', $guru->id_guru);
                })
                ->latest('tanggal');

            // Jika ada filter bulan
            if ($bulan) {
                $query->whereMonth('tanggal', $bulan);
            }

            // Filter tahun
            $query->whereYear('tanggal', $tahun);

            // Ambil data dengan pagination
            $riwayat = $query->paginate(3)->appends($request->query());

            return view('guru.riwayat.index', compact('riwayat', 'bulan', 'tahun'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal load riwayat');
        }
    }

    public function profil()
    {
        try {
            // Ambil data guru login
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
            // Validasi file foto
            $request->validate([
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            // Ambil data guru
            $guru = Auth::user()->guru;

            // Jika upload foto baru
            if ($request->hasFile('foto')) {

                // Hapus foto lama jika ada
                if ($guru->foto && file_exists(public_path('uploads/guru/'.$guru->foto))) {
                    unlink(public_path('uploads/guru/'.$guru->foto));
                }

                // Simpan foto baru
                $file = $request->file('foto');
                $nama = time().'_'.$file->getClientOriginalName();

                $file->move(public_path('uploads/guru'), $nama);

                // Update database
                $guru->update(['foto' => $nama]);
            }

            return back()->with('success','Foto berhasil diupdate');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update foto');
        }
    }

    // Mengunduh laporan konseling dalam bentuk PDF
    public function downloadPDF(Request $request)
    {
        try {
            // Ambil data guru login
            $guru = Auth::user()->guru;

            if (!$guru) abort(403);

            // Ambil filter bulan & tahun
            $bulan = $request->get('bulan');
            $tahun = $request->get('tahun', now()->year);

            // Query data laporan
            $query = Konseling::with(['siswa.kelas', 'riwayatKonseling'])
                ->where('id_guru', $guru->id_guru)
                ->latest('tanggal');

            if ($bulan) {
                $query->whereMonth('tanggal', $bulan);
            }

            $query->whereYear('tanggal', $tahun);

            // Ambil semua data
            $riwayat = $query->get();

            // Mapping nama bulan
            $namaBulanList = [
                1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
            ];

            // Tentukan nama bulan
            $namaBulan = ($bulan && isset($namaBulanList[(int)$bulan]))
                ? $namaBulanList[(int)$bulan]
                : 'Semua Periode';

            // Generate PDF
            $pdf = Pdf::loadView('guru.riwayat.pdf', compact('riwayat', 'guru', 'namaBulan', 'tahun'))
                ->setPaper('a4', 'landscape');

            return $pdf->download("laporan-konseling-{$namaBulan}-{$tahun}.pdf");

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal download PDF');
        }
    }
}