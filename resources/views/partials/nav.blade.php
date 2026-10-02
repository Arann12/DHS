<nav id="main-nav"
    class="fixed w-full z-50 py-3 sm:py-5 px-4 sm:px-8 md:px-16 flex justify-between items-center nav-transparent relative">

    <!-- ── Left Menu: Beranda, Tentang Kami, Akademi ── -->
    <div class="hidden md:flex items-center justify-start space-x-8 text-xs font-light tracking-wide flex-1">
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('/') ? 'nav-link-active' : '' }}"
            href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('tentang-kami') ? 'nav-link-active' : '' }}"
            href="/tentang-kami"><span data-id="Tentang Kami" data-en="About Us">Tentang Kami</span></a>
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('akademi') ? 'nav-link-active' : '' }}"
            href="/akademi"><span data-id="Akademi" data-en="Academy">Akademi</span></a>
    </div>

    <!-- ── Centered Logo (Absolute 50% Centered) ── -->
    <a class="nav-logo absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center focus:outline-none transition-transform hover:scale-105"
        href="/">
        <img src="{{ isset($navLogo) ? asset(ltrim($navLogo, '/')) : asset('image/LogoDHS.png') }}" alt="Logo DHS"
            class="h-8 sm:h-9 md:h-11 lg:h-12 w-auto object-contain shrink-0"
            style="max-height: 46px; width: auto; aspect-ratio: auto; image-rendering: -webkit-optimize-contrast;">
    </a>

    <!-- ── Right Menu: Berita, FAQ, Layanan, Formulir Pendaftaran ── -->
    <div class="hidden md:flex items-center justify-end space-x-6 lg:space-x-8 text-xs font-light tracking-wide flex-1">
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('layanan*') || Request::is('pengajuan*') ? 'nav-link-active' : '' }}"
            href="/layanan"><span data-id="Layanan" data-en="Services">Layanan</span></a>
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('berita') ? 'nav-link-active' : '' }}"
            href="/berita"><span data-id="Berita" data-en="News">Berita</span></a>
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('faq') ? 'nav-link-active' : '' }}"
            href="/faq"><span data-id="FAQ" data-en="FAQ">FAQ</span></a>
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('formulir-pendaftaran') ? 'nav-link-active' : '' }}"
            href="/formulir-pendaftaran"><span data-id="Formulir Pendaftaran" data-en="Registration Form">Formulir
                Pendaftaran</span></a>
    </div>

    <!-- ── Mobile Menu Toggle Button (Mobile Only) ── -->
    <button id="mobile-menu-btn" type="button" class="md:hidden focus:outline-none nav-link ml-auto p-2"
        onclick="toggleMobileMenu()" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="mobile-menu">
        <span id="mobile-menu-icon" class="material-icons text-2xl">menu</span>
    </button>

</nav>

<!-- ── Mobile Menu Dropdown ──
     Positioning + visibility via CSS below (not Tailwind utilities) so the menu
     always shows above page content even if arbitrary-value classes are purged. -->
<div id="mobile-menu" class="px-4 sm:px-8 py-6 space-y-4 md:hidden shadow-lg" hidden>
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2 border-b border-black/5"
        href="/" onclick="closeMobileMenu()"><span data-id="Beranda" data-en="Home">Beranda</span></a>
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2 border-b border-black/5"
        href="/tentang-kami" onclick="closeMobileMenu()"><span data-id="Tentang Kami" data-en="About Us">Tentang Kami</span></a>
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2 border-b border-black/5"
        href="/akademi" onclick="closeMobileMenu()"><span data-id="Akademi" data-en="Academy">Akademi</span></a>
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2 border-b border-black/5"
        href="/layanan" onclick="closeMobileMenu()"><span data-id="Layanan" data-en="Services">Layanan Pengajuan</span></a>
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2 border-b border-black/5"
        href="/berita" onclick="closeMobileMenu()"><span data-id="Berita" data-en="News">Berita</span></a>
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2 border-b border-black/5"
        href="/faq" onclick="closeMobileMenu()"><span data-id="FAQ" data-en="FAQ">FAQ</span></a>
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2"
        href="/formulir-pendaftaran" onclick="closeMobileMenu()"><span data-id="Formulir Pendaftaran" data-en="Registration Form">Formulir
            Pendaftaran</span></a>
</div>


<style>
    /* Base style for sticky nav */
    #main-nav {
        position: fixed !important;
        width: 100%;
        left: 0;
        top: 0;
        z-index: 50;
        transition: background 0.4s cubic-bezier(0.25, 1, 0.5, 1),
            backdrop-filter 0.4s cubic-bezier(0.25, 1, 0.5, 1),
            -webkit-backdrop-filter 0.4s cubic-bezier(0.25, 1, 0.5, 1),
            border-color 0.4s cubic-bezier(0.25, 1, 0.5, 1),
            box-shadow 0.4s cubic-bezier(0.25, 1, 0.5, 1),
            padding 0.35s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }

    /* ── Transparent state (above hero / initial state) ── */
    .nav-transparent {
        background: linear-gradient(to bottom, rgba(15, 23, 42, 0.45) 0%, rgba(15, 23, 42, 0) 100%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: none;
    }

    /* When mobile menu is open, make nav fully opaque so gradient doesn't bleed through menu */
    #main-nav.menu-open {
        background: rgba(15, 23, 42, 0.95) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .nav-transparent .nav-logo,
    .nav-transparent .nav-link {
        color: #ffffff;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
    }

    .nav-transparent .nav-link-active {
        border-bottom: 2px solid rgba(255, 255, 255, 0.9);
        padding-bottom: 4px;
        color: #ffffff;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.7);
    }


    /* ── Glass state (scrolled / active sticky) ── */
    .nav-glass {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(24px) saturate(1.7);
        -webkit-backdrop-filter: blur(24px) saturate(1.7);
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        padding-top: 0.8rem;
        padding-bottom: 0.8rem;
    }

    .nav-glass .nav-logo,
    .nav-glass .nav-link {
        color: #1A365D;
    }

    .nav-glass .nav-link-active {
        border-bottom: 2px solid #C53030;
        padding-bottom: 4px;
        color: #C53030;
    }

    @media (max-height: 500px) and (orientation: landscape) {
        #main-nav { padding-top: 0.4rem; padding-bottom: 0.4rem; }
        .nav-logo img { height: 28px !important; }
    }

    /* ── Mobile menu: own CSS so it never depends on Tailwind utility build ──
       z-index must beat page content (hero uses position:relative; fixed with
       z-index:auto paints below later positioned siblings → menu "invisible"). */
    #mobile-menu {
        display: none;
        position: fixed;
        top: 56px;
        left: 0;
        right: 0;
        z-index: 60;
        background: #ffffff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        max-height: calc(100vh - 56px);
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }

    #mobile-menu.is-open {
        display: flex;
        flex-direction: column;
    }

    @media (min-width: 640px) {
        #mobile-menu {
            top: 73px;
            max-height: calc(100vh - 73px);
        }
    }

    @media (min-width: 768px) {
        #mobile-menu,
        #mobile-menu.is-open {
            display: none !important;
        }
    }
</style>

<script>
    /* ─── Mobile menu toggle ─── */
    function setMobileMenu(open) {
        var menu = document.getElementById('mobile-menu');
        var nav = document.getElementById('main-nav');
        var icon = document.getElementById('mobile-menu-icon');
        var btn = document.getElementById('mobile-menu-btn');
        if (!menu) return;
        menu.classList.toggle('is-open', !!open);
        if (open) menu.removeAttribute('hidden');
        else menu.setAttribute('hidden', '');
        if (nav) nav.classList.toggle('menu-open', !!open);
        if (icon) icon.textContent = open ? 'close' : 'menu';
        if (btn) btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        document.body.style.overflow = open ? 'hidden' : '';
    }
    function isMobileMenuOpen() {
        var menu = document.getElementById('mobile-menu');
        return !!(menu && menu.classList.contains('is-open'));
    }
    function toggleMobileMenu() {
        setMobileMenu(!isMobileMenuOpen());
    }
    function closeMobileMenu() {
        setMobileMenu(false);
    }
</script>