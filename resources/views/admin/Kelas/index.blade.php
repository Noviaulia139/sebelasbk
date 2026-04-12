@extends('admin.layout')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-building"></i>
        Data Kelas
    </h1>
</div>

<!-- Card Container -->
<div class="card-container">

    <!-- Toolbar: Button & Search -->
    <div class="crud-toolbar">
        <a href="{{ route('admin.kelas.create') }}" class="btn-add">
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Kelas
        </a>

       <!-- Toolbar: Button & Search -->
<div class="crud-toolbar">
    
    <form method="GET" class="search-box" id="searchForm">
        <i class="bi bi-search"></i>
        <input type="text" 
               name="q" 
               placeholder="Cari nama kelas..."
               value="{{ request('q') }}"
               oninput="handleSearch(this)">
    </form>
</div>
</div>

<script>
    let searchTimer;
    function handleSearch(input) {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            if (input.value === '') {
                input.name = ''; // hapus param ?q= dari URL
            }
            document.getElementById('searchForm').submit();
        }, 500); // tunggu 500ms setelah berhenti ketik
    }
</script>

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
                    <th>Nama Kelas</th>
                    <th>Jurusan</th>
                    <th>Guru BK</th>
                    <th style="width: 180px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($kelas as $k)
                <tr>
                    <td><strong>{{ $loop->iteration }}</strong></td>
                    <td><strong>{{ $k->nama_kelas }}</strong></td>
                    <td>{{ $k->jurusan }}</td>
                    <td>{{ $k->guru->nama ?? '-' }}</td>

                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.kelas.edit', $k->id_kelas) }}"
                               class="btn-edit">
                                <i class="bi bi-pencil-square me-1"></i>Edit
                            </a>

                            <form action="{{ route('admin.kelas.destroy', $k->id_kelas) }}"
                                  method="POST"
                                  style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete"
                                        onclick="return confirm('Yakin hapus data kelas ini?')">
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
                            <p>Data kelas tidak ditemukan</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $kelas->links('pagination::bootstrap-5') }}
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