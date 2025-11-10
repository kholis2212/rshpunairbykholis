<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter - RSHP Universitas Airlangga</title>
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
            font-family: 'Poppins', 'Segoe UI Emoji', 'Noto Color Emoji', 'Apple Color Emoji', sans-serif;
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
            background: var(--white);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            flex-shrink: 0;
            box-shadow: 0 10px 30px rgba(0, 119, 182, 0.3);
            animation: bounce 2s ease-in-out infinite;
            border: 3px solid var(--primary);
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
            margin-bottom: 35px;
            text-align: center;
        }

        .section-header h2 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--white);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .section-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.05rem;
            font-weight: 300;
        }

        /* Menu Grid */
        .menu-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
            margin-top: 30px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Menu Card */
        .menu-card {
            background: var(--white);
            border-radius: 25px;
            padding: 45px;
            text-decoration: none;
            color: var(--text-dark);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 35px;
            border: 2px solid transparent;
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
            background: radial-gradient(circle, rgba(0, 119, 182, 0.08), transparent);
            border-radius: 50%;
            transition: width 0.5s ease, height 0.5s ease;
        }

        .menu-card:hover::before {
            transform: scaleX(1);
        }

        .menu-card:hover::after {
            width: 600px;
            height: 600px;
        }

        .menu-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 70px rgba(0, 119, 182, 0.25);
            border-color: var(--primary);
        }

        .menu-icon {
            width: 90px;
            height: 90px;
            background: var(--white);
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            flex-shrink: 0;
            box-shadow: 0 10px 30px rgba(0, 119, 182, 0.2);
            transition: all 0.4s ease;
            position: relative;
            z-index: 2;
            border: 3px solid var(--primary);
        }

        .menu-card:hover .menu-icon {
            transform: scale(1.15) rotate(5deg);
            box-shadow: 0 15px 40px rgba(0, 119, 182, 0.4);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .menu-content {
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .menu-card h3 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 12px;
            transition: color 0.3s ease;
        }

        .menu-card:hover h3 {
            color: var(--primary);
        }

        .menu-card p {
            font-size: 1rem;
            color: var(--text-gray);
            line-height: 1.7;
            margin-bottom: 0;
        }

        .menu-arrow {
            position: absolute;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--light-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary);
            transition: all 0.3s ease;
            z-index: 2;
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

        .alert-success::before {
            content: "✓";
            font-size: 1.4rem;
            font-weight: bold;
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

            .section-header h2 {
                font-size: 1.6rem;
            }

            .user-details {
                display: none;
            }

            .menu-card {
                flex-direction: column;
                text-align: center;
                padding: 35px;
            }

            .menu-arrow {
                position: static;
                margin-top: 20px;
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

            .section-header h2 {
                font-size: 1.4rem;
                flex-direction: column;
            }

            .menu-card {
                padding: 30px 20px;
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
        <a href="{{ url('/dashboard') }}" class="navbar-brand">
            <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo UNAIR">
            <span class="navbar-brand-text">RSHP UNAIR</span>
        </a>
        
        <div class="navbar-menu">
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                </div>
                <div class="user-details">
                    <span class="user-name">{{ Auth::user()->nama }}</span>
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
                    🩺
                </div>
                <div class="welcome-text">
                    <h1>Selamat Datang, {{ Auth::user()->nama }}!</h1>
                    <p>Anda login sebagai <strong>Dokter Hewan ({{ Auth::user()->role }})</strong><br>
                    Akses dan evaluasi rekam medis pasien untuk monitoring kesehatan hewan</p>
                    <span class="role-badge">
                        <span>✨</span>
                        <span>{{ strtoupper(Auth::user()->role) }}</span>
                    </span>
                </div>
            </div>
        </div>

        @if(session('status'))
            <div class="alert-success">
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <!-- Menu Section -->
        <div class="section-header">
            <h2>
                <span>📋</span>
                <span>Menu Dokter Hewan</span>
            </h2>
            <p>Akses informasi rekam medis untuk evaluasi kondisi pasien</p>
        </div>

        <div class="menu-grid">
            <!-- Rekam Medis Pasien -->
            <a href="{{ route('dokter.rekam-medis.index') }}" class="menu-card">
                <div class="menu-icon">📋</div>
                <div class="menu-content">
                    <h3>Rekam Medis Pasien</h3>
                    <p>Lihat dan akses rekam medis lengkap pasien hewan untuk evaluasi dan monitoring kesehatan secara menyeluruh (View Only)</p>
                </div>
                <div class="menu-arrow">→</div>
            </a>
        </div>
    </div>
</body>
</html>