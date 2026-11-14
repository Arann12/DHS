@extends('layouts.app')

@section('title', 'Tentang Kami — Denpasar Hotel School')

@php
    $aboutHero = isset($sections['hero']) ? $sections['hero']->section_content : [];
    $aboutIntro = isset($sections['intro']) ? $sections['intro']->section_content : [];
    $aboutVision = isset($sections['vision']) ? $sections['vision']->section_content : [];
    $aboutTimeline = isset($sections['timeline']) ? $sections['timeline']->section_content : [];
    $aboutDirector = isset($sections['director']) ? $sections['director']->section_content : [];
    $aboutLeader = isset($sections['leader']) ? $sections['leader']->section_content : [];
    $aboutCta = isset($sections['cta']) ? $sections['cta']->section_content : [];

    $heroTitle   = $aboutHero['title'] ?? 'Membangun Pemimpin Hospitality Masa Depan';
    $heroSubtitle= $aboutHero['subtitle'] ?? 'INSTITUSI &amp; WARISAN';
    $heroBgImage = !empty($aboutHero['bgImage']) ? $aboutHero['bgImage'] : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDvULZTmcRw3vX-f-CzNGg8stMRI2Ea5NrSmiyucdED1Ui6mqgK2AmexIratVtInAzxZCCHoL-zzOc0IKiakMVptfS6D7Totb7TxRP3hnBTI6jiqWvMeiM_1-hkImIpVicdfMM6OIO2stFSZu3ragqM52MjEfHpklP14W0JSFCG3J7oNfgCwfP2lub1AqE-vF_htAw-tUtFYRPRud-E7yvapjggWrzGecs_O5JgHck2s4ToD8oRnYCnxg';

    $introLabel = $aboutIntro['label'] ?? 'TENTANG DHS';
    $introHeadline = $aboutIntro['headline'] ?? 'Transforming Into Excellent';
    $introP1 = $aboutIntro['p1'] ?? 'Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri...';
    $introP2 = $aboutIntro['p2'] ?? 'Lembaga ini hadir untuk mengajak mahasiswa belajar sambil bekerja di Australia, Jerman dan Asia Tenggara melalui Partnership Program of DHS, dikenal dengan sebutan PP DHS.';
    $introQuote = $aboutIntro['quote'] ?? '"Mengintegrasikan pendidikan perhotelan dengan dunia industri nyata untuk karir global."';

    $visionVisi = $aboutVision['visi'] ?? 'Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global.';
    $visionMisi = $aboutVision['misi'] ?? [
        'Melaksanakan program pendidikan inovatif sesuai kebutuhan industri.',
        'Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional.',
        'Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara.'
    ];
    $visionCoreValues = $aboutVision['coreValues'] ?? [
        ['title' => 'Integritas (Integrity)', 'desc' => 'DHS memegang teguh visi dan misi guna membentuk insan pariwisata yang kompeten dan berdaya saing.'],
        ['title' => 'Tanggung Jawab (Responsibility)', 'desc' => 'DHS bertanggung jawab menghasilkan lulusan yang sesuai dengan kriteria dunia kerja serta tantangan di masa depan.'],
        ['title' => 'Kualitas (Quality)', 'desc' => 'DHS memberikan pelayanan dan solusi terbaik yang berfokus pada kualitas pembelajaran.']
    ];

    $visionSectionLabel = $aboutVision['sectionLabel'] ?? 'Tujuan Kami';
    $visionSectionTitle = $aboutVision['sectionTitle'] ?? 'Visi, Misi & Core Values';
    $visionVisiLabel    = $aboutVision['visiLabel'] ?? 'Visi';
    $visionMisiLabel    = $aboutVision['misiLabel'] ?? 'Misi';

    $timelineSectionLabel = $aboutTimeline['sectionLabel'] ?? 'Perjalanan Kami';
    $timelineSectionTitle = $aboutTimeline['sectionTitle'] ?? 'Sejarah & Milestone';
    $timelineItems = $aboutTimeline['items'] ?? [
        ['year' => '2005', 'title' => 'DHS Berdiri', 'desc' => 'Denpasar Hotel School didirikan dengan visi membawa standar pendidikan hospitality internasional ke Bali.'],
        ['year' => '2009', 'title' => 'Akreditasi Nasional', 'desc' => 'DHS meraih akreditasi A dari BAN-PT. Sebuah pengakuan atas komitmen kami terhadap kualitas pendidikan.'],
        ['year' => '2013', 'title' => 'Gedung Training Center Baru', 'desc' => 'Peresmian Training Center seluas 4.500 m² dengan dapur profesional, training bar, dan training restaurant.'],
        ['year' => '2017', 'title' => 'MoU Marriott International', 'desc' => 'Penandatanganan MoU strategis dengan Marriott International membuka jalur rekrutmen langsung hotel bintang 5 & kapal pesiar dunia.'],
        ['year' => '2022', 'title' => 'Program Internasional', 'desc' => 'Peluncuran program exchange mahasiswa dengan sekolah perhotelan di Swiss dan Singapura.'],
        ['year' => '2024', 'title' => 'DHS Hari Ini', 'desc' => '3.000+ alumni tersebar di hotel-hotel terkemuka di 20+ negara.'],
        ['year' => '2026', 'title' => 'Transformasi Masa Depan', 'desc' => 'DHS melangkah ke era pendidikan hospitality digital modern dengan kurikulum berbasis teknologi industri global.'],
    ];

    // Meta konfigurasi interaktif untuk Peta Jejak Karir Global DHS
    $stageMeta = [
        '2005' => ['phase' => 'Langkah Awal', 'hub' => 'Kampus Pusat Bali', 'highlight' => 'Berdiri di Bawah Yayasan Guna Widya Paramesthi', 'badge' => 'KAMPUS PUSAT BALI', 'icon' => 'school', 'nodes' => ['bali'], 'arcs' => []],
        '2009' => ['phase' => 'Akreditasi A', 'hub' => 'Pusat Vokasi Bali & Indonesia', 'highlight' => 'Standar Mutu Pendidikan Perhotelan Terakreditasi A', 'badge' => 'AKREDITASI A BAN-PT', 'icon' => 'verified', 'nodes' => ['bali'], 'arcs' => []],
        '2013' => ['phase' => 'Ekspansi Fasilitas', 'hub' => 'Klungkung & Denpasar, Bali', 'highlight' => 'Fasilitas Praktik Standar Kapal Pesiar & Hotel Mewah', 'badge' => '4.500 m² TRAINING CENTER', 'icon' => 'apartment', 'nodes' => ['bali', 'klungkung'], 'arcs' => []],
        '2017' => ['phase' => 'Kemitraan Global', 'hub' => 'Marriott Luxury Hotels Network', 'highlight' => 'Akses Penyaluran Kerja Langsung Tanpa Potongan Agen Fee', 'badge' => 'MARRIOTT GLOBAL NETWORK', 'icon' => 'handshake', 'nodes' => ['bali', 'singapore', 'dubai', 'tokyo'], 'arcs' => ['bali-sg', 'bali-dubai', 'bali-tokyo']],
        '2022' => ['phase' => 'Go International', 'hub' => 'Swiss (Eropa) & Singapura', 'highlight' => 'Pengalaman Belajar Sambil Bekerja di Eropa & Asia', 'badge' => 'SWISS & ASIA EXCHANGE', 'icon' => 'flight_takeoff', 'nodes' => ['bali', 'singapore', 'swiss', 'germany'], 'arcs' => ['bali-sg', 'bali-swiss', 'bali-germany']],
        '2024' => ['phase' => 'Jejak Global', 'hub' => 'Jaringan Alumni 20+ Negara Dunia', 'highlight' => 'Penyaluran Magang & Karir Internasional Berkelanjutan', 'badge' => '3.000+ ALUMNI DUNIA', 'icon' => 'public', 'nodes' => ['bali', 'singapore', 'swiss', 'germany', 'australia', 'usa', 'dubai', 'tokyo'], 'arcs' => ['bali-sg', 'bali-swiss', 'bali-germany', 'bali-aus', 'bali-usa', 'bali-dubai', 'bali-tokyo']],
        '2026' => ['phase' => 'Masa Depan Vokasi', 'hub' => 'Pusat Keunggulan Hospitality Cerdas', 'highlight' => 'Integrasi Kurikulum Global & Jalur Magang Berbayar Luar Negeri', 'badge' => 'ERA VOKASI CERDAS', 'icon' => 'trending_up', 'nodes' => ['bali', 'singapore', 'swiss', 'germany', 'australia', 'usa', 'dubai', 'tokyo'], 'arcs' => ['bali-sg', 'bali-swiss', 'bali-germany', 'bali-aus', 'bali-usa', 'bali-dubai', 'bali-tokyo']],
    ];

    $timelineStages = [];
    foreach ($timelineItems as $item) {
        $yr = (string)($item['year'] ?? '');
        $meta = $stageMeta[$yr] ?? [
            'phase' => 'Milestone',
            'hub' => 'Denpasar Hotel School',
            'highlight' => 'Transformasi Pendidikan Hospitality Menuju Keunggulan Global',
            'badge' => 'MILESTONE ' . $yr,
            'icon' => 'star',
            'nodes' => ['bali'],
            'arcs' => []
        ];
        $timelineStages[] = array_merge([
            'year' => $yr,
            'title' => $item['title'] ?? 'Milestone DHS',
            'desc' => $item['desc'] ?? '',
        ], $meta);
    }

    $directorP1 = $aboutDirector['p1'] ?? '';
    $directorP2 = $aboutDirector['p2'] ?? '';
    $directorPhoto = !empty($aboutDirector['photo']) ? $aboutDirector['photo'] : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDeYrRiWE5PIngmO86w0Cn5hPsDfiG59HTAVn8-asaEPcvD_fxcdAfcXy_4KR3Pj-pL3DyMS_WN9hCkZFO-lSelGflhgKm5r2oTS_3HJ83ZvydeMvZY_QKmjAItPrh0n3Yvymm1YaFTXkLZpopTGMNQl17m_JEFUai2rxAdUHMzWu383ihOl9jx19ZEtRwSlqf0azKeZNaeaNPVSW6SAXdOP0RroYx1ZflK8JBFkyTsOLiVdTtucCRmxQ';

    // Baca tim kepemimpinan — support format baru (array members) dan lama (single object)
    if (isset($aboutLeader['members']) && is_array($aboutLeader['members']) && count($aboutLeader['members']) > 0) {
        $leaderTeam = $aboutLeader['members'];
    } elseif (!empty($aboutLeader['name'])) {
        // Backward compat: format lama single object
        $leaderTeam = [[
            'name'  => $aboutLeader['name']  ?? 'I Made Dwija Suastana, S.H., M.H.',
            'title' => $aboutLeader['title'] ?? 'Direktur Denpasar Hotel School',
            'bio'   => $aboutLeader['bio']   ?? 'Memimpin Denpasar Hotel School (DHS) dengan komitmen penuh untuk mencetak SDM unggul berdaya saing global.',
            'photo' => !empty($aboutLeader['photo']) ? $aboutLeader['photo'] : $directorPhoto,
        ]];
    } else {
        $leaderTeam = [
            [
                'name'  => 'I Made Dwija Suastana, S.H., M.H.',
                'title' => 'Direktur Denpasar Hotel School',
                'bio'   => 'Memimpin Denpasar Hotel School (DHS) dengan komitmen penuh untuk mencetak SDM unggul berdaya saing global.',
                'photo' => $directorPhoto,
            ]
        ];
    }

    $ctaTitle  = $aboutCta['title'] ?? 'Jadilah Bagian dari Keluarga DHS';
    $ctaDesc   = $aboutCta['desc'] ?? 'Bergabunglah dengan ribuan alumni kami yang telah berhasil membangun karir gemilang di industri hospitality global.';
    $ctaBtn1   = $aboutCta['btn1Text'] ?? 'Jelajahi Program';
    $ctaBtn1Url = $aboutCta['btn1Url'] ?? '/akademi';
    $ctaBtn2   = $aboutCta['btn2Text'] ?? 'Daftar Sekarang';
    $ctaBtn2Url = $aboutCta['btn2Url'] ?? '/formulir-pendaftaran';
    if ($ctaBtn2Url === '/cara-mendaftar') { $ctaBtn2Url = '/formulir-pendaftaran'; }
@endphp

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img alt="DHS Campus panoramic view" class="absolute inset-0 w-full h-full object-cover"
            src="{{ $heroBgImage }}">

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><span data-id="Tentang Kami" data-en="About Us">Tentang Kami</span></span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-[1.1]">
                <span data-id="{{ $heroTitle }}" data-en="{{ $heroTitle }}">{{ $heroTitle }}</span>
            </h1>
            <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/70 font-medium">
                <span data-id="{{ $heroSubtitle }}" data-en="{{ $heroSubtitle }}">{{ $heroSubtitle }}</span>
            </p>
        </div>
    </section>

    <!-- Tagline / Intro -->
    <section class="bg-white pt-24 md:pt-32 pb-20 md:pb-28">
        <div class="max-w-[1280px] mx-auto px-5 md:px-16 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div data-reveal="fade-right">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                    <span data-id="{{ $introLabel }}" data-en="ABOUT DHS">{{ $introLabel }}</span>
                </span>
                <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6">
                    <span data-id="{{ $introHeadline }}" data-en="{{ $introHeadline }}">{{ $introHeadline }}</span>
                </h2>
                <p class="text-base text-muted-light leading-relaxed mb-6">
                    <span data-id="{{ $introP1 }}" data-en="{{ $introP1 }}">{{ $introP1 }}</span>
                </p>
                <p class="text-base text-muted-light leading-relaxed">
                    <span data-id="{{ $introP2 }}" data-en="{{ $introP2 }}">{{ $introP2 }}</span>
                </p>
            </div>
            <div class="relative overflow-hidden rounded-sm shadow-lg" data-reveal="fade-left" data-delay="200" style="min-height: 420px;">
                @php
                    $introImage = !empty($aboutIntro['image']) ? $aboutIntro['image'] : '/image/about_dhs.jpg';
                @endphp
                <img
                    src="{{ $introImage }}"
                    alt="Mahasiswa DHS berprestasi di dunia hospitality internasional"
                    class="w-full h-full object-cover absolute inset-0"
                    style="min-height: 420px;"
                >
                <!-- Overlay with quote -->
                <div class="absolute inset-0 bg-gradient-to-t from-dhs-navy/80 via-dhs-navy/20 to-transparent flex items-end p-8">
                    <blockquote class="text-white">
                        <p class="font-serif text-lg md:text-xl italic leading-relaxed mb-3">
                            <span data-id="{{ $introQuote }}" data-en="{{ $introQuote }}">{{ $introQuote }}</span>
                        </p>
                        <footer class="text-white/60 text-xs uppercase tracking-widest font-semibold">— Denpasar Hotel School</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="bg-white py-20 md:py-24">
        <div class="px-5 md:px-16 max-w-[1280px] mx-auto">
            <div class="text-center mb-16" data-reveal="fade-up">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                    <span data-id="Tujuan Kami" data-en="Our Purpose">{{ $visionSectionLabel }}</span>
                </span>
                <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">
                    <span data-id="Visi, Misi &amp; Core Values" data-en="Vision, Mission &amp; Core Values">{{ $visionSectionTitle }}</span>
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="bg-white p-10 shadow-sm" data-reveal="fade-right" data-delay="100">
                    <span class="material-icons text-primary text-4xl mb-6 block">visibility</span>
                    <h3 class="text-[24px] font-semibold font-serif text-text-light mb-4"><span data-id="Visi" data-en="Vision">{{ $visionVisiLabel }}</span></h3>
                    <p class="text-base text-muted-light leading-relaxed"><span data-id="{{ $visionVisi }}" data-en="{{ $visionVisi }}">{{ $visionVisi }}</span></p>
                </div>
                <div class="bg-dhs-lightblue p-10 shadow-sm" data-reveal="fade-left" data-delay="200">
                    <span class="material-icons text-primary text-4xl mb-6 block">flag</span>
                    <h3 class="text-[24px] font-semibold font-serif text-text-light mb-4"><span data-id="Misi" data-en="Mission">{{ $visionMisiLabel }}</span></h3>
                    <ul class="space-y-3 text-muted-light text-base">
                        @foreach($visionMisi as $misiItem)
                        <li class="flex items-start"><span class="text-primary mr-2 mt-1">•</span> <span data-id="{{ $misiItem }}" data-en="{{ $misiItem }}">{{ $misiItem }}</span></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="bg-white p-10 shadow-sm" data-reveal="zoom-in" data-delay="150">
                <h3 class="text-[24px] font-semibold font-serif text-text-light mb-8 text-center"><span data-id="Core Values (Nilai-Nilai Utama)" data-en="Core Values">Core Values (Nilai-Nilai Utama)</span></h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($visionCoreValues as $cv)
                    <div>
                        <h4 class="font-bold text-lg text-primary mb-2"><span data-id="{{ $cv['title'] }}" data-en="{{ $cv['title'] }}">{{ $cv['title'] }}</span></h4>
                        <p class="text-sm text-muted-light leading-relaxed"><span data-id="{{ $cv['desc'] }}" data-en="{{ $cv['desc'] }}">{{ $cv['desc'] }}</span></p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


        <!-- ░░ INTERACTIVE GLOBAL FLIGHT ARC & MAP JOURNEY (SEJARAH & MILESTONE) ░░ -->
    <section id="global-journey-section" class="py-20 md:py-28 text-white px-4 sm:px-6 md:px-16 w-full relative overflow-hidden select-none" style="background: linear-gradient(180deg, #071322 0%, #0d1e34 50%, #071322 100%); color: #ffffff;">
        {{-- Atmospheric Background Glows --}}
        <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(197,48,48,0.25) 0%, transparent 70%); filter: blur(60px);"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(197,168,128,0.2) 0%, transparent 70%); filter: blur(60px);"></div>

        <div class="max-w-7xl mx-auto relative z-10 w-full">
            {{-- Section Header --}}
            <div class="text-center mb-10 sm:mb-14" data-reveal="fade-up">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[0.68rem] font-bold tracking-[0.2em] uppercase mb-4 shadow-sm" style="background: rgba(197,168,128,0.12); color: #E5C397; border: 1px solid rgba(197,168,128,0.35);">
                    <span class="w-2 h-2 rounded-full animate-ping" style="background-color: #E5C397;"></span>
                    <span data-id="PERJALANAN KAMI — DARI BALI MENUJU DUNIA" data-en="OUR JOURNEY — FROM BALI TO THE WORLD">{{ $timelineSectionLabel ?? 'Perjalanan Kami' }} — Dari Bali Menuju Dunia</span>
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif font-bold tracking-wide mb-4" style="color: #ffffff;">
                    <span data-id="{{ $timelineSectionTitle ?? 'Sejarah & Jejak Karir Global' }}" data-en="{{ $timelineSectionTitle ?? 'History & Global Career Footprint' }}">{{ $timelineSectionTitle ?? 'Sejarah & Jejak Karir Global' }}</span>
                </h2>
                <p class="text-sm sm:text-base max-w-2xl mx-auto leading-relaxed" style="color: #cbd5e1;">
                    <span data-id="Menyusuri transformasi Denpasar Hotel School sejak 2005 hingga melahirkan lebih dari 3.000 alumni unggul yang berkarir di hotel bintang 5 dan kapal pesiar mewah internasional di 20+ negara."
                          data-en="Tracing the transformation of Denpasar Hotel School since 2005, cultivating over 3,000 successful alumni working in 5-star hotels and luxury cruise lines across 20+ countries.">
                        Menyusuri transformasi Denpasar Hotel School sejak 2005 hingga melahirkan lebih dari 3.000 alumni unggul yang berkarir di hotel bintang 5 dan kapal pesiar mewah internasional di 20+ negara.
                    </span>
                </p>
            </div>

            {{-- Interactive Chrono Bar (Year Pills & Autoplay Controls) --}}
            <div class="mb-8 sm:mb-10 rounded-2xl p-3 sm:p-4 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-4" style="background: rgba(13, 30, 52, 0.9); border: 1px solid rgba(255, 255, 255, 0.15); backdrop-filter: blur(12px);" data-reveal="fade-up" data-delay="100">
                {{-- Year Selector Buttons --}}
                <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto py-1 px-1 scrollbar-none" id="dhs-chrono-pills">
                    @foreach($timelineStages as $idx => $m)
                    <button type="button"
                            class="dhs-chrono-pill shrink-0 px-4 sm:px-5 py-2.5 rounded-xl font-sans text-xs sm:text-sm font-bold transition-all duration-300 flex items-center gap-2 {{ $idx === 0 ? 'active' : '' }}"
                            onclick="dhsSelectMilestone({{ $idx }})"
                            data-year="{{ $m['year'] }}"
                            id="pill-{{ $idx }}">
                        <span class="w-2 h-2 rounded-full pill-dot transition-colors"></span>
                        <span class="font-serif tracking-wider text-sm sm:text-base">{{ $m['year'] }}</span>
                        <span class="text-[0.68rem] opacity-75 font-normal hidden lg:inline-block tracking-tight">({{ $m['phase'] }})</span>
                    </button>
                    @endforeach
                </div>

                {{-- Autoplay / Mode Controls --}}
                <div class="flex items-center gap-3 shrink-0 w-full md:w-auto justify-end px-2">
                    <div class="text-[0.7rem] tracking-widest uppercase font-mono font-bold flex items-center gap-1.5" style="color: #E5C397;">
                        <span class="material-icons text-sm">schedule</span>
                        <span id="dhs-milestone-counter">FASE 01 / 0{{ count($timelineStages) }}</span>
                    </div>
                    <button type="button" id="dhs-autoplay-toggle" onclick="dhsToggleAutoplay()"
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg border text-xs transition-colors font-medium cursor-pointer"
                            style="background: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2); color: #f1f5f9;">
                        <span class="material-icons text-sm" id="dhs-autoplay-icon">pause</span>
                        <span id="dhs-autoplay-label" class="text-[0.7rem] uppercase tracking-wider">Otomatis</span>
                    </button>
                </div>
            </div>

            {{-- Main Interactive Theater (Story Card + SVG Flight Map) --}}
            <div class="dhs-theater-grid" data-reveal="fade-up" data-delay="200">
                {{-- Column Left: Story & Metric Card --}}
                <div class="dhs-story-col">
                    <div class="dhs-glass-card h-full flex flex-col justify-between">
                        {{-- Massive Glowing Background Year Watermark --}}
                        <div id="dhs-card-year-watermark"
                             class="absolute -bottom-8 -right-4 font-serif text-[110px] sm:text-[140px] font-extrabold leading-none pointer-events-none select-none transition-all duration-500"
                             style="color: rgba(255, 255, 255, 0.04);">
                            2005
                        </div>

                        {{-- Card Header --}}
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-4">
                                <span id="dhs-card-phase-badge"
                                      class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.68rem] font-bold tracking-widest uppercase"
                                      style="background: rgba(197, 48, 48, 0.25); color: #fca5a5; border: 1px solid rgba(197, 48, 48, 0.45);">
                                    LANGKAH AWAL
                                </span>
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm"
                                     style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.18); color: #E5C397;">
                                    <span class="material-icons text-xl" id="dhs-card-icon">school</span>
                                </div>
                            </div>

                            <div class="font-serif text-3xl sm:text-4xl font-extrabold tracking-wide mb-2 flex items-baseline gap-2.5" style="color: #E5C397;">
                                <span id="dhs-card-year">2005</span>
                                <span class="text-xs font-sans uppercase tracking-widest font-semibold" style="color: #94a3b8;" id="dhs-card-hub">Kampus Pusat Bali</span>
                            </div>

                            <h3 id="dhs-card-title" class="font-serif text-xl sm:text-2xl font-bold mb-4 leading-snug" style="color: #ffffff;">
                                DHS Berdiri di Bali
                            </h3>

                            <p id="dhs-card-desc" class="text-sm sm:text-base leading-relaxed mb-6" style="color: #cbd5e1;">
                                Denpasar Hotel School didirikan di Denpasar dengan visi membawa standar pendidikan vokasi hospitality internasional ke Bali.
                            </p>
                        </div>

                        {{-- Card Bottom Stats & Features --}}
                        <div class="pt-6 space-y-4" style="border-top: 1px solid rgba(255, 255, 255, 0.12);">
                            <div class="rounded-xl p-3.5 flex items-center gap-3" style="background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.1);">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shrink-0 animate-pulse"></span>
                                <div class="flex-1">
                                    <div class="text-[0.65rem] uppercase tracking-wider font-semibold" style="color: #94a3b8;">Pencapaian Utama</div>
                                    <div id="dhs-card-highlight" class="text-xs sm:text-sm font-bold text-emerald-300">
                                        Berdiri di Bawah Yayasan Guna Widya Paramesthi
                                    </div>
                                </div>
                            </div>

                            {{-- Navigation Buttons --}}
                            <div class="flex items-center justify-between pt-2">
                                <button type="button" onclick="dhsNavMilestone(-1)"
                                        class="px-4 py-2.5 rounded-xl text-white text-xs font-semibold flex items-center gap-1.5 transition-all cursor-pointer hover:scale-105 active:scale-95"
                                        style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.15);">
                                    <span class="material-icons text-sm">arrow_back</span>
                                    <span>Sebelumnya</span>
                                </button>
                                <button type="button" onclick="dhsNavMilestone(1)"
                                        class="px-5 py-2.5 rounded-xl text-white text-xs font-semibold flex items-center gap-1.5 transition-all shadow-md cursor-pointer hover:scale-105 active:scale-95"
                                        style="background: linear-gradient(135deg, #C53030 0%, #C5A880 100%);">
                                    <span>Selanjutnya</span>
                                    <span class="material-icons text-sm">arrow_forward</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Column Right: Interactive Vector World Map Stage --}}
                <div class="dhs-map-col">
                    <div class="dhs-glass-card h-full flex flex-col justify-between">
                        {{-- Top Map Status Bar --}}
                        <div class="flex items-center justify-between gap-3 mb-3 pb-3 text-xs" style="border-bottom: 1px solid rgba(255, 255, 255, 0.12);">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                                <span class="font-mono text-[0.7rem] tracking-wider uppercase font-semibold text-emerald-400">LIVE GLOBAL PLACEMENT RADAR</span>
                            </div>
                            <div id="dhs-map-active-badge" class="px-3 py-1 rounded-full text-[0.68rem] font-bold tracking-widest uppercase"
                                 style="background: rgba(197, 168, 128, 0.2); color: #E5C397; border: 1px solid rgba(197, 168, 128, 0.35);">
                                1 HUB AKTIF
                            </div>
                        </div>

                        {{-- SVG World Map Viewport --}}
                        <div class="dhs-map-viewport">
                            <svg viewBox="0 0 1000 500" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <radialGradient id="dhs-ocean-glow" cx="80%" cy="58%" r="65%">
                                        <stop offset="0%" stop-color="#1E3A8A" stop-opacity="0.35"/>
                                        <stop offset="100%" stop-color="#050C16" stop-opacity="0"/>
                                    </radialGradient>
                                    <linearGradient id="gold-flight-grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#C5A880" stop-opacity="1"/>
                                        <stop offset="50%" stop-color="#E5C397" stop-opacity="1"/>
                                        <stop offset="100%" stop-color="#C53030" stop-opacity="1"/>
                                    </linearGradient>
                                    <filter id="gold-beam" x="-20%" y="-20%" width="140%" height="140%">
                                        <feGaussianBlur stdDeviation="2.5" result="blur" />
                                        <feComposite in="SourceGraphic" in2="blur" operator="over" />
                                    </filter>
                                </defs>

                                {{-- Ocean background with depth --}}
                                <rect width="1000" height="500" fill="#06101D" />
                                <rect width="1000" height="500" fill="url(#dhs-ocean-glow)" />

                                {{-- Cartography Grid Lines --}}
                                <g stroke="rgba(255,255,255,0.05)" stroke-width="0.8" fill="none">
                                    <line x1="0" y1="250" x2="1000" y2="250" stroke-dasharray="4 4" stroke="rgba(197,168,128,0.25)"/>
                                    <line x1="0" y1="185" x2="1000" y2="185"/>
                                    <line x1="0" y1="315" x2="1000" y2="315"/>
                                    <line x1="250" y1="0" x2="250" y2="500"/>
                                    <line x1="520" y1="0" x2="520" y2="500"/>
                                    <line x1="750" y1="0" x2="750" y2="500"/>
                                </g>

                                {{-- Continents with Luxury Navy/Gold Silhouette --}}
                                <g class="dhs-continent-paths" fill="#12253E" stroke="rgba(197,168,128,0.3)" stroke-width="0.85" stroke-linejoin="round">
                                    <!-- North America -->
                                    <path d="M 125,75 Q 160,50 210,65 Q 260,80 300,90 Q 325,120 280,140 Q 250,130 235,160 Q 265,185 240,215 Q 210,245 185,220 Q 150,210 135,175 Q 110,150 95,115 Q 105,85 125,75 Z M 275,55 Q 315,40 345,45 Q 370,70 335,85 Q 295,75 275,55 Z" />
                                    <!-- South America -->
                                    <path d="M 225,255 Q 275,255 315,295 Q 345,335 320,390 Q 285,455 265,465 Q 250,425 235,360 Q 210,305 225,255 Z" />
                                    <!-- Europe & Scandinavia -->
                                    <path d="M 470,95 Q 520,75 565,100 Q 555,130 525,140 Q 495,160 465,150 Q 455,120 470,95 Z M 435,100 Q 455,95 450,125 Q 430,120 435,100 Z M 505,65 Q 530,55 545,80 Q 520,90 505,65 Z" />
                                    <!-- Africa -->
                                    <path d="M 465,175 Q 535,165 585,200 Q 615,250 585,315 Q 555,375 515,385 Q 475,330 450,255 Q 455,200 465,175 Z M 605,320 Q 625,335 615,370 Q 595,350 605,320 Z" />
                                    <!-- Asia -->
                                    <path d="M 565,100 Q 660,80 760,85 Q 850,110 895,150 Q 860,195 810,215 Q 770,255 720,265 Q 675,240 625,230 Q 590,205 565,155 Z M 875,130 Q 900,145 885,185 Q 865,170 875,130 Z M 805,245 Q 835,235 845,265 Q 815,270 805,245 Z M 670,210 Q 700,205 705,225 Q 680,230 670,210 Z" />
                                    <!-- Australia & New Zealand -->
                                    <path d="M 785,345 Q 865,320 920,345 Q 915,405 865,435 Q 815,415 780,375 Z M 925,410 Q 945,420 935,445 Q 915,435 925,410 Z" />
                                    <!-- Indonesia / Maritime SE Asia (Prominently Highlighted) -->
                                    <path d="M 745,275 Q 785,265 775,290 Q 735,295 745,275 Z M 785,285 Q 825,275 820,305 Q 780,300 785,285 Z M 845,285 Q 895,275 890,310 Q 845,305 845,285 Z M 815,308 Q 835,308 830,316 Q 815,315 815,308 Z" fill="#1B4168" stroke="#C5A880" stroke-width="1.3"/>
                                </g>

                                {{-- Golden Curved Flight Arcs (Dynamic Visibility per Milestone) --}}
                                <g id="dhs-flight-arcs" fill="none" stroke="url(#gold-flight-grad)" stroke-width="2.2" stroke-linecap="round" filter="url(#gold-beam)">
                                    <!-- Bali to Singapore -->
                                    <path id="arc-bali-sg" d="M 820,312 Q 795,280 770,280" class="flight-arc-path" />
                                    <!-- Bali to Switzerland (Zurich/Geneva) -->
                                    <path id="arc-bali-swiss" d="M 820,312 Q 650,140 518,135" class="flight-arc-path" />
                                    <!-- Bali to Germany (Munich/Frankfurt) -->
                                    <path id="arc-bali-germany" d="M 820,312 Q 660,115 522,118" class="flight-arc-path" />
                                    <!-- Bali to Dubai (UAE) -->
                                    <path id="arc-bali-dubai" d="M 820,312 Q 730,220 645,205" class="flight-arc-path" />
                                    <!-- Bali to Tokyo (Japan) -->
                                    <path id="arc-bali-tokyo" d="M 820,312 Q 865,220 885,165" class="flight-arc-path" />
                                    <!-- Bali to Australia (Sydney/Melbourne) -->
                                    <path id="arc-bali-aus" d="M 820,312 Q 870,340 905,395" class="flight-arc-path" />
                                    <!-- Bali to USA & Caribbean (Cruise Line Hub Miami) -->
                                    <path id="arc-bali-usa" d="M 820,312 Q 520,60 275,195" class="flight-arc-path" />
                                </g>

                                {{-- Geographic Nodes & Radar Pulse Beacons --}}
                                <g id="dhs-map-nodes">
                                    <!-- Bali HQ (Always Active & Prominently Glowing) -->
                                    <g id="node-bali" class="map-node active-node" transform="translate(820, 312)">
                                        <circle r="16" fill="none" stroke="#C5A880" stroke-width="1.5" class="radar-circle-1" />
                                        <circle r="26" fill="none" stroke="#C5A880" stroke-width="0.8" class="radar-circle-2" opacity="0.6" />
                                        <circle r="6" fill="#C53030" stroke="#FFF" stroke-width="2" />
                                        <text x="14" y="4" fill="#E5C397" font-size="10.5" font-family="'Inter', sans-serif" font-weight="bold" letter-spacing="0.5">BALI (HQ)</text>
                                    </g>

                                    <!-- Klungkung Hub -->
                                    <g id="node-klungkung" class="map-node" transform="translate(828, 308)">
                                        <circle r="4.5" fill="#C5A880" stroke="#FFF" stroke-width="1.5" />
                                        <text x="10" y="-8" fill="#FFF" font-size="9" font-family="'Inter', sans-serif" font-weight="600">KLUNGKUNG</text>
                                    </g>

                                    <!-- Singapore -->
                                    <g id="node-singapore" class="map-node" transform="translate(770, 280)">
                                        <circle r="12" fill="none" stroke="#C5A880" stroke-width="1" class="radar-circle-1" />
                                        <circle r="4.5" fill="#E5C397" stroke="#FFF" stroke-width="1.5" />
                                        <text x="-12" y="-10" fill="#E2E8F0" font-size="9.5" font-family="'Inter', sans-serif" font-weight="600" text-anchor="end">🇸🇬 SINGAPURA</text>
                                    </g>

                                    <!-- Switzerland -->
                                    <g id="node-swiss" class="map-node" transform="translate(518, 135)">
                                        <circle r="14" fill="none" stroke="#C5A880" stroke-width="1.2" class="radar-circle-1" />
                                        <circle r="5" fill="#C53030" stroke="#FFF" stroke-width="1.8" />
                                        <text x="-12" y="-6" fill="#F8FAFC" font-size="10" font-family="'Inter', sans-serif" font-weight="bold" text-anchor="end">🇨🇭 SWISS</text>
                                    </g>

                                    <!-- Germany -->
                                    <g id="node-germany" class="map-node" transform="translate(522, 118)">
                                        <circle r="12" fill="none" stroke="#C5A880" stroke-width="1" class="radar-circle-1" />
                                        <circle r="4.5" fill="#E5C397" stroke="#FFF" stroke-width="1.5" />
                                        <text x="12" y="-6" fill="#E2E8F0" font-size="9.5" font-family="'Inter', sans-serif" font-weight="600">🇩🇪 JERMAN</text>
                                    </g>

                                    <!-- Dubai UAE -->
                                    <g id="node-dubai" class="map-node" transform="translate(645, 205)">
                                        <circle r="12" fill="none" stroke="#C5A880" stroke-width="1" class="radar-circle-1" />
                                        <circle r="4.5" fill="#E5C397" stroke="#FFF" stroke-width="1.5" />
                                        <text x="-10" y="-8" fill="#E2E8F0" font-size="9.5" font-family="'Inter', sans-serif" font-weight="600" text-anchor="end">🇦🇪 DUBAI</text>
                                    </g>

                                    <!-- Tokyo Japan -->
                                    <g id="node-tokyo" class="map-node" transform="translate(885, 165)">
                                        <circle r="12" fill="none" stroke="#C5A880" stroke-width="1" class="radar-circle-1" />
                                        <circle r="4.5" fill="#E5C397" stroke="#FFF" stroke-width="1.5" />
                                        <text x="10" y="4" fill="#E2E8F0" font-size="9.5" font-family="'Inter', sans-serif" font-weight="600">🇯🇵 JEPANG</text>
                                    </g>

                                    <!-- Australia (Sydney) -->
                                    <g id="node-australia" class="map-node" transform="translate(905, 395)">
                                        <circle r="14" fill="none" stroke="#C5A880" stroke-width="1" class="radar-circle-1" />
                                        <circle r="5" fill="#C53030" stroke="#FFF" stroke-width="1.8" />
                                        <text x="12" y="4" fill="#F8FAFC" font-size="9.5" font-family="'Inter', sans-serif" font-weight="bold">🇦🇺 AUSTRALIA</text>
                                    </g>

                                    <!-- USA & Caribbean (Cruise Line HQ) -->
                                    <g id="node-usa" class="map-node" transform="translate(275, 195)">
                                        <circle r="15" fill="none" stroke="#C5A880" stroke-width="1.2" class="radar-circle-1" />
                                        <circle r="5" fill="#C53030" stroke="#FFF" stroke-width="1.8" />
                                        <text x="-12" y="4" fill="#F8FAFC" font-size="9.5" font-family="'Inter', sans-serif" font-weight="bold" text-anchor="end">🇺🇸 USA & CARIBBEAN</text>
                                    </g>
                                </g>
                            </svg>
                        </div>

                        {{-- Map Legend Bar --}}
                        <div class="mt-4 pt-3 flex flex-wrap items-center justify-between gap-3 text-[0.68rem] text-slate-400" style="border-top: 1px solid rgba(255, 255, 255, 0.12);">
                            <div class="flex items-center gap-4">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full border border-white" style="background-color: #C53030;"></span>
                                    <span>Hub Utama DHS (Bali)</span>
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full" style="background-color: #E5C397;"></span>
                                    <span>Destinasi Global</span>
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <span class="w-5 h-0.5" style="background: linear-gradient(90deg, #C53030, #E5C397);"></span>
                                    <span>Lintasan Karir Dunia</span>
                                </span>
                            </div>
                            <div class="font-mono text-[0.68rem] font-bold" style="color: #cbd5e1;">
                                JARINGAN 20+ NEGARA
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Luxury Scoped Styling for Map, Radar, and Responsive Grid --}}
    <style>
        /* Scoped Theater Grid Layout */
        .dhs-theater-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.75rem;
            width: 100%;
            align-items: stretch;
        }
        @media (min-width: 1024px) {
            .dhs-theater-grid {
                grid-template-columns: 42% calc(58% - 1.75rem);
            }
        }
        .dhs-story-col, .dhs-map-col {
            min-width: 0;
            width: 100%;
        }
        .dhs-glass-card {
            background: linear-gradient(180deg, rgba(14, 30, 52, 0.95) 0%, rgba(7, 19, 34, 0.98) 100%);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 1.5rem;
            padding: 1.75rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
        }

        /* Scoped Year Pills */
        .dhs-chrono-pill {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(197, 168, 128, 0.3);
            color: #cbd5e1;
            cursor: pointer;
        }
        .dhs-chrono-pill:hover {
            background: rgba(255, 255, 255, 0.18);
            color: #ffffff;
            border-color: rgba(197, 168, 128, 0.7);
        }
        .dhs-chrono-pill .pill-dot {
            background-color: #94a3b8;
        }
        .dhs-chrono-pill.active {
            background: linear-gradient(135deg, #C53030 0%, #C5A880 100%) !important;
            color: #ffffff !important;
            border-color: rgba(255, 255, 255, 0.7) !important;
            box-shadow: 0 4px 20px rgba(197, 48, 48, 0.5) !important;
            transform: scale(1.03);
        }
        .dhs-chrono-pill.active .pill-dot {
            background-color: #ffffff !important;
            box-shadow: 0 0 8px #ffffff;
        }

        /* Map Viewport Container */
        .dhs-map-viewport {
            position: relative;
            width: 100%;
            min-height: 360px;
            height: 400px;
            background: #06101D;
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .dhs-map-viewport svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        /* Radar Beacon Rings */
        .radar-circle-1 {
            animation: radarPulse 2.4s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
            transform-origin: center;
        }
        .radar-circle-2 {
            animation: radarPulse 2.4s infinite cubic-bezier(0.215, 0.61, 0.355, 1) 0.8s;
            transform-origin: center;
        }
        @keyframes radarPulse {
            0% { r: 4; opacity: 0.95; stroke-width: 1.5; }
            50% { opacity: 0.5; }
            100% { r: 24; opacity: 0; stroke-width: 0.4; }
        }

        /* Flight Arc Path - Streaming Golden Radar Dash */
        .flight-arc-path {
            opacity: 0;
            stroke-dasharray: 8 6;
            stroke-dashoffset: 0;
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
        }
        .flight-arc-path.active-arc {
            opacity: 1 !important;
            animation: arcDashStream 8s linear infinite;
        }
        @keyframes arcDashStream {
            from { stroke-dashoffset: 0; }
            to { stroke-dashoffset: -140; }
        }

        /* Map Nodes Active / Inactive states */
        .map-node {
            opacity: 0.25;
            transition: opacity 0.45s ease, transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
            transform-box: fill-box;
            transform-origin: center;
        }
        .map-node.active-node {
            opacity: 1 !important;
            transform: scale(1.1);
        }
    </style>

    {{-- Interactive Controller Script --}}
    <script>
    (function() {
        const milestones = @json($timelineStages);
        let currentIndex = 0;
        let autoplayTimer = null;
        let isAutoplay = true;

        function updateUI(idx) {
            currentIndex = idx;
            const data = milestones[idx];
            if (!data) return;

            // Update Pills
            document.querySelectorAll('.dhs-chrono-pill').forEach((pill, i) => {
                pill.classList.toggle('active', i === idx);
            });

            // Update Counter
            const counter = document.getElementById('dhs-milestone-counter');
            if (counter) {
                counter.textContent = 'FASE ' + String(idx + 1).padStart(2, '0') + ' / ' + String(milestones.length).padStart(2, '0');
            }

            // Update Story Card with smooth fade
            const cardYear = document.getElementById('dhs-card-year');
            const cardYearWatermark = document.getElementById('dhs-card-year-watermark');
            const cardPhase = document.getElementById('dhs-card-phase-badge');
            const cardHub = document.getElementById('dhs-card-hub');
            const cardTitle = document.getElementById('dhs-card-title');
            const cardDesc = document.getElementById('dhs-card-desc');
            const cardHighlight = document.getElementById('dhs-card-highlight');
            const cardIcon = document.getElementById('dhs-card-icon');
            const mapActiveBadge = document.getElementById('dhs-map-active-badge');

            if (cardYear) cardYear.textContent = data.year;
            if (cardYearWatermark) cardYearWatermark.textContent = data.year;
            if (cardPhase) cardPhase.textContent = data.phase.toUpperCase();
            if (cardHub) cardHub.textContent = data.hub;
            if (cardTitle) cardTitle.textContent = data.title;
            if (cardDesc) cardDesc.textContent = data.desc;
            if (cardHighlight) cardHighlight.textContent = data.highlight;
            if (cardIcon) cardIcon.textContent = data.icon;

            // Update Map Nodes
            const allNodes = document.querySelectorAll('.map-node');
            allNodes.forEach(node => {
                const id = node.id.replace('node-', '');
                if (data.nodes.includes(id)) {
                    node.classList.add('active-node');
                } else {
                    node.classList.remove('active-node');
                }
            });

            // Update Flight Arcs
            const allArcs = document.querySelectorAll('.flight-arc-path');
            allArcs.forEach(arc => {
                const id = arc.id.replace('arc-', '');
                if (data.arcs.includes(id)) {
                    arc.classList.add('active-arc');
                } else {
                    arc.classList.remove('active-arc');
                }
            });

            // Map Badge
            if (mapActiveBadge) {
                const activeCount = data.nodes.length;
                mapActiveBadge.textContent = activeCount + ' HUB AKTIF';
            }
        }

        window.dhsSelectMilestone = function(idx) {
            updateUI(idx);
            // Reset autoplay timer on user interaction
            if (isAutoplay) {
                startAutoplay();
            }
        };

        window.dhsNavMilestone = function(direction) {
            let next = (currentIndex + direction + milestones.length) % milestones.length;
            dhsSelectMilestone(next);
        };

        function startAutoplay() {
            if (autoplayTimer) clearInterval(autoplayTimer);
            autoplayTimer = setInterval(() => {
                let next = (currentIndex + 1) % milestones.length;
                updateUI(next);
            }, 5500); // changes every 5.5s
        }

        function stopAutoplay() {
            if (autoplayTimer) {
                clearInterval(autoplayTimer);
                autoplayTimer = null;
            }
        }

        window.dhsToggleAutoplay = function() {
            isAutoplay = !isAutoplay;
            const icon = document.getElementById('dhs-autoplay-icon');
            const label = document.getElementById('dhs-autoplay-label');
            if (isAutoplay) {
                startAutoplay();
                if (icon) icon.textContent = 'pause';
                if (label) label.textContent = 'Otomatis';
            } else {
                stopAutoplay();
                if (icon) icon.textContent = 'play_arrow';
                if (label) label.textContent = 'Jeda';
            }
        };

        // Initialize on DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            updateUI(0);
            startAutoplay();
        });
    })();
    </script>


    <!-- Pesan Direktur Section -->
    <section class="bg-white py-20 md:py-24 px-5 md:px-16 max-w-[1280px] mx-auto border-t border-black/5">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-center">
            <div class="md:col-span-1" data-reveal="fade-right">
                <img class="w-full h-auto object-cover border border-black/10" alt="{{ $leaderTeam[0]['name'] ?? 'Direktur DHS' }}"
                    src="{{ $directorPhoto }}">
            </div>
            <div class="md:col-span-2 text-text-light" data-reveal="fade-left" data-delay="200">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                    <span data-id="KATA SAMBUTAN" data-en="WELCOME MESSAGE">KATA SAMBUTAN</span>
                </span>
                <h2 class="text-[32px] font-semibold font-serif mb-6"><span data-id="Pesan Direktur" data-en="Director's Message">Pesan Direktur</span></h2>
                <div class="text-base text-muted-light leading-relaxed space-y-4">
                    @if($directorP1)
                    <p><span data-id="{{ $directorP1 }}" data-en="{{ $directorP1 }}">{{ $directorP1 }}</span></p>
                    @endif
                    @if($directorP2)
                    <p><span data-id="{{ $directorP2 }}" data-en="{{ $directorP2 }}">{{ $directorP2 }}</span></p>
                    @endif
                    <p class="font-bold text-primary pt-4">Salam Excellent!<br>— {{ $leaderTeam[0]['name'] ?? 'Direktur DHS' }} (<span data-id="Direktur" data-en="Director">Direktur</span>)</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tim Kepemimpinan -->
    <section class="bg-white py-20 md:py-24">
        <div class="px-5 md:px-16 max-w-[1280px] mx-auto">
            <div class="text-center mb-16" data-reveal="fade-up">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                    <span data-id="Orang-Orang di Balik DHS" data-en="The People Behind DHS">Orang-Orang di Balik DHS</span>
                </span>
                <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">
                    <span data-id="Tim Kepemimpinan" data-en="Leadership Team">Tim Kepemimpinan</span>
                </h2>
            </div>

            @php
                $count = count($leaderTeam);
                $gridClass = match(true) {
                    $count === 1 => 'grid grid-cols-1 justify-items-center',
                    $count === 2 => 'grid grid-cols-1 md:grid-cols-2 gap-8 max-w-2xl mx-auto',
                    default      => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8',
                };
            @endphp

            <div class="{{ $gridClass }}">
                @foreach($leaderTeam as $i => $member)
                @php
                    $mName  = $member['name']  ?? '';
                    $mTitle = $member['title'] ?? '';
                    $mBio   = $member['bio']   ?? '';
                    $mPhoto = !empty($member['photo']) ? $member['photo'] : $directorPhoto;
                @endphp
                <div class="group text-center {{ $count === 1 ? 'mx-auto max-w-xs' : '' }}" data-reveal="zoom-in" data-delay="{{ $i * 100 }}">
                    <div class="relative overflow-hidden mb-6 aspect-square max-w-[280px] mx-auto">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            alt="{{ $mName }}"
                            src="{{ $mPhoto }}">
                    </div>
                    <h3 class="text-[20px] font-semibold font-serif text-text-light mb-1">{{ $mName }}</h3>
                    <p class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-3"><span data-id="{{ $mTitle }}" data-en="{{ $mTitle }}">{{ $mTitle }}</span></p>
                    <p class="text-sm text-muted-light leading-relaxed"><span data-id="{{ $mBio }}" data-en="{{ $mBio }}">{{ $mBio }}</span></p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Partnership & Mitra Section -->
    <section class="py-12 md:py-16 bg-white/50 border-t border-b border-black/5 overflow-hidden">
        <div class="max-w-[1280px] mx-auto px-5 md:px-16 text-center mb-10">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                <span data-id="Kemitraan &amp; Jaringan Global" data-en="Partnership &amp; Global Network">Kemitraan &amp; Jaringan Global</span>
            </span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6" data-reveal="fade-up">
                <span data-id="Partnership Program" data-en="Partnership Program">Partnership Program</span>
            </h2>
            <p class="text-base text-muted-light max-w-3xl mx-auto leading-relaxed" data-reveal="fade-up" data-delay="100">
                <span data-id="DHS berkomitmen penuh untuk mengintegrasikan pendidikan vokasi dengan dunia industri global. Program ini menjamin penempatan magang internasional (OJT) berkualitas dan penyaluran kerja langsung di hotel bintang 4 &amp; 5 serta kapal pesiar mewah tanpa potongan agen fee (Zero Agent Fee)." data-en="DHS is fully committed to integrating vocational education with the global industry. This program guarantees high-quality international internship (OJT) placement and direct recruitment in 4 &amp; 5-star hotels and luxury cruise lines with absolutely zero agent fees.">DHS berkomitmen penuh untuk mengintegrasikan pendidikan vokasi dengan dunia industri global. Program ini menjamin penempatan magang internasional (OJT) berkualitas dan penyaluran kerja langsung di hotel bintang 4 &amp; 5 serta kapal pesiar mewah tanpa potongan agen fee (Zero Agent Fee).</span>
            </p>
        </div>

        @php
            $renderCard = function($item) {
                $name = e(is_array($item) ? ($item['name'] ?? '') : ($item->name ?? ''));
                $logo = is_array($item) ? ($item['logo_url'] ?? '') : ($item->logo_url ?? '');

                $out = '<div class="bg-white border border-black/10 hover:border-primary/30 hover:shadow-md transition-all duration-300 flex flex-col items-center justify-center w-48 h-32 p-4 cursor-default select-none shrink-0 rounded-lg gap-3">';

                // Logo area
                $out .= '<div class="flex items-center justify-center w-full h-16 flex-shrink-0">';
                if (!empty($logo)) {
                    $out .= '<img src="' . e($logo) . '" alt="' . $name . '" class="max-w-full max-h-full object-contain" loading="lazy">';
                } else {
                    $out .= '<div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center"><span class="material-icons text-slate-400 text-2xl">business</span></div>';
                }
                $out .= '</div>';

                // Text area below logo
                $out .= '<div class="text-center w-full pt-2 border-t border-slate-100">';
                $out .= '<div class="font-sans text-[0.7rem] font-bold tracking-wide text-dhs-navy line-clamp-1 leading-tight">' . $name . '</div>';
                $out .= '</div>';

                $out .= '</div>';
                return $out;
            };
            $marqueeItems = function($items) use ($renderCard) {
                $out = '';
                for ($i = 0; $i < 3; $i++) {
                    foreach ($items as $item) {
                        $out .= $renderCard($item);
                    }
                }
                return $out;
            };
            $mitraIndustri = ($partners ?? collect())->filter(fn($p) => $p->partner_group === 'mitra_industri')->values();
            $partnershipItems = ($partners ?? collect())->filter(fn($p) => $p->partner_group === 'partnership')->values();
        @endphp

        @if(($partners ?? collect())->count() > 0)
        <div class="space-y-6 select-none">
            {{-- Row 1: Mitra Industri — scroll left --}}
            @if($mitraIndustri->count() > 0)
            <div class="marquee-container relative flex overflow-hidden w-full">
                <div class="marquee-track flex shrink-0 gap-8 py-4 animate-marquee-left" data-direction="left">
                    {!! $marqueeItems($mitraIndustri) !!}
                </div>
            </div>
            @endif
            {{-- Row 2: Partnership — scroll right --}}
            @if($partnershipItems->count() > 0)
            <div class="marquee-container relative flex overflow-hidden w-full">
                <div class="marquee-track flex shrink-0 gap-8 py-4 animate-marquee-right" data-direction="right">
                    {!! $marqueeItems($partnershipItems) !!}
                </div>
            </div>
            @endif
        </div>
        @endif
    </section>

    <style>
        @keyframes marquee-left {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        @keyframes marquee-right {
            0%   { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }
        .animate-marquee-left {
            animation: marquee-left var(--dur, 40s) linear infinite;
            will-change: transform;
            backface-visibility: hidden;
        }
        .animate-marquee-right {
            animation: marquee-right var(--dur, 40s) linear infinite;
            will-change: transform;
            backface-visibility: hidden;
        }
        .marquee-container:hover .animate-marquee-left,
        .marquee-container:hover .animate-marquee-right {
            animation-play-state: paused;
        }
    </style>
    <script>
    (function() {
        var PX_PER_SECOND = 80;
        function initMarquee() {
            document.querySelectorAll('.marquee-track').forEach(function(track) {
                var halfWidth = track.scrollWidth / 2;
                if (halfWidth > 0) {
                    var duration = halfWidth / PX_PER_SECOND;
                    track.style.setProperty('--dur', duration.toFixed(2) + 's');
                }
            });
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMarquee);
        } else {
            initMarquee();
        }
        var resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(initMarquee, 200);
        });
    })();
    </script>

    <!-- CTA Section -->
    <section class="bg-dhs-lightblue py-20 md:py-24 px-5 md:px-16">
        <div class="max-w-3xl mx-auto text-center" data-reveal="zoom-in">
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6">
                <span data-id="Jadilah Bagian dari Keluarga DHS" data-en="Become Part of the DHS Family">Jadilah Bagian dari Keluarga DHS</span>
            </h2>
            <p class="text-lg text-muted-light mb-10 leading-relaxed">
                <span data-id="Bergabunglah dengan ribuan alumni kami yang telah berhasil membangun karir gemilang di industri hospitality global." data-en="Join thousands of our alumni who have successfully built brilliant careers in the global hospitality industry.">Bergabunglah dengan ribuan alumni kami yang telah berhasil membangun karir gemilang di industri hospitality global.</span>
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4" data-reveal="fade-up" data-delay="200">
                <a class="px-8 py-4 bg-primary text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:opacity-90 transition-opacity" href="{{ $ctaBtn1Url }}"><span data-id="Jelajahi Program" data-en="Explore Programs">{{ $ctaBtn1 }}</span></a>
                <a class="px-8 py-4 bg-transparent border border-dhs-navy text-dhs-navy text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-navy hover:text-white transition-colors" href="{{ $ctaBtn2Url }}"><span data-id="Daftar Sekarang" data-en="Register Now">{{ $ctaBtn2 }}</span></a>
            </div>
        </div>
    </section>
@endsection