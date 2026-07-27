@extends('layouts.app')

@section('title', 'Tentang Kami — Denpasar Hotel School')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img alt="DHS Campus panoramic view" class="absolute inset-0 w-full h-full object-cover"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvULZTmcRw3vX-f-CzNGg8stMRI2Ea5NrSmiyucdED1Ui6mqgK2AmexIratVtInAzxZCCHoL-zzOc0IKiakMVptfS6D7Totb7TxRP3hnBTI6jiqWvMeiM_1-hkImIpVicdfMM6OIO2stFSZu3ragqM52MjEfHpklP14W0JSFCG3J7oNfgCwfP2lub1AqE-vF_htAw-tUtFYRPRud-E7yvapjggWrzGecs_O5JgHck2s4ToD8oRnYCnxg">

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><span data-id="Tentang Kami" data-en="About Us">Tentang Kami</span></span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-[1.1]">
                <span data-id="Membangun Pemimpin Hospitality Masa Depan" data-en="Building Future Hospitality Leaders">Membangun Pemimpin Hospitality Masa Depan</span>
            </h1>
            <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/70 font-medium">
                <span data-id="Institusi &amp; Warisan" data-en="Institution &amp; Heritage">Institusi &amp; Warisan</span>
            </p>
        </div>
    </section>

    <!-- Tagline / Intro -->
    <section class="py-20 md:py-28 px-5 md:px-16 max-w-[1280px] mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div data-reveal="fade-right">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                    <span data-id="Tentang DHS" data-en="About DHS">Tentang DHS</span>
                </span>
                <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6">
                    <span data-id="Transforming Into Excellent" data-en="Transforming Into Excellent">Transforming Into Excellent</span>
                </h2>
                <p class="text-base text-muted-light leading-relaxed mb-6">
                    <span data-id="Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi. Lembaga ini didirikan untuk memberi kesempatan generasi muda Indonesia menjadi tenaga profesional bidang perhotelan, hospitality, kapal pesiar dan pariwisata." data-en="Denpasar Hotel School (DHS) is a hospitality education and training institution that promotes overseas education by integrating educational institutions and training with the industrial world. DHS operates under the Guna Widya Paramesthi Foundation. The institution was established to provide opportunities for young Indonesians to become professionals in hospitality, cruise ships, and tourism.">Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi. Lembaga ini didirikan untuk memberi kesempatan generasi muda Indonesia menjadi tenaga profesional bidang perhotelan, hospitality, kapal pesiar dan pariwisata.</span>
                </p>
                <p class="text-base text-muted-light leading-relaxed">
                    <span data-id="Lembaga ini hadir untuk mengajak mahasiswa belajar sambil bekerja di Australia, Jerman dan Asia Tenggara melalui Partnership Program of DHS, dikenal dengan sebutan PP DHS." data-en="The institution is here to invite students to study while working in Australia, Germany, and Southeast Asia through the DHS Partnership Program, known as PP DHS.">Lembaga ini hadir untuk mengajak mahasiswa belajar sambil bekerja di Australia, Jerman dan Asia Tenggara melalui Partnership Program of DHS, dikenal dengan sebutan PP DHS.</span>
                </p>
            </div>
            <div class="flex items-center justify-center bg-dhs-cream p-8 text-center h-full" data-reveal="fade-left" data-delay="200">
                <div class="text-muted-light italic text-sm">
                    <span data-id="&quot;Mengintegrasikan pendidikan perhotelan dengan dunia industri nyata untuk karir global.&quot;" data-en="&quot;Integrating hospitality education with the real industrial world for a global career.&quot;">"Mengintegrasikan pendidikan perhotelan dengan dunia industri nyata untuk karir global."</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="bg-dhs-cream py-20 md:py-24">
        <div class="px-5 md:px-16 max-w-[1280px] mx-auto">
            <div class="text-center mb-16" data-reveal="fade-up">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                    <span data-id="Tujuan Kami" data-en="Our Purpose">Tujuan Kami</span>
                </span>
                <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">
                    <span data-id="Visi, Misi &amp; Core Values" data-en="Vision, Mission &amp; Core Values">Visi, Misi &amp; Core Values</span>
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="bg-white p-10 shadow-sm" data-reveal="fade-right" data-delay="100">
                    <span class="material-icons text-primary text-4xl mb-6 block">visibility</span>
                    <h3 class="text-[24px] font-semibold font-serif text-text-light mb-4"><span data-id="Visi" data-en="Vision">Visi</span></h3>
                    <p class="text-base text-muted-light leading-relaxed"><span data-id="Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global." data-en="Transforming high school graduates into professionals in hospitality and tourism who are willing and able to compete at a global level.">Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global.</span></p>
                </div>
                <div class="bg-dhs-navy p-10 shadow-sm" data-reveal="fade-left" data-delay="200">
                    <span class="material-icons text-primary text-4xl mb-6 block">flag</span>
                    <h3 class="text-[24px] font-semibold font-serif text-white mb-4"><span data-id="Misi" data-en="Mission">Misi</span></h3>
                    <ul class="space-y-3 text-white/80 text-base">
                        <li class="flex items-start"><span class="text-primary mr-2 mt-1">•</span> <span data-id="Melaksanakan program pendidikan inovatif sesuai kebutuhan industri." data-en="Implementing innovative educational programs according to industry needs.">Melaksanakan program pendidikan inovatif sesuai kebutuhan industri.</span></li>
                        <li class="flex items-start"><span class="text-primary mr-2 mt-1">•</span> <span data-id="Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional." data-en="Developing education and training resources professionally.">Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional.</span></li>
                        <li class="flex items-start"><span class="text-primary mr-2 mt-1">•</span> <span data-id="Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara." data-en="Providing opportunities for students to study while working in Australia, Germany, and Southeast Asia.">Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara.</span></li>
                    </ul>
                </div>
            </div>

            <div class="bg-white p-10 shadow-sm" data-reveal="zoom-in" data-delay="150">
                <h3 class="text-[24px] font-semibold font-serif text-text-light mb-8 text-center"><span data-id="Core Values (Nilai-Nilai Utama)" data-en="Core Values">Core Values (Nilai-Nilai Utama)</span></h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h4 class="font-bold text-lg text-primary mb-2"><span data-id="Integritas (Integrity)" data-en="Integrity">Integritas (Integrity)</span></h4>
                        <p class="text-sm text-muted-light leading-relaxed"><span data-id="DHS memegang teguh visi dan misi guna membentuk insan pariwisata yang kompeten dan berdaya saing." data-en="DHS upholds its vision and mission to shape competent and competitive tourism professionals.">DHS memegang teguh visi dan misi guna membentuk insan pariwisata yang kompeten dan berdaya saing.</span></p>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg text-primary mb-2"><span data-id="Tanggung Jawab (Responsibility)" data-en="Responsibility">Tanggung Jawab (Responsibility)</span></h4>
                        <p class="text-sm text-muted-light leading-relaxed"><span data-id="DHS bertanggung jawab menghasilkan lulusan yang sesuai dengan kriteria dunia kerja serta tantangan di masa depan." data-en="DHS is responsible for producing graduates who meet workforce criteria and future challenges.">DHS bertanggung jawab menghasilkan lulusan yang sesuai dengan kriteria dunia kerja serta tantangan di masa depan.</span></p>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg text-primary mb-2"><span data-id="Kualitas (Quality)" data-en="Quality">Kualitas (Quality)</span></h4>
                        <p class="text-sm text-muted-light leading-relaxed"><span data-id="DHS memberikan pelayanan dan solusi terbaik yang berfokus pada kualitas pembelajaran." data-en="DHS provides the best service and solutions focused on learning quality.">DHS memberikan pelayanan dan solusi terbaik yang berfokus pada kualitas pembelajaran.</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sejarah Timeline -->
    <section class="py-20 md:py-24 px-5 md:px-16 max-w-[1280px] mx-auto">
        <div class="text-center mb-16" data-reveal="fade-up">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                <span data-id="Perjalanan Kami" data-en="Our Journey">Perjalanan Kami</span>
            </span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">
                <span data-id="Sejarah &amp; Milestone" data-en="History &amp; Milestones">Sejarah &amp; Milestone</span>
            </h2>
        </div>
        <div class="relative max-w-3xl mx-auto">
            <div class="absolute left-1/2 top-0 bottom-0 w-px bg-black/10 -translate-x-1/2 hidden md:block"></div>
            <div class="space-y-12">
                @php
                    $timeline = [
                        ['year' => '2005', 'title_id' => 'DHS Berdiri', 'title_en' => 'DHS Founded', 'desc_id' => 'Denpasar Hotel School didirikan dengan visi membawa standar pendidikan hospitality internasional ke Bali. Angkatan pertama berjumlah 48 mahasiswa di tiga program.', 'desc_en' => 'Denpasar Hotel School was founded with the vision of bringing international hospitality education standards to Bali. The first batch consisted of 48 students across three programs.'],
                        ['year' => '2009', 'title_id' => 'Akreditasi Nasional', 'title_en' => 'National Accreditation', 'desc_id' => 'DHS meraih akreditasi A dari BAN-PT. Sebuah pengakuan atas komitmen kami terhadap kualitas pendidikan dan standar institusi.', 'desc_en' => 'DHS received A accreditation from BAN-PT. A recognition of our commitment to educational quality and institutional standards.'],
                        ['year' => '2013', 'title_id' => 'Gedung Training Center Baru', 'title_en' => 'New Training Center Building', 'desc_id' => 'Peresmian Training Center seluas 4.500 m² dengan dapur profesional, training bar, dan training restaurant berkapasitas 120 kursi.', 'desc_en' => 'Inauguration of a 4,500 m² Training Center with a professional kitchen, training bar, and 120-seat training restaurant.'],
                        ['year' => '2017', 'title_id' => 'MoU dengan Marriott International', 'title_en' => 'MoU with Marriott International', 'desc_id' => 'Penandatanganan MoU strategis dengan Marriott International membuka jalur rekrutmen langsung ke lebih dari 30 properti di Asia Pasifik.', 'desc_en' => 'Signing of a strategic MoU with Marriott International opening direct recruitment pathways to over 30 properties in Asia Pacific.'],
                        ['year' => '2022', 'title_id' => 'Program Internasional', 'title_en' => 'International Program', 'desc_id' => 'Peluncuran program exchange mahasiswa dengan sekolah perhotelan di Swiss dan Singapura, memperluas wawasan global mahasiswa DHS.', 'desc_en' => 'Launch of student exchange programs with hospitality schools in Switzerland and Singapore, expanding DHS students\' global perspective.'],
                        ['year' => '2024', 'title_id' => 'DHS Hari Ini', 'title_en' => 'DHS Today', 'desc_id' => '3.000+ alumni tersebar di hotel-hotel terkemuka di 20+ negara. DHS terus bertumbuh sebagai pusat unggulan pendidikan hospitality di Indonesia.', 'desc_en' => '3,000+ alumni spread across leading hotels in 20+ countries. DHS continues to grow as a center of excellence for hospitality education in Indonesia.'],
                    ];
                @endphp
                @foreach($timeline as $i => $item)
                    <div class="flex flex-col md:flex-row {{ $i % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center gap-8"
                        data-reveal="fade-up" data-delay="{{ $i * 100 }}">
                        <div class="{{ $i % 2 === 0 ? 'md:text-right' : 'md:text-left' }} flex-1">
                            <div class="bg-white p-6 shadow-sm border-l-4 {{ $i % 2 === 0 ? 'border-l-primary' : 'border-l-dhs-navy' }} inline-block w-full">
                                <h3 class="text-[20px] font-semibold font-serif text-text-light mb-2"><span data-id="{{ $item['title_id'] }}" data-en="{{ $item['title_en'] }}">{{ $item['title_id'] }}</span></h3>
                                <p class="text-base text-muted-light leading-relaxed"><span data-id="{{ $item['desc_id'] }}" data-en="{{ $item['desc_en'] }}">{{ $item['desc_id'] }}</span></p>
                            </div>
                        </div>
                        <div class="shrink-0 w-16 h-16 bg-primary text-white flex items-center justify-center font-bold text-sm font-sans z-10 shadow-md">{{ $item['year'] }}</div>
                        <div class="flex-1 hidden md:block"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pesan Direktur Section -->
    <section class="bg-white py-20 md:py-24 px-5 md:px-16 max-w-[1280px] mx-auto border-t border-black/5">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-center">
            <div class="md:col-span-1" data-reveal="fade-right">
                <img class="w-full h-auto object-cover border border-black/10" alt="I Made Dwija Suastana, S.H., M.H."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDeYrRiWE5PIngmO86w0Cn5hPsDfiG59HTAVn8-asaEPcvD_fxcdAfcXy_4KR3Pj-pL3DyMS_WN9hCkZFO-lSelGflhgKm5r2oTS_3HJ83ZvydeMvZY_QKmjAItPrh0n3Yvymm1YaFTXkLZpopTGMNQl17m_JEFUai2rxAdUHMzWu383ihOl9jx19ZEtRwSlqf0azKeZNaeaNPVSW6SAXdOP0RroYx1ZflK8JBFkyTsOLiVdTtucCRmxQ">
            </div>
            <div class="md:col-span-2 text-text-light" data-reveal="fade-left" data-delay="200">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                    <span data-id="KATA SAMBUTAN" data-en="WELCOME MESSAGE">KATA SAMBUTAN</span>
                </span>
                <h2 class="text-[32px] font-semibold font-serif mb-6"><span data-id="Pesan Direktur" data-en="Director's Message">Pesan Direktur</span></h2>
                <div class="text-base text-muted-light leading-relaxed space-y-4">
                    <p><span data-id="&quot;Halo sahabat excellent, Denpasar Hotel School hadir dengan sebuah komitmen untuk mengantarkan calon profesional muda menjadi SDM Indonesia yang unggul dan kompeten.&quot;" data-en="&quot;Hello excellent friends, Denpasar Hotel School is here with a commitment to guide young professionals to become outstanding and competent Indonesian human resources.&quot;">"Halo sahabat excellent, Denpasar Hotel School hadir dengan sebuah komitmen untuk mengantarkan calon profesional muda menjadi SDM Indonesia yang unggul dan kompeten."</span></p>
                    <p><span data-id="&quot;Di Denpasar Hotel School, Anda akan dilatih oleh para praktisi yang telah berpengalaman di bidangnya masing-masing. Mari bergabung bersama kami, Denpasar Hotel School, kami siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global.&quot;" data-en="&quot;At Denpasar Hotel School, you will be trained by experienced practitioners in their respective fields. Join us at Denpasar Hotel School, we are ready to guide you to become a competent young professional with global competitiveness.&quot;">"Di Denpasar Hotel School, Anda akan dilatih oleh para praktisi yang telah berpengalaman di bidangnya masing-masing. Mari bergabung bersama kami, Denpasar Hotel School, kami siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global."</span></p>
                    <p class="font-bold text-primary pt-4">Salam Excellent!<br>— I Made Dwija Suastana, S.H., M.H. (<span data-id="Direktur" data-en="Director">Direktur</span>)</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tim Kepemimpinan -->
    <section class="bg-dhs-cream py-20 md:py-24">
        <div class="px-5 md:px-16 max-w-[1280px] mx-auto">
            <div class="text-center mb-16" data-reveal="fade-up">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                    <span data-id="Orang-Orang di Balik DHS" data-en="The People Behind DHS">Orang-Orang di Balik DHS</span>
                </span>
                <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">
                    <span data-id="Tim Kepemimpinan" data-en="Leadership Team">Tim Kepemimpinan</span>
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-center">
                <div class="group text-center mx-auto md:col-start-2" data-reveal="zoom-in">
                    <div class="relative overflow-hidden mb-6 aspect-square max-w-[280px] mx-auto">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            alt="I Made Dwija Suastana"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDeYrRiWE5PIngmO86w0Cn5hPsDfiG59HTAVn8-asaEPcvD_fxcdAfcXy_4KR3Pj-pL3DyMS_WN9hCkZFO-lSelGflhgKm5r2oTS_3HJ83ZvydeMvZY_QKmjAItPrh0n3Yvymm1YaFTXkLZpopTGMNQl17m_JEFUai2rxAdUHMzWu383ihOl9jx19ZEtRwSlqf0azKeZNaeaNPVSW6SAXdOP0RroYx1ZflK8JBFkyTsOLiVdTtucCRmxQ">
                    </div>
                    <h3 class="text-[20px] font-semibold font-serif text-text-light mb-1">I Made Dwija Suastana, S.H., M.H.</h3>
                    <p class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-3"><span data-id="Direktur" data-en="Director">Direktur</span></p>
                    <p class="text-sm text-muted-light leading-relaxed"><span data-id="Memimpin Denpasar Hotel School (DHS) dengan komitmen penuh untuk mencetak SDM unggul berdaya saing global." data-en="Leading Denpasar Hotel School (DHS) with full commitment to producing globally competitive human resources.">Memimpin Denpasar Hotel School (DHS) dengan komitmen penuh untuk mencetak SDM unggul berdaya saing global.</span></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partnership & Mitra Section -->
    <section class="py-20 md:py-24 bg-dhs-cream/50 border-t border-b border-black/5 overflow-hidden">
        <div class="max-w-[1280px] mx-auto px-5 md:px-16 text-center mb-16">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                <span data-id="Kemitraan &amp; Jaringan Global" data-en="Partnership &amp; Global Network">Kemitraan &amp; Jaringan Global</span>
            </span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6" data-reveal="fade-up">
                <span data-id="Partnership Program" data-en="Partnership Program">Partnership Program</span>
            </h2>
            <p class="text-base text-muted-light max-w-3xl mx-auto leading-relaxed" data-reveal="fade-up" data-delay="100">
                <span data-id="DHS berkomitmen penuh untuk mengintegrasikan pendidikan vokasi dengan dunia industri global. Program ini menjamin penempatan magang internasional (OJT) berkualitas dan penyaluran kerja langsung di hotel bintang 4 &amp; 5 serta kapal pesiar mewah tanpa potongan agen fee (Zero Agent Fee)." data-en="DHS is fully committed to integrating vocational education with the global industry. This program guarantees high-quality international internship (OJT) placement and direct recruitment in 4 &amp; 5-star hotels and luxury cruise lines with absolutely zero agent fees.">DHS berkomitmen penuh untuk mengintegrasikan pendidikan vokasi dengan dunia industri global. Program ini menjamin penempatan magang internasional (OJT) berkualitas dan penyaluran kerja langsung di hotel bintang 4 &amp; 5 serta kapal pesiar mewah tanpa potongan agen fee (Zero Agent Fee).</span>
            </p>
        </div>

        <!-- Marquee Rows Container -->
        <div class="space-y-6 select-none" data-reveal="fade-up" data-delay="200">
            @php
                $row1 = [
                    ['line1' => 'TAFE', 'sub' => 'AUSTRALIA', 'font' => 'font-sans text-xl font-black tracking-[0.2em]'],
                    ['line1' => 'The Hotel<br>School', 'sub' => 'SYDNEY &amp; MELBOURNE', 'font' => 'font-serif text-sm font-bold tracking-wide leading-tight'],
                    ['line1' => 'Ausbildung', 'sub' => 'JERMAN', 'font' => 'font-serif text-lg italic font-semibold', 'subtracking' => 'tracking-[0.3em]'],
                    ['line1' => '<span class="text-primary">G</span>COM', 'sub' => 'EDUCATION', 'font' => 'font-sans text-xl font-bold tracking-[0.15em]'],
                    ['line1' => 'Bursa SDM<br>Indonesia', 'sub' => null, 'font' => 'font-sans text-xs font-extrabold tracking-[0.1em] uppercase leading-tight'],
                    ['line1' => 'NEO', 'sub' => 'BY ASTON', 'font' => 'font-serif text-2xl font-extrabold tracking-[0.1em]'],
                    ['line1' => 'Four Star', 'sub' => 'BY TRANS HOTEL', 'font' => 'font-serif text-sm font-bold tracking-wide uppercase leading-tight', 'subtracking' => 'tracking-[0.15em]'],
                    ['line1' => 'AMNAYA', 'sub' => 'RESORT BALI', 'font' => 'font-serif text-lg font-bold tracking-widest uppercase'],
                    ['line1' => 'THEANNA', 'sub' => 'VILLA CANGGU', 'font' => 'font-serif text-lg font-semibold tracking-wider uppercase'],
                ];
                $row2 = [
                    ['line1' => 'Four Points<br><span class="text-[0.55rem] font-sans font-normal tracking-[0.12em] text-muted-light">by Sheraton</span>', 'sub' => 'UNGASAN BALI', 'font' => 'font-serif text-xs font-bold tracking-wider uppercase leading-tight', 'subtracking' => 'tracking-[0.15em]', 'submargin' => 'mt-0.5'],
                    ['line1' => 'Kuta Paradiso', 'sub' => 'HOTEL BALI', 'font' => 'font-serif text-sm font-semibold tracking-wide italic leading-tight'],
                    ['line1' => 'Bali Language<br>Art &amp; Culture', 'sub' => null, 'font' => 'font-sans text-[10px] font-bold tracking-wider uppercase leading-snug'],
                    ['line1' => 'FOKUSINDO', 'sub' => null, 'font' => 'font-sans text-sm font-black tracking-[0.15em] uppercase'],
                    ['line1' => 'JUBILEE', 'sub' => null, 'font' => 'font-serif text-lg font-bold tracking-widest italic'],
                    ['line1' => 'Soulbites', 'sub' => 'UBUD BALI', 'font' => 'font-sans text-sm font-semibold tracking-wider uppercase'],
                    ['line1' => 'TACO CASA', 'sub' => null, 'font' => 'font-sans text-base font-extrabold tracking-widest uppercase'],
                    ['line1' => 'COMO UMA', 'sub' => 'CANGGU', 'font' => 'font-serif text-sm font-bold tracking-wide leading-tight'],
                    ['line1' => 'THE VASINI', 'sub' => 'SMART BOUTIQUE', 'font' => 'font-serif text-xs font-bold tracking-wider uppercase leading-tight', 'subtracking' => 'tracking-[0.1em]', 'submargin' => 'mt-0.5'],
                    ['line1' => 'Noble Career<br>Gurus', 'sub' => null, 'font' => 'font-sans text-[10px] font-bold tracking-wider uppercase leading-snug'],
                ];

                $renderCard = function($item) {
                    $out = '<div class="bg-white border border-black/10 hover:border-primary/30 hover:shadow-md transition-all duration-300 flex items-center justify-center w-48 h-24 p-4 cursor-default select-none shrink-0 rounded-lg">';
                    $out .= '<div class="text-center">';
                    $out .= '<div class="' . $item['font'] . ' text-dhs-navy">' . $item['line1'] . '</div>';
                    if (!empty($item['sub'])) {
                        $subtracking = $item['subtracking'] ?? 'tracking-[0.2em]';
                        $submargin = $item['submargin'] ?? 'mt-1';
                        $out .= '<div class="text-[0.55rem] font-sans ' . $subtracking . ' text-muted-light uppercase ' . $submargin . '">' . $item['sub'] . '</div>';
                    }
                    $out .= '</div></div>';
                    return $out;
                };
            @endphp

            <!-- Row 1: Left Scroll -->
            <div class="marquee-container relative flex overflow-hidden w-full">
                <div class="flex shrink-0 gap-6 py-4 animate-marquee-left">
                    @foreach($row1 as $item)
                        {!! $renderCard($item) !!}
                    @endforeach
                    @foreach($row1 as $item)
                        {!! $renderCard($item) !!}
                    @endforeach
                </div>
            </div>

            <!-- Row 2: Right Scroll -->
            <div class="marquee-container relative flex overflow-hidden w-full">
                <div class="flex shrink-0 gap-6 py-4 animate-marquee-right">
                    @foreach($row2 as $item)
                        {!! $renderCard($item) !!}
                    @endforeach
                    @foreach($row2 as $item)
                        {!! $renderCard($item) !!}
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes marquee-left {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        @keyframes marquee-right {
            0% { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }
        .animate-marquee-left {
            animation: marquee-left 40s linear infinite;
        }
        .animate-marquee-right {
            animation: marquee-right 40s linear infinite;
        }
        .marquee-container:hover .animate-marquee-left,
        .marquee-container:hover .animate-marquee-right {
            animation-play-state: paused;
        }
    </style>

    <!-- CTA Section -->
    <section class="bg-dhs-navy py-20 md:py-24 px-5 md:px-16">
        <div class="max-w-3xl mx-auto text-center" data-reveal="zoom-in">
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-white mb-6">
                <span data-id="Jadilah Bagian dari Keluarga DHS" data-en="Become Part of the DHS Family">Jadilah Bagian dari Keluarga DHS</span>
            </h2>
            <p class="text-lg text-white/70 mb-10 leading-relaxed">
                <span data-id="Bergabunglah dengan ribuan alumni kami yang telah berhasil membangun karir gemilang di industri hospitality global." data-en="Join thousands of our alumni who have successfully built brilliant careers in the global hospitality industry.">Bergabunglah dengan ribuan alumni kami yang telah berhasil membangun karir gemilang di industri hospitality global.</span>
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4" data-reveal="fade-up" data-delay="200">
                <a class="px-8 py-4 bg-primary text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:opacity-90 transition-opacity" href="/akademi"><span data-id="Jelajahi Program" data-en="Explore Programs">Jelajahi Program</span></a>
                <a class="px-8 py-4 bg-transparent border border-white text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-white hover:text-dhs-navy transition-colors" href="/cara-mendaftar"><span data-id="Daftar Sekarang" data-en="Register Now">Daftar Sekarang</span></a>
            </div>
        </div>
    </section>
@endsection