@extends('layouts.app')

@section('title', 'Denpasar Hotel School — International Vocational Training Center in Bali')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center text-center overflow-hidden">
        <div class="absolute inset-0 bg-black/35 z-10"></div>
        <img alt="Hotel Lobby" class="absolute inset-0 w-full h-full object-cover"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBaJKFYExsjON0pHP43rfmOAIqTkD_R2sTlmKK5Y3CMDGPSja6oJ9DR5erhpkcJFaGwf8hwJZD58ClcpjuTPYEL5LyfjSjhB-t-AumWxxUO-avGgwTwc2wPhoyV6tw23si9SHWgb-5qyJtdTi6WaHdheSZI6A0nWVeXVQ69zkjhtBFvmGPvNvIy5vgQ3-jvlnbQ4bpVLKjjmedqgkXlfk0i_oXHtaIcsJSv5idQg1RZWqqLN8RrwIF70A">

        <div class="relative z-20 px-6 max-w-4xl mx-auto mt-20">
            <div class="mb-6 inline-flex items-center space-x-3 text-white">
                <span class="h-[1px] w-8 bg-white/60"></span>
                <span class="label-text text-white/90"
                    data-id="DENPASAR HOTEL SCHOOL — PUSAT PELATIHAN VOKASI INTERNASIONAL DI BALI"
                    data-en="DENPASAR HOTEL SCHOOL — INTERNATIONAL VOCATIONAL TRAINING CENTER IN BALI">DENPASAR HOTEL SCHOOL
                    — PUSAT PELATIHAN VOKASI INTERNASIONAL DI BALI</span>
                <span class="h-[1px] w-8 bg-white/60"></span>
            </div>
            <h1 class="text-5xl md:text-7xl font-serif text-white mb-10 leading-tight">
                <span data-id="Membentuk Masa Depan Perhotelan Global"
                    data-en="Crafting The Future Of Global Hospitality">Membentuk Masa Depan Perhotelan Global</span>
            </h1>

            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <!-- Used bg-dhs-navy instead of #1C1A17 as per DESIGN.md -->
                <a class="px-8 py-4 bg-dhs-navy text-white text-sm font-bold tracking-widest uppercase hover:bg-dhs-darknavy transition-colors rounded-md"
                    href="/akademi"><span data-id="JELAJAHI PROGRAM" data-en="EXPLORE PROGRAMS">JELAJAHI PROGRAM</span></a>
                <a class="px-8 py-4 bg-white/20 backdrop-blur-sm text-white text-sm font-bold tracking-widest uppercase border border-white/40 hover:bg-white/30 transition-colors rounded-md"
                    href="/cara-mendaftar"><span data-id="DAFTAR SEKARANG" data-en="REGISTER NOW">DAFTAR SEKARANG</span></a>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 flex flex-col items-center">
            <span class="text-xs uppercase tracking-widest text-white mb-3" data-id="Geser Untuk Scroll"
                data-en="Swipe To Scroll">Geser Untuk Scroll</span>
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
                <span class="label-text text-primary mb-4 block" data-id="SEKILAS DHS" data-en="ABOUT DHS">SEKILAS
                    DHS</span>
                <h2 class="text-5xl md:text-6xl font-serif mb-8 leading-tight text-text-light">
                    <span data-id="Transformasi Menuju Unggul." data-en="Transforming Into Excellent.">Transformasi Menuju
                        Unggul.</span>
                </h2>

                <div class="space-y-6 text-dhs-darknavy leading-relaxed">
                    <p><span data-id="Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi."
                            data-en="Denpasar Hotel School (DHS) is a hospitality education and training institution that offers overseas education by integrating educational and training institutions with the industrial world. DHS operates under the Guna Widya Paramesthi Foundation.">Denpasar
                            Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung
                            pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia
                            industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi.</span></p>
                    <p><span data-id="Lembaga ini didirikan untuk memberi kesempatan generasi muda Indonesia menjadi tenaga profesional bidang perhotelan, hospitality, kapal pesiar dan pariwisata, serta belajar sambil bekerja di luar negeri."
                            data-en="This institution was established to provide opportunities for the young generation of Indonesia to become professionals in hotel, hospitality, cruise lines, and tourism, and to learn while working abroad.">Lembaga
                            ini didirikan untuk memberi kesempatan generasi muda Indonesia menjadi tenaga profesional bidang
                            perhotelan, hospitality, kapal pesiar dan pariwisata, serta belajar sambil bekerja di luar
                            negeri.</span></p>
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
                        data-id="Mencetak SDM pariwisata yang unggul, kompeten, dan siap bersaing di tingkat global."
                        data-en="Producing outstanding, competent tourism human resources ready to compete globally.">
                        Mencetak SDM pariwisata yang unggul, kompeten, dan siap bersaing di tingkat global.
                    </div>
                </div>
            </div>

            <div class="relative h-[600px] md:h-[700px] w-full ml-auto md:w-[85%]" data-reveal="fade-left" data-delay="200">
                <div class="absolute -inset-4 bg-surface-light -z-10 translate-x-4 translate-y-4"></div>
                <img alt="Hotel Interior" class="w-full h-full object-cover shadow-sm"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5jkBzd0EqrT-cphGIkzHYDH2a7dpxzv95e4cWzjIaFRYe8B3poCp2NncsdrneEW_ldLWrzvbO4JcdyzzGiQ-Mvb33B6kEHzU80DleUBPVkvlrCikONCi2W8yS5aMmee0S50iv_AYi1wUI-pnY1lPSKs2H7rnAXGxAPLvpZ9j5QBG9pWjHTb3FiXnNHZa6j5uJnKPdjulHepAKqk6Eb1zivof6CfMQt0IRObJoQROAn60P6jzRyfcrAQ">
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="py-24 bg-surface-light px-6 md:px-16">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 md:gap-24">
            <div data-reveal="fade-right">
                <h2 class="text-5xl md:text-6xl font-serif mb-16 leading-tight text-text-light">
                    <span data-id="Standar Visioner." data-en="Visionary Standards.">Standar Visioner.</span>
                </h2>

                <div class="mb-12">
                    <span class="label-text text-primary mb-4 block" data-id="VISI" data-en="VISION">VISI</span>
                    <p class="font-serif text-2xl italic leading-relaxed text-muted-light">
                        <span
                            data-id="&ldquo;Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global.&rdquo;"
                            data-en="&ldquo;Transforming high school, vocational school, and equivalent graduates into professionals in hospitality and tourism who are willing and able to compete globally.&rdquo;">"Mentransformasi
                            lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata
                            yang mau dan mampu bersaing di tingkat global."</span>
                    </p>
                </div>

                <div>
                    <span class="label-text text-primary mb-6 block" data-id="MISI" data-en="MISSION">MISI</span>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <span class="material-icons text-primary mr-4 mt-1">check_circle_outline</span>
                            <span class="text-muted-light leading-relaxed"
                                data-id="Melaksanakan program pendidikan inovatif sesuai kebutuhan industri."
                                data-en="Implementing innovative education programs in accordance with industry needs.">Melaksanakan
                                program pendidikan inovatif sesuai kebutuhan industri.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="material-icons text-primary mr-4 mt-1">check_circle_outline</span>
                            <span class="text-muted-light leading-relaxed"
                                data-id="Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional."
                                data-en="Developing education and training resources professionally.">Mengembangkan
                                sumberdaya pendidikan dan pelatihan secara profesional.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="material-icons text-primary mr-4 mt-1">check_circle_outline</span>
                            <span class="text-muted-light leading-relaxed"
                                data-id="Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara."
                                data-en="Providing opportunities for students to study while working in Australia, Germany, and Southeast Asia.">Memberikan
                                kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia
                                Tenggara.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 content-center">
                <!-- Grid cards for Core Values + Global Network -->
                <div class="bg-background-light p-6 flex flex-col justify-between h-56 transition-transform hover:-translate-y-1 duration-300 shadow-sm card-hover"
                    data-reveal="zoom-in" data-delay="100">
                    <span class="material-icons text-primary text-3xl">verified</span>
                    <div>
                        <h4 class="font-bold text-sm mb-1 text-text-light"><span data-id="Integritas"
                                data-en="Integrity">Integritas</span></h4>
                        <p class="text-[0.7rem] text-muted-light leading-relaxed"
                            data-id="Membentuk insan pariwisata yang kompeten dan berdaya saing tinggi."
                            data-en="Shaping competent and highly competitive tourism professionals.">Membentuk insan
                            pariwisata yang kompeten dan berdaya saing tinggi.</p>
                    </div>
                </div>

                <div class="bg-background-light p-6 flex flex-col justify-between h-56 transition-transform hover:-translate-y-1 duration-300 shadow-sm card-hover"
                    data-reveal="zoom-in" data-delay="200">
                    <span class="material-icons text-primary text-3xl">fact_check</span>
                    <div>
                        <h4 class="font-bold text-sm mb-1 text-text-light"><span data-id="Tanggung Jawab"
                                data-en="Responsibility">Tanggung Jawab</span></h4>
                        <p class="text-[0.7rem] text-muted-light leading-relaxed"
                            data-id="Menghasilkan lulusan yang sesuai kriteria dunia kerja masa depan."
                            data-en="Producing graduates who meet the criteria of the future workforce.">Menghasilkan
                            lulusan yang sesuai kriteria dunia kerja masa depan.</p>
                    </div>
                </div>

                <div class="bg-background-light p-6 flex flex-col justify-between h-56 transition-transform hover:-translate-y-1 duration-300 shadow-sm card-hover"
                    data-reveal="zoom-in" data-delay="300">
                    <span class="material-icons text-primary text-3xl">star</span>
                    <div>
                        <h4 class="font-bold text-sm mb-1 text-text-light"><span data-id="Kualitas"
                                data-en="Quality">Kualitas</span></h4>
                        <p class="text-[0.7rem] text-muted-light leading-relaxed"
                            data-id="Berfokus pada penyediaan solusi dan kualitas pembelajaran terbaik."
                            data-en="Focusing on providing the best solutions and learning quality.">Berfokus pada
                            penyediaan solusi dan kualitas pembelajaran terbaik.</p>
                    </div>
                </div>

                <div class="bg-background-light p-6 flex flex-col justify-between h-56 transition-transform hover:-translate-y-1 duration-300 shadow-sm card-hover"
                    data-reveal="zoom-in" data-delay="400">
                    <span class="material-icons text-primary text-3xl">public</span>
                    <div>
                        <h4 class="font-bold text-sm mb-1 text-text-light"><span data-id="Global Network"
                                data-en="Global Network">Global Network</span></h4>
                        <p class="text-[0.7rem] text-muted-light leading-relaxed"
                            data-id="Kesempatan kerja & belajar di Australia, Jerman & Asia Tenggara."
                            data-en="Work & study opportunities in Australia, Germany & Southeast Asia.">Kesempatan kerja &
                            belajar di Australia, Jerman & Asia Tenggara.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Campus Life Gallery -->
    <section class="py-12 bg-surface-light px-6 md:px-16">
        <div class="max-w-7xl mx-auto">
            <h3 class="text-center font-serif text-2xl mb-12 text-text-light" data-reveal="fade-up"
                data-id="Kehidupan & Lingkungan Kampus" data-en="Campus Life &amp; Environment">Kehidupan & Lingkungan
                Kampus</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <img alt="Students in uniform" class="w-full h-[400px] object-cover shadow-sm" data-reveal="zoom-up"
                    data-delay="100"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCbRFStu23zaKKqIJeoNTPdSOcPof73N6z-I-QsGizCu594Eha4Mz0SejvG2hnF6yR68hPeN7xD_S1jEZRkzyCBrs8vDdvREWF-3OAPOgH3qHLgtcUvnZe8Rn1IBJAWejpEp4WOENNj0cc7gOgDOekzGxeBw1_w1YoCEDF65kipejrZCRT_xlGbzjwQUJm4_CNr8F3jauVVHFX03WogUy7RZO30XkuqCSw4mJEZ3cNqvzP0L5HyEQTniA">
                <img alt="Resort Pool" class="w-full h-[400px] object-cover shadow-sm" data-reveal="zoom-up"
                    data-delay="250"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDTY_0q-eeJ-lg9SUN09cLtSeVQR488pa_Xwag_o53lQzWT6mJR5WZs7yr6XbePzFxR3qxgiFvrEoNRgTdBGXSDDjwndYp88gIFAbcxGsNUdAZhXNledP3kFKkUXRYQkqkNW-yjqNZuHAtYEw1dMPKqJnAeTZFdyzrZPK3Opj_kuWb_k7Th8YmDJkdeDzKN1uwEyWzuDzSZ-ONuUd0TRqQTctN_cqSFal0SCwZhd6WmrTA8-CwwcCNwoQ">
                <img alt="Chefs cooking" class="w-full h-[400px] object-cover shadow-sm" data-reveal="zoom-up"
                    data-delay="400"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDV0lh3gGKxkEZoxy7owBdHzRVEZvkTUx_cLcTOGAorH2W5Hlj93QcVs4ZTcVZhy6ReTblju-pImR6huMYYKK3Ht_2BydhaglchgK_UjAw6j0_cBbtChI08T9-9SrN4y7LPA0hvtQx8P7Ro6tEHZJwQYTY1SK15KI-kaVZnE7hYSv9HI7UerrDb0fPLXglYz0YNzfv5YcT60EHMmhqSQ4yMT6QGwO7ZAyM-JwghKblh8sWSOMmwJGfTKA">
            </div>
        </div>
    </section>

    <!-- Disciplines & Programs Section -->
    <section class="py-24 px-6 md:px-16 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16" data-reveal="fade-up">
            <div>
                <span class="label-text text-primary mb-4 block" data-id="AKADEMI UNGGULAN"
                    data-en="EXCELLENT ACADEMY">AKADEMI UNGGULAN</span>
                <h2 class="text-5xl md:text-6xl font-serif leading-tight text-text-light">
                    <span data-id="Disiplin & Pelatihan Profesional Kami"
                        data-en="Our Disciplines &amp; Professional Training.">Disiplin & Pelatihan Profesional Kami</span>
                </h2>
            </div>
            <a class="label-text border-b border-primary pb-1 mt-6 md:mt-0 hover:text-primary transition-colors text-primary flex items-center"
                href="/akademi">
                <span data-id="LIHAT SEMUA PROGRAM" data-en="SEE ALL PROGRAMS">LIHAT SEMUA PROGRAM</span> <span
                    class="material-icons text-xs ml-1">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1: Program Internasional -->
            <div class="border border-black/10 group cursor-pointer bg-white shadow-sm transition-shadow duration-300 hover:shadow-md card-hover"
                data-reveal="fade-up" data-delay="100">
                <div class="overflow-hidden h-[300px]">
                    <img alt="Program Internasional"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXptvnod1HxEn1Bx6IezKWRBCwkykUPMcRW74guW5_55XXUaalkhFqPnoliMwG70kGUvZe7BZdcexnivnWW1-lK7WedS10yZF0nB7J_ZTIXnug_xa2_b0l7ZH3uXNLTJROPIqkEBqhJapvitg8WQoVxzwTyJuSq4r3rcPwfmvU8uPENXrzHnh0AbgLiOgwmys8JVmMCyf7XQYs5X0T0iaZxtDoi7jQJeSzDcGZwmF17aEOKwCkODnBOQ">
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-serif mb-4 text-text-light"><span data-id="Program Internasional"
                            data-en="International Program">Program Internasional</span></h3>
                    <p class="text-muted-light mb-8 text-sm leading-relaxed"
                        data-id="Pendidikan luar negeri berpartner dengan TAFE Australia & The Hotel School, serta Ausbildung Jerman."
                        data-en="Overseas education partnering with TAFE Australia &amp; The Hotel School, as well as Ausbildung Germany.">
                        Pendidikan luar negeri berpartner dengan TAFE Australia & The Hotel School, serta Ausbildung Jerman.
                    </p>
                    <a class="label-text text-xs border-b border-text-light/30 pb-1 hover:text-primary transition-colors"
                        href="/akademi?filter=internasional"><span data-id="DETAIL PROGRAM" data-en="PROGRAM DETAILS">DETAIL
                            PROGRAM</span></a>
                </div>
            </div>

            <!-- Card 2: Pendidikan Vokasi 2 Tahun -->
            <div class="border border-black/10 group cursor-pointer bg-white shadow-sm transition-shadow duration-300 hover:shadow-md card-hover"
                data-reveal="fade-up" data-delay="250">
                <div class="overflow-hidden h-[300px]">
                    <img alt="Pendidikan Vokasi 2 Tahun"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxW5mY_zGD0HDOuwOrmrluxFe62YYnMPXOVLSqWRlgjb2vMXfJRycIhaY-CD9oObxiUpXDfsNqINeygV8X8D-cGXIgF1TsGf1oTPgW6_TY1GU8KeHFIgeVZgBDZxo-77h1BWpzJ4Z6JQaflVOHy1jq3aT80-6ua894112IvlKWSK8uWYLygVc8fO53xwVQEVcu7Od_VANVKjmstsZjgZrBxMmHgC8V-HwKbyyG_7PWWcGVDbWh2uLnNw">
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-serif mb-4 text-text-light"><span data-id="Vokasi 2 Tahun"
                            data-en="2-Year Vocational">Vokasi 2 Tahun</span></h3>
                    <p class="text-muted-light mb-8 text-sm leading-relaxed"
                        data-id="Jurusan Culinary Arts, Perhotelan, & F&B Service dengan jaminan OJT hotel bintang 4 & 5."
                        data-en="Majors in Culinary Arts, Hospitality, &amp; F&B Service with guaranteed OJT in 4 &amp; 5-star hotels.">
                        Jurusan Culinary Arts, Perhotelan, & F&B Service dengan jaminan OJT hotel bintang 4 & 5.</p>
                    <a class="label-text text-xs border-b border-text-light/30 pb-1 hover:text-primary transition-colors"
                        href="/akademi?filter=2-tahun"><span data-id="DETAIL PROGRAM" data-en="PROGRAM DETAILS">DETAIL
                            PROGRAM</span></a>
                </div>
            </div>

            <!-- Card 3: Program Eksekutif Cruise Line -->
            <div class="border border-black/10 group cursor-pointer bg-white shadow-sm transition-shadow duration-300 hover:shadow-md card-hover"
                data-reveal="fade-up" data-delay="400">
                <div class="overflow-hidden h-[300px]">
                    <img alt="Program Eksekutif Cruise Line"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        src="{{ asset('image/Kapal.jpg') }}">
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-serif mb-4 text-text-light"><span data-id="Program Eksekutif"
                            data-en="Executive Program">Program Eksekutif</span></h3>
                    <p class="text-muted-light mb-8 text-sm leading-relaxed"
                        data-id="Program singkat 6 bulan kapal pesiar (Cook, Steward, Bartender) dengan bonus gratis paspor & seaman book."
                        data-en="6-month short cruise line program (Cook, Steward, Bartender) with free passport &amp; seaman book bonus.">
                        Program singkat 6 bulan kapal pesiar (Cook, Steward, Bartender) dengan bonus gratis paspor & seaman
                        book.</p>
                    <a class="label-text text-xs border-b border-text-light/30 pb-1 hover:text-primary transition-colors"
                        href="/akademi?filter=eksekutif"><span data-id="DETAIL PROGRAM" data-en="PROGRAM DETAILS">DETAIL
                            PROGRAM</span></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Showcase -->
    <section class="py-24 px-6 md:px-16 max-w-7xl mx-auto border-t border-black/10">
        <div class="text-center mb-16" data-reveal="fade-up">
            <span class="label-text text-text-light" data-id="FASILITAS KELAS DUNIA"
                data-en="WORLD CLASS FACILITIES">FASILITAS KELAS DUNIA</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 relative h-[500px] md:h-[600px] group overflow-hidden" data-reveal="fade-right">
                <img alt="Industry Kitchen"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAuTCak20mOeB9LQyn2XonJILtYY9k6DyYGKEQ_2nztbxQWXwrVPOL29MgalMVIKCAW04dx_vIrTJCd_XfZmfX9_9hbLrXB0cPP_Z2UsA4IYQswE7_qtBrSAXUCYqMucBYQEqjuiG38mvQaMG5r26TUh-29dvwJ_34-CjtOGQkO16jk6q2OBqzcfV9-nc_yifBoKLwOk3ZQgc4Y8cMYrRz7pnjfbDsJcv_KI3heB7aNsCudsGWesMK0CA">
                <div class="absolute bottom-6 left-6 bg-black/60 backdrop-blur-sm px-4 py-2 text-white text-xs uppercase tracking-wider"
                    data-id="DAPUR INDUSTRI" data-en="INDUSTRY KITCHEN">DAPUR INDUSTRI</div>
            </div>

            <div class="flex flex-col gap-6 h-[500px] md:h-[600px]" data-reveal="fade-left" data-delay="200">
                <div class="relative h-1/2 group overflow-hidden">
                    <img alt="Mock Suite"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCyOX_hVvTkAG09wnSm_vRW8D4osAWduBcFAjzCZ1wV4i4GPLit9wTP_i2XtVSYgamC--GK74WFus4JzhyZYBIq4uQo7edkXb7qbkbYZSD7tyTMmm-avYEYkfxEHRv3d-UVeXaNEwoeW8jpXjQnhYk1Ixp0oGDWNB4GRjOVwWJw9-VOBMkmWx-HYymiZmpE5WXj8wKO1j_zVtxaJ0IuVTJ7-kam2tSORas5a52dmUAOG2LK1tpKCHpOFg">
                    <div class="absolute bottom-6 left-6 bg-black/60 backdrop-blur-sm px-4 py-2 text-white text-xs uppercase tracking-wider"
                        data-id="KAMAR SUITE SIMULASI" data-en="MOCK SUITE">KAMAR SUITE SIMULASI</div>
                </div>

                <div class="relative h-1/2 group overflow-hidden">
                    <img alt="Training Bar"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDA-3TVgjqn3rAEEMHDMk4BdnH6XnDlEPUP2Nc_9LrVXk3EsldakTpUoLH42IgL4tS_sVrXfm3KbpdvDhxRTcJUyVrKQmhaPn_BBDJ0FQiIz9SJi62qfc9pDjuHpvzqiMNxJPWxI8ctpmx-Bz4jTY1IKMeJRtHAnb_9GJQUvK8bEsDw0ux1S4BVwNd1eC9utAz77RQgpUE8mrqmszl64keLmdWPNOJCyYE2gv5BmNUXFWMpsee-QQJ53A">
                    <div class="absolute bottom-6 left-6 bg-black/60 backdrop-blur-sm px-4 py-2 text-white text-xs uppercase tracking-wider"
                        data-id="BAR PELATIHAN" data-en="TRAINING BAR">BAR PELATIHAN</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Message from Director Section -->
    <section class="py-32 bg-surface-light px-6 md:px-16 relative">
        <div class="max-w-4xl mx-auto text-center relative z-10 text-text-light" data-reveal="zoom-in">
            <span class="label-text text-primary mb-8 block" data-id="PESAN DIREKTUR"
                data-en="MESSAGE FROM THE DIRECTOR">PESAN DIREKTUR</span>
            <!-- TODO: Tambahkan testimonial alumni asli jika data sudah tersedia -->
            <h2 class="text-2xl md:text-3xl font-serif leading-relaxed mb-8">
                <span
                    data-id="&ldquo;Halo sahabat excellent, Denpasar Hotel School hadir dengan sebuah komitmen untuk mengantarkan calon profesional muda menjadi SDM Indonesia yang unggul dan kompeten. Di Denpasar Hotel School, Anda akan dilatih oleh para praktisi yang telah berpengalaman di bidangnya masing-masing. Mari bergabung bersama kami, Denpasar Hotel School, kami siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global.&rdquo;"
                    data-en="&ldquo;Hello excellent friends, Denpasar Hotel School comes with a commitment to deliver young professional candidates to become superior and competent Indonesian human resources. At Denpasar Hotel School, you will be trained by practitioners who are experienced in their respective fields. Let's join us, Denpasar Hotel School, we are ready to guide you to become competent young professionals with global competitiveness.&rdquo;">"Halo
                    sahabat excellent, Denpasar Hotel School hadir dengan sebuah komitmen untuk mengantarkan calon
                    profesional muda menjadi SDM Indonesia yang unggul dan kompeten. Di Denpasar Hotel School, Anda akan
                    dilatih oleh para praktisi yang telah berpengalaman di bidangnya masing-masing. Mari bergabung bersama
                    kami, Denpasar Hotel School, kami siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki
                    daya saing global."</span>
            </h2>
            <div>
                <h4 class="font-bold text-sm tracking-widest uppercase mb-1">I Made Dwija Suastana, S.H., M.H.</h4>
                <p class="label-text text-muted-light" data-id="DIREKTUR DENPASAR HOTEL SCHOOL &mdash; SALAM EXCELLENT!"
                    data-en="DIRECTOR OF DENPASAR HOTEL SCHOOL &mdash; SALAM EXCELLENT!">DIREKTUR DENPASAR HOTEL SCHOOL —
                    SALAM EXCELLENT!</p>
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
            <div class="group cursor-pointer" data-reveal="fade-right">
                <div class="overflow-hidden mb-8 h-[400px]">
                    <img alt="Team meeting"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAO3TjdyecwwVtS9SP20fK3_4C9aPBiHhONLdja28RvyQ_WiSbCtw3yhXXWyIA-_0QjM3PyUVN4YdtPRrVPQKbZXYiLJcuFqUp0dShFMbOX2jWwnoDr2-hu_aUwmAMCP1at0lGcWERGUPEm1WhFlotXnftrEp4j1XKnawHtj_e-Q7d2w3zSUOtfQAFRpOIdTo4Ee8E6dy6fcOnjn_g5oKV5WL04cs1Ghu3nWQ9ErWT5FTk7UVtFtM8_ww">
                </div>
                <div class="flex items-center space-x-3 mb-4">
                    <span class="label-text text-primary text-[0.6rem]" data-id="KEGIATAN" data-en="EVENTS">KEGIATAN</span>
                    <span class="w-1 h-1 rounded-full bg-muted-light/30"></span>
                    <span class="label-text text-muted-light text-[0.6rem]" data-id="12 SEP 2024" data-en="SEP 12, 2024">12
                        SEP 2024</span>
                </div>
                <h3
                    class="text-3xl font-serif mb-4 leading-tight text-text-light group-hover:text-primary transition-colors">
                    <span data-id="Kemitraan DHS dengan Kapal Pesiar Mewah 2026"
                        data-en="DHS Partnerships with Luxury Cruise Lines 2026">Kemitraan DHS dengan Kapal Pesiar Mewah
                        2026</span>
                </h3>
                <p class="text-muted-light mb-6 leading-relaxed text-sm">
                    <span
                        data-id="Denpasar Hotel School mengumumkan kemitraan eksklusif dengan tiga perusahaan kapal pesiar global. Kolaborasi ini akan memberikan mahasiswa terbaik kami akses yang belum pernah ada sebelumnya ke magang kapal pesiar mewah, meningkatkan standar pelatihan perhotelan kelautan..."
                        data-en="Denpasar Hotel School announces an exclusive partnership with three global cruise lines. This collaboration will provide our top-tier students with unprecedented access to floating-luxury internships, elevating standard marine hospitality training...">Denpasar
                        Hotel School announces an exclusive partnership with three global cruise lines. This collaboration
                        will provide our top-tier students with unprecedented access to floating-luxury internships,
                        elevating standard marine hospitality training...</span>
                </p>
                <a class="label-text text-xs border-b border-text-light/30 pb-1 hover:text-primary transition-colors"
                    href="/berita">
                    <span data-id="BACA SELENGKAPNYA &rarr;" data-en="READ FULL ARTICLE &rarr;">BACA SELENGKAPNYA
                        &rarr;</span>
                </a>
            </div>

            <!-- Small Articles List -->
            <div class="flex flex-col gap-8" data-reveal="fade-left" data-delay="200">
                <!-- Article 1 -->
                <a href="/berita" class="flex gap-6 group cursor-pointer border-b border-black/5 pb-8 no-underline">
                    <div class="w-32 h-32 flex-shrink-0 overflow-hidden">
                        <img alt="Culinary dish"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAOSLVSRHrQY7s9VWmSs04TV3EjPDPwXecszDnbnTZdlKMbo2Vd0WroDGcDAhcWm7TbrOYNO05puHkFoqlIClDRA0hdXnsz1waqZytA_z-Eec9UZOlRQxyNqwul_0HBclEU_z_dH9iOsQ8A3rsvPwYTtYkqJc1BIsATalvHW5OSyjLNtrmfnTQeXWR4RmgzYkva0lr7Rmd_HeZO2e4pWgzUtPYdBqc7wROamPgt_YrSYvQHNQ5cIqdIdQ">
                    </div>
                    <div>
                        <span class="label-text text-primary text-[0.6rem] mb-2 block" data-id="LOKAKARYA"
                            data-en="WORKSHOP">LOKAKARYA</span>
                        <h4
                            class="text-xl font-serif mb-2 leading-snug text-text-light group-hover:text-primary transition-colors">
                            <span data-id="Masterclass Kuliner bersama Chef Michelin"
                                data-en="Culinary Masterclass with Michelin Chefs">Masterclass Kuliner bersama Chef
                                Michelin</span>
                        </h4>
                        <span class="label-text text-muted-light text-[0.6rem]" data-id="25 AGU 2024"
                            data-en="AUG 25, 2024">25 AGU 2024</span>
                    </div>
                </a>

                <!-- Article 2 -->
                <a href="/berita" class="flex gap-6 group cursor-pointer border-b border-black/5 pb-8 no-underline">
                    <div class="w-32 h-32 flex-shrink-0 overflow-hidden">
                        <img alt="Hotel interior"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCBBM8Cew2Zj_xFW078EjybXe3HFH4ljOwP6ScrqZaBOSYPfm9OEMg1QTiBEDQtgRaPwSzGVFZWtxyjVjG7THaHxzgVtk2FJRgFx9uEJ1_N22f4xbj8wTmV6NsoqVHjc-LuAUUwp8xJUo9CE0egnbeTW0VIJbiQu5-33lrPYvWOyERCC-GgvUvw1AceDUx9udxp56x_pL037xrYx30NGvAQVfLsGOQc1V2RexfoEpIDtB-UtkPZKLW6yA">
                    </div>
                    <div>
                        <span class="label-text text-primary text-[0.6rem] mb-2 block" data-id="KARIER"
                            data-en="CAREERS">KARIER</span>
                        <h4
                            class="text-xl font-serif mb-2 leading-snug text-text-light group-hover:text-primary transition-colors">
                            <span data-id="Lulusan Memimpin Resort Butik di Asia"
                                data-en="Graduates Leading Boutique Resorts in Asia">Lulusan Memimpin Resort Butik di
                                Asia</span>
                        </h4>
                        <span class="label-text text-muted-light text-[0.6rem]" data-id="15 AGU 2024"
                            data-en="AUG 15, 2024">15 AGU 2024</span>
                    </div>
                </a>

                <!-- Article 3 -->
                <a href="/berita" class="flex gap-6 group cursor-pointer pb-2 no-underline">
                    <div class="w-32 h-32 flex-shrink-0 overflow-hidden">
                        <img alt="Eco resort"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBT3146jDkz7k7l8W_Pe9wP81NZq8CHsF8TDxzE6yss-GNpP-U9J05Tf26bqmEfwCuNIs-r32cWfsatZnGNb11ihIw9dnzdjodyKagakbY5b4jD32sHMQUBTvlHDMPv1tnQWreyZL9LYUclFFcv7lsNsLxKy4MJm8PKKqHeuYvGhHQPXRu_UOhg8ks6xnTtwP_3Cgv56ZVSZ2LNeC2LwH-9RkkxnLLq4wz48juU72N9FwdIQ1x8kBgwwQ">
                    </div>
                    <div>
                        <span class="label-text text-primary text-[0.6rem] mb-2 block" data-id="KEBERLANJUTAN"
                            data-en="SUSTAINABILITY">KEBERLANJUTAN</span>
                        <h4
                            class="text-xl font-serif mb-2 leading-snug text-text-light group-hover:text-primary transition-colors">
                            <span data-id="Inisiatif Kampus Hospitality Berkelanjutan"
                                data-en="Sustainable Hospitality Campus Initiatives">Inisiatif Kampus Hospitality
                                Berkelanjutan</span>
                        </h4>
                        <span class="label-text text-muted-light text-[0.6rem]" data-id="05 AGU 2024"
                            data-en="AUG 05, 2024">05 AGU 2024</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Partnership & Mitra Section -->
    <section class="py-20 md:py-24 bg-dhs-cream/50 border-t border-b border-black/5 overflow-hidden">
        <div class="max-w-[1280px] mx-auto px-5 md:px-16 text-center mb-16">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block">
                <span data-id="Kemitraan &amp; Jaringan Global" data-en="Partnership &amp; Global Network">Kemitraan &amp;
                    Jaringan Global</span>
            </span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6"
                data-reveal="fade-up">
                <span data-id="Partnership Program (PP DHS)" data-en="Partnership Program (PP DHS)">Partnership Program (PP
                    DHS)</span>
            </h2>
            <p class="text-base text-muted-light max-w-3xl mx-auto leading-relaxed" data-reveal="fade-up" data-delay="100">
                <span
                    data-id="DHS berkomitmen penuh untuk mengintegrasikan pendidikan vokasi dengan dunia industri global. Program ini menjamin penempatan magang internasional (OJT) berkualitas dan penyaluran kerja langsung di hotel bintang 4 &amp; 5 serta kapal pesiar mewah tanpa potongan agen fee (Zero Agent Fee)."
                    data-en="DHS is fully committed to integrating vocational education with the global industry. This program guarantees high-quality international internship (OJT) placement and direct recruitment in 4 &amp; 5-star hotels and luxury cruise lines with absolutely zero agent fees.">DHS
                    berkomitmen penuh untuk mengintegrasikan pendidikan vokasi dengan dunia industri global. Program ini
                    menjamin penempatan magang internasional (OJT) berkualitas dan penyaluran kerja langsung di hotel
                    bintang 4 &amp; 5 serta kapal pesiar mewah tanpa potongan agen fee (Zero Agent Fee).</span>
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

                $renderCard = function ($item) {
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
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes marquee-right {
            0% {
                transform: translateX(-50%);
            }

            100% {
                transform: translateX(0);
            }
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

    <!-- Contact Form Section -->
    <section id="contact-section" class="py-24 bg-surface-light px-6 md:px-16">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 md:gap-24">
            <div class="text-text-light" data-reveal="fade-right">
                <span class="label-text text-primary mb-4 block" data-id="KONTAK" data-en="CONTACT">KONTAK</span>
                <h2 class="text-5xl md:text-7xl font-serif mb-12 leading-tight">
                    <span data-id="Hubungi Kami." data-en="Contact Us.">Hubungi Kami.</span>
                </h2>

                <div class="space-y-8">
                    <div>
                        <span class="label-text text-primary mb-2 block" data-id="KAMPUS DENPASAR"
                            data-en="DENPASAR CAMPUS">KAMPUS DENPASAR</span>
                        <p class="text-base font-semibold">Jl. Sari Dana IV No. 1 Gatsu Barat, Denpasar 80116, Bali</p>
                        <p class="text-sm text-muted-light mt-1">WA: +62 81 246 319966 | Email: sahabat@dhs.or.id</p>
                    </div>
                    <div>
                        <span class="label-text text-primary mb-2 block" data-id="KAMPUS KLUNGKUNG"
                            data-en="KLUNGKUNG CAMPUS">KAMPUS KLUNGKUNG</span>
                        <p class="text-base font-semibold">Jl. Raya Takmung No. 36, Klungkung 80752, Bali</p>
                        <p class="text-sm text-muted-light mt-1">Telp: +0366 5582998 | WA: +62 81 337 106480</p>
                    </div>
                    <div>
                        <span class="label-text text-muted-light mb-2 block" data-id="PENDAFTARAN ONLINE"
                            data-en="ONLINE REGISTRATION">PENDAFTARAN ONLINE</span>
                        <p class="text-sm font-medium">Linktree: <a href="https://linktr.ee/BiayaPendidikan_DHS"
                                target="_blank"
                                class="underline text-primary hover:text-dhs-darknavy">BiayaPendidikan_DHS</a></p>
                        <p class="text-sm font-medium">Portal: <a href="http://www.dhs.or.id/student" target="_blank"
                                class="underline text-primary hover:text-dhs-darknavy">www.dhs.or.id/student</a></p>
                    </div>
                </div>
            </div>

            <!-- Contact Form Card with Cream Background & Sharp Corners -->
            <div class="bg-background-light p-12 shadow-sm border border-black/5" data-reveal="fade-left" data-delay="150">
                <h3 class="text-2xl font-serif mb-8 text-text-light" data-id="Kirim Pertanyaan" data-en="Send an Inquiry">
                    Kirim Pertanyaan</h3>

                <form class="space-y-8" onsubmit="event.preventDefault(); alert('Inquiry submitted!');">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="label-text text-muted-light mb-2 block" data-id="NAMA LENGKAP"
                                data-en="FULL NAME">NAMA LENGKAP</label>
                            <input
                                class="w-full bg-transparent border-0 border-b border-black/20 focus:ring-0 focus:border-primary px-0 py-2 placeholder-muted-light/50 text-text-light"
                                placeholder="e.g. John Doe" data-id="misal: John Doe" data-en="e.g. John Doe" type="text"
                                required>
                        </div>
                        <div>
                            <label class="label-text text-muted-light mb-2 block" data-id="ALAMAT EMAIL"
                                data-en="EMAIL ADDRESS">ALAMAT EMAIL</label>
                            <input
                                class="w-full bg-transparent border-0 border-b border-black/20 focus:ring-0 focus:border-primary px-0 py-2 placeholder-muted-light/50 text-text-light"
                                placeholder="e.g. john@example.com" data-id="misal: john@example.com"
                                data-en="e.g. john@example.com" type="email" required>
                        </div>
                    </div>

                    <div>
                        <label class="label-text text-muted-light mb-2 block" data-id="PROGRAM YANG DIMINATI"
                            data-en="PROGRAM OF INTEREST">PROGRAM YANG DIMINATI</label>
                        <select
                            class="w-full bg-transparent border-0 border-b border-black/20 focus:ring-0 focus:border-primary px-0 py-2 text-muted-light">
                            <option data-id="Pilih Program" data-en="Select a Program">Pilih Program</option>
                            <option>Culinary Arts</option>
                            <option>Hospitality Management</option>
                            <option>F&amp;B Service</option>
                        </select>
                    </div>

                    <div>
                        <label class="label-text text-muted-light mb-2 block" data-id="PESAN"
                            data-en="MESSAGE">PESAN</label>
                        <textarea
                            class="w-full bg-transparent border-0 border-b border-black/20 focus:ring-0 focus:border-primary px-0 py-2 placeholder-muted-light/50 text-text-light resize-none"
                            placeholder="How can we help you?" data-id="Bagaimana kami bisa membantu Anda?"
                            data-en="How can we help you?" rows="4" required></textarea>
                    </div>

                    <!-- Navy solid button with sharp corners -->
                    <button
                        class="w-full py-4 bg-dhs-navy text-white text-sm font-bold tracking-widest uppercase hover:bg-dhs-darknavy transition-colors mt-4"
                        type="submit" data-id="KIRIM PERTANYAAN" data-en="SUBMIT INQUIRY">KIRIM PERTANYAAN</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Visit / Directions Section -->
    <section class="w-full">
        <!-- Google Maps Embed -->
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.6658058766166!2d115.18809017511477!3d-8.628046287700172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f595f08b1fd%3A0xffcf6a4a4cc594e9!2sDenpasar%20Hotel%20School!5e0!3m2!1sid!2sid!4v1784079656770!5m2!1sid!2sid"
            width="100%" height="480" style="border:0; display:block;" allowfullscreen="" loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin" title="Denpasar Hotel School Location">
        </iframe>

        <!-- Location Info Bar — static block below the map, never overlaps footer -->
        <div
            class="bg-white border-t border-black/8 px-6 md:px-16 py-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-sm">
            <div class="flex items-center gap-4">
                <span class="material-icons text-primary text-2xl flex-shrink-0">location_on</span>
                <div>
                    <p class="text-xs font-bold tracking-widest uppercase text-text-light mb-0.5">Denpasar Hotel School</p>
                    <p class="text-[0.7rem] text-muted-light">Jl. Sari Dana IV No. 1, Gatsu Barat, Denpasar 80116, Bali</p>
                </div>
            </div>
            <a href="https://maps.google.com/?q=Denpasar+Hotel+School" target="_blank" rel="noopener"
                class="flex-shrink-0 flex items-center gap-1.5 px-6 py-2.5 bg-primary text-white text-[0.65rem] font-bold tracking-widest uppercase hover:bg-red-700 transition-all duration-200 hover:shadow-md rounded-sm">
                <span class="material-icons text-sm">directions</span>
                <span data-id="PETUNJUK ARAH" data-en="GET DIRECTIONS">PETUNJUK ARAH</span>
            </a>
        </div>
    </section>

@endsection