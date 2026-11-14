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
        ['year' => '2017', 'title' => 'Kemitraan Marriott International', 'desc' => 'Penandatanganan kemitraan strategis dengan Marriott International membuka akses penyaluran karir langsung tanpa potongan biaya agen fee ke jaringan hotel bintang 5 dunia.'],
        ['year' => '2022', 'title' => 'Program Internasional Swiss & Singapura', 'desc' => 'Peluncuran program pertukaran mahasiswa dan magang berbayar lintas benua di Swiss dan Singapura, memperkuat kompetensi berstandar hospitality global.'],
        ['year' => '2024', 'title' => '3.000+ Alumni di 20+ Negara Dunia', 'desc' => 'Lebih dari 3.000 alumni DHS sukses berkarir di maskapai kapal pesiar mewah internasional serta jaringan hotel bintang 5 di lebih dari 20 negara.'],
    ];

    // Meta konfigurasi interaktif 3 Milestone Strategis (2017 - 2024)
    $stageMeta = [
        '2017' => [
            'phase' => 'Kemitraan Global Bintang 5',
            'hub' => 'Jaringan Hotel Bintang 5 Dunia',
            'image' => '/image/hotel_lobby.jpg',
            'stat_val' => '5-STAR',
            'stat_label' => 'Mitra Marriott Group',
            'stat_desc' => 'Jalur karir langsung tanpa potongan biaya agen',
            'badge' => 'GLOBAL NETWORK',
            'quote' => 'Membuka akses karir eksklusif ke jaringan hotel bintang 5 global tanpa biaya agen.'
        ],
        '2022' => [
            'phase' => 'Program Lintas Benua',
            'hub' => 'Swiss & Singapura (2 Benua)',
            'image' => '/image/international_program.jpg',
            'stat_val' => '2 BENUA',
            'stat_label' => 'Program Exchange & Magang',
            'stat_desc' => 'Belajar dan magang berbayar di Eropa dan Asia',
            'badge' => 'GO INTERNATIONAL',
            'quote' => 'Pengalaman belajar dan magang kerja berbayar di pusat hospitality Eropa dan Asia.'
        ],
        '2024' => [
            'phase' => 'Jejak Global & Prestasi Alumni',
            'hub' => '20+ Negara & Kapal Pesiar Mewah',
            'image' => '/image/Kapal.jpg',
            'stat_val' => '3.000+',
            'stat_label' => 'Alumni Internasional',
            'stat_desc' => 'Berkarir di kapal pesiar dunia & hotel bintang 5',
            'badge' => 'ALUMNI DUNIA',
            'quote' => 'Bukti nyata alumni DHS dipercaya oleh maskapai kapal pesiar dan luxury resort dunia.'
        ]
    ];

    $timelineStages = [];
    foreach ($timelineItems as $item) {
        $yr = (string)($item['year'] ?? '');
        if (!isset($stageMeta[$yr])) continue; // Strictly 3 modern milestones
        $meta = $stageMeta[$yr];
        $timelineStages[] = array_merge([
            'year' => $yr,
            'title' => $item['title'] ?? 'Milestone DHS',
            'desc' => $item['desc'] ?? '',
        ], $meta);
    }
    // Fallback if empty
    if (empty($timelineStages)) {
        foreach ($stageMeta as $yr => $meta) {
            $timelineStages[] = array_merge([
                'year' => (string)$yr,
                'title' => $meta['phase'],
                'desc' => $meta['stat_desc'],
            ], $meta);
        }
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


        
    
    
    
    
    <!-- ░░ FULLSCREEN AMBIENT SHOWCASE: SEJARAH & MILESTONE (100VH DESKTOP, NATURAL SCROLL) ░░ -->
    <section id="fullscreen-chrono-section" class="dhs-fullscreen-chrono w-full text-white select-none relative overflow-hidden" style="background: #080D15; color: #ffffff;">
        {{-- Subtle Ambient Radial Lighting --}}
        <div class="absolute -top-32 right-1/4 w-[550px] h-[550px] rounded-full pointer-events-none opacity-20" style="background: radial-gradient(circle, #C5A880 0%, transparent 70%); filter: blur(100px);"></div>
        <div class="absolute -bottom-32 left-10 w-[500px] h-[500px] rounded-full pointer-events-none opacity-15" style="background: radial-gradient(circle, #C53030 0%, transparent 70%); filter: blur(95px);"></div>

        <div class="max-w-7xl mx-auto w-full h-full flex flex-col justify-between px-4 sm:px-8 py-5 lg:py-7 relative z-10">
            {{-- Top Header & Navigation Controls (No "Scroll untuk navigasi" badge) --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pb-3 border-b border-white/10 shrink-0">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-2 h-2 rounded-full" style="background-color: #C5A880;"></span>
                        <span class="text-[0.68rem] tracking-[0.25em] uppercase font-bold" style="color: #E5C397;">
                            MILESTONE STRATEGIS (2017 — 2024)
                        </span>
                    </div>
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-serif font-bold tracking-tight text-white">
                        Transformasi Keunggulan & Reputasi Global
                    </h2>
                </div>

                {{-- Interactive Controls --}}
                <div class="flex items-center gap-2.5 shrink-0 self-end sm:self-center">
                    <span id="dhs-counter-label" class="font-mono text-xs font-semibold px-3 py-1 rounded-full border border-white/10" style="background: rgba(255,255,255,0.05); color: #cbd5e1;">
                        01 / 0{{ count($timelineStages) }}
                    </span>
                    <button type="button" onclick="dhsChronoNav(-1)"
                            class="w-8 h-8 rounded-full border border-white/15 flex items-center justify-center text-white transition-all hover:bg-white/10 hover:border-white/30 cursor-pointer active:scale-95"
                            title="Sebelumnya">
                        <span class="material-icons text-base">arrow_back</span>
                    </button>
                    <button type="button" onclick="dhsChronoNav(1)"
                            class="w-8 h-8 rounded-full border border-white/15 flex items-center justify-center text-white transition-all hover:bg-white/10 hover:border-white/30 cursor-pointer active:scale-95"
                            title="Selanjutnya">
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

            {{-- Center Viewport: Split Screen Theater (50:50) --}}
            <div class="flex-1 flex items-center justify-center my-auto py-3 lg:py-5">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center w-full">
                    {{-- Left Column: 3D Tilt Archival Visual Theater (lg:col-span-6) --}}
                    <div class="lg:col-span-6 w-full flex justify-center">
                        <div class="dhs-tilt-perspective w-full max-w-[540px]">
                            <div id="dhs-tilt-card" class="dhs-tilt-card group">
                                <img id="dhs-chrono-img"
                                     src="{{ $timelineStages[0]['image'] ?? '/image/hotel_lobby.jpg' }}"
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
                                        {{ $timelineStages[0]['badge'] ?? 'GLOBAL NETWORK' }}
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
                                <div class="absolute bottom-4 left-4 right-4 z-10 flex items-center justify-between text-xs backdrop-blur-md px-4 py-2 rounded-xl border border-white/10" style="background: rgba(8, 13, 21, 0.85);">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons text-sm" style="color: #E5C397;">place</span>
                                        <span id="dhs-photo-hub" class="font-medium text-white">{{ $timelineStages[0]['hub'] ?? 'Jaringan Hotel Bintang 5 Dunia' }}</span>
                                    </div>
                                    <span class="text-[0.65rem] font-mono tracking-wider text-slate-400">HISTORIC ARCHIVE</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Kinetic Editorial Narrative (lg:col-span-6) --}}
                    <div class="lg:col-span-6 flex flex-col justify-center">
                        <div class="space-y-3.5 max-w-xl">
                            {{-- Phase Indicator --}}
                            <div class="flex items-center gap-2">
                                <span class="text-xs uppercase tracking-[0.25em] font-bold" style="color: #E5C397;" id="dhs-chrono-phase">
                                    01 / {{ strtoupper($timelineStages[0]['phase'] ?? 'Kemitraan Global Bintang 5') }}
                                </span>
                            </div>

                            {{-- Rolling Number Year Animation Container --}}
                            <div class="dhs-rolling-year-container">
                                <div id="dhs-chrono-year" class="dhs-rolling-year font-serif italic font-extrabold text-5xl sm:text-6xl lg:text-7xl tracking-tight leading-none" style="color: #C5A880;">
                                    {{ $timelineStages[0]['year'] ?? '2017' }}
                                </div>
                            </div>

                            {{-- Milestone Title --}}
                            <h3 class="text-xl sm:text-2xl lg:text-3xl font-serif font-bold text-white tracking-wide transition-opacity duration-300" id="dhs-chrono-title">
                                {{ $timelineStages[0]['title'] ?? 'Kemitraan Marriott International' }}
                            </h3>

                            {{-- Milestone Description --}}
                            <p class="text-sm sm:text-base text-slate-300 leading-relaxed transition-opacity duration-300" id="dhs-chrono-desc">
                                {{ $timelineStages[0]['desc'] ?? '' }}
                            </p>

                            {{-- Editorial Quote Pill --}}
                            <div class="pl-3.5 border-l-2 transition-opacity duration-300" style="border-color: #C5A880;" id="dhs-chrono-quote-box">
                                <p class="text-xs sm:text-sm italic text-slate-300 leading-relaxed" id="dhs-chrono-quote">
                                    "{{ $timelineStages[0]['quote'] ?? 'Membuka akses karir eksklusif ke jaringan hotel bintang 5 global tanpa biaya agen.' }}"
                                </p>
                            </div>

                            {{-- Single Metric Card --}}
                            <div class="pt-1.5">
                                <div class="p-3 sm:p-3.5 rounded-2xl border border-white/10 flex items-center gap-4 transition-all" style="background: rgba(255, 255, 255, 0.04);">
                                    <div class="font-serif text-2xl sm:text-3xl font-extrabold shrink-0 tracking-tight" style="color: #E5C397;" id="dhs-stat-val">
                                        {{ $timelineStages[0]['stat_val'] ?? '5-STAR' }}
                                    </div>
                                    <div class="w-px h-9 bg-white/15 shrink-0"></div>
                                    <div class="min-w-0">
                                        <div class="text-[0.68rem] uppercase tracking-wider font-semibold text-slate-400" id="dhs-stat-label">
                                            {{ $timelineStages[0]['stat_label'] ?? 'Mitra Marriott Group' }}
                                        </div>
                                        <div class="text-xs sm:text-sm font-medium text-white truncate" id="dhs-stat-desc">
                                            {{ $timelineStages[0]['stat_desc'] ?? 'Jalur karir langsung ke hotel luxury internasional' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom: 3-Segment Interactive Milestone Timeline Tabs with Live Progress Bar --}}
            <div class="pt-3 border-t border-white/10 shrink-0">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 max-w-4xl mx-auto w-full">
                    @foreach($timelineStages as $idx => $m)
                    <button type="button"
                            onclick="dhsChronoSelect({{ $idx }})"
                            id="dhs-tab-{{ $idx }}"
                            class="dhs-milestone-tab group text-left p-3 rounded-2xl border transition-all duration-300 cursor-pointer {{ $idx === 0 ? 'active' : '' }}">
                        <div class="flex items-center justify-between mb-1">
                            <span class="dhs-tab-year font-serif font-bold text-base transition-colors">{{ $m['year'] }}</span>
                            <span class="dhs-tab-badge text-[0.62rem] font-bold tracking-wider uppercase px-2 py-0.5 rounded-full transition-colors">{{ $m['badge'] }}</span>
                        </div>
                        <div class="dhs-tab-title text-xs font-semibold text-slate-300 truncate transition-colors">{{ $m['title'] }}</div>
                        {{-- Micro Progress Bar for Autoplay --}}
                        <div class="mt-2 w-full h-[3px] bg-white/10 rounded-full overflow-hidden">
                            <div class="dhs-tab-progress h-full w-0 rounded-full transition-all duration-75" style="background: linear-gradient(90deg, #C53030, #E5C397);"></div>
                        </div>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ░░ SCOPED FULLSCREEN LUXURY CSS ░░ --}}
    <style>
        /* Exact 100vh on Desktop */
        @media (min-width: 1024px) {
            .dhs-fullscreen-chrono {
                width: 100%;
                height: 100vh;
                min-height: 100vh;
                max-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                position: relative;
            }
        }
        @media (max-width: 1023px) {
            .dhs-fullscreen-chrono {
                width: 100%;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                position: relative;
                padding-top: 5rem;
                padding-bottom: 2.5rem;
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
            max-height: 380px;
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
            height: 4.25rem;
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

        /* 3 Modern Interactive Milestone Tabs */
        .dhs-milestone-tab {
            background: rgba(255, 255, 255, 0.03);
            border-color: rgba(255, 255, 255, 0.08);
        }
        .dhs-milestone-tab .dhs-tab-year {
            color: #94a3b8;
        }
        .dhs-milestone-tab .dhs-tab-badge {
            background: rgba(255, 255, 255, 0.05);
            color: #94a3b8;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .dhs-milestone-tab:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(197, 168, 128, 0.3);
            transform: translateY(-2px);
        }

        /* Active Tab State */
        .dhs-milestone-tab.active {
            background: rgba(197, 168, 128, 0.08);
            border-color: rgba(197, 168, 128, 0.5);
            box-shadow: 0 4px 20px rgba(197, 168, 128, 0.12);
        }
        .dhs-milestone-tab.active .dhs-tab-year {
            color: #E5C397;
        }
        .dhs-milestone-tab.active .dhs-tab-title {
            color: #ffffff;
        }
        .dhs-milestone-tab.active .dhs-tab-badge {
            background: rgba(197, 168, 128, 0.18);
            color: #E5C397;
            border-color: rgba(197, 168, 128, 0.4);
        }
    </style>

    {{-- ░░ AMBIENT SHOWCASE CONTROLLER (NO SCROLL-LOCK, NATURAL FLUID FLOW) ░░ --}}
    <script>
    (function() {
        const milestones = @json($timelineStages);
        let currentIndex = 0;
        let autoplayInterval = null;
        let isAutoplay = true;
        let autoplayProgress = 0;
        const PROGRESS_STEP_MS = 60;
        const DURATION_MS = 6000;

        function updateView(idx) {
            currentIndex = idx;
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
            if (photoHub) photoHub.textContent = data.hub || 'Jaringan Global DHS';

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
            const quote = document.getElementById('dhs-chrono-quote');
            const quoteBox = document.getElementById('dhs-chrono-quote-box');
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
            if (quote && quoteBox) {
                quoteBox.style.opacity = '0.3';
                setTimeout(() => {
                    quote.textContent = '"' + (data.quote || 'Komitmen pendidikan hospitality kelas dunia.') + '"';
                    quoteBox.style.opacity = '1';
                }, 180);
            }
            if (counter) counter.textContent = String(idx + 1).padStart(2, '0') + ' / ' + String(milestones.length).padStart(2, '0');

            // Update Metric Box
            const statVal = document.getElementById('dhs-stat-val');
            const statLabel = document.getElementById('dhs-stat-label');
            const statDesc = document.getElementById('dhs-stat-desc');
            if (statVal) statVal.textContent = data.stat_val || data.year;
            if (statLabel) statLabel.textContent = data.stat_label || 'Pencapaian';
            if (statDesc) statDesc.textContent = data.stat_desc || data.highlight || '';

            // Update Tabs Active State
            milestones.forEach((_, i) => {
                const tab = document.getElementById('dhs-tab-' + i);
                if (tab) {
                    tab.classList.toggle('active', i === idx);
                    const prog = tab.querySelector('.dhs-tab-progress');
                    if (prog && i !== idx) prog.style.width = '0%';
                }
            });
        }

        window.dhsChronoSelect = function(idx) {
            updateView(idx);
            autoplayProgress = 0;
            if (isAutoplay) {
                resetAndStartAutoplay();
            }
        };

        window.dhsChronoNav = function(dir) {
            let next = (currentIndex + dir + milestones.length) % milestones.length;
            dhsChronoSelect(next);
        };

        // ── AUTOPLAY ENGINE WITH MICRO-PROGRESS BAR ──
        function resetAndStartAutoplay() {
            stopAutoplay();
            isAutoplay = true;
            updateAutoplayUI(true);
            autoplayProgress = 0;

            autoplayInterval = setInterval(() => {
                autoplayProgress += (PROGRESS_STEP_MS / DURATION_MS) * 100;
                const activeProg = document.querySelector('#dhs-tab-' + currentIndex + ' .dhs-tab-progress');
                if (activeProg) {
                    activeProg.style.width = Math.min(100, autoplayProgress) + '%';
                }

                if (autoplayProgress >= 100) {
                    autoplayProgress = 0;
                    let next = (currentIndex + 1) % milestones.length;
                    dhsChronoSelect(next);
                }
            }, PROGRESS_STEP_MS);
        }

        function stopAutoplay() {
            if (autoplayInterval) {
                clearInterval(autoplayInterval);
                autoplayInterval = null;
            }
            const activeProg = document.querySelector('#dhs-tab-' + currentIndex + ' .dhs-tab-progress');
            if (activeProg && !isAutoplay) {
                activeProg.style.width = '0%';
            }
        }

        function updateAutoplayUI(active) {
            const icon = document.getElementById('dhs-chrono-autoplay-icon');
            const text = document.getElementById('dhs-chrono-autoplay-text');
            if (icon) icon.textContent = active ? 'pause' : 'play_arrow';
            if (text) text.textContent = active ? 'Otomatis' : 'Jeda';
        }

        window.dhsChronoToggleAutoplay = function() {
            isAutoplay = !isAutoplay;
            updateAutoplayUI(isAutoplay);
            if (isAutoplay) {
                resetAndStartAutoplay();
            } else {
                stopAutoplay();
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
                
                const rx = ((y - cy) / cy) * -6;
                const ry = ((x - cx) / cx) * 6;
                
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

        // Lightbox Zoom Handler
        window.dhsOpenCurrentLightbox = function() {
            const cur = milestones[currentIndex];
            if (!cur) return;
            const src = cur.image || '/image/hotel_lobby.jpg';
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
            const section = document.getElementById('fullscreen-chrono-section');
            if (!section) return;
            const rect = section.getBoundingClientRect();
            if (rect.top <= window.innerHeight && rect.bottom >= 0) {
                if (e.key === 'ArrowLeft') dhsChronoNav(-1);
                if (e.key === 'ArrowRight') dhsChronoNav(1);
            }
        });

        // Hover to Pause / Resume Autoplay
        function initHoverPause() {
            const section = document.getElementById('fullscreen-chrono-section');
            if (!section) return;

            section.addEventListener('mouseenter', function() {
                if (isAutoplay && autoplayInterval) {
                    clearInterval(autoplayInterval);
                    autoplayInterval = null;
                }
            });

            section.addEventListener('mouseleave', function() {
                if (isAutoplay && !autoplayInterval) {
                    resetAndStartAutoplay();
                }
            });
        }

        // Initialize on DOM Ready
        document.addEventListener('DOMContentLoaded', function() {
            updateView(0);
            initTilt();
            initHoverPause();
            resetAndStartAutoplay();
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