@extends('layouts.app')

@section('title', 'Program Akademi — Denpasar Hotel School')

@section('content')
    <!-- Hero Section -->
    @php
        $academyHeroTitle = $academyHero['title'] ?? 'Program Vokasi & Kursus';
        $academyHeroSubtitle = $academyHero['subtitle'] ?? 'Program Akademik & Pelatihan';
        $academyHeroBg = $academyHero['bgImage'] ?? '/image/hero_registration.jpg';
    @endphp
    <section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img alt="Students in training kitchen" width="1920" height="1080" class="absolute inset-0 w-full h-full object-cover" style="will-change:transform;" src="{{ $academyHeroBg }}">

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-36 sm:pt-40 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><span data-id="Akademi" data-en="Academy">Akademi</span></span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-[1.1]">
                {{ $academyHeroTitle }}
            </h1>
            <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/70 font-medium">
                {{ $academyHeroSubtitle }}
            </p>
        </div>
    </section>

    <!-- Main Content with Filter -->
    <main class="pt-16">
        <style>
            .filter-tab-btn {
                min-width: 185px;
                width: auto;
                cursor: pointer;
                border-radius: 1rem;
                border: 1px solid #e2e8f0;
                background-color: #ffffff;
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.03);
                transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .filter-tab-btn:hover:not(.is-active) {
                background-color: #f8fafc;
                border-color: #94a3b8;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px -2px rgba(15, 36, 64, 0.08);
            }
            .filter-tab-btn.is-active {
                background-color: #0F2440 !important;
                border-color: #0F2440 !important;
                box-shadow: 0 8px 20px -4px rgba(15, 36, 64, 0.35) !important;
                transform: translateY(-1px);
            }
            .filter-tab-btn.is-active .icon-box {
                background-color: rgba(255, 255, 255, 0.15) !important;
                color: #ffffff !important;
            }
            .filter-tab-btn.is-active .tab-title {
                color: #ffffff !important;
                font-weight: 700 !important;
            }
            .filter-tab-btn.is-active .tab-subtitle {
                color: rgba(255, 255, 255, 0.7) !important;
            }
        </style>

        <!-- Category Filter Tabs -->
        <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-10" data-reveal="fade-up">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-bold text-primary mb-4 block" data-id="PILIH KATEGORI DURASI" data-en="SELECT DURATION CATEGORY">PILIH KATEGORI DURASI</span>
            
            <div class="category-scroll-container flex flex-nowrap overflow-x-auto gap-3 pb-3 pt-1 w-full no-scrollbar snap-x snap-mandatory scroll-smooth cursor-grab active:cursor-grabbing select-none" style="-webkit-overflow-scrolling: touch;">
                @foreach($categories as $cat)
                @php
                    $catIcon = match($cat->category_key) {
                        '1-tahun'              => 'school',
                        '1-tahun-kapal-pesiar' => 'directions_boat',
                        '2-tahun'              => 'workspace_premium',
                        'internasional'        => 'public',
                        'short-course','6-bulan' => 'bolt',
                        'eksekutif'            => 'military_tech',
                        default                => 'map'
                    };
                    $catSubtitle = match($cat->category_key) {
                        '1-tahun'              => 'Vokasi Kilat',
                        '1-tahun-kapal-pesiar' => 'Cruise Line Career',
                        '2-tahun'              => 'Diploma Penuh',
                        'internasional'        => 'Germany · Australia',
                        'short-course','6-bulan' => 'Skill Intensif',
                        'eksekutif'            => 'Spesialis Pro',
                        default                => 'Program Pilihan'
                    };
                @endphp
                <button type="button"
                    class="filter-tab-btn group text-left transition-all duration-200 shrink-0 snap-start cursor-pointer
                           flex flex-row items-center gap-3 px-4 py-2.5
                           {{ $loop->first ? 'is-active' : '' }}"
                    data-target="{{ $cat->category_key }}">

                    {{-- Icon kiri --}}
                    <div class="icon-box w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition-all duration-200 bg-slate-100/90 text-[#0F2440]">
                        <span class="material-icons text-[1.15rem]">{{ $catIcon }}</span>
                    </div>

                    {{-- Teks kanan --}}
                    <div class="min-w-0 flex-1 pr-0.5">
                        <p class="tab-title font-semibold text-[0.8rem] leading-snug transition-colors duration-200 text-slate-800 whitespace-nowrap">
                            {{ $cat->category_name }}
                        </p>
                        <p class="tab-subtitle text-[0.66rem] font-medium mt-0.5 leading-none transition-colors duration-200 text-slate-400 whitespace-nowrap">
                            {{ $catSubtitle }}
                        </p>
                    </div>
                </button>
                @endforeach
            </div>
        </section>


        <!-- Category Panels -->
        <section class="max-w-[1280px] mx-auto px-5 md:px-16" data-reveal="fade-up" data-delay="150">
            @foreach($categories as $cat)
            <div class="category-content-panel {{ $loop->first ? 'active' : 'hidden' }}" id="panel-{{ $cat->category_key }}">
                <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-10 items-start mb-16">
                    <!-- Category Sidebar -->
                    <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg lg:sticky lg:top-24 mb-8 lg:mb-0">
                        <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block">{{ $cat->category_name }}</span>
                        <h2 class="text-3xl font-serif font-bold text-text-light mb-4 leading-tight">{{ $cat->category_name }}</h2>
                        @if($cat->subtitle)
                        <p class="text-xs text-muted-light uppercase tracking-wider mb-4">{{ $cat->subtitle }}</p>
                        @endif
                        @if($cat->description)
                        <p class="text-sm text-muted-light leading-relaxed mb-6">{{ $cat->description }}</p>
                        @endif
                        @if($cat->career_opportunities)
                        <div class="pt-4 border-t border-black/10 mb-4">
                            <p class="text-xs font-bold text-text-light uppercase tracking-wider mb-2">Peluang Kerja Lulusan:</p>
                            <p class="text-xs text-muted-light leading-relaxed">{{ $cat->career_opportunities }}</p>
                        </div>
                        @endif
                        <a href="/program?category={{ $cat->category_key }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold transition-colors">
                            <span>Lihat semua {{ $cat->category_name }}</span>
                            <span class="material-icons text-xs">arrow_forward</span>
                        </a>
                    </div>

                    <!-- Programs Grid -->
                    <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($cat->programs->where('is_active', 1) as $program)
                        <a href="/program/{{ $program->slug }}" class="group bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full card-hover">
                            <div class="relative overflow-hidden h-44 sm:h-48 lg:h-52 shrink-0">
                                <img src="{{ $program->thumbnail_url ?? 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800' }}" alt="{{ $program->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                                @if($program->country_badge)
                                <span class="absolute top-3 right-3 bg-dhs-navy/90 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded tracking-wider shadow-sm">
                                    {{ $program->country_badge }}
                                </span>
                                @endif
                            </div>
                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-serif font-bold text-lg text-text-light group-hover:text-primary transition-colors mb-2 leading-snug">{{ $program->title }}</h3>
                                    @if($program->description)
                                    <p class="text-xs text-muted-light leading-relaxed mb-4">{{ Str::limit($program->description, 120) }}</p>
                                    @endif
                                </div>
                                <div class="pt-3 border-t border-black/5 flex items-center justify-between text-xs text-primary font-semibold">
                                    <span data-id="Lihat Detail Program" data-en="View Program Details">Lihat Detail Program</span>
                                    <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="col-span-full text-center py-12 text-muted-light">
                            <p>Belum ada program tersedia.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Global Link to All Programs Catalog -->
            <div class="text-center mt-10 mb-20" data-reveal="fade-up">
                <a href="/program" class="group relative inline-flex items-center gap-4 px-8 py-4 rounded-2xl text-white font-semibold text-sm transition-all duration-300 hover:-translate-y-0.5" style="background: linear-gradient(135deg, #0F2440 0%, #1e293b 100%); border: 1px solid rgba(255, 255, 255, 0.15); box-shadow: 0 12px 28px -6px rgba(15, 36, 64, 0.35);">
                    <span class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors duration-300" style="background: rgba(255, 255, 255, 0.1); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.25);">
                        <span class="material-icons text-xl leading-none">grid_view</span>
                    </span>
                    <span class="tracking-wide text-slate-100 font-medium text-sm sm:text-base pr-1">Lihat Semua Katalog Program DHS</span>
                    <span class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 transition-all duration-300 group-hover:translate-x-1.5" style="background: rgba(255, 255, 255, 0.15); color: #ffffff;">
                        <span class="material-icons text-sm leading-none">arrow_forward</span>
                    </span>
                </a>
            </div>
        </section>

        <!-- Beasiswa Section -->
        <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-20" data-reveal="fade-up">
            <div class="text-center mb-12">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block" data-id="JALUR BEASISWA" data-en="SCHOLARSHIP PATHWAYS">JALUR BEASISWA</span>
                <h3 class="text-3xl md:text-4xl font-serif text-text-light mb-4" data-id="Program Beasiswa DHS" data-en="DHS Scholarship Program">Program Beasiswa DHS</h3>
                <p class="text-sm text-muted-light max-w-2xl mx-auto" data-id="Denpasar Hotel School menyediakan keringanan biaya pendidikan melalui berbagai skema beasiswa bagi calon profesional berprestasi." data-en="Denpasar Hotel School provides educational fee relief through various scholarship schemes for high-achieving prospective professionals.">Denpasar Hotel School menyediakan keringanan biaya pendidikan melalui berbagai skema beasiswa bagi calon profesional berprestasi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <a href="/beasiswa/beasiswa-prestasi" class="bg-white border border-black/5 p-8 shadow-sm hover:shadow-lg hover:border-primary/20 transition-all duration-300 group block">
                    <div class="w-12 h-12 bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary/20 transition-colors">
                        <span class="material-icons text-primary text-2xl">emoji_events</span>
                    </div>
                    <h4 class="font-bold font-serif text-xl text-text-light mb-3">Beasiswa Prestasi</h4>
                    <p class="text-xs text-muted-light leading-relaxed mb-5">Bagi calon peserta didik dengan prestasi akademik dan non-akademik yang unggul. Keringanan biaya pendidikan hingga 50%.</p>
                    <ul class="text-xs text-muted-light space-y-2.5">
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Nilai rata-rata rapor/ijazah ≥ 80</li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Piagam atau sertifikat prestasi</li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Lulus seleksi wawancara</li>
                    </ul>
                </a>

                <a href="/beasiswa/beasiswa-stt" class="bg-dhs-lightblue p-8 shadow-sm hover:shadow-lg transition-all duration-300 group block">
                    <div class="w-12 h-12 bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary/20 transition-colors">
                        <span class="material-icons text-primary text-2xl">groups</span>
                    </div>
                    <h4 class="font-bold font-serif text-xl text-text-light mb-3">Beasiswa STT / Desa</h4>
                    <p class="text-xs text-muted-light leading-relaxed mb-5">Khusus bagi anggota Sekaa Teruna Teruni (STT) dan utusan desa adat yang ingin meningkatkan kompetensi di bidang perhotelan.</p>
                    <ul class="text-xs text-muted-light space-y-2.5">
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Surat rekomendasi Bendesa Adat</li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Aktif sebagai anggota STT</li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Warga Bali berdomisili di Bali</li>
                    </ul>
                </a>

                <a href="/beasiswa/beasiswa-khusus" class="bg-white border border-black/5 p-8 shadow-sm hover:shadow-lg hover:border-primary/20 transition-all duration-300 group block">
                    <div class="w-12 h-12 bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary/20 transition-colors">
                        <span class="material-icons text-primary text-2xl">workspace_premium</span>
                    </div>
                    <h4 class="font-bold font-serif text-xl text-text-light mb-3">Beasiswa Khusus</h4>
                    <p class="text-xs text-muted-light leading-relaxed mb-5">Bagi calon peserta didik dari keluarga kurang mampu dengan komitmen tinggi untuk berkarir di industri perhotelan dan pariwisata.</p>
                    <ul class="text-xs text-muted-light space-y-2.5">
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Surat keterangan tidak mampu</li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Esai motivasi dan wawancara</li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Seleksi oleh Tim DHS</li>
                    </ul>
                </a>
            </div>

            <div class="text-center">
                <a class="inline-flex items-center gap-3 px-8 py-4 bg-primary text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:opacity-90 transition-opacity" href="/layanan?type=beasiswa">
                    <span class="material-icons text-base">school</span>
                    <span data-id="Ajukan Beasiswa Sekarang" data-en="Apply for Scholarship Now">Ajukan Beasiswa Sekarang</span>
                </a>
            </div>
        </section>

        <!-- Document Assistance Section (1 Single Horizontal Row Grid - Compact Sharper Cards) -->
        <section class="max-w-6xl mx-auto px-5 md:px-8 mb-24" data-reveal="fade-up">
            <!-- Section Header -->
            <div class="text-center mb-10">
                <span class="inline-flex items-center gap-2 px-5 py-1.5 md:px-6 md:py-2 rounded-full bg-red-50 text-primary text-[0.7rem] uppercase tracking-wider font-bold border border-red-100/80 mb-3 shadow-2xs">
                    <span class="material-icons text-xs text-primary">verified</span>
                    Layanan Pendampingan Resmi
                </span>
                <h3 class="text-2xl md:text-3xl lg:text-4xl font-serif font-bold text-slate-900 mb-3 leading-snug" data-id="Layanan Pengurusan Dokumen" data-en="Document Processing Services">
                    Layanan Pengurusan Dokumen Sertifikasi
                </h3>
                <p class="text-xs md:text-sm text-slate-500 leading-relaxed max-w-xl mx-auto" data-id="DHS menyediakan bantuan penuh bagi para siswa dan calon pencari kerja kapal pesiar untuk mengurus dokumen sertifikasi wajib:" data-en="DHS provides full assistance for students and prospective cruise ship workers to process mandatory certification documents:">
                    Denpasar Hotel School mengawal dan mendampingi proses pengurusan sertifikasi maritim serta dokumen kerja luar negeri secara resmi &amp; cepat:
                </p>
            </div>

            <!-- 1 Deret Horizontal Murni (Ukuran Konsisten Seragam & Spacing Rapi) -->
            <div class="flex flex-row items-stretch overflow-x-auto gap-4 md:gap-5 pb-4 pt-2 no-scrollbar px-1">
                @foreach([
                        ['title' => 'Passport & Buku Pelaut', 'icon' => 'card_travel',   'slug' => 'passport',   'tag' => 'Imigrasi & Dephub'],
                        ['title' => 'BST (Basic Safety)',     'icon' => 'anchor',        'slug' => 'bst',        'tag' => 'STCW 2010'],
                        ['title' => 'SDSD (Security Duties)', 'icon' => 'security',      'slug' => 'sdsd',       'tag' => 'ISPS Code VI/6'],
                        ['title' => 'CCM (Crowd & Crisis)',   'icon' => 'groups',        'slug' => 'ccm',        'tag' => 'STCW V/2 Passenger'],
                        ['title' => 'SSAT (Security Aware)',  'icon' => 'verified_user', 'slug' => 'ssat',       'tag' => 'STCW VI/6 Security'],
                        ['title' => 'PSCRB (Survival Craft)', 'icon' => 'sailing',       'slug' => 'pscrb',      'tag' => 'Advanced Lifeboat'],
                        ['title' => 'C1/D Visa (US Seaman)',  'icon' => 'badge',         'slug' => 'c1d-visa',   'tag' => 'US Embassy Visa'],
                    ] as $doc)
                    <a href="/dokumen/{{ $doc['slug'] }}" 
                       class="group bg-slate-50/70 hover:bg-white rounded-md p-4 md:p-5 border border-slate-200/80 shadow-2xs hover:shadow-xl hover:border-primary/40 hover:-translate-y-1.5 transition-all duration-300 flex flex-col items-center justify-between text-center flex-1 min-w-[150px] max-w-[180px] h-[155px] shrink-0 md:shrink relative overflow-hidden">
                        
                        <!-- Top Icon Centered with Bottom Spacing -->
                        <div class="pt-1 mb-3">
                            <span class="material-icons text-2xl md:text-3xl text-primary group-hover:scale-110 transition-transform duration-300">{{ $doc['icon'] }}</span>
                        </div>

                        <!-- Bottom Title & Sub-tag Centered -->
                        <div class="space-y-1 w-full">
                            <div class="h-9 flex items-center justify-center">
                                <h4 class="font-serif font-bold text-xs md:text-sm text-slate-900 group-hover:text-primary transition-colors leading-tight line-clamp-2">
                                    {{ $doc['title'] }}
                                </h4>
                            </div>
                            <span class="text-[0.6rem] font-semibold text-slate-400 block group-hover:text-slate-600 transition-colors truncate">
                                {{ $doc['tag'] }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Bottom Action & Info Callout (Simpel & Minimalis) -->
            <div class="mt-6 p-4 px-5 bg-slate-50 border border-slate-200/80 rounded-md flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <div class="flex items-center gap-2.5 text-xs text-slate-600 font-medium">
                    <span class="material-icons text-base text-primary shrink-0">headset_mic</span>
                    <span>Butuh pengurusan dokumen tambahan? Tim admisi DHS siap membantu pendaftaran &amp; konsultasi berkas online.</span>
                </div>

                <a class="text-xs font-bold text-primary hover:text-primary-dark transition-colors flex items-center gap-1 shrink-0 group" href="/layanan?type=dokumen">
                    <span>Ajukan Dokumen Online</span>
                    <span class="material-icons text-sm group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                </a>
            </div>
        </section>


        <!-- CTA Section -->
        <section class="py-16 mb-0 border-t border-black/10">
        <div class="max-w-3xl mx-auto px-5 text-center">
            <h2 class="text-[48px] leading-[1.2] font-semibold font-serif mb-6 text-text-light" data-id="Mulai Karir Sukses Anda" data-en="Start Your Successful Career">Mulai Karir Sukses Anda</h2>
            <p class="text-base text-muted-light mb-10" data-id="Denpasar Hotel School siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global." data-en="Denpasar Hotel School is ready to guide you to become a competent young professional with global competitiveness.">Denpasar Hotel School siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global. Gabung sekarang juga secara online.</p>
            <div class="flex justify-center">
                <a class="px-8 py-4 bg-primary text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-primary/90 transition-colors" href="/formulir-pendaftaran"><span data-id="Pendaftaran Online" data-en="Online Registration">Pendaftaran Online</span></a>
            </div>
        </div>
        </section>
    </main>

    <style>
        .category-content-panel.hidden {
            content-visibility: auto;
            contain-intrinsic-size: 0 2000px;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-tab-btn');
            const panels = document.querySelectorAll('.category-content-panel');

            // ── Seamless Infinite Auto-scroll ──
            const scrollContainers = document.querySelectorAll('.category-scroll-container');
            scrollContainers.forEach(container => {
                // 1. Clone semua item asli dan append — buat efek marquee seamless
                const origItems = Array.from(container.children);
                origItems.forEach(item => {
                    const clone = item.cloneNode(true);
                    clone.dataset.isClone = 'true'; // tandai sebagai clone
                    container.appendChild(clone);
                });

                const origWidth = origItems.reduce((sum, el) => {
                    const style = getComputedStyle(el);
                    return sum + el.offsetWidth
                        + parseFloat(style.marginLeft || 0)
                        + parseFloat(style.marginRight || 0);
                }, 0);
                // tambahkan gap antar item (gap-3 = 12px)
                const gapPx  = 12;
                const loopAt = origWidth + gapPx * origItems.length;

                let isDown   = false;
                let isPaused = false;
                let startX, dragStart;
                const SPEED  = 0.4; // px per frame — turunkan untuk lebih lambat
                let pos      = 0;

                function autoScroll() {
                    if (!isPaused && !isDown) {
                        pos += SPEED;
                        // Ketika sudah melewati set pertama, lompat ke titik yang
                        // identik pada set pertama → tidak ada visual jump
                        if (pos >= loopAt) pos -= loopAt;
                        container.scrollLeft = pos;
                    }
                    requestAnimationFrame(autoScroll);
                }
                requestAnimationFrame(autoScroll);

                // Pause saat hover
                container.addEventListener('mouseenter', () => { isPaused = true; });
                container.addEventListener('mouseleave', () => { isPaused = false; isDown = false; });

                // Pause saat touch (mobile)
                container.addEventListener('touchstart', () => { isPaused = true; }, { passive: true });
                container.addEventListener('touchend',   () => {
                    pos = container.scrollLeft % loopAt; // normalise pos setelah touch
                    setTimeout(() => { isPaused = false; }, 1000);
                }, { passive: true });

                // Drag to scroll (mouse)
                container.addEventListener('mousedown', e => {
                    isDown = true; isPaused = true;
                    startX    = e.pageX - container.offsetLeft;
                    dragStart = container.scrollLeft;
                });
                container.addEventListener('mouseup', () => {
                    pos = container.scrollLeft % loopAt;
                    isDown = false;
                    setTimeout(() => { isPaused = false; }, 800);
                });
                container.addEventListener('mousemove', e => {
                    if (!isDown) return;
                    e.preventDefault();
                    const newLeft = dragStart - (e.pageX - container.offsetLeft - startX) * 1.5;
                    container.scrollLeft = newLeft;
                    pos = newLeft % loopAt;
                });
            });


            // Helper: set satu button ke state aktif atau tidak aktif
            function setTabStyle(b, active) {
                if (active) {
                    b.classList.add('is-active');
                } else {
                    b.classList.remove('is-active');
                }
            }

            function activateTab(btn) {
                const target = btn.dataset.target;

                // Reset semua button (original + clone)
                document.querySelectorAll('.filter-tab-btn').forEach(b => setTabStyle(b, false));

                // Aktifkan SEMUA button dengan data-target yang sama (original + clone-nya)
                document.querySelectorAll(`.filter-tab-btn[data-target="${target}"]`).forEach(b => setTabStyle(b, true));

                // Tampilkan panel yang sesuai
                panels.forEach(p => {
                    if (p.id === 'panel-' + target) {
                        p.classList.remove('hidden'); p.classList.add('active');
                    } else {
                        p.classList.add('hidden'); p.classList.remove('active');
                    }
                });
            }

            // Semua button (original & clone) bisa diklik
            document.querySelectorAll('.filter-tab-btn').forEach(btn =>
                btn.addEventListener('click', function() { activateTab(this); })
            );

            const filterParam = new URLSearchParams(window.location.search).get('filter');
            if (filterParam) {
                const matchBtn = document.querySelector(`.filter-tab-btn[data-target="${filterParam}"]`);
                if (matchBtn) activateTab(matchBtn);
            }
        });
    </script>
@endsection
