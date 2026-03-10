@extends('layouts.siswa')

@section('content')
<div class="ajukan-container">
    <!-- Page Header -->
    <div class="page-header-ajukan">
        <div class="header-content-ajukan">
            <div class="header-icon-ajukan">
                <i class="bi bi-chat-right-text-fill"></i>
            </div>
            <div>
                <h1 class="page-title-ajukan">Ajukan Konseling</h1>
                <p class="page-subtitle-ajukan">Sampaikan masalah Anda dan dapatkan solusi dari Guru BK</p>
            </div>
        </div>
    </div>

    <!-- Info Alert -->
    <div class="info-alert">
        <div class="alert-icon">
            <i class="bi bi-shield-check"></i>
        </div>
        <div class="alert-content">
            <h5>Privasi Terjaga</h5>
            <p>Semua informasi yang Anda sampaikan akan dijaga kerahasiaannya dan hanya dapat diakses oleh Guru BK.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card-ajukan">
        <div class="form-header-ajukan">
            <div class="form-header-content">
                <i class="bi bi-pencil-square"></i>
                <span>Form Pengajuan Konseling</span>
            </div>
            <span class="form-badge">Wajib Diisi</span>
        </div>

        <form action="{{ route('siswa.konseling.store') }}" method="POST" class="konseling-form">
            @csrf

            <!-- Masalah Field -->
            <div class="form-group-ajukan">
                <label class="form-label-ajukan">
                    <i class="bi bi-chat-text-fill"></i>
                    Ceritakan Masalah Anda
                    <span class="required-mark">*</span>
                </label>
                <textarea 
                    name="masalah" 
                    class="form-control-ajukan" 
                    rows="8"
                    placeholder="Jelaskan masalah yang Anda hadapi dengan detail...&#10;&#10;Contoh:&#10;• Masalah belajar: Kesulitan memahami pelajaran matematika&#10;• Masalah keluarga: Komunikasi dengan orang tua&#10;• Masalah pertemanan: Konflik dengan teman sekelas&#10;• Masalah pribadi: Merasa cemas atau stress"
                    required
                ></textarea>
                <div class="textarea-footer-ajukan">
                    <span class="char-counter">
                        <i class="bi bi-textarea-t"></i>
                        <span id="charCount">0</span> karakter
                    </span>
                    <span class="help-text-inline">
                        <i class="bi bi-info-circle"></i>
                        Minimal 20 karakter
                    </span>
                </div>
            </div>

            <!-- Tips Section -->
            <div class="tips-box">
                <div class="tips-box-header">
                    <i class="bi bi-lightbulb-fill"></i>
                    <span>Tips Mengisi Formulir</span>
                </div>
                <ul class="tips-list-ajukan">
                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Jelaskan masalah secara jelas dan detail</span>
                    </li>
                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Sampaikan kapan masalah mulai terjadi</span>
                    </li>
                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Ceritakan dampak yang Anda rasakan</span>
                    </li>
                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Jangan ragu untuk terbuka, semua akan dijaga kerahasiaannya</span>
                    </li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions-ajukan">
                <a href="{{ route('siswa.dashboard') }}" class="btn-cancel-ajukan">
                    <i class="bi bi-x-circle"></i>
                    Batal
                </a>
                <button type="submit" class="btn-submit-ajukan">
                    <i class="bi bi-send-fill"></i>
                    Kirim Konseling
                </button>
            </div>
        </form>
    </div>

    <!-- Note Section -->
    <div class="note-section">
        <div class="note-icon">
            <i class="bi bi-clock-history"></i>
        </div>
        <div class="note-content">
            <h6>Apa Selanjutnya?</h6>
            <p>Setelah mengirim, Guru BK akan meninjau pengajuan Anda. Anda akan menerima notifikasi dan dapat melihat status di Dashboard.</p>
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

/* Container */
.ajukan-container {
    padding: 2rem 0;
    max-width: 900px;
    margin: 0 auto;
}

/* Page Header */
.page-header-ajukan {
    margin-bottom: 2rem;
}

.header-content-ajukan {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.header-icon-ajukan {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, var(--color-teal) 0%, var(--color-dark-teal) 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    box-shadow: 0 4px 16px rgba(77, 134, 156, 0.3);
    flex-shrink: 0;
}

.page-title-ajukan {
    font-size: 1.875rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.page-subtitle-ajukan {
    font-size: 0.9375rem;
    color: #64748b;
    margin: 0.5rem 0 0 0;
}

/* Info Alert */
.info-alert {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    border-radius: 12px;
    border-left: 4px solid var(--color-teal);
    margin-bottom: 2rem;
}

.alert-icon {
    width: 40px;
    height: 40px;
    background: var(--color-teal);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.alert-content {
    flex: 1;
}

.alert-content h5 {
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-dark-teal);
    margin: 0 0 0.375rem 0;
}

.alert-content p {
    font-size: 0.875rem;
    color: var(--color-dark-teal);
    margin: 0;
    line-height: 1.6;
}

/* Form Card */
.form-card-ajukan {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    margin-bottom: 2rem;
}

.form-header-ajukan {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-bottom: 2px solid #e2e8f0;
}

.form-header-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.125rem;
    font-weight: 700;
    color: #1e293b;
}

.form-header-content i {
    color: var(--color-teal);
    font-size: 1.25rem;
}

.form-badge {
    padding: 0.375rem 0.875rem;
    background: #fee2e2;
    color: #991b1b;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
}

/* Form */
.konseling-form {
    padding: 2rem;
}

.form-group-ajukan {
    margin-bottom: 2rem;
}

.form-label-ajukan {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.875rem;
}

.form-label-ajukan i {
    color: var(--color-teal);
    font-size: 1.125rem;
}

.required-mark {
    color: #dc2626;
    font-size: 1.125rem;
}

.form-control-ajukan {
    width: 100%;
    padding: 1.25rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 0.9375rem;
    line-height: 1.7;
    color: #1e293b;
    background: #fafbfc;
    transition: all 0.3s ease;
    resize: vertical;
    font-family: inherit;
}

.form-control-ajukan:focus {
    outline: none;
    border-color: var(--color-teal);
    background: white;
    box-shadow: 0 0 0 4px rgba(122, 178, 178, 0.1);
}

.form-control-ajukan::placeholder {
    color: #94a3b8;
    line-height: 1.7;
}

.textarea-footer-ajukan {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 0.75rem;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.char-counter {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #64748b;
    font-size: 0.875rem;
}

.char-counter i {
    color: #94a3b8;
}

.help-text-inline {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.8125rem;
    color: #64748b;
}

.help-text-inline i {
    color: var(--color-teal);
}

/* Tips Box */
.tips-box {
    padding: 1.5rem;
    background: linear-gradient(135deg, #fef9e7 0%, #fdeaa8 100%);
    border-radius: 12px;
    border: 2px solid #fcd34d;
    margin-bottom: 2rem;
}

.tips-box-header {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    font-size: 1rem;
    font-weight: 700;
    color: #92400e;
    margin-bottom: 1rem;
}

.tips-box-header i {
    color: #f59e0b;
    font-size: 1.25rem;
}

.tips-list-ajukan {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.tips-list-ajukan li {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    color: #92400e;
    font-size: 0.875rem;
    line-height: 1.6;
}

.tips-list-ajukan li i {
    color: #f59e0b;
    margin-top: 0.125rem;
    flex-shrink: 0;
    font-size: 1rem;
}

/* Form Actions */
.form-actions-ajukan {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

.btn-cancel-ajukan {
    padding: 0.875rem 1.75rem;
    background: white;
    color: #64748b;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9375rem;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
}

.btn-cancel-ajukan:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: #475569;
}

.btn-submit-ajukan {
    padding: 0.875rem 2rem;
    background: linear-gradient(135deg, var(--color-teal) 0%, var(--color-dark-teal) 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9375rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 12px rgba(77, 134, 156, 0.3);
}

.btn-submit-ajukan:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(77, 134, 156, 0.4);
}

.btn-submit-ajukan:active {
    transform: translateY(0);
}

/* Note Section */
.note-section {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.note-icon {
    width: 40px;
    height: 40px;
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-teal);
    font-size: 1.25rem;
    flex-shrink: 0;
}

.note-content h6 {
    font-size: 0.9375rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.375rem 0;
}

.note-content p {
    font-size: 0.875rem;
    color: #64748b;
    margin: 0;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .ajukan-container {
        padding: 1rem;
    }

    .header-content-ajukan {
        flex-direction: column;
        text-align: center;
    }

    .page-title-ajukan {
        font-size: 1.5rem;
    }

    .form-header-ajukan {
        flex-direction: column;
        gap: 0.75rem;
        align-items: flex-start;
    }

    .konseling-form {
        padding: 1.5rem;
    }

    .form-actions-ajukan {
        flex-direction: column-reverse;
    }

    .btn-cancel-ajukan,
    .btn-submit-ajukan {
        width: 100%;
        justify-content: center;
    }

    .textarea-footer-ajukan {
        flex-direction: column;
        align-items: flex-start;
    }

    .info-alert,
    .note-section {
        flex-direction: column;
    }
}

@media (max-width: 480px) {
    .header-icon-ajukan {
        width: 56px;
        height: 56px;
        font-size: 1.75rem;
    }

    .alert-icon,
    .note-icon {
        width: 36px;
        height: 36px;
        font-size: 1.125rem;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-card-ajukan,
.info-alert,
.note-section {
    animation: fadeInUp 0.5s ease-out;
}
</style>

<script>
// Character counter
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.querySelector('.form-control-ajukan');
    const charCount = document.getElementById('charCount');
    
    if (textarea && charCount) {
        textarea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
            
            // Change color based on minimum requirement
            if (this.value.length >= 20) {
                charCount.parentElement.style.color = '#059669';
            } else {
                charCount.parentElement.style.color = '#64748b';
            }
        });
    }
    
    // Form validation
    const form = document.querySelector('.konseling-form');
    form?.addEventListener('submit', function(e) {
        const masalah = textarea.value.trim();
        
        if (masalah.length < 20) {
            e.preventDefault();
            alert('Mohon jelaskan masalah Anda dengan lebih detail (minimal 20 karakter)');
            textarea.focus();
        }
    });
    
    // Confirm before leaving if form has changes
    let formChanged = false;
    
    textarea?.addEventListener('input', function() {
        formChanged = this.value.trim().length > 0;
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
});
</script>

@endsection