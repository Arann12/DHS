@extends('layouts.app')

@section('title', 'Formulir Layanan Pengurusan Dokumen — Denpasar Hotel School')

@section('content')

<main class="min-h-screen bg-slate-100">

    <!-- ================= DARK HERO HEADER ================= -->
    <section class="relative bg-gradient-to-br from-dhs-darknavy via-dhs-navy to-slate-900 pt-28 md:pt-36 pb-24 md:pb-32 px-4 text-white overflow-hidden">
        <div class="absolute inset-0 pointer-events-none select-none overflow-hidden">
            <div class="absolute -top-32 -right-32 w-96 h-96 bg-cyan-400/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-cyan-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-4xl mx-auto text-center relative z-10">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 text-[0.68rem] font-bold uppercase tracking-[0.2em] text-cyan-300 mb-4 backdrop-blur-sm">
                <span class="material-icons text-sm text-cyan-400">description</span>
                DOCUMENT SERVICES
            </span>
            <h1 class="text-2xl sm:text-3xl md:text-5xl font-serif font-bold text-white leading-tight mb-4 tracking-wide">
                Layanan Pengurusan Dokumen
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                Pengurusan paspor, BST, SDSD, legalisir, transkrip, dan sertifikasi resmi Denpasar Hotel School.
            </p>
        </div>
    </section>

    <div class="max-w-[850px] mx-auto px-4 -mt-14 md:-mt-20 relative z-20 pb-20">

        <!-- ================= TOP STEPPER HEADER ================= -->
        <div class="mb-8 bg-white/95 backdrop-blur-md rounded-2xl p-5 md:p-6 border border-slate-200 shadow-lg">

            <div class="relative flex items-center justify-between max-w-2xl mx-auto px-4">
                <!-- Progress Line -->
                <div class="absolute left-10 right-10 top-4 h-[2px] bg-slate-300 -z-0"></div>
                <div id="progress-bar-line" class="absolute left-10 top-4 h-[2px] bg-cyan-600 transition-all duration-300 -z-0" style="width: 0%;"></div>

                <!-- Step 1 Circle -->
                <div class="step-indicator flex flex-col items-center relative z-10 cursor-pointer" onclick="goToStep(1)">
                    <div id="step-circle-1" class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm bg-cyan-600 text-white ring-4 ring-cyan-600/20 shadow-md transition-all">1</div>
                    <span id="step-label-1" class="text-[0.68rem] font-bold text-cyan-700 tracking-wider uppercase mt-2 text-center">Data Pemohon</span>
                </div>

                <!-- Step 2 Circle -->
                <div class="step-indicator flex flex-col items-center relative z-10 cursor-pointer" onclick="goToStep(2)">
                    <div id="step-circle-2" class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm bg-white border-2 border-slate-300 text-slate-500 transition-all">2</div>
                    <span id="step-label-2" class="text-[0.68rem] font-semibold text-slate-400 tracking-wider uppercase mt-2 text-center">Dokumen</span>
                </div>

                <!-- Step 3 Circle -->
                <div class="step-indicator flex flex-col items-center relative z-10 cursor-pointer" onclick="goToStep(3)">
                    <div id="step-circle-3" class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm bg-white border-2 border-slate-300 text-slate-500 transition-all">3</div>
                    <span id="step-label-3" class="text-[0.68rem] font-semibold text-slate-400 tracking-wider uppercase mt-2 text-center">Upload Berkas</span>
                </div>

                <!-- Step 4 Circle -->
                <div class="step-indicator flex flex-col items-center relative z-10 cursor-pointer" onclick="goToStep(4)">
                    <div id="step-circle-4" class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm bg-white border-2 border-slate-300 text-slate-500 transition-all">4</div>
                    <span id="step-label-4" class="text-[0.68rem] font-semibold text-slate-400 tracking-wider uppercase mt-2 text-center">Catatan</span>
                </div>

                <!-- Step 5 Circle -->
                <div class="step-indicator flex flex-col items-center relative z-10 cursor-pointer" onclick="goToStep(5)">
                    <div id="step-circle-5" class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm bg-white border-2 border-slate-300 text-slate-500 transition-all">5</div>
                    <span id="step-label-5" class="text-[0.68rem] font-semibold text-slate-400 tracking-wider uppercase mt-2 text-center">Konfirmasi</span>
                </div>
            </div>
        </div>

        <!-- ================= MAIN FORM CARD (EXACT MATCH REFERENCE DESIGN) ================= -->
        <div class="bg-white rounded-2xl border border-slate-300 shadow-xl overflow-hidden relative">

            <!-- Card Header: Logo + Title with Vertical Divider -->
            <div class="p-6 md:p-8 border-b border-slate-200 bg-white flex items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <img src="{{ $navLogo ?? '/image/LogoDHS.png' }}" alt="DHS Logo" class="h-14 md:h-16 w-auto object-contain">
                    <div class="h-12 w-[1px] bg-slate-300"></div>
                    <div>
                        <span class="text-[0.65rem] md:text-[0.7rem] uppercase tracking-[0.2em] font-semibold text-cyan-700 block">Formulir Layanan Pengurusan Dokumen</span>
                        <h1 class="text-lg md:text-2xl font-serif font-bold text-dhs-navy leading-tight">Denpasar Hotel School</h1>
                    </div>
                </div>
                <div class="hidden sm:flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-50 border border-cyan-200 text-xs font-bold text-cyan-800">
                    <span class="material-icons text-sm text-cyan-600">description</span>
                    Document Service
                </div>
            </div>

            <!-- Form Error & Success Notifications -->
            <div class="px-6 md:px-8 pt-4">
                @if(session('reg_success'))
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-5 mb-4 flex gap-4 items-start shadow-sm">
                    <span class="material-icons text-emerald-600 text-2xl mt-0.5">check_circle</span>
                    <div>
                        <p class="font-bold text-emerald-900 text-base">Permintaan Layanan Dokumen Berhasil Dikirim!</p>
                        <p class="text-sm text-emerald-800 mt-1 leading-relaxed">{{ session('reg_success') }}</p>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-rose-50 border border-rose-200 rounded-xl p-5 mb-4">
                    <ul class="list-disc list-inside text-sm text-rose-700 space-y-1">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- ================= FORM CONTENT ================= -->
            <form id="dhs-dokumen-form" action="/pengajuan-dokumen" method="POST">
                @csrf
                <input type="hidden" name="tipe_pendaftaran" value="dokumen">

                <!-- STEP 1: DATA DIRI PEMOHON -->
                <div id="step-content-1" class="step-content p-6 md:p-10 space-y-6">
                    <div class="border-b border-slate-200 pb-4 mb-6">
                        <h2 class="text-lg font-serif font-bold text-dhs-navy">1. Data Pemohon Dokumen</h2>
                        <p class="text-xs text-slate-500">Lengkapi identitas pribadi untuk pengurusan dokumen sertifikasi</p>
                    </div>

                    <!-- Row 1: Nama Lengkap -->
                    <div class="grid grid-cols-1 md:grid-cols-3 items-start gap-3 md:gap-6 py-3 border-b border-slate-100">
                        <div class="md:col-span-1">
                            <label class="block font-bold text-sm text-slate-800">Nama Lengkap <span class="text-rose-500">*</span></label>
                            <span class="text-[0.75rem] italic text-slate-400 font-normal block mt-0.5">sesuai KTP / Paspor</span>
                        </div>
                        <div class="md:col-span-2">
                            <input type="text" name="nama_lengkap" id="field-nama" value="{{ old('nama_lengkap') }}"
                                placeholder="Masukkan nama lengkap Anda"
                                class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm outline-none focus:border-cyan-600 focus:ring-2 focus:ring-cyan-600/10 transition-all bg-white"
                                required>
                        </div>
                    </div>

                    <!-- Row 2: Phone / WA -->
                    <div class="grid grid-cols-1 md:grid-cols-3 items-start gap-3 md:gap-6 py-3 border-b border-slate-100">
                        <div class="md:col-span-1">
                            <label class="block font-bold text-sm text-slate-800">Nomor HP / WhatsApp <span class="text-rose-500">*</span></label>
                            <span class="text-[0.75rem] italic text-slate-400 font-normal block mt-0.5">nomor aktif WhatsApp</span>
                        </div>
                        <div class="md:col-span-2">
                            <input type="tel" name="hp_wa" id="field-hp" value="{{ old('hp_wa') }}"
                                placeholder="08xxxxxxxxxx"
                                class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm outline-none focus:border-cyan-600 focus:ring-2 focus:ring-cyan-600/10 transition-all bg-white"
                                required>
                        </div>
                    </div>

                    <!-- Row 3: Email -->
                    <div class="grid grid-cols-1 md:grid-cols-3 items-start gap-3 md:gap-6 py-3">
                        <div class="md:col-span-1">
                            <label class="block font-bold text-sm text-slate-800">Alamat Email <span class="text-rose-500">*</span></label>
                            <span class="text-[0.75rem] italic text-slate-400 font-normal block mt-0.5">email aktif Anda</span>
                        </div>
                        <div class="md:col-span-2">
                            <input type="email" name="email" id="field-email" value="{{ old('email') }}"
                                placeholder="alamat@email.com"
                                class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm outline-none focus:border-cyan-600 focus:ring-2 focus:ring-cyan-600/10 transition-all bg-white"
                                required>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: DOKUMEN SERTIFIKASI -->
                <div id="step-content-2" class="step-content p-6 md:p-10 space-y-6 hidden">
                    <div class="border-b border-slate-200 pb-4 mb-6">
                        <h2 class="text-lg font-serif font-bold text-dhs-navy">2. Pilihan Dokumen Sertifikasi</h2>
                        <p class="text-xs text-slate-500">Pilih jenis dokumen sertifikasi dan tujuan pengurusan</p>
                    </div>

                    <!-- Row 1: Jenis Dokumen -->
                    <div class="grid grid-cols-1 md:grid-cols-3 items-start gap-3 md:gap-6 py-3 border-b border-slate-100">
                        <div class="md:col-span-1">
                            <label class="block font-bold text-sm text-slate-800">Pilih Dokumen Sertifikasi <span class="text-rose-500">*</span></label>
                            <span class="text-[0.75rem] italic text-slate-400 font-normal block mt-0.5">dokumen yang ingin diurus</span>
                        </div>
                        <div class="md:col-span-2">
                            <select name="jenis_dokumen" id="reg-jenis-dokumen"
                                class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm font-semibold outline-none focus:border-cyan-600 focus:ring-2 focus:ring-cyan-600/10 transition-all bg-white cursor-pointer"
                                required>
                                <option value="" disabled selected>-- Pilih dokumen --</option>
                                <option value="Passport" {{ old('jenis_dokumen') === 'Passport' ? 'selected' : '' }}>Passport (Paspor 48 Hal)</option>
                                <option value="BST" {{ old('jenis_dokumen') === 'BST' ? 'selected' : '' }}>BST (Basic Safety Training)</option>
                                <option value="SDSD" {{ old('jenis_dokumen') === 'SDSD' ? 'selected' : '' }}>SDSD (Security Duties on Ships)</option>
                                <option value="CCM" {{ old('jenis_dokumen') === 'CCM' ? 'selected' : '' }}>CCM (Crowd Control Management)</option>
                                <option value="SSAT" {{ old('jenis_dokumen') === 'SSAT' ? 'selected' : '' }}>SSAT (Ship Security Awareness)</option>
                                <option value="PSCRB" {{ old('jenis_dokumen') === 'PSCRB' ? 'selected' : '' }}>PSCRB (Proficiency in Survival Craft)</option>
                                <option value="C1/D Visa" {{ old('jenis_dokumen') === 'C1/D Visa' ? 'selected' : '' }}>C1/D Visa (US Seaman Visa)</option>
                                <option value="Surat Keterangan Alumni" {{ old('jenis_dokumen') === 'Surat Keterangan Alumni' ? 'selected' : '' }}>Surat Keterangan Alumni</option>
                                <option value="Transkrip Nilai" {{ old('jenis_dokumen') === 'Transkrip Nilai' ? 'selected' : '' }}>Transkrip Nilai</option>
                                <option value="Surat Rekomendasi" {{ old('jenis_dokumen') === 'Surat Rekomendasi' ? 'selected' : '' }}>Surat Rekomendasi</option>
                                <option value="Legalisir Dokumen" {{ old('jenis_dokumen') === 'Legalisir Dokumen' ? 'selected' : '' }}>Legalisir Dokumen</option>
                                <option value="Paket Dokumen Lengkap" {{ old('jenis_dokumen') === 'Paket Dokumen Lengkap' ? 'selected' : '' }}>Paket Pengurusan Dokumen Lengkap</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 2: Tujuan Pengurusan -->
                    <div class="grid grid-cols-1 md:grid-cols-3 items-start gap-3 md:gap-6 py-3">
                        <div class="md:col-span-1">
                            <label class="block font-bold text-sm text-slate-800">Tujuan Pengurusan</label>
                            <span class="text-[0.75rem] italic text-slate-400 font-normal block mt-0.5">peruntukan dokumen</span>
                        </div>
                        <div class="md:col-span-2">
                            <select name="tujuan" id="reg-tujuan-dokumen"
                                class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm outline-none focus:border-cyan-600 focus:ring-2 focus:ring-cyan-600/10 transition-all bg-white cursor-pointer">
                                <option value="" disabled selected>-- Pilih tujuan --</option>
                                <option value="Kapal Pesiar Internasional" {{ old('tujuan') === 'Kapal Pesiar Internasional' ? 'selected' : '' }}>Kapal Pesiar Internasional</option>
                                <option value="Program DHS" {{ old('tujuan') === 'Program DHS' ? 'selected' : '' }}>Persiapan Program Studi DHS</option>
                                <option value="Kerja di Luar Negeri" {{ old('tujuan') === 'Kerja di Luar Negeri' ? 'selected' : '' }}>Kerja di Luar Negeri</option>
                                <option value="Lainnya" {{ old('tujuan') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- STEP 3: LINK BERKAS GOOGLE DRIVE -->
                <div id="step-content-3" class="step-content p-6 md:p-10 space-y-6 hidden">
                    <div class="border-b border-slate-200 pb-4 mb-6">
                        <h2 class="text-lg font-serif font-bold text-dhs-navy">3. Lampirkan Berkas via Google Drive</h2>
                        <p class="text-xs text-slate-500">Upload dokumen ke Google Drive lalu tempel link-nya di sini</p>
                    </div>

                    {{-- Panduan --}}
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-2">
                        <p class="text-sm font-bold text-blue-800 mb-2 flex items-center gap-2">
                            <span class="material-icons text-base">info</span>
                            Cara Melampirkan Berkas
                        </p>
                        <ol class="text-xs text-blue-700 space-y-1.5 ml-1 list-decimal list-inside">
                            <li>Scan atau foto semua dokumen persyaratan dengan kualitas jelas.</li>
                            <li>Upload ke <strong>Google Drive</strong> atau <strong>Google Photos</strong>.</li>
                            <li>Klik kanan folder → <strong>"Bagikan"</strong> → ubah ke <strong>"Siapa saja yang memiliki link"</strong>.</li>
                            <li>Salin link dan tempel di kolom di bawah ini.</li>
                        </ol>
                        <a href="https://drive.google.com" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-1.5 mt-3 px-3 py-1.5 bg-white border border-blue-300 rounded-lg text-xs font-semibold text-blue-700 hover:bg-blue-100 transition-colors">
                            <span class="material-icons text-sm">open_in_new</span>
                            Buka Google Drive
                        </a>
                    </div>

                    {{-- Dokumen yang diperlukan --}}
                    <div class="bg-cyan-50 border border-cyan-200 rounded-xl p-4 mb-2">
                        <p class="text-sm font-bold text-cyan-800 mb-2">📋 Dokumen yang Perlu Dilampirkan:</p>
                        <ul class="text-xs text-cyan-700 space-y-1 ml-1">
                            <li>✅ <strong>Foto diri</strong> terbaru (background putih/merah, ukuran 4x6)</li>
                            <li>✅ <strong>KTP</strong> (scan kedua sisi, jelas)</li>
                            <li>✅ <strong>Kartu Keluarga</strong> (KK)</li>
                            <li>✅ <strong>Ijazah / Sertifikat</strong> terakhir (jika diperlukan)</li>
                            <li>✅ <strong>Surat keterangan kerja</strong> / kontrak (untuk sertifikasi kapal)</li>
                            <li>✅ <strong>Dokumen lain</strong> sesuai jenis layanan yang dipilih</li>
                        </ul>
                    </div>

                    {{-- Input Link Drive --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 items-start gap-3 md:gap-6 py-3">
                        <div class="md:col-span-1">
                            <label class="block font-bold text-sm text-slate-800">Link Folder Drive <span class="text-rose-500">*</span></label>
                            <span class="text-[0.75rem] italic text-slate-400 font-normal block mt-0.5">pastikan akses publik</span>
                        </div>
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-2 border border-slate-300 rounded-lg px-4 py-3 focus-within:border-cyan-600 focus-within:ring-2 focus-within:ring-cyan-600/10 transition-all bg-white">
                                <span class="material-icons text-slate-400 shrink-0">link</span>
                                <input type="url" name="link_berkas" id="field-link-berkas"
                                    value="{{ old('link_berkas') }}"
                                    placeholder="https://drive.google.com/drive/folders/..."
                                    class="flex-1 text-sm outline-none bg-transparent"
                                    required>
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5">Contoh: https://drive.google.com/drive/folders/1aBcDeF...</p>
                        </div>
                    </div>
                </div>

                <!-- STEP 4: INFORMASI & CATATAN -->
                <div id="step-content-4" class="step-content p-6 md:p-10 space-y-6 hidden">
                    <div class="border-b border-slate-200 pb-4 mb-6">
                        <h2 class="text-lg font-serif font-bold text-dhs-navy">4. Catatan &amp; Informasi Layanan</h2>
                        <p class="text-xs text-slate-500">Tuliskan instruksi khusus atau pertanyaan pengurusan dokumen</p>
                    </div>

                    <!-- Row 1: Sumber Informasi -->
                    <div class="grid grid-cols-1 md:grid-cols-3 items-start gap-3 md:gap-6 py-3 border-b border-slate-100">
                        <div class="md:col-span-1">
                            <label class="block font-bold text-sm text-slate-800">Sumber Informasi</label>
                            <span class="text-[0.75rem] italic text-slate-400 font-normal block mt-0.5">darimana tahu DHS</span>
                        </div>
                        <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach(['Keluarga', 'Teman', 'Lembaga Tempat Belajar atau Kerja', 'Media Sosial', 'Situs Denpasar Hotel School', 'Pameran Pendidikan', 'Lainnya'] as $src)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="sumber_info[]" value="{{ $src }}"
                                    class="w-4 h-4 accent-cyan-600"
                                    {{ in_array($src, old('sumber_info', [])) ? 'checked' : '' }}>
                                <span class="text-sm text-slate-700 group-hover:text-cyan-700 transition-colors">{{ $src }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Row 2: Special Request -->
                    <div class="grid grid-cols-1 md:grid-cols-3 items-start gap-3 md:gap-6 py-3">
                        <div class="md:col-span-1">
                            <label class="block font-bold text-sm text-slate-800">Catatan / Permintaan Khusus</label>
                            <span class="text-[0.75rem] italic text-slate-400 font-normal block mt-0.5">hal khusus yang ditindaklanjuti</span>
                        </div>
                        <div class="md:col-span-2">
                            <textarea name="special_request" rows="4"
                                placeholder="Tuliskan catatan khusus mengenai batas waktu, jadwal pelatihan, atau pertanyaan Anda..."
                                class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm outline-none focus:border-cyan-600 focus:ring-2 focus:ring-cyan-600/10 transition-all resize-none bg-white">{{ old('special_request') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- STEP 5: KONFIRMASI -->
                <div id="step-content-5" class="step-content p-6 md:p-10 space-y-6 hidden">
                    <div class="border-b border-slate-200 pb-4 mb-6">
                        <h2 class="text-lg font-serif font-bold text-dhs-navy">5. Konfirmasi Permintaan Layanan Dokumen</h2>
                        <p class="text-xs text-slate-500">Periksa kembali data Anda sebelum mengirimkan formulir</p>
                    </div>

                    <div class="bg-cyan-50/70 border border-cyan-200 rounded-xl p-6 space-y-4 text-sm">
                        <div class="flex justify-between border-b border-cyan-200/60 pb-2">
                            <span class="text-slate-600 font-medium">Nama Pemohon:</span>
                            <span id="summary-nama" class="font-bold text-dhs-navy">-</span>
                        </div>
                        <div class="flex justify-between border-b border-cyan-200/60 pb-2">
                            <span class="text-slate-600 font-medium">WhatsApp / HP:</span>
                            <span id="summary-hp" class="font-bold text-dhs-navy">-</span>
                        </div>
                        <div class="flex justify-between border-b border-cyan-200/60 pb-2">
                            <span class="text-slate-600 font-medium">Email:</span>
                            <span id="summary-email" class="font-bold text-dhs-navy">-</span>
                        </div>
                        <div class="flex justify-between border-b border-cyan-200/60 pb-2">
                            <span class="text-slate-600 font-medium">Dokumen Sertifikasi:</span>
                            <span id="summary-dokumen" class="font-bold text-cyan-800">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600 font-medium">Tujuan Pengurusan:</span>
                            <span id="summary-tujuan" class="font-bold text-dhs-navy">-</span>
                        </div>
                    </div>
                </div>

                <!-- ================= CARD FOOTER ACTION BUTTONS ================= -->
                <div class="p-6 md:p-8 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
                    <button type="button" id="btn-prev" onclick="changeStep(-1)"
                        class="px-6 py-2.5 rounded-lg border border-slate-300 bg-white text-slate-700 font-semibold text-sm hover:bg-slate-100 transition-all opacity-50 cursor-not-allowed disabled:opacity-50"
                        disabled>
                        Sebelumnya
                    </button>

                    <div class="flex items-center gap-3">
                        <button type="button" id="btn-next" onclick="changeStep(1)"
                            class="px-8 py-2.5 rounded-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-sm shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                            <span>Selanjutnya</span>
                            <span class="material-icons text-base">arrow_forward</span>
                        </button>

                        <button type="submit" id="btn-submit"
                            class="px-8 py-2.5 rounded-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-sm shadow-md hover:shadow-lg transition-all hidden flex items-center gap-2">
                            <span>Kirim Permintaan Dokumen</span>
                            <span class="material-icons text-base">description</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
let currentStep = 1;
const totalSteps = 5;

function updateStepUI() {
    document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
    document.getElementById(`step-content-${currentStep}`).classList.remove('hidden');

    const progressPercent = ((currentStep - 1) / (totalSteps - 1)) * 100;
    document.getElementById('progress-bar-line').style.width = `${progressPercent}%`;

    for (let i = 1; i <= totalSteps; i++) {
        const circle = document.getElementById(`step-circle-${i}`);
        const label = document.getElementById(`step-label-${i}`);

        if (i < currentStep) {
            circle.className = "w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm bg-cyan-600 text-white shadow-md transition-all";
            circle.innerHTML = `<span class="material-icons text-sm">check</span>`;
            if (label) label.className = "text-[0.68rem] font-bold text-cyan-700 tracking-wider uppercase mt-2 text-center";
        } else if (i === currentStep) {
            circle.className = "w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm bg-cyan-600 text-white ring-4 ring-cyan-600/20 shadow-md transition-all";
            circle.textContent = i;
            if (label) label.className = "text-[0.68rem] font-bold text-cyan-700 tracking-wider uppercase mt-2 text-center";
        } else {
            circle.className = "w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm bg-white border-2 border-slate-300 text-slate-500 transition-all";
            circle.textContent = i;
            if (label) label.className = "text-[0.68rem] font-semibold text-slate-400 tracking-wider uppercase mt-2 text-center";
        }
    }

    const btnPrev = document.getElementById('btn-prev');
    const btnNext = document.getElementById('btn-next');
    const btnSubmit = document.getElementById('btn-submit');

    if (currentStep === 1) {
        btnPrev.disabled = true;
        btnPrev.classList.add('opacity-50', 'cursor-not-allowed');
    } else {
        btnPrev.disabled = false;
        btnPrev.classList.remove('opacity-50', 'cursor-not-allowed');
    }

    if (currentStep === totalSteps) {
        btnNext.classList.add('hidden');
        btnSubmit.classList.remove('hidden');
        populateSummary();
    } else {
        btnNext.classList.remove('hidden');
        btnSubmit.classList.add('hidden');
    }
}

function validateStep(step) {
    if (step === 1) {
        const nama = document.getElementById('field-nama').value.trim();
        const hp = document.getElementById('field-hp').value.trim();
        const email = document.getElementById('field-email').value.trim();
        if (!nama || !hp || !email) {
            alert('Mohon lengkapi Nama Lengkap, Nomor HP/WhatsApp, dan Email terlebih dahulu.');
            return false;
        }
    } else if (step === 2) {
        const d = document.getElementById('reg-jenis-dokumen').value;
        if (!d) {
            alert('Mohon pilih Dokumen Sertifikasi yang ingin diurus.');
            return false;
        }
    } else if (step === 3) {
        const link = document.getElementById('field-link-berkas').value.trim();
        if (!link) {
            alert('Mohon masukkan Link Folder Google Drive berkas persyaratan.');
            return false;
        }
    }
    return true;
}

function changeStep(delta) {
    if (delta > 0 && !validateStep(currentStep)) return;
    const nextStep = currentStep + delta;
    if (nextStep >= 1 && nextStep <= totalSteps) {
        currentStep = nextStep;
        updateStepUI();
        window.scrollTo({ top: 100, behavior: 'smooth' });
    }
}

function goToStep(step) {
    if (step < currentStep || validateStep(currentStep)) {
        currentStep = step;
        updateStepUI();
    }
}

function populateSummary() {
    document.getElementById('summary-nama').textContent = document.getElementById('field-nama').value || '-';
    document.getElementById('summary-hp').textContent = document.getElementById('field-hp').value || '-';
    document.getElementById('summary-email').textContent = document.getElementById('field-email').value || '-';
    document.getElementById('summary-dokumen').textContent = document.getElementById('reg-jenis-dokumen').value || '-';
    document.getElementById('summary-tujuan').textContent = document.getElementById('reg-tujuan-dokumen').value || '-';
}

function showFileName(input, labelId) {
    const label = document.getElementById(labelId);
    if (input.files && input.files[0]) {
        const file = input.files[0];
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file melebihi batas 2MB.');
            input.value = '';
            label.textContent = 'Choose File | No file chosen';
        } else {
            label.textContent = '✓ ' + file.name;
            label.style.color = '#1A365D';
        }
    }
}

updateStepUI();
</script>

@endsection
