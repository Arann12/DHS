@extends('layouts.app')

@section('title', 'Program ' . $beasiswa['title'] . ' — Denpasar Hotel School')

@section('content')

    <!-- Hero Section -->
    <section class="relative h-[52vh] min-h-[420px] flex items-center justify-center text-center overflow-hidden bg-dhs-navy">
        <div class="absolute inset-0 bg-black/60 z-10"></div>
        <img alt="{{ $beasiswa['title'] }}" width="1920" height="1080" class="absolute inset-0 w-full h-full object-cover" style="will-change:transform;" src="/image/hero_registration.jpg">

        <div class="relative z-20 px-6 max-w-4xl mx-auto pt-24 pb-12 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-3 justify-center text-white/90 text-xs font-semibold uppercase tracking-widest bg-white/10 px-5 py-2 rounded-full backdrop-blur-md border border-white/15">
                <a class="hover:text-white transition-colors" href="/">Beranda</a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <a class="hover:text-white transition-colors" href="/akademi">Akademi</a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold">{{ $beasiswa['title'] }}</span>
            </div>
            
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-white/15 backdrop-blur-md mb-6 border border-white/25 shadow-xl">
                <span class="material-icons text-4xl text-amber-400">{{ $beasiswa['icon'] }}</span>
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-5 leading-tight">
                {{ $beasiswa['title'] }}
            </h1>
            <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/80 font-medium max-w-2xl mx-auto leading-relaxed">
                Program Beasiswa & Keringanan Biaya Pendidikan Denpasar Hotel School
            </p>
        </div>
    </section>

    <!-- Main Content Detail -->
    <main class="py-20 md:py-28 max-w-[1280px] mx-auto px-6 md:px-12 lg:px-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16 items-start">
            
            <!-- Main Information Column (Left) -->
            <div class="lg:col-span-2 space-y-12 md:space-y-14">
                
                <!-- Deskripsi & Manfaat Beasiswa -->
                <div class="bg-white border border-black/10 rounded-3xl p-8 md:p-12 shadow-sm space-y-6" data-reveal="fade-up">
                    <h3 class="text-2xl md:text-3xl font-serif font-bold text-text-light flex items-center gap-4">
                        <span class="w-3 h-8 bg-primary rounded-full shrink-0"></span>
                        Tentang {{ $beasiswa['title'] }}
                    </h3>
                    <p class="text-base md:text-lg text-muted-light leading-relaxed text-justify">
                        {{ $beasiswa['description'] }}
                    </p>

                    <div class="p-6 md:p-7 bg-amber-500/10 border border-amber-500/20 rounded-2xl flex items-start gap-4 mt-6">
                        <div class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-md">
                            <span class="material-icons text-2xl">card_giftcard</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-base md:text-lg text-dhs-navy mb-1">Manfaat Utama Beasiswa</h4>
                            <p class="text-xs md:text-sm font-medium text-text-light leading-relaxed">{{ $beasiswa['manfaat'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Persyaratan Beasiswa -->
                <div class="bg-white border border-black/10 rounded-3xl p-8 md:p-12 shadow-sm space-y-8" data-reveal="fade-up">
                    <div>
                        <h3 class="text-2xl md:text-3xl font-serif font-bold text-text-light flex items-center gap-4 mb-2">
                            <span class="w-3 h-8 bg-primary rounded-full shrink-0"></span>
                            Persyaratan Kualifikasi & Dokumen
                        </h3>
                        <p class="text-xs md:text-sm text-muted-light ml-7">Syarat utama untuk mengikuti seleksi beasiswa ini:</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach($beasiswa['syarat'] as $item)
                        <div class="flex items-start gap-4 p-5 md:p-6 bg-slate-50/90 rounded-2xl border border-slate-200/80 hover:border-primary/30 hover:bg-white hover:shadow-md transition-all">
                            <span class="material-icons text-emerald-600 text-2xl shrink-0 mt-0.5">check_circle</span>
                            <span class="text-xs md:text-sm font-semibold text-text-light leading-relaxed">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- Sidebar Info Column (Right) -->
            <div class="lg:col-span-1 space-y-10 lg:sticky lg:top-28" data-reveal="fade-up">
                
                <!-- Box Ringkasan Beasiswa -->
                <div class="bg-dhs-navy text-white rounded-3xl p-8 md:p-10 shadow-xl space-y-8 border border-white/10">
                    <h4 class="font-serif font-bold text-2xl border-b border-white/15 pb-5 tracking-wide">Ringkasan Beasiswa</h4>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center shrink-0 border border-white/15">
                                <span class="material-icons text-amber-400 text-2xl">verified</span>
                            </div>
                            <div>
                                <span class="text-[0.7rem] uppercase tracking-wider text-white/60 font-semibold block mb-1">Skema Program</span>
                                <span class="text-base font-bold text-white leading-snug">{{ $beasiswa['title'] }}</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 pt-5 border-t border-white/10">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center shrink-0 border border-white/15">
                                <span class="material-icons text-emerald-400 text-2xl">workspace_premium</span>
                            </div>
                            <div>
                                <span class="text-[0.7rem] uppercase tracking-wider text-white/60 font-semibold block mb-1">Keringanan Biaya</span>
                                <span class="text-base font-bold text-emerald-300 leading-snug">Hingga 50%</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-white/15">
                        {{-- Formulir Pendaftaran Button --}}
                        <a href="/layanan?beasiswa={{ urlencode($beasiswa['title']) }}" 
                           class="group relative w-full p-4.5 px-5 rounded-2xl bg-amber-400 hover:bg-amber-300 text-dhs-navy font-bold text-sm shadow-xl shadow-amber-950/20 hover:shadow-amber-950/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 flex items-center justify-between overflow-hidden">
                            <div class="flex items-center gap-3.5 relative z-10">
                                <div class="w-11 h-11 rounded-xl bg-dhs-navy/10 flex items-center justify-center shrink-0 border border-dhs-navy/15 shadow-inner">
                                    <span class="material-icons text-2xl text-dhs-navy">edit_note</span>
                                </div>
                                <div class="text-left">
                                    <span class="block text-[0.65rem] uppercase tracking-widest text-dhs-navy/70 font-bold">Daftar Beasiswa</span>
                                    <span class="block font-serif font-bold text-base text-dhs-navy leading-tight">Formulir Pendaftaran</span>
                                </div>
                            </div>
                            <span class="material-icons text-xl text-dhs-navy group-hover:translate-x-1.5 transition-transform relative z-10">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Navigation List Beasiswa Lainnya -->
                <div class="bg-white border border-black/10 rounded-3xl p-8 shadow-sm space-y-5">
                    <h5 class="text-xs uppercase tracking-wider font-bold text-primary px-1">Program Beasiswa Lainnya</h5>
                    <div class="space-y-3">
                        @foreach([
                            'beasiswa-prestasi' => 'Beasiswa Prestasi',
                            'beasiswa-stt' => 'Beasiswa STT / Desa',
                            'beasiswa-khusus' => 'Beasiswa Khusus'
                        ] as $key => $title)
                        <a href="/beasiswa/{{ $key }}" class="flex items-center justify-between p-3.5 px-5 rounded-2xl text-xs md:text-sm font-semibold {{ $type == $key ? 'bg-primary text-white shadow-md' : 'text-text-light hover:bg-dhs-lightblue' }} transition-all">
                            <span>{{ $title }}</span>
                            <span class="material-icons text-base">chevron_right</span>
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </main>
@endsection
