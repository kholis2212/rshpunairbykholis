<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RSHP Universitas Airlangga</title>
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

        /* Animated Background */
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

        /* Floating Shapes */
        .shape {
            position: fixed;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            animation: float 15s ease-in-out infinite;
            z-index: 0;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            bottom: 20%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            top: 60%;
            left: 70%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-30px) scale(1.05);
            }
        }

        /* Navigation Bar */
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

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

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
            background: var(--white);
            color: var(--primary);
        }

        /* Login Container */
        .login-wrapper {
            min-height: calc(100vh - 90px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            position: relative;
            z-index: 10;
        }

        .login-container {
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
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Left Side - Info Panel */
        .login-info {
            flex: 1;
            background: linear-gradient(135deg, #0077b6 0%, #023e8a 100%);
            padding: 30px 35px;
            color: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-info::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.5;
            }
        }

        .login-info > * {
            position: relative;
            z-index: 2;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo-section img {
            max-width: 400px;
            margin-bottom: 15px;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.2));
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .login-info h1 {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 12px;
            margin-left: 10px;
            line-height: 1.3;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .login-info p {
            font-size: 0.9rem;
            margin-left: 10px;
            line-height: 1.6;
            opacity: 0.95;
            font-weight: 300;
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
            font-weight: 500;
        }

        .info-features li::before {
            content: "✓";
            background: var(--accent);
            color: var(--primary-dark);
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

        /* Right Side - Form Panel */
        .login-form-panel {
            flex: 1;
            padding: 30px 35px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            margin-bottom: 30px;
        }

        .form-header h2 {
            font-size: 1.8rem;
            color: var(--primary-dark);
            margin-bottom: 8px;
            font-weight: 800;
        }

        .form-header p {
            color: var(--text-gray);
            font-size: 0.9rem;
        }

        /* Flash Message - Success */
        .alert-success {
            background: linear-gradient(135deg, #06d6a0 0%, #05b589 100%);
            color: var(--white);
            padding: 12px 18px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(6, 214, 160, 0.3);
            animation: slideDown 0.5s ease;
        }

        .alert-success::before {
            content: "✓";
            font-size: 1.1rem;
            font-weight: bold;
        }

        /* Flash Message - Error */
        .alert-danger {
            background: linear-gradient(135deg, #ef476f 0%, #d62839 100%);
            color: var(--white);
            padding: 12px 18px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(239, 71, 111, 0.3);
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
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

        .alert-danger::before {
            content: "⚠";
            font-size: 1.1rem;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
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

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 71, 111, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .invalid-feedback {
            color: var(--danger);
            font-size: 0.75rem;
            margin-top: 5px;
            display: block;
            font-weight: 500;
        }

        /* Remember Me Checkbox */
        .remember-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .remember-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--primary);
        }

        .remember-group label {
            color: var(--text-gray);
            font-size: 0.85rem;
            cursor: pointer;
            user-select: none;
            margin: 0;
            font-weight: 500;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.3);
            margin-top: 8px;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 119, 182, 0.4);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: var(--text-gray);
            font-size: 0.8rem;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            padding: 0 15px;
        }

        .links {
            text-align: center;
        }

        .links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .links a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .back-home {
            margin-top: 20px;
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
            box-shadow: 0 4px 15px rgba(0, 119, 182, 0.1);
        }

        .back-home a:hover {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.3);
        }

        .back-home a .icon {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .back-home a:hover .icon {
            transform: translateX(-3px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }

            .navbar-brand-text {
                display: none;
            }

            .navbar-menu {
                gap: 10px;
            }

            .nav-btn {
                padding: 8px 18px;
                font-size: 0.85rem;
            }

            .login-container {
                flex-direction: column;
                margin: 20px;
            }

            .login-info {
                padding: 40px 30px;
            }

            .login-info h1 {
                font-size: 1.5rem;
            }

            .login-form-panel {
                padding: 40px 30px;
            }

            .form-header h2 {
                font-size: 1.6rem;
            }

            .info-features {
                display: none;
            }
        }

        /* Loading Animation */
        .btn.loading {
            position: relative;
            color: transparent;
            pointer-events: none;
        }

        .btn.loading::after {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: var(--white);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-gray);
            font-size: 1.2rem;
            user-select: none;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary);
        }
    </style>
</head>
<body>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo UNAIR">
            <span class="navbar-brand-text">RSHP UNAIR</span>
        </a>
        <div class="navbar-menu">
            <a href="{{ route('login') }}" class="nav-btn btn-login active">
                <span>🔐</span>
                <span>Login</span>
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="nav-btn btn-register">
                    <span>✨</span>
                    <span>Register</span>
                </a>
            @endif
        </div>
    </nav>

    <div class="login-wrapper">
        <div class="login-container">
            <!-- Left Side - Info Panel -->
            <div class="login-info">
                <div class="logo-section">
                    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo UNAIR">
                </div>
                <h1>Selamat Datang di RSHP Universitas Airlangga</h1>
                <p>Masuk ke akun Anda untuk mengakses layanan pendaftaran online dan mengelola jadwal kunjungan hewan kesayangan Anda.</p>
                
                <ul class="info-features">
                    <li>Pendaftaran online 24/7</li>
                    <li>Kelola jadwal dengan mudah</li>
                    <li>Riwayat kunjungan lengkap</li>
                    <li>Notifikasi otomatis</li>
                </ul>
            </div>

            <!-- Right Side - Form Panel -->
            <div class="login-form-panel">
                <div class="form-header">
                    <h2>Login</h2>
                    <p>Masukkan email dan password Anda untuk melanjutkan</p>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert-success" id="successAlert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert-danger" id="errorAlert">
                        <div>
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div style="position: relative;">
                            <span class="input-icon">📧</span>
                            <input 
                                type="email" 
                                id="email"
                                name="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                placeholder="nama@email.com" 
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                autofocus>
                        </div>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div style="position: relative;">
                            <span class="input-icon">🔒</span>
                            <input 
                                type="password" 
                                id="password"
                                name="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                placeholder="Masukkan password Anda" 
                                required
                                autocomplete="current-password">
                            <span class="password-toggle" onclick="togglePassword()">
                                <span id="toggleIcon">👁️</span>
                            </span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="remember-group">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember" 
                            {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Ingat Saya</label>
                    </div>

                    <button type="submit" class="btn" id="loginBtn">Login</button>
                </form>

                <div class="divider">
                    <span>atau</span>
                </div>

                <div class="links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            🔑 Lupa password?
                        </a>
                    @endif
                </div>

                <div class="links" style="margin-top: 15px;">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" style="color: var(--accent); font-weight: 700;">
                            ✨ Belum punya akun? Daftar di sini
                        </a>
                    @endif
                </div>

                <div class="back-home">
                    <a href="{{ url('/') }}">
                        <span class="icon">←</span>
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
            }
        }

        // Form submission animation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });

        // Add input focus animations
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                const icon = this.parentElement.querySelector('.input-icon');
                if (icon) {
                    icon.style.transform = 'translateY(-50%) scale(1.2)';
                }
            });
            
            input.addEventListener('blur', function() {
                const icon = this.parentElement.querySelector('.input-icon');
                if (icon) {
                    icon.style.transform = 'translateY(-50%) scale(1)';
                }
            });
        });

        // Auto-hide alert messages after 5 seconds
        setTimeout(() => {
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');
            
            if (successAlert) {
                successAlert.style.animation = 'slideDown 0.5s ease reverse';
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 500);
            }
            
            if (errorAlert) {
                errorAlert.style.animation = 'shake 0.5s ease reverse';
                setTimeout(() => {
                    errorAlert.style.display = 'none';
                }, 500);
            }
        }, 5000);
    </script>
</body>
</html>