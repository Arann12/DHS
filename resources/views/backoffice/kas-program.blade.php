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

    {{-- Summary Cards --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:14px;margin-bottom:1.5rem;">
        <div class="bo-card" style="padding:18px 20px;border-left:4px solid #16a34a;border-radius:14px;">
            <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:6px;">Pemasukan</div>
            <div style="font-size:20px;font-weight:800;color:#15803d;" x-text="'Rp ' + formatNumber(summaryFiltered.masuk)"></div>
        </div>
        <div class="bo-card" style="padding:18px 20px;border-left:4px solid #dc2626;border-radius:14px;">
            <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:6px;">Pengeluaran</div>
            <div style="font-size:20px;font-weight:800;color:#b91c1c;" x-text="'Rp ' + formatNumber(summaryFiltered.keluar)"></div>
        </div>
        <div class="bo-card" style="padding:18px 20px;border-left:4px solid #2563eb;border-radius:14px;">
            <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:6px;">Saldo</div>
            <div style="font-size:20px;font-weight:800;"
                 :style="summaryFiltered.saldo >= 0 ? 'color:#1d4ed8;' : 'color:#dc2626;'"
                 x-text="'Rp ' + formatNumber(summaryFiltered.saldo)"></div>
        </div>
        <button type="button"
                x-on:click="filterStatus = (filterStatus === 'piutang' ? '' : 'piutang')"
                class="bo-card"
                style="padding:18px 20px;border:none;border-left:4px solid #f59e0b;border-radius:14px;text-align:left;cursor:pointer;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;gap:6px;">
                <span style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;">Uang di Lapangan</span>
                <span style="font-size:10.5px;font-weight:700;padding:2px 7px;border-radius:99px;background:#fef3c7;color:#b45309;">Piutang</span>
            </div>
            <div style="font-size:20px;font-weight:800;color:#b45309;">Rp {{ number_format($totalPiutang ?? 0, 0, ',', '.') }}</div>
            <div style="font-size:11px;color:#92400e;margin-top:3px;" x-text="filterStatus === 'piutang' ? 'Filter Piutang aktif (klik reset)' : 'Klik untuk saring transaksi piutang'"></div>
        </button>
        <div class="bo-card" style="padding:18px 20px;border-left:4px solid #9333ea;border-radius:14px;">
            <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:6px;">Margin Keuntungan</div>
            <div style="font-size:20px;font-weight:800;"
                 :style="summaryFiltered.persen >= 0 ? 'color:#7e22ce;' : 'color:#dc2626;'"
                 x-text="summaryFiltered.persen.toFixed(1) + '%'"></div>
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
            <table class="bo-table" style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="white-space:nowrap;">Tanggal</th>
                        <th style="white-space:nowrap;">Kode</th>
                        <th>Program</th>
                        <th>Kategori &amp; Deskripsi</th>
                        <th style="text-align:center;">Vol &amp; Satuan</th>
                        <th style="text-align:right;">Harga Satuan</th>
                        <th style="text-align:right;">Total</th>
                        <th style="text-align:center;">Tipe</th>
                        <th style="text-align:center;">Bukti</th>
                        <th style="text-align:center;min-width:135px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-if="filtered.length === 0">
                        <tr>
                            <td colspan="10" style="text-align:center;padding:2.5rem;color:#94a3b8;">
                                <span class="material-icons-round" style="font-size:40px;display:block;margin-bottom:.5rem;">inbox</span>
                                Tidak ada data transaksi ditemukan
                            </td>
                        </tr>
                    </template>
                    <template x-for="item in filtered" :key="item.id">
                        <tr>
                            <td style="white-space:nowrap;font-size:13px;" x-text="formatTanggal(item.tanggal)"></td>
                            <td style="white-space:nowrap;font-size:12.5px;font-family:monospace;color:#64748b;" x-text="item.kode || '-'"></td>
                            <td>
                                <div style="font-weight:600;color:#334155;" x-text="item.program ? item.program.title : 'Umum'"></div>
                            </td>
                            <td>
                                <div style="font-weight:600;color:#0f172a;" x-text="item.jenis"></div>
                                <div style="font-size:12.5px;color:#475569;" x-text="item.deskripsi || '-'"></div>
                                <template x-if="item.piutang_nama">
                                    <div style="display:inline-flex;align-items:center;gap:4px;margin-top:3px;padding:2px 7px;border-radius:6px;font-size:11px;font-weight:700;"
                                         :style="item.is_piutang && !item.piutang_lunas_at ? 'background:#fef3c7;color:#b45309;' : 'background:#f1f5f9;color:#475569;'"
                                         x-text="(item.is_piutang && !item.piutang_lunas_at ? 'Piutang: ' : 'Penanggung: ') + item.piutang_nama"></div>
                                </template>
                                <template x-if="item.keterangan">
                                    <div style="font-size:11.5px;color:#94a3b8;" x-text="'Ket: ' + item.keterangan"></div>
                                </template>
                            </td>
                            <td style="text-align:center;white-space:nowrap;" x-text="(parseFloat(item.volume) || 1) + ' ' + (item.satuan || 'Paket')"></td>
                            <td style="text-align:right;white-space:nowrap;color:#64748b;" x-text="'Rp ' + formatNumber(item.harga_satuan || item.jumlah)"></td>
                            <td style="text-align:right;white-space:nowrap;font-weight:700;">
                                <template x-if="item.is_piutang && !item.piutang_lunas_at">
                                    <span style="color:#b45309;">
                                        <span style="font-size:10.5px;display:block;font-weight:600;">(Piutang)</span>
                                        <span x-text="'Rp ' + formatNumber(item.jumlah)"></span>
                                    </span>
                                </template>
                                <template x-if="!item.is_piutang || item.piutang_lunas_at">
                                    <span :style="item.type === 'masuk' ? 'color:#15803d;' : 'color:#b91c1c;'"
                                          x-text="(item.type === 'masuk' ? '+ Rp ' : '- Rp ') + formatNumber(item.jumlah)"></span>
                                </template>
                            </td>
                            <td style="text-align:center;">
                                <span :class="item.type === 'masuk' ? 'badge badge-green' : 'badge badge-red'"
                                      x-text="item.type === 'masuk' ? 'Pemasukan' : 'Pengeluaran'"></span>
                            </td>
                            <td style="text-align:center;">
                                <template x-if="item.bukti_gambar && window.DHSKasHelper.isPdf(item.bukti_gambar)">
                                    <a :href="item.bukti_gambar" target="_blank" class="badge badge-red" style="text-decoration:none;">PDF</a>
                                </template>
                                <template x-if="item.bukti_gambar && !window.DHSKasHelper.isPdf(item.bukti_gambar)">
                                    <a :href="item.bukti_gambar" target="_blank">
                                        <img :src="item.bukti_gambar" style="width:36px;height:36px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;">
                                    </a>
                                </template>
                                <template x-if="!item.bukti_gambar">
                                    <span style="color:#cbd5e1;">—</span>
                                </template>
                            </td>
                            <td style="text-align:center;white-space:nowrap;">
                                <div style="display:inline-flex;align-items:center;gap:5px;">
                                    <template x-if="item.is_piutang && !item.piutang_lunas_at">
                                        <button type="button" class="btn-icon" title="Bayar / Lunasi Piutang" x-on:click="lunasPiutang(item)">
                                            <span class="material-icons-round" style="font-size:18px;color:#16a34a;">payments</span>
                                        </button>
                                    </template>
                                    <a :href="'/backoffice/kas/' + item.id + '/kwitansi'" target="_blank" class="btn-icon" title="Cetak Kwitansi">
                                        <span class="material-icons-round" style="font-size:18px;color:#2563eb;">receipt_long</span>
                                    </a>
                                    <button type="button" class="btn-icon" title="Edit" x-on:click="openModal('edit', item)">
                                        <span class="material-icons-round" style="font-size:18px;color:#374151;">edit</span>
                                    </button>
                                    <button type="button" class="btn-icon danger" title="Hapus" x-on:click="deleteItem(item.id)">
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
                'optProgramMasuk'    => $optProgramMasuk ?? $optMasukList,
                'optProgramKeluar'   => $optProgramKeluar ?? $optKeluarList,
            ])
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

    @include('backoffice.partials.kas-piutang-pay-modal', ['payScope' => 'piutangPay', 'payRedirect' => '/backoffice/kas-kategori-kas/' . $kategori->id])

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
                keterangan: '',
                kodeMode: 'auto',
                kode: '',
                bukti_gambar: '',
            },
        },
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

        formatNumber(n)  { return window.DHSKasHelper.formatNumber(n); },
        formatTanggal(s) { return window.DHSKasHelper.formatTanggal(s); },

        openModal(mode, item) {
            this.modal.mode   = mode;
            this.modal.editId = item ? item.id : null;
            if (mode === 'add') {
                this.modal.form = {
                    editMode:           false,
                    program_ref:        '{{ $firstProgId ? "prog:" . $firstProgId : "" }}',
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
                const isPendingPt = !!(item.is_piutang && !item.piutang_lunas_at);
                this.modal.form = {
                    editMode:           true,
                    program_ref:        ref,
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

        lunasPiutang(item) {
            const sisa = parseFloat(item.jumlah) || 0;
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
