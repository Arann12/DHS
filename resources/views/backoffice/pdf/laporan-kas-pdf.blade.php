<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan & Arus Kas - Denpasar Hotel School</title>
    <style>
        @page {
            margin: 24px 30px 32px 30px;
            size: a4 landscape;
        }

        * {
            box-sizing: border-box;
            font-family: 'DejaVu Sans', 'Helvetica Neue', Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            font-size: 9px;
            color: #1e293b;
            line-height: 1.35;
            background-color: #ffffff;
        }

        /* ── KOP SURAT RESMI DHS ── */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .kop-logo {
            width: 75px;
            vertical-align: middle;
            text-align: left;
            padding-right: 14px;
        }

        .kop-logo img {
            max-height: 60px;
            max-width: 75px;
        }

        .kop-text {
            vertical-align: middle;
            text-align: left;
        }

        .kop-title {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .kop-subtitle {
            font-size: 10px;
            font-weight: 700;
            color: #1e3a8a;
            letter-spacing: 0.3px;
            margin-bottom: 3px;
        }

        .kop-address {
            font-size: 8px;
            color: #475569;
            line-height: 1.3;
        }

        .kop-divider-primary {
            border: none;
            border-top: 2.5px solid #1e3a8a;
            margin: 0;
            padding: 0;
        }

        .kop-divider-gold {
            border: none;
            border-top: 1px solid #d97706;
            margin-top: 1.5px;
            margin-bottom: 12px;
        }

        /* ── DOKUMEN HEADER & PARAMETER META ── */
        .report-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
        }

        .report-title-cell {
            padding: 8px 12px;
            vertical-align: middle;
            border-right: 1px solid #e2e8f0;
            width: 45%;
        }

        .report-title {
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 2px;
        }

        .report-sub {
            font-size: 8.5px;
            font-weight: 600;
            color: #0284c7;
        }

        .report-meta-cell {
            padding: 6px 12px;
            vertical-align: middle;
            font-size: 8px;
            color: #334155;
            width: 55%;
        }

        .meta-grid {
            width: 100%;
            border-collapse: collapse;
        }

        .meta-grid td {
            padding: 1.5px 4px;
            vertical-align: top;
        }

        .meta-label {
            font-weight: bold;
            color: #64748b;
            width: 25%;
        }

        .meta-val {
            font-weight: 600;
            color: #0f172a;
        }

        /* ── 4 KARTU RINGKASAN EKSEKUTIF ── */
        .summary-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px 0;
            margin-left: -8px;
            margin-right: -8px;
            margin-bottom: 14px;
        }

        .summary-card {
            padding: 8px 10px;
            border-radius: 6px;
            vertical-align: top;
            width: 25%;
        }

        .card-masuk {
            background-color: #f0fdf4;
            border: 1px solid #86efac;
        }

        .card-keluar {
            background-color: #fef2f2;
            border: 1px solid #fca5a5;
        }

        .card-piutang {
            background-color: #fffbeb;
            border: 1px solid #fde68a;
        }

        .card-selisih {
            background-color: #eff6ff;
            border: 1px solid #93c5fd;
        }

        .card-label {
            font-size: 7.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }

        .card-masuk .card-label { color: #166534; }
        .card-keluar .card-label { color: #991b1b; }
        .card-piutang .card-label { color: #92400e; }
        .card-selisih .card-label { color: #1e40af; }

        .card-value {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .card-masuk .card-value { color: #15803d; }
        .card-keluar .card-value { color: #b91c1c; }
        .card-piutang .card-value { color: #b45309; }
        .card-selisih .card-value { color: #1d4ed8; }

        .card-desc {
            font-size: 7px;
            color: #64748b;
        }

        /* ── TABEL LEDGER TRANSAKSI ── */
        .ledger-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        .ledger-table thead {
            display: table-header-group;
        }

        .ledger-table tr {
            page-break-inside: avoid;
        }

        .ledger-table th {
            background-color: #1e293b;
            color: #ffffff;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            padding: 6px 5px;
            border: 1px solid #0f172a;
            vertical-align: middle;
            text-align: center;
        }

        .ledger-table td {
            font-size: 8px;
            padding: 5px;
            border: 1px solid #cbd5e1;
            vertical-align: top;
            color: #334155;
        }

        .ledger-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .ledger-table tfoot td {
            background-color: #f1f5f9;
            font-weight: bold;
            font-size: 8.5px;
            padding: 6px 5px;
            border: 1.5px solid #94a3b8;
            color: #0f172a;
        }

        /* BADGES */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 7px;
            font-weight: bold;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .badge-masuk {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #86efac;
        }

        .badge-keluar {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
        }

        .badge-lunas {
            background-color: #e0f2fe;
            color: #0369a1;
            border: 1px solid #7dd3fc;
        }

        .badge-piutang {
            background-color: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        /* ── SIGNATURE / PENGESAHAN ── */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: avoid;
            margin-top: 18px;
        }

        .signature-table td {
            vertical-align: top;
            width: 50%;
            font-size: 8.5px;
        }

        .sig-box {
            padding: 8px 16px;
        }

        .sig-date {
            margin-bottom: 4px;
            color: #475569;
        }

        .sig-role {
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 42px;
        }

        .sig-name {
            font-weight: bold;
            font-size: 9px;
            color: #0f172a;
            text-decoration: underline;
        }

        .sig-title {
            font-size: 8px;
            color: #64748b;
            margin-top: 2px;
        }
    </style>
</head>
<body>

    {{-- KOP SURAT RESMI DENPASAR HOTEL SCHOOL --}}
    <table class="kop-table">
        <tr>
            <td class="kop-logo">
                @if($logoBase64)
                    <img src="{{ $logoBase64 }}" alt="Logo DHS">
                @endif
            </td>
            <td class="kop-text">
                <div class="kop-title">DENPASAR HOTEL SCHOOL</div>
                <div class="kop-subtitle">LEMBAGA PENDIDIKAN & PELATIHAN PERHOTELAN DAN KAPAL PESIAR INTERNASIONAL</div>
                <div class="kop-address">
                    Kampus Pusat: Jl. Raya Sesetan No. 248 Denpasar Selatan, Bali 80223 | Telp: (0361) 723388<br>
                    Website Resmi: www.denpasarhotelschool.com | Email Resmi: info@denpasarhotelschool.com
                </div>
            </td>
        </tr>
    </table>
    <hr class="kop-divider-primary">
    <hr class="kop-divider-gold">

    {{-- INFORMASI LAPORAN & FILTER METADATA --}}
    <table class="report-header-table">
        <tr>
            <td class="report-title-cell">
                <div class="report-title">LAPORAN ARUS KAS & KEUANGAN</div>
                <div class="report-sub">{{ $scopeLabel }}</div>
            </td>
            <td class="report-meta-cell">
                <table class="meta-grid">
                    <tr>
                        <td class="meta-label">Periode:</td>
                        <td class="meta-val">{{ $periodeLabel }}</td>
                        <td class="meta-label">Tipe Trx:</td>
                        <td class="meta-val">{{ $tipeLabel }}</td>
                    </tr>
                    <tr>
                        <td class="meta-label">Dicetak Pada:</td>
                        <td class="meta-val">{{ $tglCetak }}</td>
                        <td class="meta-label">Status:</td>
                        <td class="meta-val">{{ $statusLabel }}</td>
                    </tr>
                    <tr>
                        <td class="meta-label">Dicetak Oleh:</td>
                        <td class="meta-val">{{ $userName }}</td>
                        <td class="meta-label">Kata Kunci:</td>
                        <td class="meta-val">{{ $searchQuery ?: 'Semua Transaksi' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- 4 KARTU RINGKASAN EKSEKUTIF --}}
    <table class="summary-table">
        <tr>
            {{-- Pemasukan --}}
            <td class="summary-card card-masuk">
                <div class="card-label">TOTAL PEMASUKAN</div>
                <div class="card-value">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</div>
                <div class="card-desc">Dana masuk kas terealisasi</div>
            </td>
            {{-- Pengeluaran --}}
            <td class="summary-card card-keluar">
                <div class="card-label">TOTAL PENGELUARAN</div>
                <div class="card-value">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</div>
                <div class="card-desc">Total belanja operasional & program</div>
            </td>
            {{-- Sisa Piutang --}}
            <td class="summary-card card-piutang">
                <div class="card-label">SISA PIUTANG (UANG LAPANGAN)</div>
                <div class="card-value">Rp {{ number_format($totalPiutang, 0, ',', '.') }}</div>
                <div class="card-desc">Tagihan piutang mahasiswa/klien</div>
            </td>
            {{-- Selisih Bersih --}}
            <td class="summary-card card-selisih">
                <div class="card-label">SELISIH BERSIH (SALDO)</div>
                <div class="card-value">Rp {{ number_format($selisih, 0, ',', '.') }}</div>
                <div class="card-desc">Pemasukan dikurangi Pengeluaran</div>
            </td>
        </tr>
    </table>

    {{-- TABEL BUKU TRANSAKSI (LEDGER) --}}
    <table class="ledger-table">
        <thead>
            <tr>
                <th style="width: 25px;">NO</th>
                <th style="width: 60px;">TANGGAL</th>
                <th style="width: 75px;">KODE</th>
                <th style="width: 100px;">PROGRAM / PROYEK</th>
                <th style="width: 55px;">TRANSAKSI</th>
                <th>DESKRIPSI & KETERANGAN</th>
                <th style="width: 60px;">VOL & SATUAN</th>
                <th style="width: 85px;">HARGA SATUAN</th>
                <th style="width: 90px;">TOTAL (RP)</th>
                <th style="width: 65px;">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $idx => $r)
                @php
                    $isPendingPiutang = ($r->is_piutang && !$r->piutang_lunas_at);
                    $programTitle = $r->project ? $r->project->nama_proyek : ($r->program ? $r->program->title : 'Umum (Non-Program)');
                    $vol = $r->volume ?? 1;
                    $hrg = $r->harga_satuan ?? $r->jumlah;
                @endphp
                <tr>
                    <td style="text-align: center; color: #64748b;">{{ $idx + 1 }}</td>
                    <td style="text-align: center; white-space: nowrap;">
                        {{ $r->tanggal ? \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') : '-' }}
                    </td>
                    <td style="text-align: center; font-weight: bold; color: #0284c7; white-space: nowrap;">
                        {{ $r->kode ?: '-' }}
                    </td>
                    <td style="font-weight: 600; color: #1e293b;">
                        {{ $programTitle }}
                    </td>
                    <td style="text-align: center;">
                        @if($r->type === 'masuk')
                            <span class="badge badge-masuk">Masuk</span>
                        @else
                            <span class="badge badge-keluar">Keluar</span>
                        @endif
                    </td>
                    <td>
                        @if($r->piutang_nama || $r->no_hp)
                            <div style="font-weight: bold; color: #0f172a; margin-bottom: 2px;">
                                {{ $r->piutang_nama ?: 'Pelanggan' }}
                                @if($r->no_hp)
                                    <span style="font-weight: normal; color: #059669; font-size: 7.5px;">({{ $r->no_hp }})</span>
                                @endif
                            </div>
                        @endif
                        <div style="color: #475569; font-size: 8px;">
                            <strong style="color: #0f172a;">{{ $r->jenis ?: '-' }}</strong>
                            @if($r->deskripsi)
                                &bull; {{ $r->deskripsi }}
                            @endif
                        </div>
                        @if($r->keterangan)
                            <div style="font-size: 7.5px; color: #64748b; font-style: italic; margin-top: 2px;">
                                Catatan: {{ strip_tags($r->keterangan) }}
                            </div>
                        @endif
                    </td>
                    <td style="text-align: center; white-space: nowrap;">
                        {{ $vol }} {{ $r->satuan ?: 'Paket' }}
                    </td>
                    <td style="text-align: right; white-space: nowrap; color: #475569;">
                        Rp {{ number_format($hrg, 0, ',', '.') }}
                    </td>
                    <td style="text-align: right; font-weight: bold; white-space: nowrap; color: {{ $r->type === 'masuk' ? '#15803d' : '#b91c1c' }};">
                        {{ $r->type === 'masuk' ? '+' : '-' }}Rp {{ number_format($r->jumlah, 0, ',', '.') }}
                    </td>
                    <td style="text-align: center;">
                        @if($isPendingPiutang)
                            <span class="badge badge-piutang">Cicil</span>
                        @else
                            <span class="badge badge-lunas">Lunas</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center; padding: 25px; color: #64748b; font-style: italic;">
                        Tidak ada data transaksi kas yang sesuai dengan parameter filter yang dipilih.
                    </td>
                </tr>
            @endforelse
        </tbody>
        @if($rows->count() > 0)
            <tfoot>
                <tr>
                    <td colspan="8" style="text-align: right; text-transform: uppercase;">
                        TOTAL AKUMULASI ({{ $rows->count() }} Transaksi):
                    </td>
                    <td style="text-align: right; color: #0f172a;">
                        Rp {{ number_format($rows->sum('jumlah'), 0, ',', '.') }}
                    </td>
                    <td style="text-align: center; font-size: 7.5px; color: #64748b;">
                        -
                    </td>
                </tr>
            </tfoot>
        @endif
    </table>

    {{-- BLOK PENGESAHAN & TANDA TANGAN --}}
    <table class="signature-table">
        <tr>
            <td style="width: 55%;">
                <div class="sig-box">
                    <div class="sig-date">&nbsp;</div>
                    <div class="sig-role">Dibuat & Diverifikasi Oleh:</div>
                    <div class="sig-name">{{ $userName }}</div>
                    <div class="sig-title">Staff Administrasi & Keuangan Denpasar Hotel School</div>
                </div>
            </td>
            <td style="width: 45%;">
                <div class="sig-box" style="text-align: right;">
                    <div class="sig-date">Denpasar, {{ $tglPengesahan }}</div>
                    <div class="sig-role">Mengetahui & Menyetujui:</div>
                    <div class="sig-name">Pimpinan / Direktur DHS</div>
                    <div class="sig-title">Denpasar Hotel School</div>
                </div>
            </td>
        </tr>
    </table>

    {{-- FOOTER NOMOR HALAMAN DOMPDF PHP SCRIPT --}}
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->getFont("DejaVu Sans", "normal");
            $size = 7.5;
            $color = [0.4, 0.45, 0.5];
            
            // Halaman X dari Y di kanan bawah
            $pageText = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $w = $fontMetrics->get_text_width($pageText, $font, $size);
            $pdf->page_text($pdf->get_width() - $w - 30, $pdf->get_height() - 22, $pageText, $font, $size, $color);

            // Watermark Dokumen Resmi di kiri bawah
            $leftText = "Dokumen Resmi Denpasar Hotel School (DHS) | Dicetak: {{ $tglCetak }} | Sistem Keuangan Terintegrasi";
            $pdf->page_text(30, $pdf->get_height() - 22, $leftText, $font, $size, $color);
        }
    </script>

</body>
</html>

