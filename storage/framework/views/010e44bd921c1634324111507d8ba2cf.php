<?php $__env->startSection('title', 'Denpasar Hotel School — International Vocational Training Center in Bali'); ?>

<?php
    $heroContent = isset($sections['hero']) ? (is_array($sections['hero']->section_content) ? $sections['hero']->section_content : json_decode($sections['hero']->section_content ?? '[]', true)) : [];
    $heroOverline = $heroContent['overline'] ?? 'DENPASAR HOTEL SCHOOL — PUSAT PELATIHAN VOKASI INTERNASIONAL DI BALI';
    $heroHeadline = $heroContent['headline'] ?? 'Membentuk Masa Depan Perhotelan Global';
    $heroCta1Text = $heroContent['cta1_text'] ?? 'JELAJAHI PROGRAM';
    $heroCta1Link = $heroContent['cta1_link'] ?? '/akademi';
    $heroCta2Text = $heroContent['cta2_text'] ?? 'DAFTAR SEKARANG';
    $heroCta2Link = $heroContent['cta2_link'] ?? '/cara-mendaftar';
    $heroScrollText = $heroContent['scroll_text'] ?? 'Geser Untuk Scroll';
    $heroBgImage = !empty($heroContent['background_image']) ? $heroContent['background_image'] : 'https://lh3.googleusercontent.com/aida-public/AB6AXuBaJKFYExsjON0pHP43rfmOAIqTkD_R2sTlmKK5Y3CMDGPSja6oJ9DR5erhpkcJFaGwf8hwJZD58ClcpjuTPYEL5LyfjSjhB-t-AumWxxUO-avGgwTwc2wPhoyV6tw23si9SHWgb-5qyJtdTi6WaHdheSZI6A0nWVeXVQ69zkjhtBFvmGPvNvIy5vgQ3-jvlnbQ4bpVLKjjmedqgkXlfk0i_oXHtaIcsJSv5idQg1RZWqqLN8RrwIF70A';

    $aboutContent = isset($sections['about']) ? (is_array($sections['about']->section_content) ? $sections['about']->section_content : json_decode($sections['about']->section_content ?? '[]', true)) : [];
    $aboutLabel = $aboutContent['label'] ?? 'SEKILAS DHS';
    $aboutHeadline = $aboutContent['headline'] ?? 'Transformasi Menuju Unggul.';
    $aboutP1 = $aboutContent['paragraph1'] ?? 'Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi.';
    $aboutP2 = $aboutContent['paragraph2'] ?? 'Lembaga ini didirikan untuk memberi kesempatan generasi muda Indonesia menjadi tenaga profesional bidang perhotelan, hospitality, kapal pesiar dan pariwisata, serta belajar sambil bekerja di luar negeri.';
    $aboutNote = $aboutContent['note'] ?? 'Mencetak SDM pariwisata yang unggul, kompeten, dan siap bersaing di tingkat global.';
    $aboutImage = !empty($aboutContent['image']) ? $aboutContent['image'] : 'https://lh3.googleusercontent.com/aida-public/AB6AXuA5jkBzd0EqrT-cphGIkzHYDH2a7dpxzv95e4cWzjIaFRYe8B3poCp2NncsdrneEW_ldLWrzvbO4JcdyzzGiQ-Mvb33B6kEHzU80DleUBPVkvlrCikONCi2W8yS5aMmee0S50iv_AYi1wUI-pnY1lPSKs2H7rnAXGxAPLvpZ9j5QBG9pWjHTb3FiXnNHZa6j5uJnKPdjulHepAKqk6Eb1zivof6CfMQt0IRObJoQROAn60P6jzRyfcrAQ';

    $visionContent = isset($sections['vision']) ? (is_array($sections['vision']->section_content) ? $sections['vision']->section_content : json_decode($sections['vision']->section_content ?? '[]', true)) : [];
    $visionSectionTitle = $visionContent['sectionTitle'] ?? 'Standar Visioner.';
    $visionVisiLabel = $visionContent['visiLabel'] ?? 'VISI';
    $visionText = $visionContent['vision_text'] ?? 'Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global.';
    $visionMisiLabel = $visionContent['misiLabel'] ?? 'MISI';
    $visionMisiItems = $visionContent['misiItems'] ?? [
        'Melaksanakan program pendidikan inovatif sesuai kebutuhan industri.',
        'Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional.',
        'Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara.'
    ];
    $visionCoreValues = $visionContent['coreValues'] ?? [
        [ 'icon' => 'verified',   'title' => 'Integritas',     'desc' => 'Membentuk insan pariwisata yang kompeten dan berdaya saing tinggi.' ],
        [ 'icon' => 'fact_check', 'title' => 'Tanggung Jawab', 'desc' => 'Menghasilkan lulusan yang sesuai kriteria dunia kerja masa depan.' ],
        [ 'icon' => 'star',       'title' => 'Kualitas',       'desc' => 'Berfokus pada penyediaan solusi dan kualitas pembelajaran terbaik.' ],
        [ 'icon' => 'public',     'title' => 'Global Network', 'desc' => 'Kesempatan kerja & belajar di Australia, Jerman & Asia Tenggara.' ]
    ];

    $campusContent = isset($sections['campus']) ? (is_array($sections['campus']->section_content) ? $sections['campus']->section_content : json_decode($sections['campus']->section_content ?? '[]', true)) : [];
    $campusTitle = $campusContent['title'] ?? 'Kehidupan & Lingkungan Kampus';
    $campusFotos = $campusContent['fotos'] ?? [
        [ 'src' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCbRFStu23zaKKqIJeoNTPdSOcPof73N6z-I-QsGizCu594Eha4Mz0SejvG2hnF6yR68hPeN7xD_S1jEZRkzyCBrs8vDdvREWF-3OAPOgH3qHLgtcUvnZe8Rn1IBJAWejpEp4WOENNj0cc7gOgDOekzGxeBw1_w1YoCEDF65kipejrZCRT_xlGbzjwQUJm4_CNr8F3jauVVHFX03WogUy7RZO30XkuqCSw4mJEZ3cNqvzP0L5HyEQTniA', 'alt' => 'Siswa dalam seragam' ],
        [ 'src' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDTY_0q-eeJ-lg9SUN09cLtSeVQR488pa_Xwag_o53lQzWT6mJR5WZs7yr6XbePzFxR3qxgiFvrEoNRgTdBGXSDDjwndYp88gIFAbcxGsNUdAZhXNledP3kFKkUXRYQkqkNW-yjqNZuHAtYEw1dMPKqJnAeTZFdyzrZPK3Opj_kuWb_k7Th8YmDJkdeDzKN1uwEyWzuDzSZ-ONuUd0TRqQTctN_cqSFal0SCwZhd6WmrTA8-CwwcCNwoQ', 'alt' => 'Resort Pool' ],
        [ 'src' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDV0lh3gGKxkEZoxy7owBdHzRVEZvkTUx_cLcTOGAorH2W5Hlj93QcVs4ZTcVZhy6ReTblju-pImR6huMYYKK3Ht_2BydhaglchgK_UjAw6j0_cBbtChI08T9-9SrN4y7LPA0hvtQx8P7Ro6tEHZJwQYTY1SK15KI-kaVZnE7hYSv9HI7UerrDb0fPLXglYz0YNzfv5YcT60EHMmhqSQ4yMT6QGwO7ZAyM-JwghKblh8sWSOMmwJGfTKA', 'alt' => 'Praktikum Dapur Chef' ]
    ];

    $academyContent = isset($sections['academy']) ? (is_array($sections['academy']->section_content) ? $sections['academy']->section_content : json_decode($sections['academy']->section_content ?? '[]', true)) : [];
    $academyLabel = $academyContent['label'] ?? 'AKADEMI UNGGULAN';
    $academyHeadline = $academyContent['headline'] ?? 'Disiplin & Pelatihan Profesional Kami';
    $academySectionTitle = $academyHeadline; // alias used in view
    $academyCards = $academyContent['cards'] ?? [
        [ 'title' => 'Program Internasional', 'desc' => 'Pendidikan luar negeri berpartner dengan TAFE Australia & The Hotel School, serta Ausbildung Jerman.', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDXptvnod1HxEn1Bx6IezKWRBCwkykUPMcRW74guW5_55XXUaalkhFqPnoliMwG70kGUvZe7BZdcexnivnWW1-lK7WedS10yZF0nB7J_ZTIXnug_xa2_b0l7ZH3uXNLTJROPIqkEBqhJapvitg8WQoVxzwTyJuSq4r3rcPwfmvU8uPENXrzHnh0AbgLiOgwmys8JVmMCyf7XQYs5X0T0iaZxtDoi7jQJeSzDcGZwmF17aEOKwCkODnBOQ', 'link' => '/akademi?filter=internasional' ],
        [ 'title' => 'Vokasi 2 Tahun', 'desc' => 'Jurusan Culinary Arts, Perhotelan, & F&B Service dengan jaminan OJT hotel bintang 4 & 5.', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAxW5mY_zGD0HDOuwOrmrluxFe62YYnMPXOVLSqWRlgjb2vMXfJRycIhaY-CD9oObxiUpXDfsNqINeygV8X8D-cGXIgF1TsGf1oTPgW6_TY1GU8KeHFIgeVZgBDZxo-77h1BWpzJ4Z6JQaflVOHy1jq3aT80-6ua894112IvlKWSK8uWYLygVc8fO53xwVQEVcu7Od_VANVKjmstsZjgZrBxMmHgC8V-HwKbyyG_7PWWcGVDbWh2uLnNw', 'link' => '/akademi?filter=2-tahun' ],
        [ 'title' => 'Program Eksekutif', 'desc' => 'Program singkat 6 bulan kapal pesiar (Cook, Steward, Bartender) dengan bonus gratis paspor & seaman book.', 'image' => '/image/Kapal.jpg', 'link' => '/akademi?filter=eksekutif' ]
    ];

    $facilitiesContent = isset($sections['facilities']) ? (is_array($sections['facilities']->section_content) ? $sections['facilities']->section_content : json_decode($sections['facilities']->section_content ?? '[]', true)) : [];
    $facilitiesTitle = $facilitiesContent['title'] ?? 'FASILITAS KELAS DUNIA';
    $facilitiesLabel = $facilitiesTitle; // alias used in view
    $facilitiesItems = $facilitiesContent['items'] ?? [
        [ 'label' => 'DAPUR INDUSTRI', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAuTCak20mOeB9LQyn2XonJILtYY9k6DyYGKEQ_2nztbxQWXwrVPOL29MgalMVIKCAW04dx_vIrTJCd_XfZmfX9_9hbLrXB0cPP_Z2UsA4IYQswE7_qtBrSAXUCYqMucBYQEqjuiG38mvQaMG5r26TUh-29dvwJ_34-CjtOGQkO16jk6q2OBqzcfV9-nc_yifBoKLwOk3ZQgc4Y8cMYrRz7pnjfbDsJcv_KI3heB7aNsCudsGWesMK0CA' ],
        [ 'label' => 'KAMAR SUITE SIMULASI', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCyOX_hVvTkAG09wnSm_vRW8D4osAWduBcFAjzCZ1wV4i4GPLit9wTP_i2XtVSYgamC--GK74WFus4JzhyZYBIq4uQo7edkXb7qbkbYZSD7tyTMmm-avYEYkfxEHRv3d-UVeXaNEwoeW8jpXjQnhYk1Ixp0oGDWNB4GRjOVwWJw9-VOBMkmWx-HYymiZmpE5WXj8wKO1j_zVtxaJ0IuVTJ7-kam2tSORas5a52dmUAOG2LK1tpKCHpOFg' ],
        [ 'label' => 'BAR PELATIHAN', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDA-3TVgjqn3rAEEMHDMk4BdnH6XnDlEPUP2Nc_9LrVXk3EsldakTpUoLH42IgL4tS_sVrXfm3KbpdvDhxRTcJUyVrKQmhaPn_BBDJ0FQiIz9SJi62qfc9pDjuHpvzqiMNxJPWxI8ctpmx-Bz4jTY1IKMeJRtHAnb_9GJQUvK8bEsDw0ux1S4BVwNd1eC9utAz77RQgpUE8mrqmszl64keLmdWPNOJCyYE2gv5BmNUXFWMpsee-QQJ53A' ]
    ];

    $directorContent = isset($sections['director']) ? (is_array($sections['director']->section_content) ? $sections['director']->section_content : json_decode($sections['director']->section_content ?? '[]', true)) : [];
    $directorLabel = $directorContent['label'] ?? 'PESAN DIREKTUR';
    $directorMessage = $directorContent['message'] ?? 'Halo sahabat excellent, Denpasar Hotel School hadir dengan sebuah komitmen untuk mengantarkan calon profesional muda menjadi SDM Indonesia yang unggul dan kompeten. Di Denpasar Hotel School, Anda akan dilatih oleh para praktisi yang telah berpengalaman di bidangnya masing-masing. Mari bergabung bersama kami, Denpasar Hotel School, kami siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global.';
    $directorName = $directorContent['name'] ?? 'I Made Dwija Suastana, S.H., M.H.';
    $directorTitle = $directorContent['title'] ?? 'DIREKTUR DENPASAR HOTEL SCHOOL — SALAM EXCELLENT!';

    $contactContent = isset($sections['contact']) ? (is_array($sections['contact']->section_content) ? $sections['contact']->section_content : json_decode($sections['contact']->section_content ?? '[]', true)) : [];
    $contactDenpasarAddr = $contactContent['denpasar_address'] ?? 'Jl. Sari Dana IV No. 1 Gatsu Barat, Denpasar 80116, Bali';
    $contactDenpasarWa = $contactContent['denpasar_wa'] ?? '+62 81 246 319966';
    $contactDenpasarEmail = $contactContent['denpasar_email'] ?? 'sahabat@dhs.or.id';

    $contactKlungkungAddr = $contactContent['klungkung_address'] ?? 'Jl. Raya Takmung No. 36, Klungkung 80752, Bali';
    $contactKlungkungPhone = $contactContent['klungkung_phone'] ?? '+0366 5582998';
    $contactKlungkungWa = $contactContent['klungkung_wa'] ?? '+62 81 337 106480';

    $contactFormContent = isset($sections['contact_form']) ? (is_array($sections['contact_form']->section_content) ? $sections['contact_form']->section_content : json_decode($sections['contact_form']->section_content ?? '[]', true)) : [];
    $contactFormTitle = $contactFormContent['title'] ?? 'Kirim Pertanyaan';
    $contactFormSubtitle = $contactFormContent['subtitle'] ?? 'Isi formulir — pesan dikirim otomatis ke email resmi kami.';
    $contactFormEmail = $contactFormContent['recipient_email'] ?? ($contactDenpasarEmail ?? 'sahabat@dhs.or.id');
    $contactFormButtonText = $contactFormContent['button_text'] ?? 'KIRIM VIA EMAIL';

    $contactSectionLabel = $contactContent['section_label'] ?? 'KONTAK';
    $contactSectionTitle = $contactContent['section_title'] ?? 'Hubungi Kami.';
    // URL embed untuk iframe peta (disimpan langsung sebagai URL embed dari Google Maps)
    $contactGoogleMapsEmbedUrl = $contactContent['google_maps'] ?? $contactContent['google_maps_url'] ?? '';
    // URL arah untuk tombol "Petunjuk Arah" (URL biasa Google Maps)
    $contactGoogleMapsUrl = $contactContent['google_maps_dir'] ?? $contactContent['google_maps_url'] ?? $footerSettings['google_maps_url'] ?? 'https://maps.google.com/?q=Denpasar+Hotel+School';

    // Jika URL embed kosong atau masih URL biasa, konversi ke format embed
    if (empty($contactGoogleMapsEmbedUrl) || !str_contains($contactGoogleMapsEmbedUrl, '/maps/embed')) {
        $raw = $contactGoogleMapsEmbedUrl ?: $contactGoogleMapsUrl;
        if (preg_match('/[?&]q=([^&]+)/', $raw, $m)) {
            $contactGoogleMapsEmbedUrl = 'https://maps.google.com/maps?q=' . $m[1] . '&output=embed';
        } elseif (preg_match('#/maps/place/([^/@?]+)#', $raw, $m)) {
            $contactGoogleMapsEmbedUrl = 'https://maps.google.com/maps?q=' . $m[1] . '&output=embed';
        } elseif (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $raw, $m)) {
            $contactGoogleMapsEmbedUrl = 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d500!2d' . $m[2] . '!3d' . $m[1] . '!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1';
        } else {
            // Fallback hardcoded ke lokasi DHS Denpasar
            $contactGoogleMapsEmbedUrl = 'https://maps.google.com/maps?q=Jl+Sari+Dana+IV+No+1+Gatsu+Barat+Denpasar+Bali&output=embed';
        }
    }

    $contactLinktreeUrl = $contactContent['linktree'] ?? $contactContent['linktree_url'] ?? $footerSettings['linktree_url'] ?? 'https://linktr.ee/BiayaPendidikan_DHS';

    $partnerContent = isset($sections['partner']) ? (is_array($sections['partner']->section_content) ? $sections['partner']->section_content : json_decode($sections['partner']->section_content ?? '[]', true)) : [];
    $partnerLabel = $partnerContent['label'] ?? 'Kemitraan & Jaringan Global';
    $partnerTitle = $partnerContent['title'] ?? 'Partnership Program (PP DHS)';
    $partnerDesc = $partnerContent['desc'] ?? 'DHS berkomitmen penuh untuk mengintegrasikan pendidikan vokasi dengan dunia industri global. Program ini menjamin penempatan magang internasional (OJT) berkualitas dan penyaluran kerja langsung di hotel bintang 4 & 5 serta kapal pesiar mewah tanpa potongan agen fee (Zero Agent Fee).';

    $newsContent = isset($sections['news']) ? (is_array($sections['news']->section_content) ? $sections['news']->section_content : json_decode($sections['news']->section_content ?? '[]', true)) : [];
    $newsLabel = $newsContent['label'] ?? 'WAWASAN';
    $newsSectionTitle = $newsContent['title'] ?? 'Berita & Artikel.';
?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center text-center overflow-hidden">
        <div class="absolute inset-0 bg-black/35 z-10"></div>
        <img alt="Hotel Lobby" class="absolute inset-0 w-full h-full object-cover"
            src="<?php echo e($heroBgImage); ?>">

        <div class="relative z-20 px-6 max-w-4xl mx-auto mt-20">
            <div class="mb-6 inline-flex items-center space-x-3 text-white">
                <span class="h-[1px] w-8 bg-white/60"></span>
                <span class="label-text text-white/90"
                    data-id="<?php echo e($heroOverline); ?>"
                    data-en="<?php echo e($heroOverline); ?>"><?php echo e($heroOverline); ?></span>
                <span class="h-[1px] w-8 bg-white/60"></span>
            </div>
            <h1 class="text-5xl md:text-7xl font-serif text-white mb-10 leading-tight">
                <span data-id="<?php echo e($heroHeadline); ?>"
                    data-en="<?php echo e($heroHeadline); ?>"><?php echo e($heroHeadline); ?></span>
            </h1>

            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <!-- Used bg-dhs-navy instead of #1C1A17 as per DESIGN.md -->
                <a class="px-8 py-4 bg-dhs-navy text-white text-sm font-bold tracking-widest uppercase hover:bg-dhs-darknavy transition-colors rounded-md"
                    href="<?php echo e($heroCta1Link); ?>"><span data-id="<?php echo e($heroCta1Text); ?>" data-en="<?php echo e($heroCta1Text); ?>"><?php echo e($heroCta1Text); ?></span></a>
                <a class="px-8 py-4 bg-white/20 backdrop-blur-sm text-white text-sm font-bold tracking-widest uppercase border border-white/40 hover:bg-white/30 transition-colors rounded-md"
                    href="<?php echo e($heroCta2Link); ?>"><span data-id="<?php echo e($heroCta2Text); ?>" data-en="<?php echo e($heroCta2Text); ?>"><?php echo e($heroCta2Text); ?></span></a>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 flex flex-col items-center">
            <span class="text-xs uppercase tracking-widest text-white mb-3" data-id="<?php echo e($heroScrollText); ?>"
                data-en="<?php echo e($heroScrollText); ?>"><?php echo e($heroScrollText); ?></span>
            <!-- Animated down arrow -->
            <div class="flex flex-col items-center">
                <span class="material-icons text-white/80 scroll-arrow"
                    style="animation: scrollArrow 1.5s ease-in-out infinite;">expand_more</span>
                <span class="material-icons text-white/80 scroll-arrow"
                    style="animation: scrollArrow 1.5s ease-in-out 0.3s infinite;">expand_more</span>
            </div>
        </div>
        <style>
            @keyframes scrollArrow {
                0% {
                    opacity: 0;
                    transform: translateY(-6px);
                }

                50% {
                    opacity: 1;
                    transform: translateY(0);
                }

                100% {
                    opacity: 0;
                    transform: translateY(6px);
                }
            }
        </style>
    </section>

    <!-- About Intro Section -->
    <section class="py-24 md:py-32 px-6 md:px-16 max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-16 md:gap-24 items-center">
            <div data-reveal="fade-right">
                <!-- text-primary resolved to DHS Red (#D62828) as per DESIGN.md -->
                <span class="label-text text-primary mb-4 block" data-id="<?php echo e($aboutLabel); ?>" data-en="ABOUT US"><?php echo e($aboutLabel); ?></span>
                <h2 class="text-5xl md:text-6xl font-serif mb-8 leading-tight text-text-light">
                    <span data-id="<?php echo e($aboutHeadline); ?>" data-en="<?php echo e($aboutHeadline); ?>"><?php echo e($aboutHeadline); ?></span>
                </h2>

                <div class="space-y-6 text-dhs-darknavy leading-relaxed">
                    <p><span data-id="<?php echo e($aboutP1); ?>" data-en="<?php echo e($aboutP1); ?>"><?php echo e($aboutP1); ?></span></p>
                    <p><span data-id="<?php echo e($aboutP2); ?>" data-en="<?php echo e($aboutP2); ?>"><?php echo e($aboutP2); ?></span></p>
                </div>

                <div class="flex space-x-16 mt-12 pt-12 border-t border-black/10">
                    <!-- TODO: Konfirmasi statistik resmi DHS sebelum publish -->
                    <!--
                                    <div>
                                        <div class="text-4xl font-serif mb-2 flex items-start text-text-light">35<span class="text-primary text-2xl font-bold">+</span></div>
                                        <div class="label-text text-muted-light text-[0.6rem]">YEARS OF HERITAGE</div>
                                    </div>
                                    <div>
                                        <div class="text-4xl font-serif mb-2 flex items-start text-text-light">12K<span class="text-primary text-2xl font-bold">+</span></div>
                                        <div class="label-text text-muted-light text-[0.6rem]">SUCCESSFUL ALUMNI</div>
                                    </div>
                                    -->
                    <div class="text-sm italic text-muted-light"
                        data-id="<?php echo e($aboutNote); ?>"
                        data-en="<?php echo e($aboutNote); ?>">
                        <?php echo e($aboutNote); ?>

                    </div>
                </div>
            </div>

            <div class="relative h-[600px] md:h-[700px] w-full ml-auto md:w-[85%]" data-reveal="fade-left" data-delay="200">
                <div class="absolute -inset-4 bg-surface-light -z-10 translate-x-4 translate-y-4"></div>
                <img alt="Hotel Interior" class="w-full h-full object-cover shadow-sm"
                    src="<?php echo e($aboutImage); ?>">
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="py-24 bg-surface-light px-6 md:px-16">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 md:gap-24">
            <div data-reveal="fade-right">
                <h2 class="text-5xl md:text-6xl font-serif mb-16 leading-tight text-text-light">
                    <span data-id="<?php echo e($visionSectionTitle); ?>" data-en="Vision & Mission"><?php echo e($visionSectionTitle); ?></span>
                </h2>

                <div class="mb-12">
                    <span class="label-text text-primary mb-4 block" data-id="<?php echo e($visionVisiLabel); ?>" data-en="VISION"><?php echo e($visionVisiLabel); ?></span>
                    <p class="font-serif text-2xl italic leading-relaxed text-muted-light">
                        <span>"<?php echo e($visionText); ?>"</span>
                    </p>
                </div>

                <div>
                    <span class="label-text text-primary mb-6 block" data-id="<?php echo e($visionMisiLabel); ?>" data-en="MISSION"><?php echo e($visionMisiLabel); ?></span>
                    <ul class="space-y-4">
                        <?php $__currentLoopData = $visionMisiItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $misi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-start">
                            <span class="material-icons text-primary mr-4 mt-1">check_circle_outline</span>
                            <span class="text-muted-light leading-relaxed" data-id="<?php echo e($misi); ?>"><?php echo e($misi); ?></span>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 content-center">
                <!-- Grid cards for Core Values + Global Network -->
                <?php $__currentLoopData = $visionCoreValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-background-light p-6 flex flex-col justify-between h-56 transition-transform hover:-translate-y-1 duration-300 shadow-sm card-hover"
                    data-reveal="zoom-in" data-delay="<?php echo e(($idx + 1) * 100); ?>">
                    <span class="material-icons text-primary text-3xl"><?php echo e($val['icon'] ?? 'verified'); ?></span>
                    <div>
                        <h4 class="font-bold text-sm mb-1 text-text-light" data-id="<?php echo e($val['title'] ?? ''); ?>"><?php echo e($val['title'] ?? ''); ?></h4>
                        <p class="text-[0.7rem] text-muted-light leading-relaxed" data-id="<?php echo e($val['desc'] ?? ''); ?>"><?php echo e($val['desc'] ?? ''); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Campus Life Gallery -->
    <section class="py-12 bg-surface-light px-6 md:px-16">
        <div class="max-w-7xl mx-auto">
            <h3 class="text-center font-serif text-2xl mb-12 text-text-light" data-reveal="fade-up"><span data-id="<?php echo e($campusTitle); ?>" data-en="<?php echo e($campusTitle); ?>"><?php echo e($campusTitle); ?></span></h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php $__currentLoopData = $campusFotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <img alt="<?php echo e($foto['alt'] ?? 'Foto Kampus'); ?>" class="w-full h-[400px] object-cover shadow-sm" data-reveal="zoom-up"
                    data-delay="<?php echo e(($idx + 1) * 150); ?>"
                    src="<?php echo e($foto['src'] ?? ''); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Disciplines & Programs Section -->
    <section class="py-24 px-6 md:px-16 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16" data-reveal="fade-up">
            <div>
                <span class="label-text text-primary mb-4 block" data-id="<?php echo e($academyLabel); ?>" data-en="ACADEMY"><?php echo e($academyLabel); ?></span>
                <h2 class="text-5xl md:text-6xl font-serif leading-tight text-text-light">
                    <span data-id="<?php echo e($academySectionTitle); ?>" data-en="<?php echo e($academySectionTitle); ?>"><?php echo e($academySectionTitle); ?></span>
                </h2>
            </div>
            <a class="label-text border-b border-primary pb-1 mt-6 md:mt-0 hover:text-primary transition-colors text-primary flex items-center"
                href="/akademi">
                <span data-id="LIHAT SEMUA PROGRAM" data-en="VIEW ALL PROGRAMS">LIHAT SEMUA PROGRAM</span> <span class="material-icons text-xs ml-1">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php $__currentLoopData = $academyCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border border-black/10 group cursor-pointer bg-white shadow-sm transition-shadow duration-300 hover:shadow-md card-hover"
                data-reveal="fade-up" data-delay="<?php echo e(($idx + 1) * 150); ?>">
                <div class="overflow-hidden h-[300px]">
                    <img alt="<?php echo e($card['title'] ?? ''); ?>"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        src="<?php echo e($card['image'] ?? ''); ?>">
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-serif mb-4 text-text-light"><span data-id="<?php echo e($card['title'] ?? ''); ?>"><?php echo e($card['title'] ?? ''); ?></span></h3>
                    <p class="text-muted-light mb-8 text-sm leading-relaxed">
                        <span data-id="<?php echo e($card['desc'] ?? ''); ?>"><?php echo e($card['desc'] ?? ''); ?></span>
                    </p>
                    <a class="label-text text-xs border-b border-text-light/30 pb-1 hover:text-primary transition-colors"
                        href="<?php echo e($card['link'] ?? '/akademi'); ?>"><span data-id="DETAIL PROGRAM" data-en="PROGRAM DETAILS">DETAIL PROGRAM</span></a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <!-- Facilities Showcase -->
    <section class="py-24 px-6 md:px-16 max-w-7xl mx-auto border-t border-black/10">
        <div class="text-center mb-16" data-reveal="fade-up">
            <span class="label-text text-text-light" data-id="<?php echo e($facilitiesLabel); ?>" data-en="FACILITIES"><?php echo e($facilitiesLabel); ?></span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php if(isset($facilitiesItems[0])): ?>
            <div class="md:col-span-2 relative h-[500px] md:h-[600px] group overflow-hidden" data-reveal="fade-right">
                <img alt="<?php echo e($facilitiesItems[0]['label'] ?? 'Fasilitas'); ?>"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    src="<?php echo e($facilitiesItems[0]['image'] ?? ''); ?>">
                <div class="absolute bottom-6 left-6 bg-black/60 backdrop-blur-sm px-4 py-2 text-white text-xs uppercase tracking-wider" data-id="<?php echo e($facilitiesItems[0]['label'] ?? ''); ?>"><?php echo e($facilitiesItems[0]['label'] ?? ''); ?></div>
            </div>
            <?php endif; ?>

            <div class="flex flex-col gap-6 h-[500px] md:h-[600px]" data-reveal="fade-left" data-delay="200">
                <?php $__currentLoopData = array_slice($facilitiesItems, 1, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="relative h-1/2 group overflow-hidden">
                    <img alt="<?php echo e($fac['label'] ?? 'Fasilitas'); ?>"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        src="<?php echo e($fac['image'] ?? ''); ?>">
                    <div class="absolute bottom-6 left-6 bg-black/60 backdrop-blur-sm px-4 py-2 text-white text-xs uppercase tracking-wider" data-id="<?php echo e($fac['label'] ?? ''); ?>"><?php echo e($fac['label'] ?? ''); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Message from Director Section -->
    <section class="py-32 bg-surface-light px-6 md:px-16 relative">
        <div class="max-w-4xl mx-auto text-center relative z-10 text-text-light" data-reveal="zoom-in">
            <span class="label-text text-primary mb-8 block"><?php echo e($directorLabel); ?></span>
            <h2 class="text-2xl md:text-3xl font-serif leading-relaxed mb-8">
                <span>"<?php echo e($directorMessage); ?>"</span>
            </h2>
            <div>
                <h4 class="font-bold text-sm tracking-widest uppercase mb-1"><?php echo e($directorName); ?></h4>
                <p class="label-text text-muted-light"><?php echo e($directorTitle); ?></p>
            </div>
        </div>
    </section>

    <!-- Insights & Articles Section -->
    <section class="py-24 px-6 md:px-16 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16" data-reveal="fade-up">
            <div>
                <span class="label-text text-primary mb-4 block" data-id="WAWASAN" data-en="INSIGHTS">WAWASAN</span>
                <h2 class="text-5xl md:text-6xl font-serif leading-tight text-text-light">
                    <span data-id="Berita &amp; Artikel." data-en="News &amp; Articles.">Berita &amp; Artikel.</span>
                </h2>
            </div>
            <a class="label-text border-b border-primary pb-1 mt-6 md:mt-0 hover:text-primary transition-colors text-primary"
                href="/berita">
                <span data-id="LIHAT ARSIP" data-en="VIEW ARCHIVE">LIHAT ARSIP</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Main Featured Article -->
            <?php $mainArticle = $featuredNews->firstWhere('is_featured', 1) ?? $featuredNews->first(); ?>
            <?php if($mainArticle): ?>
            <div class="group cursor-pointer" data-reveal="fade-right">
                <div class="overflow-hidden mb-8 h-[400px]">
                    <img alt="<?php echo e($mainArticle->title); ?>"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        src="<?php echo e($mainArticle->thumbnail_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuAO3TjdyecwwVtS9SP20fK3_4C9aPBiHhONLdja28RvyQ_WiSbCtw3yhXXWyIA-_0QjM3PyUVN4YdtPRrVPQKbZXYiLJcuFqUp0dShFMbOX2jWwnoDr2-hu_aUwmAMCP1at0lGcWERGUPEm1WhFlotXnftrEp4j1XKnawHtj_e-Q7d2w3zSUOtfQAFRpOIdTo4Ee8E6dy6fcOnjn_g5oKV5WL04cs1Ghu3nWQ9ErWT5FTk7UVtFtM8_ww'); ?>">
                </div>
                <div class="flex items-center space-x-3 mb-4">
                    <span class="label-text text-primary text-[0.6rem]" data-id="<?php echo e(strtoupper($mainArticle->category)); ?>" data-en="<?php echo e(strtoupper($mainArticle->category)); ?>"><?php echo e(strtoupper($mainArticle->category)); ?></span>
                    <span class="w-1 h-1 rounded-full bg-muted-light/30"></span>
                    <span class="label-text text-muted-light text-[0.6rem]" data-id="<?php echo e($mainArticle->created_at->format('d M Y')); ?>" data-en="<?php echo e($mainArticle->created_at->format('M d, Y')); ?>"><?php echo e($mainArticle->created_at->format('d M Y')); ?></span>
                </div>
                <h3
                    class="text-3xl font-serif mb-4 leading-tight text-text-light group-hover:text-primary transition-colors">
                    <span data-id="<?php echo e($mainArticle->title); ?>"
                        data-en="<?php echo e($mainArticle->title); ?>"><?php echo e($mainArticle->title); ?></span>
                </h3>
                <p class="text-muted-light mb-6 leading-relaxed text-sm">
                    <span
                        data-id="<?php echo e($mainArticle->excerpt ?? ''); ?>"
                        data-en="<?php echo e($mainArticle->excerpt ?? ''); ?>"><?php echo e($mainArticle->excerpt ?? ''); ?></span>
                </p>
                <a class="label-text text-xs border-b border-text-light/30 pb-1 hover:text-primary transition-colors"
                    href="/berita/<?php echo e($mainArticle->slug); ?>">
                    <span data-id="BACA SELENGKAPNYA &rarr;" data-en="READ FULL ARTICLE &rarr;">BACA SELENGKAPNYA
                        &rarr;</span>
                </a>
            </div>
            <?php endif; ?>

            <!-- Small Articles List -->
            <div class="flex flex-col gap-8" data-reveal="fade-left" data-delay="200">
                <?php $__currentLoopData = $featuredNews->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($article->id !== ($mainArticle->id ?? null)): ?>
                <a href="/berita/<?php echo e($article->slug); ?>" class="flex gap-6 group cursor-pointer border-b border-black/5 pb-8 no-underline">
                    <div class="w-32 h-32 flex-shrink-0 overflow-hidden">
                        <img alt="<?php echo e($article->title); ?>"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            src="<?php echo e($article->thumbnail_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuAOSLVSRHrQY7s9VWmSs04TV3EjPDPwXecszDnbnTZdlKMbo2Vd0WroDGcDAhcWm7TbrOYNO05puHkFoqlIClDRA0hdXnsz1waqZytA_z-Eec9UZOlRQxyNqwul_0HBclEU_z_dH9iOsQ8A3rsvPwYTtYkqJc1BIsATalvHW5OSyjLNtrmfnTQeXWR4RmgzYkva0lr7Rmd_HeZO2e4pWgzUtPYdBqc7wROamPgt_YrSYvQHNQ5cIqdIdQ'); ?>">
                    </div>
                    <div>
                        <span class="label-text text-primary text-[0.6rem] mb-2 block" data-id="<?php echo e(strtoupper($article->category)); ?>"
                            data-en="<?php echo e(strtoupper($article->category)); ?>"><?php echo e(strtoupper($article->category)); ?></span>
                        <h4
                            class="text-xl font-serif mb-2 leading-snug text-text-light group-hover:text-primary transition-colors">
                            <span data-id="<?php echo e($article->title); ?>"
                                data-en="<?php echo e($article->title); ?>"><?php echo e($article->title); ?></span>
                        </h4>
                        <span class="label-text text-muted-light text-[0.6rem]" data-id="<?php echo e($article->created_at->format('d M Y')); ?>"
                            data-en="<?php echo e($article->created_at->format('M d, Y')); ?>"><?php echo e($article->created_at->format('d M Y')); ?></span>
                    </div>
                </a>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <?php
        $mitraIndustri = $partners->filter(fn($p) => $p->partner_group === 'mitra_industri')->values();
        $partnership = $partners->filter(fn($p) => $p->partner_group === 'partnership')->values();

        $renderCard = function ($item) {
            $name = e($item['name'] ?? '');
            $sub  = e($item['sub'] ?? '');
            $logo = $item['logo_url'] ?? '';
            $font = $item['font'] ?? 'font-sans text-sm font-bold tracking-wider';
            $out = '<div class="bg-white border border-black/10 hover:border-primary/30 hover:shadow-md transition-all duration-300 flex items-center justify-center w-48 h-24 p-4 cursor-default select-none shrink-0 rounded-lg">';
            if ($logo) {
                $out .= '<div class="flex items-center justify-center w-full h-full"><img src="' . e($logo) . '" alt="' . $name . '" class="max-w-full max-h-full object-contain" loading="lazy"></div>';
            } else {
                $out .= '<div class="text-center">';
                $out .= '<div class="' . $font . ' text-dhs-navy">' . $name . '</div>';
                if ($sub) {
                    $out .= '<div class="text-[0.55rem] font-sans tracking-[0.2em] text-muted-light uppercase mt-1">' . $sub . '</div>';
                }
                $out .= '</div>';
            }
            $out .= '</div>';
            return $out;
        };

        $marqueeItems = function($items) use ($renderCard) {
            $out = '';
            foreach ($items as $item) { $out .= $renderCard(['name' => $item['name'], 'sub' => $item['country'] ?? null, 'logo_url' => $item['logo_url'] ?? '', 'font' => 'font-sans text-sm font-bold tracking-wider']); }
            foreach ($items as $item) { $out .= $renderCard(['name' => $item['name'], 'sub' => $item['country'] ?? null, 'logo_url' => $item['logo_url'] ?? '', 'font' => 'font-sans text-sm font-bold tracking-wider']); }
            return $out;
        };
    ?>

    <!-- Partnership & Mitra Section — Single Section, Two Rows -->
    <?php if($partners->count() > 0): ?>
    <section class="py-20 md:py-24 bg-white border-t border-b border-black/5 overflow-hidden">
        <div class="max-w-[1280px] mx-auto px-5 md:px-16 text-center mb-10">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                <span data-id="<?php echo e($partnerLabel); ?>" data-en="OUR PARTNERS"><?php echo e($partnerLabel); ?></span>
            </span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6" data-reveal="fade-up">
                <span data-id="<?php echo e($partnerTitle); ?>" data-en="Trusted by Leading Institutions"><?php echo e($partnerTitle); ?></span>
            </h2>
            <p class="text-base text-muted-light max-w-3xl mx-auto leading-relaxed" data-reveal="fade-up" data-delay="100">
                <?php echo e(strip_tags($partnerDesc)); ?>

            </p>
        </div>
        <div class="space-y-6 select-none" data-reveal="fade-up" data-delay="200">
            
            <?php if($mitraIndustri->count() > 0): ?>
            <div class="marquee-container relative flex overflow-hidden w-full">
                <div class="marquee-track flex shrink-0 gap-6 py-4 animate-marquee-left" data-direction="left">
                    <?php echo $marqueeItems($mitraIndustri); ?>

                </div>
            </div>
            <?php endif; ?>
            
            <?php if($partnership->count() > 0): ?>
            <div class="marquee-container relative flex overflow-hidden w-full">
                <div class="marquee-track flex shrink-0 gap-6 py-4 animate-marquee-right" data-direction="right">
                    <?php echo $marqueeItems($partnership); ?>

                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <style>
        @keyframes marquee-left {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        @keyframes marquee-right {
            0%   { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }
        .animate-marquee-left {
            animation: marquee-left var(--dur, 40s) linear infinite;
            will-change: transform;
            backface-visibility: hidden;
        }
        .animate-marquee-right {
            animation: marquee-right var(--dur, 40s) linear infinite;
            will-change: transform;
            backface-visibility: hidden;
        }
        .marquee-container:hover .animate-marquee-left,
        .marquee-container:hover .animate-marquee-right {
            animation-play-state: paused;
        }
    </style>
    <script>
    (function() {
        // Kecepatan pixel per detik yang diinginkan (sama untuk semua baris)
        var PX_PER_SECOND = 80;
        function initMarquee() {
            document.querySelectorAll('.marquee-track').forEach(function(track) {
                // scrollWidth adalah total lebar semua item (sudah diduplikasi 2x di PHP)
                // Kita perlu lebar SETENGAH-nya (1 set item)
                var halfWidth = track.scrollWidth / 2;
                if (halfWidth > 0) {
                    var duration = halfWidth / PX_PER_SECOND;
                    track.style.setProperty('--dur', duration.toFixed(2) + 's');
                }
            });
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMarquee);
        } else {
            initMarquee();
        }
        // Re-hitung saat resize (tablet/mobile ukuran berubah)
        var resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(initMarquee, 200);
        });
    })();
    </script>

    
    <?php echo $__env->make('components.testimonial-slider', ['testimonials' => $testimonials], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Contact Form Section -->
    
    <section id="contact-section" class="py-24 bg-surface-light px-6 md:px-16">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 md:gap-24">
            <div class="text-text-light" data-reveal="fade-right">
                <span class="label-text text-primary mb-4 block" data-id="KONTAK" data-en="CONTACT"><?php echo e($contactSectionLabel); ?></span>
                <h2 class="text-5xl md:text-7xl font-serif mb-10 leading-tight">
                    <span data-id="Hubungi Kami." data-en="Contact Us."><?php echo e($contactSectionTitle); ?></span>
                </h2>

                <div class="space-y-8">
                    <div>
                        <span class="label-text text-primary mb-2 block" data-id="KAMPUS DENPASAR" data-en="DENPASAR CAMPUS">KAMPUS DENPASAR</span>
                        <p class="text-base font-semibold"><?php echo e($contactDenpasarAddr); ?></p>
                        <p class="text-sm text-muted-light mt-1">WA: <?php echo e($contactDenpasarWa); ?></p>
                        <p class="text-sm text-muted-light">Email: <?php echo e($contactDenpasarEmail); ?></p>
                    </div>
                    <div>
                        <span class="label-text text-primary mb-2 block" data-id="KAMPUS KLUNGKUNG" data-en="KLUNGKUNG CAMPUS">KAMPUS KLUNGKUNG</span>
                        <p class="text-base font-semibold"><?php echo e($contactKlungkungAddr); ?></p>
                        <p class="text-sm text-muted-light mt-1">Telp: <?php echo e($contactKlungkungPhone); ?> | WA: <?php echo e($contactKlungkungWa); ?></p>
                    </div>
                    <div>
                        <span class="label-text text-muted-light mb-2 block" data-id="PENDAFTARAN ONLINE" data-en="ONLINE REGISTRATION">PENDAFTARAN ONLINE</span>
                        <p class="text-sm font-medium">Linktree: <a href="<?php echo e($contactLinktreeUrl); ?>" target="_blank" class="underline text-primary hover:text-dhs-darknavy"><?php echo e(parse_url($contactLinktreeUrl, PHP_URL_HOST) ?: 'Linktree'); ?></a></p>

                    </div>
                    
                    <div class="pt-2">
                        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $contactDenpasarWa)); ?>"
                            target="_blank"
                            class="inline-flex items-center gap-3 px-6 py-3 text-white text-sm font-bold tracking-wider uppercase rounded-lg transition-all duration-200 shadow-md hover:shadow-lg hover:scale-105"
                            style="background:#25D366;">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Chat WhatsApp Langsung
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form Card -->
            <script>window.__dhsContact={cats:<?php echo json_encode($programCategories ?? [], 15, 512) ?>,wa:"<?php echo e(preg_replace('/[^0-9]/', '', $contactDenpasarWa)); ?>"};</script>
            <div class="bg-white p-10 shadow-lg border border-black/5 rounded-2xl" data-reveal="fade-left" data-delay="150"
                x-data="contactForm()"
                x-init="initFromWindow()"
                >
                <h3 class="text-2xl font-serif mb-1 text-text-light"><?php echo e($contactFormTitle); ?></h3>
                <p class="text-sm text-muted-light mb-8"><?php echo e($contactFormSubtitle); ?></p>

                <form class="space-y-6" @submit.prevent="submitToWhatsApp()">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="contact-label">NAMA LENGKAP</label>
                            <input x-model="formData.nama" class="contact-field" placeholder="Nama lengkap Anda" type="text" required>
                        </div>
                        <div>
                            <label class="contact-label">EMAIL</label>
                            <input x-model="formData.email" class="contact-field" placeholder="email@example.com" type="email" required>
                        </div>
                    </div>

                    <div>
                        <label class="contact-label">KATEGORI DURASI</label>
                        <div class="contact-select-wrap">
                            <select x-model="formData.kategori" @change="updatePrograms()" class="contact-select" required>
                                <option value="">— Pilih Kategori Durasi —</option>
                                <template x-for="cat in programsData" :key="cat.category_key">
                                    <option :value="cat.category_key" x-text="cat.category_name || cat.label"></option>
                                </template>
                            </select>
                            <span class="contact-chevron"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></span>
                        </div>
                    </div>

                    <div>
                        <label class="contact-label">PROGRAM YANG DIMINATI</label>
                        <div class="contact-select-wrap" :class="!formData.kategori ? 'opacity-50 pointer-events-none' : ''">
                            <select x-model="formData.program" class="contact-select" :disabled="!formData.kategori" required>
                                <option value="">— Pilih Program —</option>
                                <template x-for="prog in filteredPrograms" :key="prog.id">
                                    <option :value="prog.id" x-text="(prog.title || prog.program_name || prog) + (prog.duration ? ' (' + prog.duration + ')' : '')"></option>
                                </template>
                            </select>
                            <span class="contact-chevron"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></span>
                        </div>
                    </div>

                    <div>
                        <label class="contact-label">PESAN / PERTANYAAN</label>
                        <textarea x-model="formData.pesan" class="contact-field resize-none" placeholder="Tuliskan pertanyaan atau informasi yang ingin Anda ketahui..." rows="4" required></textarea>
                    </div>

                    <button type="submit" class="w-full py-4 text-white text-sm font-bold tracking-widest uppercase transition-all duration-200 rounded-xl flex items-center justify-center gap-3 hover:shadow-lg active:scale-[0.98] mt-2"
                        style="background:#25D366;">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        <span>KIRIM VIA WHATSAPP</span>
                    </button>
                    <p class="text-center text-xs text-muted-light">Pesan akan langsung terkirim ke WhatsApp resmi Denpasar Hotel School.</p>
                </form>
            </div>
        </div>
    </section>

    <style>
        .contact-label {
            display: block;
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(0,0,0,0.45);
            margin-bottom: 8px;
            font-family: 'Inter', sans-serif;
        }
        .contact-field {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1.5px solid rgba(0,0,0,0.15);
            outline: none;
            padding: 9px 0;
            color: #1a1a2e;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s;
        }
        .contact-field::placeholder { color: rgba(0,0,0,0.28); }
        .contact-field:focus { border-bottom-color: #0E06B4; }
        .contact-select-wrap {
            position: relative;
            transition: opacity 0.2s;
        }
        .contact-select {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1.5px solid rgba(0,0,0,0.15);
            outline: none;
            padding: 9px 28px 9px 0;
            color: #1a1a2e;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .contact-select:focus { border-bottom-color: #0E06B4; }
        .contact-select option { background: #fff; color: #1a1a2e; }
        .contact-select:disabled { cursor: not-allowed; color: rgba(0,0,0,0.3); }
        .contact-chevron {
            position: absolute;
            right: 4px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: rgba(0,0,0,0.35);
            display: flex;
            align-items: center;
        }
    </style>

    <!-- Visit / Directions Section -->
    <section class="w-full">
        <iframe
            src="<?php echo e($contactGoogleMapsEmbedUrl); ?>"
            width="100%" height="480" style="border:0; display:block;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" title="Denpasar Hotel School Location">
        </iframe>

        <!-- Location Info Bar — static block below the map, never overlaps footer -->
        <div
            class="bg-white border-t border-black/8 px-6 md:px-16 py-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-sm">
            <div class="flex items-center gap-4">
                <span class="material-icons text-primary text-2xl flex-shrink-0">location_on</span>
                <div>
                    <p class="text-xs font-bold tracking-widest uppercase text-text-light mb-0.5">Denpasar Hotel School</p>
                    <p class="text-[0.7rem] text-muted-light"><?php echo e($contactDenpasarAddr); ?></p>
                </div>
            </div>
            <a href="<?php echo e($contactGoogleMapsUrl); ?>" target="_blank" rel="noopener"
                class="flex-shrink-0 flex items-center gap-1.5 px-6 py-2.5 bg-primary text-white text-[0.65rem] font-bold tracking-widest uppercase hover:bg-red-700 transition-all duration-200 hover:shadow-md rounded-sm">
                <span class="material-icons text-sm">directions</span>
                <span data-id="PETUNJUK ARAH" data-en="GET DIRECTIONS">PETUNJUK ARAH</span>
            </a>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/welcome.blade.php ENDPATH**/ ?>