<?php
    $footerSettings = $footerSettings ?? [];
    $siteName = $siteName ?? 'Denpasar Hotel School';
    $tagline = $tagline ?? '"Transforming Into Excellent"';
    $addressDenpasar = $footerSettings['address_denpasar'] ?? 'Jl. Sari Dana IV No. 1 Gatsu Barat, Denpasar 80116, Bali';
    $addressKlungkung = $footerSettings['address_klungkung'] ?? 'Jl. Raya Takmung No. 36, Klungkung 80752, Bali';
    $phoneDenpasar = $footerSettings['phone_denpasar'] ?? '+62 81 246 319966';
    $phoneKlungkung = $footerSettings['phone_klungkung'] ?? '+0366 5582998';
    $waKlungkung = $footerSettings['wa_klungkung'] ?? '+62 81 337 106480';
    $email = $footerSettings['email'] ?? 'sahabat@dhs.or.id';
    $instagramUrl = $footerSettings['instagram_url'] ?? 'https://instagram.com/denpasarhotelschool';
    $facebookUrl = $footerSettings['facebook_url'] ?? '#';
    $youtubeUrl = $footerSettings['youtube_url'] ?? '#';
    $copyright = $footerSettings['copyright'] ?? '© 2026 DENPASAR HOTEL SCHOOL.';
    $exploreLinks = json_decode($footerSettings['explore_links'] ?? '[]', true) ?? [
        ['label' => 'Beranda', 'url' => '/'],
        ['label' => 'Sekilas DHS', 'url' => '/tentang-kami'],
        ['label' => 'Akademi', 'url' => '/akademi'],
        ['label' => 'Berita & Artikel', 'url' => '/berita'],
    ];
    $admissionLinks = json_decode($footerSettings['admission_links'] ?? '[]', true) ?? [
        ['label' => 'Pendaftaran Online', 'url' => '/formulir-pendaftaran'],
        ['label' => 'FAQ', 'url' => '/faq'],
        ['label' => 'Karier', 'url' => '/karier'],
    ];
?>

<footer class="bg-surface-light pt-16 pb-8 px-6 md:px-16 border-t border-black/5">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-16 text-text-light">
        <div class="md:col-span-2">
            <h2 class="text-3xl font-serif mb-4 tracking-wide"><?php echo e($siteName); ?></h2>
            <p class="text-xs uppercase tracking-widest text-primary font-bold mb-4"><?php echo $tagline; ?></p>

            <div class="space-y-4 text-xs text-muted-light mb-6 leading-relaxed">
                <div>
                    <span class="font-bold text-text-light block" data-id="KAMPUS DENPASAR" data-en="DENPASAR CAMPUS">KAMPUS DENPASAR</span>
                    <?php echo e($addressDenpasar); ?><br>
                    WA: <?php echo e($phoneDenpasar); ?> | Email: <?php echo e($email); ?>

                </div>
                <div>
                    <span class="font-bold text-text-light block" data-id="KAMPUS KLUNGKUNG" data-en="KLUNGKUNG CAMPUS">KAMPUS KLUNGKUNG</span>
                    <?php echo e($addressKlungkung); ?><br>
                    Telp: <?php echo e($phoneKlungkung); ?> | WA: <?php echo e($waKlungkung); ?>

                </div>
            </div>

            <div class="flex space-x-4">
                <a class="w-10 h-10 rounded-full border border-black/10 flex items-center justify-center hover:bg-black/5 hover:text-primary transition-colors text-muted-light" href="<?php echo e($instagramUrl); ?>" target="_blank" title="Instagram">
                    <span class="material-icons text-sm">share</span>
                </a>
                <a class="w-10 h-10 rounded-full border border-black/10 flex items-center justify-center hover:bg-black/5 hover:text-primary transition-colors text-muted-light" href="<?php echo e($facebookUrl); ?>" target="_blank" title="Facebook">
                    <span class="material-icons text-sm">thumb_up</span>
                </a>
                <a class="w-10 h-10 rounded-full border border-black/10 flex items-center justify-center hover:bg-black/5 hover:text-primary transition-colors text-muted-light" href="<?php echo e($youtubeUrl); ?>" target="_blank" title="YouTube">
                    <span class="material-icons text-sm">play_circle</span>
                </a>
                <a class="w-10 h-10 rounded-full border border-black/10 flex items-center justify-center hover:bg-black/5 hover:text-primary transition-colors text-muted-light" href="mailto:<?php echo e($email); ?>" title="Email Hubungi Kami">
                    <span class="material-icons text-sm">mail_outline</span>
                </a>
            </div>
        </div>

        <div>
            <span class="label-text mb-6 block text-text-light" data-id="EKSPLORASI" data-en="EXPLORE">EKSPLORASI</span>
            <ul class="space-y-4 text-sm text-muted-light">
                <?php $__currentLoopData = $exploreLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="hover:text-primary transition-colors" href="<?php echo e($link['url'] ?? '#'); ?>"><?php echo e($link['label'] ?? ''); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>

        <div>
            <span class="label-text mb-6 block text-text-light" data-id="PENDAFTARAN &amp; LINK" data-en="ADMISSIONS &amp; LINKS">PENDAFTARAN &amp; LINK</span>
            <ul class="space-y-4 text-sm text-muted-light">
                <?php $__currentLoopData = $admissionLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="hover:text-primary transition-colors" href="<?php echo e($link['url'] ?? '#'); ?>" <?php echo e(str_starts_with($link['url'] ?? '', 'http') ? 'target="_blank"' : ''); ?>><?php echo e($link['label'] ?? ''); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>

    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center pt-8 border-t border-black/5 text-[0.65rem] text-muted-light uppercase tracking-widest">
        <p><?php echo $copyright; ?> <span data-id="DIRANCANG UNTUK KEUNGGULAN." data-en="CRAFTED FOR EXCELLENCE.">DIRANCANG UNTUK KEUNGGULAN.</span></p>
        <div class="flex space-x-6 mt-4 md:mt-0">
            <a class="hover:text-primary transition-colors" href="/privacy-policy"><span data-id="KEBIJAKAN PRIVASI" data-en="PRIVACY POLICY">KEBIJAKAN PRIVASI</span></a>
            <a class="hover:text-primary transition-colors" href="/legal"><span data-id="LEGAL" data-en="LEGAL">LEGAL</span></a>
            <a class="hover:text-primary transition-colors" href="/cookies"><span data-id="KUKIS" data-en="COOKIES">KUKIS</span></a>
        </div>
    </div>
</footer>
<?php /**PATH D:\laragon\www\DHS\resources\views/partials/footer.blade.php ENDPATH**/ ?>