<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSHP Universitas Airlangga</title>
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
            overflow-x: hidden;
        }

        /* === HEADER SECTION === */
        header {
            background: linear-gradient(135deg, #0077b6 0%, #023e8a 100%);
            color: var(--white);
            padding: 25px 0;
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
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
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
            transition: all 0.3s ease;
        }

        nav.scrolled {
            box-shadow: 0 6px 30px rgba(0,0,0,0.15);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 30px;
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

        nav a:hover {
            color: var(--primary-dark);
        }

        nav a:hover::before {
            width: 100%;
        }

        /* === HERO SECTION === */
        .hero-section {
            background: linear-gradient(135deg, rgba(0,119,182,0.95), rgba(2,62,138,0.95)), 
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%23f8fbff" width="1200" height="600"/><g fill-opacity="0.1"><circle fill="%230077b6" cx="200" cy="200" r="150"/><circle fill="%2300b4d8" cx="1000" cy="400" r="200"/></g></svg>');
            background-size: cover;
            background-position: center;
            color: var(--white);
            padding: 80px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero-content h2 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            animation: fadeInUp 0.8s ease;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 35px;
            opacity: 0.95;
            font-weight: 300;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 1.2s ease;
        }

        .btn {
            padding: 14px 35px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--accent);
            color: var(--primary-dark);
            box-shadow: 0 5px 20px rgba(255, 195, 0, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 195, 0, 0.4);
        }

        .btn-secondary {
            background: var(--white);
            color: var(--primary);
            box-shadow: 0 5px 20px rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
        }

        /* === FEATURES SECTION === */
        .features-section {
            padding: 80px 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: var(--primary-dark);
            margin-bottom: 15px;
            font-weight: 800;
        }

        .section-title p {
            color: var(--text-gray);
            font-size: 1.1rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 60px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .feature-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px 35px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.06);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .feature-card::before {
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

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,119,182,0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2.5rem;
            box-shadow: 0 10px 30px rgba(0,119,182,0.2);
        }

        .feature-card h3 {
            color: var(--primary-dark);
            margin-bottom: 15px;
            font-size: 1.4rem;
            font-weight: 700;
        }

        .feature-card p {
            color: var(--text-gray);
            line-height: 1.7;
            margin-bottom: 0;
        }

        /* === INFO SECTION === */
        .info-section {
            background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 100%);
            padding: 80px 30px;
        }

        .info-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .info-content h2 {
            font-size: 2.3rem;
            color: var(--primary-dark);
            margin-bottom: 25px;
            font-weight: 800;
            line-height: 1.3;
        }

        .info-content p {
            color: var(--text-gray);
            margin-bottom: 30px;
            font-size: 1.05rem;
            line-height: 1.8;
        }

        .info-list {
            list-style: none;
            margin-bottom: 30px;
        }

        .info-list li {
            padding: 15px 0;
            color: var(--text-dark);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-list li::before {
            content: "✓";
            background: var(--success);
            color: var(--white);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        /* === SCHEDULE TABLE === */
        .schedule-section {
            padding: 80px 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .table-container {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
        }

        th {
            padding: 20px;
            text-align: left;
            font-weight: 600;
            font-size: 1.05rem;
        }

        td {
            padding: 20px;
            border-bottom: 1px solid #e8e8e8;
            color: var(--text-dark);
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background-color: #f0f9ff;
            transform: scale(1.01);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* === VIDEO SECTION === */
        .video-section {
            background: var(--white);
            padding: 80px 30px;
        }

        .video-container {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            margin-top: 40px;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* === STATS SECTION === */
        .stats-section {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            padding: 60px 30px;
            color: var(--white);
        }

        .stats-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            text-align: center;
        }

        .stat-item h3 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 10px;
            color: var(--accent);
        }

        .stat-item p {
            font-size: 1.1rem;
            opacity: 0.95;
            margin-bottom: 0;
        }

        /* === FOOTER === */
        footer {
            background: var(--primary-dark);
            color: var(--white);
            padding: 50px 30px 30px;
            margin-top: 0;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: var(--accent);
        }

        .footer-section p, .footer-section a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--accent);
            padding-left: 5px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.7);
        }

        /* === RESPONSIVE === */
        @media (max-width: 968px) {
            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .logo-section {
                flex-direction: column;
            }

            .header-text h1 {
                font-size: 1.5rem;
            }

            nav a {
                margin: 0 15px;
                font-size: 0.9rem;
            }

            .hero-content h2 {
                font-size: 2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .info-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .stat-item h3 {
                font-size: 2.5rem;
            }

            table {
                font-size: 0.9rem;
            }

            th, td {
                padding: 15px 10px;
            }
        }

        @media (max-width: 640px) {
            nav {
                padding: 0 10px;
            }

            nav a {
                margin: 0 8px;
                padding: 15px 0;
                font-size: 0.85rem;
            }

            .hero-section {
                padding: 50px 20px;
            }

            .hero-content h2 {
                font-size: 1.6rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .features-section,
            .schedule-section,
            .video-section {
                padding: 50px 20px;
            }

            .hero-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .feature-card {
                min-height: auto;
                padding: 35px 25px;
            }
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
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

    <!-- Navigation Bar -->
    <nav id="navbar">
        <div class="nav-container">
            <a href="/">Beranda</a>
            <a href="/strukturorganisasi">Struktur Organisasi</a>
            <a href="/layananumum">Layanan Umum</a>
            <a href="/visimisidantujuan">Visi Misi & Tujuan</a>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h2>Sistem Pendaftaran Online Hadir untuk Anda</h2>
            <p>Daftarkan hewan kesayangan Anda dengan mudah, cepat, dan efisien. Tidak perlu antre, semua bisa dilakukan dari rumah!</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    Daftar Sekarang
                </a>
                <a href="/layananumum" class="btn btn-secondary">
                    Lihat Layanan Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="section-title">
            <h2>Keunggulan Layanan Kami</h2>
            <p>Pengalaman terbaik untuk hewan kesayangan Anda</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">💻</div>
                <h3>Pendaftaran Online</h3>
                <p>Daftar kapan saja, dimana saja melalui website resmi kami tanpa perlu datang langsung</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Proses Cepat</h3>
                <p>Sistem pendaftaran yang efisien menghemat waktu Anda, tanpa antre panjang</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">👨‍⚕️</div>
                <h3>Pilih Dokter</h3>
                <p>Bebas memilih dokter hewan sesuai dengan kebutuhan dan spesialisasi yang diinginkan</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <h3>Jadwal Fleksibel</h3>
                <p>Pilih jadwal kunjungan yang sesuai dengan waktu luang Anda</p>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section" style="border-radius: 20px; margin: 40px 0;">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>15+</h3>
                    <p>Tahun Berpengalaman</p>
                </div>
                <div class="stat-item">
                    <h3>50+</h3>
                    <p>Tenaga Profesional</p>
                </div>
                <div class="stat-item">
                    <h3>10K+</h3>
                    <p>Hewan Dilayani</p>
                </div>
                <div class="stat-item">
                    <h3>98%</h3>
                    <p>Kepuasan Pelanggan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="info-section">
        <div class="info-container">
            <div class="info-content">
                <h2>Mengapa Memilih RSHP Universitas Airlangga?</h2>
                <p><strong>RSHP Universitas Airlangga</strong> adalah rumah sakit hewan pendidikan yang terus berinovasi untuk memberikan pelayanan terbaik bagi masyarakat dan hewan kesayangan Anda.</p>
                
                <ul class="info-list">
                    <li>Fasilitas medis lengkap dan modern</li>
                    <li>Tim dokter hewan berpengalaman dan terlatih</li>
                    <li>Layanan rawat inap 24 jam</li>
                    <li>Laboratorium dan diagnostik terpadu</li>
                    <li>Harga terjangkau dengan kualitas terbaik</li>
                </ul>

                <a href="/visimisidantujuan" class="btn btn-primary">Selengkapnya Tentang Kami</a>
            </div>
            
            <div class="info-image">
                <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" 
                     alt="RSHP UNAIR" 
                     style="width: 100%; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section class="schedule-section">
        <div class="section-title">
            <h2>Jadwal Pendaftaran Online</h2>
            <p>Lihat jadwal operasional kami untuk merencanakan kunjungan Anda</p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Jam Operasional</th>
                        <th>Layanan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Senin - Kamis</strong></td>
                        <td>08.00 - 16.00 WIB</td>
                        <td>Pendaftaran Hewan Kecil</td>
                    </tr>
                    <tr>
                        <td><strong>Jumat - Sabtu</strong></td>
                        <td>08.00 - 12.00 WIB</td>
                        <td>Pendaftaran Hewan Besar</td>
                    </tr>
                    <tr>
                        <td><strong>Minggu</strong></td>
                        <td>Tutup</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Video Section -->
    <section class="video-section">
        <div class="video-container">
            <div class="section-title">
                <h2>Profil RSHP Universitas Airlangga</h2>
                <p>Lihat fasilitas dan layanan kami lebih dekat</p>
            </div>
            
            <div class="video-wrapper">
                <iframe 
                    src="https://www.youtube.com/embed/rCfvZPECZvE?si=kAjeG3JnmQ6GjoWv"
                    title="Profil RSHP UNAIR"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Tentang RSHP UNAIR</h3>
                <p>Rumah Sakit Hewan Pendidikan Universitas Airlangga adalah fasilitas kesehatan hewan terpadu yang melayani dengan profesionalisme tinggi.</p>
            </div>
            
            <div class="footer-section">
                <h3>Layanan</h3>
                <a href="/layananumum">Layanan Umum</a>
                <a href="/strukturorganisasi">Struktur Organisasi</a>
                <a href="/visimisidantujuan">Visi & Misi</a>
            </div>
            
            <div class="footer-section">
                <h3>Kontak</h3>
                <p>📍 Kampus C Universitas Airlangga<br>Surabaya, Jawa Timur</p>
                <p>📞 (031) 5992785</p>
                <p>✉️ rshp@unair.ac.id</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2025 Rumah Sakit Hewan Pendidikan Universitas Airlangga | Designed by Kholis Abdi</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

</body>
</html>