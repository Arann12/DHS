@extends('layouts.app')

@section('title', 'Berita & Artikel — Denpasar Hotel School')

@section('content')
<!-- Hero Section -->
<section class="max-w-[1280px] mx-auto px-5 md:px-16 pt-12 md:pt-32 pb-12">
    <div class="flex flex-col gap-6 items-start">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-muted-light">
            <a class="hover:text-primary transition-colors" href="/">Beranda</a>
            <span class="material-icons text-sm">chevron_right</span>
            <span class="text-text-light font-semibold">Berita</span>
        </div>
        <div class="flex flex-col gap-2">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary">Publikasi</span>
            <h1 class="text-[40px] md:text-[64px] leading-[1.1] font-bold font-serif text-text-light">Berita &amp; Artikel</h1>
        </div>
        <!-- Search Bar -->
        <div class="w-full md:w-1/2 mt-4 relative">
            <span class="material-icons absolute left-0 top-3 text-muted-light">search</span>
            <input class="w-full bg-transparent border-b border-text-light focus:border-primary py-3 pl-8 pr-4 text-base placeholder:text-muted-light transition-colors outline-none" placeholder="Cari artikel..." type="text">
        </div>
    </div>
</section>

<!-- Category Filters -->
<section class="max-w-[1280px] mx-auto px-5 md:px-16 pb-12">
    <div class="flex flex-wrap gap-4">
        <button class="bg-primary text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold px-6 py-2 hover:opacity-90 transition-opacity filter-btn active" data-filter="all">Semua</button>
        <button class="bg-transparent border border-black/20 text-text-light text-[0.7rem] uppercase tracking-[0.15em] font-semibold px-6 py-2 hover:border-text-light transition-colors filter-btn" data-filter="alumni">Prestasi Alumni</button>
        <button class="bg-transparent border border-black/20 text-text-light text-[0.7rem] uppercase tracking-[0.15em] font-semibold px-6 py-2 hover:border-text-light transition-colors filter-btn" data-filter="partnership">Partnership</button>
        <button class="bg-transparent border border-black/20 text-text-light text-[0.7rem] uppercase tracking-[0.15em] font-semibold px-6 py-2 hover:border-text-light transition-colors filter-btn" data-filter="kampus">Kampus</button>
    </div>
</section>

<!-- TODO: Data artikel di bawah ini masih merupakan data dummy. Menunggu artikel resmi dari tim Denpasar Hotel School (DHS). -->
<section class="max-w-[1280px] mx-auto px-5 md:px-16 pb-4">
    <div class="bg-dhs-cream p-4 border border-black/5 text-xs text-muted-light font-mono">
        [TODO] Artikel di bawah ini menggunakan data dummy sementara menunggu update artikel asli.
    </div>
</section>

<!-- Featured Article -->
<section class="max-w-[1280px] mx-auto px-5 md:px-16 pb-20">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center bg-white overflow-hidden shadow-sm">
        <div class="md:col-span-7 h-64 md:h-[500px]">
            <img class="w-full h-full object-cover" alt="DHS Partnership with Luxury Cruise Lines" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDC3Zbmur_Z6Cm6ZdufBko9V8AUa5eo_OvVNaa1S7u2lDFCcd_bV1J1xi07jU0dsOzz1pdsjSUje3x5Ihq28gVdZISdaDrU17iO9l8tNWwQTRTBR4oJUZ6UcLaCywLs5Gd6DyIQBvc3hpcqLx9NZ1NQbAj4Wp0hz-Ogib_DihRqkj4y1WTx-rtncJ6e_K2lYS7dwPHupErzN25TvXZySa4jRQIKNCeVlFkQ33V__7sZtOPQY-1ZViqdKg">
        </div>
        <div class="md:col-span-5 p-8 md:p-12 flex flex-col gap-6">
            <div class="flex items-center gap-4">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary">Partnership</span>
                <span class="w-1 h-1 bg-black/20 rounded-full"></span>
                <span class="text-sm text-muted-light">12 Sep 2024</span>
            </div>
            <h2 class="text-[32px] md:text-[40px] leading-[1.2] font-semibold font-serif text-text-light">DHS Partnerships with Luxury Cruise Lines 2024</h2>
            <p class="text-base text-muted-light leading-relaxed">Denpasar Hotel School mengumumkan kemitraan eksklusif dengan tiga maskapai pelayaran global. Kolaborasi ini akan memberikan akses luar biasa kepada siswa terbaik kami untuk magang di atas kapal mewah, meningkatkan standar pelatihan marine hospitality...</p>
            <a class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light border-b border-text-light pb-1 w-max hover:text-primary hover:border-primary transition-colors flex items-center gap-2 mt-4" href="#">
                Baca Selengkapnya
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
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Culinary Masterclass with Michelin Chefs" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2sH5SMdu6UCQ3YvGlHm8ILbpsorjRDnXWB0-cDMJdnzP6sFivwY2_HZCoAb3ZpBFfq6PG99Gfy3nAMFJBBBlL4bQFWJYj1WFRdHAYJMgs1y0mfkU5o8u1ORzW8UndwUEwimNT1Hx6HE6uRbqXs70Q9HBB-ZgPPTcY_am0aXRo_wII0uiEdUjpSrwgtDHMA2y6dS2dOXFcDaOsGEnlOuwMTFknFG8SUzaaZeJ-afh4hHMvmET5yaF3Ig">
            </div>
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div class="flex items-center justify-between">
                    <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary">Workshop</span>
                    <span class="text-sm text-muted-light">05 Sep 2024</span>
                </div>
                <h3 class="text-[24px] leading-[1.3] font-semibold font-serif text-text-light group-hover:text-primary transition-colors line-clamp-2">Culinary Masterclass with Michelin Chefs</h3>
                <p class="text-base text-muted-light line-clamp-3">Menjelajahi teknik gastronomi modern yang dipandu oleh pakar kuliner bertaraf internasional.</p>
            </div>
        </article>
        <!-- Card 2 -->
        <article class="bg-white overflow-hidden shadow-sm flex flex-col group cursor-pointer">
            <div class="aspect-[4/3] overflow-hidden">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Graduates Leading Boutique Resorts" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBkVuUf3rMDtKrjFDBWzOYJd39961DbCmbbmbCCy2jPOCu8529Heb-hrO-a0h_wBNu_0iF-NQTCAjVDVCrurSJzSgXIdWgtH1ODE3qH1F71ZF4gSB0H4hTWzCaQec56icpTL42dx73rFyQfjay9MChhMUdDxr8CDXweORy1rv2TKGuCEyvB7fT8JGdrFNigr1eYKQzwNFkFR1IW4aoNzpXRAgh-49BA0IjV7t7AFVSCCBS1PpDtkwAALw">
            </div>
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div class="flex items-center justify-between">
                    <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary">Careers</span>
                    <span class="text-sm text-muted-light">28 Agu 2024</span>
                </div>
                <h3 class="text-[24px] leading-[1.3] font-semibold font-serif text-text-light group-hover:text-primary transition-colors line-clamp-2">Graduates Leading Boutique Resorts in Asia</h3>
                <p class="text-base text-muted-light line-clamp-3">Kisah sukses alumni DHS yang membentuk masa depan akomodasi butik eksklusif di seluruh kawasan Asia.</p>
            </div>
        </article>
        <!-- Card 3 -->
        <article class="bg-white overflow-hidden shadow-sm flex flex-col group cursor-pointer">
            <div class="aspect-[4/3] overflow-hidden">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Sustainable Hospitality Campus" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvULZTmcRw3vX-f-CzNGg8stMRI2Ea5NrSmiyucdED1Ui6mqgK2AmexIratVtInAzxZCCHoL-zzOc0IKiakMVptfS6D7Totb7TxRP3hnBTI6jiqWvMeiM_1-hkImIpVicdfMM6OIO2stFSZu3ragqM52MjEfHpklP14W0JSFCG3J7oNfgCwfP2lub1AqE-vF_htAw-tUtFYRPRud-E7yvapjggWrzGecs_O5JgHck2s4ToD8oRnYCnxg">
            </div>
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div class="flex items-center justify-between">
                    <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary">Sustainability</span>
                    <span class="text-sm text-muted-light">15 Agu 2024</span>
                </div>
                <h3 class="text-[24px] leading-[1.3] font-semibold font-serif text-text-light group-hover:text-primary transition-colors line-clamp-2">Sustainable Hospitality Campus Initiatives</h3>
                <p class="text-base text-muted-light line-clamp-3">Menerapkan praktik ramah lingkungan inovatif di fasilitas pelatihan kami untuk mempersiapkan siswa menghadapi green hospitality.</p>
            </div>
        </article>
        <!-- Card 4 -->
        <article class="bg-white overflow-hidden shadow-sm flex flex-col group cursor-pointer">
            <div class="aspect-[4/3] overflow-hidden">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="DHS Student Wins Gold in Mixology" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjxiUQl4dFSx7fE7pPrEiTpTmdkv3ZZAvcKSuzipT64Cz7tNEoX4C-CBWzgyLmN3COIHeJPxkdmFc5-idxG1H7whgV689VQWS1KGAwYBca26oqw3Fn4kCl6-j8Nuy2wbTzSiUaufT7SjiF8KrlCqdCyyxiFpn79YM793rwcdZX4UiHMiDMyqbQ8yZBK4i7tiShh9R2XUsrUKT_-kNvdBFXnJosF5-5rcBS4xoRUlzqMHN1uXYrpMR0dA">
            </div>
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div class="flex items-center justify-between">
                    <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary">Prestasi Alumni</span>
                    <span class="text-sm text-muted-light">02 Agu 2024</span>
                </div>
                <h3 class="text-[24px] leading-[1.3] font-semibold font-serif text-text-light group-hover:text-primary transition-colors line-clamp-2">DHS Student Wins Gold in Mixology</h3>
                <p class="text-base text-muted-light line-clamp-3">Siswa F&amp;B Service tingkat akhir kami meraih posisi teratas di Asian Mixology Championships yang digelar di Singapura.</p>
            </div>
        </article>
        <!-- Card 5 -->
        <article class="bg-white overflow-hidden shadow-sm flex flex-col group cursor-pointer">
            <div class="aspect-[4/3] overflow-hidden">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="DHS Open House 2024" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAyc_DpsG87AfWrshUPlxIuKJvZHkN6oU7L4YS1jdArSgxdWcKYnc24iT2j0Bm89HwJwgt4EzxhqA1uVwgXNn4OGrPnTDiByZsNp12wbAlT64ckn8FEDJ1gJzcgrTypE0q2Uukg1SCEVPaAYxQ6BjsjWyKqCscfL49HiymbPwORh5-WpELYPux0KqJtUDVkt88aAZOCHiZTC9dq_RYls5MXYqUV4qY5ol-_PTi-9-CK1woAVpvlOL9Alw">
            </div>
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div class="flex items-center justify-between">
                    <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary">Kampus</span>
                    <span class="text-sm text-muted-light">20 Jul 2024</span>
                </div>
                <h3 class="text-[24px] leading-[1.3] font-semibold font-serif text-text-light group-hover:text-primary transition-colors line-clamp-2">DHS Open House 2024: Tour Fasilitas Eksklusif</h3>
                <p class="text-base text-muted-light line-clamp-3">Bergabunglah dengan kami di Open House tahunan dan rasakan langsung fasilitas pelatihan berkelas dunia yang kami miliki.</p>
            </div>
        </article>
        <!-- Card 6 -->
        <article class="bg-white overflow-hidden shadow-sm flex flex-col group cursor-pointer">
            <div class="aspect-[4/3] overflow-hidden">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="MoU with Marriott Hotels" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2sH5SMdu6UCQ3YvGlHm8ILbpsorjRDnXWB0-cDMJdnzP6sFivwY2_HZCoAb3ZpBFfq6PG99Gfy3nAMFJBBBlL4bQFWJYj1WFRdHAYJMgs1y0mfkU5o8u1ORzW8UndwUEwimNT1Hx6HE6uRbqXs70Q9HBB-ZgPPTcY_am0aXRo_wII0uiEdUjpSrwgtDHMA2y6dS2dOXFcDaOsGEnlOuwMTFknFG8SUzaaZeJ-afh4hHMvmET5yaF3Ig">
            </div>
            <div class="p-6 flex flex-col gap-4 flex-1">
                <div class="flex items-center justify-between">
                    <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary">Partnership</span>
                    <span class="text-sm text-muted-light">10 Jul 2024</span>
                </div>
                <h3 class="text-[24px] leading-[1.3] font-semibold font-serif text-text-light group-hover:text-primary transition-colors line-clamp-2">MoU DHS &amp; Marriott: Jalur Rekrutmen Langsung</h3>
                <p class="text-base text-muted-light line-clamp-3">Perjanjian kerjasama terbaru dengan Marriott Hotels membuka jalur rekrutmen langsung bagi lulusan terbaik DHS ke properti Marriott di seluruh Asia Pasifik.</p>
            </div>
        </article>
    </div>
    <div class="flex justify-center mt-12">
        <button class="bg-transparent border border-text-light text-text-light text-[0.7rem] uppercase tracking-[0.15em] font-semibold px-8 py-4 hover:bg-text-light hover:text-white transition-colors">Muat Lebih Banyak</button>
    </div>
</section>

<!-- Newsletter CTA -->
<section class="bg-dhs-beige py-20">
    <div class="max-w-3xl mx-auto px-5 text-center flex flex-col gap-8">
        <div class="flex flex-col gap-4">
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">Jangan lewatkan update terbaru</h2>
            <p class="text-base text-muted-light">Dapatkan wawasan terkini seputar industri perhotelan dan kabar terbaru dari kampus kami langsung di kotak masuk Anda.</p>
        </div>
        <form class="flex flex-col md:flex-row gap-4 justify-center" onsubmit="return false;">
            <input class="w-full md:w-96 bg-transparent border-b border-text-light focus:border-primary py-3 px-4 text-base placeholder:text-muted-light transition-colors outline-none text-center md:text-left" placeholder="Alamat Email Anda" type="email">
            <button class="bg-dhs-navy text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold px-8 py-4 hover:bg-dhs-darknavy transition-colors shrink-0" type="submit">Subscribe</button>
        </form>
    </div>
</section>
@endsection
