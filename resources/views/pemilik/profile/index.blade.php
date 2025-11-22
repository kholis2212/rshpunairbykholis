@extends('layouts.lte.main')

@section('title', 'Profile Saya - RSHP UNAIR')

@section('page-icon', 'person-badge-fill')
@section('page-title', 'Profile Pemilik')

@section('breadcrumb')
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="alert-content">
                <div class="alert-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="alert-text">
                    <strong>Berhasil!</strong>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="alert-content">
                <div class="alert-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div class="alert-text">
                    <strong>Error!</strong>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Profile Header -->
            <div class="profile-header-card mb-4">
                <div class="profile-avatar-section">
                    <div class="profile-avatar">
                        <div class="avatar-circle">
                            {{ strtoupper(substr($user->nama, 0, 1)) }}
                        </div>
                        <div class="avatar-badge">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                    </div>
                    <div class="profile-actions">
                        <button class="btn-action" onclick="document.getElementById('profileForm').requestSubmit()">
                            <i class="bi bi-save-fill"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                        <button class="btn-action btn-secondary" onclick="resetForm()">
                            <i class="bi bi-arrow-clockwise"></i>
                            <span>Reset Form</span>
                        </button>
                    </div>
                </div>
                <div class="profile-info">
                    <h1>{{ $user->nama }}</h1>
                    <p class="profile-role">Pemilik Hewan</p>
                    <div class="profile-stats">
                        <div class="stat-item">
                            <i class="bi bi-envelope-fill"></i>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="stat-item">
                            <i class="bi bi-telephone-fill"></i>
                            <span>{{ $pemilik->no_wa ?? 'Belum diatur' }}</span>
                        </div>
                        <div class="stat-item">
                            <i class="bi bi-calendar-check-fill"></i>
                            <span>Bergabung: {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y') : 'Tidak tersedia' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Form -->
            <div class="card profile-form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Informasi Profile</h5>
                        <p>Kelola data profile dan informasi akun Anda</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('pemilik.profile.update') }}" method="POST" id="profileForm">
                        @csrf
                        @method('PUT')

                        <!-- Data Pribadi Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-person-vcard-fill"></i>
                                </div>
                                <div class="section-text">
                                    <h6>Data Pribadi</h6>
                                    <p>Informasi identitas dan data diri</p>
                                </div>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="nama" class="form-label">
                                        <i class="bi bi-person-fill me-2"></i>
                                        Nama Lengkap
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="text" 
                                               id="nama" 
                                               name="nama" 
                                               class="form-control @error('nama') is-invalid @enderror" 
                                               value="{{ old('nama', $user->nama) }}" 
                                               placeholder="Masukkan nama lengkap"
                                               required>
                                        <div class="input-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                    @error('nama')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope-fill me-2"></i>
                                        Email
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="email" 
                                               id="email" 
                                               name="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email', $user->email) }}" 
                                               placeholder="nama@email.com"
                                               required>
                                        <div class="input-icon">
                                            <i class="bi bi-at"></i>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Kontak & Alamat Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div class="section-text">
                                    <h6>Kontak & Alamat</h6>
                                    <p>Informasi kontak dan alamat lengkap</p>
                                </div>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="no_wa" class="form-label">
                                        <i class="bi bi-whatsapp me-2"></i>
                                        Nomor WhatsApp
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="tel" 
                                               id="no_wa" 
                                               name="no_wa" 
                                               class="form-control @error('no_wa') is-invalid @enderror" 
                                               value="{{ old('no_wa', $pemilik->no_wa ?? '') }}" 
                                               placeholder="Contoh: 081234567890">
                                        <div class="input-icon">
                                            <i class="bi bi-phone"></i>
                                        </div>
                                    </div>
                                    @error('no_wa')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                    <div class="form-hint">
                                        <i class="bi bi-info-circle-fill"></i>
                                        <span>Nomor WhatsApp akan digunakan untuk notifikasi dan komunikasi</span>
                                    </div>
                                </div>

                                <div class="form-group full-width">
                                    <label for="alamat" class="form-label">
                                        <i class="bi bi-geo-alt-fill me-2"></i>
                                        Alamat Lengkap
                                    </label>
                                    <div class="input-wrapper">
                                        <textarea id="alamat" 
                                                  name="alamat" 
                                                  class="form-control @error('alamat') is-invalid @enderror" 
                                                  rows="4"
                                                  placeholder="Masukkan alamat lengkap termasuk jalan, RT/RW, kelurahan, kecamatan, kota, dan kode pos">{{ old('alamat', $pemilik->alamat ?? '') }}</textarea>
                                        <div class="input-icon textarea-icon">
                                            <i class="bi bi-house"></i>
                                        </div>
                                    </div>
                                    @error('alamat')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                    <div class="form-hint">
                                        <i class="bi bi-info-circle-fill"></i>
                                        <span>Alamat lengkap akan digunakan untuk pengiriman dan layanan home visit</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Keamanan Akun Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-shield-lock-fill"></i>
                                </div>
                                <div class="section-text">
                                    <h6>Keamanan Akun</h6>
                                    <p>Kelola kata sandi dan keamanan akun</p>
                                </div>
                            </div>

                            <div class="security-notice">
                                <div class="security-icon">
                                    <i class="bi bi-info-circle-fill"></i>
                                </div>
                                <div class="security-text">
                                    <p><strong>Informasi Penting:</strong> Kosongkan field password jika tidak ingin mengubah password. Pastikan password baru memiliki minimal 8 karakter dan mengandung kombinasi huruf, angka, dan simbol.</p>
                                </div>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="bi bi-key-fill me-2"></i>
                                        Password Baru
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="password" 
                                               id="password" 
                                               name="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               placeholder="Masukkan password baru"
                                               autocomplete="new-password">
                                        <div class="input-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                    <div class="password-strength" id="passwordStrength">
                                        <div class="strength-bar">
                                            <div class="strength-fill" id="strengthFill"></div>
                                        </div>
                                        <div class="strength-text" id="strengthText">Kekuatan password</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="bi bi-key me-2"></i>
                                        Konfirmasi Password
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="password" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               class="form-control" 
                                               placeholder="Konfirmasi password baru"
                                               autocomplete="new-password">
                                        <div class="input-icon">
                                            <i class="bi bi-lock-fill"></i>
                                        </div>
                                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <div class="password-match" id="passwordMatch">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>Password cocok</span>
                                    </div>
                                </div>
                            </div>

                            <div class="password-requirements">
                                <h6>Persyaratan Password:</h6>
                                <div class="requirements-list">
                                    <span id="reqLength" class="requirement">
                                        <i class="bi bi-circle"></i>
                                        <span>Minimal 8 karakter</span>
                                    </span>
                                    <span id="reqUpper" class="requirement">
                                        <i class="bi bi-circle"></i>
                                        <span>Mengandung huruf besar</span>
                                    </span>
                                    <span id="reqLower" class="requirement">
                                        <i class="bi bi-circle"></i>
                                        <span>Mengandung huruf kecil</span>
                                    </span>
                                    <span id="reqNumber" class="requirement">
                                        <i class="bi bi-circle"></i>
                                        <span>Mengandung angka</span>
                                    </span>
                                    <span id="reqSpecial" class="requirement">
                                        <i class="bi bi-circle"></i>
                                        <span>Mengandung simbol</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Statistik Akun Section -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <div class="section-text">
                                    <h6>Statistik Akun</h6>
                                    <p>Ringkasan aktivitas dan data akun Anda</p>
                                </div>
                            </div>

                            <div class="stats-grid">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="bi bi-heart-fill"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h3>{{ $user->pemilik->pets->count() ?? 0 }}</h3>
                                        <p>Hewan Peliharaan</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-icon" style="background: linear-gradient(135deg, #0077b6, #0096c7);">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h3>{{ $user->pemilik->pets->sum(function($pet) { return $pet->temuDokter->count(); }) ?? 0 }}</h3>
                                        <p>Total Kunjungan</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-icon" style="background: linear-gradient(135deg, #06d6a0, #05b589);">
                                        <i class="bi bi-file-medical"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h3>{{ $user->pemilik->pets->sum(function($pet) { return $pet->rekamMedis->count(); }) ?? 0 }}</h3>
                                        <p>Rekam Medis</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Update Profile</span>
                            </button>
                            <button type="reset" class="btn btn-secondary btn-reset">
                                <i class="bi bi-arrow-clockwise"></i>
                                <span>Reset Form</span>
                            </button>
                            <a href="{{ route('pemilik.dashboard-pemilik') }}" class="btn btn-outline btn-cancel">
                                <i class="bi bi-x-circle"></i>
                                <span>Batal</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Danger Zone Card -->
            <div class="card danger-zone-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Zona Berbahaya</h5>
                        <p>Tindakan yang tidak dapat dibatalkan</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="danger-actions">
                        <div class="danger-action">
                            <div class="danger-info">
                                <h6>Hapus Akun</h6>
                                <p>Menghapus akun secara permanen akan menghapus semua data termasuk hewan peliharaan, rekam medis, dan reservasi. Tindakan ini tidak dapat dibatalkan.</p>
                            </div>
                            <button class="btn-danger" onclick="showDeleteAccountModal()">
                                <i class="bi bi-trash-fill"></i>
                                <span>Hapus Akun</span>
                            </button>
                        </div>
                        
                        <div class="danger-action">
                            <div class="danger-info">
                                <h6>Ekspor Data</h6>
                                <p>Unduh semua data pribadi Anda dalam format PDF atau Excel untuk keperluan arsip pribadi.</p>
                            </div>
                            <button class="btn-export" onclick="exportData()">
                                <i class="bi bi-download"></i>
                                <span>Ekspor Data</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="modal-icon modal-icon-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                </div>
                <div class="modal-body text-center">
                    <h4 class="modal-title mb-3">Konfirmasi Penghapusan Akun</h4>
                    <p class="modal-text">Apakah Anda yakin ingin menghapus akun Anda secara permanen?</p>
                    
                    <div class="deletion-warning">
                        <div class="warning-header">
                            <i class="bi bi-exclamation-octagon-fill"></i>
                            <span>PERINGATAN: TINDAKAN INI TIDAK DAPAT DIBATALKAN!</span>
                        </div>
                        <div class="warning-content">
                            <p>Dengan menghapus akun, Anda akan kehilangan:</p>
                            <ul>
                                <li>Semua data hewan peliharaan</li>
                                <li>Riwayat rekam medis</li>
                                <li>Data reservasi dan kunjungan</li>
                                <li>Informasi profile dan kontak</li>
                            </ul>
                        </div>
                    </div>

                    <div class="confirmation-input">
                        <label for="confirmDelete" class="form-label">
                            Ketik <strong>"HAPUS AKUN"</strong> untuk konfirmasi
                        </label>
                        <input type="text" id="confirmDelete" class="form-control" placeholder="HAPUS AKUN">
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i>
                        <span>Batal</span>
                    </button>
                    <button type="button" class="btn btn-confirm-delete" id="confirmDeleteBtn" disabled>
                        <i class="bi bi-trash-fill"></i>
                        <span>Ya, Hapus Akun!</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary: #0077b6;
            --primary-dark: #023e8a;
            --secondary: #0096c7;
            --success: #06d6a0;
            --warning: #ffa500;
            --danger: #ef476f;
            --light-bg: #f8fbff;
            --text-dark: #1a1a2e;
            --text-gray: #4a5568;
            --border-light: #e8f1fa;
        }

        /* Profile Header Card */
        .profile-header-card {
            background: var(--white);
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 119, 182, 0.15);
            position: relative;
            overflow: hidden;
            border: 3px solid transparent;
            background-clip: padding-box;
        }

        .profile-header-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 25px;
            padding: 3px;
            background: linear-gradient(135deg, #0077b6, #0096c7, #00b4d8);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            z-index: -1;
        }

        .profile-avatar-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .profile-avatar {
            position: relative;
            display: inline-block;
        }

        .avatar-circle {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            font-weight: 800;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 119, 182, 0.4);
            border: 5px solid white;
        }

        .avatar-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #06d6a0, #05b589);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            border: 3px solid white;
            box-shadow: 0 3px 10px rgba(6, 214, 160, 0.4);
        }

        .profile-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-action {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
            cursor: pointer;
        }

        .btn-action.btn-secondary {
            background: var(--light-bg);
            color: var(--text-gray);
            border: 2px solid #e8e8e8;
            box-shadow: none;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.4);
        }

        .btn-action.btn-secondary:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
        }

        .profile-info {
            text-align: center;
            width: 100%;
        }

        .profile-info h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #023e8a, #0077b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .profile-role {
            font-size: 1.1rem;
            color: var(--text-gray);
            margin-bottom: 25px;
            font-weight: 600;
            background: var(--light-bg);
            padding: 8px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        .profile-stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--light-bg);
            padding: 12px 20px;
            border-radius: 15px;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9rem;
            border: 2px solid var(--border-light);
        }

        .stat-item i {
            color: var(--primary);
            font-size: 1.1rem;
        }

        /* Profile Form Card */
        .profile-form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 119, 182, 0.12);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .profile-form-card .card-header {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            padding: 30px;
            border: none;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .card-header-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
            backdrop-filter: blur(10px);
        }

        .card-header-text h5 {
            margin: 0 0 5px 0;
            font-size: 1.4rem;
            font-weight: 700;
        }

        .card-header-text p {
            margin: 0;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .profile-form-card .card-body {
            padding: 40px;
        }

        /* Form Sections */
        .form-section {
            margin-bottom: 40px;
            padding: 30px;
            background: var(--white);
            border-radius: 15px;
            border: 2px solid var(--border-light);
            transition: all 0.3s ease;
        }

        .form-section:hover {
            border-color: #0077b6;
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.1);
        }

        .form-section:last-of-type {
            margin-bottom: 0;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--border-light);
        }

        .section-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .section-text h6 {
            margin: 0 0 5px 0;
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 1.1rem;
        }

        .section-text p {
            margin: 0;
            font-size: 0.9rem;
            color: var(--text-gray);
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        /* Form Styles */
        .form-label {
            font-size: 0.95rem;
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }

        .required {
            color: #ef476f;
            margin-left: 5px;
            font-size: 1.1rem;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            padding: 14px 50px 14px 18px;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #f8fbff;
            width: 100%;
        }

        .form-control:focus {
            border-color: #0077b6;
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 119, 182, 0.1);
            outline: none;
        }

        .form-control::placeholder {
            color: #a0a0a0;
        }

        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #0077b6;
            font-size: 1.2rem;
            pointer-events: none;
        }

        .textarea-icon {
            top: 20px;
            transform: none;
        }

        .password-toggle {
            position: absolute;
            right: 45px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-gray);
            cursor: pointer;
            font-size: 1rem;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        .form-control.is-invalid {
            border-color: #ef476f;
            background: #fff5f5;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 71, 111, 0.1);
        }

        .invalid-feedback {
            color: #ef476f;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 8px;
            display: flex !important;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .form-hint {
            background: #f0f9ff;
            border-left: 3px solid #0077b6;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 12px;
            display: flex;
            align-items: start;
            gap: 10px;
            color: var(--text-gray);
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .form-hint i {
            color: #0077b6;
            font-size: 1rem;
            margin-top: 2px;
        }

        /* Security Notice */
        .security-notice {
            background: #fff8e6;
            border: 2px solid #ffa500;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .security-icon {
            color: #ffa500;
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        .security-text p {
            margin: 0;
            color: var(--text-gray);
            font-size: 0.9rem;
            font-weight: 600;
            line-height: 1.5;
        }

        /* Password Strength */
        .password-strength {
            margin-top: 10px;
        }

        .strength-bar {
            width: 100%;
            height: 6px;
            background: #e8e8e8;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .strength-text {
            font-size: 0.75rem;
            color: var(--text-gray);
            font-weight: 600;
        }

        .password-match {
            display: none;
            align-items: center;
            gap: 5px;
            color: var(--success);
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 8px;
        }

        .password-match.show {
            display: flex;
        }

        /* Password Requirements */
        .password-requirements {
            background: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .password-requirements h6 {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin: 0 0 15px 0;
        }

        .requirements-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: var(--text-gray);
            white-space: nowrap;
        }

        .requirement.valid {
            color: var(--success);
        }

        .requirement.valid i {
            color: var(--success);
        }

        .requirement i {
            color: var(--text-gray);
            font-size: 0.7rem;
            transition: all 0.3s ease;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
            border: 2px solid #f8fbff;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: var(--primary);
        }

        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #06d6a0, #05b589);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .stat-content h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin: 0;
            line-height: 1;
        }

        .stat-content p {
            font-size: 0.85rem;
            color: var(--text-gray);
            font-weight: 600;
            margin: 5px 0 0 0;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid var(--border-light);
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-submit {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            border: none;
            padding: 14px 40px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
            cursor: pointer;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.4);
        }

        .btn-reset {
            background: #f8fbff;
            color: #4a5568;
            border: 2px solid #e8e8e8;
            padding: 14px 40px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-reset:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
            color: #4a5568;
        }

        .btn-outline {
            background: transparent;
            color: var(--text-gray);
            border: 2px solid #e8e8e8;
            padding: 14px 40px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-outline:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
            color: var(--text-dark);
        }

        /* Danger Zone */
        .danger-zone-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(239, 71, 111, 0.1);
            overflow: hidden;
            border: 2px solid #fff5f5;
        }

        .danger-zone-card .card-header {
            background: linear-gradient(135deg, #ef476f, #d62839);
            color: white;
            padding: 25px 30px;
            border: none;
        }

        .danger-zone-card .card-body {
            padding: 30px;
        }

        .danger-actions {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .danger-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #fff5f5;
            border-radius: 12px;
            border: 2px solid #f8d7da;
            flex-wrap: wrap;
            gap: 15px;
        }

        .danger-info {
            flex: 1;
        }

        .danger-info h6 {
            font-size: 1rem;
            font-weight: 700;
            color: #721c24;
            margin: 0 0 8px 0;
        }

        .danger-info p {
            font-size: 0.9rem;
            color: #856404;
            margin: 0;
            line-height: 1.5;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef476f, #d62839);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 71, 111, 0.3);
        }

        .btn-export {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-export:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
        }

        /* Delete Account Modal */
        .deletion-warning {
            background: #fff5f5;
            border: 2px solid #f8d7da;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            text-align: left;
        }

        .warning-header {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #721c24;
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .warning-content p {
            font-weight: 600;
            color: #721c24;
            margin: 0 0 10px 0;
        }

        .warning-content ul {
            color: #721c24;
            padding-left: 20px;
            margin: 0;
        }

        .warning-content li {
            margin-bottom: 5px;
        }

        .confirmation-input {
            text-align: left;
            margin-top: 20px;
        }

        .confirmation-input .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        #confirmDelete {
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
        }

        #confirmDeleteBtn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .requirements-list {
                gap: 10px;
            }
            
            .requirement {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 768px) {
            .profile-header-card {
                padding: 30px 25px;
            }

            .profile-avatar-section {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .profile-actions {
                width: 100%;
                justify-content: center;
            }

            .profile-info h1 {
                font-size: 1.8rem;
            }

            .profile-stats {
                flex-direction: column;
                gap: 15px;
            }

            .profile-form-card .card-header {
                flex-direction: column;
                text-align: center;
                padding: 25px 20px;
            }

            .profile-form-card .card-body {
                padding: 30px 20px;
            }

            .form-section {
                padding: 20px;
            }

            .section-header {
                flex-direction: column;
                text-align: center;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit,
            .btn-reset,
            .btn-outline {
                width: 100%;
                justify-content: center;
            }

            .danger-action {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-danger,
            .btn-export {
                width: 100%;
                justify-content: center;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .requirements-list {
                flex-direction: column;
                gap: 8px;
            }
            
            .requirement {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .avatar-circle {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
            }

            .avatar-badge {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .password-requirements ul {
                grid-template-columns: 1fr;
            }
            
            .requirements-list {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
@endsection

@section('extra-js')
    <script>
        // Password toggle functionality
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggle = field.parentNode.querySelector('.password-toggle i');
            
            if (field.type === 'password') {
                field.type = 'text';
                toggle.className = 'bi bi-eye-slash';
            } else {
                field.type = 'password';
                toggle.className = 'bi bi-eye';
            }
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            const requirements = {
                length: password.length >= 8,
                upper: /[A-Z]/.test(password),
                lower: /[a-z]/.test(password),
                number: /[0-9]/.test(password),
                special: /[^A-Za-z0-9]/.test(password)
            };

            // Update requirement indicators
            Object.keys(requirements).forEach(key => {
                const element = document.getElementById(`req${key.charAt(0).toUpperCase() + key.slice(1)}`);
                if (element) {
                    if (requirements[key]) {
                        element.classList.add('valid');
                        element.querySelector('i').className = 'bi bi-check-circle-fill';
                        strength++;
                    } else {
                        element.classList.remove('valid');
                        element.querySelector('i').className = 'bi bi-circle';
                    }
                }
            });

            // Update strength bar
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            const percentage = (strength / 5) * 100;

            strengthFill.style.width = `${percentage}%`;

            // Set color and text based on strength
            if (password.length === 0) {
                strengthFill.style.background = '#e8e8e8';
                strengthText.textContent = 'Kekuatan password';
                strengthText.style.color = 'var(--text-gray)';
            } else if (strength <= 2) {
                strengthFill.style.background = '#ef476f';
                strengthText.textContent = 'Lemah';
                strengthText.style.color = '#ef476f';
            } else if (strength <= 3) {
                strengthFill.style.background = '#ffa500';
                strengthText.textContent = 'Cukup';
                strengthText.style.color = '#ffa500';
            } else if (strength <= 4) {
                strengthFill.style.background = '#06d6a0';
                strengthText.textContent = 'Kuat';
                strengthText.style.color = '#06d6a0';
            } else {
                strengthFill.style.background = '#0077b6';
                strengthText.textContent = 'Sangat Kuat';
                strengthText.style.color = '#0077b6';
            }
        }

        // Password match checker
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchElement = document.getElementById('passwordMatch');

            if (confirmPassword.length === 0) {
                matchElement.classList.remove('show');
            } else if (password === confirmPassword) {
                matchElement.classList.add('show');
            } else {
                matchElement.classList.remove('show');
            }
        }

        // Form validation
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');
            let isValid = true;

            // Reset previous errors
            password.classList.remove('is-invalid');
            passwordConfirmation.classList.remove('is-invalid');
            
            // Remove existing error messages
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                if (!el.parentNode.querySelector('.is-invalid')) {
                    el.remove();
                }
            });

            // Validate password confirmation
            if (password.value && password.value !== passwordConfirmation.value) {
                passwordConfirmation.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Konfirmasi password tidak sesuai!</span>';
                passwordConfirmation.parentNode.appendChild(errorDiv);
                isValid = false;
            }

            // Validate password strength if provided
            if (password.value && password.value.length < 8) {
                password.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Password minimal 8 karakter!</span>';
                password.parentNode.appendChild(errorDiv);
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                const firstError = document.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });

        // Event listeners for real-time validation
        document.getElementById('password').addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
            
            checkPasswordStrength(this.value);
            checkPasswordMatch();
        });

        document.getElementById('password_confirmation').addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
            
            checkPasswordMatch();
        });

        // Delete account modal functionality
        function showDeleteAccountModal() {
            const modal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
            modal.show();
        }

        document.getElementById('confirmDelete').addEventListener('input', function() {
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            confirmBtn.disabled = this.value !== 'HAPUS AKUN';
        });

        // Export data functionality
        function exportData() {
            // Show loading state
            const exportBtn = document.querySelector('.btn-export');
            const originalText = exportBtn.innerHTML;
            exportBtn.innerHTML = '<i class="bi bi-arrow-clockwise spinning"></i><span>Mengekspor...</span>';
            exportBtn.disabled = true;

            // Simulate export process
            setTimeout(() => {
                // Create and trigger download
                const blob = new Blob(['Data ekspor simulasi'], { type: 'application/pdf' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `data-pemilik-${new Date().toISOString().split('T')[0]}.pdf`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);

                // Reset button
                exportBtn.innerHTML = originalText;
                exportBtn.disabled = false;

                // Show success message
                alert('Data berhasil diekspor!');
            }, 2000);
        }

        // Reset form functionality
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset semua perubahan?')) {
                document.getElementById('profileForm').reset();
                checkPasswordStrength('');
                checkPasswordMatch();
            }
        }

        // Add spinning animation for loading
        const style = document.createElement('style');
        style.textContent = `
            .spinning {
                animation: spin 1s linear infinite;
            }
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);

        // Auto focus on first input
        document.getElementById('nama').focus();

        // Add form requestSubmit polyfill for older browsers
        if (!HTMLFormElement.prototype.requestSubmit) {
            HTMLFormElement.prototype.requestSubmit = function(submitter) {
                if (submitter) {
                    submitter.click();
                } else {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.click();
                    } else {
                        this.submit();
                    }
                }
            };
        }

        // Initialize password strength on load
        document.addEventListener('DOMContentLoaded', function() {
            checkPasswordStrength('');
            checkPasswordMatch();
        });
    </script>
@endsection