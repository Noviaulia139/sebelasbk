@extends('admin.layout')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-chat-dots-fill"></i>
        Data Konseling
    </h1>
</div>

<!-- Card Container -->
<div class="card-container">
    
<!-- Toolbar: Search Only -->
<div class="crud-toolbar">
    <div></div>
    <form method="GET" action="{{ route('admin.konseling.index') }}" class="search-box" id="searchForm">
        <i class="bi bi-search"></i>
        <input type="text" 
               name="q" 
               placeholder="Cari nama siswa atau status..."
               value="{{ request('q') }}"
               oninput="handleSearch(this)">
    </form>
</div>

<script>
    let searchTimer;
    function handleSearch(input) {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            if (input.value === '') {
                input.name = '';
            }
            document.getElementById('searchForm').submit();
        }, 500);
    }
</script>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-modern">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Siswa</th>
                    <th>Guru BK</th>
                    <th>Masalah</th>
                    <th>Solusi</th>
                    <th style="width: 130px;" class="text-center">Status</th>
                    <th style="width: 120px;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
            @forelse($konseling as $item)
                <tr>
                    <td><strong>{{ $loop->iteration }}</strong></td>

                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 40px; 
                                        height: 40px; 
                                        border-radius: 10px; 
                                        background: linear-gradient(135deg, #CDE8E5, #EEF7FF);
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        color: #4D869C;
                                        font-weight: 700;
                                        font-size: 1.1rem;">
                                {{ substr($item->siswa->nama, 0, 1) }}
                            </div>
                            <strong>{{ $item->siswa->nama }}</strong>
                        </div>
                    </td>

                    <td>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <i class="bi bi-person-badge" style="color: #7AB2B2;"></i>
                            <span>{{ $item->guru->nama ?? '-' }}</span>
                        </div>
                    </td>

                    <td>
                        <div style="max-width: 250px;">
                            {{ Str::limit($item->masalah, 50) }}
                        </div>
                    </td>

                    <td>
                        @if($item->solusi)
                            <div style="max-width: 250px;">
                                {{ Str::limit($item->solusi, 50) }}
                            </div>
                        @else
                            <span style="color: #94a3b8; 
                                         font-style: italic;
                                         font-size: 0.9rem;">
                                <i class="bi bi-hourglass-split me-1"></i>
                                Belum ada solusi
                            </span>
                        @endif
                    </td>

                    <td class="text-center">
                        @if($item->status == 'pending')
                            <span style="background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
                                         color: #475569;
                                         padding: 8px 16px;
                                         border-radius: 10px;
                                         font-weight: 600;
                                         font-size: 0.85rem;
                                         display: inline-flex;
                                         align-items: center;
                                         gap: 6px;
                                         white-space: nowrap;">
                                <i class="bi bi-clock-history"></i>
                                Pending
                            </span>
                        @elseif($item->status == 'proses')
                            <span style="background: linear-gradient(135deg, #fef3c7, #fde047);
                                         color: #92400e;
                                         padding: 8px 16px;
                                         border-radius: 10px;
                                         font-weight: 600;
                                         font-size: 0.85rem;
                                         display: inline-flex;
                                         align-items: center;
                                         gap: 6px;
                                         white-space: nowrap;">
                                <i class="bi bi-arrow-repeat"></i>
                                Proses
                            </span>
                        @elseif($item->status == 'selesai')
                            <span style="background: linear-gradient(135deg, #d1fae5, #a7f3d0);
                                         color: #065f46;
                                         padding: 8px 16px;
                                         border-radius: 10px;
                                         font-weight: 600;
                                         font-size: 0.85rem;
                                         display: inline-flex;
                                         align-items: center;
                                         gap: 6px;
                                         white-space: nowrap;">
                                <i class="bi bi-check-circle-fill"></i>
                                Selesai
                            </span>
                        @else
                            <span style="background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
                                         color: #475569;
                                         padding: 8px 16px;
                                         border-radius: 10px;
                                         font-weight: 600;
                                         font-size: 0.85rem;
                                         display: inline-flex;
                                         align-items: center;
                                         gap: 6px;
                                         white-space: nowrap;">
                                <i class="bi bi-question-circle"></i>
                                {{ ucfirst($item->status) }}
                            </span>
                        @endif
                    </td>

                    <td>
                        <div style="display: flex; align-items: center; gap: 6px; color: #64748b;">
                            <i class="bi bi-calendar3"></i>
                            <span style="font-size: 0.9rem;">
                                {{ $item->created_at?->format('d M Y') ?? '-' }}
                            </span>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="bi bi-chat-dots"></i>
                            <p>Data konseling belum tersedia</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
           <div class="pagination-wrapper">
    {{ $konseling->appends(request()->query())->links('pagination::bootstrap-5') }}
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
    <div style="margin-top: 20px; 
                padding: 16px 20px; 
                background: linear-gradient(135deg, #fef3c7, #fde68a);
                border-radius: 12px;
                display: flex;
                align-items: center;
                gap: 12px;
                border-left: 4px solid #f59e0b;">
        <i class="bi bi-info-circle-fill" style="font-size: 1.5rem; color: #d97706;"></i>
        <div>
            <strong style="color: #92400e; display: block; margin-bottom: 4px;">
                Mode Read-Only
            </strong>
            <small style="color: #78350f;">
                Data konseling bersifat rahasia dan hanya dapat dilihat. 
                Siswa dan Guru BK yang dapat mengelola data konseling.
            </small>
        </div>
    </div>
</div>

@endsection