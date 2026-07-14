@extends('layouts.app')

@section('title', 'Denpasar Hotel School — International Vocational Training Center in Bali')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center text-center overflow-hidden">
    <div class="absolute inset-0 bg-black/35 z-10"></div>
    <img alt="Hotel Lobby" class="absolute inset-0 w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBaJKFYExsjON0pHP43rfmOAIqTkD_R2sTlmKK5Y3CMDGPSja6oJ9DR5erhpkcJFaGwf8hwJZD58ClcpjuTPYEL5LyfjSjhB-t-AumWxxUO-avGgwTwc2wPhoyV6tw23si9SHWgb-5qyJtdTi6WaHdheSZI6A0nWVeXVQ69zkjhtBFvmGPvNvIy5vgQ3-jvlnbQ4bpVLKjjmedqgkXlfk0i_oXHtaIcsJSv5idQg1RZWqqLN8RrwIF70A">
    
    <div class="relative z-20 px-6 max-w-4xl mx-auto mt-20">
        <div class="mb-6 inline-flex items-center space-x-3 text-white">
            <span class="h-[1px] w-8 bg-white/60"></span>
            <span class="label-text text-white/90">DENPASAR HOTEL SCHOOL — INTERNATIONAL VOCATIONAL TRAINING CENTER IN BALI</span>
            <span class="h-[1px] w-8 bg-white/60"></span>
        </div>
        <h1 class="text-5xl md:text-7xl font-serif text-white mb-10 leading-tight">Crafting The Future Of Global Hospitality</h1>
        
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
            <!-- Used bg-dhs-navy instead of #1C1A17 as per DESIGN.md -->
            <a class="px-8 py-4 bg-dhs-navy text-white text-sm font-bold tracking-widest uppercase hover:bg-dhs-darknavy transition-colors rounded-none" href="/akademi">JELAJAHI PROGRAM</a>
            <a class="px-8 py-4 bg-white/20 backdrop-blur-sm text-white text-sm font-bold tracking-widest uppercase border border-white/40 hover:bg-white/30 transition-colors rounded-none" href="/cara-mendaftar">DAFTAR SEKARANG</a>
        </div>
    </div>
    
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 flex flex-col items-center">
        <span class="text-xs uppercase tracking-widest text-white mb-2">Swipe To Scroll</span>
        <div class="w-px h-12 bg-white/50"></div>
    </div>
    
    <!-- Floating Inquiry Button -->
    <button class="absolute bottom-10 right-10 z-20 w-12 h-12 bg-dhs-navy rounded-full flex items-center justify-center text-white hover:bg-dhs-darknavy transition-colors shadow-lg" onclick="document.getElementById('contact-section').scrollIntoView({behavior: 'smooth'})" title="Hubungi Kami">
        <span class="material-icons">chat_bubble_outline</span>
    </button>
</section>

<!-- About Intro Section -->
<section class="py-24 md:py-32 px-6 md:px-16 max-w-7xl mx-auto">
    <div class="grid md:grid-cols-2 gap-16 md:gap-24 items-center">
        <div>
            <!-- text-primary resolved to DHS Red (#D62828) as per DESIGN.md -->
            <span class="label-text text-primary mb-4 block">SEKILAS DHS</span>
            <h2 class="text-5xl md:text-6xl font-serif mb-8 leading-tight text-text-light">Transforming<br>Into Excellent.</h2>
            
            <div class="space-y-6 text-dhs-darknavy leading-relaxed">
                <p>Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi.</p>
                <p>Lembaga ini didirikan untuk memberi kesempatan generasi muda Indonesia menjadi tenaga profesional bidang perhotelan, hospitality, kapal pesiar dan pariwisata, serta belajar sambil bekerja di luar negeri.</p>
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
                <div class="text-sm italic text-muted-light">
                    Mencetak SDM pariwisata yang unggul, kompeten, dan siap bersaing di tingkat global.
                </div>
            </div>
        </div>
        
        <div class="relative h-[600px] md:h-[700px] w-full ml-auto md:w-[85%]">
            <div class="absolute -inset-4 bg-surface-light -z-10 translate-x-4 translate-y-4"></div>
            <img alt="Hotel Interior" class="w-full h-full object-cover shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5jkBzd0EqrT-cphGIkzHYDH2a7dpxzv95e4cWzjIaFRYe8B3poCp2NncsdrneEW_ldLWrzvbO4JcdyzzGiQ-Mvb33B6kEHzU80DleUBPVkvlrCikONCi2W8yS5aMmee0S50iv_AYi1wUI-pnY1lPSKs2H7rnAXGxAPLvpZ9j5QBG9pWjHTb3FiXnNHZa6j5uJnKPdjulHepAKqk6Eb1zivof6CfMQt0IRObJoQROAn60P6jzRyfcrAQ">
        </div>
    </div>
</section>

<!-- Vision & Mission Section -->
<section class="py-24 bg-surface-light px-6 md:px-16">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 md:gap-24">
        <div>
            <h2 class="text-5xl md:text-6xl font-serif mb-16 leading-tight text-text-light">Visionary<br>Standards.</h2>
            
            <div class="mb-12">
                <span class="label-text text-primary mb-4 block">VISI</span>
                <p class="font-serif text-2xl italic leading-relaxed text-muted-light">
                    "Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global."
                </p>
            </div>
            
            <div>
                <span class="label-text text-primary mb-6 block">MISI</span>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <span class="material-icons text-primary mr-4 mt-1">check_circle_outline</span>
                        <span class="text-muted-light leading-relaxed">Melaksanakan program pendidikan inovatif sesuai kebutuhan industri.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="material-icons text-primary mr-4 mt-1">check_circle_outline</span>
                        <span class="text-muted-light leading-relaxed">Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="material-icons text-primary mr-4 mt-1">check_circle_outline</span>
                        <span class="text-muted-light leading-relaxed">Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara.</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-6 content-center">
            <!-- Grid cards for Core Values + Global Network -->
            <div class="bg-background-light p-6 flex flex-col justify-between h-56 transition-transform hover:-translate-y-1 duration-300 shadow-sm">
                <span class="material-icons text-primary text-3xl">verified</span>
                <div>
                    <h4 class="font-bold text-sm mb-1 text-text-light">Integritas</h4>
                    <p class="text-[0.7rem] text-muted-light leading-relaxed">Membentuk insan pariwisata yang kompeten dan berdaya saing tinggi.</p>
                </div>
            </div>
            
            <div class="bg-background-light p-6 flex flex-col justify-between h-56 transition-transform hover:-translate-y-1 duration-300 shadow-sm">
                <span class="material-icons text-primary text-3xl">fact_check</span>
                <div>
                    <h4 class="font-bold text-sm mb-1 text-text-light">Tanggung Jawab</h4>
                    <p class="text-[0.7rem] text-muted-light leading-relaxed">Menghasilkan lulusan yang sesuai kriteria dunia kerja masa depan.</p>
                </div>
            </div>
            
            <div class="bg-background-light p-6 flex flex-col justify-between h-56 transition-transform hover:-translate-y-1 duration-300 shadow-sm">
                <span class="material-icons text-primary text-3xl">star</span>
                <div>
                    <h4 class="font-bold text-sm mb-1 text-text-light">Kualitas</h4>
                    <p class="text-[0.7rem] text-muted-light leading-relaxed">Berfokus pada penyediaan solusi dan kualitas pembelajaran terbaik.</p>
                </div>
            </div>
            
            <div class="bg-background-light p-6 flex flex-col justify-between h-56 transition-transform hover:-translate-y-1 duration-300 shadow-sm">
                <span class="material-icons text-primary text-3xl">public</span>
                <div>
                    <h4 class="font-bold text-sm mb-1 text-text-light">Global Network</h4>
                    <p class="text-[0.7rem] text-muted-light leading-relaxed">Kesempatan kerja & belajar di Australia, Jerman & Asia Tenggara.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Campus Life Gallery -->
<section class="py-12 bg-surface-light px-6 md:px-16">
    <div class="max-w-7xl mx-auto">
        <h3 class="text-center font-serif text-2xl mb-12 text-text-light">Campus Life &amp; Environment</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <img alt="Students in uniform" class="w-full h-[400px] object-cover shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCbRFStu23zaKKqIJeoNTPdSOcPof73N6z-I-QsGizCu594Eha4Mz0SejvG2hnF6yR68hPeN7xD_S1jEZRkzyCBrs8vDdvREWF-3OAPOgH3qHLgtcUvnZe8Rn1IBJAWejpEp4WOENNj0cc7gOgDOekzGxeBw1_w1YoCEDF65kipejrZCRT_xlGbzjwQUJm4_CNr8F3jauVVHFX03WogUy7RZO30XkuqCSw4mJEZ3cNqvzP0L5HyEQTniA">
            <img alt="Resort Pool" class="w-full h-[400px] object-cover shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDTY_0q-eeJ-lg9SUN09cLtSeVQR488pa_Xwag_o53lQzWT6mJR5WZs7yr6XbePzFxR3qxgiFvrEoNRgTdBGXSDDjwndYp88gIFAbcxGsNUdAZhXNledP3kFKkUXRYQkqkNW-yjqNZuHAtYEw1dMPKqJnAeTZFdyzrZPK3Opj_kuWb_k7Th8YmDJkdeDzKN1uwEyWzuDzSZ-ONuUd0TRqQTctN_cqSFal0SCwZhd6WmrTA8-CwwcCNwoQ">
            <img alt="Chefs cooking" class="w-full h-[400px] object-cover shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDV0lh3gGKxkEZoxy7owBdHzRVEZvkTUx_cLcTOGAorH2W5Hlj93QcVs4ZTcVZhy6ReTblju-pImR6huMYYKK3Ht_2BydhaglchgK_UjAw6j0_cBbtChI08T9-9SrN4y7LPA0hvtQx8P7Ro6tEHZJwQYTY1SK15KI-kaVZnE7hYSv9HI7UerrDb0fPLXglYz0YNzfv5YcT60EHMmhqSQ4yMT6QGwO7ZAyM-JwghKblh8sWSOMmwJGfTKA">
        </div>
    </div>
</section>

<!-- Disciplines & Programs Section -->
<section class="py-24 px-6 md:px-16 max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-end mb-16">
        <div>
            <span class="label-text text-primary mb-4 block">AKADEMI UNGGULAN</span>
            <h2 class="text-5xl md:text-6xl font-serif leading-tight text-text-light">Our Disciplines &amp;<br>Professional Training.</h2>
        </div>
        <a class="label-text border-b border-primary pb-1 mt-6 md:mt-0 hover:text-primary transition-colors text-primary flex items-center" href="/akademi">
            SEE ALL PROGRAMS <span class="material-icons text-xs ml-1">arrow_forward</span>
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Card 1: Program Internasional -->
        <div class="border border-black/10 group cursor-pointer bg-white shadow-sm transition-shadow duration-300 hover:shadow-md">
            <div class="overflow-hidden h-[300px]">
                <img alt="Program Internasional" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXptvnod1HxEn1Bx6IezKWRBCwkykUPMcRW74guW5_55XXUaalkhFqPnoliMwG70kGUvZe7BZdcexnivnWW1-lK7WedS10yZF0nB7J_ZTIXnug_xa2_b0l7ZH3uXNLTJROPIqkEBqhJapvitg8WQoVxzwTyJuSq4r3rcPwfmvU8uPENXrzHnh0AbgLiOgwmys8JVmMCyf7XQYs5X0T0iaZxtDoi7jQJeSzDcGZwmF17aEOKwCkODnBOQ">
            </div>
            <div class="p-8">
                <h3 class="text-2xl font-serif mb-4 text-text-light">Program Internasional</h3>
                <p class="text-muted-light mb-8 text-sm leading-relaxed">Pendidikan luar negeri berpartner dengan TAFE Australia & The Hotel School, serta Ausbildung Jerman.</p>
                <a class="label-text text-xs border-b border-text-light/30 pb-1 hover:text-primary transition-colors" href="/akademi?filter=internasional">PROGRAM DETAILS</a>
            </div>
        </div>
        
        <!-- Card 2: Pendidikan Vokasi 2 Tahun -->
        <div class="border border-black/10 group cursor-pointer bg-white shadow-sm transition-shadow duration-300 hover:shadow-md">
            <div class="overflow-hidden h-[300px]">
                <img alt="Pendidikan Vokasi 2 Tahun" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxW5mY_zGD0HDOuwOrmrluxFe62YYnMPXOVLSqWRlgjb2vMXfJRycIhaY-CD9oObxiUpXDfsNqINeygV8X8D-cGXIgF1TsGf1oTPgW6_TY1GU8KeHFIgeVZgBDZxo-77h1BWpzJ4Z6JQaflVOHy1jq3aT80-6ua894112IvlKWSK8uWYLygVc8fO53xwVQEVcu7Od_VANVKjmstsZjgZrBxMmHgC8V-HwKbyyG_7PWWcGVDbWh2uLnNw">
            </div>
            <div class="p-8">
                <h3 class="text-2xl font-serif mb-4 text-text-light">Vokasi 2 Tahun</h3>
                <p class="text-muted-light mb-8 text-sm leading-relaxed">Jurusan Culinary Arts, Perhotelan, & F&B Service dengan jaminan OJT hotel bintang 4 & 5.</p>
                <a class="label-text text-xs border-b border-text-light/30 pb-1 hover:text-primary transition-colors" href="/akademi?filter=2-tahun">PROGRAM DETAILS</a>
            </div>
        </div>
        
        <!-- Card 3: Program Eksekutif Cruise Line -->
        <div class="border border-black/10 group cursor-pointer bg-white shadow-sm transition-shadow duration-300 hover:shadow-md">
            <div class="overflow-hidden h-[300px]">
                <img alt="Program Eksekutif Cruise Line" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDO63PKB9j0PZSIejsxFA-pyDKLSi4F2odNeFY2uIrh8kOIqjFrwvv93e4ZKYiNJ-dZ5BkULb9Fi61NiHFRyKTKMXZ8TGT-5v0yb7WTTtTwaDvUO6gdGFA1X1i7kJ-tOhNjaa499vvTyEkXIHBeryw3dSs-_PvWfpIXUtcxslmh-lvlSqpTB80bYuj1cXpa2bem_wW0OCyUvpUqHlFKEQc_NxIoy3OS_kFmFX8miorPLtRfU6qVyh5bdw">
            </div>
            <div class="p-8">
                <h3 class="text-2xl font-serif mb-4 text-text-light">Program Eksekutif</h3>
                <p class="text-muted-light mb-8 text-sm leading-relaxed">Program singkat 6 bulan kapal pesiar (Cook, Steward, Bartender) dengan bonus gratis paspor & seaman book.</p>
                <a class="label-text text-xs border-b border-text-light/30 pb-1 hover:text-primary transition-colors" href="/akademi?filter=eksekutif">PROGRAM DETAILS</a>
            </div>
        </div>
    </div>
</section>

<!-- Facilities Showcase -->
<section class="py-24 px-6 md:px-16 max-w-7xl mx-auto border-t border-black/10">
    <div class="text-center mb-16">
        <span class="label-text text-text-light">WORLD CLASS FACILITIES</span>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 relative h-[500px] md:h-[600px] group overflow-hidden">
            <img alt="Industry Kitchen" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAuTCak20mOeB9LQyn2XonJILtYY9k6DyYGKEQ_2nztbxQWXwrVPOL29MgalMVIKCAW04dx_vIrTJCd_XfZmfX9_9hbLrXB0cPP_Z2UsA4IYQswE7_qtBrSAXUCYqMucBYQEqjuiG38mvQaMG5r26TUh-29dvwJ_34-CjtOGQkO16jk6q2OBqzcfV9-nc_yifBoKLwOk3ZQgc4Y8cMYrRz7pnjfbDsJcv_KI3heB7aNsCudsGWesMK0CA">
            <div class="absolute bottom-6 left-6 bg-black/60 backdrop-blur-sm px-4 py-2 text-white text-xs uppercase tracking-wider">INDUSTRY KITCHEN</div>
        </div>
        
        <div class="flex flex-col gap-6 h-[500px] md:h-[600px]">
            <div class="relative h-1/2 group overflow-hidden">
                <img alt="Mock Suite" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCyOX_hVvTkAG09wnSm_vRW8D4osAWduBcFAjzCZ1wV4i4GPLit9wTP_i2XtVSYgamC--GK74WFus4JzhyZYBIq4uQo7edkXb7qbkbYZSD7tyTMmm-avYEYkfxEHRv3d-UVeXaNEwoeW8jpXjQnhYk1Ixp0oGDWNB4GRjOVwWJw9-VOBMkmWx-HYymiZmpE5WXj8wKO1j_zVtxaJ0IuVTJ7-kam2tSORas5a52dmUAOG2LK1tpKCHpOFg">
                <div class="absolute bottom-6 left-6 bg-black/60 backdrop-blur-sm px-4 py-2 text-white text-xs uppercase tracking-wider">MOCK SUITE</div>
            </div>
            
            <div class="relative h-1/2 group overflow-hidden">
                <img alt="Training Bar" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDA-3TVgjqn3rAEEMHDMk4BdnH6XnDlEPUP2Nc_9LrVXk3EsldakTpUoLH42IgL4tS_sVrXfm3KbpdvDhxRTcJUyVrKQmhaPn_BBDJ0FQiIz9SJi62qfc9pDjuHpvzqiMNxJPWxI8ctpmx-Bz4jTY1IKMeJRtHAnb_9GJQUvK8bEsDw0ux1S4BVwNd1eC9utAz77RQgpUE8mrqmszl64keLmdWPNOJCyYE2gv5BmNUXFWMpsee-QQJ53A">
                <div class="absolute bottom-6 left-6 bg-black/60 backdrop-blur-sm px-4 py-2 text-white text-xs uppercase tracking-wider">TRAINING BAR</div>
            </div>
        </div>
    </div>
</section>

<!-- Message from Director Section (Replacing dummy Ritz-Carlton testimonial) -->
<section class="py-32 bg-surface-light px-6 md:px-16 relative">
    <div class="max-w-4xl mx-auto text-center relative z-10 text-text-light">
        <span class="label-text text-primary mb-8 block">PESAN DIREKTUR</span>
        <!-- TODO: Tambahkan testimonial alumni asli jika data sudah tersedia -->
        <h2 class="text-2xl md:text-3xl font-serif leading-relaxed mb-8">
            "Halo sahabat excellent, Denpasar Hotel School hadir dengan sebuah komitmen untuk mengantarkan calon profesional muda menjadi SDM Indonesia yang unggul dan kompeten. Di Denpasar Hotel School, Anda akan dilatih oleh para praktisi yang telah berpengalaman di bidangnya masing-masing. Mari bergabung bersama kami, Denpasar Hotel School, kami siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global."
        </h2>
        <div>
            <h4 class="font-bold text-sm tracking-widest uppercase mb-1">I Made Dwija Suastana, S.H., M.H.</h4>
            <p class="label-text text-muted-light">DIREKTUR DENPASAR HOTEL SCHOOL — SALAM EXCELLENT!</p>
        </div>
    </div>
</section>

<!-- Insights & Articles Section -->
<section class="py-24 px-6 md:px-16 max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-end mb-16">
        <div>
            <span class="label-text text-primary mb-4 block">INSIGHTS</span>
            <h2 class="text-5xl md:text-6xl font-serif leading-tight text-text-light">News &amp; Articles.</h2>
        </div>
        <a class="label-text border-b border-primary pb-1 mt-6 md:mt-0 hover:text-primary transition-colors text-primary" href="/berita">VIEW ARCHIVE</a>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Main Featured Article -->
        <div class="group cursor-pointer">
            <div class="overflow-hidden mb-8 h-[400px]">
                <img alt="Team meeting" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAO3TjdyecwwVtS9SP20fK3_4C9aPBiHhONLdja28RvyQ_WiSbCtw3yhXXWyIA-_0QjM3PyUVN4YdtPRrVPQKbZXYiLJcuFqUp0dShFMbOX2jWwnoDr2-hu_aUwmAMCP1at0lGcWERGUPEm1WhFlotXnftrEp4j1XKnawHtj_e-Q7d2w3zSUOtfQAFRpOIdTo4Ee8E6dy6fcOnjn_g5oKV5WL04cs1Ghu3nWQ9ErWT5FTk7UVtFtM8_ww">
            </div>
            <div class="flex items-center space-x-3 mb-4">
                <span class="label-text text-primary text-[0.6rem]">EVENTS</span>
                <span class="w-1 h-1 rounded-full bg-muted-light/30"></span>
                <span class="label-text text-muted-light text-[0.6rem]">SEP 12, 2024</span>
            </div>
            <h3 class="text-3xl font-serif mb-4 leading-tight text-text-light group-hover:text-primary transition-colors">DHS Partnerships with Luxury Cruise Lines 2026</h3>
            <p class="text-muted-light mb-6 leading-relaxed text-sm">Denpasar Hotel School announces an exclusive partnership with three global cruise lines. This collaboration will provide our top-tier students with unprecedented access to floating-luxury internships, elevating standard marine hospitality training...</p>
            <a class="label-text text-xs border-b border-text-light/30 pb-1 hover:text-primary transition-colors" href="/berita/cruise-partnership-2026">READ FULL ARTICLE →</a>
        </div>
        
        <!-- Small Articles List -->
        <div class="flex flex-col gap-8">
            <!-- Article 1 -->
            <div class="flex gap-6 group cursor-pointer border-b border-black/5 pb-8">
                <div class="w-32 h-32 flex-shrink-0 overflow-hidden">
                    <img alt="Culinary dish" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAOSLVSRHrQY7s9VWmSs04TV3EjPDPwXecszDnbnTZdlKMbo2Vd0WroDGcDAhcWm7TbrOYNO05puHkFoqlIClDRA0hdXnsz1waqZytA_z-Eec9UZOlRQxyNqwul_0HBclEU_z_dH9iOsQ8A3rsvPwYTtYkqJc1BIsATalvHW5OSyjLNtrmfnTQeXWR4RmgzYkva0lr7Rmd_HeZO2e4pWgzUtPYdBqc7wROamPgt_YrSYvQHNQ5cIqdIdQ">
                </div>
                <div>
                    <span class="label-text text-primary text-[0.6rem] mb-2 block">WORKSHOP</span>
                    <h4 class="text-xl font-serif mb-2 leading-snug text-text-light group-hover:text-primary transition-colors">Culinary Masterclass with Michelin Chefs</h4>
                    <span class="label-text text-muted-light text-[0.6rem]">AUG 25, 2024</span>
                </div>
            </div>
            
            <!-- Article 2 -->
            <div class="flex gap-6 group cursor-pointer border-b border-black/5 pb-8">
                <div class="w-32 h-32 flex-shrink-0 overflow-hidden">
                    <img alt="Hotel interior" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCBBM8Cew2Zj_xFW078EjybXe3HFH4ljOwP6ScrqZaBOSYPfm9OEMg1QTiBEDQtgRaPwSzGVFZWtxyjVjG7THaHxzgVtk2FJRgFx9uEJ1_N22f4xbj8wTmV6NsoqVHjc-LuAUUwp8xJUo9CE0egnbeTW0VIJbiQu5-33lrPYvWOyERCC-GgvUvw1AceDUx9udxp56x_pL037xrYx30NGvAQVfLsGOQc1V2RexfoEpIDtB-UtkPZKLW6yA">
                </div>
                <div>
                    <span class="label-text text-primary text-[0.6rem] mb-2 block">CAREERS</span>
                    <h4 class="text-xl font-serif mb-2 leading-snug text-text-light group-hover:text-primary transition-colors">Graduates Leading Boutique Resorts in Asia</h4>
                    <span class="label-text text-muted-light text-[0.6rem]">AUG 15, 2024</span>
                </div>
            </div>
            
            <!-- Article 3 -->
            <div class="flex gap-6 group cursor-pointer pb-2">
                <div class="w-32 h-32 flex-shrink-0 overflow-hidden">
                    <img alt="Eco resort" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBT3146jDkz7k7l8W_Pe9wP81NZq8CHsF8TDxzE6yss-GNpP-U9J05Tf26bqmEfwCuNIs-r32cWfsatZnGNb11ihIw9dnzdjodyKagakbY5b4jD32sHMQUBTvlHDMPv1tnQWreyZL9LYUclFFcv7lsNsLxKy4MJm8PKKqHeuYvGhHQPXRu_UOhg8ks6xnTtwP_3Cgv56ZVSZ2LNeC2LwH-9RkkxnLLq4wz48juU72N9FwdIQ1x8kBgwwQ">
                </div>
                <div>
                    <span class="label-text text-primary text-[0.6rem] mb-2 block">SUSTAINABILITY</span>
                    <h4 class="text-xl font-serif mb-2 leading-snug text-text-light group-hover:text-primary transition-colors">Sustainable Hospitality Campus Initiatives</h4>
                    <span class="label-text text-muted-light text-[0.6rem]">AUG 05, 2024</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="py-16 bg-surface-light px-6 md:px-16 border-b border-black/5">
    <div class="max-w-7xl mx-auto text-center">
        <span class="label-text text-text-light mb-8 block">MITRA AKADEMIK & INDUSTRI</span>
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-8 gap-8 items-center justify-items-center opacity-70 text-text-light font-medium text-xs">
            <div class="text-center font-serif py-2">The Hotel School Sydney/Melbourne</div>
            <div class="text-center font-serif py-2">TAFE Australia</div>
            <div class="text-center font-serif py-2">Ausbildung Jerman</div>
            <div class="text-center font-serif py-2">Bursa SDM Indonesia</div>
            <div class="text-center font-serif py-2">GCOM Education</div>
            <div class="text-center font-serif py-2">NEO by ASTON</div>
            <div class="text-center font-serif py-2">Four Points Ungasan</div>
            <div class="text-center font-serif py-2">Kuta Paradiso Hotel</div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section id="contact-section" class="py-24 bg-surface-light px-6 md:px-16">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 md:gap-24">
        <div class="text-text-light">
            <span class="label-text text-primary mb-4 block">CONTACT</span>
            <h2 class="text-5xl md:text-7xl font-serif mb-12 leading-tight">Hubungi<br>Kami.</h2>
            
            <div class="space-y-8">
                <div>
                    <span class="label-text text-primary mb-2 block">KAMPUS DENPASAR</span>
                    <p class="text-base font-semibold">Jl. Sari Dana IV No. 1 Gatsu Barat, Denpasar 80116, Bali</p>
                    <p class="text-sm text-muted-light mt-1">WA: +62 81 246 319966 | Email: sahabat@dhs.or.id</p>
                </div>
                <div>
                    <span class="label-text text-primary mb-2 block">KAMPUS KLUNGKUNG</span>
                    <p class="text-base font-semibold">Jl. Raya Takmung No. 36, Klungkung 80752, Bali</p>
                    <p class="text-sm text-muted-light mt-1">Telp: +0366 5582998 | WA: +62 81 337 106480</p>
                </div>
                <div>
                    <span class="label-text text-muted-light mb-2 block">PENDAFTARAN ONLINE</span>
                    <p class="text-sm font-medium">Linktree: <a href="https://linktr.ee/BiayaPendidikan_DHS" target="_blank" class="underline text-primary hover:text-dhs-darknavy">BiayaPendidikan_DHS</a></p>
                    <p class="text-sm font-medium">Portal: <a href="http://www.dhs.or.id/student" target="_blank" class="underline text-primary hover:text-dhs-darknavy">www.dhs.or.id/student</a></p>
                </div>
            </div>
        </div>
        
        <!-- Contact Form Card with Cream Background & Sharp Corners -->
        <div class="bg-background-light p-12 shadow-sm border border-black/5">
            <h3 class="text-2xl font-serif mb-8 text-text-light">Send an Inquiry</h3>
            
            <form class="space-y-8" onsubmit="event.preventDefault(); alert('Inquiry submitted!');">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="label-text text-muted-light mb-2 block">FULL NAME</label>
                        <input class="w-full bg-transparent border-0 border-b border-black/20 focus:ring-0 focus:border-primary px-0 py-2 placeholder-muted-light/50 text-text-light" placeholder="e.g. John Doe" type="text" required>
                    </div>
                    <div>
                        <label class="label-text text-muted-light mb-2 block">EMAIL ADDRESS</label>
                        <input class="w-full bg-transparent border-0 border-b border-black/20 focus:ring-0 focus:border-primary px-0 py-2 placeholder-muted-light/50 text-text-light" placeholder="e.g. john@example.com" type="email" required>
                    </div>
                </div>
                
                <div>
                    <label class="label-text text-muted-light mb-2 block">PROGRAM OF INTEREST</label>
                    <select class="w-full bg-transparent border-0 border-b border-black/20 focus:ring-0 focus:border-primary px-0 py-2 text-muted-light">
                        <option>Select a Program</option>
                        <option>Culinary Arts</option>
                        <option>Hospitality Management</option>
                        <option>F&amp;B Service</option>
                    </select>
                </div>
                
                <div>
                    <label class="label-text text-muted-light mb-2 block">MESSAGE</label>
                    <textarea class="w-full bg-transparent border-0 border-b border-black/20 focus:ring-0 focus:border-primary px-0 py-2 placeholder-muted-light/50 text-text-light resize-none" placeholder="How can we help you?" rows="4" required></textarea>
                </div>
                
                <!-- Navy solid button with sharp corners -->
                <button class="w-full py-4 bg-dhs-navy text-white text-sm font-bold tracking-widest uppercase hover:bg-dhs-darknavy transition-colors mt-4" type="submit">SUBMIT INQUIRY</button>
            </form>
        </div>
    </div>
</section>

<!-- Visit / Directions Section -->
<section class="relative h-[500px] w-full bg-gray-200 dark:bg-gray-800">
    <div class="absolute inset-0 opacity-30 mix-blend-multiply bg-[url('https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=2000&auto=format&fit=crop')] bg-cover bg-center"></div>
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <div class="bg-white p-8 shadow-xl max-w-sm text-center pointer-events-auto border border-black/5">
            <span class="material-icons text-primary text-3xl mb-4">location_on</span>
            <h3 class="text-2xl font-serif mb-2 text-text-light">Visit Our Campus</h3>
            <p class="text-muted-light text-sm mb-6">Experience our world-class facilities first-hand. Schedule a private tour.</p>
            <a class="inline-block px-6 py-2 border border-black/20 text-xs font-bold tracking-widest uppercase hover:bg-black/5 text-text-light transition-colors" href="https://maps.google.com" target="_blank" rel="noopener">GET DIRECTIONS →</a>
        </div>
    </div>
</section>
@endsection
