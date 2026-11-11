@php
    $pId      = $prefix ?? 'reg';
    $fId      = $formId ?? 'form-pendaftaran';
    $oldMode  = old('payment_mode', 'belum');
    $oldTotal = old('total_biaya', '');
    $oldNom   = old('nominal_pembayaran', '');
@endphp

<div class="pt-4 border-t border-black/10 space-y-4" id="{{ $pId }}-payment-wrapper">
    <div>
        <label class="block text-sm font-semibold text-text-light mb-1">
            <span data-id="Metode / Status Pembayaran" data-en="Payment Method / Status">Metode / Status Pembayaran</span>
        </label>
        <p class="text-xs text-muted-light mb-3">
            <span data-id="Pilih bayar lunas, bayar uang muka (DP), atau kirim formulir terlebih dahulu." data-en="Choose full payment, down payment (DP), or pay later.">Pilih bayar lunas, bayar uang muka (DP), atau kirim formulir terlebih dahulu.</span>
        </p>

        <!-- Hidden input untuk mode & total biaya (otomatis dari program yang dipilih, tidak perlu input manual) -->
        <input type="hidden" name="payment_mode" id="{{ $pId }}_payment_mode" value="{{ $oldMode }}">
        <input type="hidden" name="total_biaya" id="{{ $pId }}_total_biaya" value="{{ $oldTotal }}">

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5" role="radiogroup" aria-label="Status Pembayaran">
            <!-- Bayar Nanti -->
            <button type="button"
                id="{{ $pId }}-btn-belum"
                onclick="window.DHSFrontPay.setMode('{{ $pId }}', 'belum')"
                class="group text-left p-3.5 sm:p-4 rounded-2xl border-2 transition-all cursor-pointer flex flex-col justify-between gap-1.5 bg-white hover:bg-slate-50/80">
                <div class="flex items-center justify-between gap-2">
                    <span class="text-xs font-bold flex items-center gap-1.5">
                        <span class="material-icons text-base">schedule</span>
                        <span data-id="Bayar Nanti" data-en="Pay Later">Bayar Nanti</span>
                    </span>
                    <span class="{{ $pId }}-check-dot w-4 h-4 rounded-full border-2 border-slate-300 flex items-center justify-center text-[10px]"></span>
                </div>
                <span class="text-[0.7rem] text-muted-light leading-snug">Konfirmasi pembayaran menyusul via Admisi DHS</span>
            </button>

            <!-- Bayar Lunas -->
            <button type="button"
                id="{{ $pId }}-btn-lunas"
                onclick="window.DHSFrontPay.setMode('{{ $pId }}', 'lunas')"
                class="group text-left p-3.5 sm:p-4 rounded-2xl border-2 transition-all cursor-pointer flex flex-col justify-between gap-1.5 bg-white hover:bg-slate-50/80">
                <div class="flex items-center justify-between gap-2">
                    <span class="text-xs font-bold flex items-center gap-1.5">
                        <span class="material-icons text-base">check_circle</span>
                        <span data-id="Bayar Lunas" data-en="Full Payment">Bayar Lunas</span>
                    </span>
                    <span class="{{ $pId }}-check-dot w-4 h-4 rounded-full border-2 border-slate-300 flex items-center justify-center text-[10px]"></span>
                </div>
                <span class="text-[0.7rem] text-muted-light leading-snug">Membayar biaya pendaftaran / program langsung penuh</span>
            </button>

            <!-- Bayar DP (Sebagian) -->
            <button type="button"
                id="{{ $pId }}-btn-dp"
                onclick="window.DHSFrontPay.setMode('{{ $pId }}', 'dp')"
                class="group text-left p-3.5 sm:p-4 rounded-2xl border-2 transition-all cursor-pointer flex flex-col justify-between gap-1.5 bg-white hover:bg-slate-50/80">
                <div class="flex items-center justify-between gap-2">
                    <span class="text-xs font-bold flex items-center gap-1.5">
                        <span class="material-icons text-base">payments</span>
                        <span data-id="Bayar DP (Sebagian)" data-en="Down Payment (DP)">Bayar DP (Sebagian)</span>
                    </span>
                    <span class="{{ $pId }}-check-dot w-4 h-4 rounded-full border-2 border-slate-300 flex items-center justify-center text-[10px]"></span>
                </div>
                <span class="text-[0.7rem] text-muted-light leading-snug">Bayar uang muka, sisa otomatis masuk piutang</span>
            </button>
        </div>
    </div>

    <!-- Notice jika pendaftar belum memilih program di dropdown atas -->
    <div id="{{ $pId }}-no-program-notice" class="hidden rounded-2xl border border-amber-200/90 bg-amber-50/90 p-4 text-xs text-amber-900 flex items-center gap-3 shadow-2xs">
        <span class="material-icons text-amber-600 text-xl shrink-0">info</span>
        <span class="leading-relaxed">Silakan pilih <strong>Program Studi</strong> pada pilihan di atas terlebih dahulu untuk memuat harga resmi program dan rincian pembayarannya.</span>
    </div>

    <!-- Box Pembayaran Lunas (Harga Otomatis Muncul Penuh Tanpa Perlu Input) -->
    <div id="{{ $pId }}-lunas-box" class="hidden rounded-2xl border border-emerald-200/90 bg-gradient-to-r from-emerald-50/90 via-white to-emerald-50/70 p-5 sm:p-6 space-y-3 shadow-sm">
        <div class="flex items-center justify-between gap-3 flex-wrap">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-xs shrink-0">
                    <span class="material-icons text-2xl">check_circle</span>
                </div>
                <div>
                    <div class="text-[0.68rem] uppercase font-bold tracking-wider text-emerald-800">Nominal Pembayaran Lunas</div>
                    <div class="text-xl sm:text-2xl font-black text-emerald-950 font-['Inter'] tracking-tight" id="{{ $pId }}-lunas-display">Rp 0</div>
                </div>
            </div>
            <div class="flex items-center gap-1.5 text-xs font-bold text-emerald-800 bg-white border border-emerald-300 px-3.5 py-1.5 rounded-full shadow-2xs">
                <span class="material-icons text-sm text-emerald-600">verified</span>
                <span>Otomatis Sesuai Harga Program</span>
            </div>
        </div>
        <p class="text-xs text-emerald-800 leading-relaxed pt-2.5 border-t border-emerald-200/60 flex items-center gap-1.5">
            <span class="material-icons text-xs text-emerald-600">info</span>
            <span>Total biaya program lunas penuh dan otomatis langsung tercatat ke kas pemasukan kampus DHS.</span>
        </p>
    </div>

    <!-- Box Pembayaran DP (Ultra Clean & Modern) -->
    <div id="{{ $pId }}-dp-box" class="hidden rounded-2xl border border-slate-200/90 bg-white p-5 sm:p-6 space-y-5 shadow-sm">
        
        <!-- Bagian Input Nominal DP -->
        <div>
            <div class="flex items-center justify-between gap-2 mb-2">
                <label class="flex items-center gap-2 text-sm font-bold text-slate-800">
                    <span class="w-6 h-6 rounded-lg bg-amber-500 text-white flex items-center justify-center text-xs shadow-xs">
                        <span class="material-icons text-sm">payments</span>
                    </span>
                    <span data-id="Nominal DP yang Dibayar Sekarang (Rp)" data-en="Down Payment Amount (IDR)">Nominal DP yang Dibayar Sekarang</span>
                    <span class="text-red-500">*</span>
                </label>
                <span class="text-[0.7rem] font-bold px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 border border-amber-200/80">
                    Uang Muka
                </span>
            </div>

            <div class="relative flex items-center">
                <span class="absolute left-4 font-black text-base text-slate-400 select-none pointer-events-none font-['Inter']">Rp</span>
                <input type="text"
                    name="nominal_pembayaran"
                    id="{{ $pId }}_nominal_pembayaran"
                    value="{{ $oldNom }}"
                    placeholder="Contoh: 5.000.000"
                    inputmode="numeric"
                    oninput="window.DHSFrontPay.onAmountInput('{{ $pId }}', this)"
                    class="w-full border-2 border-slate-200 rounded-xl pl-12 pr-4 py-3.5 text-base sm:text-lg font-['Inter'] bg-slate-50/50 outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-500/10 transition-all font-bold text-slate-900 placeholder:text-slate-400 placeholder:font-normal">
            </div>

            <!-- Tombol Preset Cepat Persentase DP -->
            <div class="flex items-center gap-2 mt-2.5 flex-wrap text-xs" id="{{ $pId }}-quick-presets">
                <span class="text-[0.7rem] font-semibold text-slate-400">Pilihan Cepat:</span>
                <button type="button" onclick="window.DHSFrontPay.setPercentDP('{{ $pId }}', 0.2)"
                    class="px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 hover:bg-amber-50 hover:border-amber-300 hover:text-amber-900 text-slate-600 font-semibold text-[0.7rem] transition-colors cursor-pointer">
                    20% DP
                </button>
                <button type="button" onclick="window.DHSFrontPay.setPercentDP('{{ $pId }}', 0.3)"
                    class="px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 hover:bg-amber-50 hover:border-amber-300 hover:text-amber-900 text-slate-600 font-semibold text-[0.7rem] transition-colors cursor-pointer">
                    30% DP
                </button>
                <button type="button" onclick="window.DHSFrontPay.setPercentDP('{{ $pId }}', 0.5)"
                    class="px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 hover:bg-amber-50 hover:border-amber-300 hover:text-amber-900 text-slate-600 font-semibold text-[0.7rem] transition-colors cursor-pointer">
                    50% DP
                </button>
            </div>

            <p class="text-[0.75rem] text-slate-500 mt-2 leading-relaxed flex items-center gap-1.5" id="{{ $pId }}-nominal-hint">
                <span class="material-icons text-xs text-amber-600">info</span>
                <span>Harga program otomatis ditentukan dari pilihan di atas. Sisanya otomatis dicatat sebagai Piutang (Uang di Lapangan).</span>
            </p>
        </div>

        <!-- Rincian Finansial (Sleek Modern Dashboard Cards) -->
        <div id="{{ $pId }}-dp-summary" class="rounded-xl border border-slate-200/80 bg-slate-50/70 p-4 sm:p-5 space-y-4">
            
            <div class="flex items-center justify-between gap-2 flex-wrap">
                <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-700">
                    <span class="material-icons text-base text-amber-600">tune</span>
                    <span>Rincian Pembayaran &amp; Sisa Tagihan</span>
                </div>
                <span class="inline-flex items-center gap-1 text-[0.7rem] font-bold text-emerald-800 bg-emerald-100/80 border border-emerald-200/80 px-2.5 py-0.5 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Kalkulasi Otomatis</span>
                </span>
            </div>

            <!-- 3 Stat KPI Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <!-- Card 1: Total Biaya Program -->
                <div class="bg-white rounded-xl p-4 border border-slate-200/90 shadow-2xs flex flex-col justify-between min-h-[92px]">
                    <div class="flex items-center justify-between gap-1 mb-1">
                        <span class="text-[0.68rem] font-bold uppercase tracking-wider text-slate-500">Harga Program</span>
                        <span class="material-icons text-slate-400 text-sm">school</span>
                    </div>
                    <div class="text-base sm:text-lg font-black text-slate-900 font-['Inter'] tracking-tight" id="{{ $pId }}-sum-total">Rp 0</div>
                    <div class="text-[0.68rem] text-slate-500 font-medium mt-1">Tarif resmi DHS</div>
                </div>

                <!-- Card 2: DP Masuk Kas -->
                <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/40 rounded-xl p-4 border border-emerald-200 shadow-2xs flex flex-col justify-between min-h-[92px]">
                    <div class="flex items-center justify-between gap-1 mb-1">
                        <span class="text-[0.68rem] font-bold uppercase tracking-wider text-emerald-800">DP Dibayar</span>
                        <span class="material-icons text-emerald-600 text-sm">arrow_downward</span>
                    </div>
                    <div class="text-base sm:text-lg font-black text-emerald-800 font-['Inter'] tracking-tight" id="{{ $pId }}-sum-dp">Rp 0</div>
                    <div class="text-[0.68rem] text-emerald-700 font-medium mt-1 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                        <span>Masuk kas kampus</span>
                    </div>
                </div>

                <!-- Card 3: Sisa Piutang -->
                <div class="bg-gradient-to-br from-amber-50 to-amber-100/50 rounded-xl p-4 border border-amber-300/80 shadow-2xs flex flex-col justify-between min-h-[92px]">
                    <div class="flex items-center justify-between gap-1 mb-1">
                        <span class="text-[0.68rem] font-bold uppercase tracking-wider text-amber-900">Sisa Piutang</span>
                        <span class="material-icons text-amber-600 text-sm">hourglass_top</span>
                    </div>
                    <div class="text-base sm:text-lg font-black text-amber-950 font-['Inter'] tracking-tight" id="{{ $pId }}-sum-sisa">Rp 0</div>
                    <div class="text-[0.68rem] text-amber-800 font-medium mt-1 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                        <span>Uang di Lapangan</span>
                    </div>
                </div>
            </div>

            <!-- Dynamic Alert Message Box -->
            <div id="{{ $pId }}-dp-validation-msg" class="text-xs p-3.5 rounded-xl border border-slate-200 bg-white text-slate-700 flex items-start gap-2.5 transition-all">
                <span class="material-icons text-slate-400 text-base shrink-0 mt-0.5">info</span>
                <span class="leading-relaxed">Pilih Program Studi di atas dan isi Nominal DP yang dibayar sekarang. Sisanya otomatis tercatat sebagai Piutang atas nama Anda.</span>
            </div>

        </div>
    </div>
</div>

@once
<script>
window.DHSFrontPay = {
    state: {},

    init(pId, formId) {
        const modeEl = document.getElementById(pId + '_payment_mode');
        this.state[pId] = {
            mode: (modeEl && modeEl.value) ? modeEl.value : 'belum',
            officialFee: 0,
        };
        this.render(pId);

        const form = document.getElementById(formId);
        if (form) {
            form.addEventListener('submit', (e) => {
                if (!this.validateOnSubmit(pId)) {
                    e.preventDefault();
                }
            });
        }
    },

    parseNum(val) {
        const digits = String(val || '').replace(/\D/g, '');
        return digits ? parseInt(digits, 10) : 0;
    },

    formatRp(num) {
        return 'Rp ' + (parseInt(num, 10) || 0).toLocaleString('id-ID');
    },

    onAmountInput(pId, el) {
        const raw = el.value.replace(/\D/g, '');
        el.value = raw ? parseInt(raw, 10).toLocaleString('id-ID') : '';
        this.updateSummary(pId);
    },

    setPercentDP(pId, percent) {
        const st = this.state[pId];
        if (!st || st.officialFee <= 0) {
            alert('Silakan pilih Program Studi pada dropdown di atas terlebih dahulu.');
            const progSelect = document.getElementById('reg-program');
            if (progSelect) progSelect.focus();
            return;
        }
        const calculated = Math.round(st.officialFee * percent);
        const nomEl = document.getElementById(pId + '_nominal_pembayaran');
        if (nomEl) {
            nomEl.value = calculated.toLocaleString('id-ID');
            this.updateSummary(pId);
        }
    },

    setOfficialFee(pId, fee) {
        if (!this.state[pId]) return;
        const parsed = parseFloat(fee) || 0;
        this.state[pId].officialFee = parsed;

        const totalEl = document.getElementById(pId + '_total_biaya');
        if (totalEl) {
            totalEl.value = parsed > 0 ? Math.round(parsed).toLocaleString('id-ID') : '';
        }

        const lunasDisplay = document.getElementById(pId + '-lunas-display');
        if (lunasDisplay) {
            lunasDisplay.textContent = this.formatRp(parsed);
        }

        const nomEl = document.getElementById(pId + '_nominal_pembayaran');
        if (this.state[pId].mode === 'lunas' && nomEl) {
            nomEl.value = parsed > 0 ? Math.round(parsed).toLocaleString('id-ID') : '';
        }

        this.render(pId);
        this.updateSummary(pId);
    },

    setMode(pId, mode) {
        if (!this.state[pId]) return;
        this.state[pId].mode = mode;
        const modeEl = document.getElementById(pId + '_payment_mode');
        if (modeEl) modeEl.value = mode;

        const st = this.state[pId];
        const nomEl = document.getElementById(pId + '_nominal_pembayaran');

        if (mode === 'lunas' && nomEl && st.officialFee > 0) {
            nomEl.value = Math.round(st.officialFee).toLocaleString('id-ID');
        }

        this.render(pId);
        this.updateSummary(pId);
    },

    render(pId) {
        const st = this.state[pId];
        if (!st) return;
        const mode = st.mode;

        const styles = {
            belum: { active: ['border-dhs-navy', 'bg-slate-50', 'text-dhs-navy', 'shadow-sm'], idle: ['border-slate-200', 'bg-white', 'text-text-light'] },
            lunas: { active: ['border-emerald-600', 'bg-emerald-50/70', 'text-emerald-800', 'shadow-sm'], idle: ['border-slate-200', 'bg-white', 'text-text-light'] },
            dp:    { active: ['border-amber-500', 'bg-amber-50/80', 'text-amber-900', 'shadow-sm'], idle: ['border-slate-200', 'bg-white', 'text-text-light'] },
        };

        ['belum', 'lunas', 'dp'].forEach((k) => {
            const btn = document.getElementById(pId + '-btn-' + k);
            if (!btn) return;
            const dot = btn.querySelector('.' + pId + '-check-dot');
            btn.classList.remove(...styles[k].active, ...styles[k].idle);
            if (mode === k) {
                btn.classList.add(...styles[k].active);
                if (dot) {
                    dot.innerHTML = '✓';
                    dot.className = pId + '-check-dot w-4 h-4 rounded-full flex items-center justify-center text-[10px] font-bold text-white shadow-2xs';
                    dot.style.backgroundColor = k === 'dp' ? '#d97706' : (k === 'lunas' ? '#059669' : '#0F2440');
                    dot.style.borderColor = 'transparent';
                }
            } else {
                btn.classList.add(...styles[k].idle);
                if (dot) {
                    dot.innerHTML = '';
                    dot.className = pId + '-check-dot w-4 h-4 rounded-full border-2 border-slate-300 flex items-center justify-center text-[10px]';
                    dot.style.backgroundColor = '';
                    dot.style.borderColor = '';
                }
            }
        });

        const noticeEl = document.getElementById(pId + '-no-program-notice');
        const lunasBox = document.getElementById(pId + '-lunas-box');
        const dpBox    = document.getElementById(pId + '-dp-box');
        const nomEl    = document.getElementById(pId + '_nominal_pembayaran');
        const totalEl  = document.getElementById(pId + '_total_biaya');

        if (mode === 'belum') {
            if (noticeEl) noticeEl.classList.add('hidden');
            if (lunasBox) lunasBox.classList.add('hidden');
            if (dpBox) dpBox.classList.add('hidden');
            if (nomEl) nomEl.disabled = true;
            if (totalEl) totalEl.disabled = true;
        } else if (mode === 'lunas') {
            if (dpBox) dpBox.classList.add('hidden');
            if (st.officialFee <= 0) {
                if (noticeEl) noticeEl.classList.remove('hidden');
                if (lunasBox) lunasBox.classList.add('hidden');
            } else {
                if (noticeEl) noticeEl.classList.add('hidden');
                if (lunasBox) lunasBox.classList.remove('hidden');
            }
            if (nomEl) {
                nomEl.disabled = false;
                if (st.officialFee > 0) {
                    nomEl.value = Math.round(st.officialFee).toLocaleString('id-ID');
                }
            }
            if (totalEl) {
                totalEl.disabled = false;
                if (st.officialFee > 0) totalEl.value = Math.round(st.officialFee).toLocaleString('id-ID');
            }
        } else {
            // Mode DP
            if (lunasBox) lunasBox.classList.add('hidden');
            if (st.officialFee <= 0) {
                if (noticeEl) noticeEl.classList.remove('hidden');
                if (dpBox) dpBox.classList.add('hidden');
            } else {
                if (noticeEl) noticeEl.classList.add('hidden');
                if (dpBox) dpBox.classList.remove('hidden');
            }
            if (nomEl) nomEl.disabled = false;
            if (totalEl) {
                totalEl.disabled = false;
                if (st.officialFee > 0) totalEl.value = Math.round(st.officialFee).toLocaleString('id-ID');
            }
        }
    },

    updateSummary(pId) {
        const st = this.state[pId];
        if (!st || st.mode !== 'dp') return;

        const total = Math.round(st.officialFee || 0);
        const dp    = this.parseNum(document.getElementById(pId + '_nominal_pembayaran')?.value);
        const sisa  = Math.max(0, total - dp);

        const sumTotal = document.getElementById(pId + '-sum-total');
        const sumDp    = document.getElementById(pId + '-sum-dp');
        const sumSisa  = document.getElementById(pId + '-sum-sisa');
        const msgEl    = document.getElementById(pId + '-dp-validation-msg');

        if (sumTotal) sumTotal.textContent = this.formatRp(total);
        if (sumDp)    sumDp.textContent    = this.formatRp(dp);
        if (sumSisa)  sumSisa.textContent  = this.formatRp(sisa);

        if (msgEl) {
            if (total <= 0) {
                msgEl.className = 'text-xs p-3.5 rounded-xl border border-slate-200 bg-white text-slate-700 flex items-start gap-2.5';
                msgEl.innerHTML = '<span class="material-icons text-slate-400 text-base shrink-0 mt-0.5">info</span><span class="leading-relaxed">Silakan pilih Program Studi di atas terlebih dahulu untuk memuat harga program.</span>';
            } else if (dp <= 0) {
                msgEl.className = 'text-xs p-3.5 rounded-xl border border-amber-200 bg-amber-50/80 text-amber-900 flex items-start gap-2.5';
                msgEl.innerHTML = '<span class="material-icons text-amber-600 text-base shrink-0 mt-0.5">info</span><span class="leading-relaxed">Biaya resmi program yang dipilih adalah <strong>' + this.formatRp(total) + '</strong>. Masukkan nominal DP yang ingin Anda bayar sekarang pada kolom di atas (atau klik tombol pilihan cepat persentase).</span>';
            } else if (dp >= total) {
                msgEl.className = 'text-xs p-3.5 rounded-xl border border-red-200 bg-red-50 text-red-900 flex items-start gap-2.5 font-semibold';
                msgEl.innerHTML = '<span class="material-icons text-red-600 text-base shrink-0 mt-0.5">warning</span><span class="leading-relaxed">Nominal DP tidak boleh sama atau melebihi Biaya Program (' + this.formatRp(total) + '). Jika ingin membayar penuh lunas, silakan pilih opsi <strong>Bayar Lunas</strong>.</span>';
            } else {
                msgEl.className = 'text-xs p-3.5 rounded-xl border border-emerald-200 bg-emerald-50/90 text-emerald-900 flex items-start gap-2.5 font-medium';
                msgEl.innerHTML = '<span class="material-icons text-emerald-600 text-base shrink-0 mt-0.5">check_circle</span><span class="leading-relaxed"><strong>Rincian Disetujui:</strong> Pembayaran DP <strong>' + this.formatRp(dp) + '</strong> langsung masuk kas DHS, dan sisa tagihan <strong>' + this.formatRp(sisa) + '</strong> otomatis dicatat ke daftar <strong>Piutang (Uang di Lapangan)</strong> atas nama Anda.</span>';
            }
        }
    },

    validateOnSubmit(pId) {
        const st = this.state[pId];
        if (!st || st.mode === 'belum') return true;

        const nomEl = document.getElementById(pId + '_nominal_pembayaran');
        let nom = this.parseNum(nomEl?.value);
        const total = Math.round(st.officialFee || 0);

        if (total <= 0) {
            alert('Silakan pilih Program Studi terlebih dahulu untuk memuat harga program.');
            const progSelect = document.getElementById('reg-program');
            if (progSelect) progSelect.focus();
            return false;
        }

        if (st.mode === 'lunas') {
            if (nom <= 0 && total > 0) {
                nom = total;
                if (nomEl) nomEl.value = nom.toLocaleString('id-ID');
            }
            return true;
        }

        if (st.mode === 'dp') {
            if (nom <= 0) {
                alert('Silakan isi Nominal DP yang dibayar sekarang (lebih dari Rp 0).');
                nomEl?.focus();
                return false;
            }

            if (nom >= total) {
                alert('Nominal DP (' + this.formatRp(nom) + ') harus lebih kecil dari Biaya Program (' + this.formatRp(total) + '). Silakan pilih opsi Bayar Lunas jika ingin membayar penuh.');
                nomEl?.focus();
                return false;
            }
        }

        return true;
    },

    reset(pId) {
        const nomEl = document.getElementById(pId + '_nominal_pembayaran');
        if (nomEl) nomEl.value = '';
        this.setMode(pId, 'belum');
    }
};
</script>
@endonce
