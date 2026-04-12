<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class KelasController extends Controller
{
   public function index(Request $request)
{
    $kelas = Kelas::with('guru')
        ->when($request->q, function($query, $q) {
            $query->where('nama_kelas', 'like', "%$q%")
                  ->orWhere('jurusan', 'like', "%$q%");
        })
        ->paginate(10);

    return view('admin.kelas.index', compact('kelas'));
}
public function create()
{
    $guru = Guru::all(); // penting buat dropdown

    return view('admin.kelas.create', compact('guru'));
}

public function store(Request $request)
{
    // VALIDASI (JANGAN DI DALAM TRY)
    $request->validate([
        'nama_kelas' => 'required',
        'jurusan'    => 'required',
        'id_guru'    => 'required'
    ]);

    DB::beginTransaction();

    try {
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
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $guru  = Guru::all();

        return view('admin.kelas.edit', compact('kelas', 'guru'));
    }

    public function update(Request $request, $id)
{
    // ✅ VALIDASI DI LUAR
   
  $request->validate([
    'nama_kelas' => 'required|unique:kelas,nama_kelas,' . $id . ',id_kelas',
    'jurusan'    => 'required',
    'id_guru'    => 'required'
]);
    DB::beginTransaction();

    try {
        $kelas = Kelas::findOrFail($id);

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
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil dihapus');
    }
}