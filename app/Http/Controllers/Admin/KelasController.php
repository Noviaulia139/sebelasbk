<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Controller untuk mengelola data kelas (CRUD + relasi guru)
class KelasController extends Controller
{
    // Menampilkan data kelas + relasi guru + fitur search + pagination
    public function index(Request $request)
    {
        $kelas = Kelas::with('guru')
            ->when($request->q, function ($query, $q) {
                $query->where('nama_kelas', 'like', "%$q%")
                      ->orWhere('jurusan', 'like', "%$q%");
            })
            ->paginate(10);

        return view('admin.kelas.index', compact('kelas'));
    }

    // Menampilkan form tambah kelas + data guru untuk dropdown
    public function create()
    {
        $guru = Guru::all();

        return view('admin.kelas.create', compact('guru'));
    }

    // Menyimpan data kelas ke database
    public function store(Request $request)
    {
        // Validasi input (dilakukan sebelum transaksi)
        $request->validate([
            'nama_kelas' => 'required',
            'jurusan'    => 'required',
            'id_guru'    => 'required'
        ]);

        DB::beginTransaction();

        try {
            // Simpan data kelas
            Kelas::create([
                'nama_kelas' => $request->nama_kelas,
                'jurusan'    => $request->jurusan,
                'id_guru'    => $request->id_guru
            ]);

            DB::commit();

            return redirect()->route('admin.kelas.index')
                ->with('success', 'Kelas berhasil ditambah');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat tambah kelas!');
        }
    }

    // Menampilkan form edit kelas
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $guru  = Guru::all();

        return view('admin.kelas.edit', compact('kelas', 'guru'));
    }

    // Mengupdate data kelas yang dipilih
    public function update(Request $request, $id)
    {
        // Validasi input (dilakukan sebelum transaksi)
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas,' . $id . ',id_kelas',
            'jurusan'    => 'required',
            'id_guru'    => 'required'
        ]);

        DB::beginTransaction();

        try {
            $kelas = Kelas::findOrFail($id);

            // Cek apakah guru berubah
            $guruBerubah = $kelas->id_guru != $request->id_guru;

            // Update data kelas
            $kelas->update([
                'nama_kelas' => $request->nama_kelas,
                'jurusan'    => $request->jurusan,
                'id_guru'    => $request->id_guru
            ]);

            DB::commit();

            return redirect()->route('admin.kelas.index')
                ->with('success', 'Kelas berhasil diupdate');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal update kelas!');
        }
    }

    // Menghapus data kelas
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil dihapus');
    }
}