@extends('layouts.lte.main')

@section('title', 'Tambah Rekam Medis - RSHP UNAIR')

@section('page-icon', 'plus-circle-fill')
@section('page-title', 'Tambah Rekam Medis Baru')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard-perawat') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.rekam-medis.index') }}">Daftar Rekam Medis</a></li>
    <li class="breadcrumb-item active">Tambah Rekam Medis</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Info Card -->
            <div class="info-card mb-4">
                <div class="info-card-icon">
                    <i class="bi bi-lightbulb-fill"></i>
                </div>
                <div class="info-card-content">
                    <h6>Informasi Rekam Medis Baru</h6>
                    <p>Isi formulir di bawah dengan lengkap dan benar. Pastikan data pasien dan dokter pemeriksa sudah sesuai sebelum menyimpan</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-file-earmark-plus-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Tambah Rekam Medis</h5>
                        <p>Isi data rekam medis baru untuk pasien</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('perawat.rekam-medis.store') }}" method="POST" id="formCreate">
                        @csrf
                        
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
                                                        {{ old('idpet') == $pet->idpet ? 'selected' : '' }}
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
                                    <div class="form-hint">
                                        <i class="bi bi-info-circle-fill"></i>
                                        <span>Pilih pasien dari daftar hewan yang terdaftar</span>
                                    </div>
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
                                                        {{ old('dokter_pemeriksa') == $dokter->iduser ? 'selected' : '' }}>
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
                                    <div class="form-hint">
                                        <i class="bi bi-info-circle-fill"></i>
                                        <span>Pilih dokter yang akan memeriksa pasien</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Patient Preview -->
                            <div class="patient-preview" id="patientPreview" style="display: none;">
                                <div class="preview-header">
                                    <h6>Detail Pasien Terpilih</h6>
                                </div>
                                <div class="preview-content">
                                    <div class="preview-grid">
                                        <div class="preview-item">
                                            <span class="preview-label">Nama Hewan</span>
                                            <span class="preview-value" id="previewNama">-</span>
                                        </div>
                                        <div class="preview-item">
                                            <span class="preview-label">Jenis/Ras</span>
                                            <span class="preview-value" id="previewJenisRas">-</span>
                                        </div>
                                        <div class="preview-item">
                                            <span class="preview-label">Pemilik</span>
                                            <span class="preview-value" id="previewPemilik">-</span>
                                        </div>
                                    </div>
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
                                              placeholder="Jelaskan keluhan utama dan riwayat penyakit pasien...">{{ old('anamnesa') }}</textarea>
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
                                <div class="form-hint">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>Deskripsi keluhan dan riwayat penyakit dari pemilik</span>
                                </div>
                                <div class="char-counter">
                                    <span id="anamnesaCount">0</span>/1000 karakter
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
                                              placeholder="Jelaskan temuan klinis dari pemeriksaan fisik...">{{ old('temuan_klinis') }}</textarea>
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
                                <div class="form-hint">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>Hasil pemeriksaan fisik dan temuan klinis lainnya</span>
                                </div>
                                <div class="char-counter">
                                    <span id="temuanCount">0</span>/1000 karakter
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
                                              placeholder="Tuliskan diagnosa berdasarkan anamnesa dan temuan klinis...">{{ old('diagnosa') }}</textarea>
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
                                <div class="form-hint">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>Diagnosa utama dan banding berdasarkan pemeriksaan</span>
                                </div>
                                <div class="char-counter">
                                    <span id="diagnosaCount">0</span>/1000 karakter
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-save-fill"></i>
                                <span>Simpan Rekam Medis</span>
                            </button>
                            <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary btn-cancel">
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

        /* Patient Preview */
        .patient-preview {
            background: linear-gradient(135deg, #f8fbff, #e3f2fd);
            border: 2px solid #0077b6;
            border-radius: 15px;
            margin-top: 20px;
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

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
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
            background: linear-gradient(135deg, #0077b6, #0096c7);
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
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.4);
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

            .form-row {
                grid-template-columns: 1fr;
            }

            .preview-grid {
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
        // Auto focus on first input
        document.getElementById('idpet').focus();

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
            });
        }

        setupCharacterCounter(anamnesaTextarea, anamnesaCount);
        setupCharacterCounter(temuanTextarea, temuanCount);
        setupCharacterCounter(diagnosaTextarea, diagnosaCount);

        // Patient preview functionality
        const patientSelect = document.getElementById('idpet');
        const patientPreview = document.getElementById('patientPreview');
        const previewNama = document.getElementById('previewNama');
        const previewJenisRas = document.getElementById('previewJenisRas');
        const previewPemilik = document.getElementById('previewPemilik');

        patientSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (this.value) {
                // Show preview
                patientPreview.style.display = 'block';
                
                // Extract data from option
                const optionText = selectedOption.textContent;
                const parts = optionText.split(' - ');
                
                previewNama.textContent = parts[0];
                previewJenisRas.textContent = selectedOption.getAttribute('data-jenis') + ' / ' + selectedOption.getAttribute('data-ras');
                previewPemilik.textContent = selectedOption.getAttribute('data-pemilik');
            } else {
                // Hide preview
                patientPreview.style.display = 'none';
            }
        });

        // Trigger change event on page load if there's a selected value
        if (patientSelect.value) {
            patientSelect.dispatchEvent(new Event('change'));
        }

        // Form validation before submit
        document.getElementById('formCreate').addEventListener('submit', function(e) {
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