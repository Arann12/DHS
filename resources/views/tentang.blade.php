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

    // Meta konfigurasi interaktif Minimalist Single-Screen Time-Machine
    $stageMeta = [
        '2005' => [
            'phase' => 'Langkah Awal',
            'hub' => 'Denpasar, Bali',
            'image' => '/image/about_dhs.jpg',
            'stat_val' => 'EST. 2005',
            'stat_label' => 'Tahun Pendirian',
            'stat_desc' => 'Berdiri di bawah Yayasan Guna Widya Paramesthi',
            'badge' => 'KAMPUS PERDANA'
        ],
        '2009' => [
            'phase' => 'Akreditasi A',
            'hub' => 'Pusat Vokasi Bali',
            'image' => '/image/short_course.jpg',
            'stat_val' => 'GRADE A',
            'stat_label' => 'Akreditasi BAN-PT',
            'stat_desc' => 'Pengakuan resmi mutu pendidikan kejuruan nasional',
            'badge' => 'MUTU TERBAIK'
        ],
        '2013' => [
            'phase' => 'Ekspansi Kampus',
            'hub' => 'Klungkung, Bali',
            'image' => '/image/culinary_students.jpg',
            'stat_val' => '4.500 m²',
            'stat_label' => 'Luas Fasilitas',
            'stat_desc' => 'Training Center terintegrasi kitchen, bar & restoran',
            'badge' => 'PUSAT PRAKTEK'
        ],
        '2017' => [
            'phase' => 'Kemitraan Global',
            'hub' => 'Jaringan Hotel Bintang 5',
            'image' => '/image/hotel_lobby.jpg',
            'stat_val' => '5-STAR',
            'stat_label' => 'Mitra Marriott Group',
            'stat_desc' => 'Jalur karir langsung tanpa potongan biaya agen',
            'badge' => 'GLOBAL NETWORK'
        ],
        '2022' => [
            'phase' => 'Program Luar Negeri',
            'hub' => 'Swiss & Singapura',
            'image' => '/image/international_program.jpg',
            'stat_val' => '2 BENUA',
            'stat_label' => 'Program Exchange',
            'stat_desc' => 'Belajar dan magang berbayar di Eropa dan Asia',
            'badge' => 'GO INTERNATIONAL'
        ],
        '2024' => [
            'phase' => 'Jejak Global',
            'hub' => '20+ Negara & Kapal Pesiar',
            'image' => '/image/Kapal.jpg',
            'stat_val' => '3.000+',
            'stat_label' => 'Alumni Internasional',
            'stat_desc' => 'Berkarir di kapal pesiar dunia & hotel bintang 5',
            'badge' => 'ALUMNI DUNIA'
        ],
        '2026' => [
            'phase' => 'Era Vokasi Cerdas',
            'hub' => 'Kampus Masa Depan',
            'image' => '/image/campus_students.jpg',
            'stat_val' => 'SMART HUB',
            'stat_label' => 'Hospitality Digital',
            'stat_desc' => 'Integrasi teknologi digital & kurikulum modern',
            'badge' => 'MASA DEPAN'
        ]
    ];

    $timelineStages = [];
    foreach ($timelineItems as $item) {
        $yr = (string)($item['year'] ?? '');
        $meta = $stageMeta[$yr] ?? [
            'phase' => 'Milestone',
            'hub' => 'Bali, Indonesia',
            'image' => '/image/about_dhs.jpg',
            'stat_val' => $yr,
            'stat_label' => 'Tahun Milestone',
            'stat_desc' => 'Transformasi pendidikan hospitality berkelanjutan',
            'badge' => 'MILESTONE'
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


        
    
    
    <!-- ░░ FULLSCREEN 100VH IMMERSIVE TIME-MACHINE (SEJARAH & MILESTONE) ░░ -->
    <section id="fullscreen-chrono-section" class="dhs-fullscreen-chrono w-full text-white select-none relative overflow-hidden" style="background: #080D15; color: #ffffff;">
        {{-- Subtle Ambient Radial Lighting --}}
        <div class="absolute -top-32 right-1/4 w-[500px] h-[500px] rounded-full pointer-events-none opacity-20" style="background: radial-gradient(circle, #C5A880 0%, transparent 70%); filter: blur(100px);"></div>
        <div class="absolute -bottom-32 left-10 w-[450px] h-[450px] rounded-full pointer-events-none opacity-15" style="background: radial-gradient(circle, #C53030 0%, transparent 70%); filter: blur(90px);"></div>

        <div class="max-w-7xl mx-auto w-full h-full flex flex-col justify-between px-4 sm:px-8 py-6 lg:py-8 relative z-10">
            {{-- Top Header & Navigation Bar --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pb-3 border-b border-white/10 shrink-0">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-2 h-2 rounded-full" style="background-color: #C5A880;"></span>
                        <span class="text-[0.68rem] tracking-[0.25em] uppercase font-bold" style="color: #E5C397;">
                            MILESTONE DHS (2005 — 2026)
                        </span>
                    </div>
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-serif font-bold tracking-tight text-white">
                        Dua Dekade Menuju Keunggulan Global
                    </h2>
                </div>

                {{-- Compact Navigation Controls --}}
                <div class="flex items-center gap-2.5 shrink-0 self-end sm:self-center">
                    <span id="dhs-counter-label" class="font-mono text-xs font-semibold px-3 py-1 rounded-full border border-white/10" style="background: rgba(255,255,255,0.05); color: #cbd5e1;">
                        01 / 0{{ count($timelineStages) }}
                    </span>
                    <button type="button" onclick="dhsChronoNav(-1)"
                            class="w-8 h-8 rounded-full border border-white/15 flex items-center justify-center text-white transition-all hover:bg-white/10 hover:border-white/30 cursor-pointer active:scale-95"
                            title="Sebelumnya (Arrow Left / Scroll Up)">
                        <span class="material-icons text-base">arrow_back</span>
                    </button>
                    <button type="button" onclick="dhsChronoNav(1)"
                            class="w-8 h-8 rounded-full border border-white/15 flex items-center justify-center text-white transition-all hover:bg-white/10 hover:border-white/30 cursor-pointer active:scale-95"
                            title="Selanjutnya (Arrow Right / Scroll Down)">
                        <span class="material-icons text-base">arrow_forward</span>
                    </button>
                    <button type="button" id="dhs-chrono-autoplay-btn" onclick="dhsChronoToggleAutoplay()"
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border border-white/15 text-xs text-slate-300 hover:text-white hover:bg-white/10 transition-colors cursor-pointer"
                            title="Jeda / Putar Otomatis">
                        <span class="material-icons text-xs" id="dhs-chrono-autoplay-icon">pause</span>
                        <span id="dhs-chrono-autoplay-text" class="text-[0.65rem] uppercase tracking-wider font-semibold">Otomatis</span>
                    </button>
                </div>
            </div>

            {{-- Center Viewport: Split Screen (50:50) with 3D Parallax Tilt --}}
            <div class="flex-1 flex items-center justify-center my-auto py-3 lg:py-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center w-full">
                    {{-- Left Column: 3D Tilt Archival Visual Theater (lg:col-span-6) --}}
                    <div class="lg:col-span-6 w-full flex justify-center">
                        <div class="dhs-tilt-perspective w-full max-w-[540px]">
                            <div id="dhs-tilt-card" class="dhs-tilt-card group">
                                <img id="dhs-chrono-img"
                                     src="/image/about_dhs.jpg"
                                     alt="Denpasar Hotel School Milestone"
                                     class="dhs-photo-kenburns" />

                                {{-- Specular Glare Overlay --}}
                                <div id="dhs-glare" class="dhs-glare-overlay"></div>

                                {{-- Subtle Vignette --}}
                                <div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(180deg, rgba(8,13,21,0.05) 0%, rgba(8,13,21,0.65) 100%);"></div>

                                {{-- Floating Badges over Photo --}}
                                <div class="absolute top-4 left-4 z-10">
                                    <span id="dhs-photo-badge" class="px-3 py-1 rounded-full text-[0.65rem] font-bold tracking-widest uppercase border backdrop-blur-md"
                                          style="background: rgba(8, 13, 21, 0.75); border-color: rgba(197, 168, 128, 0.4); color: #E5C397;">
                                        KAMPUS PERDANA
                                    </span>
                                </div>

                                {{-- Top-Right Lightbox Zoom Button --}}
                                <div class="absolute top-4 right-4 z-10">
                                    <button type="button"
                                            id="dhs-zoom-btn"
                                            class="w-8 h-8 rounded-full border border-white/20 bg-black/50 backdrop-blur-md flex items-center justify-center text-white/80 hover:text-white hover:scale-110 transition-all cursor-pointer"
                                            onclick="dhsOpenCurrentLightbox()"
                                            title="Perbesar Foto Arsip">
                                        <span class="material-icons text-sm">fullscreen</span>
                                    </button>
                                </div>

                                {{-- Bottom Location Bar --}}
                                <div class="absolute bottom-4 left-4 right-4 z-10 flex items-center justify-between text-xs backdrop-blur-md px-4 py-2.5 rounded-xl border border-white/10" style="background: rgba(8, 13, 21, 0.8);">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons text-sm" style="color: #E5C397;">place</span>
                                        <span id="dhs-photo-hub" class="font-medium text-white">Denpasar, Bali</span>
                                    </div>
                                    <span class="text-[0.65rem] font-mono tracking-wider text-slate-400">HISTORIC ARCHIVE</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Kinetic Editorial Narrative (lg:col-span-6) --}}
                    <div class="lg:col-span-6 flex flex-col justify-center">
                        <div class="space-y-4 max-w-xl">
                            {{-- Phase Indicator --}}
                            <div class="flex items-center gap-2">
                                <span class="text-xs uppercase tracking-[0.25em] font-bold" style="color: #E5C397;" id="dhs-chrono-phase">
                                    01 / LANGKAH AWAL
                                </span>
                            </div>

                            {{-- Rolling Number Year Animation Container --}}
                            <div class="dhs-rolling-year-container">
                                <div id="dhs-chrono-year" class="dhs-rolling-year font-serif italic font-extrabold text-5xl sm:text-6xl lg:text-7xl tracking-tight leading-none" style="color: #C5A880;">
                                    2005
                                </div>
                            </div>

                            {{-- Milestone Title --}}
                            <h3 class="text-xl sm:text-2xl lg:text-3xl font-serif font-bold text-white tracking-wide transition-opacity duration-300" id="dhs-chrono-title">
                                Pendirian Kampus Denpasar
                            </h3>

                            {{-- Milestone Description --}}
                            <p class="text-sm sm:text-base text-slate-300 leading-relaxed transition-opacity duration-300" id="dhs-chrono-desc">
                                Denpasar Hotel School didirikan di Bali dengan visi menghadirkan standar pendidikan kejuruan hospitality bertaraf internasional.
                            </p>

                            {{-- Single Metric Card --}}
                            <div class="pt-3">
                                <div class="p-3.5 sm:p-4 rounded-2xl border border-white/10 flex items-center gap-4 transition-all" style="background: rgba(255, 255, 255, 0.04);">
                                    <div class="font-serif text-2xl sm:text-3xl font-extrabold shrink-0 tracking-tight" style="color: #E5C397;" id="dhs-stat-val">
                                        EST. 2005
                                    </div>
                                    <div class="w-px h-10 bg-white/15 shrink-0"></div>
                                    <div class="min-w-0">
                                        <div class="text-[0.68rem] uppercase tracking-wider font-semibold text-slate-400" id="dhs-stat-label">
                                            Tahun Pendirian
                                        </div>
                                        <div class="text-xs sm:text-sm font-medium text-white truncate" id="dhs-stat-desc">
                                            Berdiri di bawah Yayasan Guna Widya Paramesthi
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom: Sleek Integrated Timeline Track with Live Pulse Beam --}}
            <div class="pt-3 border-t border-white/10 shrink-0">
                <div class="relative py-2">
                    {{-- Base Track Rail --}}
                    <div class="dhs-track-line">
                        {{-- Completed Fill --}}
                        <div id="dhs-track-fill" class="dhs-track-fill" style="width: 0%;"></div>
                        {{-- Live Beam Counting Progress --}}
                        <div id="dhs-track-live-beam" class="dhs-track-live-beam"></div>
                    </div>

                    {{-- Milestone Dots Row with Micro-Tooltips --}}
                    <div class="dhs-dots-row">
                        @foreach($timelineStages as $idx => $m)
                        <div class="relative group/dot flex flex-col items-center">
                            {{-- Floating Hover Tooltip --}}
                            <div class="dhs-dot-tooltip">
                                <span class="font-serif font-bold text-dhs-gold text-xs">{{ $m['year'] }}</span>
                                <span class="text-[0.65rem] text-slate-200 block whitespace-nowrap">{{ $m['title'] }}</span>
                            </div>

                            <button type="button"
                                    class="dhs-dot-btn {{ $idx === 0 ? 'active' : '' }}"
                                    id="dhs-dot-{{ $idx }}"
                                    onclick="dhsChronoSelect({{ $idx }})"
                                    aria-label="Pilih Tahun {{ $m['year'] }}">
                                <div class="dhs-dot-bezel">
                                    <div class="dhs-dot-core"></div>
                                </div>
                                <span class="dhs-dot-year">{{ $m['year'] }}</span>
                                <span class="dhs-dot-phase hidden md:inline-block">{{ $m['phase'] }}</span>
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ░░ SCOPED FULLSCREEN LUXURY CSS ░░ --}}
    <style>
        /* Exact 100vh on Desktop */
        .dhs-fullscreen-chrono {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            scroll-snap-align: start;
        }
        @media (min-width: 1024px) {
            .dhs-fullscreen-chrono {
                height: 100vh;
                max-height: 100vh;
            }
        }

        /* 3D Parallax Tilt Card Container */
        .dhs-tilt-perspective {
            perspective: 1200px;
        }
        .dhs-tilt-card {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 10;
            max-height: 400px;
            border-radius: 1.25rem;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.7);
            background: #060B12;
            transform-style: preserve-3d;
            transform: rotateX(var(--rx, 0deg)) rotateY(var(--ry, 0deg));
            transition: transform 0.15s ease-out, box-shadow 0.3s ease;
        }
        .dhs-tilt-card:hover {
            box-shadow: 0 25px 60px rgba(197, 168, 128, 0.25);
        }
        @media (max-width: 640px) {
            .dhs-tilt-card {
                aspect-ratio: 4 / 3;
            }
        }
        .dhs-photo-kenburns {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            animation: dhsKenBurnsMotion 18s ease-in-out infinite alternate;
            transition: opacity 0.4s ease-in-out;
        }
        @keyframes dhsKenBurnsMotion {
            0% { transform: scale(1) translate(0, 0); }
            50% { transform: scale(1.06) translate(-1%, -0.8%); }
            100% { transform: scale(1.03) translate(0.8%, -1%); }
        }

        /* Specular Glare */
        .dhs-glare-overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: radial-gradient(circle at var(--gx, 50%) var(--gy, 50%), rgba(255, 255, 255, 0.18) 0%, transparent 60%);
            opacity: var(--go, 0);
            transition: opacity 0.2s ease;
            mix-blend-mode: overlay;
            z-index: 5;
        }

        /* Rolling Year Animation */
        .dhs-rolling-year-container {
            overflow: hidden;
            height: 4.5rem;
            display: flex;
            align-items: center;
        }
        .dhs-rolling-year {
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.35s ease;
        }
        .dhs-rolling-year.anim-out {
            transform: translateY(-50px);
            opacity: 0;
        }
        .dhs-rolling-year.anim-in {
            transform: translateY(50px);
            opacity: 0;
        }

        /* Timeline Track & Active Fill */
        .dhs-track-line {
            position: relative;
            width: 100%;
            height: 3px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 999px;
            margin: 12px 0;
            overflow: visible;
        }
        .dhs-track-fill {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background: linear-gradient(90deg, #C53030 0%, #C5A880 100%);
            border-radius: 999px;
            box-shadow: 0 0 10px rgba(197, 168, 128, 0.7);
            transition: width 0.45s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .dhs-track-live-beam {
            position: absolute;
            top: -2px;
            height: 7px;
            width: 24px;
            background: radial-gradient(circle, #ffffff 0%, #E5C397 50%, transparent 80%);
            border-radius: 999px;
            box-shadow: 0 0 12px #ffffff;
            transition: left 0.1s linear;
            pointer-events: none;
            opacity: 0.8;
        }

        /* Dots Row & Interactive Buttons */
        .dhs-dots-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-top: -21px;
        }
        .dhs-dot-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 4px;
            user-select: none;
            transition: transform 0.25s ease;
        }
        .dhs-dot-btn:hover {
            transform: translateY(-2px);
        }
        .dhs-dot-bezel {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #080D15;
            border: 2px solid rgba(255, 255, 255, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .dhs-dot-core {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #94a3b8;
            transition: all 0.3s ease;
        }
        .dhs-dot-year {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 0.85rem;
            font-weight: 700;
            color: #94a3b8;
            margin-top: 8px;
            transition: color 0.3s ease;
        }
        .dhs-dot-phase {
            font-size: 0.62rem;
            color: #64748b;
            font-weight: 500;
            margin-top: 1px;
            transition: color 0.3s ease;
        }

        /* Active Dot State */
        .dhs-dot-btn.active .dhs-dot-bezel {
            border-color: #E5C397;
            background: #C53030;
            transform: scale(1.4);
            box-shadow: 0 0 14px rgba(229, 195, 151, 0.85);
        }
        .dhs-dot-btn.active .dhs-dot-core {
            background: #ffffff;
        }
        .dhs-dot-btn.active .dhs-dot-year {
            color: #E5C397;
            font-size: 0.95rem;
            font-weight: 800;
        }
        .dhs-dot-btn.active .dhs-dot-phase {
            color: #e2e8f0;
            font-weight: 600;
        }

        /* Hover Tooltip */
        .dhs-dot-tooltip {
            position: absolute;
            bottom: 42px;
            left: 50%;
            transform: translateX(-50%) translateY(6px);
            background: rgba(10, 18, 30, 0.95);
            border: 1px solid rgba(197, 168, 128, 0.4);
            padding: 5px 10px;
            border-radius: 8px;
            pointer-events: none;
            opacity: 0;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            backdrop-filter: blur(8px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4);
            z-index: 30;
        }
        .group\/dot:hover .dhs-dot-tooltip {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    </style>

    {{-- ░░ INTERACTIVE CONTROLLER JAVASCRIPT ░░ --}}
    <script>
    (function() {
        const milestones = @json($timelineStages);
        let currentIndex = 0;
        let autoplayTimer = null;
        let beamRaf = null;
        let isAutoplay = true;
        let lastWheelTime = 0;
        const STAGE_DURATION = 6000; // 6 seconds per stage
        let stageStartTime = Date.now();

        function updateView(idx) {
            currentIndex = idx;
            stageStartTime = Date.now();
            const data = milestones[idx];
            if (!data) return;

            // Update Photo with cross-fade
            const img = document.getElementById('dhs-chrono-img');
            if (img && data.image) {
                img.style.opacity = '0.2';
                setTimeout(() => {
                    img.src = data.image;
                    img.style.opacity = '1';
                }, 180);
            }

            // Update Photo Badges
            const photoBadge = document.getElementById('dhs-photo-badge');
            const photoHub = document.getElementById('dhs-photo-hub');
            if (photoBadge) photoBadge.textContent = data.badge || data.phase.toUpperCase();
            if (photoHub) photoHub.textContent = data.hub || 'Denpasar, Bali';

            // Rolling Year Digits Animation
            const yearEl = document.getElementById('dhs-chrono-year');
            if (yearEl) {
                yearEl.classList.add('anim-out');
                setTimeout(() => {
                    yearEl.textContent = data.year;
                    yearEl.classList.remove('anim-out');
                    yearEl.classList.add('anim-in');
                    void yearEl.offsetWidth; // trigger reflow
                    yearEl.classList.remove('anim-in');
                }, 180);
            }

            // Update Narrative Texts with soft fade
            const phase = document.getElementById('dhs-chrono-phase');
            const title = document.getElementById('dhs-chrono-title');
            const desc = document.getElementById('dhs-chrono-desc');
            const counter = document.getElementById('dhs-counter-label');

            if (phase) phase.textContent = String(idx + 1).padStart(2, '0') + ' / ' + (data.phase || '').toUpperCase();
            if (title) {
                title.style.opacity = '0.3';
                setTimeout(() => { title.textContent = data.title; title.style.opacity = '1'; }, 180);
            }
            if (desc) {
                desc.style.opacity = '0.3';
                setTimeout(() => { desc.textContent = data.desc; desc.style.opacity = '1'; }, 180);
            }
            if (counter) counter.textContent = String(idx + 1).padStart(2, '0') + ' / ' + String(milestones.length).padStart(2, '0');

            // Update Metric Box
            const statVal = document.getElementById('dhs-stat-val');
            const statLabel = document.getElementById('dhs-stat-label');
            const statDesc = document.getElementById('dhs-stat-desc');
            if (statVal) statVal.textContent = data.stat_val || data.year;
            if (statLabel) statLabel.textContent = data.stat_label || 'Pencapaian';
            if (statDesc) statDesc.textContent = data.stat_desc || data.highlight || '';

            // Update Dots
            document.querySelectorAll('.dhs-dot-btn').forEach((btn, i) => {
                btn.classList.toggle('active', i === idx);
            });

            // Update Track Progress Fill
            const fill = document.getElementById('dhs-track-fill');
            if (fill && milestones.length > 1) {
                const percent = (idx / (milestones.length - 1)) * 100;
                fill.style.width = percent + '%';
            }
        }

        window.dhsChronoSelect = function(idx) {
            updateView(idx);
            if (isAutoplay) startAutoplay();
        };

        window.dhsChronoNav = function(dir) {
            let next = (currentIndex + dir + milestones.length) % milestones.length;
            dhsChronoSelect(next);
        };

        // Live Beam Animation RAF Loop
        function animateLiveBeam() {
            if (isAutoplay && milestones.length > 1) {
                const elapsed = Date.now() - stageStartTime;
                const progressWithinStage = Math.min(elapsed / STAGE_DURATION, 1);
                
                const segmentWidth = 100 / (milestones.length - 1);
                const currentPercent = (currentIndex * segmentWidth) + (progressWithinStage * segmentWidth);
                
                const beam = document.getElementById('dhs-track-live-beam');
                if (beam) {
                    beam.style.left = 'calc(' + Math.min(currentPercent, 100) + '% - 12px)';
                    beam.style.opacity = '0.85';
                }
            } else {
                const beam = document.getElementById('dhs-track-live-beam');
                if (beam) beam.style.opacity = '0';
            }
            beamRaf = requestAnimationFrame(animateLiveBeam);
        }

        function startAutoplay() {
            if (autoplayTimer) clearInterval(autoplayTimer);
            stageStartTime = Date.now();
            autoplayTimer = setInterval(() => {
                let next = (currentIndex + 1) % milestones.length;
                updateView(next);
            }, STAGE_DURATION);
        }

        function stopAutoplay() {
            if (autoplayTimer) {
                clearInterval(autoplayTimer);
                autoplayTimer = null;
            }
        }

        window.dhsChronoToggleAutoplay = function() {
            isAutoplay = !isAutoplay;
            const icon = document.getElementById('dhs-chrono-autoplay-icon');
            const text = document.getElementById('dhs-chrono-autoplay-text');
            if (isAutoplay) {
                startAutoplay();
                if (icon) icon.textContent = 'pause';
                if (text) text.textContent = 'Otomatis';
            } else {
                stopAutoplay();
                if (icon) icon.textContent = 'play_arrow';
                if (text) text.textContent = 'Jeda';
            }
        };

        // 3D Parallax Tilt Card Implementation
        function initTilt() {
            const card = document.getElementById('dhs-tilt-card');
            if (!card) return;

            card.addEventListener('mousemove', function(e) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const cx = rect.width / 2;
                const cy = rect.height / 2;
                
                // Tilt rotation range: -7deg to +7deg
                const rx = ((y - cy) / cy) * -7;
                const ry = ((x - cx) / cx) * 7;
                
                card.style.setProperty('--rx', rx.toFixed(2) + 'deg');
                card.style.setProperty('--ry', ry.toFixed(2) + 'deg');
                card.style.setProperty('--gx', ((x / rect.width) * 100).toFixed(1) + '%');
                card.style.setProperty('--gy', ((y / rect.height) * 100).toFixed(1) + '%');
                card.style.setProperty('--go', '1');
            });

            card.addEventListener('mouseleave', function() {
                card.style.setProperty('--rx', '0deg');
                card.style.setProperty('--ry', '0deg');
                card.style.setProperty('--go', '0');
            });
        }

        // Mouse Wheel Navigation (Debounced)
        function initWheelNav() {
            const section = document.getElementById('fullscreen-chrono-section');
            if (!section) return;

            section.addEventListener('wheel', function(e) {
                const now = Date.now();
                // Cooldown 600ms between wheel steps
                if (now - lastWheelTime > 600 && Math.abs(e.deltaY) > 25) {
                    if (e.deltaY > 0) {
                        dhsChronoNav(1);
                    } else {
                        dhsChronoNav(-1);
                    }
                    lastWheelTime = now;
                    e.preventDefault();
                }
            }, { passive: false });
        }

        // Lightbox Zoom Handler
        window.dhsOpenCurrentLightbox = function() {
            const cur = milestones[currentIndex];
            if (!cur) return;
            const src = cur.image || '/image/about_dhs.jpg';
            const caption = cur.year + ' — ' + cur.title + ' (' + (cur.hub || 'Denpasar Hotel School') + ')';
            
            const modal = document.getElementById('dhs-lightbox-modal');
            const img = document.getElementById('dhs-lightbox-img');
            const cap = document.getElementById('dhs-lightbox-caption');
            if (modal && img) {
                img.src = src;
                if (cap) cap.textContent = caption;
                modal.classList.add('active');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }
        };

        // Keyboard Navigation (Arrow Left / Right)
        window.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') dhsChronoNav(-1);
            if (e.key === 'ArrowRight') dhsChronoNav(1);
        });

        // Initialize on DOM Ready
        document.addEventListener('DOMContentLoaded', function() {
            updateView(0);
            startAutoplay();
            beamRaf = requestAnimationFrame(animateLiveBeam);
            initTilt();
            initWheelNav();
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