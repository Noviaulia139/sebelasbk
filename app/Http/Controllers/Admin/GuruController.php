<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $guru = Guru::when($q, function ($query) use ($q) {
            $query->where('nama', 'like', "%$q%")
                  ->orWhere('nip', 'like', "%$q%");
        })->get();

        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip'   => 'nullable|string|max:20',
            'nama'  => 'required|string|max:100',
            'password' => 'required|min:6',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('nip', 'nama');
        $data['password'] = Hash::make($request->password);

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

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nip'   => 'nullable|string|max:20',
            'nama'  => 'required|string|max:100',
            'password' => 'nullable|min:6',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('nip', 'nama');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($guru->foto && file_exists(public_path('uploads/guru/' . $guru->foto))) {
                unlink(public_path('uploads/guru/' . $guru->foto));
            }

            $file = $request->foto;
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/guru'), $namaFile);
            $data['foto'] = $namaFile;
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

        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }
}
