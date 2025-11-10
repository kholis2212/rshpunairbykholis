<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - RSHP UNAIR</title>
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
            max-width: 700px;
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
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
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
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(0, 119, 182, 0.1);
        }

        .form-control::placeholder {
            color: #a0a0a0;
        }

        .input-icon {
            position: relative;
        }

        .input-icon input {
            padding-left: 48px;
        }

        .input-icon::before {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.3rem;
        }

        .input-icon.icon-name::before {
            content: "👤";
        }

        .input-icon.icon-email::before {
            content: "📧";
        }

        .input-icon.icon-password::before {
            content: "🔒";
        }

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

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 119, 182, 0.4);
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
            background: #f0f9ff;
            border-left: 4px solid var(--primary);
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
            content: "💡";
            font-size: 1.3rem;
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
                <div class="form-header-icon">👥</div>
                <h1>Tambah User</h1>
                <p>Isi formulir di bawah untuk menambah user baru</p>
            </div>

            <!-- Body -->
            <div class="form-body">
                <div class="form-hint">
                    <span>Pastikan email yang Anda masukkan belum terdaftar dalam sistem</span>
                </div>

                <form action="{{ route('admin.user.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nama">
                            Nama Lengkap
                            <span class="required">*</span>
                        </label>
                        <div class="input-icon icon-name">
                            <input type="text" 
                                   id="nama" 
                                   name="nama" 
                                   class="form-control @error('nama') error @enderror" 
                                   value="{{ old('nama') }}" 
                                   placeholder="Contoh: John Doe"
                                   autofocus>
                        </div>
                        @error('nama')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

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
                                   value="{{ old('email') }}" 
                                   placeholder="Contoh: user@mail.com">
                        </div>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">
                            Password
                            <span class="required">*</span>
                        </label>
                        <div class="input-icon icon-password">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control @error('password') error @enderror" 
                                   placeholder="Minimal 6 karakter">
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <span>💾</span>
                            <span>Simpan User</span>
                        </button>
                        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                            <span>↩️</span>
                            <span>Kembali</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto focus on input
        document.getElementById('nama').focus();

        // Form validation before submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const nama = document.getElementById('nama');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            
            let isValid = true;
            
            if (nama.value.trim() === '') {
                nama.classList.add('error');
                nama.focus();
                isValid = false;
            }
            
            if (email.value.trim() === '') {
                email.classList.add('error');
                if (isValid) email.focus();
                isValid = false;
            }
            
            if (password.value.trim() === '') {
                password.classList.add('error');
                if (isValid) password.focus();
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });

        // Remove error class on input
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });
    </script>
</body>
</html>