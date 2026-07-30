<?php $__env->startSection('title', 'Beasiswa — Denpasar Hotel School'); ?>

<?php
    $heroTitle = $beasiswa['heroTitle'] ?? 'Beasiswa DHS';
    $heroSubtitle = $beasiswa['heroSubtitle'] ?? 'JALUR BEASISWA';
    $heroBgImage = $beasiswa['heroBgImage'] ?? 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1600&auto=format&fit=crop';
    $introTitle = $beasiswa['introTitle'] ?? 'Program Beasiswa Denpasar Hotel School';
    $introDesc = $beasiswa['introDesc'] ?? 'DHS menyediakan keringanan biaya pendidikan melalui berbagai skema beasiswa bagi calon profesional berprestasi. Beasiswa ini merupakan bagian dari komitmen DHS untuk memberikan akses pendidikan berkualitas kepada bakat terbaik tanpa terkendala biaya.';
    $scholarships = $beasiswa['scholarships'] ?? [];
    $generalReqs = $beasiswa['generalRequirements'] ?? [
        'Warga Negara Indonesia (WNI)',
        'Lulusan SMA/SMK/MA atau sederajat (maksimal 2 tahun setelah kelulusan)',
        'Usia maksimal 22 tahun saat pendaftaran',
        'Sehat jasmani dan rohani (dibuktikan dengan surat kesehatan)',
        'Tidak sedang menerima beasiswa dari lembaga lain',
        'Berkomitmen untuk menyelesaikan program pendidikan hingga lulus',
    ];
    $steps = $beasiswa['registrationSteps'] ?? [
        ['icon' => 'description', 'title' => 'Isi Formulir Online', 'desc' => 'Lengkapi formulir pendaftaran online di halaman pendaftaran DHS. Lampirkan dokumen yang diperlukan.'],
        ['icon' => 'upload_file', 'title' => 'Unggah Dokumen', 'desc' => 'Upload surat keterangan, rapor/ijazah, piagam prestasi, dan dokumen pendukung lainnya.'],
        ['icon' => 'how_to_reg', 'title' => 'Verifikasi Berkas', 'desc' => 'Tim admisi akan memverifikasi kelengkapan dan keaslian dokumen yang dikirimkan.'],
        ['icon' => 'event', 'title' => 'Wawancara', 'desc' => 'Kandidat yang lolos seleksi berkas akan diundang untuk wawancara dengan tim DHS.'],
        ['icon' => 'notifications_active', 'title' => 'Pengumuman', 'desc' => 'Hasil seleksi akan diumumkan melalui email dan WhatsApp secara resmi.'],
    ];
    $stages = $beasiswa['selectionStages'] ?? [
        ['month' => 'Maret', 'title' => 'Pembukaan Pendaftaran', 'desc' => 'Pendaftaran beasiswa dibuka untuk calon mahasiswa baru.'],
        ['month' => 'April', 'title' => 'Penutupan & Verifikasi', 'desc' => 'Batas akhir pendaftaran. Tim mulai memverifikasi semua berkas yang masuk.'],
        ['month' => 'Mei', 'title' => 'Seleksi & Wawancara', 'desc' => 'Proses seleksi berkas dan wawancara dengan kandidat terpilih.'],
        ['month' => 'Juni', 'title' => 'Pengumuman', 'desc' => 'Hasil beasiswa diumumkan. Penerima beasiswa melakukan daftar ulang.'],
    ];
    $faqs = $beasiswa['faqs'] ?? [
        ['q' => 'Apakah beasiswa menanggung biaya penuh?', 'a' => 'Tergantung jenis beasiswa. Beasiswa Prestasi dapat mencakup keringanan hingga 50% biaya pendidikan. Beasiswa Khusus dan STT/Desa memiliki skema keringanan yang berbeda sesuai kelayakan.'],
        ['q' => 'Bisakah mendaftar lebih dari satu jenis beasiswa?', 'a' => 'Tidak. Setiap calon peserta didik hanya dapat mendaftar pada satu jalur beasiswa. Pastikan Anda memilih jalur yang paling sesuai dengan kriteria Anda.'],
        ['q' => 'Apa yang terjadi jika saya tidak memenuhi syarat beasiswa?', 'a' => 'Anda tetap dapat mendaftar sebagai mahasiswa reguler dengan biaya standar. DHS juga menyediakan opsi cicilan untuk membantu meringankan biaya.'],
        ['q' => 'Bagaimana cara menghubungi tim beasiswa?', 'a' => 'Hubungi kami via WhatsApp di +62 81 246 319966 atau email ke sahabat@dhs.or.id. Tim kami siap membantu Anda.'],
    ];
    $ctaTitle = $beasiswa['ctaTitle'] ?? 'Ajukan Beasiswa Sekarang';
    $ctaDesc = $beasiswa['ctaDesc'] ?? 'Jangan lewatkan kesempatan untuk mendapatkan keringanan biaya pendidikan. Bersama DHS, bangun karir impian Anda di industri hospitality global.';
    $ctaBtnText = $beasiswa['ctaBtnText'] ?? 'Daftar Sekarang';
    $ctaBtnUrl = $beasiswa['ctaBtnUrl'] ?? '/formulir-pendaftaran';
?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative h-[60vh] min-h-[420px] flex items-center justify-center text-center overflow-hidden mb-16">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img alt="Beasiswa DHS" class="absolute inset-0 w-full h-full object-cover" src="<?php echo e($heroBgImage); ?>">

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <a class="hover:text-white transition-colors" href="/akademi"><span data-id="Akademi" data-en="Academy">Akademi</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><span data-id="Beasiswa" data-en="Scholarship">Beasiswa</span></span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-[1.1]">
                <span data-id="<?php echo e($heroTitle); ?>" data-en="<?php echo e($heroTitle); ?>"><?php echo e($heroTitle); ?></span>
            </h1>
            <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/70 font-medium">
                <span data-id="<?php echo e($heroSubtitle); ?>" data-en="<?php echo e($heroSubtitle); ?>"><?php echo e($heroSubtitle); ?></span>
            </p>
        </div>
    </section>

    <!-- Intro Section -->
    <section class="py-16 md:py-20 px-5 md:px-16 max-w-[1280px] mx-auto text-center" data-reveal="fade-up">
        <h2 class="text-[32px] md:text-[40px] leading-[1.2] font-semibold font-serif text-text-light mb-6">
            <span data-id="<?php echo e($introTitle); ?>" data-en="<?php echo e($introTitle); ?>"><?php echo e($introTitle); ?></span>
        </h2>
        <p class="text-base text-muted-light max-w-3xl mx-auto leading-relaxed">
            <span data-id="<?php echo e($introDesc); ?>" data-en="<?php echo e($introDesc); ?>"><?php echo e($introDesc); ?></span>
        </p>
    </section>

    <!-- Scholarship Cards -->
    <section class="py-16 md:py-20 bg-dhs-cream px-5 md:px-16">
        <div class="max-w-[1280px] mx-auto">
            <div class="text-center mb-12" data-reveal="fade-up">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">JALUR BEASISWA</span>
                <h2 class="text-[32px] md:text-[40px] leading-[1.2] font-semibold font-serif text-text-light">Tersedia 3 Jalur Beasiswa</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php $__currentLoopData = $scholarships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $scholarship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white border border-black/5 p-8 shadow-sm hover:shadow-lg transition-shadow duration-300 <?php echo e($i === 1 ? 'bg-dhs-navy text-white' : ''); ?>" data-reveal="fade-up" data-delay="<?php echo e($i * 150); ?>">
                    <div class="w-12 h-12 <?php echo e($i === 1 ? 'bg-white/10' : 'bg-primary/10'); ?> flex items-center justify-center mb-6">
                        <span class="material-icons <?php echo e($i === 1 ? 'text-white' : 'text-primary'); ?> text-2xl"><?php echo e($scholarship['icon'] ?? 'school'); ?></span>
                    </div>
                    <h3 class="font-bold font-serif text-xl <?php echo e($i === 1 ? 'text-white' : 'text-text-light'); ?> mb-3">
                        <?php echo e($scholarship['title']); ?>

                    </h3>
                    <p class="text-xs <?php echo e($i === 1 ? 'text-white/75' : 'text-muted-light'); ?> leading-relaxed mb-5"><?php echo e($scholarship['desc']); ?></p>
                    <ul class="text-xs <?php echo e($i === 1 ? 'text-white/75' : 'text-muted-light'); ?> space-y-2.5">
                        <?php $__currentLoopData = $scholarship['requirements'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-start gap-2">
                            <span class="material-icons <?php echo e($i === 1 ? 'text-white' : 'text-primary'); ?> text-sm mt-0.5">check_circle</span>
                            <span><?php echo e($req); ?></span>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Persyaratan Umum -->
    <section class="py-16 md:py-20 px-5 md:px-16 max-w-[1280px] mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div data-reveal="fade-right">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">PERSYARATAN UMUM</span>
                <h2 class="text-[32px] md:text-[40px] leading-[1.2] font-semibold font-serif text-text-light mb-8">
                    Siapa yang Bisa Mendaftar?
                </h2>
                <ul class="space-y-4">
                    <?php $__currentLoopData = $generalReqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-start gap-3">
                        <span class="material-icons text-primary text-lg mt-0.5">check_circle</span>
                        <span class="text-base text-muted-light leading-relaxed"><?php echo e($req); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div data-reveal="fade-left" data-delay="200">
                <div class="bg-dhs-cream p-8 border border-black/5">
                    <span class="material-icons text-primary text-4xl mb-4 block">info</span>
                    <h3 class="font-bold font-serif text-xl text-text-light mb-3">Catatan Penting</h3>
                    <ul class="text-sm text-muted-light space-y-3 leading-relaxed">
                        <li>• Penerima beasiswa wajib mempertahankan minimal IPK 3.0 selama masa studi.</li>
                        <li>• Apabila berhenti di tengah jalan, dana beasiswa harus dikembalikan secara penuh.</li>
                        <li>• Kuota beasiswa terbatas untuk setiap periode pendaftaran.</li>
                        <li>• Keputusan tim seleksi bersifat mutlak dan tidak dapat diganggu gugat.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Pendaftaran -->
    <section class="py-16 md:py-20 bg-dhs-cream px-5 md:px-16">
        <div class="max-w-[1280px] mx-auto">
            <div class="text-center mb-16" data-reveal="fade-up">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">LANGKAH MUDAH</span>
                <h2 class="text-[32px] md:text-[40px] leading-[1.2] font-semibold font-serif text-text-light">
                    Cara Mendaftar Beasiswa
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
                <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="text-center relative" data-reveal="fade-up" data-delay="<?php echo e($i * 100); ?>">
                    <div class="w-14 h-14 bg-dhs-navy text-white rounded-full flex items-center justify-center mx-auto mb-4 text-lg font-bold font-sans">
                        <?php echo e($i + 1); ?>

                    </div>
                    <span class="material-icons text-primary text-3xl mb-3 block"><?php echo e($step['icon']); ?></span>
                    <h4 class="font-bold text-sm text-text-light mb-2"><?php echo e($step['title']); ?></h4>
                    <p class="text-xs text-muted-light leading-relaxed"><?php echo e($step['desc']); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Tahapan Seleksi / Timeline -->
    <section class="py-16 md:py-20 px-5 md:px-16 max-w-[1280px] mx-auto">
        <div class="text-center mb-16" data-reveal="fade-up">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">TIMELINE</span>
            <h2 class="text-[32px] md:text-[40px] leading-[1.2] font-semibold font-serif text-text-light">
                Tahapan Seleksi Beasiswa
            </h2>
        </div>
        <div class="relative max-w-3xl mx-auto">
            <div class="absolute left-1/2 top-0 bottom-0 w-px bg-black/10 -translate-x-1/2 hidden md:block"></div>
            <div class="space-y-12">
                <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex flex-col md:flex-row <?php echo e($i % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse'); ?> items-center gap-8" data-reveal="fade-up" data-delay="<?php echo e($i * 100); ?>">
                    <div class="<?php echo e($i % 2 === 0 ? 'md:text-right' : 'md:text-left'); ?> flex-1">
                        <div class="bg-white p-6 shadow-sm border-l-4 <?php echo e($i % 2 === 0 ? 'border-l-primary' : 'border-l-dhs-navy'); ?> inline-block w-full">
                            <h4 class="font-bold text-lg text-text-light mb-1"><?php echo e($stage['title']); ?></h4>
                            <p class="text-sm text-muted-light leading-relaxed"><?php echo e($stage['desc']); ?></p>
                        </div>
                    </div>
                    <div class="shrink-0 w-20 h-16 bg-dhs-navy text-white flex items-center justify-center font-bold text-sm font-sans z-10 shadow-md rounded-lg">
                        <?php echo e($stage['month']); ?>

                    </div>
                    <div class="flex-1 hidden md:block"></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- FAQ Beasiswa -->
    <section class="py-16 md:py-20 bg-dhs-cream px-5 md:px-16">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-12" data-reveal="fade-up">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">FAQ</span>
                <h2 class="text-[32px] md:text-[40px] leading-[1.2] font-semibold font-serif text-text-light">
                    Pertanyaan Seputar Beasiswa
                </h2>
            </div>
            <div class="space-y-4">
                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors" data-reveal="fade-up">
                    <button class="w-full flex justify-between items-center text-left focus:outline-none beasiswa-accordion-toggle">
                        <span class="text-[18px] font-semibold text-text-light pr-4"><?php echo e($faq['q']); ?></span>
                        <span class="material-icons text-primary shrink-0 transition-transform duration-300 beasiswa-icon-indicator">add</span>
                    </button>
                    <div class="beasiswa-accordion-content overflow-hidden transition-all duration-300 max-h-0">
                        <div class="text-muted-light text-base leading-relaxed pt-4"><?php echo e($faq['a']); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-dhs-navy py-20 md:py-24 px-5 md:px-16">
        <div class="max-w-3xl mx-auto text-center" data-reveal="zoom-in">
            <span class="material-icons text-primary text-5xl mb-6 block">school</span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-white mb-6">
                <?php echo e($ctaTitle); ?>

            </h2>
            <p class="text-lg text-white/70 mb-10 leading-relaxed"><?php echo e($ctaDesc); ?></p>
            <div class="flex flex-col sm:flex-row justify-center gap-4" data-reveal="fade-up" data-delay="200">
                <a class="px-8 py-4 bg-primary text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:opacity-90 transition-opacity" href="<?php echo e($ctaBtnUrl); ?>">
                    <?php echo e($ctaBtnText); ?>

                </a>
                <a class="px-8 py-4 bg-transparent border border-white text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-white hover:text-dhs-navy transition-colors" href="https://wa.me/6281246319966">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var accs = document.querySelectorAll('.beasiswa-accordion-toggle');
            accs.forEach(function (acc) {
                acc.addEventListener('click', function () {
                    var content = this.nextElementSibling;
                    var icon = this.querySelector('.beasiswa-icon-indicator');
                    var isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';
                    document.querySelectorAll('.beasiswa-accordion-content').forEach(function (c) { c.style.maxHeight = '0px'; });
                    document.querySelectorAll('.beasiswa-icon-indicator').forEach(function (i) { i.textContent = 'add'; });
                    if (!isOpen) {
                        content.style.maxHeight = content.scrollHeight + 'px';
                        icon.textContent = 'remove';
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/beasiswa.blade.php ENDPATH**/ ?>