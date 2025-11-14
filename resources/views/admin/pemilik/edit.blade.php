{{-- views/admin/pemilik/edit.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Edit Pemilik - RSHP UNAIR')

@section('page-icon', 'person-fill')
@section('page-title', 'Edit Pemilik')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Data Pemilik</a></li>
    <li class="breadcrumb-item active">Edit Data</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Current Value Card -->
            <div class="current-value-card mb-4">
                <div class="current-value-header">
                    <div class="current-value-icon">
                        <i class="bi bi-file-text-fill"></i>
                    </div>
                    <div class="current-value-text">
                        <h6>Data Saat Ini</h6>
                        <p>Informasi pemilik yang sedang aktif</p>
                    </div>
                </div>
                <div class="current-value-body">
                    <div class="current-value-grid">
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-person-fill"></i>
                                <span>Nama</span>
                            </div>
                            <div class="current-value-display">
                                {{ $pemilik->nama }}
                            </div>
                        </div>
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-envelope-fill"></i>
                                <span>Email</span>
                            </div>
                            <div class="current-value-display">
                                {{ $pemilik->email }}
                            </div>
                        </div>
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-whatsapp"></i>
                                <span>No. WhatsApp</span>
                            </div>
                            <div class="current-value-display">
                                {{ $pemilik->no_wa }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Warning Card -->
            <div class="warning-card mb-4">
                <div class="warning-card-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div class="warning-card-content">
                    <h6>Perhatian!</h6>
                    <p>Password bersifat opsional. Kosongkan jika tidak ingin mengubah password. Pastikan email yang baru belum digunakan oleh user lain.</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Edit Pemilik</h5>
                        <p>Perbarui data pemilik dengan informasi yang benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST" id="formEdit">
                        @csrf
                        @method('PUT')
                        
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
                                       value="{{ old('nama', $pemilik->nama) }}" 
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
                                       value="{{ old('email', $pemilik->email) }}" 
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
                                    Password Baru
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" 
                                           id="password" 
                                           name="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           placeholder="Kosongkan jika tidak diubah">
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
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           class="form-control" 
                                           placeholder="Ketik ulang password baru">
                                    <div class="input-icon">
                                        <i class="bi bi-lock-fill"></i>
                                    </div>
                                    <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="password-note">
                            <i class="bi bi-info-circle-fill"></i>
                            <span>Password hanya akan diubah jika Anda mengisi kolom di atas. Jika kosong, password lama tetap digunakan.</span>
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
                                       value="{{ old('no_wa', $pemilik->no_wa) }}" 
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
                                          rows="3">{{ old('alamat', $pemilik->alamat) }}</textarea>
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
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Update Data</span>
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
        /* Current Value Card */
        .current-value-card {
            background: linear-gradient(135deg, #f0f9ff, #e3f2fd);
            border: 2px solid #0077b6;
            border-radius: 15px;
            overflow: hidden;
            animation: slideDown 0.5s ease;
        }

        .current-value-header {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .current-value-icon {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            backdrop-filter: blur(10px);
        }

        .current-value-text h6 {
            margin: 0 0 3px 0;
            font-size: 1rem;
            font-weight: 700;
        }

        .current-value-text p {
            margin: 0;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .current-value-body {
            padding: 25px;
        }

        .current-value-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .current-value-item {
            background: white;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            padding: 15px;
        }

        .current-value-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .current-value-label i {
            color: #0077b6;
            font-size: 1rem;
        }

        .current-value-display {
            font-size: 1rem;
            font-weight: 700;
            color: #023e8a;
            word-break: break-word;
        }

        /* Warning Card */
        .warning-card {
            background: linear-gradient(135deg, rgba(255, 165, 0, 0.05), rgba(255, 140, 0, 0.05));
            border: 2px solid rgba(255, 165, 0, 0.3);
            border-radius: 15px;
            padding: 20px 25px;
            display: flex;
            align-items: start;
            gap: 20px;
            animation: slideDown 0.6s ease;
        }

        .warning-card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #ffa500, #ff8c00);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .warning-card-content h6 {
            font-size: 1rem;
            font-weight: 700;
            color: #ff8c00;
            margin: 0 0 5px 0;
        }

        .warning-card-content p {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin: 0;
            line-height: 1.6;
        }

        /* Form Card */
        .form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(255, 165, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.7s ease;
        }

        .form-card .card-header {
            background: linear-gradient(135deg, #ffa500, #ff8c00);
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
            border-color: #ffa500;
            background: white;
            box-shadow: 0 0 0 4px rgba(255, 165, 0, 0.1);
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
            color: #ffa500;
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
            color: #ffa500;
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

        .password-note {
            background: #fff8e6;
            border-left: 3px solid #ffa500;
            padding: 12px 15px;
            border-radius: 8px;
            margin: -10px 0 25px 0;
            display: flex;
            align-items: start;
            gap: 10px;
            color: var(--text-gray);
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .password-note i {
            color: #ffa500;
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
            background: linear-gradient(135deg, #ffa500, #ff8c00);
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
            box-shadow: 0 5px 20px rgba(255, 165, 0, 0.3);
            flex: 1;
            justify-content: center;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 165, 0, 0.4);
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
            .current-value-header,
            .warning-card {
                flex-direction: column;
                text-align: center;
            }

            .current-value-grid {
                grid-template-columns: 1fr;
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

        // Auto focus and select all text
        const input = document.getElementById('nama');
        input.focus();
        input.select();

        // Form validation before submit
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            const requiredFields = ['nama', 'email', 'no_wa', 'alamat'];
            let hasError = false;

            requiredFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field && field.value.trim() === '') {
                    field.classList.add('is-invalid');
                    hasError = true;
                }
            });

            // Validate password confirmation if password is filled
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');
            if (password.value !== '' && password.value !== passwordConfirmation.value) {
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