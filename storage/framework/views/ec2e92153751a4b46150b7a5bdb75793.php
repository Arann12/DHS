<aside id="bo-sidebar">
    <div class="sidebar-logo">
        <img src="<?php echo e($boLogo ? asset(ltrim($boLogo, '/')) : asset('image/LogoDHS_2.jpeg')); ?>" alt="DHS Logo" class="sidebar-logo-img">
        <div class="logo-text">Denpasar<br>Hotel School</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-group-label">Utama</div>
        <a href="/backoffice/dashboard" class="nav-item <?php echo e(Request::is('backoffice/dashboard') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">dashboard</span>
            <span class="nav-label">Dashboard</span>
        </a>

        <div class="nav-group-label">Modul Utama</div>
        <a href="/backoffice/beranda" class="nav-item <?php echo e(Request::is('backoffice/beranda') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">home</span>
            <span class="nav-label">Home</span>
        </a>
        <a href="/backoffice/statistik" class="nav-item <?php echo e(Request::is('backoffice/statistik') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">info</span>
            <span class="nav-label">About Us</span>
        </a>
        <a href="/backoffice/program" class="nav-item <?php echo e(Request::is('backoffice/program') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">school</span>
            <span class="nav-label">Academy</span>
        </a>
        <a href="/backoffice/branding" class="nav-item <?php echo e(Request::is('backoffice/branding') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">palette</span>
            <span class="nav-label">Logo DHS & Branding</span>
        </a>
        <a href="/backoffice/berita" class="nav-item <?php echo e(Request::is('backoffice/berita') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">article</span>
            <span class="nav-label">News</span>
        </a>
        <a href="/backoffice/faq" class="nav-item <?php echo e(Request::is('backoffice/faq') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">quiz</span>
            <span class="nav-label">FAQ</span>
        </a>
        <a href="/backoffice/partner" class="nav-item <?php echo e(Request::is('backoffice/partner') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">handshake</span>
            <span class="nav-label">Partner</span>
        </a>
        <a href="/backoffice/admisi" class="nav-item <?php echo e(Request::is('backoffice/admisi') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">assignment</span>
            <span class="nav-label">Registration Form</span>
        </a>
        <a href="/backoffice/pendaftar" class="nav-item <?php echo e(Request::is('backoffice/pendaftar') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">how_to_reg</span>
            <span class="nav-label">Data Pendaftar</span>
        </a>

        <div class="nav-group-label">Konten Tambahan</div>
        <a href="/backoffice/testimoni" class="nav-item <?php echo e(Request::is('backoffice/testimoni') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">format_quote</span>
            <span class="nav-label">Testimoni</span>
        </a>

        <div class="nav-group-label">Pengaturan System</div>
        <a href="/backoffice/navigasi" class="nav-item <?php echo e(Request::is('backoffice/navigasi') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">menu</span>
            <span class="nav-label">Navigasi & Menu</span>
        </a>
        <a href="/backoffice/footer-cms" class="nav-item <?php echo e(Request::is('backoffice/footer-cms') ? 'active' : ''); ?>">
            <span class="material-icons-round mat-icon">web</span>
            <span class="nav-label">Footer</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="/backoffice/logout" method="POST" onsubmit="return confirm('Yakin ingin logout?')">
            <?php echo csrf_field(); ?>
            <button type="submit" class="nav-item" style="margin:0;background:none;border:none;cursor:pointer;width:100%;text-align:left;">
                <span class="material-icons-round mat-icon">logout</span>
                <span class="nav-label">Logout</span>
            </button>
        </form>
    </div>
</aside>
<?php /**PATH D:\laragon\www\DHS\resources\views/backoffice/partials/sidebar.blade.php ENDPATH**/ ?>