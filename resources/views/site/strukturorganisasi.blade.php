<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi - RSHP Universitas Airlangga</title>
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
            --light-bg: #f8fbff;
            --white: #ffffff;
            --text-dark: #1a1a2e;
            --text-gray: #4a5568;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* === HEADER === */
        header {
            background: linear-gradient(135deg, #0077b6 0%, #023e8a 100%);
            color: var(--white);
            padding: 25px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 30px;
            position: relative;
            z-index: 2;
        }

        .logo-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            text-align: center;
        }

        .logo-section img {
            max-height: 80px;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.2));
            transition: transform 0.3s ease;
        }

        .logo-section img:hover {
            transform: scale(1.05);
        }

        .header-text h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .header-text p {
            font-size: 0.95rem;
            opacity: 0.95;
            font-weight: 300;
        }

        /* === NAVIGATION === */
        nav {
            background-color: var(--white);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 30px;
            flex-wrap: wrap;
        }

        nav a {
            text-decoration: none;
            color: var(--primary);
            margin: 0 25px;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 18px 0;
            display: inline-block;
            position: relative;
            transition: all 0.3s ease;
        }

        nav a.active {
            color: var(--primary-dark);
        }

        nav a::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--secondary));
            transition: width 0.3s ease;
            border-radius: 3px;
        }

        nav a:hover::before,
        nav a.active::before {
            width: 100%;
        }

        /* === BREADCRUMB === */
        .breadcrumb {
            max-width: 1200px;
            margin: 30px auto 0;
            padding: 0 30px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            color: var(--text-gray);
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .breadcrumb a:hover {
            color: var(--primary-dark);
        }

        .breadcrumb span {
            color: var(--text-gray);
        }

        /* === PAGE HEADER === */
        .page-header {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 30px;
            text-align: center;
        }

        .page-header h2 {
            font-size: 2.5rem;
            color: var(--primary-dark);
            margin-bottom: 15px;
            font-weight: 800;
        }

        .page-header p {
            font-size: 1.1rem;
            color: var(--text-gray);
            max-width: 700px;
            margin: 0 auto;
        }

        /* === ORGANIZATION CHART === */
        .org-container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 30px;
        }

        .org-level {
            margin-bottom: 40px;
        }

        .org-level-title {
            text-align: center;
            font-size: 1.3rem;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Director Level */
        .director-box {
            max-width: 400px;
            margin: 0 auto 50px;
        }

        /* Grid Levels */
        .org-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .org-grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            max-width: 700px;
            margin: 0 auto 40px;
        }

        .org-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            max-width: 900px;
            margin: 0 auto 40px;
        }

        .org-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin: 0 auto 40px;
        }

        .position-card {
            background: var(--white);
            border-radius: 20px;
            padding: 30px 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.06);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
            text-align: center;
        }

        .position-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .position-card:hover::before {
            transform: scaleX(1);
        }

        .position-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,119,182,0.15);
            border-color: var(--primary);
        }

        .position-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin: 0 auto 18px;
            box-shadow: 0 10px 30px rgba(0,119,182,0.2);
        }

        .position-title {
            color: var(--primary-dark);
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .position-name {
            color: var(--text-dark);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .position-nip {
            color: var(--text-gray);
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Connector Lines */
        .connector {
            text-align: center;
            margin: 20px 0;
            color: var(--primary);
            font-size: 2rem;
        }

        /* Info Section */
        .info-section {
            background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 100%);
            padding: 80px 30px;
            margin-top: 60px;
        }

        .info-content {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        .info-content h3 {
            font-size: 2rem;
            color: var(--primary-dark);
            margin-bottom: 20px;
            font-weight: 800;
        }

        .info-content p {
            font-size: 1.1rem;
            color: var(--text-gray);
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .info-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .stat-box {
            background: var(--white);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0,119,182,0.15);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .stat-label {
            color: var(--text-gray);
            font-weight: 600;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            padding: 80px 30px;
            text-align: center;
            color: var(--white);
        }

        .cta-content h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 800;
        }

        .cta-content p {
            font-size: 1.1rem;
            margin-bottom: 40px;
            opacity: 0.95;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn {
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: var(--accent);
            color: var(--primary-dark);
            box-shadow: 0 8px 25px rgba(255, 195, 0, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 195, 0, 0.4);
        }

        /* Footer */
        footer {
            background: var(--primary-dark);
            color: var(--white);
            padding: 30px;
            text-align: center;
            border-top: 4px solid var(--accent);
        }

        footer p {
            opacity: 0.9;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .org-grid-2,
            .org-grid-3 {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .page-header h2 {
                font-size: 2rem;
            }

            .position-title {
                font-size: 1.1rem;
            }

            .position-name {
                font-size: 1rem;
            }
        }

        @media (max-width: 640px) {
            nav a {
                margin: 0 10px;
                padding: 15px 0;
                font-size: 0.85rem;
            }

            .page-header h2 {
                font-size: 1.8rem;
            }

            .org-grid {
                grid-template-columns: 1fr;
            }

            .cta-content h2 {
                font-size: 2rem;
            }
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="header-content">
            <div class="logo-section">
                <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo Universitas Airlangga">
                <div class="header-text">
                    <h1>Rumah Sakit Hewan Pendidikan UNAIR</h1>
                    <p>Melayani dengan Kasih Sayang & Profesionalitas</p>
                </div>
            </div>
        </div>
    </header>

    <!-- NAVIGATION -->
    <nav>
        <div class="nav-container">
            <a href="/">Beranda</a>
            <a href="/strukturorganisasi" class="active">Struktur Organisasi</a>
            <a href="/layananumum">Layanan Umum</a>
            <a href="/visimisidantujuan">Visi Misi & Tujuan</a>
            <a href="/login">Login</a>
        </div>
    </nav>

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="/">Beranda</a>
        <span>›</span>
        <span>Struktur Organisasi</span>
    </div>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h2>Struktur Organisasi</h2>
        <p>Kepemimpinan dan tim profesional yang berdedikasi untuk memberikan pelayanan kesehatan hewan terbaik</p>
    </div>

    <!-- ORGANIZATION CHART -->
    <div class="org-container">
        
        <!-- Level 1: Direktur -->
        <div class="org-level">
            <div class="org-level-title">Pimpinan</div>
            <div class="director-box">
                <div class="position-card">
                    <div class="position-icon">👨‍💼</div>
                    <div class="position-title">Direktur RSHP</div>
                    <div class="position-name">Prof. Dr. drh. Ahmad Suryadi, M.Vet</div>
                    <div class="position-nip">NIP. 196805121993031002</div>
                </div>
            </div>
        </div>

        <div class="connector">↓</div>

        <!-- Level 2: Wakil Direktur -->
        <div class="org-level">
            <div class="org-level-title">Wakil Direktur</div>
            <div class="org-grid-2">
                <div class="position-card">
                    <div class="position-icon">👩‍💼</div>
                    <div class="position-title">Wakil Direktur Bidang Akademik</div>
                    <div class="position-name">Dr. drh. Siti Aminah, M.Si</div>
                    <div class="position-nip">NIP. 197203151998032001</div>
                </div>
                <div class="position-card">
                    <div class="position-icon">👨‍💼</div>
                    <div class="position-title">Wakil Direktur Bidang Umum</div>
                    <div class="position-name">drh. Budi Santoso, M.Vet</div>
                    <div class="position-nip">NIP. 197508202000031003</div>
                </div>
            </div>
        </div>

        <div class="connector">↓</div>

        <!-- Level 3: Kepala Divisi -->
        <div class="org-level">
            <div class="org-level-title">Kepala Divisi</div>
            <div class="org-grid-3">
                <div class="position-card">
                    <div class="position-icon">🏥</div>
                    <div class="position-title">Kepala Divisi Medis</div>
                    <div class="position-name">drh. Dewi Lestari, M.Vet.Sc</div>
                    <div class="position-nip">NIP. 198001102005012001</div>
                </div>
                <div class="position-card">
                    <div class="position-icon">🔬</div>
                    <div class="position-title">Kepala Divisi Laboratorium</div>
                    <div class="position-name">drh. Eko Prasetyo, M.Si</div>
                    <div class="position-nip">NIP. 198205152008011002</div>
                </div>
                <div class="position-card">
                    <div class="position-icon">📋</div>
                    <div class="position-title">Kepala Divisi Administrasi</div>
                    <div class="position-name">Rina Wijayanti, S.Sos, M.M</div>
                    <div class="position-nip">NIP. 197912202003122001</div>
                </div>
            </div>
        </div>

        <div class="connector">↓</div>

        <!-- Level 4: Koordinator -->
        <div class="org-level">
            <div class="org-level-title">Koordinator</div>
            <div class="org-grid">
                <div class="position-card">
                    <div class="position-icon">🏨</div>
                    <div class="position-title">Koordinator Layanan Rawat</div>
                    <div class="position-name">drh. Agus Wijaya, M.Sc</div>
                    <div class="position-nip">NIP. 198607152012011001</div>
                </div>
                <div class="position-card">
                    <div class="position-icon">🚑</div>
                    <div class="position-title">Koordinator Emergency</div>
                    <div class="position-name">drh. Maya Kusuma, M.Vet</div>
                    <div class="position-nip">NIP. 198809202014012002</div>
                </div>
                <div class="position-card">
                    <div class="position-icon">📸</div>
                    <div class="position-title">Koordinator Radiologi</div>
                    <div class="position-name">drh. Rudi Hartono, M.Si</div>
                    <div class="position-nip">NIP. 198702102015011001</div>
                </div>
            </div>
        </div>

    </div>

    <!-- INFO SECTION -->
    <section class="info-section">
        <div class="info-content">
            <h3>Tim Profesional Kami</h3>
            <p>RSHP Universitas Airlangga didukung oleh tim profesional yang berpengalaman dan berdedikasi tinggi dalam memberikan pelayanan kesehatan hewan terbaik. Setiap anggota tim kami memiliki kompetensi dan keahlian di bidangnya masing-masing.</p>
            
            <div class="info-stats">
                <div class="stat-box">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Tenaga Medis</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">20+</div>
                    <div class="stat-label">Dokter Hewan</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Tenaga Laboratorium</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Staff Administrasi</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Bergabung dengan Tim Kami</h2>
            <p>Kami selalu mencari profesional berbakat untuk bergabung dengan tim RSHP UNAIR. Hubungi kami untuk informasi lebih lanjut tentang peluang karir.</p>
            <a href="/" class="btn btn-primary">
                Kembali ke Beranda
            </a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025 Rumah Sakit Hewan Pendidikan Universitas Airlangga | Designed by Kholis Abdi</p>
    </footer>

</body>
</html>