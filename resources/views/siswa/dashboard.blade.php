@extends('layouts.siswa')

@section('content')
<div class="dashboard-container">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="header-content">
            <div class="header-icon">
                <i class="bi bi-house-door-fill"></i>
            </div>
            <div>
                <h1 class="page-title">Dashboard Siswa</h1>
                <p class="page-subtitle">Selamat datang! Pantau status konseling Anda di sini</p>
            </div>
        </div>
        <div class="header-actions">
            <span class="last-update">
                <i class="bi bi-clock"></i> {{ date('d M Y, H:i') }}
            </span>
        </div>
    </div>

    {{-- ================= NOTIFIKASI ================= --}}
    @if($lastKonseling)
    <div class="notification-card">
        @if($lastKonseling->status == 'menunggu')
        <div class="notification-content notification-warning">
            <div class="notification-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="notification-text">
                <h5>Konseling Sedang Menunggu</h5>
                <p>Konseling Anda sedang <strong>menunggu respon</strong> dari Guru BK. Mohon bersabar ya!</p>
            </div>
        </div>
        @elseif($lastKonseling->status == 'terjadwal')
        <div class="notification-content notification-primary">
            <div class="notification-icon">
                <i class="bi bi-calendar-check"></i>
            </div>
            <div class="notification-text">
                <h5>Konseling Terjadwal</h5>
                <p>Konseling Anda sudah <strong>dijadwalkan</strong> oleh Guru BK.</p>
            </div>
        </div>
        @else
        <div class="notification-content notification-success">
            <div class="notification-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="notification-text">
                <h5>Konseling Selesai</h5>
                <p>Konseling Anda <strong>sudah selesai</strong>! Silakan lihat solusi dari Guru BK.</p>
            </div>
            <a href="{{ route('siswa.riwayat.index') }}" class="btn-view-solution">
                <i class="bi bi-eye-fill"></i> Lihat Solusi
            </a>
        </div>
        @endif
    </div>
    @else
    <div class="notification-card">
        <div class="notification-content notification-info">
            <div class="notification-icon">
                <i class="bi bi-info-circle-fill"></i>
            </div>
            <div class="notification-text">
                <h5>Belum Ada Konseling</h5>
                <p>Anda belum pernah mengajukan konseling. Jangan ragu untuk meminta bantuan!</p>
            </div>
        </div>
    </div>
    @endif

    {{-- ================= STATISTICS CARDS ================= --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="stat-card stat-warning">
                <div class="stat-card-body">
                    <div class="stat-content">
                        <div class="stat-info">
                            <p class="stat-label">Terjadwal</p>
                            <h2 class="stat-value">{{ $terjadwal }}</h2>
                            <span class="stat-badge badge-warning">Dijadwalkan</span>
                        </div>
                        <div class="stat-icon-wrapper stat-icon-warning">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <span class="stat-trend">
                            <i class="bi bi-clock"></i> Menunggu jadwal konseling
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="stat-card stat-success">
                <div class="stat-card-body">
                    <div class="stat-content">
                        <div class="stat-info">
                            <p class="stat-label">Selesai</p>
                            <h2 class="stat-value">{{ $selesai }}</h2>
                            <span class="stat-badge badge-success">Completed</span>
                        </div>
                        <div class="stat-icon-wrapper stat-icon-success">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <span class="stat-trend">
                            <i class="bi bi-graph-up"></i> Total terselesaikan
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="stat-card stat-danger">
                <div class="stat-card-body">
                    <div class="stat-content">
                        <div class="stat-info">
                            <p class="stat-label">Dibatalkan</p>
                            <h2 class="stat-value">{{ $batal }}</h2>
                            <span class="stat-badge badge-danger">Cancelled</span>
                        </div>
                        <div class="stat-icon-wrapper stat-icon-danger">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <span class="stat-trend">
                            <i class="bi bi-dash-circle"></i> Konseling dibatalkan
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= QUICK ACTIONS ================= --}}
    <div class="quick-actions-section">
        <div class="section-header-actions">
            <div>
                <h2 class="section-title">
                    <i class="bi bi-lightning-charge-fill me-2"></i>Aksi Cepat
                </h2>
                <p class="section-subtitle">Lakukan tindakan yang Anda butuhkan dengan cepat</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <a href="{{ route('siswa.konseling.ajukan') }}" class="action-card action-primary">
                    <div class="action-icon">
                        <i class="bi bi-chat-right-text-fill"></i>
                    </div>
                    <div class="action-content">
                        <h4>Ajukan Konseling</h4>
                        <p>Sampaikan masalah Anda dan dapatkan solusi dari Guru BK</p>
                    </div>
                    <div class="action-arrow">
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('siswa.riwayat.index') }}" class="action-card action-secondary">
                    <div class="action-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="action-content">
                        <h4>Riwayat Konseling</h4>
                        <p>Lihat semua riwayat konseling dan solusi yang telah diberikan</p>
                    </div>
                    <div class="action-arrow">
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- ================= TIPS SECTION ================= --}}
    <div class="tips-card">
        <div class="tips-header">
            <i class="bi bi-lightbulb-fill"></i>
            <span>Tips Menggunakan Layanan Konseling</span>
        </div>
        <div class="tips-grid">
            <div class="tip-item">
                <div class="tip-number">1</div>
                <div class="tip-content">
                    <h5>Sampaikan dengan Jelas</h5>
                    <p>Jelaskan masalah Anda secara detail agar Guru BK dapat memberikan solusi yang tepat</p>
                </div>
            </div>
            <div class="tip-item">
                <div class="tip-number">2</div>
                <div class="tip-content">
                    <h5>Bersikap Terbuka</h5>
                    <p>Jangan ragu untuk berbagi, semua informasi akan dijaga kerahasiaannya</p>
                </div>
            </div>
            <div class="tip-item">
                <div class="tip-number">3</div>
                <div class="tip-content">
                    <h5>Follow Up</h5>
                    <p>Periksa dashboard secara berkala untuk melihat respon dari Guru BK</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Color Variables */
:root {
    --color-mint: #CDE8E5;
    --color-light-blue: #EEF7FF;
    --color-teal: #7AB2B2;
    --color-dark-teal: #4D869C;
}

/* Dashboard Container */
.dashboard-container {
    padding: 2rem 0;
}

/* Dashboard Header */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding: 2rem;
    background: linear-gradient(135deg, var(--color-dark-teal) 0%, #3a6b7d 100%);
    border-radius: 16px;
    color: white;
    box-shadow: 0 4px 16px rgba(77, 134, 156, 0.3);
}

.header-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.header-icon {
    width: 56px;
    height: 56px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
}

.page-title {
    font-size: 1.875rem;
    font-weight: 700;
    margin: 0;
}

.page-subtitle {
    font-size: 0.9375rem;
    margin: 0.25rem 0 0 0;
    opacity: 0.95;
}

.header-actions {
    display: flex;
    align-items: center;
}

.last-update {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 8px;
    font-size: 0.875rem;
}

/* Notification Card */
.notification-card {
    margin-bottom: 2rem;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.notification-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 1.5rem;
}

.notification-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    flex-shrink: 0;
}

.notification-text {
    flex: 1;
}

.notification-text h5 {
    font-size: 1.125rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
}

.notification-text p {
    margin: 0;
    font-size: 0.9375rem;
    line-height: 1.6;
}

.btn-view-solution {
    padding: 0.625rem 1.25rem;
    background: white;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Notification Variants */
.notification-warning {
    background: linear-gradient(135deg, #fef9e7 0%, #fdeaa8 100%);
    color: #92400e;
}

.notification-warning .notification-icon {
    background: #f59e0b;
    color: white;
}

.notification-primary {
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    color: var(--color-dark-teal);
}

.notification-primary .notification-icon {
    background: var(--color-teal);
    color: white;
}

.notification-success {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    color: #065f46;
}

.notification-success .notification-icon {
    background: #10b981;
    color: white;
}

.notification-success .btn-view-solution {
    color: #065f46;
}

.notification-success .btn-view-solution:hover {
    background: #10b981;
    color: white;
}

.notification-info {
    background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
    color: #3730a3;
}

.notification-info .notification-icon {
    background: #6366f1;
    color: white;
}

/* Statistics Cards */
.stat-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
}

.stat-card-body {
    padding: 1.5rem;
}

.stat-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.stat-info {
    flex: 1;
}

.stat-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #64748b;
    margin-bottom: 0.5rem;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0.5rem 0;
    line-height: 1;
}

.stat-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-warning {
    background: #fef9e7;
    color: #92400e;
}

.badge-success {
    background: #d1fae5;
    color: #065f46;
}

.badge-danger {
    background: #fee2e2;
    color: #991b1b;
}

.stat-icon-wrapper {
    width: 64px;
    height: 64px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
}

.stat-icon-warning {
    background: linear-gradient(135deg, #fef9e7 0%, #fdeaa8 100%);
    color: #d97706;
}

.stat-icon-success {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    color: #059669;
}

.stat-icon-danger {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    color: #dc2626;
}

.stat-footer {
    padding-top: 1rem;
    border-top: 1px solid #f1f5f9;
}

.stat-trend {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8125rem;
    color: #64748b;
}

/* Color Variants */
.stat-warning .stat-value {
    color: #d97706;
}

.stat-success .stat-value {
    color: #059669;
}

.stat-danger .stat-value {
    color: #dc2626;
}

/* Quick Actions Section */
.quick-actions-section {
    margin-top: 2.5rem;
    margin-bottom: 2.5rem;
}

.section-header-actions {
    margin-bottom: 1.5rem;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a202c;
    margin: 0;
    display: flex;
    align-items: center;
}

.section-subtitle {
    font-size: 0.9375rem;
    color: #64748b;
    margin: 0.5rem 0 0 0;
}

/* Action Cards */
.action-card {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 2rem;
    background: white;
    border-radius: 16px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid #e2e8f0;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.action-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
}

.action-primary {
    border-color: var(--color-teal);
}

.action-primary:hover {
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
}

.action-secondary {
    border-color: #10b981;
}

.action-secondary:hover {
    background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
}

.action-icon {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    flex-shrink: 0;
}

.action-primary .action-icon {
    background: linear-gradient(135deg, var(--color-teal) 0%, var(--color-dark-teal) 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(77, 134, 156, 0.3);
}

.action-secondary .action-icon {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.action-content {
    flex: 1;
}

.action-content h4 {
    font-size: 1.125rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
}

.action-primary .action-content h4 {
    color: var(--color-dark-teal);
}

.action-secondary .action-content h4 {
    color: #065f46;
}

.action-content p {
    margin: 0;
    font-size: 0.875rem;
    color: #64748b;
    line-height: 1.6;
}

.action-arrow {
    font-size: 1.75rem;
    opacity: 0.5;
    transition: all 0.3s ease;
}

.action-primary .action-arrow {
    color: var(--color-teal);
}

.action-secondary .action-arrow {
    color: #10b981;
}

.action-card:hover .action-arrow {
    opacity: 1;
    transform: translateX(4px);
}

/* Tips Card */
.tips-card {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 16px;
    padding: 2rem;
    border: 2px solid #e2e8f0;
    margin-top: 2rem;
}

.tips-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1.5rem;
}

.tips-header i {
    color: #f59e0b;
    font-size: 1.5rem;
}

.tips-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.tip-item {
    display: flex;
    gap: 1rem;
    padding: 1.25rem;
    background: white;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.tip-number {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, var(--color-teal) 0%, var(--color-dark-teal) 100%);
    color: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.125rem;
    flex-shrink: 0;
}

.tip-content h5 {
    font-size: 1rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.5rem 0;
}

.tip-content p {
    margin: 0;
    font-size: 0.875rem;
    color: #64748b;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .page-title {
        font-size: 1.5rem;
    }

    .stat-value {
        font-size: 2rem;
    }

    .stat-icon-wrapper {
        width: 52px;
        height: 52px;
        font-size: 1.5rem;
    }

    .action-card {
        flex-direction: column;
        text-align: center;
    }

    .action-arrow {
        display: none;
    }

    .notification-content {
        flex-direction: column;
        text-align: center;
    }

    .tips-grid {
        grid-template-columns: 1fr;
    }
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stat-card,
.action-card,
.tip-item {
    animation: fadeIn 0.5s ease-out;
}
</style>

@endsection