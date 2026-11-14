@extends('backoffice.layouts.app')

@section('title', 'Keuangan ' . $project->display_program_title)
@section('page-title', 'Detail Keuangan Program')

@php
    $optMasukList   = !empty($optMasuk) ? array_values(array_unique($optMasuk)) : [];
    $optKeluarList  = !empty($optKeluar) ? array_values(array_unique($optKeluar)) : [];
    $unitsData      = $units ?? ['Orang', 'Unit', 'Hari', 'Paket', 'Jam', 'Bulan', 'Pcs', 'Sesi', 'Semester', 'Lot', 'Set'];
    $projectsData   = $mappedProjects ?? collect();
    $tglMulaiStr    = $project->tanggal_mulai ? $project->tanggal_mulai->format('d M Y') : '-';
    $tglSelesaiStr  = $project->tanggal_selesai ? $project->tanggal_selesai->format('d M Y') : '-';
    $kodeProgramShow = $project->kode_proyek ?: ('PRG-' . str_pad($project->id, 5, '0', STR_PAD_LEFT));
@endphp

@section('content')
<div x-data="kasProgramDetailData()">

    {{-- ── Flash Message ───────────────────────────────────── --}}
    @if(session('success'))
    <div class="bo-card" style="border-left:4px solid #22c55e;margin-bottom:1rem;padding:.85rem 1.15rem;color:#166534;background:#f0fdf4;display:flex;align-items:center;gap:8px;font-weight:600;">
        <span class="material-icons-round" style="font-size:20px;">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- ── Breadcrumb ──────────────────────────────────────── --}}
    <div style="font-size:12.5px;color:#64748b;margin-bottom:10px;display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
        <a href="/backoffice/dashboard" style="color:#64748b;text-decoration:none;">Admin</a>
        <span>&rsaquo;</span>
        <a href="/backoffice/kas" style="color:#64748b;text-decoration:none;">Keuangan Umum</a>
        <span>&rsaquo;</span>
        <a href="/backoffice/kas-keuangan-program" style="color:#64748b;text-decoration:none;">Keuangan Program</a>
        <span>&rsaquo;</span>
        <strong style="color:#0f172a;">{{ $project->nama_proyek }}</strong>
    </div>

    {{-- ── Header Judul (Format Revisi 4 untuk Sekolah Perhotelan) ── --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:14px;margin-bottom:1.25rem;">
        <div>
            <h2 style="margin:0 0 4px;font-size:24px;font-weight:800;color:#0f172a;font-family:'Inter',sans-serif;">
                Keuangan {{ $project->display_program_title }}
            </h2>
            <div style="font-size:13.5px;color:#475569;display:flex;flex-wrap:wrap;align-items:center;gap:8px;">
                <strong style="color:#1e293b;">{{ $project->nama_proyek }}</strong>
                <span>&bull;</span>
                <span>{{ $tglMulaiStr }} – {{ $tglSelesaiStr }}</span>
                <span>&bull;</span>
                <span>PIC: <strong style="color:#0f172a;">{{ $project->pic }}</strong></span>
                @if($project->keterangan)
                    <span>&bull;</span>
                    <span style="color:#64748b;">{{ $project->keterangan }}</span>
                @endif
            </div>
        </div>

        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <a href="/backoffice/kas-keuangan-program"
               style="display:inline-flex;align-items:center;gap:6px;padding:9px 16px;background:#fff;border:1.5px solid #e2e8f0;border-radius:10px;color:#334155;font-size:13px;font-weight:600;text-decoration:none;">
                <span class="material-icons-round" style="font-size:17px;">arrow_back</span>
                Keuangan Program
            </a>
        </div>
    </div>

    {{-- ── Card Info Program & Nilai Program (Gaya Foto 5) ───── --}}
    <div class="bo-card" style="padding:22px 24px;margin-bottom:1.25rem;border:1px solid #e2e8f0;border-radius:16px;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:16px;">
            <div>
                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:6px;">
                    <span style="background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;padding:3px 10px;border-radius:6px;font-size:11.5px;font-weight:700;font-family:monospace;">
                        {{ $kodeProgramShow }}
                    </span>
                    <span style="font-size:18px;font-weight:800;color:#0f172a;">{{ $project->nama_proyek }}</span>
                    <span style="background:#f1f5f9;color:#475569;padding:3px 10px;border-radius:6px;font-size:12px;font-weight:600;">
                        PIC: {{ $project->pic }}
                    </span>
                </div>
                <div style="font-size:12.5px;color:#64748b;">
                    Program: <strong style="color:#334155;">{{ $project->display_program_title }}</strong>
                    &bull; Periode: <strong style="color:#334155;">{{ $tglMulaiStr }} – {{ $tglSelesaiStr }}</strong>
                    @if($project->keterangan)
                        &bull; Ket: {{ $project->keterangan }}
                    @endif
                </div>
            </div>

            <div>
                @if($summary['is_lunas'])
                    <span style="display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:99px;background:#dcfce7;color:#15803d;font-size:12px;font-weight:700;">
                        <span style="width:7px;height:7px;border-radius:50%;background:#16a34a;"></span>
                        Status Bayar: Lunas
                    </span>
                @elseif($summary['is_piutang'])
                    <span style="display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:99px;background:#fef3c7;color:#b45309;font-size:12px;font-weight:700;">
                        <span style="width:7px;height:7px;border-radius:50%;background:#d97706;"></span>
                        Status Bayar: Piutang / Belum Lunas
                    </span>
                @else
                    <span style="display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:99px;background:#f1f5f9;color:#475569;font-size:12px;font-weight:700;">
                        Status: Nilai Program Belum Diset
                    </span>
                @endif
            </div>
        </div>

        {{-- Nilai / Harga Program Inline Box --}}
        <form method="POST" action="/backoffice/kas-program/{{ $project->id }}/update-nilai"
              style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:14px 18px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;">
            @csrf
            <div>
                <div style="font-size:11.5px;font-weight:800;letter-spacing:.05em;color:#334155;text-transform:uppercase;margin-bottom:2px;">
                    NILAI / TARGET BIAYA PROGRAM:
                </div>
                <div style="font-size:12px;color:#64748b;">
                    Tentukan nilai total target program untuk menghitung status pelunasan, piutang, dan laba bersih.
                </div>
            </div>
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                <div style="position:relative;display:flex;align-items:center;">
                    <span style="position:absolute;left:12px;font-size:13px;font-weight:700;color:#64748b;">Rp</span>
                    <input type="text"
                           name="nilai_proyek"
                           x-model="nilaiDisplay"
                           x-on:input="nilaiDisplay = window.DHSKasHelper.formatRupiahString($event.target.value)"
                           class="bo-input"
                           style="width:190px;padding:9px 12px 9px 36px;font-weight:700;font-size:14px;border-radius:10px;background:#fff;"
                           inputmode="numeric">
                </div>
                <button type="submit"
                        style="display:inline-flex;align-items:center;gap:6px;padding:9px 16px;background:#0f172a;color:#fff;border:none;border-radius:10px;font-size:13px;font-weight:700;cursor:pointer;">
                    <span class="material-icons-round" style="font-size:16px;">save</span>
                    Simpan Nilai
                </button>
            </div>
        </form>
    </div>

    {{-- ── 5 Summary Cards (Sesuai Foto 3 & Foto 5) ────────── --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:14px;margin-bottom:1.5rem;">

        <div class="bo-card" style="padding:16px 18px;border:1px solid #e2e8f0;border-radius:14px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                <span style="font-size:11px;font-weight:700;color:#64748b;letter-spacing:.05em;">NILAI PROGRAM</span>
                <span style="font-size:10.5px;font-weight:700;padding:2px 8px;border-radius:99px;background:#f1f5f9;color:#475569;">100%</span>
            </div>
            <div style="font-size:20px;font-weight:800;color:#0f172a;">Rp {{ number_format($summary['nilai_proyek'], 0, ',', '.') }}</div>
            <div style="font-size:11.5px;color:#64748b;margin-top:4px;">Target Program</div>
        </div>

        <div class="bo-card" style="padding:16px 18px;border:1px solid #e2e8f0;border-left:4px solid #16a34a;border-radius:14px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                <span style="font-size:11px;font-weight:700;color:#64748b;letter-spacing:.05em;">TOTAL TERBAYAR</span>
                <span style="font-size:10.5px;font-weight:700;padding:2px 8px;border-radius:99px;background:#dcfce7;color:#15803d;">{{ $summary['persen_bayar'] }}%</span>
            </div>
            <div style="font-size:20px;font-weight:800;color:#15803d;">Rp {{ number_format($summary['total_masuk'], 0, ',', '.') }}</div>
            <div style="width:100%;height:5px;background:#e2e8f0;border-radius:99px;overflow:hidden;margin-top:8px;">
                <div style="height:100%;background:#16a34a;border-radius:99px;width:{{ $summary['persen_bayar'] }}%;"></div>
            </div>
        </div>

        <div class="bo-card" style="padding:16px 18px;border:1px solid #e2e8f0;border-left:4px solid {{ $summary['sisa_tagihan'] > 0 ? '#dc2626' : '#16a34a' }};border-radius:14px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                <span style="font-size:11px;font-weight:700;color:#64748b;letter-spacing:.05em;">SISA TAGIHAN</span>
                <span style="font-size:10.5px;font-weight:700;padding:2px 8px;border-radius:99px;background:{{ $summary['sisa_tagihan'] > 0 ? '#fef3c7' : '#dcfce7' }};color:{{ $summary['sisa_tagihan'] > 0 ? '#b45309' : '#15803d' }};">
                    {{ $summary['persen_sisa'] }}%
                </span>
            </div>
            <div style="font-size:20px;font-weight:800;color:{{ $summary['sisa_tagihan'] > 0 ? '#b91c1c' : '#15803d' }};">
                Rp {{ number_format($summary['sisa_tagihan'], 0, ',', '.') }}
            </div>
            <div style="font-size:11.5px;color:{{ $summary['sisa_tagihan'] > 0 ? '#b45309' : '#15803d' }};margin-top:4px;font-weight:600;">
                {{ $summary['is_lunas'] ? 'Sudah Lunas' : ($summary['is_piutang'] ? 'Belum Lunas (Piutang)' : '-') }}
            </div>
        </div>

        <div class="bo-card" style="padding:16px 18px;border:1px solid #e2e8f0;border-left:4px solid #f59e0b;border-radius:14px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                <span style="font-size:11px;font-weight:700;color:#64748b;letter-spacing:.05em;">BIAYA PROGRAM</span>
                <span style="font-size:10.5px;font-weight:700;padding:2px 8px;border-radius:99px;background:#fef3c7;color:#b45309;">{{ $summary['persen_biaya'] }}%</span>
            </div>
            <div style="font-size:20px;font-weight:800;color:#b45309;">Rp {{ number_format($summary['total_keluar'], 0, ',', '.') }}</div>
            <div style="font-size:11.5px;color:#64748b;margin-top:4px;">{{ $summary['count_keluar'] }} item ({{ $summary['persen_biaya'] }}% dari target)</div>
        </div>

        <div class="bo-card" style="padding:16px 18px;border:1px solid #e2e8f0;border-left:4px solid #2563eb;border-radius:14px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                <span style="font-size:11px;font-weight:700;color:#64748b;letter-spacing:.05em;">LABA BERSIH</span>
                <span style="font-size:10.5px;font-weight:700;padding:2px 8px;border-radius:99px;background:#dbeafe;color:#1d4ed8;">{{ $summary['margin_laba'] }}%</span>
            </div>
            <div style="font-size:20px;font-weight:800;color:{{ $summary['laba_bersih'] >= 0 ? '#1d4ed8' : '#dc2626' }};">
                Rp {{ number_format($summary['laba_bersih'], 0, ',', '.') }}
            </div>
            <div style="font-size:11.5px;color:#64748b;margin-top:4px;">Margin {{ $summary['margin_laba'] }}%</div>
        </div>

    </div>

    {{-- ── Tab Navigasi: Pemasukan | Pengeluaran | Piutang (Revisi 5 & 6) ── --}}
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:1.25rem;flex-wrap:wrap;">
        <button type="button"
                x-on:click="activeTab = 'masuk'"
                style="display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:11px;font-size:13.5px;font-weight:700;cursor:pointer;transition:all .15s;"
                :style="activeTab === 'masuk' ? 'background:#0f172a;color:#fff;border:1.5px solid #0f172a;box-shadow:0 4px 12px rgba(15,23,42,0.18);' : 'background:#fff;color:#334155;border:1.5px solid #e2e8f0;'">
            <span class="material-icons-round" style="font-size:18px;" :style="activeTab === 'masuk' ? 'color:#4ade80;' : 'color:#16a34a;'">payments</span>
            <span>Pemasukan</span>
            <span style="padding:1px 8px;border-radius:99px;font-size:11px;"
                  :style="activeTab === 'masuk' ? 'background:rgba(255,255,255,0.2);color:#fff;' : 'background:#f1f5f9;color:#475569;'">
                {{ count($pemasukanList) }}
            </span>
        </button>

        <button type="button"
                x-on:click="activeTab = 'keluar'"
                style="display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:11px;font-size:13.5px;font-weight:700;cursor:pointer;transition:all .15s;"
                :style="activeTab === 'keluar' ? 'background:#0f172a;color:#fff;border:1.5px solid #0f172a;box-shadow:0 4px 12px rgba(15,23,42,0.18);' : 'background:#fff;color:#334155;border:1.5px solid #e2e8f0;'">
            <span class="material-icons-round" style="font-size:18px;" :style="activeTab === 'keluar' ? 'color:#fca5a5;' : 'color:#dc2626;'">shopping_bag</span>
            <span>Pengeluaran</span>
            <span style="padding:1px 8px;border-radius:99px;font-size:11px;"
                  :style="activeTab === 'keluar' ? 'background:rgba(255,255,255,0.2);color:#fff;' : 'background:#f1f5f9;color:#475569;'">
                {{ count($pengeluaranList) }}
            </span>
        </button>

        <button type="button"
                x-on:click="activeTab = 'piutang'"
                style="display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:11px;font-size:13.5px;font-weight:700;cursor:pointer;transition:all .15s;"
                :style="activeTab === 'piutang' ? 'background:#b45309;color:#fff;border:1.5px solid #b45309;box-shadow:0 4px 12px rgba(180,83,9,0.25);' : 'background:#fff;color:#b45309;border:1.5px solid #fde68a;'">
            <span class="material-icons-round" style="font-size:18px;">pending_actions</span>
            <span>Piutang (Belum Lunas)</span>
            <span style="padding:1px 8px;border-radius:99px;font-size:11px;"
                  :style="activeTab === 'piutang' ? 'background:rgba(255,255,255,0.25);color:#fff;' : 'background:#fef3c7;color:#b45309;'">
                {{ count($pendingPiutangTrx ?? []) + count($unpaidProjects) }}
            </span>
        </button>
    </div>

    {{-- ── TAB 1: PEMASUKAN ──────────────────────────────────── --}}
    <div x-show="activeTab === 'masuk'">
        <div class="bo-card" style="padding:22px 24px;border:1px solid #e2e8f0;border-radius:16px;margin-bottom:1.25rem;">
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:38px;height:38px;border-radius:10px;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;">
                        <span class="material-icons-round">payments</span>
                    </div>
                    <div>
                        <h3 style="margin:0;font-size:15.5px;font-weight:700;color:#0f172a;font-family:'Inter',sans-serif;">Pemasukan</h3>
                        <div style="font-size:12px;color:#64748b;">Catat pembayaran SPP, pendaftaran, termin, atau pelunasan program</div>
                    </div>
                </div>
                <span style="background:#dcfce7;color:#15803d;padding:5px 12px;border-radius:8px;font-size:12.5px;font-weight:700;">
                    Total Diterima: Rp {{ number_format($summary['total_masuk'], 0, ',', '.') }}
                </span>
            </div>

            @include('backoffice.partials.kas-transaction-form', [
                'scope'              => 'formMasuk',
                'actionExpr'         => "'/backoffice/kas/store'",
                'programScopeMode'   => 'locked',
                'lockedProgramRef'   => 'proj:' . $project->id,
                'lockedProgramLabel' => $project->display_program_title . ' — ' . $project->nama_proyek,
                'redirectValue'      => '/backoffice/kas-program-detail/' . $project->id,
                'submitText'         => 'Simpan Pemasukan',
                'showCancel'         => false,
                'btnBg'              => '#15803d',
                'piutangCategories'  => $piutangCategories ?? [],
                'optProgramMasuk'    => $optProgramMasuk ?? $optMasukList,
                'optProgramKeluar'   => $optProgramKeluar ?? $optKeluarList,
            ])
        </div>

        <div class="bo-card" style="padding:0;overflow:hidden;border:1px solid #e2e8f0;border-radius:16px;">
            <div style="padding:14px 20px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;background:#fafafa;">
                <span style="font-size:11.5px;font-weight:800;letter-spacing:.06em;color:#475569;text-transform:uppercase;">RIWAYAT PEMASUKAN</span>
                <span style="font-size:12px;color:#64748b;">{{ count($pemasukanList) }} transaksi tercatat</span>
            </div>
            <div>
                <table class="bo-table kas-transaction-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th style="text-align:center;">Vol &amp; Satuan</th>
                            <th style="text-align:right;">Harga Satuan</th>
                            <th style="text-align:right;">Nominal</th>
                            <th style="text-align:center;">Bukti Nota</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemasukanList as $trx)
                            @php
                                $isPendingPt = $trx->is_piutang && !$trx->piutang_lunas_at;
                            @endphp
                            <tr style="{{ $isPendingPt ? 'background:#fffbeb;' : '' }}">
                                <td style="white-space:nowrap;">{{ $trx->tanggal ? $trx->tanggal->format('d M Y') : '-' }}</td>
                                <td>
                                    <div style="font-weight:700;color:#0f172a;">{{ $trx->deskripsi ?: '-' }}</div>
                                    <div style="font-size:11.5px;color:#64748b;font-family:monospace;">{{ $trx->kode ?: '-' }}</div>
                                    @if($trx->piutang_nama)
                                        <span style="display:inline-block;margin-top:3px;padding:2px 7px;border-radius:6px;font-size:11px;font-weight:700;background:{{ $isPendingPt ? '#fef3c7' : '#f1f5f9' }};color:{{ $isPendingPt ? '#b45309' : '#475569' }};">
                                            {{ $isPendingPt ? 'Piutang: ' : 'Penanggung: ' }}{{ $trx->piutang_nama }}
                                        </span>
                                    @endif
                                </td>
                                <td style="font-weight:600;color:#334155;">{{ $trx->jenis }}</td>
                                <td style="text-align:center;white-space:nowrap;">{{ (float)($trx->volume ?? 1) }} {{ $trx->satuan ?: 'Paket' }}</td>
                                <td style="text-align:right;white-space:nowrap;color:#64748b;">Rp {{ number_format($trx->harga_satuan ?? $trx->jumlah, 0, ',', '.') }}</td>
                                <td style="text-align:right;white-space:nowrap;font-weight:800;color:{{ $isPendingPt ? '#b45309' : '#15803d' }};">
                                    @if($isPendingPt)
                                        <span style="display:block;font-size:10.5px;font-weight:700;">(Piutang - Belum Masuk)</span>
                                    @endif
                                    Rp {{ number_format($trx->jumlah, 0, ',', '.') }}
                                </td>
                                <td style="text-align:center;">
                                    @if($trx->bukti_gambar)
                                        @if(str_ends_with(strtolower($trx->bukti_gambar), '.pdf'))
                                            <a href="{{ $trx->bukti_gambar }}" target="_blank" class="badge badge-red" style="text-decoration:none;">PDF</a>
                                        @else
                                            <a href="{{ $trx->bukti_gambar }}" target="_blank">
                                                <img src="{{ $trx->bukti_gambar }}" style="width:36px;height:36px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;">
                                            </a>
                                        @endif
                                    @else
                                        <span style="color:#94a3b8;">—</span>
                                    @endif
                                </td>
                                <td style="text-align:center;white-space:nowrap;">
                                    <div style="display:inline-flex;align-items:center;gap:6px;">
                                        <button type="button" class="btn-icon danger" title="Hapus" aria-label="Hapus transaksi" x-on:click="deleteTrx({{ $trx->id }})">
                                            <span class="material-icons-round" style="font-size:17px;">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center;padding:2rem;color:#94a3b8;">Belum ada riwayat pemasukan pada program ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ── TAB 2: PENGELUARAN ────────────────────────────────── --}}
    <div x-show="activeTab === 'keluar'" style="display:none;">
        <div class="bo-card" style="padding:22px 24px;border:1px solid #e2e8f0;border-radius:16px;margin-bottom:1.25rem;">
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:38px;height:38px;border-radius:10px;background:#fee2e2;color:#dc2626;display:flex;align-items:center;justify-content:center;">
                        <span class="material-icons-round">shopping_bag</span>
                    </div>
                    <div>
                        <h3 style="margin:0;font-size:15.5px;font-weight:700;color:#0f172a;font-family:'Inter',sans-serif;">Pengeluaran</h3>
                        <div style="font-size:12px;color:#64748b;">Catat pembelian bahan praktik, honor instruktur/dosen, dan operasional program</div>
                    </div>
                </div>
                <span style="background:#fee2e2;color:#b91c1c;padding:5px 12px;border-radius:8px;font-size:12.5px;font-weight:700;">
                    Total Biaya: Rp {{ number_format($summary['total_keluar'], 0, ',', '.') }}
                </span>
            </div>

            @include('backoffice.partials.kas-transaction-form', [
                'scope'              => 'formKeluar',
                'actionExpr'         => "'/backoffice/kas/store'",
                'programScopeMode'   => 'locked',
                'lockedProgramRef'   => 'proj:' . $project->id,
                'lockedProgramLabel' => $project->display_program_title . ' — ' . $project->nama_proyek,
                'redirectValue'      => '/backoffice/kas-program-detail/' . $project->id,
                'submitText'         => 'Simpan Pengeluaran',
                'showCancel'         => false,
                'btnBg'              => '#dc2626',
                'piutangCategories'  => $piutangCategories ?? [],
                'optProgramMasuk'    => $optProgramMasuk ?? $optMasukList,
                'optProgramKeluar'   => $optProgramKeluar ?? $optKeluarList,
            ])
        </div>

        <div class="bo-card" style="padding:0;overflow:hidden;border:1px solid #e2e8f0;border-radius:16px;">
            <div style="padding:14px 20px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;background:#fafafa;">
                <span style="font-size:11.5px;font-weight:800;letter-spacing:.06em;color:#475569;text-transform:uppercase;">RIWAYAT PENGELUARAN</span>
                <span style="font-size:12px;color:#64748b;">{{ count($pengeluaranList) }} transaksi tercatat</span>
            </div>
            <div>
                <table class="bo-table kas-transaction-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th style="text-align:center;">Vol &amp; Satuan</th>
                            <th style="text-align:right;">Harga Satuan</th>
                            <th style="text-align:right;">Nominal</th>
                            <th style="text-align:center;">Bukti Nota</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengeluaranList as $trx)
                            <tr>
                                <td style="white-space:nowrap;">{{ $trx->tanggal ? $trx->tanggal->format('d M Y') : '-' }}</td>
                                <td>
                                    <div style="font-weight:700;color:#0f172a;">{{ $trx->deskripsi ?: '-' }}</div>
                                    <div style="font-size:11.5px;color:#64748b;font-family:monospace;">{{ $trx->kode ?: '-' }}</div>
                                </td>
                                <td style="font-weight:600;color:#334155;">{{ $trx->jenis }}</td>
                                <td style="text-align:center;white-space:nowrap;">{{ (float)($trx->volume ?? 1) }} {{ $trx->satuan ?: 'Paket' }}</td>
                                <td style="text-align:right;white-space:nowrap;color:#64748b;">Rp {{ number_format($trx->harga_satuan ?? $trx->jumlah, 0, ',', '.') }}</td>
                                <td style="text-align:right;white-space:nowrap;font-weight:800;color:#b91c1c;">Rp {{ number_format($trx->jumlah, 0, ',', '.') }}</td>
                                <td style="text-align:center;">
                                    @if($trx->bukti_gambar)
                                        @if(str_ends_with(strtolower($trx->bukti_gambar), '.pdf'))
                                            <a href="{{ $trx->bukti_gambar }}" target="_blank" class="badge badge-red" style="text-decoration:none;">PDF</a>
                                        @else
                                            <a href="{{ $trx->bukti_gambar }}" target="_blank">
                                                <img src="{{ $trx->bukti_gambar }}" style="width:36px;height:36px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;">
                                            </a>
                                        @endif
                                    @else
                                        <span style="color:#94a3b8;">—</span>
                                    @endif
                                </td>
                                <td style="text-align:center;white-space:nowrap;">
                                    <div style="display:inline-flex;align-items:center;gap:6px;">
                                        <button type="button" class="btn-icon danger" title="Hapus" aria-label="Hapus transaksi" x-on:click="deleteTrx({{ $trx->id }})">
                                            <span class="material-icons-round" style="font-size:17px;">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center;padding:2rem;color:#94a3b8;">Belum ada riwayat pengeluaran pada program ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ── TAB 3: PIUTANG (TAGIHAN SISWA/DP & PROGRAM BELUM LUNAS) ── --}}
    <div x-show="activeTab === 'piutang'" style="display:none;">
        {{-- Bagian A: Tagihan Siswa / Sisa DP pada Program Ini --}}
        <div class="bo-card" style="padding:0;overflow:hidden;border:1px solid #fde68a;border-radius:16px;margin-bottom:1.25rem;">
            <div style="padding:16px 20px;border-bottom:1px solid #fef3c7;display:flex;align-items:center;justify-content:space-between;background:#fffbeb;flex-wrap:wrap;gap:10px;">
                <div>
                    <h3 style="margin:0;font-size:15px;font-weight:700;color:#92400e;font-family:'Inter',sans-serif;">Tagihan Siswa / Sisa DP Belum Lunas (Program Ini)</h3>
                    <div style="font-size:12px;color:#b45309;">Klik Bayar / Lunasi untuk mencatat pelunasan penuh atau cicilan masuk ke kas</div>
                </div>
            </div>
            <div>
                <table class="bo-table kas-transaction-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th style="text-align:right;">Sisa Piutang</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingPiutangTrx ?? [] as $ptx)
                            <tr>
                                <td style="white-space:nowrap;">{{ $ptx->tanggal ? $ptx->tanggal->format('d M Y') : '-' }}</td>
                                <td>
                                    <div style="font-weight:700;color:#b45309;">{{ $ptx->piutang_nama ?: 'Belum Dinamai' }}</div>
                                    <div style="font-weight:600;color:#0f172a;">{{ $ptx->deskripsi ?: '-' }}</div>
                                    <div style="font-size:11px;color:#64748b;font-family:monospace;">{{ $ptx->kode ?: '-' }}</div>
                                </td>
                                <td>{{ $ptx->jenis }}</td>
                                <td style="text-align:right;font-weight:800;color:#b45309;">Rp {{ number_format($ptx->jumlah, 0, ',', '.') }}</td>
                                <td style="text-align:center;">
                                    <span style="color:#64748b;font-size:12px;">Gunakan Edit pada transaksi</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center;padding:1.75rem;color:#64748b;">
                                    Tidak ada tagihan siswa / sisa DP terpisah pada program ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Bagian B: Daftar Semua Program Belum Lunas --}}
        <div class="bo-card" style="padding:0;overflow:hidden;border:1px solid #fde68a;border-radius:16px;">
            <div style="padding:16px 20px;border-bottom:1px solid #fef3c7;display:flex;align-items:center;justify-content:space-between;background:#fffbeb;flex-wrap:wrap;gap:10px;">
                <div>
                    <h3 style="margin:0;font-size:15px;font-weight:700;color:#92400e;font-family:'Inter',sans-serif;">Daftar Program Belum Lunas (Piutang)</h3>
                    <div style="font-size:12px;color:#b45309;">Menampilkan semua program yang pembayarannya masih kurang dari Nilai Program</div>
                </div>
                <a href="/backoffice/kas-keuangan-program" class="btn-secondary" style="font-size:12.5px;padding:7px 14px;border-color:#b45309;color:#b45309;">
                    Kembali ke Keuangan Program
                </a>
            </div>
            <div>
                <table class="bo-table kas-transaction-table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>PIC</th>
                            <th style="text-align:right;">Nilai Program</th>
                            <th style="text-align:right;">Terbayar</th>
                            <th style="text-align:right;">Sisa Tagihan (Piutang)</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($unpaidProjects as $up)
                            <tr>
                                <td style="font-family:monospace;color:#64748b;">{{ $up['kode_proyek'] }}</td>
                                <td>
                                    <div style="font-size:11px;font-weight:700;color:#2563eb;">{{ $up['program_title'] }}</div>
                                    <div style="font-weight:700;color:#0f172a;">{{ $up['nama_proyek'] }}</div>
                                </td>
                                <td style="font-weight:600;color:#334155;">{{ $up['pic'] }}</td>
                                <td style="text-align:right;font-weight:700;">Rp {{ number_format($up['nilai_proyek'], 0, ',', '.') }}</td>
                                <td style="text-align:right;color:#15803d;font-weight:700;">
                                    Rp {{ number_format($up['total_masuk'], 0, ',', '.') }}
                                    <span style="display:block;font-size:11px;color:#64748b;font-weight:500;">({{ $up['persen_bayar'] }}%)</span>
                                </td>
                                <td style="text-align:right;color:#b91c1c;font-weight:800;">Rp {{ number_format($up['sisa_tagihan'], 0, ',', '.') }}</td>
                                <td style="text-align:center;">
                                    <a href="/backoffice/kas-program-detail/{{ $up['id'] }}" class="btn-primary" style="padding:6px 12px;font-size:12px;">
                                        Catat Pelunasan
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center;padding:2.5rem;color:#15803d;font-weight:600;">
                                    Semua program sudah lunas! Tidak ada piutang tersisa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <form id="programTrxDeleteForm" method="POST" action="" style="display:none;">
        @csrf
        <input type="hidden" name="redirect_to" value="/backoffice/kas-program-detail/{{ $project->id }}">
    </form>

</div>
@endsection

@push('scripts')
@include('backoffice.partials.kas-helpers-js')
<script>
function kasProgramDetailData() {
    const today = new Date().toISOString().slice(0, 10);
    return {
        activeTab:      'masuk',
        nilaiDisplay:   '{{ $project->nilai_proyek ? number_format($project->nilai_proyek, 0, ",", ".") : "0" }}',
        projects:       @json($projectsData),
        unitsList:      @json($unitsData),
        pendingTrxList: @json($pendingPiutangTrx ?? []),


        formMasuk: {
            editMode:           false,
            program_ref:        'proj:{{ $project->id }}',
            tanggal:            today,
            type:               'masuk',
            jenis:              '',
            deskripsi:          '',
            satuan:             'Paket',
            volume:             1,
            hargaSatuanDisplay: '',
            payment_mode:       'lunas',
            totalHargaDisplay:  '',
            dpNominalDisplay:   '',
            piutang_nama:       '',
            keterangan:         '',
            kodeMode:           'auto',
            kode:               '',
            bukti_gambar:       '',
        },

        formKeluar: {
            editMode:           false,
            program_ref:        'proj:{{ $project->id }}',
            tanggal:            today,
            type:               'keluar',
            jenis:              '',
            deskripsi:          '',
            satuan:             'Paket',
            volume:             1,
            hargaSatuanDisplay: '',
            payment_mode:       'lunas',
            totalHargaDisplay:  '',
            dpNominalDisplay:   '',
            piutang_nama:       '',
            keterangan:         '',
            kodeMode:           'auto',
            kode:               '',
            bukti_gambar:       '',
        },

        deleteTrx(id) {
            if (!confirm('Yakin ingin menghapus transaksi ini?')) return;
            const form = document.getElementById('programTrxDeleteForm');
            form.action = '/backoffice/kas/' + id + '/delete';
            form.submit();
        }
    };
}
</script>
@endpush

