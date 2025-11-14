{{-- views/admin/role-user/create.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Tambah Role User - RSHP UNAIR')

@section('page-icon', 'person-plus-fill')
@section('page-title', 'Tambah Role User')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.role-user.index') }}">Manajemen Role User</a></li>
    <li class="breadcrumb-item active">Tambah Data</li>
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
                    <h6>Informasi</h6>
                    <p>Pilih user dan role yang ingin diberikan. User dapat memiliki lebih dari satu role untuk akses ke berbagai fitur sistem</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Tambah Role User</h5>
                        <p>Isi formulir di bawah dengan lengkap dan benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.role-user.store') }}" method="POST" id="formCreate">
                        @csrf
                        
                        <div class="form-group">
                            <label for="iduser" class="form-label">
                                <i class="bi bi-person-fill me-2"></i>
                                Pilih User
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <select id="iduser" 
                                        name="iduser" 
                                        class="form-control @error('iduser') is-invalid @enderror" 
                                        onchange="loadUserRoles()"
                                        autofocus>
                                    <option value="">-- Pilih User --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->iduser }}" 
                                                data-roles="{{ json_encode($userRoles[$user->iduser] ?? []) }}"
                                                {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                                            {{ $user->nama }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-icon">
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                            @error('iduser')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Info Role yang Sudah Dimiliki -->
                        <div id="existingRolesInfo" class="info-existing-roles" style="display: none;">
                            <div class="info-existing-header">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Role yang Sudah Dimiliki User:</span>
                            </div>
                            <div id="existingRolesList" class="info-existing-content"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-shield-check me-2"></i>
                                Pilih Role
                                <span class="required">*</span>
                            </label>
                            <div class="role-section">
                                <div class="role-grid" id="roleGrid">
                                    @foreach($roles as $role)
                                    <div class="role-item" data-role-id="{{ $role->idrole }}">
                                        <input type="checkbox" 
                                               id="role_{{ $role->idrole }}" 
                                               name="roles[]" 
                                               value="{{ $role->idrole }}"
                                               {{ is_array(old('roles')) && in_array($role->idrole, old('roles')) ? 'checked' : '' }}
                                               class="role-checkbox">
                                        <label for="role_{{ $role->idrole }}" class="role-label">
                                            <div class="role-icon">
                                                <i class="bi bi-shield-check"></i>
                                            </div>
                                            <div class="role-text">
                                                <span class="role-name">{{ $role->nama_role }}</span>
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('roles')
                                <div class="invalid-feedback d-flex align-items-center gap-2" style="display: block !important;">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Pilih minimal 1 role untuk user. Role yang sudah dimiliki akan dinonaktifkan</span>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-save-fill"></i>
                                <span>Simpan Role</span>
                            </button>
                            <a href="{{ route('admin.role-user.index') }}" class="btn btn-secondary btn-cancel">
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
        /* Info Existing Roles */
        .info-existing-roles {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 2px solid #ffc107;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            animation: slideDown 0.4s ease;
        }

        .info-existing-header {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #856404;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .info-existing-content {
            color: #856404;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* Role Section */
        .role-section {
            background: #f8fbff;
            border: 2px solid #e8e8e8;
            border-radius: 15px;
            padding: 25px;
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .role-item {
            position: relative;
        }

        .role-checkbox {
            display: none;
        }

        .role-label {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            background: white;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
        }

        .role-label:hover {
            border-color: #0077b6;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.1);
        }

        .role-checkbox:checked + .role-label {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-color: #0077b6;
            color: white;
        }

        .role-checkbox:checked + .role-label .role-icon {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .role-checkbox:disabled + .role-label {
            background: #f8f9fa;
            border-color: #dee2e6;
            color: #6c757d;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .role-checkbox:disabled + .role-label:hover {
            transform: none;
            box-shadow: none;
            border-color: #dee2e6;
        }

        .role-icon {
            width: 45px;
            height: 45px;
            background: #f8fbff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #0077b6;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .role-text {
            flex: 1;
        }

        .role-name {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .role-checkbox:disabled + .role-label::after {
            content: "✓ Sudah dimiliki";
            position: absolute;
            top: -8px;
            right: -8px;
            background: #6c757d;
            color: white;
            padding: 4px 8px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 600;
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

        .form-control:focus {
            border-color: #0077b6;
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 119, 182, 0.1);
        }

        select.form-control {
            appearance: none;
            cursor: pointer;
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

            .role-grid {
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
        const allRoles = @json($roles);

        // Load user roles ketika user dipilih
        function loadUserRoles() {
            const userSelect = document.getElementById('iduser');
            const selectedOption = userSelect.options[userSelect.selectedIndex];
            const existingRolesInfo = document.getElementById('existingRolesInfo');
            const existingRolesList = document.getElementById('existingRolesList');
            
            if (selectedOption.value) {
                const userRoles = JSON.parse(selectedOption.dataset.roles || '[]');
                
                if (userRoles.length > 0) {
                    // Tampilkan info role yang sudah dimiliki
                    existingRolesInfo.style.display = 'block';
                    
                    const roleNames = userRoles.map(roleId => {
                        const role = allRoles.find(r => r.idrole == roleId);
                        return role ? role.nama_role : '';
                    }).filter(Boolean);
                    
                    existingRolesList.innerHTML = roleNames.map(name => 
                        `<span class="badge-role badge-${name.toLowerCase().replace(' ', '')}">${name}</span>`
                    ).join(' ');
                    
                    // Disable checkbox untuk role yang sudah dimiliki
                    userRoles.forEach(roleId => {
                        const checkbox = document.getElementById('role_' + roleId);
                        if (checkbox) {
                            checkbox.disabled = true;
                            checkbox.checked = false;
                        }
                    });

                    // Enable checkbox untuk role yang belum dimiliki
                    allRoles.forEach(role => {
                        if (!userRoles.includes(role.idrole)) {
                            const checkbox = document.getElementById('role_' + role.idrole);
                            if (checkbox) {
                                checkbox.disabled = false;
                            }
                        }
                    });
                } else {
                    existingRolesInfo.style.display = 'none';
                    // Enable semua checkbox
                    allRoles.forEach(role => {
                        const checkbox = document.getElementById('role_' + role.idrole);
                        if (checkbox) {
                            checkbox.disabled = false;
                        }
                    });
                }
            } else {
                existingRolesInfo.style.display = 'none';
                // Enable semua checkbox
                allRoles.forEach(role => {
                    const checkbox = document.getElementById('role_' + role.idrole);
                    if (checkbox) {
                        checkbox.disabled = false;
                    }
                });
            }
        }

        // Auto focus on select
        document.getElementById('iduser').focus();

        // Form validation before submit
        document.getElementById('formCreate').addEventListener('submit', function(e) {
            const user = document.getElementById('iduser');
            const roles = document.querySelectorAll('input[name="roles[]"]:checked');
            let hasError = false;

            if (user.value === '') {
                user.classList.add('is-invalid');
                hasError = true;
            }

            if (roles.length === 0) {
                const roleSection = document.querySelector('.role-section');
                if (!roleSection.querySelector('.invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                    errorDiv.style.display = 'block !important';
                    errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Pilih minimal 1 role!</span>';
                    roleSection.appendChild(errorDiv);
                }
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
                if (user.value === '') {
                    user.focus();
                }
            }
        });

        // Remove error class on change
        document.getElementById('iduser').addEventListener('change', function() {
            this.classList.remove('is-invalid');
        });

        // Remove error on role selection
        document.querySelectorAll('.role-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const roleSection = document.querySelector('.role-section');
                const existingError = roleSection.querySelector('.invalid-feedback');
                if (existingError) {
                    existingError.remove();
                }
            });
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadUserRoles();
        });
    </script>
@endsection