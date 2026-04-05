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
    
    <!-- Toolbar -->
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

    <!-- Alert -->
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
                    <th style="width:60px;">No</th>
                    <th style="width:100px;" class="text-center">Foto</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th style="width:120px;">Kelas</th>
                    <th>Jurusan</th>
                    <th style="width:180px;" class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($siswa as $s)
                <tr>
                    <!-- NOMOR AUTO SESUAI PAGE -->
                    <td>
                        <strong>
                            {{ ($siswa->currentPage() - 1) * $siswa->perPage() + $loop->iteration }}
                        </strong>
                    </td>

                    <td class="photo-cell">
                        <img src="{{ $s->foto 
                            ? asset('uploads/siswa/'.$s->foto) 
                            : asset('assets/img/default-user.png') }}"
                             class="user-photo"
                             alt="{{ $s->nama }}">
                    </td>

                    <td><strong>{{ $s->nis }}</strong></td>
                    <td><strong>{{ $s->nama }}</strong></td>
                    <td><strong>{{ $s->kelas->nama_kelas ?? '-' }}</strong></td>
                    <td><strong>{{ $s->kelas->jurusan ?? '-' }}</strong></td>

                    <td>
                        <div class="action-buttons">
                            <a href="/admin/siswa/{{ $s->id_siswa }}/edit"
                               class="btn-edit">
                                <i class="bi bi-pencil-square me-1"></i>Edit
                            </a>

                            <form action="/admin/siswa/{{ $s->id_siswa }}"
                                  method="POST"
                                  style="display:inline;"
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

    <!-- Pagination -->
<div class="pagination-wrapper">
    {{ $siswa->links('pagination::bootstrap-5') }}
</div>

<style>
.pagination-wrapper {
    display: flex;
    justify-content: center;
    padding: 16px 0 4px;
}
.pagination-wrapper .pagination {
    display: flex;
    align-items: center;
    gap: 4px;
    margin: 0;
    padding: 0;
    list-style: none;
}
.pagination-wrapper .pagination li a,
.pagination-wrapper .pagination li span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    padding: 0 10px;
    border-radius: 8px;
    font-size: 13.5px;
    font-weight: 500;
    text-decoration: none;
    border: 1px solid #b2d8df;
    background: #ffffff;
    color: #2a7d8e;
    transition: all 0.15s ease;
}
.pagination-wrapper .pagination li a:hover {
    background: #e0f4f7;
    border-color: #3a8fa3;
    color: #1d6b7a;
}
.pagination-wrapper .pagination li.active span {
    background: #3a8fa3;
    border-color: #3a8fa3;
    color: #ffffff;
    box-shadow: 0 2px 8px rgba(58, 143, 163, 0.30);
    cursor: default;
}
.pagination-wrapper .pagination li.disabled span,
.pagination-wrapper .pagination li.disabled a {
    background: #f4f9fa;
    border-color: #daeaed;
    color: #9bbfc7;
    pointer-events: none;
    cursor: not-allowed;
}
</style>

</div>

@endsection