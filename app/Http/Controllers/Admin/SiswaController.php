<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * TAMPIL DATA + SEARCH
     */
    public function index(Request $request)
    {
        $q = $request->q;

        $siswa = Siswa::when($q, function ($query) use ($q) {
                $query->where('nama', 'like', "%$q%")
                      ->orWhere('nis', 'like', "%$q%")
                      ->orWhere('kelas', 'like', "%$q%")
                      ->orWhere('jurusan', 'like', "%$q%");
            })
            ->orderBy('id_siswa', 'desc')
            ->get();

        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * FORM TAMBAH
     */
    public function create()
    {
        return view('admin.siswa.create');
    }

    /**
     * SIMPAN DATA BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'password' => 'required|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoName = null;

        if ($request->hasFile('foto')) {
            $fotoName = time() . '_' . uniqid() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/siswa'), $fotoName);
        }

        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'password' => Hash::make($request->password),
            'foto' => $fotoName,
        ]);

        return redirect('/admin/siswa')
            ->with('success', 'Data siswa berhasil ditambahkan');
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * UPDATE DATA (TANPA PASSWORD)
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $id . ',id_siswa',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
        ];

        if ($request->hasFile('foto')) {
            // hapus foto lama jika ada
            if ($siswa->foto && file_exists(public_path('uploads/siswa/' . $siswa->foto))) {
                unlink(public_path('uploads/siswa/' . $siswa->foto));
            }

            $fotoName = time() . '_' . uniqid() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/siswa'), $fotoName);
            $data['foto'] = $fotoName;
        }

        $siswa->update($data);

        return redirect('/admin/siswa')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    /**
     * HAPUS DATA
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        // hapus foto jika ada
        if ($siswa->foto && file_exists(public_path('uploads/siswa/' . $siswa->foto))) {
            unlink(public_path('uploads/siswa/' . $siswa->foto));
        }

        $siswa->delete();

        return back()->with('success', 'Data siswa berhasil dihapus');
    }
}
