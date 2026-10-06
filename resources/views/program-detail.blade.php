@extends('layouts.app')

@section('title', $program->title . ' — Denpasar Hotel School')

@push('styles')
<style>
    .prog-detail-bg { background-color: #F8FAFC; }

    /* Card base */
    .pd-card {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.07);
        border-radius: 1.25rem;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        transition: box-shadow 0.25s cubic-bezier(0.4,0,0.2,1);
    }
    .pd-card:hover {
        box-shadow: 0 8px 28px rgba(0,0,0,0.1);
    }

    /* Section header inside card */
    .pd-section-label {
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #C53030;
        margin-bottom: 0.25rem;
    }
    .pd-section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.45rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.3;
        margin-bottom: 0.2rem;
    }
    .pd-section-sub {
        font-size: 0.75rem;
        color: #64748b;
    }
    .pd-icon-wrap {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .pd-icon-wrap .material-icons {
        font-size: 1.25rem;
        color: #0F2440;
    }

    /* Activity item */
    .pd-act-item {
        display: flex;
        gap: 1rem;
        padding: 1.1rem 1rem;
        border-radius: 0.875rem;
        background: #F8FAFC;
        border: 1px solid rgba(0,0,0,0.05);
        transition: background 0.18s ease, box-shadow 0.18s ease;
    }
    .pd-act-item:hover {
        background: #fff;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    }
    .pd-act-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #0F2440;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
    }
    .pd-act-icon .material-icons { color: #fff; font-size: 1.1rem; }

    /* Benefit item */
    .pd-benefit-item {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
        padding: 0.9rem 0.75rem;
        border-radius: 0.75rem;
        transition: background 0.15s ease;
    }
    .pd-benefit-item:hover { background: #f8fafc; }
    .pd-benefit-num {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #e2e8f0;
        line-height: 1;
        flex-shrink: 0;
        min-width: 2rem;
        margin-top: 2px;
    }

    /* Requirement row */
    .pd-req-item {
        display: flex;
        align-items: center;
        gap: 0.875rem;
        padding: 0.875rem 0.75rem;
        border-radius: 0.75rem;
        transition: background 0.15s ease;
    }
    .pd-req-item:hover { background: #f8fafc; }
    .pd-req-item + .pd-req-item { border-top: 1px solid #f1f5f9; }

    /* List items (kurikulum, fasilitas) */
    .pd-list-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.6rem 0.5rem;
        border-radius: 0.6rem;
        transition: background 0.15s ease;
    }
    .pd-list-item:hover { background: #f8fafc; }

    /* Sidebar */
    .pd-sidebar-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 1.25rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        transition: box-shadow 0.25s ease;
    }
    .pd-sidebar-card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .pd-spec-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid #e2e8f0;
    }
    .pd-spec-row:last-child { border-bottom: none; }

    /* Related card */
    .pd-rel-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 1rem;
        overflow: hidden;
        transition: box-shadow 0.25s ease, transform 0.25s ease;
    }
    .pd-rel-card:hover {
        box-shadow: 0 12px 32px rgba(0,0,0,0.12);
        transform: translateY(-3px);
    }
</style>
@endpush

@section('content')

    {{-- ═══════════════════════════════ HERO ═══════════════════════════════ --}}
    <section class="relative min-h-[640px] md:min-h-[700px] flex flex-col justify-start items-center overflow-hidden bg-slate-950 text-white" style="padding-top: 160px; padding-bottom: 80px;">
        <div class="absolute inset-0 bg-black/60 z-10"></div>
        <img
            alt="{{ $cms['title'] ?? $program->title }}"
            width="1920" height="1080"
            class="absolute inset-0 w-full h-full object-cover"
            style="will-change: transform;"
            src="{{ $cms['hero_image'] ?? ($program->thumbnail_url ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600') }}"
        >

        <div class="relative z-20 px-6 max-w-4xl mx-auto text-center" data-reveal="fade-up">

            {{-- Breadcrumb --}}
            <nav class="mb-7 inline-flex items-center gap-2 text-white/70 text-xs font-semibold uppercase tracking-wider">
                <a href="/" class="hover:text-white transition-colors flex items-center gap-1">
                    <span class="material-icons text-sm leading-none">home</span>Beranda
                </a>
                <span class="material-icons text-xs opacity-40">chevron_right</span>
                <a href="/akademi" class="hover:text-white transition-colors">Akademi</a>
                <span class="material-icons text-xs opacity-40">chevron_right</span>
                <a href="/program" class="hover:text-white transition-colors">Program</a>
                <span class="material-icons text-xs opacity-40">chevron_right</span>
                <span class="text-amber-400 font-bold truncate max-w-[200px]">{{ $cms['title'] ?? $program->title }}</span>
            </nav>

            {{-- Badges --}}
            <div class="my-7 flex items-center justify-center gap-3.5 flex-wrap">
                <span class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white/10 border border-white/20 backdrop-blur-md text-white shadow-sm">
                    <span class="material-icons text-sm text-amber-400">school</span>
                    {{ $cms['category'] ?? ($program->category ? $program->category->category_name : 'Program Vokasi') }}
                </span>
                @if(!empty($cms['country_badge']) || $program->country_badge)
                <span class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white/10 border border-white/20 backdrop-blur-md text-white shadow-sm">
                    <span class="material-icons text-sm text-amber-400">public</span>
                    {{ $cms['country_badge'] ?? $program->country_badge }}
                </span>
                @endif
            </div>

            {{-- Title --}}
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[3.25rem] font-serif font-bold text-white mb-6 leading-[1.15] tracking-tight max-w-3xl mx-auto" style="text-shadow: 0 2px 20px rgba(0,0,0,0.7);">
                {{ $cms['title'] ?? $program->title }}
            </h1>

            {{-- CTA --}}
            <div class="pt-4 sm:pt-6">
                <a href="/formulir-pendaftaran?program={{ $program->slug }}"
                   class="inline-flex items-center gap-2.5 px-8 py-3.5 rounded-full text-white font-bold text-xs uppercase tracking-widest border border-white/40 bg-transparent hover:bg-white/15 hover:border-white transition-all">
                    <span>{{ $cms['cta_text'] ?? 'Daftar Program Ini' }}</span>
                    <span class="material-icons text-base">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════ MAIN CONTENT ═════════════════════════════ --}}
    <div class="prog-detail-bg pt-20 pb-24 sm:pt-24 sm:pb-28 lg:pt-28 lg:pb-32 px-5 md:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

                {{-- ── LEFT: Content (8 cols) ── --}}
                <div class="lg:col-span-8 space-y-8">

                    {{-- Card 1: Deskripsi --}}
                    <div class="pd-card p-8 sm:p-10" data-reveal="fade-up">
                        <div class="flex items-start gap-4 mb-7">
                            <div class="pd-icon-wrap">
                                <span class="material-icons">menu_book</span>
                            </div>
                            <div>
                                <p class="pd-section-label">Tentang Program</p>
                                <h2 class="pd-section-title">{{ $cms['desc_title'] ?? 'Deskripsi & Profil Program' }}</h2>
                                <p class="pd-section-sub">{{ $cms['desc_subtitle'] ?? 'Gambaran umum kurikulum dan fokus pembelajaran' }}</p>
                            </div>
                        </div>
                        <div class="text-slate-600 text-[0.9rem] leading-[1.85] space-y-4" style="border-top: 1px solid #f1f5f9; padding-top: 1.5rem;">
                            <p>{{ $cms['description'] ?? ($program->description ?: 'Program pendidikan vokasi siap kerja yang memadukan teori industri pariwisata terkini dengan praktik intensif (70% Praktik & 30% Teori). Peserta didik dibimbing langsung oleh instruktur berpengalaman dari hotel berbintang dan kapal pesiar internasional.') }}</p>
                            @if(!empty($cms['desc_p2']))
                            <p>{{ $cms['desc_p2'] }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Card 2: Aktivitas --}}
                    @php
                        $activities = $cms['activities'] ?? [
                            ['icon' => 'science',          'title' => '70% Praktik Laboratorium',      'desc' => 'Simulasi kerja di Kitchen Lab, Bar & Restaurant, Mockup Hotel Room, dan Front Office Counter.'],
                            ['icon' => 'flight_takeoff',   'title' => 'On the Job Training (OJT)',     'desc' => 'Praktik kerja lapangan selama 6 bulan di hotel bintang 4 & 5 Bali, Jakarta, atau kapal pesiar internasional.'],
                            ['icon' => 'translate',        'title' => 'English for Hospitality',       'desc' => 'Pembekalan intensif percakapan Bahasa Inggris maritim dan perhotelan untuk persiapan wawancara kerja.'],
                            ['icon' => 'record_voice_over','title' => 'Mockup Interview & Mentoring',  'desc' => 'Bimbingan khusus pembuatan CV internasional dan simulasi wawancara bersama praktisi senior.'],
                        ];
                    @endphp
                    <div class="pd-card p-8 sm:p-10" data-reveal="fade-up" data-delay="100">
                        <div class="flex items-start gap-4 mb-7">
                            <div class="pd-icon-wrap">
                                <span class="material-icons">sports_score</span>
                            </div>
                            <div>
                                <p class="pd-section-label">Kegiatan Belajar</p>
                                <h2 class="pd-section-title">{{ $cms['activities_title'] ?? 'Aktivitas & Kegiatan Pembelajaran' }}</h2>
                                <p class="pd-section-sub">{{ $cms['activities_subtitle'] ?? 'Rincian kegiatan praktik dan pelatihan selama masa studi' }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" style="border-top: 1px solid #f1f5f9; padding-top: 1.5rem;">
                            @foreach($activities as $act)
                            <div class="pd-act-item">
                                <div class="pd-act-icon">
                                    <span class="material-icons">{{ $act['icon'] ?? 'star' }}</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 text-[0.85rem] mb-1 leading-snug">{{ $act['title'] ?? '' }}</h3>
                                    <p class="text-slate-500 text-xs leading-relaxed">{{ $act['desc'] ?? '' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Card 3: Manfaat --}}
                    @php
                        $benefits = $cms['benefits'] ?? [
                            ['title' => 'Sertifikat Resmi Terakreditasi & Garuda Dephub',    'desc' => 'Memperoleh Ijazah Vokasi DHS dan Sertifikat Kompetensi resmi yang diakui secara nasional maupun industri maritim & perhotelan global.'],
                            ['title' => 'Penyaluran Kerja ke 50+ Hotel & Kapal Pesiar',     'desc' => 'Jaminan pendampingan karir sampai bekerja melalui jaringan kemitraan DHS di Bali, nasional, dan internasional.'],
                            ['title' => 'Fasilitas Lab Lengkap Tanpa Biaya Tersembunyi',    'desc' => 'Seluruh bahan masakan, peralatan bar, dan sarana laboratorium disiapkan kampus tanpa pungutan biaya tambahan.'],
                            ['title' => 'Bimbingan Praktisi Aktif Perhotelan',              'desc' => 'Diajar langsung oleh Ex-Executive Chef, Head Bartender, dan General Manager yang masih aktif di industri.'],
                            ['title' => 'Akses Beasiswa Keringanan Biaya s/d 50%',          'desc' => 'Berhak mengklaim Beasiswa Prestasi, STT/Desa, atau Beasiswa Khusus DHS bagi peserta berprestasi dan kurang mampu.'],
                        ];
                    @endphp
                    <div class="pd-card p-8 sm:p-10" data-reveal="fade-up" data-delay="150">
                        <div class="flex items-start gap-4 mb-7">
                            <div class="pd-icon-wrap">
                                <span class="material-icons">card_giftcard</span>
                            </div>
                            <div>
                                <p class="pd-section-label">Keuntungan</p>
                                <h2 class="pd-section-title">{{ $cms['benefits_title'] ?? 'Manfaat & Benefit yang Didapatkan' }}</h2>
                                <p class="pd-section-sub">{{ $cms['benefits_subtitle'] ?? 'Keunggulan eksklusif bagi setiap peserta program' }}</p>
                            </div>
                        </div>
                        <div class="space-y-1" style="border-top: 1px solid #f1f5f9; padding-top: 1.25rem;">
                            @foreach($benefits as $i => $ben)
                            <div class="pd-benefit-item">
                                <span class="pd-benefit-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <div>
                                    <h3 class="font-semibold text-slate-900 text-[0.87rem] mb-0.5 leading-snug">{{ $ben['title'] ?? '' }}</h3>
                                    <p class="text-slate-500 text-xs leading-relaxed">{{ $ben['desc'] ?? '' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Card 4: Kurikulum --}}
                    @php $curriculumContent = $cms['curriculum'] ?? $program->curriculum; @endphp
                    @if($curriculumContent)
                    <div class="pd-card p-8 sm:p-10" data-reveal="fade-up" data-delay="200">
                        <div class="flex items-start gap-4 mb-7">
                            <div class="pd-icon-wrap">
                                <span class="material-icons">auto_stories</span>
                            </div>
                            <div>
                                <p class="pd-section-label">Kurikulum</p>
                                <h2 class="pd-section-title">{{ $cms['curriculum_title'] ?? 'Materi & Kurikulum Pelatihan' }}</h2>
                                <p class="pd-section-sub">{{ $cms['curriculum_subtitle'] ?? 'Modul keahlian yang dipelajari selama masa studi' }}</p>
                            </div>
                        </div>
                        @php
                            $currLines = is_array($curriculumContent)
                                ? $curriculumContent
                                : array_filter(array_map('trim', explode("\n", $curriculumContent)));
                        @endphp
                        <div class="space-y-0.5" style="border-top: 1px solid #f1f5f9; padding-top: 1.25rem;">
                            @foreach($currLines as $line)
                            @if(trim($line))
                            <div class="pd-list-item">
                                <span class="material-icons text-[1.1rem] text-primary flex-shrink-0 mt-[1px]">check</span>
                                <span class="text-slate-700 text-[0.87rem] leading-relaxed">{{ $line }}</span>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Card 5: Persyaratan --}}
                    @php
                        $reqs = $cms['requirements'] ?? ($program->requirements ? explode("\n", $program->requirements) : [
                            'Pria / Wanita, usia minimal 17 tahun.',
                            'Lulusan SMA / SMK / MA / Paket C sederajat.',
                            'Sehat jasmani dan rohani serta bebas narkoba.',
                            'Memiliki motivasi tinggi untuk berkarir di industri pariwisata & kapal pesiar.',
                            'Menyerahkan fotokopi KTP, KK, Akta Kelahiran, Ijazah & Pas Foto terbaru.',
                        ]);
                        if (is_string($reqs)) {
                            $reqs = array_filter(array_map('trim', explode("\n", $reqs)));
                        }
                    @endphp
                    <div class="pd-card p-8 sm:p-10" data-reveal="fade-up" data-delay="250">
                        <div class="flex items-start gap-4 mb-7">
                            <div class="pd-icon-wrap">
                                <span class="material-icons">checklist</span>
                            </div>
                            <div>
                                <p class="pd-section-label">Syarat Daftar</p>
                                <h2 class="pd-section-title">{{ $cms['requirements_title'] ?? 'Persyaratan Pendaftaran' }}</h2>
                                <p class="pd-section-sub">{{ $cms['requirements_subtitle'] ?? 'Kelengkapan administrasi dan kriteria calon peserta' }}</p>
                            </div>
                        </div>
                        <div style="border-top: 1px solid #f1f5f9; padding-top: 1.25rem;">
                            @foreach($reqs as $req)
                            <div class="pd-req-item">
                                <span class="material-icons text-[1.15rem] text-primary flex-shrink-0">check_circle</span>
                                <span class="text-slate-700 text-[0.87rem]">{{ $req }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Card 6: Fasilitas --}}
                    @php $facilitiesContent = $cms['facilities'] ?? $program->facilities; @endphp
                    @if($facilitiesContent)
                    <div class="pd-card p-8 sm:p-10" data-reveal="fade-up" data-delay="300">
                        <div class="flex items-start gap-4 mb-7">
                            <div class="pd-icon-wrap">
                                <span class="material-icons">apartment</span>
                            </div>
                            <div>
                                <p class="pd-section-label">Sarana & Prasarana</p>
                                <h2 class="pd-section-title">{{ $cms['facilities_title'] ?? 'Fasilitas & Sarana Pendukung' }}</h2>
                                <p class="pd-section-sub">{{ $cms['facilities_subtitle'] ?? 'Sarana laboratorium dan fasilitas praktik yang disediakan' }}</p>
                            </div>
                        </div>
                        @php
                            $facLines = is_array($facilitiesContent)
                                ? $facilitiesContent
                                : array_filter(array_map('trim', explode("\n", $facilitiesContent)));
                        @endphp
                        <div class="space-y-0.5" style="border-top: 1px solid #f1f5f9; padding-top: 1.25rem;">
                            @foreach($facLines as $line)
                            @if(trim($line))
                            <div class="pd-list-item">
                                <span class="material-icons text-[1.1rem] text-primary flex-shrink-0 mt-[1px]">check</span>
                                <span class="text-slate-700 text-[0.87rem] leading-relaxed">{{ $line }}</span>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>{{-- /left --}}

                {{-- ── RIGHT: Sidebar (4 cols) ── --}}
                <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">

                    {{-- Registration card --}}
                    <div class="pd-sidebar-card overflow-hidden">
                        <div style="height: 3px; background: linear-gradient(90deg, #C53030, #e87272);"></div>
                        <div class="p-8">
                            <div class="text-center mb-7">
                                <span class="inline-block px-4 py-1.5 rounded-full text-[0.65rem] font-bold uppercase tracking-widest mb-4" style="background: #fef2f2; color: #C53030; letter-spacing: 0.12em;">
                                    {{ $cms['sidebar_gelombang'] ?? 'Pendaftaran Gelombang Baru' }}
                                </span>
                                <h3 class="font-serif font-bold text-[1.4rem] text-slate-900 mb-2 leading-tight">Daftar Program Ini</h3>
                                <p class="text-[0.8rem] text-slate-500 leading-relaxed">{{ $cms['sidebar_kuota'] ?? 'Kuota terbatas untuk setiap gelombang pelatihan.' }}</p>
                            </div>

                            <div class="mb-7" style="border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 0.5rem 0;">
                                <div class="pd-spec-row">
                                    <span class="text-slate-500 text-[0.8rem]">Durasi Studi</span>
                                    <span class="font-bold text-slate-900 text-[0.8rem]">{{ $cms['duration'] ?? ($program->duration ?: '1 Tahun') }}</span>
                                </div>
                                <div class="pd-spec-row">
                                    <span class="text-slate-500 text-[0.8rem]">Kategori</span>
                                    <span class="font-bold text-slate-900 text-[0.8rem]">{{ $cms['category'] ?? ($program->category ? $program->category->category_name : 'Vokasi') }}</span>
                                </div>
                                @if(!empty($cms['tuition_fee']) || $program->tuition_fee)
                                <div class="pd-spec-row">
                                    <span class="text-slate-500 text-[0.8rem]">Biaya Pendidikan</span>
                                    <span class="font-bold text-slate-900 text-[0.8rem]">{{ $cms['tuition_fee'] ?? $program->tuition_fee }}</span>
                                </div>
                                @endif
                                <div class="pd-spec-row">
                                    <span class="text-slate-500 text-[0.8rem]">Beasiswa</span>
                                    <span class="font-bold text-[0.8rem] flex items-center gap-1" style="color: #059669;">
                                        <span class="material-icons text-[0.95rem]">check_circle</span>
                                        Tersedia
                                    </span>
                                </div>
                            </div>

                            <a href="/formulir-pendaftaran?program={{ $program->slug }}"
                               class="w-full flex items-center justify-center gap-2.5 py-4 rounded-xl font-bold text-[0.8rem] text-white uppercase tracking-wider transition-all hover:opacity-90 hover:shadow-xl hover:-translate-y-0.5 mb-3"
                               style="background: linear-gradient(135deg, #C53030, #9b1c1c); box-shadow: 0 4px 18px rgba(197,48,48,0.35);">
                                <span>Daftar Online Sekarang</span>
                                <span class="material-icons text-[1.05rem]">arrow_forward</span>
                            </a>

                            @if(!empty($cms['brochure_url']) || $program->brochure_url)
                            <a href="{{ $cms['brochure_url'] ?? $program->brochure_url }}" target="_blank"
                               class="w-full flex items-center justify-center gap-2 py-3.5 rounded-xl text-[0.78rem] font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-all">
                                <span class="material-icons text-[0.95rem] text-primary">picture_as_pdf</span>
                                Unduh Brosur Program
                            </a>
                            @endif
                        </div>
                    </div>

                    {{-- Helpdesk card --}}
                    <div class="rounded-2xl overflow-hidden border border-slate-700/80" style="background: linear-gradient(165deg, #0f172a 0%, #1e293b 100%);">
                        <div class="p-8 pb-6">
                            <div class="flex items-start gap-4 mb-6">
                                <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #f59e0b, #d97706); box-shadow: 0 4px 20px rgba(245,158,11,0.35);">
                                    <span class="material-icons text-white" style="font-size: 1.6rem;">support_agent</span>
                                </div>
                                <div class="flex-1 pt-1">
                                    <h3 class="font-bold text-[1.15rem] text-white leading-tight mb-2">{{ $cms['sidebar_helpdesk_title'] ?? 'Butuh Info Lebih Lanjut?' }}</h3>
                                    <p class="text-[0.85rem] font-semibold leading-snug" style="color: #fbbf24;">{{ $cms['sidebar_helpdesk_sub'] ?? 'Tim Admisi DHS Siap Membantu' }}</p>
                                </div>
                            </div>
                            <p class="text-[0.85rem] leading-relaxed" style="color: #cbd5e1;">
                                {{ $cms['sidebar_helpdesk_desc'] ?? 'Konsultasikan jadwal kelas, rincian biaya pendidikan, dan opsi beasiswa melalui sekretariat DHS.' }}
                            </p>
                        </div>
                        <div class="px-8 pb-8 space-y-1" style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1.75rem;">
                            <div class="flex items-center gap-4 py-3 px-4 rounded-lg transition-all hover:bg-white/5" style="background: rgba(255,255,255,0.03);">
                                <span class="material-icons text-[1.15rem]" style="color: #94a3b8;">phone</span>
                                <div class="flex-1">
                                    <div class="text-[0.68rem] uppercase tracking-wider font-bold mb-1" style="color: #64748b; letter-spacing: 0.08em;">Telepon Kampus</div>
                                    <div class="font-bold text-[0.95rem] text-white">{{ $cms['sidebar_phone'] ?? '(0361) 222-123' }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 py-3 px-4 rounded-lg transition-all hover:bg-amber-500/10" style="background: rgba(251,191,36,0.06);">
                                <span class="material-icons text-[1.15rem]" style="color: #fbbf24;">phone_android</span>
                                <div class="flex-1">
                                    <div class="text-[0.68rem] uppercase tracking-wider font-bold mb-1" style="color: #94a3b8; letter-spacing: 0.08em;">WhatsApp Admisi</div>
                                    <div class="font-bold text-[0.95rem]" style="color: #fbbf24;">{{ $cms['sidebar_wa'] ?? '+62 81 246 319966' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>{{-- /right --}}

            </div>
        </div>
    </div>

    {{-- ═══════════════════════ RELATED PROGRAMS ════════════════════════════ --}}
    @if($relatedPrograms->isNotEmpty())
    <section class="py-16 px-5 md:px-8 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10">
                <p class="text-[0.65rem] uppercase tracking-[0.2em] font-bold text-primary mb-2">Program Lainnya</p>
                <h2 class="font-serif font-bold text-2xl md:text-3xl text-slate-900">Pilihan Program Unggulan DHS</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPrograms as $rel)
                <a href="/program/{{ $rel->slug }}" class="pd-rel-card flex flex-col h-full group">
                    <div class="relative h-48 overflow-hidden bg-slate-900">
                        <img src="{{ $rel->thumbnail_url ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800' }}"
                             alt="{{ $rel->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-[0.65rem] font-bold uppercase tracking-wide">
                            {{ $rel->category ? $rel->category->category_name : 'Pelatihan' }}
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif font-bold text-base text-slate-900 mb-2 line-clamp-2 leading-snug group-hover:text-primary transition-colors">{{ $rel->title }}</h3>
                            <p class="text-slate-500 text-xs line-clamp-2 leading-relaxed mb-4">{{ $rel->description }}</p>
                        </div>
                        <div class="flex items-center gap-1 text-xs font-bold text-primary">
                            <span>Lihat Detail</span>
                            <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection
