@extends('layouts.app')

@section('title', 'Layanan Pengurusan ' . $doc['title'] . ' — Denpasar Hotel School')

@section('content')

    <!-- Hero Section -->
    <section class="relative min-h-[460px] lg:min-h-[480px] flex items-center justify-center overflow-hidden bg-slate-900 text-white pt-24 pb-20 md:pb-24">
        <!-- Ambient Background Overlay & Images -->
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/95 via-slate-950/98 to-[#081225] z-10"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(2,132,199,0.25),transparent_50%)] z-10"></div>
        <img alt="{{ $doc['title'] }}" width="1920" height="1080" class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-30 filter blur-[2px]" src="{{ !empty($doc['hero_image']) ? $doc['hero_image'] : 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600' }}">

        <div class="relative z-20 px-6 max-w-5xl mx-auto text-center" data-reveal="fade-up">
            <!-- Breadcrumbs -->
            <div class="mb-6 inline-flex items-center space-x-2.5 justify-center text-white/80 text-[0.725rem] font-semibold uppercase tracking-widest bg-white/10 px-5 py-2 rounded-full backdrop-blur-md border border-white/15 shadow-sm">
                <a class="hover:text-amber-300 transition-colors flex items-center gap-1" href="/">
                    <span class="material-icons text-sm">home</span> Beranda
                </a>
                <span class="material-icons text-xs text-white/40">chevron_right</span>
                <a class="hover:text-amber-300 transition-colors" href="/akademi">Akademi</a>
                <span class="material-icons text-xs text-white/40">chevron_right</span>
                <span class="text-amber-400 font-bold">{{ $doc['slug'] }}</span>
            </div>
            
            <!-- Document Category Badge -->
            <div class="mb-4">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-400/20 text-amber-300 border border-amber-400/30 text-[0.7rem] uppercase tracking-widest font-bold shadow-inner">
                    <span class="material-icons text-sm">verified</span>
                    {{ $doc['badge'] ?? 'Sertifikasi Resmi STCW & Standar Internasional' }}
                </span>
            </div>

            <!-- Icon Header -->
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-br from-white/20 to-white/5 backdrop-blur-md mb-6 border border-white/25 shadow-2xl shadow-black/40 group hover:scale-105 transition-transform duration-300">
                <span class="material-icons text-4xl text-amber-400 group-hover:rotate-12 transition-transform duration-300">{{ $doc['icon'] }}</span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-5 leading-tight tracking-tight">
                Layanan Pengurusan {{ $doc['title'] }}
            </h1>
            <p class="text-xs sm:text-sm md:text-base uppercase tracking-[0.2em] text-cyan-200/90 font-medium max-w-3xl mx-auto leading-relaxed">
                {{ $doc['category'] ?? 'Bantuan Resmi & Pendampingan Pengurusan Dokumen Sertifikasi' }}
            </p>

            <!-- Quick Info Bar (Below Title) -->
            <div class="mt-8 flex flex-wrap items-center justify-center gap-3 md:gap-6 text-xs text-white/80 font-medium">
                <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-xl border border-white/10 backdrop-blur-sm">
                    <span class="material-icons text-amber-400 text-base">schedule</span>
                    <span>Waktu: <strong class="text-white">{{ $doc['waktu'] }}</strong></span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-xl border border-white/10 backdrop-blur-sm">
                    <span class="material-icons text-emerald-400 text-base">verified_user</span>
                    <span>Status: <strong class="text-emerald-300">Resmi &amp; Terverifikasi</strong></span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-xl border border-white/10 backdrop-blur-sm">
                    <span class="material-icons text-cyan-400 text-base">headset_mic</span>
                    <span>Layanan: <strong class="text-cyan-200">Pendampingan Full</strong></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Metrics Highlight Section (Spaced with clear top/bottom margin) -->
    <section class="relative z-30 max-w-[1280px] mx-auto px-6 md:px-12 pt-12 md:pt-16 pb-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5 md:gap-6">
            <div class="bg-white rounded-2xl p-5 md:p-6 border border-slate-200/80 shadow-md hover:shadow-lg transition-all hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-200 text-amber-600 flex items-center justify-center shrink-0">
                        <span class="material-icons text-2xl">schedule</span>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[0.65rem] uppercase tracking-wider font-bold text-slate-400 block mb-0.5">Estimasi Proses</span>
                        <span class="text-sm md:text-base font-bold text-slate-800 truncate block">{{ $doc['waktu'] }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 md:p-6 border border-slate-200/80 shadow-md hover:shadow-lg transition-all hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center shrink-0">
                        <span class="material-icons text-2xl">security</span>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[0.65rem] uppercase tracking-wider font-bold text-slate-400 block mb-0.5">Jaminan Keabsahan</span>
                        <span class="text-sm md:text-base font-bold text-slate-800 truncate block">100% Asli / Resmi</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 md:p-6 border border-slate-200/80 shadow-md hover:shadow-lg transition-all hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-sky-50 border border-sky-200 text-sky-600 flex items-center justify-center shrink-0">
                        <span class="material-icons text-2xl">work_outline</span>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[0.65rem] uppercase tracking-wider font-bold text-slate-400 block mb-0.5">Target Peruntukan</span>
                        <span class="text-sm md:text-base font-bold text-slate-800 truncate block">Kapal Pesiar &amp; Hotel</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 md:p-6 border border-slate-200/80 shadow-md hover:shadow-lg transition-all hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 border border-indigo-200 text-indigo-600 flex items-center justify-center shrink-0">
                        <span class="material-icons text-2xl">support_agent</span>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[0.65rem] uppercase tracking-wider font-bold text-slate-400 block mb-0.5">Bantuan Admisi</span>
                        <span class="text-sm md:text-base font-bold text-slate-800 truncate block">Konsultasi Gratis</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Detail -->
    <main class="pt-10 pb-16 md:pt-12 md:pb-24 max-w-[1280px] mx-auto px-6 md:px-12 lg:px-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16 items-start">
            
            <!-- Main Information Column (Left) -->
            <div class="lg:col-span-2 space-y-12">
                
                <!-- Deskripsi Layanan -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-8 md:p-12 shadow-sm space-y-6 relative overflow-hidden" data-reveal="fade-up">
                    <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-primary to-cyan-500"></div>
                    <div class="flex items-center justify-between border-b border-slate-100 pb-5">
                        <h3 class="text-2xl md:text-3xl font-serif font-bold text-slate-900 flex items-center gap-3">
                            <span class="material-icons text-primary text-3xl">info</span>
                            Tentang {{ $doc['title'] }}
                        </h3>
                        @if(isset($doc['badge']))
                        <span class="hidden sm:inline-flex text-xs font-semibold px-3 py-1 bg-sky-50 text-sky-800 rounded-full border border-sky-200">
                            {{ $doc['badge'] }}
                        </span>
                        @endif
                    </div>
                    
                    <p class="text-base md:text-lg text-slate-600 leading-relaxed text-justify">
                        {{ $doc['description'] }}
                    </p>

                    @if(isset($doc['peruntukan']))
                    <div class="p-4 md:p-5 bg-sky-50/70 border border-sky-100 rounded-2xl flex items-start gap-3">
                        <span class="material-icons text-sky-600 text-xl mt-0.5">assignment_ind</span>
                        <div class="text-xs md:text-sm text-slate-700">
                            <strong class="text-sky-900 block font-semibold mb-0.5">Diperuntukkan Bagi:</strong>
                            {{ $doc['peruntukan'] }}
                        </div>
                    </div>
                    @endif

                    @if(isset($doc['key_features']) && count($doc['key_features']) > 0)
                    <div class="pt-4 border-t border-slate-100">
                        <span class="text-xs uppercase tracking-wider font-bold text-slate-400 block mb-3">Keunggulan Layanan Pengurusan DHS:</span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($doc['key_features'] as $feat)
                            <div class="flex items-center gap-2.5 text-xs md:text-sm font-semibold text-slate-700">
                                <span class="material-icons text-emerald-500 text-lg">verified</span>
                                <span>{{ $feat }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Persyaratan Dokumen -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-8 md:p-12 shadow-sm space-y-8" data-reveal="fade-up">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-5">
                        <div>
                            <h3 class="text-2xl md:text-3xl font-serif font-bold text-slate-900 flex items-center gap-3 mb-1">
                                <span class="material-icons text-emerald-600 text-3xl">fact_check</span>
                                Persyaratan Dokumen
                            </h3>
                            <p class="text-xs md:text-sm text-slate-500">Pastikan seluruh dokumen berkas berikut lengkap saat pengajuan:</p>
                        </div>
                        <span class="hidden sm:flex w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-700 items-center justify-center font-bold text-sm border border-emerald-200 shrink-0">
                            {{ count($doc['syarat']) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4.5">
                        @foreach($doc['syarat'] as $idx => $item)
                        <div class="group flex items-start gap-4 p-5 bg-slate-50/90 rounded-2xl border border-slate-200/80 hover:border-emerald-500/40 hover:bg-white hover:shadow-lg transition-all duration-300">
                            <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                {{ $idx + 1 }}
                            </div>
                            <span class="text-xs md:text-sm font-semibold text-slate-800 leading-relaxed pt-1">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>

                    <!-- Tips Menyiapkan Dokumen Callout -->
                    <div class="p-5 bg-amber-50/80 border border-amber-200/80 rounded-2xl flex items-start gap-4">
                        <span class="material-icons text-amber-600 text-2xl shrink-0 mt-0.5">lightbulb</span>
                        <div class="text-xs md:text-sm text-amber-900">
                            <strong class="font-bold text-amber-950 block mb-0.5">Tips Persiapan Berkas:</strong>
                            Siapkan dokumen fisik asli dan hasil scan digital (format JPG/PDF berkualitas jelas) dalam Google Drive untuk mempercepat verifikasi oleh tim admisi DHS.
                        </div>
                    </div>
                </div>

                <!-- Alur & Tahapan Pengurusan -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-8 md:p-12 shadow-sm space-y-8" data-reveal="fade-up">
                    <div class="border-b border-slate-100 pb-5">
                        <h3 class="text-2xl md:text-3xl font-serif font-bold text-slate-900 flex items-center gap-3 mb-1">
                            <span class="material-icons text-sky-600 text-3xl">alt_route</span>
                            Alur &amp; Tahapan Pengurusan
                        </h3>
                        <p class="text-xs md:text-sm text-slate-500">Tahapan sistematis pendampingan dari awal pendaftaran hingga penerbitan dokumen:</p>
                    </div>

                    <div class="relative pl-3 md:pl-6 space-y-6 before:absolute before:left-[27px] md:before:left-[39px] before:top-6 before:bottom-6 before:w-0.5 before:bg-slate-200">
                        @foreach($doc['proses'] as $idx => $step)
                        <div class="relative flex items-start gap-5 md:gap-7 group">
                            <!-- Step Number Badge -->
                            <div class="relative z-10 w-11 h-11 md:w-13 md:h-13 rounded-2xl bg-gradient-to-br from-primary to-dhs-navy text-amber-300 font-serif font-bold text-base md:text-lg flex items-center justify-center shrink-0 shadow-md group-hover:scale-110 group-hover:from-amber-400 group-hover:to-amber-500 group-hover:text-dhs-navy transition-all duration-300 border border-white">
                                {{ $idx + 1 }}
                            </div>
                            <!-- Content Card -->
                            <div class="flex-1 bg-slate-50/90 border border-slate-200/80 p-5 md:p-6 rounded-2xl group-hover:bg-white group-hover:border-primary/30 group-hover:shadow-md transition-all duration-300">
                                <span class="text-[0.65rem] uppercase tracking-widest font-bold text-slate-400 block mb-1">Tahap 0{{ $idx + 1 }}</span>
                                <h4 class="text-sm md:text-base font-bold text-slate-800 leading-snug">{{ $step }}</h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                @if(isset($doc['faq']) && count($doc['faq']) > 0)
                <!-- FAQ Section for Specific Document -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-8 md:p-12 shadow-sm space-y-6" data-reveal="fade-up">
                    <div class="border-b border-slate-100 pb-5">
                        <h3 class="text-2xl md:text-3xl font-serif font-bold text-slate-900 flex items-center gap-3 mb-1">
                            <span class="material-icons text-amber-500 text-3xl">help_outline</span>
                            Pertanyaan Sering Diajukan (FAQ)
                        </h3>
                        <p class="text-xs md:text-sm text-slate-500">Hal-hal yang sering ditanyakan mengenai pengurusan {{ $doc['title'] }}:</p>
                    </div>

                    <div class="space-y-4">
                        @foreach($doc['faq'] as $f)
                        <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200/80">
                            <h4 class="font-bold text-sm md:text-base text-slate-800 flex items-center gap-2 mb-2">
                                <span class="material-icons text-primary text-lg">help</span>
                                {{ $f['q'] }}
                            </h4>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed pl-7">
                                {{ $f['a'] }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            <!-- Sidebar Info Column (Right) -->
            <div class="lg:col-span-1 space-y-8 lg:sticky lg:top-28" data-reveal="fade-up">
                
                <!-- Box Ringkasan Layanan – Clean Redesign -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">

                    <!-- Card Header -->
                    <div class="px-6 pt-6 pb-4">
                        <p class="text-[0.7rem] uppercase tracking-widest font-bold text-primary mb-1">Layanan Resmi DHS</p>
                        <h4 class="font-serif font-bold text-2xl text-slate-900 leading-tight">Ringkasan Layanan</h4>
                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-slate-100 mx-6"></div>

                    <!-- Metric Rows -->
                    <div class="px-6 py-4 space-y-3">
                        <!-- Estimasi Waktu -->
                        <div class="flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                                <span class="material-icons text-xl" style="color: #D97706;">schedule</span>
                            </div>
                            <div>
                                <p class="text-[0.65rem] uppercase tracking-wider font-bold text-slate-400 leading-none mb-0.5">Estimasi Waktu Proses</p>
                                <p class="text-sm font-bold text-slate-900 leading-snug">{{ $doc['waktu'] }}</p>
                            </div>
                        </div>

                        <div class="h-px bg-slate-100"></div>

                        <!-- Estimasi Biaya -->
                        <div class="flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                                <span class="material-icons text-xl" style="color: #059669;">payments</span>
                            </div>
                            <div>
                                <p class="text-[0.65rem] uppercase tracking-wider font-bold text-slate-400 leading-none mb-0.5">Estimasi Biaya</p>
                                <p class="text-sm font-bold text-slate-900 leading-snug">{{ $doc['biaya'] }}</p>
                            </div>
                        </div>

                        <div class="h-px bg-slate-100"></div>

                        <!-- Standardisasi -->
                        <div class="flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center shrink-0">
                                <span class="material-icons text-xl" style="color: #0284C7;">workspace_premium</span>
                            </div>
                            <div>
                                <p class="text-[0.65rem] uppercase tracking-wider font-bold text-slate-400 leading-none mb-0.5">Standardisasi</p>
                                <p class="text-sm font-bold text-slate-900 leading-snug">{{ $doc['badge'] ?? 'Terakreditasi Resmi' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-slate-100 mx-6"></div>

                    <!-- Action Button -->
                    <div class="px-6 pt-5 pb-6">

                        <!-- Tombol Formulir Online (Premium CTA) -->
                        <a href="/layanan?doc={{ urlencode($doc['title']) }}"
                           class="group relative flex items-center justify-between w-full px-5 py-4 rounded-2xl overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl active:scale-[0.99]"
                           style="background: linear-gradient(135deg, #0F2440 0%, #1A3A5C 60%, #0F2440 100%); box-shadow: 0 4px 24px rgba(15,36,64,0.35);">
                            <!-- Subtle shine overlay -->
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                 style="background: linear-gradient(135deg, rgba(255,255,255,0.06) 0%, transparent 60%);"></div>

                            <div class="flex items-center gap-5 relative z-10">
                                <!-- Icon (no background) -->
                                <span class="material-icons text-2xl shrink-0" style="color: #FBBF24;">edit_note</span>
                                <!-- Text -->
                                <div>
                                    <p class="text-[0.6rem] uppercase tracking-[0.15em] font-bold leading-none mb-1.5" style="color: #FBBF24;">Ajukan Permohonan</p>
                                    <p class="font-serif font-bold text-base leading-none" style="color: #ffffff;">Isi Formulir Online</p>
                                </div>
                            </div>

                            <!-- Arrow -->
                            <div class="relative z-10 w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:translate-x-1"
                                 style="background: rgba(255,255,255,0.12);">
                                <span class="material-icons text-base" style="color: #ffffff;">arrow_forward</span>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </main>
@endsection
