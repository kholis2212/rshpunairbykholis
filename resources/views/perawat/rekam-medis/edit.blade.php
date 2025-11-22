@extends('layouts.lte.main')

@section('title', 'Edit Rekam Medis - RSHP UNAIR')

@section('page-icon', 'pencil-square')
@section('page-title', 'Edit Rekam Medis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard-perawat') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.rekam-medis.index') }}">Daftar Rekam Medis</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.rekam-medis.show', $rekamMedis->idrekam_medis) }}">Detail Rekam Medis</a></li>
    <li class="breadcrumb-item active">Edit Rekam Medis</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Current Value Card -->
            <div class="current-value-card mb-4">
                <div class="current-value-header">
                    <div class="current-value-icon">
                        <i class="bi bi-file-text-fill"></i>
                    </div>
                    <div class="current-value-text">
                        <h6>Data Saat Ini</h6>
                        <p>Informasi rekam medis yang sedang aktif</p>
                    </div>
                </div>
                <div class="current-value-body">
                    <div class="current-value-grid">
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-paw-fill"></i>
                                <span>Pasien</span>
                            </div>
                            <div class="current-value-display">
                                {{ $rekamMedis->pet->nama }} - {{ $rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan }}
                            </div>
                        </div>
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-person-badge"></i>
                                <span>Dokter Pemeriksa</span>
                            </div>
                            <div class="current-value-display">
                                {{ $rekamMedis->dokter->nama ?? 'Data dokter tidak tersedia' }}
                            </div>
                        </div>
                        <div class="current-value-item full-width">
                            <div class="current-value-label">
                                <i class="bi bi-calendar-event-fill"></i>
                                <span>Tanggal Pemeriksaan</span>
                            </div>
                            <div class="current-value-display">
                                {{ $rekamMedis->created_at->format('d M Y, H:i') }}
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
                    <p>Pastikan perubahan data rekam medis dilakukan dengan hati-hati. Data yang diubah akan tercatat dalam riwayat pasien</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Edit Rekam Medis</h5>
                        <p>Perbarui data rekam medis dengan informasi yang benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('perawat.rekam-medis.update', $rekamMedis->idrekam_medis) }}" method="POST" id="formEdit">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-paw-fill"></i>
                                <h6>Data Pasien</h6>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="idpet" class="form-label">
                                        <i class="bi bi-paw me-2"></i>
                                        Pilih Pasien
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <select id="idpet" 
                                                name="idpet" 
                                                class="form-control @error('idpet') is-invalid @enderror"
                                                required>
                                            <option value="">Pilih Pasien</option>
                                            @foreach($pets as $pet)
                                                <option value="{{ $pet->idpet }}" 
                                                        {{ old('idpet', $rekamMedis->idpet) == $pet->idpet ? 'selected' : '' }}
                                                        data-jenis="{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan }}"
                                                        data-ras="{{ $pet->rasHewan->nama_ras }}"
                                                        data-pemilik="{{ $pet->pemilik->user->nama }}">
                                                    {{ $pet->nama }} - {{ $pet->rasHewan->jenisHewan->nama_jenis_hewan }} ({{ $pet->pemilik->user->nama }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-icon">
                                            <i class="bi bi-chevron-down"></i>
                                        </div>
                                    </div>
                                    @error('idpet')
                                        <div class="invalid-feedback d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="dokter_pemeriksa" class="form-label">
                                        <i class="bi bi-person-badge me-2"></i>
                                        Dokter Pemeriksa
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <select id="dokter_pemeriksa" 
                                                name="dokter_pemeriksa" 
                                                class="form-control @error('dokter_pemeriksa') is-invalid @enderror"
                                                required>
                                            <option value="">Pilih Dokter</option>
                                            @foreach($dokters as $dokter)
                                                <option value="{{ $dokter->iduser }}" 
                                                        {{ old('dokter_pemeriksa', $rekamMedis->dokter_pemeriksa) == $dokter->iduser ? 'selected' : '' }}>
                                                    {{ $dokter->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-icon">
                                            <i class="bi bi-chevron-down"></i>
                                        </div>
                                    </div>
                                    @error('dokter_pemeriksa')
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
                                <i class="bi bi-clipboard2-pulse-fill"></i>
                                <h6>Data Pemeriksaan</h6>
                            </div>
                            <div class="form-group">
                                <label for="anamnesa" class="form-label">
                                    <i class="bi bi-chat-left-text me-2"></i>
                                    Anamnesa
                                </label>
                                <div class="input-wrapper">
                                    <textarea id="anamnesa" 
                                              name="anamnesa" 
                                              class="form-control @error('anamnesa') is-invalid @enderror" 
                                              rows="4"
                                              placeholder="Jelaskan keluhan utama dan riwayat penyakit pasien...">{{ old('anamnesa', $rekamMedis->anamnesa) }}</textarea>
                                    <div class="input-icon textarea-icon">
                                        <i class="bi bi-text-paragraph"></i>
                                    </div>
                                </div>
                                @error('anamnesa')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="char-counter">
                                    <span id="anamnesaCount">{{ strlen(old('anamnesa', $rekamMedis->anamnesa)) }}</span>/1000 karakter
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="temuan_klinis" class="form-label">
                                    <i class="bi bi-clipboard-check me-2"></i>
                                    Temuan Klinis
                                </label>
                                <div class="input-wrapper">
                                    <textarea id="temuan_klinis" 
                                              name="temuan_klinis" 
                                              class="form-control @error('temuan_klinis') is-invalid @enderror" 
                                              rows="4"
                                              placeholder="Jelaskan temuan klinis dari pemeriksaan fisik...">{{ old('temuan_klinis', $rekamMedis->temuan_klinis) }}</textarea>
                                    <div class="input-icon textarea-icon">
                                        <i class="bi bi-clipboard-data"></i>
                                    </div>
                                </div>
                                @error('temuan_klinis')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="char-counter">
                                    <span id="temuanCount">{{ strlen(old('temuan_klinis', $rekamMedis->temuan_klinis)) }}</span>/1000 karakter
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="diagnosa" class="form-label">
                                    <i class="bi bi-file-medical me-2"></i>
                                    Diagnosa
                                </label>
                                <div class="input-wrapper">
                                    <textarea id="diagnosa" 
                                              name="diagnosa" 
                                              class="form-control @error('diagnosa') is-invalid @enderror" 
                                              rows="4"
                                              placeholder="Tuliskan diagnosa berdasarkan anamnesa dan temuan klinis...">{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
                                    <div class="input-icon textarea-icon">
                                        <i class="bi bi-prescription2"></i>
                                    </div>
                                </div>
                                @error('diagnosa')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="char-counter">
                                    <span id="diagnosaCount">{{ strlen(old('diagnosa', $rekamMedis->diagnosa)) }}</span>/1000 karakter
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
                                            <span class="field-label">Anamnesa:</span>
                                            <span class="field-value">{{ $rekamMedis->anamnesa ? Str::limit($rekamMedis->anamnesa, 100) : '-' }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Temuan Klinis:</span>
                                            <span class="field-value">{{ $rekamMedis->temuan_klinis ? Str::limit($rekamMedis->temuan_klinis, 100) : '-' }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Diagnosa:</span>
                                            <span class="field-value">{{ $rekamMedis->diagnosa ? Str::limit($rekamMedis->diagnosa, 100) : '-' }}</span>
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
                                            <span class="field-label">Anamnesa:</span>
                                            <span class="field-value" id="newAnamnesaPreview">
                                                {{ $rekamMedis->anamnesa ? Str::limit($rekamMedis->anamnesa, 100) : '-' }}
                                            </span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Temuan Klinis:</span>
                                            <span class="field-value" id="newTemuanPreview">
                                                {{ $rekamMedis->temuan_klinis ? Str::limit($rekamMedis->temuan_klinis, 100) : '-' }}
                                            </span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Diagnosa:</span>
                                            <span class="field-value" id="newDiagnosaPreview">
                                                {{ $rekamMedis->diagnosa ? Str::limit($rekamMedis->diagnosa, 100) : '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Update Rekam Medis</span>
                            </button>
                            <a href="{{ route('perawat.rekam-medis.show', $rekamMedis->idrekam_medis) }}" class="btn btn-secondary btn-cancel">
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
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .current-value-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .current-value-item.full-width {
            grid-column: 1 / -1;
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
            padding: 15px 20px;
            font-size: 0.95rem;
            font-weight: 600;
            color: #023e8a;
            line-height: 1.5;
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
            height: 100%;
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
            line-height: 1.4;
            word-break: break-word;
        }

        .comparison-arrow {
            color: #0077b6;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 40px;
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

        /* Form Styles */
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
            background: linear-gradient(135deg, rgba(0, 119, 182, 0.05), rgba(0, 150, 199, 0.05));
            border-radius: 12px;
            border-left: 4px solid var(--primary);
        }

        .section-header i {
            color: var(--primary);
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

        select.form-control {
            appearance: none;
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

        .textarea-icon {
            top: 25px;
            transform: none;
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

        /* Character Counter */
        .char-counter {
            text-align: right;
            font-size: 0.8rem;
            color: var(--text-gray);
            margin-top: 5px;
            font-weight: 600;
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
            .comparison-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .comparison-arrow {
                transform: rotate(90deg);
                padding-top: 0;
                padding-bottom: 0;
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
        // Auto focus and select all text in first input
        const patientSelect = document.getElementById('idpet');
        patientSelect.focus();

        // Character counters
        const anamnesaTextarea = document.getElementById('anamnesa');
        const temuanTextarea = document.getElementById('temuan_klinis');
        const diagnosaTextarea = document.getElementById('diagnosa');
        const anamnesaCount = document.getElementById('anamnesaCount');
        const temuanCount = document.getElementById('temuanCount');
        const diagnosaCount = document.getElementById('diagnosaCount');

        function setupCharacterCounter(textarea, counter) {
            textarea.addEventListener('input', function() {
                const count = this.value.length;
                counter.textContent = count;
                
                if (count > 1000) {
                    counter.style.color = '#ef476f';
                } else if (count > 800) {
                    counter.style.color = '#ffa500';
                } else {
                    counter.style.color = '#0077b6';
                }
                
                // Update comparison preview
                const previewId = 'new' + textarea.id.charAt(0).toUpperCase() + textarea.id.slice(1) + 'Preview';
                const previewElement = document.getElementById(previewId);
                if (previewElement) {
                    previewElement.textContent = this.value ? this.value.substring(0, 100) + (this.value.length > 100 ? '...' : '') : '-';
                }
            });
        }

        setupCharacterCounter(anamnesaTextarea, anamnesaCount);
        setupCharacterCounter(temuanTextarea, temuanCount);
        setupCharacterCounter(diagnosaTextarea, diagnosaCount);

        // Form validation before submit
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            const patientSelect = document.getElementById('idpet');
            const dokterSelect = document.getElementById('dokter_pemeriksa');
            let isValid = true;

            // Reset previous errors
            patientSelect.classList.remove('is-invalid');
            dokterSelect.classList.remove('is-invalid');
            
            // Remove existing error messages
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                if (!el.parentNode.querySelector('.is-invalid')) {
                    el.remove();
                }
            });

            // Validate patient selection
            if (!patientSelect.value) {
                patientSelect.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Pilih pasien!</span>';
                patientSelect.parentNode.appendChild(errorDiv);
                isValid = false;
            }

            // Validate doctor selection
            if (!dokterSelect.value) {
                dokterSelect.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Pilih dokter pemeriksa!</span>';
                dokterSelect.parentNode.appendChild(errorDiv);
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
        patientSelect.addEventListener('change', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

        document.getElementById('dokter_pemeriksa').addEventListener('change', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });
    </script>
@endsection