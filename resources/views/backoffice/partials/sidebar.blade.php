<aside id="bo-sidebar">
    <div class="sidebar-logo">
        @php $sidebarLogo = \App\Models\BrandingSetting::where('setting_key', 'logo_primary')->value('setting_value') ?? ''; @endphp
        @if($sidebarLogo)
            <img src="{{ asset(ltrim($sidebarLogo, '/')) }}" alt="DHS Logo" class="sidebar-logo-img">
        @else
            <img src="{{ asset('image/LogoDHS_2.jpeg') }}" alt="DHS Logo" class="sidebar-logo-img">
        @endif
        <div class="logo-text">Denpasar<br>Hotel School</div>
    </div>

    @php $currentRole = session('backoffice_user.role', ''); @endphp
    <nav class="sidebar-nav">
        @if($currentRole !== 'finance')
        <div class="nav-group-label">Utama</div>
        <a href="/backoffice/dashboard" class="nav-item {{ Request::is('backoffice/dashboard') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">dashboard</span>
            <span class="nav-label">Dashboard</span>
        </a>

        <div class="nav-group-label">Modul Utama</div>
        <a href="/backoffice/beranda" class="nav-item {{ Request::is('backoffice/beranda') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">home</span>
            <span class="nav-label">Home</span>
        </a>
        <a href="/backoffice/statistik" class="nav-item {{ Request::is('backoffice/statistik') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">info</span>
            <span class="nav-label">About Us</span>
        </a>
        <a href="/backoffice/program-tarif" class="nav-item {{ Request::is('backoffice/program-tarif*') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">price_change</span>
            <span class="nav-label">Atur Harga Program</span>
        </a>
        <a href="/backoffice/program" class="nav-item {{ Request::is('backoffice/program') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">school</span>
            <span class="nav-label">Editor Landing Academy</span>
        </a>
        <a href="/backoffice/program-detail" class="nav-item {{ Request::is('backoffice/program-detail*') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">auto_stories</span>
            <span class="nav-label">Editor Halaman Program</span>
        </a>
        <a href="/backoffice/branding" class="nav-item {{ Request::is('backoffice/branding') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">palette</span>
            <span class="nav-label">Logo DHS & Branding</span>
        </a>
        <a href="/backoffice/berita" class="nav-item {{ Request::is('backoffice/berita') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">article</span>
            <span class="nav-label">News</span>
        </a>
        <a href="/backoffice/faq" class="nav-item {{ Request::is('backoffice/faq') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">quiz</span>
            <span class="nav-label">FAQ</span>
        </a>
        <a href="/backoffice/partner" class="nav-item {{ Request::is('backoffice/partner') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">handshake</span>
            <span class="nav-label">Partner</span>
        </a>
        <a href="/backoffice/admisi" class="nav-item {{ Request::is('backoffice/admisi') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">assignment</span>
            <span class="nav-label">Registration Form</span>
        </a>
        <a href="/backoffice/pendaftar" class="nav-item {{ Request::is('backoffice/pendaftar') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">how_to_reg</span>
            <span class="nav-label">Data Pendaftar</span>
        </a>
        <a href="/backoffice/layanan" class="nav-item {{ Request::is('backoffice/layanan') && !Request::is('backoffice/layanan-settings') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">folder_shared</span>
            <span class="nav-label">Data Pengajuan Layanan</span>
        </a>
        <a href="/backoffice/layanan-settings" class="nav-item {{ Request::is('backoffice/layanan-settings') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">tune</span>
            <span class="nav-label">Editor Isian Form</span>
        </a>

        <div class="nav-group-label">Konten Tambahan</div>
        <a href="/backoffice/testimoni" class="nav-item {{ Request::is('backoffice/testimoni') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">format_quote</span>
            <span class="nav-label">Testimoni</span>
        </a>

        <div class="nav-group-label">Layanan & Beasiswa</div>
        <a href="/backoffice/layanan" class="nav-item {{ Request::is('backoffice/layanan') && !Request::is('backoffice/layanan-settings') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">manage_search</span>
            <span class="nav-label">Kelola Beasiswa & Dokumen</span>
        </a>

        <div class="nav-group-label">Dokumen Sertifikasi</div>
        <a href="/backoffice/dokumen-sertifikasi" class="nav-item {{ Request::is('backoffice/dokumen-sertifikasi') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">folder_special</span>
            <span class="nav-label">Semua Dokumen (7 CMS)</span>
        </a>
        <a href="/backoffice/dokumen-sertifikasi/passport" class="nav-item {{ Request::is('backoffice/dokumen-sertifikasi/passport') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">card_travel</span>
            <span class="nav-label">Passport & Buku Pelaut</span>
        </a>
        <a href="/backoffice/dokumen-sertifikasi/bst" class="nav-item {{ Request::is('backoffice/dokumen-sertifikasi/bst') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">anchor</span>
            <span class="nav-label">BST (Basic Safety)</span>
        </a>
        <a href="/backoffice/dokumen-sertifikasi/sdsd" class="nav-item {{ Request::is('backoffice/dokumen-sertifikasi/sdsd') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">security</span>
            <span class="nav-label">SDSD (Security Duties)</span>
        </a>
        <a href="/backoffice/dokumen-sertifikasi/ccm" class="nav-item {{ Request::is('backoffice/dokumen-sertifikasi/ccm') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">groups</span>
            <span class="nav-label">CCM (Crowd & Crisis)</span>
        </a>
        <a href="/backoffice/dokumen-sertifikasi/ssat" class="nav-item {{ Request::is('backoffice/dokumen-sertifikasi/ssat') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">verified_user</span>
            <span class="nav-label">SSAT (Security Aware)</span>
        </a>
        <a href="/backoffice/dokumen-sertifikasi/pscrb" class="nav-item {{ Request::is('backoffice/dokumen-sertifikasi/pscrb') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">sailing</span>
            <span class="nav-label">PSCRB (Survival Craft)</span>
        </a>
        <a href="/backoffice/dokumen-sertifikasi/c1d-visa" class="nav-item {{ Request::is('backoffice/dokumen-sertifikasi/c1d-visa') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">badge</span>
            <span class="nav-label">C1/D Visa (US Seaman)</span>
        </a>

        @endif

        @if(in_array($currentRole, ['super_admin', 'finance']))
        <div class="nav-group-label">Manajemen Keuangan</div>
        <a href="/backoffice/kas" class="nav-item {{ Request::is('backoffice/kas') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">account_balance_wallet</span>
            <span class="nav-label">Keuangan Umum</span>
        </a>
        <a href="/backoffice/kas-keuangan-program" class="nav-item {{ Request::is('backoffice/kas-keuangan-program*') || Request::is('backoffice/kas-program-detail*') || Request::is('backoffice/kas-kategori-kas*') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">folder_open</span>
            <span class="nav-label">Keuangan Program</span>
        </a>
        @if(in_array($currentRole, ['super_admin', 'finance']))
        <a href="/backoffice/program-kategori" class="nav-item {{ Request::is('backoffice/program-kategori*') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">account_tree</span>
            <span class="nav-label">Kategori &amp; Program</span>
        </a>
        @endif
        <a href="/backoffice/kas-kategori" class="nav-item {{ Request::is('backoffice/kas-kategori*') && !Request::is('backoffice/kas-kategori-kas*') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">category</span>
            <span class="nav-label">Kategori</span>
        </a>
        @endif

        @if($currentRole !== 'finance')
        <div class="nav-group-label">Pengaturan System</div>
        <a href="/backoffice/navigasi" class="nav-item {{ Request::is('backoffice/navigasi') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">menu</span>
            <span class="nav-label">Navigasi & Menu</span>
        </a>
        <a href="/backoffice/footer-cms" class="nav-item {{ Request::is('backoffice/footer-cms') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">web</span>
            <span class="nav-label">Footer</span>
        </a>
        @endif

        @if($currentRole === 'super_admin')
        <div class="nav-group-label">Akses Super Admin</div>
        <a href="/backoffice/users" class="nav-item {{ Request::is('backoffice/users*') ? 'active' : '' }}">
            <span class="material-icons-round mat-icon">manage_accounts</span>
            <span class="nav-label">Kelola Akun</span>
        </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        <button type="button" class="nav-item" style="margin:0;background:none;border:none;cursor:pointer;width:100%;text-align:left;" onclick="openLogoutModal()" aria-label="Logout">
            <span class="material-icons-round mat-icon">logout</span>
            <span class="nav-label">Logout</span>
        </button>
    </div>
</aside>
