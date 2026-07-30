<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Denpasar Hotel School'); ?></title>

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

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
        }

        body {
            background-color: #F6F2EA;
            color: #0010B8;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            /* Body is always visible — loader covers it instead */
            overflow: hidden;
        }

        body.page-ready {
            overflow: auto;
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
            background-color: #0010B8;
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
            color: #F6F2EA;
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
            background-color: #DF1501;
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
            background: rgba(246, 242, 234, 0.15);
            position: relative;
            overflow: hidden;
        }

        .loader-line-fill {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #DF1501, #F6F2EA);
            animation: dhs-line-progress 2.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .loader-label {
            font-size: 0.55rem;
            font-weight: 700;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            color: rgba(246, 242, 234, 0.45);
        }

        /* ── Wordmark ── */
        #dhs-loader .loader-wordmark {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            color: #F6F2EA;
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
                color: #F6F2EA;
            }

            25%,
            50% {
                opacity: 1;
                color: #DF1501;
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
            box-shadow: 0 8px 20px rgba(214, 40, 40, 0.25);
            filter: brightness(1.05);
        }

        a.bg-dhs-navy:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(27, 42, 107, 0.2);
            filter: brightness(1.1);
        }

        a.border:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        /* ================================================================
            CARD HOVER LIFT
        ================================================================ */
        .card-hover {
            transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1),
                box-shadow 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 48px rgba(27, 42, 107, 0.08);
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
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="bg-background-light text-text-light font-sans antialiased transition-colors">

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

    <?php echo $__env->make('partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
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

            function dismissLoader() {
                if (!loader || loader.dataset.dismissed) return;
                loader.dataset.dismissed = '1';
                loader.classList.add('loader-hidden');
                document.body.classList.add('page-ready');
                setTimeout(function () { if (loader && loader.parentNode) loader.parentNode.removeChild(loader); }, 800);
            }

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

            // Smooth page transition click handler
            document.addEventListener('click', function (e) {
                var link = e.target.closest('a[href]');
                if (!link) return;
                var href = link.getAttribute('href');
                if (!href || href.startsWith('#') || href.startsWith('http') ||
                    href.startsWith('//') || href.startsWith('javascript') ||
                    link.getAttribute('target') === '_blank') return;

                e.preventDefault();
                document.body.classList.add('page-leaving');
                setTimeout(function () {
                    window.location.href = href;
                }, 340);
            });

            var navbar = document.getElementById('main-nav');

            function handleScroll() {
                var scrolled = window.scrollY;

                if (navbar) {
                    if (scrolled > 50) {
                        navbar.classList.remove('nav-transparent');
                        navbar.classList.add('nav-glass');
                    } else {
                        navbar.classList.remove('nav-glass');
                        navbar.classList.add('nav-transparent');
                    }
                }
            }

            window.addEventListener('scroll', handleScroll, { passive: true });
            handleScroll();
        })();
    </script>

    
    <div id="google_translate_element2"></div>
    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            includedLanguages: 'id,en,ja,ko,zh-CN,ar,fr,de,es,it,pt,ru,th,vi,ms,tl,hi,nl',
            autoDisplay: false
        }, 'google_translate_element2');
    }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    
    <div id="lang-switcher">
        <button id="lang-btn" onclick="toggleLangMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12.87 15.07l-2.54-2.51.03-.03A17.52 17.52 0 0014.07 6H17V4h-7V2H8v2H1v2h11.17C11.5 7.92 10.44 9.75 9 11.35 8.07 10.32 7.3 9.19 6.69 8h-2c.73 1.63 1.73 3.17 2.98 4.56l-5.09 5.02L4 19l5-5 3.11 3.11.76-2.04M18.5 10h-2L12 22h2l1.12-3h4.75L21 22h2l-4.5-12m-2.62 7l1.62-4.33L19.12 17h-3.24z"/>
            </svg>
        </button>
        <div id="lang-menu" class="lang-menu">
            <div class="lang-menu-title">Pilih Bahasa</div>
            <button onclick="switchLang('id')">🇮🇩 Indonesia</button>
            <button onclick="switchLang('en')">🇬🇧 English</button>
            <button onclick="switchLang('ja')">🇯🇵 日本語</button>
            <button onclick="switchLang('ko')">🇰🇷 한국어</button>
            <button onclick="switchLang('zh-CN')">🇨🇳 中文</button>
            <button onclick="switchLang('ar')">🇸🇦 العربية</button>
            <button onclick="switchLang('fr')">🇫🇷 Français</button>
            <button onclick="switchLang('de')">🇩🇪 Deutsch</button>
            <button onclick="switchLang('es')">🇪🇸 Español</button>
            <button onclick="switchLang('it')">🇮🇹 Italiano</button>
            <button onclick="switchLang('pt')">🇵🇹 Português</button>
            <button onclick="switchLang('ru')">🇷🇺 Русский</button>
            <button onclick="switchLang('th')">🇹🇭 ไทย</button>
            <button onclick="switchLang('vi')">🇻🇳 Tiếng Việt</button>
            <button onclick="switchLang('ms')">🇲🇾 Bahasa Melayu</button>
            <button onclick="switchLang('tl')">🇵🇭 Filipino</button>
            <button onclick="switchLang('hi')">🇮🇳 हिन्दी</button>
            <button onclick="switchLang('nl')">🇳🇱 Nederlands</button>
        </div>
    </div>
    <script>
    function toggleLangMenu() {
        document.getElementById('lang-menu').classList.toggle('lang-show');
    }
    function switchLang(lang) {
        var combo = document.querySelector('#google_translate_element2 .goog-te-combo');
        if (combo) {
            combo.value = lang;
            combo.dispatchEvent(new Event('change'));
        }
        document.getElementById('lang-menu').classList.remove('lang-show');
    }
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#lang-switcher')) {
            document.getElementById('lang-menu').classList.remove('lang-show');
        }
    });
    </script>

    <style>
    /* Hide Google's default elements completely */
    .goog-te-banner-frame,
    .goog-te-spinner-pos,
    #goog-gt-tt,
    .goog-tooltip,
    .goog-text-highlight,
    .goog-te-menu-frame,
    .skiptranslate {
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
    body {
        top: 0 !important;
    }

    /* ── Custom Language Switcher ── */
    #lang-switcher {
        position: fixed;
        bottom: 24px;
        left: 24px;
        z-index: 9999;
    }

    #lang-btn {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        border: none;
        background: linear-gradient(135deg, #0E06B4, #2B2494);
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(14,6,180,0.35);
        transition: box-shadow 0.3s, transform 0.2s;
    }
    #lang-btn:hover {
        box-shadow: 0 6px 28px rgba(14,6,180,0.45);
        transform: scale(1.08);
    }

    .lang-menu {
        position: absolute;
        bottom: 64px;
        left: 0;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        width: 200px;
        max-height: 360px;
        overflow-y: auto;
        padding: 8px 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.25s ease;
    }
    .lang-menu.lang-show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .lang-menu-title {
        padding: 8px 16px 4px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #888;
    }

    .lang-menu button {
        display: block;
        width: 100%;
        padding: 10px 16px;
        border: none;
        background: none;
        text-align: left;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        color: #333;
        cursor: pointer;
        transition: background 0.15s;
    }
    .lang-menu button:hover {
        background: #f0f0ff;
    }
    .lang-menu::-webkit-scrollbar {
        width: 4px;
    }
    .lang-menu::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }
    </style>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH D:\laragon\www\DHS\resources\views/layouts/app.blade.php ENDPATH**/ ?>