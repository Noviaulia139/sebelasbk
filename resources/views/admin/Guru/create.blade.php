@extends('admin.layout')

@section('content')
<div class="admin-guru-container">
    <!-- Page Header -->
    <div class="page-header-admin-guru">
        <div class="header-content-admin-guru">
            <div class="header-icon-admin-guru">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <div>
                <h1 class="page-title-admin-guru">Tambah Guru BK</h1>
                <p class="page-subtitle-admin-guru">Tambahkan data guru bimbingan konseling baru</p>
            </div>
        </div>
    </div>

   {{-- ALERT ERROR --}}
@if($errors->any())
<div class="alert-error-admin-guru">
    <div class="alert-icon-error-guru">
        <i class="bi bi-exclamation-triangle-fill"></i>
    </div>
    <div class="alert-content-error-guru">
        <h5>Terdapat Kesalahan!</h5>
        <ul class="error-list-guru">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <button class="alert-close-error-guru" onclick="this.parentElement.remove()">
        <i class="bi bi-x"></i>
    </button>
</div>
@endif

    <!-- Form Card -->
    <div class="form-card-admin-guru">
        <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data" id="guruFormCreate" novalidate>
            @csrf
            
            <div class="row g-4">
                <!-- Photo Section -->
                <div class="col-lg-4">
                    <div class="photo-section-admin-guru">
                        <div class="photo-header-admin-guru">
                            <i class="bi bi-image-fill"></i>
                            <span>Foto Profil</span>
                        </div>
                        
                        <div class="photo-wrapper-admin-guru">
                            <div class="photo-container-admin-guru">
                                <img 
                                    src="https://ui-avatars.com/api/?name=Guru+BK&background=4D869C&color=fff&size=300"
                                    alt="Preview Foto"
                                    class="profile-photo-admin-guru"
                                    id="photoPreviewCreate"
                                >
                                <div class="photo-overlay-admin-guru">
                                    <i class="bi bi-camera-fill"></i>
                                    <span>Upload Foto</span>
                                </div>
                            </div>
                        </div>

                        <div class="photo-upload-admin-guru">
                            <label for="photoInputCreate" class="upload-label-admin-guru">
                                <i class="bi bi-cloud-upload-fill"></i>
                                <span>Pilih Foto</span>
                                <input 
                                    type="file" 
                                    name="foto" 
                                    id="photoInputCreate" 
                                    class="photo-input-admin-guru"
                                    accept="image/*"
                                >
                            </label>
                            <small class="upload-hint-admin-guru">
                                <i class="bi bi-info-circle"></i>
                                Maksimal 2MB (JPG, PNG)
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="col-lg-8">
                    <div class="info-section-admin-guru">
                        <div class="info-header-admin-guru">
                            <i class="bi bi-person-badge-fill"></i>
                            <span>Informasi Guru</span>
                        </div>

                        <div class="info-body-admin-guru">
                            <!-- NIP -->
                            <div class="form-group-admin-guru">
                                <label class="form-label-admin-guru">
                                    <i class="bi bi-card-text"></i>
                                    Nomor Induk Pegawai (NIP)
                                    <span class="required-mark">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="nip"
                                    class="form-control-admin-guru @error('nip') is-invalid @enderror" 
                                    value="{{ old('nip') }}"
                                    placeholder="Masukkan NIP"
                                    required
                                >
                                @error('nip')
                                    <small class="error-message-admin-guru">{{ $message }}</small>
                                @enderror
                                <small class="input-hint-admin-guru">Nomor identitas resmi pegawai</small>
                            </div>

                            <!-- Nama -->
                            <div class="form-group-admin-guru">
                                <label class="form-label-admin-guru">
                                    <i class="bi bi-person-fill"></i>
                                    Nama Lengkap
                                    <span class="required-mark">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="nama"
                                    class="form-control-admin-guru @error('nama') is-invalid @enderror" 
                                    value="{{ old('nama') }}"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                >
                                @error('nama')
                                    <small class="error-message-admin-guru">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group-admin-guru">
                                <label class="form-label-admin-guru">
                                    <i class="bi bi-key-fill"></i>
                                    Password
                                    <span class="required-mark">*</span>
                                </label>
                                <div class="password-wrapper-admin-guru">
                                    <input 
                                        type="password" 
                                        name="password"
                                        id="passwordInputCreate"
                                        class="form-control-admin-guru @error('password') is-invalid @enderror" 
                                        placeholder="Masukkan password"
                                        autocomplete="new-password"
                                        required
                                    >
                                    <button type="button" class="password-toggle-admin-guru" onclick="togglePassword('passwordInputCreate', this)">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <small class="error-message-admin-guru">{{ $message }}</small>
                                @enderror
                                <small class="input-hint-admin-guru">Password untuk login guru BK</small>
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-actions-admin-guru">
                                <a href="{{ route('admin.guru.index') }}" class="btn-cancel-admin-guru">
                                    <i class="bi bi-x-circle-fill"></i>
                                    Batal
                                </a>
                                <button type="submit" class="btn-submit-admin-guru">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Simpan Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
.admin-guru-container {
    padding: 2rem 0;
    max-width: 1100px;
    margin: 0 auto;
}

/* Page Header */
.page-header-admin-guru {
    margin-bottom: 2rem;
}

.header-content-admin-guru {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.header-icon-admin-guru {
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

.page-title-admin-guru {
    font-size: 1.875rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.page-subtitle-admin-guru {
    font-size: 0.9375rem;
    color: #64748b;
    margin: 0.5rem 0 0 0;
}
/* Alert Error */
.alert-error-admin-guru {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    border-radius: 12px;
    border-left: 4px solid #dc2626;
    margin-bottom: 2rem;
    position: relative;
}

.alert-icon-error-guru {
    width: 40px;
    height: 40px;
    background: #dc2626;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.alert-content-error-guru {
    flex: 1;
}

.alert-content-error-guru h5 {
    font-size: 1rem;
    font-weight: 700;
    color: #7f1d1d;
    margin: 0 0 0.5rem 0;
}

.error-list-guru {
    margin: 0;
    padding-left: 1.25rem;
    color: #7f1d1d;
    font-size: 0.875rem;
}

.error-list-guru li {
    margin-bottom: 0.25rem;
}

.alert-close-error-guru {
    width: 32px;
    height: 32px;
    background: rgba(255, 255, 255, 0.5);
    border: none;
    border-radius: 6px;
    color: #7f1d1d;
    font-size: 1.25rem;
    cursor: pointer;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.alert-close-error-guru:hover {
    background: white;
    transform: scale(1.1);
}
/* Form Card */
.form-card-admin-guru {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    overflow: hidden;
}

/* Photo Section */
.photo-section-admin-guru {
    padding: 2rem;
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    border-right: 1px solid var(--color-mint);
    height: 100%;
}

.photo-header-admin-guru {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-dark-teal);
    margin-bottom: 1.5rem;
}

.photo-header-admin-guru i {
    color: var(--color-teal);
    font-size: 1.125rem;
}

.photo-wrapper-admin-guru {
    margin-bottom: 1.5rem;
}

.photo-container-admin-guru {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(77, 134, 156, 0.2);
    border: 3px solid white;
}

.profile-photo-admin-guru {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-overlay-admin-guru {
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

.photo-container-admin-guru:hover .photo-overlay-admin-guru {
    opacity: 1;
}

.photo-overlay-admin-guru i {
    font-size: 2rem;
}

.photo-overlay-admin-guru span {
    font-weight: 600;
    font-size: 0.9375rem;
}

.photo-upload-admin-guru {
    text-align: center;
}

.upload-label-admin-guru {
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

.upload-label-admin-guru:hover {
    border-color: var(--color-dark-teal);
    background: var(--color-light-blue);
}

.upload-label-admin-guru i {
    font-size: 1.5rem;
}

.photo-input-admin-guru {
    display: none;
}

.upload-hint-admin-guru {
    margin-top: 0.75rem;
    font-size: 0.8125rem;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.375rem;
}

/* Info Section */
.info-section-admin-guru {
    padding: 2rem;
}

.info-header-admin-guru {
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

.info-header-admin-guru i {
    color: var(--color-teal);
    font-size: 1.125rem;
}

.info-body-admin-guru {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group-admin-guru {
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
}

.form-label-admin-guru {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9375rem;
    font-weight: 700;
    color: var(--color-dark-teal);
}

.form-label-admin-guru i {
    color: var(--color-teal);
    font-size: 1rem;
}

.required-mark {
    color: #dc2626;
    margin-left: 0.25rem;
}

.form-control-admin-guru {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--color-mint);
    border-radius: 10px;
    font-size: 0.9375rem;
    color: #1e293b;
    background: white;
    transition: all 0.3s ease;
}

.form-control-admin-guru:focus {
    outline: none;
    border-color: var(--color-teal);
    box-shadow: 0 0 0 3px rgba(122, 178, 178, 0.1);
}

.form-control-admin-guru.is-invalid {
    border-color: #dc2626;
}

.password-wrapper-admin-guru {
    position: relative;
}

.password-wrapper-admin-guru .form-control-admin-guru {
    padding-right: 3rem;
}

.password-toggle-admin-guru {
    position: absolute;
    top: 50%;
    right: 1rem;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--color-teal);
    font-size: 1.125rem;
    cursor: pointer;
    padding: 0.25rem;
    transition: all 0.3s ease;
}

.password-toggle-admin-guru:hover {
    color: var(--color-dark-teal);
}

.input-hint-admin-guru {
    font-size: 0.8125rem;
    color: #94a3b8;
    margin-top: 0.25rem;
}

.error-message-admin-guru {
    font-size: 0.8125rem;
    color: #dc2626;
    margin-top: 0.25rem;
    display: block;
}

/* Form Actions */
.form-actions-admin-guru {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--color-mint);
}

.btn-cancel-admin-guru {
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

.btn-cancel-admin-guru:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: #475569;
}

.btn-submit-admin-guru {
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

.btn-submit-admin-guru:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(77, 134, 156, 0.4);
}

/* Responsive Design */
@media (max-width: 991px) {
    .photo-section-admin-guru {
        border-right: none;
        border-bottom: 1px solid var(--color-mint);
    }
}

@media (max-width: 768px) {
    .admin-guru-container {
        padding: 1rem;
    }

    .header-content-admin-guru {
        flex-direction: column;
        text-align: center;
    }

    .page-title-admin-guru {
        font-size: 1.5rem;
    }

    .photo-section-admin-guru,
    .info-section-admin-guru {
        padding: 1.5rem;
    }

    .photo-container-admin-guru {
        width: 160px;
        height: 160px;
    }

    .form-actions-admin-guru {
        flex-direction: column-reverse;
    }

    .btn-cancel-admin-guru,
    .btn-submit-admin-guru {
        width: 100%;
        justify-content: center;
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

.form-card-admin-guru {
    animation: fadeIn 0.5s ease-out;
}
</style>

<script>
// Photo preview
document.getElementById('photoInputCreate')?.addEventListener('change', function(e) {
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
            document.getElementById('photoPreviewCreate').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Toggle password visibility
function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye-fill');
        icon.classList.add('bi-eye-slash-fill');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash-fill');
        icon.classList.add('bi-eye-fill');
    }
}
</script>

@endsection