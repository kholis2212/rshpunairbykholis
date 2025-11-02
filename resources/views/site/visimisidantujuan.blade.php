<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi Misi & Tujuan - RSHP Universitas Airlangga</title>
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

        /* === VISION SECTION === */
        .vision-section {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 30px;
        }

        .vision-card {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 25px;
            padding: 60px 50px;
            text-align: center;
            color: var(--white);
            box-shadow: 0 20px 60px rgba(0,119,182,0.3);
            position: relative;
            overflow: hidden;
        }

        .vision-card::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .vision-icon {
            font-size: 4rem;
            margin-bottom: 25px;
            position: relative;
            z-index: 2;
        }

        .vision-card h3 {
            font-size: 2rem;
            margin-bottom: 25px;
            font-weight: 800;
            position: relative;
            z-index: 2;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .vision-card p {
            font-size: 1.3rem;
            line-height: 1.8;
            opacity: 0.95;
            font-weight: 400;
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: 0 auto;
        }

        /* === MISSION SECTION === */
        .mission-section {
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 30px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-header h3 {
            font-size: 2.3rem;
            color: var(--primary-dark);
            margin-bottom: 15px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-header p {
            font-size: 1.1rem;
            color: var(--text-gray);
        }

        .mission-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .mission-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px 35px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.06);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
            display: flex;
            gap: 25px;
            align-items: flex-start;
        }

        .mission-card::before {
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

        .mission-card:hover::before {
            transform: scaleX(1);
        }

        .mission-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,119,182,0.15);
            border-color: var(--primary);
        }

        .mission-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--white);
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(0,119,182,0.3);
        }

        .mission-content h4 {
            color: var(--primary-dark);
            font-size: 1.3rem;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .mission-content p {
            color: var(--text-gray);
            line-height: 1.8;
            font-size: 1.05rem;
        }

        /* === GOALS SECTION === */
        .goals-section {
            background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 100%);
            padding: 80px 30px;
        }

        .goals-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .goals-list {
            display: grid;
            gap: 25px;
            margin-top: 40px;
        }

        .goal-item {
            background: var(--white);
            border-radius: 20px;
            padding: 35px 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 30px;
            border-left: 5px solid var(--primary);
        }

        .goal-item:hover {
            transform: translateX(10px);
            box-shadow: 0 15px 50px rgba(0,119,182,0.15);
            border-left-color: var(--accent);
        }

        .goal-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
            box-shadow: 0 10px 25px rgba(0,119,182,0.2);
        }

        .goal-text h4 {
            color: var(--primary-dark);
            font-size: 1.3rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .goal-text p {
            color: var(--text-gray);
            line-height: 1.8;
            font-size: 1.05rem;
        }

        /* === VALUES SECTION === */
        .values-section {
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 30px;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .value-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.06);
            transition: all 0.4s ease;
            border: 2px solid transparent;
        }

        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,119,182,0.15);
            border-color: var(--primary);
        }

        .value-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 25px;
            box-shadow: 0 10px 30px rgba(0,119,182,0.2);
        }

        .value-card h4 {
            color: var(--primary-dark);
            font-size: 1.4rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .value-card p {
            color: var(--text-gray);
            line-height: 1.7;
            font-size: 1rem;
        }

        /* === CTA SECTION === */
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
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
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
            background: var(--accent);
            color: var(--primary-dark);
            box-shadow: 0 8px 25px rgba(255, 195, 0, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 195, 0, 0.4);
        }

        .btn-secondary {
            background: var(--white);
            color: var(--primary);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 255, 255, 0.3);
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
            .page-header h2 {
                font-size: 2rem;
            }

            .vision-card {
                padding: 40px 30px;
            }

            .vision-card h3 {
                font-size: 1.7rem;
            }

            .vision-card p {
                font-size: 1.1rem;
            }

            .mission-grid {
                grid-template-columns: 1fr;
            }

            .goal-item {
                flex-direction: column;
                text-align: center;
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

            .vision-icon {
                font-size: 3rem;
            }

            .mission-card {
                flex-direction: column;
                text-align: center;
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
            <a href="/layananumum">Layanan Umum</a>
            <a href="/visimisidantujuan" class="active">Visi Misi & Tujuan</a>
            <a href="/login">Login</a>
        </div>
    </nav>

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="/">Beranda</a>
        <span>›</span>
        <span>Visi Misi & Tujuan</span>
    </div>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h2>Visi Misi & Tujuan</h2>
        <p>Komitmen kami untuk menjadi pusat unggulan pelayanan kesehatan hewan dan pendidikan kedokteran hewan</p>
    </div>

    <!-- VISION SECTION -->
    <section class="vision-section">
        <div class="vision-card">
            <div class="vision-icon">🎯</div>
            <h3>Visi</h3>
            <p>Menjadi Rumah Sakit Hewan Pendidikan yang unggul, inovatif, dan terpercaya dalam pelayanan kesehatan hewan serta pengembangan ilmu kedokteran hewan di tingkat nasional dan internasional pada tahun 2030</p>
        </div>
    </section>

    <!-- MISSION SECTION -->
    <section class="mission-section">
        <div class="section-header">
            <h3>Misi</h3>
            <p>Langkah strategis untuk mewujudkan visi kami</p>
        </div>
        
        <div class="mission-grid">
            <div class="mission-card">
                <div class="mission-number">01</div>
                <div class="mission-content">
                    <h4>Pelayanan Berkualitas</h4>
                    <p>Menyelenggarakan pelayanan kesehatan hewan yang berkualitas tinggi, profesional, dan berbasis pada standar internasional</p>
                </div>
            </div>

            <div class="mission-card">
                <div class="mission-number">02</div>
                <div class="mission-content">
                    <h4>Pendidikan & Penelitian</h4>
                    <p>Mengembangkan pendidikan dan penelitian kedokteran hewan yang inovatif untuk menghasilkan dokter hewan berkompeten</p>
                </div>
            </div>

            <div class="mission-card">
                <div class="mission-number">03</div>
                <div class="mission-content">
                    <h4>Teknologi Terkini</h4>
                    <p>Menerapkan teknologi dan metode terkini dalam diagnosis, pengobatan, dan perawatan kesehatan hewan</p>
                </div>
            </div>

            <div class="mission-card">
                <div class="mission-number">04</div>
                <div class="mission-content">
                    <h4>Pengabdian Masyarakat</h4>
                    <p>Memberikan kontribusi nyata kepada masyarakat melalui program edukasi dan layanan kesehatan hewan yang terjangkau</p>
                </div>
            </div>
        </div>
    </section>

    <!-- GOALS SECTION -->
    <section class="goals-section">
        <div class="goals-container">
            <div class="section-header">
                <h3>Tujuan</h3>
                <p>Target yang ingin kami capai untuk kesejahteraan hewan</p>
            </div>

            <div class="goals-list">
                <div class="goal-item">
                    <div class="goal-icon">🏆</div>
                    <div class="goal-text">
                        <h4>Meningkatkan Kualitas Layanan</h4>
                        <p>Menyediakan fasilitas dan layanan kesehatan hewan yang komprehensif dengan standar tertinggi untuk memastikan kesehatan dan kesejahteraan hewan peliharaan</p>
                    </div>
                </div>

                <div class="goal-item">
                    <div class="goal-icon">🎓</div>
                    <div class="goal-text">
                        <h4>Menghasilkan Lulusan Berkualitas</h4>
                        <p>Menjadi pusat pembelajaran dan pelatihan bagi mahasiswa kedokteran hewan untuk menghasilkan dokter hewan yang kompeten dan profesional</p>
                    </div>
                </div>

                <div class="goal-item">
                    <div class="goal-icon">🔬</div>
                    <div class="goal-text">
                        <h4>Mendorong Riset & Inovasi</h4>
                        <p>Mengembangkan penelitian ilmiah di bidang kedokteran hewan untuk menemukan solusi inovatif bagi berbagai penyakit dan masalah kesehatan hewan</p>
                    </div>
                </div>

                <div class="goal-item">
                    <div class="goal-icon">🤝</div>
                    <div class="goal-text">
                        <h4>Membangun Kemitraan Strategis</h4>
                        <p>Menjalin kerjasama dengan institusi pendidikan, penelitian, dan organisasi nasional maupun internasional dalam bidang kesehatan hewan</p>
                    </div>
                </div>

                <div class="goal-item">
                    <div class="goal-icon">💚</div>
                    <div class="goal-text">
                        <h4>Meningkatkan Kesadaran Masyarakat</h4>
                        <p>Memberikan edukasi kepada masyarakat tentang pentingnya kesehatan hewan dan kesejahteraan hewan untuk menciptakan hubungan harmonis antara manusia dan hewan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VALUES SECTION -->
    <section class="values-section">
        <div class="section-header">
            <h3>Nilai-Nilai Kami</h3>
            <p>Prinsip yang menjadi landasan kerja kami</p>
        </div>

        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">❤️</div>
                <h4>Kasih Sayang</h4>
                <p>Memberikan perhatian dan perawatan penuh kasih sayang kepada setiap hewan</p>
            </div>

            <div class="value-card">
                <div class="value-icon">⭐</div>
                <h4>Profesionalisme</h4>
                <p>Menjalankan tugas dengan standar etika dan kompetensi tertinggi</p>
            </div>

            <div class="value-card">
                <div class="value-icon">🔍</div>
                <h4>Integritas</h4>
                <p>Bertindak jujur, transparan, dan bertanggung jawab dalam setiap pelayanan</p>
            </div>

            <div class="value-card">
                <div class="value-icon">💡</div>
                <h4>Inovasi</h4>
                <p>Terus berinovasi untuk meningkatkan kualitas layanan dan pendidikan</p>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Bergabunglah dengan Kami</h2>
            <p>Mari bersama-sama mewujudkan visi dan misi RSHP UNAIR untuk kesejahteraan hewan di Indonesia</p>
            <div class="cta-buttons">
                <a href="/" class="btn btn-primary">
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