<?php $__env->startSection('title', 'Tentang Kami — Denpasar Hotel School'); ?>

<?php
    $aboutHero = isset($sections['hero']) ? $sections['hero']->section_content : [];
    $aboutIntro = isset($sections['intro']) ? $sections['intro']->section_content : [];
    $aboutVision = isset($sections['vision']) ? $sections['vision']->section_content : [];
    $aboutTimeline = isset($sections['timeline']) ? $sections['timeline']->section_content : [];
    $aboutDirector = isset($sections['director']) ? $sections['director']->section_content : [];
    $aboutLeader = isset($sections['leader']) ? $sections['leader']->section_content : [];
    $aboutCta = isset($sections['cta']) ? $sections['cta']->section_content : [];

    $heroTitle   = $aboutHero['title'] ?? 'Membangun Pemimpin Hospitality Masa Depan';
    $heroSubtitle= $aboutHero['subtitle'] ?? 'INSTITUSI &amp; WARISAN';
    $heroBgImage = !empty($aboutHero['bgImage']) ? $aboutHero['bgImage'] : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDvULZTmcRw3vX-f-CzNGg8stMRI2Ea5NrSmiyucdED1Ui6mqgK2AmexIratVtInAzxZCCHoL-zzOc0IKiakMVptfS6D7Totb7TxRP3hnBTI6jiqWvMeiM_1-hkImIpVicdfMM6OIO2stFSZu3ragqM52MjEfHpklP14W0JSFCG3J7oNfgCwfP2lub1AqE-vF_htAw-tUtFYRPRud-E7yvapjggWrzGecs_O5JgHck2s4ToD8oRnYCnxg';

    $introLabel = $aboutIntro['label'] ?? 'TENTANG DHS';
    $introHeadline = $aboutIntro['headline'] ?? 'Transforming Into Excellent';
    $introP1 = $aboutIntro['p1'] ?? 'Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri...';
    $introP2 = $aboutIntro['p2'] ?? 'Lembaga ini hadir untuk mengajak mahasiswa belajar sambil bekerja di Australia, Jerman dan Asia Tenggara melalui Partnership Program of DHS, dikenal dengan sebutan PP DHS.';
    $introQuote = $aboutIntro['quote'] ?? '"Mengintegrasikan pendidikan perhotelan dengan dunia industri nyata untuk karir global."';

    $visionVisi = $aboutVision['visi'] ?? 'Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global.';
    $visionMisi = $aboutVision['misi'] ?? [
        'Melaksanakan program pendidikan inovatif sesuai kebutuhan industri.',
        'Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional.',
        'Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara.'
    ];
    $visionCoreValues = $aboutVision['coreValues'] ?? [
        ['title' => 'Integritas (Integrity)', 'desc' => 'DHS memegang teguh visi dan misi guna membentuk insan pariwisata yang kompeten dan berdaya saing.'],
        ['title' => 'Tanggung Jawab (Responsibility)', 'desc' => 'DHS bertanggung jawab menghasilkan lulusan yang sesuai dengan kriteria dunia kerja serta tantangan di masa depan.'],
        ['title' => 'Kualitas (Quality)', 'desc' => 'DHS memberikan pelayanan dan solusi terbaik yang berfokus pada kualitas pembelajaran.']
    ];

    $visionSectionLabel = $aboutVision['sectionLabel'] ?? 'Tujuan Kami';
    $visionSectionTitle = $aboutVision['sectionTitle'] ?? 'Visi, Misi & Core Values';
    $visionVisiLabel    = $aboutVision['visiLabel'] ?? 'Visi';
    $visionMisiLabel    = $aboutVision['misiLabel'] ?? 'Misi';

    $timelineSectionLabel = $aboutTimeline['sectionLabel'] ?? 'Perjalanan Kami';
    $timelineSectionTitle = $aboutTimeline['sectionTitle'] ?? 'Sejarah & Milestone';
    $timelineItems = $aboutTimeline['items'] ?? [
        ['year' => '2005', 'title' => 'DHS Berdiri', 'desc' => 'Denpasar Hotel School didirikan dengan visi membawa standar pendidikan hospitality internasional ke Bali.'],
        ['year' => '2009', 'title' => 'Akreditasi Nasional', 'desc' => 'DHS meraih akreditasi A dari BAN-PT. Sebuah pengakuan atas komitmen kami terhadap kualitas pendidikan.'],
        ['year' => '2013', 'title' => 'Gedung Training Center Baru', 'desc' => 'Peresmian Training Center seluas 4.500 m² dengan dapur profesional, training bar, dan training restaurant.'],
        ['year' => '2017', 'title' => 'MoU dengan Marriott International', 'desc' => 'Penandatanganan MoU strategis dengan Marriott International membuka jalur rekrutmen langsung.'],
        ['year' => '2022', 'title' => 'Program Internasional', 'desc' => 'Peluncuran program exchange mahasiswa dengan sekolah perhotelan di Swiss dan Singapura.'],
        ['year' => '2024', 'title' => 'DHS Hari Ini', 'desc' => '3.000+ alumni tersebar di hotel-hotel terkemuka di 20+ negara.'],
    ];

    $directorP1 = $aboutDirector['p1'] ?? '';
    $directorP2 = $aboutDirector['p2'] ?? '';
    $directorPhoto = !empty($aboutDirector['photo']) ? $aboutDirector['photo'] : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDeYrRiWE5PIngmO86w0Cn5hPsDfiG59HTAVn8-asaEPcvD_fxcdAfcXy_4KR3Pj-pL3DyMS_WN9hCkZFO-lSelGflhgKm5r2oTS_3HJ83ZvydeMvZY_QKmjAItPrh0n3Yvymm1YaFTXkLZpopTGMNQl17m_JEFUai2rxAdUHMzWu383ihOl9jx19ZEtRwSlqf0azKeZNaeaNPVSW6SAXdOP0RroYx1ZflK8JBFkyTsOLiVdTtucCRmxQ';

    $leaderName  = $aboutLeader['name'] ?? 'I Made Dwija Suastana, S.H., M.H.';
    $leaderTitle = $aboutLeader['title'] ?? 'Direktur Denpasar Hotel School';
    $leaderBio   = $aboutLeader['bio'] ?? 'Memimpin Denpasar Hotel School (DHS) dengan komitmen penuh untuk mencetak SDM unggul berdaya saing global.';
    $leaderPhoto = !empty($aboutLeader['photo']) ? $aboutLeader['photo'] : $directorPhoto;

    $ctaTitle  = $aboutCta['title'] ?? 'Jadilah Bagian dari Keluarga DHS';
    $ctaDesc   = $aboutCta['desc'] ?? 'Bergabunglah dengan ribuan alumni kami yang telah berhasil membangun karir gemilang di industri hospitality global.';
    $ctaBtn1   = $aboutCta['btn1Text'] ?? 'Jelajahi Program';
    $ctaBtn1Url = $aboutCta['btn1Url'] ?? '/akademi';
    $ctaBtn2   = $aboutCta['btn2Text'] ?? 'Daftar Sekarang';
    $ctaBtn2Url = $aboutCta['btn2Url'] ?? '/cara-mendaftar';
?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img alt="DHS Campus panoramic view" class="absolute inset-0 w-full h-full object-cover"
            src="<?php echo e($heroBgImage); ?>">

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><span data-id="Tentang Kami" data-en="About Us">Tentang Kami</span></span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-[1.1]">
                <span data-id="<?php echo e($heroTitle); ?>" data-en="<?php echo e($heroTitle); ?>"><?php echo e($heroTitle); ?></span>
            </h1>
            <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/70 font-medium">
                <span data-id="<?php echo e($heroSubtitle); ?>" data-en="<?php echo e($heroSubtitle); ?>"><?php echo $heroSubtitle; ?></span>
            </p>
        </div>
    </section>

    <!-- Tagline / Intro -->
    <section class="bg-white py-20 md:py-28 px-5 md:px-16 max-w-[1280px] mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div data-reveal="fade-right">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                    <span data-id="<?php echo e($introLabel); ?>" data-en="<?php echo e($introLabel); ?>"><?php echo e($introLabel); ?></span>
                </span>
                <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6">
                    <span data-id="<?php echo e($introHeadline); ?>" data-en="<?php echo e($introHeadline); ?>"><?php echo e($introHeadline); ?></span>
                </h2>
                <p class="text-base text-muted-light leading-relaxed mb-6">
                    <span data-id="<?php echo e($introP1); ?>" data-en="<?php echo e($introP1); ?>"><?php echo e($introP1); ?></span>
                </p>
                <p class="text-base text-muted-light leading-relaxed">
                    <span data-id="<?php echo e($introP2); ?>" data-en="<?php echo e($introP2); ?>"><?php echo e($introP2); ?></span>
                </p>
            </div>
            <div class="flex items-center justify-center bg-dhs-cream p-8 text-center h-full" data-reveal="fade-left" data-delay="200">
                <div class="text-muted-light italic text-sm">
                    <span data-id="<?php echo e($introQuote); ?>" data-en="<?php echo e($introQuote); ?>"><?php echo $introQuote; ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="bg-dhs-cream py-20 md:py-24">
        <div class="px-5 md:px-16 max-w-[1280px] mx-auto">
            <div class="text-center mb-16" data-reveal="fade-up">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                    <span data-id="Tujuan Kami" data-en="Our Purpose"><?php echo e($visionSectionLabel); ?></span>
                </span>
                <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">
                    <span data-id="Visi, Misi &amp; Core Values" data-en="Vision, Mission &amp; Core Values"><?php echo e($visionSectionTitle); ?></span>
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="bg-white p-10 shadow-sm" data-reveal="fade-right" data-delay="100">
                    <span class="material-icons text-primary text-4xl mb-6 block">visibility</span>
                    <h3 class="text-[24px] font-semibold font-serif text-text-light mb-4"><span data-id="Visi" data-en="Vision"><?php echo e($visionVisiLabel); ?></span></h3>
                    <p class="text-base text-muted-light leading-relaxed"><span data-id="<?php echo e($visionVisi); ?>" data-en="<?php echo e($visionVisi); ?>"><?php echo e($visionVisi); ?></span></p>
                </div>
                <div class="bg-dhs-navy p-10 shadow-sm" data-reveal="fade-left" data-delay="200">
                    <span class="material-icons text-primary text-4xl mb-6 block">flag</span>
                    <h3 class="text-[24px] font-semibold font-serif text-white mb-4"><span data-id="Misi" data-en="Mission"><?php echo e($visionMisiLabel); ?></span></h3>
                    <ul class="space-y-3 text-white/80 text-base">
                        <?php $__currentLoopData = $visionMisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $misiItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-start"><span class="text-primary mr-2 mt-1">•</span> <span data-id="<?php echo e($misiItem); ?>" data-en="<?php echo e($misiItem); ?>"><?php echo e($misiItem); ?></span></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>

            <div class="bg-white p-10 shadow-sm" data-reveal="zoom-in" data-delay="150">
                <h3 class="text-[24px] font-semibold font-serif text-text-light mb-8 text-center"><span data-id="Core Values (Nilai-Nilai Utama)" data-en="Core Values">Core Values (Nilai-Nilai Utama)</span></h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $visionCoreValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <h4 class="font-bold text-lg text-primary mb-2"><span data-id="<?php echo e($cv['title']); ?>" data-en="<?php echo e($cv['title']); ?>"><?php echo e($cv['title']); ?></span></h4>
                        <p class="text-sm text-muted-light leading-relaxed"><span data-id="<?php echo e($cv['desc']); ?>" data-en="<?php echo e($cv['desc']); ?>"><?php echo e($cv['desc']); ?></span></p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Sejarah Timeline -->
    <section class="py-20 md:py-24 px-5 md:px-16 max-w-[1280px] mx-auto">
        <div class="text-center mb-16" data-reveal="fade-up">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                <span data-id="Perjalanan Kami" data-en="Our Journey"><?php echo e($timelineSectionLabel); ?></span>
            </span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light">
                <span data-id="Sejarah &amp; Milestone" data-en="History &amp; Milestones"><?php echo e($timelineSectionTitle); ?></span>
            </h2>
        </div>
        <div class="relative max-w-3xl mx-auto">
            <div class="absolute left-1/2 top-0 bottom-0 w-px bg-black/10 -translate-x-1/2 hidden md:block"></div>
            <div class="space-y-12">
                <?php $__currentLoopData = $timelineItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex flex-col md:flex-row <?php echo e($i % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse'); ?> items-center gap-8"
                        data-reveal="fade-up" data-delay="<?php echo e($i * 100); ?>">
                        <div class="<?php echo e($i % 2 === 0 ? 'md:text-right' : 'md:text-left'); ?> flex-1">
                            <div class="bg-white p-6 shadow-sm border-l-4 <?php echo e($i % 2 === 0 ? 'border-l-primary' : 'border-l-dhs-navy'); ?> inline-block w-full">
                                <h3 class="text-[20px] font-semibold font-serif text-text-light mb-2"><span data-id="<?php echo e($item['title']); ?>" data-en="<?php echo e($item['title']); ?>"><?php echo e($item['title']); ?></span></h3>
                                <p class="text-base text-muted-light leading-relaxed"><span data-id="<?php echo e($item['desc']); ?>" data-en="<?php echo e($item['desc']); ?>"><?php echo e($item['desc']); ?></span></p>
                            </div>
                        </div>
                        <div class="shrink-0 w-16 h-16 bg-primary text-white flex items-center justify-center font-bold text-sm font-sans z-10 shadow-md"><?php echo e($item['year']); ?></div>
                        <div class="flex-1 hidden md:block"></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Pesan Direktur Section -->
    <section class="bg-white py-20 md:py-24 px-5 md:px-16 max-w-[1280px] mx-auto border-t border-black/5">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-center">
            <div class="md:col-span-1" data-reveal="fade-right">
                <img class="w-full h-auto object-cover border border-black/10" alt="<?php echo e($leaderName); ?>"
                    src="<?php echo e($directorPhoto); ?>">
            </div>
            <div class="md:col-span-2 text-text-light" data-reveal="fade-left" data-delay="200">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                    <span data-id="KATA SAMBUTAN" data-en="WELCOME MESSAGE">KATA SAMBUTAN</span>
                </span>
                <h2 class="text-[32px] font-semibold font-serif mb-6"><span data-id="Pesan Direktur" data-en="Director's Message">Pesan Direktur</span></h2>
                <div class="text-base text-muted-light leading-relaxed space-y-4">
                    <?php if($directorP1): ?>
                    <p><span data-id="<?php echo e($directorP1); ?>" data-en="<?php echo e($directorP1); ?>"><?php echo e($directorP1); ?></span></p>
                    <?php endif; ?>
                    <?php if($directorP2): ?>
                    <p><span data-id="<?php echo e($directorP2); ?>" data-en="<?php echo e($directorP2); ?>"><?php echo e($directorP2); ?></span></p>
                    <?php endif; ?>
                    <p class="font-bold text-primary pt-4">Salam Excellent!<br>— <?php echo e($leaderName); ?> (<span data-id="Direktur" data-en="Director">Direktur</span>)</p>
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
                            alt="<?php echo e($leaderName); ?>"
                            src="<?php echo e($leaderPhoto); ?>">
                    </div>
                    <h3 class="text-[20px] font-semibold font-serif text-text-light mb-1"><?php echo e($leaderName); ?></h3>
                    <p class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-3"><span data-id="<?php echo e($leaderTitle); ?>" data-en="<?php echo e($leaderTitle); ?>"><?php echo e($leaderTitle); ?></span></p>
                    <p class="text-sm text-muted-light leading-relaxed"><span data-id="<?php echo e($leaderBio); ?>" data-en="<?php echo e($leaderBio); ?>"><?php echo e($leaderBio); ?></span></p>
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

        <?php
            $renderCard = function($item) {
                $name = e($item['name'] ?? '');
                $sub  = e($item['sub'] ?? '');
                $font = 'font-sans text-sm font-bold tracking-wider';
                $out = '<div class="bg-white border border-black/10 hover:border-primary/30 hover:shadow-md transition-all duration-300 flex items-center justify-center w-48 h-24 p-4 cursor-default select-none shrink-0 rounded-lg">';
                $out .= '<div class="text-center">';
                $out .= '<div class="' . $font . ' text-dhs-navy">' . $name . '</div>';
                if ($sub) {
                    $out .= '<div class="text-[0.55rem] font-sans tracking-[0.2em] text-muted-light uppercase mt-1">' . $sub . '</div>';
                }
                $out .= '</div></div>';
                return $out;
            };
            $marqueeItems = function($items) use ($renderCard) {
                $out = '';
                foreach ($items as $item) { $out .= $renderCard(['name' => $item['name'], 'sub' => $item['country'] ?? null]); }
                foreach ($items as $item) { $out .= $renderCard(['name' => $item['name'], 'sub' => $item['country'] ?? null]); }
                return $out;
            };
            $mitraIndustri = ($partners ?? collect())->filter(fn($p) => $p->partner_group === 'mitra_industri')->values();
            $partnershipItems = ($partners ?? collect())->filter(fn($p) => $p->partner_group === 'partnership')->values();
        ?>

        <?php if(($partners ?? collect())->count() > 0): ?>
        <div class="space-y-6 select-none">
            
            <?php if($mitraIndustri->count() > 0): ?>
            <div class="marquee-container relative flex overflow-hidden w-full">
                <div class="flex shrink-0 gap-6 py-4 animate-marquee-left">
                    <?php echo $marqueeItems($mitraIndustri); ?>

                </div>
            </div>
            <?php endif; ?>
            
            <?php if($partnershipItems->count() > 0): ?>
            <div class="marquee-container relative flex overflow-hidden w-full">
                <div class="flex shrink-0 gap-6 py-4 animate-marquee-right">
                    <?php echo $marqueeItems($partnershipItems); ?>

                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
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
                <a class="px-8 py-4 bg-primary text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:opacity-90 transition-opacity" href="<?php echo e($ctaBtn1Url); ?>"><span data-id="Jelajahi Program" data-en="Explore Programs"><?php echo e($ctaBtn1); ?></span></a>
                <a class="px-8 py-4 bg-transparent border border-white text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-white hover:text-dhs-navy transition-colors" href="<?php echo e($ctaBtn2Url); ?>"><span data-id="Daftar Sekarang" data-en="Register Now"><?php echo e($ctaBtn2); ?></span></a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/tentang.blade.php ENDPATH**/ ?>