@php
    $scope              = $scope ?? 'modal.form';
    $actionExpr         = $actionExpr ?? "'/backoffice/kas/store'";
    $programScopeMode   = $programScopeMode ?? 'umum'; // 'umum' | 'kategori' | 'locked'
    $lockedProgramRef   = $lockedProgramRef ?? '';
    $lockedProgramLabel = $lockedProgramLabel ?? '';
    $scopedPrograms     = $scopedPrograms ?? collect();
    $scopedCategoryName = $scopedCategoryName ?? '';
    $redirectValue      = $redirectValue ?? '';
    $submitText         = $submitText ?? 'Simpan Transaksi';
    $showCancel         = $showCancel ?? false;
    $cancelAction       = $cancelAction ?? 'modal.open = false';
    $btnBg              = $btnBg ?? '#1A365D';
    $catUmumMasuk       = $optUmumMasuk ?? ($optMasuk ?? []);
    $catUmumKeluar      = $optUmumKeluar ?? ($optKeluar ?? []);
    $catProgMasuk       = $optProgramMasuk ?? ($optMasuk ?? []);
    $catProgKeluar      = $optProgramKeluar ?? ($optKeluar ?? []);
    $piutangCategories  = $piutangCategories ?? ['Pembayaran SPP / Uang Kuliah', 'Pembayaran Biaya Sertifikasi', 'Uang Pendaftaran Mahasiswa'];
@endphp

<script>
if (typeof window.makeKasTransactionForm !== 'function') {
    window.makeKasTransactionForm = function(scopeName, config) {
        config = config || {};
        const piutangCategories = config.piutangCategories || [];
        const programScopeMode = config.programScopeMode || 'umum';
        const scopedCategoryName = config.scopedCategoryName || '';
        const csrfToken = config.csrfToken || '';
        const initialUnits = Array.isArray(config.unitsList) ? config.unitsList : ['Orang', 'Unit', 'Hari', 'Paket', 'Jam', 'Bulan', 'Pcs', 'Sesi', 'Semester', 'Lot', 'Set'];

        return {
            unitsList: initialUnits,
            unitOpen: false,
            newUnit: '',
            unitSaving: false,
            localFileName: '',
            localFilePreview: '',
            localIsPdf: false,
            piutangCategories: piutangCategories,
            paymentMode: 'lunas',
            totalHargaDisplay: '',
            bayarSekarangDisplay: '',
            selectedProgramFee: 0,

            get scopeObj() {
                if (scopeName === 'formMasuk') return this.formMasuk || {};
                if (scopeName === 'formKeluar') return this.formKeluar || {};
                return (this.modal && this.modal.form) ? this.modal.form : {};
            },

            canCicil() {
                const j = (this.scopeObj.jenis || '').trim();
                if (!j) return false;
                return Array.isArray(this.piutangCategories) && this.piutangCategories.includes(j);
            },

            shouldShowPaymentScheme() {
                if (this.scopeObj.editMode) {
                    return !!(this.scopeObj.is_pending_piutang && this.canCicil());
                }
                return (this.scopeObj.type === 'piutang') || (this.scopeObj.type === 'masuk' && this.canCicil() && !!this.scopeObj.jenis);
            },

            get calcHarga() {
                return (window.DHSKasHelper && window.DHSKasHelper.parseRupiah)
                    ? window.DHSKasHelper.parseRupiah(this.scopeObj.hargaSatuanDisplay)
                    : (parseFloat(String(this.scopeObj.hargaSatuanDisplay || '').replace(/\./g, '').replace(',', '.')) || 0);
            },

            get calcTotal() {
                const v = parseFloat(this.scopeObj.volume) || 0;
                return Math.round(v * this.calcHarga);
            },

            get calcTotalHarga() {
                if (this.paymentMode === 'cicil') {
                    const h = (window.DHSKasHelper && window.DHSKasHelper.parseRupiah)
                        ? window.DHSKasHelper.parseRupiah(this.totalHargaDisplay)
                        : (parseFloat(String(this.totalHargaDisplay || '').replace(/\./g, '').replace(',', '.')) || 0);
                    return h > 0 ? h : this.calcTotal;
                }
                return this.calcTotal;
            },

            get calcBayarSekarang() {
                return (window.DHSKasHelper && window.DHSKasHelper.parseRupiah)
                    ? window.DHSKasHelper.parseRupiah(this.bayarSekarangDisplay)
                    : (parseFloat(String(this.bayarSekarangDisplay || '').replace(/\./g, '').replace(',', '.')) || 0);
            },

            get calcSisaPiutang() {
                return Math.max(0, this.calcTotalHarga - this.calcBayarSekarang);
            },

            get calcPercentPaid() {
                if (this.calcTotalHarga <= 0) return 0;
                return Math.min(100, Math.round((this.calcBayarSekarang / this.calcTotalHarga) * 100));
            },

            get calcPercentRemaining() {
                return Math.max(0, 100 - this.calcPercentPaid);
            },

            setPaymentMode(mode) {
                if (mode === 'cicil' && !this.canCicil()) {
                    alert('Kategori "' + (this.scopeObj.jenis || '') + '" disetting hanya menerima pembayaran lunas (tidak dapat dicicil / DP). Atur di menu Kategori untuk mengubah.');
                    return;
                }
                this.paymentMode = mode;
                this.scopeObj.payment_mode = mode;
                if (mode === 'lunas') {
                    if (this.scopeObj.type === 'piutang') {
                        this.scopeObj.type = 'masuk';
                    }
                    if (this.totalHargaDisplay && !this.scopeObj.hargaSatuanDisplay) {
                        this.scopeObj.hargaSatuanDisplay = this.totalHargaDisplay;
                    }
                }
                if (mode === 'cicil') {
                    if (!this.totalHargaDisplay && this.calcTotal > 0) {
                        this.totalHargaDisplay = (window.DHSKasHelper && window.DHSKasHelper.formatNumber)
                            ? window.DHSKasHelper.formatNumber(this.calcTotal)
                            : Math.abs(this.calcTotal).toLocaleString('id-ID');
                    } else if (!this.totalHargaDisplay && this.selectedProgramFee > 0) {
                        this.totalHargaDisplay = (window.DHSKasHelper && window.DHSKasHelper.formatNumber)
                            ? window.DHSKasHelper.formatNumber(this.selectedProgramFee)
                            : Math.abs(this.selectedProgramFee).toLocaleString('id-ID');
                    }
                    if (this.totalHargaDisplay) {
                        this.scopeObj.hargaSatuanDisplay = this.totalHargaDisplay;
                        this.scopeObj.volume = 1;
                    }
                }
            },

            setTotalHarga(val) {
                this.totalHargaDisplay = (window.DHSKasHelper && window.DHSKasHelper.formatNumber)
                    ? window.DHSKasHelper.formatNumber(val)
                    : Math.abs(val).toLocaleString('id-ID');
                this.scopeObj.hargaSatuanDisplay = this.totalHargaDisplay;
                this.scopeObj.volume = 1;
            },

            onProgramChange(el) {
                const opt = el.options[el.selectedIndex];
                const fee = opt ? parseFloat(opt.getAttribute('data-fee') || 0) : 0;
                this.selectedProgramFee = fee;
                if (fee > 0 && (!this.totalHargaDisplay || this.totalHargaDisplay === '0')) {
                    this.setTotalHarga(fee);
                }
            },

            onFilePicked(e) {
                const file = e.target.files[0];
                if (!file) {
                    this.localFileName = '';
                    this.localFilePreview = '';
                    this.localIsPdf = false;
                    return;
                }
                this.localFileName = file.name;
                this.localIsPdf = file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf');
                if (!this.localIsPdf && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = ev => { this.localFilePreview = ev.target.result; };
                    reader.readAsDataURL(file);
                } else {
                    this.localFilePreview = '';
                }
            },

            clearPickedFile() {
                if (this.$refs.fileInput) this.$refs.fileInput.value = '';
                this.localFileName = '';
                this.localFilePreview = '';
                this.localIsPdf = false;
                this.scopeObj.bukti_gambar = '';
            },

            async submitNewUnit() {
                const clean = (this.newUnit || '').trim();
                if (!clean || this.unitSaving) return;
                this.unitSaving = true;
                const res = (window.DHSKasHelper && window.DHSKasHelper.addUnit)
                    ? await window.DHSKasHelper.addUnit(clean, csrfToken)
                    : null;
                this.unitSaving = false;
                if (res && res.units) {
                    this.unitsList = res.units;
                } else if (!this.unitsList.includes(clean)) {
                    this.unitsList.push(clean);
                }
                this.scopeObj.satuan = clean;
                this.newUnit = '';
                this.unitOpen = false;
            },

            validateBeforeSubmit(e) {
                if (typeof $ !== 'undefined') {
                    const $el = $('#summernote-kas-keterangan');
                    if ($el.length && $el.data('summernote')) {
                        const code = $el.summernote('code');
                        $el.val(code);
                        this.scopeObj.keterangan = code;
                    }
                }
                const sc = this.scopeObj;
                if (programScopeMode === 'kategori' && !sc.program_ref) {
                    e.preventDefault();
                    alert('Silakan pilih Program di kategori ' + scopedCategoryName + ' terlebih dahulu.');
                    return;
                }
                if (!sc.type) {
                    e.preventDefault();
                    alert('Silakan pilih Transaksi (Pemasukan / Piutang / Pengeluaran).');
                    return;
                }
                if (!sc.jenis) {
                    e.preventDefault();
                    alert('Silakan pilih Kategori transaksi.');
                    return;
                }
                if (sc.editMode && sc.is_pending_piutang) {
                    const sisa = sc.sisa_piutang || this.calcTotalHarga;
                    if (this.calcBayarSekarang > sisa && sisa > 0) {
                        e.preventDefault();
                        alert('Nominal cicilan (Rp ' + (window.DHSKasHelper ? window.DHSKasHelper.formatNumber(this.calcBayarSekarang) : this.calcBayarSekarang) + ') tidak boleh melebihi sisa tagihan piutang (Rp ' + (window.DHSKasHelper ? window.DHSKasHelper.formatNumber(sisa) : sisa) + ').');
                        return;
                    }
                } else if (!sc.editMode && (sc.type === 'masuk' || sc.type === 'piutang') && this.paymentMode === 'cicil') {
                    if (!this.canCicil()) {
                        e.preventDefault();
                        alert('Kategori "' + (sc.jenis || '') + '" disetting hanya menerima pembayaran lunas (tidak dapat dicicil / DP). Atur di menu Kategori untuk mengubah.');
                        return;
                    }
                    if (this.calcTotalHarga <= 0) {
                        e.preventDefault();
                        alert('Total Harga Program harus lebih dari Rp 0.');
                        return;
                    }
                    if (this.calcBayarSekarang > this.calcTotalHarga) {
                        e.preventDefault();
                        alert('Nominal yang dibayar sekarang tidak boleh melebihi Total Harga Program.');
                        return;
                    }
                    if (this.calcSisaPiutang > 0 && !(sc.piutang_nama || '').trim()) {
                        e.preventDefault();
                        alert('Silakan masukkan Nama Siswa / Penanggung Piutang untuk sisa tagihan.');
                        return;
                    }
                } else {
                    if (this.calcTotal <= 0) {
                        e.preventDefault();
                        alert('Harga Satuan dan Volume harus menghasilkan Total lebih dari 0.');
                        return;
                    }
                }
            },

            init() {
                if (this.scopeObj.type === 'piutang') {
                    this.paymentMode = 'cicil';
                    this.scopeObj.payment_mode = 'cicil';
                } else {
                    this.paymentMode = this.scopeObj.payment_mode || 'lunas';
                }
                this.totalHargaDisplay = this.scopeObj.totalHargaDisplay || this.scopeObj.hargaSatuanDisplay || '';
                this.bayarSekarangDisplay = this.scopeObj.dpNominalDisplay || '';

                this.$watch(() => this.scopeObj.type, (val) => {
                    if (val === 'piutang') {
                        this.paymentMode = 'cicil';
                        this.scopeObj.payment_mode = 'cicil';
                        if (!this.totalHargaDisplay && this.calcTotal > 0) {
                            this.totalHargaDisplay = (window.DHSKasHelper && window.DHSKasHelper.formatNumber)
                                ? window.DHSKasHelper.formatNumber(this.calcTotal)
                                : Math.abs(this.calcTotal).toLocaleString('id-ID');
                        } else if (!this.totalHargaDisplay && this.selectedProgramFee > 0) {
                            this.totalHargaDisplay = (window.DHSKasHelper && window.DHSKasHelper.formatNumber)
                                ? window.DHSKasHelper.formatNumber(this.selectedProgramFee)
                                : Math.abs(this.selectedProgramFee).toLocaleString('id-ID');
                        }
                        if (this.totalHargaDisplay) {
                            this.scopeObj.hargaSatuanDisplay = this.totalHargaDisplay;
                            this.scopeObj.volume = 1;
                        }
                    } else if (val === 'masuk') {
                        if (this.canCicil() && this.scopeObj.payment_mode === 'cicil') {
                            this.paymentMode = 'cicil';
                        } else {
                            this.paymentMode = 'lunas';
                            this.scopeObj.payment_mode = 'lunas';
                        }
                    } else {
                        this.paymentMode = 'lunas';
                        this.scopeObj.payment_mode = 'lunas';
                    }
                });

                this.$watch(() => this.scopeObj.jenis, (val) => {
                    if (val && Array.isArray(this.piutangCategories) && !this.piutangCategories.includes(val)) {
                        if (this.paymentMode === 'cicil') {
                            this.paymentMode = 'lunas';
                            this.scopeObj.payment_mode = 'lunas';
                        }
                    }
                });

                this.$watch(() => this.scopeObj.payment_mode, (val) => {
                    if (val && val !== this.paymentMode) {
                        this.paymentMode = val;
                    }
                });

                this.$watch(() => this.scopeObj.totalHargaDisplay, (val) => {
                    if (val !== undefined && val !== this.totalHargaDisplay) {
                        this.totalHargaDisplay = val;
                    }
                });

                this.$watch(() => this.scopeObj.dpNominalDisplay, (val) => {
                    if (val !== undefined && val !== this.bayarSekarangDisplay) {
                        this.bayarSekarangDisplay = val;
                    }
                });
            }
        };
    };
}
</script>

<form method="POST"
      :action="{{ $actionExpr }}"
      enctype="multipart/form-data"
      x-data="window.makeKasTransactionForm('{{ $scope }}', { piutangCategories: {{ json_encode($piutangCategories) }}, programScopeMode: '{{ $programScopeMode }}', scopedCategoryName: '{{ $scopedCategoryName }}', csrfToken: '{{ csrf_token() }}', unitsList: {{ json_encode($unitsData ?? ['Orang', 'Unit', 'Hari', 'Paket', 'Jam', 'Bulan', 'Pcs', 'Sesi', 'Semester', 'Lot', 'Set']) }} })"
      x-on:submit="validateBeforeSubmit($event)">
    @csrf
    <input type="hidden" name="harga_satuan" :value="paymentMode === 'cicil' ? calcTotalHarga : calcHarga">
    <input type="hidden" name="jumlah" :value="paymentMode === 'cicil' ? calcTotalHarga : calcTotal">
    <input type="hidden" name="total_harga_program" :value="calcTotalHarga">
    <input type="hidden" name="dp_nominal" :value="calcBayarSekarang">
    <input type="hidden" name="satuan" :value="{{ $scope }}.satuan || 'Paket'">
    <input type="hidden" name="bukti_gambar" :value="{{ $scope }}.bukti_gambar || ''">
    <input type="hidden" name="payment_mode" :value="paymentMode">
    <input type="hidden" name="is_piutang" :value="paymentMode === 'cicil' ? '1' : '0'">
    <input type="hidden" name="redirect_to" value="{{ $redirectValue }}">

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">

        {{-- 1. Ruang Lingkup Program / Umum --}}
        @if($programScopeMode === 'umum')
            {{-- Mode KEUANGAN UMUM: Tambah transaksi hanya untuk Umum; Edit mempertahankan scope aslinya --}}
            <div style="grid-column:1/-1;">
                <label class="bo-label">Jenis Kas / Ruang Lingkup</label>
                <div x-show="!{{ $scope }}.program_ref">
                    <input type="hidden" :name="!{{ $scope }}.program_ref ? 'program_ref' : ''" value="">
                    <div style="padding:10px 14px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:10px;display:flex;align-items:center;justify-content:space-between;gap:8px;">
                        <span style="font-weight:700;font-size:13.5px;color:#0f172a;display:flex;align-items:center;gap:6px;">
                            <span class="material-icons-round" style="font-size:18px;color:#0284c7;">domain</span>
                            Umum / Operasional Kampus (Non-Program)
                        </span>
                        <span style="font-size:11px;font-weight:600;padding:2px 8px;border-radius:99px;background:#e0f2fe;color:#0369a1;">Khusus Umum</span>
                    </div>
                    <div style="font-size:11px;color:#64748b;margin-top:4px;">
                        Input di Keuangan Umum khusus untuk kebutuhan umum (listrik, air, internet, ATK, perawatan gedung, dll). Transaksi program diinput di menu <a href="/backoffice/kas-keuangan-program" style="color:#1d4ed8;">Keuangan Program</a>.
                    </div>
                </div>
                <div x-show="!!{{ $scope }}.program_ref" style="display:none;">
                    <input type="hidden" :name="!!{{ $scope }}.program_ref ? 'program_ref' : ''" :value="{{ $scope }}.program_ref">
                    <div style="padding:10px 14px;background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:10px;display:flex;align-items:center;justify-content:space-between;gap:8px;">
                        <span style="font-weight:700;font-size:13.5px;color:#1e3a8a;display:flex;align-items:center;gap:6px;">
                            <span class="material-icons-round" style="font-size:18px;color:#2563eb;">school</span>
                            <span x-text="{{ $scope }}.programLabel || 'Transaksi Program'"></span>
                        </span>
                        <span style="font-size:11px;font-weight:600;padding:2px 8px;border-radius:99px;background:#dbeafe;color:#1d4ed8;">Program Terpilih</span>
                    </div>
                </div>
            </div>
        @elseif($programScopeMode === 'kategori')
            {{-- Mode KEUANGAN PER KATEGORI PROGRAM: Hanya bisa memilih program yang ada di kategori terpilih --}}
            <div style="grid-column:1/-1;">
                <label class="bo-label">Pilih Program ({{ $scopedCategoryName }}) <span style="color:#dc2626">*</span></label>
                <select class="bo-select" name="program_ref" x-model="{{ $scope }}.program_ref" required
                        x-on:change="onProgramChange($event.target)">
                    <option value="">-- Pilih Program di {{ $scopedCategoryName }} --</option>
                    @foreach($scopedPrograms as $prog)
                        <option value="prog:{{ $prog->id }}" data-fee="{{ (float)($prog->tuition_fee ?? 0) }}">
                            {{ $prog->title }} @if($prog->tuition_fee) (Tarif Resmi: Rp {{ number_format($prog->tuition_fee, 0, ',', '.') }}) @endif
                        </option>
                    @endforeach
                </select>
                <div style="font-size:11px;color:#64748b;margin-top:4px;">
                    Hanya menampilkan daftar program yang termasuk dalam kategori <strong>{{ $scopedCategoryName }}</strong>.
                </div>
            </div>
        @elseif($programScopeMode === 'locked')
            {{-- Mode DETAIL PROGRAM TERPILIH: Terkunci pada program yang sedang dibuka --}}
            <div style="grid-column:1/-1;">
                <label class="bo-label">Program Terpilih</label>
                <input type="hidden" name="program_ref" value="{{ $lockedProgramRef }}">
                <div style="padding:10px 14px;background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:10px;display:flex;align-items:center;justify-content:space-between;gap:8px;">
                    <span style="font-weight:700;font-size:13.5px;color:#1e3a8a;display:flex;align-items:center;gap:6px;">
                        <span class="material-icons-round" style="font-size:18px;color:#2563eb;">school</span>
                        {{ $lockedProgramLabel }}
                    </span>
                    <span style="font-size:11px;font-weight:600;padding:2px 8px;border-radius:99px;background:#dbeafe;color:#1d4ed8;">Khusus Program Ini</span>
                </div>
            </div>
        @endif

        {{-- 2. Tanggal Transaksi --}}
        <div>
            <label class="bo-label">Tanggal Transaksi <span style="color:#dc2626">*</span></label>
            <input type="date" class="bo-input" name="tanggal" x-model="{{ $scope }}.tanggal" required>
        </div>

        {{-- 3. Transaksi (Dropdown Pemasukan / Pengeluaran) --}}
        <div>
            <label class="bo-label">Transaksi <span style="color:#dc2626">*</span></label>
            <select class="bo-select" name="type" x-model="{{ $scope }}.type"
                    x-on:change="{{ $scope }}.jenis = ''; setPaymentMode('lunas');">
                <option value="">-- Pilih Transaksi --</option>
                <option value="masuk">Pemasukan (Uang Masuk)</option>
                <option value="keluar">Pengeluaran (Uang Keluar)</option>
            </select>
        </div>

        {{-- 4. Kategori (Sesuai Pemasukan / Pengeluaran / Piutang) --}}
        <div style="grid-column:1/-1;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:5px;">
                <label class="bo-label" style="margin-bottom:0;">Kategori <span style="color:#dc2626">*</span></label>
                <a href="/backoffice/kas-kategori" target="_blank" style="font-size:11.5px;color:#1d4ed8;text-decoration:none;display:inline-flex;align-items:center;gap:3px;">
                    <span class="material-icons-round" style="font-size:14px;">settings</span>
                    Kelola Kategori
                </a>
            </div>

            {{-- Belum pilih transaksi --}}
            <div x-show="!{{ $scope }}.type">
                <select class="bo-select" disabled style="background:#f8fafc;color:#94a3b8;">
                    <option value="">-- Pilih Transaksi terlebih dahulu --</option>
                </select>
            </div>

            @if($programScopeMode === 'umum')
                {{-- Kategori Pemasukan Umum --}}
                <div x-show="{{ $scope }}.type === 'masuk' && !{{ $scope }}.program_ref" style="display:none;">
                    <select class="bo-select"
                            :name="({{ $scope }}.type === 'masuk' && !{{ $scope }}.program_ref) ? 'jenis' : ''"
                            x-model="{{ $scope }}.jenis"
                            :disabled="{{ $scope }}.type !== 'masuk' || !!{{ $scope }}.program_ref">
                        <option value="">-- Pilih Kategori Pemasukan Umum --</option>
                        @foreach($catUmumMasuk as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori Piutang Umum --}}
                <div x-show="{{ $scope }}.type === 'piutang' && !{{ $scope }}.program_ref" style="display:none;">
                    <select class="bo-select"
                            :name="({{ $scope }}.type === 'piutang' && !{{ $scope }}.program_ref) ? 'jenis' : ''"
                            x-model="{{ $scope }}.jenis"
                            :disabled="{{ $scope }}.type !== 'piutang' || !!{{ $scope }}.program_ref">
                        <option value="">-- Pilih Kategori Piutang (Bisa Cicil / DP) --</option>
                        @foreach($piutangCategories as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori Pengeluaran Umum --}}
                <div x-show="{{ $scope }}.type === 'keluar' && !{{ $scope }}.program_ref" style="display:none;">
                    <select class="bo-select"
                            :name="({{ $scope }}.type === 'keluar' && !{{ $scope }}.program_ref) ? 'jenis' : ''"
                            x-model="{{ $scope }}.jenis"
                            :disabled="{{ $scope }}.type !== 'keluar' || !!{{ $scope }}.program_ref">
                        <option value="">-- Pilih Kategori Pengeluaran Umum --</option>
                        @foreach($catUmumKeluar as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori Pemasukan Program (hanya aktif saat edit transaksi program) --}}
                <div x-show="{{ $scope }}.type === 'masuk' && !!{{ $scope }}.program_ref" style="display:none;">
                    <select class="bo-select"
                            :name="({{ $scope }}.type === 'masuk' && !!{{ $scope }}.program_ref) ? 'jenis' : ''"
                            x-model="{{ $scope }}.jenis"
                            :disabled="{{ $scope }}.type !== 'masuk' || !{{ $scope }}.program_ref">
                        <option value="">-- Pilih Kategori Pemasukan Program --</option>
                        @foreach($catProgMasuk as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori Piutang Program (hanya aktif saat edit transaksi program) --}}
                <div x-show="{{ $scope }}.type === 'piutang' && !!{{ $scope }}.program_ref" style="display:none;">
                    <select class="bo-select"
                            :name="({{ $scope }}.type === 'piutang' && !!{{ $scope }}.program_ref) ? 'jenis' : ''"
                            x-model="{{ $scope }}.jenis"
                            :disabled="{{ $scope }}.type !== 'piutang' || !{{ $scope }}.program_ref">
                        <option value="">-- Pilih Kategori Piutang Program --</option>
                        @php $progPiutang = array_values(array_intersect($catProgMasuk, $piutangCategories)); @endphp
                        @foreach(!empty($progPiutang) ? $progPiutang : $piutangCategories as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori Pengeluaran Program (hanya aktif saat edit transaksi program) --}}
                <div x-show="{{ $scope }}.type === 'keluar' && !!{{ $scope }}.program_ref" style="display:none;">
                    <select class="bo-select"
                            :name="({{ $scope }}.type === 'keluar' && !!{{ $scope }}.program_ref) ? 'jenis' : ''"
                            x-model="{{ $scope }}.jenis"
                            :disabled="{{ $scope }}.type !== 'keluar' || !{{ $scope }}.program_ref">
                        <option value="">-- Pilih Kategori Pengeluaran Program --</option>
                        @foreach($catProgKeluar as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                {{-- Kategori Pemasukan Program --}}
                <div x-show="{{ $scope }}.type === 'masuk'" style="display:none;">
                    <select class="bo-select" :name="{{ $scope }}.type === 'masuk' ? 'jenis' : ''" x-model="{{ $scope }}.jenis" :disabled="{{ $scope }}.type !== 'masuk'">
                        <option value="">-- Pilih Kategori Pemasukan Program --</option>
                        @foreach($catProgMasuk as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori Piutang Program --}}
                <div x-show="{{ $scope }}.type === 'piutang'" style="display:none;">
                    <select class="bo-select" :name="{{ $scope }}.type === 'piutang' ? 'jenis' : ''" x-model="{{ $scope }}.jenis" :disabled="{{ $scope }}.type !== 'piutang'">
                        <option value="">-- Pilih Kategori Piutang Program --</option>
                        @php $progPiutang = array_values(array_intersect($catProgMasuk, $piutangCategories)); @endphp
                        @foreach(!empty($progPiutang) ? $progPiutang : $piutangCategories as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori Pengeluaran Program --}}
                <div x-show="{{ $scope }}.type === 'keluar'" style="display:none;">
                    <select class="bo-select" :name="{{ $scope }}.type === 'keluar' ? 'jenis' : ''" x-model="{{ $scope }}.jenis" :disabled="{{ $scope }}.type !== 'keluar'">
                        <option value="">-- Pilih Kategori Pengeluaran Program --</option>
                        @foreach($catProgKeluar as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            {{-- Status Skema Pembayaran Kategori Terpilih --}}
            <template x-if="!{{ $scope }}.editMode && {{ $scope }}.type === 'piutang' && {{ $scope }}.jenis">
                <div style="margin-top:6px;display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:11.5px;color:#92400e;background:#fef3c7;border:1px solid #fde68a;padding:3px 9px;border-radius:20px;font-weight:600;">
                        <span class="material-icons-round" style="font-size:14px;color:#d97706;">payments</span>
                        Kategori ini menerima skema <strong>Cicil / DP (Piutang)</strong>
                    </span>
                </div>
            </template>
            <template x-if="!{{ $scope }}.editMode && {{ $scope }}.type === 'masuk' && {{ $scope }}.jenis && canCicil()">
                <div style="margin-top:6px;display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:11.5px;color:#166534;background:#f0fdf4;border:1px solid #bbf7d0;padding:3px 9px;border-radius:20px;font-weight:600;">
                        <span class="material-icons-round" style="font-size:14px;color:#16a34a;">check_circle</span>
                        Kategori ini mendukung pilihan <strong>Bayar Lunas</strong> atau <strong>Cicil / DP</strong>
                    </span>
                </div>
            </template>
            <template x-if="!{{ $scope }}.editMode && {{ $scope }}.type === 'masuk' && {{ $scope }}.jenis && !canCicil()">
                <div style="margin-top:6px;display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:11.5px;color:#64748b;background:#f8fafc;border:1px solid #e2e8f0;padding:3px 9px;border-radius:20px;font-weight:500;">
                        <span class="material-icons-round" style="font-size:14px;color:#94a3b8;">lock</span>
                        Kategori ini disetting <strong>Hanya Lunas</strong> (tidak dapat dicicil / DP)
                    </span>
                </div>
            </template>
            <template x-if="{{ $scope }}.editMode">
                <div style="margin-top:6px;display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
                    <template x-if="{{ $scope }}.is_pending_piutang">
                        <span style="display:inline-flex;align-items:center;gap:4px;font-size:11.5px;color:#92400e;background:#fef3c7;border:1px solid #fde68a;padding:3px 9px;border-radius:20px;font-weight:600;">
                            <span class="material-icons-round" style="font-size:14px;color:#d97706;">pending_actions</span>
                            Status: <strong>Belum Lunas (Piutang)</strong>
                        </span>
                    </template>
                    <template x-if="!{{ $scope }}.is_pending_piutang">
                        <span style="display:inline-flex;align-items:center;gap:4px;font-size:11.5px;color:#166534;background:#f0fdf4;border:1px solid #bbf7d0;padding:3px 9px;border-radius:20px;font-weight:600;">
                            <span class="material-icons-round" style="font-size:14px;color:#16a34a;">verified</span>
                            Status: <strong>Lunas</strong>
                        </span>
                    </template>
                </div>
            </template>
        </div>

        {{-- 5. Data Kontak & Nomor HP / WhatsApp (Input deskripsi ditiadakan, cukup keterangan) --}}
        <div style="grid-column:1/-1;display:grid;grid-template-columns:1fr 1fr;gap:14px;">
            <div>
                <label class="bo-label">
                    <span x-text="paymentMode === 'cicil' ? 'Nama Siswa / Penanggung Piutang' : 'Nama Siswa / Pembayar (Opsional)'">Nama Siswa / Pembayar</span>
                    <span style="color:#dc2626" x-show="paymentMode === 'cicil' && calcSisaPiutang > 0">*</span>
                </label>
                <div style="position:relative;display:flex;align-items:center;">
                    <span class="material-icons-round" style="position:absolute;left:10px;font-size:18px;color:#94a3b8;pointer-events:none;">person</span>
                    <input type="text"
                           class="bo-input"
                           name="piutang_nama"
                           x-model="{{ $scope }}.piutang_nama"
                           placeholder="Contoh: I Komang Adi Artana"
                           style="padding-left:36px;"
                           :required="!{{ $scope }}.editMode && paymentMode === 'cicil' && calcSisaPiutang > 0">
                </div>
            </div>
            <div>
                <label class="bo-label" style="display:flex;align-items:center;gap:6px;">
                    <span class="material-icons-round" style="font-size:16px;color:#16a34a;">phone</span>
                    <span>Nomor HP / WhatsApp</span>
                </label>
                <div style="position:relative;display:flex;align-items:center;">
                    <span class="material-icons-round" style="position:absolute;left:10px;font-size:18px;color:#16a34a;pointer-events:none;">chat</span>
                    <input type="tel"
                           class="bo-input"
                           name="no_hp"
                           x-model="{{ $scope }}.no_hp"
                           placeholder="081234567890 / 628..."
                           style="padding-left:36px;">
                </div>
                <div style="font-size:11px;color:#64748b;margin-top:4px;">
                    Dapat dihubungi langsung melalui tombol WhatsApp di rincian transaksi.
                </div>
            </div>
        </div>

        {{-- 5b. Metode Pembayaran (Ultra-Clean & Minimalist Segmented Control - Strict Single Line) --}}
        <div style="grid-column:1/-1;">
            <style>
                .kas-metode-segmented {
                    background: #f1f5f9;
                    padding: 4px;
                    border-radius: 10px;
                    border: 1px solid #e2e8f0;
                    display: grid;
                    grid-template-columns: repeat(5, minmax(0, 1fr));
                    gap: 4px;
                    width: 100%;
                }
                .kas-metode-segmented .kas-metode-btn {
                    height: 38px;
                    padding: 0 6px;
                    border-radius: 7px;
                    border: none;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 5px;
                    font-size: 11.5px;
                    font-weight: 500;
                    font-family: 'Inter', sans-serif;
                    transition: all 0.15s ease;
                    white-space: nowrap !important;
                    outline: none;
                    text-decoration: none;
                }
                .kas-metode-segmented .kas-metode-btn span {
                    white-space: nowrap !important;
                    line-height: 1;
                }
                @media (max-width: 580px) {
                    .kas-metode-segmented {
                        grid-template-columns: repeat(3, minmax(0, 1fr));
                    }
                }
                @media (max-width: 380px) {
                    .kas-metode-segmented {
                        grid-template-columns: repeat(2, minmax(0, 1fr));
                    }
                }
            </style>

            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:7px;flex-wrap:nowrap;gap:8px;">
                <label class="bo-label" style="margin:0;font-size:12.5px;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:4px;white-space:nowrap;">
                    <span>Metode Pembayaran</span>
                    <span style="color:#dc2626;">*</span>
                </label>
                <span style="font-size:11.5px;color:#64748b;white-space:nowrap;" x-text="'Dipilih: ' + ({{ $scope }}.metode_pembayaran || 'Transfer Bank')"></span>
            </div>

            @php
                $metodeList = [
                    ['key' => 'Transfer Bank', 'icon' => 'account_balance'],
                    ['key' => 'Kas Tunai',     'icon' => 'payments'],
                    ['key' => 'QRIS',          'icon' => 'qr_code_2'],
                    ['key' => 'EDC / Debit',   'icon' => 'credit_card'],
                    ['key' => 'Lainnya',       'icon' => 'more_horiz'],
                ];
            @endphp

            <div class="kas-metode-segmented">
                @foreach($metodeList as $m)
                    <button type="button"
                            x-on:click="{{ $scope }}.metode_pembayaran = '{{ $m['key'] }}'"
                            class="kas-metode-btn"
                            :style="({{ $scope }}.metode_pembayaran || 'Transfer Bank') === '{{ $m['key'] }}'
                                ? 'background:#ffffff;color:#0f172a;font-weight:700;box-shadow:0 1px 3px rgba(15,23,42,0.1), 0 1px 2px rgba(15,23,42,0.06);'
                                : 'background:transparent;color:#64748b;font-weight:500;'"
                            onmouseover="if(({{ $scope }}.metode_pembayaran || 'Transfer Bank') !== '{{ $m['key'] }}') { this.style.color='#1e293b'; this.style.background='rgba(255,255,255,0.6)'; }"
                            onmouseout="if(({{ $scope }}.metode_pembayaran || 'Transfer Bank') !== '{{ $m['key'] }}') { this.style.color='#64748b'; this.style.background='transparent'; }">
                        <span class="material-icons-round" style="font-size:16px;flex-shrink:0;transition:color 0.15s ease;"
                              :style="({{ $scope }}.metode_pembayaran || 'Transfer Bank') === '{{ $m['key'] }}' ? 'color:#1A365D;' : 'color:#94a3b8;'">
                            {{ $m['icon'] }}
                        </span>
                        <span style="white-space:nowrap !important;flex-shrink:0;">{{ $m['key'] }}</span>
                    </button>
                @endforeach
            </div>

            <input type="hidden" name="metode_pembayaran" :value="{{ $scope }}.metode_pembayaran || 'Transfer Bank'">
        </div>

        {{-- 5c. Skema Pembayaran Transaksi (Tambah Baru) / Bayar Cicilan (Edit Piutang) --}}
        <div style="grid-column:1/-1;"
             x-show="shouldShowPaymentScheme()"
             x-transition>
            <div style="background:#ffffff;border:1.5px solid #e2e8f0;border-radius:16px;padding:20px;box-shadow:0 4px 20px -2px rgba(15,23,42,0.06);transition:all 0.25s ease;"
                 :style="paymentMode === 'cicil' ? 'border-color:#fde68a;background:linear-gradient(180deg, #fffdfa 0%, #ffffff 100%);box-shadow:0 4px 20px -2px rgba(217,119,6,0.08);' : 'border-color:#bbf7d0;background:linear-gradient(180deg, #fafffc 0%, #ffffff 100%);box-shadow:0 4px 20px -2px rgba(16,185,129,0.08);'">
                
                {{-- KASUS 1: MODE ADD (TAMBAH TRANSAKSI BARU) --}}
                <template x-if="!{{ $scope }}.editMode">
                    <div>
                        {{-- Header Skema Pembayaran --}}
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:14px;border-bottom:1px solid #f1f5f9;flex-wrap:wrap;gap:10px;">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div style="width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;transition:all 0.2s;"
                                     :style="paymentMode === 'cicil' ? 'background:#fef3c7;color:#b45309;' : 'background:#dcfce7;color:#15803d;'">
                                    <span class="material-icons-round" style="font-size:22px;" x-text="paymentMode === 'cicil' ? 'pending_actions' : 'account_balance_wallet'"></span>
                                </div>
                                <div>
                                    <div style="font-size:14px;font-weight:800;color:#0f172a;letter-spacing:-0.01em;">Skema Pembayaran Transaksi</div>
                                    <div style="font-size:12px;color:#64748b;margin-top:1px;">Pilih penerimaan lunas atau bertahap (cicilan / DP)</div>
                                </div>
                            </div>
                            <div style="display:inline-flex;align-items:center;gap:6px;font-size:11.5px;font-weight:700;padding:4px 12px;border-radius:99px;transition:all 0.2s;"
                                 :style="paymentMode === 'cicil' ? 'background:#fef3c7;color:#92400e;border:1px solid #fde68a;' : 'background:#dcfce7;color:#15803d;border:1px solid #bbf7d0;'">
                                <span style="width:7px;height:7px;border-radius:50%;" :style="paymentMode === 'cicil' ? 'background:#d97706;' : 'background:#16a34a;'"></span>
                                <span x-text="paymentMode === 'cicil' ? 'Skema: Cicilan / DP (Piutang)' : 'Skema: Bayar Lunas (100% Kas)'"></span>
                            </div>
                        </div>

                        {{-- Dua Tombol Toggle: Bayar Lunas vs Cicil / DP --}}
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:16px;">
                            
                            {{-- Opsi 1: Bayar Lunas --}}
                            <div x-on:click="setPaymentMode('lunas')"
                                 style="cursor:pointer;border-radius:14px;padding:16px 18px;transition:all 0.2s cubic-bezier(0.16, 1, 0.3, 1);position:relative;"
                                 :style="paymentMode === 'lunas'
                                     ? 'background:linear-gradient(145deg, #ffffff 0%, #f0fdf4 100%);border:2px solid #059669;box-shadow:0 4px 16px -2px rgba(5,150,105,0.18);'
                                     : 'background:#ffffff;border:1.5px solid #e2e8f0;box-shadow:0 1px 3px rgba(0,0,0,0.02);'"
                                 onmouseover="if(this.getAttribute('data-active')!=='true'){this.style.borderColor='#cbd5e1';this.style.background='#f8fafc';}"
                                 onmouseout="if(this.getAttribute('data-active')!=='true'){this.style.borderColor='#e2e8f0';this.style.background='#ffffff';}"
                                 :data-active="paymentMode === 'lunas' ? 'true' : 'false'">
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        {{-- Custom Sleek Radio Indicator --}}
                                        <div style="width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.2s;"
                                             :style="paymentMode === 'lunas'
                                                 ? 'background:#059669;box-shadow:0 2px 6px rgba(5,150,105,0.35);'
                                                 : 'border:2px solid #cbd5e1;background:#ffffff;'">
                                            <span class="material-icons-round" style="font-size:15px;color:#ffffff;" x-show="paymentMode === 'lunas'">check</span>
                                        </div>
                                        <span style="font-weight:800;font-size:14px;letter-spacing:-0.01em;"
                                              :style="paymentMode === 'lunas' ? 'color:#065f46;' : 'color:#1e293b;'">
                                            Bayar Lunas
                                        </span>
                                    </div>
                                    <span style="font-size:10.5px;font-weight:700;padding:2px 9px;border-radius:99px;"
                                          :style="paymentMode === 'lunas' ? 'background:#d1fae5;color:#047857;border:1px solid #a7f3d0;' : 'background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;'">
                                        100% Kas
                                    </span>
                                </div>
                                <div style="font-size:12px;line-height:1.45;padding-left:32px;"
                                     :style="paymentMode === 'lunas' ? 'color:#047857;' : 'color:#64748b;'">
                                    Langsung masuk penuh ke kas DHS hari ini tanpa tagihan piutang.
                                </div>
                            </div>

                            {{-- Opsi 2: Cicil / DP --}}
                            <div x-on:click="setPaymentMode('cicil')"
                                 style="cursor:pointer;border-radius:14px;padding:16px 18px;transition:all 0.2s cubic-bezier(0.16, 1, 0.3, 1);position:relative;"
                                 :style="paymentMode === 'cicil'
                                     ? 'background:linear-gradient(145deg, #ffffff 0%, #fffbeb 100%);border:2px solid #d97706;box-shadow:0 4px 16px -2px rgba(217,119,6,0.18);'
                                     : 'background:#ffffff;border:1.5px solid #e2e8f0;box-shadow:0 1px 3px rgba(0,0,0,0.02);'"
                                 onmouseover="if(this.getAttribute('data-active')!=='true'){this.style.borderColor='#cbd5e1';this.style.background='#f8fafc';}"
                                 onmouseout="if(this.getAttribute('data-active')!=='true'){this.style.borderColor='#e2e8f0';this.style.background='#ffffff';}"
                                 :data-active="paymentMode === 'cicil' ? 'true' : 'false'">
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        {{-- Custom Sleek Radio Indicator --}}
                                        <div style="width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.2s;"
                                             :style="paymentMode === 'cicil'
                                                 ? 'background:#d97706;box-shadow:0 2px 6px rgba(217,119,6,0.35);'
                                                 : 'border:2px solid #cbd5e1;background:#ffffff;'">
                                            <span class="material-icons-round" style="font-size:15px;color:#ffffff;" x-show="paymentMode === 'cicil'">check</span>
                                        </div>
                                        <span style="font-weight:800;font-size:14px;letter-spacing:-0.01em;"
                                              :style="paymentMode === 'cicil' ? 'color:#92400e;' : 'color:#1e293b;'">
                                            Cicil / DP
                                        </span>
                                    </div>
                                    <span style="font-size:10.5px;font-weight:700;padding:2px 9px;border-radius:99px;"
                                          :style="paymentMode === 'cicil' ? 'background:#fef3c7;color:#92400e;border:1px solid #fde68a;' : 'background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;'">
                                        Piutang
                                    </span>
                                </div>
                                <div style="font-size:12px;line-height:1.45;padding-left:32px;"
                                     :style="paymentMode === 'cicil' ? 'color:#92400e;' : 'color:#64748b;'">
                                    Bayar uang muka (DP), sisa dana dicatat sebagai Uang di Lapangan.
                                </div>
                            </div>

                        </div>

                        {{-- KONTEN BAYAR LUNAS (ADD): Banner Ringkas Lunas --}}
                        <div x-show="paymentMode === 'lunas'"
                             style="background:#f0fdf4;border:1.5px solid #a7f3d0;border-radius:12px;padding:14px 16px;display:flex;align-items:flex-start;gap:12px;">
                            <div style="width:34px;height:34px;border-radius:10px;background:#dcfce7;color:#15803d;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <span class="material-icons-round" style="font-size:20px;">verified</span>
                            </div>
                            <div style="font-size:12.5px;color:#166534;line-height:1.5;">
                                <div style="font-weight:800;color:#14532d;margin-bottom:2px;">Pembayaran Lunas Penuh (100% Masuk Kas)</div>
                                <template x-if="calcTotal > 0">
                                    <span>
                                        Nominal transaksi sebesar <strong style="font-weight:800;color:#0f5132;" x-text="'Rp ' + window.DHSKasHelper.formatNumber(calcTotal)"></strong> akan langsung 100% tercatat ke saldo kas pemasukan DHS hari ini tanpa tagihan piutang.
                                    </span>
                                </template>
                                <template x-if="calcTotal <= 0">
                                    <span>
                                        Seluruh pembayaran akan langsung tercatat sebagai pemasukan kas DHS hari ini tanpa ada tagihan piutang. Silakan tentukan Volume dan Satuan di bawah.
                                    </span>
                                </template>
                            </div>
                        </div>

                        {{-- KONTEN CICIL / DP (ADD): Rincian Piutang & Cicilan --}}
                        <div x-show="paymentMode === 'cicil'" style="display:none;background:#fffdf7;border:1.5px solid #fde68a;border-radius:14px;padding:16px 18px;margin-top:14px;">
                            
                            <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px;padding-bottom:10px;border-bottom:1px solid #fef3c7;">
                                <div style="width:32px;height:32px;border-radius:9px;background:#fef3c7;color:#b45309;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <span class="material-icons-round" style="font-size:19px;">receipt_long</span>
                                </div>
                                <div>
                                    <div style="font-size:13.5px;font-weight:800;color:#92400e;">Rincian Piutang &amp; Cicilan (Uang di Lapangan)</div>
                                    <div style="font-size:11.5px;color:#b45309;">Tentukan total kesepakatan biaya dan nominal setoran kas hari ini.</div>
                                </div>
                            </div>

                            {{-- Input Kolom: Total Harga & Bayar Sekarang --}}
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
                                <div>
                                    <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:6px;">
                                        <label class="bo-label" style="font-size:12px;margin-bottom:0;color:#92400e;font-weight:700;white-space:nowrap;">
                                            Total Biaya Program (Rp) <span style="color:#dc2626">*</span>
                                        </label>
                                        <template x-if="selectedProgramFee > 0">
                                            <button type="button" x-on:click="setTotalHarga(selectedProgramFee)"
                                                    style="border:1px solid #bfdbfe;background:#eff6ff;color:#1d4ed8;font-size:11px;font-weight:700;cursor:pointer;padding:3px 10px;border-radius:7px;display:inline-flex;align-items:center;gap:4px;white-space:nowrap;flex-shrink:0;transition:all 0.15s;"
                                                    onmouseover="this.style.background='#dbeafe';this.style.borderColor='#93c5fd';"
                                                    onmouseout="this.style.background='#eff6ff';this.style.borderColor='#bfdbfe';">
                                                <span class="material-icons-round" style="font-size:14px;">bolt</span> Gunakan Tarif Resmi
                                            </button>
                                        </template>
                                    </div>
                                    <div style="position:relative;display:flex;align-items:center;">
                                        <span style="position:absolute;left:10px;font-size:12px;font-weight:800;color:#64748b;background:#f1f5f9;padding:3px 8px;border-radius:6px;pointer-events:none;border:1px solid #e2e8f0;">Rp</span>
                                        <input type="text"
                                               class="bo-input"
                                               x-model="totalHargaDisplay"
                                               x-on:input="totalHargaDisplay = window.DHSKasHelper.formatRupiahString($event.target.value); {{ $scope }}.hargaSatuanDisplay = totalHargaDisplay"
                                               placeholder="Contoh: 18.000.000"
                                               style="padding-left:48px;font-weight:800;font-size:14.5px;background:#ffffff;border:1.5px solid #cbd5e1;border-radius:9px;color:#0f172a;height:42px;"
                                               :required="!{{ $scope }}.editMode && paymentMode === 'cicil'">
                                    </div>
                                    <div style="font-size:11px;color:#78350f;margin-top:4px;">
                                        Total biaya keseluruhan program yang disepakati (bisa diinput manual).
                                    </div>
                                </div>

                                <div>
                                    <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:6px;">
                                        <label class="bo-label" style="font-size:12px;margin-bottom:0;color:#166534;font-weight:700;white-space:nowrap;">
                                            Nominal Dibayar Sekarang (Rp) <span style="color:#dc2626">*</span>
                                        </label>
                                        <span style="font-size:11px;font-weight:700;padding:2px 8px;border-radius:6px;background:#dcfce7;color:#15803d;border:1px solid #bbf7d0;white-space:nowrap;flex-shrink:0;">
                                            Masuk Kas
                                        </span>
                                    </div>
                                    <div style="position:relative;display:flex;align-items:center;">
                                        <span style="position:absolute;left:10px;font-size:12px;font-weight:800;color:#15803d;background:#dcfce7;padding:3px 8px;border-radius:6px;pointer-events:none;border:1px solid #bbf7d0;">Rp</span>
                                        <input type="text"
                                               class="bo-input"
                                               x-model="bayarSekarangDisplay"
                                               x-on:input="bayarSekarangDisplay = window.DHSKasHelper.formatRupiahString($event.target.value)"
                                               placeholder="0 (atau misal 5.000.000)"
                                               style="padding-left:48px;font-weight:800;font-size:14.5px;background:#ffffff;border:1.5px solid #86efac;border-radius:9px;color:#15803d;height:42px;">
                                    </div>
                                    <div style="font-size:11px;color:#166534;margin-top:4px;">
                                        Nominal ini langsung masuk ke saldo kas pemasukan DHS hari ini.
                                    </div>
                                </div>
                            </div>

                            {{-- 3 Kartu Ringkasan Keuangan --}}
                            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px;margin-bottom:12px;">
                                <div style="background:#ffffff;border:1.5px solid #e2e8f0;border-radius:12px;padding:12px 14px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                                    <div style="font-size:10.5px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.5px;">Total Biaya</div>
                                    <div style="font-size:16px;font-weight:800;color:#0f172a;margin-top:3px;"
                                         x-text="'Rp ' + window.DHSKasHelper.formatNumber(calcTotalHarga)"></div>
                                    <div style="font-size:11px;color:#94a3b8;margin-top:2px;">Biaya Program</div>
                                </div>

                                <div style="background:#f0fdf4;border:1.5px solid #86efac;border-radius:12px;padding:12px 14px;text-align:center;box-shadow:0 1px 3px rgba(22,163,74,0.05);">
                                    <div style="font-size:10.5px;font-weight:700;color:#15803d;text-transform:uppercase;letter-spacing:0.5px;">Masuk ke Kas</div>
                                    <div style="font-size:16px;font-weight:800;color:#15803d;margin-top:3px;"
                                         x-text="'Rp ' + window.DHSKasHelper.formatNumber(calcBayarSekarang)"></div>
                                    <div style="font-size:11px;font-weight:600;color:#16a34a;margin-top:2px;"
                                         x-text="calcPercentPaid + '% Dari Total'"></div>
                                </div>

                                <div style="background:#fffbeb;border:1.5px solid #fde68a;border-radius:12px;padding:12px 14px;text-align:center;box-shadow:0 1px 3px rgba(217,119,6,0.05);">
                                    <div style="font-size:10.5px;font-weight:700;color:#b45309;text-transform:uppercase;letter-spacing:0.5px;">Sisa Piutang</div>
                                    <div style="font-size:16px;font-weight:800;color:#b45309;margin-top:3px;"
                                         x-text="'Rp ' + window.DHSKasHelper.formatNumber(calcSisaPiutang)"></div>
                                    <div style="font-size:11px;font-weight:600;color:#d97706;margin-top:2px;">Uang di Lapangan</div>
                                </div>
                            </div>

                            {{-- Mini Visual Progress Bar --}}
                            <div style="background:#f1f5f9;border-radius:99px;height:8px;overflow:hidden;margin-bottom:12px;display:flex;">
                                <div :style="'width: ' + calcPercentPaid + '%;'" style="background:#16a34a;transition:width 0.3s ease;"></div>
                                <div :style="'width: ' + calcPercentRemaining + '%;'" style="background:#f59e0b;transition:width 0.3s ease;"></div>
                            </div>

                            {{-- Status Dinamis Banner --}}
                            <div style="padding:11px 14px;border-radius:10px;font-size:12px;font-weight:600;margin-bottom:12px;display:flex;align-items:center;gap:10px;"
                                 :style="calcBayarSekarang > 0 && calcSisaPiutang > 0
                                     ? 'background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;'
                                     : (calcBayarSekarang === 0 && calcTotalHarga > 0
                                         ? 'background:#fef3c7;border:1px solid #fde68a;color:#92400e;'
                                         : (calcBayarSekarang >= calcTotalHarga && calcTotalHarga > 0
                                             ? 'background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;'
                                             : 'background:#eff6ff;border:1px solid #bfdbfe;color:#1e40af;'))">
                                <span class="material-icons-round" style="font-size:19px;flex-shrink:0;"
                                      x-text="calcBayarSekarang > 0 && calcSisaPiutang > 0 ? 'check_circle' : (calcBayarSekarang === 0 && calcTotalHarga > 0 ? 'info' : (calcBayarSekarang >= calcTotalHarga && calcTotalHarga > 0 ? 'task_alt' : 'help_outline'))"></span>
                                <span x-text="calcBayarSekarang > 0 && calcSisaPiutang > 0
                                    ? 'Cicilan Rp ' + window.DHSKasHelper.formatNumber(calcBayarSekarang) + ' akan langsung masuk ke kas DHS. Sisa Rp ' + window.DHSKasHelper.formatNumber(calcSisaPiutang) + ' dicatat sebagai Uang di Lapangan (Piutang).'
                                    : (calcBayarSekarang === 0 && calcTotalHarga > 0
                                        ? 'Belum ada pembayaran hari ini (Rp 0 masuk kas). Total Rp ' + window.DHSKasHelper.formatNumber(calcTotalHarga) + ' akan tercatat sebagai Piutang di Lapangan.'
                                        : (calcBayarSekarang >= calcTotalHarga && calcTotalHarga > 0
                                            ? 'Pembayaran Lunas Penuh: 100% dana (Rp ' + window.DHSKasHelper.formatNumber(calcBayarSekarang) + ') masuk ke kas DHS tanpa sisa piutang.'
                                            : 'Silakan tentukan Total Biaya Program dan nominal yang dibayar sekarang.'))"></span>
                            </div>

                            {{-- Info Konfirmasi Penanggung Piutang & Kontak (Tersambung ke input atas) --}}
                            <div style="background:#ffffff;border:1.5px solid #fde68a;border-radius:11px;padding:12px 14px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                                <div>
                                    <div style="font-size:11px;color:#92400e;font-weight:700;text-transform:uppercase;">Penanggung Tagihan / Siswa:</div>
                                    <div style="font-size:13.5px;font-weight:800;color:#78350f;" x-text="{{ $scope }}.piutang_nama || '(Sesuai nama kontak di atas)'"></div>
                                </div>
                                <template x-if="{{ $scope }}.no_hp">
                                    <div style="display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:700;color:#059669;background:#ecfdf5;padding:4px 10px;border-radius:8px;border:1px solid #a7f3d0;">
                                        <span class="material-icons-round" style="font-size:15px;">chat</span>
                                        <span x-text="{{ $scope }}.no_hp"></span>
                                    </div>
                                </template>
                            </div>

                        </div>
                    </div>
                </template>

                {{-- KASUS 2: MODE EDIT PADA TRANSAKSI YANG MASIH DIHITUNG SEBAGAI PIUTANG --}}
                <template x-if="{{ $scope }}.editMode && {{ $scope }}.is_pending_piutang">
                    <div style="background:#ffffff;border:1.5px solid #fde68a;border-radius:14px;padding:18px 20px;box-shadow:0 4px 16px -2px rgba(217,119,6,0.08);">
                        {{-- Header Bayar Cicilan --}}
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;padding-bottom:12px;border-bottom:1px solid #fef3c7;flex-wrap:wrap;gap:10px;">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:38px;height:38px;border-radius:10px;background:#fef3c7;color:#b45309;display:flex;align-items:center;justify-content:center;">
                                    <span class="material-icons-round" style="font-size:22px;">account_balance_wallet</span>
                                </div>
                                <div>
                                    <div style="font-size:14px;font-weight:800;color:#92400e;">Bayar Cicilan / Pelunasan Piutang</div>
                                    <div style="font-size:12px;color:#b45309;">Catat setoran cicilan yang masuk kas hari ini untuk mengurangi sisa tagihan piutang.</div>
                                </div>
                            </div>
                            <div style="display:inline-flex;align-items:center;gap:6px;font-size:11.5px;font-weight:700;padding:4px 12px;border-radius:99px;background:#fef3c7;color:#92400e;border:1px solid #fde68a;">
                                <span style="width:7px;height:7px;border-radius:50%;background:#d97706;"></span>
                                <span>Tagihan Belum Lunas</span>
                            </div>
                        </div>

                        {{-- Ringkasan Sisa Tagihan Saat Ini & Penanggung --}}
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px;">
                            <div style="background:#fffbeb;border:1.5px solid #fde68a;border-radius:12px;padding:12px 14px;box-shadow:0 1px 3px rgba(217,119,6,0.04);">
                                <div style="font-size:11px;font-weight:700;color:#92400e;text-transform:uppercase;letter-spacing:0.5px;">Sisa Tagihan Piutang Saat Ini</div>
                                <div style="font-size:20px;font-weight:800;color:#b45309;margin-top:3px;"
                                     x-text="'Rp ' + window.DHSKasHelper.formatNumber({{ $scope }}.sisa_piutang || calcTotalHarga)"></div>
                                <div style="font-size:11px;color:#d97706;margin-top:2px;">Uang di Lapangan</div>
                            </div>

                            <div style="background:#ffffff;border:1.5px solid #e2e8f0;border-radius:12px;padding:12px 14px;box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                                <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.5px;">Penanggung / Mahasiswa</div>
                                <div style="font-size:15px;font-weight:800;color:#0f172a;margin-top:3px;"
                                     x-text="{{ $scope }}.piutang_nama || 'Belum dinamai'"></div>
                                <div style="font-size:11px;color:#94a3b8;margin-top:2px;">Target penagihan</div>
                            </div>
                        </div>

                        {{-- Input Setor Cicilan Masuk Kas --}}
                        <div style="background:#f8fafc;border:1.5px solid #cbd5e1;border-radius:12px;padding:14px;margin-bottom:12px;">
                            <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:6px;flex-wrap:wrap;">
                                <label class="bo-label" style="font-size:12.5px;margin-bottom:0;color:#15803d;font-weight:800;">
                                    Nominal Cicilan yang Disetor Sekarang (Masuk Kas)
                                </label>
                                <button type="button"
                                        x-on:click="bayarSekarangDisplay = window.DHSKasHelper.formatNumber({{ $scope }}.sisa_piutang || calcTotalHarga)"
                                        style="border:1px solid #86efac;background:#dcfce7;color:#15803d;font-size:11px;font-weight:700;cursor:pointer;padding:3px 10px;border-radius:7px;display:inline-flex;align-items:center;gap:4px;transition:all 0.15s;"
                                        onmouseover="this.style.background='#bbf7d0';"
                                        onmouseout="this.style.background='#dcfce7';">
                                    <span class="material-icons-round" style="font-size:14px;">done_all</span> Lunasi Penuh
                                </button>
                            </div>
                            <div style="position:relative;display:flex;align-items:center;">
                                <span style="position:absolute;left:10px;font-size:12px;font-weight:800;color:#15803d;background:#dcfce7;padding:3px 8px;border-radius:6px;pointer-events:none;border:1px solid #bbf7d0;">Rp</span>
                                <input type="text"
                                       class="bo-input"
                                       x-model="bayarSekarangDisplay"
                                       x-on:input="bayarSekarangDisplay = window.DHSKasHelper.formatRupiahString($event.target.value)"
                                       placeholder="0 (isi nominal jika ada setoran cicilan hari ini)"
                                       style="padding-left:48px;font-weight:800;font-size:15px;background:#ffffff;border:1.5px solid #86efac;border-radius:9px;color:#15803d;height:42px;">
                            </div>
                            <div style="font-size:11px;color:#64748b;margin-top:5px;">
                                Isi nominal di atas untuk mencatat cicilan masuk kas hari ini dan mengurangi sisa piutang. Biarkan <strong>Rp 0</strong> jika hanya ingin mengubah data tanpa setoran cicilan.
                            </div>

                            {{-- Dinamis kalkulasi sisa setelah setoran --}}
                            <template x-if="calcBayarSekarang > 0">
                                <div style="margin-top:10px;padding:10px 14px;border-radius:9px;font-size:12px;font-weight:600;display:flex;align-items:center;gap:10px;"
                                     :style="calcBayarSekarang >= ({{ $scope }}.sisa_piutang || calcTotalHarga)
                                         ? 'background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;'
                                         : 'background:#eff6ff;border:1px solid #bfdbfe;color:#1e40af;'">
                                    <span class="material-icons-round" style="font-size:19px;"
                                          x-text="calcBayarSekarang >= ({{ $scope }}.sisa_piutang || calcTotalHarga) ? 'verified' : 'info'"></span>
                                    <span x-text="calcBayarSekarang >= ({{ $scope }}.sisa_piutang || calcTotalHarga)
                                        ? 'Setoran Rp ' + window.DHSKasHelper.formatNumber(calcBayarSekarang) + ' akan MELUNASI PENUH tagihan ini (Status menjadi LUNAS).'
                                        : 'Setoran Rp ' + window.DHSKasHelper.formatNumber(calcBayarSekarang) + ' masuk ke kas hari ini. Sisa piutang menjadi Rp ' + window.DHSKasHelper.formatNumber(Math.max(0, ({{ $scope }}.sisa_piutang || calcTotalHarga) - calcBayarSekarang)) + '.'"></span>
                                </div>
                            </template>
                        </div>

                        {{-- Ubah Nama Siswa / Penanggung Piutang --}}
                        <div>
                            <label class="bo-label" style="font-size:12px;color:#92400e;font-weight:700;">
                                Nama Siswa / Penanggung Piutang
                            </label>
                            <div style="position:relative;display:flex;align-items:center;">
                                <span class="material-icons-round" style="position:absolute;left:10px;font-size:18px;color:#94a3b8;pointer-events:none;">person</span>
                                <input type="text"
                                       class="bo-input"
                                       name="piutang_nama"
                                       x-model="{{ $scope }}.piutang_nama"
                                       placeholder="Nama Siswa / Penanggung Piutang"
                                       style="padding-left:36px;background:#ffffff;font-weight:600;border:1.5px solid #cbd5e1;border-radius:9px;height:42px;">
                            </div>
                        </div>
                    </div>
                </template>

            </div>
        </div>

        {{-- 6. Satuan (Dropdown Dinamis Bisa Tambah Langsung) & Volume (Tampil jika paymentMode !== 'cicil') --}}
        <div style="position:relative;" x-on:click.away="unitOpen = false" x-show="paymentMode !== 'cicil'">
            <label class="bo-label">Satuan</label>
            <button type="button"
                    x-on:click="unitOpen = !unitOpen"
                    class="bo-input"
                    style="display:flex;align-items:center;justify-content:space-between;cursor:pointer;text-align:left;background:#fff;">
                <span x-text="{{ $scope }}.satuan || 'Pilih Satuan'" :style="{{ $scope }}.satuan ? 'color:#0f172a;font-weight:500;' : 'color:#94a3b8;'"></span>
                <span class="material-icons-round" style="font-size:18px;color:#64748b;" x-text="unitOpen ? 'expand_less' : 'expand_more'"></span>
            </button>

            <div x-show="unitOpen" x-transition
                 style="display:none;position:absolute;top:100%;left:0;right:0;margin-top:4px;background:#fff;border:1.5px solid #cbd5e1;border-radius:10px;box-shadow:0 12px 28px rgba(15,23,42,0.14);z-index:80;padding:8px;">
                {{-- Input Tambah Satuan Langsung --}}
                <div style="display:flex;gap:6px;margin-bottom:8px;padding-bottom:8px;border-bottom:1px solid #f1f5f9;">
                    <input type="text"
                           x-model="newUnit"
                           x-on:keydown.enter.prevent="submitNewUnit()"
                           placeholder="Tambah satuan baru..."
                           style="flex:1;min-width:0;padding:6px 10px;font-size:12.5px;border:1px solid #cbd5e1;border-radius:7px;outline:none;">
                    <button type="button"
                            x-on:click="submitNewUnit()"
                            :disabled="!newUnit.trim() || unitSaving"
                            style="padding:6px 10px;background:#1A365D;color:#fff;border:none;border-radius:7px;font-size:12px;font-weight:600;cursor:pointer;white-space:nowrap;">
                        + Tambah
                    </button>
                </div>

                {{-- Pilihan Satuan --}}
                <div style="max-height:175px;overflow-y:auto;display:flex;flex-direction:column;gap:2px;">
                    <template x-for="u in unitsList" :key="u">
                        <button type="button"
                                x-on:click="{{ $scope }}.satuan = u; unitOpen = false"
                                style="display:flex;align-items:center;justify-content:space-between;padding:7px 10px;border:none;border-radius:6px;cursor:pointer;font-size:13px;text-align:left;"
                                :style="{{ $scope }}.satuan === u ? 'background:#eff6ff;color:#1d4ed8;font-weight:600;' : 'background:transparent;color:#334155;'">
                            <span x-text="u"></span>
                            <span class="material-icons-round" style="font-size:15px;" x-show="{{ $scope }}.satuan === u">check</span>
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <div x-show="paymentMode !== 'cicil'">
            <label class="bo-label">Volume (Jumlah) <span style="color:#dc2626" x-show="paymentMode !== 'cicil'">*</span></label>
            <input type="number" class="bo-input" name="volume" x-model="{{ $scope }}.volume"
                   min="0.01" step="any" placeholder="1" :required="paymentMode !== 'cicil'">
        </div>

        {{-- 7. Harga Satuan (Rp) format titik setiap 3 angka (Tampil jika paymentMode !== 'cicil') --}}
        <div style="grid-column:1/-1;" x-show="paymentMode !== 'cicil'">
            <label class="bo-label">Harga Satuan (Rp) <span style="color:#dc2626" x-show="paymentMode !== 'cicil'">*</span></label>
            <div style="position:relative;display:flex;align-items:center;">
                <span style="position:absolute;left:14px;font-weight:700;font-size:13.5px;color:#64748b;pointer-events:none;">Rp</span>
                <input type="text"
                       class="bo-input"
                       x-model="{{ $scope }}.hargaSatuanDisplay"
                       x-on:input="{{ $scope }}.hargaSatuanDisplay = window.DHSKasHelper.formatRupiahString($event.target.value)"
                       placeholder="Contoh: 500.000"
                       inputmode="numeric"
                       style="padding-left:42px;font-weight:600;"
                       :required="paymentMode !== 'cicil'">
            </div>
        </div>

        {{-- 8. Total Transaksi (Otomatis) (Tampil jika paymentMode !== 'cicil') --}}
        <div style="grid-column:1/-1;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:10px;padding:12px 16px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;"
             x-show="paymentMode !== 'cicil'">
            <div>
                <div style="font-size:12px;color:#64748b;font-weight:600;">Total Transaksi (Otomatis)</div>
                <div style="font-size:11px;color:#94a3b8;" x-text="(parseFloat({{ $scope }}.volume) || 0) + ' ' + ({{ $scope }}.satuan || 'Paket') + ' × Rp ' + window.DHSKasHelper.formatNumber(calcHarga)"></div>
            </div>
            <div style="font-size:22px;font-weight:800;"
                 :style="{{ $scope }}.type === 'keluar' ? 'color:#b91c1c;' : 'color:#0f172a;'"
                 x-text="'Rp ' + window.DHSKasHelper.formatNumber(calcTotal)"></div>
        </div>

        {{-- 9. Keterangan & Uraian Transaksi (Rich Text Editor: Bold, List, Teks Panjang) --}}
        <div style="grid-column:1/-1;">
            <label class="bo-label" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                <span style="font-weight:700;color:#0f172a;">Keterangan &amp; Uraian Transaksi</span>
                <span style="font-size:11.5px;color:#64748b;font-weight:normal;">Mendukung teks panjang &amp; format teks (tebal / bold, miring, list, dll)</span>
            </label>
            <textarea id="summernote-kas-keterangan"
                      name="keterangan"
                      class="bo-textarea"
                      x-model="{{ $scope }}.keterangan"
                      rows="4"
                      style="min-height:110px;"
                      placeholder="Tulis uraian dan rincian transaksi lengkap di sini..."></textarea>
        </div>

        {{-- 10. Kode Transaksi (Otomatis / Manual) --}}
        <div style="grid-column:1/-1;">
            <label class="bo-label">Kode Transaksi</label>
            <div style="display:grid;grid-template-columns:160px 1fr;gap:8px;">
                <select class="bo-select" x-model="{{ $scope }}.kodeMode"
                        x-on:change="if({{ $scope }}.kodeMode === 'auto') {{ $scope }}.kode = ''">
                    <option value="auto">Otomatis</option>
                    <option value="manual">Isi Manual</option>
                </select>
                <div x-show="{{ $scope }}.kodeMode === 'auto'">
                    <input type="text" class="bo-input" readonly style="background:#f1f5f9;color:#64748b;cursor:not-allowed;"
                           :value="({{ $scope }}.type === 'keluar' ? 'KK' : 'KM') + '-' + ({{ $scope }}.tanggal || '').replace(/-/g,'') + '-XXXX'">
                </div>
                <div x-show="{{ $scope }}.kodeMode === 'manual'" style="display:none;">
                    <input type="text" class="bo-input" :name="{{ $scope }}.kodeMode === 'manual' ? 'kode' : ''" x-model="{{ $scope }}.kode" placeholder="Masukkan kode transaksi manual" maxlength="50">
                </div>
            </div>
        </div>

        {{-- 11. Bukti Transaksi (Upload PDF, JPG, PNG) --}}
        <div style="grid-column:1/-1;">
            <label class="bo-label">Bukti Transaksi</label>
            <div x-on:click="$refs.fileInput.click()"
                 style="border:1.5px dashed #cbd5e1;border-radius:12px;padding:18px;text-align:center;cursor:pointer;background:#fafafa;transition:all .15s;">
                <span class="material-icons-round" style="font-size:28px;color:#475569;display:block;margin-bottom:4px;">upload_file</span>
                <div style="font-weight:700;font-size:13.5px;color:#0f172a;">Upload bukti transaksi</div>
                <div style="font-size:12px;color:#64748b;">PDF, JPG, PNG (maks. 5MB)</div>
            </div>
            <input type="file" x-ref="fileInput" name="bukti_file" accept=".pdf,.jpg,.jpeg,.png,.webp"
                   x-on:change="onFilePicked($event)" style="display:none;">

            {{-- File / Image Preview --}}
            <div x-show="localFileName || {{ $scope }}.bukti_gambar" style="display:none;margin-top:10px;padding:10px 12px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;">
                <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
                    <div style="display:flex;align-items:center;gap:10px;min-width:0;">
                        <template x-if="localFilePreview || ({{ $scope }}.bukti_gambar && !window.DHSKasHelper.isPdf({{ $scope }}.bukti_gambar) && !localFileName)">
                            <img :src="localFilePreview || {{ $scope }}.bukti_gambar" style="width:48px;height:48px;object-fit:cover;border-radius:6px;border:1px solid #cbd5e1;">
                        </template>
                        <template x-if="localIsPdf || (!localFileName && window.DHSKasHelper.isPdf({{ $scope }}.bukti_gambar))">
                            <span class="material-icons-round" style="font-size:32px;color:#dc2626;">picture_as_pdf</span>
                        </template>
                        <div style="min-width:0;">
                            <div style="font-size:12.5px;font-weight:600;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"
                                 x-text="localFileName || ({{ $scope }}.bukti_gambar ? {{ $scope }}.bukti_gambar.split('/').pop() : '')"></div>
                            <div style="font-size:11px;color:#64748b;" x-text="localFileName ? 'Siap diupload' : 'File tersimpan'"></div>
                        </div>
                    </div>
                    <button type="button" x-on:click="clearPickedFile()"
                            style="background:none;border:none;color:#dc2626;cursor:pointer;font-size:12px;font-weight:600;">
                        Hapus
                    </button>
                </div>
            </div>
        </div>

    </div>

    {{-- Form Action Footer --}}
    <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:18px;padding-top:14px;border-top:1px solid #f1f5f9;">
        @if($showCancel)
            <button type="button" class="btn-secondary" x-on:click="{{ $cancelAction }}">Batal</button>
        @endif
        <button type="submit" class="btn-primary" style="background:{{ $btnBg }};">
            <span class="material-icons-round" style="font-size:18px;">save</span>
            <span x-text="{{ $scope }}.editMode ? 'Simpan Perubahan' : '{{ $submitText }}'"></span>
        </button>
    </div>
</form>

