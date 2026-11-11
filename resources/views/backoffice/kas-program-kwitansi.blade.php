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
    $now = \Carbon\Carbon::now();
    $tglCetak = $now->format('d') . ' ' . ($bulanIndo[(int)$now->format('m')] ?? '') . ' ' . $now->format('Y');
    $kodeProgramShow = $project->kode_proyek ?: ('PRG-' . str_pad($project->id, 5, '0', STR_PAD_LEFT));
    $adminName = session('backoffice_user.name') ?? 'Admin Keuangan';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Program {{ $kodeProgramShow }} - {{ $project->nama_proyek }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; color: #1e293b; padding: 24px 16px 48px; font-size: 13.5px; line-height: 1.5; }
        .toolbar-wrapper { max-width: 840px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: space-between; gap: 12px; background: #fff; padding: 14px 20px; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
        .btn-action { display: inline-flex; align-items: center; gap: 8px; padding: 9px 18px; font-size: 13.5px; font-weight: 600; border-radius: 8px; text-decoration: none; cursor: pointer; border: none; }
        .btn-print { background: #1A1F6B; color: #fff; }
        .btn-back { background: #f8fafc; color: #475569; border: 1.5px solid #cbd5e1; }
        .kwitansi-sheet { max-width: 840px; margin: 0 auto; background: #fff; padding: 40px 48px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); border: 1px solid #e2e8f0; position: relative; }
        .kop-section { display: flex; align-items: center; gap: 20px; padding-bottom: 16px; border-bottom: 3px double #1A1F6B; margin-bottom: 24px; }
        .kop-logo { width: 80px; height: 80px; object-fit: contain; }
        .kop-text h1 { font-size: 20px; font-weight: 800; color: #1A1F6B; text-transform: uppercase; }
        .kop-sub { font-size: 12.5px; font-weight: 600; color: #D4302A; margin-bottom: 3px; }
        .kop-addr { font-size: 11.5px; color: #64748b; }
        .title-bar { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1.5px solid #e2e8f0; }
        .status-stamp { padding: 5px 14px; border-radius: 6px; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: .06em; border: 2px solid {{ $summary['is_lunas'] ? '#16a34a' : '#d97706' }}; color: {{ $summary['is_lunas'] ? '#16a34a' : '#b45309' }}; background: {{ $summary['is_lunas'] ? '#f0fdf4' : '#fffbeb' }}; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px 24px; margin-bottom: 20px; background: #f8fafc; padding: 14px 18px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; }
        table.trx-table { width: 100%; border-collapse: collapse; margin: 16px 0 22px; font-size: 12.5px; }
        table.trx-table th { background: #1A1F6B; color: #fff; text-align: left; padding: 9px 12px; font-size: 11px; text-transform: uppercase; letter-spacing: .05em; }
        table.trx-table td { padding: 9px 12px; border-bottom: 1px solid #e2e8f0; }
        .terbilang-box { background: #f8fafc; border: 1px dashed #94a3b8; border-radius: 6px; padding: 10px 14px; font-style: italic; font-weight: 600; margin-bottom: 20px; }
        .summary-footer { display: flex; justify-content: space-between; align-items: flex-end; gap: 24px; margin-top: 24px; padding-top: 20px; border-top: 1px solid #e2e8f0; }
        .sig-box { width: 190px; text-align: center; }
        .sig-title { font-size: 12px; color: #64748b; margin-bottom: 60px; }
        .sig-line { font-weight: 700; border-top: 1px solid #0f172a; padding-top: 4px; font-size: 12.5px; }
        @media print {
            body { background: #fff !important; padding: 0 !important; }
            .toolbar-wrapper { display: none !important; }
            .kwitansi-sheet { box-shadow: none !important; border: none !important; padding: 10mm 14mm !important; }
            @page { size: A4 portrait; margin: 12mm 14mm; }
        }
    </style>
</head>
<body>
    <div class="toolbar-wrapper">
        <a href="/backoffice/kas-program-detail/{{ $project->id }}" class="btn-action btn-back">
            <span class="material-icons-round" style="font-size:18px;">arrow_back</span>
            Kembali ke Detail Program
        </a>
        <button type="button" class="btn-action btn-print" onclick="window.print()">
            <span class="material-icons-round" style="font-size:18px;">print</span>
            Cetak / Print Kuitansi
        </button>
    </div>

    <div class="kwitansi-sheet">
        <div class="kop-section">
            <img src="{{ $logo }}" alt="Logo DHS" class="kop-logo" onerror="this.src='/image/LogoDHS.png'">
            <div class="kop-text">
                <h1>Denpasar Hotel School (DHS)</h1>
                <div class="kop-sub">Pusat Pendidikan &amp; Pelatihan Pariwisata &amp; Perhotelan Terakreditasi</div>
                <div class="kop-addr">
                    {{ $address }}<br>
                    Telp: {{ $phone }} &bull; Email: {{ $email }}
                </div>
            </div>
        </div>

        <div class="title-bar">
            <div>
                <div style="font-size:18px;font-weight:800;color:#1A1F6B;">
                    KUITANSI PEMBAYARAN PROGRAM
                </div>
                <div style="font-size:12.5px;color:#64748b;">
                    No. Referensi: <strong style="font-family:monospace;color:#0f172a;">{{ $kodeProgramShow }}</strong>
                    &bull; Tgl Cetak: <strong>{{ $tglCetak }}</strong>
                </div>
            </div>
            <div class="status-stamp">
                {{ $summary['is_lunas'] ? 'LUNAS' : 'BELUM LUNAS (PIUTANG)' }}
            </div>
        </div>

        <div class="info-grid">
            <div><span style="color:#64748b;">Judul Program:</span><br><strong>{{ $project->display_program_title }}</strong></div>
            <div><span style="color:#64748b;">Nama Program / Angkatan:</span><br><strong>{{ $project->nama_proyek }}</strong></div>
            <div><span style="color:#64748b;">PIC / Penanggung Jawab:</span><br><strong>{{ $project->pic }}</strong></div>
            <div><span style="color:#64748b;">Periode Pelaksanaan:</span><br>
                <strong>{{ $project->tanggal_mulai ? $project->tanggal_mulai->format('d M Y') : '-' }} – {{ $project->tanggal_selesai ? $project->tanggal_selesai->format('d M Y') : '-' }}</strong>
            </div>
        </div>

        <div style="font-size:12px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.05em;">Rincian Pemasukan Terbayar:</div>
        <table class="trx-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Deskripsi</th>
                    <th style="text-align:center;">Vol / Satuan</th>
                    <th style="text-align:right;">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pemasukanList as $item)
                    <tr>
                        <td>{{ $item->tanggal ? $item->tanggal->format('d M Y') : '-' }}</td>
                        <td style="font-family:monospace;">{{ $item->kode ?: '-' }}</td>
                        <td>{{ $item->deskripsi ?: $item->jenis }}</td>
                        <td style="text-align:center;">{{ (float)($item->volume ?? 1) }} {{ $item->satuan ?: 'Paket' }}</td>
                        <td style="text-align:right;font-weight:700;">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;color:#94a3b8;">Belum ada pembayaran masuk tercatat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="terbilang-box">
            Terbilang Total Terbayar: # {{ terbilang_kas($summary['total_masuk']) }} #
        </div>

        <div class="summary-footer">
            <div style="border:1.5px solid #cbd5e1;border-radius:10px;padding:14px 18px;min-width:290px;">
                <div style="display:flex;justify-content:space-between;margin-bottom:6px;font-size:12.5px;">
                    <span style="color:#64748b;">Nilai Program</span>
                    <strong>Rp {{ number_format($summary['nilai_proyek'], 0, ',', '.') }}</strong>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:6px;font-size:13px;color:#15803d;">
                    <span>Total Terbayar</span>
                    <strong>Rp {{ number_format($summary['total_masuk'], 0, ',', '.') }}</strong>
                </div>
                <div style="display:flex;justify-content:space-between;padding-top:6px;border-top:1px dashed #cbd5e1;font-size:13.5px;color:{{ $summary['sisa_tagihan'] > 0 ? '#b91c1c' : '#15803d' }};">
                    <span>Sisa Tagihan (Piutang)</span>
                    <strong>Rp {{ number_format($summary['sisa_tagihan'], 0, ',', '.') }}</strong>
                </div>
            </div>

            <div style="display:flex;gap:28px;">
                <div class="sig-box">
                    <div class="sig-title">PIC Program,</div>
                    <div class="sig-line">{{ $project->pic }}</div>
                </div>
                <div class="sig-box">
                    <div class="sig-title">Denpasar, {{ $tglCetak }}<br>Bag. Keuangan DHS,</div>
                    <div class="sig-line">{{ $adminName }}</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

