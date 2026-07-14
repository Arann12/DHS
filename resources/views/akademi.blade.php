@extends('layouts.app')

@section('title', 'Program Akademi — Denpasar Hotel School')

@section('content')
<!-- Hero Section -->
<header class="relative pt-32 pb-16 md:pt-48 md:pb-24 px-5 md:px-16 max-w-[1280px] mx-auto">
    <div class="mb-8">
        <p class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-muted-light mb-4 flex items-center space-x-2">
            <a class="hover:text-primary transition-colors" href="/">Beranda</a>
            <span class="material-icons text-sm">chevron_right</span>
            <span class="text-primary">Akademi</span>
        </p>
        <p class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4">Program Akademik & Pelatihan</p>
        <h1 class="text-[40px] md:text-[64px] leading-[1.1] font-bold font-serif text-text-light max-w-3xl">Program Vokasi &amp; Kursus</h1>
    </div>
    <div class="relative w-full h-[350px] md:h-[500px] overflow-hidden mt-8">
        <img class="w-full h-full object-cover" alt="Students in training kitchen" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxn2eqm_jRIxoqtBqU_Z4510mT8Oum1XJuCt3B4qsnaur1kOxl1kswsTUDy_IWkop-w6gCJC9c4z-J1rwUSX4qHaSazUfu4x09voqcT3DY8fhiWkEHZcuUOZBNOolJHzCrNRQQXlB6UNrMOsC2_nhrMbSl_DzCpEu5YNeYXrmzbkHsYKIWxKH0th79FkaqCRHftpuCaHJyYzxate_qQzEmQcWi4iGgWxF-wIUFQGCYA83w8lUepgu6VQ">
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
    </div>
</header>

<!-- Main Content with 2-Level Filter -->
<main class="pb-24">
    <!-- Category Duration Filter -->
    <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-12">
        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">PILIH KATEGORI DURASI</span>
        <div class="flex flex-wrap gap-3 border-b border-black/10 pb-6">
            <button class="filter-tab-btn px-5 py-2.5 bg-dhs-navy text-white text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:bg-dhs-darknavy transition-all animate-none" data-target="internasional">Program Internasional</button>
            <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="2-tahun">Vokasi 2 Tahun</button>
            <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="1-tahun">Vokasi 1 Tahun</button>
            <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="1-tahun-kapal-pesiar">1 Tahun Kapal Pesiar</button>
            <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="6-bulan">Short Course 6 Bulan</button>
            <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="eksekutif">Program Eksekutif (6 Bln)</button>
        </div>
    </section>

    <!-- Content Sections per Category -->
    <section class="max-w-[1280px] mx-auto px-5 md:px-16">
        
        <!-- Category: Program Internasional (Active by default) -->
        <div class="category-content-panel active" id="panel-internasional">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start mb-16">
                <div class="md:col-span-1">
                    <h2 class="text-3xl font-serif text-text-light mb-4">Program Internasional</h2>
                    <p class="text-sm text-muted-light leading-relaxed mb-6">
                        DHS bekerjasama dengan The Hotel School Melbourne & Sydney dan TAFE Australia untuk menyalurkan peserta didik DHS yang berminat lanjut untuk melaksanakan pendidikan di luar negeri. Program ini dapat menghasilkan peserta didik yang berkompetensi secara global dan mampu bersaing dalam bursa kerja dan siap dalam masyarakat ekonomi ASEAN (MEA).
                    </p>
                    <p class="text-xs font-semibold text-primary uppercase tracking-wider mb-2">Peluang Kerja Lulusan:</p>
                    <p class="text-xs text-muted-light">Hotel Staff, Restaurant Staff, Instruktur LKP/LPK, Wirausaha.</p>
                </div>
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach([
                        ['title' => 'Program 1 Tahun + Ausbildung Jerman', 'desc' => 'Pelatihan intensif 1 tahun di kampus dilanjutkan program penempatan Ausbildung kerja di Jerman.'],
                        ['title' => 'Program 2 Tahun + 1 Semester TAFE Australia', 'desc' => 'Studi komprehensif di Bali dengan transfer kredit 1 semester di TAFE Australia.'],
                        ['title' => 'TAFE Australia Pathway', 'desc' => 'Program penyaluran langsung menuju perkuliahan TAFE di Australia.'],
                        ['title' => 'THS Australia Pathway', 'desc' => 'Jalur studi khusus berpartner dengan The Hotel School Sydney & Melbourne.'],
                        ['title' => 'Australia Short Course', 'desc' => 'Pelatihan praktis jangka pendek terfokus langsung di Australia.'],
                        ['title' => 'Study Visit (Australia & Singapura)', 'desc' => 'Kunjungan edukasi dan familiarisasi hotel mewah langsung ke Australia atau Singapura.']
                    ] as $course)
                    <div class="p-6 bg-white border border-black/5 shadow-sm">
                        <h4 class="font-bold font-serif text-lg text-primary mb-2">{{ $course['title'] }}</h4>
                        <p class="text-xs text-muted-light leading-relaxed">{{ $course['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Category: Pendidikan Vokasi 2 Tahun -->
        <div class="category-content-panel hidden" id="panel-2-tahun">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start mb-16">
                <div class="md:col-span-1">
                    <h2 class="text-3xl font-serif text-text-light mb-4">Vokasi 2 Tahun</h2>
                    <p class="text-sm text-muted-light leading-relaxed mb-6">
                        Memiliki jurusan FB Service Bartender, Perhotelan dan Culinary Arts. Melalui program kerjasama DHS dengan industri, kami menjamin peserta didik mendapatkan penempatan pada saat On The Job Training semester mereka. DHS juga menjamin kualitas program melalui instruktur/dosen yang berpengalaman baik dari teori serta berpengalaman bekerja di kapal pesiar, Hotel Bintang 4 & 5, dengan latar belakang pendidikan dari universitas ternama di Bali, Canada & Jerman.
                    </p>
                </div>
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach([
                        ['title' => 'Perhotelan (FO & HK)', 'desc' => 'Fokus pada operasional Front Office dan Housekeeping berstandar hotel bintang 5.'],
                        ['title' => 'Tata Boga (Culinary Art)', 'desc' => 'Mengembangkan keahlian memasak masakan internasional dan lokal dengan standar kebersihan tinggi.'],
                        ['title' => 'Tata Hidangan (FBS & Bartender)', 'desc' => 'Seni pelayanan makanan, minuman, mixology, dan hospitality service terapan.']
                    ] as $course)
                    <div class="p-6 bg-white border border-black/5 shadow-sm">
                        <span class="material-icons text-primary text-2xl mb-4">school</span>
                        <h4 class="font-bold font-serif text-lg text-text-light mb-2">{{ $course['title'] }}</h4>
                        <p class="text-xs text-muted-light leading-relaxed">{{ $course['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Category: Pendidikan Vokasi 1 Tahun -->
        <div class="category-content-panel hidden" id="panel-1-tahun">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start mb-16">
                <div class="md:col-span-1">
                    <h2 class="text-3xl font-serif text-text-light mb-4">Vokasi 1 Tahun</h2>
                    <p class="text-sm text-muted-light leading-relaxed mb-6">
                        Memiliki jurusan Cruise Line FB Service & Culinary Arts, FB Service & Culinary Arts, serta Perhotelan. Dirancang untuk persiapan kilat memasuki industri perhotelan bintang 4 & 5 serta kapal pesiar, dengan bimbingan dosen berpengalaman internasional.
                    </p>
                </div>
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach([
                        ['title' => 'Perhotelan (FO & HK)', 'desc' => 'Teori terfokus dan penempatan praktis di Front Office & Housekeeping.'],
                        ['title' => 'Tata Boga (Culinary Art)', 'desc' => 'Fondasi dasar teknik kuliner, penanganan bahan makanan, dan sanitasi.'],
                        ['title' => 'Tata Hidangan (FBS & Bartender)', 'desc' => 'Dasar pelayanan restoran, pengetahuan menu, dan keterampilan bar.']
                    ] as $course)
                    <div class="p-6 bg-white border border-black/5 shadow-sm">
                        <span class="material-icons text-primary text-2xl mb-4">star_border</span>
                        <h4 class="font-bold font-serif text-lg text-text-light mb-2">{{ $course['title'] }}</h4>
                        <p class="text-xs text-muted-light leading-relaxed">{{ $course['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Category: Program 1 Tahun Kapal Pesiar -->
        <div class="category-content-panel hidden" id="panel-1-tahun-kapal-pesiar">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start mb-16">
                <div class="md:col-span-1">
                    <h2 class="text-3xl font-serif text-text-light mb-4">1 Tahun Kapal Pesiar</h2>
                    <p class="text-sm text-muted-light leading-relaxed mb-6">
                        Program akselerasi 1 tahun yang difokuskan untuk persiapan bekerja secara profesional di departemen food & beverage dan housekeeping di kapal pesiar internasional dengan penempatan bebas agen fee.
                    </p>
                </div>
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach([
                        ['title' => 'Cook (Asisten Koki)', 'desc' => 'Praktek dapur intensif untuk menyiapkan menu cruise line internasional.'],
                        ['title' => 'Waiter & Bartender', 'desc' => 'Layanan restoran mewah & pencampuran minuman tingkat lanjut untuk bar kapal pesiar.'],
                        ['title' => 'Hotel Steward', 'desc' => 'Manajemen kebersihan, tata graha, dan penataan kamar di kabin kapal pesiar mewah.']
                    ] as $course)
                    <div class="p-6 bg-white border border-black/5 shadow-sm">
                        <span class="material-icons text-primary text-2xl mb-4">directions_boat</span>
                        <h4 class="font-bold font-serif text-lg text-text-light mb-2">{{ $course['title'] }}</h4>
                        <p class="text-xs text-muted-light leading-relaxed">{{ $course['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Category: Short Course 6 Bulan -->
        <div class="category-content-panel hidden" id="panel-6-bulan">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start mb-16">
                <div class="md:col-span-1">
                    <h2 class="text-3xl font-serif text-text-light mb-4">Short Course 6 Bulan</h2>
                    <p class="text-sm text-muted-light leading-relaxed mb-6">
                        Program singkat ini diperuntukan untuk peserta didik yang berniat menambah ilmu di bidang-bidang spesifik dengan mengutamakan praktek langsung daripada teori di laboratorium standar industri perhotelan kami.
                    </p>
                </div>
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach([
                        ['title' => 'Perhotelan (FO & HK)', 'desc' => 'Pelatihan kilat siap kerja Front Office & Housekeeping.'],
                        ['title' => 'Tata Boga (Culinary Art)', 'desc' => 'Praktek kuliner dasar terfokus untuk keterampilan masak praktis.'],
                        ['title' => 'Tata Hidangan (FBS & Bartender)', 'desc' => 'Latihan barista, bartending dasar, dan pelayanan hidangan restoran.']
                    ] as $course)
                    <div class="p-6 bg-white border border-black/5 shadow-sm">
                        <span class="material-icons text-primary text-2xl mb-4">schedule</span>
                        <h4 class="font-bold font-serif text-lg text-text-light mb-2">{{ $course['title'] }}</h4>
                        <p class="text-xs text-muted-light leading-relaxed">{{ $course['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Category: Program Eksekutif -->
        <div class="category-content-panel hidden" id="panel-eksekutif">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start mb-16">
                <div class="md:col-span-1">
                    <h2 class="text-3xl font-serif text-text-light mb-4">Program Eksekutif</h2>
                    <p class="text-sm text-muted-light leading-relaxed mb-6">
                        Program khusus 6 bulan kapal pesiar dengan berbagai fasilitas bonus menarik. Cocok untuk akselerasi karir maritim instan tanpa agent fee penempatan.
                    </p>
                </div>
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach([
                        ['title' => 'FBS & Bar (Cruise Line)', 'desc' => 'Bonus: Free Bottle Shaker Flair untuk praktek atraksi bar.'],
                        ['title' => 'Hotel Steward (Cruise Line)', 'desc' => 'Fokus manajemen housekeeping intensif di atas kapal pesiar.'],
                        ['title' => 'Cook (Cruise Line)', 'desc' => 'Bonus: Free Passport & Seaman Book (Buku Pelaut) resmi.'],
                        ['title' => 'Flair Bartending & Sommelier', 'desc' => 'Pendidikan bartender atraksi & spesialis wawasan minuman anggur.'],
                        ['title' => 'Buttler', 'desc' => 'Pelayanan eksklusif personal. Bonus: Free Driving Licence (SIM).'],
                        ['title' => 'SPA Therapist', 'desc' => 'Seni pijat relaksasi dan terapi spa berkualitas hotel bintang lima.']
                    ] as $course)
                    <div class="p-6 bg-white border border-black/5 shadow-sm">
                        <span class="material-icons text-primary text-2xl mb-4">workspace_premium</span>
                        <h4 class="font-bold font-serif text-lg text-text-light mb-2">{{ $course['title'] }}</h4>
                        <p class="text-xs text-muted-light leading-relaxed">{{ $course['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>

    <!-- Beasiswa Section -->
    <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-20">
        <div class="bg-dhs-navy p-8 md:p-12 text-white flex flex-col md:flex-row justify-between items-center gap-8">
            <div>
                <span class="bg-primary text-white text-[0.65rem] uppercase tracking-widest font-bold px-3 py-1 mb-4 inline-block">BEASISWA DHS</span>
                <h3 class="text-3xl font-serif mb-2 text-white">Jalur Beasiswa: Prestasi, STT, & Khusus</h3>
                <p class="text-sm text-white/80 max-w-2xl">Denpasar Hotel School menyediakan keringanan biaya pendidikan melalui berbagai skema beasiswa bagi calon profesional berprestasi.</p>
            </div>
            <a class="px-8 py-4 bg-primary text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:opacity-90 transition-opacity whitespace-nowrap" href="http://www.dhs.or.id/student" target="_blank">Ajukan Beasiswa</a>
        </div>
    </section>

    <!-- Document Assistance Section -->
    <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-24">
        <h3 class="text-[32px] leading-[1.3] font-semibold font-serif mb-10 text-center text-text-light">Layanan Pengurusan Dokumen</h3>
        <p class="text-sm text-muted-light text-center max-w-2xl mx-auto mb-12">DHS menyediakan bantuan penuh bagi para siswa dan calon pencari kerja kapal pesiar untuk mengurus dokumen sertifikasi wajib:</p>
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-6 justify-center text-center">
            @foreach([
                ['title' => 'Passport', 'icon' => 'card_travel'],
                ['title' => 'BST', 'icon' => 'anchor'],
                ['title' => 'SDSD', 'icon' => 'security'],
                ['title' => 'CCM', 'icon' => 'groups'],
                ['title' => 'SSAT', 'icon' => 'verified_user'],
                ['title' => 'PSCRB', 'icon' => 'sailing'],
                ['title' => 'C1D VISA', 'icon' => 'badge']
            ] as $doc)
            <div class="bg-dhs-cream p-6 border border-black/5 hover:bg-white transition-colors duration-300">
                <span class="material-icons text-primary text-3xl mb-3 block">{{$doc['icon']}}</span>
                <h5 class="font-bold text-sm text-text-light">{{ $doc['title'] }}</h5>
            </div>
            @endforeach
        </div>
    </section>

    <!-- CTA Section -->
    <section class="max-w-3xl mx-auto px-5 text-center mb-24">
        <h2 class="text-[48px] leading-[1.2] font-semibold font-serif mb-6 text-text-light">Mulai Karir Sukses Anda</h2>
        <p class="text-base text-muted-light mb-10">Denpasar Hotel School siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global. Gabung sekarang juga secara online.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a class="px-8 py-4 bg-dhs-navy text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-darknavy transition-colors" href="http://www.dhs.or.id/student" target="_blank">Pendaftaran Online</a>
            <a class="px-8 py-4 bg-transparent border border-dhs-navy text-dhs-navy text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-cream transition-colors" href="https://linktr.ee/BiayaPendidikan_DHS" target="_blank">Unduh Brosur Biaya</a>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-tab-btn');
        const panels = document.querySelectorAll('.category-content-panel');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Reset button styles
                filterBtns.forEach(b => {
                    b.classList.remove('bg-dhs-navy', 'text-white');
                    b.classList.add('bg-transparent', 'border', 'border-black/20', 'text-text-light');
                });
                // Activate clicked button
                btn.classList.remove('bg-transparent', 'border', 'border-black/20', 'text-text-light');
                btn.classList.add('bg-dhs-navy', 'text-white');

                // Toggle Panels
                const target = btn.dataset.target;
                panels.forEach(p => {
                    if (p.id === 'panel-' + target) {
                        p.classList.remove('hidden');
                        p.classList.add('active');
                    } else {
                        p.classList.add('hidden');
                        p.classList.remove('active');
                    }
                });
            });
        });

        // Handle direct url hash filtering (e.g. /akademi?filter=internasional)
        const urlParams = new URLSearchParams(window.location.search);
        const filterParam = urlParams.get('filter');
        if (filterParam) {
            const matchBtn = document.querySelector(`.filter-tab-btn[data-target="${filterParam}"]`);
            if (matchBtn) matchBtn.click();
        }
    });
</script>
@endsection
