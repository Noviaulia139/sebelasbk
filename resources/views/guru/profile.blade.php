@extends('layouts.guru')

@section('content')
<div class="profil-guru-container">
    <!-- Page Header -->
    <div class="page-header-profil-guru">
        <div class="header-content-profil-guru">
           
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert-success-profil-guru">
        <div class="alert-icon-profil-guru">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="alert-content-profil-guru">
            <h5>Berhasil Diperbarui!</h5>
            <p>{{ session('success') }}</p>
        </div>
        <button class="alert-close-profil-guru" onclick="this.parentElement.remove()">
            <i class="bi bi-x"></i>
        </button>
    </div>
    @endif

    <!-- Profile Card -->
    <div class="profile-card-guru">
        <form action="/guru/profil/update" method="POST" enctype="multipart/form-data" id="profileFormGuru">
            @csrf
            <input type="hidden" name="id_guru" value="{{ $guru->id_guru }}">
            
            <div class="row g-4">
                <!-- Photo Section -->
                <div class="col-lg-4">
                    <div class="photo-section-guru">
                        <div class="photo-header-guru">
                            <i class="bi bi-image-fill"></i>
                            <span>Foto Profil</span>
                        </div>
                        
                        <div class="photo-wrapper-guru">
                            <div class="photo-container-guru">
                                <img 
                                    src="{{ $guru->foto ? asset('foto_guru/'.$guru->foto) : 'https://ui-avatars.com/api/?name='.$guru->nama.'&background=4D869C&color=fff&size=300' }}"
                                    alt="Foto Profil"
                                    class="profile-photo-guru"
                                    id="photoPreviewGuru"
                                >
                                <div class="photo-overlay-guru">
                                    <i class="bi bi-camera-fill"></i>
                                    <span>Ubah Foto</span>
                                </div>
                            </div>
                        </div>

                        <div class="photo-upload-guru">
                            <label for="photoInputGuru" class="upload-label-guru">
                                <i class="bi bi-cloud-upload-fill"></i>
                                <span>Pilih Foto Baru</span>
                                <input 
                                    type="file" 
                                    name="foto" 
                                    id="photoInputGuru" 
                                    class="photo-input-guru"
                                    accept="image/*"
                                >
                            </label>
                            
                        </div>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="col-lg-8">
                    <div class="info-section-guru">
                        <div class="info-header-guru">
                            <i class="bi bi-person-badge-fill"></i>
                            <span>Informasi Pribadi</span>
                        </div>

                        <div class="info-body-guru">
                            <!-- Nama -->
                            <div class="form-group-profil-guru">
                                <label class="form-label-profil-guru">
                                    <i class="bi bi-person-fill"></i>
                                    Nama Lengkap
                                </label>
                                <div class="input-wrapper-disabled-guru">
                                    <input 
                                        type="text" 
                                        class="form-control-profil-guru disabled" 
                                        name="nama" 
                                        value="{{ $guru->nama }}" 
                                        disabled
                                    >
                                    <span class="input-badge-guru">Tidak dapat diubah</span>
                                </div>
                                <small class="input-hint-guru">Data ini dikelola oleh sistem</small>
                            </div>

                            <!-- NIP -->
                            <div class="form-group-profil-guru">
                                <label class="form-label-profil-guru">
                                    <i class="bi bi-card-text"></i>
                                    Nomor Induk Pegawai (NIP)
                                </label>
                                <div class="input-wrapper-disabled-guru">
                                    <input 
                                        type="text" 
                                        class="form-control-profil-guru disabled" 
                                        value="{{ $guru->nip }}" 
                                        disabled
                                    >
                                    <span class="input-badge-guru">Tidak dapat diubah</span>
                                </div>
                                <small class="input-hint-guru">Nomor identitas resmi pegawai</small>
                            </div>

                            <!-- Jabatan (if available) -->
                            @if(isset($guru->jabatan))
                            <div class="form-group-profil-guru">
                                <label class="form-label-profil-guru">
                                    <i class="bi bi-briefcase-fill"></i>
                                    Jabatan
                                </label>
                                <div class="input-wrapper-disabled-guru">
                                    <input 
                                        type="text" 
                                        class="form-control-profil-guru disabled" 
                                        value="{{ $guru->jabatan }}" 
                                        disabled
                                    >
                                    <span class="input-badge-guru">Tidak dapat diubah</span>
                                </div>
                            </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="form-actions-profil-guru">
                           
                                <button type="submit" class="btn-submit-profil-guru">
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
.profil-guru-container {
    padding: 2rem 0;
    max-width: 1100px;
    margin: 0 auto;
}

/* Page Header */
.page-header-profil-guru {
    margin-bottom: 2rem;
}

.header-content-profil-guru {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.header-icon-profil-guru {
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

.page-title-profil-guru {
    font-size: 1.875rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.page-subtitle-profil-guru {
    font-size: 0.9375rem;
    color: #64748b;
    margin: 0.5rem 0 0 0;
}

/* Success Alert */
.alert-success-profil-guru {
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

.alert-icon-profil-guru {
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

.alert-content-profil-guru {
    flex: 1;
}

.alert-content-profil-guru h5 {
    font-size: 1rem;
    font-weight: 700;
    color: #065f46;
    margin: 0 0 0.25rem 0;
}

.alert-content-profil-guru p {
    font-size: 0.875rem;
    color: #065f46;
    margin: 0;
}

.alert-close-profil-guru {
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

.alert-close-profil-guru:hover {
    background: white;
    transform: scale(1.1);
}

/* Profile Card */
.profile-card-guru {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    margin-bottom: 2rem;
}

/* Photo Section */
.photo-section-guru {
    padding: 2rem;
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    border-right: 1px solid var(--color-mint);
    height: 100%;
}

.photo-header-guru {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-dark-teal);
    margin-bottom: 1.5rem;
}

.photo-header-guru i {
    color: var(--color-teal);
    font-size: 1.125rem;
}

.photo-wrapper-guru {
    margin-bottom: 1.5rem;
}

.photo-container-guru {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(77, 134, 156, 0.2);
    border: 3px solid white;
}

.profile-photo-guru {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-overlay-guru {
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

.photo-container-guru:hover .photo-overlay-guru {
    opacity: 1;
}

.photo-overlay-guru i {
    font-size: 2rem;
}

.photo-overlay-guru span {
    font-weight: 600;
    font-size: 0.9375rem;
}

.photo-upload-guru {
    text-align: center;
}

.upload-label-guru {
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

.upload-label-guru:hover {
    border-color: var(--color-dark-teal);
    background: var(--color-light-blue);
    color: var(--color-dark-teal);
}

.upload-label-guru i {
    font-size: 1.5rem;
}

.photo-input-guru {
    display: none;
}

.upload-hint-guru {
    margin-top: 0.75rem;
    font-size: 0.8125rem;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.375rem;
}

/* Info Section */
.info-section-guru {
    padding: 2rem;
}

.info-header-guru {
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

.info-header-guru i {
    color: var(--color-teal);
    font-size: 1.125rem;
}

.info-body-guru {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group-profil-guru {
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
}

.form-label-profil-guru {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9375rem;
    font-weight: 700;
    color: var(--color-dark-teal);
}

.form-label-profil-guru i {
    color: var(--color-teal);
    font-size: 1rem;
}

.input-wrapper-disabled-guru {
    position: relative;
}

.form-control-profil-guru {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--color-mint);
    border-radius: 10px;
    font-size: 0.9375rem;
    color: #1e293b;
    background: white;
    transition: all 0.3s ease;
}

.form-control-profil-guru.disabled {
    background: linear-gradient(135deg, var(--color-light-blue) 0%, #f8fafc 100%);
    color: #64748b;
    cursor: not-allowed;
}

.input-badge-guru {
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

.input-hint-guru {
    font-size: 0.8125rem;
    color: #94a3b8;
    margin-top: 0.25rem;
}

/* Form Actions */
.form-actions-profil-guru {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--color-mint);
}

.btn-cancel-profil-guru {
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

.btn-cancel-profil-guru:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: #475569;
}

.btn-submit-profil-guru {
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

.btn-submit-profil-guru:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(77, 134, 156, 0.4);
}

/* Info Note */
.info-note-guru {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    border-radius: 12px;
    border: 1px solid var(--color-mint);
}

.note-icon-info-guru {
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

.note-content-info-guru h6 {
    font-size: 0.9375rem;
    font-weight: 700;
    color: var(--color-dark-teal);
    margin: 0 0 0.375rem 0;
}

.note-content-info-guru p {
    font-size: 0.875rem;
    color: #64748b;
    margin: 0;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 991px) {
    .photo-section-guru {
        border-right: none;
        border-bottom: 1px solid var(--color-mint);
    }
}

@media (max-width: 768px) {
    .profil-guru-container {
        padding: 1rem;
    }

    .header-content-profil-guru {
        flex-direction: column;
        text-align: center;
    }

    .page-title-profil-guru {
        font-size: 1.5rem;
    }

    .photo-section-guru,
    .info-section-guru {
        padding: 1.5rem;
    }

    .photo-container-guru {
        width: 160px;
        height: 160px;
    }

    .form-actions-profil-guru {
        flex-direction: column-reverse;
    }

    .btn-cancel-profil-guru,
    .btn-submit-profil-guru {
        width: 100%;
        justify-content: center;
    }

    .input-badge-guru {
        position: static;
        display: block;
        margin-top: 0.5rem;
        width: fit-content;
    }

    .alert-success-profil-guru {
        flex-direction: column;
        text-align: center;
    }

    .info-note-guru {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .header-icon-profil-guru {
        width: 56px;
        height: 56px;
        font-size: 1.75rem;
    }

    .photo-container-guru {
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

.profile-card-guru,
.info-note-guru {
    animation: fadeIn 0.5s ease-out;
}
</style>

<script>
// Photo preview
document.getElementById('photoInputGuru')?.addEventListener('change', function(e) {
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
            document.getElementById('photoPreviewGuru').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Form submit confirmation
document.getElementById('profileFormGuru')?.addEventListener('submit', function(e) {
    const photoInput = document.getElementById('photoInputGuru');
    
    if (!photoInput.files.length) {
        e.preventDefault();
        alert('Silakan pilih foto terlebih dahulu!');
        return;
    }
    
    // Confirm submission
    if (!confirm('Apakah Anda yakin ingin menyimpan perubahan?')) {
        e.preventDefault();
    }
});

// Auto-hide success alert after 5 seconds
setTimeout(function() {
    const alert = document.querySelector('.alert-success-profil-guru');
    if (alert) {
        alert.style.transition = 'opacity 0.5s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    }
}, 5000);
</script>

@endsection