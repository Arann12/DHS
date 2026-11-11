@extends('backoffice.layouts.app')

@section('title', 'Kelola Kategori & Anak Program — Academy DHS')
@section('page-title', 'Kategori & Anak Program')

@push('styles')
<style>
    .cat-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        margin-bottom: 22px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
        overflow: hidden;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .cat-card:hover {
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        border-color: #cbd5e1;
    }
    .cat-header {
        padding: 18px 22px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }
    .cat-badge-id {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 9px;
        background: #1A365D;
        color: #ffffff;
        font-size: 11px;
        font-weight: 800;
        border-radius: 6px;
        letter-spacing: 0.5px;
    }
    .prog-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .prog-table th {
        background: #fafafa;
        color: #475569;
        font-weight: 700;
        font-size: 11.5px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 12px 18px;
        border-bottom: 1.5px solid #e2e8f0;
        text-align: left;
    }
    .prog-table td {
        padding: 14px 18px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
        vertical-align: middle;
    }
    .prog-table tr:last-child td {
        border-bottom: none;
    }
    .prog-table tr:hover td {
        background: #f8fafc;
    }
    .badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 700;
    }
    .badge-pill-green {
        background: #dcfce7;
        color: #15803d;
    }
    .badge-pill-gray {
        background: #f1f5f9;
        color: #64748b;
    }
    .badge-pill-blue {
        background: #eff6ff;
        color: #1d4ed8;
    }
    .badge-pill-amber {
        background: #fef3c7;
        color: #b45309;
    }
    .bo-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(4px);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .bo-modal-box {
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        width: 100%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        border: 1px solid #e2e8f0;
    }
    .stat-badge-count {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #2563eb;
        color: #fff;
        font-size: 11px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
    }
</style>
@endpush

@section('content')
<div x-data="programKategoriManager()">

    {{-- Flash Success Alert --}}
    @if(session('success'))
    <div class="bo-card" style="border-left:4px solid #22c55e;margin-bottom:1.25rem;padding:12px 18px;color:#166534;background:#f0fdf4;display:flex;align-items:center;gap:10px;font-weight:600;border-radius:12px;">
        <span class="material-icons-round" style="font-size:22px;color:#16a34a;">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Flash Validation Error Alert --}}
    @if(isset($errors) && $errors->any())
    <div class="bo-card" style="border-left:4px solid #ef4444;margin-bottom:1.25rem;padding:12px 18px;color:#991b1b;background:#fef2f2;border-radius:12px;">
        <div style="font-weight:700;margin-bottom:4px;display:flex;align-items:center;gap:6px;">
            <span class="material-icons-round" style="font-size:20px;color:#dc2626;">error</span>
            Terjadi kesalahan penginputan:
        </div>
        <ul style="margin:0;padding-left:24px;font-size:13px;">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Top Action Banner --}}
    <div class="bo-card" style="padding:18px 24px;margin-bottom:20px;border-radius:16px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;background:#ffffff;border:1px solid #e2e8f0;">
        <div>
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:42px;height:42px;border-radius:11px;background:linear-gradient(135deg,#1A365D,#2563eb);color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span class="material-icons-round" style="font-size:24px;">account_tree</span>
                </div>
                <div>
                    <h2 style="margin:0;font-size:18px;font-weight:800;color:#0F2440;">Kelola Kategori &amp; Anak Program</h2>
                    <div style="font-size:13px;color:#64748b;margin-top:2px;">
                        Kategori &amp; anak program yang ditambahkan atau diubah di sini otomatis tersinkronisasi ke seluruh sistem: Keuangan Program, Halaman Akademi Publik, Formulir, dan Atur Tarif.
                    </div>
                </div>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <a href="/backoffice/kas-keuangan-program" class="btn-secondary" style="font-size:12.5px;padding:8px 14px;">
                <span class="material-icons-round" style="font-size:17px;">payments</span>
                Keuangan Program
            </a>
            <a href="/backoffice/program-tarif" class="btn-secondary" style="font-size:12.5px;padding:8px 14px;">
                <span class="material-icons-round" style="font-size:17px;">price_change</span>
                Atur Biaya / Tarif
            </a>
            <button type="button" class="btn-secondary" style="font-size:12.5px;padding:8px 14px;background:#f8fafc;" x-on:click="openAddProgramModal(null)">
                <span class="material-icons-round" style="font-size:18px;color:#2563eb;">playlist_add</span>
                <span style="font-weight:700;color:#1e3a8a;">+ Tambah Anak Program</span>
            </button>
            <button type="button" class="btn-primary" style="font-size:13px;padding:9px 18px;box-shadow:0 4px 14px rgba(26,54,93,0.2);" x-on:click="openAddCatModal()">
                <span class="material-icons-round" style="font-size:18px;">create_new_folder</span>
                <span>+ Tambah Kategori Baru</span>
            </button>
        </div>
    </div>

    {{-- 4 Stat Summary Cards --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));gap:16px;margin-bottom:22px;">
        <div class="bo-card" style="padding:16px 20px;border-radius:14px;display:flex;align-items:center;gap:14px;border:1px solid #e2e8f0;">
            <div style="width:46px;height:46px;border-radius:12px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:24px;">folder</span>
            </div>
            <div>
                <div style="font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.5px;">Total Kategori</div>
                <div style="font-size:22px;font-weight:900;color:#0F2440;">{{ $totalCategories }} <span style="font-size:13px;font-weight:600;color:#64748b;">Kategori</span></div>
            </div>
        </div>

        <div class="bo-card" style="padding:16px 20px;border-radius:14px;display:flex;align-items:center;gap:14px;border:1px solid #e2e8f0;">
            <div style="width:46px;height:46px;border-radius:12px;background:#f0fdf4;color:#16a34a;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:24px;">school</span>
            </div>
            <div>
                <div style="font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.5px;">Total Anak Program</div>
                <div style="font-size:22px;font-weight:900;color:#0F2440;">{{ $totalPrograms }} <span style="font-size:13px;font-weight:600;color:#64748b;">Jurusan</span></div>
            </div>
        </div>

        <div class="bo-card" style="padding:16px 20px;border-radius:14px;display:flex;align-items:center;gap:14px;border:1px solid #e2e8f0;">
            <div style="width:46px;height:46px;border-radius:12px;background:#fef3c7;color:#d97706;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:24px;">verified</span>
            </div>
            <div>
                <div style="font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.5px;">Program Aktif</div>
                <div style="font-size:22px;font-weight:900;color:#0F2440;">{{ $activePrograms }} <span style="font-size:13px;font-weight:600;color:#64748b;">Jurusan</span></div>
            </div>
        </div>

        <div class="bo-card" style="padding:16px 20px;border-radius:14px;display:flex;align-items:center;gap:14px;border:1px solid #e2e8f0;">
            <div style="width:46px;height:46px;border-radius:12px;background:#f3e8ff;color:#7c3aed;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:24px;">check_circle</span>
            </div>
            <div>
                <div style="font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.5px;">Kategori Aktif</div>
                <div style="font-size:22px;font-weight:900;color:#0F2440;">{{ $activeCats }} / {{ $totalCategories }}</div>
            </div>
        </div>
    </div>

    {{-- Filter & Search Toolbar --}}
    <div class="bo-card" style="padding:14px 20px;margin-bottom:22px;border-radius:14px;border:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div style="position:relative;flex:1;min-width:260px;max-width:480px;">
            <span class="material-icons-round" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:19px;">search</span>
            <input type="text" class="bo-input" placeholder="Cari nama kategori atau nama anak program..."
                   x-model="searchQuery" style="padding-left:38px !important;border-radius:10px !important;">
        </div>

        <div style="display:flex;align-items:center;gap:8px;">
            <button type="button" class="btn-secondary" style="font-size:12.5px;padding:7px 12px;" x-on:click="toggleAll(true)">
                <span class="material-icons-round" style="font-size:16px;">unfold_more</span> Buka Semua
            </button>
            <button type="button" class="btn-secondary" style="font-size:12.5px;padding:7px 12px;" x-on:click="toggleAll(false)">
                <span class="material-icons-round" style="font-size:16px;">unfold_less</span> Tutup Semua
            </button>
        </div>
    </div>

    {{-- Category Cards with Nested Child Programs --}}
    @forelse($categories as $cat)
    <div class="cat-card"
         x-show="matchesSearch('{{ strtolower(addslashes($cat->category_name . ' ' . $cat->subtitle . ' ' . $cat->programs->pluck('title')->implode(' '))) }}')"
         x-transition>
        
        {{-- Category Header --}}
        <div class="cat-header">
            <div style="display:flex;align-items:center;gap:12px;">
                <span class="cat-badge-id">#{{ $cat->display_order ?: $cat->id }}</span>
                <div style="width:38px;height:38px;border-radius:10px;background:#e0e7ff;color:#3730a3;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span class="material-icons-round" style="font-size:22px;">folder_special</span>
                </div>
                <div>
                    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                        <h3 style="margin:0;font-size:16.5px;font-weight:800;color:#0F2440;">{{ $cat->category_name }}</h3>
                        @if($cat->is_active)
                            <span class="badge-pill badge-pill-green"><span class="material-icons-round" style="font-size:13px;">check</span> Aktif</span>
                        @else
                            <span class="badge-pill badge-pill-gray">Non-Aktif</span>
                        @endif
                        <span class="badge-pill badge-pill-blue">
                            <span class="stat-badge-count">{{ $cat->programs->count() }}</span>
                            Anak Program
                        </span>
                    </div>
                    @if($cat->subtitle)
                        <div style="font-size:13px;color:#64748b;margin-top:2px;">{{ $cat->subtitle }}</div>
                    @endif
                </div>
            </div>

            {{-- Category Action Buttons --}}
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                <button type="button" class="btn-primary" style="font-size:12px;padding:6px 12px;box-shadow:none;"
                        x-on:click="openAddProgramModal({{ $cat->id }}, '{{ addslashes($cat->category_name) }}')">
                    <span class="material-icons-round" style="font-size:16px;">add</span>
                    <span>Tambah Anak Program</span>
                </button>
                <button type="button" class="btn-secondary" style="font-size:12px;padding:6px 11px;"
                        x-on:click="openEditCatModal({{ json_encode($cat) }})">
                    <span class="material-icons-round" style="font-size:16px;color:#475569;">edit</span>
                    <span>Edit Kategori</span>
                </button>
                <button type="button" class="btn-danger" style="font-size:12px;padding:6px 10px;"
                        x-on:click="openDeleteCatModal({{ $cat->id }}, '{{ addslashes($cat->category_name) }}', {{ $cat->programs->count() }})">
                    <span class="material-icons-round" style="font-size:16px;">delete</span>
                </button>
                <button type="button" class="btn-icon" style="background:#fff;border:1px solid #cbd5e1;border-radius:8px;width:32px;height:32px;"
                        x-on:click="collapsed[{{ $cat->id }}] = !collapsed[{{ $cat->id }}]"
                        :title="collapsed[{{ $cat->id }}] ? 'Buka daftar anak program' : 'Tutup daftar anak program'">
                    <span class="material-icons-round" style="font-size:18px;color:#64748b;transition:transform .2s;"
                          :style="collapsed[{{ $cat->id }}] ? 'transform:rotate(-90deg)' : ''">expand_more</span>
                </button>
            </div>
        </div>

        {{-- Category Optional Meta Info (Description & Careers) --}}
        @if($cat->description || $cat->career_opportunities)
        <div style="padding:10px 22px;background:#fafbfc;border-bottom:1px solid #f1f5f9;font-size:12.5px;color:#64748b;display:flex;gap:18px;flex-wrap:wrap;">
            @if($cat->description)
                <div style="flex:1;min-width:240px;">
                    <strong style="color:#334155;">Deskripsi:</strong> {{ Str::limit($cat->description, 120) }}
                </div>
            @endif
            @if($cat->career_opportunities)
                <div style="flex:1;min-width:240px;">
                    <strong style="color:#334155;">Peluang Karir:</strong> {{ Str::limit($cat->career_opportunities, 100) }}
                </div>
            @endif
        </div>
        @endif

        {{-- Child Programs Table ("Anak-anak dari program itu") --}}
        <div x-show="!collapsed[{{ $cat->id }}]" x-transition>
            @if($cat->programs->count() > 0)
            <div style="overflow-x:auto;">
                <table class="prog-table">
                    <thead>
                        <tr>
                            <th style="width:45px;">#</th>
                            <th>Nama Anak Program / Jurusan</th>
                            <th style="width:130px;">Durasi</th>
                            <th style="width:140px;">Negara / Badge</th>
                            <th style="width:160px;">Biaya Pendidikan</th>
                            <th style="width:100px;">Status</th>
                            <th style="width:180px;text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cat->programs as $progIndex => $prog)
                        <tr>
                            <td style="color:#94a3b8;font-weight:700;font-size:12px;">
                                #{{ $prog->display_order ?: ($progIndex + 1) }}
                            </td>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div style="width:32px;height:32px;border-radius:8px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                        <span class="material-icons-round" style="font-size:18px;">school</span>
                                    </div>
                                    <div>
                                        <div style="font-weight:700;color:#0F2440;font-size:13.5px;">{{ $prog->title }}</div>
                                        <div style="font-size:11.5px;color:#64748b;margin-top:1px;">
                                            Slug: <code style="font-size:11px;background:#f1f5f9;padding:1px 5px;border-radius:4px;color:#334155;">{{ $prog->slug }}</code>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($prog->duration)
                                    <span class="badge-pill badge-pill-blue">
                                        <span class="material-icons-round" style="font-size:13px;">schedule</span>
                                        {{ $prog->duration }}
                                    </span>
                                @else
                                    <span style="color:#94a3b8;font-size:12px;">-</span>
                                @endif
                            </td>
                            <td>
                                @if($prog->country_badge)
                                    <span class="badge-pill badge-pill-amber">
                                        <span class="material-icons-round" style="font-size:13px;">place</span>
                                        {{ $prog->country_badge }}
                                    </span>
                                @else
                                    <span style="color:#94a3b8;font-size:12px;">-</span>
                                @endif
                            </td>
                            <td>
                                @if($prog->tuition_fee)
                                    <div style="font-weight:800;color:#059669;font-size:13px;">
                                        Rp {{ number_format($prog->tuition_fee, 0, ',', '.') }}
                                    </div>
                                    <div style="font-size:11px;color:#64748b;">Biaya Resmi</div>
                                @else
                                    <span class="badge-pill badge-pill-gray" style="font-size:11px;">Belum diatur</span>
                                @endif
                            </td>
                            <td>
                                @if($prog->is_active)
                                    <span class="badge-pill badge-pill-green">Aktif</span>
                                @else
                                    <span class="badge-pill badge-pill-gray">Non-Aktif</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <div style="display:inline-flex;align-items:center;gap:6px;">
                                    <button type="button" class="btn-secondary" style="font-size:11.5px;padding:5px 9px;"
                                            x-on:click="openEditProgramModal({{ json_encode($prog) }})" title="Edit Anak Program">
                                        <span class="material-icons-round" style="font-size:15px;color:#2563eb;">edit</span>
                                        <span>Edit</span>
                                    </button>
                                    <a href="/backoffice/program-tarif" class="btn-secondary" style="font-size:11.5px;padding:5px 8px;" title="Atur Tarif Biaya">
                                        <span class="material-icons-round" style="font-size:15px;color:#059669;">price_change</span>
                                    </a>
                                    <button type="button" class="btn-danger" style="font-size:11.5px;padding:5px 8px;"
                                            x-on:click="openDeleteProgramModal({{ $prog->id }}, '{{ addslashes($prog->title) }}')" title="Hapus Anak Program">
                                        <span class="material-icons-round" style="font-size:15px;">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div style="padding:32px 20px;text-align:center;background:#fff;">
                <div style="width:48px;height:48px;border-radius:50%;background:#f1f5f9;color:#94a3b8;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
                    <span class="material-icons-round" style="font-size:24px;">school</span>
                </div>
                <div style="font-size:14px;font-weight:700;color:#475569;">Belum ada anak program di kategori ini</div>
                <div style="font-size:12.5px;color:#94a3b8;margin-top:3px;margin-bottom:14px;">
                    Tambahkan jurusan atau kursus spesialisasi yang merupakan anak dari kategori <strong>{{ $cat->category_name }}</strong>.
                </div>
                <button type="button" class="btn-primary" style="font-size:12px;padding:7px 14px;"
                        x-on:click="openAddProgramModal({{ $cat->id }}, '{{ addslashes($cat->category_name) }}')">
                    <span class="material-icons-round" style="font-size:16px;">add</span>
                    Tambah Anak Program Sekarang
                </button>
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="bo-card" style="padding:48px 24px;text-align:center;border-radius:16px;border:1px dashed #cbd5e1;">
        <div style="width:64px;height:64px;border-radius:50%;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
            <span class="material-icons-round" style="font-size:32px;">create_new_folder</span>
        </div>
        <h3 style="margin:0 0 8px;font-size:18px;color:#0F2440;">Belum Ada Kategori Program</h3>
        <p style="font-size:14px;color:#64748b;max-width:440px;margin:0 auto 20px;">
            Buat kategori program perdana untuk mengelompokkan jurusan, kursus, dan program pelatihan di DHS.
        </p>
        <button type="button" class="btn-primary" style="padding:10px 22px;font-size:13.5px;" x-on:click="openAddCatModal()">
            <span class="material-icons-round" style="font-size:18px;">add_circle</span>
            Tambah Kategori Program Perdana
        </button>
    </div>
    @endforelse

    {{-- MODAL 1: Tambah Kategori Baru --}}
    <div class="bo-modal-backdrop" x-show="showAddCatModal" x-transition style="display:none;" @keydown.escape.window="showAddCatModal = false">
        <div class="bo-modal-box" @click.stop>
            <div style="padding:20px 24px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:36px;height:36px;border-radius:9px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;">
                        <span class="material-icons-round" style="font-size:20px;">create_new_folder</span>
                    </div>
                    <div>
                        <h3 style="margin:0;font-size:16px;font-weight:800;color:#0F2440;">Tambah Kategori Program Baru</h3>
                        <div style="font-size:12px;color:#64748b;">Buat kelompok/induk program akademi baru DHS</div>
                    </div>
                </div>
                <button type="button" class="btn-icon" x-on:click="showAddCatModal = false">
                    <span class="material-icons-round">close</span>
                </button>
            </div>

            <form action="/backoffice/program-kategori/store" method="POST">
                @csrf
                <div style="padding:20px 24px;display:flex;flex-direction:column;gap:14px;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Nama Kategori Program <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="category_name" class="bo-input" placeholder="Contoh: Program Vokasi 3 Tahun / Kapal Pesiar Eksekutif" required autofocus>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Subjudul Kategori</label>
                        <input type="text" name="subtitle" class="bo-input" placeholder="Contoh: Program Keahlian Perhotelan Tingkat Mahir">
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Deskripsi Kategori</label>
                        <textarea name="description" class="bo-textarea" rows="3" placeholder="Deskripsi ringkas mengenai kategori program ini..."></textarea>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Peluang Karir Lulusan</label>
                        <input type="text" name="career_opportunities" class="bo-input" placeholder="Contoh: Hotel Manager, F&B Supervisor, Executive Chef">
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Urutan Tampilan</label>
                            <input type="number" name="display_order" class="bo-input" value="{{ $totalCategories + 1 }}" min="1">
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Status Kategori</label>
                            <label style="display:flex;align-items:center;gap:8px;font-size:13px;font-weight:600;margin-top:8px;cursor:pointer;">
                                <input type="checkbox" name="is_active" value="1" checked style="width:17px;height:17px;accent-color:#2563eb;">
                                Aktif &amp; Tampilkan
                            </label>
                        </div>
                    </div>

                    {{-- Opsional Buat Anak Program Perdana --}}
                    <div style="background:#f8fafc;border:1px dashed #cbd5e1;border-radius:12px;padding:14px;margin-top:4px;">
                        <div style="font-weight:700;font-size:12.5px;color:#1e3a8a;display:flex;align-items:center;gap:6px;margin-bottom:6px;">
                            <span class="material-icons-round" style="font-size:16px;">school</span>
                            Langsung Buat 1 Anak Program Perdana (Opsional)
                        </div>
                        <input type="text" name="initial_program_title" class="bo-input" style="background:#fff;" placeholder="Contoh: Food & Beverage Division (Biarkan kosong jika nanti)">
                    </div>
                </div>

                <div style="padding:14px 24px;background:#f8fafc;border-top:1px solid #e2e8f0;display:flex;justify-content:flex-end;gap:10px;border-radius:0 0 18px 18px;">
                    <button type="button" class="btn-secondary" x-on:click="showAddCatModal = false">Batal</button>
                    <button type="submit" class="btn-primary">
                        <span class="material-icons-round" style="font-size:18px;">save</span>
                        Simpan Kategori Baru
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL 2: Edit Kategori --}}
    <div class="bo-modal-backdrop" x-show="showEditCatModal" x-transition style="display:none;" @keydown.escape.window="showEditCatModal = false">
        <div class="bo-modal-box" @click.stop>
            <div style="padding:20px 24px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:36px;height:36px;border-radius:9px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;">
                        <span class="material-icons-round" style="font-size:20px;">edit</span>
                    </div>
                    <div>
                        <h3 style="margin:0;font-size:16px;font-weight:800;color:#0F2440;">Edit Kategori Program</h3>
                        <div style="font-size:12px;color:#64748b;" x-text="editCat.category_name"></div>
                    </div>
                </div>
                <button type="button" class="btn-icon" x-on:click="showEditCatModal = false">
                    <span class="material-icons-round">close</span>
                </button>
            </div>

            <form :action="'/backoffice/program-kategori/' + editCat.id + '/update'" method="POST">
                @csrf
                <div style="padding:20px 24px;display:flex;flex-direction:column;gap:14px;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Nama Kategori Program <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="category_name" class="bo-input" x-model="editCat.category_name" required>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Subjudul Kategori</label>
                        <input type="text" name="subtitle" class="bo-input" x-model="editCat.subtitle">
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Deskripsi Kategori</label>
                        <textarea name="description" class="bo-textarea" rows="3" x-model="editCat.description"></textarea>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Peluang Karir Lulusan</label>
                        <input type="text" name="career_opportunities" class="bo-input" x-model="editCat.career_opportunities">
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Urutan Tampilan</label>
                            <input type="number" name="display_order" class="bo-input" x-model="editCat.display_order" min="1">
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Status Kategori</label>
                            <label style="display:flex;align-items:center;gap:8px;font-size:13px;font-weight:600;margin-top:8px;cursor:pointer;">
                                <input type="checkbox" name="is_active" value="1" :checked="editCat.is_active" style="width:17px;height:17px;accent-color:#2563eb;">
                                Aktif &amp; Tampilkan
                            </label>
                        </div>
                    </div>
                </div>

                <div style="padding:14px 24px;background:#f8fafc;border-top:1px solid #e2e8f0;display:flex;justify-content:flex-end;gap:10px;border-radius:0 0 18px 18px;">
                    <button type="button" class="btn-secondary" x-on:click="showEditCatModal = false">Batal</button>
                    <button type="submit" class="btn-primary">
                        <span class="material-icons-round" style="font-size:18px;">save</span>
                        Simpan Perubahan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL 3: Tambah Anak Program --}}
    <div class="bo-modal-backdrop" x-show="showAddProgModal" x-transition style="display:none;" @keydown.escape.window="showAddProgModal = false">
        <div class="bo-modal-box" @click.stop>
            <div style="padding:20px 24px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:36px;height:36px;border-radius:9px;background:#f0fdf4;color:#16a34a;display:flex;align-items:center;justify-content:center;">
                        <span class="material-icons-round" style="font-size:20px;">school</span>
                    </div>
                    <div>
                        <h3 style="margin:0;font-size:16px;font-weight:800;color:#0F2440;">Tambah Anak Program Baru</h3>
                        <div style="font-size:12px;color:#64748b;">Tambahkan jurusan/spesialisasi ke dalam kategori program</div>
                    </div>
                </div>
                <button type="button" class="btn-icon" x-on:click="showAddProgModal = false">
                    <span class="material-icons-round">close</span>
                </button>
            </div>

            <form action="/backoffice/program-kategori/item/store" method="POST">
                @csrf
                <div style="padding:20px 24px;display:flex;flex-direction:column;gap:14px;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Pilih Kategori Induk <span style="color:#ef4444;">*</span></label>
                        <select name="category_id" class="bo-input" x-model="newProgCatId" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Nama Anak Program / Jurusan <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="title" class="bo-input" placeholder="Contoh: Ausbildung Perhotelan & Restoran" required>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Durasi Waktu</label>
                            <input type="text" name="duration" class="bo-input" placeholder="Contoh: 1 Tahun, 6 Bulan, 3 Tahun">
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Badge Negara / Spesialisasi</label>
                            <input type="text" name="country_badge" class="bo-input" placeholder="Contoh: Jerman, Kapal Pesiar, Australia">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Biaya Pendidikan Resmi (Rp)</label>
                        <div style="position:relative;display:flex;align-items:center;">
                            <span style="position:absolute;left:12px;font-size:13px;font-weight:700;color:#94a3b8;pointer-events:none;">Rp</span>
                            <input type="text" name="tuition_fee" class="bo-input" placeholder="0 (Kosongkan jika belum ditentukan)"
                                   x-on:input="formatRupiahInput($event)" style="padding-left:38px !important;font-weight:700;">
                        </div>
                        <div style="font-size:11.5px;color:#64748b;margin-top:3px;">
                            Biaya ini akan tersimpan dan otomatis menjadi rujukan pada form pendaftaran dan keuangan program.
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Deskripsi Singkat (Opsional)</label>
                        <textarea name="description" class="bo-textarea" rows="2" placeholder="Ringkasan singkat mengenai kompetensi atau tujuan anak program ini..."></textarea>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Urutan Tampilan</label>
                            <input type="number" name="display_order" class="bo-input" value="1" min="1">
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Status Program</label>
                            <label style="display:flex;align-items:center;gap:8px;font-size:13px;font-weight:600;margin-top:8px;cursor:pointer;">
                                <input type="checkbox" name="is_active" value="1" checked style="width:17px;height:17px;accent-color:#16a34a;">
                                Aktif &amp; Siap Dipilih
                            </label>
                        </div>
                    </div>
                </div>

                <div style="padding:14px 24px;background:#f8fafc;border-top:1px solid #e2e8f0;display:flex;justify-content:flex-end;gap:10px;border-radius:0 0 18px 18px;">
                    <button type="button" class="btn-secondary" x-on:click="showAddProgModal = false">Batal</button>
                    <button type="submit" class="btn-primary" style="background:#16a34a;">
                        <span class="material-icons-round" style="font-size:18px;">save</span>
                        Simpan Anak Program
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL 4: Edit Anak Program --}}
    <div class="bo-modal-backdrop" x-show="showEditProgModal" x-transition style="display:none;" @keydown.escape.window="showEditProgModal = false">
        <div class="bo-modal-box" @click.stop>
            <div style="padding:20px 24px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:36px;height:36px;border-radius:9px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;">
                        <span class="material-icons-round" style="font-size:20px;">edit</span>
                    </div>
                    <div>
                        <h3 style="margin:0;font-size:16px;font-weight:800;color:#0F2440;">Edit Anak Program</h3>
                        <div style="font-size:12px;color:#64748b;" x-text="editProg.title"></div>
                    </div>
                </div>
                <button type="button" class="btn-icon" x-on:click="showEditProgModal = false">
                    <span class="material-icons-round">close</span>
                </button>
            </div>

            <form :action="'/backoffice/program-kategori/item/' + editProg.id + '/update'" method="POST">
                @csrf
                <div style="padding:20px 24px;display:flex;flex-direction:column;gap:14px;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Pindah / Ubah Kategori Induk <span style="color:#ef4444;">*</span></label>
                        <select name="category_id" class="bo-input" x-model="editProg.category_id" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Nama Anak Program / Jurusan <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="title" class="bo-input" x-model="editProg.title" required>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Durasi Waktu</label>
                            <input type="text" name="duration" class="bo-input" x-model="editProg.duration">
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Badge Negara / Spesialisasi</label>
                            <input type="text" name="country_badge" class="bo-input" x-model="editProg.country_badge">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Biaya Pendidikan Resmi (Rp)</label>
                        <div style="position:relative;display:flex;align-items:center;">
                            <span style="position:absolute;left:12px;font-size:13px;font-weight:700;color:#94a3b8;pointer-events:none;">Rp</span>
                            <input type="text" name="tuition_fee" class="bo-input" x-model="editProg.tuition_fee_formatted"
                                   x-on:input="formatRupiahInput($event)" style="padding-left:38px !important;font-weight:700;">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Deskripsi Singkat (Opsional)</label>
                        <textarea name="description" class="bo-textarea" rows="2" x-model="editProg.description"></textarea>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Urutan Tampilan</label>
                            <input type="number" name="display_order" class="bo-input" x-model="editProg.display_order" min="1">
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Status Program</label>
                            <label style="display:flex;align-items:center;gap:8px;font-size:13px;font-weight:600;margin-top:8px;cursor:pointer;">
                                <input type="checkbox" name="is_active" value="1" :checked="editProg.is_active" style="width:17px;height:17px;accent-color:#2563eb;">
                                Aktif &amp; Siap Dipilih
                            </label>
                        </div>
                    </div>
                </div>

                <div style="padding:14px 24px;background:#f8fafc;border-top:1px solid #e2e8f0;display:flex;justify-content:flex-end;gap:10px;border-radius:0 0 18px 18px;">
                    <button type="button" class="btn-secondary" x-on:click="showEditProgModal = false">Batal</button>
                    <button type="submit" class="btn-primary">
                        <span class="material-icons-round" style="font-size:18px;">save</span>
                        Simpan Perubahan Anak Program
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL 5: Konfirmasi Hapus Kategori --}}
    <div class="bo-modal-backdrop" x-show="showDeleteCatModal" x-transition style="display:none;" @keydown.escape.window="showDeleteCatModal = false">
        <div class="bo-modal-box" style="max-width:440px;" @click.stop>
            <div style="padding:28px 24px 20px;text-align:center;">
                <div style="width:56px;height:56px;border-radius:50%;background:#fee2e2;color:#dc2626;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <span class="material-icons-round" style="font-size:30px;">warning</span>
                </div>
                <h3 style="margin:0 0 8px;font-size:17px;color:#0F2440;">Hapus Kategori Program?</h3>
                <p style="font-size:13.5px;color:#64748b;margin:0 0 14px;line-height:1.5;">
                    Anda yakin ingin menghapus kategori <strong style="color:#0F2440;" x-text="deleteCatTarget.name"></strong>?
                </p>
                <template x-if="deleteCatTarget.childCount > 0">
                    <div style="padding:10px 14px;background:#fef2f2;border:1px solid #fecaca;border-radius:10px;font-size:12px;color:#991b1b;margin-bottom:16px;text-align:left;">
                        <strong>Perhatian:</strong> Kategori ini memiliki <span x-text="deleteCatTarget.childCount"></span> anak program. Seluruh anak program di dalamnya juga akan terhapus.
                    </div>
                </template>
            </div>

            <form :action="'/backoffice/program-kategori/' + deleteCatTarget.id + '/delete'" method="POST">
                @csrf
                <div style="padding:14px 24px;background:#f8fafc;border-top:1px solid #e2e8f0;display:flex;justify-content:center;gap:12px;border-radius:0 0 18px 18px;">
                    <button type="button" class="btn-secondary" x-on:click="showDeleteCatModal = false">Batal</button>
                    <button type="submit" class="btn-danger">
                        <span class="material-icons-round" style="font-size:17px;">delete_forever</span>
                        Ya, Hapus Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL 6: Konfirmasi Hapus Anak Program --}}
    <div class="bo-modal-backdrop" x-show="showDeleteProgModal" x-transition style="display:none;" @keydown.escape.window="showDeleteProgModal = false">
        <div class="bo-modal-box" style="max-width:440px;" @click.stop>
            <div style="padding:28px 24px 20px;text-align:center;">
                <div style="width:56px;height:56px;border-radius:50%;background:#fee2e2;color:#dc2626;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <span class="material-icons-round" style="font-size:30px;">delete_sweep</span>
                </div>
                <h3 style="margin:0 0 8px;font-size:17px;color:#0F2440;">Hapus Anak Program?</h3>
                <p style="font-size:13.5px;color:#64748b;margin:0 0 14px;line-height:1.5;">
                    Anda yakin ingin menghapus anak program <strong style="color:#0F2440;" x-text="deleteProgTarget.title"></strong>?
                </p>
                <div style="font-size:12px;color:#94a3b8;">
                    Tindakan ini tidak dapat dibatalkan.
                </div>
            </div>

            <form :action="'/backoffice/program-kategori/item/' + deleteProgTarget.id + '/delete'" method="POST">
                @csrf
                <div style="padding:14px 24px;background:#f8fafc;border-top:1px solid #e2e8f0;display:flex;justify-content:center;gap:12px;border-radius:0 0 18px 18px;">
                    <button type="button" class="btn-secondary" x-on:click="showDeleteProgModal = false">Batal</button>
                    <button type="submit" class="btn-danger">
                        <span class="material-icons-round" style="font-size:17px;">delete_forever</span>
                        Ya, Hapus Program
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function programKategoriManager() {
    return {
        searchQuery: '',
        collapsed: {},

        // Modals state
        showAddCatModal: false,
        showEditCatModal: false,
        showAddProgModal: false,
        showEditProgModal: false,
        showDeleteCatModal: false,
        showDeleteProgModal: false,

        // Data targets
        newProgCatId: {{ $categories->first()?->id ?? 'null' }},
        editCat: {
            id: null,
            category_name: '',
            subtitle: '',
            description: '',
            career_opportunities: '',
            display_order: 1,
            is_active: 1
        },
        editProg: {
            id: null,
            category_id: null,
            title: '',
            duration: '',
            country_badge: '',
            tuition_fee: null,
            tuition_fee_formatted: '',
            description: '',
            display_order: 1,
            is_active: 1
        },
        deleteCatTarget: {
            id: null,
            name: '',
            childCount: 0
        },
        deleteProgTarget: {
            id: null,
            title: ''
        },

        matchesSearch(text) {
            if (!this.searchQuery || this.searchQuery.trim() === '') return true;
            return text.toLowerCase().includes(this.searchQuery.toLowerCase().trim());
        },

        toggleAll(open) {
            @foreach($categories as $cat)
                this.collapsed[{{ $cat->id }}] = !open;
            @endforeach
        },

        openAddCatModal() {
            this.showAddCatModal = true;
        },

        openEditCatModal(cat) {
            this.editCat = {
                id: cat.id,
                category_name: cat.category_name || '',
                subtitle: cat.subtitle || '',
                description: cat.description || '',
                career_opportunities: cat.career_opportunities || '',
                display_order: cat.display_order || 1,
                is_active: cat.is_active ? 1 : 0
            };
            this.showEditCatModal = true;
        },

        openAddProgramModal(catId, catName) {
            if (catId) {
                this.newProgCatId = catId;
            }
            this.showAddProgModal = true;
        },

        openEditProgramModal(prog) {
            let feeFormatted = '';
            if (prog.tuition_fee !== null && prog.tuition_fee !== undefined && prog.tuition_fee !== '') {
                feeFormatted = new Intl.NumberFormat('id-ID').format(prog.tuition_fee);
            }
            this.editProg = {
                id: prog.id,
                category_id: prog.category_id,
                title: prog.title || '',
                duration: prog.duration || '',
                country_badge: prog.country_badge || '',
                tuition_fee: prog.tuition_fee,
                tuition_fee_formatted: feeFormatted,
                description: prog.description || '',
                display_order: prog.display_order || 1,
                is_active: prog.is_active ? 1 : 0
            };
            this.showEditProgModal = true;
        },

        openDeleteCatModal(id, name, count) {
            this.deleteCatTarget = {
                id: id,
                name: name,
                childCount: count
            };
            this.showDeleteCatModal = true;
        },

        openDeleteProgramModal(id, title) {
            this.deleteProgTarget = {
                id: id,
                title: title
            };
            this.showDeleteProgModal = true;
        },

        formatRupiahInput(e) {
            let val = e.target.value.replace(/\D/g, '');
            if (!val) {
                e.target.value = '';
                return;
            }
            e.target.value = new Intl.NumberFormat('id-ID').format(val);
        }
    };
}
</script>
@endpush
