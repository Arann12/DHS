@extends('layouts.app')

@section('title', 'Karier — Denpasar Hotel School')

@section('content')
<!-- Hero Section -->
<section class="px-5 md:px-16 pt-16 pb-20 md:pt-32 md:pb-24 max-w-[1280px] mx-auto">
    <div class="flex flex-col gap-6">
        <div class="flex items-center gap-2 text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-muted-light">
            <a class="hover:text-primary transition-colors" href="/">Beranda</a>
            <span class="material-icons text-sm">chevron_right</span>
            <span class="text-text-light">Karier</span>
        </div>
        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary">Bergabunglah Bersama Kami</span>
        <h1 class="text-[40px] md:text-[64px] leading-[1.1] tracking-tight font-bold font-serif text-text-light max-w-3xl">Karier di DHS</h1>
        <p class="text-lg text-muted-light max-w-2xl leading-relaxed">Kami selalu mencari individu bersemangat yang ingin berkontribusi dalam mencetak generasi hospitality profesional terbaik Indonesia.</p>
    </div>
</section>

<!-- Coming Soon Banner -->
<section class="bg-dhs-cream py-20 px-5 md:px-16">
    <div class="max-w-3xl mx-auto text-center">
        <span class="material-icons text-primary text-6xl mb-8 block">work_outline</span>
        <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6">Lowongan Kerja Tersedia</h2>
        <p class="text-base text-muted-light mb-10 leading-relaxed">Halaman karier kami sedang dalam pengembangan. Untuk informasi lowongan terkini, silakan hubungi tim HR kami melalui email atau WhatsApp.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a class="px-8 py-4 bg-dhs-navy text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-darknavy transition-colors" href="mailto:karier@dhs.ac.id">
                Kirim CV via Email
            </a>
            <a class="px-8 py-4 bg-transparent border border-dhs-navy text-dhs-navy text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-cream transition-colors" href="https://wa.me/628123456789">
                Hubungi via WhatsApp
            </a>
        </div>
    </div>
</section>

<!-- Mengapa Bergabung -->
<section class="py-20 md:py-24 px-5 md:px-16 max-w-[1280px] mx-auto">
    <div class="text-center mb-16">
        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">Kenapa DHS?</span>
        <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">Mengapa Bergabung dengan Kami</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="p-8 bg-white shadow-sm border border-transparent hover:border-black/10 transition-colors">
            <span class="material-icons text-primary text-3xl mb-4 block">school</span>
            <h3 class="text-[20px] font-semibold font-serif text-text-light mb-3">Lingkungan Akademik Berkualitas</h3>
            <p class="text-base text-muted-light leading-relaxed">Bekerja bersama pengajar dan praktisi berpengalaman di lingkungan kampus yang mendukung pertumbuhan profesional.</p>
        </div>
        <div class="p-8 bg-white shadow-sm border border-transparent hover:border-black/10 transition-colors">
            <span class="material-icons text-primary text-3xl mb-4 block">diversity_3</span>
            <h3 class="text-[20px] font-semibold font-serif text-text-light mb-3">Komunitas yang Inklusif</h3>
            <p class="text-base text-muted-light leading-relaxed">Budaya kerja yang kolaboratif, menghargai keberagaman, dan mendorong inovasi dalam pendidikan hospitality.</p>
        </div>
        <div class="p-8 bg-white shadow-sm border border-transparent hover:border-black/10 transition-colors">
            <span class="material-icons text-primary text-3xl mb-4 block">trending_up</span>
            <h3 class="text-[20px] font-semibold font-serif text-text-light mb-3">Pengembangan Karir</h3>
            <p class="text-base text-muted-light leading-relaxed">Program pelatihan staf berkelanjutan, akses ke jaringan industri global, dan kesempatan pengembangan kompetensi.</p>
        </div>
    </div>
</section>
@endsection
