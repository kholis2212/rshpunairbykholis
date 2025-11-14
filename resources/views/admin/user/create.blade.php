{{-- views/admin/user/create.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Tambah User - RSHP UNAIR')

@section('page-icon', 'person-plus-fill')
@section('page-title', 'Tambah User')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Data User</a></li>
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
                    <p>Pastikan email yang Anda masukkan belum terdaftar dalam sistem untuk menghindari duplikasi data</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Tambah User</h5>
                        <p>Isi formulir di bawah dengan lengkap dan benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="POST" id="formCreate">
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
                                       placeholder="Contoh: John Doe"
                                       autofocus>
                                <div class="input-icon">
                                    <i class="bi bi-person-badge-fill"></i>
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
                                <span>Masukkan nama lengkap user yang akan didaftarkan</span>
                            </div>
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
                                       placeholder="Contoh: user@example.com">
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

                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="bi bi-key-fill me-2"></i>
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
                                    <i class="bi bi-shield-lock-fill"></i>
                                </div>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Password harus terdiri dari minimal 6 karakter</span>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-save-fill"></i>
                                <span>Simpan Data</span>
                            </button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary btn-cancel">
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
            const nama = document.getElementById('nama');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            let hasError = false;

            if (nama.value.trim() === '') {
                nama.classList.add('is-invalid');
                hasError = true;
            }

            if (email.value.trim() === '') {
                email.classList.add('is-invalid');
                hasError = true;
            }

            if (password.value.trim() === '') {
                password.classList.add('is-invalid');
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
                
                // Tambahkan pesan error custom jika belum ada
                if (nama.value.trim() === '' && !nama.parentNode.querySelector('.invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                    errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Nama wajib diisi!</span>';
                    nama.parentNode.appendChild(errorDiv);
                }

                if (email.value.trim() === '' && !email.parentNode.querySelector('.invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                    errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Email wajib diisi!</span>';
                    email.parentNode.appendChild(errorDiv);
                }

                if (password.value.trim() === '' && !password.parentNode.querySelector('.invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                    errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Password wajib diisi!</span>';
                    password.parentNode.appendChild(errorDiv);
                }

                if (nama.value.trim() === '') {
                    nama.focus();
                } else if (email.value.trim() === '') {
                    email.focus();
                } else {
                    password.focus();
                }
            }
        });

        // Remove error class on input
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
                // Hapus pesan error custom jika ada
                const customError = this.parentNode.querySelector('.invalid-feedback');
                if (customError && !this.parentNode.querySelector('.is-invalid')) {
                    customError.remove();
                }
            });
        });
    </script>
@endsection