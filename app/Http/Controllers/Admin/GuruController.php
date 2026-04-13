<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// Controller untuk mengelola data guru (CRUD + akun login)
class GuruController extends Controller
{
    // Menampilkan data guru + fitur search dan pagination
    public function index(Request $request)
    {
        try {
            $q = $request->q;

            $guru = Guru::when($q, function ($query) use ($q) {
                    $query->where(function ($sub) use ($q) {
                        $sub->where('nama', 'like', "%$q%")
                            ->orWhere('nip', 'like', "%$q%");
                    });
                })
                ->orderBy('id_guru', 'desc')
                ->paginate(10);

            return view('admin.guru.index', compact('guru'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat data guru: ' . $e->getMessage());
        }
    }

    // Menampilkan form tambah guru
    public function create()
    {
        return view('admin.guru.create');
    }

    // Menyimpan data guru + membuat akun user jika belum ada
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nip' => 'required|numeric|unique:guru_bk,nip',
            'nama'  => 'required|string|max:100',
            'password' => 'required|min:3',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Ambil data utama
            $data = $request->only('nip', 'nama');

            // Cek apakah user dengan username = NIP sudah ada
            $user = User::where('username', $request->nip)->first();

            // Jika belum ada, buat akun login guru
            if (!$user) {
                User::create([
                    'username' => (string)$request->nip,
                    'password' => Hash::make($request->password),
                    'role' => 'guru'
                ]);
            }

            // Upload foto jika ada
            if ($request->hasFile('foto')) {
                $file = $request->foto;
                $namaFile = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/guru'), $namaFile);
                $data['foto'] = $namaFile;
            }

            // Simpan data guru ke database
            Guru::create($data);

            DB::commit();

            return redirect()->route('admin.guru.index')
                ->with('success', 'Data guru berhasil ditambahkan');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Gagal tambah guru: ' . $e->getMessage());
        }
    }

    // Menampilkan form edit guru
    public function edit($id)
    {
        try {
            $guru = Guru::findOrFail($id);
            return view('admin.guru.edit', compact('guru'));

        } catch (\Exception $e) {
            return back()->with('error', 'Data tidak ditemukan');
        }
    }

    // Update data guru + sinkronisasi akun user
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nip' => 'required|numeric|unique:guru_bk,nip,' . $id . ',id_guru',
            'nama' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $guru = Guru::findOrFail($id);

            $data = $request->only('nip', 'nama');

            // Update foto (hapus lama lalu upload baru)
            if ($request->hasFile('foto')) {
                if ($guru->foto && file_exists(public_path('uploads/guru/' . $guru->foto))) {
                    unlink(public_path('uploads/guru/' . $guru->foto));
                }

                $file = $request->foto;
                $namaFile = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/guru'), $namaFile);
                $data['foto'] = $namaFile;
            }

            // Update user berdasarkan NIP lama
            $user = User::where('username', $guru->nip)->first();

            if ($user) {
                $user->username = (string)$request->nip;

                if ($request->filled('password')) {
                    $user->password = Hash::make($request->password);
                }

                $user->save();
            }

            // Update data guru
            $guru->update($data);

            DB::commit();

            return redirect()
                ->route('admin.guru.index')
                ->with('success', 'Data guru berhasil diperbarui');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    // Menghapus data guru + akun user + file foto
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $guru = Guru::findOrFail($id);

            // Hapus foto jika ada
            if ($guru->foto && file_exists(public_path('uploads/guru/' . $guru->foto))) {
                unlink(public_path('uploads/guru/' . $guru->foto));
            }

            // Hapus akun user berdasarkan NIP
            User::where('username', (string)$guru->nip)->delete();

            // Hapus data guru
            $guru->delete();

            DB::commit();

            return redirect()
                ->route('admin.guru.index')
                ->with('success', 'Data guru berhasil dihapus');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Gagal hapus: ' . $e->getMessage());
        }
    }
}