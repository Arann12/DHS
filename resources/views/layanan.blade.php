@extends('layouts.app')

@section('title', 'Formulir Pengajuan Layanan & Beasiswa — Denpasar Hotel School')

@section('content')

@php
$programs = [];
if (isset($categories) && $categories->count() > 0) {
    foreach ($categories as $cat) {
        $programs[$cat->category_key] = [
            'label'   => $cat->category_name,
            'options' => $cat->programs->where('is_active', 1)->pluck('title')->toArray(),
        ];
    }
} else {
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
@endphp

<!-- Hero Section (Exact Match to registration.blade.php) -->
<section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden">
    <div class="absolute inset-0 bg-black/55 z-10"></div>
    <img alt="DHS Layanan Hero" class="absolute inset-0 w-full h-full object-cover"
        src="{{ !empty($formSettings['hero_image']) ? $formSettings['hero_image'] : '/image/hero_registration.jpg' }}">

    <div class="relative z-20 px-6 max-w-5xl mx-auto pt-36 sm:pt-40 text-white" data-reveal="fade-up">
        <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/90 text-xs font-semibold uppercase tracking-wider" style="text-shadow: 0 1px 3px rgba(0,0,0,0.8);">
            <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
            <span class="material-icons text-sm text-white/60">chevron_right</span>
            <span class="text-white font-bold"><span data-id="Formulir Layanan" data-en="Service Form">Formulir Layanan</span></span>
        </div>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-[1.1]" style="text-shadow: 0 3px 12px rgba(0,0,0,0.85);">
            <span>{{ $formSettings['header_title'] ?? 'Formulir Pengajuan Beasiswa & Dokumen' }}</span>
        </h1>
        <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/90 font-medium max-w-2xl mx-auto" style="text-shadow: 0 2px 6px rgba(0,0,0,0.85);">
            <span>{{ $formSettings['header_subtitle'] ?? 'Pilih Jenis Pengajuan & Daftarkan Diri Anda secara Online di DHS' }}</span>
        </p>
    </div>
</section>

<!-- Main Form Section (Exact Match to registration.blade.php) -->
<main class="pt-16 pb-24 bg-[#F7FAFC]">
    <section class="max-w-[850px] mx-auto px-5 md:px-8">
        <div class="bg-white border border-black/10 rounded-2xl p-8 md:p-12 shadow-md">

            <!-- Title Header -->
            <div class="text-center mb-10">
                <span class="text-[0.7rem] uppercase tracking-[0.2em] font-bold text-primary mb-2 block">
                    {{ $formSettings['badge_text'] ?? 'PENGAJUAN ONLINE DHS' }}
                </span>
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-dhs-navy mb-3">
                    FORMULIR PENGAJUAN DENPASAR HOTEL SCHOOL
                </h2>
                <p class="text-sm text-muted-light max-w-xl mx-auto leading-relaxed">
                    {{ $formSettings['notice_text'] ?? 'Silakan pilih jenis pengajuan yang diinginkan dan lengkapi data di bawah ini. Tim DHS akan segera memproses pengajuan Anda.' }}
                </p>
            </div>

            <!-- Notifications -->
            @if(session('reg_success'))
            <div class="bg-green-50 border border-green-200 rounded-xl p-5 mb-8 flex gap-3 items-start">
                <span class="material-icons text-green-500 mt-0.5">check_circle</span>
                <div>
                    <p class="font-semibold text-green-800">Pengajuan Berhasil Dikirim!</p>
                    <p class="text-sm text-green-700 mt-1">{{ session('reg_success') }}</p>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-5 mb-8">
                <p class="font-semibold text-red-800 text-sm mb-1">Mohon perbaiki kesalahan berikut:</p>
                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form Body -->
            <form action="/layanan" method="POST" class="space-y-6" id="form-layanan">
                @csrf

                <!-- 1. PILIH JENIS PENGAJUAN (DROPDOWN DIRECT UTAMA) -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2">
                        <span>Pilih Jenis Pengajuan</span> <span class="text-red-500">*</span>
                    </label>
                    <input type="hidden" name="tipe_pengajuan" id="hidden-tipe-pengajuan" value="beasiswa">
                    <input type="hidden" name="jenis_pengajuan_utama" id="hidden-jenis-utama" value="">

                    <select id="reg-jenis-pengajuan-select" onchange="onJenisPengajuanSelect(this)"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] font-semibold text-dhs-navy outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all bg-white cursor-pointer"
                        required>
                        <option value="" disabled {{ !old('jenis_pengajuan_utama') && !request('type') && !request('doc') && !request('beasiswa') ? 'selected' : '' }}>-- Pilih Beasiswa atau Dokumen yang Ingin Diajukan --</option>

                        <optgroup label="🎓 JALUR BEASISWA DHS">
                            @php
                                $beasiswaParam = request('beasiswa');
                                $beasiswaList = !empty($formSettings['beasiswa_options']) ? $formSettings['beasiswa_options'] : [
                                    ['name' => 'Beasiswa Prestasi', 'desc' => 'Keringanan Biaya Pendidikan s/d 50%'],
                                    ['name' => 'Beasiswa STT / Desa', 'desc' => 'Utusan Sekaa Teruna & Desa Adat Bali'],
                                    ['name' => 'Beasiswa Khusus', 'desc' => 'Keluarga Kurang Mampu']
                                ];
                            @endphp
                            @foreach($beasiswaList as $bItem)
                                @if(!isset($bItem['is_active']) || $bItem['is_active'])
                                    @php $bVal = $bItem['name']; @endphp
                                    <option value="{{ $bVal }}" data-type="beasiswa" {{ old('jenis_pengajuan_utama') === $bVal || (!old('jenis_pengajuan_utama') && ($beasiswaParam === $bVal || (!$beasiswaParam && !request('doc') && request('type') === 'beasiswa' && $loop->first))) ? 'selected' : '' }}>
                                        🎓 {{ $bVal }} {{ !empty($bItem['desc']) ? '(' . $bItem['desc'] . ')' : '' }}
                                    </option>
                                @endif
                            @endforeach
                        </optgroup>

                        <optgroup label="📑 LAYANAN DOKUMEN &amp; SERTIFIKASI KAPAL">
                            @php
                                $docParam = request('doc');
                                $docList = !empty($formSettings['dokumen_options']) ? $formSettings['dokumen_options'] : [
                                    ['name' => 'Passport', 'desc' => 'Paspor 48 Hal / Pelaut'],
                                    ['name' => 'BST', 'desc' => 'Basic Safety Training'],
                                    ['name' => 'SDSD', 'desc' => 'Security Duties on Ships'],
                                    ['name' => 'CCM', 'desc' => 'Crowd Control Management'],
                                    ['name' => 'SSAT', 'desc' => 'Ship Security Awareness'],
                                    ['name' => 'PSCRB', 'desc' => 'Proficiency in Survival Craft'],
                                    ['name' => 'C1/D Visa', 'desc' => 'US Seaman Visa'],
                                    ['name' => 'Surat Keterangan Alumni', 'desc' => 'Surat Keterangan Lulus'],
                                    ['name' => 'Transkrip Nilai', 'desc' => 'Transkrip Nilai Akademik'],
                                    ['name' => 'Surat Rekomendasi Kerja', 'desc' => 'Rekomendasi Kerja / Magang'],
                                    ['name' => 'Legalisir Dokumen', 'desc' => 'Legalisir Dokumen DHS'],
                                    ['name' => 'Paket Dokumen Kapal Pesiar', 'desc' => 'Paket Dokumen Kapal Pesiar Lengkap']
                                ];
                            @endphp
                            @foreach($docList as $dItem)
                                @if(!isset($dItem['is_active']) || $dItem['is_active'])
                                    @php $dVal = $dItem['name']; @endphp
                                    <option value="{{ $dVal }}" data-type="dokumen" {{ old('jenis_pengajuan_utama') === $dVal || (!old('jenis_pengajuan_utama') && ($docParam === $dVal || (!$docParam && request('type') === 'dokumen' && $loop->first))) ? 'selected' : '' }}>
                                        📑 {{ $dVal }} {{ !empty($dItem['desc']) ? '(' . $dItem['desc'] . ')' : '' }}
                                    </option>
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                </div>


                <!-- 2. NAMA LENGKAP -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2">
                        <span>Nama Lengkap</span> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                        placeholder="Masukkan nama lengkap Anda sesuai KTP / Ijazah"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
                        required>
                </div>

                <!-- 3. HP / WA -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2">
                        <span>HP / WA (WhatsApp Aktif)</span> <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="hp_wa" value="{{ old('hp_wa') }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
                        required>
                </div>

                <!-- 4. EMAIL -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2">
                        <span>Email</span> <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="alamat@email.com"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
                        required>
                </div>

                <!-- ================= DROPDOWN OPSI BEASISWA ================= -->
                <div id="panel-beasiswa-options" class="space-y-6">
                    <!-- Dropdown Program Studi -->
                    <div>
                        <label class="block text-sm font-semibold text-text-light mb-2">
                            <span>Program Studi Diminati</span> <span class="text-red-500">*</span>
                        </label>
                        <input type="hidden" name="kategori" id="hidden-kategori" value="{{ old('kategori', '1-tahun') }}">
                        <select name="program" id="select-program-beasiswa"
                            class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all bg-white cursor-pointer">
                            <option value="" disabled selected>-- Pilih Program Studi --</option>
                            @foreach($programs as $catKey => $cat)
                            <optgroup label="{{ $cat['label'] }}">
                                @foreach($cat['options'] as $progOpt)
                                <option value="{{ $progOpt }}" data-cat="{{ $catKey }}" {{ old('program') === $progOpt ? 'selected' : '' }}>{{ $progOpt }}</option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <!-- Asal Sekolah -->
                    <div>
                        <label class="block text-sm font-semibold text-text-light mb-2">
                            <span>Asal Sekolah / Perguruan Tinggi</span>
                        </label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}"
                            placeholder="Contoh: SMAN 1 Denpasar / SMKN 1 Kuta"
                            class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    </div>
                </div>

                <!-- ================= DROPDOWN OPSI DOKUMEN ================= -->
                <div id="panel-dokumen-options" class="space-y-6 hidden">
                    <!-- Informational Banner for Documents -->
                    <div class="p-5 bg-gradient-to-r from-sky-50 to-blue-50/80 border border-sky-200/80 rounded-2xl flex items-start gap-4 shadow-sm">
                        <div class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center shrink-0 shadow-md">
                            <span class="material-icons text-xl">description</span>
                        </div>
                        <div class="space-y-1 text-xs text-slate-700">
                            <h4 class="font-bold text-sm text-dhs-navy flex items-center gap-2">
                                Layanan Pengurusan Dokumen Sertifikasi Resmi DHS
                                <span class="text-[0.65rem] font-semibold px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded-full">Resmi &amp; Terdaftar</span>
                            </h4>
                            <p class="leading-relaxed text-slate-600">
                                Permintaan pengurusan paspor, BST, SDSD, CCM, SSAT, PSCRB, C1/D Visa, maupun surat keterangan alumni akan langsung diverifikasi oleh Tim Admisi DHS. 
                            </p>
                            <div class="pt-1.5 flex flex-wrap items-center gap-3 font-semibold text-primary">
                                <span class="flex items-center gap-1"><span class="material-icons text-xs text-emerald-600">check_circle</span> Waktu Proses: 1 - 14 Hari</span>
                                <span class="flex items-center gap-1"><span class="material-icons text-xs text-emerald-600">check_circle</span> Verifikasi 1x24 Jam</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Tujuan Pengurusan -->
                    <div>
                        <label class="block text-sm font-semibold text-text-light mb-2">
                            <span>Tujuan Pengurusan Dokumen</span>
                        </label>
                        <select name="tujuan" id="select-tujuan-dokumen"
                            class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all bg-white cursor-pointer">
                            <option value="" disabled selected>-- Pilih Tujuan Pengurusan --</option>
                            <option value="Kapal Pesiar Internasional" {{ old('tujuan') === 'Kapal Pesiar Internasional' ? 'selected' : '' }}>🚢 Bekerja di Kapal Pesiar Internasional</option>
                            <option value="Hotel Luar Negeri" {{ old('tujuan') === 'Hotel Luar Negeri' ? 'selected' : '' }}>🏨 Bekerja di Hotel Luar Negeri (Jepang / Dubai / Australia)</option>
                            <option value="Persiapan Program DHS" {{ old('tujuan') === 'Persiapan Program DHS' ? 'selected' : '' }}>🎓 Persiapan Mengikuti Program DHS</option>
                            <option value="Persyaratan Administrasi Alumni" {{ old('tujuan') === 'Persyaratan Administrasi Alumni' ? 'selected' : '' }}>📄 Persyaratan Administrasi Alumni / Kerja</option>
                            <option value="Lainnya" {{ old('tujuan') === 'Lainnya' ? 'selected' : '' }}>✨ Lainnya</option>
                        </select>
                    </div>

                    <!-- Tahun Lulus & NIM -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-text-light mb-1">Tahun Lulus (jika Alumni DHS)</label>
                            <input type="text" name="tahun_lulus" value="{{ old('tahun_lulus') }}" placeholder="Contoh: 2023"
                                class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-text-light mb-1">Nomor Induk Siswa / NIM (opsional)</label>
                            <input type="text" name="nomor_induk" value="{{ old('nomor_induk') }}" placeholder="Contoh: DHS-2023-014"
                                class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary">
                        </div>
                    </div>
                </div>

                <!-- 5. PENGUMPULAN BERKAS / FOTO VIA GOOGLE DRIVE -->
                <div class="pt-4 border-t border-black/10 space-y-4">
                    <label class="block text-sm font-semibold text-text-light mb-1">
                        <span>Pengumpulan Berkas &amp; Foto via Google Drive</span> <span class="text-red-500">*</span>
                    </label>

                    <!-- Informasi & Langkah-langkah Pengumpulan -->
                    <div class="bg-blue-50/80 border border-blue-200 rounded-xl p-5 space-y-3">
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-bold uppercase tracking-wider text-blue-900 flex items-center gap-1.5">
                                <span class="material-icons text-base text-blue-600">info</span>
                                Langkah-Langkah Pengiriman Berkas Drive:
                            </p>
                            <a href="https://drive.google.com" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1 px-3 py-1 bg-white border border-blue-300 rounded text-[0.7rem] font-bold text-blue-700 hover:bg-blue-100 transition-colors">
                                <span class="material-icons text-xs">open_in_new</span>
                                Buka Drive
                            </a>
                        </div>
                        <ol class="text-xs text-blue-800 space-y-1.5 list-decimal list-inside leading-relaxed">
                            <li>Siapkan foto/scan dokumen yang diperlukan (Foto diri, KTP, KK, Ijazah, Sertifikat).</li>
                            <li>Upload file dokumen tersebut ke dalam 1 folder di <strong>Google Drive</strong> Anda.</li>
                            <li>Atur akses folder ke <strong class="text-blue-950">"Siapa saja yang memiliki link" (Anyone with the link)</strong>.</li>
                            <li>Salin link folder tersebut dan tempel di kolom di bawah ini.</li>
                        </ol>
                    </div>

                    <!-- Clean Checklist Berkas Beasiswa (Tanpa Kotak Dalam) -->
                    <div id="checklist-beasiswa-info" class="bg-slate-50 border border-slate-200/90 rounded-xl p-4 space-y-3" style="font-family: 'Inter', sans-serif !important;">
                        <div class="flex items-center gap-2 border-b border-slate-200/80 pb-2.5">
                            <span class="material-icons text-amber-600 text-sm">assignment_turned_in</span>
                            <span class="font-bold text-xs uppercase tracking-wider text-slate-800" style="font-size: 12px !important; font-family: 'Inter', sans-serif !important;">
                                Dokumen Persyaratan Pengajuan Beasiswa
                            </span>
                        </div>

                        <div class="space-y-2.5 text-xs text-slate-700" style="font-family: 'Inter', sans-serif !important;">
                            <div class="flex items-start gap-2" style="font-size: 12px !important;">
                                <span class="font-bold text-slate-900 shrink-0">🏆 Beasiswa Prestasi:</span>
                                <span class="text-slate-600">Pas Foto, KTP/Kartu Pelajar, Kartu Keluarga, Rapor/Ijazah, &amp; Sertifikat Prestasi.</span>
                            </div>
                            <div class="flex items-start gap-2" style="font-size: 12px !important;">
                                <span class="font-bold text-slate-900 shrink-0">👥 Beasiswa STT / Desa:</span>
                                <span class="text-slate-600">Pas Foto, KTP, Kartu Keluarga, Rapor/Ijazah, &amp; Rekomendasi Bendesa Adat.</span>
                            </div>
                            <div class="flex items-start gap-2" style="font-size: 12px !important;">
                                <span class="font-bold text-slate-900 shrink-0">🎓 Beasiswa Khusus:</span>
                                <span class="text-slate-600">Pas Foto, KTP, Kartu Keluarga, Rapor/Ijazah, &amp; Surat Keterangan Tidak Mampu.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Clean Checklist Berkas Dokumen (Tanpa Kotak Dalam) -->
                    <div id="checklist-dokumen-info" class="bg-slate-50 border border-slate-200/90 rounded-xl p-4 space-y-3 hidden" style="font-family: 'Inter', sans-serif !important;">
                        <div class="flex items-center gap-2 border-b border-slate-200/80 pb-2.5">
                            <span class="material-icons text-cyan-600 text-sm">verified</span>
                            <span class="font-bold text-xs uppercase tracking-wider text-slate-800" style="font-size: 12px !important; font-family: 'Inter', sans-serif !important;">
                                Dokumen Sertifikasi Kapal &amp; Akademik Resmi
                            </span>
                        </div>

                        <div class="flex flex-wrap gap-2 text-xs font-semibold text-slate-800" style="font-size: 12px !important; font-family: 'Inter', sans-serif !important;">
                            <span class="px-2.5 py-1 bg-white border border-slate-200 rounded-full flex items-center gap-1.5 shadow-2xs">🛃 Passport</span>
                            <span class="px-2.5 py-1 bg-white border border-slate-200 rounded-full flex items-center gap-1.5 shadow-2xs">⚓ BST</span>
                            <span class="px-2.5 py-1 bg-white border border-slate-200 rounded-full flex items-center gap-1.5 shadow-2xs">🛡️ SDSD</span>
                            <span class="px-2.5 py-1 bg-white border border-slate-200 rounded-full flex items-center gap-1.5 shadow-2xs">👥 CCM</span>
                            <span class="px-2.5 py-1 bg-white border border-slate-200 rounded-full flex items-center gap-1.5 shadow-2xs">🛡️ SSAT</span>
                            <span class="px-2.5 py-1 bg-white border border-slate-200 rounded-full flex items-center gap-1.5 shadow-2xs">⛵ PSCRB</span>
                            <span class="px-2.5 py-1 bg-white border border-slate-200 rounded-full flex items-center gap-1.5 shadow-2xs">📛 C1/D VISA</span>
                            <span class="px-2.5 py-1 bg-white border border-slate-200 rounded-full flex items-center gap-1.5 shadow-2xs">📄 Alumni / Legalisir</span>
                        </div>
                    </div>






                    <!-- Input Link Drive -->
                    <div>
                        <label class="block text-sm font-semibold text-text-light mb-2">
                            <span>Link Folder Google Drive Berkas</span> <span class="text-red-500">*</span>
                        </label>
                        <div class="flex items-center gap-2 border border-black/15 rounded-lg px-4 py-3 focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/10 transition-all bg-white shadow-2xs">
                            <span class="material-icons text-primary shrink-0 text-xl">link</span>
                            <input type="url" name="link_berkas" id="field-link-berkas" value="{{ old('link_berkas') }}"
                                placeholder="https://drive.google.com/drive/folders/..."
                                class="w-full text-sm font-['Inter'] outline-none bg-transparent"
                                required>
                        </div>
                        <p class="text-xs text-muted-light mt-1.5">Pastikan akses folder sudah disetel ke "Siapa saja yang memiliki link" (Anyone with the link).</p>
                    </div>
                </div>




                <!-- 7. CATATAN TAMBAHAN (OPSIONAL) -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2">
                        <span>Catatan Tambahan (opsional)</span>
                    </label>
                    <textarea name="catatan" rows="2"
                        placeholder="Tuliskan instruksi tambahan, hari, waktu, atau hal lain jika ada..."
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all resize-none">{{ old('catatan') }}</textarea>
                </div>

                <!-- 8. INFORMASI DIPEROLEH DARI -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-3">
                        <span>Informasi tentang Denpasar Hotel School diperoleh dari:</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach(['Keluarga', 'Teman', 'Lembaga Tempat Belajar atau Kerja', 'Media Sosial', 'Situs Denpasar Hotel School', 'Pameran Pendidikan', 'Lainnya'] as $src)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="sumber_info[]" value="{{ $src }}"
                                class="w-4 h-4 accent-primary"
                                {{ in_array($src, old('sumber_info', [])) ? 'checked' : '' }}>
                            <span class="text-sm text-text-light group-hover:text-primary transition-colors">{{ $src }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- FORM ACTION BUTTONS (Exact match to registration.blade.php) -->
                <div class="flex justify-end gap-3 pt-6 border-t border-black/10">
                    <button type="reset" onclick="resetFormState()"
                        class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 border border-black/10 text-text-light text-xs font-semibold rounded transition-all">
                        <span>Batal</span>
                    </button>
                    <button type="submit"
                        class="px-8 py-2.5 bg-dhs-navy hover:bg-primary text-white text-xs font-bold rounded transition-all shadow-sm flex items-center gap-2">
                        <span id="btn-submit-text">Kirim Pengajuan</span>
                        <span class="material-icons text-sm">send</span>
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>

<!-- HELPDESK ADMISI SECTION (Exact match to registration.blade.php) -->
@php
    $waNum = $helpdesk['helpdesk_wa'] ?? '+62 81 246 319966';
    $waClean = preg_replace('/[^0-9]/', '', $waNum);
    if (str_starts_with($waClean, '0')) {
        $waClean = '62' . substr($waClean, 1);
    }
    $emailAddr = $helpdesk['helpdesk_email'] ?? 'sahabat@dhs.or.id';
    $serviceHours = $helpdesk['helpdesk_hours'] ?? 'Senin – Sabtu: 08:00 – 17:00 WITA';
@endphp
<section class="bg-dhs-lightblue py-16 px-6 md:px-16">
    <div class="max-w-[850px] mx-auto">
        <div class="bg-white border border-black/10 rounded-2xl p-8 md:p-10 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center gap-8">
                <div class="flex-1">
                    <span class="text-[0.7rem] uppercase tracking-[0.2em] font-bold text-primary mb-2 block">BUTUH BANTUAN?</span>
                    <h3 class="text-2xl md:text-3xl font-serif font-bold text-dhs-navy mb-2 leading-tight">Hubungi Tim Admisi</h3>
                    <p class="text-sm text-muted-light">Tim helpdesk kami siap menjawab pertanyaan Anda seputar pengajuan beasiswa dan dokumen.</p>
                </div>
                <div class="flex flex-col gap-4 md:min-w-[260px]">
                    <a href="https://wa.me/{{ $waClean }}" target="_blank"
                        class="flex items-center gap-4 p-4 border border-black/10 rounded-xl hover:border-primary/40 hover:shadow-md transition-all group">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-icons text-green-600 text-xl">chat</span>
                        </div>
                        <div>
                            <p class="text-[0.65rem] uppercase tracking-widest text-muted-light font-semibold">WhatsApp</p>
                            <p class="text-sm font-bold text-dhs-navy group-hover:text-primary transition-colors">{{ $waNum }}</p>
                        </div>
                    </a>
                    <a href="mailto:{{ $emailAddr }}"
                        class="flex items-center gap-4 p-4 border border-black/10 rounded-xl hover:border-primary/40 hover:shadow-md transition-all group">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-icons text-blue-600 text-xl">email</span>
                        </div>
                        <div>
                            <p class="text-[0.65rem] uppercase tracking-widest text-muted-light font-semibold">Email</p>
                            <p class="text-sm font-bold text-dhs-navy group-hover:text-primary transition-colors">{{ $emailAddr }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function onJenisPengajuanSelect(selectEl) {
    const selectedOpt = selectEl.options[selectEl.selectedIndex];
    const type = selectedOpt.dataset.type || 'beasiswa';
    const value = selectedOpt.value;

    document.getElementById('hidden-tipe-pengajuan').value = type;
    document.getElementById('hidden-jenis-utama').value = value;

    const isBeasiswa = (type === 'beasiswa');

    document.getElementById('panel-beasiswa-options').classList.toggle('hidden', !isBeasiswa);
    document.getElementById('panel-dokumen-options').classList.toggle('hidden', isBeasiswa);

    document.getElementById('checklist-beasiswa-info').classList.toggle('hidden', !isBeasiswa);
    document.getElementById('checklist-dokumen-info').classList.toggle('hidden', isBeasiswa);

    const submitText = document.getElementById('btn-submit-text');
    if (submitText) {
        submitText.textContent = isBeasiswa ? `Kirim Pengajuan ${value}` : `Kirim Pengurusan ${value}`;
    }

    // Toggle required fields
    const progSelectEl = document.getElementById('select-program-beasiswa');
    if (progSelectEl) {
        progSelectEl.required = isBeasiswa;
    }
}


function resetFormState() {
    setTimeout(() => {
        const select = document.getElementById('reg-jenis-pengajuan-select');
        if (select && select.value) onJenisPengajuanSelect(select);
    }, 100);
}

// Sync hidden category when program selection changes
const progSelect = document.getElementById('select-program-beasiswa');
if (progSelect) {
    progSelect.addEventListener('change', function() {
        const opt = this.options[this.selectedIndex];
        const cat = opt.dataset.cat || '1-tahun';
        const hidden = document.getElementById('hidden-kategori');
        if (hidden) hidden.value = cat;
    });
}

// Init on load if pre-selected
const initialSelect = document.getElementById('reg-jenis-pengajuan-select');
if (initialSelect && initialSelect.value) {
    onJenisPengajuanSelect(initialSelect);
}
</script>

@endsection

