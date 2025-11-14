{{-- layouts/lte/main.blade.php --}}
@include('layouts.lte.head')

@include('layouts.lte.navbar')

@include('layouts.lte.sidebar')

<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header" style="background: linear-gradient(135deg, rgba(0, 119, 182, 0.05), rgba(0, 150, 199, 0.05)); border-bottom: 2px solid rgba(0, 119, 182, 0.1); box-shadow: 0 4px 15px rgba(0, 119, 182, 0.08);">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0" style="color: #023e8a; font-weight: 800; display: flex; align-items: center; gap: 10px;">
                        <i class="bi bi-@yield('page-icon', 'house-heart-fill')" style="color: #0077b6; font-size: 1.3rem;"></i>
                        @yield('page-title', 'Dashboard')
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end" style="background: rgba(0, 119, 182, 0.08); padding: 10px 20px; border-radius: 50px; font-weight: 600;">
                        @yield('breadcrumb')
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            @yield('content')
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->

@include('layouts.lte.footer')