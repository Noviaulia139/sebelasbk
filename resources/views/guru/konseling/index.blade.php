@extends('layouts.guru')

@section('content')
<div class="page-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-icon">
                <i class="bi bi-inbox-fill"></i>
            </div>
            <div>
                <h1 class="page-title">Konseling Masuk</h1>
                <p class="page-subtitle">Kelola pengajuan konseling dari siswa yang membutuhkan bantuan</p>
            </div>
        </div>
        <div class="header-stats">
            <div class="stat-item">
                <span class="stat-number">{{ $konseling->count() ?? 0 }}</span>
                <span class="stat-label">Total Masuk</span>
            </div>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="filter-section">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Cari nama siswa atau jenis masalah..." />
        </div>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        @if(isset($konseling) && $konseling->count() > 0)
        <div class="table-header">
            <h3 class="table-title">
                <i class="bi bi-list-ul me-2"></i>Daftar Pengajuan Konseling
            </h3>
        </div>

        <div class="table-responsive">
            <table class="table modern-table" id="konselingTable">
                <thead>
                    <tr>
                        <th>
                            <div class="th-content">
                                <i class="bi bi-person-circle me-2"></i>Nama Siswa
                            </div>
                        </th>
                        <th>
                            <div class="th-content">
                                <i class="bi bi-journal-text me-2"></i>Jenis Konseling
                            </div>
                        </th>
                        <th>
                            <div class="th-content">
                                <i class="bi bi-lightbulb"></i> Solusi
                            </div>
                        </th>
                        <th>
                            <div class="th-content">
                                <i class="bi bi-flag me-2"></i>Status
                            </div>
                        </th>
                        <th style="width: 200px;">
                            <div class="th-content justify-content-center">
                                <i class="bi bi-gear me-2"></i>Aksi
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($konseling as $item)
                    <tr class="table-row-hover" data-id="{{ $item->id_konseling }}">
                        <td>
                            <div class="student-info">
                                <div class="student-avatar">
                                    {{ substr($item->siswa->nama ?? 'U', 0, 1) }}
                                </div>
                                <div class="student-details">
                                    <strong class="student-name">{{ $item->siswa->nama ?? '-' }}</strong>
                                    <small class="student-meta">
                                        <i class="bi bi-mortarboard"></i> {{ $item->siswa->kelas ?? 'Tidak ada kelas' }}
                                    </small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="problem-info">
                                <div class="problem-badge">
                                    <i class="bi bi-chat-square-text"></i>
                                </div>
                                <span class="problem-text">{{ $item->masalah }}</span>
                            </div>
                        </td>

                        <td>
                            @if($item->solusi)
                                <span class="badge-solusi badge-filled">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Sudah diisi
                                </span>
                            @else
                                <span class="badge-solusi badge-empty">
                                    <i class="bi bi-clock-fill"></i>
                                    Belum diisi
                                </span>
                            @endif
                        </td>

                        <td>
                            <span class="status-badge status-terjadwal">
                                <i class="bi bi-calendar-check"></i>
                                Terjadwal
                            </span>
                        </td>

                        <td>
                            <div class="action-buttons">
                                <a href="/guru/konseling/{{ $item->id_konseling }}" class="btn-action btn-accept">
                                    <i class="bi bi-pencil-square"></i>
                                    Isi Solusi
                                </a>
                                <form action="/guru/konseling/{{ $item->id_konseling }}/batal" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menolak konseling ini?')">
                                    @csrf
                                    <button type="submit" class="btn-action btn-reject">
                                        <i class="bi bi-x-circle"></i>
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Info -->
        <div class="table-footer">
            <p class="showing-info">
                Menampilkan <strong>{{ $konseling->count() }}</strong> pengajuan konseling
            </p>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-illustration">
                <div class="empty-icon">
                    <i class="bi bi-inbox"></i>
                </div>
                <div class="empty-circle circle-1"></div>
                <div class="empty-circle circle-2"></div>
                <div class="empty-circle circle-3"></div>
            </div>
            <h5 class="empty-title">Belum Ada Pengajuan Konseling</h5>
            <p class="empty-text">Pengajuan konseling dari siswa akan muncul di sini. Saat ini belum ada siswa yang mengajukan konseling.</p>
        </div>
        @endif
    </div>
</div>



<style>
/* Page Container */
.page-container {
    padding: 2rem 0;
}

/* Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding: 2rem;
    background: linear-gradient(180deg, #4D869C 0%, #4D869C 100%);
    border-radius: 16px;
    color: white;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.header-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.header-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    color: white;
}

.page-subtitle {
    font-size: 0.9375rem;
    margin: 0.5rem 0 0 0;
    color: rgba(255, 255, 255, 0.95);
}

.header-stats {
    display: flex;
    gap: 2rem;
}

.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1rem 2rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 12px;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: white;
}

.stat-label {
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.95);
    margin-top: 0.25rem;
}

/* Filter Section */
.filter-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    gap: 1rem;
    flex-wrap: wrap;
}

.search-box {
    flex: 1;
    min-width: 300px;
    max-width: 500px;
    position: relative;
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #7AB2B2;
    font-size: 1.125rem;
}

.search-box input {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 3rem;
    border: 2px solid #CDE8E5;
    border-radius: 12px;
    font-size: 0.9375rem;
    transition: all 0.3s ease;
    background: white;
}

.search-box input:focus {
    outline: none;
    border-color: #7AB2B2;
    box-shadow: 0 0 0 4px rgba(122, 178, 178, 0.1);
}

/* Table Card */
.table-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #CDE8E5;
    overflow: hidden;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    background: linear-gradient(135deg, #EEF7FF 0%, #CDE8E5 100%);
    border-bottom: 2px solid #CDE8E5;
}

.table-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #4D869C;
    margin: 0;
    display: flex;
    align-items: center;
}

/* Table */
.table-responsive {
    overflow-x: auto;
}

.modern-table {
    width: 100%;
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.modern-table thead th {
    padding: 1.25rem 2rem;
    font-weight: 600;
    font-size: 0.875rem;
    color: #4D869C;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid #CDE8E5;
    background: #EEF7FF;
}

.th-content {
    display: flex;
    align-items: center;
}

.modern-table tbody tr {
    border-bottom: 1px solid #EEF7FF;
    transition: all 0.2s ease;
}

.modern-table tbody tr:last-child {
    border-bottom: none;
}

.table-row-hover:hover {
    background: #EEF7FF;
}

.modern-table tbody td {
    padding: 1.5rem 2rem;
    color: #4D869C;
    font-size: 0.9375rem;
    vertical-align: middle;
}

/* Student Info */
.student-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.student-avatar {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: linear-gradient(135deg, #7AB2B2 0%, #4D869C 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.25rem;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(77, 134, 156, 0.25);
}

.student-details {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.student-name {
    color: #4D869C;
    font-weight: 600;
    font-size: 0.9375rem;
}

.student-meta {
    color: #7AB2B2;
    font-size: 0.8125rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

/* Problem Info */
.problem-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.problem-badge {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #EEF7FF 0%, #CDE8E5 100%);
    color: #4D869C;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.problem-text {
    line-height: 1.5;
    max-width: 400px;
    color: #4D869C;
}

/* Badge Solusi */
.badge-solusi {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.8125rem;
    white-space: nowrap;
}

.badge-filled {
    background: #d1fae5;
    color: #065f46;
    border: 2px solid #a7f3d0;
}

.badge-empty {
    background: #fee2e2;
    color: #991b1b;
    border: 2px solid #fecaca;
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.8125rem;
    white-space: nowrap;
}

.status-terjadwal {
    background: #CDE8E5;
    color: #4D869C;
    border: 2px solid #7AB2B2;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.625rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    white-space: nowrap;
}

.btn-accept {
    background: linear-gradient(135deg, #7AB2B2 0%, #4D869C 100%);
    color: white;
}

.btn-accept:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(77, 134, 156, 0.3);
    color: white;
}

.btn-reject {
    background: #fee2e2;
    color: #991b1b;
    border: 2px solid #fecaca;
}

.btn-reject:hover {
    background: #dc2626;
    color: white;
    border-color: #dc2626;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

/* Table Footer */
.table-footer {
    padding: 1.25rem 2rem;
    background: #EEF7FF;
    border-top: 1px solid #CDE8E5;
}

.showing-info {
    margin: 0;
    color: #7AB2B2;
    font-size: 0.875rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 5rem 2rem;
    position: relative;
}

.empty-illustration {
    position: relative;
    margin-bottom: 2rem;
}

.empty-icon {
    width: 140px;
    height: 140px;
    margin: 0 auto;
    border-radius: 50%;
    background: linear-gradient(135deg, #EEF7FF 0%, #CDE8E5 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 1;
}

.empty-icon i {
    font-size: 4rem;
    color: #7AB2B2;
}

.empty-circle {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(122, 178, 178, 0.1) 0%, rgba(77, 134, 156, 0.1) 100%);
}

.circle-1 {
    width: 200px;
    height: 200px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: pulse 3s ease-in-out infinite;
}

.circle-2 {
    width: 160px;
    height: 160px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: pulse 3s ease-in-out infinite 0.5s;
}

.circle-3 {
    width: 120px;
    height: 120px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: pulse 3s ease-in-out infinite 1s;
}

@keyframes pulse {
    0%, 100% {
        opacity: 0.4;
        transform: translate(-50%, -50%) scale(1);
    }
    50% {
        opacity: 0.2;
        transform: translate(-50%, -50%) scale(1.1);
    }
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #4D869C;
    margin-bottom: 0.75rem;
}

.empty-text {
    color: #7AB2B2;
    font-size: 1rem;
    max-width: 500px;
    margin: 0 auto 2rem;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .header-content {
        width: 100%;
    }

    .header-stats {
        width: 100%;
        justify-content: space-around;
    }

    .page-title {
        font-size: 1.5rem;
    }

    .filter-section {
        flex-direction: column;
        align-items: stretch;
    }

    .search-box {
        max-width: 100%;
    }

    .table-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .modern-table thead th,
    .modern-table tbody td {
        padding: 1rem;
        font-size: 0.875rem;
    }

    .student-avatar {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }

    .action-buttons {
        flex-direction: column;
        width: 100%;
    }

    .btn-action {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
// Search functionality
document.getElementById('searchInput')?.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#konselingTable tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});
</script>
@endsection