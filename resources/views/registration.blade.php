@extends('layouts.app')

@section('title', 'Formulir Pendaftaran — Denpasar Hotel School')

@section('content')

@php
$programs = [];
if (isset($categories) && $categories->count() > 0) {
    foreach ($categories as $cat) {
        $activePrograms = $cat->programs->where('is_active', 1)->map(fn($p) => [
            'title' => $p->title,
            'fee'   => $p->tuition_fee ? (float) $p->tuition_fee : 0,
        ])->values()->toArray();
        // Only include category if it has active programs
        if (count($activePrograms) > 0) {
            $programs[$cat->category_key] = [
                'label'   => $cat->category_name,
                'options' => $activePrograms,
            ];
        }
    }
} else {
    // Default fallback if categories not loaded
    $programs = [
        'internasional' => [
            'label'   => 'Program Internasional',
            'options' => [
                ['title' => 'Program 1 Tahun + Ausbildung Jerman', 'fee' => 0],
                ['title' => 'Program 2 Tahun + 1 Semester TAFE Australia', 'fee' => 0],
                ['title' => 'TAFE Australia Pathway', 'fee' => 0],
                ['title' => 'THS Australia Pathway', 'fee' => 0],
                ['title' => 'Australia Short Course', 'fee' => 0],
                ['title' => 'Study Visit (Australia & Singapura)', 'fee' => 0],
            ]
        ],
        '2-tahun' => [
            'label'   => 'Vokasi 2 Tahun',
            'options' => [
                ['title' => 'Perhotelan (FO & HK) — 2 Tahun', 'fee' => 0],
                ['title' => 'Tata Boga (Culinary Art) — 2 Tahun', 'fee' => 0],
                ['title' => 'Tata Hidangan (FBS & Bartender) — 2 Tahun', 'fee' => 0],
            ]
        ],
        '1-tahun' => [
            'label'   => 'Vokasi 1 Tahun',
            'options' => [
                ['title' => 'Perhotelan (FO & HK) — 1 Tahun', 'fee' => 0],
                ['title' => 'Tata Boga (Culinary Art) — 1 Tahun', 'fee' => 0],
                ['title' => 'Tata Hidangan (FBS & Bartender) — 1 Tahun', 'fee' => 0],
            ]
        ],
        '1-tahun-kapal-pesiar' => [
            'label'   => '1 Tahun Kapal Pesiar',
            'options' => [
                ['title' => 'Cook (Asisten Koki) — Kapal Pesiar', 'fee' => 0],
                ['title' => 'Waiter & Bartender — Kapal Pesiar', 'fee' => 0],
                ['title' => 'Hotel Steward — Kapal Pesiar', 'fee' => 0],
            ]
        ],
        '6-bulan' => [
            'label'   => 'Short Course 6 Bulan',
            'options' => [
                ['title' => 'Perhotelan (FO & HK) — 6 Bulan', 'fee' => 0],
                ['title' => 'Tata Boga (Culinary Art) — 6 Bulan', 'fee' => 0],
                ['title' => 'Tata Hidangan (FBS & Bartender) — 6 Bulan', 'fee' => 0],
            ]
        ],
        'eksekutif' => [
            'label'   => 'Program Eksekutif (6 Bln)',
            'options' => [
                ['title' => 'FBS & Bar (Cruise Line)', 'fee' => 0],
                ['title' => 'Hotel Steward (Cruise Line)', 'fee' => 0],
                ['title' => 'Cook (Cruise Line)', 'fee' => 0],
                ['title' => 'Flair Bartending & Sommelier', 'fee' => 0],
                ['title' => 'Butler', 'fee' => 0],
                ['title' => 'SPA Therapist', 'fee' => 0],
            ]
        ],
    ];
}
@endphp

<!-- Hero Section -->
<section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden">
    <div class="absolute inset-0 bg-black/55 z-10"></div>
    <img alt="DHS Registration" class="absolute inset-0 w-full h-full object-cover"
        src="/image/hero_registration.jpg">

    <div class="relative z-20 px-6 max-w-5xl mx-auto pt-36 sm:pt-40 text-white" data-reveal="fade-up">
        <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/90 text-xs font-semibold uppercase tracking-wider" style="text-shadow: 0 1px 3px rgba(0,0,0,0.8);">
            <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
            <span class="material-icons text-sm text-white/60">chevron_right</span>
            <span class="text-white font-bold"><span data-id="Formulir Pendaftaran" data-en="Registration Form">Formulir Pendaftaran</span></span>
        </div>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-[1.1]" style="text-shadow: 0 3px 12px rgba(0,0,0,0.85);">
            <span data-id="Program &amp; Formulir Pendaftaran" data-en="Programs &amp; Registration Form">Program & Formulir Pendaftaran</span>
        </h1>
        <p class="text-xs md:text-sm uppercase tracking-[0.25em] text-white/90 font-medium" style="text-shadow: 0 2px 6px rgba(0,0,0,0.85);">
            <span data-id="Pilih Program Studi &amp; Daftarkan Diri Anda Secara Online" data-en="Choose Your Study Program &amp; Register Online">Pilih Program Studi & Daftarkan Diri Anda Secara Online</span>
        </p>
    </div>
</section>

<!-- Main Content with Direct Registration Form -->
<main class="pt-12 pb-24">
    <!-- FORMULIR PENDAFTARAN (CLEAN CARD) -->
    <section class="max-w-[850px] mx-auto px-5 scroll-mt-24" id="form-pendaftaran">
        <div class="bg-white border border-black/10 rounded-2xl p-8 md:p-12 shadow-md">
            
            <div class="text-center mb-10">
                <span class="text-[0.7rem] uppercase tracking-[0.2em] font-bold text-primary mb-2 block"><span data-id="PENDAFTARAN ONLINE" data-en="ONLINE REGISTRATION">PENDAFTARAN ONLINE</span></span>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-dhs-navy mb-3 leading-tight">
                    <span class="block" data-id="FORMULIR PENDAFTARAN" data-en="REGISTRATION FORM">FORMULIR PENDAFTARAN</span>
                    <span class="block" data-id="DENPASAR HOTEL SCHOOL" data-en="DENPASAR HOTEL SCHOOL">DENPASAR HOTEL SCHOOL</span>
                </h2>
                <p class="text-sm text-muted-light max-w-xl mx-auto">
                    <span data-id="Silakan lengkapi formulir pendaftaran di bawah ini. Tim admisi DHS akan segera menghubungi Anda." data-en="Please complete the registration form below. The DHS admissions team will contact you shortly.">Silakan lengkapi formulir pendaftaran di bawah ini. Tim admisi DHS akan segera menghubungi Anda.</span>
                </p>
            </div>

            @if(session('reg_success'))
            <div class="bg-green-50 border border-green-200 rounded-xl p-5 mb-8 flex gap-3 items-start">
                <span class="material-icons text-green-500 mt-0.5">check_circle</span>
                <div>
                    <p class="font-semibold text-green-800">Pendaftaran Berhasil Dikirim!</p>
                    <p class="text-sm text-green-700 mt-1">{{ session('reg_success') }}</p>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-5 mb-8">
                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- ── Step-by-Step Interactive Progress Tracker ── --}}
            <div class="mb-10 bg-slate-50/80 border border-black/5 rounded-2xl p-5 sm:p-6 shadow-xs">
                <div class="flex items-center justify-between max-w-md mx-auto relative">
                    <div class="absolute left-6 right-6 top-4 h-0.5 bg-slate-200 -z-0"></div>

                    {{-- Step 1 --}}
                    <div class="flex flex-col items-center gap-2 relative z-10">
                        <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs shadow-md ring-4 ring-white">
                            1
                        </div>
                        <span class="text-[0.68rem] font-bold text-primary tracking-wider uppercase">Data Diri</span>
                    </div>

                    {{-- Step 2 --}}
                    <div class="flex flex-col items-center gap-2 relative z-10">
                        <div class="w-8 h-8 rounded-full bg-white text-slate-600 border-2 border-slate-300 flex items-center justify-center font-bold text-xs shadow-sm ring-4 ring-white">
                            2
                        </div>
                        <span class="text-[0.68rem] font-semibold text-slate-500 tracking-wider uppercase">Program</span>
                    </div>

                    {{-- Step 3 --}}
                    <div class="flex flex-col items-center gap-2 relative z-10">
                        <div class="w-8 h-8 rounded-full bg-white text-slate-600 border-2 border-slate-300 flex items-center justify-center font-bold text-xs shadow-sm ring-4 ring-white">
                            3
                        </div>
                        <span class="text-[0.68rem] font-semibold text-slate-500 tracking-wider uppercase">Berkas</span>
                    </div>
                </div>
            </div>

            <form action="/pendaftaran" method="POST" enctype="multipart/form-data" class="space-y-6" id="form-pendaftaran">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2"><span data-id="Nama Lengkap" data-en="Full Name">Nama Lengkap</span> <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                        placeholder="Masukkan nama lengkap Anda"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('nama_lengkap') border-red-400 @enderror"
                        required>
                </div>

                <!-- HP/WA -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2"><span data-id="HP / WA" data-en="Phone / WhatsApp">HP / WA</span> <span class="text-red-500">*</span></label>
                    <input type="tel" name="hp_wa" value="{{ old('hp_wa') }}"
                        placeholder="08xxxxxxxxxx (aktif di WhatsApp)"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('hp_wa') border-red-400 @enderror"
                        required>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2"><span data-id="Email" data-en="Email">Email</span> <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="alamat@email.com"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('email') border-red-400 @enderror"
                        required>
                </div>

                <!-- Pilih Program Studi -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2"><span data-id="Pilih Program Studi" data-en="Select Study Program">Pilih Program Studi</span> <span class="text-red-500">*</span></label>
                    <select name="program" id="reg-program"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all bg-white cursor-pointer @error('program') border-red-400 @enderror"
                        required>
                        <option value="" disabled selected>-- Pilih Program Studi --</option>
                        @foreach($programs as $key => $cat)
                        <optgroup label="{{ $cat['label'] }}" style="font-weight: 700; color: #1A365D;">
                            @foreach($cat['options'] as $prog)
                            <option value="{{ $prog['title'] }}" style="padding-left: 1rem; color: #0F2440;" {{ old('program') === $prog['title'] ? 'selected' : '' }}>
                                {{ $prog['title'] }}
                            </option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>

                <!-- Special Request -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-2"><span data-id="Special Request" data-en="Special Request">Special Request</span></label>
                    <textarea name="special_request" rows="3"
                        placeholder="tuliskan hal yang Denpasar Hotel School perlu tindak lanjuti, misalnya hari, waktu dan lainnya"
                        class="w-full border border-black/15 rounded-lg px-4 py-3 text-sm font-['Inter'] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all resize-none">{{ old('special_request') }}</textarea>
                </div>

                <!-- Unggah Bukti Biaya Pendaftaran -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-1"><span data-id="Unggah Bukti Biaya Pendaftaran (jika ada)" data-en="Upload Registration Fee Proof (if applicable)">Unggah Bukti Biaya Pendaftaran (jika ada)</span></label>
                    <p class="text-xs text-muted-light mb-2">note: size file max 2mb</p>
                    <div class="border-2 border-dashed border-black/15 rounded-lg px-4 py-4 flex items-center gap-3 hover:border-primary/40 transition-colors cursor-pointer" onclick="document.getElementById('bukti_pendaftaran').click()">
                        <span class="material-icons text-muted-light">upload_file</span>
                        <div class="flex-1">
                            <input type="file" id="bukti_pendaftaran" name="bukti_pendaftaran" accept=".jpg,.jpeg,.png,.pdf"
                                class="hidden" onchange="showFileName(this, 'label-pendaftaran')">
                            <span id="label-pendaftaran" class="text-sm text-muted-light">Choose File | No file chosen</span>
                        </div>
                    </div>
                </div>

                <!-- Unggah Bukti Biaya Program -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-1"><span data-id="Unggah Bukti Biaya Program (jika ada)" data-en="Upload Program Fee Proof (if applicable)">Unggah Bukti Biaya Program (jika ada)</span></label>
                    <p class="text-xs text-muted-light mb-2">note: size file max 2mb</p>
                    <div class="border-2 border-dashed border-black/15 rounded-lg px-4 py-4 flex items-center gap-3 hover:border-primary/40 transition-colors cursor-pointer" onclick="document.getElementById('bukti_program').click()">
                        <span class="material-icons text-muted-light">upload_file</span>
                        <div class="flex-1">
                            <input type="file" id="bukti_program" name="bukti_program" accept=".jpg,.jpeg,.png,.pdf"
                                class="hidden" onchange="showFileName(this, 'label-program')">
                            <span id="label-program" class="text-sm text-muted-light">Choose File | No file chosen</span>
                        </div>
                    </div>
                </div>

                <!-- Informasi Diperoleh Dari -->
                <div>
                    <label class="block text-sm font-semibold text-text-light mb-3"><span data-id="Informasi tentang Denpasar Hotel School diperoleh dari:" data-en="How did you hear about Denpasar Hotel School?">Informasi tentang Denpasar Hotel School diperoleh dari:</span></label>
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

                <!-- Form Action Buttons -->
                <div class="flex justify-end gap-3 pt-6 border-t border-black/10">
                    <button type="reset" onclick="resetFormState()"
                        class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 border border-black/10 text-text-light text-xs font-semibold rounded-lg transition-all">
                        <span data-id="Batal" data-en="Cancel">Batal</span>
                    </button>
                    <button type="submit" id="btn-submit-reg"
                        class="px-8 py-2.5 bg-dhs-navy hover:bg-primary text-white text-xs font-semibold rounded-lg transition-all duration-300 shadow-sm hover:shadow-md hover:scale-[1.02] flex items-center gap-2">
                        <span id="btn-submit-text" data-id="Kirim Pendaftaran" data-en="Submit Application">Kirim Pendaftaran</span>
                        <span class="material-icons text-base">send</span>
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>

{{-- KONTAK HELPDESK ADMISI --}}
@php
    $waNum = $helpdesk['helpdesk_wa'] ?? '+62 81 246 319966';
    $waClean = preg_replace('/[^0-9]/', '', $waNum);
    if (str_starts_with($waClean, '0')) {
        $waClean = '62' . substr($waClean, 1);
    }
    $emailAddr = $helpdesk['helpdesk_email'] ?? ($footerSettings['email_denpasar'] ?? 'dhsvokasi@gmail.com');
    $serviceHours = $helpdesk['helpdesk_hours'] ?? 'Senin – Sabtu: 08:00 – 17:00 WITA';
@endphp
<section class="bg-dhs-lightblue py-16 px-6 md:px-16">
    <div class="max-w-[850px] mx-auto">
        <div class="bg-white border border-black/10 rounded-2xl p-8 md:p-10 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center gap-8">
                <div class="flex-1">
                    <span class="text-[0.7rem] uppercase tracking-[0.2em] font-bold text-primary mb-2 block"><span data-id="BUTUH BANTUAN?" data-en="NEED HELP?">BUTUH BANTUAN?</span></span>
                    <h3 class="text-2xl md:text-3xl font-serif font-bold text-dhs-navy mb-2 leading-tight"><span data-id="Hubungi Tim Admisi" data-en="Contact Admissions Team">Hubungi Tim Admisi</span></h3>
                    <p class="text-sm text-muted-light"><span data-id="Tim helpdesk kami siap menjawab pertanyaan Anda seputar program dan pendaftaran." data-en="Our helpdesk team is ready to answer your questions about programs and registration.">Tim helpdesk kami siap menjawab pertanyaan Anda seputar program dan pendaftaran.</span></p>
                </div>
                <div class="flex flex-col gap-4 md:min-w-[260px]">
                    {{-- WhatsApp --}}
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
                    {{-- Email --}}
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
                    {{-- Jam Operasional --}}
                    <div class="flex items-center gap-4 p-4 border border-black/10 rounded-xl bg-background-light">
                        <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-icons text-amber-600 text-xl">schedule</span>
                        </div>
                        <div>
                            <p class="text-[0.65rem] uppercase tracking-widest text-muted-light font-semibold">Jam Pelayanan</p>
                            <p class="text-sm font-bold text-dhs-navy">{{ $serviceHours }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
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

function resetFormState() {
    document.getElementById('label-pendaftaran').textContent = 'Choose File | No file chosen';
    document.getElementById('label-program').textContent = 'Choose File | No file chosen';
}

document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('form-pendaftaran');
    if (form) {
        form.addEventListener('submit', function() {
            var btn = document.getElementById('btn-submit-reg');
            var txt = document.getElementById('btn-submit-text');
            if (btn) {
                btn.style.opacity = '0.75';
                btn.style.pointerEvents = 'none';
                if (txt) txt.textContent = 'Mengirim Formulir...';
            }
        });
    }
});
</script>

@endsection
