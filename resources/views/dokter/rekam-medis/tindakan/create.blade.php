@extends('layouts.lte.main')

@section('title', 'Tambah Tindakan - RSHP UNAIR')

@section('page-icon', 'plus-circle-fill')
@section('page-title', 'Tambah Tindakan & Terapi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard-dokter') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dokter.rekam-medis.index') }}">Daftar Rekam Medis</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dokter.rekam-medis.show', $rekamMedis->idrekam_medis) }}">Detail Rekam Medis</a></li>
    <li class="breadcrumb-item active">Tambah Tindakan</li>
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

            <!-- Info Card -->
            <div class="info-card mb-4">
                <div class="info-card-icon">
                    <i class="bi bi-lightbulb-fill"></i>
                </div>
                <div class="info-card-content">
                    <h6>Informasi Tindakan & Terapi</h6>
                    <p>Pilih kode tindakan atau terapi yang sesuai dengan penanganan medis yang diberikan kepada pasien. Pastikan detail tindakan diisi dengan lengkap dan jelas</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-file-earmark-plus-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Tambah Tindakan & Terapi</h5>
                        <p>Isi formulir di bawah dengan lengkap dan benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('dokter.rekam-medis.tindakan.store', $rekamMedis->idrekam_medis) }}" method="POST" id="formCreate">
                        @csrf
                        
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
                                                {{ old('idkode_tindakan_terapi') == $kode->idkode_tindakan_terapi ? 'selected' : '' }}
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
                        <div class="code-preview" id="codePreview" style="display: none;">
                            <div class="preview-header">
                                <h6>Detail Tindakan Terpilih</h6>
                            </div>
                            <div class="preview-content">
                                <div class="preview-row">
                                    <div class="preview-item">
                                        <span class="preview-label">Kode</span>
                                        <span class="preview-value" id="previewKode">-</span>
                                    </div>
                                    <div class="preview-item">
                                        <span class="preview-label">Kategori</span>
                                        <span class="preview-value" id="previewKategori">-</span>
                                    </div>
                                    <div class="preview-item">
                                        <span class="preview-label">Tipe</span>
                                        <span class="preview-value" id="previewTipe">-</span>
                                    </div>
                                </div>
                                <div class="preview-description">
                                    <span class="preview-label">Deskripsi</span>
                                    <p class="preview-value" id="previewDeskripsi">-</p>
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
                                          required>{{ old('detail') }}</textarea>
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
                                <span id="charCount">0</span>/1000 karakter
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-save-fill"></i>
                                <span>Simpan Tindakan</span>
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
        }

        /* Patient Summary Card */
        .patient-summary-card {
            background: var(--white);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 30px rgba(0, 119, 182, 0.12);
            border: 2px solid rgba(0, 119, 182, 0.1);
        }

        .patient-header {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .patient-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            flex-shrink: 0;
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
        }

        .patient-details h4 {
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 5px;
            font-size: 1.4rem;
        }

        .patient-details p {
            color: var(--text-gray);
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .patient-meta {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--light-bg);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            color: var(--text-gray);
            font-weight: 600;
        }

        .meta-item i {
            color: var(--primary);
            font-size: 0.8rem;
        }

        /* Info Card */
        .info-card {
            background: linear-gradient(135deg, rgba(0, 119, 182, 0.05), rgba(0, 150, 199, 0.05));
            border: 2px solid rgba(0, 119, 182, 0.15);
            border-radius: 15px;
            padding: 20px 25px;
            display: flex;
            align-items: start;
            gap: 20px;
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

        .info-card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .info-card-content h6 {
            font-size: 1rem;
            font-weight: 700;
            color: #023e8a;
            margin: 0 0 5px 0;
        }

        .info-card-content p {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin: 0;
            line-height: 1.6;
        }

        /* Form Card */
        .form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 119, 182, 0.12);
            overflow: hidden;
            animation: slideUp 0.6s ease;
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
            border-color: #0077b6;
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 119, 182, 0.1);
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
            top: 25px;
            transform: none;
        }

        .form-control.is-invalid {
            border-color: #ef476f;
            background: #fff5f5;
            padding-right: 50px;
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

        /* Code Preview */
        .code-preview {
            background: linear-gradient(135deg, #f8fbff, #e3f2fd);
            border: 2px solid #0077b6;
            border-radius: 15px;
            margin-bottom: 25px;
            overflow: hidden;
            animation: slideDown 0.5s ease;
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
            background: linear-gradient(135deg, #0077b6, #0096c7);
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
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
            flex: 1;
            justify-content: center;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.4);
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

            .info-card {
                flex-direction: column;
                text-align: center;
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
        // Auto focus on first input
        document.getElementById('idkode_tindakan_terapi').focus();

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
        });

        // Code preview functionality
        const codeSelect = document.getElementById('idkode_tindakan_terapi');
        const codePreview = document.getElementById('codePreview');
        const previewKode = document.getElementById('previewKode');
        const previewKategori = document.getElementById('previewKategori');
        const previewTipe = document.getElementById('previewTipe');
        const previewDeskripsi = document.getElementById('previewDeskripsi');

        codeSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (this.value) {
                // Show preview
                codePreview.style.display = 'block';
                
                // Extract data from option
                const optionText = selectedOption.textContent;
                const parts = optionText.split(' - ');
                
                previewKode.textContent = parts[0];
                previewDeskripsi.textContent = parts[1] || '-';
                previewKategori.textContent = selectedOption.getAttribute('data-kategori') || '-';
                previewTipe.textContent = selectedOption.getAttribute('data-tipe') || '-';
            } else {
                // Hide preview
                codePreview.style.display = 'none';
            }
        });

        // Trigger change event on page load if there's a selected value
        if (codeSelect.value) {
            codeSelect.dispatchEvent(new Event('change'));
        }

        // Form validation before submit
        document.getElementById('formCreate').addEventListener('submit', function(e) {
            const codeSelect = document.getElementById('idkode_tindakan_terapi');
            const detailTextarea = document.getElementById('detail');
            let isValid = true;

            // Reset previous errors
            codeSelect.classList.remove('is-invalid');
            detailTextarea.classList.remove('is-invalid');
            
            // Remove existing error messages
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                if (!el.parentNode.querySelector('.is-invalid')) {
                    el.remove();
                }
            });

            // Validate code selection
            if (!codeSelect.value) {
                codeSelect.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Pilih kode tindakan/terapi!</span>';
                codeSelect.parentNode.appendChild(errorDiv);
                isValid = false;
            }

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
        codeSelect.addEventListener('change', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

        textarea.addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });
    </script>
@endsection