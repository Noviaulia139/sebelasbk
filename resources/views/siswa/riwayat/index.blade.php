@extends('layouts.siswa')

@section('content')
<div class="riwayat-container">
    <!-- Page Header -->
    <div class="page-header-riwayat">
        <div class="header-content-riwayat">
            <div class="header-icon-riwayat">
                <i class="bi bi-clock-history"></i>
            </div>
            <div>
                <h1 class="page-title-riwayat">Riwayat Konseling</h1>
                <p class="page-subtitle-riwayat">Lihat semua riwayat konseling yang telah Anda lakukan</p>
            </div>
        </div>
        <div class="header-stats-riwayat">
            <div class="stat-badge-riwayat">
                <i class="bi bi-file-text"></i>
                <span>{{ $riwayat->count() }} Konseling</span>
            </div>
        </div>
    </div>

    @if($riwayat->count() > 0)
    <!-- Cards Grid Layout -->
    <div class="riwayat-grid">
        @foreach($riwayat as $index => $item)
        <div class="konseling-card" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
            <!-- Card Header -->
            <div class="card-header-konseling">
                <div class="card-number">
                    #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                </div>
                <div class="card-date">
                    <i class="bi bi-calendar-event"></i>
                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body-konseling">
                <!-- Masalah Section -->
                <div class="masalah-section">
                    <div class="section-label">
                        <i class="bi bi-chat-square-text-fill"></i>
                        <span>Masalah</span>
                    </div>
                    <p class="masalah-content">{{ $item->masalah }}</p>
                </div>

                <!-- Solusi Section -->
                <div class="solusi-section">
                    <div class="section-label">
                        <i class="bi bi-lightbulb-fill"></i>
                        <span>Solusi dari Guru</span>
                    </div>
                    @if($item->solusi)
                    <div class="solusi-content-filled">
                        <p class="solusi-text-content">{{ Str::limit($item->solusi, 150) }}</p>
                        @if(strlen($item->solusi) > 150)
                        <button class="btn-expand" onclick="showDetail('{{ $item->id_konseling }}')">
                            <i class="bi bi-arrows-angle-expand"></i>
                            Lihat Selengkapnya
                        </button>
                        @endif
                    </div>
                    @else
                    <div class="solusi-content-empty">
                        <i class="bi bi-hourglass-split"></i>
                        <span>Guru belum memberikan solusi</span>
                    </div>
                    @endif
                </div>

                <!-- Status Section -->
                <div class="status-section">
                    @if($item->status == 'selesai')
                    <div class="status-badge-card status-selesai">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Selesai</span>
                    </div>
                    @elseif($item->status == 'terjadwal')
                    <div class="status-badge-card status-terjadwal">
                        <i class="bi bi-clock-fill"></i>
                        <span>Terjadwal</span>
                    </div>
                    @else
                    <div class="status-badge-card status-menunggu">
                        <i class="bi bi-hourglass-split"></i>
                        <span>Menunggu</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="empty-state-riwayat">
        <div class="empty-illustration-riwayat">
            <div class="empty-icon-riwayat">
                <i class="bi bi-inbox"></i>
            </div>
            <div class="empty-circle-bg circle-1"></div>
            <div class="empty-circle-bg circle-2"></div>
            <div class="empty-circle-bg circle-3"></div>
        </div>
        <h3 class="empty-title-riwayat">Belum Ada Riwayat Konseling</h3>
        <p class="empty-text-riwayat">Anda belum pernah melakukan konseling. Mulai konseling pertama Anda sekarang!</p>
        <a href="/siswa/konseling/ajukan" class="btn-empty-action">
            <i class="bi bi-plus-circle-fill"></i>
            Ajukan Konseling Baru
        </a>
    </div>
    @endif
</div>

<style>
/* Color Variables */
:root {
    --color-mint: #CDE8E5;
    --color-light-blue: #EEF7FF;
    --color-teal: #7AB2B2;
    --color-dark-teal: #4D869C;
}

/* Container */
.riwayat-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

/* Page Header */
.page-header-riwayat {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2.5rem;
    padding: 2rem;
    background: linear-gradient(135deg, #4D869C 0%, #3a6b7d 100%);
    border-radius: 20px;
    color: white;
    box-shadow: 0 8px 24px rgba(77, 134, 156, 0.35);
}

.header-content-riwayat {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.header-icon-riwayat {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
}

.page-title-riwayat {
    font-size: 2rem;
    font-weight: 800;
    margin: 0;
    color: white;
}

.page-subtitle-riwayat {
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
    color: rgba(255, 255, 255, 0.95);
}

.header-stats-riwayat {
    display: flex;
    gap: 1rem;
}

.stat-badge-riwayat {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.5rem;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    font-weight: 700;
    font-size: 1.125rem;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

/* Grid Layout */
.riwayat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 2rem;
}

/* Konseling Card */
.konseling-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid #e8f4f4;
}

.konseling-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(77, 134, 156, 0.2);
    border-color: #7AB2B2;
}

/* Card Header */
.card-header-konseling {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    border-bottom: 2px solid var(--color-mint);
}

.card-number {
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--color-dark-teal);
    padding: 0.5rem 1rem;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(77, 134, 156, 0.2);
}

.card-date {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--color-dark-teal);
    font-size: 0.9375rem;
    font-weight: 600;
}

.card-date i {
    color: var(--color-teal);
    font-size: 1.125rem;
}

/* Card Body */
.card-body-konseling {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* Section Label */
.section-label {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    font-weight: 700;
    font-size: 0.875rem;
    color: var(--color-dark-teal);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.75rem;
}

.section-label i {
    font-size: 1.125rem;
}

/* Masalah Section */
.masalah-section {
    padding: 1.25rem;
    background: linear-gradient(135deg, #fef9e7 0%, #fcf3cf 100%);
    border-radius: 12px;
    border-left: 4px solid #f39c12;
}

.masalah-section .section-label {
    color: #b8860b;
}

.masalah-section .section-label i {
    color: #f39c12;
}

.masalah-content {
    margin: 0;
    color: #7d6608;
    font-size: 0.9375rem;
    line-height: 1.7;
    font-weight: 500;
}

/* Solusi Section */
.solusi-section {
    padding: 1.25rem;
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    border-radius: 12px;
    border-left: 4px solid var(--color-teal);
}

.solusi-section .section-label {
    color: var(--color-dark-teal);
}

.solusi-section .section-label i {
    color: var(--color-teal);
}

.solusi-content-filled {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.solusi-text-content {
    margin: 0;
    color: #334155;
    font-size: 0.9375rem;
    line-height: 1.7;
}

.btn-expand {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: linear-gradient(135deg, var(--color-teal) 0%, var(--color-dark-teal) 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 0.8125rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    align-self: flex-start;
}

.btn-expand:hover {
    transform: translateX(4px);
    box-shadow: 0 4px 12px rgba(77, 134, 156, 0.4);
}

.solusi-content-empty {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    border-radius: 10px;
    color: #991b1b;
    font-size: 0.875rem;
    font-weight: 600;
    font-style: italic;
}

.solusi-content-empty i {
    font-size: 1.25rem;
    color: #dc2626;
}

/* Status Section */
.status-section {
    display: flex;
    justify-content: flex-end;
}

.status-badge-card {
    display: inline-flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.75rem 1.25rem;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.875rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.status-selesai {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    color: #065f46;
    border: 2px solid #6ee7b7;
}

.status-terjadwal {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    color: #92400e;
    border: 2px solid #fcd34d;
}

.status-menunggu {
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    color: var(--color-dark-teal);
    border: 2px solid var(--color-teal);
}

.status-badge-card i {
    font-size: 1.125rem;
}

/* Empty State */
.empty-state-riwayat {
    text-align: center;
    padding: 6rem 2rem;
    position: relative;
}

.empty-illustration-riwayat {
    position: relative;
    margin-bottom: 2rem;
}

.empty-icon-riwayat {
    width: 160px;
    height: 160px;
    margin: 0 auto;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--color-mint) 0%, var(--color-light-blue) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 1;
}

.empty-icon-riwayat i {
    font-size: 5rem;
    color: var(--color-teal);
}

.empty-circle-bg {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(122, 178, 178, 0.15) 0%, rgba(77, 134, 156, 0.15) 100%);
}

.circle-1 {
    width: 220px;
    height: 220px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: pulse-circle 3s ease-in-out infinite;
}

.circle-2 {
    width: 180px;
    height: 180px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: pulse-circle 3s ease-in-out infinite 0.5s;
}

.circle-3 {
    width: 140px;
    height: 140px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: pulse-circle 3s ease-in-out infinite 1s;
}

@keyframes pulse-circle {
    0%, 100% {
        opacity: 0.4;
        transform: translate(-50%, -50%) scale(1);
    }
    50% {
        opacity: 0.2;
        transform: translate(-50%, -50%) scale(1.15);
    }
}

.empty-title-riwayat {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--color-dark-teal);
    margin-bottom: 0.75rem;
}

.empty-text-riwayat {
    color: #64748b;
    font-size: 1.125rem;
    max-width: 500px;
    margin: 0 auto 2rem;
    line-height: 1.7;
}

.btn-empty-action {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, var(--color-teal) 0%, var(--color-dark-teal) 100%);
    color: white;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(77, 134, 156, 0.3);
}

.btn-empty-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(77, 134, 156, 0.4);
    color: white;
}

.btn-empty-action i {
    font-size: 1.25rem;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .riwayat-grid {
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    }
}

@media (max-width: 768px) {
    .riwayat-container {
        padding: 1rem;
    }

    .page-header-riwayat {
        flex-direction: column;
        align-items: flex-start;
        gap: 1.5rem;
        padding: 1.5rem;
    }

    .header-content-riwayat {
        width: 100%;
    }

    .header-stats-riwayat {
        width: 100%;
    }

    .stat-badge-riwayat {
        flex: 1;
        justify-content: center;
    }

    .page-title-riwayat {
        font-size: 1.5rem;
    }

    .riwayat-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .header-icon-riwayat {
        width: 56px;
        height: 56px;
        font-size: 1.75rem;
    }
}

@media (max-width: 480px) {
    .card-header-konseling {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .empty-icon-riwayat {
        width: 120px;
        height: 120px;
    }

    .empty-icon-riwayat i {
        font-size: 3.5rem;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.konseling-card {
    animation: fadeInUp 0.6s ease-out;
}
</style>

<script>
function showDetail(id) {
    window.location.href = '/siswa/riwayat/' + id;
}

// Add entrance animation on scroll
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.konseling-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1
    });
    
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        observer.observe(card);
    });
});
</script>

@endsection