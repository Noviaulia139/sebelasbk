@extends('layouts.guru')

@section('content')
<div class="page-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-icon">
                <i class="bi bi-lightbulb-fill"></i>
            </div>
            <div>
                <h1 class="page-title">Solusi Konseling</h1>
                <p class="page-subtitle">Berikan solusi dan saran untuk mengatasi masalah siswa</p>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="content-card">
        <form action="/guru/konseling/{{ $konseling->id_konseling }}/solusi" method="POST">
            @csrf

            <!-- Student Info Section -->
            <div class="section-card">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="bi bi-info-circle me-2"></i>Informasi Siswa
                    </h3>
                </div>

                <div class="info-grid">
                    <!-- Nama Siswa -->
                    <div class="info-item">
                        <label class="info-label">
                            <i class="bi bi-person-circle"></i>
                            Nama Siswa
                        </label>
                        <div class="student-display">
                            <div class="student-avatar">
                                {{ substr($konseling->siswa->nama, 0, 1) }}
                            </div>
                            <div class="student-details">
                                <strong class="student-name">{{ $konseling->siswa->nama }}</strong>
                                <small class="student-meta">
                                    <i class="bi bi-mortarboard"></i> {{ $konseling->siswa->kelas ?? 'Tidak ada kelas' }}
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Masalah -->
                    <div class="info-item full-width">
                        <label class="info-label">
                            <i class="bi bi-chat-square-text"></i>
                            Masalah yang Dihadapi
                        </label>
                        <div class="problem-display">
                            <div class="problem-badge">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <span class="problem-text">{{ $konseling->masalah }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Solution Section -->
            <div class="section-card">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="bi bi-lightbulb me-2"></i>Solusi dan Rekomendasi
                    </h3>
                    @if($konseling->solusi)
                    <span class="status-badge status-filled">
                        <i class="bi bi-check-circle"></i>
                        Sudah diisi
                    </span>
                    @else
                    <span class="status-badge status-empty">
                        <i class="bi bi-clock"></i>
                        Belum diisi
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="bi bi-pencil-square"></i>
                        Tuliskan Solusi Anda
                    </label>
                    <textarea 
                        name="solusi" 
                        class="form-control-textarea" 
                        rows="10"
                        placeholder="Tuliskan solusi, saran, dan rekomendasi untuk mengatasi masalah siswa...&#10;&#10;Tips:&#10;• Identifikasi akar masalah&#10;• Berikan pendekatan yang tepat&#10;• Saran tindak lanjut&#10;• Monitoring berkala"
                    >{{ $konseling->solusi }}</textarea>
                    <div class="textarea-info">
                        <span class="char-counter">
                            <i class="bi bi-textarea-t"></i>
                            <span id="charCount">{{ strlen($konseling->solusi ?? '') }}</span> karakter
                        </span>
                    </div>
                </div>

                @if(!$konseling->solusi)
                <div class="alert-info">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>Solusi belum diisi. Berikan solusi yang konstruktif dan membantu siswa.</span>
                </div>
                @endif

                <!-- Tips Card -->
                <div class="tips-card">
                    <div class="tips-header">
                        <i class="bi bi-star-fill"></i>
                        <span>Tips Memberikan Solusi</span>
                    </div>
                    <ul class="tips-list">
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Bersikap empati dan memahami situasi siswa</span>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Berikan solusi yang spesifik dan dapat diterapkan</span>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Sertakan langkah-langkah konkret yang bisa diikuti</span>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Tawarkan dukungan berkelanjutan jika diperlukan</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <a href="/guru/riwayat" class="btn-cancel">
                    kembali
                </a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-circle-fill"></i>
                    Simpan Solusi
                </button>
            </div>
        </form>
    </div>
</div>

<style>
/* Page Container */
.page-container {
    padding: 2rem 0;
    max-width: 1200px;
    margin: 0 auto;
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

/* Content Card */
.content-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #CDE8E5;
    overflow: hidden;
}

/* Section Card */
.section-card {
    padding: 2rem;
    border-bottom: 1px solid #EEF7FF;
}

.section-card:last-child {
    border-bottom: none;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1.25rem;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #CDE8E5;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #4D869C;
    margin: 0;
    display: flex;
    align-items: center;
}

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.info-item.full-width {
    grid-column: 1 / -1;
}

.info-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    font-size: 0.9375rem;
    color: #4D869C;
}

.info-label i {
    color: #7AB2B2;
    font-size: 1.125rem;
}

/* Student Display */
.student-display {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, #EEF7FF 0%, #CDE8E5 100%);
    border-radius: 12px;
    border: 2px solid #CDE8E5;
}

.student-avatar {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    background: linear-gradient(135deg, #7AB2B2 0%, #4D869C 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.5rem;
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
    font-size: 1rem;
}

.student-meta {
    color: #7AB2B2;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

/* Problem Display */
.problem-display {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: #fef3c7;
    border-radius: 12px;
    border: 2px solid #fde68a;
}

.problem-badge {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1.25rem;
}

.problem-text {
    flex: 1;
    color: #92400e;
    font-size: 0.9375rem;
    line-height: 1.6;
    font-weight: 500;
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

.status-filled {
    background: #d1fae5;
    color: #065f46;
    border: 2px solid #a7f3d0;
}

.status-empty {
    background: #fee2e2;
    color: #991b1b;
    border: 2px solid #fecaca;
}

/* Form Group */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    font-size: 0.9375rem;
    color: #4D869C;
    margin-bottom: 0.75rem;
}

.form-label i {
    color: #7AB2B2;
    font-size: 1.125rem;
}

/* Textarea */
.form-control-textarea {
    width: 100%;
    padding: 1.25rem;
    border: 2px solid #CDE8E5;
    border-radius: 12px;
    font-size: 0.9375rem;
    line-height: 1.6;
    color: #4D869C;
    background: #EEF7FF;
    transition: all 0.3s ease;
    resize: vertical;
    font-family: inherit;
}

.form-control-textarea:focus {
    outline: none;
    border-color: #7AB2B2;
    background: white;
    box-shadow: 0 0 0 4px rgba(122, 178, 178, 0.1);
}

.form-control-textarea::placeholder {
    color: #7AB2B2;
    line-height: 1.6;
}

.textarea-info {
    display: flex;
    justify-content: flex-end;
    margin-top: 0.5rem;
}

.char-counter {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #7AB2B2;
    font-size: 0.875rem;
}

/* Alert Info */
.alert-info {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 1rem 1.25rem;
    background: #fef3c7;
    border-left: 4px solid #fbbf24;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.alert-info i {
    color: #f59e0b;
    font-size: 1.125rem;
    flex-shrink: 0;
    margin-top: 0.125rem;
}

.alert-info span {
    color: #92400e;
    font-size: 0.875rem;
    line-height: 1.5;
}

/* Tips Card */
.tips-card {
    margin-top: 1.5rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, #EEF7FF 0%, #CDE8E5 100%);
    border-radius: 12px;
    border: 2px solid #7AB2B2;
}

.tips-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 700;
    font-size: 0.9375rem;
    color: #4D869C;
    margin-bottom: 0.875rem;
}

.tips-header i {
    color: #fbbf24;
    font-size: 1.125rem;
}

.tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
}

.tips-list li {
    display: flex;
    align-items: flex-start;
    gap: 0.625rem;
}

.tips-list li i {
    color: #10b981;
    font-size: 1rem;
    margin-top: 0.125rem;
    flex-shrink: 0;
}

.tips-list li span {
    color: #4D869C;
    font-size: 0.875rem;
    line-height: 1.5;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding: 1.5rem 2rem;
    background: #EEF7FF;
    border-top: 1px solid #CDE8E5;
}

.btn-cancel {
    padding: 0.75rem 1.5rem;
    background: white;
    color: #7AB2B2;
    border: 2px solid #CDE8E5;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-cancel:hover {
    background: #EEF7FF;
    border-color: #7AB2B2;
    color: #4D869C;
    transform: translateY(-2px);
}

.btn-submit {
    padding: 0.75rem 1.75rem;
    background: linear-gradient(135deg, #7AB2B2 0%, #4D869C 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(77, 134, 156, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-container {
        padding: 1rem;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .header-content {
        width: 100%;
    }

    .page-title {
        font-size: 1.5rem;
    }

    .section-card {
        padding: 1.5rem;
    }

    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .student-display {
        flex-direction: column;
        text-align: center;
    }

    .form-actions {
        flex-direction: column-reverse;
        padding: 1.25rem 1.5rem;
    }

    .btn-cancel,
    .btn-submit {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .header-icon {
        width: 56px;
        height: 56px;
        font-size: 1.75rem;
    }

    .student-avatar {
        width: 48px;
        height: 48px;
        font-size: 1.25rem;
    }

    .problem-badge {
        width: 36px;
        height: 36px;
        font-size: 1rem;
    }
}
</style>

<script>
// Character counter
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.querySelector('.form-control-textarea');
    const charCount = document.getElementById('charCount');
    
    if (textarea && charCount) {
        textarea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
        });
    }
});

// Confirm before leaving if form has changes
let formChanged = false;
const form = document.querySelector('form');
const textarea = document.querySelector('.form-control-textarea');

if (textarea) {
    const originalValue = textarea.value;
    
    textarea.addEventListener('input', function() {
        formChanged = this.value !== originalValue;
    });
    
    form?.addEventListener('submit', function() {
        formChanged = false;
    });
    
    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
}
</script>
@endsection