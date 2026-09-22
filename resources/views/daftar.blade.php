@extends('layouts.app')

@section('title', 'Formulir Pendaftaran — Beasiswa & Layanan Dokumen — Denpasar Hotel School')

@section('content')

{{-- Hero --}}
<section class="relative h-[62vh] min-h-[460px] flex items-center justify-center text-center overflow-hidden bg-dhs-navy">
    <div class="absolute inset-0 bg-black/55 z-10"></div>
    <img alt="DHS Pendaftaran" class="absolute inset-0 w-full h-full object-cover"
        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxn2eqm_jRIxoqtBqU_Z4510mT8Oum1XJuCt3B4qsnaur1kOxl1kswsTUDy_IWkop-w6gCJC9c4z-J1rwUSX4qHaSazUfu4x09voqcT3DY8fhiWkEHZcuUOZBNOolJHzCrNRQQXlB6UNrMOsC2_nhrMbSl_DzCpEu5YNeYXrmzbkHsYKIWxKH0th79FkaqCRHftpuCaHJyYzxate_qQzEmQcWi4iGgWxF-wIUFQGCYA83w8lUepgu6VQ">

    <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
        <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
            <a class="hover:text-white transition-colors" href="/">Beranda</a>
            <span class="material-icons text-sm text-white/40">chevron_right</span>
            <a class="hover:text-white transition-colors" href="/akademi">Akademi</a>
            <span class="material-icons text-sm text-white/40">chevron_right</span>
            <span class="text-white font-bold">Formulir Pendaftaran</span>
        </div>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-[1.1]">
            Formulir Pendaftaran
        </h1>
        <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/70 font-medium">
            Beasiswa Program &amp; Layanan Pengurusan Dokumen — Denpasar Hotel School
        </p>
    </div>
</section>

<main class="py-16 pb-24 bg-gray-50/60">
    <div class="max-w-[960px] mx-auto px-5">

        {{-- Tab Switcher --}}
        <div class="flex justify-center mb-12" data-reveal="fade-up">
            <div class="inline-flex bg-white border border-black/10 rounded-2xl p-1.5 shadow-sm gap-1">
                <button id="tab-beasiswa" onclick="switchTab('beasiswa')"
                    class="tab-btn px-7 py-3 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2.5 active-tab">
                    <span class="material-icons text-base">workspace_premium</span>
                    Pendaftaran Beasiswa
                </button>
                <button id="tab-dokumen" onclick="switchTab('dokumen')"
                    class="tab-btn px-7 py-3 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2.5">
                    <span class="material-icons text-base">description</span>
                    Layanan Pengurusan Dokumen
                </button>
            </div>
        </div>

        {{-- ===================== PANEL: BEASISWA ===================== --}}
        <div id="panel-beasiswa" class="tab-panel" data-reveal="fade-up">

            {{-- Pilih Jenis Beasiswa --}}
            <div class="mb-8">
                <h2 class="text-xl font-bold font-serif text-dhs-navy mb-1">Pilih Program Beasiswa</h2>
                <p class="text-sm text-muted-light mb-5">Pilih salah satu skema beasiswa yang sesuai dengan kondisi Anda.</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach([
                        ['key' => 'Beasiswa Prestasi', 'icon' => 'emoji_events', 'desc' => 'Untuk calon siswa berprestasi akademik & non-akademik'],
                        ['key' => 'Beasiswa STT / Desa', 'icon' => 'groups', 'desc' => 'Untuk anggota STT dan utusan desa adat Bali'],
                        ['key' => 'Beasiswa Khusus', 'icon' => 'workspace_premium', 'desc' => 'Untuk calon siswa dari keluarga kurang mampu'],
                    ] as $bs)
                    <label class="beasiswa-card cursor-pointer group" data-key="{{ $bs['key'] }}">
                        <input type="radio" name="jenis_beasiswa_ui" value="{{ $bs['key'] }}" class="sr-only beasiswa-radio">
                        <div class="bg-white border-2 border-black/10 rounded-2xl p-5 flex flex-col items-center text-center gap-3 hover:border-primary/50 hover:shadow-lg transition-all duration-300 group-has-[:checked]:border-primary group-has-[:checked]:bg-primary/5 group-has-[:checked]:shadow-md">
                            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center group-has-[:checked]:bg-primary transition-colors">
                                <span class="material-icons text-primary text-2xl group-has-[:checked]:text-white transition-colors">{{ $bs['icon'] }}</span>
                            </div>
                            <div>
                                <p class="font-bold text-sm text-text-light group-has-[:checked]:text-primary transition-colors">{{ $bs['key'] }}</p>
                                <p class="text-xs text-muted-light mt-1 leading-relaxed">{{ $bs['desc'] }}</p>
                            </div>
                            <div class="w-5 h-5 rounded-full border-2 border-black/20 group-has-[:checked]:border-primary group-has-[:checked]:bg-primary transition-all flex items-center justify-center">
                                <span class="material-icons text-white text-xs hidden group-has-[:checked]:block">check</span>
                            </div>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Form Beasiswa --}}
            <div class="bg-white border border-black/10 rounded-2xl p-8 md:p-12 shadow-sm">
                <div class="flex items-center gap-4 mb-8 pb-6 border-b border-black/8">
                    <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center">
                        <span class="material-icons text-primary text-2xl">edit_note</span>
                    </div>
                    <div>
                        <span class="text-[0.7rem] uppercase tracking-[0.2em] font-bold text-primary block">FORMULIR BEASISWA</span>
                        <h2 class="text-xl font-serif font-bold text-dhs-navy leading-tight">Data Pendaftaran Beasiswa DHS</h2>
                    </div>
                </div>

                @if(session('beasiswa_success'))
                <div class="bg-green-50 border border-green-200 rounded-xl p-5 mb-8 flex gap-3 items-start">
                    <span class="material-icons text-green-500 mt-0.5">check_circle</span>
                    <div>
                        <p class="font-semibold text-green-800">Pendaftaran Beasiswa Berhasil!</p>
                        <p class="text-sm text-green-700 mt-1">{{ session('beasiswa_success') }}</p>
                    </div>
                </div>
                @endif

                @if($errors->hasBag('beasiswa') || ($errors->any() && session()->get('form_type') === 'beasiswa'))
                <div class="bg-red-50 border border-red-200 rounded-xl p-5 mb-8">
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
                @endif

                <form action="/daftar/beasiswa" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="jenis_beasiswa" id="hidden-jenis-beasiswa" value="{{ old('jenis_beasiswa') }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Lengkap --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-text-light mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                placeholder="Masukkan nama lengkap Anda"
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
                                required>
                        </div>

                        {{-- HP/WA --}}
                        <div>
                            <label class="block text-sm font-semibold text-text-light mb-2">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                            <input type="tel" name="hp_wa" value="{{ old('hp_wa') }}"
                                placeholder="08xxxxxxxxxx"
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
                                required>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-text-light mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="alamat@email.com"
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
                                required>
                        </div>

                        {{-- Asal Sekolah --}}
                        <div>
                            <label class="block text-sm font-semibold text-text-light mb-2">Asal Sekolah / Institusi <span class="text-red-500">*</span></label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}"
                                placeholder="Nama sekolah atau institusi asal"
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
                                required>
                        </div>

                        {{-- Nilai Rata-rata --}}
                        <div>
                            <label class="block text-sm font-semibold text-text-light mb-2">Nilai Rata-rata Rapor / Ijazah</label>
                            <input type="text" name="nilai_rata" value="{{ old('nilai_rata') }}"
                                placeholder="Contoh: 85.50"
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                        </div>

                        {{-- Program Diminati --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-text-light mb-2">Program yang Diminati <span class="text-red-500">*</span></label>
                            <select name="program_diminati"
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all cursor-pointer"
                                required>
                                <option value="" disabled selected>-- Pilih Program --</option>
                                @foreach($programs as $key => $cat)
                                <optgroup label="{{ $cat['label'] }}">
                                    @foreach($cat['options'] as $prog)
                                    <option value="{{ $prog }}" {{ old('program_diminati') === $prog ? 'selected' : '' }}>{{ $prog }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>

                        {{-- Motivasi --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-text-light mb-2">Esai / Surat Motivasi <span class="text-xs text-muted-light font-normal ml-1">(opsional, min. 100 kata untuk Beasiswa Khusus)</span></label>
                            <textarea name="motivasi" rows="4"
                                placeholder="Ceritakan motivasi Anda mendaftar beasiswa ini dan rencana karir ke depan..."
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all resize-none">{{ old('motivasi') }}</textarea>
                        </div>
                    </div>

                    {{-- Upload Dokumen --}}
                    <div class="border-t border-black/8 pt-6 space-y-5">
                        <h4 class="text-sm font-bold text-text-light flex items-center gap-2">
                            <span class="material-icons text-primary text-base">attach_file</span>
                            Unggah Dokumen Pendukung
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Rapor / Ijazah --}}
                            <div>
                                <label class="block text-sm font-semibold text-text-light mb-1">Rapor / Ijazah Terakhir <span class="text-xs text-muted-light font-normal">(opsional)</span></label>
                                <p class="text-xs text-muted-light mb-2">Format JPG, PNG, atau PDF. Max 2MB.</p>
                                <div class="border-2 border-dashed border-black/15 rounded-xl px-4 py-4 flex items-center gap-3 hover:border-primary/40 transition-colors cursor-pointer" onclick="document.getElementById('rapor_file').click()">
                                    <span class="material-icons text-muted-light">upload_file</span>
                                    <input type="file" id="rapor_file" name="rapor_file" accept=".jpg,.jpeg,.png,.pdf" class="hidden" onchange="showFileName(this, 'lbl-rapor')">
                                    <span id="lbl-rapor" class="text-sm text-muted-light">Pilih File...</span>
                                </div>
                            </div>

                            {{-- Sertifikat Prestasi --}}
                            <div>
                                <label class="block text-sm font-semibold text-text-light mb-1">Sertifikat / Piagam Prestasi <span class="text-xs text-muted-light font-normal">(opsional)</span></label>
                                <p class="text-xs text-muted-light mb-2">Format JPG, PNG, atau PDF. Max 2MB.</p>
                                <div class="border-2 border-dashed border-black/15 rounded-xl px-4 py-4 flex items-center gap-3 hover:border-primary/40 transition-colors cursor-pointer" onclick="document.getElementById('sertifikat_file').click()">
                                    <span class="material-icons text-muted-light">upload_file</span>
                                    <input type="file" id="sertifikat_file" name="sertifikat_file" accept=".jpg,.jpeg,.png,.pdf" class="hidden" onchange="showFileName(this, 'lbl-sertifikat')">
                                    <span id="lbl-sertifikat" class="text-sm text-muted-light">Pilih File...</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Info dari mana --}}
                    <div class="border-t border-black/8 pt-6">
                        <label class="block text-sm font-semibold text-text-light mb-3">Informasi tentang DHS diperoleh dari:</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach(['Keluarga', 'Teman', 'Lembaga / Sekolah', 'Media Sosial', 'Situs DHS', 'Pameran Pendidikan', 'Lainnya'] as $src)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="sumber_info[]" value="{{ $src }}"
                                    class="w-4 h-4 accent-primary"
                                    {{ in_array($src, old('sumber_info', [])) ? 'checked' : '' }}>
                                <span class="text-sm text-text-light group-hover:text-primary transition-colors">{{ $src }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-black/8">
                        <button type="reset" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 border border-black/10 text-text-light text-xs font-semibold rounded-xl transition-all">
                            Reset
                        </button>
                        <button type="submit"
                            class="px-8 py-3 bg-dhs-navy hover:bg-primary text-white text-xs font-bold rounded-xl transition-all shadow-sm flex items-center gap-2">
                            <span class="material-icons text-sm">send</span>
                            Kirim Pendaftaran Beasiswa
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ===================== PANEL: DOKUMEN ===================== --}}
        <div id="panel-dokumen" class="tab-panel hidden" data-reveal="fade-up">

            {{-- Pilih Layanan Dokumen --}}
            <div class="mb-8">
                <h2 class="text-xl font-bold font-serif text-dhs-navy mb-1">Pilih Layanan Pengurusan Dokumen</h2>
                <p class="text-sm text-muted-light mb-5">Pilih satu atau lebih dokumen yang ingin Anda urus bersama DHS.</p>
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-4">
                    @foreach([
                        ['key' => 'Passport', 'icon' => 'card_travel'],
                        ['key' => 'BST', 'icon' => 'anchor'],
                        ['key' => 'SDSD', 'icon' => 'security'],
                        ['key' => 'CCM', 'icon' => 'groups'],
                        ['key' => 'SSAT', 'icon' => 'verified_user'],
                        ['key' => 'PSCRB', 'icon' => 'sailing'],
                        ['key' => 'C1/D Visa', 'icon' => 'badge'],
                    ] as $dok)
                    <label class="dokumen-card cursor-pointer group" data-key="{{ $dok['key'] }}">
                        <input type="checkbox" name="layanan_dokumen_ui[]" value="{{ $dok['key'] }}" class="sr-only dokumen-checkbox">
                        <div class="bg-white border-2 border-black/10 rounded-2xl p-4 flex flex-col items-center text-center gap-2 hover:border-primary/50 hover:shadow-lg transition-all duration-300 group-has-[:checked]:border-primary group-has-[:checked]:bg-primary/5">
                            <div class="w-11 h-11 rounded-xl bg-dhs-lightblue flex items-center justify-center group-has-[:checked]:bg-primary transition-colors">
                                <span class="material-icons text-primary text-xl group-has-[:checked]:text-white transition-colors">{{ $dok['icon'] }}</span>
                            </div>
                            <p class="font-bold text-xs text-text-light group-has-[:checked]:text-primary transition-colors leading-tight">{{ $dok['key'] }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>
                <p class="text-xs text-muted-light mt-3 flex items-center gap-1.5">
                    <span class="material-icons text-sm text-primary">info</span>
                    Pilih semua dokumen yang ingin Anda urus. Tim DHS akan menghubungi Anda untuk detail biaya dan jadwal.
                </p>
            </div>

            {{-- Form Dokumen --}}
            <div class="bg-white border border-black/10 rounded-2xl p-8 md:p-12 shadow-sm">
                <div class="flex items-center gap-4 mb-8 pb-6 border-b border-black/8">
                    <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center">
                        <span class="material-icons text-primary text-2xl">description</span>
                    </div>
                    <div>
                        <span class="text-[0.7rem] uppercase tracking-[0.2em] font-bold text-primary block">FORMULIR LAYANAN DOKUMEN</span>
                        <h2 class="text-xl font-serif font-bold text-dhs-navy leading-tight">Data Pengurusan Dokumen DHS</h2>
                    </div>
                </div>

                @if(session('dokumen_success'))
                <div class="bg-green-50 border border-green-200 rounded-xl p-5 mb-8 flex gap-3 items-start">
                    <span class="material-icons text-green-500 mt-0.5">check_circle</span>
                    <div>
                        <p class="font-semibold text-green-800">Permintaan Layanan Dokumen Berhasil Dikirim!</p>
                        <p class="text-sm text-green-700 mt-1">{{ session('dokumen_success') }}</p>
                    </div>
                </div>
                @endif

                <form action="/daftar/dokumen" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="layanan_dokumen" id="hidden-layanan-dokumen" value="{{ old('layanan_dokumen') }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-text-light mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                placeholder="Masukkan nama lengkap Anda"
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
                                required>
                        </div>

                        {{-- HP/WA --}}
                        <div>
                            <label class="block text-sm font-semibold text-text-light mb-2">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                            <input type="tel" name="hp_wa" value="{{ old('hp_wa') }}"
                                placeholder="08xxxxxxxxxx"
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
                                required>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-text-light mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="alamat@email.com"
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
                                required>
                        </div>

                        {{-- Pekerjaan --}}
                        <div>
                            <label class="block text-sm font-semibold text-text-light mb-2">Status / Pekerjaan Saat Ini</label>
                            <select name="pekerjaan"
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all cursor-pointer">
                                <option value="">-- Pilih Status --</option>
                                <option value="Pelajar / Mahasiswa" {{ old('pekerjaan') === 'Pelajar / Mahasiswa' ? 'selected' : '' }}>Pelajar / Mahasiswa</option>
                                <option value="Karyawan Hotel / Restoran" {{ old('pekerjaan') === 'Karyawan Hotel / Restoran' ? 'selected' : '' }}>Karyawan Hotel / Restoran</option>
                                <option value="Calon Awak Kapal Pesiar" {{ old('pekerjaan') === 'Calon Awak Kapal Pesiar' ? 'selected' : '' }}>Calon Awak Kapal Pesiar</option>
                                <option value="Belum Bekerja" {{ old('pekerjaan') === 'Belum Bekerja' ? 'selected' : '' }}>Belum Bekerja</option>
                                <option value="Lainnya" {{ old('pekerjaan') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        {{-- Tujuan Dokumen --}}
                        <div>
                            <label class="block text-sm font-semibold text-text-light mb-2">Tujuan Pengurusan Dokumen</label>
                            <select name="tujuan_dokumen"
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all cursor-pointer">
                                <option value="">-- Pilih Tujuan --</option>
                                <option value="Kapal Pesiar Internasional" {{ old('tujuan_dokumen') === 'Kapal Pesiar Internasional' ? 'selected' : '' }}>Kapal Pesiar Internasional</option>
                                <option value="Program DHS" {{ old('tujuan_dokumen') === 'Program DHS' ? 'selected' : '' }}>Program DHS</option>
                                <option value="Kerja di Luar Negeri" {{ old('tujuan_dokumen') === 'Kerja di Luar Negeri' ? 'selected' : '' }}>Kerja di Luar Negeri</option>
                                <option value="Lainnya" {{ old('tujuan_dokumen') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        {{-- Catatan / Request --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-text-light mb-2">Catatan / Permintaan Khusus</label>
                            <textarea name="catatan" rows="3"
                                placeholder="Tuliskan informasi tambahan atau hal yang perlu ditindaklanjuti tim DHS..."
                                class="w-full border border-black/15 rounded-xl px-4 py-3.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all resize-none">{{ old('catatan') }}</textarea>
                        </div>
                    </div>

                    {{-- Upload KTP --}}
                    <div class="border-t border-black/8 pt-6 space-y-5">
                        <h4 class="text-sm font-bold text-text-light flex items-center gap-2">
                            <span class="material-icons text-primary text-base">attach_file</span>
                            Unggah Dokumen Identitas (Opsional)
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-text-light mb-1">Fotokopi KTP</label>
                                <p class="text-xs text-muted-light mb-2">Format JPG, PNG, atau PDF. Max 2MB.</p>
                                <div class="border-2 border-dashed border-black/15 rounded-xl px-4 py-4 flex items-center gap-3 hover:border-primary/40 transition-colors cursor-pointer" onclick="document.getElementById('ktp_file').click()">
                                    <span class="material-icons text-muted-light">upload_file</span>
                                    <input type="file" id="ktp_file" name="ktp_file" accept=".jpg,.jpeg,.png,.pdf" class="hidden" onchange="showFileName(this, 'lbl-ktp')">
                                    <span id="lbl-ktp" class="text-sm text-muted-light">Pilih File...</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-text-light mb-1">Pas Foto Terbaru</label>
                                <p class="text-xs text-muted-light mb-2">Format JPG atau PNG. Max 2MB.</p>
                                <div class="border-2 border-dashed border-black/15 rounded-xl px-4 py-4 flex items-center gap-3 hover:border-primary/40 transition-colors cursor-pointer" onclick="document.getElementById('foto_file').click()">
                                    <span class="material-icons text-muted-light">upload_file</span>
                                    <input type="file" id="foto_file" name="foto_file" accept=".jpg,.jpeg,.png" class="hidden" onchange="showFileName(this, 'lbl-foto')">
                                    <span id="lbl-foto" class="text-sm text-muted-light">Pilih File...</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-black/8">
                        <button type="reset" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 border border-black/10 text-text-light text-xs font-semibold rounded-xl transition-all">
                            Reset
                        </button>
                        <button type="submit"
                            class="px-8 py-3 bg-dhs-navy hover:bg-primary text-white text-xs font-bold rounded-xl transition-all shadow-sm flex items-center gap-2">
                            <span class="material-icons text-sm">send</span>
                            Kirim Permintaan Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>

<style>
.tab-btn {
    color: #6B7280;
    background: transparent;
}
.tab-btn.active-tab {
    background: #1A365D;
    color: white;
    box-shadow: 0 4px 14px rgba(26,54,93,0.25);
}
.tab-btn:not(.active-tab):hover {
    background: #f3f4f6;
    color: #1A365D;
}
</style>

<script>
function switchTab(tab) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active-tab'));
    document.getElementById('panel-' + tab).classList.remove('hidden');
    document.getElementById('tab-' + tab).classList.add('active-tab');
}

// Beasiswa radio → update hidden input
document.querySelectorAll('.beasiswa-radio').forEach(radio => {
    radio.addEventListener('change', () => {
        document.getElementById('hidden-jenis-beasiswa').value = radio.value;
    });
});

// Dokumen checkbox → update hidden input (comma-separated)
document.querySelectorAll('.dokumen-checkbox').forEach(cb => {
    cb.addEventListener('change', () => {
        const checked = [...document.querySelectorAll('.dokumen-checkbox:checked')].map(c => c.value);
        document.getElementById('hidden-layanan-dokumen').value = checked.join(', ');
    });
});

function showFileName(input, labelId) {
    const label = document.getElementById(labelId);
    if (input.files && input.files[0]) {
        const file = input.files[0];
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file melebihi batas 2MB.');
            input.value = '';
            label.textContent = 'Pilih File...';
        } else {
            label.textContent = '✓ ' + file.name;
            label.style.color = '#1A365D';
        }
    }
}

// Auto-switch tab from URL param e.g. /daftar?tab=dokumen
const urlParams = new URLSearchParams(window.location.search);
const tabParam = urlParams.get('tab');
if (tabParam === 'dokumen') switchTab('dokumen');

// Auto-preselect beasiswa from URL param e.g. /daftar?beasiswa=Beasiswa+Prestasi
const beasiswaParam = urlParams.get('beasiswa');
if (beasiswaParam) {
    const radio = document.querySelector(`.beasiswa-radio[value="${beasiswaParam}"]`);
    if (radio) {
        radio.checked = true;
        radio.dispatchEvent(new Event('change'));
    }
}

// Auto-preselect dokumen from URL param e.g. /daftar?dokumen=BST
const dokumenParam = urlParams.get('dokumen');
if (dokumenParam) {
    switchTab('dokumen');
    const cb = document.querySelector(`.dokumen-checkbox[value="${dokumenParam}"]`);
    if (cb) {
        cb.checked = true;
        cb.dispatchEvent(new Event('change'));
    }
}
</script>

@endsection
