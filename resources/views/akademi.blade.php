@extends('layouts.app')

@section('title', 'Program Akademi — Denpasar Hotel School')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img alt="Students in training kitchen" class="absolute inset-0 w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxn2eqm_jRIxoqtBqU_Z4510mT8Oum1XJuCt3B4qsnaur1kOxl1kswsTUDy_IWkop-w6gCJC9c4z-J1rwUSX4qHaSazUfu4x09voqcT3DY8fhiWkEHZcuUOZBNOolJHzCrNRQQXlB6UNrMOsC2_nhrMbSl_DzCpEu5YNeYXrmzbkHsYKIWxKH0th79FkaqCRHftpuCaHJyYzxate_qQzEmQcWi4iGgWxF-wIUFQGCYA83w8lUepgu6VQ">

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><span data-id="Akademi" data-en="Academy">Akademi</span></span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-[1.1]">
                <span data-id="Program Vokasi &amp; Kursus" data-en="Vocational Programs &amp; Courses">Program Vokasi &amp; Kursus</span>
            </h1>
            <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/70 font-medium">
                <span data-id="Program Akademik &amp; Pelatihan" data-en="Academic &amp; Training Programs">Program Akademik &amp; Pelatihan</span>
            </p>
        </div>
    </section>

    <!-- Main Content with 2-Level Filter -->
    <main class="pt-16 pb-24">
        <!-- Category Duration Filter -->
        <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-12" data-reveal="fade-up">
            <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block" data-id="PILIH KATEGORI DURASI" data-en="SELECT DURATION CATEGORY">PILIH KATEGORI DURASI</span>
            <div class="flex flex-wrap gap-3 border-b border-black/10 pb-6">
                <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="internasional"><span data-id="Program Internasional" data-en="International Program">Program Internasional</span></button>
                <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="2-tahun"><span data-id="Vokasi 2 Tahun" data-en="2-Year Vocational">Vokasi 2 Tahun</span></button>
                <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="1-tahun"><span data-id="Vokasi 1 Tahun" data-en="1-Year Vocational">Vokasi 1 Tahun</span></button>
                <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="1-tahun-kapal-pesiar"><span data-id="1 Tahun Kapal Pesiar" data-en="1-Year Cruise Line">1 Tahun Kapal Pesiar</span></button>
                <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="6-bulan"><span data-id="Short Course 6 Bulan" data-en="6-Month Short Course">Short Course 6 Bulan</span></button>
                <button class="filter-tab-btn px-5 py-2.5 bg-transparent border border-black/20 text-text-light text-[0.75rem] uppercase tracking-[0.12em] font-semibold hover:border-text-light transition-all" data-target="eksekutif"><span data-id="Program Eksekutif (6 Bln)" data-en="Executive Program (6 Mo)">Program Eksekutif (6 Bln)</span></button>
            </div>
        </section>

        <!-- Content Sections per Category -->
        <section class="max-w-[1280px] mx-auto px-5 md:px-16" data-reveal="fade-up" data-delay="150">            <!-- Category: Program Internasional (Active by default) -->
            <div class="category-content-panel active" id="panel-internasional">
                <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-10 items-start mb-16">
                    <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg lg:sticky lg:top-24 mb-8 lg:mb-0">
                        <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block" data-id="GLOBAL OPPORTUNITY" data-en="GLOBAL OPPORTUNITY">GLOBAL OPPORTUNITY</span>
                        <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight">
                            <span data-id="Program Internasional" data-en="International Program">Program Internasional</span>
                        </h2>
                        <p class="text-sm text-muted-light leading-relaxed mb-6">
                            <span data-id="DHS bekerjasama dengan The Hotel School Melbourne &amp; Sydney dan TAFE Australia untuk menyalurkan peserta didik DHS yang berminat lanjut untuk melaksanakan pendidikan di luar negeri. Program ini dapat menghasilkan peserta didik yang berkompetensi secara global dan mampu bersaing dalam bursa kerja dan siap dalam masyarakat ekonomi ASEAN (MEA)." data-en="DHS collaborates with The Hotel School Melbourne &amp; Sydney and TAFE Australia to channel DHS students who wish to continue their education abroad. This program produces globally competent students who can compete in the job market and are ready for the ASEAN Economic Community (AEC).">DHS bekerjasama dengan The Hotel School Melbourne &amp; Sydney dan TAFE Australia untuk menyalurkan peserta didik DHS yang berminat lanjut untuk melaksanakan pendidikan di luar negeri. Program ini dapat menghasilkan peserta didik yang berkompetensi secara global dan mampu bersaing dalam bursa kerja dan siap dalam masyarakat ekonomi ASEAN (MEA).</span>
                        </p>
                        <div class="pt-4 border-t border-black/10">
                            <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">
                                <span data-id="Peluang Kerja Lulusan:" data-en="Graduate Career Opportunities:">Peluang Kerja Lulusan:</span>
                            </p>
                            <p class="text-xs text-muted-light leading-relaxed">
                                <span data-id="Hotel Staff, Restaurant Staff, Instruktur LKP/LPK, Wirausaha." data-en="Hotel Staff, Restaurant Staff, LKP/LPK Instructor, Entrepreneur.">Hotel Staff, Restaurant Staff, Instruktur LKP/LPK, Wirausaha.</span>
                            </p>
                        </div>
                    </div>

                    <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach([
                                [
                                    'title_id' => 'Program 1 Tahun + Ausbildung Jerman',
                                    'title_en' => '1-Year Program + Ausbildung Germany',
                                    'desc_id' => 'Pelatihan intensif 1 tahun di kampus dilanjutkan program penempatan Ausbildung kerja di Jerman.',
                                    'desc_en' => 'Intensive 1-year campus training followed by an Ausbildung work placement program in Germany.',
                                    'country_id' => '🇩🇪 JERMAN',
                                    'country_en' => '🇩🇪 GERMANY',
                                    'img' => 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?auto=format&fit=crop&w=800&h=600&q=80'
                                ],
                                [
                                    'title_id' => 'Program 2 Tahun + 1 Semester TAFE Australia',
                                    'title_en' => '2-Year Program + 1 Semester TAFE Australia',
                                    'desc_id' => 'Studi komprehensif di Bali dengan transfer kredit 1 semester di TAFE Australia.',
                                    'desc_en' => 'Comprehensive study in Bali with 1-semester credit transfer at TAFE Australia.',
                                    'country_id' => '🇦🇺 AUSTRALIA',
                                    'country_en' => '🇦🇺 AUSTRALIA',
                                    'img' => 'https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?auto=format&fit=crop&w=800&h=600&q=80'
                                ],
                                [
                                    'title_id' => 'TAFE Australia Pathway',
                                    'title_en' => 'TAFE Australia Pathway',
                                    'desc_id' => 'Program penyaluran langsung menuju perkuliahan TAFE di Australia.',
                                    'desc_en' => 'Direct pathway program to TAFE studies in Australia.',
                                    'country_id' => '🇦🇺 AUSTRALIA',
                                    'country_en' => '🇦🇺 AUSTRALIA',
                                    'img' => 'https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?auto=format&fit=crop&w=800&h=600&q=80'
                                ],
                                [
                                    'title_id' => 'THS Australia Pathway',
                                    'title_en' => 'THS Australia Pathway',
                                    'desc_id' => 'Jalur studi khusus berpartner dengan The Hotel School Sydney & Melbourne.',
                                    'desc_en' => 'Special study pathway partnered with The Hotel School Sydney & Melbourne.',
                                    'country_id' => '🇦🇺 AUSTRALIA',
                                    'country_en' => '🇦🇺 AUSTRALIA',
                                    'img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&h=600&q=80'
                                ],
                                [
                                    'title_id' => 'Australia Short Course',
                                    'title_en' => 'Australia Short Course',
                                    'desc_id' => 'Pelatihan praktis jangka pendek terfokus langsung di Australia.',
                                    'desc_en' => 'Focused short-term practical training directly in Australia.',
                                    'country_id' => '🇦🇺 AUSTRALIA',
                                    'country_en' => '🇦🇺 AUSTRALIA',
                                    'img' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&h=600&q=80'
                                ],
                                [
                                    'title_id' => 'Study Visit (Australia & Singapura)',
                                    'title_en' => 'Study Visit (Australia & Singapore)',
                                    'desc_id' => 'Kunjungan edukasi dan familiarisasi hotel mewah langsung ke Australia atau Singapura.',
                                    'desc_en' => 'Educational visit and luxury hotel familiarization directly to Australia or Singapore.',
                                    'country_id' => '🇸🇬 SINGAPURA & 🇦🇺 AUSTRALIA',
                                    'country_en' => '🇸🇬 SINGAPORE & 🇦🇺 AUSTRALIA',
                                    'img' => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=800&h=600&q=80'
                                ]
                            ] as $course)
                            <div class="group bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full card-hover">
                                <div class="relative overflow-hidden h-44 sm:h-48 lg:h-52 shrink-0">
                                    <img src="{{ $course['img'] }}" alt="{{ $course['title_id'] }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                                    <span class="absolute top-3 right-3 bg-dhs-navy/90 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded tracking-wider shadow-sm">
                                        <span data-id="{{ $course['country_id'] }}" data-en="{{ $course['country_en'] }}">{{ $course['country_id'] }}</span>
                                    </span>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="font-serif font-bold text-lg text-dhs-navy group-hover:text-primary transition-colors mb-2 leading-snug">
                                            <span data-id="{{ $course['title_id'] }}" data-en="{{ $course['title_en'] }}">{{ $course['title_id'] }}</span>
                                        </h3>
                                        <p class="text-xs text-muted-light leading-relaxed mb-4">
                                            <span data-id="{{ $course['desc_id'] }}" data-en="{{ $course['desc_en'] }}">{{ $course['desc_id'] }}</span>
                                        </p>
                                    </div>
                                    <div class="pt-3 border-t border-black/5 flex items-center justify-between text-xs text-primary font-semibold">
                                        <span data-id="Lihat Detail Program" data-en="View Program Details">Lihat Detail Program</span>
                                        <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Category: Pendidikan Vokasi 2 Tahun -->
            <div class="category-content-panel hidden" id="panel-2-tahun">
                <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-10 items-start mb-16">
                    <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg lg:sticky lg:top-24 mb-8 lg:mb-0">
                        <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block" data-id="PROGRAM VOKASI" data-en="VOCATIONAL PROGRAM">PROGRAM VOKASI</span>
                        <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight">
                            <span data-id="Vokasi 2 Tahun" data-en="2-Year Vocational">Vokasi 2 Tahun</span>
                        </h2>
                        <p class="text-sm text-muted-light leading-relaxed mb-6">
                            <span data-id="Memiliki jurusan FB Service Bartender, Perhotelan dan Culinary Arts. Melalui program kerjasama DHS dengan industri, kami menjamin peserta didik mendapatkan penempatan pada saat On The Job Training semester mereka. DHS juga menjamin kualitas program melalui instruktur/dosen yang berpengalaman baik dari teori serta berpengalaman bekerja di kapal pesiar, Hotel Bintang 4 &amp; 5, dengan latar belakang pendidikan dari universitas ternama di Bali, Canada &amp; Jerman." data-en="Offers majors in FB Service Bartender, Hospitality and Culinary Arts. Through DHS industry cooperation programs, we guarantee students get placements during their On The Job Training semester. DHS also guarantees program quality through lecturers/instructors with experienced backgrounds in theory and cruise line or 4 &amp; 5-star hotel experience, with higher education backgrounds from reputable universities in Bali, Canada &amp; Germany.">Memiliki jurusan FB Service Bartender, Perhotelan dan Culinary Arts. Melalui program kerjasama DHS dengan industri, kami menjamin peserta didik mendapatkan penempatan pada saat On The Job Training semester mereka. DHS juga menjamin kualitas program melalui instruktur/dosen yang berpengalaman baik dari teori serta berpengalaman bekerja di kapal pesiar, Hotel Bintang 4 &amp; 5, dengan latar belakang pendidikan dari universitas ternama di Bali, Canada &amp; Jerman.</span>
                        </p>
                        <div class="pt-4 border-t border-black/10">
                            <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">
                                <span data-id="Peluang Kerja Lulusan:" data-en="Graduate Career Opportunities:">Peluang Kerja Lulusan:</span>
                            </p>
                            <p class="text-xs text-muted-light leading-relaxed">
                                <span data-id="Hotel Staff, Restaurant Staff, Barista, Chef/Cook, Entrepreneur." data-en="Hotel Staff, Restaurant Staff, Barista, Chef/Cook, Entrepreneur.">Hotel Staff, Restaurant Staff, Barista, Chef/Cook, Entrepreneur.</span>
                            </p>
                        </div>
                    </div>

                    <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach([
                                [
                                    'title_id' => 'Perhotelan (FO & HK)',
                                    'title_en' => 'Hospitality (FO & HK)',
                                    'desc_id' => 'Fokus pada operasional Front Office dan Housekeeping berstandar hotel bintang 5.',
                                    'desc_en' => 'Focused on Front Office and Housekeeping operations to 5-star hotel standards.',
                                    'badge_id' => '2 TAHUN',
                                    'badge_en' => '2 YEARS',
                                    'img' => 'https://images.pexels.com/photos/5371676/pexels-photo-5371676.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'Tata Boga (Culinary Art)',
                                    'title_en' => 'Culinary Art',
                                    'desc_id' => 'Mengembangkan keahlian memasak masakan internasional dan lokal dengan standar kebersihan tinggi.',
                                    'desc_en' => 'Developing cooking skills for international and local cuisine with high hygiene standards.',
                                    'badge_id' => '2 TAHUN',
                                    'badge_en' => '2 YEARS',
                                    'img' => 'https://images.pexels.com/photos/15323383/pexels-photo-15323383.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'Tata Hidangan (FBS & Bartender)',
                                    'title_en' => 'Food & Beverage Service & Bartending',
                                    'desc_id' => 'Seni pelayanan makanan, minuman, mixology, dan hospitality service terapan.',
                                    'desc_en' => 'The art of food, beverage service, mixology, and applied hospitality service.',
                                    'badge_id' => '2 TAHUN',
                                    'badge_en' => '2 YEARS',
                                    'img' => 'https://images.pexels.com/photos/4485382/pexels-photo-4485382.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ]
                            ] as $course)
                            <div class="group bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full card-hover">
                                <div class="relative overflow-hidden h-44 sm:h-48 lg:h-52 shrink-0">
                                    <img src="{{ $course['img'] }}" alt="{{ $course['title_id'] }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                                    <span class="absolute top-3 right-3 bg-dhs-navy/90 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded tracking-wider shadow-sm">
                                        <span data-id="{{ $course['badge_id'] }}" data-en="{{ $course['badge_en'] }}">{{ $course['badge_id'] }}</span>
                                    </span>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="font-serif font-bold text-lg text-dhs-navy group-hover:text-primary transition-colors mb-2 leading-snug">
                                            <span data-id="{{ $course['title_id'] }}" data-en="{{ $course['title_en'] }}">{{ $course['title_id'] }}</span>
                                        </h3>
                                        <p class="text-xs text-muted-light leading-relaxed mb-4">
                                            <span data-id="{{ $course['desc_id'] }}" data-en="{{ $course['desc_en'] }}">{{ $course['desc_id'] }}</span>
                                        </p>
                                    </div>
                                    <div class="pt-3 border-t border-black/5 flex items-center justify-between text-xs text-primary font-semibold">
                                        <span data-id="Lihat Detail Program" data-en="View Program Details">Lihat Detail Program</span>
                                        <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Category: Pendidikan Vokasi 1 Tahun -->
            <div class="category-content-panel hidden" id="panel-1-tahun">
                <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-10 items-start mb-16">
                    <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg lg:sticky lg:top-24 mb-8 lg:mb-0">
                        <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block" data-id="PROGRAM VOKASI" data-en="VOCATIONAL PROGRAM">PROGRAM VOKASI</span>
                        <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight">
                            <span data-id="Vokasi 1 Tahun" data-en="1-Year Vocational">Vokasi 1 Tahun</span>
                        </h2>
                        <p class="text-sm text-muted-light leading-relaxed mb-6">
                            <span data-id="Memiliki jurusan Cruise Line FB Service &amp; Culinary Arts, FB Service &amp; Culinary Arts, serta Perhotelan. Dirancang untuk persiapan kilat memasuki industri perhotelan bintang 4 &amp; 5 serta kapal pesiar, dengan bimbingan dosen berpengalaman internasional." data-en="Offers majors in Cruise Line FB Service &amp; Culinary Arts, FB Service &amp; Culinary Arts, and Hospitality. Designed for rapid preparation to enter 4 &amp; 5-star hotel and cruise ship industries, guided by internationally experienced lecturers.">Memiliki jurusan Cruise Line FB Service &amp; Culinary Arts, FB Service &amp; Culinary Arts, serta Perhotelan. Dirancang untuk persiapan kilat memasuki industri perhotelan bintang 4 &amp; 5 serta kapal pesiar, dengan bimbingan dosen berpengalaman internasional.</span>
                        </p>
                        <div class="pt-4 border-t border-black/10">
                            <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">
                                <span data-id="Peluang Kerja Lulusan:" data-en="Graduate Career Opportunities:">Peluang Kerja Lulusan:</span>
                            </p>
                            <p class="text-xs text-muted-light leading-relaxed">
                                <span data-id="Hotel Staff, Restaurant Staff, Barista, Assistant Cook, Entrepreneur." data-en="Hotel Staff, Restaurant Staff, Barista, Assistant Cook, Entrepreneur.">Hotel Staff, Restaurant Staff, Barista, Assistant Cook, Entrepreneur.</span>
                            </p>
                        </div>
                    </div>

                    <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach([
                                [
                                    'title_id' => 'Perhotelan (FO & HK)',
                                    'title_en' => 'Hospitality (FO & HK)',
                                    'desc_id' => 'Teori terfokus dan penempatan praktis di Front Office & Housekeeping.',
                                    'desc_en' => 'Focused theory and practical placement in Front Office & Housekeeping.',
                                    'badge_id' => '1 TAHUN',
                                    'badge_en' => '1 YEAR',
                                    'img' => 'https://images.pexels.com/photos/5371676/pexels-photo-5371676.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'Tata Boga (Culinary Art)',
                                    'title_en' => 'Culinary Art',
                                    'desc_id' => 'Fondasi dasar teknik kuliner, penanganan bahan makanan, dan sanitasi.',
                                    'desc_en' => 'Fundamentals of culinary techniques, food handling, and sanitation.',
                                    'badge_id' => '1 TAHUN',
                                    'badge_en' => '1 YEAR',
                                    'img' => 'https://images.pexels.com/photos/15323383/pexels-photo-15323383.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'Tata Hidangan (FBS & Bartender)',
                                    'title_en' => 'Food & Beverage & Bartending',
                                    'desc_id' => 'Dasar pelayanan restoran, pengetahuan menu, dan keterampilan bar.',
                                    'desc_en' => 'Restaurant service basics, menu knowledge, and bar skills.',
                                    'badge_id' => '1 TAHUN',
                                    'badge_en' => '1 YEAR',
                                    'img' => 'https://images.pexels.com/photos/4485382/pexels-photo-4485382.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ]
                            ] as $course)
                            <div class="group bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full card-hover">
                                <div class="relative overflow-hidden h-44 sm:h-48 lg:h-52 shrink-0">
                                    <img src="{{ $course['img'] }}" alt="{{ $course['title_id'] }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                                    <span class="absolute top-3 right-3 bg-dhs-navy/90 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded tracking-wider shadow-sm">
                                        <span data-id="{{ $course['badge_id'] }}" data-en="{{ $course['badge_en'] }}">{{ $course['badge_id'] }}</span>
                                    </span>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="font-serif font-bold text-lg text-dhs-navy group-hover:text-primary transition-colors mb-2 leading-snug">
                                            <span data-id="{{ $course['title_id'] }}" data-en="{{ $course['title_en'] }}">{{ $course['title_id'] }}</span>
                                        </h3>
                                        <p class="text-xs text-muted-light leading-relaxed mb-4">
                                            <span data-id="{{ $course['desc_id'] }}" data-en="{{ $course['desc_en'] }}">{{ $course['desc_id'] }}</span>
                                        </p>
                                    </div>
                                    <div class="pt-3 border-t border-black/5 flex items-center justify-between text-xs text-primary font-semibold">
                                        <span data-id="Lihat Detail Program" data-en="View Program Details">Lihat Detail Program</span>
                                        <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Category: Program 1 Tahun Kapal Pesiar -->
            <div class="category-content-panel hidden" id="panel-1-tahun-kapal-pesiar">
                <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-10 items-start mb-16">
                    <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg lg:sticky lg:top-24 mb-8 lg:mb-0">
                        <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block" data-id="PROGRAM KAPAL PESIAR" data-en="CRUISE LINE PROGRAM">PROGRAM KAPAL PESIAR</span>
                        <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight">
                            <span data-id="1 Tahun Kapal Pesiar" data-en="1-Year Cruise Line">1 Tahun Kapal Pesiar</span>
                        </h2>
                        <p class="text-sm text-muted-light leading-relaxed mb-6">
                            <span data-id="Program akselerasi 1 tahun yang difokuskan untuk persiapan bekerja secara profesional di departemen food &amp; beverage dan housekeeping di kapal pesiar internasional dengan penempatan bebas agen fee." data-en="A 1-year acceleration program focused on professional preparation to work in the food &amp; beverage and housekeeping departments on international cruise ships with agent fee-free placement.">Program akselerasi 1 tahun yang difokuskan untuk persiapan bekerja secara profesional di departemen food &amp; beverage dan housekeeping di kapal pesiar internasional dengan penempatan bebas agen fee.</span>
                        </p>
                        <div class="pt-4 border-t border-black/10">
                            <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">
                                <span data-id="Peluang Kerja Lulusan:" data-en="Graduate Career Opportunities:">Peluang Kerja Lulusan:</span>
                            </p>
                            <p class="text-xs text-muted-light leading-relaxed">
                                <span data-id="Cruise Ship Cook, Waiter/Waitress, Cabin Steward, Galley Utility." data-en="Cruise Ship Cook, Waiter/Waitress, Cabin Steward, Galley Utility.">Cruise Ship Cook, Waiter/Waitress, Cabin Steward, Galley Utility.</span>
                            </p>
                        </div>
                    </div>

                    <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach([
                                [
                                    'title_id' => 'Cook (Asisten Koki)',
                                    'title_en' => 'Cook (Kitchen Assistant)',
                                    'desc_id' => 'Praktek dapur intensif untuk menyiapkan menu cruise line internasional.',
                                    'desc_en' => 'Intensive kitchen practice to prepare international cruise line menus.',
                                    'badge_id' => 'KAPAL PESIAR',
                                    'badge_en' => 'CRUISE LINE',
                                    'img' => 'https://images.pexels.com/photos/16140004/pexels-photo-16140004.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'Waiter & Bartender',
                                    'title_en' => 'Waiter & Bartender',
                                    'desc_id' => 'Layanan restoran mewah & pencampuran minuman tingkat lanjut untuk bar kapal pesiar.',
                                    'desc_en' => 'Luxury restaurant service & advanced mixology for cruise ship bars.',
                                    'badge_id' => 'KAPAL PESIAR',
                                    'badge_en' => 'CRUISE LINE',
                                    'img' => 'https://images.pexels.com/photos/19300593/pexels-photo-19300593.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'Hotel Steward',
                                    'title_en' => 'Hotel Steward',
                                    'desc_id' => 'Manajemen kebersihan, tata graha, dan penataan kamar di kabin kapal pesiar mewah.',
                                    'desc_en' => 'Cleanliness management, housekeeping, and cabin arrangement on luxury cruise ships.',
                                    'badge_id' => 'KAPAL PESIAR',
                                    'badge_en' => 'CRUISE LINE',
                                    'img' => 'https://images.pexels.com/photos/6466213/pexels-photo-6466213.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ]
                            ] as $course)
                            <div class="group bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full card-hover">
                                <div class="relative overflow-hidden h-44 sm:h-48 lg:h-52 shrink-0">
                                    <img src="{{ $course['img'] }}" alt="{{ $course['title_id'] }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                                    <span class="absolute top-3 right-3 bg-dhs-navy/90 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded tracking-wider shadow-sm">
                                        <span data-id="{{ $course['badge_id'] }}" data-en="{{ $course['badge_en'] }}">{{ $course['badge_id'] }}</span>
                                    </span>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="font-serif font-bold text-lg text-dhs-navy group-hover:text-primary transition-colors mb-2 leading-snug">
                                            <span data-id="{{ $course['title_id'] }}" data-en="{{ $course['title_en'] }}">{{ $course['title_id'] }}</span>
                                        </h3>
                                        <p class="text-xs text-muted-light leading-relaxed mb-4">
                                            <span data-id="{{ $course['desc_id'] }}" data-en="{{ $course['desc_en'] }}">{{ $course['desc_id'] }}</span>
                                        </p>
                                    </div>
                                    <div class="pt-3 border-t border-black/5 flex items-center justify-between text-xs text-primary font-semibold">
                                        <span data-id="Lihat Detail Program" data-en="View Program Details">Lihat Detail Program</span>
                                        <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Category: Short Course 6 Bulan -->
            <div class="category-content-panel hidden" id="panel-6-bulan">
                <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-10 items-start mb-16">
                    <div class="lg:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg lg:sticky lg:top-24 mb-8 lg:mb-0">
                        <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block" data-id="KURSUS SINGKAT" data-en="SHORT COURSE">KURSUS SINGKAT</span>
                        <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight">
                            <span data-id="Short Course 6 Bulan" data-en="6-Month Short Course">Short Course 6 Bulan</span>
                        </h2>
                        <p class="text-sm text-muted-light leading-relaxed mb-6">
                            <span data-id="Program singkat ini diperuntukan untuk peserta didik yang berniat menambah ilmu di bidang-bidang spesifik dengan mengutamakan praktek langsung daripada teori di laboratorium standar industri perhotelan kami." data-en="This short program is intended for students who want to add knowledge in specific fields, prioritizing hands-on practice over theory in our industry-standard hospitality laboratory.">Program singkat ini diperuntukan untuk peserta didik yang berniat menambah ilmu di bidang-bidang spesifik dengan mengutamakan praktek langsung daripada teori di laboratorium standar industri perhotelan kami.</span>
                        </p>
                        <div class="pt-4 border-t border-black/10">
                            <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">
                                <span data-id="Peluang Kerja Lulusan:" data-en="Graduate Career Opportunities:">Peluang Kerja Lulusan:</span>
                            </p>
                            <p class="text-xs text-muted-light leading-relaxed">
                                <span data-id="Entry-level Hotel Staff, Barista, Commis Chef, Restaurant Server." data-en="Entry-level Hotel Staff, Barista, Commis Chef, Restaurant Server.">Entry-level Hotel Staff, Barista, Commis Chef, Restaurant Server.</span>
                            </p>
                        </div>
                    </div>

                    <div class="lg:col-span-2 xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach([
                                [
                                    'title_id' => 'Perhotelan (FO & HK)',
                                    'title_en' => 'Hospitality (FO & HK)',
                                    'desc_id' => 'Pelatihan kilat siap kerja Front Office & Housekeeping.',
                                    'desc_en' => 'Fast-track work-ready training in Front Office & Housekeeping.',
                                    'badge_id' => '6 BULAN',
                                    'badge_en' => '6 MONTHS',
                                    'img' => 'https://images.pexels.com/photos/5371676/pexels-photo-5371676.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'Tata Boga (Culinary Art)',
                                    'title_en' => 'Culinary Art',
                                    'desc_id' => 'Praktek kuliner dasar terfokus untuk keterampilan masak praktis.',
                                    'desc_en' => 'Focused basic culinary practice for practical cooking skills.',
                                    'badge_id' => '6 BULAN',
                                    'badge_en' => '6 MONTHS',
                                    'img' => 'https://images.pexels.com/photos/15323383/pexels-photo-15323383.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'Tata Hidangan (FBS & Bartender)',
                                    'title_en' => 'Food & Beverage & Bartending',
                                    'desc_id' => 'Latihan barista, bartending dasar, dan pelayanan hidangan restoran.',
                                    'desc_en' => 'Barista training, basic bartending, and restaurant food service.',
                                    'badge_id' => '6 BULAN',
                                    'badge_en' => '6 MONTHS',
                                    'img' => 'https://images.pexels.com/photos/4485382/pexels-photo-4485382.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ]
                            ] as $course)
                            <div class="group bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full card-hover">
                                <div class="relative overflow-hidden h-44 sm:h-48 lg:h-52 shrink-0">
                                    <img src="{{ $course['img'] }}" alt="{{ $course['title_id'] }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                                    <span class="absolute top-3 right-3 bg-dhs-navy/90 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded tracking-wider shadow-sm">
                                        <span data-id="{{ $course['badge_id'] }}" data-en="{{ $course['badge_en'] }}">{{ $course['badge_id'] }}</span>
                                    </span>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="font-serif font-bold text-lg text-dhs-navy group-hover:text-primary transition-colors mb-2 leading-snug">
                                            <span data-id="{{ $course['title_id'] }}" data-en="{{ $course['title_en'] }}">{{ $course['title_id'] }}</span>
                                        </h3>
                                        <p class="text-xs text-muted-light leading-relaxed mb-4">
                                            <span data-id="{{ $course['desc_id'] }}" data-en="{{ $course['desc_en'] }}">{{ $course['desc_id'] }}</span>
                                        </p>
                                    </div>
                                    <div class="pt-3 border-t border-black/5 flex items-center justify-between text-xs text-primary font-semibold">
                                        <span data-id="Lihat Detail Program" data-en="View Program Details">Lihat Detail Program</span>
                                        <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Category: Program Eksekutif -->
            <div class="category-content-panel hidden" id="panel-eksekutif">
                <div class="grid grid-cols-1 xl:grid-cols-4 gap-10 items-start mb-16">
                    <div class="xl:col-span-1 bg-white p-8 border border-black/5 shadow-sm rounded-lg xl:sticky xl:top-24 mb-8 xl:mb-0">
                        <span class="text-xs font-bold uppercase tracking-widest text-primary mb-3 block" data-id="PROGRAM EKSEKUTIF" data-en="EXECUTIVE PROGRAM">PROGRAM EKSEKUTIF</span>
                        <h2 class="text-3xl font-serif font-bold text-dhs-navy mb-4 leading-tight">
                            <span data-id="Program Eksekutif" data-en="Executive Program">Program Eksekutif</span>
                        </h2>
                        <p class="text-sm text-muted-light leading-relaxed mb-6">
                            <span data-id="Program khusus 6 bulan kapal pesiar dengan berbagai fasilitas bonus menarik. Cocok untuk akselerasi karir maritim instan tanpa agent fee penempatan." data-en="Special 6-month cruise ship program with various attractive bonus facilities. Ideal for instant maritime career acceleration without placement agent fees.">Program khusus 6 bulan kapal pesiar dengan berbagai fasilitas bonus menarik. Cocok untuk akselerasi karir maritim instan tanpa agent fee penempatan.</span>
                        </p>
                        <div class="pt-4 border-t border-black/10">
                            <p class="text-xs font-bold text-dhs-navy uppercase tracking-wider mb-2">
                                <span data-id="Peluang Kerja Lulusan:" data-en="Graduate Career Opportunities:">Peluang Kerja Lulusan:</span>
                            </p>
                            <p class="text-xs text-muted-light leading-relaxed">
                                <span data-id="Cruise Line Cook, Cruise Line Bartender, Butler, Spa Therapist." data-en="Cruise Line Cook, Cruise Line Bartender, Butler, Spa Therapist.">Cruise Line Cook, Cruise Line Bartender, Butler, Spa Therapist.</span>
                            </p>
                        </div>
                    </div>

                    <div class="xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach([
                                [
                                    'title_id' => 'FBS & Bar (Cruise Line)',
                                    'title_en' => 'FBS & Bar (Cruise Line)',
                                    'desc_id' => 'Bonus: Free Bottle Shaker Flair untuk praktek atraksi bar.',
                                    'desc_en' => 'Bonus: Free Bottle Shaker Flair for bar attraction practice.',
                                    'badge_id' => 'EKSEKUTIF',
                                    'badge_en' => 'EXECUTIVE',
                                    'img' => 'https://images.pexels.com/photos/19674104/pexels-photo-19674104.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'Hotel Steward (Cruise Line)',
                                    'title_en' => 'Hotel Steward (Cruise Line)',
                                    'desc_id' => 'Fokus manajemen housekeeping intensif di atas kapal pesiar.',
                                    'desc_en' => 'Focused intensive housekeeping management on cruise ships.',
                                    'badge_id' => 'EKSEKUTIF',
                                    'badge_en' => 'EXECUTIVE',
                                    'img' => 'https://images.pexels.com/photos/6466213/pexels-photo-6466213.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'Cook (Cruise Line)',
                                    'title_en' => 'Cook (Cruise Line)',
                                    'desc_id' => 'Bonus: Free Passport & Seaman Book (Buku Pelaut) resmi.',
                                    'desc_en' => 'Bonus: Free official Passport & Seaman Book.',
                                    'badge_id' => 'EKSEKUTIF',
                                    'badge_en' => 'EXECUTIVE',
                                    'img' => 'https://images.pexels.com/photos/32176062/pexels-photo-32176062.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'Flair Bartending & Sommelier',
                                    'title_en' => 'Flair Bartending & Sommelier',
                                    'desc_id' => 'Pendidikan bartender atraksi & spesialis wawasan minuman anggur.',
                                    'desc_en' => 'Flair bartender education & wine knowledge specialist.',
                                    'badge_id' => 'EKSEKUTIF',
                                    'badge_en' => 'EXECUTIVE',
                                    'img' => 'https://images.pexels.com/photos/87224/pexels-photo-87224.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'Butler',
                                    'title_en' => 'Butler',
                                    'desc_id' => 'Pelayanan eksklusif personal. Bonus: Free Driving Licence (SIM).',
                                    'desc_en' => 'Exclusive personal service. Bonus: Free Driving Licence.',
                                    'badge_id' => 'EKSEKUTIF',
                                    'badge_en' => 'EXECUTIVE',
                                    'img' => 'https://images.pexels.com/photos/5371583/pexels-photo-5371583.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ],
                                [
                                    'title_id' => 'SPA Therapist',
                                    'title_en' => 'SPA Therapist',
                                    'desc_id' => 'Seni pijat relaksasi dan terapi spa berkualitas hotel bintang lima.',
                                    'desc_en' => 'Relaxation massage art and spa therapy to five-star hotel quality.',
                                    'badge_id' => 'EKSEKUTIF',
                                    'badge_en' => 'EXECUTIVE',
                                    'img' => 'https://images.pexels.com/photos/9146364/pexels-photo-9146364.jpeg?auto=compress&cs=tinysrgb&w=800'
                                ]
                            ] as $course)
                            <div class="group bg-white border border-black/10 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full card-hover">
                                <div class="relative overflow-hidden h-44 sm:h-48 lg:h-52 shrink-0">
                                    <img src="{{ $course['img'] }}" alt="{{ $course['title_id'] }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                                    <span class="absolute top-3 right-3 bg-dhs-navy/90 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded tracking-wider shadow-sm">
                                        <span data-id="{{ $course['badge_id'] }}" data-en="{{ $course['badge_en'] }}">{{ $course['badge_id'] }}</span>
                                    </span>
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="font-serif font-bold text-lg text-dhs-navy group-hover:text-primary transition-colors mb-2 leading-snug">
                                            <span data-id="{{ $course['title_id'] }}" data-en="{{ $course['title_en'] }}">{{ $course['title_id'] }}</span>
                                        </h3>
                                        <p class="text-xs text-muted-light leading-relaxed mb-4">
                                            <span data-id="{{ $course['desc_id'] }}" data-en="{{ $course['desc_en'] }}">{{ $course['desc_id'] }}</span>
                                        </p>
                                    </div>
                                    <div class="pt-3 border-t border-black/5 flex items-center justify-between text-xs text-primary font-semibold">
                                        <span data-id="Lihat Detail Program" data-en="View Program Details">Lihat Detail Program</span>
                                        <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </section>

        <!-- Beasiswa Section -->
        <section class="max-w-[1280px] mx-auto px-5 md:px-16 mb-20" data-reveal="fade-up">
            <div class="text-center mb-12">
                <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary mb-4 block" data-id="JALUR BEASISWA" data-en="SCHOLARSHIP PATHWAYS">JALUR BEASISWA</span>
                <h3 class="text-3xl md:text-4xl font-serif text-text-light mb-4" data-id="Program Beasiswa DHS" data-en="DHS Scholarship Program">Program Beasiswa DHS</h3>
                <p class="text-sm text-muted-light max-w-2xl mx-auto" data-id="Denpasar Hotel School menyediakan keringanan biaya pendidikan melalui berbagai skema beasiswa bagi calon profesional berprestasi." data-en="Denpasar Hotel School provides educational fee relief through various scholarship schemes for high-achieving prospective professionals.">Denpasar Hotel School menyediakan keringanan biaya pendidikan melalui berbagai skema beasiswa bagi calon profesional berprestasi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <!-- Beasiswa Prestasi -->
                <div class="bg-white border border-black/5 p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div class="w-12 h-12 bg-primary/10 flex items-center justify-center mb-6">
                        <span class="material-icons text-primary text-2xl">emoji_events</span>
                    </div>
                    <h4 class="font-bold font-serif text-xl text-text-light mb-3" data-id="Beasiswa Prestasi" data-en="Achievement Scholarship">Beasiswa Prestasi</h4>
                    <p class="text-xs text-muted-light leading-relaxed mb-5" data-id="Bagi calon peserta didik dengan prestasi akademik dan non-akademik yang unggul. Keringanan biaya pendidikan hingga 50%." data-en="For prospective students with outstanding academic and non-academic achievements. Up to 50% educational fee relief.">Bagi calon peserta didik dengan prestasi akademik dan non-akademik yang unggul. Keringanan biaya pendidikan hingga 50%.</p>
                    <ul class="text-xs text-muted-light space-y-2.5">
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span><span data-id="Nilai rata-rata rapor/ijazah ≥ 80" data-en="Average report/diploma grade ≥ 80">Nilai rata-rata rapor/ijazah ≥ 80</span></li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span><span data-id="Piagam atau sertifikat prestasi" data-en="Achievement charter or certificate">Piagam atau sertifikat prestasi</span></li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span><span data-id="Lulus seleksi wawancara" data-en="Pass interview selection">Lulus seleksi wawancara</span></li>
                    </ul>
                </div>

                <!-- Beasiswa STT / Desa (Featured) -->
                <div class="bg-dhs-navy p-8 shadow-sm text-white">
                    <div class="w-12 h-12 bg-white/10 flex items-center justify-center mb-6">
                        <span class="material-icons text-white text-2xl">groups</span>
                    </div>
                    <h4 class="font-bold font-serif text-xl text-white mb-3" data-id="Beasiswa STT / Desa" data-en="STT / Village Scholarship">Beasiswa STT / Desa</h4>
                    <p class="text-xs text-white/75 leading-relaxed mb-5" data-id="Khusus bagi anggota Sekaa Teruna Teruni (STT) dan utusan desa adat yang ingin meningkatkan kompetensi di bidang perhotelan." data-en="Exclusively for Sekaa Teruna Teruni (STT) members and customary village representatives seeking to improve hospitality competency.">Khusus bagi anggota Sekaa Teruna Teruni (STT) dan utusan desa adat yang ingin meningkatkan kompetensi di bidang perhotelan.</p>
                    <ul class="text-xs text-white/75 space-y-2.5">
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span><span data-id="Surat rekomendasi Bendesa Adat" data-en="Recommendation letter from Bendesa Adat">Surat rekomendasi Bendesa Adat</span></li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span><span data-id="Aktif sebagai anggota STT" data-en="Active STT member">Aktif sebagai anggota STT</span></li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span><span data-id="Warga Bali berdomisili di Bali" data-en="Balinese resident in Bali">Warga Bali berdomisili di Bali</span></li>
                    </ul>
                </div>

                <!-- Beasiswa Khusus -->
                <div class="bg-white border border-black/5 p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div class="w-12 h-12 bg-primary/10 flex items-center justify-center mb-6">
                        <span class="material-icons text-primary text-2xl">workspace_premium</span>
                    </div>
                    <h4 class="font-bold font-serif text-xl text-text-light mb-3" data-id="Beasiswa Khusus" data-en="Special Scholarship">Beasiswa Khusus</h4>
                    <p class="text-xs text-muted-light leading-relaxed mb-5" data-id="Bagi calon peserta didik dari keluarga kurang mampu dengan komitmen tinggi untuk berkarir di industri perhotelan dan pariwisata." data-en="For prospective students from economically disadvantaged families with a high commitment to a career in hospitality and tourism.">Bagi calon peserta didik dari keluarga kurang mampu dengan komitmen tinggi untuk berkarir di industri perhotelan dan pariwisata.</p>
                    <ul class="text-xs text-muted-light space-y-2.5">
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span><span data-id="Surat keterangan tidak mampu" data-en="Certificate of financial hardship">Surat keterangan tidak mampu</span></li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span><span data-id="Esai motivasi dan wawancara" data-en="Motivation essay and interview">Esai motivasi dan wawancara</span></li>
                        <li class="flex items-start gap-2"><span class="material-icons text-primary text-sm mt-0.5">check_circle</span><span data-id="Seleksi oleh Tim DHS" data-en="Selected by DHS Team">Seleksi oleh Tim DHS</span></li>
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
                @foreach([
                        ['title' => 'Passport', 'icon' => 'card_travel'],
                        ['title' => 'BST', 'icon' => 'anchor'],
                        ['title' => 'SDSD', 'icon' => 'security'],
                        ['title' => 'CCM', 'icon' => 'groups'],
                        ['title' => 'SSAT', 'icon' => 'verified_user'],
                        ['title' => 'PSCRB', 'icon' => 'sailing'],
                        ['title' => 'C1D VISA', 'icon' => 'badge']
                    ] as $doc)
                    <div class="bg-dhs-cream p-6 border border-black/5 hover:bg-white transition-colors duration-300">
                        <span class="material-icons text-primary text-3xl mb-3 block">{{$doc['icon']}}</span>
                        <h5 class="font-bold text-sm text-text-light">{{ $doc['title'] }}</h5>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- CTA Section -->
        <section class="max-w-3xl mx-auto px-5 text-center mb-24">
            <h2 class="text-[48px] leading-[1.2] font-semibold font-serif mb-6 text-text-light" data-id="Mulai Karir Sukses Anda" data-en="Start Your Successful Career">Mulai Karir Sukses Anda</h2>
            <p class="text-base text-muted-light mb-10" data-id="Denpasar Hotel School siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global. Gabung sekarang juga secara online." data-en="Denpasar Hotel School is ready to guide you to become a competent young professional with global competitiveness. Join us now online.">Denpasar Hotel School siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global. Gabung sekarang juga secara online.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a class="px-8 py-4 bg-dhs-navy text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-darknavy transition-colors" href="/formulir-pendaftaran" target="_blank"><span data-id="Pendaftaran Online" data-en="Online Registration">Pendaftaran Online</span></a>
                <a class="px-8 py-4 bg-transparent border border-dhs-navy text-dhs-navy text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-cream transition-colors" href="https://linktr.ee/BiayaPendidikan_DHS" target="_blank"><span data-id="Brosur Biaya" data-en="Download Cost Brochure">Unduh Brosur Biaya</span></a>
            </div>
        </section>
    </main>

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
@endsection