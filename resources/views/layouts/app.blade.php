<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Denpasar Hotel School')</title>

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
            will-change: opacity, transform;
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

    @include('partials.nav')


    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script>
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
                    } else {
                        // Fade out when scrolling out of viewport to make it dynamic and trendy
                        entry.target.classList.remove('is-visible');
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
            var heroImg = document.querySelector('section img.object-cover');

            function handleScroll() {
                var scrolled = window.scrollY;

                if (heroImg) {
                    heroImg.style.transform = 'translate3d(0, ' + (scrolled * 0.25) + 'px, 0)';
                }

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
</body>

</html>