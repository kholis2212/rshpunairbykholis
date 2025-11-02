<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - RSHP Universitas Airlangga</title>
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
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-bottom: 3px solid var(--accent);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
        }

        .navbar-brand img {
            height: 50px;
            filter: drop-shadow(0 2px 5px rgba(0,0,0,0.2));
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        .navbar-brand-text {
            color: var(--primary-dark);
            font-size: 1.2rem;
            font-weight: 700;
        }

        .navbar-menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 20px;
            background: var(--light-bg);
            border-radius: 50px;
            border: 2px solid var(--primary);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.9rem;
            line-height: 1.2;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-gray);
            text-transform: uppercase;
        }

        .logout-btn {
            padding: 10px 25px;
            background: linear-gradient(135deg, var(--danger) 0%, #d62839 100%);
            color: var(--white);
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(239, 71, 111, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 71, 111, 0.5);
        }

        /* Dashboard Container */
        .dashboard-container {
            padding: 40px 30px;
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        /* Welcome Card */
        .welcome-card {
            background: var(--white);
            border-radius: 25px;
            padding: 45px;
            margin-bottom: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            border: 3px solid transparent;
            background-clip: padding-box;
        }

        .welcome-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 25px;
            padding: 3px;
            background: linear-gradient(135deg, var(--accent), var(--secondary), var(--primary));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            z-index: -1;
        }

        .welcome-card::after {
            content: "";
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(0, 119, 182, 0.1), rgba(255, 195, 0, 0.1));
            border-radius: 50%;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.5;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.3;
            }
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .welcome-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            flex-shrink: 0;
            box-shadow: 0 10px 30px rgba(0, 119, 182, 0.3);
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .welcome-text h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-text p {
            font-size: 1.1rem;
            color: var(--text-gray);
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--accent), #ffdb4d);
            color: var(--primary-dark);
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 5px 20px rgba(255, 195, 0, 0.4);
        }

        /* Section Header */
        .section-header {
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-header h2 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--white);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            margin: 0;
        }

        .section-icon {
            width: 50px;
            height: 50px;
            background: var(--accent);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 5px 20px rgba(255, 195, 0, 0.4);
        }

        /* Menu Grid */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        /* Menu Card */
        .menu-card {
            background: var(--white);
            border-radius: 25px;
            padding: 35px;
            text-decoration: none;
            color: var(--text-dark);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 3px solid transparent;
            display: block;
        }

        .menu-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .menu-card::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(0, 119, 182, 0.1), transparent);
            border-radius: 50%;
            transition: width 0.6s ease, height 0.6s ease;
        }

        .menu-card:hover::before {
            transform: scaleX(1);
        }

        .menu-card:hover::after {
            width: 500px;
            height: 500px;
        }

        .menu-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 70px rgba(0, 119, 182, 0.2);
            border-color: var(--primary);
        }

        .menu-card-content {
            position: relative;
            z-index: 2;
        }

        .menu-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0, 119, 182, 0.3);
            transition: all 0.4s ease;
        }

        .menu-card:hover .menu-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 40px rgba(0, 119, 182, 0.5);
        }

        .menu-card h3 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 12px;
            transition: all 0.3s ease;
        }

        .menu-card:hover h3 {
            color: var(--primary);
        }

        .menu-card p {
            font-size: 0.95rem;
            color: var(--text-gray);
            line-height: 1.7;
            margin-bottom: 0;
        }

        /* Submenu Indicator */
        .submenu-indicator {
            position: absolute;
            top: 25px;
            right: 25px;
            background: var(--accent);
            color: var(--primary-dark);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.9rem;
            box-shadow: 0 4px 15px rgba(255, 195, 0, 0.4);
            z-index: 3;
            animation: pulse-badge 2s ease-in-out infinite;
        }

        @keyframes pulse-badge {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 4px 15px rgba(255, 195, 0, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 6px 20px rgba(255, 195, 0, 0.6);
            }
        }

        /* Arrow Icon */
        .menu-arrow {
            position: absolute;
            bottom: 25px;
            right: 25px;
            width: 40px;
            height: 40px;
            background: var(--light-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--primary);
            transition: all 0.3s ease;
        }

        .menu-card:hover .menu-arrow {
            background: var(--primary);
            color: var(--white);
            transform: translateX(5px);
        }

        /* Alert Success */
        .alert-success {
            background: linear-gradient(135deg, #06d6a0 0%, #05b589 100%);
            color: white;
            padding: 18px 25px;
            margin-bottom: 30px;
            border-radius: 15px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 8px 25px rgba(6, 214, 160, 0.3);
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

        /* Responsive */
        @media (max-width: 968px) {
            .navbar {
                padding: 15px 30px;
            }

            .navbar-brand-text {
                display: none;
            }

            .welcome-content {
                flex-direction: column;
                text-align: center;
            }

            .welcome-text h1 {
                font-size: 1.8rem;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }

            .section-header h2 {
                font-size: 1.5rem;
            }

            .user-details {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .navbar {
                padding: 15px 20px;
            }

            .dashboard-container {
                padding: 30px 20px;
            }

            .welcome-card {
                padding: 30px 25px;
            }

            .user-info {
                padding: 8px 15px;
            }
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
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="user-details">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-role">{{ Auth::user()->role }}</span>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">
                    <span>🚪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <div class="dashboard-container">
        <!-- Welcome Card -->
        <div class="welcome-card">
            <div class="welcome-content">
                <div class="welcome-icon">
                    @php
                    $role = Auth::user()->role ?? 'guest';
                    @endphp
                    @if(Auth::user()->role === 'admin')
                        👨‍💼
                    @elseif(Auth::user()->role === 'dokter')
                        🩺
                    @elseif(Auth::user()->role === 'perawat')
                        💉
                    @elseif(Auth::user()->role === 'resepsionis')
                        📞
                    @elseif(Auth::user()->role === 'pemilik')
                        🐾
                    @endif
                </div>
                <div class="welcome-text">
                    <h1>Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                    <p>Anda login sebagai 
                        @if(Auth::user()->role === 'admin')
                            <strong>Administrator</strong> - Kelola seluruh sistem dan data master
                        @elseif(Auth::user()->role === 'dokter')
                            <strong>Dokter Hewan</strong> - Akses rekam medis pasien
                        @elseif(Auth::user()->role === 'perawat')
                            <strong>Perawat</strong> - Kelola rekam medis dan tindakan terapi
                        @elseif(Auth::user()->role === 'resepsionis')
                            <strong>Resepsionis</strong> - Kelola registrasi dan jadwal temu dokter
                        @elseif(Auth::user()->role === 'pemilik')
                            <strong>Pemilik Hewan</strong> - Pantau kesehatan hewan kesayangan Anda
                        @endif
                    </p>
                    <span class="role-badge">
                        <span>✨</span>
                        <span>{{ strtoupper(Auth::user()->role) }}</span>
                    </span>
                </div>
            </div>
        </div>

        @if(session('status'))
            <div class="alert-success">
                <span style="font-size: 1.3rem;">✓</span>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <!-- Dashboard Content Based on Role -->
        @if(Auth::user()->role === 'admin')
            <!-- Admin Dashboard -->
            <div class="section-header">
                <div class="section-icon">📊</div>
                <h2>Dashboard Administrator</h2>
            </div>
            
            <div class="menu-grid">
                <a href="{{ route('admin.data-master.index') }}" class="menu-card">
                    <div class="submenu-indicator">8</div>
                    <div class="menu-card-content">
                        <div class="menu-icon">🗂️</div>
                        <h3>Data Master</h3>
                        <p>Kelola seluruh data master sistem: User, Role, Jenis Hewan, Ras, Pemilik, Pet, Kategori, Kategori Klinis, dan Kode Tindakan Terapi</p>
                    </div>
                    <div class="menu-arrow">→</div>
                </a>
            </div>

        @elseif(Auth::user()->role === 'dokter')
            <!-- Dokter Dashboard -->
            <div class="section-header">
                <div class="section-icon">🩺</div>
                <h2>Dashboard Dokter Hewan</h2>
            </div>
            
            <div class="menu-grid">
                <a href="{{ route('dokter.rekam-medis.index') }}" class="menu-card">
                    <div class="menu-card-content">
                        <div class="menu-icon">📋</div>
                        <h3>Rekam Medis Pasien</h3>
                        <p>Lihat dan akses rekam medis pasien untuk evaluasi dan monitoring kesehatan (View Only)</p>
                    </div>
                    <div class="menu-arrow">→</div>
                </a>
            </div>

        @elseif(Auth::user()->role === 'perawat')
            <!-- Perawat Dashboard -->
            <div class="section-header">
                <div class="section-icon">💉</div>
                <h2>Dashboard Perawat</h2>
            </div>
            
            <div class="menu-grid">
                <a href="{{ route('perawat.rekam-medis.index') }}" class="menu-card">
                    <div class="menu-card-content">
                        <div class="menu-icon">📝</div>
                        <h3>Rekam Medis</h3>
                        <p>Kelola rekam medis pasien dan tindakan terapi dengan full akses CRUD (Create, Read, Update, Delete)</p>
                    </div>
                    <div class="menu-arrow">→</div>
                </a>
            </div>

        @elseif(Auth::user()->role === 'resepsionis')
            <!-- Resepsionis Dashboard -->
            <div class="section-header">
                <div class="section-icon">📞</div>
                <h2>Dashboard Resepsionis</h2>
            </div>
            
            <div class="menu-grid">
                <a href="{{ route('resepsionis.registrasi.index') }}" class="menu-card">
                    <div class="submenu-indicator">2</div>
                    <div class="menu-card-content">
                        <div class="menu-icon">📝</div>
                        <h3>Registrasi</h3>
                        <p>Kelola registrasi pemilik hewan dan registrasi pet baru ke dalam sistem</p>
                    </div>
                    <div class="menu-arrow">→</div>
                </a>

                <a href="{{ route('resepsionis.temu-dokter.index') }}" class="menu-card">
                    <div class="menu-card-content">
                        <div class="menu-icon">🗓️</div>
                        <h3>Temu Dokter</h3>
                        <p>Kelola jadwal temu dokter hari ini dan buat janji konsultasi untuk pasien</p>
                    </div>
                    <div class="menu-arrow">→</div>
                </a>
            </div>

        @elseif(Auth::user()->role === 'pemilik')
            <!-- Pemilik Dashboard -->
            <div class="section-header">
                <div class="section-icon">🐾</div>
                <h2>Dashboard Pemilik Hewan</h2>
            </div>
            
            <div class="menu-grid">
                <a href="{{ route('pemilik.pet.index') }}" class="menu-card">
                    <div class="menu-card-content">
                        <div class="menu-icon">🐕</div>
                        <h3>Daftar Pet Saya</h3>
                        <p>Lihat daftar hewan kesayangan Anda yang terdaftar di sistem</p>
                    </div>
                    <div class="menu-arrow">→</div>
                </a>

                <a href="{{ route('pemilik.reservasi.index') }}" class="menu-card">
                    <div class="menu-card-content">
                        <div class="menu-icon">📅</div>
                        <h3>Daftar Reservasi Saya</h3>
                        <p>Lihat riwayat reservasi dan jadwal kunjungan hewan kesayangan Anda</p>
                    </div>
                    <div class="menu-arrow">→</div>
                </a>

                <a href="{{ route('pemilik.rekam-medis.index') }}" class="menu-card">
                    <div class="menu-card-content">
                        <div class="menu-icon">📄</div>
                        <h3>Daftar Rekam Medis Pet</h3>
                        <p>Lihat rekam medis lengkap dan riwayat kesehatan hewan kesayangan Anda</p>
                    </div>
                    <div class="menu-arrow">→</div>
                </a>
            </div>
        @endif
    </div>
</body>
</html>