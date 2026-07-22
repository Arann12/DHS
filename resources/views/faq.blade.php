@extends('layouts.app')

@section('title', 'FAQ — Denpasar Hotel School')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden mb-16">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img alt="Hospitality Support" class="absolute inset-0 w-full h-full object-cover"
            src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80&w=1600&auto=format&fit=crop">

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><span data-id="FAQ" data-en="FAQ">FAQ</span></span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-8 leading-[1.1]">
                <span data-id="Pertanyaan yang Sering Diajukan" data-en="Frequently Asked Questions">Pertanyaan yang Sering Diajukan</span>
            </h1>

            <!-- Search Bar -->
            <div class="w-full max-w-2xl mx-auto relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-icons text-primary text-2xl">search</span>
                </div>
                <input
                    class="w-full pl-12 pr-4 py-4 bg-white/95 backdrop-blur-sm border border-white/20 focus:outline-none focus:border-primary transition-all text-base text-text-light placeholder:text-muted-light shadow-lg rounded-sm"
                    placeholder="Cari pertanyaan... (mis. 'biaya', 'asrama', 'magang')"
                    data-id="Cari pertanyaan... (mis. 'biaya', 'asrama', 'magang')"
                    data-en="Search questions... (e.g. 'fees', 'dorm', 'internship')" type="text">
            </div>
        </div>
    </section>

    <!-- Category Filter -->
    <section class="border-y border-black/10 bg-dhs-cream">
        <div class="max-w-[1280px] mx-auto px-5 md:px-16 py-4">
            <div class="flex overflow-x-auto gap-4 md:justify-center">
                <button
                    class="faq-cat-btn whitespace-nowrap px-6 py-2 bg-text-light text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold border border-text-light transition-colors active"
                    data-cat="all"><span data-id="Semua" data-en="All">Semua</span></button>
                <button
                    class="faq-cat-btn whitespace-nowrap px-6 py-2 bg-transparent text-text-light hover:bg-dhs-beige text-[0.7rem] uppercase tracking-[0.15em] font-semibold border border-transparent hover:border-black/20 transition-colors"
                    data-cat="akademi"><span data-id="Akademi &amp; Kurikulum" data-en="Academy &amp; Curriculum">Akademi &amp; Kurikulum</span></button>
                <button
                    class="faq-cat-btn whitespace-nowrap px-6 py-2 bg-transparent text-text-light hover:bg-dhs-beige text-[0.7rem] uppercase tracking-[0.15em] font-semibold border border-transparent hover:border-black/20 transition-colors"
                    data-cat="pendaftaran"><span data-id="Pendaftaran &amp; Seleksi" data-en="Registration &amp; Selection">Pendaftaran &amp; Seleksi</span></button>
                <button
                    class="faq-cat-btn whitespace-nowrap px-6 py-2 bg-transparent text-text-light hover:bg-dhs-beige text-[0.7rem] uppercase tracking-[0.15em] font-semibold border border-transparent hover:border-black/20 transition-colors"
                    data-cat="biaya"><span data-id="Biaya &amp; Pembayaran" data-en="Fees &amp; Payments">Biaya &amp; Pembayaran</span></button>
                <button
                    class="faq-cat-btn whitespace-nowrap px-6 py-2 bg-transparent text-text-light hover:bg-dhs-beige text-[0.7rem] uppercase tracking-[0.15em] font-semibold border border-transparent hover:border-black/20 transition-colors"
                    data-cat="kampus"><span data-id="Kehidupan Kampus" data-en="Campus Life">Kehidupan Kampus</span></button>
            </div>
        </div>
    </section>

    <!-- FAQ List -->
    <section class="px-5 md:px-16 py-16 md:py-20 max-w-[1280px] mx-auto">
        <div class="max-w-3xl mx-auto space-y-16">

            <!-- Akademi & Kurikulum -->
            <div data-section="akademi">
                <h2
                    class="text-[32px] leading-[1.3] font-semibold font-serif text-text-light mb-8 pb-4 border-b border-black/10">
                    <span data-id="Akademi &amp; Kurikulum" data-en="Academy &amp; Curriculum">Akademi &amp; Kurikulum</span>
                </h2>
                <div class="space-y-4">
                    <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                        <button
                            class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                            <span class="text-[20px] font-semibold text-text-light pr-4">
                                <span data-id="Berapa lama durasi tiap program studi di DHS?" data-en="How long is the duration of each study program at DHS?">Berapa lama durasi tiap program studi di DHS?</span>
                            </span>
                            <span
                                class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                        </button>
                        <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                            <p class="text-muted-light text-base leading-relaxed pt-4">
                                <span data-id="Durasi program studi di Denpasar Hotel School bervariasi. Program Diploma 1 berdurasi 1 tahun, Diploma 3 berdurasi 3 tahun, dan Diploma 4 (Sarjana Terapan) berdurasi 4 tahun. Setiap program mencakup masa perkuliahan teori, praktik di laboratorium kampus, dan program magang (On the Job Training) di industri perhotelan." data-en="The duration of study programs at Denpasar Hotel School varies. The Diploma 1 program lasts 1 year, Diploma 3 lasts 3 years, and Diploma 4 (Applied Bachelor) lasts 4 years. Each program includes theoretical lectures, practice in campus laboratories, and internship programs (On the Job Training) in the hospitality industry.">Durasi program studi di Denpasar Hotel School bervariasi. Program Diploma 1 berdurasi 1 tahun, Diploma 3 berdurasi 3 tahun, dan Diploma 4 (Sarjana Terapan) berdurasi 4 tahun. Setiap program mencakup masa perkuliahan teori, praktik di laboratorium kampus, dan program magang (On the Job Training) di industri perhotelan.</span>
                            </p>
                        </div>
                    </div>
                    <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                        <button
                            class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                            <span class="text-[20px] font-semibold text-text-light pr-4">
                                <span data-id="Apakah kurikulum DHS berstandar internasional?" data-en="Is the DHS curriculum internationally standardized?">Apakah kurikulum DHS berstandar internasional?</span>
                            </span>
                            <span
                                class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                        </button>
                        <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                            <p class="text-muted-light text-base leading-relaxed pt-4">
                                <span data-id="Ya, kurikulum kami dirancang dengan memadukan standar kompetensi nasional (SKKNI) dan standar internasional industri perhotelan. Kami juga bekerja sama dengan berbagai jaringan hotel global untuk memastikan materi yang diajarkan relevan dengan kebutuhan industri saat ini." data-en="Yes, our curriculum is designed by combining national competency standards (SKKNI) and international hospitality industry standards. We also cooperate with various global hotel chains to ensure the material taught is relevant to current industry needs.">Ya, kurikulum kami dirancang dengan memadukan standar kompetensi nasional (SKKNI) dan standar internasional industri perhotelan. Kami juga bekerja sama dengan berbagai jaringan hotel global untuk memastikan materi yang diajarkan relevan dengan kebutuhan industri saat ini.</span>
                            </p>
                        </div>
                    </div>
                    <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                        <button
                            class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                            <span class="text-[20px] font-semibold text-text-light pr-4">
                                <span data-id="Apa saja program studi yang tersedia di DHS?" data-en="What study programs are available at DHS?">Apa saja program studi yang tersedia di DHS?</span>
                            </span>
                            <span
                                class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                        </button>
                        <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                            <p class="text-muted-light text-base leading-relaxed pt-4">
                                <span data-id="DHS menawarkan tiga program utama: Culinary Arts (seni kuliner), Hospitality Management (manajemen perhotelan), dan Food &amp; Beverage Service. Setiap program dirancang dengan rasio praktik tinggi untuk memastikan kesiapan kerja lulusan." data-en="DHS offers three main programs: Culinary Arts, Hospitality Management, and Food &amp; Beverage Service. Each program is designed with a high practice ratio to ensure graduates' work readiness.">DHS menawarkan tiga program utama: Culinary Arts (seni kuliner), Hospitality Management (manajemen perhotelan), dan Food &amp; Beverage Service. Setiap program dirancang dengan rasio praktik tinggi untuk memastikan kesiapan kerja lulusan.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pendaftaran & Seleksi -->
            <div data-section="pendaftaran">
                <h2
                    class="text-[32px] leading-[1.3] font-semibold font-serif text-text-light mb-8 pb-4 border-b border-black/10">
                    <span data-id="Pendaftaran &amp; Seleksi" data-en="Registration &amp; Selection">Pendaftaran &amp; Seleksi</span>
                </h2>
                <div class="space-y-4">
                    <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                        <button
                            class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                            <span class="text-[20px] font-semibold text-text-light pr-4">
                                <span data-id="Apa saja syarat pendaftaran mahasiswa baru?" data-en="What are the new student registration requirements?">Apa saja syarat pendaftaran mahasiswa baru?</span>
                            </span>
                            <span
                                class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                        </button>
                        <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                            <ul class="list-none space-y-2 text-muted-light text-base pt-4">
                                <li class="flex items-start"><span class="text-primary mr-2">•</span> <span data-id="Lulusan SMA/SMK/MA sederajat dari semua jurusan." data-en="High school/vocational school graduates or equivalent from all majors.">Lulusan SMA/SMK/MA sederajat dari semua jurusan.</span></li>
                                <li class="flex items-start"><span class="text-primary mr-2">•</span> <span data-id="Mengisi formulir pendaftaran online." data-en="Fill out the online registration form.">Mengisi formulir pendaftaran online.</span></li>
                                <li class="flex items-start"><span class="text-primary mr-2">•</span> <span data-id="Menyerahkan fotokopi ijazah, SKHUN, dan transkrip nilai yang dilegalisir." data-en="Submit legalized photocopies of diploma, national exam certificate, and transcripts.">Menyerahkan fotokopi ijazah, SKHUN, dan transkrip nilai yang dilegalisir.</span></li>
                                <li class="flex items-start"><span class="text-primary mr-2">•</span> <span data-id="Pas foto terbaru ukuran 3x4 dan 4x6 (masing-masing 2 lembar)." data-en="Recent passport-size photographs 3x4 and 4x6 (2 copies each).">Pas foto terbaru ukuran 3x4 dan 4x6 (masing-masing 2 lembar).</span></li>
                                <li class="flex items-start"><span class="text-primary mr-2">•</span> <span data-id="Lulus ujian saringan masuk (Tes Potensi Akademik dan Wawancara)." data-en="Pass entrance examination (Academic Potential Test and Interview).">Lulus ujian saringan masuk (Tes Potensi Akademik dan Wawancara).</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                        <button
                            class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                            <span class="text-[20px] font-semibold text-text-light pr-4">
                                <span data-id="Apakah ada beasiswa yang tersedia?" data-en="Are there scholarships available?">Apakah ada beasiswa yang tersedia?</span>
                            </span>
                            <span
                                class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                        </button>
                        <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                            <p class="text-muted-light text-base leading-relaxed pt-4">
                                <span data-id="DHS menyediakan beberapa jalur beasiswa, antara lain Beasiswa Prestasi Akademik, Beasiswa Prestasi Non-Akademik (olahraga/seni), dan Beasiswa Kemitraan Industri. Informasi lengkap mengenai persyaratan dan jadwal pengajuan beasiswa dapat dilihat pada halaman Beasiswa atau menghubungi tim admisi kami." data-en="DHS provides several scholarship pathways, including Academic Achievement Scholarships, Non-Academic Achievement Scholarships (sports/arts), and Industry Partnership Scholarships. Complete information about requirements and schedule can be found on the Scholarship page or by contacting our admissions team.">DHS menyediakan beberapa jalur beasiswa, antara lain Beasiswa Prestasi Akademik, Beasiswa Prestasi Non-Akademik (olahraga/seni), dan Beasiswa Kemitraan Industri. Informasi lengkap mengenai persyaratan dan jadwal pengajuan beasiswa dapat dilihat pada halaman Beasiswa atau menghubungi tim admisi kami.</span>
                            </p>
                        </div>
                    </div>
                    <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                        <button
                            class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                            <span class="text-[20px] font-semibold text-text-light pr-4">
                                <span data-id="Kapan periode pendaftaran dibuka?" data-en="When is the registration period open?">Kapan periode pendaftaran dibuka?</span>
                            </span>
                            <span
                                class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                        </button>
                        <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                            <p class="text-muted-light text-base leading-relaxed pt-4">
                                <span data-id="Pendaftaran mahasiswa baru DHS dibuka setiap tahun mulai bulan Maret hingga Juli untuk penerimaan tahun ajaran baru di bulan September. Pendaftaran dilakukan secara online melalui portal resmi DHS." data-en="DHS new student registration opens every year from March to July for the new academic year intake in September. Registration is done online through the official DHS portal.">Pendaftaran mahasiswa baru DHS dibuka setiap tahun mulai bulan Maret hingga Juli untuk penerimaan tahun ajaran baru di bulan September. Pendaftaran dilakukan secara online melalui portal resmi DHS.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Biaya & Pembayaran -->
            <div data-section="biaya">
                <h2
                    class="text-[32px] leading-[1.3] font-semibold font-serif text-text-light mb-8 pb-4 border-b border-black/10">
                    <span data-id="Biaya &amp; Pembayaran" data-en="Fees &amp; Payments">Biaya &amp; Pembayaran</span>
                </h2>
                <div class="space-y-4">
                    <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                        <button
                            class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                            <span class="text-[20px] font-semibold text-text-light pr-4">
                                <span data-id="Berapa biaya kuliah di DHS?" data-en="How much is the tuition fee at DHS?">Berapa biaya kuliah di DHS?</span>
                            </span>
                            <span
                                class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                        </button>
                        <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                            <p class="text-muted-light text-base leading-relaxed pt-4">
                                <span data-id="Biaya pendidikan di DHS bervariasi tergantung program yang dipilih. Untuk informasi lengkap mengenai struktur biaya, silakan mengunduh brosur biaya terbaru atau hubungi tim admisi kami. Kami juga menawarkan skema cicilan yang fleksibel." data-en="Tuition fees at DHS vary depending on the chosen program. For complete information on the fee structure, please download the latest fee brochure or contact our admissions team. We also offer flexible installment schemes.">Biaya pendidikan di DHS bervariasi tergantung program yang dipilih. Untuk informasi lengkap mengenai struktur biaya, silakan mengunduh brosur biaya terbaru atau hubungi tim admisi kami. Kami juga menawarkan skema cicilan yang fleksibel.</span>
                            </p>
                        </div>
                    </div>
                    <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                        <button
                            class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                            <span class="text-[20px] font-semibold text-text-light pr-4">
                                <span data-id="Apakah biaya kuliner/seragam sudah termasuk dalam biaya kuliah?" data-en="Are culinary/uniform costs included in the tuition fee?">Apakah biaya kuliner/seragam sudah termasuk dalam biaya kuliah?</span>
                            </span>
                            <span
                                class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                        </button>
                        <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                            <p class="text-muted-light text-base leading-relaxed pt-4">
                                <span data-id="Biaya seragam dan peralatan praktik (termasuk perlengkapan dapur untuk program Culinary) dikenakan terpisah pada saat registrasi ulang. Detail biaya ini akan diinformasikan pada saat dinyatakan lulus seleksi." data-en="Uniform and practice equipment costs (including kitchen equipment for the Culinary program) are charged separately upon re-registration. Details of these costs will be communicated once declared passed the selection.">Biaya seragam dan peralatan praktik (termasuk perlengkapan dapur untuk program Culinary) dikenakan terpisah pada saat registrasi ulang. Detail biaya ini akan diinformasikan pada saat dinyatakan lulus seleksi.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kehidupan Kampus -->
            <div data-section="kampus">
                <h2
                    class="text-[32px] leading-[1.3] font-semibold font-serif text-text-light mb-8 pb-4 border-b border-black/10">
                    <span data-id="Kehidupan Kampus &amp; Akomodasi" data-en="Campus Life &amp; Accommodation">Kehidupan Kampus &amp; Akomodasi</span>
                </h2>
                <div class="space-y-4">
                    <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                        <button
                            class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                            <span class="text-[20px] font-semibold text-text-light pr-4">
                                <span data-id="Apakah DHS menyediakan fasilitas asrama mahasiswa?" data-en="Does DHS provide student dormitory facilities?">Apakah DHS menyediakan fasilitas asrama mahasiswa?</span>
                            </span>
                            <span
                                class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                        </button>
                        <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                            <p class="text-muted-light text-base leading-relaxed pt-4">
                                <span data-id="Ya, kami merekomendasikan beberapa fasilitas akomodasi yang dikelola oleh mitra kami yang berlokasi dekat dengan kampus. Fasilitas ini dirancang nyaman, aman, dan mendukung lingkungan belajar mahasiswa. Hubungi layanan mahasiswa kami untuk bantuan penempatan akomodasi." data-en="Yes, we recommend several accommodation facilities managed by our partners located close to campus. These facilities are designed to be comfortable, safe, and support the student learning environment. Contact our student services for accommodation placement assistance.">Ya, kami merekomendasikan beberapa fasilitas akomodasi yang dikelola oleh mitra kami yang berlokasi dekat dengan kampus. Fasilitas ini dirancang nyaman, aman, dan mendukung lingkungan belajar mahasiswa. Hubungi layanan mahasiswa kami untuk bantuan penempatan akomodasi.</span>
                            </p>
                        </div>
                    </div>
                    <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors">
                        <button
                            class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                            <span class="text-[20px] font-semibold text-text-light pr-4">
                                <span data-id="Kegiatan apa saja yang tersedia di luar jam kuliah?" data-en="What activities are available outside of class hours?">Kegiatan apa saja yang tersedia di luar jam kuliah?</span>
                            </span>
                            <span
                                class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                        </button>
                        <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                            <p class="text-muted-light text-base leading-relaxed pt-4">
                                <span data-id="DHS memiliki berbagai kegiatan kemahasiswaan seperti komunitas memasak, klub barista, himpunan mahasiswa jurusan, dan kompetisi keterampilan reguler. Kami juga mengadakan kunjungan industri ke hotel dan resort terkemuka secara rutin." data-en="DHS has various student activities such as cooking community, barista club, student association, and regular skill competitions. We also organize regular industrial visits to leading hotels and resorts.">DHS memiliki berbagai kegiatan kemahasiswaan seperti komunitas memasak, klub barista, himpunan mahasiswa jurusan, dan kompetisi keterampilan reguler. Kami juga mengadakan kunjungan industri ke hotel dan resort terkemuka secara rutin.</span>
                            </p>
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
                <span data-id="Tidak Menemukan Jawaban yang Kamu Cari?" data-en="Didn't Find the Answer You Were Looking For?">Tidak Menemukan Jawaban yang Kamu Cari?</span>
            </h2>
            <p class="text-lg text-muted-light mb-10 max-w-2xl mx-auto leading-relaxed">
                <span data-id="Tim admisi kami siap membantu Anda secara langsung untuk menjawab segala pertanyaan seputar proses belajar di Denpasar Hotel School." data-en="Our admissions team is ready to assist you directly to answer all questions about the learning process at Denpasar Hotel School.">Tim admisi kami siap membantu Anda secara langsung untuk menjawab segala pertanyaan seputar proses belajar di Denpasar Hotel School.</span>
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a class="inline-flex items-center justify-center px-8 py-4 bg-dhs-navy text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-darknavy transition-colors w-full sm:w-auto min-w-[280px]"
                    href="https://wa.me/6281246319966" target="_blank">
                    <span data-id="Hubungi Kami via WhatsApp (+62 81 246 319966)" data-en="Contact Us via WhatsApp (+62 81 246 319966)">Hubungi Kami via WhatsApp (+62 81 246 319966)</span>
                </a>
                <a class="inline-flex items-center justify-center px-8 py-4 bg-transparent border border-dhs-navy text-dhs-navy text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-navy hover:text-white transition-colors w-full sm:w-auto min-w-[280px]"
                    href="mailto:sahabat@dhs.or.id">
                    <span data-id="Kirim Pertanyaan via Email (sahabat@dhs.or.id)" data-en="Send Inquiries via Email (sahabat@dhs.or.id)">Kirim Pertanyaan via Email (sahabat@dhs.or.id)</span>
                </a>
            </div>
        </div>
    </section>

    <script>
        // Accordion logic
        document.addEventListener('DOMContentLoaded', function () {
            const accordions = document.querySelectorAll('.accordion-toggle');
            accordions.forEach(acc => {
                acc.addEventListener('click', function () {
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