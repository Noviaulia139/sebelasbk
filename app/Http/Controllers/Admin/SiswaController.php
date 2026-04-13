<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Controller untuk mengelola data siswa (CRUD + relasi kelas + akun login)
class SiswaController extends Controller
{
    // Menampilkan data siswa + relasi kelas + fitur search + pagination
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
            ->paginate(10);

        return view('admin.siswa.index', compact('siswa'));
    }

    // Menampilkan form tambah siswa + data kelas untuk dropdown
    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', compact('kelas'));
    }

    // Menyimpan data siswa + membuat akun user
    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nis' => 'required|numeric|unique:siswa,nis',
                'nama' => 'required',
                'id_kelas' => 'required',
                'password' => 'required|min:3',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $fotoName = null;

            // Upload foto jika ada
            if ($request->hasFile('foto')) {
                $fotoName = time().'_'.uniqid().'.'.$request->foto->extension();
                $request->foto->move(public_path('uploads/siswa'), $fotoName);
            }

            // Membuat akun user (login siswa)
            $user = User::create([
                'name' => $request->nama,
                'username' => $request->nis,
                'password' => Hash::make($request->password),
                'role' => 'siswa'
            ]);

            // Simpan data siswa ke database
            Siswa::create([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'id_kelas' => $request->id_kelas,
                'password' => Hash::make($request->password),
                'foto' => $fotoName,
                'id_user' => $user->id // FIX: sebelumnya error karena $user tidak didefinisikan
            ]);

            return redirect('/admin/siswa')->with('success','Data siswa berhasil ditambahkan');

        } catch (\Exception $e) {
            // Menangkap error agar aplikasi tidak crash
            return back()->with('error', $e->getMessage());
        }
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

    // Update data siswa + sinkronisasi akun user
    public function update(Request $request, $id)
    {
        try {
            $siswa = Siswa::findOrFail($id);

            // Simpan NIS lama untuk mencari user
            $nis_lama = $siswa->nis;

            // Validasi input
            $request->validate([
                'nis' => 'required|numeric|unique:siswa,nis,' . $id . ',id_siswa',
                'nama' => 'required',
                'id_kelas' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'password' => 'nullable|min:3'
            ]);

            // Data yang akan diupdate
            $data = [
                'nis' => $request->nis,
                'nama' => $request->nama,
                'id_kelas' => $request->id_kelas,
            ];

            // Update akun user berdasarkan NIS lama
            $user = User::where('username', $nis_lama)->first();

            if ($user) {
                $user->username = $request->nis;

                if ($request->filled('password')) {
                    $user->password = Hash::make($request->password);
                }

                $user->save();
            } else {
                // Debug jika user tidak ditemukan
                return back()->with('error', 'User tidak ditemukan');
            }

            // Upload foto baru + hapus foto lama
            if ($request->hasFile('foto')) {

                if ($siswa->foto && file_exists(public_path('uploads/siswa/' . $siswa->foto))) {
                    unlink(public_path('uploads/siswa/' . $siswa->foto));
                }

                $fotoName = time().'_'.uniqid().'.'.$request->foto->extension();
                $request->foto->move(public_path('uploads/siswa'), $fotoName);

                $data['foto'] = $fotoName;
            }

            // Update data siswa
            $siswa->update($data);

            return redirect('/admin/siswa')
                ->with('success', 'Data siswa berhasil diperbarui');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    // Menghapus data siswa + file foto
    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);

            // Hapus foto jika ada
            if ($siswa->foto && file_exists(public_path('uploads/siswa/' . $siswa->foto))) {
                unlink(public_path('uploads/siswa/' . $siswa->foto));
            }

            // Hapus data siswa
            $siswa->delete();

            return back()->with('success', 'Data siswa & user berhasil dihapus');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal hapus: ' . $e->getMessage());
        }
    }
}