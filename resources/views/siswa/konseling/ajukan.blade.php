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

    {{-- ✅ NOTIFIKASI ERROR (duplikat / gagal) --}}
    @if(session('error'))
    <div class="alert-notif alert-notif--error" id="alertError">
        <div class="alert-notif__icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-notif__body">
            <h5>Pengajuan Gagal</h5>
            <p>{{ session('error') }}</p>
        </div>
        <button class="alert-notif__close" onclick="this.parentElement.remove()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    @endif

    {{-- ✅ NOTIFIKASI SUCCESS --}}
    @if(session('success'))
    <div class="alert-notif alert-notif--success" id="alertSuccess">
        <div class="alert-notif__icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-notif__body">
            <h5>Berhasil!</h5>
            <p>{{ session('success') }}</p>
        </div>
        <button class="alert-notif__close" onclick="this.parentElement.remove()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    @endif

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

    {{-- ALERT ERROR VALIDASI --}}
@if($errors->any())
<div class="alert-notif alert-notif--error" id="alertError">
    <div class="alert-notif__icon">
        <i class="bi bi-exclamation-triangle-fill"></i>
    </div>
    <div class="alert-notif__body">
        <h5>Terjadi Kesalahan!</h5>
        <ul style="margin:0; padding-left:18px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <button class="alert-notif__close" onclick="this.parentElement.remove()">
        <i class="bi bi-x-lg"></i>
    </button>
</div>
@endif
<div class="info-alert">
    <div class="alert-icon">
        <i class="bi bi-person-lines-fill"></i>
    </div>
    <div class="alert-content">
        <h5>Informasi Anda</h5>
        <p><b>Kelas:</b> {{ $kelas->nama_kelas }} ({{ $kelas->jurusan }})</p>
        <p><b>Guru BK:</b> {{ $guru->nama }}</p>
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

        <form action="{{ route('siswa.konseling.store') }}" method="POST" class="konseling-form" id="konselingForm" novalidate>
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
    id="masalahTextarea"
    class="form-control-ajukan @error('masalah') is-invalid @enderror" 
    rows="8"
    placeholder="Jelaskan masalah yang Anda hadapi..."
>{{ old('masalah') }}</textarea>

@error('masalah')
    <small class="error-message-ajukan">{{ $message }}</small>
@enderror
                <div class="textarea-footer-ajukan">
                    <span class="char-counter" id="charCounterWrapper">
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
                <button type="submit" class="btn-submit-ajukan" id="btnSubmit">
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

/* =============================================
   ALERT NOTIFIKASI (error & success)
   ============================================= */
.alert-notif {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem 1.25rem 1.25rem 1.25rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    position: relative;
    animation: slideDown 0.4s ease-out;
}

.alert-notif--error {
    background: linear-gradient(135deg, #fff1f2 0%, #fee2e2 100%);
    border-left: 4px solid #dc2626;
}

.alert-notif--success {
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    border-left: 4px solid #16a34a;
}

.alert-notif__icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.alert-notif--error .alert-notif__icon {
    background: #dc2626;
}

.alert-notif--success .alert-notif__icon {
    background: #16a34a;
}

.alert-notif__body {
    flex: 1;
}

.alert-notif__body h5 {
    font-size: 1rem;
    font-weight: 700;
    margin: 0 0 0.375rem 0;
}

.alert-notif--error .alert-notif__body h5 { color: #991b1b; }
.alert-notif--success .alert-notif__body h5 { color: #166534; }

.alert-notif__body p {
    font-size: 0.875rem;
    margin: 0;
    line-height: 1.6;
}

.alert-notif--error .alert-notif__body p { color: #991b1b; }
.alert-notif--success .alert-notif__body p { color: #166534; }

.alert-notif__close {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    opacity: 0.6;
    transition: opacity 0.2s;
    flex-shrink: 0;
}

.alert-notif--error .alert-notif__close { color: #991b1b; }
.alert-notif--success .alert-notif__close { color: #166534; }

.alert-notif__close:hover {
    opacity: 1;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-12px); }
    to   { opacity: 1; transform: translateY(0); }
}

.alert-error-ajukan {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: #fee2e2;
    border-left: 5px solid #dc2626;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    align-items: flex-start;
}

.alert-icon-error-ajukan {
    background: #dc2626;
    color: white;
    padding: 10px;
    border-radius: 8px;
}

.alert-content-error-ajukan h5 {
    margin: 0 0 5px;
    color: #7f1d1d;
}

.alert-content-error-ajukan ul {
    margin: 0;
    padding-left: 20px;
    color: #7f1d1d;
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
    box-sizing: border-box;
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
    transition: color 0.2s;
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

.btn-submit-ajukan:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(77, 134, 156, 0.4);
}

.btn-submit-ajukan:active:not(:disabled) {
    transform: translateY(0);
}

.btn-submit-ajukan:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
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
    .note-section,
    .alert-notif {
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
    .note-icon,
    .alert-notif__icon {
        width: 36px;
        height: 36px;
        font-size: 1.125rem;
    }
}

/* Animation */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

.form-card-ajukan,
.info-alert,
.note-section {
    animation: fadeInUp 0.5s ease-out;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const textarea     = document.getElementById('masalahTextarea');
    const charCount    = document.getElementById('charCount');
    const charWrapper  = document.getElementById('charCounterWrapper');
    const form         = document.getElementById('konselingForm');
    const btn          = document.getElementById('btnSubmit');

    let isSubmitting = false;

    // ✅ FUNCTION ALERT (WAJIB ADA)
    function showAlert(message) {
        const container = document.querySelector('.ajukan-container');

        const alert = document.createElement('div');
        alert.className = 'alert-notif alert-notif--error';
        alert.innerHTML = `
            <div class="alert-notif__icon">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <div class="alert-notif__body">
                <h5>Terjadi Kesalahan!</h5>
                <p>${message}</p>
            </div>
        `;

        container.prepend(alert);

        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 4000);
    }

    // ── Character counter ──────────────────────────────
    if (textarea && charCount) {
        textarea.addEventListener('input', function () {
            const len = this.value.length;
            charCount.textContent = len;
            charWrapper.style.color = len >= 20 ? '#059669' : '#64748b';
        });
    }

    // ── Warn before leave if form changed ──────────────
    let formChanged = false;
    textarea?.addEventListener('input', function () {
        formChanged = this.value.trim().length > 0;
    });

    window.addEventListener('beforeunload', function (e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    function showAlert(message) {
    const container = document.querySelector('.ajukan-container');

    const alert = document.createElement('div');
    alert.className = 'alert-notif alert-notif--error';
    alert.innerHTML = `
        <div class="alert-notif__icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-notif__body">
            <h5>Terjadi Kesalahan!</h5>
            <p>${message}</p>
        </div>
    `;

    container.prepend(alert);

    // 🔥 AUTO SCROLL KE ATAS
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });

    // auto hilang
    setTimeout(() => {
        alert.style.transition = 'opacity 0.5s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    }, 4000);
}

    // ── Submit handler ──────────────────────────────
    form?.addEventListener('submit', function (e) {
        const masalah = textarea.value.trim();

        // ❗ VALIDASI KOSONG
        if (masalah === '') {
            e.preventDefault();
            showAlert("Masalah tidak boleh kosong!");
            return;
        }

        // ❗ VALIDASI MINIMAL
        if (masalah.length < 20) {
            e.preventDefault();
            showAlert("Minimal 20 karakter!");
            return;
        }

        // ❗ CEGAH DOUBLE SUBMIT
        if (isSubmitting) {
            e.preventDefault();
            return;
        }

        isSubmitting = true;
        formChanged = false;

        btn.disabled = true;
        btn.style.pointerEvents = 'none';
        btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Mengirim...';
    });

    // ── Auto dismiss alert lama ─────────────────────
    ['alertError', 'alertSuccess'].forEach(function (id) {
        const el = document.getElementById(id);
        if (el) {
            setTimeout(function () {
                el.style.transition = 'opacity 0.5s ease';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            }, 6000);
        }
    });

});
</script>

@endsection