@extends('layouts.app')

@section('title', 'Daftar Program Studi & Vokasi — Denpasar Hotel School')

@push('styles')
<style>
    .prog-index-bg { background-color: #F8FAFC; }

    /* Filter pill */
    .pi-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.55rem 1.1rem;
        border-radius: 9999px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        font-size: 0.78rem;
        font-weight: 600;
        color: #475569;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.2s cubic-bezier(0.4,0,0.2,1);
        text-decoration: none;
    }
    .pi-pill:hover {
        border-color: #0F2440;
        color: #0F2440;
        box-shadow: 0 2px 8px rgba(15,36,64,0.12);
        transform: translateY(-1px);
    }
    .pi-pill.active {
        background: #0F2440;
        border-color: #0F2440;
        color: #ffffff;
        box-shadow: 0 4px 16px rgba(15,36,64,0.28);
        transform: translateY(-1px);
    }
    .pi-pill .material-icons {
        font-size: 0.9rem;
    }

    /* Program card */
    .pi-card {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 1.125rem;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: box-shadow 0.25s cubic-bezier(0.4,0,0.2,1), transform 0.25s cubic-bezier(0.4,0,0.2,1);
        text-decoration: none;
    }
    .pi-card:hover {
        box-shadow: 0 16px 40px rgba(0,0,0,0.13);
        transform: translateY(-4px);
    }
    .pi-card:hover .pi-card-img { transform: scale(1.05); }

    .pi-card-thumb {
        position: relative;
        height: 13.5rem;
        overflow: hidden;
        background: #0f172a;
        flex-shrink: 0;
    }
    .pi-card-img {
        width: 100%; height: 100%;
        object-fit: cover;
        opacity: 0.88;
        transition: transform 0.5s cubic-bezier(0.4,0,0.2,1);
    }
    .pi-card-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(15,23,42,0.72) 0%, transparent 55%);
    }

    .pi-card-body {
        padding: 1.4rem 1.5rem 1.25rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .pi-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.35;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.15s ease;
    }
    .pi-card:hover .pi-card-title { color: #C53030; }
    .pi-card-desc {
        font-size: 0.75rem;
        color: #64748b;
        line-height: 1.65;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 1.1rem;
    }
    .pi-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 0.875rem;
        border-top: 1px solid #f1f5f9;
    }

    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@section('content')

    {{-- ═══════════════════════════════ HERO ═══════════════════════════════ --}}
    <section class="relative flex flex-col justify-start items-center text-center overflow-hidden bg-slate-950 text-white"
             style="min-height: 640px; padding-top: 160px; padding-bottom: 72px;">
        <div class="absolute inset-0 bg-black/60 z-10"></div>
        <img alt="Katalog Program DHS" width="1920" height="1080"
             class="absolute inset-0 w-full h-full object-cover"
             style="will-change: transform;"
             src="/image/hero_registration.jpg">

        <div class="relative z-20 px-6 max-w-4xl mx-auto" data-reveal="fade-up">
            {{-- Breadcrumb --}}
            <nav class="mb-7 inline-flex items-center gap-2 text-white/70 text-xs font-semibold uppercase tracking-wider bg-white/10 px-5 py-2.5 rounded-full border border-white/15 backdrop-blur-sm">
                <a href="/" class="hover:text-white transition-colors flex items-center gap-1">
                    <span class="material-icons text-sm leading-none">home</span>Beranda
                </a>
                <span class="material-icons text-xs opacity-40">chevron_right</span>
                <a href="/akademi" class="hover:text-white transition-colors">Akademi</a>
                <span class="material-icons text-xs opacity-40">chevron_right</span>
                <span class="text-amber-400 font-bold">Katalog Program</span>
            </nav>

            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[3.25rem] font-serif font-bold text-white mb-4 leading-[1.15] tracking-tight">
                Program Studi & Pelatihan Vokasi
            </h1>
            <p class="text-sm text-white/70 max-w-2xl mx-auto leading-relaxed">
                Program unggulan berstandar internasional — mencetak profesional perhotelan, tata boga, dan kru kapal pesiar kelas dunia.
            </p>
        </div>
    </section>

    {{-- ════════════════════════ CATALOG SECTION ════════════════════════════ --}}
    <section class="prog-index-bg pt-20 pb-24 sm:pt-24 sm:pb-28 lg:pt-28 lg:pb-32 px-5 md:px-8">
        <div class="max-w-7xl mx-auto">

            {{-- Label --}}
            <p class="text-[0.65rem] font-bold uppercase tracking-[0.2em] text-primary mb-4" data-reveal="fade-up">
                Filter Kategori Program
            </p>

            {{-- Pills --}}
            <div class="mb-10 overflow-x-auto no-scrollbar pb-1" data-reveal="fade-up">
                <div class="flex flex-nowrap gap-2">
                    @php
                        $catIconMap = [
                            '1-tahun'              => 'school',
                            '1-tahun-kapal-pesiar' => 'directions_boat',
                            '2-tahun'              => 'workspace_premium',
                            'internasional'        => 'public',
                            'short-course'         => 'bolt',
                            '6-bulan'              => 'bolt',
                            'eksekutif'            => 'military_tech',
                        ];
                    @endphp

                    <a href="/program" data-no-loader
                       class="pi-pill {{ !$categoryKey ? 'active' : '' }}">
                        <span class="material-icons">grid_view</span>
                        Semua ({{ \App\Models\Program::where('is_active', 1)->count() }})
                    </a>

                    @foreach($categories as $cat)
                    <a href="/program?category={{ $cat->category_key }}" data-no-loader
                       class="pi-pill {{ $categoryKey === $cat->category_key ? 'active' : '' }}">
                        <span class="material-icons">{{ $catIconMap[$cat->category_key] ?? 'map' }}</span>
                        {{ $cat->category_name }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Active filter bar --}}
            @if($categoryKey || $search)
            <div class="mb-8 px-5 py-3.5 rounded-xl border border-amber-200 bg-amber-50 flex items-center justify-between flex-wrap gap-3 text-xs font-medium text-amber-900">
                <div class="flex items-center gap-2">
                    <span class="material-icons text-amber-500 text-sm">filter_alt</span>
                    <span>Menampilkan:</span>
                    @if($categoryKey)
                        <span class="bg-amber-200/70 px-2.5 py-0.5 rounded-lg font-bold">{{ optional($categories->firstWhere('category_key', $categoryKey))->category_name ?? $categoryKey }}</span>
                    @endif
                    @if($search)
                        <span class="bg-amber-200/70 px-2.5 py-0.5 rounded-lg font-bold">"{{ $search }}"</span>
                    @endif
                </div>
                <a href="/program" data-no-loader class="flex items-center gap-1 font-bold text-primary hover:underline">
                    <span class="material-icons text-xs">close</span> Reset
                </a>
            </div>
            @endif

            {{-- Empty state --}}
            @if($programs->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl border border-slate-200 max-w-xl mx-auto px-6">
                <div class="w-14 h-14 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
                    <span class="material-icons text-primary text-2xl">search_off</span>
                </div>
                <h3 class="font-serif font-bold text-lg text-slate-900 mb-2">Program Tidak Ditemukan</h3>
                <p class="text-slate-500 text-sm mb-6">Tidak ada program yang sesuai dengan filter yang dipilih.</p>
                <a href="/program" class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary text-white font-bold text-xs uppercase tracking-wider rounded-xl hover:bg-red-700 transition-colors">
                    <span class="material-icons text-sm">refresh</span> Lihat Semua
                </a>
            </div>
            @else

            {{-- Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($programs as $prog)
                <a href="/program/{{ $prog->slug }}" class="pi-card group">

                    {{-- Thumbnail --}}
                    <div class="pi-card-thumb">
                        <img class="pi-card-img"
                             src="{{ $prog->thumbnail_url ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800' }}"
                             alt="{{ $prog->title }}"
                             loading="lazy">
                        <div class="pi-card-overlay"></div>

                        {{-- Top badges --}}
                        <div class="absolute top-3.5 left-4 right-4 flex items-center justify-between z-10">
                            <span class="px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-[0.65rem] font-bold uppercase tracking-wide">
                                {{ $prog->category ? $prog->category->category_name : 'Pelatihan' }}
                            </span>
                            @if($prog->country_badge)
                            <span class="px-3 py-1 rounded-full bg-amber-400 text-slate-900 font-bold text-[0.65rem] uppercase tracking-wide">
                                {{ $prog->country_badge }}
                            </span>
                            @endif
                        </div>

                        {{-- Duration bottom-left --}}
                        <div class="absolute bottom-3.5 left-4 z-10 flex items-center gap-1.5">
                            <span class="material-icons text-amber-400 text-sm">schedule</span>
                            <span class="text-white text-xs font-semibold">{{ $prog->duration ?: '1 Tahun' }}</span>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="pi-card-body">
                        <div>
                            <h3 class="pi-card-title">{{ $prog->title }}</h3>
                            <p class="pi-card-desc">{{ $prog->description ?: 'Program pendidikan dan pelatihan keahlian praktis berstandar industri internasional di Denpasar Hotel School.' }}</p>
                        </div>
                        <div class="pi-card-footer">
                            <span class="flex items-center gap-1 text-xs font-bold text-primary">
                                <span>Lihat Detail</span>
                                <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </span>
                            <span class="px-4 py-2 rounded-xl text-white text-xs font-bold"
                                  style="background: #C53030;">
                                Daftar
                            </span>
                        </div>
                    </div>

                </a>
                @endforeach
            </div>
            @endif

        </div>
    </section>

    {{-- ══════════════════════ CONSULTATION CTA ════════════════════════════ --}}
    <section style="background: linear-gradient(135deg, #0f172a 0%, #0F2440 100%); padding: 72px 24px; text-align: center; position: relative; overflow: hidden;">
        <div class="max-w-3xl mx-auto relative z-10" data-reveal="fade-up">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[0.65rem] uppercase tracking-widest font-bold mb-5"
                  style="background: rgba(255,255,255,0.08); color: #fbbf24; border: 1px solid rgba(255,255,255,0.12);">
                <span class="material-icons text-sm">headset_mic</span> Tim Konsultasi Admisi DHS
            </span>
            <h2 class="font-serif font-bold text-2xl sm:text-3xl md:text-[2.25rem] text-white mb-4 leading-snug">
                Bingung Memilih Program yang Tepat?
            </h2>
            <p class="text-sm text-white/55 max-w-xl mx-auto mb-8 leading-relaxed">
                Konsultasikan bakat, minat, dan rencana karir Anda secara gratis bersama konselor admisi Denpasar Hotel School.
            </p>
            @php
                $waAdmin = preg_replace('/[^0-9]/', '', $footerSettings['wa_klungkung'] ?? $footerSettings['phone_denpasar'] ?? '6281246319966');
                $waMsg  = urlencode('Halo Kak DHS 👋, saya ingin konsultasi mengenai program studi yang tersedia di Denpasar Hotel School. Mohon bantuannya ya.');
            @endphp
            <div style="position:relative; display:inline-block;">
                <span style="position:absolute;inset:-6px;border-radius:9999px;border:2px solid rgba(74,222,128,0.35);animation:wa-pulse 2s ease-out infinite;pointer-events:none;"></span>
                <a href="https://wa.me/{{ $waAdmin }}?text={{ $waMsg }}" target="_blank" rel="noopener" data-no-loader
                   class="inline-flex items-center gap-3 px-8 py-4 rounded-full font-bold text-[0.875rem] text-white transition-all hover:-translate-y-0.5"
                   style="background: linear-gradient(135deg,#22c55e,#15803d); box-shadow: 0 8px 28px rgba(34,197,94,0.4);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32" fill="white" style="flex-shrink:0"><path d="M16.003 2C8.28 2 2 8.28 2 16.003c0 2.47.65 4.79 1.78 6.81L2 30l7.38-1.75A13.94 13.94 0 0 0 16.003 30C23.72 30 30 23.72 30 16.003 30 8.28 23.72 2 16.003 2zm0 25.5a11.44 11.44 0 0 1-5.84-1.6l-.42-.25-4.38 1.04 1.06-4.27-.27-.44A11.47 11.47 0 0 1 4.5 16.003C4.5 9.66 9.66 4.5 16.003 4.5S27.5 9.66 27.5 16.003 22.34 27.5 16.003 27.5zm6.29-8.58c-.34-.17-2.02-1-2.34-1.11-.31-.11-.54-.17-.77.17-.23.34-.88 1.11-1.08 1.34-.2.23-.4.26-.74.09-.34-.17-1.44-.53-2.75-1.69-1.02-.91-1.7-2.02-1.9-2.36-.2-.34-.02-.52.15-.69.15-.15.34-.4.51-.6.17-.2.23-.34.34-.57.11-.23.06-.43-.03-.6-.09-.17-.77-1.86-1.06-2.55-.28-.67-.56-.58-.77-.59-.2-.01-.43-.01-.66-.01-.23 0-.6.09-.91.43-.31.34-1.2 1.17-1.2 2.86s1.23 3.32 1.4 3.55c.17.23 2.42 3.69 5.87 5.18.82.35 1.46.56 1.96.72.82.26 1.57.22 2.16.13.66-.1 2.02-.83 2.31-1.62.28-.8.28-1.48.2-1.62-.09-.14-.31-.23-.66-.4z"/></svg>
                    <span>Chat WhatsApp Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="opacity:0.75"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
            <p class="mt-4 text-[0.7rem]" style="color: rgba(255,255,255,0.3);">Gratis &bull; Tanpa Komitmen &bull; Respon Cepat</p>
            <style>
                @keyframes wa-pulse {
                    0%   { transform: scale(1); opacity: 0.7; }
                    70%  { transform: scale(1.2); opacity: 0; }
                    100% { transform: scale(1.2); opacity: 0; }
                }
            </style>
        </div>
    </section>

@endsection
