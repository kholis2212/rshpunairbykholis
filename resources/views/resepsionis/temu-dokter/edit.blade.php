{{-- views/resepsionis/temu-dokter/edit.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Edit Jadwal Temu Dokter - RSHP UNAIR')

@section('page-icon', 'pencil-square')
@section('page-title', 'Edit Jadwal Temu Dokter')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard-resepsionis') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.temu-dokter.index') }}">Temu Dokter</a></li>
    <li class="breadcrumb-item active">Edit Jadwal</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <!-- Current Data Card -->
            <div class="current-data-card mb-4">
                <div class="current-data-header">
                    <div class="current-data-icon">
                        <i class="bi bi-file-text-fill"></i>
                    </div>
                    <div class="current-data-text">
                        <h6>Data Saat Ini</h6>
                        <p>Informasi jadwal temu dokter yang sedang aktif</p>
                    </div>
                </div>
                <div class="current-data-body">
                    <div class="current-data-grid">
                        <div class="current-data-item">
                            <div class="current-data-label">
                                <i class="bi bi-123"></i>
                                <span>Nomor Antrian</span>
                            </div>
                            <div class="current-data-value">{{ $temuDokter->no_urut }}</div>
                        </div>
                        <div class="current-data-item">
                            <div class="current-data-label">
                                <i class="bi bi-person-fill"></i>
                                <span>Pemilik</span>
                            </div>
                            <div class="current-data-value">{{ $temuDokter->pet->pemilik->user->nama }}</div>
                        </div>
                        <div class="current-data-item">
                            <div class="current-data-label">
                                <i class="bi bi-heart-fill"></i>
                                <span>Hewan</span>
                            </div>
                            <div class="current-data-value">{{ $temuDokter->pet->nama }}</div>
                        </div>
                        <div class="current-data-item">
                            <div class="current-data-label">
                                <i class="bi bi-person-badge"></i>
                                <span>Dokter</span>
                            </div>
                            <div class="current-data-value">{{ $temuDokter->userDokter->nama }}</div>
                        </div>
                        <div class="current-data-item">
                            <div class="current-data-label">
                                <i class="bi bi-calendar-event-fill"></i>
                                <span>Waktu Daftar</span>
                            </div>
                            <div class="current-data-value">{{ $temuDokter->waktu_daftar->format('d M Y, H:i') }}</div>
                        </div>
                        <div class="current-data-item">
                            <div class="current-data-label">
                                <i class="bi bi-circle-fill"></i>
                                <span>Status</span>
                            </div>
                            <div class="current-data-value">
                                <span class="status-badge status-{{ $temuDokter->warna_status }}">
                                    {{ $temuDokter->status_lengkap }}
                                </span>
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
                    <p>Perubahan pada nomor antrian tidak dapat dilakukan. Hanya data pemilik, hewan, dokter, dan status yang dapat diperbarui. Pastikan perubahan tidak mengganggu urutan antrian yang sudah berjalan.</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Edit Jadwal Temu Dokter</h5>
                        <p>Perbarui data jadwal temu dokter sesuai kebutuhan</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('resepsionis.temu-dokter.update', $temuDokter->idreservasi_dokter) }}" method="POST" id="formEdit">
                        @csrf
                        @method('PUT')
                        
                        <!-- Section 1: Pilih Pemilik -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-person-badge-fill"></i>
                                </div>
                                <div class="section-text">
                                    <h6>Data Pemilik</h6>
                                    <p>Pilih pemilik hewan yang sudah terdaftar</p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="pemilik_search" class="form-label">
                                    <i class="bi bi-search me-2"></i>
                                    Cari Pemilik
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" 
                                           id="pemilik_search" 
                                           class="form-control"
                                           placeholder="Ketik nama pemilik untuk mencari..."
                                           autocomplete="off"
                                           value="{{ $temuDokter->pet->pemilik->user->nama }}" readonly>
                                    <div class="input-icon">
                                        <i class="bi bi-chevron-down"></i>
                                    </div>
                                </div>
                                
                                <div class="selected-pemilik mt-3">
                                    <div class="selected-item">
                                        <div class="selected-icon">
                                            <i class="bi bi-person-check-fill"></i>
                                        </div>
                                        <div class="selected-content">
                                            <h6>{{ $temuDokter->pet->pemilik->user->nama }}</h6>
                                            <p>{{ $temuDokter->pet->pemilik->user->email }} | {{ $temuDokter->pet->pemilik->no_wa ?? 'No WA belum diisi' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Pilih Hewan Peliharaan -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-heart-pulse-fill"></i>
                                </div>
                                <div class="section-text">
                                    <h6>Data Hewan Peliharaan</h6>
                                    <p>Pilih hewan peliharaan dari pemilik yang dipilih</p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="idpet" class="form-label">
                                    <i class="bi bi-paw-fill me-2"></i>
                                    Pilih Hewan Peliharaan
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <select name="idpet" id="idpet" class="form-control @error('idpet') is-invalid @enderror">
                                        <option value="">Pilih hewan peliharaan...</option>
                                        @foreach($pemilik as $owner)
                                            @foreach($owner->pets as $pet)
                                                @php
                                                    $petData = [
                                                        'idpet' => $pet->idpet,
                                                        'nama' => $pet->nama,
                                                        'jenis_hewan' => $pet->rasHewan->jenisHewan->nama_jenis_hewan,
                                                        'ras' => $pet->rasHewan->nama_ras,
                                                        'jenis_kelamin' => $pet->jenis_kelamin,
                                                        'tanggal_lahir' => $pet->tanggal_lahir
                                                    ];
                                                @endphp
                                                <option 
                                                    value="{{ $pet->idpet }}" 
                                                    {{ old('idpet', $temuDokter->idpet) == $pet->idpet ? 'selected' : '' }}
                                                    data-pet="{{ json_encode($petData) }}">
                                                    {{ $pet->nama }} - {{ $pet->rasHewan->jenisHewan->nama_jenis_hewan }} ({{ $pet->rasHewan->nama_ras }})
                                                </option>
                                            @endforeach
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
                                
                                <div class="pet-info mt-3" id="petInfo">
                                    <div class="pet-card">
                                        <div class="pet-icon">
                                            <i class="bi bi-heart-fill"></i>
                                        </div>
                                        <div class="pet-details">
                                            <h6 id="petNama">{{ $temuDokter->pet->nama }}</h6>
                                            <div class="pet-meta">
                                                <span class="pet-badge" id="petJenis">{{ $temuDokter->pet->rasHewan->jenisHewan->nama_jenis_hewan }}</span>
                                                <span class="pet-badge" id="petRas">{{ $temuDokter->pet->rasHewan->nama_ras }}</span>
                                                <span class="pet-badge" id="petGender">{{ $temuDokter->pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}</span>
                                                <span class="pet-badge" id="petAge">
                                                    @if($temuDokter->pet->tanggal_lahir)
                                                        {{ \Carbon\Carbon::parse($temuDokter->pet->tanggal_lahir)->age }} tahun
                                                    @else
                                                        Usia tidak diketahui
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Pilih Dokter -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-person-badge"></i>
                                </div>
                                <div class="section-text">
                                    <h6>Data Dokter</h6>
                                    <p>Pilih dokter yang akan memeriksa</p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="idrole_user" class="form-label">
                                    <i class="bi bi-stethoscope me-2"></i>
                                    Pilih Dokter
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <select name="idrole_user" id="idrole_user" class="form-control @error('idrole_user') is-invalid @enderror">
                                        <option value="">Pilih dokter...</option>
                                        @foreach($dokter as $d)
                                            <option value="{{ $d->idrole_user }}" 
                                                {{ old('idrole_user', $temuDokter->idrole_user) == $d->idrole_user ? 'selected' : '' }}>
                                                {{ $d->user->nama }} 
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-icon">
                                        <i class="bi bi-chevron-down"></i>
                                    </div>
                                </div>
                                @error('idrole_user')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                
                                <div class="doctor-info mt-3" id="doctorInfo">
                                    <div class="doctor-card">
                                        <div class="doctor-icon">
                                            <i class="bi bi-person-check-fill"></i>
                                        </div>
                                        <div class="doctor-details">
                                            <h6 id="doctorNama">{{ $temuDokter->userDokter->nama }}</h6>
                                            <p id="doctorEmail">Dokter Hewan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Status -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-gear-fill"></i>
                                </div>
                                <div class="section-text">
                                    <h6>Status Temu Dokter</h6>
                                    <p>Atur status kunjungan saat ini</p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="status" class="form-label">
                                    <i class="bi bi-circle-fill me-2"></i>
                                    Status
                                    <span class="required">*</span>
                                </label>
                                <div class="status-options">
                                    <div class="status-option">
                                        <input type="radio" name="status" id="status_A" value="A" 
                                               {{ old('status', $temuDokter->status) == 'A' ? 'checked' : '' }} class="status-radio">
                                        <label for="status_A" class="status-label status-aktif">
                                            <div class="status-indicator"></div>
                                            <div class="status-content">
                                                <div class="status-title">Aktif</div>
                                                <div class="status-description">Pasien sedang menunggu antrian</div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="status-option">
                                        <input type="radio" name="status" id="status_S" value="S" 
                                               {{ old('status', $temuDokter->status) == 'S' ? 'checked' : '' }} class="status-radio">
                                        <label for="status_S" class="status-label status-selesai">
                                            <div class="status-indicator"></div>
                                            <div class="status-content">
                                                <div class="status-title">Selesai</div>
                                                <div class="status-description">Pemeriksaan telah selesai</div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="status-option">
                                        <input type="radio" name="status" id="status_C" value="C" 
                                               {{ old('status', $temuDokter->status) == 'C' ? 'checked' : '' }} class="status-radio">
                                        <label for="status_C" class="status-label status-cancel">
                                            <div class="status-indicator"></div>
                                            <div class="status-content">
                                                <div class="status-title">Dibatalkan</div>
                                                <div class="status-description">Kunjungan dibatalkan</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback d-flex align-items-center gap-2" style="display: block !important;">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Comparison Section -->
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
                                            <label>Hewan:</label>
                                            <span>{{ $temuDokter->pet->nama }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <label>Dokter:</label>
                                            <span>{{ $temuDokter->userDokter->nama }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <label>Status:</label>
                                            <span class="status-badge status-{{ $temuDokter->warna_status }}">
                                                {{ $temuDokter->status_lengkap }}
                                            </span>
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
                                            <label>Hewan:</label>
                                            <span id="newPet">{{ $temuDokter->pet->nama }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <label>Dokter:</label>
                                            <span id="newDoctor">{{ $temuDokter->userDokter->nama }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <label>Status:</label>
                                            <span id="newStatus" class="status-badge status-{{ $temuDokter->warna_status }}">
                                                {{ $temuDokter->status_lengkap }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Update Jadwal</span>
                            </button>
                            <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-secondary btn-cancel">
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
        /* Current Data Card */
        .current-data-card {
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

        .current-data-header {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .current-data-icon {
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

        .current-data-text h6 {
            margin: 0 0 3px 0;
            font-size: 1rem;
            font-weight: 700;
        }

        .current-data-text p {
            margin: 0;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .current-data-body {
            padding: 25px;
        }

        .current-data-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .current-data-item {
            background: white;
            border: 2px solid #0077b6;
            border-radius: 10px;
            padding: 15px;
        }

        .current-data-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-gray);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .current-data-label i {
            color: #0077b6;
            font-size: 1rem;
        }

        .current-data-value {
            font-size: 1rem;
            font-weight: 700;
            color: #023e8a;
            word-break: break-word;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-success { background: #d1fae5; color: #065f46; }
        .status-primary { background: #dbeafe; color: #1e40af; }
        .status-danger { background: #fecaca; color: #991b1b; }

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
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .section-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #ffa500, #ff8c00);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .section-text h6 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #023e8a;
            margin: 0 0 5px 0;
        }

        .section-text p {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin: 0;
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

        .form-control:read-only {
            background: #f5f5f5;
            color: var(--text-gray);
            cursor: not-allowed;
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

        /* Status Options */
        .status-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .status-option {
            position: relative;
        }

        .status-radio {
            position: absolute;
            opacity: 0;
        }

        .status-label {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8fbff;
        }

        .status-radio:checked + .status-label {
            border-color: #ffa500;
            background: white;
            box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.1);
        }

        .status-aktif .status-indicator { background: #06d6a0; }
        .status-selesai .status-indicator { background: #0077b6; }
        .status-cancel .status-indicator { background: #ef476f; }

        .status-indicator {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .status-content {
            flex: 1;
        }

        .status-title {
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 3px;
        }

        .status-description {
            font-size: 0.85rem;
            color: var(--text-gray);
        }

        /* Selected Items */
        .selected-pemilik, .pet-info, .doctor-info {
            animation: slideDown 0.3s ease;
        }

        .selected-item, .pet-card, .doctor-card {
            background: #f0f9ff;
            border: 2px solid #0077b6;
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .selected-icon, .pet-icon, .doctor-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .selected-content h6, .pet-details h6, .doctor-details h6 {
            margin: 0 0 5px 0;
            font-size: 1rem;
            font-weight: 700;
            color: #023e8a;
        }

        .selected-content p, .doctor-details p {
            margin: 0;
            font-size: 0.85rem;
            color: var(--text-gray);
        }

        .pet-meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pet-badge {
            background: rgba(0, 119, 182, 0.1);
            color: #0077b6;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Comparison Section */
        .comparison-section {
            background: #f8fbff;
            border: 2px dashed #0077b6;
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
        }

        .comparison-header {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 20px;
        }

        .comparison-header i {
            color: #0077b6;
            font-size: 1.3rem;
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
            font-size: 0.9rem;
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            gap: 10px;
        }

        .comparison-field {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .comparison-field:last-child {
            border-bottom: none;
        }

        .comparison-field label {
            font-weight: 600;
            color: var(--text-gray);
            font-size: 0.85rem;
        }

        .comparison-field span {
            font-weight: 700;
            color: #023e8a;
            text-align: right;
        }

        .comparison-arrow {
            color: #0077b6;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 40px;
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
            .current-data-header,
            .warning-card,
            .section-header {
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

            .current-data-grid {
                grid-template-columns: 1fr;
            }

            .comparison-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .comparison-arrow {
                transform: rotate(90deg);
                margin: 0;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit, .btn-cancel {
                width: 100%;
            }

            .pet-meta {
                justify-content: center;
            }

            .status-options {
                gap: 8px;
            }

            .status-label {
                padding: 12px 15px;
            }
        }
    </style>
@endsection

@section('extra-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeEventListeners();
            updateComparison();
        });

        function initializeEventListeners() {
            // Pet selection change
            document.getElementById('idpet').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value && selectedOption.dataset.pet) {
                    const pet = JSON.parse(selectedOption.dataset.pet);
                    updatePetInfo(pet);
                }
                updateComparison();
            });

            // Doctor selection change
            document.getElementById('idrole_user').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    updateDoctorInfo(selectedOption.textContent.trim());
                }
                updateComparison();
            });

            // Status change
            document.querySelectorAll('.status-radio').forEach(radio => {
                radio.addEventListener('change', function() {
                    updateComparison();
                });
            });
        }

        function updatePetInfo(pet) {
            document.getElementById('petNama').textContent = pet.nama;
            document.getElementById('petJenis').textContent = pet.jenis_hewan;
            document.getElementById('petRas').textContent = pet.ras;
            document.getElementById('petGender').textContent = pet.jenis_kelamin === 'J' ? 'Jantan' : 'Betina';
            
            if (pet.tanggal_lahir) {
                const age = calculateAge(pet.tanggal_lahir);
                document.getElementById('petAge').textContent = age;
            } else {
                document.getElementById('petAge').textContent = 'Usia tidak diketahui';
            }
        }

        function updateDoctorInfo(doctorName) {
            document.getElementById('doctorNama').textContent = doctorName;
        }

        function calculateAge(tanggalLahir) {
            const birthDate = new Date(tanggalLahir);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            return age + ' tahun';
        }

        function updateComparison() {
            // Update pet in comparison
            const petSelect = document.getElementById('idpet');
            const selectedPetOption = petSelect.options[petSelect.selectedIndex];
            if (selectedPetOption.value) {
                document.getElementById('newPet').textContent = selectedPetOption.textContent.split(' - ')[0];
            }

            // Update doctor in comparison
            const doctorSelect = document.getElementById('idrole_user');
            const selectedDoctorOption = doctorSelect.options[doctorSelect.selectedIndex];
            if (selectedDoctorOption.value) {
                document.getElementById('newDoctor').textContent = selectedDoctorOption.textContent.trim();
            }

            // Update status in comparison
            const selectedStatus = document.querySelector('input[name="status"]:checked');
            if (selectedStatus) {
                const statusValue = selectedStatus.value;
                const statusText = getStatusText(statusValue);
                const statusClass = getStatusClass(statusValue);
                
                const statusElement = document.getElementById('newStatus');
                statusElement.textContent = statusText;
                statusElement.className = `status-badge ${statusClass}`;
            }
        }

        function getStatusText(status) {
            switch(status) {
                case 'A': return 'Aktif';
                case 'S': return 'Selesai';
                case 'C': return 'Dibatalkan';
                default: return 'Tidak Diketahui';
            }
        }

        function getStatusClass(status) {
            switch(status) {
                case 'A': return 'status-success';
                case 'S': return 'status-primary';
                case 'C': return 'status-danger';
                default: return 'status-secondary';
            }
        }

        // Form validation
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            const petSelect = document.getElementById('idpet');
            const doctorSelect = document.getElementById('idrole_user');
            const statusSelected = document.querySelector('input[name="status"]:checked');
            
            let isValid = true;
            let errorMessage = '';

            if (!petSelect.value) {
                isValid = false;
                errorMessage = 'Pilih hewan peliharaan wajib diisi!';
            } else if (!doctorSelect.value) {
                isValid = false;
                errorMessage = 'Pilih dokter wajib diisi!';
            } else if (!statusSelected) {
                isValid = false;
                errorMessage = 'Pilih status wajib diisi!';
            }

            if (!isValid) {
                e.preventDefault();
                showValidationError(errorMessage);
            }
        });

        function showValidationError(message) {
            // Create or show error notification
            const existingAlert = document.querySelector('.alert-danger');
            if (existingAlert) {
                existingAlert.remove();
            }

            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger alert-dismissible fade show';
            alertDiv.innerHTML = `
                <div class="alert-content">
                    <div class="alert-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div class="alert-text">
                        <strong>Error!</strong>
                        <p>${message}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.querySelector('.content-wrapper').insertBefore(alertDiv, document.querySelector('.content-wrapper').firstChild);
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
@endsection