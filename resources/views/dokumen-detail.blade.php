@extends('layouts.app')

@section('title', 'Layanan Pengurusan ' . $doc['title'] . ' — Denpasar Hotel School')

@push('styles')
<style>
    .dd-bg { background-color: #F8FAFC; }

    /* Card base matching Image #3 */
    .pd-card {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.07);
        border-radius: 1.25rem;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        transition: box-shadow 0.25s cubic-bezier(0.4,0,0.2,1);
    }
    .pd-card:hover {
        box-shadow: 0 8px 28px rgba(0,0,0,0.1);
    }

    /* Section header inside card */
    .pd-section-label {
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #C53030;
        margin-bottom: 0.25rem;
    }
    .pd-section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.45rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.3;
        margin-bottom: 0.2rem;
    }
    .pd-section-sub {
        font-size: 0.75rem;
        color: #64748b;
    }
    .pd-icon-wrap {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .pd-icon-wrap .material-icons {
        font-size: 1.25rem;
        color: #0F2440;
    }

    /* Sub-card item matching Image #3 */
    .pd-sub-item {
        display: flex;
        gap: 1rem;
        padding: 1.1rem 1rem;
        border-radius: 0.875rem;
        background: #F8FAFC;
        border: 1px solid rgba(0,0,0,0.05);
        transition: background 0.18s ease, box-shadow 0.18s ease;
    }
    .pd-sub-item:hover {
        background: #fff;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    }
    .pd-sub-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #0F2440;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
    }
    .pd-sub-icon .material-icons { color: #fff; font-size: 1.1rem; }

    /* Stat card */
    .dd-stat {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 1rem;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.875rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .dd-stat:hover {
        box-shadow: 0 6px 20px rgba(15,36,64,0.08);
        transform: translateY(-2px);
    }
    .dd-stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #f1f5f9;
        color: #0F2440;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .dd-stat-icon .material-icons { font-size: 1.2rem; }
    .dd-stat-lbl { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #94a3b8; margin-bottom: 0.15rem; }
    .dd-stat-val { font-size: 0.85rem; font-weight: 700; color: #0f172a; line-height: 1.3; }

    /* Hero section 3/4 layar laptop */
    .dd-hero-section {
        height: 75vh;
        min-height: 580px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    /* Jarak pemisah 4cm antara hero section dengan content */
    .dd-content-spacer {
        padding-top: 4cm;
        padding-bottom: 80px;
    }
    @media (max-width: 768px) {
        .dd-content-spacer {
            padding-top: 2.5cm;
            padding-bottom: 50px;
        }
    }

    /* Sidebar summary */
    .dd-sidebar-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 1.25rem;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(15,36,64,0.08);
    }
    .dd-sidebar-head {
        background: #0F2440;
        padding: 1.5rem 1.75rem;
    }
    .dd-spec-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.95rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.85rem;
    }
    .dd-spec-row:last-child { border-bottom: none; }

    /* Sidebar CTA Button */
    .dd-sidebar-btn {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 0.6rem !important;
        width: 100% !important;
        padding: 0.95rem 1.5rem !important;
        border-radius: 0.75rem !important;
        background: #0F2440 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.08em !important;
        box-shadow: 0 4px 14px rgba(15, 36, 64, 0.25) !important;
        transition: all 0.2s ease !important;
        text-decoration: none !important;
        cursor: pointer !important;
    }
    .dd-sidebar-btn:hover {
        background: #1A3A5C !important;
        color: #ffffff !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(15, 36, 64, 0.35) !important;
    }
    .dd-sidebar-btn span,
    .dd-sidebar-btn .material-icons {
        color: #ffffff !important;
    }

    /* Hero CTA Button */
    .dd-hero-btn {
        display: inline-flex !important;
        align-items: center !important;
        gap: 0.65rem !important;
        padding: 0.85rem 1.85rem !important;
        border-radius: 9999px !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
        border: 1px solid rgba(255, 255, 255, 0.4) !important;
        background: rgba(255, 255, 255, 0.15) !important;
        backdrop-filter: blur(12px) !important;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25) !important;
        transition: all 0.2s ease !important;
        text-decoration: none !important;
    }
    .dd-hero-btn:hover {
        background: rgba(255, 255, 255, 0.28) !important;
        border-color: #ffffff !important;
        color: #ffffff !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.4) !important;
    }
    .dd-hero-btn span,
    .dd-hero-btn .material-icons {
        color: #ffffff !important;
    }

    .dd-dark-badge {
        background: #0F2440 !important;
        color: #ffffff !important;
    }
</style>
@endpush

@section('content')

    {{-- ═══════════════════════════════ HERO (3/4 Layar Laptop) ═══════════════════════════════ --}}
    <section class="relative dd-hero-section overflow-hidden bg-slate-950 text-white pt-24 pb-12 md:pt-32 md:pb-16">
        <div class="absolute inset-0 bg-black/60 z-10"></div>
        <img alt="{{ $doc['title'] }}" width="1920" height="1080"
             class="absolute inset-0 w-full h-full object-cover"
             style="will-change: transform;"
             src="{{ !empty($doc['hero_image']) ? $doc['hero_image'] : 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600' }}">

        <div class="relative z-20 px-6 max-w-5xl mx-auto text-center" data-reveal="fade-up">

            {{-- 1. Breadcrumb: rapi, proporsional, margin bawah lega --}}
            <nav class="inline-flex items-center gap-2.5 text-white/80 text-xs font-semibold uppercase tracking-wider bg-white/10 px-4 py-2 rounded-full backdrop-blur-md border border-white/15 shadow-sm"
                 style="margin-bottom: 24px;">
                <a href="/" class="hover:text-amber-300 transition-colors flex items-center gap-1.5">
                    <span class="material-icons text-sm leading-none">home</span>Beranda
                </a>
                <span class="material-icons text-xs opacity-40">chevron_right</span>
                <a href="/akademi" class="hover:text-amber-300 transition-colors">Akademi</a>
                <span class="material-icons text-xs opacity-40">chevron_right</span>
                <span class="text-amber-400 font-bold truncate max-w-[240px]">{{ $doc['title'] }}</span>
            </nav>

            {{-- 2. Badges: jarak teratur ke judul --}}
            <div class="flex items-center justify-center gap-3 flex-wrap" style="margin-bottom: 28px;">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white/15 border border-white/20 backdrop-blur-md text-white shadow-sm">
                    <span class="material-icons text-sm text-amber-400">verified</span>
                    {{ $doc['badge'] ?? 'Sertifikasi Resmi' }}
                </span>
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white/15 border border-white/20 backdrop-blur-md text-white shadow-sm">
                    <span class="material-icons text-sm text-amber-400">{{ $doc['icon'] }}</span>
                    {{ $doc['category'] ?? 'Sertifikasi Maritim' }}
                </span>
            </div>

            {{-- 3. Title H1: Line-height lapang, jarak antar baris tidak dempet --}}
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[3.25rem] font-serif font-bold text-white max-w-4xl mx-auto"
                style="text-shadow: 0 4px 24px rgba(0,0,0,0.85); line-height: 1.45; letter-spacing: 0.02em; margin-bottom: 28px;">
                Layanan Pengurusan {{ $doc['title'] }}
            </h1>

            {{-- 4. CTA Button --}}
            <div>
                <a href="/layanan?doc={{ urlencode($doc['title']) }}"
                   class="dd-hero-btn">
                    <span>Ajukan Permohonan Online</span>
                    <span class="material-icons text-base">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════ MAIN CONTENT (Pemisah 10cm) ═════════════════════════════ --}}
    <div class="dd-bg dd-content-spacer px-5 md:px-8">
        <div class="max-w-7xl mx-auto">

            {{-- ══ STAT STRIP ══ --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-10" data-reveal="fade-up">
                <div class="dd-stat">
                    <div class="dd-stat-icon"><span class="material-icons">schedule</span></div>
                    <div><p class="dd-stat-lbl">Estimasi Waktu</p><p class="dd-stat-val">{{ $doc['waktu'] }}</p></div>
                </div>
                <div class="dd-stat">
                    <div class="dd-stat-icon"><span class="material-icons">workspace_premium</span></div>
                    <div><p class="dd-stat-lbl">Status Dokumen</p><p class="dd-stat-val">Resmi & Terverifikasi</p></div>
                </div>
                <div class="dd-stat">
                    <div class="dd-stat-icon"><span class="material-icons">payments</span></div>
                    <div><p class="dd-stat-lbl">Biaya Layanan</p><p class="dd-stat-val">{{ $doc['biaya'] }}</p></div>
                </div>
                <div class="dd-stat">
                    <div class="dd-stat-icon"><span class="material-icons">support_agent</span></div>
                    <div><p class="dd-stat-lbl">Bantuan Admisi</p><p class="dd-stat-val">Konsultasi Gratis</p></div>
                </div>
            </div>

            {{-- ══ MAIN GRID (Kiri Konten, Kanan Sidebar) ══ --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

                {{-- ── LEFT: Content Cards (8 cols) — Persis Sesuai Desain Image #3 ── --}}
                <div class="lg:col-span-8 space-y-8">

                    {{-- Card 1: Deskripsi & Profil Layanan (Matching Image #3 Card 1) --}}
                    <div class="pd-card p-8 sm:p-10" data-reveal="fade-up">
                        <div class="flex items-start gap-4 mb-7">
                            <div class="pd-icon-wrap">
                                <span class="material-icons">menu_book</span>
                            </div>
                            <div>
                                <p class="pd-section-label">Tentang Layanan</p>
                                <h2 class="pd-section-title">Deskripsi & Profil Layanan</h2>
                                <p class="pd-section-sub">Gambaran lengkap panduan dan prosedur pengurusan dokumen</p>
                            </div>
                        </div>

                        <div class="text-slate-600 text-[0.9rem] leading-[1.85] space-y-4" style="border-top: 1px solid #f1f5f9; padding-top: 1.5rem;">
                            <p>{{ $doc['description'] }}</p>

                            @if(isset($doc['peruntukan']))
                            <div class="flex items-start gap-3 p-4 rounded-xl bg-slate-50 border border-slate-100 mt-5">
                                <div class="w-8 h-8 rounded-lg bg-[#0F2440] text-white flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="material-icons text-base">person_pin</span>
                                </div>
                                <div>
                                    <p class="text-[0.65rem] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Diperuntukkan Bagi</p>
                                    <p class="text-slate-700 text-xs font-semibold leading-relaxed">{{ $doc['peruntukan'] }}</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Sub-cards Keunggulan (Matching Image #3 Card 2 Layout) --}}
                        @if(isset($doc['key_features']) && count($doc['key_features']) > 0)
                        <div class="mt-8 pt-6" style="border-top: 1px solid #f1f5f9;">
                            <p class="pd-section-label mb-3">Keunggulan Layanan</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                @foreach($doc['key_features'] as $feat)
                                <div class="pd-sub-item">
                                    <div class="pd-sub-icon">
                                        <span class="material-icons">verified</span>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900 text-[0.85rem] mb-1 leading-snug">{{ $feat }}</h3>
                                        <p class="text-slate-500 text-xs leading-relaxed">Proses resmi terstandarisasi Ditjen / Lembaga Terkait.</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Card 2: Persyaratan Berkas (Matching Image #3 Card 2) --}}
                    <div class="pd-card p-8 sm:p-10" data-reveal="fade-up" data-delay="100">
                        <div class="flex items-start gap-4 mb-7">
                            <div class="pd-icon-wrap">
                                <span class="material-icons">fact_check</span>
                            </div>
                            <div>
                                <p class="pd-section-label">Kelengkapan Berkas</p>
                                <h2 class="pd-section-title">Persyaratan Dokumen</h2>
                                <p class="pd-section-sub">{{ count($doc['syarat']) }} berkas wajib disiapkan sebelum proses pengajuan dimulai</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5" style="border-top: 1px solid #f1f5f9; padding-top: 1.5rem;">
                            @foreach($doc['syarat'] as $idx => $item)
                            <div class="pd-sub-item">
                                <div class="pd-sub-icon font-serif font-bold text-sm text-white">
                                    {{ $idx + 1 }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 text-[0.85rem] mb-1 leading-snug">Persyaratan {{ $idx + 1 }}</h3>
                                    <p class="text-slate-600 text-xs leading-relaxed">{{ $item }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Tips Callout --}}
                        <div class="flex items-start gap-3.5 p-4 rounded-xl bg-amber-50/70 border border-amber-200/60 mt-6">
                            <div class="w-8 h-8 rounded-lg bg-amber-500 text-white flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="material-icons text-base">lightbulb</span>
                            </div>
                            <div>
                                <p class="text-[0.65rem] font-bold uppercase tracking-wider text-amber-800 mb-0.5">Tips Persiapan Berkas</p>
                                <p class="text-amber-900/80 text-xs leading-relaxed">
                                    Siapkan scan digital (JPG/PDF) dokumen asli dengan resolusi tajam dan terbaca jelas. Tim admisi DHS akan memeriksa keabsahan dokumen sebelum antrean proses dimulai.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Card 3: Alur Pengurusan --}}
                    <div class="pd-card p-8 sm:p-10" data-reveal="fade-up" data-delay="150">
                        <div class="flex items-start gap-4 mb-7">
                            <div class="pd-icon-wrap">
                                <span class="material-icons">route</span>
                            </div>
                            <div>
                                <p class="pd-section-label">Tahapan Proses</p>
                                <h2 class="pd-section-title">Alur & Prosedur Pengurusan</h2>
                                <p class="pd-section-sub">{{ count($doc['proses']) }} tahapan terstruktur dari konsultasi awal hingga dokumen terbit</p>
                            </div>
                        </div>

                        <div class="space-y-3.5" style="border-top: 1px solid #f1f5f9; padding-top: 1.5rem;">
                            @foreach($doc['proses'] as $idx => $step)
                            <div class="pd-sub-item">
                                <div class="pd-sub-icon font-serif font-bold text-sm text-white">
                                    {{ $idx + 1 }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-0.5">
                                        <h3 class="font-bold text-slate-900 text-[0.85rem]">Tahap {{ $idx + 1 }}</h3>
                                        <span class="text-[0.65rem] font-bold uppercase tracking-wider text-primary">Langkah Resmi</span>
                                    </div>
                                    <p class="text-slate-600 text-xs leading-relaxed">{{ $step }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Card 4: FAQ (Pertanyaan Umum) --}}
                    @if(isset($doc['faq']) && count($doc['faq']) > 0)
                    <div class="pd-card p-8 sm:p-10" data-reveal="fade-up" data-delay="200">
                        <div class="flex items-start gap-4 mb-7">
                            <div class="pd-icon-wrap">
                                <span class="material-icons">quiz</span>
                            </div>
                            <div>
                                <p class="pd-section-label">Tanya Jawab</p>
                                <h2 class="pd-section-title">Pertanyaan Umum (FAQ)</h2>
                                <p class="pd-section-sub">Informasi penting yang sering ditanyakan seputar pengurusan {{ $doc['title'] }}</p>
                            </div>
                        </div>

                        <div class="space-y-3.5" style="border-top: 1px solid #f1f5f9; padding-top: 1.5rem;">
                            @foreach($doc['faq'] as $f)
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-xs transition-all">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-6 h-6 rounded-md bg-[#0F2440] text-white flex items-center justify-center flex-shrink-0 text-xs font-bold">
                                        Q
                                    </div>
                                    <h3 class="font-bold text-slate-900 text-sm">{{ $f['q'] }}</h3>
                                </div>
                                <p class="text-slate-600 text-xs leading-relaxed pl-9">{{ $f['a'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>

                {{-- ── RIGHT: Sidebar (4 cols) ── --}}
                <aside class="lg:col-span-4 lg:sticky lg:top-28 space-y-6" data-reveal="fade-up">

                    {{-- Summary Card --}}
                    <div class="dd-sidebar-card">
                        <div class="dd-sidebar-head text-white">
                            <p class="text-[0.65rem] font-bold uppercase tracking-wider text-amber-400 mb-1">Layanan Resmi DHS</p>
                            <h3 class="font-serif text-xl font-bold">Ringkasan Layanan</h3>
                        </div>

                        <div>
                            <div class="dd-spec-row">
                                <span class="text-slate-500 text-xs">Estimasi Waktu</span>
                                <span class="font-bold text-slate-900 text-xs">{{ $doc['waktu'] }}</span>
                            </div>
                            <div class="dd-spec-row">
                                <span class="text-slate-500 text-xs">Biaya Layanan</span>
                                <span class="font-bold text-primary text-xs">{{ $doc['biaya'] }}</span>
                            </div>
                            <div class="dd-spec-row">
                                <span class="text-slate-500 text-xs">Standar Regulasi</span>
                                <span class="font-bold text-slate-900 text-xs">{{ $doc['badge'] ?? 'Terakreditasi Resmi' }}</span>
                            </div>
                            <div class="dd-spec-row">
                                <span class="text-slate-500 text-xs">Kategori</span>
                                <span class="font-bold text-slate-900 text-xs">{{ $doc['category'] ?? 'Sertifikasi' }}</span>
                            </div>
                        </div>

                        <div class="p-5 border-t border-slate-100">
                            <a href="/layanan?doc={{ urlencode($doc['title']) }}"
                               class="dd-sidebar-btn">
                                <span class="material-icons text-base">edit_note</span>
                                <span>Ajukan Permohonan Online</span>
                            </a>
                        </div>
                    </div>

                    {{-- Helpdesk Card --}}
                    <div class="pd-card p-6 text-center">
                        <div class="w-12 h-12 rounded-full bg-slate-100 text-[#0F2440] flex items-center justify-center mx-auto mb-3">
                            <span class="material-icons text-2xl">support_agent</span>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm mb-1">Butuh Bantuan & Konsultasi?</h4>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4">
                            Tim admisi DHS siap mendampingi proses pengecekan berkas dan jadwal pengurusan dokumen Anda.
                        </p>
                        <a href="/layanan" class="inline-flex items-center gap-1.5 text-xs font-bold text-primary hover:text-[#0F2440] transition-colors">
                            <span>Hubungi Tim Admisi DHS</span>
                            <span class="material-icons text-sm">arrow_forward</span>
                        </a>
                    </div>
                </aside>

            </div>
        </div>
    </div>

@endsection
