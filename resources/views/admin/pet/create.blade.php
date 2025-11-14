{{-- views/admin/pet/create.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Tambah Pet - RSHP UNAIR')

@section('page-icon', 'plus-circle-fill')
@section('page-title', 'Tambah Pet')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Data Pet</a></li>
    <li class="breadcrumb-item active">Tambah Data</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Info Card -->
            <div class="info-card mb-4">
                <div class="info-card-icon">
                    <i class="bi bi-lightbulb-fill"></i>
                </div>
                <div class="info-card-content">
                    <h6>Informasi</h6>
                    <p>Pastikan data yang dimasukkan sesuai dengan dokumen atau informasi resmi dari pemilik untuk menjaga keakuratan data sistem</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-file-earmark-plus-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Tambah Pet</h5>
                        <p>Isi formulir di bawah dengan lengkap dan benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.pet.store') }}" method="POST" id="formCreate">
                        @csrf
                        
                        <div class="form-group">
                            <label for="nama" class="form-label">
                                <i class="bi bi-paw-fill me-2"></i>
                                Nama Pet
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <input type="text" 
                                       id="nama" 
                                       name="nama" 
                                       class="form-control @error('nama') is-invalid @enderror" 
                                       value="{{ old('nama') }}" 
                                       placeholder="Contoh: Milo, Luna, Bobby"
                                       autofocus>
                                <div class="input-icon">
                                    <i class="bi bi-tag-fill"></i>
                                </div>
                            </div>
                            @error('nama')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Masukkan nama panggilan pet yang mudah dikenali</span>
                            </div>
                        </div>

                        <div class="form-grid">
                            <!-- Tanggal Lahir -->
                            <div class="form-group">
                                <label for="tanggal_lahir" class="form-label">
                                    <i class="bi bi-calendar-event me-2"></i>
                                    Tanggal Lahir
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="date" 
                                           id="tanggal_lahir" 
                                           name="tanggal_lahir" 
                                           class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                           value="{{ old('tanggal_lahir') }}"
                                           max="{{ date('Y-m-d') }}">
                                    <div class="input-icon">
                                        <i class="bi bi-calendar-check-fill"></i>
                                    </div>
                                </div>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-gender-ambiguous me-2"></i>
                                    Jenis Kelamin
                                    <span class="required">*</span>
                                </label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" 
                                               id="jantan" 
                                               name="jenis_kelamin" 
                                               value="L" 
                                               {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}
                                               class="form-check-input">
                                        <label for="jantan" class="form-check-label">
                                            <i class="bi bi-gender-male"></i>
                                            <span>Jantan</span>
                                        </label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" 
                                               id="betina" 
                                               name="jenis_kelamin" 
                                               value="P" 
                                               {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}
                                               class="form-check-input">
                                        <label for="betina" class="form-check-label">
                                            <i class="bi bi-gender-female"></i>
                                            <span>Betina</span>
                                        </label>
                                    </div>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Warna/Tanda -->
                        <div class="form-group">
                            <label for="warna_tanda" class="form-label">
                                <i class="bi bi-palette me-2"></i>
                                Warna/Tanda Khusus
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <input type="text" 
                                       id="warna_tanda" 
                                       name="warna_tanda" 
                                       class="form-control @error('warna_tanda') is-invalid @enderror" 
                                       value="{{ old('warna_tanda') }}" 
                                       placeholder="Contoh: Coklat muda dengan bercak putih di dada">
                                <div class="input-icon">
                                    <i class="bi bi-brush-fill"></i>
                                </div>
                            </div>
                            @error('warna_tanda')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Deskripsikan ciri khas fisik pet untuk identifikasi</span>
                            </div>
                        </div>

                        <!-- Ras Hewan -->
                        <div class="form-group">
                            <label for="idras_hewan" class="form-label">
                                <i class="bi bi-tags me-2"></i>
                                Ras Hewan
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <select id="idras_hewan" 
                                        name="idras_hewan" 
                                        class="form-control @error('idras_hewan') is-invalid @enderror">
                                    <option value="">-- Pilih Ras Hewan --</option>
                                    @foreach($rasHewan as $ras)
                                        <option value="{{ $ras->idras_hewan }}" {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}>
                                            {{ $ras->nama_ras }} ({{ $ras->nama_jenis_hewan }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-icon">
                                    <i class="bi bi-card-checklist"></i>
                                </div>
                            </div>
                            @error('idras_hewan')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Pemilik -->
                        <div class="form-group">
                            <label for="idpemilik" class="form-label">
                                <i class="bi bi-person me-2"></i>
                                Pemilik
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <select id="idpemilik" 
                                        name="idpemilik" 
                                        class="form-control @error('idpemilik') is-invalid @enderror">
                                    <option value="">-- Pilih Pemilik --</option>
                                    @foreach($pemilik as $owner)
                                        <option value="{{ $owner->idpemilik }}" {{ old('idpemilik') == $owner->idpemilik ? 'selected' : '' }}>
                                            {{ $owner->nama }} ({{ $owner->no_wa }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-icon">
                                    <i class="bi bi-person-check-fill"></i>
                                </div>
                            </div>
                            @error('idpemilik')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-save-fill"></i>
                                <span>Simpan Data</span>
                            </button>
                            <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary btn-cancel">
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
        :root {
            --primary: #0077b6;
            --primary-dark: #023e8a;
            --secondary: #0096c7;
            --success: #06d6a0;
            --warning: #ffa500;
            --danger: #ef476f;
            --light-bg: #f8fbff;
            --text-dark: #1a1a2e;
            --text-gray: #4a5568;
        }

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

        /* Radio Group Styles */
        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            background: var(--light-bg);
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
        }

        .radio-option:hover {
            border-color: var(--primary);
            background: #f0f9ff;
        }

        .radio-option input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .radio-option label {
            margin: 0;
            cursor: pointer;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .radio-option input[type="radio"]:checked + label {
            color: var(--primary);
        }

        .radio-option input[type="radio"]:checked ~ .radio-option {
            border-color: var(--primary);
            background: var(--light-bg);
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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
            
            .radio-group {
                flex-direction: column;
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
        document.getElementById('nama').focus();

        // Form validation before submit
        document.getElementById('formCreate').addEventListener('submit', function(e) {
            const input = document.getElementById('nama');
            if (input.value.trim() === '') {
                e.preventDefault();
                input.classList.add('is-invalid');
                
                // Tambahkan pesan error jika belum ada
                if (!document.querySelector('.invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                    errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Nama pet wajib diisi!</span>';
                    input.parentNode.appendChild(errorDiv);
                }
                
                input.focus();
            }
        });

        // Remove error class on input
        document.getElementById('nama').addEventListener('input', function() {
            this.classList.remove('is-invalid');
            // Hapus pesan error custom jika ada
            const customError = this.parentNode.querySelector('.invalid-feedback');
            if (customError && !this.parentNode.querySelector('.is-invalid')) {
                customError.remove();
            }
        });

        // Set max date to today
        document.getElementById('tanggal_lahir').max = new Date().toISOString().split('T')[0];
    </script>
@endsection