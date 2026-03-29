@extends('admin.layout')

@section('content')
<div class="dashboard-admin-container">
    <!-- Page Header -->
    <div class="page-header-admin">
        <div class="header-content-admin">
            <div class="header-icon-admin">
                <i class="bi bi-speedometer2"></i>
            </div>
            <div>
                <h1 class="page-title-admin">Dashboard Admin</h1>
                <p class="page-subtitle-admin">Pantau sistem dan statistik secara real-time</p>
            </div>
        </div>
        <div class="header-date-admin">
            <i class="bi bi-calendar-event"></i>
            <span>{{ date('d M Y, H:i') }}</span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="stat-card-admin stat-primary-admin">
                <div class="stat-card-body-admin">
                    <div class="stat-content-admin">
                        <div class="stat-info-admin">
                            <p class="stat-label-admin">Total Siswa</p>
                            <h2 class="stat-value-admin">{{ $totalSiswa }}</h2>
                            <span class="stat-badge-admin badge-primary-admin">Terdaftar</span>
                        </div>
                        <div class="stat-icon-wrapper-admin stat-icon-primary-admin">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <div class="stat-footer-admin">
                        <span class="stat-trend-admin">
                            <i class="bi bi-arrow-up"></i> Data siswa aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="stat-card-admin stat-success-admin">
                <div class="stat-card-body-admin">
                    <div class="stat-content-admin">
                        <div class="stat-info-admin">
                            <p class="stat-label-admin">Total Guru BK</p>
                            <h2 class="stat-value-admin">{{ $totalGuru }}</h2>
                            <span class="stat-badge-admin badge-success-admin">Aktif</span>
                        </div>
                        <div class="stat-icon-wrapper-admin stat-icon-success-admin">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                    </div>
                    <div class="stat-footer-admin">
                        <span class="stat-trend-admin">
                            <i class="bi bi-check-circle"></i> Guru terdaftar
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="stat-card-admin stat-warning-admin">
                <div class="stat-card-body-admin">
                    <div class="stat-content-admin">
                        <div class="stat-info-admin">
                            <p class="stat-label-admin">Total Konseling</p>
                            <h2 class="stat-value-admin">{{ $totalKonseling }}</h2>
                            <span class="stat-badge-admin badge-warning-admin">Record</span>
                        </div>
                        <div class="stat-icon-wrapper-admin stat-icon-warning-admin">
                            <i class="bi bi-chat-dots-fill"></i>
                        </div>
                    </div>
                    <div class="stat-footer-admin">
                        <span class="stat-trend-admin">
                            <i class="bi bi-graph-up"></i> Total konseling
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Title -->
    <h2 class="section-title-admin">
        <i class="bi bi-bar-chart-fill me-2"></i>Statistik Sistem
    </h2>

    <!-- Charts -->
    <div class="row g-4 mb-4">
        <!-- Pie Chart Card -->
        <div class="col-lg-6">
            <div class="chart-card-admin">
                <div class="chart-header-admin">
                    <div class="chart-header-content-admin">
                        <i class="bi bi-pie-chart-fill"></i>
                        <span>Distribusi Data</span>
                    </div>
                    <span class="chart-badge-admin badge-primary-admin">Overview</span>
                </div>
                <div class="chart-body-admin">
                    @php
                        $total = $totalSiswa + $totalGuru + $totalKonseling;
                        $siswaPercent = $total > 0 ? ($totalSiswa / $total) * 100 : 0;
                        $guruPercent = $total > 0 ? ($totalGuru / $total) * 100 : 0;
                        $konselingPercent = $total > 0 ? ($totalKonseling / $total) * 100 : 0;
                    @endphp
                    
                    <div class="pie-chart-container-admin">
                        <svg viewBox="0 0 200 200" class="pie-svg-admin">
                            <!-- Siswa Slice -->
                            <circle cx="100" cy="100" r="75" fill="none" 
                                    stroke="#4D869C" stroke-width="50"
                                    stroke-dasharray="{{ ($siswaPercent/100) * 471.24 }} 471.24"
                                    transform="rotate(-90 100 100)"
                                    class="pie-slice"/>
                            
                            <!-- Guru Slice -->
                            <circle cx="100" cy="100" r="75" fill="none" 
                                    stroke="#10b981" stroke-width="50"
                                    stroke-dasharray="{{ ($guruPercent/100) * 471.24 }} 471.24"
                                    stroke-dashoffset="{{ -($siswaPercent/100) * 471.24 }}"
                                    transform="rotate(-90 100 100)"
                                    class="pie-slice"/>
                            
                            <!-- Konseling Slice -->
                            <circle cx="100" cy="100" r="75" fill="none" 
                                    stroke="#f59e0b" stroke-width="50"
                                    stroke-dasharray="{{ ($konselingPercent/100) * 471.24 }} 471.24"
                                    stroke-dashoffset="{{ -(($siswaPercent + $guruPercent)/100) * 471.24 }}"
                                    transform="rotate(-90 100 100)"
                                    class="pie-slice"/>
                            
                            <!-- Center Circle -->
                            <circle cx="100" cy="100" r="50" fill="white"/>
                            <text x="100" y="95" text-anchor="middle" class="pie-label-admin">Total</text>
                            <text x="100" y="115" text-anchor="middle" class="pie-value-admin">{{ $total }}</text>
                        </svg>
                    </div>
                    
                    <div class="chart-legend-admin">
                        <div class="legend-item-admin">
                            <div class="legend-indicator-admin">
                                <span class="legend-dot-admin" style="background: #4D869C;"></span>
                                <span class="legend-text-admin">Siswa</span>
                            </div>
                            <strong class="legend-value-admin">{{ $totalSiswa }} <small>({{ number_format($siswaPercent, 1) }}%)</small></strong>
                        </div>
                        <div class="legend-item-admin">
                            <div class="legend-indicator-admin">
                                <span class="legend-dot-admin" style="background: #10b981;"></span>
                                <span class="legend-text-admin">Guru BK</span>
                            </div>
                            <strong class="legend-value-admin">{{ $totalGuru }} <small>({{ number_format($guruPercent, 1) }}%)</small></strong>
                        </div>
                        <div class="legend-item-admin">
                            <div class="legend-indicator-admin">
                                <span class="legend-dot-admin" style="background: #f59e0b;"></span>
                                <span class="legend-text-admin">Konseling</span>
                            </div>
                            <strong class="legend-value-admin">{{ $totalKonseling }} <small>({{ number_format($konselingPercent, 1) }}%)</small></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bar Chart Card -->
        <div class="col-lg-6">
            <div class="chart-card-admin">
                <div class="chart-header-admin">
                    <div class="chart-header-content-admin">
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Perbandingan Data</span>
                    </div>
                    <span class="chart-badge-admin badge-success-admin">Statistik</span>
                </div>
                <div class="chart-body-admin">
                    @php
                        $maxValue = max($totalSiswa, $totalGuru, $totalKonseling);
                        $siswaHeight = $maxValue > 0 ? ($totalSiswa / $maxValue) * 100 : 0;
                        $guruHeight = $maxValue > 0 ? ($totalGuru / $maxValue) * 100 : 0;
                        $konselingHeight = $maxValue > 0 ? ($totalKonseling / $maxValue) * 100 : 0;
                    @endphp
                    
                    <div class="bar-chart-admin">
                        <div class="bar-item-admin">
                            <div class="bar-wrapper-admin">
                                <div class="bar-fill-admin bar-primary-fill-admin" style="height: {{ $siswaHeight }}%">
                                    <span class="bar-value-admin">{{ $totalSiswa }}</span>
                                </div>
                            </div>
                            <div class="bar-label-admin">
                                <i class="bi bi-people-fill"></i>
                                Siswa
                            </div>
                        </div>
                        
                        <div class="bar-item-admin">
                            <div class="bar-wrapper-admin">
                                <div class="bar-fill-admin bar-success-fill-admin" style="height: {{ $guruHeight }}%">
                                    <span class="bar-value-admin">{{ $totalGuru }}</span>
                                </div>
                            </div>
                            <div class="bar-label-admin">
                                <i class="bi bi-person-badge-fill"></i>
                                Guru BK
                            </div>
                        </div>
                        
                        <div class="bar-item-admin">
                            <div class="bar-wrapper-admin">
                                <div class="bar-fill-admin bar-warning-fill-admin" style="height: {{ $konselingHeight }}%">
                                    <span class="bar-value-admin">{{ $totalKonseling }}</span>
                                </div>
                            </div>
                            <div class="bar-label-admin">
                                <i class="bi bi-chat-dots-fill"></i>
                                Konseling
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Title -->
    <h2 class="section-title-admin">
        <i class="bi bi-info-circle-fill me-2"></i>Informasi Sistem
    </h2>

    <!-- Info Cards -->
    <div class="row g-4">
        <div class="col-lg-4 col-md-6">
            <div class="info-card-admin info-primary-admin">
                <div class="info-icon-admin">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div class="info-content-admin">
                    <h6>Sistem Aman</h6>
                    <p>Keamanan terjaga dengan baik</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-card-admin info-success-admin">
                <div class="info-icon-admin">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div class="info-content-admin">
                    <h6>Berjalan Optimal</h6>
                    <p>Semua layanan beroperasi normal</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-card-admin info-warning-admin">
                <div class="info-icon-admin">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="info-content-admin">
                    <h6>Update Realtime</h6>
                    <p>Data ter-update secara otomatis</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Container */
.dashboard-admin-container {
    padding: 2rem 0;
}

/* Page Header */
.page-header-admin {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding: 2rem;
    background: linear-gradient(135deg, #4D869C 0%, #3a6b7d 100%);
    border-radius: 16px;
    color: white;
    box-shadow: 0 4px 16px rgba(77, 134, 156, 0.3);
}

.header-content-admin {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.header-icon-admin {
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

.page-title-admin {
    font-size: 1.875rem;
    font-weight: 700;
    margin: 0;
    color: white;
}

.page-subtitle-admin {
    font-size: 0.9375rem;
    color: rgba(255, 255, 255, 0.95);
    margin: 0.25rem 0 0 0;
}

.header-date-admin {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 8px;
    font-size: 0.875rem;
}

/* Statistics Cards */
.stat-card-admin {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
    height: 100%;
}

.stat-card-admin:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
}

.stat-card-body-admin {
    padding: 1.5rem;
}

.stat-content-admin {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.stat-info-admin {
    flex: 1;
}

.stat-label-admin {
    font-size: 0.875rem;
    font-weight: 500;
    color: #64748b;
    margin-bottom: 0.5rem;
}

.stat-value-admin {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0.5rem 0;
    line-height: 1;
}

.stat-badge-admin {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-primary-admin {
    background: #dbeafe;
    color: #1e40af;
}

.badge-success-admin {
    background: #d1fae5;
    color: #065f46;
}

.badge-warning-admin {
    background: #fef3c7;
    color: #92400e;
}

.stat-icon-wrapper-admin {
    width: 64px;
    height: 64px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
}

.stat-icon-primary-admin {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    color: #2563eb;
}

.stat-icon-success-admin {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    color: #059669;
}

.stat-icon-warning-admin {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    color: #d97706;
}

.stat-footer-admin {
    padding-top: 1rem;
    border-top: 1px solid #f1f5f9;
}

.stat-trend-admin {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8125rem;
    color: #64748b;
}

/* Color Variants */
.stat-primary-admin .stat-value-admin {
    color: #2563eb;
}

.stat-success-admin .stat-value-admin {
    color: #059669;
}

.stat-warning-admin .stat-value-admin {
    color: #d97706;
}

/* Section Title */
.section-title-admin {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin: 2.5rem 0 1.5rem 0;
    display: flex;
    align-items: center;
}

/* Chart Cards */
.chart-card-admin {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    height: 100%;
}

.chart-header-admin {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-bottom: 2px solid #e2e8f0;
}

.chart-header-content-admin {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.125rem;
    font-weight: 700;
    color: #1e293b;
}

.chart-header-content-admin i {
    color: #4D869C;
    font-size: 1.25rem;
}

.chart-badge-admin {
    padding: 0.375rem 0.875rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
}

.chart-body-admin {
    padding: 2rem;
}

/* Pie Chart */
.pie-chart-container-admin {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
}

.pie-svg-admin {
    width: 220px;
    height: 220px;
}

.pie-slice {
    transition: all 0.3s ease;
}

.pie-label-admin {
    font-size: 14px;
    fill: #64748b;
    font-weight: 600;
}

.pie-value-admin {
    font-size: 28px;
    fill: #1e293b;
    font-weight: 700;
}

.chart-legend-admin {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.legend-item-admin {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.legend-item-admin:hover {
    transform: translateX(4px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.legend-indicator-admin {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.legend-dot-admin {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.legend-text-admin {
    color: #64748b;
    font-size: 0.9375rem;
    font-weight: 500;
}

.legend-value-admin {
    color: #1e293b;
    font-size: 1rem;
}

.legend-value-admin small {
    color: #94a3b8;
    font-weight: 500;
}

/* Bar Chart */
.bar-chart-admin {
    display: flex;
    justify-content: space-around;
    align-items: flex-end;
    height: 280px;
    gap: 2rem;
    padding: 1rem 0;
}

.bar-item-admin {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.bar-wrapper-admin {
    width: 100%;
    height: 220px;
    display: flex;
    align-items: flex-end;
}

.bar-fill-admin {
    width: 100%;
    border-radius: 12px 12px 0 0;
    transition: height 1s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding-top: 1rem;
    position: relative;
}

.bar-primary-fill-admin {
    background: linear-gradient(180deg, #4D869C 0%, #3a6b7d 100%);
}

.bar-success-fill-admin {
    background: linear-gradient(180deg, #10b981 0%, #059669 100%);
}

.bar-warning-fill-admin {
    background: linear-gradient(180deg, #f59e0b 0%, #d97706 100%);
}

.bar-value-admin {
    color: white;
    font-weight: 700;
    font-size: 1.25rem;
}

.bar-label-admin {
    font-weight: 600;
    color: #1e293b;
    font-size: 0.9375rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.bar-label-admin i {
    font-size: 1.125rem;
}

/* Info Cards */
.info-card-admin {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    padding: 1.5rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 2px solid;
    transition: all 0.3s ease;
}

.info-card-admin:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
}

.info-primary-admin {
    border-color: #4D869C;
}

.info-success-admin {
    border-color: #10b981;
}

.info-warning-admin {
    border-color: #f59e0b;
}

.info-icon-admin {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    flex-shrink: 0;
}

.info-primary-admin .info-icon-admin {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    color: #4D869C;
}

.info-success-admin .info-icon-admin {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    color: #10b981;
}

.info-warning-admin .info-icon-admin {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    color: #f59e0b;
}

.info-content-admin h6 {
    margin: 0 0 0.375rem 0;
    font-size: 1rem;
    font-weight: 700;
    color: #1e293b;
}

.info-content-admin p {
    margin: 0;
    font-size: 0.875rem;
    color: #64748b;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-admin-container {
        padding: 1rem 0;
    }

    .page-header-admin {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .page-title-admin {
        font-size: 1.5rem;
    }

    .stat-value-admin {
        font-size: 2rem;
    }

    .stat-icon-wrapper-admin {
        width: 52px;
        height: 52px;
        font-size: 1.5rem;
    }

    .bar-chart-admin {
        gap: 1rem;
        height: 220px;
    }

    .bar-wrapper-admin {
        height: 160px;
    }

    .chart-body-admin {
        padding: 1.5rem;
    }

    .pie-svg-admin {
        width: 180px;
        height: 180px;
    }
}
</style>

<script>
// Animation on load
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.stat-card-admin, .chart-card-admin, .info-card-admin');
    
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>

@endsection