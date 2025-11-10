<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Role - RSHP UNAIR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0077b6;
            --primary-dark: #023e8a;
            --secondary: #00b4d8;
            --accent: #ffc300;
            --success: #06d6a0;
            --danger: #ef476f;
            --light-bg: #f8fbff;
            --white: #ffffff;
            --text-dark: #1a1a2e;
            --text-gray: #4a5568;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0077b6 0%, #023e8a 100%);
            min-height: 100vh;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 700px;
            width: 100%;
        }

        .form-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: slideUp 0.5s ease;
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

        .form-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            padding: 35px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .form-header-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 20px;
            backdrop-filter: blur(10px);
        }

        .form-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .form-header p {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .form-body {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .required {
            color: var(--danger);
            margin-left: 3px;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            background: var(--light-bg);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(0, 119, 182, 0.1);
        }

        select.form-control {
            cursor: pointer;
        }

        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .error-message::before {
            content: "⚠️";
        }

        .form-control.error {
            border-color: var(--danger);
            background: #fff5f5;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 35px;
        }

        .btn {
            flex: 1;
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 119, 182, 0.4);
        }

        .btn-secondary {
            background: var(--light-bg);
            color: var(--text-dark);
            border: 2px solid #e8e8e8;
        }

        .btn-secondary:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
        }

        .form-hint {
            background: #f0f9ff;
            border-left: 4px solid var(--primary);
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            color: var(--text-gray);
            font-size: 0.9rem;
            display: flex;
            align-items: start;
            gap: 12px;
        }

        .form-hint::before {
            content: "💡";
            font-size: 1.3rem;
        }

        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 15px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            background: var(--light-bg);
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox-item:hover {
            background: #e6f4ff;
            border-color: var(--primary);
        }

        .checkbox-item input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: var(--primary);
        }

        .checkbox-item input[type="checkbox"]:checked + label {
            color: var(--primary);
            font-weight: 600;
        }

        .checkbox-item label {
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--text-dark);
            margin: 0;
        }

        .role-section {
            background: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 20px;
        }

        .role-section-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .role-section-title::before {
            content: "🔐";
            font-size: 1.2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .form-header {
                padding: 30px 25px;
            }

            .form-header h1 {
                font-size: 1.5rem;
            }

            .form-body {
                padding: 30px 25px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .checkbox-group {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <!-- Header -->
            <div class="form-header">
                <div class="form-header-icon">🔐</div>
                <h1>Tambah Role ke User</h1>
                <p>Berikan hak akses kepada user</p>
            </div>

            <!-- Body -->
            <div class="form-body">
                <div class="form-hint">
                    <span>Pilih user dan role yang ingin diberikan. User dapat memiliki lebih dari satu role</span>
                </div>

                <form action="{{ route('admin.role-user.store') }}" method="POST" id="roleForm">
                    @csrf
                    
                    <div class="form-group">
                        <label for="iduser">
                            Pilih User
                            <span class="required">*</span>
                        </label>
                        <select id="iduser" 
                                name="iduser" 
                                class="form-control @error('iduser') error @enderror" 
                                onchange="loadUserRoles()"
                                autofocus>
                            <option value="">-- Pilih User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->iduser }}" 
                                        data-roles="{{ $user->roleUsers->pluck('idrole')->toJson() }}"
                                        {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                                    {{ $user->nama }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('iduser')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Info Role yang Sudah Dimiliki -->
                    <div id="existingRolesInfo" style="display: none; background: #fff3cd; border: 2px solid #ffc107; border-radius: 10px; padding: 15px; margin-bottom: 20px;">
                        <div style="font-weight: 600; color: #856404; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                            <span>ℹ️</span>
                            <span>Role yang Sudah Dimiliki User:</span>
                        </div>
                        <div id="existingRolesList" style="color: #856404;"></div>
                    </div>

                    <div class="form-group">
                        <div class="role-section">
                            <div class="role-section-title">
                                Pilih Role (minimal 1)
                                <span class="required">*</span>
                            </div>
                            
                            <div class="checkbox-group">
                                @foreach($roles as $role)
                                <div class="checkbox-item">
                                    <input type="checkbox" 
                                           id="role_{{ $role->idrole }}" 
                                           name="roles[]" 
                                           value="{{ $role->idrole }}"
                                           {{ is_array(old('roles')) && in_array($role->idrole, old('roles')) ? 'checked' : '' }}>
                                    <label for="role_{{ $role->idrole }}">{{ $role->nama_role }}</label>
                                </div>
                                @endforeach
                            </div>
                            
                            @error('roles')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <span>💾</span>
                            <span>Tambah Role</span>
                        </button>
                        <a href="{{ route('admin.role-user.index') }}" class="btn btn-secondary">
                            <span>↩️</span>
                            <span>Kembali</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    
                    existingRolesList.innerHTML = roleNames.join(', ');
                    
                    // Disable checkbox untuk role yang sudah dimiliki
                    userRoles.forEach(roleId => {
                        const checkbox = document.getElementById('role_' + roleId);
                        if (checkbox) {
                            checkbox.disabled = true;
                            checkbox.checked = false;
                            const item = checkbox.closest('.checkbox-item');
                            item.style.opacity = '0.5';
                            item.style.cursor = 'not-allowed';
                            const label = item.querySelector('label');
                            label.style.cursor = 'not-allowed';
                            label.innerHTML = label.textContent + ' <small>(Sudah dimiliki)</small>';
                        }
                    });
                } else {
                    existingRolesInfo.style.display = 'none';
                    // Enable semua checkbox
                    allRoles.forEach(role => {
                        const checkbox = document.getElementById('role_' + role.idrole);
                        if (checkbox) {
                            checkbox.disabled = false;
                            const item = checkbox.closest('.checkbox-item');
                            item.style.opacity = '1';
                            item.style.cursor = 'pointer';
                            const label = item.querySelector('label');
                            label.style.cursor = 'pointer';
                            label.textContent = role.nama_role;
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
                        const item = checkbox.closest('.checkbox-item');
                        item.style.opacity = '1';
                        item.style.cursor = 'pointer';
                        const label = item.querySelector('label');
                        label.style.cursor = 'pointer';
                        label.textContent = role.nama_role;
                    }
                });
            }
        }

        // Auto focus on select
        document.getElementById('iduser').focus();

        // Form validation before submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const user = document.getElementById('iduser');
            const roles = document.querySelectorAll('input[name="roles[]"]:checked');
            
            let isValid = true;
            
            if (user.value === '') {
                user.classList.add('error');
                user.focus();
                isValid = false;
            }
            
            if (roles.length === 0) {
                alert('⚠️ Pilih minimal 1 role untuk user!');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });

        // Remove error class on change
        document.getElementById('iduser').addEventListener('change', function() {
            this.classList.remove('error');
        });
    </script>
</body>
</html>