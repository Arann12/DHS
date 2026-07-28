@extends('layouts.app')

@section('title', 'Karier — Denpasar Hotel School')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden mb-16">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img alt="Karier DHS" class="absolute inset-0 w-full h-full object-cover"
            src="https://images.unsplash.com/photo-1521737711867-e3b90473bd58?q=80&w=1600&auto=format&fit=crop">

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><span data-id="Karier" data-en="Career">Karier</span></span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-8 leading-[1.1]">
                <span data-id="Karier di DHS" data-en="Careers at DHS">Karier di DHS</span>
            </h1>
            <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/70 font-medium">
                <span data-id="Bergabunglah Bersama Kami" data-en="Join Us">Bergabunglah Bersama Kami</span>
            </p>
        </div>
    </section>

    <!-- Coming Soon Banner -->
    <section class="bg-dhs-cream py-20 px-5 md:px-16">
        <div class="max-w-3xl mx-auto text-center">
            <span class="material-icons text-primary text-6xl mb-8 block">work_outline</span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6">
                <span data-id="Lowongan Kerja Tersedia" data-en="Available Job Vacancies">Lowongan Kerja Tersedia</span>
            </h2>
            <p class="text-base text-muted-light mb-10 leading-relaxed">
                <span data-id="Halaman karier kami sedang dalam pengembangan. Untuk informasi lowongan terkini, silakan hubungi tim HR kami melalui email atau WhatsApp." data-en="Our career page is currently under development. For the latest vacancy information, please contact our HR team via email or WhatsApp.">Halaman karier kami sedang dalam pengembangan. Untuk informasi lowongan terkini, silakan hubungi tim HR kami melalui email atau WhatsApp.</span>
            </p>
            @php
                $helpdeskWA = $footerSettings['helpdesk_wa'] ?? '+62 81 246 319966';
                $waNumber = preg_replace('/[^0-9]/', '', $helpdeskWA);
                if (!str_starts_with($waNumber, '62')) { $waNumber = '62' . ltrim($waNumber, '0'); }
            @endphp
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a class="px-8 py-4 bg-dhs-navy text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-darknavy transition-colors"
                    href="mailto:{{ $footerSettings['helpdesk_email'] ?? 'karier@dhs.or.id' }}">
                    <span data-id="Kirim CV via Email" data-en="Send CV via Email">Kirim CV via Email</span>
                </a>
                <a class="px-8 py-4 bg-transparent border border-dhs-navy text-dhs-navy text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-cream transition-colors"
                    href="https://wa.me/{{ $waNumber }}">
                    <span data-id="Hubungi via WhatsApp" data-en="Contact via WhatsApp">Hubungi via WhatsApp</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Mengapa Bergabung -->
    <section class="py-20 md:py-24 px-5 md:px-16 max-w-[1280px] mx-auto">
        <div class="text-center mb-16">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                <span data-id="Kenapa DHS?" data-en="Why DHS?">Kenapa DHS?</span>
            </span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">
                <span data-id="Mengapa Bergabung dengan Kami" data-en="Why Join Us">Mengapa Bergabung dengan Kami</span>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 bg-white shadow-sm border border-transparent hover:border-black/10 transition-colors">
                <span class="material-icons text-primary text-3xl mb-4 block">school</span>
                <h3 class="text-[20px] font-semibold font-serif text-text-light mb-3">
                    <span data-id="Lingkungan Akademik Berkualitas" data-en="Quality Academic Environment">Lingkungan Akademik Berkualitas</span>
                </h3>
                <p class="text-base text-muted-light leading-relaxed">
                    <span data-id="Bekerja bersama pengajar dan praktisi berpengalaman di lingkungan kampus yang mendukung pertumbuhan profesional." data-en="Work alongside experienced educators and practitioners in a campus environment that supports professional growth.">Bekerja bersama pengajar dan praktisi berpengalaman di lingkungan kampus yang mendukung pertumbuhan profesional.</span>
                </p>
            </div>
            <div class="p-8 bg-white shadow-sm border border-transparent hover:border-black/10 transition-colors">
                <span class="material-icons text-primary text-3xl mb-4 block">diversity_3</span>
                <h3 class="text-[20px] font-semibold font-serif text-text-light mb-3">
                    <span data-id="Komunitas yang Inklusif" data-en="Inclusive Community">Komunitas yang Inklusif</span>
                </h3>
                <p class="text-base text-muted-light leading-relaxed">
                    <span data-id="Budaya kerja yang kolaboratif, menghargai keberagaman, dan mendorong inovasi dalam pendidikan hospitality." data-en="A collaborative work culture that values diversity and encourages innovation in hospitality education.">Budaya kerja yang kolaboratif, menghargai keberagaman, dan mendorong inovasi dalam pendidikan hospitality.</span>
                </p>
            </div>
            <div class="p-8 bg-white shadow-sm border border-transparent hover:border-black/10 transition-colors">
                <span class="material-icons text-primary text-3xl mb-4 block">trending_up</span>
                <h3 class="text-[20px] font-semibold font-serif text-text-light mb-3">
                    <span data-id="Pengembangan Karir" data-en="Career Development">Pengembangan Karir</span>
                </h3>
                <p class="text-base text-muted-light leading-relaxed">
                    <span data-id="Program pelatihan staf berkelanjutan, akses ke jaringan industri global, dan kesempatan pengembangan kompetensi." data-en="Continuous staff training programs, access to a global industry network, and competency development opportunities.">Program pelatihan staf berkelanjutan, akses ke jaringan industri global, dan kesempatan pengembangan kompetensi.</span>
                </p>
            </div>
        </div>
    </section>
@endsection
