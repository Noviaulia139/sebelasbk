@extends('admin.layout')

@section('content')

<div class="admin-guru-container">
    <!-- Page Header -->
    <div class="page-header-admin-guru">
        <div class="header-content-admin-guru">
            <div class="header-icon-admin-guru">
                <i class="bi bi-building"></i>
            </div>
            <div>
                <h1 class="page-title-admin-guru">Tambah Kelas</h1>
                <p class="page-subtitle-admin-guru">Tambahkan data kelas baru</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card-admin-guru">
        <form action="{{ route('admin.kelas.store') }}" method="POST" id="kelasFormCreate">
            @csrf

            <div class="info-section-admin-guru">
                <div class="info-header-admin-guru">
                    <i class="bi bi-building"></i>
                    <span>Informasi Kelas</span>
                </div>

                <div class="info-body-admin-guru">

                    <!-- ID Kelas -->
                    <div class="form-group-admin-guru">
                        <label class="form-label-admin-guru">
                            <i class="bi bi-hash"></i>
                            ID Kelas
                            <span class="required-mark">*</span>
                        </label>
                        <input
                            type="text"
                            name="id_kelas"
                            class="form-control-admin-guru @error('id_kelas') is-invalid @enderror"
                            value="{{ old('id_kelas') }}"
                            placeholder="Masukkan ID kelas"
                            required
                        >
                        @error('id_kelas')
                            <small class="error-message-admin-guru">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Nama Kelas -->
                    <div class="form-group-admin-guru">
                        <label class="form-label-admin-guru">
                            <i class="bi bi-door-open-fill"></i>
                            Nama Kelas
                            <span class="required-mark">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama_kelas"
                            class="form-control-admin-guru @error('nama_kelas') is-invalid @enderror"
                            value="{{ old('nama_kelas') }}"
                            placeholder="Masukkan nama kelas"
                            required
                        >
                        @error('nama_kelas')
                            <small class="error-message-admin-guru">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Jurusan -->
                    <div class="form-group-admin-guru">
                        <label class="form-label-admin-guru">
                            <i class="bi bi-bookmark-fill"></i>
                            Jurusan
                            <span class="required-mark">*</span>
                        </label>
                        <input
                            type="text"
                            name="jurusan"
                            class="form-control-admin-guru @error('jurusan') is-invalid @enderror"
                            value="{{ old('jurusan') }}"
                            placeholder="Masukkan jurusan"
                            required
                        >
                        @error('jurusan')
                            <small class="error-message-admin-guru">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Guru BK -->
                    <div class="form-group-admin-guru">
                        <label class="form-label-admin-guru">
                            <i class="bi bi-person-badge-fill"></i>
                            Guru BK
                        </label>
                        <select
                            name="id_guru"
                            class="form-control-admin-guru @error('id_guru') is-invalid @enderror"
                        >
                            <option value="">-- Pilih Guru --</option>
                            @foreach($guru as $g)
                                <option value="{{ $g->id_guru }}" {{ old('id_guru') == $g->id_guru ? 'selected' : '' }}>
                                    {{ $g->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_guru')
                            <small class="error-message-admin-guru">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions-admin-guru">
                        <a href="{{ route('admin.kelas.index') }}" class="btn-cancel-admin-guru">
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

        </form>
    </div>
</div>

<style>
:root {
    --color-mint: #CDE8E5;
    --color-light-blue: #EEF7FF;
    --color-teal: #7AB2B2;
    --color-dark-teal: #4D869C;
}

.admin-guru-container {
    padding: 2rem 0;
    max-width: 800px;
    margin: 0 auto;
}

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

.form-card-admin-guru {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    animation: fadeIn 0.5s ease-out;
}

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
    appearance: auto;
}

.form-control-admin-guru:focus {
    outline: none;
    border-color: var(--color-teal);
    box-shadow: 0 0 0 3px rgba(122, 178, 178, 0.1);
}

.form-control-admin-guru.is-invalid {
    border-color: #dc2626;
}

.error-message-admin-guru {
    font-size: 0.8125rem;
    color: #dc2626;
    margin-top: 0.25rem;
    display: block;
}

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

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
    .admin-guru-container { padding: 1rem; }
    .header-content-admin-guru { flex-direction: column; text-align: center; }
    .page-title-admin-guru { font-size: 1.5rem; }
    .info-section-admin-guru { padding: 1.5rem; }
    .form-actions-admin-guru { flex-direction: column-reverse; }
    .btn-cancel-admin-guru,
    .btn-submit-admin-guru { width: 100%; justify-content: center; }
}
</style>

@endsection