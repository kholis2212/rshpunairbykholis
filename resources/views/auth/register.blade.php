<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RSHP Universitas Airlangga</title>
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
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(0, 180, 216, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 195, 0, 0.1) 0%, transparent 50%);
            animation: rotate 20s linear infinite;
            z-index: 0;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .shape {
            position: fixed;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            animation: float 15s ease-in-out infinite;
            z-index: 0;
        }

        .shape-1 { width: 300px; height: 300px; top: 10%; left: 10%; animation-delay: 0s; }
        .shape-2 { width: 200px; height: 200px; bottom: 20%; right: 15%; animation-delay: 2s; }
        .shape-3 { width: 150px; height: 150px; top: 60%; left: 70%; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-30px) scale(1.05); }
        }

        .navbar {
            position: relative;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
        }

        .navbar-brand img {
            height: 50px;
            filter: drop-shadow(0 2px 5px rgba(0,0,0,0.3));
            background: rgba(255, 255, 255, 0.95);
            padding: 5px 10px;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img { transform: scale(1.05); }

        .navbar-brand-text {
            color: var(--white);
            font-size: 1.2rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .navbar-menu {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .nav-btn {
            padding: 10px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .nav-btn.btn-login {
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .nav-btn.btn-login:hover {
            background: var(--white);
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        .nav-btn.btn-register {
            background: linear-gradient(135deg, #ffc300 0%, #ffdb4d 100%);
            color: var(--primary-dark);
            border-color: var(--accent);
            box-shadow: 0 4px 15px rgba(255, 195, 0, 0.4);
            font-weight: 700;
        }

        .nav-btn.btn-register:hover {
            background: linear-gradient(135deg, #ffdb4d 0%, #ffe680 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 195, 0, 0.6);
        }

        .nav-btn.active {
            background: linear-gradient(135deg, #ffc300 0%, #ffdb4d 100%);
            color: var(--primary-dark);
            box-shadow: 0 4px 15px rgba(255, 195, 0, 0.4);
        }

        .register-wrapper {
            min-height: calc(100vh - 90px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            position: relative;
            z-index: 10;
        }

        .register-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: var(--white);
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-info {
            flex: 1;
            background: linear-gradient(135deg, #ffc300 0%, #ffaa00 100%);
            padding: 30px 35px;
            color: var(--primary-dark);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .register-info::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.5; }
        }

        .register-info > * { position: relative; z-index: 2; }

        .logo-section {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo-section img {
            max-width: 350px;
            margin-bottom: 15px;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.2));
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .register-info h1 {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 12px;
            margin-left: 10px;
            line-height: 1.3;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .register-info p {
            font-size: 0.85rem;
            margin-left: 10px;
            line-height: 1.6;
            opacity: 0.95;
            font-weight: 400;
        }

        .info-features {
            list-style: none;
            margin-top: 20px;
        }

        .info-features li {
            padding: 8px 0;
            margin-left: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .info-features li::before {
            content: "✓";
            background: var(--primary);
            color: var(--white);
            width: 24px;
            height: 24px;
            margin-left: 10px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
            font-size: 0.75rem;
        }

        .register-form-panel {
            flex: 1;
            padding: 30px 35px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header { margin-bottom: 25px; }

        .form-header h2 {
            font-size: 1.7rem;
            color: var(--primary-dark);
            margin-bottom: 8px;
            font-weight: 800;
        }

        .form-header p {
            color: var(--text-gray);
            font-size: 0.9rem;
        }

        .alert-success, .alert-danger {
            padding: 12px 18px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--white);
        }

        .alert-success {
            background: linear-gradient(135deg, #06d6a0 0%, #05b589 100%);
            box-shadow: 0 4px 15px rgba(6, 214, 160, 0.3);
        }

        .alert-danger {
            background: linear-gradient(135deg, #ef476f 0%, #d62839 100%);
            box-shadow: 0 4px 15px rgba(239, 71, 111, 0.3);
        }

        .form-group {
            margin-bottom: 16px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.85rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 18px;
            padding-left: 45px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 0.9rem;
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

        .form-control.is-invalid {
            border-color: var(--danger);
            background: #fff5f7;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 1.1rem;
        }

        .invalid-feedback {
            color: var(--danger);
            font-size: 0.75rem;
            margin-top: 5px;
            display: block;
            font-weight: 500;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--accent) 0%, #ffaa00 100%);
            color: var(--primary-dark);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(255, 195, 0, 0.4);
            margin-top: 15px;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 195, 0, 0.5);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: var(--text-gray);
            font-size: 0.8rem;
        }

        .divider::before, .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span { padding: 0 15px; }

        .links {
            text-align: center;
        }

        .links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .links a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .back-home {
            margin-top: 15px;
            text-align: center;
        }

        .back-home a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 25px;
            background: linear-gradient(135deg, var(--light-bg), #e3f2fd);
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 50px;
            border: 2px solid var(--primary);
            transition: all 0.3s ease;
        }

        .back-home a:hover {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            transform: translateY(-2px);
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-gray);
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover { color: var(--primary); }

        @media (max-width: 768px) {
            .navbar { padding: 15px 20px; }
            .navbar-brand-text { display: none; }
            .register-container { flex-direction: column; }
            .info-features { display: none; }
        }
    </style>
</head>
<body>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>

    <nav class="navbar">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo UNAIR">
            <span class="navbar-brand-text">RSHP UNAIR</span>
        </a>
        <div class="navbar-menu">
            <a href="{{ route('login') }}" class="nav-btn btn-login">
                <span>🔐</span>
                <span>Login</span>
            </a>
            <a href="{{ route('register') }}" class="nav-btn btn-register active">
                <span>✨</span>
                <span>Register</span>
            </a>
        </div>
    </nav>

    <div class="register-wrapper">
        <div class="register-container">
            <div class="register-info">
                <div class="logo-section">
                    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo UNAIR">
                </div>
                <h1>Bergabung dengan RSHP Universitas Airlangga</h1>
                <p>Daftar sekarang untuk mendapatkan akses penuh ke layanan kesehatan hewan terbaik.</p>
                
                <ul class="info-features">
                    <li>Akses layanan 24/7</li>
                    <li>Notifikasi jadwal otomatis</li>
                    <li>Riwayat medis lengkap</li>
                    <li>Konsultasi online</li>
                </ul>
            </div>

            <div class="register-form-panel">
                <div class="form-header">
                    <h2>Daftar Akun Baru</h2>
                    <p>Lengkapi data di bawah untuk membuat akun</p>
                </div>

                @if (session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <div style="position: relative;">
                            <span class="input-icon">👤</span>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div style="position: relative;">
                            <span class="input-icon">📧</span>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div style="position: relative;">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter" required autocomplete="new-password">
                            <span class="password-toggle" onclick="togglePassword('password', 'icon1')">
                                <span id="icon1">👁️</span>
                            </span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Konfirmasi Password</label>
                        <div style="position: relative;">
                            <span class="input-icon">🔐</span>
                            <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Ulangi password Anda" required autocomplete="new-password">
                            <span class="password-toggle" onclick="togglePassword('password-confirm', 'icon2')">
                                <span id="icon2">👁️</span>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn">Daftar Sekarang</button>
                </form>

                <div class="divider"><span>atau</span></div>

                <div class="links">
                    <a href="{{ route('login') }}">🔐 Sudah punya akun? Login di sini</a>
                </div>

                <div class="back-home">
                    <a href="{{ url('/') }}">
                        <span>←</span>
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = '🙈';
            } else {
                input.type = 'password';
                icon.textContent = '👁️';
            }
        }
    </script>
</body>
</html>