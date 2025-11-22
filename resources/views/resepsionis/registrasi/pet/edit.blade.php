@extends('layouts.lte.main')

@section('title', 'Edit Hewan - RSHP UNAIR')

@section('page-icon', 'paw-fill')
@section('page-title', 'Edit Data Hewan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard-resepsionis') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.registrasi.pet.index') }}">Data Hewan</a></li>
    <li class="breadcrumb-item active">Edit Data</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Current Value Card -->
            <div class="current-value-card mb-4">
                <div class="current-value-header">
                    <div class="current-value-icon">
                        <i class="bi bi-file-text-fill"></i>
                    </div>
                    <div class="current-value-text">
                        <h6>Data Saat Ini</h6>
                        <p>Informasi hewan yang sedang aktif dalam sistem</p>
                    </div>
                </div>
                <div class="current-value-body">
                    <div class="current-value-grid">
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-paw-fill"></i>
                                <span>Nama Hewan</span>
                            </div>
                            <div class="current-value-display">
                                {{ $pet->nama }}
                            </div>
                        </div>
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-tags-fill"></i>
                                <span>Jenis/Ras</span>
                            </div>
                            <div class="current-value-display">
                                {{ $pet->rasHewan->jenisHewan->nama_jenis_hewan }} / {{ $pet->rasHewan->nama_ras }}
                            </div>
                        </div>
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-person-fill"></i>
                                <span>Pemilik</span>
                            </div>
                            <div class="current-value-display">
                                {{ $pet->pemilik->user->nama }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Warning Card -->
            <div class="warning-card mb-4">
                <div class="warning-card-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div class="warning-card-content">
                    <h6>Perhatian!</h6>
                    <p>Pastikan data yang diubah sudah benar. Perubahan data hewan akan mempengaruhi riwayat medis dan perawatan</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Edit Hewan</h5>
                        <p>Perbarui data hewan dengan informasi yang benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('resepsionis.registrasi.pet.update', $pet->idpet) }}" method="POST" id="formEdit">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-paw-fill"></i>
                                <h6>Data Dasar Hewan</h6>
                            </div>
                            
                            <div class="form-group">
                                <label for="nama" class="form-label">
                                    <i class="bi bi-tag me-2"></i>
                                    Nama Hewan
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" 
                                           id="nama" 
                                           name="nama" 
                                           class="form-control @error('nama') is-invalid @enderror" 
                                           value="{{ old('nama', $pet->nama) }}" 
                                           placeholder="Masukkan nama hewan"
                                           autofocus>
                                    <div class="input-icon">
                                        <i class="bi bi-paw"></i>
                                    </div>
                                </div>
                                @error('nama')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="idpemilik" class="form-label">
                                        <i class="bi bi-person me-2"></i>
                                        Pemilik
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <select id="idpemilik" 
                                                name="idpemilik" 
                                                class="form-control @error('idpemilik') is-invalid @enderror"
                                                required>
                                            <option value="">Pilih Pemilik</option>
                                            @foreach($pemilik as $pem)
                                                <option value="{{ $pem->idpemilik }}" 
                                                        {{ old('idpemilik', $pet->idpemilik) == $pem->idpemilik ? 'selected' : '' }}>
                                                    {{ $pem->user->nama }} - {{ $pem->no_wa }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-icon">
                                            <i class="bi bi-chevron-down"></i>
                                        </div>
                                    </div>
                                    @error('idpemilik')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="jenis_kelamin" class="form-label">
                                        <i class="bi bi-gender-ambiguous me-2"></i>
                                        Jenis Kelamin
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <select id="jenis_kelamin" 
                                                name="jenis_kelamin" 
                                                class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                                required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'L' ? 'selected' : '' }}>Jantan</option>
                                            <option value="P" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'P' ? 'selected' : '' }}>Betina</option>
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

                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-tags-fill"></i>
                                <h6>Klasifikasi Hewan</h6>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="idjenis_hewan" class="form-label">
                                        <i class="bi bi-diagram-3 me-2"></i>
                                        Jenis Hewan
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <select id="idjenis_hewan" 
                                                name="idjenis_hewan" 
                                                class="form-control @error('idjenis_hewan') is-invalid @enderror"
                                                required>
                                            <option value="">Pilih Jenis Hewan</option>
                                            @foreach($jenisHewan as $jenis)
                                                <option value="{{ $jenis->idjenis_hewan }}" 
                                                        {{ old('idjenis_hewan', $pet->rasHewan->idjenis_hewan) == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                                    {{ $jenis->nama_jenis_hewan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-icon">
                                            <i class="bi bi-chevron-down"></i>
                                        </div>
                                    </div>
                                    @error('idjenis_hewan')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="idras_hewan" class="form-label">
                                        <i class="bi bi-tag me-2"></i>
                                        Ras Hewan
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <select id="idras_hewan" 
                                                name="idras_hewan" 
                                                class="form-control @error('idras_hewan') is-invalid @enderror"
                                                required>
                                            <option value="">Pilih Ras</option>
                                            @foreach($rasHewan as $ras)
                                                <option value="{{ $ras->idras_hewan }}" 
                                                        {{ old('idras_hewan', $pet->idras_hewan) == $ras->idras_hewan ? 'selected' : '' }}>
                                                    {{ $ras->nama_ras }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-icon">
                                            <i class="bi bi-chevron-down"></i>
                                        </div>
                                    </div>
                                    @error('idras_hewan')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-palette-fill"></i>
                                <h6>Informasi Tambahan</h6>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tanggal_lahir" class="form-label">
                                        <i class="bi bi-calendar-event me-2"></i>
                                        Tanggal Lahir
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="date" 
                                               id="tanggal_lahir" 
                                               name="tanggal_lahir" 
                                               class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                               value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}">
                                        <div class="input-icon">
                                            <i class="bi bi-calendar"></i>
                                        </div>
                                    </div>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="warna_tanda" class="form-label">
                                        <i class="bi bi-palette me-2"></i>
                                        Warna/Tanda Khas
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="text" 
                                               id="warna_tanda" 
                                               name="warna_tanda" 
                                               class="form-control @error('warna_tanda') is-invalid @enderror" 
                                               value="{{ old('warna_tanda', $pet->warna_tanda) }}" 
                                               placeholder="Contoh: Putih, Hitam, Coklat, Stripes">
                                        <div class="input-icon">
                                            <i class="bi bi-brush"></i>
                                        </div>
                                    </div>
                                    @error('warna_tanda')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="comparison-section">
                            <div class="comparison-header">
                                <i class="bi bi-arrow-left-right"></i>
                                <span>Perbandingan Perubahan</span>
                            </div>
                            <div class="comparison-grid">
                                <div class="comparison-item comparison-old">
                                    <div class="comparison-label">
                                        <i class="bi bi-file-text"></i>
                                        <span>Data Lama</span>
                                    </div>
                                    <div class="comparison-content">
                                        <div class="comparison-field">
                                            <span class="field-label">Nama:</span>
                                            <span class="field-value">{{ $pet->nama }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Jenis/Ras:</span>
                                            <span class="field-value">{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan }} / {{ $pet->rasHewan->nama_ras }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Jenis Kelamin:</span>
                                            <span class="field-value">{{ $pet->jenis_kelamin == 'L' ? 'Jantan' : 'Betina' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comparison-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                                <div class="comparison-item comparison-new">
                                    <div class="comparison-label">
                                        <i class="bi bi-file-earmark-check"></i>
                                        <span>Data Baru</span>
                                    </div>
                                    <div class="comparison-content">
                                        <div class="comparison-field">
                                            <span class="field-label">Nama:</span>
                                            <span class="field-value" id="newNama">{{ old('nama', $pet->nama) }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Jenis/Ras:</span>
                                            <span class="field-value" id="newJenisRas">
                                                @php
                                                    $selectedJenis = $jenisHewan->firstWhere('idjenis_hewan', old('idjenis_hewan', $pet->rasHewan->idjenis_hewan));
                                                    $selectedRas = $rasHewan->firstWhere('idras_hewan', old('idras_hewan', $pet->idras_hewan));
                                                @endphp
                                                {{ $selectedJenis->nama_jenis_hewan ?? $pet->rasHewan->jenisHewan->nama_jenis_hewan }} / {{ $selectedRas->nama_ras ?? $pet->rasHewan->nama_ras }}
                                            </span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Jenis Kelamin:</span>
                                            <span class="field-value" id="newGender">
                                                {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'L' ? 'Jantan' : 'Betina' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Update Data</span>
                            </button>
                            <a href="{{ route('resepsionis.registrasi.pet.index') }}" class="btn btn-secondary btn-cancel">
                                <i class="bi bi-x-circle-fill"></i>
                                <span>Batal</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Current Value Card */
        .current-value-card {
            background: linear-gradient(135deg, #f0f9ff, #e3f2fd);
            border: 2px solid #0077b6;
            border-radius: 15px;
            overflow: hidden;
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

        .current-value-header {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .current-value-icon {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            backdrop-filter: blur(10px);
        }

        .current-value-text h6 {
            margin: 0 0 3px 0;
            font-size: 1rem;
            font-weight: 700;
        }

        .current-value-text p {
            margin: 0;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .current-value-body {
            padding: 25px;
        }

        .current-value-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .current-value-item {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .current-value-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #4a5568;
        }

        .current-value-label i {
            color: #0077b6;
            font-size: 1rem;
        }

        .current-value-display {
            background: white;
            border: 2px solid #0077b6;
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #023e8a;
            word-break: break-word;
        }

        /* Warning Card */
        .warning-card {
            background: linear-gradient(135deg, rgba(255, 165, 0, 0.05), rgba(255, 140, 0, 0.05));
            border: 2px solid rgba(255, 165, 0, 0.3);
            border-radius: 15px;
            padding: 20px 25px;
            display: flex;
            align-items: start;
            gap: 20px;
            animation: slideDown 0.6s ease;
        }

        .warning-card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #ffa500, #ff8c00);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .warning-card-content h6 {
            font-size: 1rem;
            font-weight: 700;
            color: #ff8c00;
            margin: 0 0 5px 0;
        }

        .warning-card-content p {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin: 0;
            line-height: 1.6;
        }

        /* Form Card */
        .form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(255, 165, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.7s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-card .card-header {
            background: linear-gradient(135deg, #ffa500, #ff8c00);
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

        .form-card .card-body {
            padding: 40px;
        }

        /* Form Sections */
        .form-section {
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #f8fbff;
        }

        .form-section:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            padding: 15px 20px;
            background: linear-gradient(135deg, rgba(255, 165, 0, 0.05), rgba(255, 140, 0, 0.05));
            border-radius: 12px;
            border-left: 4px solid #ffa500;
        }

        .section-header i {
            color: #ffa500;
            font-size: 1.3rem;
        }

        .section-header h6 {
            margin: 0;
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 1.1rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 25px;
        }

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
        }

        .form-control:focus {
            border-color: #ffa500;
            background: white;
            box-shadow: 0 0 0 4px rgba(255, 165, 0, 0.1);
        }

        .form-control::placeholder {
            color: #a0a0a0;
        }

        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #ffa500;
            font-size: 1.2rem;
            pointer-events: none;
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

        /* Comparison Section */
        .comparison-section {
            background: #f8fbff;
            border: 2px dashed #0077b6;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .comparison-header {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 20px;
        }

        .comparison-header i {
            color: #0077b6;
            font-size: 1.2rem;
        }

        .comparison-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 20px;
            align-items: start;
        }

        .comparison-item {
            background: white;
            border-radius: 12px;
            padding: 20px;
            min-height: 200px;
        }

        .comparison-old {
            border: 2px solid #e8e8e8;
        }

        .comparison-new {
            border: 2px solid #06d6a0;
        }

        .comparison-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .comparison-label i {
            font-size: 1rem;
        }

        .comparison-old .comparison-label {
            color: #ef476f;
        }

        .comparison-old .comparison-label i {
            color: #ef476f;
        }

        .comparison-new .comparison-label {
            color: #06d6a0;
        }

        .comparison-new .comparison-label i {
            color: #06d6a0;
        }

        .comparison-content {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .comparison-field {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .field-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .field-value {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
            word-break: break-word;
        }

        .comparison-arrow {
            color: #0077b6;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 80px;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f8fbff;
            justify-content: center;
        }

        .btn-submit {
            background: linear-gradient(135deg, #ffa500, #ff8c00);
            color: white;
            border: none;
            padding: 12px 40px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(255, 165, 0, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 165, 0, 0.4);
        }

        .btn-cancel {
            background: #f8fbff;
            color: #4a5568;
            border: 2px solid #e8e8e8;
            padding: 12px 40px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
            color: #4a5568;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .current-value-header,
            .warning-card {
                flex-direction: column;
                text-align: center;
            }

            .current-value-grid {
                grid-template-columns: 1fr;
            }

            .form-card .card-header {
                flex-direction: column;
                text-align: center;
                padding: 25px 20px;
            }

            .form-card .card-body {
                padding: 30px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .comparison-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .comparison-arrow {
                transform: rotate(90deg);
                margin: 10px 0;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection

@section('extra-js')
    <script>
        // Auto focus and select all text
        const namaInput = document.getElementById('nama');
        namaInput.focus();
        namaInput.select();

        // Live preview of new values
        document.getElementById('nama').addEventListener('input', function() {
            document.getElementById('newNama').textContent = this.value || '{{ $pet->nama }}';
        });

        document.getElementById('jenis_kelamin').addEventListener('change', function() {
            const genderText = this.value ? (this.value === 'L' ? 'Jantan' : 'Betina') : '{{ $pet->jenis_kelamin == 'L' ? 'Jantan' : 'Betina' }}';
            document.getElementById('newGender').textContent = genderText;
        });

        // Update jenis/ras when selections change
        function updateJenisRasPreview() {
            const jenisSelect = document.getElementById('idjenis_hewan');
            const rasSelect = document.getElementById('idras_hewan');
            
            const jenisText = jenisSelect.options[jenisSelect.selectedIndex]?.text || '{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan }}';
            const rasText = rasSelect.options[rasSelect.selectedIndex]?.text || '{{ $pet->rasHewan->nama_ras }}';
            
            document.getElementById('newJenisRas').textContent = `${jenisText} / ${rasText}`;
        }

        document.getElementById('idjenis_hewan').addEventListener('change', updateJenisRasPreview);
        document.getElementById('idras_hewan').addEventListener('change', updateJenisRasPreview);

        // Form validation before submit
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            const nama = document.getElementById('nama');
            const idpemilik = document.getElementById('idpemilik');
            const jenisKelamin = document.getElementById('jenis_kelamin');
            const idjenisHewan = document.getElementById('idjenis_hewan');
            const idrasHewan = document.getElementById('idras_hewan');
            const tanggalLahir = document.getElementById('tanggal_lahir');
            const warnaTanda = document.getElementById('warna_tanda');
            let isValid = true;

            // Reset previous errors
            [nama, idpemilik, jenisKelamin, idjenisHewan, idrasHewan, tanggalLahir, warnaTanda].forEach(field => {
                if (field) field.classList.remove('is-invalid');
            });
            
            // Remove existing error messages
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                if (!el.parentNode.querySelector('.is-invalid')) {
                    el.remove();
                }
            });

            // Validate required fields
            const fields = [
                { field: nama, name: 'Nama hewan' },
                { field: idpemilik, name: 'Pemilik' },
                { field: jenisKelamin, name: 'Jenis kelamin' },
                { field: idjenisHewan, name: 'Jenis hewan' },
                { field: idrasHewan, name: 'Ras hewan' },
                { field: tanggalLahir, name: 'Tanggal lahir' },
                { field: warnaTanda, name: 'Warna/tanda' }
            ];

            fields.forEach(({ field, name }) => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                    errorDiv.innerHTML = `<i class="bi bi-exclamation-circle-fill"></i><span>${name} wajib diisi!</span>`;
                    field.parentNode.appendChild(errorDiv);
                    isValid = false;
                }
            });

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
        document.getElementById('nama').addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

        document.getElementById('idpemilik').addEventListener('change', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

        document.getElementById('jenis_kelamin').addEventListener('change', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

        document.getElementById('idjenis_hewan').addEventListener('change', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

        document.getElementById('idras_hewan').addEventListener('change', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

        document.getElementById('tanggal_lahir').addEventListener('change', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

        document.getElementById('warna_tanda').addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });
    </script>
@endsection