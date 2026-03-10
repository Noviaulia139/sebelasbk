@extends('admin.layout')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-people-fill"></i>
        Data Siswa
    </h1>
</div>

<!-- Card Container -->
<div class="card-container">
    
    <!-- Toolbar: Button & Search -->
    <div class="crud-toolbar">
        <a href="/admin/siswa/create" class="btn-add">
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Siswa
        </a>

        <form method="GET" class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" 
                   name="q" 
                   placeholder="Cari nama, NIS, kelas, atau jurusan..."
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
                    <th>NIS</th>
                    <th>Nama</th>
                    <th style="width: 100px;">Kelas</th>
                    <th>Jurusan</th>
                    <th style="width: 180px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($siswa as $s)
                <tr>
                    <td><strong>{{ $loop->iteration }}</strong></td>

                    <td class="photo-cell">
                        @if($s->foto)
                            <img src="{{ asset('uploads/siswa/'.$s->foto) }}"
                                 class="user-photo"
                                 alt="{{ $s->nama }}">
                        @else
                            <img src="{{ asset('assets/img/default-user.png') }}"
                                 class="user-photo"
                                 alt="Default">
                        @endif
                    </td>

                    <td><strong>{{ $s->nis }}</strong></td>
                    <td><strong>{{ $s->nama }}</strong></td>
                    <td><strong>{{ $s->kelas }}</strong></td>
                    <td><strong>{{ $s->jurusan }}</strong></td>
                    

                    <td>
                        <div class="action-buttons">
                            <a href="/admin/siswa/{{ $s->id_siswa }}/edit"
                               class="btn-edit">
                                <i class="bi bi-pencil-square me-1"></i>Edit
                            </a>

                            <form action="/admin/siswa/{{ $s->id_siswa }}"
                                  method="POST" 
                                  style="display: inline;"
                                  onsubmit="return confirm('Yakin hapus data siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete">
                                    <i class="bi bi-trash-fill me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Data siswa tidak ditemukan</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection