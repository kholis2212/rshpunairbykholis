<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('admin.dashboard-admin') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" 
                 alt="UNAIR Logo" 
                 class="brand-image opacity-75 shadow"
                 style="max-height: 35px; background: white; padding: 4px 8px; border-radius: 8px;" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">RSHP UNAIR</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" 
                data-lte-toggle="treeview" 
                role="navigation" 
                aria-label="Main navigation"
                data-accordion="false">
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard-admin') }}" 
                       class="nav-link {{ Request::is('admin/dashboard-admin') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <!-- Data Master Header -->
                <li class="nav-header">DATA MASTER</li>
                
                <!-- User Management -->
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" 
                       class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>Data User</p>
                    </a>
                </li>
                
                <!-- Role Management -->
                <li class="nav-item">
                    <a href="{{ route('admin.role-user.index') }}" 
                       class="nav-link {{ Request::is('admin/role-user*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-shield-lock-fill"></i>
                        <p>Manajemen Role</p>
                    </a>
                </li>
                
                <!-- Jenis Hewan -->
                <li class="nav-item">
                    <a href="{{ route('admin.jenis-hewan.index') }}" 
                       class="nav-link {{ Request::is('admin/jenis-hewan*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-heart-fill"></i>
                        <p>Data Jenis Hewan</p>
                    </a>
                </li>
                
                <!-- Ras Hewan -->
                <li class="nav-item">
                    <a href="{{ route('admin.ras-hewan.index') }}" 
                       class="nav-link {{ Request::is('admin/ras-hewan*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-award-fill"></i>
                        <p>Data Ras Hewan</p>
                    </a>
                </li>
                
                <!-- Pemilik -->
                <li class="nav-item">
                    <a href="{{ route('admin.pemilik.index') }}" 
                       class="nav-link {{ Request::is('admin/pemilik*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>Data Pemilik</p>
                    </a>
                </li>
                
                <!-- Pet -->
                <li class="nav-item">
                    <a href="{{ route('admin.pet.index') }}" 
                       class="nav-link {{ Request::is('admin/pet*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-emoji-smile-fill"></i>
                        <p>Data Pet</p>
                    </a>
                </li>
                
                <!-- Kategori -->
                <li class="nav-item">
                    <a href="{{ route('admin.kategori.index') }}" 
                       class="nav-link {{ Request::is('admin/kategori') && !Request::is('admin/kategori-klinis*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-folder-fill"></i>
                        <p>Data Kategori</p>
                    </a>
                </li>
                
                <!-- Kategori Klinis -->
                <li class="nav-item">
                    <a href="{{ route('admin.kategori-klinis.index') }}" 
                       class="nav-link {{ Request::is('admin/kategori-klinis*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-hospital-fill"></i>
                        <p>Kategori Klinis</p>
                    </a>
                </li>
                
                <!-- Kode Tindakan Terapi -->
                <li class="nav-item">
                    <a href="{{ route('admin.kode-tindakan-terapi.index') }}" 
                       class="nav-link {{ Request::is('admin/kode-tindakan-terapi*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-capsule-pill"></i>
                        <p>Kode Tindakan Terapi</p>
                    </a>
                </li>
                
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->