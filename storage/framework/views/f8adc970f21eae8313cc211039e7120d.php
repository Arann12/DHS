<?php $__env->startSection('title', 'Program Akademi — Denpasar Hotel School'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <?php
        $academyHeroTitle = $academyHero['title'] ?? 'Program Vokasi & Kursus';
        $academyHeroSubtitle = $academyHero['subtitle'] ?? 'Program Akademik & Pelatihan';
        $academyHeroBg = $academyHero['bgImage'] ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuCxn2eqm_jRIxoqtBqU_Z4510mT8Oum1XJuCt3B4qsnaur1kOxl1kswsTUDy_IWkop-w6gCJC9c4z-J1rwUSX4qHaSazUfu4x09voqcT3DY8fhiWkEHZcuUOZBNOolJHzCrNRQQXlB6UNrMOsC2_nhrMbSl_DzCpEu5YNeYXrmzbkHsYKIWxKH0th79FkaqCRHftpuCaHJyYzxate_qQzEmQcWi4iGgWxF-wIUFQGCYA83w8lUepgu6VQ';
    ?>
    <section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img alt="Students in training kitchen" width="1920" height="1080" class="absolute inset-0 w-full h-full object-cover" style="will-change:transform;" src="<?php echo e($academyHeroBg); ?>">

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><span data-id="Akademi" data-en="Academy">Akademi</span></span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-[1.1]">
                <?php echo e($academyHeroTitle); ?>

            </h1>
            <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/70 font-medium">
                <?php echo e($academyHeroSubtitle); ?>

            </p>
        </div>
    </section>

    <!-- Main Content with Filter -->
    <main class="pt-16 pb-24">
        <!-- Category Filter Tabs -->
        <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-12" data-reveal="fade-up">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block" data-id="PILIH KATEGORI DURASI" data-en="SELECT DURATION CATEGORY">PILIH KATEGORI DURASI</span>
            <div class="flex flex-wrap gap-3 border-b border-black/10 pb-6">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button class="filter-tab-btn px-5 py-2.5 <?php echo e($loop->first ? 'bg-dhs-navy text-white' : 'bg-transparent border border-black/20 text-text-light'); ?> text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="<?php echo e($cat->category_key); ?>">
                    <?php echo e($cat->category_name); ?>

                </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <!-- Category Panels -->
        <section class="max-w-[1280px] mx-auto px-5 md:px-16" data-reveal="fade-up" data-delay="150">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="category-content-panel <?php echo e($loop->first ? 'active' : 'hidden'); ?>" id="panel-<?php echo e($cat->category_key); ?>">
                <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-10 items-start mb-16">
                    <!-- Category Sidebar -->
                    <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg lg:sticky lg:top-24 mb-8 lg:mb-0">
                        <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block"><?php echo e($cat->category_name); ?></span>
                        <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight"><?php echo e($cat->category_name); ?></h2>
                        <?php if($cat->subtitle): ?>
                        <p class="text-xs text-muted-light uppercase tracking-wider mb-4"><?php echo e($cat->subtitle); ?></p>
                        <?php endif; ?>
                        <?php if($cat->description): ?>
                        <p class="text-sm text-muted-light leading-relaxed mb-6"><?php echo e($cat->description); ?></p>
                        <?php endif; ?>
                        <?php if($cat->career_opportunities): ?>
                        <div class="pt-4 border-t border-black/10">
                            <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">Peluang Kerja Lulusan:</p>
                            <p class="text-xs text-muted-light leading-relaxed"><?php echo e($cat->career_opportunities); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Programs Grid -->
                    <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php $__empty_1 = true; $__currentLoopData = $cat->programs->where('is_active', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="group bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col h-full card-hover">
                            <div class="relative overflow-hidden h-44 sm:h-48 lg:h-52 shrink-0">
                                <img src="<?php echo e($program->thumbnail_url ?? 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800'); ?>" alt="<?php echo e($program->title); ?>" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                                <?php if($program->country_badge): ?>
                                <span class="absolute top-3 right-3 bg-dhs-navy/90 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded tracking-wider shadow-sm">
                                    <?php echo e($program->country_badge); ?>

                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-serif font-bold text-lg text-dhs-navy group-hover:text-primary transition-colors mb-2 leading-snug"><?php echo e($program->title); ?></h3>
                                    <?php if($program->description): ?>
                                    <p class="text-xs text-muted-light leading-relaxed mb-4"><?php echo e(Str::limit($program->description, 120)); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="pt-3 border-t border-black/5 flex items-center justify-between text-xs text-primary font-semibold">
                                    <span data-id="Lihat Detail Program" data-en="View Program Details">Lihat Detail Program</span>
                                    <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-span-full text-center py-12 text-muted-light">
                            <p>Belum ada program tersedia.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </section>

        <!-- Beasiswa Section -->
        <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-20" data-reveal="fade-up">
            <div class="text-center mb-12">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block" data-id="JALUR BEASISWA" data-en="SCHOLARSHIP PATHWAYS">JALUR BEASISWA</span>
                <h3 class="text-3xl md:text-4xl font-serif text-text-light mb-4" data-id="Program Beasiswa DHS" data-en="DHS Scholarship Program">Program Beasiswa DHS</h3>
                <p class="text-sm text-muted-light max-w-2xl mx-auto" data-id="Denpasar Hotel School menyediakan keringanan biaya pendidikan melalui berbagai skema beasiswa bagi calon profesional berprestasi." data-en="Denpasar Hotel School provides educational fee relief through various scholarship schemes for high-achieving prospective professionals.">Denpasar Hotel School menyediakan keringanan biaya pendidikan melalui berbagai skema beasiswa bagi calon profesional berprestasi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white border border-black/5 p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div class="w-12 h-12 bg-primary/10 flex items-center justify-center mb-6">
                        <span class="material-icons text-primary text-2xl">emoji_events</span>
                    </div>
                    <h4 class="font-bold font-serif text-xl text-text-light mb-3">Beasiswa Prestasi</h4>
                    <p class="text-xs text-muted-light leading-relaxed mb-5">Bagi calon peserta didik dengan prestasi akademik dan non-akademik yang unggul. Keringanan biaya pendidikan hingga 50%.</p>
                    <ul class="text-xs text-muted-light space-y-2.5">
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Nilai rata-rata rapor/ijazah ≥ 80</li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Piagam atau sertifikat prestasi</li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Lulus seleksi wawancara</li>
                    </ul>
                </div>

                <div class="bg-dhs-navy p-8 shadow-sm text-white">
                    <div class="w-12 h-12 bg-white/10 flex items-center justify-center mb-6">
                        <span class="material-icons text-white text-2xl">groups</span>
                    </div>
                    <h4 class="font-bold font-serif text-xl text-white mb-3">Beasiswa STT / Desa</h4>
                    <p class="text-xs text-white/75 leading-relaxed mb-5">Khusus bagi anggota Sekaa Teruna Teruni (STT) dan utusan desa adat yang ingin meningkatkan kompetensi di bidang perhotelan.</p>
                    <ul class="text-xs text-white/75 space-y-2.5">
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Surat rekomendasi Bendesa Adat</li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Aktif sebagai anggota STT</li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Warga Bali berdomisili di Bali</li>
                    </ul>
                </div>

                <div class="bg-white border border-black/5 p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div class="w-12 h-12 bg-primary/10 flex items-center justify-center mb-6">
                        <span class="material-icons text-primary text-2xl">workspace_premium</span>
                    </div>
                    <h4 class="font-bold font-serif text-xl text-text-light mb-3">Beasiswa Khusus</h4>
                    <p class="text-xs text-muted-light leading-relaxed mb-5">Bagi calon peserta didik dari keluarga kurang mampu dengan komitmen tinggi untuk berkarir di industri perhotelan dan pariwisata.</p>
                    <ul class="text-xs text-muted-light space-y-2.5">
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Surat keterangan tidak mampu</li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Esai motivasi dan wawancara</li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span>Seleksi oleh Tim DHS</li>
                    </ul>
                </div>
            </div>

            <div class="text-center">
                <a class="inline-flex items-center gap-3 px-8 py-4 bg-primary text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:opacity-90 transition-opacity" href="http://www.dhs.or.id/student" target="_blank">
                    <span class="material-icons text-base">school</span>
                    <span data-id="Ajukan Beasiswa Sekarang" data-en="Apply for Scholarship Now">Ajukan Beasiswa Sekarang</span>
                </a>
            </div>
        </section>

        <!-- Document Assistance Section -->
        <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-24">
            <h3 class="text-[32px] leading-[1.3] font-semibold font-serif mb-10 text-center text-text-light" data-id="Layanan Pengurusan Dokumen" data-en="Document Processing Services">Layanan Pengurusan Dokumen</h3>
            <p class="text-sm text-muted-light text-center max-w-2xl mx-auto mb-12" data-id="DHS menyediakan bantuan penuh bagi para siswa dan calon pencari kerja kapal pesiar untuk mengurus dokumen sertifikasi wajib:" data-en="DHS provides full assistance for students and prospective cruise ship workers to process mandatory certification documents:">DHS menyediakan bantuan penuh bagi para siswa dan calon pencari kerja kapal pesiar untuk mengurus dokumen sertifikasi wajib:</p>
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-6 justify-center text-center">
                <?php $__currentLoopData = [
                        ['title' => 'Passport', 'icon' => 'card_travel'],
                        ['title' => 'BST', 'icon' => 'anchor'],
                        ['title' => 'SDSD', 'icon' => 'security'],
                        ['title' => 'CCM', 'icon' => 'groups'],
                        ['title' => 'SSAT', 'icon' => 'verified_user'],
                        ['title' => 'PSCRB', 'icon' => 'sailing'],
                        ['title' => 'C1D VISA', 'icon' => 'badge']
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-dhs-cream p-6 border border-black/5 hover:bg-white transition-colors duration-300">
                        <span class="material-icons text-primary text-3xl mb-3 block"><?php echo e($doc['icon']); ?></span>
                        <h5 class="font-bold text-sm text-text-light"><?php echo e($doc['title']); ?></h5>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="max-w-3xl mx-auto px-5 text-center mb-24">
            <h2 class="text-[48px] leading-[1.2] font-semibold font-serif mb-6 text-text-light" data-id="Mulai Karir Sukses Anda" data-en="Start Your Successful Career">Mulai Karir Sukses Anda</h2>
            <p class="text-base text-muted-light mb-10" data-id="Denpasar Hotel School siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global." data-en="Denpasar Hotel School is ready to guide you to become a competent young professional with global competitiveness.">Denpasar Hotel School siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global. Gabung sekarang juga secara online.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a class="px-8 py-4 bg-dhs-navy text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-darknavy transition-colors" href="/formulir-pendaftaran"><span data-id="Pendaftaran Online" data-en="Online Registration">Pendaftaran Online</span></a>
                <a class="px-8 py-4 bg-transparent border border-dhs-navy text-dhs-navy text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-cream transition-colors" href="https://linktr.ee/BiayaPendidikan_DHS" target="_blank"><span data-id="Brosur Biaya" data-en="Download Cost Brochure">Unduh Brosur Biaya</span></a>
            </div>
        </section>
    </main>

    <style>
        .category-content-panel.hidden {
            content-visibility: auto;
            contain-intrinsic-size: 0 2000px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-tab-btn');
            const panels = document.querySelectorAll('.category-content-panel');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterBtns.forEach(b => {
                        b.classList.remove('bg-dhs-navy', 'text-white');
                        b.classList.add('bg-transparent', 'border', 'border-black/20', 'text-text-light');
                    });
                    btn.classList.remove('bg-transparent', 'border', 'border-black/20', 'text-text-light');
                    btn.classList.add('bg-dhs-navy', 'text-white');

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

            const urlParams = new URLSearchParams(window.location.search);
            const filterParam = urlParams.get('filter');
            if (filterParam) {
                const matchBtn = document.querySelector(`.filter-tab-btn[data-target="${filterParam}"]`);
                if (matchBtn) matchBtn.click();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/akademi.blade.php ENDPATH**/ ?>