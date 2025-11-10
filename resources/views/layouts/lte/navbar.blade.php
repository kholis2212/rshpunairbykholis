<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list" style="font-size: 1.5rem;"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('admin.dashboard-admin') }}" class="nav-link">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->
        
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen" title="Fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen" style="font-size: 1.3rem;"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none; font-size: 1.3rem;"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->
            
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="display: flex; align-items: center; gap: 10px;">
                    <span class="d-none d-md-inline" style="font-weight: 600;">{{ Auth::user()->nama }}</span>
                    <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #0077b6, #00b4d8); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.9rem;">
                        {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end" style="border-radius: 15px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.15);">
                    <!--begin::User Image-->
                    <li class="user-header text-bg-primary">
                        <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-size: 2.5rem; font-weight: bold; box-shadow: 0 5px 20px rgba(0,0,0,0.2);">
                            {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                        </div>
                        <p style="margin: 0; font-size: 1.1rem; font-weight: 700;">
                            {{ Auth::user()->nama }}
                            <small style="display: block; margin-top: 5px; opacity: 0.9; font-size: 0.9rem;">
                                <i class="bi bi-shield-check"></i> {{ ucfirst(Auth::user()->role) }}
                            </small>
                        </p>
                    </li>
                    <!--end::User Image-->
                    
                    <!--begin::Menu Footer-->
                    <li class="user-footer" style="padding: 15px; display: flex; justify-content: space-between; gap: 10px;">
                        <a href="#" class="btn btn-default btn-flat" style="flex: 1; background: #f0f9ff; color: #0077b6; font-weight: 600; border-radius: 8px;">
                            <i class="bi bi-person-circle"></i> Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="flex: 1; margin: 0;">
                            @csrf
                            <button type="submit" class="btn btn-default btn-flat" style="width: 100%; background: linear-gradient(135deg, #ef476f, #d62839); color: white; font-weight: 600; border-radius: 8px; border: none;">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                    <!--end::Menu Footer-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<!--end::Header-->