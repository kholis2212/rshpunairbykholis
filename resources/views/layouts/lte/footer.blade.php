<!--begin::Footer-->
<footer class="app-footer" style="background: linear-gradient(135deg, #023e8a, #0077b6); color: white; padding: 20px 0; border-top: 3px solid #ffc300; box-shadow: 0 -5px 20px rgba(0,0,0,0.1);">
    <!--begin::Container-->
    <div class="container-fluid">
        <div class="row align-items-center">
            <!--begin::Copyright-->
            <div class="col-md-6 text-center text-md-start">
                <strong style="font-weight: 700;">
                    &copy; 2025 
                    <a href="https://rshp.unair.ac.id" class="text-decoration-none" style="color: #ffc300; font-weight: 700;">
                        Rumah Sakit Hewan Pendidikan UNAIR
                    </a>
                </strong>
                <span style="opacity: 0.9;"> | All Rights Reserved</span>
            </div>
            <!--end::Copyright-->
            
            <!--begin::Designer Credit-->
            <div class="col-md-6 text-center text-md-end" style="opacity: 0.95;">
                <span>Designed by</span> 
                <strong style="color: #ffc300; font-weight: 700;">Kholis Abdi</strong>
            </div>
            <!--end::Designer Credit-->
        </div>
    </div>
    <!--end::Container-->
</footer>
<!--end::Footer-->

</div>
<!--end::App Wrapper-->

<!--begin::Script-->
<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" 
        crossorigin="anonymous"></script>
<!--end::Third Party Plugin(OverlayScrollbars)-->

<!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
        crossorigin="anonymous"></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)-->

<!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" 
        crossorigin="anonymous"></script>
<!--end::Required Plugin(Bootstrap 5)-->

<!--begin::Required Plugin(AdminLTE)-->
<script src="{{ asset('assets/js/adminlte.js') }}"></script>
<!--end::Required Plugin(AdminLTE)-->

<!-- jQuery (for DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<!--begin::OverlayScrollbars Configure-->
<script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };
    
    document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal !== 'undefined' && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script>
<!--end::OverlayScrollbars Configure-->

<!-- Custom Scripts -->
<script>
    // Auto hide alerts after 5 seconds with animation
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.transition = 'all 0.4s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 400);
        });
    }, 5000);
    
    // Initialize DataTables with custom styling
    $(document).ready(function() {
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "pageLength": 10,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json",
                    "search": "🔍 Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
            });
        }
    });
    
    // Add smooth scroll behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Animate cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.card, .small-box').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });
</script>

@yield('extra-js')

</body>
</html>