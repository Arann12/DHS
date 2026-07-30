<?php $__env->startSection('title', 'Formulir Pendaftaran — Denpasar Hotel School'); ?>

<?php $__env->startSection('content'); ?>

<?php
$programs = [];
if (isset($categories) && $categories->count() > 0) {
    foreach ($categories as $cat) {
        $programs[$cat->category_key] = [
            'label'   => $cat->category_name,
            'options' => $cat->programs->where('is_active', 1)->pluck('title')->toArray(),
        ];
    }
} else {
    // Default fallback if categories not loaded
    $programs = [
        'internasional' => [
            'label'   => 'Program Internasional',
            'options' => [
                'Program 1 Tahun + Ausbildung Jerman',
                'Program 2 Tahun + 1 Semester TAFE Australia',
                'TAFE Australia Pathway',
                'THS Australia Pathway',
                'Australia Short Course',
                'Study Visit (Australia & Singapura)',
            ]
        ],
        '2-tahun' => [
            'label'   => 'Vokasi 2 Tahun',
            'options' => [
                'Perhotelan (FO & HK) — 2 Tahun',
                'Tata Boga (Culinary Art) — 2 Tahun',
                'Tata Hidangan (FBS & Bartender) — 2 Tahun',
            ]
        ],
        '1-tahun' => [
            'label'   => 'Vokasi 1 Tahun',
            'options' => [
                'Perhotelan (FO & HK) — 1 Tahun',
                'Tata Boga (Culinary Art) — 1 Tahun',
                'Tata Hidangan (FBS & Bartender) — 1 Tahun',
            ]
        ],
        '1-tahun-kapal-pesiar' => [
            'label'   => '1 Tahun Kapal Pesiar',
            'options' => [
                'Cook (Asisten Koki) — Kapal Pesiar',
                'Waiter & Bartender — Kapal Pesiar',
                'Hotel Steward — Kapal Pesiar',
            ]
        ],
        '6-bulan' => [
            'label'   => 'Short Course 6 Bulan',
            'options' => [
                'Perhotelan (FO & HK) — 6 Bulan',
                'Tata Boga (Culinary Art) — 6 Bulan',
                'Tata Hidangan (FBS & Bartender) — 6 Bulan',
            ]
        ],
        'eksekutif' => [
            'label'   => 'Program Eksekutif (6 Bln)',
            'options' => [
                'FBS & Bar (Cruise Line)',
                'Hotel Steward (Cruise Line)',
                'Cook (Cruise Line)',
                'Flair Bartending & Sommelier',
                'Butler',
                'SPA Therapist',
            ]
        ],
    ];
}
?>

<!-- Hero Section -->
<section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden">
    <div class="absolute inset-0 bg-black/55 z-10"></div>
    <img alt="DHS Registration" class="absolute inset-0 w-full h-full object-cover"
        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxn2eqm_jRIxoqtBqU_Z4510mT8Oum1XJuCt3B4qsnaur1kOxl1kswsTUDy_IWkop-w6gCJC9c4z-J1rwUSX4qHaSazUfu4x09voqcT3DY8fhiWkEHZcuUOZBNOolJHzCrNRQQXlB6UNrMOsC2_nhrMbSl_DzCpEu5YNeYXrmzbkHsYKIWxKH0th79FkaqCRHftpuCaHJyYzxate_qQzEmQcWi4iGgWxF-wIUFQGCYA83w8lUepgu6VQ">

    <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
        <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
            <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
            <span class="material-icons text-sm text-white/40">chevron_right</span>
            <span class="text-white font-bold"><span data-id="Formulir Pendaftaran" data-en="Registration Form">Formulir Pendaftaran</span></span>
        </div>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-[1.1]">
            <span data-id="Program &amp; Formulir Pendaftaran" data-en="Programs &amp; Registration Form">Program & Formulir Pendaftaran</span>
        </h1>
        <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/70 font-medium">
            <span data-id="Pilih Program Studi &amp; Daftarkan Diri Anda Secara Online" data-en="Choose Your Study Program &amp; Register Online">Pilih Program Studi & Daftarkan Diri Anda Secara Online</span>
        </p>
    </div>
</section>

<!-- Main Content with 2-Level Filter & Program Catalog -->
<main class="pt-16 pb-24">
    <!-- Category Duration Filter -->
    <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-12" data-reveal="fade-up">
        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block"><span data-id="PILIH KATEGORI DURASI PROGRAM" data-en="SELECT PROGRAM DURATION CATEGORY">PILIH KATEGORI DURASI PROGRAM</span></span>
        <div class="flex flex-wrap gap-3 border-b border-black/10 pb-6" id="reg-filter-tabs">
            <button class="filter-tab-btn px-5 py-2.5 bg-dhs-navy text-white text-[0.75rem] uppercase tracking-[0.12em] font-semibold transition-all" data-target="internasional">Program Internasional</button>
            <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="2-tahun">Vokasi 2 Tahun</button>
            <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="1-tahun">Vokasi 1 Tahun</button>
            <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="1-tahun-kapal-pesiar">1 Tahun Kapal Pesiar</button>
            <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="6-bulan">Short Course 6 Bulan</button>
            <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="eksekutif">Program Eksekutif (6 Bln)</button>
        </div>
    </section>

    <!-- Content Sections per Category -->
    <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-16" data-reveal="fade-up" data-delay="150">
        <!-- Category: Program Internasional -->
        <div class="category-content-panel active" id="panel-internasional">
            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-10 items-start">
                <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block">GLOBAL OPPORTUNITY</span>
                    <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight">Program Internasional</h2>
                    <p class="text-sm text-muted-light leading-relaxed mb-6">
                        DHS bekerjasama dengan The Hotel School Melbourne & Sydney dan TAFE Australia untuk menyalurkan peserta didik DHS yang berminat lanjut untuk melaksanakan pendidikan di luar negeri.
                    </p>
                    <div class="pt-4 border-t border-black/10">
                        <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">Peluang Kerja Lulusan:</p>
                        <p class="text-xs text-muted-light leading-relaxed">Hotel Staff, Restaurant Staff, Instruktur LKP/LPK, Wirausaha.</p>
                    </div>
                </div>

                <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = [
                        ['title' => 'Program 1 Tahun + Ausbildung Jerman', 'country' => '🇩🇪 JERMAN', 'desc' => 'Pelatihan intensif 1 tahun di kampus dilanjutkan program penempatan Ausbildung kerja di Jerman.', 'img' => 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?auto=format&fit=crop&w=800&h=600&q=80'],
                        ['title' => 'Program 2 Tahun + 1 Semester TAFE Australia', 'country' => '🇦🇺 AUSTRALIA', 'desc' => 'Studi komprehensif di Bali dengan transfer kredit 1 semester di TAFE Australia.', 'img' => 'https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?auto=format&fit=crop&w=800&h=600&q=80'],
                        ['title' => 'TAFE Australia Pathway', 'country' => '🇦🇺 AUSTRALIA', 'desc' => 'Program penyaluran langsung menuju perkuliahan TAFE di Australia.', 'img' => 'https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?auto=format&fit=crop&w=800&h=600&q=80'],
                        ['title' => 'THS Australia Pathway', 'country' => '🇦🇺 AUSTRALIA', 'desc' => 'Jalur studi khusus berpartner dengan The Hotel School Sydney & Melbourne.', 'img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&h=600&q=80'],
                        ['title' => 'Australia Short Course', 'country' => '🇦🇺 AUSTRALIA', 'desc' => 'Pelatihan praktis jangka pendek terfokus langsung di Australia.', 'img' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&h=600&q=80'],
                        ['title' => 'Study Visit (Australia & Singapura)', 'country' => '🇸🇬 SINGAPURA & 🇦🇺 AUSTRALIA', 'desc' => 'Kunjungan edukasi dan familiarisasi hotel mewah langsung ke Australia atau Singapura.', 'img' => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=800&h=600&q=80']
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full">
                        <div class="relative overflow-hidden h-44 shrink-0">
                            <img src="<?php echo e($course['img']); ?>" alt="<?php echo e($course['title']); ?>" class="w-full h-full object-cover">
                            <span class="absolute top-3 right-3 bg-dhs-navy/90 text-white text-[10px] font-bold px-2.5 py-1 rounded"><?php echo e($course['country']); ?></span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-serif font-bold text-base text-dhs-navy mb-2 leading-snug"><?php echo e($course['title']); ?></h3>
                                <p class="text-xs text-muted-light leading-relaxed mb-4"><?php echo e($course['desc']); ?></p>
                            </div>
                            <button type="button" onclick="selectProgram('internasional', '<?php echo e($course['title']); ?>')"
                                class="w-full py-2.5 bg-dhs-navy/5 hover:bg-primary hover:text-white border border-dhs-navy/20 text-dhs-navy text-xs font-semibold rounded transition-all flex items-center justify-center gap-2">
                                <span class="material-icons" style="font-size:16px;">edit_note</span>
                                Pilih & Daftar Program Ini
                            </button>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Category: Vokasi 2 Tahun -->
        <div class="category-content-panel hidden" id="panel-2-tahun">
            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-10 items-start">
                <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block">PROGRAM VOKASI</span>
                    <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight">Vokasi 2 Tahun</h2>
                    <p class="text-sm text-muted-light leading-relaxed mb-6">
                        Memiliki jurusan FB Service Bartender, Perhotelan dan Culinary Arts dengan jaminan penempatan OJT di Hotel Bintang 4 & 5.
                    </p>
                    <div class="pt-4 border-t border-black/10">
                        <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">Peluang Kerja Lulusan:</p>
                        <p class="text-xs text-muted-light leading-relaxed">Hotel Staff, Restaurant Staff, Barista, Chef/Cook, Entrepreneur.</p>
                    </div>
                </div>

                <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = [
                        ['title' => 'Perhotelan (FO & HK) — 2 Tahun', 'badge' => '2 TAHUN', 'desc' => 'Fokus pada operasional Front Office dan Housekeeping berstandar hotel bintang 5.', 'img' => 'https://images.pexels.com/photos/5371676/pexels-photo-5371676.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'Tata Boga (Culinary Art) — 2 Tahun', 'badge' => '2 TAHUN', 'desc' => 'Mengembangkan keahlian memasak masakan internasional dan lokal dengan standar kebersihan tinggi.', 'img' => 'https://images.pexels.com/photos/15323383/pexels-photo-15323383.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'Tata Hidangan (FBS & Bartender) — 2 Tahun', 'badge' => '2 TAHUN', 'desc' => 'Seni pelayanan makanan, minuman, mixology, dan hospitality service terapan.', 'img' => 'https://images.pexels.com/photos/4485382/pexels-photo-4485382.jpeg?auto=compress&cs=tinysrgb&w=800']
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full">
                        <div class="relative overflow-hidden h-44 shrink-0">
                            <img src="<?php echo e($course['img']); ?>" alt="<?php echo e($course['title']); ?>" class="w-full h-full object-cover">
                            <span class="absolute top-3 right-3 bg-dhs-navy/90 text-white text-[10px] font-bold px-2.5 py-1 rounded"><?php echo e($course['badge']); ?></span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-serif font-bold text-base text-dhs-navy mb-2 leading-snug"><?php echo e($course['title']); ?></h3>
                                <p class="text-xs text-muted-light leading-relaxed mb-4"><?php echo e($course['desc']); ?></p>
                            </div>
                            <button type="button" onclick="selectProgram('2-tahun', '<?php echo e($course['title']); ?>')"
                                class="w-full py-2.5 bg-dhs-navy/5 hover:bg-primary hover:text-white border border-dhs-navy/20 text-dhs-navy text-xs font-semibold rounded transition-all flex items-center justify-center gap-2">
                                <span class="material-icons" style="font-size:16px;">edit_note</span>
                                Pilih & Daftar Program Ini
                            </button>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Category: Vokasi 1 Tahun -->
        <div class="category-content-panel hidden" id="panel-1-tahun">
            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-10 items-start">
                <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block">PROGRAM VOKASI</span>
                    <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight">Vokasi 1 Tahun</h2>
                    <p class="text-sm text-muted-light leading-relaxed mb-6">
                        Dirancang untuk persiapan kilat memasuki industri perhotelan bintang 4 & 5 serta kapal pesiar.
                    </p>
                    <div class="pt-4 border-t border-black/10">
                        <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">Peluang Kerja Lulusan:</p>
                        <p class="text-xs text-muted-light leading-relaxed">Hotel Staff, Restaurant Staff, Barista, Assistant Cook, Entrepreneur.</p>
                    </div>
                </div>

                <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = [
                        ['title' => 'Perhotelan (FO & HK) — 1 Tahun', 'badge' => '1 TAHUN', 'desc' => 'Teori terfokus dan penempatan praktis di Front Office & Housekeeping.', 'img' => 'https://images.pexels.com/photos/5371676/pexels-photo-5371676.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'Tata Boga (Culinary Art) — 1 Tahun', 'badge' => '1 TAHUN', 'desc' => 'Fondasi dasar teknik kuliner, penanganan bahan makanan, dan sanitasi.', 'img' => 'https://images.pexels.com/photos/15323383/pexels-photo-15323383.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'Tata Hidangan (FBS & Bartender) — 1 Tahun', 'badge' => '1 TAHUN', 'desc' => 'Dasar pelayanan restoran, pengetahuan menu, dan keterampilan bar.', 'img' => 'https://images.pexels.com/photos/4485382/pexels-photo-4485382.jpeg?auto=compress&cs=tinysrgb&w=800']
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full">
                        <div class="relative overflow-hidden h-44 shrink-0">
                            <img src="<?php echo e($course['img']); ?>" alt="<?php echo e($course['title']); ?>" class="w-full h-full object-cover">
                            <span class="absolute top-3 right-3 bg-dhs-navy/90 text-white text-[10px] font-bold px-2.5 py-1 rounded"><?php echo e($course['badge']); ?></span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-serif font-bold text-base text-dhs-navy mb-2 leading-snug"><?php echo e($course['title']); ?></h3>
                                <p class="text-xs text-muted-light leading-relaxed mb-4"><?php echo e($course['desc']); ?></p>
                            </div>
                            <button type="button" onclick="selectProgram('1-tahun', '<?php echo e($course['title']); ?>')"
                                class="w-full py-2.5 bg-dhs-navy/5 hover:bg-primary hover:text-white border border-dhs-navy/20 text-dhs-navy text-xs font-semibold rounded transition-all flex items-center justify-center gap-2">
                                <span class="material-icons" style="font-size:16px;">edit_note</span>
                                Pilih & Daftar Program Ini
                            </button>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Category: 1 Tahun Kapal Pesiar -->
        <div class="category-content-panel hidden" id="panel-1-tahun-kapal-pesiar">
            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-10 items-start">
                <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block">PROGRAM KAPAL PESIAR</span>
                    <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight">1 Tahun Kapal Pesiar</h2>
                    <p class="text-sm text-muted-light leading-relaxed mb-6">
                        Program akselerasi 1 tahun yang difokuskan untuk persiapan bekerja secara profesional di departemen F&B dan housekeeping kapal pesiar.
                    </p>
                    <div class="pt-4 border-t border-black/10">
                        <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">Peluang Kerja Lulusan:</p>
                        <p class="text-xs text-muted-light leading-relaxed">Cruise Ship Cook, Waiter/Waitress, Cabin Steward, Galley Utility.</p>
                    </div>
                </div>

                <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = [
                        ['title' => 'Cook (Asisten Koki) — Kapal Pesiar', 'badge' => 'KAPAL PESIAR', 'desc' => 'Praktek dapur intensif untuk menyiapkan menu cruise line internasional.', 'img' => 'https://images.pexels.com/photos/16140004/pexels-photo-16140004.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'Waiter & Bartender — Kapal Pesiar', 'badge' => 'KAPAL PESIAR', 'desc' => 'Layanan restoran mewah & pencampuran minuman tingkat lanjut untuk bar kapal pesiar.', 'img' => 'https://images.pexels.com/photos/19300593/pexels-photo-19300593.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'Hotel Steward — Kapal Pesiar', 'badge' => 'KAPAL PESIAR', 'desc' => 'Manajemen kebersihan, tata graha, dan penataan kamar di kabin kapal pesiar mewah.', 'img' => 'https://images.pexels.com/photos/6466213/pexels-photo-6466213.jpeg?auto=compress&cs=tinysrgb&w=800']
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full">
                        <div class="relative overflow-hidden h-44 shrink-0">
                            <img src="<?php echo e($course['img']); ?>" alt="<?php echo e($course['title']); ?>" class="w-full h-full object-cover">
                            <span class="absolute top-3 right-3 bg-dhs-navy/90 text-white text-[10px] font-bold px-2.5 py-1 rounded"><?php echo e($course['badge']); ?></span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-serif font-bold text-base text-dhs-navy mb-2 leading-snug"><?php echo e($course['title']); ?></h3>
                                <p class="text-xs text-muted-light leading-relaxed mb-4"><?php echo e($course['desc']); ?></p>
                            </div>
                            <button type="button" onclick="selectProgram('1-tahun-kapal-pesiar', '<?php echo e($course['title']); ?>')"
                                class="w-full py-2.5 bg-dhs-navy/5 hover:bg-primary hover:text-white border border-dhs-navy/20 text-dhs-navy text-xs font-semibold rounded transition-all flex items-center justify-center gap-2">
                                <span class="material-icons" style="font-size:16px;">edit_note</span>
                                Pilih & Daftar Program Ini
                            </button>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Category: Short Course 6 Bulan -->
        <div class="category-content-panel hidden" id="panel-6-bulan">
            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-10 items-start">
                <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block">KURSUS SINGKAT</span>
                    <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight">Short Course 6 Bulan</h2>
                    <p class="text-sm text-muted-light leading-relaxed mb-6">
                        Program singkat diperuntukan untuk peserta didik yang berniat menambah ilmu di bidang spesifik dengan mengutamakan praktek langsung.
                    </p>
                    <div class="pt-4 border-t border-black/10">
                        <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">Peluang Kerja Lulusan:</p>
                        <p class="text-xs text-muted-light leading-relaxed">Barista, Commis Chef, Restaurant Server, Housekeeping Attendant.</p>
                    </div>
                </div>

                <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = [
                        ['title' => 'Perhotelan (FO & HK) — 6 Bulan', 'badge' => '6 BULAN', 'desc' => 'Pelatihan kilat siap kerja Front Office & Housekeeping.', 'img' => 'https://images.pexels.com/photos/5371676/pexels-photo-5371676.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'Tata Boga (Culinary Art) — 6 Bulan', 'badge' => '6 BULAN', 'desc' => 'Praktek kuliner dasar terfokus untuk keterampilan masak praktis.', 'img' => 'https://images.pexels.com/photos/15323383/pexels-photo-15323383.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'Tata Hidangan (FBS & Bartender) — 6 Bulan', 'badge' => '6 BULAN', 'desc' => 'Latihan barista, bartending dasar, dan pelayanan hidangan restoran.', 'img' => 'https://images.pexels.com/photos/4485382/pexels-photo-4485382.jpeg?auto=compress&cs=tinysrgb&w=800']
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full">
                        <div class="relative overflow-hidden h-44 shrink-0">
                            <img src="<?php echo e($course['img']); ?>" alt="<?php echo e($course['title']); ?>" class="w-full h-full object-cover">
                            <span class="absolute top-3 right-3 bg-dhs-navy/90 text-white text-[10px] font-bold px-2.5 py-1 rounded"><?php echo e($course['badge']); ?></span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-serif font-bold text-base text-dhs-navy mb-2 leading-snug"><?php echo e($course['title']); ?></h3>
                                <p class="text-xs text-muted-light leading-relaxed mb-4"><?php echo e($course['desc']); ?></p>
                            </div>
                            <button type="button" onclick="selectProgram('6-bulan', '<?php echo e($course['title']); ?>')"
                                class="w-full py-2.5 bg-dhs-navy/5 hover:bg-primary hover:text-white border border-dhs-navy/20 text-dhs-navy text-xs font-semibold rounded transition-all flex items-center justify-center gap-2">
                                <span class="material-icons" style="font-size:16px;">edit_note</span>
                                Pilih & Daftar Program Ini
                            </button>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Category: Program Eksekutif -->
        <div class="category-content-panel hidden" id="panel-eksekutif">
            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-10 items-start">
                <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block">PROGRAM EKSEKUTIF</span>
                    <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight">Program Eksekutif</h2>
                    <p class="text-sm text-muted-light leading-relaxed mb-6">
                        Program khusus 6 bulan kapal pesiar dengan berbagai fasilitas bonus menarik untuk akselerasi karir maritim instan.
                    </p>
                    <div class="pt-4 border-t border-black/10">
                        <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">Peluang Kerja Lulusan:</p>
                        <p class="text-xs text-muted-light leading-relaxed">Cruise Line Cook, Cruise Line Bartender, Butler, Spa Therapist.</p>
                    </div>
                </div>

                <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = [
                        ['title' => 'FBS & Bar (Cruise Line)', 'badge' => 'EKSEKUTIF', 'desc' => 'Bonus: Free Bottle Shaker Flair untuk praktek atraksi bar.', 'img' => 'https://images.pexels.com/photos/19674104/pexels-photo-19674104.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'Hotel Steward (Cruise Line)', 'badge' => 'EKSEKUTIF', 'desc' => 'Fokus manajemen housekeeping intensif di atas kapal pesiar.', 'img' => 'https://images.pexels.com/photos/6466213/pexels-photo-6466213.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'Cook (Cruise Line)', 'badge' => 'EKSEKUTIF', 'desc' => 'Bonus: Free Passport & Seaman Book (Buku Pelaut) resmi.', 'img' => 'https://images.pexels.com/photos/32176062/pexels-photo-32176062.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'Flair Bartending & Sommelier', 'badge' => 'EKSEKUTIF', 'desc' => 'Pendidikan bartender atraksi & spesialis wawasan minuman anggur.', 'img' => 'https://images.pexels.com/photos/87224/pexels-photo-87224.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'Butler', 'badge' => 'EKSEKUTIF', 'desc' => 'Pelayanan eksklusif personal. Bonus: Free Driving Licence (SIM).', 'img' => 'https://images.pexels.com/photos/5371583/pexels-photo-5371583.jpeg?auto=compress&cs=tinysrgb&w=800'],
                        ['title' => 'SPA Therapist', 'badge' => 'EKSEKUTIF', 'desc' => 'Seni pijat relaksasi dan terapi spa berkualitas hotel bintang lima.', 'img' => 'https://images.pexels.com/photos/9146364/pexels-photo-9146364.jpeg?auto=compress&cs=tinysrgb&w=800']
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full">
                        <div class="relative overflow-hidden h-44 shrink-0">
                            <img src="<?php echo e($course['img']); ?>" alt="<?php echo e($course['title']); ?>" class="w-full h-full object-cover">
                            <span class="absolute top-3 right-3 bg-dhs-navy/90 text-white text-[10px] font-bold px-2.5 py-1 rounded"><?php echo e($course['badge']); ?></span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-serif font-bold text-base text-dhs-navy mb-2 leading-snug"><?php echo e($course['title']); ?></h3>
                                <p class="text-xs text-muted-light leading-relaxed mb-4"><?php echo e($course['desc']); ?></p>
                            </div>
                            <button type="button" onclick="selectProgram('eksekutif', '<?php echo e($course['title']); ?>')"
                                class="w-full py-2.5 bg-dhs-navy/5 hover:bg-primary hover:text-white border border-dhs-navy/20 text-dhs-navy text-xs font-semibold rounded transition-all flex items-center justify-center gap-2">
                                <span class="material-icons" style="font-size:16px;">edit_note</span>
                                Pilih & Daftar Program Ini
                            </button>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- FORMULIR PENDAFTARAN (CLEAN CARD) -->
    <section class="max-w-[850px] mx-auto px-5 scroll-mt-24" id="form-pendaftaran">
        <div class="bg-white border border-black/10 rounded-2xl p-8 md:p-12 shadow-md">
            
            <div class="text-center mb-10">
                <span class="text-[0.7rem] uppercase tracking-[0.2em] font-bold text-primary mb-2 block"><span data-id="PENDAFTARAN ONLINE" data-en="ONLINE REGISTRATION">PENDAFTARAN ONLINE</span></span>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-dhs-navy mb-3"><span data-id="FORMULIR PENDAFTARAN DENPASAR HOTEL SCHOOL" data-en="DENPASAR HOTEL SCHOOL REGISTRATION FORM">FORMULIR PENDAFTARAN DENPASAR HOTEL SCHOOL</span></h2>
                <p class="text-sm text-muted-light max-w-xl mx-auto">
                    <span data-id="Silakan lengkapi formulir pendaftaran di bawah ini. Tim admisi DHS akan segera menghubungi Anda." data-en="Please complete the registration form below. The DHS admissions team will contact you shortly.">Silakan lengkapi formulir pendaftaran di bawah ini. Tim admisi DHS akan segera menghubungi Anda.</span>
                </p>
            </div>

            <?php if(session('reg_success')): ?>
            <div class="bg-green-50 border border-green-200 rounded-xl p-5 mb-8 flex gap-3 items-start">
                <span class="material-icons text-green-500 mt-0.5">check_circle</span>
                <div>
                    <p class="font-semibold text-green-800">Pendaftaran Berhasil Dikirim!</p>
                    <p class="text-sm text-green-700 mt-1"><?php echo e(session('reg_success')); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
            <div class="bg-red-50 border border-red-200 rounded-xl p-5 mb-8">
                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endif; ?>

            <form action="/pendaftaran" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2"><span data-id="Nama Lengkap" data-en="Full Name">Nama Lengkap</span> <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" value="<?php echo e(old('nama_lengkap')); ?>"
                        placeholder="Masukkan nama lengkap Anda"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required>
                </div>

                <!-- HP/WA -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2"><span data-id="HP / WA" data-en="Phone / WhatsApp">HP / WA</span> <span class="text-red-500">*</span></label>
                    <input type="tel" name="hp_wa" value="<?php echo e(old('hp_wa')); ?>"
                        placeholder="08xxxxxxxxxx (aktif di WhatsApp)"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all <?php $__errorArgs = ['hp_wa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2"><span data-id="Email" data-en="Email">Email</span> <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                        placeholder="alamat@email.com"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required>
                </div>

                <!-- Pilih Kategori Durasi -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2"><span data-id="Pilih Kategori Durasi" data-en="Select Duration Category">Pilih Kategori Durasi</span> <span class="text-red-500">*</span></label>
                    <select name="kategori" id="reg-kategori"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all bg-white cursor-pointer <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required>
                        <option value="" disabled selected>-- Pilih Kategori Durasi --</option>
                        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(old('kategori') === $key ? 'selected' : ''); ?>><?php echo e($cat['label']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Daftar Program -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2"><span data-id="Daftar Program" data-en="Select Program">Daftar Program</span> <span class="text-red-500">*</span></label>
                    <select name="program" id="reg-program"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all bg-white cursor-pointer <?php $__errorArgs = ['program'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required>
                        <option value="" disabled selected>-- Pilih program setelah memilih kategori --</option>
                    </select>
                    <script id="programs-data" type="application/json"><?php echo json_encode($programs, 15, 512) ?></script>
                </div>

                <!-- Special Request -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2"><span data-id="Special Request" data-en="Special Request">Special Request</span></label>
                    <textarea name="special_request" rows="3"
                        placeholder="tuliskan hal yang Denpasar Hotel School perlu tindak lanjuti, misalnya hari, waktu dan lainnya"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all resize-none"><?php echo e(old('special_request')); ?></textarea>
                </div>

                <!-- Unggah Bukti Biaya Pendaftaran -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-1"><span data-id="Unggah Bukti Biaya Pendaftaran (jika ada)" data-en="Upload Registration Fee Proof (if applicable)">Unggah Bukti Biaya Pendaftaran (jika ada)</span></label>
                    <p class="text-xs text-muted-light mb-2">note: size file max 2mb</p>
                    <div class="border-2 border-dashed border-black/15 rounded-lg px-4 py-4 flex items-center gap-3 hover:border-primary/40 transition-colors cursor-pointer" onclick="document.getElementById('bukti_pendaftaran').click()">
                        <span class="material-icons text-muted-light">upload_file</span>
                        <div class="flex-1">
                            <input type="file" id="bukti_pendaftaran" name="bukti_pendaftaran" accept=".jpg,.jpeg,.png,.pdf"
                                class="hidden" onchange="showFileName(this, 'label-pendaftaran')">
                            <span id="label-pendaftaran" class="text-sm text-muted-light">Choose File | No file chosen</span>
                        </div>
                    </div>
                </div>

                <!-- Unggah Bukti Biaya Program -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-1"><span data-id="Unggah Bukti Biaya Program (jika ada)" data-en="Upload Program Fee Proof (if applicable)">Unggah Bukti Biaya Program (jika ada)</span></label>
                    <p class="text-xs text-muted-light mb-2">note: size file max 2mb</p>
                    <div class="border-2 border-dashed border-black/15 rounded-lg px-4 py-4 flex items-center gap-3 hover:border-primary/40 transition-colors cursor-pointer" onclick="document.getElementById('bukti_program').click()">
                        <span class="material-icons text-muted-light">upload_file</span>
                        <div class="flex-1">
                            <input type="file" id="bukti_program" name="bukti_program" accept=".jpg,.jpeg,.png,.pdf"
                                class="hidden" onchange="showFileName(this, 'label-program')">
                            <span id="label-program" class="text-sm text-muted-light">Choose File | No file chosen</span>
                        </div>
                    </div>
                </div>

                <!-- Informasi Diperoleh Dari -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-3"><span data-id="Informasi tentang Denpasar Hotel School diperoleh dari:" data-en="How did you hear about Denpasar Hotel School?">Informasi tentang Denpasar Hotel School diperoleh dari:</span></label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <?php $__currentLoopData = ['Keluarga', 'Teman', 'Lembaga Tempat Belajar atau Kerja', 'Media Sosial', 'Situs Denpasar Hotel School', 'Pameran Pendidikan', 'Lainnya']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $src): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="sumber_info[]" value="<?php echo e($src); ?>"
                                class="w-4 h-4 accent-primary"
                                <?php echo e(in_array($src, old('sumber_info', [])) ? 'checked' : ''); ?>>
                            <span class="text-sm text-text-light group-hover:text-primary transition-colors"><?php echo e($src); ?></span>
                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Form Action Buttons -->
                <div class="flex justify-end gap-3 pt-6 border-t border-black/10">
                    <button type="reset" onclick="resetFormState()"
                        class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 border border-black/10 text-text-light text-xs font-semibold rounded transition-all">
                        <span data-id="Batal" data-en="Cancel">Batal</span>
                    </button>
                    <button type="submit"
                        class="px-7 py-2.5 bg-dhs-navy hover:bg-primary text-white text-xs font-semibold rounded transition-all shadow-sm">
                        <span data-id="Kirim" data-en="Submit">Kirim</span>
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>


<?php
    $waNum = $helpdesk['helpdesk_wa'] ?? '+62 81 246 319966';
    $waClean = preg_replace('/[^0-9]/', '', $waNum);
    if (str_starts_with($waClean, '0')) {
        $waClean = '62' . substr($waClean, 1);
    }
    $emailAddr = $helpdesk['helpdesk_email'] ?? 'sahabat@dhs.or.id';
    $serviceHours = $helpdesk['helpdesk_hours'] ?? 'Senin – Sabtu: 08:00 – 17:00 WITA';
?>
<section class="py-16 px-6 md:px-16">
    <div class="max-w-[850px] mx-auto">
        <div class="bg-white border border-black/10 rounded-2xl p-8 md:p-10 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center gap-8">
                <div class="flex-1">
                    <span class="text-[0.7rem] uppercase tracking-[0.2em] font-bold text-primary mb-2 block"><span data-id="BUTUH BANTUAN?" data-en="NEED HELP?">BUTUH BANTUAN?</span></span>
                    <h3 class="text-2xl md:text-3xl font-serif font-bold text-dhs-navy mb-2 leading-tight"><span data-id="Hubungi Tim Admisi" data-en="Contact Admissions Team">Hubungi Tim Admisi</span></h3>
                    <p class="text-sm text-muted-light"><span data-id="Tim helpdesk kami siap menjawab pertanyaan Anda seputar program dan pendaftaran." data-en="Our helpdesk team is ready to answer your questions about programs and registration.">Tim helpdesk kami siap menjawab pertanyaan Anda seputar program dan pendaftaran.</span></p>
                </div>
                <div class="flex flex-col gap-4 md:min-w-[260px]">
                    
                    <a href="https://wa.me/<?php echo e($waClean); ?>" target="_blank"
                        class="flex items-center gap-4 p-4 border border-black/10 rounded-xl hover:border-primary/40 hover:shadow-md transition-all group">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-icons text-green-600 text-xl">chat</span>
                        </div>
                        <div>
                            <p class="text-[0.65rem] uppercase tracking-widest text-muted-light font-semibold">WhatsApp</p>
                            <p class="text-sm font-bold text-dhs-navy group-hover:text-primary transition-colors"><?php echo e($waNum); ?></p>
                        </div>
                    </a>
                    
                    <a href="mailto:<?php echo e($emailAddr); ?>"
                        class="flex items-center gap-4 p-4 border border-black/10 rounded-xl hover:border-primary/40 hover:shadow-md transition-all group">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-icons text-blue-600 text-xl">email</span>
                        </div>
                        <div>
                            <p class="text-[0.65rem] uppercase tracking-widest text-muted-light font-semibold">Email</p>
                            <p class="text-sm font-bold text-dhs-navy group-hover:text-primary transition-colors"><?php echo e($emailAddr); ?></p>
                        </div>
                    </a>
                    
                    <div class="flex items-center gap-4 p-4 border border-black/10 rounded-xl bg-background-light">
                        <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-icons text-amber-600 text-xl">schedule</span>
                        </div>
                        <div>
                            <p class="text-[0.65rem] uppercase tracking-widest text-muted-light font-semibold">Jam Pelayanan</p>
                            <p class="text-sm font-bold text-dhs-navy"><?php echo e($serviceHours); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
const programsData = JSON.parse(document.getElementById('programs-data').textContent);

// Tab Filter Switching
document.querySelectorAll('#reg-filter-tabs .filter-tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const target = this.dataset.target;

        // Active tab styling
        document.querySelectorAll('#reg-filter-tabs .filter-tab-btn').forEach(b => {
            b.classList.remove('bg-dhs-navy', 'text-white');
            b.classList.add('bg-transparent', 'border', 'border-black/20', 'text-text-light');
        });
        this.classList.remove('bg-transparent', 'border', 'border-black/20', 'text-text-light');
        this.classList.add('bg-dhs-navy', 'text-white');

        // Show content panel per category
        document.querySelectorAll('.category-content-panel').forEach(p => {
            if (p.id === 'panel-' + target) {
                p.classList.remove('hidden');
                p.classList.add('active');
            } else {
                p.classList.add('hidden');
                p.classList.remove('active');
            }
        });

        // Sync dropdown
        const select = document.getElementById('reg-kategori');
        select.value = target;
        updateProgramOptions(target);
    });
});

// Dropdown Kategori Change
document.getElementById('reg-kategori').addEventListener('change', function() {
    updateProgramOptions(this.value);

    // Sync tab button
    const target = this.value;
    document.querySelectorAll('#reg-filter-tabs .filter-tab-btn').forEach(btn => {
        if (btn.dataset.target === target) {
            btn.click();
        }
    });
});

function updateProgramOptions(kategori, selectedProgram = null) {
    const programSelect = document.getElementById('reg-program');
    programSelect.innerHTML = '<option value="" disabled selected>-- Pilih program --</option>';

    if (programsData[kategori]) {
        programsData[kategori].options.forEach(opt => {
            const option = document.createElement('option');
            option.value = opt;
            option.textContent = opt;
            if (selectedProgram && opt.includes(selectedProgram)) {
                option.selected = true;
            }
            programSelect.appendChild(option);
        });
    }
}

// Select program from course card button
function selectProgram(kategori, programTitle) {
    const tabBtn = document.querySelector(`#reg-filter-tabs .filter-tab-btn[data-target="${kategori}"]`);
    if (tabBtn) tabBtn.click();

    const selectKat = document.getElementById('reg-kategori');
    selectKat.value = kategori;
    updateProgramOptions(kategori, programTitle);

    // Smooth scroll down to form
    document.getElementById('form-pendaftaran').scrollIntoView({ behavior: 'smooth' });
}

function showFileName(input, labelId) {
    const label = document.getElementById(labelId);
    if (input.files && input.files[0]) {
        const file = input.files[0];
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file melebihi batas 2MB.');
            input.value = '';
            label.textContent = 'Choose File | No file chosen';
        } else {
            label.textContent = '✓ ' + file.name;
            label.style.color = '#0010B8';
        }
    }
}

function resetFormState() {
    document.getElementById('label-pendaftaran').textContent = 'Choose File | No file chosen';
    document.getElementById('label-program').textContent = 'Choose File | No file chosen';
}

// Restore old inputs if validation error
const oldKategori = "<?php echo e(old('kategori')); ?>";
const oldProgram  = "<?php echo e(old('program')); ?>";
if (oldKategori) {
    updateProgramOptions(oldKategori);
    document.getElementById('reg-kategori').value = oldKategori;
    if (oldProgram) {
        document.getElementById('reg-program').value = oldProgram;
    }
} else {
    // Initial default options for first category
    updateProgramOptions('internasional');
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/registration.blade.php ENDPATH**/ ?>