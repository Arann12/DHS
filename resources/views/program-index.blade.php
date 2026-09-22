@extends('layouts.app')

@section('title', 'Daftar Program Studi & Vokasi — Denpasar Hotel School')

@section('content')

    <!-- Hero Section -->
    <section class="relative min-h-[680px] md:min-h-[720px] flex flex-col justify-start items-center text-center overflow-hidden bg-slate-950 text-white" style="padding-top: 165px; padding-bottom: 90px;">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/90 via-slate-950/95 to-[#081225] z-10"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(197,48,48,0.2),transparent_50%)] z-10"></div>
        <img alt="Katalog Program DHS" width="1920" height="1080" class="absolute inset-0 w-full h-full object-cover opacity-25 filter blur-[2px]" src="/image/hero_registration.jpg">

        <div class="relative z-20 px-6 max-w-5xl mx-auto" data-reveal="fade-up">
            <!-- Breadcrumbs -->
            <div class="mb-8 inline-flex items-center space-x-2.5 justify-center text-white/90 text-xs sm:text-sm font-semibold uppercase tracking-wider bg-slate-900/80 px-6 py-2.5 rounded-full border border-white/20 shadow-lg backdrop-blur-md" style="text-shadow: 0 1px 2px rgba(0,0,0,0.8);">
                <a class="hover:text-amber-300 transition-colors flex items-center gap-1" href="/">
                    <span class="material-icons text-sm">home</span> Beranda
                </a>
                <span class="material-icons text-xs text-white/40">chevron_right</span>
                <a class="hover:text-amber-300 transition-colors" href="/akademi">Akademi</a>
                <span class="material-icons text-xs text-white/40">chevron_right</span>
                <span class="text-amber-400 font-bold">Katalog Program</span>
            </div>

            <!-- Header Titles -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-4 leading-tight tracking-tight">
                Program Studi & Pelatihan Vokasi
            </h1>
            <p class="text-xs sm:text-sm md:text-base text-slate-300 font-medium max-w-3xl mx-auto leading-relaxed">
                Pilih program unggulan berstandar internasional yang dirancang khusus untuk mencetak profesional perhotelan, tata boga, dan kru kapal pesiar tingkat dunia.
            </p>


        </div>
    </section>

    <!-- Category Filter Tabs & Main Catalog Grid -->
    <section class="bg-slate-50 py-16 px-5 md:px-8 border-b border-slate-200">
        <div class="max-w-7xl mx-auto">

            <!-- Category Pills / Tabs -->
            <div class="mb-12 overflow-x-auto pb-4 flex items-center justify-start md:justify-center gap-2.5 scrollbar-none">
                <a href="/program" data-no-loader class="px-5 py-2.5 rounded-full text-xs font-bold transition-all whitespace-nowrap border {{ !$categoryKey ? 'bg-primary text-white border-primary shadow-md' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-100 hover:border-slate-300' }}">
                    Semua Program ({{ \App\Models\Program::where('is_active', 1)->count() }})
                </a>
                @foreach($categories as $cat)
                <a href="/program?category={{ $cat->category_key }}" data-no-loader class="px-5 py-2.5 rounded-full text-xs font-bold transition-all whitespace-nowrap border {{ $categoryKey === $cat->category_key ? 'bg-primary text-white border-primary shadow-md' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-100 hover:border-slate-300' }}">
                    {{ $cat->category_name }}
                </a>
                @endforeach
            </div>

            <!-- Active Filter Status Bar -->
            @if($categoryKey || $search)
            <div class="mb-8 p-4 bg-amber-50 rounded-2xl border border-amber-200/70 flex items-center justify-between flex-wrap gap-4 text-xs font-medium text-amber-900">
                <div class="flex items-center gap-2">
                    <span class="material-icons text-amber-600 text-sm">filter_alt</span>
                    <span>Menampilkan hasil untuk:</span>
                    @if($categoryKey)
                        <span class="font-bold bg-amber-200/60 px-2.5 py-1 rounded-lg">Kategori: {{ optional($categories->firstWhere('category_key', $categoryKey))->category_name ?? $categoryKey }}</span>
                    @endif
                    @if($search)
                        <span class="font-bold bg-amber-200/60 px-2.5 py-1 rounded-lg">Pencarian: "{{ $search }}"</span>
                    @endif
                </div>
                <a href="/program" data-no-loader class="text-primary hover:underline font-bold flex items-center gap-1">
                    <span class="material-icons text-xs">close</span> Reset Filter
                </a>
            </div>
            @endif

            <!-- Empty State -->
            @if($programs->isEmpty())
            <div class="text-center py-20 bg-white rounded-3xl border border-slate-200/80 shadow-xs max-w-2xl mx-auto px-6">
                <div class="w-16 h-16 rounded-full bg-red-50 text-primary flex items-center justify-center mx-auto mb-4">
                    <span class="material-icons text-3xl">sentiment_dissatisfied</span>
                </div>
                <h3 class="font-serif font-bold text-xl text-slate-900 mb-2">Program Tidak Ditemukan</h3>
                <p class="text-xs sm:text-sm text-slate-500 mb-6">Maaf, kami tidak dapat menemukan program studi yang sesuai dengan kata kunci atau filter pilihan Anda.</p>
                <a href="/program" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-bold text-xs uppercase tracking-wider rounded-xl hover:bg-red-700 transition-colors">
                    <span class="material-icons text-sm">refresh</span> Lihat Semua Program
                </a>
            </div>
            @else

            <!-- Program Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($programs as $prog)
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-direction-col overflow-hidden group">
                    
                    <!-- Card Thumbnail Image -->
                    <div class="relative h-56 overflow-hidden bg-slate-900">
                        <img src="{{ $prog->thumbnail_url ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800' }}" alt="{{ $prog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        
                        <!-- Top Badges -->
                        <div class="absolute top-4 left-4 right-4 flex items-center justify-between gap-2 z-10">
                            <span class="px-3 py-1 rounded-full bg-slate-900/80 text-white text-[0.65rem] font-bold uppercase tracking-wider backdrop-blur-md border border-white/10 shadow-sm">
                                {{ $prog->category ? $prog->category->category_name : 'Pelatihan' }}
                            </span>
                            @if($prog->country_badge)
                            <span class="px-3 py-1 rounded-full bg-amber-400 text-slate-950 font-bold text-[0.65rem] uppercase tracking-wider shadow-md border border-amber-300">
                                {{ $prog->country_badge }}
                            </span>
                            @endif
                        </div>

                        <!-- Duration Badge (Bottom Left Image) -->
                        <div class="absolute bottom-3 left-4 z-10 flex items-center gap-1.5 text-white/90 text-xs font-semibold">
                            <span class="material-icons text-amber-400 text-sm">schedule</span>
                            <span>{{ $prog->duration ?: '1 Tahun' }}</span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif font-bold text-lg text-slate-900 mb-3 group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                {{ $prog->title }}
                            </h3>
                            <p class="text-slate-600 text-xs leading-relaxed line-clamp-3 mb-6">
                                {{ $prog->description ?: 'Program pendidikan dan pelatihan keahlian praktis berstandar industri internasional di Denpasar Hotel School.' }}
                            </p>
                        </div>

                        <!-- Card Footer / Actions -->
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-3">
                            <a href="/program/{{ $prog->slug }}" class="flex-1 px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold text-center transition-colors flex items-center justify-center gap-1">
                                <span>Detail Program</span>
                                <span class="material-icons text-sm">arrow_forward</span>
                            </a>
                            <a href="/formulir-pendaftaran?program={{ $prog->slug }}" class="px-4 py-2.5 rounded-xl bg-primary hover:bg-red-700 text-white text-xs font-bold text-center transition-colors shadow-sm">
                                Daftar
                            </a>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
            @endif

        </div>
    </section>

    <!-- Consultation CTA Footer -->
    <section style="background: linear-gradient(to right, #0f172a, #020617, #0F2440); padding: 64px 24px; text-align: center; position: relative; overflow: hidden;">
        <div class="max-w-4xl mx-auto relative z-10" data-reveal="fade-up">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[0.7rem] uppercase tracking-widest font-bold mb-4" style="background: rgba(255,255,255,0.1); color: #fbbf24; border: 1px solid rgba(255,255,255,0.15);">
                <span class="material-icons text-sm">headset_mic</span> Tim Konsultasi Admisi DHS
            </span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-serif font-bold mb-4" style="color: #ffffff;">Bingung Memilih Program Studi yang Tepat?</h2>
            <p class="text-xs sm:text-sm max-w-2xl mx-auto mb-8 leading-relaxed" style="color: #cbd5e1;">
                Konsultasikan bakat, minat, dan rencana karir masa depan Anda secara gratis bersama konselor admisi Denpasar Hotel School.
            </p>
            @php
                $waAdmin = preg_replace('/[^0-9]/', '', $footerSettings['wa_klungkung'] ?? $footerSettings['phone_denpasar'] ?? '6281246319966');
                $waMsg  = urlencode('Halo Kak DHS 👋, saya ingin konsultasi mengenai program studi yang tersedia di Denpasar Hotel School. Mohon bantuannya ya.');
            @endphp
            <div class="flex flex-col items-center gap-4 mt-2">
                <!-- WhatsApp CTA Button -->
                <div style="position:relative; display:inline-block;">
                    <!-- Pulse ring -->
                    <span style="position:absolute;inset:-6px;border-radius:9999px;border:2px solid rgba(74,222,128,0.4);animation:wa-pulse 2s ease-out infinite;pointer-events:none;"></span>
                    <a href="https://wa.me/{{ $waAdmin }}?text={{ $waMsg }}" target="_blank" rel="noopener" data-no-loader
                       style="display:inline-flex;align-items:center;gap:12px;padding:14px 32px;border-radius:9999px;text-decoration:none;font-weight:800;font-size:0.85rem;letter-spacing:0.04em;color:#fff;position:relative;overflow:hidden;
                              background:linear-gradient(135deg,#22c55e 0%,#16a34a 50%,#15803d 100%);
                              box-shadow:0 8px 32px rgba(34,197,94,0.45), 0 2px 8px rgba(0,0,0,0.3);
                              transition:transform 0.2s, box-shadow 0.2s;"
                       onmouseover="this.style.transform='translateY(-2px) scale(1.03)';this.style.boxShadow='0 16px 40px rgba(34,197,94,0.55), 0 4px 12px rgba(0,0,0,0.3)';"
                       onmouseout="this.style.transform='';this.style.boxShadow='0 8px 32px rgba(34,197,94,0.45), 0 2px 8px rgba(0,0,0,0.3)';">
                        <!-- Shimmer overlay -->
                        <span style="position:absolute;top:0;left:-75%;width:50%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.2),transparent);animation:wa-shimmer 2.5s ease-in-out infinite;pointer-events:none;"></span>
                        <!-- WhatsApp Icon SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32" fill="white" style="flex-shrink:0;">
                            <path d="M16.003 2C8.28 2 2 8.28 2 16.003c0 2.47.65 4.79 1.78 6.81L2 30l7.38-1.75A13.94 13.94 0 0 0 16.003 30C23.72 30 30 23.72 30 16.003 30 8.28 23.72 2 16.003 2zm0 25.5a11.44 11.44 0 0 1-5.84-1.6l-.42-.25-4.38 1.04 1.06-4.27-.27-.44A11.47 11.47 0 0 1 4.5 16.003C4.5 9.66 9.66 4.5 16.003 4.5S27.5 9.66 27.5 16.003 22.34 27.5 16.003 27.5zm6.29-8.58c-.34-.17-2.02-1-2.34-1.11-.31-.11-.54-.17-.77.17-.23.34-.88 1.11-1.08 1.34-.2.23-.4.26-.74.09-.34-.17-1.44-.53-2.75-1.69-1.02-.91-1.7-2.02-1.9-2.36-.2-.34-.02-.52.15-.69.15-.15.34-.4.51-.6.17-.2.23-.34.34-.57.11-.23.06-.43-.03-.6-.09-.17-.77-1.86-1.06-2.55-.28-.67-.56-.58-.77-.59-.2-.01-.43-.01-.66-.01-.23 0-.6.09-.91.43-.31.34-1.2 1.17-1.2 2.86s1.23 3.32 1.4 3.55c.17.23 2.42 3.69 5.87 5.18.82.35 1.46.56 1.96.72.82.26 1.57.22 2.16.13.66-.1 2.02-.83 2.31-1.62.28-.8.28-1.48.2-1.62-.09-.14-.31-.23-.66-.4z"/>
                        </svg>
                        <span>Chat WhatsApp Sekarang</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;opacity:0.8">
                            <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                </div>
                <!-- Trust text -->
                <p style="color:rgba(255,255,255,0.45);font-size:0.7rem;display:flex;align-items:center;gap:6px;margin-top:4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="rgba(255,255,255,0.4)"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
                    Gratis &bull; Tanpa Komitmen &bull; Respon Cepat
                </p>
            </div>
            <style>
                @keyframes wa-pulse {
                    0%   { transform: scale(1);   opacity: 0.8; }
                    70%  { transform: scale(1.18); opacity: 0;   }
                    100% { transform: scale(1.18); opacity: 0;   }
                }
                @keyframes wa-shimmer {
                    0%   { left: -75%; }
                    100% { left: 130%; }
                }
            </style>
        </div>
    </section>

@endsection
