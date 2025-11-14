<!--begin::Footer-->
<footer class="app-footer" style="background: linear-gradient(135deg, #023e8a 0%, #0077b6 100%); color: white; padding: 20px 0; border-top: 4px solid #ffc300; box-shadow: 0 -8px 30px rgba(0,0,0,0.15); position: relative; overflow: hidden;">
    <!-- Decorative Background -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 20% 50%, rgba(255, 195, 0, 0.1) 0%, transparent 50%), radial-gradient(circle at 80% 80%, rgba(0, 180, 216, 0.1) 0%, transparent 50%); pointer-events: none;"></div>
    
    <!--begin::Container-->
    <div class="container-fluid" style="position: relative; z-index: 1;">
        <div class="row align-items-center">
            <!--begin::Copyright-->
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <div style="display: flex; align-items: center; gap: 12px; justify-content: center; justify-content: md-start;">
                    <div style="width: 45px; height: 45px; background: rgba(255, 255, 255, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.2); backdrop-filter: blur(10px);">
                        🏥
                    </div>
                    <div style="display: flex; flex-direction: column; line-height: 1.3;">
                        <strong style="font-weight: 800; font-size: 1rem;">
                            &copy; 2025 RSHP UNAIR
                        </strong>
                        <span style="opacity: 0.9; font-size: 0.85rem; font-weight: 500;">All Rights Reserved</span>
                    </div>
                </div>
            </div>
            <!--end::Copyright-->
            
            <!--begin::Designer Credit-->
            <div class="col-md-6 text-center text-md-end">
                <div style="display: flex; align-items: center; gap: 8px; opacity: 0.95; justify-content: center; justify-content: md-end;">
                    <span style="font-weight: 600; font-size: 0.9rem;">Designed by</span> 
                    <strong style="color: #ffc300; font-weight: 800; font-size: 1rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">Kholis Abdi</strong>
                </div>
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
    // Auto hide alerts after 5 seconds with smooth animation
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.transition = 'all 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-30px) scale(0.95)';
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 500);
        });
    }, 5000);
    
    // Initialize DataTables with minimal features
    $(document).ready(function() {
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                "responsive": true,
                "lengthChange": false,    // Disable dropdown "Tampilkan X data"
                "searching": true,       /
                "paging": false,          // Disable pagination
                "info": false,            // Disable info "Menampilkan X sampai Y dari Z data"
                "ordering": true,         // Keep column sorting
                "autoWidth": false
                // Remove language and dom configuration to disable all extra features
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
    
    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -80px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                entry.target.classList.add('fade-in');
            }
        });
    }, observerOptions);
    
    // Observe cards and boxes
    document.querySelectorAll('.card, .small-box, .alert').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        observer.observe(el);
    });
    
    // Add loading state for buttons
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                
                // Re-enable after 5 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }, 5000);
            }
        });
    });
</script>

@yield('extra-js')

</body>
</html>