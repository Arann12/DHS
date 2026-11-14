@php
    $showProgramFilter = $showProgramFilter ?? true;
@endphp

<div class="bo-card bo-filter-card" style="margin-bottom:1.5rem;padding:20px 24px;border:1px solid #e2e8f0;border-radius:16px;box-shadow:0 2px 12px rgba(15,23,42,0.04);background:#ffffff;">
    
    {{-- BARIS 1: 5 FILTER UTAMA (SEIMBANG & PROPORSIONAL) --}}
    <div style="display:grid;grid-template-columns:repeat({{ $showProgramFilter ? 5 : 4 }}, minmax(0, 1fr));gap:14px;align-items:flex-end;">
        
        {{-- 1. PERIODE --}}
        <div>
            <label style="display:flex;align-items:center;gap:6px;font-size:11px;font-weight:700;letter-spacing:.05em;color:#475569;text-transform:uppercase;margin-bottom:6px;">
                <span class="material-icons-round" style="font-size:15px;color:#3b82f6;">calendar_today</span>
                <span>PERIODE</span>
            </label>
            <select class="bo-select" x-model="filterPeriode" style="width:100%;height:42px;box-sizing:border-box;padding:0 12px;font-size:13.5px;font-weight:500;border-radius:10px;border:1.5px solid #cbd5e1;background:#fff;outline:none;cursor:pointer;font-family:'Inter',sans-serif;">
                <option value="all">Semua Periode</option>
                <option value="harian">Harian (1 Hari)</option>
                <option value="rentang_tanggal">Rentang Hari (A – B)</option>
                <option value="bulanan">Bulanan</option>
                <option value="rentang_bulan">Rentang Bulan (A – B)</option>
                <option value="tahunan">Tahunan</option>
            </select>
        </div>

        {{-- 2. TRANSAKSI (PEMASUKAN, PENGELUARAN, PIUTANG) --}}
        <div>
            <label style="display:flex;align-items:center;gap:6px;font-size:11px;font-weight:700;letter-spacing:.05em;color:#475569;text-transform:uppercase;margin-bottom:6px;">
                <span class="material-icons-round" style="font-size:15px;color:#64748b;">swap_vert</span>
                <span>TRANSAKSI</span>
            </label>
            <select class="bo-select" x-model="filterTipe" style="width:100%;height:42px;box-sizing:border-box;padding:0 12px;font-size:13.5px;font-weight:500;border-radius:10px;border:1.5px solid #cbd5e1;background:#fff;outline:none;cursor:pointer;font-family:'Inter',sans-serif;">
                <option value="">Semua Transaksi</option>
                <option value="masuk">🟢 Pemasukan</option>
                <option value="keluar">🔴 Pengeluaran</option>
                <option value="piutang">⏳ Piutang</option>
            </select>
        </div>

        {{-- 3. STATUS TRANSAKSI (HANYA 2: LUNAS & CICIL) --}}
        <div>
            <label style="display:flex;align-items:center;gap:6px;font-size:11px;font-weight:700;letter-spacing:.05em;color:#475569;text-transform:uppercase;margin-bottom:6px;">
                <span class="material-icons-round" style="font-size:15px;color:#059669;">verified</span>
                <span>STATUS</span>
            </label>
            <select class="bo-select" x-model="filterStatus" style="width:100%;height:42px;box-sizing:border-box;padding:0 12px;font-size:13.5px;font-weight:500;border-radius:10px;border:1.5px solid #cbd5e1;background:#fff;outline:none;cursor:pointer;font-family:'Inter',sans-serif;">
                <option value="">Semua Status</option>
                <option value="lunas">✓ Lunas</option>
                <option value="cicil">⏳ Cicil</option>
            </select>
        </div>

        {{-- 4. PROGRAM STUDI --}}
        @if($showProgramFilter)
        <div>
            <label style="display:flex;align-items:center;gap:6px;font-size:11px;font-weight:700;letter-spacing:.05em;color:#475569;text-transform:uppercase;margin-bottom:6px;">
                <span class="material-icons-round" style="font-size:15px;color:#d97706;">school</span>
                <span>PROGRAM</span>
            </label>
            <select class="bo-select" x-model="filterRel" style="width:100%;height:42px;box-sizing:border-box;padding:0 12px;font-size:13.5px;font-weight:500;border-radius:10px;border:1.5px solid #cbd5e1;background:#fff;outline:none;cursor:pointer;font-family:'Inter',sans-serif;">
                <option value="">Semua Program</option>
                @if(isset($scopedPrograms) && $scopedPrograms->count() > 0)
                    @foreach($scopedPrograms as $prog)
                        <option value="prog:{{ $prog->id }}">{{ $prog->title }}</option>
                    @endforeach
                @elseif(isset($programKategori))
                    @foreach($programKategori as $kat)
                        <optgroup label="── {{ $kat->category_name }} ──">
                            @foreach($kat->programs as $prog)
                                <option value="prog:{{ $prog->id }}">{{ $prog->title }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                    <option value="null">Umum (Tanpa Program)</option>
                @endif
            </select>
        </div>
        @endif

        {{-- 5. URUTKAN / SORT --}}
        <div>
            <label style="display:flex;align-items:center;gap:6px;font-size:11px;font-weight:700;letter-spacing:.05em;color:#475569;text-transform:uppercase;margin-bottom:6px;">
                <span class="material-icons-round" style="font-size:15px;color:#7c3aed;">sort</span>
                <span>URUTKAN</span>
            </label>
            <select class="bo-select" x-model="sortBy" style="width:100%;height:42px;box-sizing:border-box;padding:0 12px;font-size:13.5px;font-weight:500;border-radius:10px;border:1.5px solid #cbd5e1;background:#fff;outline:none;cursor:pointer;font-family:'Inter',sans-serif;">
                <option value="tanggal_desc">📅 Tanggal Terbaru</option>
                <option value="tanggal_asc">📅 Tanggal Terlama</option>
                <option value="nominal_desc">💰 Nominal Terbesar</option>
                <option value="nominal_asc">💰 Nominal Terkecil</option>
                <option value="program_asc">🎓 Program (A → Z)</option>
                <option value="program_desc">🎓 Program (Z → A)</option>
            </select>
        </div>

    </div>

    {{-- BARIS 1.5: PARAMETER KHUSUS PERIODE (HANYA MUNCUL JIKA MEMILIH HARIAN / BULANAN / RENTANG) --}}
    <div x-show="filterPeriode !== 'all'" x-transition
         style="margin-top:14px;padding:12px 16px;background:#f8fafc;border:1.5px dashed #cbd5e1;border-radius:12px;display:flex;align-items:center;gap:14px;flex-wrap:wrap;">
        
        <div style="display:flex;align-items:center;gap:6px;font-size:11.5px;font-weight:700;color:#3b82f6;text-transform:uppercase;letter-spacing:.05em;">
            <span class="material-icons-round" style="font-size:16px;">tune</span>
            <span>Parameter Periode:</span>
        </div>

        {{-- Parameter Harian --}}
        <div x-show="filterPeriode === 'harian'" style="display:flex;align-items:center;gap:8px;">
            <span style="font-size:12.5px;font-weight:600;color:#64748b;">Pilih Tanggal:</span>
            <input type="date" class="bo-input" x-model="filterTanggal"
                   style="height:38px;padding:0 12px;font-size:13px;border-radius:8px;border:1.5px solid #cbd5e1;background:#fff;font-family:'Inter',sans-serif;">
        </div>

        {{-- Parameter Rentang Tanggal --}}
        <div x-show="filterPeriode === 'rentang_tanggal'" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <span style="font-size:12.5px;font-weight:600;color:#64748b;">Dari:</span>
            <input type="date" class="bo-input" x-model="filterTglDari"
                   style="height:38px;padding:0 12px;font-size:13px;border-radius:8px;border:1.5px solid #cbd5e1;background:#fff;font-family:'Inter',sans-serif;">
            <span style="font-size:12.5px;font-weight:600;color:#64748b;">Sampai:</span>
            <input type="date" class="bo-input" x-model="filterTglSampai"
                   style="height:38px;padding:0 12px;font-size:13px;border-radius:8px;border:1.5px solid #cbd5e1;background:#fff;font-family:'Inter',sans-serif;">
        </div>

        {{-- Parameter Bulanan --}}
        <div x-show="filterPeriode === 'bulanan'" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <span style="font-size:12.5px;font-weight:600;color:#64748b;">Bulan:</span>
            <select class="bo-select" x-model="filterBulan"
                    style="height:38px;padding:0 10px;font-size:13px;border-radius:8px;border:1.5px solid #cbd5e1;background:#fff;font-family:'Inter',sans-serif;">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <span style="font-size:12.5px;font-weight:600;color:#64748b;">Tahun:</span>
            <select class="bo-select" x-model="filterTahun"
                    style="height:38px;padding:0 10px;font-size:13px;border-radius:8px;border:1.5px solid #cbd5e1;background:#fff;font-family:'Inter',sans-serif;">
                <option value="">Semua</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
            </select>
        </div>

        {{-- Parameter Rentang Bulan --}}
        <div x-show="filterPeriode === 'rentang_bulan'" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <span style="font-size:12.5px;font-weight:600;color:#64748b;">Dari:</span>
            <select class="bo-select" x-model="filterBulanDari"
                    style="height:38px;padding:0 10px;font-size:13px;border-radius:8px;border:1.5px solid #cbd5e1;background:#fff;font-family:'Inter',sans-serif;">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <span style="font-size:12.5px;font-weight:600;color:#64748b;">Sampai:</span>
            <select class="bo-select" x-model="filterBulanSampai"
                    style="height:38px;padding:0 10px;font-size:13px;border-radius:8px;border:1.5px solid #cbd5e1;background:#fff;font-family:'Inter',sans-serif;">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <span style="font-size:12.5px;font-weight:600;color:#64748b;">Tahun:</span>
            <select class="bo-select" x-model="filterTahun"
                    style="height:38px;padding:0 10px;font-size:13px;border-radius:8px;border:1.5px solid #cbd5e1;background:#fff;font-family:'Inter',sans-serif;">
                <option value="">Semua</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
            </select>
        </div>

        {{-- Parameter Tahunan --}}
        <div x-show="filterPeriode === 'tahunan'" style="display:flex;align-items:center;gap:8px;">
            <span style="font-size:12.5px;font-weight:600;color:#64748b;">Pilih Tahun:</span>
            <select class="bo-select" x-model="filterTahun"
                    style="height:38px;padding:0 10px;font-size:13px;border-radius:8px;border:1.5px solid #cbd5e1;background:#fff;font-family:'Inter',sans-serif;">
                <option value="">Semua</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
            </select>
        </div>
    </div>

    {{-- BARIS 2: PENCARIAN CEPAT + TOMBOL RESET & EXPORT TERPADU --}}
    <div style="margin-top:14px;padding-top:14px;border-top:1px solid #f1f5f9;display:flex;align-items:flex-end;gap:12px;flex-wrap:wrap;">
        
        {{-- Input Pencarian --}}
        <div style="flex:1;min-width:280px;">
            <label style="display:flex;align-items:center;gap:6px;font-size:11px;font-weight:700;letter-spacing:.05em;color:#475569;text-transform:uppercase;margin-bottom:6px;">
                <span class="material-icons-round" style="font-size:15px;color:#3b82f6;">search</span>
                <span>SEARCH</span>
            </label>
            <div style="position:relative;display:flex;align-items:center;">
                <span class="material-icons-round" style="position:absolute;left:13px;color:#94a3b8;font-size:19px;pointer-events:none;">search</span>
                <input type="text"
                       x-model="filterSearch"
                       placeholder="Search transaksi berdasarkan kode kas, deskripsi, siswa, kategori..."
                       class="bo-input"
                       style="width:100%;height:42px;box-sizing:border-box;padding-left:40px;padding-right:36px;font-size:13.5px;border-radius:10px;border:1.5px solid #cbd5e1;background:#fff;outline:none;transition:all 0.15s;font-family:'Inter',sans-serif;">
                <button type="button"
                        x-show="filterSearch && filterSearch.length > 0"
                        x-on:click="filterSearch = ''"
                        style="position:absolute;right:10px;background:none;border:none;color:#94a3b8;cursor:pointer;padding:4px;display:flex;align-items:center;border-radius:50%;"
                        onmouseover="this.style.color='#ef4444'"
                        onmouseout="this.style.color='#94a3b8'">
                    <span class="material-icons-round" style="font-size:18px;">cancel</span>
                </button>
            </div>
        </div>

        {{-- Tombol Reset Filter --}}
        <div>
            <button type="button"
                    x-on:click="resetFilter()"
                    style="height:42px;display:inline-flex;align-items:center;gap:6px;padding:0 18px;background:#f8fafc;border:1.5px solid #cbd5e1;border-radius:10px;color:#475569;font-size:13px;font-weight:600;cursor:pointer;font-family:'Inter',sans-serif;transition:all 0.15s;white-space:nowrap;box-shadow:0 1px 2px rgba(0,0,0,0.03);"
                    onmouseover="this.style.background='#f1f5f9';this.style.borderColor='#94a3b8';this.style.color='#1e293b'"
                    onmouseout="this.style.background='#f8fafc';this.style.borderColor='#cbd5e1';this.style.color='#475569'">
                <span class="material-icons-round" style="font-size:17px;color:#64748b;">refresh</span>
                <span>Reset Filter</span>
            </button>
        </div>

        {{-- Tombol Export CSV --}}
        <div>
            <a :href="exportCsvUrl()"
               style="height:42px;display:inline-flex;align-items:center;gap:6px;padding:0 18px;background:#059669;border:1.5px solid #047857;border-radius:10px;color:#fff;font-size:13px;font-weight:700;text-decoration:none;cursor:pointer;font-family:'Inter',sans-serif;transition:all 0.15s;box-shadow:0 1px 3px rgba(5,150,105,0.25);white-space:nowrap;"
               onmouseover="this.style.background='#047857';this.style.borderColor='#065f46'"
               onmouseout="this.style.background='#059669';this.style.borderColor='#047857'">
                <span class="material-icons-round" style="font-size:18px;color:#a7f3d0;">download</span>
                <span>Export CSV</span>
            </a>
        </div>

        {{-- Tombol Export PDF --}}
        <div>
            <a :href="exportPdfUrl()"
               target="_blank"
               style="height:42px;display:inline-flex;align-items:center;gap:6px;padding:0 18px;background:#dc2626;border:1.5px solid #b91c1c;border-radius:10px;color:#fff;font-size:13px;font-weight:700;text-decoration:none;cursor:pointer;font-family:'Inter',sans-serif;transition:all 0.15s;box-shadow:0 1px 3px rgba(220,38,38,0.25);white-space:nowrap;"
               onmouseover="this.style.background='#b91c1c';this.style.borderColor='#991b1b'"
               onmouseout="this.style.background='#dc2626';this.style.borderColor='#b91c1c'">
                <span class="material-icons-round" style="font-size:18px;color:#fecaca;">picture_as_pdf</span>
                <span>Export PDF</span>
            </a>
        </div>

    </div>

</div>

<style>
/* Responsive layout for Kas Filter Bar */
@media (max-width: 1100px) {
    .bo-filter-card > div:first-child {
        grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    }
}
@media (max-width: 768px) {
    .bo-filter-card > div:first-child {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }
}
@media (max-width: 520px) {
    .bo-filter-card > div:first-child {
        grid-template-columns: 1fr !important;
    }
}
</style>
