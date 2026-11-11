@extends('backoffice.layouts.app')

@section('title', 'Keuangan Umum')
@section('page-title', 'Manajemen Keuangan & Arus Kas')

@push('styles')
<style>
    .kas-compact-table { width: 100%; border-collapse: collapse; table-layout: auto; }
    .kas-compact-table th { padding: 10px 9px !important; font-size: 10.5px !important; letter-spacing: .04em !important; white-space: nowrap; }
    .kas-compact-table td { padding: 10px 9px !important; font-size: 12.5px !important; vertical-align: middle; word-break: break-word; }
    .kas-compact-table .kas-act-btn { width: 28px; height: 28px; border-radius: 7px; }
    .kas-compact-table .kas-act-btn .material-icons-round { font-size: 16px !important; }
</style>
@endpush

@php
    $optMasukList        = !empty($optMasuk) ? array_values(array_unique($optMasuk)) : [];
    $optKeluarList       = !empty($optKeluar) ? array_values(array_unique($optKeluar)) : [];
    $unitsData           = $units ?? ['Orang', 'Unit', 'Hari', 'Paket', 'Jam', 'Bulan', 'Pcs', 'Sesi', 'Semester', 'Lot', 'Set'];
    $piutangTrxList      = $piutangTxPendingList ?? collect();
    $totalPiutangDisplay = $totalPiutang ?? 0;
@endphp

@section('content')
<div x-data="kasData()" x-init="init()">

    {{-- ── Flash Messages ──────────────────────────────────── --}}
    @if(session('success'))
    <div class="bo-card" style="border-left:4px solid #22c55e;margin-bottom:1rem;padding:.85rem 1.15rem;color:#166534;background:#f0fdf4;display:flex;align-items:center;gap:8px;font-weight:600;">
        <span class="material-icons-round" style="font-size:20px;">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- ── Top Action Header ───────────────────────────────── --}}
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:1.25rem;">
        <div style="font-size:13.5px;color:#64748b;">
            Pantau seluruh arus kas pemasukan &amp; pengeluaran Denpasar Hotel School secara terpadu.
        </div>
        <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
            <button type="button" x-on:click="piutangOverviewModal = true" class="btn-secondary" style="font-size:13px;padding:8px 14px;border-color:#d97706;color:#b45309;background:#fffbeb;">
                <span class="material-icons-round" style="font-size:17px;">pending_actions</span>
                Uang di Lapangan ({{ count($piutangTrxList) }})
            </button>
            <a href="/backoffice/kas-keuangan-program" class="btn-secondary" style="font-size:13px;padding:8px 14px;">
                <span class="material-icons-round" style="font-size:17px;">folder_open</span>
                Keuangan Program
            </a>
            <a href="/backoffice/kas-kategori" class="btn-secondary" style="font-size:13px;padding:8px 14px;">
                <span class="material-icons-round" style="font-size:17px;">category</span>
                Jenis Kas
            </a>
            <button type="button" class="btn-primary" x-on:click="openModal('add', null)">
                <span class="material-icons-round" style="font-size:18px;">add</span>
                Tambah Transaksi Umum
            </button>
        </div>
    </div>

    {{-- ── Summary Cards (Sesuai Gaya Foto 3 & Foto 5) ────── --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(205px,1fr));gap:14px;margin-bottom:1.5rem;">

        {{-- Pemasukan --}}
        <div class="bo-card" style="padding:18px 20px;border-left:4px solid #16a34a;border-radius:14px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                <span style="font-size:11px;font-weight:700;letter-spacing:.06em;color:#64748b;text-transform:uppercase;">Total Pemasukan</span>
                <span style="font-size:11px;font-weight:700;padding:2px 8px;border-radius:99px;background:#dcfce7;color:#15803d;">Masuk</span>
            </div>
            <div style="font-size:21px;font-weight:800;color:#15803d;" x-text="'Rp ' + formatNumber(summaryFiltered.masuk)"></div>
            <div style="font-size:11.5px;color:#64748b;margin-top:4px;" x-text="summaryFiltered.countMasuk + ' transaksi terealisasi'"></div>
        </div>

        {{-- Pengeluaran --}}
        <div class="bo-card" style="padding:18px 20px;border-left:4px solid #dc2626;border-radius:14px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                <span style="font-size:11px;font-weight:700;letter-spacing:.06em;color:#64748b;text-transform:uppercase;">Total Pengeluaran</span>
                <span style="font-size:11px;font-weight:700;padding:2px 8px;border-radius:99px;background:#fee2e2;color:#b91c1c;">Keluar</span>
            </div>
            <div style="font-size:21px;font-weight:800;color:#b91c1c;" x-text="'Rp ' + formatNumber(summaryFiltered.keluar)"></div>
            <div style="font-size:11.5px;color:#64748b;margin-top:4px;" x-text="summaryFiltered.countKeluar + ' item pengeluaran'"></div>
        </div>

        {{-- Saldo / Laba Bersih --}}
        <div class="bo-card" style="padding:18px 20px;border-left:4px solid #2563eb;border-radius:14px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                <span style="font-size:11px;font-weight:700;letter-spacing:.06em;color:#64748b;text-transform:uppercase;">Saldo / Net</span>
                <span style="font-size:11px;font-weight:700;padding:2px 8px;border-radius:99px;background:#dbeafe;color:#1d4ed8;" x-text="summaryFiltered.persen.toFixed(1) + '%'"></span>
            </div>
            <div style="font-size:21px;font-weight:800;"
                 :style="summaryFiltered.saldo >= 0 ? 'color:#1d4ed8;' : 'color:#dc2626;'"
                 x-text="(summaryFiltered.saldo < 0 ? '- Rp ' : 'Rp ') + formatNumber(summaryFiltered.saldo)"></div>
            <div style="font-size:11.5px;color:#64748b;margin-top:4px;" x-text="'Margin filter ' + summaryFiltered.persen.toFixed(1) + '%'"></div>
        </div>

        {{-- Uang di Lapangan / Piutang Belum Lunas --}}
        <button type="button" x-on:click="piutangOverviewModal = true" class="bo-card" style="padding:18px 20px;border:none;border-left:4px solid #f59e0b;border-radius:14px;text-align:left;cursor:pointer;display:block;width:100%;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;gap:6px;">
                <span style="font-size:11px;font-weight:700;letter-spacing:.06em;color:#64748b;text-transform:uppercase;">Uang di Lapangan</span>
                <span style="font-size:11px;font-weight:700;padding:2px 8px;border-radius:99px;background:#fef3c7;color:#b45309;">Piutang</span>
            </div>
            <div style="font-size:21px;font-weight:800;color:#b45309;">Rp {{ number_format($totalPiutangDisplay, 0, ',', '.') }}</div>
            <div style="font-size:11.5px;color:#92400e;margin-top:4px;">{{ count($piutangTrxList) }} tagihan / sisa DP belum lunas &rarr;</div>
        </button>

        {{-- Margin Total Keseluruhan --}}
        <div class="bo-card" style="padding:18px 20px;border-left:4px solid #0891b2;border-radius:14px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                <span style="font-size:11px;font-weight:700;letter-spacing:.06em;color:#64748b;text-transform:uppercase;">Saldo Keseluruhan</span>
                <span style="font-size:11px;font-weight:700;padding:2px 8px;border-radius:99px;background:#cffafe;color:#0e7490;">{{ $persenKeuntungan }}%</span>
            </div>
            <div style="font-size:21px;font-weight:800;color:{{ $saldo >= 0 ? '#0e7490' : '#dc2626' }};">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
            <div style="font-size:11.5px;color:#64748b;margin-top:4px;">Total {{ $transactions->count() }} transaksi tercatat</div>
        </div>

    </div>

    {{-- ── Filter Bar (Foto 1 & Foto 2 + Sortir Harian/Bulanan/Tahunan/Rentang) ── --}}
    @include('backoffice.partials.kas-filter-bar', ['showProgramFilter' => true])

    {{-- ── Tabel Transaksi ─────────────────────────────────── --}}
    <div class="bo-card" style="padding:0;overflow:hidden;border:1px solid #e2e8f0;">
        <div style="overflow-x:auto;">
            <table class="bo-table kas-compact-table">
                <thead>
                    <tr>
                        <th>Tanggal &amp; Kode</th>
                        <th>Program</th>
                        <th>Kategori &amp; Deskripsi</th>
                        <th style="text-align:right;">Vol &amp; Harga</th>
                        <th style="text-align:right;">Total &amp; Tipe</th>
                        <th style="text-align:center;">Bukti</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-if="filtered.length === 0">
                        <tr>
                            <td colspan="7" style="text-align:center;padding:2.5rem;color:#94a3b8;">
                                <span class="material-icons-round" style="font-size:40px;display:block;margin-bottom:.5rem;">inbox</span>
                                Tidak ada data transaksi yang cocok dengan filter
                            </td>
                        </tr>
                    </template>
                    <template x-for="item in filtered" :key="item.id">
                        <tr>
                            <td style="width:110px;">
                                <div style="font-weight:600;color:#0f172a;font-size:12.5px;white-space:nowrap;" x-text="formatTanggal(item.tanggal)"></div>
                                <div style="font-size:10.5px;font-family:monospace;color:#64748b;margin-top:2px;white-space:nowrap;" x-text="item.kode || '-'"></div>
                            </td>
                            <td style="max-width:175px;">
                                <template x-if="item.program">
                                    <span style="font-weight:600;color:#334155;font-size:12px;line-height:1.35;display:block;" x-text="item.program.title"></span>
                                </template>
                                <template x-if="!item.program">
                                    <span style="display:inline-block;padding:2px 8px;border-radius:6px;background:#e0f2fe;color:#0369a1;font-size:11px;font-weight:700;">Umum</span>
                                </template>
                            </td>
                            <td>
                                <div style="font-weight:600;color:#0f172a;font-size:12.5px;line-height:1.35;" x-text="item.jenis"></div>
                                <div style="font-size:12px;color:#475569;line-height:1.35;" x-text="item.deskripsi || '-'"></div>
                                <template x-if="item.piutang_nama">
                                    <div style="display:inline-flex;align-items:center;gap:4px;margin-top:3px;padding:1px 6px;border-radius:5px;font-size:10.5px;font-weight:700;"
                                         :style="item.is_piutang && !item.piutang_lunas_at ? 'background:#fef3c7;color:#b45309;' : 'background:#f1f5f9;color:#475569;'"
                                         x-text="(item.is_piutang && !item.piutang_lunas_at ? 'Piutang: ' : 'Penanggung: ') + item.piutang_nama"></div>
                                </template>
                                <template x-if="item.keterangan">
                                    <div style="font-size:11px;color:#94a3b8;margin-top:2px;line-height:1.3;" x-text="'Ket: ' + item.keterangan"></div>
                                </template>
                            </td>
                            <td style="text-align:right;white-space:nowrap;">
                                <div style="font-weight:600;color:#334155;font-size:12px;"
                                     x-text="(parseFloat(item.volume) || 1) + ' ' + (item.satuan || 'Paket')"></div>
                                <div style="font-size:11px;color:#64748b;"
                                     x-text="'@ Rp ' + formatNumber(item.harga_satuan || item.jumlah)"></div>
                            </td>
                            <td style="text-align:right;white-space:nowrap;">
                                <template x-if="item.is_piutang && !item.piutang_lunas_at">
                                    <div style="font-weight:800;font-size:12.5px;color:#b45309;" x-text="'Rp ' + formatNumber(item.jumlah)"></div>
                                </template>
                                <template x-if="!item.is_piutang || item.piutang_lunas_at">
                                    <div style="font-weight:800;font-size:12.5px;"
                                         :style="item.type === 'masuk' ? 'color:#15803d;' : 'color:#b91c1c;'"
                                         x-text="(item.type === 'masuk' ? '+ Rp ' : '- Rp ') + formatNumber(item.jumlah)"></div>
                                </template>
                                <div style="margin-top:3px;">
                                    <button type="button"
                                            x-show="item.is_piutang && !item.piutang_lunas_at"
                                            x-on:click="lunasPiutang(item)"
                                            class="badge"
                                            title="Klik untuk Bayar Cicilan / Lunasi Piutang"
                                            style="background:#fef3c7;color:#b45309;font-size:10px;padding:2px 8px;border:1px solid #fde68a;cursor:pointer;display:inline-flex;align-items:center;gap:3px;font-weight:700;">
                                        <span class="material-icons-round" style="font-size:12px;">payments</span>
                                        Piutang (Bayar / Cicil)
                                    </button>
                                    <span x-show="!item.is_piutang || item.piutang_lunas_at"
                                          :class="item.type === 'masuk' ? 'badge badge-green' : 'badge badge-red'"
                                          style="font-size:9.5px;padding:2px 7px;"
                                          x-text="item.type === 'masuk' ? 'Pemasukan' : 'Pengeluaran'"></span>
                                </div>
                            </td>
                            <td style="text-align:center;width:48px;">
                                <template x-if="item.bukti_gambar && window.DHSKasHelper.isPdf(item.bukti_gambar)">
                                    <a :href="item.bukti_gambar" target="_blank" class="badge badge-red" style="text-decoration:none;font-size:10px;padding:2px 6px;">PDF</a>
                                </template>
                                <template x-if="item.bukti_gambar && !window.DHSKasHelper.isPdf(item.bukti_gambar)">
                                    <a :href="item.bukti_gambar" target="_blank">
                                        <img :src="item.bukti_gambar" style="width:32px;height:32px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;">
                                    </a>
                                </template>
                                <template x-if="!item.bukti_gambar">
                                    <span style="color:#cbd5e1;font-size:12px;">—</span>
                                </template>
                            </td>
                            <td style="text-align:center;white-space:nowrap;">
                                <div style="display:inline-flex;align-items:center;justify-content:center;gap:3px;">
                                    <button type="button" class="btn-icon kas-act-btn" title="Detail Transaksi" x-on:click="openDetail(item)">
                                        <span class="material-icons-round" style="color:#0891b2;">visibility</span>
                                    </button>
                                    <a :href="'/backoffice/kas/' + item.id + '/kwitansi'" target="_blank" class="btn-icon kas-act-btn" title="Cetak Kwitansi">
                                        <span class="material-icons-round" style="color:#2563eb;">receipt_long</span>
                                    </a>
                                    <template x-if="item.is_piutang && !item.piutang_lunas_at">
                                        <button type="button" class="btn-icon kas-act-btn" title="Bayar Cicilan / Lunasi Piutang" x-on:click="lunasPiutang(item)" style="background:#f0fdf4;border:1px solid #bbf7d0;">
                                            <span class="material-icons-round" style="color:#16a34a;">payments</span>
                                        </button>
                                    </template>
                                    <button type="button" class="btn-icon kas-act-btn" title="Edit" x-on:click="openModal('edit', item)">
                                        <span class="material-icons-round" style="color:#374151;">edit</span>
                                    </button>
                                    <button type="button" class="btn-icon danger kas-act-btn" title="Hapus" x-on:click="deleteItem(item.id)">
                                        <span class="material-icons-round" style="color:#ef4444;">delete</span>
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



    {{-- ══════════════════════════════════════════════════════════
         MODAL TAMBAH / EDIT TRANSAKSI (FORMAT CHATGPT + REVISI 3)
    ══════════════════════════════════════════════════════════ --}}
    <div class="bo-modal-backdrop"
         x-show="modal.open"
         x-transition
         style="display:none;"
         x-on:click.self="modal.open = false"
         x-on:keydown.escape.window="modal.open = false">
        <div class="bo-modal wide" style="max-width:650px;width:95%;padding:26px 28px;" x-on:click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
                <h3 style="margin:0;font-size:1.15rem;font-weight:700;"
                    x-text="modal.mode === 'add' ? 'Tambah Transaksi Umum' : 'Edit Transaksi'"></h3>
                <button type="button" class="btn-icon" x-on:click="modal.open = false">
                    <span class="material-icons-round">close</span>
                </button>
            </div>

            @include('backoffice.partials.kas-transaction-form', [
                'scope'            => 'modal.form',
                'actionExpr'       => "modal.mode === 'add' ? '/backoffice/kas/store' : '/backoffice/kas/' + modal.editId + '/update'",
                'programScopeMode' => 'umum',
                'redirectValue'    => '/backoffice/kas',
                'submitText'       => 'Simpan Transaksi Umum',
                'showCancel'       => true,
                'cancelAction'     => 'modal.open = false',
                'optUmumMasuk'     => $optUmumMasuk ?? $optMasukList,
                'optUmumKeluar'    => $optUmumKeluar ?? $optKeluarList,
                'optProgramMasuk'  => $optProgramMasuk ?? $optMasukList,
                'optProgramKeluar' => $optProgramKeluar ?? $optKeluarList,
            ])
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         MODAL KONFIRMASI HAPUS
    ══════════════════════════════════════════════════════════ --}}
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
            <p style="color:#6b7280;font-size:.9rem;margin-bottom:1.25rem;">Transaksi yang dihapus tidak dapat dipulihkan kembali.</p>
            <div style="display:flex;justify-content:center;gap:.75rem;">
                <button type="button" class="btn-secondary" x-on:click="deleteConfirm.open = false">Batal</button>
                <button type="button" class="btn-danger" x-on:click="confirmDelete()">
                    <span class="material-icons-round" style="font-size:17px;">delete</span> Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         MODAL DETAIL TRANSAKSI
    ══════════════════════════════════════════════════════════ --}}
    <div class="bo-modal-backdrop"
         x-show="detailModal.open"
         x-transition
         style="display:none;"
         x-on:click.self="detailModal.open = false"
         x-on:keydown.escape.window="detailModal.open = false">
        <div class="bo-modal" style="max-width:580px;width:95%;" x-on:click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;border-bottom:1px solid #f1f5f9;padding-bottom:.75rem;">
                <div style="display:flex;align-items:center;gap:.5rem;">
                    <span class="material-icons-round" style="color:#0891b2;font-size:24px;">info</span>
                    <h3 style="margin:0;font-size:1.15rem;font-weight:700;">Detail Transaksi Kas</h3>
                </div>
                <button type="button" class="btn-icon" x-on:click="detailModal.open = false">
                    <span class="material-icons-round">close</span>
                </button>
            </div>

            <template x-if="detailModal.item">
                <div>
                    <div style="margin-bottom:1rem;padding:.85rem 1rem;border-radius:10px;display:flex;align-items:center;justify-content:space-between;"
                         :style="detailModal.item.type === 'masuk' ? 'background:#f0fdf4;border:1px solid #bbf7d0;' : 'background:#fef2f2;border:1px solid #fecaca;'">
                        <div>
                            <div style="font-size:11px;text-transform:uppercase;font-weight:700;"
                                 :style="detailModal.item.type === 'masuk' ? 'color:#15803d;' : 'color:#b91c1c;'"
                                 x-text="detailModal.item.type === 'masuk' ? 'Pemasukan Kas' : 'Pengeluaran Kas'"></div>
                            <div style="font-size:22px;font-weight:800;"
                                 :style="detailModal.item.type === 'masuk' ? 'color:#15803d;' : 'color:#b91c1c;'"
                                 x-text="(detailModal.item.type === 'masuk' ? '+ Rp ' : '- Rp ') + formatNumber(detailModal.item.jumlah)"></div>
                        </div>
                        <div style="text-align:right;font-size:12px;color:#475569;">
                            <div x-text="(parseFloat(detailModal.item.volume) || 1) + ' ' + (detailModal.item.satuan || 'Paket')"></div>
                            <div x-text="'@ Rp ' + formatNumber(detailModal.item.harga_satuan || detailModal.item.jumlah)"></div>
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;font-size:13px;margin-bottom:1rem;">
                        <div style="background:#f8fafc;padding:10px;border-radius:8px;">
                            <div style="color:#64748b;font-size:11px;">Kode</div>
                            <div style="font-weight:700;" x-text="detailModal.item.kode || '-'"></div>
                        </div>
                        <div style="background:#f8fafc;padding:10px;border-radius:8px;">
                            <div style="color:#64748b;font-size:11px;">Tanggal</div>
                            <div style="font-weight:700;" x-text="formatTanggal(detailModal.item.tanggal)"></div>
                        </div>
                        <div style="background:#f8fafc;padding:10px;border-radius:8px;">
                            <div style="color:#64748b;font-size:11px;">Program</div>
                            <div style="font-weight:700;" x-text="detailModal.item.project ? detailModal.item.project.nama_proyek : (detailModal.item.program ? detailModal.item.program.title : 'Umum')"></div>
                        </div>
                        <div style="background:#f8fafc;padding:10px;border-radius:8px;">
                            <div style="color:#64748b;font-size:11px;">Kategori</div>
                            <div style="font-weight:700;" x-text="detailModal.item.jenis"></div>
                        </div>
                        <div style="grid-column:1/-1;background:#f8fafc;padding:10px;border-radius:8px;">
                            <div style="color:#64748b;font-size:11px;">Deskripsi / Uraian</div>
                            <div style="color:#0f172a;font-weight:500;" x-text="detailModal.item.deskripsi || '-'"></div>
                        </div>
                        <template x-if="detailModal.item.keterangan">
                            <div style="grid-column:1/-1;background:#f8fafc;padding:10px;border-radius:8px;">
                                <div style="color:#64748b;font-size:11px;">Keterangan Tambahan</div>
                                <div style="color:#334155;white-space:pre-wrap;" x-text="detailModal.item.keterangan"></div>
                            </div>
                        </template>
                    </div>

                    <template x-if="detailModal.item.bukti_gambar">
                        <div style="margin-bottom:1rem;">
                            <div style="font-size:12px;font-weight:600;color:#64748b;margin-bottom:6px;">Bukti Transaksi:</div>
                            <template x-if="window.DHSKasHelper.isPdf(detailModal.item.bukti_gambar)">
                                <a :href="detailModal.item.bukti_gambar" target="_blank" class="btn-secondary" style="font-size:12.5px;padding:7px 14px;">
                                    <span class="material-icons-round" style="font-size:16px;color:#dc2626;">picture_as_pdf</span> Buka Dokumen PDF
                                </a>
                            </template>
                            <template x-if="!window.DHSKasHelper.isPdf(detailModal.item.bukti_gambar)">
                                <a :href="detailModal.item.bukti_gambar" target="_blank">
                                    <img :src="detailModal.item.bukti_gambar" style="max-height:170px;border-radius:8px;border:1px solid #e2e8f0;">
                                </a>
                            </template>
                        </div>
                    </template>

                    <div style="display:flex;justify-content:space-between;align-items:center;border-top:1px solid #f1f5f9;padding-top:12px;">
                        <a :href="'/backoffice/kas/' + detailModal.item.id + '/kwitansi'" target="_blank" class="btn-secondary" style="font-size:13px;">
                            <span class="material-icons-round" style="font-size:16px;">receipt_long</span> Cetak Kwitansi
                        </a>
                        <div style="display:flex;gap:8px;">
                            <button type="button" class="btn-secondary" x-on:click="openModal('edit', detailModal.item); detailModal.open = false;">
                                <span class="material-icons-round" style="font-size:16px;">edit</span> Edit
                            </button>
                            <button type="button" class="btn-primary" x-on:click="detailModal.open = false">Tutup</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         MODAL RINCIAN UANG DI LAPANGAN (PIUTANG & SISA DP)
    ══════════════════════════════════════════════════════════ --}}
    <div class="bo-modal-backdrop"
         x-show="piutangOverviewModal"
         x-transition
         style="display:none;z-index:1100;"
         x-on:click.self="piutangOverviewModal = false"
         x-on:keydown.escape.window="piutangOverviewModal = false">
        <div class="bo-modal wide" style="max-width:860px;width:96%;padding:24px 26px;max-height:90vh;display:flex;flex-direction:column;" x-on:click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:14px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:42px;height:42px;border-radius:11px;background:#fef3c7;color:#b45309;display:flex;align-items:center;justify-content:center;">
                        <span class="material-icons-round" style="font-size:24px;">pending_actions</span>
                    </div>
                    <div>
                        <h3 style="margin:0;font-size:1.15rem;font-weight:800;color:#0f172a;">Rincian Uang di Lapangan (Piutang &amp; Sisa DP)</h3>
                        <div style="font-size:12.5px;color:#64748b;">
                            Total belum masuk kas: <strong style="color:#b45309;">Rp {{ number_format($totalPiutangDisplay, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-icon" x-on:click="piutangOverviewModal = false">
                    <span class="material-icons-round">close</span>
                </button>
            </div>

            {{-- Tab Header --}}
            <div style="overflow-y:auto;flex:1;">
                {{-- Tagihan Siswa / Klien & Sisa DP --}}
                <div>
                    <div style="overflow-x:auto;border:1px solid #e2e8f0;border-radius:12px;">
                        <table class="bo-table" style="width:100%;border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Penanggung / Deskripsi</th>
                                    <th>Lingkup</th>
                                    <th style="text-align:right;">Sisa Piutang</th>
                                    <th style="text-align:center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($piutangTrxList as $pt)
                                    <tr>
                                        <td style="white-space:nowrap;font-size:12.5px;">{{ $pt->tanggal ? $pt->tanggal->format('d M Y') : '-' }}</td>
                                        <td>
                                            <div style="font-weight:700;color:#b45309;font-size:12.5px;">{{ $pt->piutang_nama ?: 'Belum Dinamai' }}</div>
                                            <div style="font-size:12.5px;color:#0f172a;font-weight:600;">{{ $pt->deskripsi ?: '-' }}</div>
                                            <div style="font-size:11px;color:#64748b;font-family:monospace;">{{ $pt->kode ?: '-' }}</div>
                                        </td>
                                        <td style="font-size:12px;">
                                            @if($pt->program)
                                                <span style="color:#334155;font-weight:600;">{{ $pt->program->title }}</span>
                                            @else
                                                <span style="color:#0369a1;font-weight:600;">Umum</span>
                                            @endif
                                        </td>
                                        <td style="text-align:right;font-weight:800;color:#b45309;white-space:nowrap;">
                                            Rp {{ number_format($pt->jumlah, 0, ',', '.') }}
                                        </td>
                                        <td style="text-align:center;white-space:nowrap;">
                                            <button type="button"
                                                    x-on:click="lunasPiutangById({{ $pt->id }})"
                                                    class="btn-primary"
                                                    style="padding:5px 12px;font-size:12px;background:#15803d;display:inline-flex;align-items:center;gap:4px;">
                                                <span class="material-icons-round" style="font-size:14px;">payments</span>
                                                Bayar / Cicil
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align:center;padding:2rem;color:#15803d;font-weight:600;">
                                            Tidak ada tagihan siswa/DP perorangan yang belum lunas.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:14px;padding-top:12px;border-top:1px solid #f1f5f9;flex-wrap:wrap;gap:8px;">
                <a href="/backoffice/kas-keuangan-program" class="btn-secondary" style="font-size:12.5px;">
                    Buka Keuangan Program &rarr;
                </a>
                <button type="button" class="btn-primary" x-on:click="piutangOverviewModal = false">Tutup</button>
            </div>
        </div>
    </div>

    @include('backoffice.partials.kas-piutang-pay-modal', ['payScope' => 'piutangPay', 'payRedirect' => '/backoffice/kas'])

    <form id="kasDeleteForm" method="POST" action="" style="display:none;">
        @csrf
        <input type="hidden" name="redirect_to" value="/backoffice/kas">
    </form>

</div>
@endsection

@push('scripts')
@include('backoffice.partials.kas-helpers-js')
<script>
function kasData() {
    return {
        // ── Filter state (Foto 1 & 2 + Revisi 1) ──────────────
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

        // ── Data ──────────────────────────────────────────────
        items:     @json($transactions),
        unitsList: @json($unitsData),

        modal: {
            open: false,
            mode: 'add',
            editId: null,
            form: {
                editMode: false,
                program_ref: '',
                programLabel: '',
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
                keterangan: '',
                kodeMode: 'auto',
                kode: '',
                bukti_gambar: '',
            },
        },
        piutangOverviewModal: false,
        piutangPay: {
            open: false,
            trxId: null,
            kode: '',
            deskripsi: '',
            nama: '',
            sisa: 0,
            bayarDisplay: '',
            tanggal: new Date().toISOString().slice(0, 10),
            catatan: '',
        },
        deleteConfirm: { open: false, targetId: null },
        detailModal:   { open: false, item: null },

        init() {
            this.items = this.items.map(i => ({
                ...i,
                jumlah:       parseFloat(i.jumlah) || 0,
                volume:       parseFloat(i.volume) || 1,
                harga_satuan: i.harga_satuan !== null && i.harga_satuan !== undefined ? parseFloat(i.harga_satuan) : (parseFloat(i.jumlah) || 0),
                program:      i.program || null,
                project:      i.project || null,
            }));
        },

        get filtered() {
            const list = this.items.filter(item => window.DHSKasHelper.matchesFilters(item, this));
            return window.DHSKasHelper.sortItems(list, this.sortBy);
        },

        get summaryFiltered() {
            let masuk = 0, keluar = 0, countMasuk = 0, countKeluar = 0;
            this.filtered.forEach(i => {
                const isPendingPiutang = i.is_piutang && !i.piutang_lunas_at;
                if (i.type === 'masuk' && !isPendingPiutang) {
                    masuk += i.jumlah;
                    countMasuk++;
                }
                if (i.type === 'keluar') {
                    keluar += i.jumlah;
                    countKeluar++;
                }
            });
            const saldo  = masuk - keluar;
            const persen = masuk > 0 ? (saldo / masuk) * 100 : 0;
            return { masuk, keluar, saldo, persen, countMasuk, countKeluar };
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
            return window.DHSKasHelper.buildExportUrl('/backoffice/kas/export-csv', this);
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
                    program_ref:        '',
                    programLabel:       '',
                    tanggal:            new Date().toISOString().slice(0, 10),
                    type:               '',
                    jenis:              '',
                    deskripsi:          '',
                    satuan:             'Paket',
                    volume:             1,
                    hargaSatuanDisplay: '',
                    payment_mode:       'lunas',
                    dpNominalDisplay:   '',
                    piutang_nama:       '',
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
                const lbl = item.program ? item.program.title : '';
                const isPendingPt = !!(item.is_piutang && !item.piutang_lunas_at);
                this.modal.form = {
                    editMode:           true,
                    program_ref:        ref,
                    programLabel:       lbl,
                    tanggal:            item.tanggal ? String(item.tanggal).substring(0, 10) : '',
                    type:               item.type || '',
                    jenis:              item.jenis || '',
                    deskripsi:          item.deskripsi || '',
                    satuan:             item.satuan || 'Paket',
                    volume:             parseFloat(item.volume) || 1,
                    hargaSatuanDisplay: harga ? Math.round(harga).toLocaleString('id-ID') : '',
                    payment_mode:       isPendingPt ? 'cicil' : 'lunas',
                    dpNominalDisplay:   '',
                    piutang_nama:       item.piutang_nama || '',
                    keterangan:         item.keterangan || '',
                    kodeMode:           item.kode ? 'manual' : 'auto',
                    kode:               item.kode || '',
                    bukti_gambar:       item.bukti_gambar || '',
                };
            }

            this.modal.open = true;
        },

        deleteItem(id) {
            this.deleteConfirm.open     = true;
            this.deleteConfirm.targetId = id;
        },

        confirmDelete() {
            const form = document.getElementById('kasDeleteForm');
            form.action = '/backoffice/kas/' + this.deleteConfirm.targetId + '/delete';
            form.submit();
        },

        lunasPiutang(item) {
            const sisa = parseFloat(item.jumlah) || 0;
            this.piutangOverviewModal = false;
            this.piutangPay = {
                open:         true,
                trxId:        item.id,
                kode:         item.kode || '',
                deskripsi:    item.deskripsi || item.jenis || 'Tagihan Piutang',
                nama:         item.piutang_nama || '',
                sisa:         sisa,
                bayarDisplay: sisa ? Math.round(sisa).toLocaleString('id-ID') : '',
                tanggal:      new Date().toISOString().slice(0, 10),
                catatan:      '',
            };
        },

        lunasPiutangById(id) {
            const found = this.items.find(x => String(x.id) === String(id));
            if (found) this.lunasPiutang(found);
        },
    };
}
</script>
@endpush
