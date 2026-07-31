<nav id="main-nav"
    class="fixed w-full z-50 py-5 px-8 md:px-16 flex justify-between items-center nav-transparent relative">

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
            class="h-10 md:h-11 lg:h-12 w-auto object-contain shrink-0"
            style="max-height: 46px; width: auto; aspect-ratio: auto; image-rendering: -webkit-optimize-contrast;">
    </a>

    <!-- ── Right Menu: Berita, FAQ, Formulir Pendaftaran ── -->
    <div class="hidden md:flex items-center justify-end space-x-8 text-xs font-light tracking-wide flex-1">
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('berita') ? 'nav-link-active' : '' }}"
            href="/berita"><span data-id="Berita" data-en="News">Berita</span></a>
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('faq') ? 'nav-link-active' : '' }}"
            href="/faq"><span data-id="FAQ" data-en="FAQ">FAQ</span></a>
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('formulir-pendaftaran') ? 'nav-link-active' : '' }}"
            href="/formulir-pendaftaran"><span data-id="Formulir Pendaftaran" data-en="Registration Form">Formulir
                Pendaftaran</span></a>
    </div>

    <!-- ── Mobile Menu Toggle Button (Mobile Only) ── -->
    <button class="md:hidden focus:outline-none nav-link ml-auto" onclick="toggleMobileMenu()">
        <span class="material-icons">menu</span>
    </button>

</nav>

<!-- ── Mobile Menu Dropdown ── -->
<div id="mobile-menu"
    class="fixed top-[73px] left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-b border-black/10 hidden flex-col px-8 py-6 space-y-4 md:hidden shadow-lg">
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2 border-b border-black/5"
        href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2 border-b border-black/5"
        href="/tentang-kami"><span data-id="Tentang Kami" data-en="About Us">Tentang Kami</span></a>
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2 border-b border-black/5"
        href="/akademi"><span data-id="Akademi" data-en="Academy">Akademi</span></a>
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2 border-b border-black/5"
        href="/berita"><span data-id="Berita" data-en="News">Berita</span></a>
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2 border-b border-black/5"
        href="/faq"><span data-id="FAQ" data-en="FAQ">FAQ</span></a>
    <a class="text-sm font-medium text-text-light hover:text-primary transition-colors py-2"
        href="/formulir-pendaftaran"><span data-id="Formulir Pendaftaran" data-en="Registration Form">Formulir
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
        background: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: none;
    }

    .nav-transparent .nav-logo,
    .nav-transparent .nav-link {
        color: #ffffff;
    }

    .nav-transparent .nav-link-active {
        border-bottom: 2px solid rgba(255, 255, 255, 0.9);
        padding-bottom: 4px;
        color: #ffffff;
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
        color: #1A1F6B;
    }

    .nav-glass .nav-link-active {
        border-bottom: 2px solid #D4302A;
        padding-bottom: 4px;
        color: #D4302A;
    }
</style>

<script>
    /* ─── Mobile menu toggle ─── */
    function toggleMobileMenu() {
        var menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');
    }

</script>