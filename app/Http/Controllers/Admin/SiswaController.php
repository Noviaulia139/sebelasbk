<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
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

    $siswa = Siswa::with('kelas')
        ->when($q, function ($query) use ($q) {
            $query->where('nama', 'like', "%$q%")
                  ->orWhere('nis', 'like', "%$q%")
                  ->orWhereHas('kelas', function ($k) use ($q) {
                      $k->where('nama_kelas', 'like', "%$q%")
                        ->orWhere('jurusan', 'like', "%$q%");
                  });
        })
        ->orderBy('id_siswa', 'desc')
        ->paginate(10); // pagination 10 data

    return view('admin.siswa.index', compact('siswa'));
}

    /**
     * FORM TAMBAH
     */
public function create()
{
    $kelas = Kelas::all();
    return view('admin.siswa.create', compact('kelas'));
}

    /**
     * SIMPAN DATA BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis',
            'nama' => 'required',
            'id_kelas' => 'required',
            'password' => 'required|min:3',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoName = null;

        if ($request->hasFile('foto')) {
            $fotoName = time().'_'.uniqid().'.'.$request->foto->extension();
            $request->foto->move(public_path('uploads/siswa'), $fotoName);
        }

        User::create([
            'name' => $request->nama,
            'username' => $request->nis, 
            'password' => Hash::make($request->password),
            'role' => 'siswa'
        ]);

        //SIMPAN SISWA
        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'password' => Hash::make($request->password), 
            'foto' => $fotoName,
        ]);

        return redirect('/admin/siswa')->with('success','Data siswa berhasil ditambahkan');
    }
    /**
     * edit data
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();

        return view('admin.siswa.edit', compact('siswa','kelas'));
    }

    /**
     * UPDATE DATA (TANPA PASSWORD)
     */
    public function update(Request $request, $id)
{
    $siswa = Siswa::findOrFail($id);

   $request->validate([
    'nis' => 'required|numeric|unique:siswa,nis,' . $id . ',id_siswa',
    'nama' => 'required',
    'id_kelas' => 'required',
    'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    'password' => 'nullable|min:6'
], [
    'nis.required' => 'NIS wajib diisi',
    'nis.numeric' => 'NIS harus berupa angka',
    'nis.unique' => 'NIS sudah digunakan',
]);

    $data = [
        'nis' => $request->nis,
        'nama' => $request->nama,
        'id_kelas' => $request->id_kelas,
    ];

    // update password jika diisi
    if($request->password){
        $data['password'] = Hash::make($request->password);
    }

    // upload foto
    if ($request->hasFile('foto')) {

        if ($siswa->foto && file_exists(public_path('uploads/siswa/' . $siswa->foto))) {
            unlink(public_path('uploads/siswa/' . $siswa->foto));
        }

        $fotoName = time().'_'.uniqid().'.'.$request->foto->extension();
        $request->foto->move(public_path('uploads/siswa'), $fotoName);

        $data['foto'] = $fotoName;
    }
    $nis_lama = $siswa->nis;

// 🔥 CARI USER BERDASARKAN NIS LAMA
$user = User::where('username', $nis_lama)->first();

if ($user) {
    $user->username = $request->nis;
 

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();
} else {
    dd('USER TIDAK DITEMUKAN', $nis_lama);
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