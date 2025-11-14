{{-- views/admin/kode-tindakan-terapi/create.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Tambah Kode Tindakan Terapi - RSHP UNAIR')

@section('page-icon', 'plus-circle-fill')
@section('page-title', 'Tambah Kode Tindakan Terapi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kode-tindakan-terapi.index') }}">Data Kode Tindakan Terapi</a></li>
    <li class="breadcrumb-item active">Tambah Data</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <!-- Info Card -->
            <div class="info-card mb-4">
                <div class="info-card-icon">
                    <i class="bi bi-lightbulb-fill"></i>
                </div>
                <div class="info-card-content">
                    <h6>Informasi</h6>
                    <p>Pastikan kode yang Anda masukkan unik dan belum terdaftar dalam sistem. Kode maksimal 5 karakter dan akan otomatis diubah menjadi huruf besar.</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-file-earmark-plus-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Tambah Kode Tindakan Terapi</h5>
                        <p>Isi formulir di bawah dengan lengkap dan benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.kode-tindakan-terapi.store') }}" method="POST" id="formCreate">
                        @csrf
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="kode" class="form-label">
                                    <i class="bi bi-code-slash me-2"></i>
                                    Kode
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" 
                                           id="kode" 
                                           name="kode" 
                                           class="form-control @error('kode') is-invalid @enderror" 
                                           value="{{ old('kode') }}" 
                                           placeholder="Contoh: T01, T02"
                                           maxlength="5"
                                           autofocus>
                                    <div class="input-icon">
                                        <i class="bi bi-tag-fill"></i>
                                    </div>
                                </div>
                                @error('kode')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="form-hint">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>Masukkan kode unik maksimal 5 karakter. Kode akan otomatis diubah menjadi huruf besar</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="idkategori" class="form-label">
                                    <i class="bi bi-folder-fill me-2"></i>
                                    Kategori
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <select id="idkategori" 
                                            name="idkategori" 
                                            class="form-control @error('idkategori') is-invalid @enderror">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategori as $kat)
                                            <option value="{{ $kat->idkategori }}" {{ old('idkategori') == $kat->idkategori ? 'selected' : '' }}>
                                                {{ $kat->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-icon">
                                        <i class="bi bi-list-ul"></i>
                                    </div>
                                </div>
                                @error('idkategori')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_tindakan_terapi" class="form-label">
                                <i class="bi bi-file-text-fill me-2"></i>
                                Deskripsi Tindakan/Terapi
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <textarea id="deskripsi_tindakan_terapi" 
                                          name="deskripsi_tindakan_terapi" 
                                          class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror" 
                                          placeholder="Masukkan deskripsi lengkap tindakan atau terapi"
                                          rows="4">{{ old('deskripsi_tindakan_terapi') }}</textarea>
                                <div class="input-icon textarea-icon">
                                    <i class="bi bi-card-text"></i>
                                </div>
                            </div>
                            @error('deskripsi_tindakan_terapi')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Jelaskan secara detail tentang tindakan atau terapi medis yang dimaksud</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="idkategori_klinis" class="form-label">
                                <i class="bi bi-hospital-fill me-2"></i>
                                Kategori Klinis
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <select id="idkategori_klinis" 
                                        name="idkategori_klinis" 
                                        class="form-control @error('idkategori_klinis') is-invalid @enderror">
                                    <option value="">-- Pilih Kategori Klinis --</option>
                                    @foreach($kategoriKlinis as $klinis)
                                        <option value="{{ $klinis->idkategori_klinis }}" {{ old('idkategori_klinis') == $klinis->idkategori_klinis ? 'selected' : '' }}>
                                            {{ $klinis->nama_kategori_klinis }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-icon">
                                    <i class="bi bi-capsule"></i>
                                </div>
                            </div>
                            @error('idkategori_klinis')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Pilih kategori klinis yang sesuai dengan jenis tindakan atau terapi</span>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-save-fill"></i>
                                <span>Simpan Data</span>
                            </button>
                            <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary btn-cancel">
                                <i class="bi bi-x-circle-fill"></i>
                                <span>Batal</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .textarea-icon {
            top: 20px;
            transform: none;
        }

        /* Include all existing styles from jenis-hewan create.blade.php */
        /* Info Card */
        .info-card {
            background: linear-gradient(135deg, rgba(0, 119, 182, 0.05), rgba(0, 150, 199, 0.05));
            border: 2px solid rgba(0, 119, 182, 0.15);
            border-radius: 15px;
            padding: 20px 25px;
            display: flex;
            align-items: start;
            gap: 20px;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .info-card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .info-card-content h6 {
            font-size: 1rem;
            font-weight: 700;
            color: #023e8a;
            margin: 0 0 5px 0;
        }

        .info-card-content p {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin: 0;
            line-height: 1.6;
        }

        /* Form Card */
        .form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 119, 182, 0.12);
            overflow: hidden;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-card .card-header {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            padding: 30px;
            border: none;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .card-header-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
            backdrop-filter: blur(10px);
        }

        .card-header-text h5 {
            margin: 0 0 5px 0;
            font-size: 1.4rem;
            font-weight: 700;
        }

        .card-header-text p {
            margin: 0;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .form-card .card-body {
            padding: 40px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 30px;
        }

        .form-label {
            font-size: 0.95rem;
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }

        .required {
            color: #ef476f;
            margin-left: 5px;
            font-size: 1.1rem;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            padding: 14px 50px 14px 18px;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #f8fbff;
        }

        .form-control:focus {
            border-color: #0077b6;
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 119, 182, 0.1);
        }

        .form-control::placeholder {
            color: #a0a0a0;
        }

        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #0077b6;
            font-size: 1.2rem;
            pointer-events: none;
        }

        .form-control.is-invalid {
            border-color: #ef476f;
            background: #fff5f5;
            padding-right: 50px;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 71, 111, 0.1);
        }

        .invalid-feedback {
            color: #ef476f;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 8px;
            display: flex !important;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .form-hint {
            background: #f0f9ff;
            border-left: 3px solid #0077b6;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 12px;
            display: flex;
            align-items: start;
            gap: 10px;
            color: var(--text-gray);
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .form-hint i {
            color: #0077b6;
            font-size: 1rem;
            margin-top: 2px;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f8fbff;
        }

        .btn-submit {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
            flex: 1;
            justify-content: center;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.4);
        }

        .btn-cancel {
            background: #f8fbff;
            color: #4a5568;
            border: 2px solid #e8e8e8;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            flex: 1;
            justify-content: center;
        }

        .btn-cancel:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
            color: #4a5568;
        }

        /* Select Styling */
        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%230077b6' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 20px;
            padding-right: 45px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .info-card {
                flex-direction: column;
                text-align: center;
            }

            .form-card .card-header {
                flex-direction: column;
                text-align: center;
                padding: 25px 20px;
            }

            .form-card .card-body {
                padding: 30px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
            }
        }
    </style>
@endsection

@section('extra-js')
    <script>
        // Auto focus on input
        document.getElementById('kode').focus();

        // Auto uppercase kode
        document.getElementById('kode').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });

        // Form validation before submit
        document.getElementById('formCreate').addEventListener('submit', function(e) {
            const requiredFields = ['kode', 'deskripsi_tindakan_terapi', 'idkategori', 'idkategori_klinis'];
            let hasError = false;

            requiredFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field && field.value.trim() === '') {
                    field.classList.add('is-invalid');
                    if (!field.parentNode.querySelector('.invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                        errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Field ini wajib diisi!</span>';
                        field.parentNode.appendChild(errorDiv);
                    }
                    hasError = true;
                    
                    if (!field.focused) {
                        field.focus();
                        field.focused = true;
                    }
                }
            });

            if (hasError) {
                e.preventDefault();
            }
        });

        // Remove error class on input
        document.querySelectorAll('.form-control').forEach(field => {
            field.addEventListener('input', function() {
                this.classList.remove('is-invalid');
                const customError = this.parentNode.querySelector('.invalid-feedback');
                if (customError && !this.parentNode.querySelector('.is-invalid')) {
                    customError.remove();
                }
            });
            
            field.addEventListener('change', function() {
                this.classList.remove('is-invalid');
                const customError = this.parentNode.querySelector('.invalid-feedback');
                if (customError && !this.parentNode.querySelector('.is-invalid')) {
                    customError.remove();
                }
            });
        });
    </script>
@endsection