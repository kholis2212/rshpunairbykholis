<!--begin::Sidebar-->
<aside class="app-sidebar shadow" data-bs-theme="dark" style="background: linear-gradient(180deg, #023e8a 0%, #0077b6 100%) !important;">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand" style="padding: 20px; background: rgba(0, 0, 0, 0.2); border-bottom: 2px solid rgba(255, 255, 255, 0.1);">
        @php
            $brandRoute = match(Auth::user()->role) {
                'admin' => 'admin.dashboard-admin',
                'dokter' => 'dokter.dashboard-dokter',
                'perawat' => 'perawat.dashboard-perawat',
                'resepsionis' => 'resepsionis.dashboard-resepsionis',
                'pemilik' => 'pemilik.dashboard-pemilik',
                default => 'admin.dashboard-admin'
            };
        @endphp
        <a href="{{ route($brandRoute) }}" class="brand-link" style="display: flex; align-items: center; gap: 12px; text-decoration: none;">
            <div style="width: 45px; height: 45px; background: rgba(255, 255, 255, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; backdrop-filter: blur(10px); border: 2px solid rgba(255, 255, 255, 0.2);">
                🏥
            </div>
            <div style="display: flex; flex-direction: column; line-height: 1.3;">
                <span style="color: white; font-weight: 800; font-size: 1.1rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">RSHP UNAIR</span>
                <span style="color: rgba(255, 255, 255, 0.8); font-size: 0.7rem; font-weight: 600;">{{ ucfirst(Auth::user()->role) }}</span>
            </div>
        </a>
    </div>
    <!--end::Sidebar Brand-->
    
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-3">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" 
                data-lte-toggle="treeview" 
                role="navigation" 
                aria-label="Main navigation"
                data-accordion="false">
                
                @php
                    $currentRole = Auth::user()->role;
                @endphp

                @if($currentRole === 'Admin')
                    <!-- ADMIN SIDEBAR -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard-admin') }}" 
                           class="nav-link {{ Request::is('admin/dashboard-admin') ? 'active' : '' }}">
                            <div class="nav-icon">🏠</div>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li class="nav-header">🗂️ DATA MASTER</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.user.index') }}" 
                           class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">
                            <div class="nav-icon">👥</div>
                            <p>Data User</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.role-user.index') }}" 
                           class="nav-link {{ Request::is('admin/role-user*') ? 'active' : '' }}">
                            <div class="nav-icon">🔐</div>
                            <p>Manajemen Role</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.jenis-hewan.index') }}" 
                           class="nav-link {{ Request::is('admin/jenis-hewan*') ? 'active' : '' }}">
                            <div class="nav-icon">🐾</div>
                            <p>Data Jenis Hewan</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.ras-hewan.index') }}" 
                           class="nav-link {{ Request::is('admin/ras-hewan*') ? 'active' : '' }}">
                            <div class="nav-icon">🐕</div>
                            <p>Data Ras Hewan</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.pemilik.index') }}" 
                           class="nav-link {{ Request::is('admin/pemilik*') ? 'active' : '' }}">
                            <div class="nav-icon">👤</div>
                            <p>Data Pemilik</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.pet.index') }}" 
                           class="nav-link {{ Request::is('admin/pet*') ? 'active' : '' }}">
                            <div class="nav-icon">🐶</div>
                            <p>Data Pet</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.kategori.index') }}" 
                           class="nav-link {{ Request::is('admin/kategori') && !Request::is('admin/kategori-klinis*') ? 'active' : '' }}">
                            <div class="nav-icon">📁</div>
                            <p>Data Kategori</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.kategori-klinis.index') }}" 
                           class="nav-link {{ Request::is('admin/kategori-klinis*') ? 'active' : '' }}">
                            <div class="nav-icon">🏥</div>
                            <p>Kategori Klinis</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.kode-tindakan-terapi.index') }}" 
                           class="nav-link {{ Request::is('admin/kode-tindakan-terapi*') ? 'active' : '' }}">
                            <div class="nav-icon">💉</div>
                            <p>Tindakan Terapi</p>
                        </a>
                    </li>

                @elseif($currentRole === 'Dokter')
                    <!-- DOKTER SIDEBAR -->
                    <li class="nav-item">
                        <a href="{{ route('dokter.dashboard-dokter') }}" 
                           class="nav-link {{ Request::is('dokter/dashboard-dokter') ? 'active' : '' }}">
                            <div class="nav-icon">🏠</div>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li class="nav-header">📋 REKAM MEDIS</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('dokter.rekam-medis.index') }}" 
                           class="nav-link {{ Request::is('dokter/rekam-medis*') ? 'active' : '' }}">
                            <div class="nav-icon">📄</div>
                            <p>Rekam Medis Pasien</p>
                        </a>
                    </li>

                @elseif($currentRole === 'Perawat')
                    <!-- PERAWAT SIDEBAR -->
                    <li class="nav-item">
                        <a href="{{ route('perawat.dashboard-perawat') }}" 
                           class="nav-link {{ Request::is('perawat/dashboard-perawat') ? 'active' : '' }}">
                            <div class="nav-icon">🏠</div>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li class="nav-header">📋 REKAM MEDIS</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('perawat.rekam-medis.index') }}" 
                           class="nav-link {{ Request::is('perawat/rekam-medis*') ? 'active' : '' }}">
                            <div class="nav-icon">📋</div>
                            <p>Rekam Medis</p>
                        </a>
                    </li>

                @elseif($currentRole === 'Resepsionis')
                    <!-- RESEPSIONIS SIDEBAR -->
                    <li class="nav-item">
                        <a href="{{ route('resepsionis.dashboard-resepsionis') }}" 
                           class="nav-link {{ Request::is('resepsionis/dashboard-resepsionis') ? 'active' : '' }}">
                            <div class="nav-icon">🏠</div>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li class="nav-header">📝 REGISTRASI</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('resepsionis.registrasi.pemilik') }}" 
                           class="nav-link {{ Request::is('resepsionis/registrasi/pemilik*') ? 'active' : '' }}">
                            <div class="nav-icon">👤</div>
                            <p>Registrasi Pemilik</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('resepsionis.registrasi.pet') }}" 
                           class="nav-link {{ Request::is('resepsionis/registrasi/pet*') ? 'active' : '' }}">
                            <div class="nav-icon">🐶</div>
                            <p>Registrasi Pet</p>
                        </a>
                    </li>
                    
                    <li class="nav-header">📅 TEMU DOKTER</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('resepsionis.temu-dokter.index') }}" 
                           class="nav-link {{ Request::is('resepsionis/temu-dokter*') ? 'active' : '' }}">
                            <div class="nav-icon">📅</div>
                            <p>Daftar Temu Dokter</p>
                        </a>
                    </li>

                @elseif($currentRole === 'Pemilik')
                    <!-- PEMILIK SIDEBAR -->
                    <li class="nav-item">
                        <a href="{{ route('pemilik.dashboard-pemilik') }}" 
                           class="nav-link {{ Request::is('pemilik/dashboard-pemilik') ? 'active' : '' }}">
                            <div class="nav-icon">🏠</div>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li class="nav-header">🐾 DATA SAYA</li>
                    
                    <li class="nav-item">
                        <a href="{{ route('pemilik.pet-saya.index') }}" 
                           class="nav-link {{ Request::is('pemilik/pet-saya*') ? 'active' : '' }}">
                            <div class="nav-icon">🐶</div>
                            <p>Daftar Pet Saya</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('pemilik.reservasi-saya.index') }}" 
                           class="nav-link {{ Request::is('pemilik/reservasi-saya*') ? 'active' : '' }}">
                            <div class="nav-icon">📅</div>
                            <p>Daftar Reservasi Saya</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('pemilik.rekam-medis-pet.index') }}" 
                           class="nav-link {{ Request::is('pemilik/rekam-medis-pet*') ? 'active' : '' }}">
                            <div class="nav-icon">📋</div>
                            <p>Daftar Rekam Medis Pet</p>
                        </a>
                    </li>

                @endif
                
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->

<style>
    /* Custom Sidebar Styling */
    .app-sidebar {
        padding-top: 0 !important;
        border-right: 3px solid #0096c7 !important;
    }
    
    .sidebar-wrapper {
        padding-top: 0 !important;
    }
    
    /* Brand Link Hover */
    .brand-link {
        transition: all 0.3s ease;
    }
    
    .brand-link:hover {
        transform: translateX(5px);
    }
    
    /* Nav Icon */
    .nav-icon {
        font-size: 1.4rem !important;
        margin-right: 12px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 30px !important;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }
    
    /* Nav Link */
    .nav-sidebar .nav-link {
        display: flex !important;
        align-items: center !important;
        color: rgba(255, 255, 255, 0.85) !important;
        padding: 12px 20px !important;
        margin: 4px 12px !important;
        border-radius: 10px !important;
        transition: all 0.3s ease !important;
        font-weight: 600 !important;
        position: relative;
        overflow: hidden;
    }
    
    .nav-sidebar .nav-link::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: white;
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }
    
    .nav-sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.15) !important;
        color: white !important;
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    
    .nav-sidebar .nav-link:hover::before {
        transform: scaleY(1);
    }
    
    .nav-sidebar .nav-link.active {
        background: rgba(255, 255, 255, 0.2) !important;
        color: white !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        border-left: 4px solid white;
    }
    
    .nav-sidebar .nav-link.active::before {
        transform: scaleY(1);
    }
    
    /* Nav Header */
    .nav-header {
        color: rgba(255, 255, 255, 0.6) !important;
        font-size: 0.75rem !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        padding: 20px 20px 10px 20px !important;
        margin-top: 15px !important;
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    /* Scrollbar */
    .app-sidebar::-webkit-scrollbar {
        width: 6px;
    }
    
    .app-sidebar::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.1);
    }
    
    .app-sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 10px;
    }
    
    .app-sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }
    
    /* Animation for nav items */
    .nav-item {
        animation: slideIn 0.3s ease forwards;
        opacity: 0;
    }
    
    .nav-item:nth-child(1) { animation-delay: 0.05s; }
    .nav-item:nth-child(2) { animation-delay: 0.1s; }
    .nav-item:nth-child(3) { animation-delay: 0.15s; }
    .nav-item:nth-child(4) { animation-delay: 0.2s; }
    .nav-item:nth-child(5) { animation-delay: 0.25s; }
    .nav-item:nth-child(6) { animation-delay: 0.3s; }
    .nav-item:nth-child(7) { animation-delay: 0.35s; }
    .nav-item:nth-child(8) { animation-delay: 0.4s; }
    .nav-item:nth-child(9) { animation-delay: 0.45s; }
    .nav-item:nth-child(10) { animation-delay: 0.5s; }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>