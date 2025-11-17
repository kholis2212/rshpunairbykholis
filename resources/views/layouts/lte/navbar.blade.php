<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body" style="box-shadow: 0 4px 20px rgba(0, 119, 182, 0.1); border-bottom: 3px solid #0077b6;">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list" style="font-size: 1.5rem; color: #0077b6;"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                @php
                    $dashboardRoute = match(Auth::user()->role) {
                        'admin' => 'admin.dashboard-admin',
                        'dokter' => 'dokter.dashboard-dokter',
                        'perawat' => 'perawat.dashboard-perawat',
                        'resepsionis' => 'resepsionis.dashboard-resepsionis',
                        'pemilik' => 'pemilik.dashboard-pemilik',
                        default => 'admin.dashboard-admin'
                    };
                @endphp
                <a href="{{ route($dashboardRoute) }}" class="nav-link" style="color: #0077b6; font-weight: 600; transition: all 0.3s ease;"
                   onmouseover="this.style.color='#005f8f'; this.style.transform='translateY(-2px)'"
                   onmouseout="this.style.color='#0077b6'; this.style.transform='translateY(0)'">
                    <i class="bi bi-house-heart-fill"></i> Dashboard
                </a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->
        
        <!--begin::Logo in Center (Desktop)-->
        <div class="d-none d-lg-flex justify-content-center flex-grow-1">
            @php
                $logoRoute = match(Auth::user()->role) {
                    'admin' => 'admin.dashboard-admin',
                    'dokter' => 'dokter.dashboard-dokter',
                    'perawat' => 'perawat.dashboard-perawat',
                    'resepsionis' => 'resepsionis.dashboard-resepsionis',
                    'pemilik' => 'pemilik.dashboard-pemilik',
                    default => 'admin.dashboard-admin'
                };
            @endphp
            <a href="{{ route($logoRoute) }}" class="navbar-brand" style="display: flex; align-items: center; gap: 15px; text-decoration: none;">
                <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" 
                     alt="UNAIR Logo" 
                     style="height: 45px; background: white; padding: 5px 10px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 119, 182, 0.15); transition: all 0.3s ease; border: 2px solid #0077b6;"
                     onmouseover="this.style.transform='scale(1.05) rotate(-2deg)'; this.style.boxShadow='0 6px 25px rgba(0, 119, 182, 0.25)'"
                     onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 15px rgba(0, 119, 182, 0.15)'">
                <div style="display: flex; flex-direction: column; line-height: 1.2;">
                    <span style="font-weight: 800; font-size: 1.1rem; color: #023e8a;">RSHP UNAIR</span>
                    <span style="font-size: 0.75rem; color: #0077b6; font-weight: 600;">Sistem Manajemen - {{ ucfirst(Auth::user()->role) }}</span>
                </div>
            </a>
        </div>
        <!--end::Logo in Center-->
        
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen" title="Layar Penuh">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen" style="font-size: 1.3rem; color: #0077b6;"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none; font-size: 1.3rem; color: #0077b6;"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->
            
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="display: flex; align-items: center; gap: 12px; padding: 8px 15px; border-radius: 50px; transition: all 0.3s ease;"
                   onmouseover="this.style.background='rgba(0, 119, 182, 0.15)'"
                   onmouseout="this.style.background='transparent'">
                    <span class="d-none d-md-inline" style="font-weight: 700; color: #023e8a;">{{ Auth::user()->nama }}</span>
                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #0077b6, #0096c7); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 1rem; box-shadow: 0 4px 15px rgba(0, 119, 182, 0.35); border: 3px solid white;">
                        {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end" style="border-radius: 20px; border: 2px solid #0077b6; box-shadow: 0 15px 50px rgba(0, 119, 182, 0.2); min-width: 300px;">
                    <!--begin::User Image-->
                    <li class="user-header" style="padding: 35px 25px; background: linear-gradient(135deg, #0077b6, #0096c7);">
                        <div style="width: 90px; height: 90px; background: rgba(255,255,255,0.25); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2.8rem; font-weight: 900; box-shadow: 0 8px 25px rgba(0,0,0,0.2); border: 4px solid rgba(255,255,255,0.3); color: white;">
                            {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                        </div>
                        <p style="margin: 0; font-size: 1.2rem; font-weight: 800; position: relative; z-index: 1; color: white;">
                            {{ Auth::user()->nama }}
                            <small style="display: block; margin-top: 8px; opacity: 0.95; font-size: 0.95rem; font-weight: 600;">
                                <i class="bi bi-shield-check-fill"></i> {{ ucfirst(Auth::user()->role) }}
                            </small>
                        </p>
                    </li>
                    <!--end::User Image-->
                    
                    <!--begin::Menu Body-->
                    <li style="padding: 20px 25px; border-bottom: 1px solid rgba(0, 119, 182, 0.1);">
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <div style="display: flex; align-items: center; gap: 10px; color: var(--text-gray);">
                                <i class="bi bi-envelope-fill" style="color: #0077b6; font-size: 1.1rem;"></i>
                                <span style="font-size: 0.9rem; font-weight: 500;">{{ Auth::user()->email ?? 'admin@rshp.unair.ac.id' }}</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; color: var(--text-gray);">
                                <i class="bi bi-calendar-check-fill" style="color: #06d6a0; font-size: 1.1rem;"></i>
                                <span style="font-size: 0.9rem; font-weight: 500;">Login: {{ now()->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                    </li>
                    <!--end::Menu Body-->
                    
                    <!--begin::Menu Footer-->
                    <li class="user-footer" style="padding: 20px; display: flex; justify-content: {{ in_array(Auth::user()->role, ['dokter', 'perawat', 'pemilik']) ? 'space-between' : 'center' }}; gap: 12px;">
                        @if(in_array(Auth::user()->role, ['dokter', 'perawat', 'pemilik']))
                            @php
                                $profileRoute = match(Auth::user()->role) {
                                    'dokter' => 'dokter.profile',
                                    'perawat' => 'perawat.profile',
                                    'pemilik' => 'pemilik.profile',
                                    default => '#'
                                };
                            @endphp
                            <a href="{{ route($profileRoute) }}" class="btn btn-default btn-flat" style="flex: 1; background: linear-gradient(135deg, #e0f2fe, #bae6fd); color: #023e8a; font-weight: 700; border-radius: 10px; padding: 12px; transition: all 0.3s ease; border: 2px solid #0077b6;"
                               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(0, 119, 182, 0.3)'"
                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <i class="bi bi-person-circle"></i> Profile
                            </a>
                        @endif
                        
                        <form method="POST" action="{{ route('logout') }}" style="{{ in_array(Auth::user()->role, ['dokter', 'perawat', 'pemilik']) ? 'flex: 1;' : 'width: 100%;' }} margin: 0;">
                            @csrf
                            <button type="submit" class="btn btn-default btn-flat" style="width: 100%; background: linear-gradient(135deg, #ef476f, #d62839); color: white; font-weight: 700; border-radius: 10px; border: none; padding: 12px; transition: all 0.3s ease;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(239, 71, 111, 0.3)'"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
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