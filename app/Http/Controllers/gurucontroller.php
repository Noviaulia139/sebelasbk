<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use App\Models\RiwayatKonseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;
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
            ->paginate(3);

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
// ================= BATAL =================
    public function batal($id)
{
    $guru = Auth::user()->guru;

    $konseling = Konseling::where('id_guru', $guru->id_guru)
        ->findOrFail($id);

    $konseling->update([
        'status' => 'batal'
    ]);

    return redirect('/guru/konseling')
        ->with('success', 'Konseling berhasil ditolak');
}

    // ================= RIWAYAT =================
    public function riwayat(Request $request)
    {
        $guru = Auth::user()->guru;

        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun', now()->year);

        $query = Konseling::with('siswa', 'riwayatKonseling')
            ->where('id_guru', $guru->id_guru)
            ->latest('tanggal');

        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }
        $query->whereYear('tanggal', $tahun);

        $riwayat = $query->paginate(3)->appends($request->query());

        return view('guru.riwayat.index', compact('riwayat', 'bulan', 'tahun'));
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

        // hapus foto lama (SAMA FOLDER)
        if ($guru->foto && file_exists(public_path('uploads/guru/'.$guru->foto))) {
            unlink(public_path('uploads/guru/'.$guru->foto));
        }

        $file = $request->file('foto');
        $nama = time().'_'.$file->getClientOriginalName();

        // SIMPAN KE FOLDER YANG SAMA
        $file->move(public_path('uploads/guru'), $nama);

        $guru->update([
            'foto' => $nama
        ]);
    }

    return back()->with('success','Foto berhasil diupdate');
}
    
    public function downloadPDF(Request $request)
{
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
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
        4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September',
        10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $namaBulan = ($bulan && isset($namaBulanList[(int)$bulan]))
        ? $namaBulanList[(int)$bulan]
        : 'Semua Periode';
    $pdf = Pdf::loadView('guru.riwayat.pdf', compact('riwayat', 'guru', 'namaBulan', 'tahun'))
        ->setPaper('a4', 'landscape');

    return $pdf->download("laporan-konseling-{$namaBulan}-{$tahun}.pdf");
}
}