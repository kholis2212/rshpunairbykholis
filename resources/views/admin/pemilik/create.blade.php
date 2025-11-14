{{-- views/admin/pemilik/create.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Tambah Pemilik - RSHP UNAIR')

@section('page-icon', 'person-plus-fill')
@section('page-title', 'Tambah Pemilik')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Data Pemilik</a></li>
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
                    <p>Pastikan email yang Anda masukkan belum terdaftar dalam sistem. Password minimal 6 karakter. Setiap pemilik akan memiliki akun untuk login ke sistem.</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Tambah Pemilik</h5>
                        <p>Isi formulir di bawah dengan lengkap dan benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.pemilik.store') }}" method="POST" id="formCreate">
                        @csrf
                        
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
                                       placeholder="Masukkan nama lengkap"
                                       autofocus>
                                <div class="input-icon">
                                    <i class="bi bi-person-fill"></i>
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
                                       placeholder="contoh@email.com">
                                <div class="input-icon">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock-fill me-2"></i>
                                    Password
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" 
                                           id="password" 
                                           name="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           placeholder="Minimal 6 karakter">
                                    <div class="input-icon">
                                        <i class="bi bi-lock-fill"></i>
                                    </div>
                                    <span class="password-toggle" onclick="togglePassword('password')">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">
                                    <i class="bi bi-lock-fill me-2"></i>
                                    Konfirmasi Password
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           class="form-control" 
                                           placeholder="Ketik ulang password">
                                    <div class="input-icon">
                                        <i class="bi bi-lock-fill"></i>
                                    </div>
                                    <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </div>
                            </div>
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
                                    <i class="bi bi-whatsapp"></i>
                                </div>
                            </div>
                            @error('no_wa')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
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
                                          placeholder="Masukkan alamat lengkap"
                                          rows="3">{{ old('alamat') }}</textarea>
                                <div class="input-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                            </div>
                            @error('alamat')
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
                            <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary btn-cancel">
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

        .form-control:focus {
            border-color: #0077b6;
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 119, 182, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
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

        .password-toggle {
            position: absolute;
            right: 45px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            cursor: pointer;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #0077b6;
        }

        .form-control.is-invalid {
            border-color: #ef476f;
            background: #fff5f5;
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
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.parentNode.querySelector('.password-toggle i');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.className = 'bi bi-eye-slash-fill';
            } else {
                field.type = 'password';
                icon.className = 'bi bi-eye-fill';
            }
        }

        // Auto focus on input
        document.getElementById('nama').focus();

        // Form validation before submit
        document.getElementById('formCreate').addEventListener('submit', function(e) {
            const requiredFields = ['nama', 'email', 'password', 'password_confirmation', 'no_wa', 'alamat'];
            let hasError = false;

            requiredFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field && field.value.trim() === '') {
                    field.classList.add('is-invalid');
                    hasError = true;
                }
            });

            // Validate password confirmation
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');
            if (password.value !== passwordConfirmation.value) {
                password.classList.add('is-invalid');
                passwordConfirmation.classList.add('is-invalid');
                hasError = true;
                
                // Add custom error message
                if (!password.parentNode.querySelector('.invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                    errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Password dan konfirmasi password tidak cocok!</span>';
                    password.parentNode.appendChild(errorDiv);
                }
            }

            if (hasError) {
                e.preventDefault();
                document.querySelector('.is-invalid').focus();
            }
        });

        // Remove error class on input
        document.querySelectorAll('.form-control').forEach(field => {
            field.addEventListener('input', function() {
                this.classList.remove('is-invalid');
                // Remove custom error message for password
                if (this.id === 'password' || this.id === 'password_confirmation') {
                    const errorDiv = this.parentNode.querySelector('.invalid-feedback');
                    if (errorDiv && !this.parentNode.querySelector('.is-invalid')) {
                        errorDiv.remove();
                    }
                }
            });
        });
    </script>
@endsection