<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index(Request $request)
    {
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
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:20|unique:guru_bk,nip',
            'nama'  => 'required|string|max:100',
            'password' => 'required|min:6',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('nip', 'nama');

        $user = User::where('username', $request->nip)->first();

        if (!$user) {
            User::create([
                'username' => $request->nip,
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

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nip'   => 'required|string|max:20|unique:guru_bk,nip,' . $id . ',id_guru',
            'nama'  => 'required|string|max:100',
            'password' => 'nullable|min:6',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('nip', 'nama');

        // update foto
        if ($request->hasFile('foto')) {
            if ($guru->foto && file_exists(public_path('uploads/guru/' . $guru->foto))) {
                unlink(public_path('uploads/guru/' . $guru->foto));
            }

            $file = $request->foto;
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/guru'), $namaFile);
            $data['foto'] = $namaFile;
        }

        // update user login
        $user = User::where('username', $guru->nip)->first();

        if ($user) {
            $user->username = $request->nip;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();
        }

        $guru->update($data);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);

        if ($guru->foto && file_exists(public_path('uploads/guru/' . $guru->foto))) {
            unlink(public_path('uploads/guru/' . $guru->foto));
        }

        User::where('username', $guru->nip)->delete();

        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus');
    }
}