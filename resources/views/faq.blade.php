@extends('layouts.app')

@section('title', 'FAQ — Denpasar Hotel School')

@section('content')
<!-- Hero Section -->
<section class="px-5 md:px-16 pt-16 pb-20 md:pt-32 md:pb-24 max-w-[1280px] mx-auto flex flex-col items-center text-center">
    <nav class="mb-8 w-full flex justify-center" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2 text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-muted-light">
            <li><a class="hover:text-primary transition-colors" href="/">Beranda</a></li>
            <li><span class="material-icons text-[14px]">chevron_right</span></li>
            <li class="text-text-light">FAQ</li>
        </ol>
    </nav>
    <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-6">PUSAT BANTUAN</span>
    <h1 class="text-[40px] md:text-[64px] leading-[1.1] tracking-tight font-bold font-serif text-text-light mb-6 max-w-3xl">
        Pertanyaan yang Sering Diajukan
    </h1>
    <p class="text-lg text-muted-light max-w-2xl mb-12 leading-relaxed">
        Kumpulan jawaban seputar akademik, pendaftaran, kehidupan kampus, dan biaya di DHS.
    </p>
    <!-- Search Bar -->
    <div class="relative w-full max-w-2xl group">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <span class="material-icons text-primary text-2xl">search</span>
        </div>
        <input class="w-full pl-12 pr-4 py-4 md:py-5 bg-white border border-black/10 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-base text-text-light placeholder:text-muted-light shadow-sm" placeholder="Cari pertanyaan... (mis. 'biaya', 'asrama', 'magang')" type="text">
    </div>
</section>

<!-- Category Filter -->
<section class="border-y border-black/10 bg-dhs-cream sticky top-[72px] z-40">
    <div class="max-w-[1280px] mx-auto px-5 md:px-16 py-4">
        <div class="flex overflow-x-auto gap-4 md:justify-center">
            <button class="faq-cat-btn whitespace-nowrap px-6 py-2 bg-text-light text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold border border-text-light transition-colors active" data-cat="all">Semua</button>
            <button class="faq-cat-btn whitespace-nowrap px-6 py-2 bg-transparent text-text-light hover:bg-dhs-beige text-[0.7rem] uppercase tracking-[0.15em] font-semibold border border-transparent hover:border-black/20 transition-colors" data-cat="akademi">Akademi &amp; Kurikulum</button>
            <button class="faq-cat-btn whitespace-nowrap px-6 py-2 bg-transparent text-text-light hover:bg-dhs-beige text-[0.7rem] uppercase tracking-[0.15em] font-semibold border border-transparent hover:border-black/20 transition-colors" data-cat="pendaftaran">Pendaftaran &amp; Seleksi</button>
            <button class="faq-cat-btn whitespace-nowrap px-6 py-2 bg-transparent text-text-light hover:bg-dhs-beige text-[0.7rem] uppercase tracking-[0.15em] font-semibold border border-transparent hover:border-black/20 transition-colors" data-cat="biaya">Biaya &amp; Pembayaran</button>
            <button class="faq-cat-btn whitespace-nowrap px-6 py-2 bg-transparent text-text-light hover:bg-dhs-beige text-[0.7rem] uppercase tracking-[0.15em] font-semibold border border-transparent hover:border-black/20 transition-colors" data-cat="kampus">Kehidupan Kampus</button>
        </div>
    </div>
</section>

<!-- FAQ List -->
<section class="px-5 md:px-16 py-16 md:py-20 max-w-[1280px] mx-auto">
    <div class="max-w-3xl mx-auto space-y-16">

        <!-- Akademi & Kurikulum -->
        <div data-section="akademi">
            <h2 class="text-[32px] leading-[1.3] font-semibold font-serif text-text-light mb-8 pb-4 border-b border-black/10">Akademi &amp; Kurikulum</h2>
            <div class="space-y-4">
                <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                    <button class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                        <span class="text-[20px] font-semibold text-text-light pr-4">Berapa lama durasi tiap program studi di DHS?</span>
                        <span class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                    </button>
                    <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                        <p class="text-muted-light text-base leading-relaxed pt-4">Durasi program studi di Denpasar Hotel School bervariasi. Program Diploma 1 berdurasi 1 tahun, Diploma 3 berdurasi 3 tahun, dan Diploma 4 (Sarjana Terapan) berdurasi 4 tahun. Setiap program mencakup masa perkuliahan teori, praktik di laboratorium kampus, dan program magang (On the Job Training) di industri perhotelan.</p>
                    </div>
                </div>
                <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                    <button class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                        <span class="text-[20px] font-semibold text-text-light pr-4">Apakah kurikulum DHS berstandar internasional?</span>
                        <span class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                    </button>
                    <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                        <p class="text-muted-light text-base leading-relaxed pt-4">Ya, kurikulum kami dirancang dengan memadukan standar kompetensi nasional (SKKNI) dan standar internasional industri perhotelan. Kami juga bekerja sama dengan berbagai jaringan hotel global untuk memastikan materi yang diajarkan relevan dengan kebutuhan industri saat ini.</p>
                    </div>
                </div>
                <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                    <button class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                        <span class="text-[20px] font-semibold text-text-light pr-4">Apa saja program studi yang tersedia di DHS?</span>
                        <span class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                    </button>
                    <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                        <p class="text-muted-light text-base leading-relaxed pt-4">DHS menawarkan tiga program utama: Culinary Arts (seni kuliner), Hospitality Management (manajemen perhotelan), dan Food &amp; Beverage Service. Setiap program dirancang dengan rasio praktik tinggi untuk memastikan kesiapan kerja lulusan.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendaftaran & Seleksi -->
        <div data-section="pendaftaran">
            <h2 class="text-[32px] leading-[1.3] font-semibold font-serif text-text-light mb-8 pb-4 border-b border-black/10">Pendaftaran &amp; Seleksi</h2>
            <div class="space-y-4">
                <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                    <button class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                        <span class="text-[20px] font-semibold text-text-light pr-4">Apa saja syarat pendaftaran mahasiswa baru?</span>
                        <span class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                    </button>
                    <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                        <ul class="list-none space-y-2 text-muted-light text-base pt-4">
                            <li class="flex items-start"><span class="text-primary mr-2">•</span> Lulusan SMA/SMK/MA sederajat dari semua jurusan.</li>
                            <li class="flex items-start"><span class="text-primary mr-2">•</span> Mengisi formulir pendaftaran online.</li>
                            <li class="flex items-start"><span class="text-primary mr-2">•</span> Menyerahkan fotokopi ijazah, SKHUN, dan transkrip nilai yang dilegalisir.</li>
                            <li class="flex items-start"><span class="text-primary mr-2">•</span> Pas foto terbaru ukuran 3x4 dan 4x6 (masing-masing 2 lembar).</li>
                            <li class="flex items-start"><span class="text-primary mr-2">•</span> Lulus ujian saringan masuk (Tes Potensi Akademik dan Wawancara).</li>
                        </ul>
                    </div>
                </div>
                <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                    <button class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                        <span class="text-[20px] font-semibold text-text-light pr-4">Apakah ada beasiswa yang tersedia?</span>
                        <span class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                    </button>
                    <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                        <p class="text-muted-light text-base leading-relaxed pt-4">DHS menyediakan beberapa jalur beasiswa, antara lain Beasiswa Prestasi Akademik, Beasiswa Prestasi Non-Akademik (olahraga/seni), dan Beasiswa Kemitraan Industri. Informasi lengkap mengenai persyaratan dan jadwal pengajuan beasiswa dapat dilihat pada halaman Beasiswa atau menghubungi tim admisi kami.</p>
                    </div>
                </div>
                <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                    <button class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                        <span class="text-[20px] font-semibold text-text-light pr-4">Kapan periode pendaftaran dibuka?</span>
                        <span class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                    </button>
                    <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                        <p class="text-muted-light text-base leading-relaxed pt-4">Pendaftaran mahasiswa baru DHS dibuka setiap tahun mulai bulan Maret hingga Juli untuk penerimaan tahun ajaran baru di bulan September. Pendaftaran dilakukan secara online melalui portal resmi DHS.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biaya & Pembayaran -->
        <div data-section="biaya">
            <h2 class="text-[32px] leading-[1.3] font-semibold font-serif text-text-light mb-8 pb-4 border-b border-black/10">Biaya &amp; Pembayaran</h2>
            <div class="space-y-4">
                <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                    <button class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                        <span class="text-[20px] font-semibold text-text-light pr-4">Berapa biaya kuliah di DHS?</span>
                        <span class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                    </button>
                    <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                        <p class="text-muted-light text-base leading-relaxed pt-4">Biaya pendidikan di DHS bervariasi tergantung program yang dipilih. Untuk informasi lengkap mengenai struktur biaya, silakan mengunduh brosur biaya terbaru atau hubungi tim admisi kami. Kami juga menawarkan skema cicilan yang fleksibel.</p>
                    </div>
                </div>
                <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                    <button class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                        <span class="text-[20px] font-semibold text-text-light pr-4">Apakah biaya kuliner/seragam sudah termasuk dalam biaya kuliah?</span>
                        <span class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                    </button>
                    <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                        <p class="text-muted-light text-base leading-relaxed pt-4">Biaya seragam dan peralatan praktik (termasuk perlengkapan dapur untuk program Culinary) dikenakan terpisah pada saat registrasi ulang. Detail biaya ini akan diinformasikan pada saat dinyatakan lulus seleksi.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kehidupan Kampus -->
        <div data-section="kampus">
            <h2 class="text-[32px] leading-[1.3] font-semibold font-serif text-text-light mb-8 pb-4 border-b border-black/10">Kehidupan Kampus &amp; Akomodasi</h2>
            <div class="space-y-4">
                <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                    <button class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                        <span class="text-[20px] font-semibold text-text-light pr-4">Apakah DHS menyediakan fasilitas asrama mahasiswa?</span>
                        <span class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                    </button>
                    <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                        <p class="text-muted-light text-base leading-relaxed pt-4">Ya, kami merekomendasikan beberapa fasilitas akomodasi yang dikelola oleh mitra kami yang berlokasi dekat dengan kampus. Fasilitas ini dirancang nyaman, aman, dan mendukung lingkungan belajar mahasiswa. Hubungi layanan mahasiswa kami untuk bantuan penempatan akomodasi.</p>
                    </div>
                </div>
                <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                    <button class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                        <span class="text-[20px] font-semibold text-text-light pr-4">Kegiatan apa saja yang tersedia di luar jam kuliah?</span>
                        <span class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                    </button>
                    <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                        <p class="text-muted-light text-base leading-relaxed pt-4">DHS memiliki berbagai kegiatan kemahasiswaan seperti komunitas memasak, klub barista, himpunan mahasiswa jurusan, dan kompetisi keterampilan reguler. Kami juga mengadakan kunjungan industri ke hotel dan resort terkemuka secara rutin.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- CTA Section -->
<section class="bg-dhs-beige py-20 md:py-24 px-5 md:px-16">
    <div class="max-w-4xl mx-auto text-center">
        <span class="material-icons text-primary text-5xl mb-6 block">support_agent</span>
        <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6">
            Tidak Menemukan Jawaban yang Kamu Cari?
        </h2>
        <p class="text-lg text-muted-light mb-10 max-w-2xl mx-auto leading-relaxed">
            Tim admisi kami siap membantu Anda secara langsung untuk menjawab segala pertanyaan seputar proses belajar di Denpasar Hotel School.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            {{-- TODO: Route /kontak belum dibuat, gunakan placeholder sementara --}}
            <a class="inline-flex items-center justify-center px-8 py-4 bg-dhs-navy text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-darknavy transition-colors w-full sm:w-auto min-w-[280px]" href="#">
                Hubungi Kami via WhatsApp
            </a>
            <a class="inline-flex items-center justify-center px-8 py-4 bg-transparent border border-dhs-navy text-dhs-navy text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-navy hover:text-white transition-colors w-full sm:w-auto min-w-[280px]" href="#">
                Kirim Pertanyaan via Email
            </a>
        </div>
    </div>
</section>

<script>
    // Accordion logic
    document.addEventListener('DOMContentLoaded', function() {
        const accordions = document.querySelectorAll('.accordion-toggle');
        accordions.forEach(acc => {
            acc.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const icon = this.querySelector('.icon-indicator');
                const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';
                // Close all
                document.querySelectorAll('.accordion-content').forEach(c => c.style.maxHeight = '0px');
                document.querySelectorAll('.icon-indicator').forEach(i => { i.textContent = 'add'; i.classList.remove('rotate-45'); });
                if (!isOpen) {
                    content.style.maxHeight = content.scrollHeight + 'px';
                    icon.textContent = 'remove';
                }
            });
        });

        // Category filter
        const catBtns = document.querySelectorAll('.faq-cat-btn');
        const sections = document.querySelectorAll('[data-section]');
        catBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                catBtns.forEach(b => {
                    b.classList.remove('bg-text-light', 'text-white', 'border-text-light');
                    b.classList.add('bg-transparent', 'text-text-light', 'border-transparent');
                });
                btn.classList.remove('bg-transparent', 'text-text-light', 'border-transparent');
                btn.classList.add('bg-text-light', 'text-white', 'border-text-light');
                const cat = btn.dataset.cat;
                sections.forEach(sec => {
                    sec.style.display = (cat === 'all' || sec.dataset.section === cat) ? 'block' : 'none';
                });
            });
        });
    });
</script>
@endsection
