@extends('layouts.lte.main')

@section('title', 'Edit Pemilik - RSHP UNAIR')

@section('page-icon', 'person-check-fill')
@section('page-title', 'Edit Data Pemilik')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard-resepsionis') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.registrasi.pemilik.index') }}">Data Pemilik</a></li>
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
                        <p>Informasi pemilik yang sedang aktif dalam sistem</p>
                    </div>
                </div>
                <div class="current-value-body">
                    <div class="current-value-grid">
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-person-fill"></i>
                                <span>Nama</span>
                            </div>
                            <div class="current-value-display">
                                {{ $pemilik->user->nama }}
                            </div>
                        </div>
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-envelope-fill"></i>
                                <span>Email</span>
                            </div>
                            <div class="current-value-display">
                                {{ $pemilik->user->email }}
                            </div>
                        </div>
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-whatsapp"></i>
                                <span>No. WhatsApp</span>
                            </div>
                            <div class="current-value-display">
                                {{ $pemilik->no_wa }}
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
                    <p>Pastikan data yang diubah sudah benar. Perubahan email akan mempengaruhi proses login pemilik</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Edit Pemilik</h5>
                        <p>Perbarui data pemilik dengan informasi yang benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('resepsionis.registrasi.pemilik.update', $pemilik->idpemilik) }}" method="POST" id="formEdit">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-person-fill"></i>
                                <h6>Data Pribadi</h6>
                            </div>
                            
                            <div class="form-group">
                                <label for="nama" class="form-label">
                                    <i class="bi bi-person me-2"></i>
                                    Nama Lengkap
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" 
                                           id="nama" 
                                           name="nama" 
                                           class="form-control @error('nama') is-invalid @enderror" 
                                           value="{{ old('nama', $pemilik->user->nama) }}" 
                                           placeholder="Masukkan nama lengkap pemilik"
                                           autofocus>
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

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope me-2"></i>
                                        Email
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="email" 
                                               id="email" 
                                               name="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email', $pemilik->user->email) }}" 
                                               placeholder="contoh@email.com">
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

                                <div class="form-group col-md-6">
                                    <label for="no_wa" class="form-label">
                                        <i class="bi bi-whatsapp me-2"></i>
                                        No. WhatsApp
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="text" 
                                               id="no_wa" 
                                               name="no_wa" 
                                               class="form-control @error('no_wa') is-invalid @enderror" 
                                               value="{{ old('no_wa', $pemilik->no_wa) }}" 
                                               placeholder="6281234567890">
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
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-geo-alt-fill"></i>
                                <h6>Data Alamat</h6>
                            </div>

                            <div class="form-group">
                                <label for="alamat" class="form-label">
                                    <i class="bi bi-house-door me-2"></i>
                                    Alamat Lengkap
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <textarea id="alamat" 
                                              name="alamat" 
                                              class="form-control @error('alamat') is-invalid @enderror" 
                                              rows="4"
                                              placeholder="Tuliskan alamat lengkap...">{{ old('alamat', $pemilik->alamat) }}</textarea>
                                    <div class="input-icon textarea-icon">
                                        <i class="bi bi-text-paragraph"></i>
                                    </div>
                                </div>
                                @error('alamat')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="char-counter">
                                    <span id="alamatCount">{{ strlen(old('alamat', $pemilik->alamat)) }}</span>/100 karakter
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
                                            <span class="field-value">{{ $pemilik->user->nama }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Email:</span>
                                            <span class="field-value">{{ $pemilik->user->email }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">No. WA:</span>
                                            <span class="field-value">{{ $pemilik->no_wa }}</span>
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
                                            <span class="field-value" id="newNama">{{ old('nama', $pemilik->user->nama) }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Email:</span>
                                            <span class="field-value" id="newEmail">{{ old('email', $pemilik->user->email) }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">No. WA:</span>
                                            <span class="field-value" id="newWa">{{ old('no_wa', $pemilik->no_wa) }}</span>
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
                            <a href="{{ route('resepsionis.registrasi.pemilik.index') }}" class="btn btn-secondary btn-cancel">
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

        // Character counter for alamat
        const alamatTextarea = document.getElementById('alamat');
        const alamatCount = document.getElementById('alamatCount');

        alamatTextarea.addEventListener('input', function() {
            const count = this.value.length;
            alamatCount.textContent = count;
            
            if (count > 100) {
                alamatCount.style.color = '#ef476f';
            } else if (count > 80) {
                alamatCount.style.color = '#ffa500';
            } else {
                alamatCount.style.color = '#0077b6';
            }
        });

        // Live preview of new values
        document.getElementById('nama').addEventListener('input', function() {
            document.getElementById('newNama').textContent = this.value || '{{ $pemilik->user->nama }}';
        });

        document.getElementById('email').addEventListener('input', function() {
            document.getElementById('newEmail').textContent = this.value || '{{ $pemilik->user->email }}';
        });

        document.getElementById('no_wa').addEventListener('input', function() {
            document.getElementById('newWa').textContent = this.value || '{{ $pemilik->no_wa }}';
        });

        // Form validation before submit
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            const nama = document.getElementById('nama');
            const email = document.getElementById('email');
            const noWa = document.getElementById('no_wa');
            const alamat = document.getElementById('alamat');
            let isValid = true;

            // Reset previous errors
            [nama, email, noWa, alamat].forEach(field => {
                field.classList.remove('is-invalid');
            });
            
            // Remove existing error messages
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                if (!el.parentNode.querySelector('.is-invalid')) {
                    el.remove();
                }
            });

            // Validate nama
            if (!nama.value.trim()) {
                nama.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Nama wajib diisi!</span>';
                nama.parentNode.appendChild(errorDiv);
                isValid = false;
            }

            // Validate email
            if (!email.value.trim()) {
                email.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Email wajib diisi!</span>';
                email.parentNode.appendChild(errorDiv);
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                email.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Format email tidak valid!</span>';
                email.parentNode.appendChild(errorDiv);
                isValid = false;
            }

            // Validate no WA
            if (!noWa.value.trim()) {
                noWa.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Nomor WhatsApp wajib diisi!</span>';
                noWa.parentNode.appendChild(errorDiv);
                isValid = false;
            }

            // Validate alamat
            if (!alamat.value.trim()) {
                alamat.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Alamat wajib diisi!</span>';
                alamat.parentNode.appendChild(errorDiv);
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

        // Email validation function
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Remove error class on input
        document.getElementById('nama').addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

        document.getElementById('email').addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

        document.getElementById('no_wa').addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });

        document.getElementById('alamat').addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.invalid-feedback');
            if (error) error.remove();
        });
    </script>
@endsection