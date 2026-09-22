@extends('layouts.app')

@section('title', $program->title . ' — Denpasar Hotel School')

@section('content')

    <!-- Hero Section -->
    <section class="relative min-h-[680px] md:min-h-[720px] flex flex-col justify-start items-center overflow-hidden bg-slate-950 text-white" style="padding-top: 165px; padding-bottom: 90px;">
        <!-- Ambient Background Overlay & Images -->
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/90 via-slate-950/95 to-[#081225] z-10"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(197,48,48,0.25),transparent_55%)] z-10"></div>
        <img alt="{{ $cms['title'] ?? $program->title }}" width="1920" height="1080" class="absolute inset-0 w-full h-full object-cover opacity-25 filter blur-[1px]" src="{{ $cms['hero_image'] ?? ($program->thumbnail_url ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600') }}">

        <div class="relative z-20 px-6 max-w-5xl mx-auto text-center" data-reveal="fade-up">
            <!-- Breadcrumbs -->
            <div class="mb-8 inline-flex items-center space-x-2.5 justify-center text-white text-xs sm:text-sm font-semibold uppercase tracking-wider px-6 py-2.5 rounded-full border border-white/25 shadow-2xl backdrop-blur-md"
                 style="background: rgba(5, 10, 25, 0.88); text-shadow: 0 2px 6px rgba(0,0,0,1), 0 1px 2px rgba(0,0,0,0.9);">
                <a class="hover:text-amber-300 transition-colors flex items-center gap-1.5" href="/"
                   style="text-shadow: 0 2px 6px rgba(0,0,0,1);">
                    <span class="material-icons text-base">home</span> Beranda
                </a>
                <span class="material-icons text-xs" style="opacity:0.5;">chevron_right</span>
                <a class="hover:text-amber-300 transition-colors" href="/akademi"
                   style="text-shadow: 0 2px 6px rgba(0,0,0,1);">Akademi</a>
                <span class="material-icons text-xs" style="opacity:0.5;">chevron_right</span>
                <a class="hover:text-amber-300 transition-colors" href="/program"
                   style="text-shadow: 0 2px 6px rgba(0,0,0,1);">Program</a>
                <span class="material-icons text-xs" style="opacity:0.5;">chevron_right</span>
                <span class="text-amber-400 font-bold truncate max-w-[180px] sm:max-w-none"
                      style="text-shadow: 0 2px 8px rgba(0,0,0,1);">{{ $cms['title'] ?? $program->title }}</span>
            </div>

            <!-- Category & Country Badges -->
            <div class="mb-5 flex items-center justify-center gap-3 flex-wrap">
                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-white text-xs sm:text-sm uppercase tracking-wider font-bold shadow-md" style="background: #0f172a; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 4px 12px rgba(0,0,0,0.4);">
                    <span class="material-icons text-sm text-amber-400">school</span>
                    {{ $cms['category'] ?? ($program->category ? $program->category->category_name : 'Program Vokasi') }}
                </span>
                @if(!empty($cms['country_badge']) || $program->country_badge)
                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-white text-xs sm:text-sm uppercase tracking-wider font-bold shadow-md" style="background: #1e293b; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 4px 12px rgba(0,0,0,0.4);">
                    <span class="material-icons text-sm text-amber-400">public</span>
                    {{ $cms['country_badge'] ?? $program->country_badge }}
                </span>
                @endif
            </div>

            <!-- Main Heading -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-6 leading-tight tracking-tight max-w-4xl mx-auto" style="text-shadow: 0 4px 16px rgba(0, 0, 0, 0.9);">
                {{ $cms['title'] ?? $program->title }}
            </h1>

            <!-- Quick Specs Unified Bar -->
            <div class="mt-6 inline-flex flex-wrap items-center justify-center rounded-full text-xs sm:text-sm text-slate-100" style="padding: 10px 24px; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.4);">
                <div class="flex items-center gap-2" style="margin: 4px 16px; text-shadow: 0 1px 2px rgba(0,0,0,0.8);">
                    <span class="material-icons text-amber-400 text-base sm:text-lg" style="filter: drop-shadow(0 1px 2px rgba(0,0,0,0.5));">schedule</span>
                    <span>Durasi Studi: <strong class="text-white font-semibold">{{ $cms['duration'] ?? ($program->duration ?: '1 Tahun') }}</strong></span>
                </div>
                <span class="text-white/30 font-light select-none" style="margin: 0 4px;">|</span>
                <div class="flex items-center gap-2" style="margin: 4px 16px; text-shadow: 0 1px 2px rgba(0,0,0,0.8);">
                    <span class="material-icons text-amber-400 text-base sm:text-lg" style="filter: drop-shadow(0 1px 2px rgba(0,0,0,0.5));">verified</span>
                    <span>Sertifikasi: <strong class="text-white font-semibold">{{ $cms['sertifikasi'] ?? 'Resmi DHS & Industri' }}</strong></span>
                </div>
                <span class="text-white/30 font-light select-none" style="margin: 0 4px;">|</span>
                <div class="flex items-center gap-2" style="margin: 4px 16px; text-shadow: 0 1px 2px rgba(0,0,0,0.8);">
                    <span class="material-icons text-amber-400 text-base sm:text-lg" style="filter: drop-shadow(0 1px 2px rgba(0,0,0,0.5));">workspace_premium</span>
                    <span>Status: <strong class="text-white font-semibold">{{ $cms['status_akreditasi'] ?? 'Terakreditasi' }}</strong></span>
                </div>
            </div>

            <!-- Header Action Button -->
            <div class="mt-10">
                <a href="/formulir-pendaftaran?program={{ $program->slug }}" class="inline-flex items-center gap-4 px-9 py-4 bg-gradient-to-r from-primary to-red-700 hover:from-red-700 hover:to-primary text-white font-bold text-sm uppercase tracking-wider rounded-2xl shadow-xl hover:scale-105 transition-all">
                    <span>{{ $cms['cta_text'] ?? 'Daftar Program Ini Online' }}</span>
                    <span class="material-icons text-base" style="margin-left: 6px;">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content & Sidebar Layout -->
    <section class="py-16 px-5 md:px-8 bg-slate-50">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Left Main Content Area (8 Cols) -->
                <div class="lg:col-span-8 space-y-10">

                    <!-- Card 1: Deskripsi & Profil Program -->
                    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-red-50 text-primary flex items-center justify-center flex-shrink-0">
                                <span class="material-icons text-2xl">menu_book</span>
                            </div>
                            <div>
                                <h2 class="font-serif font-bold text-2xl text-slate-900">{{ $cms['desc_title'] ?? 'Deskripsi & Profil Program' }}</h2>
                                <p class="text-slate-500 text-sm mt-0.5">{{ $cms['desc_subtitle'] ?? 'Gambaran umum kurikulum dan fokus pembelajaran.' }}</p>
                            </div>
                        </div>

                        <div class="text-slate-700 text-base leading-relaxed space-y-4">
                            <p>{{ $cms['description'] ?? ($program->description ?: 'Program pendidikan vokasi siap kerja yang memadukan teori industri pariwisata terkini dengan praktik intensif (70% Praktik & 30% Teori). Peserta didik dibimbing langsung oleh instruktur berpengalaman dari hotel berbintang dan kapal pesiar.') }}</p>
                            @if(!empty($cms['desc_p2']))
                            <p>{{ $cms['desc_p2'] }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Card 2: Aktivitas & Kegiatan Pembelajaran (Programnya Ngapain Aja) -->
                    @php
                        $activities = $cms['activities'] ?? [
                            ['icon' => 'science', 'color' => '#4f46e5', 'title' => '70% Praktik Laboratorium', 'desc' => 'Simulasi kerja di Kitchen Lab, Bar & Restaurant, Mockup Hotel Room, dan Front Office Counter.'],
                            ['icon' => 'flight_takeoff', 'color' => '#d97706', 'title' => 'On the Job Training (OJT)', 'desc' => 'Praktik kerja lapangan selama 6 bulan di hotel bintang 4 & 5 Bali, Jakarta, atau kapal pesiar internasional.'],
                            ['icon' => 'translate', 'color' => '#059669', 'title' => 'English for Hospitality', 'desc' => 'Pembekalan intensif percakapan Bahasa Inggris maritim dan perhotelan untuk persiapan wawancara kerja.'],
                            ['icon' => 'record_voice_over', 'color' => '#c53030', 'title' => 'Mockup Interview & Mentoring', 'desc' => 'Bimbingan khusus pembuatan CV internasional dan simulasi wawancara bersama praktisi senior.']
                        ];
                    @endphp
                    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-100">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons text-2xl">sports_score</span>
                            </div>
                            <div>
                                <h2 class="font-serif font-bold text-2xl text-slate-900">{{ $cms['activities_title'] ?? 'Aktivitas & Kegiatan Pembelajaran' }}</h2>
                                <p class="text-slate-500 text-sm mt-0.5">{{ $cms['activities_subtitle'] ?? 'Rincian kegiatan praktik dan pelatihan selama masa studi.' }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach($activities as $act)
                            <div class="p-6 bg-slate-50 rounded-2xl flex items-start gap-4">
                                <div class="flex-shrink-0" style="width:44px;height:44px;border-radius:12px;background:{{ $act['color'] ?? '#4f46e5' }};display:flex;align-items:center;justify-content:center;">
                                    <span class="material-icons" style="color:#fff;font-size:22px;">{{ $act['icon'] ?? 'science' }}</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 text-base mb-1.5">{{ $act['title'] ?? '' }}</h3>
                                    <p class="text-slate-700 text-sm leading-relaxed">{{ $act['desc'] ?? '' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Card 3: Benefit & Keuntungan Utama Yang Didapat -->
                    @php
                        $benefits = $cms['benefits'] ?? [
                            ['title' => 'Sertifikat Resmi Terakreditasi & Garuda Dephub', 'desc' => 'Memperoleh Ijazah Vokasi DHS dan Sertifikat Kompetensi resmi yang diakui secara nasional maupun industri maritim & perhotelan global.'],
                            ['title' => 'Penyaluran Kerja & Kerjasama 50+ Hotel Bintang 5', 'desc' => 'Jaminan pendampingan karir sampai bekerja melalui jaringan kemitraan DHS di Bali, nasional, dan internasional.'],
                            ['title' => 'Fasilitas Lab Lengkap Tanpa Biaya Tersembunyi', 'desc' => 'Seluruh bahan masakan, peralatan bar, dan sarana laboratorium disiapkan kampus tanpa ada pungutan biaya tambahan selama praktik.'],
                            ['title' => 'Bimbingan Praktisi Aktif Perhotelan & Kapal Pesiar', 'desc' => 'Diajar langsung oleh Ex-Executive Chef, Head Bartender, dan General Manager yang masih aktif berkarir di industri hospitality.'],
                            ['title' => 'Akses Beasiswa Keringanan Biaya s/d 50%', 'desc' => 'Berhak mengklaim Beasiswa Prestasi, Beasiswa STT/Desa, atau Beasiswa Khusus DHS bagi peserta didik berprestasi dan kurang mampu.']
                        ];
                    @endphp
                    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-100">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons text-2xl">card_giftcard</span>
                            </div>
                            <div>
                                <h2 class="font-serif font-bold text-2xl text-slate-900">{{ $cms['benefits_title'] ?? 'Manfaat & Benefit yang Didapatkan' }}</h2>
                                <p class="text-slate-500 text-sm mt-0.5">{{ $cms['benefits_subtitle'] ?? 'Keunggulan dan fasilitas eksklusif bagi setiap peserta program.' }}</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            @foreach($benefits as $ben)
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="material-icons text-lg font-bold">check</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 text-base mb-1">{{ $ben['title'] ?? '' }}</h3>
                                    <p class="text-slate-600 text-sm leading-relaxed">{{ $ben['desc'] ?? '' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Card 4: Materi & Kurikulum Pelatihan -->
                    @php
                        $curriculumContent = $cms['curriculum'] ?? $program->curriculum;
                    @endphp
                    @if($curriculumContent)
                    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons text-2xl">auto_stories</span>
                            </div>
                            <div>
                                <h2 class="font-serif font-bold text-2xl text-slate-900">{{ $cms['curriculum_title'] ?? 'Materi & Kurikulum Pelatihan' }}</h2>
                                <p class="text-slate-500 text-sm mt-0.5">{{ $cms['curriculum_subtitle'] ?? 'Modul keahlian yang dipelajari selama masa studi.' }}</p>
                            </div>
                        </div>

                        <div class="text-slate-700 text-base leading-relaxed whitespace-pre-line bg-slate-50 p-6 rounded-2xl">
                            {{ is_array($curriculumContent) ? implode("\n", $curriculumContent) : $curriculumContent }}
                        </div>
                    </div>
                    @endif

                    <!-- Card 5: Persyaratan Pendaftaran -->
                    @php
                        $reqs = $cms['requirements'] ?? ($program->requirements ? explode("\n", $program->requirements) : [
                            'Pria / Wanita, usia minimal 17 tahun.',
                            'Lulusan SMA / SMK / MA / Paket C sederajat.',
                            'Sehat jasmani dan rohani serta bebas narkoba.',
                            'Memiliki motivasi tinggi untuk berkarir di industri pariwisata & kapal pesiar.',
                            'Menyerahkan fotokopi KTP, KK, Akta Kelahiran, Ijazah & Pas Foto terbaru.'
                        ]);
                        if (is_string($reqs)) {
                            $reqs = array_filter(array_map('trim', explode("\n", $reqs)));
                        }
                    @endphp
                    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons text-2xl">checklist</span>
                            </div>
                            <div>
                                <h2 class="font-serif font-bold text-2xl text-slate-900">{{ $cms['requirements_title'] ?? 'Persyaratan Pendaftaran' }}</h2>
                                <p class="text-slate-500 text-sm mt-0.5">{{ $cms['requirements_subtitle'] ?? 'Kelengkapan administrasi dan kriteria calon peserta.' }}</p>
                            </div>
                        </div>

                        <div class="space-y-4 text-base text-slate-700">
                            @foreach($reqs as $req)
                            <div class="flex items-center gap-3">
                                <span class="material-icons text-emerald-600 text-xl flex-shrink-0">check_circle</span>
                                <span>{{ $req }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Card 6: Fasilitas & Sarana Pendukung (jika tersedia) -->
                    @php
                        $facilitiesContent = $cms['facilities'] ?? $program->facilities;
                    @endphp
                    @if($facilitiesContent)
                    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-100">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons text-2xl">star</span>
                            </div>
                            <div>
                                <h2 class="font-serif font-bold text-2xl text-slate-900">{{ $cms['facilities_title'] ?? 'Fasilitas & Sarana Pendukung' }}</h2>
                                <p class="text-slate-500 text-sm mt-0.5">{{ $cms['facilities_subtitle'] ?? 'Sarana laboratorium dan fasilitas praktik yang disediakan.' }}</p>
                            </div>
                        </div>

                        <div class="text-slate-700 text-base leading-relaxed whitespace-pre-line bg-slate-50 p-6 rounded-2xl">
                            {{ is_array($facilitiesContent) ? implode("\n", $facilitiesContent) : $facilitiesContent }}
                        </div>
                    </div>
                    @endif

                </div>

                <!-- Right Sticky Sidebar (4 Cols) -->
                <div class="lg:col-span-4 space-y-8 lg:sticky lg:top-28">
                    
                    <!-- Registration Card -->
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200">
                        <div class="text-center pb-6 border-b border-slate-100 mb-6">
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-3" style="background:#fef2f2;color:#c53030;">
                                {{ $cms['sidebar_gelombang'] ?? 'Pendaftaran Gelombang Baru' }}
                            </span>
                            <h3 class="font-serif font-bold text-2xl text-slate-900 mb-1">Daftar Program Ini</h3>
                            <p class="text-sm text-slate-500">{{ $cms['sidebar_kuota'] ?? 'Kuota terbatas untuk setiap gelombang pelatihan.' }}</p>
                        </div>

                        <!-- Specs List -->
                        <div class="space-y-3 mb-8 text-sm">
                            <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-2xl">
                                <span class="text-slate-500 font-medium">Durasi Studi:</span>
                                <span class="font-bold text-slate-900">{{ $cms['duration'] ?? ($program->duration ?: '1 Tahun') }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-2xl">
                                <span class="text-slate-500 font-medium">Kategori Vokasi:</span>
                                <span class="font-bold text-slate-900">{{ $cms['category'] ?? ($program->category ? $program->category->category_name : 'Vokasi') }}</span>
                            </div>
                            @if(!empty($cms['tuition_fee']) || $program->tuition_fee)
                            <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-2xl">
                                <span class="text-slate-500 font-medium">Biaya Pendidikan:</span>
                                <span class="font-bold text-slate-900">{{ $cms['tuition_fee'] ?? $program->tuition_fee }}</span>
                            </div>
                            @endif
                            <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-2xl">
                                <span class="text-slate-500 font-medium">Jalur Beasiswa:</span>
                                <span class="font-bold" style="color:#059669;">Tersedia Beasiswa DHS</span>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <a href="/formulir-pendaftaran?program={{ $program->slug }}" class="w-full py-4 font-bold text-sm uppercase tracking-wider rounded-2xl shadow-md transition-all flex items-center justify-center gap-3 text-white mb-3" style="background:linear-gradient(to right,#c53030,#9b1c1c);">
                            <span>Daftar Online Sekarang</span>
                            <span class="material-icons text-base" style="margin-left: 6px;">arrow_forward</span>
                        </a>

                        @if(!empty($cms['brochure_url']) || $program->brochure_url)
                        <a href="{{ $cms['brochure_url'] ?? $program->brochure_url }}" target="_blank" class="w-full py-3 font-semibold text-xs uppercase tracking-wider rounded-2xl border border-slate-200 hover:bg-slate-50 text-slate-700 transition-all flex items-center justify-center gap-2">
                            <span class="material-icons text-sm text-red-600">picture_as_pdf</span>
                            <span>Unduh Brosur Program</span>
                        </a>
                        @endif
                    </div>

                    <!-- Helpdesk Box - forced dark navy -->
                    <div class="bg-slate-900 rounded-3xl p-8 border border-slate-800" style="background-color:#0f172a !important;">
                        <div class="flex items-center gap-4 mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-amber-500 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons" style="color:#fff;font-size:26px;">support_agent</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg" style="color:#f8fafc;">{{ $cms['sidebar_helpdesk_title'] ?? 'Butuh Info Lebih Lanjut?' }}</h3>
                                <p class="text-sm" style="color:#fcd34d;">{{ $cms['sidebar_helpdesk_sub'] ?? 'Tim Admisi DHS Siap Membantu' }}</p>
                            </div>
                        </div>

                        <p class="text-sm leading-relaxed mb-6" style="color:#cbd5e1;">
                            {{ $cms['sidebar_helpdesk_desc'] ?? 'Konsultasikan jadwal kelas, rincian biaya pendidikan, dan opsi beasiswa melalui sekretariat DHS.' }}
                        </p>

                        <div class="space-y-4 text-sm">
                            <div class="flex items-center gap-3">
                                <span style="font-size:18px;">📞</span>
                                <div>
                                    <div class="text-xs" style="color:#94a3b8;">Telepon Kampus</div>
                                    <div class="font-bold" style="color:#f8fafc;">{{ $cms['sidebar_phone'] ?? '(0361) 222-123' }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span style="font-size:18px;">📱</span>
                                <div>
                                    <div class="text-xs" style="color:#94a3b8;">Sekretariat Admisi</div>
                                    <div class="font-bold" style="color:#fcd34d;">{{ $cms['sidebar_wa'] ?? '+62 81 246 319966' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- Related Programs Grid -->
    @if($relatedPrograms->isNotEmpty())
    <section class="py-16 px-5 md:px-8 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-red-50 text-primary text-xs uppercase tracking-wider font-bold mb-3">
                    <span class="material-icons text-sm">auto_awesome</span> Program Terkait Lainnya
                </span>
                <h2 class="text-3xl font-serif font-bold text-slate-900">Pilihan Program Unggulan DHS</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedPrograms as $rel)
                <div class="bg-slate-50 rounded-3xl border border-slate-100 overflow-hidden flex flex-col justify-between hover:shadow-lg transition-all duration-300">
                    <div class="relative h-48 overflow-hidden bg-slate-900">
                        <img src="{{ $rel->thumbnail_url ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800' }}" alt="{{ $rel->title }}" class="w-full h-full object-cover">
                        <div class="absolute top-3 left-3">
                            <span class="px-3.5 py-1 rounded-full bg-slate-900/80 text-white text-xs font-bold uppercase backdrop-blur-md">
                                {{ $rel->category ? $rel->category->category_name : 'Pelatihan' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif font-bold text-lg text-slate-900 mb-2 line-clamp-2">{{ $rel->title }}</h3>
                            <p class="text-slate-600 text-sm line-clamp-2 mb-4">{{ $rel->description }}</p>
                        </div>
                        <a href="/program/{{ $rel->slug }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary hover:underline">
                            <span>Lihat Detail Program</span>
                            <span class="material-icons text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection
