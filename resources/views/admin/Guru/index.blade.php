@extends('admin.layout')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-person-badge-fill"></i>
        Data Guru
    </h1>
</div>

<!-- Card Container -->
<div class="card-container">
    
    <!-- Toolbar: Button & Search -->
    <div class="crud-toolbar">
        <a href="{{ route('admin.guru.create') }}" class="btn-add">
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Guru
        </a>

        <form method="GET" class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" 
                   name="q" 
                   placeholder="Cari nama atau NIP guru..."
                   value="{{ request('q') }}">
        </form>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert-success">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-modern">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th style="width: 100px;" class="text-center">Foto</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th style="width: 180px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($guru as $g)
                <tr>
                    <td><strong>{{ $loop->iteration }}</strong></td>

                    <td class="photo-cell">
                        @if($g->foto)
                            <img src="{{ asset('uploads/guru/'.$g->foto) }}"
                                 class="user-photo"
                                 alt="{{ $g->nama }}">
                        @else
                            <img src="{{ asset('assets/img/default-user.png') }}"
                                 class="user-photo"
                                 alt="Default">
                        @endif
                    </td>

                    <td><strong>{{ $g->nip }}</strong></td>
                    <td><strong>{{ $g->nama }}</strong></td>

                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.guru.edit', $g->id_guru) }}"
                               class="btn-edit">
                                <i class="bi bi-pencil-square me-1"></i>Edit
                            </a>

                            <form action="{{ route('admin.guru.destroy', $g->id_guru) }}"
                                  method="POST" 
                                  style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete"
                                        onclick="return confirm('Yakin hapus data guru ini?')">
                                    <i class="bi bi-trash-fill me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Data guru tidak ditemukan</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection