<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Role User - RSHP UNAIR</title>
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
            --warning: #ffa500;
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
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header Card */
        .header-card {
            background: var(--white);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
        }

        .header-title h1 {
            color: var(--primary-dark);
            font-size: 1.8rem;
            font-weight: 700;
        }

        .header-title p {
            color: var(--text-gray);
            font-size: 0.95rem;
            margin-top: 5px;
        }

        .header-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        /* Buttons */
        .btn {
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success), #05b589);
            color: var(--white);
            box-shadow: 0 5px 20px rgba(6, 214, 160, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(6, 214, 160, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #ff8c00);
            color: var(--white);
            box-shadow: 0 5px 20px rgba(255, 165, 0, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 165, 0, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #d62839);
            color: var(--white);
            box-shadow: 0 5px 20px rgba(239, 71, 111, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 71, 111, 0.4);
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 0.85rem;
        }

        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.4s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
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

        .alert-success {
            background: linear-gradient(135deg, #06d6a0, #05b589);
            color: var(--white);
        }

        .alert-success::before {
            content: "✓";
            font-size: 1.5rem;
            font-weight: bold;
        }

        .alert-error {
            background: linear-gradient(135deg, #ef476f, #d62839);
            color: var(--white);
        }

        .alert-error::before {
            content: "⚠️";
            font-size: 1.5rem;
        }

        /* Table Card */
        .table-card {
            background: var(--white);
            border-radius: 20px;
            padding: 0;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .table-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h2 {
            font-size: 1.3rem;
            font-weight: 600;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 10px 40px 10px 15px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
            font-size: 0.9rem;
            width: 250px;
            transition: all 0.3s ease;
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-box input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .table-wrapper {
            overflow-x: auto;
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--light-bg);
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.95rem;
            border-bottom: 2px solid var(--primary);
        }

        td {
            padding: 18px 15px;
            border-bottom: 1px solid #e8e8e8;
            color: var(--text-dark);
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: #f0f9ff;
            transform: scale(1.01);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-number {
            background: linear-gradient(135deg, var(--accent), #ffdb4d);
            color: var(--primary-dark);
        }

        .badge-role {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin: 3px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .badge-administrator {
            background: linear-gradient(135deg, #ef476f, #d62839);
            color: white;
        }

        .badge-dokter {
            background: linear-gradient(135deg, #0077b6, #00b4d8);
            color: white;
        }

        .badge-perawat {
            background: linear-gradient(135deg, #06d6a0, #05b589);
            color: white;
        }

        .badge-resepsionis {
            background: linear-gradient(135deg, #ffc300, #ffdb4d);
            color: #1a1a2e;
        }

        /* Default style untuk role lain yang tidak terdefinisi */
        .badge-role:not([class*="badge-administrator"]):not([class*="badge-dokter"]):not([class*="badge-perawat"]):not([class*="badge-resepsionis"]) {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            color: var(--text-gray);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 1.4rem;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        /* Modal Confirm Delete */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: var(--white);
            margin: 10% auto;
            padding: 40px;
            border-radius: 20px;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
            text-align: center;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--danger), #d62839);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 25px;
            animation: pulse 1.5s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .modal-content h3 {
            color: var(--text-dark);
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .modal-content p {
            color: var(--text-gray);
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .header-card {
                padding: 20px;
                text-align: center;
                flex-direction: column;
            }

            .header-title h1 {
                font-size: 1.4rem;
            }

            .search-box input {
                width: 100%;
            }

            .table-wrapper {
                padding: 20px 15px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .modal-content {
                margin: 20% 15px;
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header-card">
            <div class="header-title">
                <div class="header-icon">🔐</div>
                <div>
                    <h1>Manajemen Role User</h1>
                    <p>Kelola hak akses dan peran pengguna sistem</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.dashboard-admin') }}" class="btn btn-primary">
                    <span>🏠</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.role-user.create') }}" class="btn btn-success">
                    <span>➕</span>
                    <span>Tambah Role</span>
                </a>
            </div>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Alert Error -->
        @if(session('error'))
            <div class="alert alert-error">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Table Card -->
        <div class="table-card">
            <div class="table-header">
                <h2>👥 Daftar User & Role</h2>
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="🔍 Cari user..." onkeyup="searchTable()">
                </div>
            </div>

            <div class="table-wrapper">
                @if($users->count() > 0)
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Role yang Dimiliki</th>
                                <th style="width: 180px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $user)
                            <tr>
                                <td>
                                    <span class="badge badge-number">{{ $index + 1 }}</span>
                                </td>
                                <td style="font-weight: 500;">{{ $user->nama }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->roleUsers->count() > 0)
                                        @foreach($user->roleUsers as $roleUser)
                                            @if($roleUser->role)
                                                <span class="badge-role badge-{{ strtolower(str_replace(' ', '', $roleUser->role->nama_role)) }}" style="position: relative; padding-right: 30px;">
                                                    🎭 {{ $roleUser->role->nama_role }}
                                                    @if($user->roleUsers->count() > 1)
                                                    <button type="button" 
                                                            onclick="confirmDeleteRole({{ $roleUser->idrole_user }}, '{{ $roleUser->role->nama_role }}', '{{ $user->nama }}')"
                                                            style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.2); border: none; color: white; width: 20px; height: 20px; border-radius: 50%; cursor: pointer; font-size: 12px; display: flex; align-items: center; justify-content: center; padding: 0;">
                                                        ✕
                                                    </button>
                                                    @endif
                                                </span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span style="color: var(--text-gray); font-style: italic;">Belum ada role</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons" style="justify-content: center;">
                                        <a href="{{ route('admin.role-user.edit', $user->iduser) }}" class="btn btn-warning btn-sm">
                                            <span>✏️</span>
                                            <span>Edit</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon">📭</div>
                        <h3>Belum Ada Data</h3>
                        <p>Belum ada user dalam sistem</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Confirm Delete Role -->
    <div id="deleteRoleModal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">⚠️</div>
            <h3>Konfirmasi Hapus Role</h3>
            <p>Apakah Anda yakin ingin menghapus role <strong id="deleteRoleName"></strong> dari user <strong id="deleteUserName"></strong>?</p>
            <p style="color: var(--danger); font-size: 0.9rem;">Role yang dihapus tidak dapat dikembalikan!</p>
            
            <form id="deleteRoleForm" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <div class="modal-buttons">
                    <button type="button" onclick="closeRoleModal()" class="btn btn-primary">
                        <span>✖️</span>
                        <span>Batal</span>
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <span>🗑️</span>
                        <span>Ya, Hapus!</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Search Function
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('dataTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const tdNama = tr[i].getElementsByTagName('td')[1];
                const tdEmail = tr[i].getElementsByTagName('td')[2];
                if (tdNama || tdEmail) {
                    const txtNama = tdNama.textContent || tdNama.innerText;
                    const txtEmail = tdEmail.textContent || tdEmail.innerText;
                    if (txtNama.toLowerCase().indexOf(filter) > -1 || txtEmail.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }

        // Modal Functions for Delete Role
        function confirmDeleteRole(id, roleName, userName) {
            const modal = document.getElementById('deleteRoleModal');
            const form = document.getElementById('deleteRoleForm');
            const roleNameEl = document.getElementById('deleteRoleName');
            const userNameEl = document.getElementById('deleteUserName');
            
            form.action = `/admin/role-user/${id}`;
            roleNameEl.textContent = roleName;
            userNameEl.textContent = userName;
            modal.style.display = 'block';
        }

        function closeRoleModal() {
            document.getElementById('deleteRoleModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('deleteRoleModal');
            if (event.target == modal) {
                closeRoleModal();
            }
        }

        // Auto hide alert after 5 seconds
        setTimeout(function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.style.animation = 'slideDown 0.4s ease reverse';
                setTimeout(() => alert.remove(), 400);
            }
        }, 5000);
    </script>
</body>
</html>