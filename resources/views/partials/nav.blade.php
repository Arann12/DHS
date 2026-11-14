<nav id="main-nav"
    class="fixed top-0 left-0 right-0 w-full z-50 py-3 sm:py-5 px-4 sm:px-8 md:px-16 flex justify-between items-center nav-transparent">

    <!-- ── Left Menu: Beranda, Tentang Kami, Akademi, Layanan ── -->
    <div class="hidden md:flex items-center justify-start space-x-8 text-xs font-light tracking-wide flex-1">
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('/') ? 'nav-link-active' : '' }}"
            href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('tentang-kami') ? 'nav-link-active' : '' }}"
            href="/tentang-kami"><span data-id="Tentang Kami" data-en="About Us">Tentang Kami</span></a>
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('akademi') ? 'nav-link-active' : '' }}"
            href="/akademi"><span data-id="Akademi" data-en="Academy">Akademi</span></a>
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('layanan*') || Request::is('pengajuan*') ? 'nav-link-active' : '' }}"
            href="/layanan"><span data-id="Layanan" data-en="Services">Layanan</span></a>
    </div>

    <!-- ── Centered Logo (Absolute 50% Centered) ── -->
    <a class="nav-logo absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center focus:outline-none transition-transform hover:scale-105"
        href="/">
        <img src="{{ isset($navLogo) ? asset(ltrim($navLogo, '/')) : asset('image/LogoDHS.png') }}" alt="Logo DHS"
            class="h-8 sm:h-9 md:h-11 lg:h-12 w-auto object-contain shrink-0"
            style="max-height: 46px; width: auto; aspect-ratio: auto; image-rendering: -webkit-optimize-contrast;">
    </a>

    <!-- ── Right Menu: Berita, FAQ, Formulir Pendaftaran, Language ── -->
    <div class="hidden md:flex items-center justify-end space-x-6 lg:space-x-8 text-xs font-light tracking-wide flex-1">
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('berita') ? 'nav-link-active' : '' }}"
            href="/berita"><span data-id="Berita" data-en="News">Berita</span></a>
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('faq') ? 'nav-link-active' : '' }}"
            href="/faq"><span data-id="FAQ" data-en="FAQ">FAQ</span></a>
        <a class="nav-link hover:opacity-70 transition-opacity {{ Request::is('formulir-pendaftaran') ? 'nav-link-active' : '' }}"
            href="/formulir-pendaftaran"><span data-id="Formulir Pendaftaran" data-en="Registration Form">Formulir
                Pendaftaran</span></a>

        <!-- Language Dropdown -->
        <div class="relative" id="nav-lang-switcher">
            <button class="nav-link hover:opacity-70 transition-opacity flex items-center gap-1" onclick="toggleNavLangMenu(event)">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12.87 15.07l-2.54-2.51.03-.03A17.52 17.52 0 0014.07 6H17V4h-7V2H8v2H1v2h11.17C11.5 7.92 10.44 9.75 9 11.35 8.07 10.32 7.3 9.19 6.69 8h-2c.73 1.63 1.73 3.17 2.98 4.56l-5.09 5.02L4 19l5-5 3.11 3.11.76-2.04M18.5 10h-2L12 22h2l1.12-3h4.75L21 22h2l-4.5-12m-2.62 7l1.62-4.33L19.12 17h-3.24z"/>
                </svg>
                <span>ID</span>
            </button>
            <div id="nav-lang-menu" class="nav-lang-menu">
                <button onclick="switchLang('id')"><img src="https://flagcdn.com/w20/id.png" alt="ID" class="nav-lang-flag"> Indonesia</button>
                <button onclick="switchLang('en')"><img src="https://flagcdn.com/w20/gb.png" alt="EN" class="nav-lang-flag"> English</button>
                <button onclick="switchLang('ja')"><img src="https://flagcdn.com/w20/jp.png" alt="JA" class="nav-lang-flag"> 日本語</button>
                <button onclick="switchLang('ko')"><img src="https://flagcdn.com/w20/kr.png" alt="KO" class="nav-lang-flag"> 한국어</button>
                <button onclick="switchLang('zh-CN')"><img src="https://flagcdn.com/w20/cn.png" alt="ZH" class="nav-lang-flag"> 中文</button>
                <button onclick="switchLang('ar')"><img src="https://flagcdn.com/w20/sa.png" alt="AR" class="nav-lang-flag"> العربية</button>
                <button onclick="switchLang('fr')"><img src="https://flagcdn.com/w20/fr.png" alt="FR" class="nav-lang-flag"> Français</button>
                <button onclick="switchLang('de')"><img src="https://flagcdn.com/w20/de.png" alt="DE" class="nav-lang-flag"> Deutsch</button>
                <button onclick="switchLang('es')"><img src="https://flagcdn.com/w20/es.png" alt="ES" class="nav-lang-flag"> Español</button>
                <button onclick="switchLang('it')"><img src="https://flagcdn.com/w20/it.png" alt="IT" class="nav-lang-flag"> Italiano</button>
                <button onclick="switchLang('pt')"><img src="https://flagcdn.com/w20/pt.png" alt="PT" class="nav-lang-flag"> Português</button>
                <button onclick="switchLang('ru')"><img src="https://flagcdn.com/w20/ru.png" alt="RU" class="nav-lang-flag"> Русский</button>
                <button onclick="switchLang('th')"><img src="https://flagcdn.com/w20/th.png" alt="TH" class="nav-lang-flag"> ไทย</button>
                <button onclick="switchLang('vi')"><img src="https://flagcdn.com/w20/vn.png" alt="VI" class="nav-lang-flag"> Tiếng Việt</button>
                <button onclick="switchLang('ms')"><img src="https://flagcdn.com/w20/my.png" alt="MS" class="nav-lang-flag"> Bahasa Melayu</button>
                <button onclick="switchLang('tl')"><img src="https://flagcdn.com/w20/ph.png" alt="TL" class="nav-lang-flag"> Filipino</button>
                <button onclick="switchLang('hi')"><img src="https://flagcdn.com/w20/in.png" alt="HI" class="nav-lang-flag"> हिन्दी</button>
                <button onclick="switchLang('nl')"><img src="https://flagcdn.com/w20/nl.png" alt="NL" class="nav-lang-flag"> Nederlands</button>
            </div>
        </div>
    </div>

    <!-- ── Mobile Menu Toggle Button (Mobile Only) ── -->
    <button id="mobile-menu-btn" type="button"
        class="md:hidden focus:outline-none ml-auto w-10 h-10 rounded-full flex items-center justify-center border transition-all duration-300 cursor-pointer"
        onclick="toggleMobileMenu()" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="mobile-menu">
        <span id="mobile-menu-icon" class="material-icons text-2xl transition-transform duration-300">menu</span>
    </button>

</nav>

<!-- ── 10x COOLER LUXURY MOBILE NAVIGATION DRAWER ── -->
<div id="mobile-menu" class="md:hidden" hidden>
    {{-- Ambient Liquid Dark Luxury Lighting --}}
    <div class="dhs-mobile-glow-top"></div>
    <div class="dhs-mobile-glow-bottom"></div>

    <div class="dhs-mobile-menu-inner relative z-10 flex flex-col justify-between min-h-full px-4 sm:px-6 py-5">
        <div>
            {{-- Top Branding Micro Header --}}
            <div class="flex items-center justify-between pb-3.5 mb-3 border-b border-white/10 shrink-0 dhs-mobile-item">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: #C5A880;"></span>
                    <span class="text-[0.68rem] tracking-[0.22em] uppercase font-bold" style="color: #E5C397;">
                        DENPASAR HOTEL SCHOOL
                    </span>
                </div>
                <span class="text-[0.6rem] font-mono tracking-widest text-slate-300 uppercase px-2 py-0.5 rounded-full border border-white/10" style="background: rgba(255, 255, 255, 0.05);">
                    BALI CAMPUS
                </span>
            </div>

            {{-- Navigation Cards (01 - 06) --}}
            <div class="space-y-2">
                {{-- 01. Beranda --}}
                <a href="/" onclick="closeMobileMenu()"
                   class="dhs-mobile-nav-card dhs-mobile-item group {{ Request::is('/') ? 'active' : '' }}">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="dhs-nav-icon-box">
                            <span class="material-icons text-lg">explore</span>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="dhs-nav-index">01</span>
                                <span class="dhs-nav-title" data-id="Beranda" data-en="Home">Beranda</span>
                            </div>
                            <p class="dhs-nav-desc">Ikhtisar Kampus & Keunggulan</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        @if(Request::is('/'))
                        <span class="dhs-active-chip">AKTIF</span>
                        @endif
                        <span class="material-icons dhs-nav-arrow">chevron_right</span>
                    </div>
                </a>

                {{-- 02. Tentang Kami --}}
                <a href="/tentang-kami" onclick="closeMobileMenu()"
                   class="dhs-mobile-nav-card dhs-mobile-item group {{ Request::is('tentang-kami*') ? 'active' : '' }}">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="dhs-nav-icon-box">
                            <span class="material-icons text-lg">corporate_fare</span>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="dhs-nav-index">02</span>
                                <span class="dhs-nav-title" data-id="Tentang Kami" data-en="About Us">Tentang Kami</span>
                            </div>
                            <p class="dhs-nav-desc">Profil, Visi, Misi & Milestone</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        @if(Request::is('tentang-kami*'))
                        <span class="dhs-active-chip">AKTIF</span>
                        @endif
                        <span class="material-icons dhs-nav-arrow">chevron_right</span>
                    </div>
                </a>

                {{-- 03. Akademi --}}
                <a href="/akademi" onclick="closeMobileMenu()"
                   class="dhs-mobile-nav-card dhs-mobile-item group {{ Request::is('akademi*') ? 'active' : '' }}">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="dhs-nav-icon-box">
                            <span class="material-icons text-lg">school</span>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="dhs-nav-index">03</span>
                                <span class="dhs-nav-title" data-id="Akademi" data-en="Academy">Akademi</span>
                            </div>
                            <p class="dhs-nav-desc">Program Studi Perhotelan & Kapal Pesiar</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        @if(Request::is('akademi*'))
                        <span class="dhs-active-chip">AKTIF</span>
                        @endif
                        <span class="material-icons dhs-nav-arrow">chevron_right</span>
                    </div>
                </a>

                {{-- 04. Layanan Pengajuan --}}
                <a href="/layanan" onclick="closeMobileMenu()"
                   class="dhs-mobile-nav-card dhs-mobile-item group {{ Request::is('layanan*') || Request::is('pengajuan*') ? 'active' : '' }}">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="dhs-nav-icon-box">
                            <span class="material-icons text-lg">verified_user</span>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="dhs-nav-index">04</span>
                                <span class="dhs-nav-title" data-id="Layanan" data-en="Services">Layanan Pengajuan</span>
                            </div>
                            <p class="dhs-nav-desc">Legalitas, Surat & Layanan Mahasiswa</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        @if(Request::is('layanan*') || Request::is('pengajuan*'))
                        <span class="dhs-active-chip">AKTIF</span>
                        @endif
                        <span class="material-icons dhs-nav-arrow">chevron_right</span>
                    </div>
                </a>

                {{-- 05. Berita --}}
                <a href="/berita" onclick="closeMobileMenu()"
                   class="dhs-mobile-nav-card dhs-mobile-item group {{ Request::is('berita*') ? 'active' : '' }}">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="dhs-nav-icon-box">
                            <span class="material-icons text-lg">newspaper</span>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="dhs-nav-index">05</span>
                                <span class="dhs-nav-title" data-id="Berita" data-en="News">Berita & Informasi</span>
                            </div>
                            <p class="dhs-nav-desc">Prestasi, Agenda & Kabar Alumni</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        @if(Request::is('berita*'))
                        <span class="dhs-active-chip">AKTIF</span>
                        @endif
                        <span class="material-icons dhs-nav-arrow">chevron_right</span>
                    </div>
                </a>

                {{-- 06. FAQ --}}
                <a href="/faq" onclick="closeMobileMenu()"
                   class="dhs-mobile-nav-card dhs-mobile-item group {{ Request::is('faq*') ? 'active' : '' }}">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="dhs-nav-icon-box">
                            <span class="material-icons text-lg">help_outline</span>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="dhs-nav-index">06</span>
                                <span class="dhs-nav-title" data-id="FAQ" data-en="FAQ">FAQ & Bantuan</span>
                            </div>
                            <p class="dhs-nav-desc">Pertanyaan Seputar Kuliah & Karir</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        @if(Request::is('faq*'))
                        <span class="dhs-active-chip">AKTIF</span>
                        @endif
                        <span class="material-icons dhs-nav-arrow">chevron_right</span>
                    </div>
                </a>
            </div>

            {{-- Section 3: High-Converting VIP Admission Card --}}
            <div class="my-3 dhs-mobile-item">
                <a href="/formulir-pendaftaran" onclick="closeMobileMenu()"
                   class="dhs-mobile-cta-card group block p-3.5 rounded-2xl relative overflow-hidden transition-all duration-300 {{ Request::is('formulir-pendaftaran*') ? 'ring-2 ring-[#E5C397]' : '' }}">
                    <div class="dhs-cta-sheen"></div>
                    <div class="relative z-10 flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[0.6rem] font-bold tracking-wider uppercase bg-white/20 text-white backdrop-blur-md mb-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-300 animate-ping"></span>
                                <span>PMB 2026/2027 DIBUKA</span>
                            </div>
                            <h4 class="text-white font-serif font-bold text-sm sm:text-base tracking-tight leading-tight">
                                Formulir Pendaftaran Online
                            </h4>
                            <p class="text-white/80 text-[0.68rem] mt-0.5 leading-snug truncate">
                                Jalur Langsung Karir Hotel Bintang 5 & Kapal Pesiar
                            </p>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-white text-[#C53030] flex items-center justify-center shrink-0 shadow-lg group-hover:scale-110 group-active:scale-95 transition-all">
                            <span class="material-icons text-lg">arrow_forward</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Bottom Section: Language Selector + Quick Hotline --}}
        <div class="pt-3 border-t border-white/10 shrink-0 space-y-3 dhs-mobile-item">
            {{-- Quick Mobile Language Switcher --}}
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-[0.62rem] uppercase tracking-wider text-slate-400 font-semibold flex items-center gap-1">
                        <span class="material-icons text-xs" style="color: #E5C397;">translate</span>
                        <span>PILIH BAHASA / LANGUAGE</span>
                    </span>
                </div>
                <div class="grid grid-cols-4 gap-1.5">
                    <button type="button" onclick="switchLang('id'); closeMobileMenu();" class="dhs-lang-pill">
                        <img src="https://flagcdn.com/w20/id.png" alt="ID" class="w-4 h-2.5 rounded-xs object-cover" />
                        <span>ID</span>
                    </button>
                    <button type="button" onclick="switchLang('en'); closeMobileMenu();" class="dhs-lang-pill">
                        <img src="https://flagcdn.com/w20/gb.png" alt="EN" class="w-4 h-2.5 rounded-xs object-cover" />
                        <span>EN</span>
                    </button>
                    <button type="button" onclick="switchLang('ja'); closeMobileMenu();" class="dhs-lang-pill">
                        <img src="https://flagcdn.com/w20/jp.png" alt="JA" class="w-4 h-2.5 rounded-xs object-cover" />
                        <span>JA</span>
                    </button>
                    <button type="button" onclick="switchLang('ko'); closeMobileMenu();" class="dhs-lang-pill">
                        <img src="https://flagcdn.com/w20/kr.png" alt="KO" class="w-4 h-2.5 rounded-xs object-cover" />
                        <span>KO</span>
                    </button>
                </div>
            </div>

            {{-- 1-Tap Concierge Contact --}}
            <div class="grid grid-cols-2 gap-2">
                <a href="https://wa.me/6281246319966?text=Halo%20Denpasar%20Hotel%20School%2C%20saya%20ingin%20konsultasi%20pendaftaran"
                   target="_blank" rel="noopener"
                   class="flex items-center justify-center gap-2 py-2 px-3 rounded-xl border border-white/10 text-white text-xs font-medium transition-all active:scale-95"
                   style="background: rgba(255, 255, 255, 0.04);">
                    <svg class="w-3.5 h-3.5 text-emerald-400 shrink-0" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>WhatsApp</span>
                </a>
                <a href="tel:03665582998"
                   class="flex items-center justify-center gap-2 py-2 px-3 rounded-xl border border-white/10 text-white text-xs font-medium transition-all active:scale-95"
                   style="background: rgba(255, 255, 255, 0.04);">
                    <span class="material-icons text-sm" style="color: #E5C397;">phone</span>
                    <span>Hotline Kampus</span>
                </a>
            </div>

            <div class="text-center pb-2">
                <span class="text-[0.6rem] text-slate-400 font-mono tracking-wider">
                    SANUR, BALI • HOSPITALITY & CRUISE EXCELLENCE
                </span>
            </div>
        </div>
    </div>
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

    /* When mobile menu is open, make nav seamlessly connect with dark luxury drawer */
    #main-nav.menu-open {
        background: rgba(8, 13, 21, 0.98) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        border-bottom: 1px solid rgba(197, 168, 128, 0.2) !important;
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

    /* ─── Mobile Toggle Button Styling ─── */
    #mobile-menu-btn {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: #ffffff;
    }
    .nav-glass #mobile-menu-btn {
        background: rgba(15, 23, 42, 0.06);
        border: 1px solid rgba(15, 23, 42, 0.14);
        color: #1A365D;
    }
    #main-nav.menu-open #mobile-menu-btn {
        background: rgba(197, 168, 128, 0.2) !important;
        border-color: rgba(197, 168, 128, 0.5) !important;
        color: #E5C397 !important;
    }
    #mobile-menu-btn.active #mobile-menu-icon {
        transform: rotate(90deg);
    }

    /* ─── 10x Cooler Luxury Mobile Menu Drawer ─── */
    #mobile-menu {
        display: none;
        position: fixed;
        top: 56px;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 60;
        background: #080D15;
        height: calc(100dvh - 56px);
        max-height: calc(100dvh - 56px);
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        border-top: 1px solid rgba(197, 168, 128, 0.2);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.9);
        opacity: 0;
        transform: translateY(-8px);
        transition: opacity 0.28s cubic-bezier(0.16, 1, 0.3, 1), transform 0.28s cubic-bezier(0.16, 1, 0.3, 1);
    }

    #mobile-menu.is-open {
        display: flex;
        flex-direction: column;
        opacity: 1;
        transform: translateY(0);
    }

    @media (min-width: 640px) {
        #mobile-menu {
            top: 73px;
            height: calc(100dvh - 73px);
            max-height: calc(100dvh - 73px);
        }
    }

    @media (min-width: 768px) {
        #mobile-menu,
        #mobile-menu.is-open {
            display: none !important;
        }
    }

    /* Ambient Lighting for Mobile Menu */
    .dhs-mobile-glow-top {
        position: absolute;
        top: -60px;
        right: -40px;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(197, 168, 128, 0.18) 0%, transparent 70%);
        filter: blur(50px);
        pointer-events: none;
    }
    .dhs-mobile-glow-bottom {
        position: absolute;
        bottom: -50px;
        left: -30px;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(197, 48, 48, 0.15) 0%, transparent 70%);
        filter: blur(60px);
        pointer-events: none;
    }

    /* Staggered Item Cascading Animation */
    .dhs-mobile-item {
        opacity: 0;
        transform: translateY(12px);
        transition: opacity 0.32s cubic-bezier(0.16, 1, 0.3, 1), transform 0.32s cubic-bezier(0.16, 1, 0.3, 1);
    }
    #mobile-menu.is-open .dhs-mobile-item:nth-child(1) { transition-delay: 30ms; opacity: 1; transform: translateY(0); }
    #mobile-menu.is-open .dhs-mobile-item:nth-child(2) { transition-delay: 60ms; opacity: 1; transform: translateY(0); }
    #mobile-menu.is-open .dhs-mobile-item:nth-child(3) { transition-delay: 90ms; opacity: 1; transform: translateY(0); }
    #mobile-menu.is-open .dhs-mobile-item:nth-child(4) { transition-delay: 120ms; opacity: 1; transform: translateY(0); }
    #mobile-menu.is-open .dhs-mobile-item:nth-child(5) { transition-delay: 150ms; opacity: 1; transform: translateY(0); }
    #mobile-menu.is-open .dhs-mobile-item:nth-child(6) { transition-delay: 180ms; opacity: 1; transform: translateY(0); }

    /* Interactive Nav Card */
    .dhs-mobile-nav-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.65rem 0.85rem;
        border-radius: 1rem;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.07);
        text-decoration: none;
        transition: all 0.25s ease;
    }
    .dhs-mobile-nav-card:hover,
    .dhs-mobile-nav-card:active {
        background: rgba(255, 255, 255, 0.07);
        border-color: rgba(197, 168, 128, 0.35);
        transform: translateX(3px);
    }
    .dhs-mobile-nav-card.active {
        background: linear-gradient(90deg, rgba(197, 168, 128, 0.14) 0%, rgba(197, 168, 128, 0.03) 100%);
        border-color: rgba(197, 168, 128, 0.45);
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.35);
    }
    .dhs-nav-icon-box {
        width: 2.25rem;
        height: 2.25rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #C5A880;
        transition: all 0.25s ease;
    }
    .dhs-mobile-nav-card.active .dhs-nav-icon-box,
    .dhs-mobile-nav-card:hover .dhs-nav-icon-box {
        background: rgba(197, 168, 128, 0.2);
        border-color: rgba(197, 168, 128, 0.5);
        color: #E5C397;
    }
    .dhs-nav-index {
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        font-size: 0.65rem;
        font-weight: 700;
        color: #C5A880;
        letter-spacing: 0.15em;
    }
    .dhs-nav-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #ffffff;
        letter-spacing: 0.01em;
        transition: color 0.2s ease;
    }
    .dhs-mobile-nav-card.active .dhs-nav-title {
        color: #E5C397;
    }
    .dhs-nav-desc {
        font-size: 0.68rem;
        color: #94a3b8;
        line-height: 1.25;
        margin-top: 1px;
    }
    .dhs-nav-arrow {
        color: #64748b;
        font-size: 1.15rem !important;
        transition: transform 0.2s ease, color 0.2s ease;
    }
    .dhs-mobile-nav-card:hover .dhs-nav-arrow,
    .dhs-mobile-nav-card.active .dhs-nav-arrow {
        transform: translateX(2px);
        color: #E5C397;
    }
    .dhs-active-chip {
        font-size: 0.55rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        padding: 0.15rem 0.45rem;
        border-radius: 9999px;
        background: rgba(197, 168, 128, 0.25);
        color: #E5C397;
        border: 1px solid rgba(197, 168, 128, 0.5);
    }

    /* VIP CTA Card */
    .dhs-mobile-cta-card {
        background: linear-gradient(135deg, #A82020 0%, #C53030 45%, #C5A880 100%);
        border: 1px solid rgba(229, 195, 151, 0.4);
        box-shadow: 0 10px 25px rgba(197, 48, 48, 0.35);
    }
    .dhs-cta-sheen {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.2) 50%, transparent 100%);
        transform: translateX(-100%);
        animation: dhsCtaSheenMotion 5s infinite;
        pointer-events: none;
    }
    @keyframes dhsCtaSheenMotion {
        0%, 70% { transform: translateX(-100%); }
        85%, 100% { transform: translateX(100%); }
    }

    /* Language Pills */
    .dhs-lang-pill {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        padding: 0.4rem 0.5rem;
        border-radius: 0.6rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #cbd5e1;
        font-size: 0.72rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .dhs-lang-pill:hover,
    .dhs-lang-pill:active {
        background: rgba(197, 168, 128, 0.15);
        border-color: rgba(197, 168, 128, 0.4);
        color: #ffffff;
    }

    /* ── Navbar Language Dropdown ── */
    .nav-lang-menu {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        width: 180px;
        max-height: 320px;
        overflow-y: auto;
        padding: 4px 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-8px);
        transition: all 0.2s ease;
        z-index: 100;
    }
    .nav-lang-menu.nav-lang-show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .nav-lang-flag {
        width: 18px;
        height: 12px;
        border-radius: 2px;
        object-fit: cover;
        margin-right: 8px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        vertical-align: middle;
    }
    .nav-lang-menu button {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 8px 14px;
        border: none;
        background: none;
        text-align: left;
        font-size: 13px;
        font-family: 'Inter', sans-serif;
        color: #1A365D;
        cursor: pointer;
        transition: background 0.15s;
    }
    .nav-lang-menu button:hover {
        background: #F7FAFC;
    }
    .nav-lang-menu::-webkit-scrollbar {
        width: 4px;
    }
    .nav-lang-menu::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }
    /* Adjust dropdown position for glass nav */
    .nav-glass .nav-lang-menu {
        background: rgba(255,255,255,0.98);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
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
        if (btn) {
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
            btn.classList.toggle('active', !!open);
        }
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

    /* ─── Global Language Switcher ─── */
    window.switchLang = function(lang) {
        var combo = document.querySelector('#google_translate_element2 .goog-te-combo');
        if (combo) {
            combo.value = lang;
            combo.dispatchEvent(new Event('change'));
        }
    };

    /* ─── Navbar Language Dropdown ─── */
    function toggleNavLangMenu(e) {
        if (e) e.stopPropagation();
        var menu = document.getElementById('nav-lang-menu');
        if (menu) {
            menu.classList.toggle('nav-lang-show');
        }
    }
    // Close navbar lang dropdown when clicking outside
    document.addEventListener('click', function(e) {
        var switcher = document.getElementById('nav-lang-switcher');
        var menu = document.getElementById('nav-lang-menu');
        if (menu && switcher && !switcher.contains(e.target)) {
            menu.classList.remove('nav-lang-show');
        }
    });
</script>