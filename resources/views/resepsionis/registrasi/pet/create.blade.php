@extends('layouts.lte.main')

@section('title', 'Registrasi Hewan - RSHP UNAIR')

@section('page-icon', 'plus-circle-fill')
@section('page-title', 'registrasi Hewan Baru')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard-resepsionis') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.registrasi.pet.index') }}">Registrasi Hewan</a></li>
    <li class="breadcrumb-item active">Registrasi Hewan Baru</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Info Card -->
            <div class="info-card mb-4">
                <div class="info-card-icon">
                    <i class="bi bi-lightbulb-fill"></i>
                </div>
                <div class="info-card-content">
                    <h6>Informasi Registrasi Hewan</h6>
                    <p>Isi formulir di bawah dengan lengkap dan benar. Pastikan data pemilik sudah terdaftar sebelum menambahkan hewan baru</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-file-earmark-plus-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Registrasi Hewan</h5>
                        <p>Isi data hewan peliharaan baru dengan informasi yang lengkap</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('resepsionis.registrasi.pet.store') }}" method="POST" id="formCreate">
                        @csrf
                        
                        <div class="form-section">
                            <div class="form-section-header">
                                <i class="bi bi-paw-fill"></i>
                                <span>Data Dasar Hewan</span>
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
                                           value="{{ old('nama') }}" 
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
                                <div class="form-hint">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>Masukkan nama panggilan hewan yang mudah dikenali</span>
                                </div>
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
                                                        {{ old('idpemilik') == $pem->idpemilik ? 'selected' : '' }}>
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
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Jantan</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Betina</option>
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
                            <div class="form-section-header">
                                <i class="bi bi-tags-fill"></i>
                                <span>Klasifikasi Hewan</span>
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
                                                        {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>
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
                                                required
                                                disabled>
                                            <option value="">Pilih Jenis Hewan Terlebih Dahulu</option>
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
                            <div class="form-section-header">
                                <i class="bi bi-palette-fill"></i>
                                <span>Informasi Tambahan</span>
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
                                               value="{{ old('tanggal_lahir') }}">
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
                                    <div class="form-hint">
                                        <i class="bi bi-info-circle-fill"></i>
                                        <span>Perkiraan tanggal lahir jika tidak diketahui pasti</span>
                                    </div>
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
                                               value="{{ old('warna_tanda') }}" 
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
                                    <div class="form-hint">
                                        <i class="bi bi-info-circle-fill"></i>
                                        <span>Deskripsi warna bulu atau tanda khas untuk identifikasi</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pet Preview -->
                        <div class="pet-preview" id="petPreview" style="display: none;">
                            <div class="preview-header">
                                <h6>Preview Data Hewan</h6>
                            </div>
                            <div class="preview-content">
                                <div class="preview-grid">
                                    <div class="preview-item">
                                        <span class="preview-label">Nama</span>
                                        <span class="preview-value" id="previewNama">-</span>
                                    </div>
                                    <div class="preview-item">
                                        <span class="preview-label">Jenis/Ras</span>
                                        <span class="preview-value" id="previewJenisRas">-</span>
                                    </div>
                                    <div class="preview-item">
                                        <span class="preview-label">Jenis Kelamin</span>
                                        <span class="preview-value" id="previewGender">-</span>
                                    </div>
                                    <div class="preview-item">
                                        <span class="preview-label">Tanggal Lahir</span>
                                        <span class="preview-value" id="previewBirth">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-save-fill"></i>
                                <span>Simpan Data</span>
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
        /* Form Section */
        .form-section {
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #f8fbff;
        }

        .form-section:last-of-type {
            border-bottom: none;
            margin-bottom: 30px;
        }

        .form-section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 25px;
            padding: 15px 20px;
            background: linear-gradient(135deg, rgba(0, 119, 182, 0.05), rgba(0, 150, 199, 0.05));
            border-radius: 12px;
            border-left: 4px solid #0077b6;
        }

        .form-section-header i {
            color: #0077b6;
            font-size: 1.2rem;
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
            margin-bottom: 25px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -10px;
            margin-left: -10px;
        }

        .form-group.col-md-6 {
            padding-right: 10px;
            padding-left: 10px;
            flex: 0 0 50%;
            max-width: 50%;
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
            width: 100%;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
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

        textarea + .input-icon {
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

        /* Pet Preview */
        .pet-preview {
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
            grid-template-columns: repeat(2, 1fr);
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

            .form-section-header {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }

            .form-group.col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
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
            }
        }
    </style>
@endsection

@section('extra-js')
    <script>
        // Auto focus on first input
        document.getElementById('nama').focus();

        // Dynamic ras hewan loading
        document.getElementById('idjenis_hewan').addEventListener('change', function() {
            const jenisHewanId = this.value;
            const rasSelect = document.getElementById('idras_hewan');
            
            if (jenisHewanId) {
                // Enable ras select
                rasSelect.disabled = false;
                
                // Clear existing options
                rasSelect.innerHTML = '<option value="">Memuat ras...</option>';
                
                // Fetch ras data
                fetch(`/resepsionis/registrasi/pet/get-ras/${jenisHewanId}`)
                    .then(response => response.json())
                    .then(data => {
                        rasSelect.innerHTML = '<option value="">Pilih Ras</option>';
                        data.forEach(ras => {
                            const option = document.createElement('option');
                            option.value = ras.idras_hewan;
                            option.textContent = ras.nama_ras;
                            rasSelect.appendChild(option);
                        });
                        
                        // Set selected value if exists in old input
                        const oldRas = '{{ old('idras_hewan') }}';
                        if (oldRas) {
                            rasSelect.value = oldRas;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        rasSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                    });
            } else {
                rasSelect.disabled = true;
                rasSelect.innerHTML = '<option value="">Pilih Jenis Hewan Terlebih Dahulu</option>';
            }
        });

        // Trigger change event on page load if there's a selected jenis
        const selectedJenis = document.getElementById('idjenis_hewan').value;
        if (selectedJenis) {
            document.getElementById('idjenis_hewan').dispatchEvent(new Event('change'));
        }

        // Pet preview functionality
        function updatePetPreview() {
            const nama = document.getElementById('nama').value;
            const jenisSelect = document.getElementById('idjenis_hewan');
            const rasSelect = document.getElementById('idras_hewan');
            const genderSelect = document.getElementById('jenis_kelamin');
            const birthDate = document.getElementById('tanggal_lahir').value;
            
            const preview = document.getElementById('petPreview');
            
            if (nama || jenisSelect.value || rasSelect.value || genderSelect.value || birthDate) {
                preview.style.display = 'block';
                
                // Update preview values
                document.getElementById('previewNama').textContent = nama || '-';
                
                const jenisText = jenisSelect.options[jenisSelect.selectedIndex]?.text || '-';
                const rasText = rasSelect.options[rasSelect.selectedIndex]?.text || '-';
                document.getElementById('previewJenisRas').textContent = `${jenisText} / ${rasText}`;
                
                document.getElementById('previewGender').textContent = 
                    genderSelect.value ? (genderSelect.value === 'L' ? 'Jantan' : 'Betina') : '-';
                
                document.getElementById('previewBirth').textContent = 
                    birthDate ? new Date(birthDate).toLocaleDateString('id-ID') : '-';
            } else {
                preview.style.display = 'none';
            }
        }

        // Add event listeners for preview
        document.getElementById('nama').addEventListener('input', updatePetPreview);
        document.getElementById('idjenis_hewan').addEventListener('change', updatePetPreview);
        document.getElementById('idras_hewan').addEventListener('change', updatePetPreview);
        document.getElementById('jenis_kelamin').addEventListener('change', updatePetPreview);
        document.getElementById('tanggal_lahir').addEventListener('change', updatePetPreview);

        // Form validation before submit
        document.getElementById('formCreate').addEventListener('submit', function(e) {
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