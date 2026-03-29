@extends('admin.layout')

@section('content')
<div class="tambah-siswa-container">
    <!-- Page Header -->
    <div class="page-header-tambah-siswa">
        <div class="header-content-tambah-siswa">
            <div class="header-icon-tambah-siswa">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <div>
                <h1 class="page-title-tambah-siswa">Tambah Siswa Baru</h1>
                <p class="page-subtitle-tambah-siswa">Lengkapi formulir untuk menambahkan siswa</p>
            </div>
        </div>
    </div>

    {{-- ALERT ERROR --}}
    @if($errors->any())
    <div class="alert-error-tambah-siswa">
        <div class="alert-icon-error-siswa">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div class="alert-content-error-siswa">
            <h5>Terdapat Kesalahan!</h5>
            <ul class="error-list-siswa">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button class="alert-close-error-siswa" onclick="this.parentElement.remove()">
            <i class="bi bi-x"></i>
        </button>
    </div>
    @endif

    <!-- Tambah Card -->
    <div class="tambah-card-siswa">
        <form action="/admin/siswa" method="POST" enctype="multipart/form-data" id="tambahFormSiswa">
            @csrf
            
            <div class="row g-4">
                <!-- Photo Section -->
                <div class="col-lg-4">
                    <div class="photo-section-tambah-siswa">
                        <div class="photo-header-tambah-siswa">
                            <i class="bi bi-image-fill"></i>
                            <span>Foto Siswa</span>
                        </div>
                        
                        <div class="photo-wrapper-tambah-siswa">
                            <div class="photo-container-tambah-siswa">
                                <img 
                                    src="https://ui-avatars.com/api/?name=Siswa+Baru&background=4D869C&color=fff&size=300"
                                    alt="Preview Foto"
                                    class="profile-photo-tambah-siswa"
                                    id="photoPreviewTambahSiswa"
                                >
                                <div class="photo-overlay-tambah-siswa">
                                    <i class="bi bi-camera-fill"></i>
                                    <span>Pilih Foto</span>
                                </div>
                            </div>
                        </div>

                        <div class="photo-upload-tambah-siswa">
                            <label for="photoInputTambahSiswa" class="upload-label-tambah-siswa">
                                <i class="bi bi-cloud-upload-fill"></i>
                                <span>Pilih Foto</span>
                                <input 
                                    type="file" 
                                    name="foto" 
                                    id="photoInputTambahSiswa" 
                                    class="photo-input-tambah-siswa"
                                    accept="image/*"
                                >
                            </label>
                            <div class="upload-hint-tambah-siswa">
                                <i class="bi bi-info-circle"></i>
                                <span>Opsional - Maksimal 2MB (JPG, PNG)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="col-lg-8">
                    <div class="info-section-tambah-siswa">
                        <div class="info-header-tambah-siswa">
                            <i class="bi bi-person-badge-fill"></i>
                            <span>Informasi Siswa</span>
                        </div>

                        <div class="info-body-tambah-siswa">
                            <!-- NIS -->
                            <div class="form-group-tambah-siswa">
                                <label class="form-label-tambah-siswa">
                                    <i class="bi bi-card-text"></i>
                                    Nomor Induk Siswa (NIS)
                                    <span class="required-badge">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="nis"
                                    class="form-control-tambah-siswa" 
                                    required
                                    placeholder="Masukkan NIS"
                                   
                                >
                                <small class="input-hint-tambah-siswa">Nomor identitas unik siswa</small>
                            </div>

                            <!-- Nama -->
                            <div class="form-group-tambah-siswa">
                                <label class="form-label-tambah-siswa">
                                    <i class="bi bi-person-fill"></i>
                                    Nama Lengkap
                                    <span class="required-badge">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="nama"
                                    class="form-control-tambah-siswa" 
                                    placeholder="Masukkan nama lengkap"
                                    autocomplete="off"
                                    required
                                    
                                >
                                <small class="input-hint-tambah-siswa">Nama sesuai ijazah</small>
                            </div>

                           <div class="form-group-tambah-siswa">
<label class="form-label-tambah-siswa">
<i class="bi bi-door-open-fill"></i>
Kelas
<span class="required-badge">*</span>
</label>
<select name="id_kelas" class="form-control-tambah-siswa" required>

<option value="" disabled selected>-- Pilih Kelas --</option>

@foreach($kelas as $k)
<option value="{{ $k->id_kelas }}">
    {{ $k->nama_kelas }}
</option>
@endforeach

</select>

<small class="input-hint-tambah-siswa">
Pilih kelas siswa
</small>
</div>

                            <!-- Password -->
                            <div class="form-group-tambah-siswa">
                                <label class="form-label-tambah-siswa">
                                    <i class="bi bi-lock-fill"></i>
                                    Password
                                    <span class="required-badge">*</span>
                                </label>
                                <div class="password-wrapper">
                                    <input 
                                        type="password" 
                                        name="password"
                                        id="passwordInput"
                                        class="form-control-tambah-siswa" 
                                      
                                        placeholder="Masukkan password"
                                        autocomplete="new-password"
                                        required
                                    >
                                    <button type="button" class="toggle-password" onclick="togglePassword()">
                                        <i class="bi bi-eye-fill" id="eyeIcon"></i>
                                    </button>
                                </div>
                                <small class="input-hint-tambah-siswa">Password untuk login siswa</small>
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-actions-tambah-siswa">
                                <a href="/admin/siswa" class="btn-cancel-tambah-siswa">
                                    <i class="bi bi-x-circle-fill"></i>
                                    Batal
                                </a>
                                <button type="submit" class="btn-submit-tambah-siswa">
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

    <!-- Info Note -->
    <div class="info-note-tambah-siswa">
        <div class="note-icon-info-tambah-siswa">
            <i class="bi bi-lightbulb-fill"></i>
        </div>
        <div class="note-content-info-tambah-siswa">
            <h6>Informasi Penting</h6>
            <p>Field bertanda <span class="required-badge">*</span> wajib diisi. Foto bersifat opsional dan dapat ditambahkan kemudian. Pastikan password mudah diingat oleh siswa.</p>
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
.tambah-siswa-container {
    padding: 2rem 0;
    max-width: 1100px;
    margin: 0 auto;
}

/* Page Header */
.page-header-tambah-siswa {
    margin-bottom: 2rem;
}

.header-content-tambah-siswa {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.header-icon-tambah-siswa {
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

.page-title-tambah-siswa {
    font-size: 1.875rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.page-subtitle-tambah-siswa {
    font-size: 0.9375rem;
    color: #64748b;
    margin: 0.5rem 0 0 0;
}

/* Error Alert */
.alert-error-tambah-siswa {
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

.alert-icon-error-siswa {
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

.alert-content-error-siswa {
    flex: 1;
}

.alert-content-error-siswa h5 {
    font-size: 1rem;
    font-weight: 700;
    color: #7f1d1d;
    margin: 0 0 0.5rem 0;
}

.error-list-siswa {
    margin: 0;
    padding-left: 1.25rem;
    color: #7f1d1d;
    font-size: 0.875rem;
}

.error-list-siswa li {
    margin-bottom: 0.25rem;
}

.alert-close-error-siswa {
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

.alert-close-error-siswa:hover {
    background: white;
    transform: scale(1.1);
}

/* Tambah Card */
.tambah-card-siswa {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    margin-bottom: 2rem;
}

/* Photo Section */
.photo-section-tambah-siswa {
    padding: 2rem;
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    border-right: 1px solid var(--color-mint);
    height: 100%;
}

.photo-header-tambah-siswa {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-dark-teal);
    margin-bottom: 1.5rem;
}

.photo-header-tambah-siswa i {
    color: var(--color-teal);
    font-size: 1.125rem;
}

.photo-wrapper-tambah-siswa {
    margin-bottom: 1.5rem;
}

.photo-container-tambah-siswa {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(77, 134, 156, 0.2);
    border: 3px solid white;
}

.profile-photo-tambah-siswa {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-overlay-tambah-siswa {
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

.photo-container-tambah-siswa:hover .photo-overlay-tambah-siswa {
    opacity: 1;
}

.photo-overlay-tambah-siswa i {
    font-size: 2rem;
}

.photo-overlay-tambah-siswa span {
    font-weight: 600;
    font-size: 0.9375rem;
}

.photo-upload-tambah-siswa {
    text-align: center;
}

.upload-label-tambah-siswa {
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

.upload-label-tambah-siswa:hover {
    border-color: var(--color-dark-teal);
    background: var(--color-light-blue);
    color: var(--color-dark-teal);
}

.upload-label-tambah-siswa i {
    font-size: 1.5rem;
}

.photo-input-tambah-siswa {
    display: none;
}

.upload-hint-tambah-siswa {
    margin-top: 0.75rem;
    font-size: 0.8125rem;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.375rem;
}

/* Info Section */
.info-section-tambah-siswa {
    padding: 2rem;
}

.info-header-tambah-siswa {
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

.info-header-tambah-siswa i {
    color: var(--color-teal);
    font-size: 1.125rem;
}

.info-body-tambah-siswa {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group-tambah-siswa {
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
}

.form-label-tambah-siswa {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9375rem;
    font-weight: 700;
    color: var(--color-dark-teal);
}

.form-label-tambah-siswa i {
    color: var(--color-teal);
    font-size: 1rem;
}

.required-badge {
    color: #dc2626;
    font-weight: 700;
    margin-left: 0.25rem;
}

.form-control-tambah-siswa {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--color-mint);
    border-radius: 10px;
    font-size: 0.9375rem;
    color: #1e293b;
    background: white;
    transition: all 0.3s ease;
}

.form-control-tambah-siswa:focus {
    outline: none;
    border-color: var(--color-teal);
    box-shadow: 0 0 0 3px rgba(122, 178, 178, 0.1);
}

.form-control-tambah-siswa::placeholder {
    color: #94a3b8;
}

.input-hint-tambah-siswa {
    font-size: 0.8125rem;
    color: #94a3b8;
    margin-top: 0.25rem;
}

/* Password Wrapper */
.password-wrapper {
    position: relative;
}

.toggle-password {
    position: absolute;
    top: 50%;
    right: 1rem;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--color-teal);
    cursor: pointer;
    padding: 0.5rem;
    font-size: 1.25rem;
    transition: color 0.3s ease;
}

.toggle-password:hover {
    color: var(--color-dark-teal);
}

/* Form Actions */
.form-actions-tambah-siswa {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--color-mint);
}

.btn-cancel-tambah-siswa {
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

.btn-cancel-tambah-siswa:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: #475569;
    transform: translateY(-2px);
}

.btn-submit-tambah-siswa {
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

.btn-submit-tambah-siswa:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(77, 134, 156, 0.4);
}

/* Info Note */
.info-note-tambah-siswa {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    border-radius: 12px;
    border: 1px solid var(--color-mint);
}

.note-icon-info-tambah-siswa {
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

.note-content-info-tambah-siswa h6 {
    font-size: 0.9375rem;
    font-weight: 700;
    color: var(--color-dark-teal);
    margin: 0 0 0.375rem 0;
}

.note-content-info-tambah-siswa p {
    font-size: 0.875rem;
    color: #64748b;
    margin: 0;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 991px) {
    .photo-section-tambah-siswa {
        border-right: none;
        border-bottom: 1px solid var(--color-mint);
    }
}

@media (max-width: 768px) {
    .tambah-siswa-container {
        padding: 1rem;
    }

    .header-content-tambah-siswa {
        flex-direction: column;
        text-align: center;
    }

    .page-title-tambah-siswa {
        font-size: 1.5rem;
    }

    .photo-section-tambah-siswa,
    .info-section-tambah-siswa {
        padding: 1.5rem;
    }

    .photo-container-tambah-siswa {
        width: 160px;
        height: 160px;
    }

    .form-actions-tambah-siswa {
        flex-direction: column-reverse;
    }

    .btn-cancel-tambah-siswa,
    .btn-submit-tambah-siswa {
        width: 100%;
        justify-content: center;
    }

    .info-note-tambah-siswa {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .header-icon-tambah-siswa {
        width: 56px;
        height: 56px;
        font-size: 1.75rem;
    }

    .photo-container-tambah-siswa {
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

.tambah-card-siswa,
.info-note-tambah-siswa {
    animation: fadeIn 0.5s ease-out;
}
</style>

<script>
// Photo preview
document.getElementById('photoInputTambahSiswa')?.addEventListener('change', function(e) {
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
            document.getElementById('photoPreviewTambahSiswa').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Toggle password visibility
function togglePassword() {
    const passwordInput = document.getElementById('passwordInput');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('bi-eye-fill');
        eyeIcon.classList.add('bi-eye-slash-fill');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('bi-eye-slash-fill');
        eyeIcon.classList.add('bi-eye-fill');
    }
}

// Form submit confirmation
document.getElementById('tambahFormSiswa')?.addEventListener('submit', function(e) {
    if (!confirm('Apakah Anda yakin ingin menyimpan data siswa ini?')) {
        e.preventDefault();
    }
});
</script>

@endsection