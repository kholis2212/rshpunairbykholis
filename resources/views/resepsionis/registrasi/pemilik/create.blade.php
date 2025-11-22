{{-- views/resepsionis/registrasi/pemilik/create.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Registrasi Pemilik Hewan - RSHP UNAIR')

@section('page-icon', 'person-plus-fill')
@section('page-title', 'Registrasi Pemilik Hewan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard-resepsionis') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.registrasi.pemilik.index') }}">Registrasi Pemilik</a></li>
    <li class="breadcrumb-item active">Registrasi Pemilik Baru</li>
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
                    <h6>Informasi Registrasi</h6>
                    <p>Pastikan data yang dimasukkan lengkap dan valid. Email harus unik dan belum terdaftar dalam sistem. Password default untuk akun baru adalah <strong>password123</strong></p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form registrasi Pemilik Hewan</h5>
                        <p>Isi formulir di bawah dengan lengkap dan benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('resepsionis.registrasi.pemilik.store') }}" method="POST" id="formCreate">
                        @csrf
                        
                        <div class="form-section">
                            <div class="form-section-header">
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Data Akun</span>
                            </div>
                            
                            <div class="form-group">
                                <label for="nama" class="form-label">
                                    <i class="bi bi-person-fill me-2"></i>
                                    Nama Lengkap
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" 
                                           id="nama" 
                                           name="nama" 
                                           class="form-control @error('nama') is-invalid @enderror" 
                                           value="{{ old('nama') }}" 
                                           placeholder="Masukkan nama lengkap pemilik"
                                           autofocus>
                                    <div class="input-icon">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                </div>
                                @error('nama')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope-fill me-2"></i>
                                    Email
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}" 
                                           placeholder="contoh: pemilik@email.com">
                                    <div class="input-icon">
                                        <i class="bi bi-at"></i>
                                    </div>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="form-hint">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>Email akan digunakan untuk login ke sistem</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-section-header">
                                <i class="bi bi-telephone-fill"></i>
                                <span>Kontak & Alamat</span>
                            </div>

                            <div class="form-group">
                                <label for="no_wa" class="form-label">
                                    <i class="bi bi-whatsapp me-2"></i>
                                    Nomor WhatsApp
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" 
                                           id="no_wa" 
                                           name="no_wa" 
                                           class="form-control @error('no_wa') is-invalid @enderror" 
                                           value="{{ old('no_wa') }}" 
                                           placeholder="Contoh: 081234567890">
                                    <div class="input-icon">
                                        <i class="bi bi-phone-fill"></i>
                                    </div>
                                </div>
                                @error('no_wa')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="form-hint">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>Nomor WhatsApp akan digunakan untuk komunikasi penting</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat" class="form-label">
                                    <i class="bi bi-geo-alt-fill me-2"></i>
                                    Alamat Lengkap
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <textarea id="alamat" 
                                              name="alamat" 
                                              class="form-control @error('alamat') is-invalid @enderror" 
                                              rows="3" 
                                              placeholder="Masukkan alamat lengkap pemilik">{{ old('alamat') }}</textarea>
                                    <div class="input-icon">
                                        <i class="bi bi-house-fill"></i>
                                    </div>
                                </div>
                                @error('alamat')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="form-hint">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>Alamat lengkap termasuk jalan, RT/RW, kelurahan, kecamatan, dan kota</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-info-card">
                            <div class="form-info-icon">
                                <i class="bi bi-key-fill"></i>
                            </div>
                            <div class="form-info-content">
                                <h6>Informasi Login</h6>
                                <p>Akun akan dibuat dengan password default: <strong>password123</strong>. Pemilik dapat mengganti password setelah login pertama kali.</p>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-person-plus-fill"></i>
                                <span>Daftarkan Pemilik</span>
                            </button>
                            <a href="{{ route('resepsionis.registrasi.pemilik.index') }}" class="btn btn-secondary btn-cancel">
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
        /* Form Section */
        .form-section {
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #f8fbff;
        }

        .form-section:last-of-type {
            border-bottom: none;
            margin-bottom: 30px;
        }

        .form-section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 25px;
            padding: 15px 20px;
            background: linear-gradient(135deg, rgba(0, 119, 182, 0.05), rgba(0, 150, 199, 0.05));
            border-radius: 12px;
            border-left: 4px solid #0077b6;
        }

        .form-section-header i {
            color: #0077b6;
            font-size: 1.2rem;
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
            margin-bottom: 25px;
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

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
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

        textarea + .input-icon {
            top: 25px;
            transform: none;
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

        /* Form Info Card */
        .form-info-card {
            background: linear-gradient(135deg, rgba(255, 195, 0, 0.05), rgba(255, 183, 0, 0.05));
            border: 2px solid rgba(255, 195, 0, 0.3);
            border-radius: 15px;
            padding: 20px 25px;
            display: flex;
            align-items: start;
            gap: 20px;
            margin-bottom: 30px;
        }

        .form-info-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #ffc300, #ffb700);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #023e8a;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .form-info-content h6 {
            font-size: 1rem;
            font-weight: 700;
            color: #ff8c00;
            margin: 0 0 5px 0;
        }

        .form-info-content p {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin: 0;
            line-height: 1.6;
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

            .form-section-header {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }

            .form-info-card {
                flex-direction: column;
                text-align: center;
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
        // Auto focus on first input
        document.getElementById('nama').focus();

        // Form validation before submit
        document.getElementById('formCreate').addEventListener('submit', function(e) {
            const nama = document.getElementById('nama');
            const email = document.getElementById('email');
            const no_wa = document.getElementById('no_wa');
            const alamat = document.getElementById('alamat');
            
            let isValid = true;

            // Validate nama
            if (nama.value.trim() === '') {
                nama.classList.add('is-invalid');
                isValid = false;
            }

            // Validate email
            if (email.value.trim() === '') {
                email.classList.add('is-invalid');
                isValid = false;
            }

            // Validate no_wa
            if (no_wa.value.trim() === '') {
                no_wa.classList.add('is-invalid');
                isValid = false;
            }

            // Validate alamat
            if (alamat.value.trim() === '') {
                alamat.classList.add('is-invalid');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                // Focus on first invalid field
                if (nama.value.trim() === '') {
                    nama.focus();
                } else if (email.value.trim() === '') {
                    email.focus();
                } else if (no_wa.value.trim() === '') {
                    no_wa.focus();
                } else if (alamat.value.trim() === '') {
                    alamat.focus();
                }
            }
        });

        // Remove error class on input
        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
        });

        // Format phone number
        document.getElementById('no_wa').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('0')) {
                value = value.substring(1);
            }
            e.target.value = value;
        });
    </script>
@endsection