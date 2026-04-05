@extends('layouts.siswa')

@section('content')
<div class="profil-container">
    <!-- Page Header -->
    <div class="page-header-profil">
        <div class="header-content-profil">
            <div class="header-icon-profil">
                <i class="bi bi-person-circle"></i>
            </div>
            <div>
                <h1 class="page-title-profil">Profil Saya</h1>
                <p class="page-subtitle-profil">Kelola informasi profil dan foto Anda</p>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert-success-custom">
        <div class="alert-icon-success">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-content-success">
            <h5>Berhasil!</h5>
            <p>{{ session('success') }}</p>
        </div>
        <button class="alert-close" onclick="this.parentElement.remove()">
            <i class="bi bi-x"></i>
        </button>
    </div>
    @endif

    <!-- Profile Card -->
    <div class="profile-card">
        <form action="/siswa/profil/update" method="POST" enctype="multipart/form-data" id="profileForm">
            @csrf
            <input type="hidden" name="id_siswa" value="{{ $siswa->id_siswa }}">
            
            <div class="row g-4">
                <!-- Photo Section -->
                <div class="col-lg-4">
                    <div class="photo-section">
                        <div class="photo-header">
                            <i class="bi bi-image-fill"></i>
                            <span>Foto Profil</span>
                        </div>
                        
                        <div class="photo-wrapper">
                            <div class="photo-container">
                                <img 
                                    src="{{ $siswa->foto ? asset('foto_siswa/'.$siswa->foto) : 'https://ui-avatars.com/api/?name='.$siswa->nama.'&background=4D869C&color=fff&size=300' }}"
                                    alt="Foto Profil"
                                    class="profile-photo"
                                    id="photoPreview"
                                >
                                <div class="photo-overlay">
                                    <i class="bi bi-camera-fill"></i>
                                    <span>Ubah Foto</span>
                                </div>
                            </div>
                        </div>

                        <div class="photo-upload">
                            <label for="photoInput" class="upload-label">
                                <i class="bi bi-cloud-upload-fill"></i>
                                <span>Pilih Foto Baru</span>
                                <input 
                                    type="file" 
                                    name="foto" 
                                    id="photoInput" 
                                    class="photo-input"
                                    accept="image/*"
                                >
                            </label>
                            
                        </div>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="col-lg-8">
                    <div class="info-section">
                        <div class="info-header">
                            <i class="bi bi-person-badge-fill"></i>
                            <span>Informasi Pribadi</span>
                        </div>

                        <div class="info-body">
                            <!-- Nama -->
                            <div class="form-group-profil">
                                <label class="form-label-profil">
                                    <i class="bi bi-person-fill"></i>
                                    Nama Lengkap
                                </label>
                                <div class="input-wrapper-disabled">
                                    <input 
                                        type="text" 
                                        class="form-control-profil disabled" 
                                        name="nama" 
                                        value="{{ $siswa->nama }}" 
                                        disabled
                                    >
                                    <span class="input-badge">Tidak dapat diubah</span>
                                </div>
                                <small class="input-hint">Data ini dikelola oleh sistem</small>
                            </div>

                            <!-- NIS -->
                            <div class="form-group-profil">
                                <label class="form-label-profil">
                                    <i class="bi bi-card-text"></i>
                                    Nomor Induk Siswa (NIS)
                                </label>
                                <div class="input-wrapper-disabled">
                                    <input 
                                        type="text" 
                                        class="form-control-profil disabled" 
                                        value="{{ $siswa->nis }}" 
                                        disabled
                                    >
                                    <span class="input-badge">Tidak dapat diubah</span>
                                </div>
                                <small class="input-hint">Nomor identitas resmi sekolah</small>
                            </div>

                            <!-- Kelas (if available) -->
                            @if(isset($siswa->kelas))
                            <div class="form-group-profil">
                                <label class="form-label-profil">
                                    <i class="bi bi-book-fill"></i>
                                    Kelas
                                </label>
                                <div class="input-wrapper-disabled">
                                    <input 
                                        type="text" 
                                        class="form-control-profil disabled" 
                                        value="{{ $siswa->kelas }}" 
                                        disabled
                                    >
                                    <span class="input-badge">Tidak dapat diubah</span>
                                </div>
                            </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="form-actions-profil">
                                <a href="{{ route('siswa.dashboard') }}" class="btn-cancel-profil">
                                    <i class="bi bi-arrow-left-circle"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn-submit-profil">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Info Note -->
    
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
.profil-container {
    padding: 2rem 0;
    max-width: 1100px;
    margin: 0 auto;
}

/* Page Header */
.page-header-profil {
    margin-bottom: 2rem;
}

.header-content-profil {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.header-icon-profil {
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

.page-title-profil {
    font-size: 1.875rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.page-subtitle-profil {
    font-size: 0.9375rem;
    color: #64748b;
    margin: 0.5rem 0 0 0;
}

/* Success Alert */
.alert-success-custom {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    border-radius: 12px;
    border-left: 4px solid #10b981;
    margin-bottom: 2rem;
    position: relative;
}

.alert-icon-success {
    width: 40px;
    height: 40px;
    background: #10b981;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.alert-content-success {
    flex: 1;
}

.alert-content-success h5 {
    font-size: 1rem;
    font-weight: 700;
    color: #065f46;
    margin: 0 0 0.25rem 0;
}

.alert-content-success p {
    font-size: 0.875rem;
    color: #065f46;
    margin: 0;
}

.alert-close {
    width: 32px;
    height: 32px;
    background: rgba(255, 255, 255, 0.5);
    border: none;
    border-radius: 6px;
    color: #065f46;
    font-size: 1.25rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.alert-close:hover {
    background: white;
    transform: scale(1.1);
}

/* Profile Card */
.profile-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    margin-bottom: 2rem;
}

/* Photo Section */
.photo-section {
    padding: 2rem;
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    border-right: 1px solid var(--color-mint);
    height: 100%;
}

.photo-header {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-dark-teal);
    margin-bottom: 1.5rem;
}

.photo-header i {
    color: var(--color-teal);
    font-size: 1.125rem;
}

.photo-wrapper {
    margin-bottom: 1.5rem;
}

.photo-container {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(77, 134, 156, 0.2);
    border: 3px solid white;
}

.profile-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(77, 134, 156, 0.9) 0%, rgba(122, 178, 178, 0.9) 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    color: white;
    opacity: 0;
    transition: all 0.3s ease;
}

.photo-container:hover .photo-overlay {
    opacity: 1;
}

.photo-overlay i {
    font-size: 2rem;
}

.photo-overlay span {
    font-weight: 600;
    font-size: 0.9375rem;
}

.photo-upload {
    text-align: center;
}

.upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    background: white;
    border: 2px dashed var(--color-teal);
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: var(--color-dark-teal);
    font-weight: 600;
}

.upload-label:hover {
    border-color: var(--color-dark-teal);
    background: var(--color-light-blue);
    color: var(--color-dark-teal);
}

.upload-label i {
    font-size: 1.5rem;
}

.photo-input {
    display: none;
}

.upload-hint {
    margin-top: 0.75rem;
    font-size: 0.8125rem;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.375rem;
}

/* Info Section */
.info-section {
    padding: 2rem;
}

.info-header {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-dark-teal);
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--color-mint);
}

.info-header i {
    color: var(--color-teal);
    font-size: 1.125rem;
}

.info-body {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group-profil {
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
}

.form-label-profil {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9375rem;
    font-weight: 700;
    color: var(--color-dark-teal);
}

.form-label-profil i {
    color: var(--color-teal);
    font-size: 1rem;
}

.input-wrapper-disabled {
    position: relative;
}

.form-control-profil {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--color-mint);
    border-radius: 10px;
    font-size: 0.9375rem;
    color: #1e293b;
    background: white;
    transition: all 0.3s ease;
}

.form-control-profil.disabled {
    background: linear-gradient(135deg, var(--color-light-blue) 0%, #f8fafc 100%);
    color: #64748b;
    cursor: not-allowed;
}

.input-badge {
    position: absolute;
    top: 50%;
    right: 1rem;
    transform: translateY(-50%);
    padding: 0.25rem 0.75rem;
    background: #fee2e2;
    color: #991b1b;
    border-radius: 6px;
    font-size: 0.6875rem;
    font-weight: 600;
}

.input-hint {
    font-size: 0.8125rem;
    color: #94a3b8;
    margin-top: 0.25rem;
}

/* Form Actions */
.form-actions-profil {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--color-mint);
}

.btn-cancel-profil {
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
}

.btn-cancel-profil:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: #475569;
}

.btn-submit-profil {
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

.btn-submit-profil:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(77, 134, 156, 0.4);
}

/* Info Note */
.info-note {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    border-radius: 12px;
    border: 1px solid var(--color-mint);
}

.note-icon-info {
    width: 40px;
    height: 40px;
    background: white;
    border: 2px solid var(--color-mint);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #10b981;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.note-content-info h6 {
    font-size: 0.9375rem;
    font-weight: 700;
    color: var(--color-dark-teal);
    margin: 0 0 0.375rem 0;
}

.note-content-info p {
    font-size: 0.875rem;
    color: #64748b;
    margin: 0;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 991px) {
    .photo-section {
        border-right: none;
        border-bottom: 1px solid var(--color-mint);
    }
}

@media (max-width: 768px) {
    .profil-container {
        padding: 1rem;
    }

    .header-content-profil {
        flex-direction: column;
        text-align: center;
    }

    .page-title-profil {
        font-size: 1.5rem;
    }

    .photo-section,
    .info-section {
        padding: 1.5rem;
    }

    .photo-container {
        width: 160px;
        height: 160px;
    }

    .form-actions-profil {
        flex-direction: column-reverse;
    }

    .btn-cancel-profil,
    .btn-submit-profil {
        width: 100%;
        justify-content: center;
    }

    .input-badge {
        position: static;
        display: block;
        margin-top: 0.5rem;
        width: fit-content;
    }

    .alert-success-custom {
        flex-direction: column;
        text-align: center;
    }

    .info-note {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .header-icon-profil {
        width: 56px;
        height: 56px;
        font-size: 1.75rem;
    }

    .photo-container {
        width: 140px;
        height: 140px;
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

.profile-card,
.info-note {
    animation: fadeIn 0.5s ease-out;
}
</style>

<script>
// Photo preview
document.getElementById('photoInput')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Check file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar! Maksimal 2MB');
            this.value = '';
            return;
        }
        
        // Check file type
        if (!file.type.match('image.*')) {
            alert('File harus berupa gambar!');
            this.value = '';
            return;
        }
        
        // Preview image
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Form submit confirmation
document.getElementById('profileForm')?.addEventListener('submit', function(e) {
    const photoInput = document.getElementById('photoInput');
    
    // Confirm submission
    if (!confirm('Apakah Anda yakin ingin menyimpan perubahan?')) {
        e.preventDefault();
    }
});

// Auto-hide success alert after 5 seconds
setTimeout(function() {
    const alert = document.querySelector('.alert-success-custom');
    if (alert) {
        alert.style.transition = 'opacity 0.5s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    }
}, 5000);
</script>

@endsection