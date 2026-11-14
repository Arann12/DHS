<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Denpasar Hotel School')</title>

    @php $favicon = \App\Models\BrandingSetting::where('setting_key', 'logo_favicon')->value('setting_value') ?? ''; @endphp
    @if($favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset(ltrim($favicon, '/')) }}">
    @else
        <link rel="icon" href="/favicon.ico">
    @endif

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ================================================================
            GLOBAL BASE STYLES
        ================================================================ */
        .label-text {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-weight: 600;
        }

        html {
            scroll-behavior: smooth;
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        body {
            background-color: #F7FAFC;
            color: #1A365D;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            width: 100%;
            max-width: 100%;
            margin: 0;
            /* Body is always visible — loader covers it instead */
            overflow: hidden;
            /* Android/Chrome + Google Translate often set these; pin full-bleed */
            left: 0 !important;
            right: 0 !important;
            position: relative;
        }

        body.page-ready {
            overflow-x: hidden;
            overflow-y: auto;
        }

        /* Keep page chrome full-bleed even if an ancestor gets transformed */
        main {
            width: 100%;
            max-width: 100%;
        }

        #main-nav {
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
        }

        /* ================================================================
            HOTEL-THEMED LOADING OVERLAY
        ================================================================ */
        #dhs-loader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            opacity: 1 !important;
            background-color: #1A365D;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 32px;
            transition: opacity 0.7s cubic-bezier(0.25, 1, 0.5, 1);
        }

        #dhs-loader.loader-hidden {
            opacity: 0 !important;
            pointer-events: none;
        }

        /* ── Marching Icon Row ── */
        .loader-icons {
            display: flex;
            align-items: flex-end;
            gap: 24px;
        }

        .loader-icon-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            animation: dhs-icon-bob 0.9s ease-in-out infinite alternate;
        }

        .loader-icon-wrap:nth-child(1) {
            animation-delay: 0s;
        }

        .loader-icon-wrap:nth-child(2) {
            animation-delay: 0.18s;
        }

        .loader-icon-wrap:nth-child(3) {
            animation-delay: 0.36s;
        }

        .loader-icon-wrap:nth-child(4) {
            animation-delay: 0.54s;
        }

        .loader-icon-wrap .material-icons {
            font-size: 2.2rem;
            color: #F7FAFC;
            opacity: 0.35;
            transition: opacity 0.3s;
        }

        /* Highlight the "active" icon in sequence */
        .loader-icon-wrap:nth-child(1) .material-icons {
            animation: dhs-icon-glow 3.6s ease-in-out infinite 0s;
        }

        .loader-icon-wrap:nth-child(2) .material-icons {
            animation: dhs-icon-glow 3.6s ease-in-out infinite 0.9s;
        }

        .loader-icon-wrap:nth-child(3) .material-icons {
            animation: dhs-icon-glow 3.6s ease-in-out infinite 1.8s;
        }

        .loader-icon-wrap:nth-child(4) .material-icons {
            animation: dhs-icon-glow 3.6s ease-in-out infinite 2.7s;
        }

        .loader-icon-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background-color: #C53030;
            opacity: 0;
        }

        .loader-icon-wrap:nth-child(1) .loader-icon-dot {
            animation: dhs-dot-appear 3.6s ease-in-out infinite 0s;
        }

        .loader-icon-wrap:nth-child(2) .loader-icon-dot {
            animation: dhs-dot-appear 3.6s ease-in-out infinite 0.9s;
        }

        .loader-icon-wrap:nth-child(3) .loader-icon-dot {
            animation: dhs-dot-appear 3.6s ease-in-out infinite 1.8s;
        }

        .loader-icon-wrap:nth-child(4) .loader-icon-dot {
            animation: dhs-dot-appear 3.6s ease-in-out infinite 2.7s;
        }

        /* ── Progress bar ── */
        .loader-line-wrap {
            width: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .loader-line-track {
            width: 100%;
            height: 1px;
            background: rgba(247, 250, 252, 0.15);
            position: relative;
            overflow: hidden;
        }

        .loader-line-fill {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #C53030, #F7FAFC);
            animation: dhs-line-progress 2.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .loader-label {
            font-size: 0.55rem;
            font-weight: 700;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            color: rgba(247, 250, 252, 0.45);
        }

        /* ── Wordmark ── */
        #dhs-loader .loader-wordmark {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            color: #F7FAFC;
            opacity: 0;
            transform: translateY(10px);
            animation: dhs-fade-up 0.8s cubic-bezier(0.25, 1, 0.5, 1) 0.15s forwards;
        }

        /* ── Keyframes ── */
        @keyframes dhs-icon-bob {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-10px);
            }
        }

        @keyframes dhs-icon-glow {

            0%,
            100% {
                opacity: 0.3;
                color: #F7FAFC;
            }

            25%,
            50% {
                opacity: 1;
                color: #C53030;
            }
        }

        @keyframes dhs-dot-appear {

            0%,
            100% {
                opacity: 0;
                transform: translateY(0);
            }

            25%,
            50% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes dhs-line-progress {
            0% {
                width: 0%;
            }

            40% {
                width: 55%;
            }

            70% {
                width: 80%;
            }

            100% {
                width: 100%;
            }
        }

        @keyframes dhs-fade-up {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animate only main element for slide-up on entry (so fixed nav is unaffected) */
        main {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.75s cubic-bezier(0.25, 1, 0.5, 1),
                transform 0.75s cubic-bezier(0.25, 1, 0.5, 1);
        }

        body.page-ready main {
            opacity: 1;
            transform: translateY(0);
        }

        /* Safe Navbar slide in transition (clears transform after rendering to preserve fixed context) */
        nav {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.75s cubic-bezier(0.25, 1, 0.5, 1) 0.15s,
                transform 0.75s cubic-bezier(0.25, 1, 0.5, 1) 0.15s,
                background 0.5s cubic-bezier(0.25, 1, 0.5, 1),
                backdrop-filter 0.5s cubic-bezier(0.25, 1, 0.5, 1),
                -webkit-backdrop-filter 0.5s cubic-bezier(0.25, 1, 0.5, 1),
                box-shadow 0.5s cubic-bezier(0.25, 1, 0.5, 1),
                padding 0.4s cubic-bezier(0.25, 1, 0.5, 1),
                border-color 0.5s cubic-bezier(0.25, 1, 0.5, 1) !important;
        }

        body.page-ready nav {
            opacity: 1;
            transform: none;
            /* remove transform context entirely */
        }

        #main-nav {
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1),
                        opacity 0.4s ease,
                        background 0.3s ease,
                        backdrop-filter 0.3s ease,
                        box-shadow 0.3s ease,
                        padding 0.3s ease !important;
            will-change: transform, opacity;
        }

        #main-nav.nav-hidden {
            transform: translateY(-115%) !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }

        /* ================================================================
            SCROLL REVEAL SYSTEM WITH ENHANCED FADE OUT
        ================================================================ */
        [data-reveal] {
            opacity: 0;
            transition-property: opacity, transform;
            transition-timing-function: cubic-bezier(0.25, 1, 0.5, 1);
            transition-duration: 0.95s;
        }

        [data-reveal="fade-up"] {
            transform: translateY(40px);
        }

        [data-reveal="fade-down"] {
            transform: translateY(-40px);
        }

        [data-reveal="fade-left"] {
            transform: translateX(40px);
        }

        [data-reveal="fade-right"] {
            transform: translateX(-40px);
        }

        [data-reveal="zoom-in"] {
            transform: scale(0.92);
        }

        [data-reveal="zoom-up"] {
            transform: scale(0.94) translateY(24px);
        }

        /* Entered / Active State (Faded In) */
        [data-reveal].is-visible {
            opacity: 1;
            transform: none;
        }

        /* Stagger delay utilities */
        [data-delay="100"] {
            transition-delay: 0.08s;
        }

        [data-delay="150"] {
            transition-delay: 0.12s;
        }

        [data-delay="200"] {
            transition-delay: 0.16s;
        }

        [data-delay="250"] {
            transition-delay: 0.20s;
        }

        [data-delay="300"] {
            transition-delay: 0.24s;
        }

        [data-delay="350"] {
            transition-delay: 0.28s;
        }

        [data-delay="400"] {
            transition-delay: 0.32s;
        }

        [data-delay="500"] {
            transition-delay: 0.40s;
        }

        [data-delay="600"] {
            transition-delay: 0.48s;
        }

        [data-delay="700"] {
            transition-delay: 0.56s;
        }

        /* ================================================================
            IMPROVED BUTTON HOVER & FADEIN ANIMATIONS
        ================================================================ */
        a.bg-primary,
        a.bg-dhs-navy,
        a.border,
        button[type="submit"],
        #lang-btn,
        .filter-tab-btn,
        .faq-cat-btn {
            transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1) !important;
            position: relative;
            overflow: hidden;
        }

        a.bg-primary:hover,
        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(163, 67, 67, 0.25);
            filter: brightness(1.05);
        }

        a.bg-dhs-navy:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(122, 51, 51, 0.2);
            filter: brightness(1.1);
        }

        a.border:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        /* ================================================================
            CARD HOVER LIFT
        ================================================================ */
        /* ================================================================
            CARD HOVER LIFT & LUXURY ACCENT
        ================================================================ */
        .card-hover {
            position: relative;
            transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1),
                box-shadow 0.45s cubic-bezier(0.16, 1, 0.3, 1),
                border-color 0.45s ease;
        }

        .card-hover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #C53030 0%, #C5A880 100%);
            transition: width 0.45s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
            z-index: 10;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -12px rgba(11, 26, 44, 0.12);
            border-color: rgba(197, 168, 128, 0.5) !important;
        }

        .card-hover:hover::after {
            width: 100%;
        }

        /* ================================================================
            PAGE TRANSITION LINK
        ================================================================ */
        body.page-leaving {
            opacity: 0 !important;
            transform: translateY(-12px);
            transition: opacity 0.35s cubic-bezier(0.25, 1, 0.5, 1),
                transform 0.35s cubic-bezier(0.25, 1, 0.5, 1) !important;
        }

        /* ================================================================
            PROSE CONTENT RESPONSIVE (Article/CMS Content)
        ================================================================ */
        .prose img,
        .prose video {
            max-width: 100% !important;
            height: auto !important;
            display: block;
        }

        .prose table {
            display: block;
            max-width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .prose iframe {
            max-width: 100%;
        }

        .prose pre {
            max-width: 100%;
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .prose {
                font-size: 15px;
            }
            .prose h1 { font-size: 1.75rem; }
            .prose h2 { font-size: 1.5rem; }
            .prose h3 { font-size: 1.25rem; }
        }

        /* ── Luxury Scroll Progress Bar ── */
        #dhs-scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 2.5px;
            width: 0%;
            background: linear-gradient(90deg, #C53030 0%, #C5A880 50%, #F3D9B1 100%);
            box-shadow: 0 0 10px rgba(197, 168, 128, 0.7), 0 0 4px rgba(197, 48, 48, 0.5);
            z-index: 99999;
            pointer-events: none;
            transition: width 0.06s ease-out;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-background-light text-text-light font-sans antialiased transition-colors">

    <!-- ░░ SCROLL PROGRESS INDICATOR ░░ -->
    <div id="dhs-scroll-progress" aria-hidden="true"></div>

    <!-- ░░ HOTEL-THEMED LOADING OVERLAY ░░ -->
    <div id="dhs-loader" role="status" aria-label="Loading Denpasar Hotel School">

        <!-- Marching hotel icons -->
        <div class="loader-icons">
            <div class="loader-icon-wrap">
                <span class="material-icons">hotel</span>
                <div class="loader-icon-dot"></div>
            </div>
            <div class="loader-icon-wrap">
                <span class="material-icons">restaurant</span>
                <div class="loader-icon-dot"></div>
            </div>
            <div class="loader-icon-wrap">
                <span class="material-icons">luggage</span>
                <div class="loader-icon-dot"></div>
            </div>
            <div class="loader-icon-wrap">
                <span class="material-icons">public</span>
                <div class="loader-icon-dot"></div>
            </div>
        </div>

        <!-- Progress line + label -->
        <div class="loader-line-wrap">
            <div class="loader-line-track">
                <div class="loader-line-fill"></div>
            </div>
            <div class="loader-label">Loading</div>
        </div>

        <!-- Brand wordmark -->
        <div class="loader-wordmark">Denpasar Hotel School</div>

    </div>

    @include('partials.nav')


    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Alpine.js for interactive components --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>

    <script>
        // Alpine.js testimonial slider component
        function testimonialSlider(totalSlides) {
            return {
                currentSlide: 0,
                totalSlides: totalSlides,
                autoplayInterval: null,
                progressInterval: null,
                progressPercent: 0,
                autoplayDuration: 5000,

                init() {
                    this.startAutoplay();
                },

                nextSlide() {
                    this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                    this.resetAutoplay();
                },

                prevSlide() {
                    this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                    this.resetAutoplay();
                },

                goToSlide(index) {
                    this.currentSlide = index;
                    this.resetAutoplay();
                },

                startAutoplay() {
                    var self = this;
                    this.progressPercent = 0;
                    var elapsed = 0;
                    var step = 100;
                    this.progressInterval = setInterval(function() {
                        elapsed += step;
                        self.progressPercent = (elapsed / self.autoplayDuration) * 100;
                        if (self.progressPercent >= 100) self.progressPercent = 100;
                    }, step);
                    this.autoplayInterval = setInterval(function() {
                        self.currentSlide = (self.currentSlide + 1) % self.totalSlides;
                        self.progressPercent = 0;
                        elapsed = 0;
                    }, this.autoplayDuration);
                },

                resetAutoplay() {
                    clearInterval(this.autoplayInterval);
                    clearInterval(this.progressInterval);
                    this.startAutoplay();
                },

                touchStartX: 0,
                handleTouchStart(e) {
                    this.touchStartX = e.touches[0].clientX;
                },
                handleTouchEnd(e) {
                    var diff = this.touchStartX - e.changedTouches[0].clientX;
                    if (Math.abs(diff) > 50) {
                        if (diff > 0) this.nextSlide();
                        else this.prevSlide();
                    }
                }
            };
        }

        // Alpine.js contact form component
        function contactForm() {
            return {
                formData: {
                    nama: '',
                    email: '',
                    kategori: '',
                    program: '',
                    pesan: ''
                },
                programsData: [],
                filteredPrograms: [],
                waNumber: '',

                initFromWindow() {
                    var d = window.__dhsContact || {};
                    this.programsData = (d.cats && d.cats.length > 0) ? d.cats : [
                        {
                            category_key: 'internasional',
                            category_name: 'Program Internasional',
                            programs: [
                                { id: '1', title: 'Program 1 Tahun + Ausbildung Jerman', duration: '1 Tahun + Ausbildung' },
                                { id: '2', title: 'Program 2 Tahun + 1 Semester TAFE Australia', duration: '2 Tahun + 1 Semester' },
                                { id: '3', title: 'TAFE Australia Pathway', duration: 'Pathway' },
                                { id: '4', title: 'THS Australia Pathway', duration: 'Pathway' },
                                { id: '5', title: 'Australia Short Course', duration: 'Short Course' },
                                { id: '6', title: 'Study Visit (Australia & Singapura)', duration: 'Study Visit' }
                            ]
                        },
                        {
                            category_key: '2-tahun',
                            category_name: 'Vokasi 2 Tahun',
                            programs: [
                                { id: '7', title: 'Perhotelan (FO & HK) — 2 Tahun', duration: '2 Tahun' },
                                { id: '8', title: 'Tata Boga (Culinary Art) — 2 Tahun', duration: '2 Tahun' },
                                { id: '9', title: 'Tata Hidangan (FBS & Bartender) — 2 Tahun', duration: '2 Tahun' }
                            ]
                        },
                        {
                            category_key: '1-tahun',
                            category_name: 'Vokasi 1 Tahun',
                            programs: [
                                { id: '10', title: 'Perhotelan (FO & HK) — 1 Tahun', duration: '1 Tahun' },
                                { id: '11', title: 'Tata Boga (Culinary Art) — 1 Tahun', duration: '1 Tahun' },
                                { id: '12', title: 'Tata Hidangan (FBS & Bartender) — 1 Tahun', duration: '1 Tahun' }
                            ]
                        },
                        {
                            category_key: '1-tahun-kapal-pesiar',
                            category_name: '1 Tahun Kapal Pesiar',
                            programs: [
                                { id: '13', title: 'Cook (Asisten Koki) — Kapal Pesiar', duration: '1 Tahun' },
                                { id: '14', title: 'Waiter & Bartender — Kapal Pesiar', duration: '1 Tahun' },
                                { id: '15', title: 'Hotel Steward — Kapal Pesiar', duration: '1 Tahun' }
                            ]
                        },
                        {
                            category_key: '6-bulan',
                            category_name: 'Short Course 6 Bulan',
                            programs: [
                                { id: '16', title: 'Short Course F&B Service & Bar', duration: '6 Bulan' },
                                { id: '17', title: 'Short Course Culinary Arts', duration: '6 Bulan' },
                                { id: '18', title: 'Short Course Housekeeping', duration: '6 Bulan' }
                            ]
                        },
                        {
                            category_key: 'eksekutif',
                            category_name: 'Program Eksekutif (6 Bln)',
                            programs: [
                                { id: '19', title: 'FBS & Bar (Cruise Line)', duration: '6 Bulan' },
                                { id: '20', title: 'Cook (Cruise Line)', duration: '6 Bulan' },
                                { id: '21', title: 'Butler', duration: '6 Bulan' },
                                { id: '22', title: 'SPA Therapist', duration: '6 Bulan' }
                            ]
                        }
                    ];
                    this.waNumber = d.wa || '6282143137707';
                },

                updatePrograms() {
                    var self = this;
                    var category = this.programsData.find(function(cat) {
                        return cat.category_key === self.formData.kategori;
                    });
                    this.filteredPrograms = category ? (category.programs || []) : [];
                    this.formData.program = '';
                },

                submitToWhatsApp() {
                    var self = this;

                    if (!this.formData.nama || !this.formData.email || !this.formData.kategori || !this.formData.program || !this.formData.pesan) {
                        alert('Mohon lengkapi semua field yang diperlukan');
                        return;
                    }

                    var kategoriObj = this.programsData.find(function(c) {
                        return c.category_key === self.formData.kategori;
                    });
                    var kategoriLabel = kategoriObj ? (kategoriObj.category_name || kategoriObj.label || self.formData.kategori) : self.formData.kategori;

                    var programObj = this.filteredPrograms.find(function(p) {
                        return (p.id && p.id == self.formData.program) || (p.title && p.title == self.formData.program) || p == self.formData.program;
                    });
                    var programLabel = (typeof programObj === 'object' && programObj !== null)
                        ? (programObj.title || programObj.program_name || programObj.name || self.formData.program)
                        : self.formData.program;
                    var programDuration = (typeof programObj === 'object' && programObj !== null && programObj.duration)
                        ? ' (' + programObj.duration + ')'
                        : '';

                    var text = 
                        'Halo Admin Denpasar Hotel School,\n\n' +
                        'Ada pertanyaan/inquiry baru dari website DHS:\n\n' +
                        'Nama Lengkap: ' + this.formData.nama + '\n' +
                        'Email: ' + this.formData.email + '\n' +
                        'Kategori Program: ' + kategoriLabel + '\n' +
                        'Program Diminati: ' + programLabel + programDuration + '\n\n' +
                        'Pesan / Pertanyaan:\n' + this.formData.pesan + '\n\n' +
                        '---\n' +
                        'Formulir Kontak Website Denpasar Hotel School (DHS)';

                    var waUrl = 'https://wa.me/' + this.waNumber + '?text=' + encodeURIComponent(text);
                    window.open(waUrl, '_blank');

                    // Reset form
                    this.formData = { nama: '', email: '', kategori: '', program: '', pesan: '' };
                    this.filteredPrograms = [];
                }
            };
        }

        (function () {
            // ── Loading Overlay ─────────────────────────────────────────────
            var loader = document.getElementById('dhs-loader');

            function dismissLoader(instant) {
                if (!loader || loader.dataset.dismissed) return;
                loader.dataset.dismissed = '1';
                if (instant) {
                    loader.style.display = 'none';
                    document.body.classList.add('page-ready');
                    if (loader.parentNode) loader.parentNode.removeChild(loader);
                    return;
                }
                loader.classList.add('loader-hidden');
                document.body.classList.add('page-ready');
                setTimeout(function () { if (loader && loader.parentNode) loader.parentNode.removeChild(loader); }, 800);
            }

            // If previous navigation was marked no-loader, skip instantly
            if (sessionStorage.getItem('dhs-skip-loader') === '1') {
                sessionStorage.removeItem('dhs-skip-loader');
                dismissLoader(true);
            } else {
                // Dismiss once all assets (images, fonts, scripts) are loaded
                if (document.readyState === 'complete') {
                    setTimeout(dismissLoader, 300);
                } else {
                    window.addEventListener('load', function () {
                        setTimeout(dismissLoader, 400);
                    });
                }
                // Safety: always dismiss after 6s no matter what
                setTimeout(dismissLoader, 6000);
            }

            // Handle browser back/forward (bfcache restore)
            window.addEventListener('pageshow', function (e) {
                if (e.persisted) {
                    document.body.classList.remove('page-leaving');
                    // Ensure page-ready is set even if loader was already dismissed
                    if (!document.body.classList.contains('page-ready')) {
                        dismissLoader(true);
                    }
                }
            });

            // Clean up page-leaving before page is cached by browser
            window.addEventListener('pagehide', function () {
                document.body.classList.remove('page-leaving');
            });

            // Intersection Observer with both Enter (Fade In) & Exit (Fade Out)
            var revealObs = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObs.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.05,
                rootMargin: '0px 0px -40px 0px'
            });

            document.querySelectorAll('[data-reveal]').forEach(function (el) {
                revealObs.observe(el);
            });

            // ── Luxury Counter-Up Animation for Key Metrics ──
            var counterElements = document.querySelectorAll('[data-counter]');
            if (counterElements.length > 0 && 'IntersectionObserver' in window) {
                var counterObs = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            var el = entry.target;
                            if (el.dataset.counterDone) return;
                            el.dataset.counterDone = 'true';

                            var target = parseInt(el.getAttribute('data-counter'), 10) || 0;
                            var numSpan = el.querySelector('.counter-number') || el;
                            var duration = 1600;
                            var start = null;

                            function step(ts) {
                                if (!start) start = ts;
                                var p = Math.min((ts - start) / duration, 1);
                                var ease = p === 1 ? 1 : 1 - Math.pow(2, -10 * p);
                                var current = Math.floor(ease * target);
                                numSpan.textContent = current.toLocaleString('id-ID');

                                if (p < 1) {
                                    requestAnimationFrame(step);
                                } else {
                                    numSpan.textContent = target.toLocaleString('id-ID');
                                }
                            }
                            requestAnimationFrame(step);
                            counterObs.unobserve(el);
                        }
                    });
                }, { threshold: 0.2 });

                counterElements.forEach(function (c) {
                    counterObs.observe(c);
                });
            }

            // Smooth page transition click handler
            document.addEventListener('click', function (e) {
                var link = e.target.closest('a[href]');
                if (!link) return;
                var href = link.getAttribute('href');
                if (!href || href.startsWith('#') || href.startsWith('http') ||
                    href.startsWith('//') || href.startsWith('javascript') ||
                    link.getAttribute('target') === '_blank') return;

                // Skip loader for filter/category links
                if (link.hasAttribute('data-no-loader')) {
                    sessionStorage.setItem('dhs-skip-loader', '1');
                    return; // let browser navigate normally without overlay
                }

                e.preventDefault();
                document.body.classList.add('page-leaving');
                setTimeout(function () {
                    window.location.href = href;
                }, 340);
            });

            var navbar = document.getElementById('main-nav');
            var scrollProgress = document.getElementById('dhs-scroll-progress');
            var navIdleTimer = null;
            var lastScrollY = window.scrollY;

            function handleScroll() {
                var scrolled = window.scrollY;

                if (scrollProgress) {
                    var docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                    var pct = docHeight > 0 ? (scrolled / docHeight) * 100 : 0;
                    scrollProgress.style.width = Math.min(Math.max(pct, 0), 100) + '%';
                }

                if (navbar) {
                    if (scrolled > 50) {
                        navbar.classList.remove('nav-transparent');
                        navbar.classList.add('nav-glass');
                    } else {
                        navbar.classList.remove('nav-glass');
                        navbar.classList.add('nav-transparent');
                    }

                    // Auto-hide navbar while scrolling, smoothly reappear after 2s idle
                    var isMobileMenuOpen = document.getElementById('mobile-menu') && document.getElementById('mobile-menu').classList.contains('is-open');
                    if (!isMobileMenuOpen) {
                        if (scrolled > 80 && Math.abs(scrolled - lastScrollY) > 4) {
                            navbar.classList.add('nav-hidden');
                        } else if (scrolled <= 60) {
                            navbar.classList.remove('nav-hidden');
                        }

                        lastScrollY = scrolled;

                        if (navIdleTimer) clearTimeout(navIdleTimer);
                        navIdleTimer = setTimeout(function () {
                            navbar.classList.remove('nav-hidden');
                        }, 2000);
                    }
                }
            }

            window.addEventListener('scroll', handleScroll, { passive: true });
            handleScroll();
        })();
    </script>

    {{-- Google Translate Widget --}}
    <div id="google_translate_element2"></div>
    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            includedLanguages: 'id,en,ja,ko,zh-CN,ar,fr,de,es,it,pt,ru,th,vi,ms,tl,hi,nl',
            autoDisplay: false
        }, 'google_translate_element2');
    }
    // Re-assert full-bleed layout after Translate mutates body styles
    function dhsFixTranslateLayout() {
        try {
            var b = document.body, h = document.documentElement;
            if (!b || !h) return;
            b.style.setProperty('top', '0', 'important');
            b.style.setProperty('left', '0', 'important');
            b.style.setProperty('right', '0', 'important');
            b.style.setProperty('margin', '0', 'important');
            b.style.setProperty('width', '100%', 'important');
            b.style.setProperty('max-width', '100%', 'important');
            b.style.setProperty('position', 'relative', 'important');
            b.style.setProperty('overflow-x', 'hidden', 'important');
            h.style.setProperty('overflow-x', 'hidden', 'important');
            h.style.setProperty('width', '100%', 'important');
            h.style.setProperty('max-width', '100%', 'important');
            var nav = document.getElementById('main-nav');
            if (nav) {
                nav.style.setProperty('left', '0', 'important');
                nav.style.setProperty('right', '0', 'important');
                nav.style.setProperty('width', '100%', 'important');
                nav.style.setProperty('max-width', '100%', 'important');
            }
        } catch (e) {}
    }
    // MutationObserver to detect translate changes
    var dhsTranslateObserver = null;
    function dhsWatchTranslate() {
        if (dhsTranslateObserver) return;
        dhsTranslateObserver = new MutationObserver(function(mutations) {
            var needsFix = false;
            for (var i = 0; i < mutations.length; i++) {
                var m = mutations[i];
                if (m.type === 'attributes' && (m.attributeName === 'style' || m.attributeName === 'class')) {
                    needsFix = true;
                    break;
                }
                if (m.type === 'childList' && m.addedNodes.length > 0) {
                    for (var j = 0; j < m.addedNodes.length; j++) {
                        var node = m.addedNodes[j];
                        if (node.nodeType === 1 && (node.className && node.className.indexOf('goog-te') !== -1)) {
                            needsFix = true;
                            break;
                        }
                    }
                }
            }
            if (needsFix) {
                dhsFixTranslateLayout();
            }
        });
        dhsTranslateObserver.observe(document.body, {
            attributes: true,
            childList: true,
            subtree: false,
            attributeFilter: ['style', 'class']
        });
    }
    setTimeout(dhsFixTranslateLayout, 800);
    setTimeout(dhsFixTranslateLayout, 2500);
    setTimeout(dhsWatchTranslate, 1000);
    // Also fix on language switch
    window.addEventListener('load', function() {
        setTimeout(function() {
            var combo = document.querySelector('#google_translate_element2 .goog-te-combo');
            if (combo) {
                combo.addEventListener('change', function() {
                    setTimeout(dhsFixTranslateLayout, 100);
                    setTimeout(dhsFixTranslateLayout, 500);
                    setTimeout(dhsFixTranslateLayout, 1500);
                });
            }
        }, 2000);
    });
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    {{-- ── Floating Interactive Contact FAB & Side-Opening Popover (Bottom-Right) ── --}}
    @php
        $dhsContactEmail = $footerSettings['email_denpasar'] ?? ($footerSettings['email'] ?? 'dhsvokasi@gmail.com');
    @endphp
    <div id="dhs-contact-fab-wrap" class="dhs-contact-fab-wrap">
        {{-- Side-Opening Card / Popover (Opens to the left of the button) --}}
        <div id="dhs-contact-popover" class="dhs-contact-popover" role="dialog" aria-label="Kontak Langsung DHS">
            <div class="dhs-popover-header">
                <div class="dhs-popover-title-wrap">
                    <span class="dhs-popover-badge">HOTLINE RESMI</span>
                    <h4 class="dhs-popover-title">Hubungi Kami</h4>
                </div>
                <button type="button" id="dhs-contact-popover-close" class="dhs-popover-close-btn" aria-label="Tutup">
                    <span class="material-icons" style="font-size: 16px;">close</span>
                </button>
            </div>

            <div class="dhs-popover-body">
                {{-- 1. WhatsApp Kampus Denpasar --}}
                <a href="https://wa.me/6281246319966?text=Halo%20Denpasar%20Hotel%20School%2C%20saya%20ingin%20konsultasi%20pendaftaran"
                   target="_blank" rel="noopener" class="dhs-contact-item">
                    <div class="dhs-contact-item-icon dhs-wa-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    </div>
                    <div style="flex:1;">
                        <div class="dhs-contact-item-title">WhatsApp Denpasar</div>
                        <div class="dhs-contact-item-sub">+62 81 246 319966 (Chat Langsung)</div>
                    </div>
                    <span class="material-icons dhs-contact-arrow">chevron_right</span>
                </a>

                {{-- 2. WhatsApp Kampus Klungkung --}}
                <a href="https://wa.me/6281337106480?text=Halo%20DHS%20Klungkung%2C%20saya%20ingin%20informasi%20program"
                   target="_blank" rel="noopener" class="dhs-contact-item">
                    <div class="dhs-contact-item-icon dhs-wa-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    </div>
                    <div style="flex:1;">
                        <div class="dhs-contact-item-title">WhatsApp Klungkung</div>
                        <div class="dhs-contact-item-sub">+62 81 337 106480</div>
                    </div>
                    <span class="material-icons dhs-contact-arrow">chevron_right</span>
                </a>

                {{-- 3. Telepon Kampus --}}
                <a href="tel:03665582998" class="dhs-contact-item">
                    <div class="dhs-contact-item-icon dhs-phone-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-2.2 2.2a15.057 15.057 0 01-6.59-6.59l2.2-2.21a.96.96 0 00.25-1.01A11.36 11.36 0 018.57 3.9c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.57-.45-1.02-1-1.02z"/></svg>
                    </div>
                    <div style="flex:1;">
                        <div class="dhs-contact-item-title">Telepon Kampus</div>
                        <div class="dhs-contact-item-sub">+0366 5582998 (Hotline)</div>
                    </div>
                    <span class="material-icons dhs-contact-arrow">chevron_right</span>
                </a>

                {{-- 4. Email Resmi --}}
                <a href="mailto:{{ $dhsContactEmail }}" class="dhs-contact-item">
                    <div class="dhs-contact-item-icon dhs-mail-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    </div>
                    <div style="flex:1;">
                        <div class="dhs-contact-item-title">Email Resmi</div>
                        <div class="dhs-contact-item-sub">{{ $dhsContactEmail }}</div>
                    </div>
                    <span class="material-icons dhs-contact-arrow">chevron_right</span>
                </a>
            </div>
        </div>

        {{-- Main Floating Action Button with Ambient Signal Waves & Morphing Icons --}}
        <button type="button" id="dhs-contact-fab-btn" aria-label="Buka Kontak DHS" title="Hubungi Kami (WhatsApp, Telepon & Email)">
            {{-- Dual Ambient Signal Radar Waves emitting from the circle --}}
            <span class="dhs-signal-wave" aria-hidden="true"></span>
            <span class="dhs-signal-wave dhs-signal-wave-2" aria-hidden="true"></span>

            {{-- Rotating Icons: WhatsApp, Email, Telepon, Close --}}
            <div class="dhs-fab-icon-rotator">
                <div class="dhs-fab-icon-item active" data-icon="wa">
                    <svg width="27" height="27" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </div>
                <div class="dhs-fab-icon-item" data-icon="email">
                    <svg width="25" height="25" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                </div>
                <div class="dhs-fab-icon-item" data-icon="phone">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-2.2 2.2a15.057 15.057 0 01-6.59-6.59l2.2-2.21a.96.96 0 00.25-1.01A11.36 11.36 0 018.57 3.9c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.57-.45-1.02-1-1.02z"/>
                    </svg>
                </div>
                <div class="dhs-fab-icon-item" data-icon="close">
                    <span class="material-icons" style="font-size: 26px;">close</span>
                </div>
            </div>
        </button>
    </div>

    {{-- ── Luxury Image Lightbox Modal ── --}}
    <div id="dhs-lightbox-modal" class="dhs-lightbox" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="dhs-lightbox-backdrop" onclick="dhsCloseLightbox()"></div>
        <div class="dhs-lightbox-container">
            <button type="button" class="dhs-lightbox-close" onclick="dhsCloseLightbox()" aria-label="Tutup Preview">
                <span class="material-icons">close</span>
            </button>
            <button type="button" class="dhs-lightbox-nav prev" onclick="dhsNavLightbox(-1)" aria-label="Foto Sebelumnya">
                <span class="material-icons">chevron_left</span>
            </button>
            <button type="button" class="dhs-lightbox-nav next" onclick="dhsNavLightbox(1)" aria-label="Foto Selanjutnya">
                <span class="material-icons">chevron_right</span>
            </button>
            <div class="dhs-lightbox-body">
                <img id="dhs-lightbox-img" src="" alt="Preview Foto DHS">
                <div id="dhs-lightbox-caption" class="dhs-lightbox-caption" style="display:none;"></div>
            </div>
        </div>
    </div>

    <script>
    /* ── Floating Contact FAB Script ── */
    (function() {
        var fabWrap = document.getElementById('dhs-contact-fab-wrap');
        var fabBtn = document.getElementById('dhs-contact-fab-btn');
        var popover = document.getElementById('dhs-contact-popover');
        var closeBtn = document.getElementById('dhs-contact-popover-close');
        if (!fabWrap || !fabBtn) return;

        var scrollTimer = null;
        var isScrolling = false;

        // Smooth Scroll Detection: hide smoothly while scrolling, reappear after 2 seconds of being idle
        window.addEventListener('scroll', function() {
            if (!isScrolling) {
                isScrolling = true;
                fabWrap.classList.add('is-scrolling');
                if (popover && popover.classList.contains('popover-open')) {
                    popover.classList.remove('popover-open');
                    updateIconState();
                }
            }

            clearTimeout(scrollTimer);
            // Menunggu user diam ~2 detik sebelum tombol muncul kembali dengan transisi ultra smooth
            scrollTimer = setTimeout(function() {
                isScrolling = false;
                fabWrap.classList.remove('is-scrolling');
            }, 2000);
        }, { passive: true });

        // Icon Rotator: cycles between WhatsApp -> Email -> Telepon
        var iconNames = ['wa', 'email', 'phone'];
        var currentIconIndex = 0;
        var iconCycleTimer = null;

        function setIcon(name) {
            var items = fabBtn.querySelectorAll('.dhs-fab-icon-item');
            items.forEach(function(item) {
                if (item.getAttribute('data-icon') === name) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        }

        function startIconCycle() {
            if (iconCycleTimer) clearInterval(iconCycleTimer);
            iconCycleTimer = setInterval(function() {
                if (popover && popover.classList.contains('popover-open')) return;
                currentIconIndex = (currentIconIndex + 1) % iconNames.length;
                setIcon(iconNames[currentIconIndex]);
            }, 2600);
        }

        function updateIconState() {
            if (popover && popover.classList.contains('popover-open')) {
                setIcon('close');
            } else {
                setIcon(iconNames[currentIconIndex]);
            }
        }

        startIconCycle();

        fabBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (popover) {
                popover.classList.toggle('popover-open');
                updateIconState();
            }
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (popover) {
                    popover.classList.remove('popover-open');
                    updateIconState();
                }
            });
        }

        document.addEventListener('click', function(e) {
            if (popover && popover.classList.contains('popover-open')) {
                if (!popover.contains(e.target) && !fabBtn.contains(e.target)) {
                    popover.classList.remove('popover-open');
                    updateIconState();
                }
            }
        });
    })();

    /* ── Luxury Image Lightbox Script ── */
    var dhsLightboxItems = [];
    var dhsLightboxIndex = 0;

    function dhsOpenLightbox(src, caption, index) {
        var modal = document.getElementById('dhs-lightbox-modal');
        var img = document.getElementById('dhs-lightbox-img');
        var cap = document.getElementById('dhs-lightbox-caption');
        if (!modal || !img) return;

        dhsLightboxIndex = typeof index === 'number' ? index : 0;
        img.src = src;
        if (cap) {
            cap.textContent = caption || '';
            cap.style.display = caption ? 'inline-block' : 'none';
        }

        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function dhsCloseLightbox() {
        var modal = document.getElementById('dhs-lightbox-modal');
        if (!modal) return;
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    function dhsNavLightbox(direction) {
        if (!dhsLightboxItems.length) return;
        dhsLightboxIndex = (dhsLightboxIndex + direction + dhsLightboxItems.length) % dhsLightboxItems.length;
        var item = dhsLightboxItems[dhsLightboxIndex];
        if (item) {
            dhsOpenLightbox(item.src, item.caption, dhsLightboxIndex);
        }
    }

    document.addEventListener('keydown', function(e) {
        var modal = document.getElementById('dhs-lightbox-modal');
        if (!modal || !modal.classList.contains('active')) return;
        if (e.key === 'Escape') dhsCloseLightbox();
        if (e.key === 'ArrowLeft') dhsNavLightbox(-1);
        if (e.key === 'ArrowRight') dhsNavLightbox(1);
    });

    function dhsInitLightbox() {
        var triggers = document.querySelectorAll('.dhs-lightbox-trigger');
        dhsLightboxItems = [];
        triggers.forEach(function(el) {
            var src = el.getAttribute('data-lightbox-src') || (el.querySelector('img') ? el.querySelector('img').src : '');
            var caption = el.getAttribute('data-lightbox-caption') || (el.querySelector('img') ? el.querySelector('img').alt : '');
            if (!src) return;
            dhsLightboxItems.push({ src: src, caption: caption });
            var curIdx = dhsLightboxItems.length - 1;
            el.style.cursor = 'pointer';
            el.addEventListener('click', function(e) {
                e.preventDefault();
                dhsOpenLightbox(src, caption, curIdx);
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', dhsInitLightbox);
    } else {
        dhsInitLightbox();
    }
    </script>

    <style>
    /* Hide Google's default elements completely */
    .goog-te-banner-frame,
    .goog-te-spinner-pos,
    #goog-gt-tt,
    .goog-tooltip,
    .goog-text-highlight,
    .goog-te-menu-frame,
    .skiptranslate,
    .goog-te-combo,
    .goog-logo-link {
        display: none !important;
        visibility: hidden !important;
        position: absolute !important;
        left: -9999px !important;
        top: auto !important;
        width: 0 !important;
        height: 0 !important;
        pointer-events: none !important;
    }
    #google_translate_element2 {
        display: none !important;
    }

    /* Google Translate on Android shifts body (top/left/position) and can
       shrink the layout viewport → white strip / broken fixed nav. Pin it. */
    html,
    body {
        width: 100% !important;
        max-width: 100% !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        overflow-x: hidden !important;
    }
    body {
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        position: relative !important;
    }
    /* Translate injects a toolbar frame above the page; keep it out of layout */
    body > div.skiptranslate,
    body > iframe[src*="translate"] {
        display: none !important;
        height: 0 !important;
        overflow: hidden !important;
    }

    /* ── Floating Interactive Contact FAB & Side-Opening Popover ── */
    .dhs-contact-fab-wrap {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 9999;
        display: flex;
        flex-direction: row-reverse; /* FAB on the right, popover extends to the left! */
        align-items: flex-end;
        gap: 12px;
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: auto;
        /* Ultra-smooth velvety easing curve saat muncul kembali */
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: transform, opacity;
    }

    /* While scrolling: menghilang secara sangat halus & elegan */
    .dhs-contact-fab-wrap.is-scrolling {
        opacity: 0;
        transform: translateY(28px) scale(0.88);
        pointer-events: none;
        transition: opacity 0.45s cubic-bezier(0.25, 1, 0.5, 1), transform 0.5s cubic-bezier(0.25, 1, 0.5, 1);
    }

    #dhs-contact-fab-btn {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        color: #ffffff;
        border: 2px solid rgba(255, 255, 255, 0.75);
        box-shadow: 0 8px 26px rgba(18, 140, 126, 0.38), 0 2px 6px rgba(0, 0, 0, 0.08);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease;
        outline: none;
        flex-shrink: 0;
    }
    #dhs-contact-fab-btn:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 12px 32px rgba(18, 140, 126, 0.48), 0 4px 10px rgba(0, 0, 0, 0.12);
    }
    #dhs-contact-fab-btn:active {
        transform: scale(0.95);
    }

    /* Ambient Signal Radar Waves emitting directly from the main circle button */
    .dhs-signal-wave {
        position: absolute;
        inset: -2px;
        border-radius: 50%;
        border: 2px solid #25D366;
        pointer-events: none;
        opacity: 0;
        animation: dhsSignalPulse 2.8s cubic-bezier(0.1, 0.8, 0.3, 1) infinite;
    }
    .dhs-signal-wave-2 {
        animation-delay: 1.3s;
    }
    @keyframes dhsSignalPulse {
        0% {
            transform: scale(0.96);
            opacity: 0.85;
        }
        50% {
            opacity: 0.35;
        }
        100% {
            transform: scale(1.68);
            opacity: 0;
        }
    }

    /* Rotating Center Icons Container */
    .dhs-fab-icon-rotator {
        position: relative;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .dhs-fab-icon-item {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        opacity: 0;
        transform: translateY(8px) scale(0.75);
        transition: opacity 0.35s ease, transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        pointer-events: none;
    }
    .dhs-fab-icon-item.active {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }

    /* Side-Opening Popover Card (Opens horizontally to the left of the button) */
    .dhs-contact-popover {
        position: absolute;
        right: 68px; /* sits to the left of the 56px FAB + 12px gap */
        bottom: 0;   /* aligned with bottom of the button */
        width: 300px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 16px 45px -8px rgba(15, 23, 42, 0.22), 0 0 0 1px rgba(15, 23, 42, 0.07);
        padding: 14px 14px 12px;
        opacity: 0;
        visibility: hidden;
        transform: translateX(24px) scale(0.92);
        transform-origin: right bottom;
        transition: opacity 0.28s cubic-bezier(0.16, 1, 0.3, 1), transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), visibility 0.28s;
        pointer-events: none;
        z-index: 10000;
    }
    .dhs-contact-popover.popover-open {
        opacity: 1;
        visibility: visible;
        transform: translateX(0) scale(1);
        pointer-events: auto;
    }

    .dhs-popover-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 11px;
        margin-bottom: 10px;
        border-bottom: 1px solid #f1f5f9;
    }
    .dhs-popover-close-btn {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        border: none;
        background: #f1f5f9;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.15s;
    }
    .dhs-popover-close-btn:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    .dhs-popover-body {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .dhs-contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 10px;
        border-radius: 12px;
        text-decoration: none;
        color: inherit;
        transition: all 0.15s ease;
        background: #ffffff;
        border: 1px solid transparent;
    }
    .dhs-contact-item:hover {
        background: #f8fafc;
        border-color: #e2e8f0;
        transform: translateX(-3px);
    }
    .dhs-contact-item-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .dhs-wa-icon {
        background: #ecfdf5;
        color: #059669;
    }
    .dhs-phone-icon {
        background: #fffbeb;
        color: #d97706;
    }
    .dhs-mail-icon {
        background: #eff6ff;
        color: #1d4ed8;
    }
    .dhs-contact-item-title {
        font-size: 12px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.25;
    }
    .dhs-contact-item-sub {
        font-size: 10.5px;
        color: #64748b;
        line-height: 1.2;
        margin-top: 2px;
    }
    .dhs-contact-arrow {
        font-size: 16px;
        color: #94a3b8;
        transition: transform 0.15s, color 0.15s;
    }
    .dhs-contact-item:hover .dhs-contact-arrow {
        transform: translateX(2px);
        color: #1A365D;
    }

    @media (max-width: 640px) {
        .dhs-contact-fab-wrap {
            bottom: 18px;
            right: 18px;
        }
        #dhs-contact-fab-btn {
            width: 50px;
            height: 50px;
        }
        .dhs-contact-popover {
            right: 60px;
            width: min(290px, calc(100vw - 84px));
            transform: translateX(16px) scale(0.92);
        }
    }
    @media (max-width: 360px) {
        .dhs-contact-popover {
            right: 0;
            bottom: 60px;
            width: calc(100vw - 32px);
            transform: translateY(16px) scale(0.92);
            transform-origin: right bottom;
        }
    }
    @media (max-height: 500px) and (orientation: landscape) {
        .dhs-contact-fab-wrap {
            bottom: 14px;
            right: 14px;
        }
        #dhs-contact-fab-btn {
            width: 44px;
            height: 44px;
        }
    }

    /* ── Luxury Image Lightbox Modal ── */
    .dhs-lightbox {
        position: fixed;
        inset: 0;
        z-index: 99990;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.35s ease;
    }
    .dhs-lightbox.active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }
    .dhs-lightbox-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(11, 26, 44, 0.94);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }
    .dhs-lightbox-container {
        position: relative;
        z-index: 10;
        max-width: 92vw;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transform: scale(0.94);
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .dhs-lightbox.active .dhs-lightbox-container {
        transform: scale(1);
    }
    .dhs-lightbox-body {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    #dhs-lightbox-img {
        max-width: 88vw;
        max-height: 78vh;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.65), 0 0 0 1px rgba(255, 255, 255, 0.1);
        user-select: none;
    }
    .dhs-lightbox-caption {
        margin-top: 14px;
        color: #f8fafc;
        font-size: 13px;
        font-weight: 500;
        letter-spacing: 0.05em;
        text-align: center;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(8px);
        padding: 6px 18px;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        max-width: 90vw;
    }
    .dhs-lightbox-close {
        position: absolute;
        top: -46px;
        right: 0;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .dhs-lightbox-close:hover {
        background: #C53030;
        transform: rotate(90deg);
        border-color: #C53030;
    }
    .dhs-lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        z-index: 20;
    }
    .dhs-lightbox-nav:hover {
        background: #C5A880;
        color: #0F2440;
        border-color: #C5A880;
        transform: translateY(-50%) scale(1.08);
    }
    .dhs-lightbox-nav.prev {
        left: -60px;
    }
    .dhs-lightbox-nav.next {
        right: -60px;
    }
    @media (max-width: 768px) {
        .dhs-lightbox-nav.prev { left: 10px; }
        .dhs-lightbox-nav.next { right: 10px; }
        .dhs-lightbox-close { top: -40px; right: 10px; }
    }
    </style>

    @stack('scripts')
</body>

</html>