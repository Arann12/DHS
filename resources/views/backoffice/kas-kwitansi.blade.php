@php
    if (!function_exists('penyebut_kas')) {
        function penyebut_kas($nilai) {
            $nilai = abs($nilai);
            $huruf = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
            $temp = "";
            if ($nilai < 12) {
                $temp = " ". $huruf[$nilai];
            } else if ($nilai < 20) {
                $temp = penyebut_kas($nilai - 10). " Belas";
            } else if ($nilai < 100) {
                $temp = penyebut_kas(intval($nilai/10))." Puluh". penyebut_kas($nilai % 10);
            } else if ($nilai < 200) {
                $temp = " Seratus" . penyebut_kas($nilai - 100);
            } else if ($nilai < 1000) {
                $temp = penyebut_kas(intval($nilai/100)) . " Ratus" . penyebut_kas($nilai % 100);
            } else if ($nilai < 2000) {
                $temp = " Seribu" . penyebut_kas($nilai - 1000);
            } else if ($nilai < 1000000) {
                $temp = penyebut_kas(intval($nilai/1000)) . " Ribu" . penyebut_kas($nilai % 1000);
            } else if ($nilai < 1000000000) {
                $temp = penyebut_kas(intval($nilai/1000000)) . " Juta" . penyebut_kas($nilai % 1000000);
            } else if ($nilai < 1000000000000) {
                $temp = penyebut_kas(intval($nilai/1000000000)) . " Milyar" . penyebut_kas(fmod($nilai,1000000000));
            } else if ($nilai < 1000000000000000) {
                $temp = penyebut_kas(intval($nilai/1000000000000)) . " Trilyun" . penyebut_kas(fmod($nilai,1000000000000));
            }
            return $temp;
        }
    }

    if (!function_exists('terbilang_kas')) {
        function terbilang_kas($nilai) {
            if ($nilai < 0) {
                $hasil = "Minus ". trim(penyebut_kas($nilai));
            } else {
                $hasil = trim(penyebut_kas($nilai));
            }
            return $hasil ? $hasil . " Rupiah" : "Nol Rupiah";
        }
    }

    $bulanIndo = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    $tglObj = \Carbon\Carbon::parse($kas->tanggal);
    $tglFormatted = $tglObj->format('d') . ' ' . ($bulanIndo[(int)$tglObj->format('m')] ?? '') . ' ' . $tglObj->format('Y');

    $isMasuk = $kas->type === 'masuk';
    $titleKwitansi = $isMasuk ? 'KWITANSI PENERIMAAN KAS' : 'BUKTI PENGELUARAN KAS';
    $labelPihak = $isMasuk ? 'Telah Diterima Dari' : 'Dibayarkan Kepada';
    $creatorName = $kas->creator->name ?? session('backoffice_user.name') ?? 'Admin Keuangan';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titleKwitansi }} - {{ $kas->kode }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            padding: 24px 16px 48px;
            font-size: 13.5px;
            line-height: 1.5;
        }

        /* ── Top Toolbar (No-Print) ── */
        .toolbar-wrapper {
            max-width: 840px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #ffffff;
            padding: 14px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
        }
        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            font-size: 13.5px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }
        .btn-print {
            background: #1A1F6B;
            color: #ffffff;
        }
        .btn-print:hover {
            background: #101340;
            box-shadow: 0 4px 12px rgba(26,31,107,0.3);
            transform: translateY(-1px);
        }
        .btn-back {
            background: #f8fafc;
            color: #475569;
            border: 1.5px solid #cbd5e1;
        }
        .btn-back:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        /* ── Kwitansi Paper Container ── */
        .kwitansi-sheet {
            max-width: 840px;
            margin: 0 auto;
            background: #ffffff;
            padding: 40px 48px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        /* Decorative watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            font-size: 80px;
            font-weight: 900;
            color: rgba(26, 31, 107, 0.035);
            letter-spacing: 0.15em;
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
            text-transform: uppercase;
        }

        /* ── Header / KOP ── */
        .kop-section {
            display: flex;
            align-items: center;
            gap: 20px;
            padding-bottom: 16px;
            border-bottom: 3px double #1A1F6B;
            margin-bottom: 24px;
        }
        .kop-logo {
            width: 82px;
            height: 82px;
            object-fit: contain;
            flex-shrink: 0;
        }
        .kop-text h1 {
            font-size: 20px;
            font-weight: 800;
            color: #1A1F6B;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 3px;
        }
        .kop-text .kop-sub {
            font-size: 13px;
            font-weight: 600;
            color: #D4302A;
            margin-bottom: 4px;
            letter-spacing: 0.02em;
        }
        .kop-text .kop-addr {
            font-size: 11.5px;
            color: #64748b;
            line-height: 1.4;
        }

        /* ── Title & Meta ── */
        .title-meta-bar {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 1.5px solid #e2e8f0;
        }
        .doc-title {
            font-size: 17px;
            font-weight: 800;
            letter-spacing: 0.04em;
            color: {{ $isMasuk ? '#166534' : '#991b1b' }};
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .doc-meta {
            text-align: right;
            font-size: 12.5px;
        }
        .meta-kode {
            font-family: monospace;
            font-weight: 700;
            font-size: 14px;
            background: #f1f5f9;
            padding: 3px 8px;
            border-radius: 4px;
            color: #0f172a;
            border: 1px solid #cbd5e1;
            display: inline-block;
            margin-bottom: 4px;
        }

        /* ── Content Rows ── */
        .receipt-body {
            margin-bottom: 28px;
        }
        .receipt-row {
            display: flex;
            margin-bottom: 14px;
            align-items: flex-start;
        }
        .row-label {
            width: 190px;
            font-weight: 600;
            color: #475569;
            flex-shrink: 0;
            position: relative;
        }
        .row-colon {
            width: 16px;
            color: #475569;
            font-weight: 600;
            flex-shrink: 0;
        }
        .row-value {
            flex-grow: 1;
            color: #0f172a;
            font-weight: 500;
        }

        /* Terbilang Box */
        .terbilang-box {
            background: #f8fafc;
            border: 1px dashed #94a3b8;
            border-radius: 6px;
            padding: 10px 14px;
            font-style: italic;
            font-weight: 600;
            color: #1e293b;
            letter-spacing: 0.01em;
            display: inline-block;
            width: 100%;
        }

        /* ── Bottom Section: Total & Signatures ── */
        .bottom-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 24px;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .nominal-badge {
            background: {{ $isMasuk ? '#ecfdf5' : '#fef2f2' }};
            border: 2px solid {{ $isMasuk ? '#10b981' : '#ef4444' }};
            border-radius: 10px;
            padding: 14px 22px;
            display: inline-block;
        }
        .nominal-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: {{ $isMasuk ? '#047857' : '#b91c1c' }};
            margin-bottom: 2px;
        }
        .nominal-value {
            font-size: 22px;
            font-weight: 800;
            color: {{ $isMasuk ? '#065f46' : '#991b1b' }};
            letter-spacing: 0.02em;
        }

        .signature-wrap {
            display: flex;
            gap: 36px;
            text-align: center;
        }
        .sig-box {
            width: 170px;
        }
        .sig-title {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 65px;
        }
        .sig-line {
            font-weight: 700;
            color: #0f172a;
            border-top: 1px solid #0f172a;
            padding-top: 4px;
            font-size: 12.5px;
        }
        .sig-role {
            font-size: 11px;
            color: #64748b;
        }

        /* ── Bukti Gambar Section (if any) ── */
        .bukti-section {
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px dashed #cbd5e1;
        }
        .bukti-title {
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 10px;
        }
        .bukti-img {
            max-width: 240px;
            max-height: 150px;
            object-fit: contain;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 4px;
            background: #fff;
        }

        /* ── Print Media Query ── */
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                font-size: 12.5px !important;
            }
            .toolbar-wrapper {
                display: none !important;
            }
            .kwitansi-sheet {
                box-shadow: none !important;
                border: none !important;
                padding: 10mm 15mm !important;
                max-width: 100% !important;
            }
            @page {
                size: A4 portrait;
                margin: 12mm 15mm;
            }
            .watermark {
                opacity: 0.3 !important;
            }
        }
    </style>
</head>
<body>

    {{-- ── TOOLBAR (Hanya Tampil di Layar) ── --}}
    <div class="toolbar-wrapper">
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="/backoffice/kas" class="btn-action btn-back">
                <span class="material-icons-round" style="font-size:18px;">arrow_back</span>
                Kembali ke Kas
            </a>
            <span style="color:#94a3b8;font-size:13px;">|</span>
            <span style="font-size:13px;color:#64748b;">
                Ukuran cetak otomatis menyesuaikan <strong>A4</strong>
            </span>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
            <button type="button" class="btn-action btn-print" onclick="window.print()">
                <span class="material-icons-round" style="font-size:18px;">print</span>
                Cetak / Print Kwitansi
            </button>
        </div>
    </div>

    {{-- ── KWITANSI LEMBAR CETAK ── --}}
    <div class="kwitansi-sheet">

        {{-- Watermark Latar --}}
        <div class="watermark">
            {{ $isMasuk ? 'DENPASAR HOTEL SCHOOL' : 'VOUCHER KAS' }}
        </div>

        {{-- KOP SURAT --}}
        <div class="kop-section">
            <img src="{{ $logo }}" alt="Logo DHS" class="kop-logo" onerror="this.src='/image/LogoDHS.png'">
            <div class="kop-text">
                <h1>Denpasar Hotel School (DHS)</h1>
                <div class="kop-sub">Pusat Pendidikan & Pelatihan Pariwisata & Perhotelan Terakreditasi</div>
                <div class="kop-addr">
                    {{ $address }}<br>
                    Telp: {{ $phone }} &bull; Email: {{ $email }} &bull; Web: www.dhs.or.id
                </div>
            </div>
        </div>

        {{-- JUDUL KWITANSI & NOMOR --}}
        <div class="title-meta-bar">
            <div class="doc-title">
                <span class="material-icons-round" style="font-size:22px;">{{ $isMasuk ? 'account_balance_wallet' : 'payments' }}</span>
                {{ $titleKwitansi }}
            </div>
            <div class="doc-meta">
                <div>No. Kwitansi : <strong class="meta-kode">{{ $kas->kode }}</strong></div>
                <div style="color:#64748b;margin-top:2px;">Tanggal : <strong>{{ $tglFormatted }}</strong></div>
            </div>
        </div>

        {{-- ISI KWITANSI --}}
        <div class="receipt-body">

            <div class="receipt-row">
                <div class="row-label">{{ $labelPihak }}</div>
                <div class="row-colon">:</div>
                <div class="row-value" style="font-size:14.5px;font-weight:700;">
                    @if($isMasuk)
                        Siswa / Mahasiswa / Mitra DHS
                    @else
                        Keperluan Operasional / Rekanan DHS
                    @endif
                </div>
            </div>

            <div class="receipt-row">
                <div class="row-label">Jenis Transaksi</div>
                <div class="row-colon">:</div>
                <div class="row-value" style="font-weight:600;color:#1A1F6B;">
                    {{ $kas->jenis }}
                    @if($kas->project)
                        <span style="color:#64748b;font-weight:500;"> — Program: {{ $kas->project->nama_proyek }}</span>
                    @elseif($kas->program)
                        <span style="color:#64748b;font-weight:500;"> — Program: {{ $kas->program->title }}</span>
                    @endif
                </div>
            </div>

            <div class="receipt-row" style="margin-top:16px;margin-bottom:16px;">
                <div class="row-label">Uang Sejumlah</div>
                <div class="row-colon">:</div>
                <div class="row-value">
                    <div class="terbilang-box">
                        # {{ terbilang_kas($kas->jumlah) }} #
                    </div>
                </div>
            </div>

            <div class="receipt-row">
                <div class="row-label">Rincian Volume &amp; Harga</div>
                <div class="row-colon">:</div>
                <div class="row-value" style="color:#334155;">
                    {{ (float)($kas->volume ?? 1) }} {{ $kas->satuan ?: 'Paket' }}
                    &times; Rp {{ number_format($kas->harga_satuan ?? $kas->jumlah, 0, ',', '.') }}
                </div>
            </div>

            <div class="receipt-row">
                <div class="row-label">Untuk Keperluan / Deskripsi</div>
                <div class="row-colon">:</div>
                <div class="row-value" style="line-height:1.6;color:#334155;">
                    {{ $kas->deskripsi ?: 'Pembayaran transaksi keuangan ' . strtolower($kas->jenis) . ' Denpasar Hotel School.' }}
                    @if(!empty($kas->keterangan))
                        <div style="font-size:12px;color:#64748b;margin-top:4px;">Catatan: {{ $kas->keterangan }}</div>
                    @endif
                </div>
            </div>

        </div>

        {{-- BAGIAN BAWAH: NOMINAL & TANDA TANGAN --}}
        <div class="bottom-section">

            {{-- Kotak Jumlah Nominal --}}
            <div class="nominal-badge">
                <div class="nominal-label">Jumlah Total</div>
                <div class="nominal-value">
                    Rp {{ number_format($kas->jumlah, 0, ',', '.') }},-
                </div>
            </div>

            {{-- Kolom Tanda Tangan --}}
            <div class="signature-wrap">
                <div class="sig-box">
                    <div class="sig-title">Mengetahui / Menyetujui,</div>
                    <div class="sig-line">Kabag. Keuangan DHS</div>
                    <div class="sig-role">Denpasar Hotel School</div>
                </div>

                <div class="sig-box">
                    <div class="sig-title">Denpasar, {{ $tglFormatted }}<br>Kasir / Admin Keuangan,</div>
                    <div class="sig-line">{{ $creatorName }}</div>
                    <div class="sig-role">Petugas Keuangan</div>
                </div>
            </div>

        </div>

        {{-- LAMPIRAN BUKTI (JIKA ADA) --}}
        @if(!empty($kas->bukti_gambar))
        <div class="bukti-section">
            <div class="bukti-title">Lampiran Bukti Transaksi:</div>
            @if(str_ends_with(strtolower($kas->bukti_gambar), '.pdf'))
                <a href="{{ $kas->bukti_gambar }}" target="_blank" style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;border-radius:6px;text-decoration:none;font-weight:600;font-size:12.5px;">
                    <span class="material-icons-round" style="font-size:18px;">picture_as_pdf</span>
                    Lihat Dokumen Bukti (PDF)
                </a>
            @else
                <a href="{{ $kas->bukti_gambar }}" target="_blank">
                    <img src="{{ $kas->bukti_gambar }}" alt="Bukti Transaksi" class="bukti-img">
                </a>
            @endif
        </div>
        @endif

    </div>

</body>
</html>

