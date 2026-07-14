@extends('layouts.app')

@section('title', 'Akademi — Denpasar Hotel School')

@section('content')
<!-- Hero Section -->
<header class="relative pt-32 pb-24 md:pt-48 md:pb-32 px-5 md:px-16 max-w-[1280px] mx-auto">
    <div class="mb-8">
        <p class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-muted-light mb-4 flex items-center space-x-2">
            <a class="hover:text-primary transition-colors" href="/">Beranda</a>
            <span class="material-icons text-sm">chevron_right</span>
            <span class="text-primary">Akademi</span>
        </p>
        <p class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4">Program Akademik</p>
        <h1 class="text-[40px] md:text-[64px] leading-[1.1] font-bold font-serif text-text-light max-w-3xl">Akademi &amp; Pelatihan Profesional</h1>
    </div>
    <div class="relative w-full h-[400px] md:h-[600px] overflow-hidden mt-12">
        <img class="w-full h-full object-cover" alt="Culinary students in training kitchen" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxn2eqm_jRIxoqtBqU_Z4510mT8Oum1XJuCt3B4qsnaur1kOxl1kswsTUDy_IWkop-w6gCJC9c4z-J1rwUSX4qHaSazUfu4x09voqcT3DY8fhiWkEHZcuUOZBNOolJHzCrNRQQXlB6UNrMOsC2_nhrMbSl_DzCpEu5YNeYXrmzbkHsYKIWxKH0th79FkaqCRHftpuCaHJyYzxate_qQzEmQcWi4iGgWxF-wIUFQGCYA83w8lUepgu6VQ">
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
    </div>
</header>

<!-- Main Content -->
<main class="pb-24">
    <!-- Tab Navigation -->
    <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-16 border-b border-black/10">
        <div class="flex space-x-8 overflow-x-auto pb-4">
            <button class="tab-btn text-[0.7rem] uppercase tracking-[0.15em] font-semibold whitespace-nowrap text-text-light border-b-2 border-primary pb-2 transition-colors" data-target="culinary">Culinary Arts</button>
            <button class="tab-btn text-[0.7rem] uppercase tracking-[0.15em] font-semibold whitespace-nowrap text-muted-light hover:text-primary pb-2 transition-colors border-b-2 border-transparent" data-target="hospitality">Hospitality Management</button>
            <button class="tab-btn text-[0.7rem] uppercase tracking-[0.15em] font-semibold whitespace-nowrap text-muted-light hover:text-primary pb-2 transition-colors border-b-2 border-transparent" data-target="fb">F&amp;B Service</button>
        </div>
    </section>

    <!-- Culinary Arts Program (Active) -->
    <div class="tab-content active max-w-[1280px] mx-auto px-5 md:px-16" id="culinary" style="display:block;">
        <!-- Summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-24 items-center">
            <div>
                <h2 class="text-[48px] leading-[1.2] font-semibold font-serif mb-6 text-text-light">Culinary Arts</h2>
                <p class="text-base text-muted-light leading-relaxed mb-8">Program intensif yang menggabungkan teknik kuliner klasik dengan inovasi gastronomi modern. Dirancang untuk mencetak koki profesional yang siap bersaing di dapur hotel berbintang dan restoran kelas dunia.</p>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <span class="material-icons text-primary mr-3 mt-1">schedule</span>
                        <div>
                            <strong class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold block text-text-light">Durasi</strong>
                            <span class="text-sm text-muted-light">18 Bulan (12 Bulan Teori &amp; Praktik + 6 Bulan Magang)</span>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <span class="material-icons text-primary mr-3 mt-1">verified</span>
                        <div>
                            <strong class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold block text-text-light">Sertifikasi</strong>
                            <span class="text-sm text-muted-light">Diploma I + Sertifikasi Profesi Nasional (BNSP)</span>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <span class="material-icons text-primary mr-3 mt-1">restaurant</span>
                        <div>
                            <strong class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold block text-text-light">Praktik</strong>
                            <span class="text-sm text-muted-light">70% Praktik Langsung di Dapur Standar Industri</span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="relative h-[500px]">
                <img class="w-full h-full object-cover shadow-xl" alt="Chef instructor guiding student" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAowavCDdZQkUdNdoSnyJZ4PinttYbln512VUgBEXw0mvWGj4DwuCh2anQGq4D51oKkLTUm-n-LDBfTTMIeLKs9zkExLVUkLLfnFFg9F9yKdBIsBf1V6zW1_-YAzHYASXjDJ0Pto0fCbfuRf5UgVrjDefhoK67nRAMmDsrneuAZFocbvx-Y1aroxs7EsWqADb1g7b1WDfl9nAO62RGCyYRHBgdDHV9tAsvagIN-CM0UmCRNpIr6Ps6ORA">
            </div>
        </div>

        <!-- Kurikulum Accordion -->
        <div class="mb-24">
            <h3 class="text-[32px] leading-[1.3] font-semibold font-serif mb-10 border-b border-black/10 pb-4 text-text-light">Kurikulum</h3>
            <div class="space-y-4">
                <div class="border border-black/10 bg-white overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 bg-dhs-cream hover:bg-dhs-beige transition-colors text-left" onclick="this.nextElementSibling.classList.toggle('hidden')">
                        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light">Semester 1: Fondasi Kuliner</span>
                        <span class="material-icons text-muted-light">expand_more</span>
                    </button>
                    <div class="p-6 text-base text-muted-light bg-white border-t border-black/10 hidden">
                        <ul class="list-disc pl-5 space-y-2">
                            <li>Pengenalan Alat &amp; Keselamatan Dapur (Kitchen Safety &amp; Hygiene)</li>
                            <li>Teknik Memotong (Knife Skills) Dasar</li>
                            <li>Pembuatan Kaldu (Stocks) dan Saus Dasar (Mother Sauces)</li>
                            <li>Metode Memasak Klasik (Classic Cooking Methods)</li>
                        </ul>
                    </div>
                </div>
                <div class="border border-black/10 bg-white overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 bg-dhs-cream hover:bg-dhs-beige transition-colors text-left" onclick="this.nextElementSibling.classList.toggle('hidden')">
                        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light">Semester 2: Spesialisasi &amp; Lanjutan</span>
                        <span class="material-icons text-muted-light">expand_more</span>
                    </button>
                    <div class="p-6 text-base text-muted-light bg-white border-t border-black/10 hidden">
                        <ul class="list-disc pl-5 space-y-2">
                            <li>Masakan Internasional (Western &amp; Asian Cuisine)</li>
                            <li>Garde Manger (Cold Kitchen)</li>
                            <li>Manajemen Dapur (Kitchen Management &amp; Costing)</li>
                            <li>Persiapan Magang Industri (On-the-Job Training Prep)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fasilitas -->
        <div class="mb-24">
            <h3 class="text-[32px] leading-[1.3] font-semibold font-serif mb-10 text-center text-text-light">Fasilitas Kelas Dunia</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="group relative overflow-hidden">
                    <img class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500" alt="Hot Kitchen" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAyc_DpsG87AfWrshUPlxIuKJvZHkN6oU7L4YS1jdArSgxdWcKYnc24iT2j0Bm89HwJwgt4EzxhqA1uVwgXNn4OGrPnTDiByZsNp12wbAlT64ckn8FEDJ1gJzcgrTypE0q2Uukg1SCEVPaAYxQ6BjsjWyKqCscfL49HiymbPwORh5-WpELYPux0KqJtUDVkt88aAZOCHiZTC9dq_RYls5MXYqUV4qY5ol-_PTi-9-CK1woAVpvlOL9Alw">
                    <div class="absolute bottom-0 w-full bg-black/60 p-4"><span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-white">Hot Kitchen</span></div>
                </div>
                <div class="group relative overflow-hidden">
                    <img class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500" alt="Training Restaurant" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDslqiK1EY_vVvpSUaZ3HKcY_udrog097-WzK-4ydrpMp2wj2jJuHLaVvnjfVnZura1Mp50g0UOuQU-gF31BlFi-yBxfEoFXqQzxJEr_0gNQj8kqiM8aWu04EhViNxLu4UncE1M6frjjBInEcUmFXFR0DaGdVNrc-HhiUiodDKQfE_1GG1owwcFUNUzmKAlhVugbKsR2B7WmYzWoI74Iak2TYSz9NQNWmxKw_IKxJgIMInn64hC3F6tsw">
                    <div class="absolute bottom-0 w-full bg-black/60 p-4"><span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-white">Training Restaurant</span></div>
                </div>
                <div class="group relative overflow-hidden">
                    <img class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500" alt="Pastry Lab" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAY6LrN9f5Nq5j32FUUxsFtc5_P0jPYYqtegclPx0WddPGXz3NAP5QyXRQKv3QPZuuwB-ufyvOWKjNge03peUNibXADkNJWPCmRurwbHFCcjBmNnHgxH-eOqQpM_mK4f62QOotLf0AAseOf7FtUCnZAzwH_ool0Fe9f2fhYAP1TQP9L-Ezj8Bz57FsBkVzMYGSUo14JradZDyvo64CgVZkhiiz2y3H30sI7nQKLby6-1b9qt84cq1Fy2g">
                    <div class="absolute bottom-0 w-full bg-black/60 p-4"><span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-white">Pastry Lab</span></div>
                </div>
            </div>
        </div>

        <!-- Career Prospects & Testimonial -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-24 bg-dhs-cream p-12">
            <div>
                <h3 class="text-[32px] leading-[1.3] font-semibold font-serif mb-6 text-text-light">Prospek Karier</h3>
                <p class="text-base text-muted-light mb-6">Lulusan kami dipersiapkan untuk menempati berbagai posisi strategis di industri kuliner global.</p>
                <ul class="space-y-3">
                    <li class="flex items-center text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light"><span class="material-icons text-primary mr-2 text-sm">check_circle</span> Executive Chef</li>
                    <li class="flex items-center text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light"><span class="material-icons text-primary mr-2 text-sm">check_circle</span> Sous Chef</li>
                    <li class="flex items-center text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light"><span class="material-icons text-primary mr-2 text-sm">check_circle</span> Pastry Chef</li>
                    <li class="flex items-center text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light"><span class="material-icons text-primary mr-2 text-sm">check_circle</span> Food &amp; Beverage Manager</li>
                </ul>
            </div>
            <div class="flex flex-col justify-center border-l-2 border-black/10 pl-12">
                <span class="material-icons text-primary text-4xl mb-4 opacity-50">format_quote</span>
                <p class="text-lg italic text-muted-light mb-6">"Disiplin dan standar tinggi yang diajarkan di DHS menjadi pondasi kuat karir saya. Pengetahuan kuliner dan etos kerja yang saya dapatkan di sini sangat relevan dengan tuntutan industri internasional."</p>
                <div class="flex items-center">
                    <img class="w-16 h-16 rounded-full object-cover mr-4" alt="Budi Santoso" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDeYrRiWE5PIngmO86w0Cn5hPsDfiG59HTAVn8-asaEPcvD_fxcdAfcXy_4KR3Pj-pL3DyMS_WN9hCkZFO-lSelGflhgKm5r2oTS_3HJ83ZvydeMvZY_QKmjAItPrh0n3Yvymm1YaFTXkLZpopTGMNQl17m_JEFUai2rxAdUHMzWu383ihOl9jx19ZEtRwSlqf0azKeZNaeaNPVSW6SAXdOP0RroYx1ZflK8JBFkyTsOLiVdTtucCRmxQ">
                    <div>
                        <strong class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light block">Budi Santoso</strong>
                        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-muted-light block">Sous Chef, The Ritz-Carlton Bali — Class of 2018</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hospitality Management Tab -->
    <div class="tab-content max-w-[1280px] mx-auto px-5 md:px-16" id="hospitality" style="display:none;">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-24 items-center">
            <div>
                <h2 class="text-[48px] leading-[1.2] font-semibold font-serif mb-6 text-text-light">Hospitality Management</h2>
                <p class="text-base text-muted-light leading-relaxed mb-8">Program strategis yang mempersiapkan pemimpin operasional hotel dan resort berbintang. Dari manajemen tamu hingga rooms division, lulusan siap mengisi peran kepemimpinan di industri akomodasi mewah global.</p>
                <ul class="space-y-4">
                    <li class="flex items-start"><span class="material-icons text-primary mr-3 mt-1">schedule</span><div><strong class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold block text-text-light">Durasi</strong><span class="text-sm text-muted-light">18 Bulan (12 Bulan Teori &amp; Praktik + 6 Bulan Magang)</span></div></li>
                    <li class="flex items-start"><span class="material-icons text-primary mr-3 mt-1">verified</span><div><strong class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold block text-text-light">Sertifikasi</strong><span class="text-sm text-muted-light">Diploma I + Sertifikasi Hotel Management (BNSP)</span></div></li>
                    <li class="flex items-start"><span class="material-icons text-primary mr-3 mt-1">hotel</span><div><strong class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold block text-text-light">Praktik</strong><span class="text-sm text-muted-light">50% Praktik di Mock Suite &amp; Reception Standar Industri</span></div></li>
                </ul>
            </div>
            <div class="relative h-[500px]">
                <img class="w-full h-full object-cover shadow-xl" alt="Hotel Management Training" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxW5mY_zGD0HDOuwOrmrluxFe62YYnMPXOVLSqWRlgjb2vMXfJRycIhaY-CD9oObxiUpXDfsNqINeygV8X8D-cGXIgF1TsGf1oTPgW6_TY1GU8KeHFIgeVZgBDZxo-77h1BWpzJ4Z6JQaflVOHy1jq3aT80-6ua894112IvlKWSK8uWYLygVc8fO53xwVQEVcu7Od_VANVKjmstsZjgZrBxMmHgC8V-HwKbyyG_7PWWcGVDbWh2uLnNw">
            </div>
        </div>
    </div>

    <!-- F&B Service Tab -->
    <div class="tab-content max-w-[1280px] mx-auto px-5 md:px-16" id="fb" style="display:none;">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-24 items-center">
            <div>
                <h2 class="text-[48px] leading-[1.2] font-semibold font-serif mb-6 text-text-light">F&amp;B Service</h2>
                <p class="text-base text-muted-light leading-relaxed mb-8">Program yang mengembangkan keahlian dalam seni pelayanan makanan dan minuman mewah. Dari mixology tingkat tinggi hingga koreografi tak terlihat dari fine dining, lulusan siap menciptakan pengalaman bersantap yang tak terlupakan.</p>
                <ul class="space-y-4">
                    <li class="flex items-start"><span class="material-icons text-primary mr-3 mt-1">schedule</span><div><strong class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold block text-text-light">Durasi</strong><span class="text-sm text-muted-light">18 Bulan (12 Bulan Teori &amp; Praktik + 6 Bulan Magang)</span></div></li>
                    <li class="flex items-start"><span class="material-icons text-primary mr-3 mt-1">verified</span><div><strong class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold block text-text-light">Sertifikasi</strong><span class="text-sm text-muted-light">Diploma I + Sertifikasi F&amp;B Service (BNSP)</span></div></li>
                    <li class="flex items-start"><span class="material-icons text-primary mr-3 mt-1">local_bar</span><div><strong class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold block text-text-light">Praktik</strong><span class="text-sm text-muted-light">70% Praktik di Training Bar &amp; Restaurant Standar Industri</span></div></li>
                </ul>
            </div>
            <div class="relative h-[500px]">
                <img class="w-full h-full object-cover shadow-xl" alt="F&B Service Training" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDO63PKB9j0PZSIejsxFA-pyDKLSi4F2odNeFY2uIrh8kOIqjFrwvv93e4ZKYiNJ-dZ5BkULb9Fi61NiHFRyKTKMXZ8TGT-5v0yb7WTTtTwaDvUO6gdGFA1X1i7kJ-tOhNjaa499vvTyEkXIHBeryw3dSs-_PvWfpIXUtcxslmh-lvlSqpTB80bYuj1cXpa2bem_wW0OCyUvpUqHlFKEQc_NxIoy3OS_kFmFX8miorPLtRfU6qVyh5bdw">
            </div>
        </div>
    </div>

    <!-- Program Comparison Table -->
    <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-24">
        <h3 class="text-[32px] leading-[1.3] font-semibold font-serif mb-10 text-center text-text-light">Ikhtisar Program</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left bg-white shadow-sm border border-black/5">
                <thead class="bg-dhs-cream border-b border-black/10">
                    <tr>
                        <th class="p-6 text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light w-1/4">Fitur</th>
                        <th class="p-6 text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light border-l border-black/10">Culinary Arts</th>
                        <th class="p-6 text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light border-l border-black/10">Hospitality Management</th>
                        <th class="p-6 text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-text-light border-l border-black/10">F&amp;B Service</th>
                    </tr>
                </thead>
                <tbody class="text-base text-muted-light divide-y divide-black/5">
                    <tr>
                        <td class="p-6 font-semibold text-text-light">Fokus Utama</td>
                        <td class="p-6 border-l border-black/5">Teknik memasak &amp; manajemen dapur</td>
                        <td class="p-6 border-l border-black/5">Operasional hotel &amp; layanan tamu</td>
                        <td class="p-6 border-l border-black/5">Pelayanan restoran &amp; mixology</td>
                    </tr>
                    <tr>
                        <td class="p-6 font-semibold text-text-light">Durasi</td>
                        <td class="p-6 border-l border-black/5">18 Bulan</td>
                        <td class="p-6 border-l border-black/5">18 Bulan</td>
                        <td class="p-6 border-l border-black/5">18 Bulan</td>
                    </tr>
                    <tr>
                        <td class="p-6 font-semibold text-text-light">Rasio Praktik</td>
                        <td class="p-6 border-l border-black/5">70% Praktik / 30% Teori</td>
                        <td class="p-6 border-l border-black/5">50% Praktik / 50% Teori</td>
                        <td class="p-6 border-l border-black/5">70% Praktik / 30% Teori</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="max-w-3xl mx-auto px-5 text-center mb-24">
        <h2 class="text-[48px] leading-[1.2] font-semibold font-serif mb-6 text-text-light">Siap Memulai Karier?</h2>
        <p class="text-base text-muted-light mb-10">Ambil langkah pertama menuju masa depan cemerlang di industri hospitality global. Bergabunglah dengan Denpasar Hotel School hari ini.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            {{-- TODO: Route /cara-mendaftar belum dibuat, menggunakan # sementara --}}
            <a class="px-8 py-4 bg-dhs-navy text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-darknavy transition-colors" href="/cara-mendaftar">Daftar Program</a>
            <a class="px-8 py-4 bg-transparent border border-dhs-navy text-dhs-navy text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-cream transition-colors" href="#">Unduh Brosur</a>
        </div>
    </section>
</main>

<script>
    // Tab switching logic
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            tabBtns.forEach(b => {
                b.classList.remove('text-text-light', 'border-primary');
                b.classList.add('text-muted-light', 'border-transparent');
            });
            tabContents.forEach(c => c.style.display = 'none');
            btn.classList.remove('text-muted-light', 'border-transparent');
            btn.classList.add('text-text-light', 'border-primary');
            const target = document.getElementById(btn.dataset.target);
            if (target) target.style.display = 'block';
        });
    });
</script>
@endsection
