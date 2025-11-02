<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Umum - RSHP Universitas Airlangga</title>
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

        /* === SERVICES GRID === */
        .services-container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 30px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .service-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.06);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .service-card::before {
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

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,119,182,0.15);
            border-color: var(--primary);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0,119,182,0.2);
        }

        .service-card h3 {
            color: var(--primary-dark);
            margin-bottom: 15px;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .service-card p {
            color: var(--text-gray);
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .service-features {
            list-style: none;
            margin-top: 20px;
        }

        .service-features li {
            padding: 10px 0;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .service-features li::before {
            content: "✓";
            background: var(--success);
            color: var(--white);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
            flex-shrink: 0;
        }

        /* === CONTACT SECTION === */
        .contact-section {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            padding: 80px 30px;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .contact-section::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
            border-radius: 50%;
        }

        .contact-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .contact-header h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 800;
        }

        .contact-header p {
            font-size: 1.1rem;
            opacity: 0.95;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 35px 25px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .contact-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
            border-color: var(--accent);
        }

        .contact-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .contact-card h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .contact-card a {
            color: var(--accent);
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
            word-break: break-word;
        }

        .contact-card a:hover {
            transform: scale(1.05);
            text-shadow: 0 0 20px rgba(255, 195, 0, 0.5);
        }

        .contact-card p {
            font-size: 0.9rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* === OPERATING HOURS === */
        .hours-section {
            max-width: 1000px;
            margin: 80px auto;
            padding: 0 30px;
        }

        .hours-card {
            background: var(--white);
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            border: 3px solid var(--primary);
        }

        .hours-card h3 {
            color: var(--primary-dark);
            font-size: 2rem;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 800;
        }

        .hours-list {
            display: grid;
            gap: 20px;
        }

        .hours-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            background: var(--light-bg);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .hours-item:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            transform: translateX(10px);
        }

        .hours-item .day {
            font-weight: 700;
            font-size: 1.1rem;
        }

        .hours-item .time {
            font-weight: 600;
            color: var(--primary);
        }

        .hours-item:hover .time {
            color: var(--accent);
        }

        /* === CTA SECTION === */
        .cta-section {
            background: var(--light-bg);
            padding: 80px 30px;
            text-align: center;
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .cta-content h2 {
            font-size: 2.5rem;
            color: var(--primary-dark);
            margin-bottom: 20px;
            font-weight: 800;
        }

        .cta-content p {
            font-size: 1.1rem;
            color: var(--text-gray);
            margin-bottom: 40px;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
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
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 119, 182, 0.4);
        }

        .btn-secondary {
            background: var(--accent);
            color: var(--primary-dark);
            box-shadow: 0 8px 25px rgba(255, 195, 0, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 195, 0, 0.4);
        }

        /* === FOOTER === */
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

        /* === RESPONSIVE === */
        @media (max-width: 1100px) {
            .contact-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

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

            .page-header h2 {
                font-size: 2rem;
            }

            .contact-header h2,
            .cta-content h2 {
                font-size: 2rem;
            }

            .hours-card {
                padding: 30px 20px;
            }

            .hours-item {
                flex-direction: column;
                text-align: center;
                gap: 10px;
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

            .services-grid {
                grid-template-columns: 1fr;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }

            .cta-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                justify-content: center;
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
            <a href="/strukturorganisasi">Struktur Organisasi</a>
            <a href="/layananumum" class="active">Layanan Umum</a>
            <a href="/visimisidantujuan">Visi Misi & Tujuan</a>
            <a href="/login">Login</a>
        </div>
    </nav>

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="/">Beranda</a>
        <span>›</span>
        <span>Layanan Umum</span>
    </div>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h2>Layanan Umum RSHP UNAIR</h2>
        <p>Kami menyediakan berbagai layanan kesehatan hewan yang lengkap dan profesional untuk kebutuhan hewan kesayangan Anda</p>
    </div>

    <!-- SERVICES GRID -->
    <div class="services-container">
        <div class="services-grid">
            <!-- Service 1 -->
            <div class="service-card">
                <div class="service-icon">🏥</div>
                <h3>Pemeriksaan Kesehatan</h3>
                <p>Layanan pemeriksaan kesehatan rutin dan menyeluruh untuk hewan kesayangan Anda</p>
                <ul class="service-features">
                    <li>Pemeriksaan fisik lengkap</li>
                    <li>Konsultasi kesehatan</li>
                    <li>Deteksi dini penyakit</li>
                    <li>Vaksinasi lengkap</li>
                </ul>
            </div>

            <!-- Service 2 -->
            <div class="service-card">
                <div class="service-icon">🔬</div>
                <h3>Laboratorium</h3>
                <p>Fasilitas laboratorium modern dengan peralatan canggih untuk diagnosis akurat</p>
                <ul class="service-features">
                    <li>Tes darah lengkap</li>
                    <li>Urinalisis</li>
                    <li>Tes mikrobiologi</li>
                    <li>Histopatologi</li>
                </ul>
            </div>

            <!-- Service 3 -->
            <div class="service-card">
                <div class="service-icon">💉</div>
                <h3>Operasi & Bedah</h3>
                <p>Layanan operasi dengan tim dokter ahli dan fasilitas ruang operasi steril</p>
                <ul class="service-features">
                    <li>Bedah umum</li>
                    <li>Bedah ortopedi</li>
                    <li>Bedah jaringan lunak</li>
                    <li>Sterilisasi</li>
                </ul>
            </div>

            <!-- Service 4 -->
            <div class="service-card">
                <div class="service-icon">🏨</div>
                <h3>Rawat Inap</h3>
                <p>Fasilitas rawat inap dengan monitoring 24 jam dan perawatan intensif</p>
                <ul class="service-features">
                    <li>Kandang individual</li>
                    <li>Monitoring 24/7</li>
                    <li>Perawatan intensif</li>
                    <li>Nutrisi khusus</li>
                </ul>
            </div>

            <!-- Service 5 -->
            <div class="service-card">
                <div class="service-icon">📸</div>
                <h3>Radiologi & Imaging</h3>
                <p>Layanan pencitraan medis untuk diagnosis yang lebih akurat dan cepat</p>
                <ul class="service-features">
                    <li>X-Ray digital</li>
                    <li>Ultrasonografi (USG)</li>
                    <li>Endoskopi</li>
                    <li>Interpretasi hasil</li>
                </ul>
            </div>

            <!-- Service 6 -->
            <div class="service-card">
                <div class="service-icon">🚑</div>
                <h3>Emergency 24 Jam</h3>
                <p>Layanan darurat siap membantu hewan kesayangan Anda kapan pun dibutuhkan</p>
                <ul class="service-features">
                    <li>Penanganan darurat</li>
                    <li>Konsultasi via telepon</li>
                    <li>Stabilisasi kondisi</li>
                    <li>Perawatan intensif</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- OPERATING HOURS -->
    <div class="hours-section">
        <div class="hours-card">
            <h3>⏰ Jam Operasional</h3>
            <div class="hours-list">
                <div class="hours-item">
                    <span class="day">Senin - Jumat</span>
                    <span class="time">08.00 - 17.00 WIB</span>
                </div>
                <div class="hours-item">
                    <span class="day">Sabtu</span>
                    <span class="time">08.00 - 14.00 WIB</span>
                </div>
                <div class="hours-item">
                    <span class="day">Minggu & Libur Nasional</span>
                    <span class="time">Layanan Emergency</span>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTACT SECTION -->
    <section class="contact-section">
        <div class="contact-content">
            <div class="contact-header">
                <h2>Hubungi Kami</h2>
                <p>Tim kami siap membantu menjawab pertanyaan dan melayani kebutuhan hewan kesayangan Anda</p>
            </div>
            
            <div class="contact-grid">
                <div class="contact-card">
                    <div class="contact-icon">📞</div>
                    <h3>Telepon</h3>
                    <a href="tel:0123456789">0123-456-789</a>
                    <p>Senin - Jumat: 08.00 - 17.00</p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">📱</div>
                    <h3>WhatsApp</h3>
                    <a href="https://wa.me/6281234567890" target="_blank">0812-3456-7890</a>
                    <p>Fast Response 24/7</p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">📧</div>
                    <h3>Email</h3>
                    <a href="mailto:rshp@unair.ac.id">rshp@unair.ac.id</a>
                    <p>Balasan dalam 1x24 jam</p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">📍</div>
                    <h3>Alamat</h3>
                    <p>Kampus C Universitas Airlangga<br>Jl. Mulyorejo, Surabaya<br>Jawa Timur 60115</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Siap Memberikan Perawatan Terbaik?</h2>
            <p>Daftarkan hewan kesayangan Anda sekarang dan nikmati layanan kesehatan hewan yang profesional dan terpercaya</p>
            <div class="cta-buttons">
                <a href="/login" class="btn btn-primary">
                    Daftar Sekarang
                </a>
                <a href="/" class="btn btn-secondary">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025 Rumah Sakit Hewan Pendidikan Universitas Airlangga | Designed by Kholis Abdi</p>
    </footer>

</body>
</html>