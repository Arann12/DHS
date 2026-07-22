@extends('layouts.app')

@section('title', 'Berita & Artikel — Denpasar Hotel School')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden mb-16">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img alt="Hospitality Background" class="absolute inset-0 w-full h-full object-cover"
            src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600&auto=format&fit=crop">

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div
                class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda"
                        data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><span data-id="Berita" data-en="News">Berita</span></span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-8 leading-[1.1]">
                <span data-id="Berita &amp; Artikel" data-en="News &amp; Articles">Berita &amp; Artikel</span>
            </h1>

            <!-- Search Bar -->
            <div class="w-full max-w-md mx-auto relative">
                <span class="material-icons absolute left-0 top-3 text-white/60">search</span>
                <input
                    class="w-full bg-transparent border-b border-white/40 focus:border-primary py-3 pl-8 pr-4 text-base text-white placeholder:text-white/60 transition-colors outline-none"
                    placeholder="Cari artikel..." data-id="Cari artikel..." data-en="Search articles..." type="text">
            </div>
        </div>
    </section>

    <!-- Category Filters -->
    <section class="max-w-[1280px] mx-auto px-5 md:px-16 pb-12">
        <div class="flex flex-wrap gap-4">
            <button
                class="bg-primary text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold px-6 py-2 hover:opacity-90 transition-opacity filter-btn active"
                data-filter="all"><span data-id="Semua" data-en="All">Semua</span></button>
            <button
                class="bg-transparent border border-black/20 text-text-light text-[0.7rem] uppercase tracking-[0.15em] font-semibold px-6 py-2 hover:border-text-light transition-colors filter-btn"
                data-filter="alumni"><span data-id="Prestasi Alumni" data-en="Alumni Achievements">Prestasi
                    Alumni</span></button>
            <button
                class="bg-transparent border border-black/20 text-text-light text-[0.7rem] uppercase tracking-[0.15em] font-semibold px-6 py-2 hover:border-text-light transition-colors filter-btn"
                data-filter="partnership"><span data-id="Partnership" data-en="Partnership">Partnership</span></button>
            <button
                class="bg-transparent border border-black/20 text-text-light text-[0.7rem] uppercase tracking-[0.15em] font-semibold px-6 py-2 hover:border-text-light transition-colors filter-btn"
                data-filter="kampus"><span data-id="Kampus" data-en="Campus">Kampus</span></button>
        </div>
    </section>

    <!-- Featured Article -->
    <section class="max-w-[1280px] mx-auto px-5 md:px-16 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center bg-white overflow-hidden shadow-sm"
            data-reveal="zoom-up">
            <div class="md:col-span-7 h-64 md:h-[500px]">
                <img class="w-full h-full object-cover" alt="DHS Partnership with Luxury Cruise Lines"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDC3Zbmur_Z6Cm6ZdufBko9V8AUa5eo_OvVNaa1S7u2lDFCcd_bV1J1xi07jU0dsOzz1pdsjSUje3x5Ihq28gVdZISdaDrU17iO9l8tNWwQTRTBR4oJUZ6UcLaCywLs5Gd6DyIQBvc3hpcqLx9NZ1NQbAj4Wp0hz-Ogib_DihRqkj4y1WTx-rtncJ6e_K2lYS7dwPHupErzN25TvXZySa4jRQIKNCeVlFkQ33V__7sZtOPQY-1ZViqdKg">
            </div>
            <div class="md:col-span-5 p-8 md:p-12 flex flex-col gap-6">
                <div class="flex items-center gap-4">
                    <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary"><span
                            data-id="Partnership" data-en="Partnership">Partnership</span></span>
                    <span class="w-1 h-1 bg-black/20 rounded-full"></span>
                    <span class="text-sm text-muted-light">12 Sep 2024</span>
                </div>
                <h2 class="text-[32px] md:text-[40px] leading-[1.2] font-semibold font-serif text-text-light">
                    <span data-id="DHS Partnerships with Luxury Cruise Lines 2024"
                        data-en="DHS Partnerships with Luxury Cruise Lines 2024">DHS Partnerships with Luxury Cruise Lines
                        2024</span>
                </h2>
                <p class="text-base text-muted-light leading-relaxed">
                    <span
                        data-id="Denpasar Hotel School mengumumkan kemitraan eksklusif dengan tiga maskapai pelayaran global. Kolaborasi ini akan memberikan akses luar biasa kepada siswa terbaik kami untuk magang di atas kapal mewah, meningkatkan standar pelatihan marine hospitality..."
                        data-en="Denpasar Hotel School announces an exclusive partnership with three global cruise lines. This collaboration will provide outstanding access for our best students to intern on luxury ships, upgrading marine hospitality training standards...">Denpasar
                        Hotel School mengumumkan kemitraan eksklusif dengan tiga maskapai pelayaran global. Kolaborasi ini
                        akan memberikan akses luar biasa kepada siswa terbaik kami untuk magang di atas kapal mewah,
                        meningkatkan standar pelatihan marine hospitality...</span>
                </p>
                <a class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light border-b border-text-light pb-1 w-max hover:text-primary hover:border-primary transition-colors flex items-center gap-2 mt-4"
                    href="#">
                    <span data-id="Baca Selengkapnya" data-en="Read More">Baca Selengkapnya</span>
                    <span class="material-icons text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Article Grid -->
    <section class="max-w-[1280px] mx-auto px-5 md:px-16 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <article class="bg-white overflow-hidden shadow-sm flex flex-col group cursor-pointer">
                <div class="aspect-[4/3] overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        alt="Culinary Masterclass with Michelin Chefs"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2sH5SMdu6UCQ3YvGlHm8ILbpsorjRDnXWB0-cDMJdnzP6sFivwY2_HZCoAb3ZpBFfq6PG99Gfy3nAMFJBBBlL4bQFWJYj1WFRdHAYJMgs1y0mfkU5o8u1ORzW8UndwUEwimNT1Hx6HE6uRbqXs70Q9HBB-ZgPPTcY_am0aXRo_wII0uiEdUjpSrwgtDHMA2y6dS2dOXFcDaOsGEnlOuwMTFknFG8SUzaaZeJ-afh4hHMvmET5yaF3Ig">
                </div>
                <div class="p-6 flex flex-col gap-4 flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary"><span
                                data-id="Workshop" data-en="Workshop">Workshop</span></span>
                        <span class="text-sm text-muted-light">05 Sep 2024</span>
                    </div>
                    <h3
                        class="text-[24px] leading-[1.3] font-semibold font-serif text-text-light group-hover:text-primary transition-colors line-clamp-2">
                        <span data-id="Culinary Masterclass dengan Michelin Chef"
                            data-en="Culinary Masterclass with Michelin Chefs">Culinary Masterclass dengan Michelin
                            Chef</span>
                    </h3>
                    <p class="text-base text-muted-light line-clamp-3">
                        <span
                            data-id="Menjelajahi teknik gastronomi modern yang dipandu oleh pakar kuliner bertaraf internasional."
                            data-en="Exploring modern gastronomy techniques guided by international-level culinary experts.">Menjelajahi
                            teknik gastronomi modern yang dipandu oleh pakar kuliner bertaraf internasional.</span>
                    </p>
                </div>
            </article>
            <!-- Card 2 -->
            <article class="bg-white overflow-hidden shadow-sm flex flex-col group cursor-pointer">
                <div class="aspect-[4/3] overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        alt="Graduates Leading Boutique Resorts"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBkVuUf3rMDtKrjFDBWzOYJd39961DbCmbbmbCCy2jPOCu8529Heb-hrO-a0h_wBNu_0iF-NQTCAjVDVCrurSJzSgXIdWgtH1ODE3qH1F71ZF4gSB0H4hTWzCaQec56icpTL42dx73rFyQfjay9MChhMUdDxr8CDXweORy1rv2TKGuCEyvB7fT8JGdrFNigr1eYKQzwNFkFR1IW4aoNzpXRAgh-49BA0IjV7t7AFVSCCBS1PpDtkwAALw">
                </div>
                <div class="p-6 flex flex-col gap-4 flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary"><span
                                data-id="Karir" data-en="Careers">Karir</span></span>
                        <span class="text-sm text-muted-light">28 Agu 2024</span>
                    </div>
                    <h3
                        class="text-[24px] leading-[1.3] font-semibold font-serif text-text-light group-hover:text-primary transition-colors line-clamp-2">
                        <span data-id="Alumni Memimpin Boutique Resort di Asia"
                            data-en="Graduates Leading Boutique Resorts in Asia">Alumni Memimpin Boutique Resort di
                            Asia</span>
                    </h3>
                    <p class="text-base text-muted-light line-clamp-3">
                        <span
                            data-id="Kisah sukses alumni DHS yang membentuk masa depan akomodasi butik eksklusif di seluruh kawasan Asia."
                            data-en="Success stories of DHS graduates shaping the future of exclusive boutique accommodations across Asia.">Kisah
                            sukses alumni DHS yang membentuk masa depan akomodasi butik eksklusif di seluruh kawasan
                            Asia.</span>
                    </p>
                </div>
            </article>
            <!-- Card 3 -->
            <article class="bg-white overflow-hidden shadow-sm flex flex-col group cursor-pointer">
                <div class="aspect-[4/3] overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        alt="Sustainable Hospitality Campus"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvULZTmcRw3vX-f-CzNGg8stMRI2Ea5NrSmiyucdED1Ui6mqgK2AmexIratVtInAzxZCCHoL-zzOc0IKiakMVptfS6D7Totb7TxRP3hnBTI6jiqWvMeiM_1-hkImIpVicdfMM6OIO2stFSZu3ragqM52MjEfHpklP14W0JSFCG3J7oNfgCwfP2lub1AqE-vF_htAw-tUtFYRPRud-E7yvapjggWrzGecs_O5JgHck2s4ToD8oRnYCnxg">
                </div>
                <div class="p-6 flex flex-col gap-4 flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary"><span
                                data-id="Keberlanjutan" data-en="Sustainability">Keberlanjutan</span></span>
                        <span class="text-sm text-muted-light">15 Agu 2024</span>
                    </div>
                    <h3
                        class="text-[24px] leading-[1.3] font-semibold font-serif text-text-light group-hover:text-primary transition-colors line-clamp-2">
                        <span data-id="Inisiatif Kampus Hospitality Berkelanjutan"
                            data-en="Sustainable Hospitality Campus Initiatives">Inisiatif Kampus Hospitality
                            Berkelanjutan</span>
                    </h3>
                    <p class="text-base text-muted-light line-clamp-3">
                        <span
                            data-id="Menerapkan praktik ramah lingkungan inovatif di fasilitas pelatihan kami untuk mempersiapkan siswa menghadapi green hospitality."
                            data-en="Implementing innovative eco-friendly practices in our training facilities to prepare students for green hospitality.">Menerapkan
                            praktik ramah lingkungan inovatif di fasilitas pelatihan kami untuk mempersiapkan siswa
                            menghadapi green hospitality.</span>
                    </p>
                </div>
            </article>
            <!-- Card 4 -->
            <article class="bg-white overflow-hidden shadow-sm flex flex-col group cursor-pointer">
                <div class="aspect-[4/3] overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        alt="DHS Student Wins Gold in Mixology"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjxiUQl4dFSx7fE7pPrEiTpTmdkv3ZZAvcKSuzipT64Cz7tNEoX4C-CBWzgyLmN3COIHeJPxkdmFc5-idxG1H7whgV689VQWS1KGAwYBca26oqw3Fn4kCl6-j8Nuy2wbTzSiUaufT7SjiF8KrlCqdCyyxiFpn79YM793rwcdZX4UiHMiDMyqbQ8yZBK4i7tiShh9R2XUsrUKT_-kNvdBFXnJosF5-5rcBS4xoRUlzqMHN1uXYrpMR0dA">
                </div>
                <div class="p-6 flex flex-col gap-4 flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary"><span
                                data-id="Prestasi Alumni" data-en="Alumni Achievements">Prestasi Alumni</span></span>
                        <span class="text-sm text-muted-light">02 Agu 2024</span>
                    </div>
                    <h3
                        class="text-[24px] leading-[1.3] font-semibold font-serif text-text-light group-hover:text-primary transition-colors line-clamp-2">
                        <span data-id="Mahasiswa DHS Meraih Emas dalam Mixology"
                            data-en="DHS Student Wins Gold in Mixology">Mahasiswa DHS Meraih Emas dalam Mixology</span>
                    </h3>
                    <p class="text-base text-muted-light line-clamp-3">
                        <span
                            data-id="Siswa F&amp;B Service tingkat akhir kami meraih posisi teratas di Asian Mixology Championships yang digelar di Singapura."
                            data-en="Our final-year F&amp;B Service student secured the top position at the Asian Mixology Championships held in Singapore.">Siswa
                            F&amp;B Service tingkat akhir kami meraih posisi teratas di Asian Mixology Championships yang
                            digelar di Singapura.</span>
                    </p>
                </div>
            </article>
            <!-- Card 5 -->
            <article class="bg-white overflow-hidden shadow-sm flex flex-col group cursor-pointer">
                <div class="aspect-[4/3] overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        alt="DHS Open House 2024"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAyc_DpsG87AfWrshUPlxIuKJvZHkN6oU7L4YS1jdArSgxdWcKYnc24iT2j0Bm89HwJwgt4EzxhqA1uVwgXNn4OGrPnTDiByZsNp12wbAlT64ckn8FEDJ1gJzcgrTypE0q2Uukg1SCEVPaAYxQ6BjsjWyKqCscfL49HiymbPwORh5-WpELYPux0KqJtUDVkt88aAZOCHiZTC9dq_RYls5MXYqUV4qY5ol-_PTi-9-CK1woAVpvlOL9Alw">
                </div>
                <div class="p-6 flex flex-col gap-4 flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary"><span
                                data-id="Kampus" data-en="Campus">Kampus</span></span>
                        <span class="text-sm text-muted-light">20 Jul 2024</span>
                    </div>
                    <h3
                        class="text-[24px] leading-[1.3] font-semibold font-serif text-text-light group-hover:text-primary transition-colors line-clamp-2">
                        <span data-id="DHS Open House 2024: Tour Fasilitas Eksklusif"
                            data-en="DHS Open House 2024: Exclusive Facility Tour">DHS Open House 2024: Tour Fasilitas
                            Eksklusif</span>
                    </h3>
                    <p class="text-base text-muted-light line-clamp-3">
                        <span
                            data-id="Bergabunglah dengan kami di Open House tahunan dan rasakan langsung fasilitas pelatihan berkelas dunia yang kami miliki."
                            data-en="Join us at our annual Open House and experience firsthand our world-class training facilities.">Bergabunglah
                            dengan kami di Open House tahunan dan rasakan langsung fasilitas pelatihan berkelas dunia yang
                            kami miliki.</span>
                    </p>
                </div>
            </article>
            <!-- Card 6 -->
            <article class="bg-white overflow-hidden shadow-sm flex flex-col group cursor-pointer">
                <div class="aspect-[4/3] overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        alt="MoU with Marriott Hotels"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2sH5SMdu6UCQ3YvGlHm8ILbpsorjRDnXWB0-cDMJdnzP6sFivwY2_HZCoAb3ZpBFfq6PG99Gfy3nAMFJBBBlL4bQFWJYj1WFRdHAYJMgs1y0mfkU5o8u1ORzW8UndwUEwimNT1Hx6HE6uRbqXs70Q9HBB-ZgPPTcY_am0aXRo_wII0uiEdUjpSrwgtDHMA2y6dS2dOXFcDaOsGEnlOuwMTFknFG8SUzaaZeJ-afh4hHMvmET5yaF3Ig">
                </div>
                <div class="p-6 flex flex-col gap-4 flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary"><span
                                data-id="Partnership" data-en="Partnership">Partnership</span></span>
                        <span class="text-sm text-muted-light">10 Jul 2024</span>
                    </div>
                    <h3
                        class="text-[24px] leading-[1.3] font-semibold font-serif text-text-light group-hover:text-primary transition-colors line-clamp-2">
                        <span data-id="MoU DHS &amp; Marriott: Jalur Rekrutmen Langsung"
                            data-en="MoU DHS &amp; Marriott: Direct Recruitment Pathway">MoU DHS &amp; Marriott: Jalur
                            Rekrutmen Langsung</span>
                    </h3>
                    <p class="text-base text-muted-light line-clamp-3">
                        <span
                            data-id="Perjanjian kerjasama terbaru dengan Marriott Hotels membuka jalur rekrutmen langsung bagi lulusan terbaik DHS ke properti Marriott di seluruh Asia Pasifik."
                            data-en="The latest cooperation agreement with Marriott Hotels opens direct recruitment pathways for top DHS graduates to Marriott properties across Asia Pacific.">Perjanjian
                            kerjasama terbaru dengan Marriott Hotels membuka jalur rekrutmen langsung bagi lulusan terbaik
                            DHS ke properti Marriott di seluruh Asia Pasifik.</span>
                    </p>
                </div>
            </article>
        </div>
    </section>
@endsection