@extends('layouts.app')

@section('title', 'Tentang Kami — Denpasar Hotel School')

@section('content')
<!-- Hero Section -->
<header class="relative pt-32 pb-0 md:pt-48 px-5 md:px-16 max-w-[1280px] mx-auto">
    <div class="mb-8">
        <p class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-muted-light mb-4 flex items-center space-x-2">
            <a class="hover:text-primary transition-colors" href="/">Beranda</a>
            <span class="material-icons text-sm">chevron_right</span>
            <span class="text-text-light">Tentang Kami</span>
        </p>
        <p class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4">Institusi &amp; Warisan</p>
        <h1 class="text-[40px] md:text-[64px] leading-[1.1] tracking-tight font-bold font-serif text-text-light max-w-3xl">Membangun Pemimpin Hospitality Masa Depan</h1>
    </div>
    <div class="relative w-full h-[400px] md:h-[560px] overflow-hidden mt-12">
        <img class="w-full h-full object-cover" alt="DHS Campus panoramic view" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvULZTmcRw3vX-f-CzNGg8stMRI2Ea5NrSmiyucdED1Ui6mqgK2AmexIratVtInAzxZCCHoL-zzOc0IKiakMVptfS6D7Totb7TxRP3hnBTI6jiqWvMeiM_1-hkImIpVicdfMM6OIO2stFSZu3ragqM52MjEfHpklP14W0JSFCG3J7oNfgCwfP2lub1AqE-vF_htAw-tUtFYRPRud-E7yvapjggWrzGecs_O5JgHck2s4ToD8oRnYCnxg">
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
    </div>
</header>

<!-- Tagline / Intro -->
<section class="py-20 md:py-28 px-5 md:px-16 max-w-[1280px] mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div>
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">Tentang DHS</span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6">Transforming Into Excellent</h2>
            <p class="text-base text-muted-light leading-relaxed mb-6">
                Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi. Lembaga ini didirikan untuk memberi kesempatan generasi muda Indonesia menjadi tenaga profesional bidang perhotelan, hospitality, kapal pesiar dan pariwisata.
            </p>
            <p class="text-base text-muted-light leading-relaxed">
                Lembaga ini hadir untuk mengajak mahasiswa belajar sambil bekerja di Australia, Jerman dan Asia Tenggara melalui Partnership Program of DHS, dikenal dengan sebutan PP DHS.
            </p>
        </div>
        <div class="flex items-center justify-center bg-dhs-cream p-8 text-center h-full">
            <!-- TODO: Tambahkan statistik resmi jika sudah dikonfirmasi -->
            <div class="text-muted-light italic text-sm">
                "Mengintegrasikan pendidikan perhotelan dengan dunia industri nyata untuk karir global."
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi -->
<section class="bg-dhs-cream py-20 md:py-24">
    <div class="px-5 md:px-16 max-w-[1280px] mx-auto">
        <div class="text-center mb-16">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">Tujuan Kami</span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">Visi, Misi &amp; Core Values</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div class="bg-white p-10 shadow-sm">
                <span class="material-icons text-primary text-4xl mb-6 block">visibility</span>
                <h3 class="text-[24px] font-semibold font-serif text-text-light mb-4">Visi</h3>
                <p class="text-base text-muted-light leading-relaxed">Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global.</p>
            </div>
            <div class="bg-dhs-navy p-10 shadow-sm">
                <span class="material-icons text-primary text-4xl mb-6 block">flag</span>
                <h3 class="text-[24px] font-semibold font-serif text-white mb-4">Misi</h3>
                <ul class="space-y-3 text-white/80 text-base">
                    <li class="flex items-start"><span class="text-primary mr-2 mt-1">•</span> Melaksanakan program pendidikan inovatif sesuai kebutuhan industri.</li>
                    <li class="flex items-start"><span class="text-primary mr-2 mt-1">•</span> Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional.</li>
                    <li class="flex items-start"><span class="text-primary mr-2 mt-1">•</span> Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara.</li>
                </ul>
            </div>
        </div>

        <div class="bg-white p-10 shadow-sm">
            <h3 class="text-[24px] font-semibold font-serif text-text-light mb-8 text-center">Core Values (Nilai-Nilai Utama)</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="font-bold text-lg text-primary mb-2">Integritas (Integrity)</h4>
                    <p class="text-sm text-muted-light leading-relaxed">DHS memegang teguh visi dan misi guna membentuk insan pariwisata yang kompeten dan berdaya saing.</p>
                </div>
                <div>
                    <h4 class="font-bold text-lg text-primary mb-2">Tanggung Jawab (Responsibility)</h4>
                    <p class="text-sm text-muted-light leading-relaxed">DHS bertanggung jawab menghasilkan lulusan yang sesuai dengan kriteria dunia kerja serta tantangan di masa depan.</p>
                </div>
                <div>
                    <h4 class="font-bold text-lg text-primary mb-2">Kualitas (Quality)</h4>
                    <p class="text-sm text-muted-light leading-relaxed">DHS memberikan pelayanan dan solusi terbaik yang berfokus pada kualitas pembelajaran.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sejarah Timeline -->
<section class="py-20 md:py-24 px-5 md:px-16 max-w-[1280px] mx-auto">
    <div class="text-center mb-16">
        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">Perjalanan Kami</span>
        <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">Sejarah &amp; Milestone</h2>
    </div>
    <div class="relative max-w-3xl mx-auto">
        <div class="absolute left-1/2 top-0 bottom-0 w-px bg-black/10 -translate-x-1/2 hidden md:block"></div>
        <div class="space-y-12">
            @php
            $timeline = [
                ['year' => '2005', 'title' => 'DHS Berdiri', 'desc' => 'Denpasar Hotel School didirikan dengan visi membawa standar pendidikan hospitality internasional ke Bali. Angkatan pertama berjumlah 48 mahasiswa di tiga program.'],
                ['year' => '2009', 'title' => 'Akreditasi Nasional', 'desc' => 'DHS meraih akreditasi A dari BAN-PT. Sebuah pengakuan atas komitmen kami terhadap kualitas pendidikan dan standar institusi.'],
                ['year' => '2013', 'title' => 'Gedung Training Center Baru', 'desc' => 'Peresmian Training Center seluas 4.500 m² dengan dapur profesional, training bar, dan training restaurant berkapasitas 120 kursi.'],
                ['year' => '2017', 'title' => 'MoU dengan Marriott International', 'desc' => 'Penandatanganan MoU strategis dengan Marriott International membuka jalur rekrutmen langsung ke lebih dari 30 properti di Asia Pasifik.'],
                ['year' => '2022', 'title' => 'Program Internasional', 'desc' => 'Peluncuran program exchange mahasiswa dengan sekolah perhotelan di Swiss dan Singapura, memperluas wawasan global mahasiswa DHS.'],
                ['year' => '2024', 'title' => 'DHS Hari Ini', 'desc' => '3.000+ alumni tersebar di hotel-hotel terkemuka di 20+ negara. DHS terus bertumbuh sebagai pusat unggulan pendidikan hospitality di Indonesia.'],
            ];
            @endphp
            @foreach($timeline as $i => $item)
            <div class="flex flex-col md:flex-row {{ $i % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center gap-8">
                <div class="{{ $i % 2 === 0 ? 'md:text-right' : 'md:text-left' }} flex-1">
                    <div class="bg-white p-6 shadow-sm border-l-4 {{ $i % 2 === 0 ? 'border-l-primary' : 'border-l-dhs-navy' }} inline-block w-full">
                        <h3 class="text-[20px] font-semibold font-serif text-text-light mb-2">{{ $item['title'] }}</h3>
                        <p class="text-base text-muted-light leading-relaxed">{{ $item['desc'] }}</p>
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
        <div class="md:col-span-1">
            <img class="w-full h-auto object-cover border border-black/10" alt="I Made Dwija Suastana, S.H., M.H." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDeYrRiWE5PIngmO86w0Cn5hPsDfiG59HTAVn8-asaEPcvD_fxcdAfcXy_4KR3Pj-pL3DyMS_WN9hCkZFO-lSelGflhgKm5r2oTS_3HJ83ZvydeMvZY_QKmjAItPrh0n3Yvymm1YaFTXkLZpopTGMNQl17m_JEFUai2rxAdUHMzWu383ihOl9jx19ZEtRwSlqf0azKeZNaeaNPVSW6SAXdOP0RroYx1ZflK8JBFkyTsOLiVdTtucCRmxQ">
        </div>
        <div class="md:col-span-2 text-text-light">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">KATA SAMBUTAN</span>
            <h2 class="text-[32px] font-semibold font-serif mb-6">Pesan Direktur</h2>
            <div class="text-base text-muted-light leading-relaxed space-y-4">
                <p>"Halo sahabat excellent, Denpasar Hotel School hadir dengan sebuah komitmen untuk mengantarkan calon profesional muda menjadi SDM Indonesia yang unggul dan kompeten."</p>
                <p>"Di Denpasar Hotel School, Anda akan dilatih oleh para praktisi yang telah berpengalaman di bidangnya masing-masing. Mari bergabung bersama kami, Denpasar Hotel School, kami siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global."</p>
                <p class="font-bold text-primary pt-4">Salam Excellent!<br>— I Made Dwija Suastana, S.H., M.H. (Direktur)</p>
            </div>
        </div>
    </div>
</section>

<!-- Tim Kepemimpinan -->
<section class="bg-dhs-cream py-20 md:py-24">
    <div class="px-5 md:px-16 max-w-[1280px] mx-auto">
        <div class="text-center mb-16">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">Orang-Orang di Balik DHS</span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">Tim Kepemimpinan</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-center">
            <div class="group text-center mx-auto md:col-start-2">
                <div class="relative overflow-hidden mb-6 aspect-square max-w-[280px] mx-auto">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="I Made Dwija Suastana" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDeYrRiWE5PIngmO86w0Cn5hPsDfiG59HTAVn8-asaEPcvD_fxcdAfcXy_4KR3Pj-pL3DyMS_WN9hCkZFO-lSelGflhgKm5r2oTS_3HJ83ZvydeMvZY_QKmjAItPrh0n3Yvymm1YaFTXkLZpopTGMNQl17m_JEFUai2rxAdUHMzWu383ihOl9jx19ZEtRwSlqf0azKeZNaeaNPVSW6SAXdOP0RroYx1ZflK8JBFkyTsOLiVdTtucCRmxQ">
                </div>
                <h3 class="text-[20px] font-semibold font-serif text-text-light mb-1">I Made Dwija Suastana, S.H., M.H.</h3>
                <p class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-3">Direktur</p>
                <p class="text-sm text-muted-light leading-relaxed">Memimpin Denpasar Hotel School (DHS) dengan komitmen penuh untuk mencetak SDM unggul berdaya saing global.</p>
            </div>
            <!-- TODO: Tambahkan jajaran pengurus lengkap saat data resmi tersedia -->
        </div>
    </div>
</section>

<!-- Mitra Strategis -->
<section class="py-20 md:py-24 px-5 md:px-16 max-w-[1280px] mx-auto">
    <div class="text-center mb-16">
        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">Jaringan Global</span>
        <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-4">Mitra Industri Kami</h2>
        <p class="text-base text-muted-light max-w-2xl mx-auto">Kolaborasi dengan pemimpin industri global untuk memastikan lulusan DHS mendapatkan akses langsung ke peluang karir terbaik.</p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        @foreach(['The Hotel School Melbourne & Sydney', 'TAFE Australia', 'Ausbildung (Jerman)', 'Bursa SDM Indonesia', 'GCOM Education', 'NEO by ASTON', 'Four Points by Sheraton Ungasan', 'Kuta Paradiso Hotel'] as $partner)
        <div class="flex items-center justify-center p-6 bg-dhs-cream hover:bg-white transition-colors shadow-sm border border-transparent hover:border-black/10 group">
            <span class="text-[0.75rem] uppercase tracking-wider font-semibold text-muted-light group-hover:text-text-light transition-colors text-center">{{ $partner }}</span>
        </div>
        @endforeach
    </div>
</section>

<!-- CTA Section -->
<section class="bg-dhs-navy py-20 md:py-24 px-5 md:px-16">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-white mb-6">Jadilah Bagian dari Keluarga DHS</h2>
        <p class="text-lg text-white/70 mb-10 leading-relaxed">Bergabunglah dengan ribuan alumni kami yang telah berhasil membangun karir gemilang di industri hospitality global.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a class="px-8 py-4 bg-primary text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:opacity-90 transition-opacity" href="/akademi">Jelajahi Program</a>
            {{-- TODO: Route /cara-mendaftar belum dibuat, gunakan placeholder --}}
            <a class="px-8 py-4 bg-transparent border border-white text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-white hover:text-dhs-navy transition-colors" href="/cara-mendaftar">Daftar Sekarang</a>
        </div>
    </div>
</section>
@endsection
