@extends('admin.layout')

@section('content')
<div class="edit-siswa-container">
    <!-- Page Header -->
    <div class="page-header-edit-siswa">
        <div class="header-content-edit-siswa">
            <div class="header-icon-edit-siswa">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <h1 class="page-title-edit-siswa">Edit Data Siswa</h1>
                <p class="page-subtitle-edit-siswa">Perbarui informasi siswa</p>
            </div>
        </div>
    </div>

    <!-- Edit Card -->
    <div class="edit-card-siswa">
        <form action="/admin/siswa/{{ $siswa->id_siswa }}" method="POST" enctype="multipart/form-data" id="editFormSiswa">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <!-- Photo Section -->
                <div class="col-lg-4">
                    <div class="photo-section-siswa">
                        <div class="photo-header-siswa">
                            <i class="bi bi-image-fill"></i>
                            <span>Foto Siswa</span>
                        </div>
                        
                        <div class="photo-wrapper-siswa"> 
                            <div class="photo-container-siswa">
                                <img 
                                    src="{{ $siswa->foto ? asset('uploads/siswa/'.$siswa->foto) : 'https://ui-avatars.com/api/?name='.$siswa->nama.'&background=4D869C&color=fff&size=300' }}"
                                    alt="Foto Siswa"
                                    class="profile-photo-siswa"
                                    id="photoPreviewSiswa"
                                >
                                <div class="photo-overlay-siswa">
                                    <i class="bi bi-camera-fill"></i>
                                    <span>Ubah Foto</span>
                                </div>
                            </div>
                        </div>

                        <div class="photo-upload-siswa">
                            <label for="photoInputSiswa" class="upload-label-siswa">
                                <i class="bi bi-cloud-upload-fill"></i>
                                <span>Pilih Foto Baru</span>
                                <input 
                                    type="file" 
                                    name="foto" 
                                    id="photoInputSiswa" 
                                    class="photo-input-siswa"
                                    accept="image/*"
                                >
                            </label>
                            <div class="upload-hint-siswa">
                                <i class="bi bi-info-circle"></i>
                                <span>Maksimal 2MB (JPG, PNG)</span>
                            </div>
                        </div>

                        @if($siswa->foto)
                        <div class="current-photo-info">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Foto saat ini tersimpan</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Info Section -->
                <div class="col-lg-8">
                    <div class="info-section-siswa">
                        <div class="info-header-siswa">
                            <i class="bi bi-person-badge-fill"></i>
                            <span>Informasi Siswa</span>
                        </div>

                        <div class="info-body-siswa">
                            <!-- NIS -->
                            <div class="form-group-edit-siswa">
                                <label class="form-label-edit-siswa">
                                    <i class="bi bi-card-text"></i>
                                    Nomor Induk Siswa (NIS)
                                </label>
                                <input 
                                    type="text" 
                                    name="nis"
                                    class="form-control-edit-siswa" 
                                    value="{{ $siswa->nis }}" 
                                    required
                                    placeholder="Masukkan NIS"
                                >
                                <small class="input-hint-siswa">Nomor identitas unik siswa</small>
                            </div>

                            <!-- Nama -->
                            <div class="form-group-edit-siswa">
                                <label class="form-label-edit-siswa">
                                    <i class="bi bi-person-fill"></i>
                                    Nama Lengkap
                                </label>
                                <input 
                                    type="text" 
                                    name="nama"
                                    class="form-control-edit-siswa" 
                                    value="{{ $siswa->nama }}" 
                                    required
                                    placeholder="Masukkan nama lengkap"
                                >
                                <small class="input-hint-siswa">Nama sesuai ijazah</small>
                            </div>

                           
             <!-- Kelas -->
<div class="form-group-edit-siswa">
    <label class="form-label-edit-siswa">
        <i class="bi bi-door-open-fill"></i>
        Kelas
    </label>

    <select name="id_kelas" class="form-control-edit-siswa" required>
        @foreach($kelas as $k)
            <option value="{{ $k->id_kelas }}"
                {{ $siswa->id_kelas == $k->id_kelas ? 'selected' : '' }}>
                {{ $k->nama_kelas }} - {{ $k->jurusan }}
            </option>
        @endforeach
    </select>
  <!-- PASSWORD -->
    <small class="input-hint-siswa">Tingkat kelas siswa</small>
</div>

                         <div class="form-group-edit-siswa">
    <label class="form-label-edit-siswa">
        <i class="bi bi-lock-fill"></i>
        Password
    </label>
    <input 
        type="password"
        name="password"
        class="form-control-edit-siswa"
        placeholder="Kosongkan jika tidak ingin mengubah password"
    >
</div>

                            <!-- Action Buttons -->
                            <div class="form-actions-edit-siswa">
                                <a href="/admin/siswa" class="btn-cancel-edit-siswa">
                                    <i class="bi bi-x-circle-fill"></i>
                                    Batal
                                </a>
                                <button type="submit" class="btn-submit-edit-siswa">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Update Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Info Note -->
    <div class="info-note-siswa">
        <div class="note-icon-info-siswa">
            <i class="bi bi-lightbulb-fill"></i>
        </div>
        <div class="note-content-info-siswa">
            <h6>Informasi Penting</h6>
            <p>Pastikan semua data yang dimasukkan sudah benar. Data siswa yang sudah diupdate akan langsung tersimpan di sistem.</p>
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
.edit-siswa-container {
    padding: 2rem 0;
    max-width: 1100px;
    margin: 0 auto;
}

/* Page Header */
.page-header-edit-siswa {
    margin-bottom: 2rem;
}

.header-content-edit-siswa {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.header-icon-edit-siswa {
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

.page-title-edit-siswa {
    font-size: 1.875rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.page-subtitle-edit-siswa {
    font-size: 0.9375rem;
    color: #64748b;
    margin: 0.5rem 0 0 0;
}

/* Edit Card */
.edit-card-siswa {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    margin-bottom: 2rem;
}

/* Photo Section */
.photo-section-siswa {
    padding: 2rem;
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    border-right: 1px solid var(--color-mint);
    height: 100%;
}

.photo-header-siswa {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-dark-teal);
    margin-bottom: 1.5rem;
}

.photo-header-siswa i {
    color: var(--color-teal);
    font-size: 1.125rem;
}

.photo-wrapper-siswa {
    margin-bottom: 1.5rem;
}

.photo-container-siswa {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(77, 134, 156, 0.2);
    border: 3px solid white;
}

.profile-photo-siswa {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-overlay-siswa {
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

.photo-container-siswa:hover .photo-overlay-siswa {
    opacity: 1;
}

.photo-overlay-siswa i {
    font-size: 2rem;
}

.photo-overlay-siswa span {
    font-weight: 600;
    font-size: 0.9375rem;
}

.photo-upload-siswa {
    text-align: center;
}

.upload-label-siswa {
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

.upload-label-siswa:hover {
    border-color: var(--color-dark-teal);
    background: var(--color-light-blue);
    color: var(--color-dark-teal);
}

.upload-label-siswa i {
    font-size: 1.5rem;
}

.photo-input-siswa {
    display: none;
}

.upload-hint-siswa {
    margin-top: 0.75rem;
    font-size: 0.8125rem;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.375rem;
}

.current-photo-info {
    margin-top: 1rem;
    padding: 0.75rem;
    background: rgba(16, 185, 129, 0.1);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    color: #059669;
    font-size: 0.875rem;
    font-weight: 600;
}

.current-photo-info i {
    font-size: 1rem;
}

/* Info Section */
.info-section-siswa {
    padding: 2rem;
}

.info-header-siswa {
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

.info-header-siswa i {
    color: var(--color-teal);
    font-size: 1.125rem;
}

.info-body-siswa {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group-edit-siswa {
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
}

.form-label-edit-siswa {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9375rem;
    font-weight: 700;
    color: var(--color-dark-teal);
}

.form-label-edit-siswa i {
    color: var(--color-teal);
    font-size: 1rem;
}

.form-control-edit-siswa {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--color-mint);
    border-radius: 10px;
    font-size: 0.9375rem;
    color: #1e293b;
    background: white;
    transition: all 0.3s ease;
}

.form-control-edit-siswa:focus {
    outline: none;
    border-color: var(--color-teal);
    box-shadow: 0 0 0 3px rgba(122, 178, 178, 0.1);
}

.form-control-edit-siswa::placeholder {
    color: #94a3b8;
}

.input-hint-siswa {
    font-size: 0.8125rem;
    color: #94a3b8;
    margin-top: 0.25rem;
}

/* Form Actions */
.form-actions-edit-siswa {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--color-mint);
}

.btn-cancel-edit-siswa {
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

.btn-cancel-edit-siswa:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: #475569;
    transform: translateY(-2px);
}

.btn-submit-edit-siswa {
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

.btn-submit-edit-siswa:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(77, 134, 156, 0.4);
}

/* Info Note */
.info-note-siswa {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, var(--color-light-blue) 0%, var(--color-mint) 100%);
    border-radius: 12px;
    border: 1px solid var(--color-mint);
}

.note-icon-info-siswa {
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

.note-content-info-siswa h6 {
    font-size: 0.9375rem;
    font-weight: 700;
    color: var(--color-dark-teal);
    margin: 0 0 0.375rem 0;
}

.note-content-info-siswa p {
    font-size: 0.875rem;
    color: #64748b;
    margin: 0;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 991px) {
    .photo-section-siswa {
        border-right: none;
        border-bottom: 1px solid var(--color-mint);
    }
}

@media (max-width: 768px) {
    .edit-siswa-container {
        padding: 1rem;
    }

    .header-content-edit-siswa {
        flex-direction: column;
        text-align: center;
    }

    .page-title-edit-siswa {
        font-size: 1.5rem;
    }

    .photo-section-siswa,
    .info-section-siswa {
        padding: 1.5rem;
    }

    .photo-container-siswa {
        width: 160px;
        height: 160px;
    }

    .form-actions-edit-siswa {
        flex-direction: column-reverse;
    }

    .btn-cancel-edit-siswa,
    .btn-submit-edit-siswa {
        width: 100%;
        justify-content: center;
    }

    .info-note-siswa {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .header-icon-edit-siswa {
        width: 56px;
        height: 56px;
        font-size: 1.75rem;
    }

    .photo-container-siswa {
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

.edit-card-siswa,
.info-note-siswa {
    animation: fadeIn 0.5s ease-out;
}
</style>

<script>
// Photo preview
document.getElementById('photoInputSiswa')?.addEventListener('change', function(e) {
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
            document.getElementById('photoPreviewSiswa').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Form submit confirmation
document.getElementById('editFormSiswa')?.addEventListener('submit', function(e) {
    if (!confirm('Apakah Anda yakin ingin mengupdate data siswa ini?')) {
        e.preventDefault();
    }
});
</script>

@endsection