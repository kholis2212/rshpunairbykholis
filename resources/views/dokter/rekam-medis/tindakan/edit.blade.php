@extends('layouts.lte.main')

@section('title', 'Edit Tindakan - RSHP UNAIR')

@section('page-icon', 'pencil-square')
@section('page-title', 'Edit Tindakan & Terapi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard-dokter') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dokter.rekam-medis.index') }}">Daftar Rekam Medis</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dokter.rekam-medis.show', $rekamMedis->idrekam_medis) }}">Detail Rekam Medis</a></li>
    <li class="breadcrumb-item active">Edit Tindakan</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Patient Info Card -->
            <div class="patient-summary-card mb-4">
                <div class="patient-header">
                    <div class="patient-avatar">
                        @if(str_contains($rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Anjing'))
                            🐕
                        @elseif(str_contains($rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Kucing'))
                            🐈
                        @elseif(str_contains($rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Burung'))
                            🐦
                        @elseif(str_contains($rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Kelinci'))
                            🐇
                        @else
                            🐾
                        @endif
                    </div>
                    <div class="patient-details">
                        <h4>{{ $rekamMedis->pet->nama }}</h4>
                        <p>{{ $rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan }} - {{ $rekamMedis->pet->rasHewan->nama_ras }}</p>
                        <div class="patient-meta">
                            <span class="meta-item">
                                <i class="bi bi-person-fill"></i>
                                {{ $rekamMedis->pet->pemilik->user->nama }}
                            </span>
                            <span class="meta-item">
                                <i class="bi bi-calendar-event-fill"></i>
                                {{ $rekamMedis->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Value Card -->
            <div class="current-value-card mb-4">
                <div class="current-value-header">
                    <div class="current-value-icon">
                        <i class="bi bi-file-text-fill"></i>
                    </div>
                    <div class="current-value-text">
                        <h6>Nilai Saat Ini</h6>
                        <p>Data tindakan yang sedang aktif</p>
                    </div>
                </div>
                <div class="current-value-body">
                    <div class="current-value-grid">
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-prescription2"></i>
                                <span>Kode Tindakan</span>
                            </div>
                            <div class="current-value-display">
                                {{ $detail->kodeTindakanTerapi->kode }} - {{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi }}
                            </div>
                        </div>
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-tags-fill"></i>
                                <span>Kategori & Tipe</span>
                            </div>
                            <div class="current-value-display">
                                {{ $detail->kodeTindakanTerapi->kategori->nama_kategori }} • {{ $detail->kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis }}
                            </div>
                        </div>
                        <div class="current-value-item full-width">
                            <div class="current-value-label">
                                <i class="bi bi-journal-text"></i>
                                <span>Detail Tindakan</span>
                            </div>
                            <div class="current-value-display">
                                {{ $detail->detail }}
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
                    <p>Pastikan perubahan data tindakan dilakukan dengan hati-hati. Data yang diubah akan tercatat dalam riwayat rekam medis pasien</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Edit Tindakan & Terapi</h5>
                        <p>Perbarui data tindakan dengan informasi yang benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('dokter.rekam-medis.tindakan.update', [$rekamMedis->idrekam_medis, $detail->iddetail_rekam_medis]) }}" method="POST" id="formEdit">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="idkode_tindakan_terapi" class="form-label">
                                <i class="bi bi-prescription2 me-2"></i>
                                Kode Tindakan/Terapi
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <select id="idkode_tindakan_terapi" 
                                        name="idkode_tindakan_terapi" 
                                        class="form-control @error('idkode_tindakan_terapi') is-invalid @enderror"
                                        required>
                                    <option value="">Pilih Kode Tindakan/Terapi</option>
                                    @foreach($kodeTindakanTerapi as $kode)
                                        <option value="{{ $kode->idkode_tindakan_terapi }}" 
                                                {{ old('idkode_tindakan_terapi', $detail->idkode_tindakan_terapi) == $kode->idkode_tindakan_terapi ? 'selected' : '' }}
                                                data-kategori="{{ $kode->kategori->nama_kategori }}"
                                                data-tipe="{{ $kode->kategoriKlinis->nama_kategori_klinis }}">
                                            {{ $kode->kode }} - {{ $kode->deskripsi_tindakan_terapi }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-icon">
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                            @error('idkode_tindakan_terapi')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Pilih kode tindakan atau terapi yang sesuai dengan penanganan medis</span>
                            </div>
                        </div>

                        <!-- Selected Code Preview -->
                        <div class="code-preview" id="codePreview">
                            <div class="preview-header">
                                <h6>Detail Tindakan Terpilih</h6>
                            </div>
                            <div class="preview-content">
                                <div class="preview-row">
                                    <div class="preview-item">
                                        <span class="preview-label">Kode</span>
                                        <span class="preview-value" id="previewKode">
                                            {{ $detail->kodeTindakanTerapi->kode }}
                                        </span>
                                    </div>
                                    <div class="preview-item">
                                        <span class="preview-label">Kategori</span>
                                        <span class="preview-value" id="previewKategori">
                                            {{ $detail->kodeTindakanTerapi->kategori->nama_kategori }}
                                        </span>
                                    </div>
                                    <div class="preview-item">
                                        <span class="preview-label">Tipe</span>
                                        <span class="preview-value" id="previewTipe">
                                            {{ $detail->kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis }}
                                        </span>
                                    </div>
                                </div>
                                <div class="preview-description">
                                    <span class="preview-label">Deskripsi</span>
                                    <p class="preview-value" id="previewDeskripsi">
                                        {{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="detail" class="form-label">
                                <i class="bi bi-journal-text me-2"></i>
                                Detail Tindakan/Terapi
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <textarea id="detail" 
                                          name="detail" 
                                          class="form-control @error('detail') is-invalid @enderror" 
                                          rows="6"
                                          placeholder="Jelaskan detail tindakan atau terapi yang diberikan, termasuk dosis, cara pemberian, dan instruksi khusus..."
                                          required>{{ old('detail', $detail->detail) }}</textarea>
                                <div class="input-icon textarea-icon">
                                    <i class="bi bi-text-paragraph"></i>
                                </div>
                            </div>
                            @error('detail')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Jelaskan secara detail tentang tindakan atau terapi yang diberikan</span>
                            </div>
                            <div class="char-counter">
                                <span id="charCount">{{ strlen(old('detail', $detail->detail)) }}</span>/1000 karakter
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
                                            <span class="field-label">Kode:</span>
                                            <span class="field-value">{{ $detail->kodeTindakanTerapi->kode }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Detail:</span>
                                            <span class="field-value">{{ $detail->detail }}</span>
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
                                            <span class="field-label">Kode:</span>
                                            <span class="field-value" id="newCodePreview">
                                                {{ $detail->kodeTindakanTerapi->kode }}
                                            </span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Detail:</span>
                                            <span class="field-value" id="newDetailPreview">
                                                {{ $detail->detail }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Update Tindakan</span>
                            </button>
                            <a href="{{ route('dokter.rekam-medis.show', $rekamMedis->idrekam_medis) }}" class="btn btn-secondary btn-cancel">
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
        /* Patient Info Card - IMPROVED */
        .patient-summary-card {
            background: linear-gradient(135deg, #f0f9ff, #e3f2fd);
            border: 2px solid #0077b6;
            border-radius: 15px;
            overflow: hidden;
            animation: slideDown 0.5s ease;
        }

        .patient-header {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 25px;
        }

        .patient-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            box-shadow: 0 8px 20px rgba(0, 119, 182, 0.3);
            flex-shrink: 0;
        }

        .patient-details {
            flex: 1;
        }

        .patient-details h4 {
            margin: 0 0 5px 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: #023e8a;
        }

        .patient-details p {
            margin: 0 0 15px 0;
            font-size: 1rem;
            color: #4a5568;
            font-weight: 600;
        }

        .patient-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: #4a5568;
            background: white;
            padding: 8px 15px;
            border-radius: 10px;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .meta-item i {
            color: #0077b6;
            font-size: 1rem;
        }

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
        .form-group {
            margin-bottom: 30px;
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

        .form-hint {
            background: #fff8e6;
            border-left: 3px solid #ffa500;
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
            color: #ffa500;
            font-size: 1rem;
            margin-top: 2px;
        }

        /* Code Preview */
        .code-preview {
            background: linear-gradient(135deg, #f8fbff, #e3f2fd);
            border: 2px solid #0077b6;
            border-radius: 15px;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .preview-header {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            padding: 15px 20px;
        }

        .preview-header h6 {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
        }

        .preview-content {
            padding: 20px;
        }

        .preview-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 15px;
        }

        .preview-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .preview-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .preview-value {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .preview-description {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .preview-description .preview-value {
            background: white;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
            font-weight: 500;
            line-height: 1.5;
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
        }

        .btn-submit {
            background: linear-gradient(135deg, #ffa500, #ff8c00);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(255, 165, 0, 0.3);
            flex: 1;
            justify-content: center;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 165, 0, 0.4);
        }

        .btn-cancel {
            background: #f8fbff;
            color: #4a5568;
            border: 2px solid #e8e8e8;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            flex: 1;
            justify-content: center;
        }

        .btn-cancel:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
            color: #4a5568;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .patient-header {
                flex-direction: column;
                text-align: center;
            }

            .patient-meta {
                justify-content: center;
            }

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

            .preview-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
            }
        }
    </style>
@endsection

@section('extra-js')
    <script>
        // Auto focus and select all text in first input
        const codeSelect = document.getElementById('idkode_tindakan_terapi');
        codeSelect.focus();

        // Character counter for textarea
        const textarea = document.getElementById('detail');
        const charCount = document.getElementById('charCount');

        textarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count;
            
            if (count > 1000) {
                charCount.style.color = '#ef476f';
            } else if (count > 800) {
                charCount.style.color = '#ffa500';
            } else {
                charCount.style.color = '#0077b6';
            }
            
            // Update comparison preview
            document.getElementById('newDetailPreview').textContent = this.value || '-';
        });

        // Code preview and comparison functionality
        const codePreview = document.getElementById('codePreview');
        const previewKode = document.getElementById('previewKode');
        const previewKategori = document.getElementById('previewKategori');
        const previewTipe = document.getElementById('previewTipe');
        const previewDeskripsi = document.getElementById('previewDeskripsi');
        const newCodePreview = document.getElementById('newCodePreview');

        codeSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (this.value) {
                // Extract data from option
                const optionText = selectedOption.textContent;
                const parts = optionText.split(' - ');
                
                previewKode.textContent = parts[0];
                previewDeskripsi.textContent = parts[1] || '-';
                previewKategori.textContent = selectedOption.getAttribute('data-kategori') || '-';
                previewTipe.textContent = selectedOption.getAttribute('data-tipe') || '-';
                
                // Update comparison preview
                newCodePreview.textContent = parts[0];
            } else {
                // Reset preview
                previewKode.textContent = '-';
                previewDeskripsi.textContent = '-';
                previewKategori.textContent = '-';
                previewTipe.textContent = '-';
                newCodePreview.textContent = '-';
            }
        });

        // Form validation before submit
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            const detailTextarea = document.getElementById('detail');
            let isValid = true;

            // Reset previous errors
            detailTextarea.classList.remove('is-invalid');
            
            // Remove existing error messages
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                if (!el.parentNode.querySelector('.is-invalid')) {
                    el.remove();
                }
            });

            // Validate detail text
            if (!detailTextarea.value.trim()) {
                detailTextarea.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Detail tindakan wajib diisi!</span>';
                detailTextarea.parentNode.appendChild(errorDiv);
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
        textarea.addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });
    </script>
@endsection