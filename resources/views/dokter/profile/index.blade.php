@extends('layouts.lte.main')

@section('title', 'Profile Dokter - RSHP UNAIR')

@section('page-icon', 'person-badge-fill')
@section('page-title', 'Profile Dokter')

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
                    </div>
                </div>
                <div class="profile-info">
                    <h1>{{ $user->nama }}</h1>
                    <p class="profile-role">Dokter</p>
                    <div class="profile-stats">
                        <div class="stat-item">
                            <i class="bi bi-envelope-fill"></i>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="stat-item">
                            <i class="bi bi-telephone-fill"></i>
                            <span>{{ $dokter->no_hp ?? 'Belum diatur' }}</span>
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
                    <form action="{{ route('dokter.profile.update') }}" method="POST" id="profileForm">
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

                                <div class="form-group">
                                    <label for="bidang_dokter" class="form-label">
                                        <i class="bi bi-heart-pulse me-2"></i>
                                        Bidang Keahlian
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="text" 
                                               id="bidang_dokter" 
                                               name="bidang_dokter" 
                                               class="form-control @error('bidang_dokter') is-invalid @enderror" 
                                               value="{{ old('bidang_dokter', $dokter->bidang_dokter ?? '') }}" 
                                               placeholder="Contoh: Bedah, Dermatologi, dll">
                                        <div class="input-icon">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                    </div>
                                    @error('bidang_dokter')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label">
                                        <i class="bi bi-gender-ambiguous me-2"></i>
                                        Jenis Kelamin
                                    </label>
                                    <div class="input-wrapper">
                                        <select id="jenis_kelamin" 
                                                name="jenis_kelamin" 
                                                class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin', $dokter->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin', $dokter->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        <div class="input-icon">
                                            <i class="bi bi-chevron-down"></i>
                                        </div>
                                    </div>
                                    @error('jenis_kelamin')
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
                                    <label for="no_hp" class="form-label">
                                        <i class="bi bi-phone-fill me-2"></i>
                                        Nomor HP
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="tel" 
                                               id="no_hp" 
                                               name="no_hp" 
                                               class="form-control @error('no_hp') is-invalid @enderror" 
                                               value="{{ old('no_hp', $dokter->no_hp ?? '') }}" 
                                               placeholder="Contoh: 081234567890">
                                        <div class="input-icon">
                                            <i class="bi bi-telephone"></i>
                                        </div>
                                    </div>
                                    @error('no_hp')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group full-width">
                                    <label for="alamat" class="form-label">
                                        <i class="bi bi-geo-alt-fill me-2"></i>
                                        Alamat
                                    </label>
                                    <div class="input-wrapper">
                                        <textarea id="alamat" 
                                                  name="alamat" 
                                                  class="form-control @error('alamat') is-invalid @enderror" 
                                                  rows="4"
                                                  placeholder="Masukkan alamat lengkap">{{ old('alamat', $dokter->alamat ?? '') }}</textarea>
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
                                    <p>Kosongkan field password jika tidak ingin mengubah password</p>
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
                                               placeholder="Masukkan password baru">
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
                                               placeholder="Konfirmasi password baru">
                                        <div class="input-icon">
                                            <i class="bi bi-lock-fill"></i>
                                        </div>
                                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                            <i class="bi bi-eye"></i>
                                        </button>
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
                        </div>
                    </form>
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

        /* Alert Success */
        .alert-success {
            background: linear-gradient(135deg, rgba(6, 214, 160, 0.1), rgba(5, 181, 137, 0.1));
            border: 2px solid var(--success);
            border-radius: 15px;
            padding: 0;
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

        .alert-content {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 18px 20px;
        }

        .alert-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--success), #05b589);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .alert-text strong {
            color: var(--success);
            font-size: 1rem;
            display: block;
            margin-bottom: 3px;
        }

        .alert-text p {
            color: var(--text-gray);
            margin: 0;
            font-size: 0.9rem;
        }

        .alert .btn-close {
            padding: 20px;
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

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.4);
        }

        .profile-info {
            text-align: center;
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
            margin-bottom: 40px;
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

                /* Perbaikan untuk card header icon */
        .card-header-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2) !important;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
            backdrop-filter: blur(10px);
            z-index: 10;
            position: relative;
        }

        .card-header-icon i {
            color: white !important;
            font-size: 1.8rem !important;
        }

        .profile-form-card .card-header {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            padding: 30px;
            border: none;
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
            overflow: hidden;
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

        select.form-control {
            appearance: none;
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

        /* Security Notice */
        .security-notice {
            background: #fff8e6;
            border: 2px solid #ffa500;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
            display: flex;
            align-items: start;
            gap: 12px;
        }

        .security-icon {
            color: #ffa500;
            font-size: 1.2rem;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .security-text p {
            margin: 0;
            color: var(--text-gray);
            font-size: 0.9rem;
            font-weight: 600;
            line-height: 1.5;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid var(--border-light);
            justify-content: center;
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

        /* Responsive */
        @media (max-width: 992px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
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
            .btn-reset {
                width: 100%;
                justify-content: center;
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

            .btn-action {
                width: 100%;
                justify-content: center;
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

            // Validate password length
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

        // Remove error class on input
        document.getElementById('password_confirmation').addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

        document.getElementById('password').addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

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
    </script>
@endsection