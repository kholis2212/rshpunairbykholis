<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemilik - RSHP UNAIR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0077b6;
            --primary-dark: #023e8a;
            --secondary: #00b4d8;
            --accent: #ffc300;
            --success: #06d6a0;
            --danger: #ef476f;
            --warning: #ffa500;
            --light-bg: #f8fbff;
            --white: #ffffff;
            --text-dark: #1a1a2e;
            --text-gray: #4a5568;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0077b6 0%, #023e8a 100%);
            min-height: 100vh;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 800px;
            width: 100%;
        }

        /* Form Card */
        .form-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: slideUp 0.5s ease;
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

        .form-header {
            background: linear-gradient(135deg, var(--warning), #ff8c00);
            color: var(--white);
            padding: 35px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .form-header-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 20px;
            backdrop-filter: blur(10px);
        }

        .form-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .form-header p {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .form-body {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .required {
            color: var(--danger);
            margin-left: 3px;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            background: var(--light-bg);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--warning);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(255, 165, 0, 0.1);
        }

        .form-control::placeholder {
            color: #a0a0a0;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .input-icon {
            position: relative;
        }

        .input-icon input,
        .input-icon textarea {
            padding-left: 48px;
        }

        .input-icon::before {
            position: absolute;
            left: 18px;
            top: 18px;
            font-size: 1.3rem;
            z-index: 1;
        }

        .input-icon.icon-user::before { content: "👤"; }
        .input-icon.icon-email::before { content: "📧"; }
        .input-icon.icon-password::before { content: "🔒"; }
        .input-icon.icon-whatsapp::before { content: "📱"; }
        .input-icon.icon-address::before { content: "🏠"; }

        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .error-message::before {
            content: "⚠️";
        }

        .form-control.error {
            border-color: var(--danger);
            background: #fff5f5;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 35px;
        }

        .btn {
            flex: 1;
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #ff8c00);
            color: var(--white);
            box-shadow: 0 5px 20px rgba(255, 165, 0, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(255, 165, 0, 0.4);
        }

        .btn-secondary {
            background: var(--light-bg);
            color: var(--text-dark);
            border: 2px solid #e8e8e8;
        }

        .btn-secondary:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
        }

        .form-hint {
            background: #fff8e6;
            border-left: 4px solid var(--warning);
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            color: var(--text-gray);
            font-size: 0.9rem;
            display: flex;
            align-items: start;
            gap: 12px;
        }

        .form-hint::before {
            content: "⚠️";
            font-size: 1.3rem;
        }

        .current-value {
            background: #f0f9ff;
            border: 2px solid var(--primary);
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .current-value-label {
            font-size: 0.85rem;
            color: var(--text-gray);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .current-value-text {
            font-size: 1.1rem;
            color: var(--primary-dark);
            font-weight: 700;
        }

        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
            user-select: none;
        }

        .password-note {
            background: #fffbeb;
            border: 2px dashed var(--warning);
            border-radius: 8px;
            padding: 12px 15px;
            margin-top: 10px;
            font-size: 0.85rem;
            color: var(--text-gray);
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .form-header {
                padding: 30px 25px;
            }

            .form-header h1 {
                font-size: 1.5rem;
            }

            .form-body {
                padding: 30px 25px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <!-- Header -->
            <div class="form-header">
                <div class="form-header-icon">✏️</div>
                <h1>Edit Pemilik Hewan</h1>
                <p>Perbarui data pemilik yang sudah ada</p>
            </div>

            <!-- Body -->
            <div class="form-body">
                <div class="current-value">
                    <div class="current-value-label">📝 Data Pemilik Saat Ini:</div>
                    <div class="current-value-text">{{ $pemilik->user->nama }} ({{ $pemilik->user->email }})</div>
                </div>

                <div class="form-hint">
                    <span>Password bersifat opsional. Kosongkan jika tidak ingin mengubah password.</span>
                </div>

                <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama -->
                    <div class="form-group">
                        <label for="nama">
                            Nama Lengkap
                            <span class="required">*</span>
                        </label>
                        <div class="input-icon icon-user">
                            <input type="text" 
                                   id="nama" 
                                   name="nama" 
                                   class="form-control @error('nama') error @enderror" 
                                   value="{{ old('nama', $pemilik->user->nama) }}" 
                                   placeholder="Contoh: Budi Santoso"
                                   autofocus>
                        </div>
                        @error('nama')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">
                            Email
                            <span class="required">*</span>
                        </label>
                        <div class="input-icon icon-email">
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control @error('email') error @enderror" 
                                   value="{{ old('email', $pemilik->user->email) }}" 
                                   placeholder="contoh@email.com">
                        </div>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password & Confirm Password -->
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="password">
                                Password Baru
                            </label>
                            <div class="input-icon icon-password" style="position: relative;">
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       class="form-control @error('password') error @enderror" 
                                       placeholder="Kosongkan jika tidak diubah">
                                <span class="password-toggle" onclick="togglePassword('password')">👁️</span>
                            </div>
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">
                                Konfirmasi Password
                            </label>
                            <div class="input-icon icon-password" style="position: relative;">
                                <input type="password" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       class="form-control" 
                                       placeholder="Ketik ulang password baru">
                                <span class="password-toggle" onclick="togglePassword('password_confirmation')">👁️</span>
                            </div>
                        </div>
                    </div>
                    <div class="password-note">
                        💡 <strong>Catatan:</strong> Password hanya akan diubah jika Anda mengisi kolom di atas. Jika kosong, password lama tetap digunakan.
                    </div>

                    <!-- No WhatsApp -->
                    <div class="form-group">
                        <label for="no_wa">
                            Nomor WhatsApp
                            <span class="required">*</span>
                        </label>
                        <div class="input-icon icon-whatsapp">
                            <input type="text" 
                                   id="no_wa" 
                                   name="no_wa" 
                                   class="form-control @error('no_wa') error @enderror" 
                                   value="{{ old('no_wa', $pemilik->no_wa) }}" 
                                   placeholder="Contoh: 081234567890">
                        </div>
                        @error('no_wa')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <label for="alamat">
                            Alamat Lengkap
                            <span class="required">*</span>
                        </label>
                        <div class="input-icon icon-address">
                            <textarea id="alamat" 
                                      name="alamat" 
                                      class="form-control @error('alamat') error @enderror" 
                                      placeholder="Masukkan alamat lengkap">{{ old('alamat', $pemilik->alamat) }}</textarea>
                        </div>
                        @error('alamat')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">
                            <span>💾</span>
                            <span>Update Data</span>
                        </button>
                        <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">
                            <span>↩️</span>
                            <span>Kembali</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggle = field.nextElementSibling;
            
            if (field.type === 'password') {
                field.type = 'text';
                toggle.textContent = '🙈';
            } else {
                field.type = 'password';
                toggle.textContent = '👁️';
            }
        }

        // Auto focus on input
        document.getElementById('nama').focus();

        // Select all text on focus
        document.getElementById('nama').addEventListener('focus', function() {
            this.select();
        });

        // Form validation before submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const requiredFields = ['nama', 'email', 'no_wa', 'alamat'];
            let hasError = false;

            requiredFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field && field.value.trim() === '') {
                    field.classList.add('error');
                    hasError = true;
                }
            });

            // Validate password confirmation if password is filled
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');
            if (password.value !== '' && password.value !== passwordConfirmation.value) {
                password.classList.add('error');
                passwordConfirmation.classList.add('error');
                hasError = true;
                alert('Password dan konfirmasi password tidak cocok!');
            }

            if (hasError) {
                e.preventDefault();
                document.querySelector('.error').focus();
            }
        });

        // Remove error class on input
        document.querySelectorAll('.form-control').forEach(field => {
            field.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });
    </script>
</body>
</html>