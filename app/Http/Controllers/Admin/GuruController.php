<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
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
    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nip' => 'required|numeric|unique:guru_bk,nip',
        'nama'  => 'required|string|max:100',
        'password' => 'required|min:6',
        'foto'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    DB::beginTransaction();

    try {
        $data = $request->only('nip', 'nama');

        $user = User::where('username', $request->nip)->first();

        if (!$user) {
            User::create([
                'username' => (string)$request->nip,
                'password' => Hash::make($request->password),
                'role' => 'guru'
            ]);
        }

        if ($request->hasFile('foto')) {
            $file = $request->foto;
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/guru'), $namaFile);
            $data['foto'] = $namaFile;
        }

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

    public function edit($id)
    {
        try {
            $guru = Guru::findOrFail($id);
            return view('admin.guru.edit', compact('guru'));

        } catch (\Exception $e) {
            return back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
{
    // ✅ PINDAH KE LUAR
    $request->validate([
        'nip' => 'required|numeric|unique:guru_bk,nip,' . $id . ',id_guru',
        'nama' => 'required',
    ]);

    DB::beginTransaction();

    try {
        $guru = Guru::findOrFail($id);

     $data = [
    'nip' => $request->nip,
    'nama' => $request->nama
];

        // UPDATE FOTO
        if ($request->hasFile('foto')) {
            if ($guru->foto && file_exists(public_path('uploads/guru/' . $guru->foto))) {
                unlink(public_path('uploads/guru/' . $guru->foto));
            }

            $file = $request->foto;
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/guru'), $namaFile);
            $data['foto'] = $namaFile;
        }

        // UPDATE USER
        $user = User::where('username', $guru->nip)->first();

        if ($user) {
            $user->username = (string)$request->nip;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();
        }

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
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $guru = Guru::findOrFail($id);

            // HAPUS FOTO
            if ($guru->foto && file_exists(public_path('uploads/guru/' . $guru->foto))) {
                unlink(public_path('uploads/guru/' . $guru->foto));
            }

            // DELETE USER (PASTIKAN STRING)
            User::where('username', (string)$guru->nip)->delete();

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