<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('guru')->paginate(10);
        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        $guru = Guru::all();
        return view('admin.kelas.create', compact('guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas'   => 'required|unique:kelas,id_kelas',
            'nama_kelas' => 'required',
            'jurusan'    => 'required',
            'id_guru'    => 'required'
        ]);

        Kelas::create([
            'id_kelas'   => $request->id_kelas,
            'nama_kelas' => $request->nama_kelas,
            'jurusan'    => $request->jurusan,
            'id_guru'    => $request->id_guru
        ]);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil ditambah');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $guru  = Guru::all();

        return view('admin.kelas.edit', compact('kelas', 'guru'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required',
            'jurusan'    => 'required',
            'id_guru'    => 'required'
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'jurusan'    => $request->jurusan,
            'id_guru'    => $request->id_guru
        ]);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil diupdate');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil dihapus');
    }
}