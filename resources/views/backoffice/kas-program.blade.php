@extends('backoffice.layouts.app')

@section('title', 'Keuangan Program: ' . $kategori->category_name)
@section('page-title', 'Keuangan Program: ' . $kategori->category_name)

@php
    $optMasukList  = !empty($optMasuk) ? array_values(array_unique($optMasuk)) : [];
    $optKeluarList = !empty($optKeluar) ? array_values(array_unique($optKeluar)) : [];
    $unitsData     = $units ?? ['Orang', 'Unit', 'Hari', 'Paket', 'Jam', 'Bulan', 'Pcs', 'Sesi', 'Semester', 'Lot', 'Set'];
    $firstProgId   = $programs->first() ? $programs->first()->id : '';
@endphp

@push('styles')
<style>
    .prog-pill-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 15px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        user-select: none;
        border: 1.5px solid #e2e8f0;
        background: #ffffff;
        color: #334155;
        font-family: 'Inter', sans-serif;
    }
    .prog-pill-btn:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
    }
    .prog-pill-btn.is-active {
        background: linear-gradient(135deg, #0F2440 0%, #1A365D 100%);
        color: #ffffff;
        border-color: #0F2440;
        box-shadow: 0 4px 14px rgba(15, 36, 64, 0.25);
        transform: translateY(-1px);
    }
    .prog-pill-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 22px;
        height: 22px;
        padding: 0 7px;
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: -0.02em;
        margin-left: 6px;
        transition: all 0.2s;
    }
    .prog-pill-btn.is-active .prog-pill-badge {
        background: rgba(255, 255, 255, 0.22);
        color: #ffffff;
    }
    .prog-pill-btn:not(.is-active) .prog-pill-badge {
        background: #f1f5f9;
        color: #475569;
    }
    .prog-pill-btn:not(.is-active):hover .prog-pill-badge {
        background: #e2e8f0;
        color: #1e293b;
    }
    .prog-pill-badge.is-zero {
        opacity: 0.55;
    }
</style>
@endpush

@section('content')
<div x-data="kasProgramData()" x-init="init()">

    {{-- Flash --}}
    @if(session('success'))
    <div class="bo-card" style="border-left:4px solid #22c55e;margin-bottom:1rem;padding:.85rem 1.15rem;color:#166534;background:#f0fdf4;display:flex;align-items:center;gap:8px;font-weight:600;">
        <span class="material-icons-round" style="font-size:20px;">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Top Bar --}}
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:1rem;">
        <a href="/backoffice/kas" class="btn-secondary" style="font-size:13px;padding:8px 14px;">
            <span class="material-icons-round" style="font-size:17px;">arrow_back</span>
            Kembali ke Keuangan Umum
        </a>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="/backoffice/kas-keuangan-program" class="btn-secondary" style="font-size:13px;padding:8px 14px;">
                <span class="material-icons-round" style="font-size:17px;">folder_open</span>
                Semua Kategori
            </a>
            <button type="button" class="btn-primary" x-on:click="openModal('add', null)">
                <span class="material-icons-round" style="font-size:18px;">add</span>
                Tambah Transaksi
            </button>
        </div>
    </div>

    {{-- Tab navigasi antar kategori --}}
    <div style="overflow-x:auto;margin-bottom:1rem;padding-bottom:4px;">
        <div style="display:flex;gap:.45rem;min-width:max-content;">
            @foreach($allKategori as $kat)
                <a href="/backoffice/kas-kategori-kas/{{ $kat->id }}"
                   style="padding:7px 14px;border-radius:9px;font-size:.82rem;font-weight:600;text-decoration:none;white-space:nowrap;border:1.5px solid {{ $kat->id == $kategori->id ? '#1A365D' : '#e2e8f0' }};background:{{ $kat->id == $kategori->id ? '#1A365D' : '#fff' }};color:{{ $kat->id == $kategori->id ? '#fff' : '#334155' }};">
                    {{ $kat->category_name }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Summary Cards: Pemasukan, Pengeluaran, Piutang, Selisih --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:14px;margin-bottom:1.5rem;">
        
        {{-- 1. Pemasukan --}}
        <div class="bo-card" style="padding:18px 20px;border-left:4px solid #16a34a;border-radius:14px;">
            <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:6px;">Pemasukan</div>
            <div style="font-size:20px;font-weight:800;color:#15803d;" x-text="'Rp ' + formatNumber(summaryFiltered.masuk)"></div>
            <div style="font-size:11.5px;color:#64748b;margin-top:4px;" x-text="summaryFiltered.countMasuk + ' transaksi terealisasi'"></div>
        </div>

        {{-- 2. Pengeluaran --}}
        <div class="bo-card" style="padding:18px 20px;border-left:4px solid #dc2626;border-radius:14px;">
            <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:6px;">Pengeluaran</div>
            <div style="font-size:20px;font-weight:800;color:#b91c1c;" x-text="'Rp ' + formatNumber(summaryFiltered.keluar)"></div>
            <div style="font-size:11.5px;color:#64748b;margin-top:4px;" x-text="summaryFiltered.countKeluar + ' item pengeluaran'"></div>
        </div>

        {{-- 3. Piutang (Uang di Lapangan) --}}
        <button type="button"
                x-on:click="filterStatus = (filterStatus === 'piutang' ? '' : 'piutang')"
                class="bo-card"
                style="padding:18px 20px;border:none;border-left:4px solid #f59e0b;border-radius:14px;text-align:left;cursor:pointer;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;gap:6px;">
                <span style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;">Piutang</span>
                <span style="font-size:10.5px;font-weight:700;padding:2px 7px;border-radius:99px;background:#fef3c7;color:#b45309;">Uang Lapangan</span>
            </div>
            <div style="font-size:20px;font-weight:800;color:#b45309;">Rp {{ number_format($totalPiutang ?? 0, 0, ',', '.') }}</div>
            <div style="font-size:11px;color:#92400e;margin-top:3px;" x-text="filterStatus === 'piutang' ? 'Filter Piutang aktif (klik reset)' : 'Klik untuk saring transaksi piutang'"></div>
        </button>

        {{-- 4. Selisih (Saldo) --}}
        <div class="bo-card" style="padding:18px 20px;border-left:4px solid #2563eb;border-radius:14px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                <span style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;">Selisih</span>
                <span style="font-size:10.5px;font-weight:700;padding:2px 7px;border-radius:99px;background:#dbeafe;color:#1d4ed8;" x-text="summaryFiltered.persen.toFixed(1) + '%'"></span>
            </div>
            <div style="font-size:20px;font-weight:800;"
                 :style="summaryFiltered.saldo >= 0 ? 'color:#1d4ed8;' : 'color:#dc2626;'"
                 x-text="(summaryFiltered.saldo < 0 ? '- Rp ' : 'Rp ') + formatNumber(summaryFiltered.saldo)"></div>
            <div style="font-size:11.5px;color:#64748b;margin-top:4px;" x-text="'Margin filter ' + summaryFiltered.persen.toFixed(1) + '%'"></div>
        </div>

    </div>

    {{-- Program Selector Pills dalam Kategori Ini --}}
    @if($programs->count() > 0)
    <div class="bo-card" style="margin-bottom:1.25rem;padding:18px 22px;border:1px solid #e2e8f0;border-radius:16px;background:#ffffff;box-shadow:0 2px 10px rgba(15,23,42,0.03);">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:14px;">
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:36px;height:36px;border-radius:10px;background:#eff6ff;color:#1A365D;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span class="material-icons-round" style="font-size:20px;">school</span>
                </div>
                <div>
                    <div style="font-size:13.5px;font-weight:800;color:#0f172a;letter-spacing:-0.01em;">
                        Program dalam Kategori: <span style="color:#1A365D;">{{ $kategori->category_name }}</span>
                    </div>
                    <div style="font-size:12px;color:#64748b;margin-top:2px;">
                        Klik program untuk memfilter transaksi secara spesifik, atau pilih Semua Program.
                    </div>
                </div>
            </div>

            <div x-show="filterRel" style="display:none;">
                <button type="button"
                        x-on:click="filterRel = ''"
                        style="display:inline-flex;align-items:center;gap:5px;padding:6px 13px;border-radius:9999px;font-size:12px;font-weight:700;color:#dc2626;background:#fef2f2;border:1px solid #fee2e2;cursor:pointer;transition:all 0.15s;"
                        onmouseover="this.style.background='#fee2e2'"
                        onmouseout="this.style.background='#fef2f2'">
                    <span class="material-icons-round" style="font-size:15px;">close</span>
                    <span>Reset Filter Program</span>
                </button>
            </div>
        </div>

        <div style="display:flex;flex-wrap:wrap;gap:9px;">
            {{-- Tombol Semua Program --}}
            <button type="button"
                    class="prog-pill-btn"
                    :class="filterRel === '' ? 'is-active' : ''"
                    x-on:click="filterRel = ''">
                <span class="material-icons-round" style="font-size:16px;">apps</span>
                <span>Semua Program</span>
                <span class="prog-pill-badge" x-text="items.length"></span>
            </button>

            {{-- Tombol per Program --}}
            @foreach($programs as $prog)
            <button type="button"
                    class="prog-pill-btn"
                    :class="filterRel === 'prog:{{ $prog->id }}' ? 'is-active' : ''"
                    x-on:click="filterRel = (filterRel === 'prog:{{ $prog->id }}' ? '' : 'prog:{{ $prog->id }}')">
                <span class="material-icons-round" style="font-size:16px;" :style="filterRel === 'prog:{{ $prog->id }}' ? 'color:#fff;' : 'color:#3b82f6;'">school</span>
                <span>{{ $prog->title }}</span>
                <span class="prog-pill-badge"
                      :class="items.filter(i => String(i.program_id) === '{{ $prog->id }}').length === 0 ? 'is-zero' : ''"
                      x-text="items.filter(i => String(i.program_id) === '{{ $prog->id }}').length"></span>
            </button>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Filter Bar (Foto 1 & Foto 2 + Sortir lengkap) --}}
    @include('backoffice.partials.kas-filter-bar', [
        'showProgramFilter' => true,
        'scopedPrograms'    => $programs
    ])

    {{-- Tabel --}}
    <div class="bo-card" style="padding:0;overflow:hidden;border:1px solid #e2e8f0;">
        <div style="overflow-x:auto;">
            <table class="bo-table kas-transaction-table" style="width:100%;min-width:1060px;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="width:125px;white-space:nowrap;">Kode</th>
                        <th style="width:95px;white-space:nowrap;">Tanggal</th>
                        <th style="width:90px;text-align:center;">Transaksi</th>
                        <th style="width:160px;">Program</th>
                        <th style="min-width:200px;">Judul / Penerima</th>
                        <th style="width:90px;text-align:center;">Vol &amp; Satuan</th>
                        <th style="width:115px;text-align:right;">Harga Satuan</th>
                        <th style="width:125px;text-align:right;">Nominal</th>
                        <th style="width:95px;">Metode</th>
                        <th style="width:80px;text-align:center;">Status</th>
                        <th style="width:60px;text-align:center;">Bukti</th>
                        <th style="width:95px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-if="filtered.length === 0">
                        <tr>
                            <td colspan="12" style="text-align:center;padding:2.5rem;color:#94a3b8;">
                                <span class="material-icons-round" style="font-size:40px;display:block;margin-bottom:.5rem;">inbox</span>
                                Tidak ada data transaksi ditemukan
                            </td>
                        </tr>
                    </template>
                    <template x-for="item in filtered" :key="item.id">
                        <tr style="height:50px;">
                            <td style="white-space:nowrap;font-size:11.5px;font-family:monospace;color:#64748b;font-weight:700;" x-text="item.kode || '-'"></td>
                            <td style="white-space:nowrap;font-size:12px;color:#475569;" x-text="formatTanggal(item.tanggal)"></td>
                            <td style="text-align:center;white-space:nowrap;">
                                <span class="badge"
                                      :class="window.DHSKasHelper.getTransactionType(item).badgeClass"
                                      x-text="window.DHSKasHelper.getTransactionType(item).label"></span>
                            </td>
                            <td style="max-width:160px;white-space:nowrap;">
                                <span style="font-weight:600;color:#334155;font-size:12px;display:block;overflow:hidden;text-overflow:ellipsis;"
                                      :title="item.program ? item.program.title : 'Umum'"
                                      x-text="item.program ? item.program.title : 'Umum'"></span>
                            </td>
                            <td style="max-width:240px;">
                                <div style="font-weight:700;color:#0f172a;font-size:12.5px;line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"
                                     :title="item.jenis"
                                     x-text="item.jenis"></div>
                                <div style="display:flex;align-items:center;gap:5px;margin-top:2px;font-size:11px;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                    <template x-if="item.piutang_nama">
                                        <span style="display:inline-flex;align-items:center;padding:1px 6px;border-radius:4px;font-size:10px;font-weight:700;flex-shrink:0;"
                                              :style="item.is_piutang && !item.piutang_lunas_at ? 'background:#fef3c7;color:#b45309;' : 'background:#f1f5f9;color:#475569;'"
                                              x-text="item.piutang_nama"></span>
                                    </template>
                                    <span style="overflow:hidden;text-overflow:ellipsis;" :title="item.deskripsi" x-text="item.deskripsi || '-'"></span>
                                </div>
                            </td>
                            <td style="text-align:center;white-space:nowrap;">
                                <span style="font-weight:600;color:#334155;font-size:12px;display:inline-block;padding:2px 8px;background:#f8fafc;border-radius:6px;border:1px solid #e2e8f0;"
                                      x-text="(parseFloat(item.volume) || 1) + ' ' + (item.satuan || 'Paket')"></span>
                            </td>
                            <td style="text-align:right;white-space:nowrap;color:#64748b;font-size:12px;" x-text="'Rp ' + formatNumber(item.harga_satuan || item.jumlah)"></td>
                            <td style="text-align:right;white-space:nowrap;font-weight:800;font-size:13px;">
                                <template x-if="item.is_piutang && !item.piutang_lunas_at">
                                    <span style="color:#b45309;" x-text="'Rp ' + formatNumber(item.jumlah)"></span>
                                </template>
                                <template x-if="!item.is_piutang || item.piutang_lunas_at">
                                    <span :style="item.type === 'masuk' ? 'color:#15803d;' : 'color:#b91c1c;'"
                                          x-text="(item.type === 'masuk' ? '+ Rp ' : '- Rp ') + formatNumber(item.jumlah)"></span>
                                </template>
                            </td>
                            <td style="white-space:nowrap;font-size:11.5px;color:#475569;">
                                <span x-text="item.metode_pembayaran || (item.payment_mode === 'dp' ? 'DP (Uang Muka)' : (item.type === 'masuk' ? 'Transfer Bank' : 'Kas Tunai'))"></span>
                            </td>
                            <td style="text-align:center;white-space:nowrap;">
                                <span class="badge"
                                      :class="window.DHSKasHelper.getTransactionStatus(item).badgeClass"
                                      x-text="window.DHSKasHelper.getTransactionStatus(item).label"></span>
                            </td>
                            <td style="text-align:center;white-space:nowrap;">
                                <template x-if="item.bukti_gambar && window.DHSKasHelper.isPdf(item.bukti_gambar)">
                                    <a :href="item.bukti_gambar" target="_blank" class="badge badge-red" style="text-decoration:none;">PDF</a>
                                </template>
                                <template x-if="item.bukti_gambar && !window.DHSKasHelper.isPdf(item.bukti_gambar)">
                                    <a :href="item.bukti_gambar" target="_blank">
                                        <img :src="item.bukti_gambar" style="width:32px;height:32px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;vertical-align:middle;">
                                    </a>
                                </template>
                                <template x-if="!item.bukti_gambar">
                                    <span style="color:#cbd5e1;">—</span>
                                </template>
                            </td>
                            <td style="text-align:center;white-space:nowrap;">
                                <div style="display:inline-flex;align-items:center;gap:4px;">
                                    <button type="button" class="btn-icon" title="Detail Transaksi" aria-label="Detail transaksi" x-on:click="detailModal.open = true; detailModal.item = item" style="position:relative;z-index:2;pointer-events:auto;">
                                        <span class="material-icons-round" style="font-size:18px;color:#0891b2;pointer-events:none;">visibility</span>
                                    </button>
                                    <button type="button" class="btn-icon" title="Edit" aria-label="Edit transaksi" x-on:click="openModal('edit', item)">
                                        <span class="material-icons-round" style="font-size:18px;color:#374151;">edit</span>
                                    </button>
                                    <button type="button" class="btn-icon danger" title="Hapus" aria-label="Hapus transaksi" x-on:click="deleteItem(item.id)">
                                        <span class="material-icons-round" style="font-size:18px;color:#ef4444;">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <div style="padding:12px 20px;font-size:12.5px;color:#64748b;border-top:1px solid #f1f5f9;" x-show="filtered.length > 0">
            Menampilkan <strong x-text="filtered.length"></strong> transaksi
        </div>
    </div>

    {{-- Modal Tambah/Edit (Format ChatGPT) --}}
    <div class="bo-modal-backdrop"
         x-show="modal.open"
         x-transition
         style="display:none;"
         x-on:click.self="modal.open = false"
         x-on:keydown.escape.window="modal.open = false">
        <div class="bo-modal wide" style="max-width:650px;width:95%;padding:26px 28px;" x-on:click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
                <h3 style="margin:0;font-size:1.15rem;font-weight:700;">
                    <span x-text="modal.mode === 'add' ? 'Tambah Transaksi' : 'Edit Transaksi'"></span>
                    — {{ $kategori->category_name }}
                </h3>
                <button type="button" class="btn-icon" x-on:click="modal.open = false">
                    <span class="material-icons-round">close</span>
                </button>
            </div>

            @include('backoffice.partials.kas-transaction-form', [
                'scope'              => 'modal.form',
                'actionExpr'         => "modal.mode === 'add' ? '/backoffice/kas/store' : '/backoffice/kas/' + modal.editId + '/update'",
                'programScopeMode'   => 'kategori',
                'scopedPrograms'     => $programs,
                'scopedCategoryName' => $kategori->category_name,
                'redirectValue'      => '/backoffice/kas-kategori-kas/' . $kategori->id,
                'submitText'         => 'Simpan Transaksi',
                'showCancel'         => true,
                'cancelAction'       => 'modal.open = false',
                'piutangCategories'  => $piutangCategories ?? [],
                'optProgramMasuk'    => $optProgramMasuk ?? $optMasukList,
                'optProgramKeluar'   => $optProgramKeluar ?? $optKeluarList,
            ])
        </div>
    </div>

    {{-- Modal Detail Transaksi --}}
    <div class="bo-modal-backdrop"
         x-show="detailModal.open"
         x-transition
         style="display:none;"
         x-on:click.self="detailModal.open = false"
         x-on:keydown.escape.window="detailModal.open = false">
        <div class="bo-modal" style="max-width:580px;width:95%;" x-on:click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;border-bottom:1px solid #f1f5f9;padding-bottom:.75rem;">
                <h3 style="margin:0;font-size:1.15rem;font-weight:700;">Detail Transaksi</h3>
                <button type="button" class="btn-icon" x-on:click="detailModal.open = false">
                    <span class="material-icons-round">close</span>
                </button>
            </div>
            <template x-if="detailModal.item">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;font-size:13px;">
                    <div style="background:#f8fafc;padding:10px;border-radius:8px;"><div style="color:#64748b;font-size:11px;">Tanggal</div><div style="font-weight:700;" x-text="formatTanggal(detailModal.item.tanggal)"></div></div>
                    <div style="background:#f8fafc;padding:10px;border-radius:8px;"><div style="color:#64748b;font-size:11px;">Kode</div><div style="font-weight:700;" x-text="detailModal.item.kode || '-' "></div></div>
                    <div style="background:#f8fafc;padding:10px;border-radius:8px;"><div style="color:#64748b;font-size:11px;">Kategori</div><div style="font-weight:700;" x-text="detailModal.item.jenis"></div></div>
                    <div style="background:#f8fafc;padding:10px;border-radius:8px;">
                        <div style="color:#64748b;font-size:11px;">Status Transaksi</div>
                        <div style="margin-top:2px;">
                            <span class="badge" :class="window.DHSKasHelper.getTransactionStatus(detailModal.item).badgeClass"
                                  x-text="window.DHSKasHelper.getTransactionStatus(detailModal.item).label"></span>
                        </div>
                        <template x-if="detailModal.item.is_piutang && !detailModal.item.piutang_lunas_at">
                            <div style="font-size:10.5px;color:#d97706;font-weight:600;margin-top:3px;">(Tagihan Piutang)</div>
                        </template>
                    </div>
                    <template x-if="detailModal.item.piutang_nama || detailModal.item.no_hp">
                        <div style="background:#f8fafc;padding:10px;border-radius:8px;">
                            <div style="color:#64748b;font-size:11px;">Kontak &amp; Siswa / Pembayar</div>
                            <div style="font-weight:700;color:#0f172a;" x-text="detailModal.item.piutang_nama || 'Pelanggan'"></div>
                            <template x-if="detailModal.item.no_hp">
                                <div style="font-size:12px;color:#16a34a;font-weight:700;margin-top:2px;display:flex;align-items:center;gap:4px;">
                                    <span class="material-icons-round" style="font-size:14px;">chat</span>
                                    <span x-text="detailModal.item.no_hp"></span>
                                </div>
                            </template>
                        </div>
                    </template>
                    <div style="background:#f8fafc;padding:10px;border-radius:8px;"><div style="color:#64748b;font-size:11px;">Volume / Satuan</div><div style="font-weight:700;" x-text="(parseFloat(detailModal.item.volume) || 1) + ' ' + (detailModal.item.satuan || 'Paket')"></div></div>
                    <div style="background:#f8fafc;padding:10px;border-radius:8px;"><div style="color:#64748b;font-size:11px;">Harga Satuan</div><div style="font-weight:700;" x-text="'Rp ' + formatNumber(detailModal.item.harga_satuan || detailModal.item.jumlah)"></div></div>
                    <div style="background:#f8fafc;padding:10px;border-radius:8px;">
                        <div style="color:#64748b;font-size:11px;">Metode Pembayaran</div>
                        <div style="font-weight:700;color:#0f172a;margin-top:2px;" x-text="detailModal.item.metode_pembayaran || 'Transfer Bank'"></div>
                    </div>
                    <div style="grid-column:1/-1;background:#f8fafc;padding:12px;border-radius:8px;">
                        <div style="color:#64748b;font-size:11px;margin-bottom:4px;font-weight:700;text-transform:uppercase;letter-spacing:0.04em;">Keterangan &amp; Uraian</div>
                        <div style="color:#1e293b;font-size:13px;line-height:1.55;" x-html="detailModal.item.keterangan || detailModal.item.deskripsi || '-'"></div>
                    </div>
                    <template x-if="detailModal.item.bukti_gambar"><div style="grid-column:1/-1;background:#f8fafc;padding:10px;border-radius:8px;"><div style="color:#64748b;font-size:11px;margin-bottom:5px;">Bukti Transaksi</div><a :href="detailModal.item.bukti_gambar" target="_blank" style="color:#2563eb;font-weight:700;">Buka bukti transaksi</a></div></template>
                    <div style="grid-column:1/-1;background:#f8fafc;padding:10px;border-radius:8px;"><div style="color:#64748b;font-size:11px;">Nominal</div><div style="font-size:18px;font-weight:800;" :style="detailModal.item.type === 'masuk' ? 'color:#15803d;' : 'color:#b91c1c;'" x-text="(detailModal.item.type === 'masuk' ? '+ Rp ' : '- Rp ') + formatNumber(detailModal.item.jumlah)"></div></div>
                </div>

                <div style="display:flex;justify-content:space-between;align-items:center;border-top:1px solid #f1f5f9;margin-top:14px;padding-top:12px;flex-wrap:wrap;gap:10px;">
                    <div>
                        <template x-if="detailModal.item.no_hp">
                            <a :href="window.DHSKasHelper.getWhatsAppUrl(detailModal.item)" target="_blank"
                               style="display:inline-flex;align-items:center;gap:8px;padding:9px 16px;border-radius:10px;background:#25D366;color:#ffffff;text-decoration:none;font-weight:700;font-size:13px;box-shadow:0 3px 10px rgba(37,211,102,0.3);transition:all 0.15s;"
                               onmouseover="this.style.background='#1ebc59';" onmouseout="this.style.background='#25D366';">
                                <span class="material-icons-round" style="font-size:18px;">chat</span>
                                <span>Hubungi via WhatsApp</span>
                            </a>
                        </template>
                        <template x-if="!detailModal.item.no_hp">
                            <span style="font-size:12px;color:#94a3b8;font-style:italic;">(Nomor HP belum diisi)</span>
                        </template>
                    </div>
                    <div style="display:flex;gap:8px;">
                        <button type="button" class="btn-secondary" x-on:click="openModal('edit', detailModal.item); detailModal.open = false;">
                            <span class="material-icons-round" style="font-size:16px;">edit</span> Edit
                        </button>
                        <button type="button" class="btn-primary" x-on:click="detailModal.open = false">Tutup</button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div class="bo-modal-backdrop"
         x-show="deleteConfirm.open"
         x-transition
         style="display:none;"
         x-on:click.self="deleteConfirm.open = false"
         x-on:keydown.escape.window="deleteConfirm.open = false">
        <div class="bo-modal" style="max-width:420px;width:95%;text-align:center;" x-on:click.stop>
            <div style="width:56px;height:56px;border-radius:50%;background:rgba(197,48,48,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <span class="material-icons-round" style="font-size:28px;color:#C53030;">warning</span>
            </div>
            <h3 style="margin:.75rem 0 .5rem;">Hapus Transaksi?</h3>
            <p style="color:#6b7280;font-size:.9rem;margin-bottom:1.25rem;">Transaksi yang dihapus tidak dapat dipulihkan.</p>
            <div style="display:flex;justify-content:center;gap:.75rem;">
                <button type="button" class="btn-secondary" x-on:click="deleteConfirm.open = false">Batal</button>
                <button type="button" class="btn-danger" x-on:click="confirmDelete()">
                    <span class="material-icons-round" style="font-size:17px;">delete</span> Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <form id="kpDeleteForm" method="POST" action="" style="display:none;">
        @csrf
        <input type="hidden" name="redirect_to" value="/backoffice/kas-kategori-kas/{{ $kategori->id }}">
    </form>

</div>
@endsection

@push('scripts')
@include('backoffice.partials.kas-helpers-js')
<script>
function kasProgramData() {
    return {
        filterPeriode:     'all',
        filterTanggal:     new Date().toISOString().slice(0, 10),
        filterTglDari:     '',
        filterTglSampai:   '',
        filterBulan:       (new Date().getMonth() + 1).toString(),
        filterBulanDari:   '1',
        filterBulanSampai: '12',
        filterTahun:       new Date().getFullYear().toString(),
        filterTipe:        '',
        filterStatus:      '',
        filterRel:         '',
        sortBy:            'tanggal_desc',
        filterSearch:      '',

        items:     @json($transactions),
        unitsList: @json($unitsData),

        modal: {
            open: false,
            mode: 'add',
            editId: null,
            form: {
                editMode: false,
                program_ref: '{{ $firstProgId ? "prog:" . $firstProgId : "" }}',
                tanggal: new Date().toISOString().slice(0, 10),
                type: '',
                jenis: '',
                deskripsi: '',
                satuan: 'Paket',
                volume: 1,
                hargaSatuanDisplay: '',
                payment_mode: 'lunas',
                dpNominalDisplay: '',
                piutang_nama: '',
                no_hp: '',
                metode_pembayaran: 'Transfer Bank',
                keterangan: '',
                kodeMode: 'auto',
                kode: '',
                bukti_gambar: '',
            },
        },
        deleteConfirm: { open: false, targetId: null },
        detailModal: { open: false, item: null },

        init() {
            this.items = this.items.map(i => ({
                ...i,
                jumlah:       parseFloat(i.jumlah) || 0,
                volume:       parseFloat(i.volume) || 1,
                harga_satuan: i.harga_satuan !== null && i.harga_satuan !== undefined ? parseFloat(i.harga_satuan) : (parseFloat(i.jumlah) || 0),
                program:      i.program || null,
            }));
        },

        get filtered() {
            const list = this.items.filter(item => window.DHSKasHelper.matchesFilters(item, this));
            return window.DHSKasHelper.sortItems(list, this.sortBy);
        },

        get summaryFiltered() {
            let masuk = 0, keluar = 0;
            this.filtered.forEach(i => {
                const isPendingPiutang = i.is_piutang && !i.piutang_lunas_at;
                if (i.type === 'masuk' && !isPendingPiutang) masuk += i.jumlah;
                if (i.type === 'keluar') keluar += i.jumlah;
            });
            const saldo  = masuk - keluar;
            const persen = masuk > 0 ? (saldo / masuk) * 100 : 0;
            return { masuk, keluar, saldo, persen };
        },

        resetFilter() {
            this.filterPeriode     = 'all';
            this.filterTanggal     = new Date().toISOString().slice(0, 10);
            this.filterTglDari     = '';
            this.filterTglSampai   = '';
            this.filterBulan       = (new Date().getMonth() + 1).toString();
            this.filterBulanDari   = '1';
            this.filterBulanSampai = '12';
            this.filterTahun       = new Date().getFullYear().toString();
            this.filterTipe        = '';
            this.filterStatus      = '';
            this.filterRel         = '';
            this.sortBy            = 'tanggal_desc';
            this.filterSearch      = '';
        },

        exportCsvUrl() {
            return window.DHSKasHelper.buildExportUrl('/backoffice/kas/export-csv?category_id={{ $kategori->id }}', this);
        },

        exportPdfUrl() {
            return window.DHSKasHelper.buildExportUrl('/backoffice/kas/export-pdf?category_id={{ $kategori->id }}', this);
        },

        formatNumber(n)  { return window.DHSKasHelper.formatNumber(n); },
        formatTanggal(s) { return window.DHSKasHelper.formatTanggal(s); },

        openDetail(item) {
            this.detailModal.item = item;
            this.detailModal.open = true;
        },

        openModal(mode, item) {
            this.modal.mode   = mode;
            this.modal.editId = item ? item.id : null;
            if (mode === 'add') {
                this.modal.form = {
                    editMode:           false,
                    itemId:             null,
                    is_piutang:         false,
                    piutang_lunas_at:   null,
                    is_pending_piutang: false,
                    sisa_piutang:       0,
                    program_ref:        '{{ $firstProgId ? "prog:" . $firstProgId : "" }}',
                    tanggal:            new Date().toISOString().slice(0, 10),
                    type:               '',
                    jenis:              '',
                    deskripsi:          '',
                    satuan:             'Paket',
                    volume:             1,
                    hargaSatuanDisplay: '',
                    payment_mode:       'lunas',
                    totalHargaDisplay:  '',
                    dpNominalDisplay:   '',
                    piutang_nama:       '',
                    no_hp:              '',
                    metode_pembayaran:  'Transfer Bank',
                    keterangan:         '',
                    kodeMode:           'auto',
                    kode:               '',
                    bukti_gambar:       '',
                };
            } else {
                const harga = item.harga_satuan !== null && item.harga_satuan !== undefined
                    ? parseFloat(item.harga_satuan)
                    : (parseFloat(item.jumlah) || 0);
                const ref = item.program_id ? ('prog:' + item.program_id) : '';
                const isPendingPt = !!(item.is_piutang && !item.piutang_lunas_at);
                const sisaPiutang = isPendingPt ? (parseFloat(item.jumlah) || 0) : 0;
                this.modal.form = {
                    editMode:           true,
                    itemId:             item.id,
                    is_piutang:         !!item.is_piutang,
                    piutang_lunas_at:   item.piutang_lunas_at || null,
                    is_pending_piutang: isPendingPt,
                    sisa_piutang:       sisaPiutang,
                    program_ref:        ref,
                    tanggal:            item.tanggal ? String(item.tanggal).substring(0, 10) : '',
                    type:               item.type || '',
                    jenis:              item.jenis || '',
                    deskripsi:          item.deskripsi || '',
                    satuan:             item.satuan || 'Paket',
                    volume:             parseFloat(item.volume) || 1,
                    hargaSatuanDisplay: harga ? Math.round(harga).toLocaleString('id-ID') : '',
                    payment_mode:       isPendingPt ? 'cicil' : 'lunas',
                    totalHargaDisplay:  harga ? Math.round(harga).toLocaleString('id-ID') : '',
                    dpNominalDisplay:   '',
                    piutang_nama:       item.piutang_nama || '',
                    no_hp:              item.no_hp || '',
                    metode_pembayaran:  item.metode_pembayaran || 'Transfer Bank',
                    keterangan:         item.keterangan || '',
                    kodeMode:           item.kode ? 'manual' : 'auto',
                    kode:               item.kode || '',
                    bukti_gambar:       item.bukti_gambar || '',
                };
            }
            this.modal.open = true;

            this.$nextTick(() => {
                if (window.DHSKasHelper && window.DHSKasHelper.initSummernote) {
                    window.DHSKasHelper.initSummernote('#summernote-kas-keterangan', this.modal.form.keterangan || '');
                }
            });
        },

        deleteItem(id) {
            this.deleteConfirm.open     = true;
            this.deleteConfirm.targetId = id;
        },

        confirmDelete() {
            const form = document.getElementById('kpDeleteForm');
            form.action = '/backoffice/kas/' + this.deleteConfirm.targetId + '/delete';
            form.submit();
        }
    };
}
</script>
@endpush
