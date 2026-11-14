<script>
window.DHSKasHelper = {
    formatNumber(n) {
        const num = parseFloat(n) || 0;
        return Math.abs(num).toLocaleString('id-ID');
    },

    formatTanggal(dateStr) {
        if (!dateStr) return '-';
        const clean = typeof dateStr === 'string' ? dateStr.substring(0, 10) : '';
        const parts = clean.split('-');
        if (parts.length === 3) {
            const d = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
            return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
        }
        return new Date(dateStr).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
    },

    formatRupiahString(val) {
        const raw = String(val || '').replace(/\D/g, '');
        return raw ? parseInt(raw, 10).toLocaleString('id-ID') : '';
    },

    parseRupiah(val) {
        if (!val) return 0;
        return parseFloat(String(val).replace(/\./g, '').replace(',', '.')) || 0;
    },

    isPdf(path) {
        if (!path) return false;
        return path.toLowerCase().split('?')[0].endsWith('.pdf');
    },

    stripTags(html) {
        if (!html) return '';
        return String(html).replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();
    },

    sortItems(items, sortBy) {
        if (!Array.isArray(items)) return [];
        const copy = [...items];
        const mode = sortBy || 'tanggal_desc';

        return copy.sort((a, b) => {
            if (mode === 'tanggal_desc') {
                const diff = new Date(b.tanggal || 0) - new Date(a.tanggal || 0);
                return diff !== 0 ? diff : (b.id - a.id);
            }
            if (mode === 'tanggal_asc') {
                const diff = new Date(a.tanggal || 0) - new Date(b.tanggal || 0);
                return diff !== 0 ? diff : (a.id - b.id);
            }
            if (mode === 'program_asc') {
                const titleA = (a.program ? a.program.title : (a.deskripsi || '')).toLowerCase();
                const titleB = (b.program ? b.program.title : (b.deskripsi || '')).toLowerCase();
                return titleA.localeCompare(titleB, 'id');
            }
            if (mode === 'program_desc') {
                const titleA = (a.program ? a.program.title : (a.deskripsi || '')).toLowerCase();
                const titleB = (b.program ? b.program.title : (b.deskripsi || '')).toLowerCase();
                return titleB.localeCompare(titleA, 'id');
            }
            if (mode === 'nominal_desc') {
                return (parseFloat(b.jumlah) || 0) - (parseFloat(a.jumlah) || 0);
            }
            if (mode === 'nominal_asc') {
                return (parseFloat(a.jumlah) || 0) - (parseFloat(b.jumlah) || 0);
            }
            return 0;
        });
    },

    getTransactionType(item) {
        if (!item) return { key: 'masuk', label: '↓ Masuk', badgeClass: 'badge-green', icon: 'arrow_downward' };
        if (item.type === 'keluar') {
            return { key: 'keluar', label: '↑ Keluar', badgeClass: 'badge-red', icon: 'arrow_upward' };
        }
        if (item.is_piutang && !item.piutang_lunas_at) {
            return { key: 'piutang', label: '⧗ Piutang', badgeClass: 'badge-amber', icon: 'schedule' };
        }
        return { key: 'masuk', label: '↓ Masuk', badgeClass: 'badge-green', icon: 'arrow_downward' };
    },

    getTransactionStatus(item) {
        if (!item) return { key: 'lunas', label: 'Lunas', badgeClass: 'badge-green', icon: 'check_circle' };
        
        // Status Cicil: Jika transaksi merupakan piutang/cicilan yang belum lunas
        const isCicil = !!(item.is_piutang && !item.piutang_lunas_at);
        if (isCicil) {
            return { key: 'cicil', label: 'Cicil', badgeClass: 'badge-amber', icon: 'schedule' };
        }

        // Status Lunas: Pemasukan bayar lunas, cicilan selesai lunas, atau pengeluaran lunas
        return { key: 'lunas', label: 'Lunas', badgeClass: 'badge-green', icon: 'check_circle' };
    },

    getWhatsAppUrl(item) {
        if (!item || !item.no_hp) return '#';
        let phone = String(item.no_hp).replace(/\D/g, '');
        if (phone.startsWith('0')) {
            phone = '62' + phone.substring(1);
        } else if (phone.startsWith('8')) {
            phone = '62' + phone;
        }
        const nama = item.piutang_nama || 'Bapak/Ibu';
        const kode = item.kode || '';
        const jenis = item.jenis || 'Transaksi Kas';
        const nominal = this.formatNumber(item.jumlah || 0);
        const st = this.getTransactionStatus(item).label;
        const text = `Halo Kak ${nama}, kami dari Denpasar Hotel School (DHS) mengonfirmasi transaksi:\n- Kode: ${kode}\n- Kategori: ${jenis}\n- Status: ${st}\n- Nominal: Rp ${nominal}\n\nTerima kasih.`;
        return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
    },

    initSummernote(selector, initialContent) {
        if (typeof $ !== 'undefined' && $.fn.summernote) {
            const $el = $(selector);
            if ($el.length) {
                if ($el.data('summernote')) {
                    $el.summernote('destroy');
                }
                $el.summernote({
                    height: 140,
                    placeholder: 'Tulis uraian lengkap, catatan, atau rincian transaksi di sini (bisa format bold, miring, list)...',
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['color', ['color']],
                        ['insert', ['link']],
                        ['view', ['codeview']]
                    ],
                    callbacks: {
                        onChange: function(contents) {
                            $el.val(contents);
                        }
                    }
                });
                $el.summernote('code', initialContent || '');
            }
        }
    },

    matchesFilters(item, f) {
        // Transaksi (Pemasukan / Pengeluaran / Piutang)
        if (f.filterTipe) {
            if (f.filterTipe === 'piutang') {
                const isPendingPiutang = !!(item.is_piutang && !item.piutang_lunas_at);
                if (!isPendingPiutang) return false;
            } else if (item.type !== f.filterTipe) {
                return false;
            }
        }

        // Status: Hanya 2: Lunas & Cicil
        if (f.filterStatus) {
            const st = this.getTransactionStatus(item).key;
            if (f.filterStatus === 'lunas' && st !== 'lunas') return false;
            if ((f.filterStatus === 'cicil' || f.filterStatus === 'piutang') && st !== 'cicil') return false;
            if (f.filterStatus === 'pemasukan' && item.type !== 'masuk') return false;
            if (f.filterStatus === 'pengeluaran' && item.type !== 'keluar') return false;
        }

        // Program / Proyek relation
        if (f.filterRel) {
            if (f.filterRel === 'null') {
                if (item.project_id || item.program_id) return false;
            } else if (f.filterRel.startsWith('proj:')) {
                const pid = f.filterRel.substring(5);
                if (String(item.project_id) !== String(pid)) return false;
            } else if (f.filterRel.startsWith('prog:')) {
                const prid = f.filterRel.substring(5);
                if (String(item.program_id) !== String(prid)) return false;
            }
        }

        // Date parsing (YYYY-MM-DD)
        const tglStr = typeof item.tanggal === 'string' ? item.tanggal.substring(0, 10) : '';
        const parts = tglStr.split('-');
        const yr = parts.length === 3 ? parts[0] : '';
        const mo = parts.length === 3 ? parseInt(parts[1], 10) : null;

        // Periode
        if (f.filterPeriode === 'harian') {
            if (f.filterTanggal && tglStr !== f.filterTanggal) return false;
        } else if (f.filterPeriode === 'rentang_tanggal') {
            if (f.filterTglDari && tglStr < f.filterTglDari) return false;
            if (f.filterTglSampai && tglStr > f.filterTglSampai) return false;
        } else if (f.filterPeriode === 'bulanan') {
            if (f.filterTahun && yr !== String(f.filterTahun)) return false;
            if (f.filterBulan && mo !== parseInt(f.filterBulan, 10)) return false;
        } else if (f.filterPeriode === 'rentang_bulan') {
            if (f.filterTahun && yr !== String(f.filterTahun)) return false;
            const d = parseInt(f.filterBulanDari, 10) || 1;
            const s = parseInt(f.filterBulanSampai, 10) || 12;
            const minM = Math.min(d, s);
            const maxM = Math.max(d, s);
            if (mo === null || mo < minM || mo > maxM) return false;
        } else if (f.filterPeriode === 'tahunan') {
            if (f.filterTahun && yr !== String(f.filterTahun)) return false;
        }

        // Search keyword
        if (f.filterSearch && f.filterSearch.trim() !== '') {
            const q = f.filterSearch.toLowerCase().trim();
            const haystack = [
                item.kode,
                item.jenis,
                item.deskripsi,
                item.keterangan,
                item.satuan,
                item.piutang_nama,
                item.project ? item.project.nama_proyek : '',
                item.project ? item.project.pic : '',
                item.program ? item.program.title : '',
            ].filter(Boolean).join(' ').toLowerCase();
            if (!haystack.includes(q)) return false;
        }

        return true;
    },

    buildExportUrl(baseUrl, f) {
        const params = new URLSearchParams();
        if (f.filterPeriode)    params.set('periode', f.filterPeriode);
        if (f.filterTanggal)    params.set('tanggal', f.filterTanggal);
        if (f.filterTglDari)    params.set('tgl_dari', f.filterTglDari);
        if (f.filterTglSampai)  params.set('tgl_sampai', f.filterTglSampai);
        if (f.filterTahun)      params.set('tahun', f.filterTahun);
        if (f.filterBulan)      params.set('bulan', f.filterBulan);
        if (f.filterBulanDari)  params.set('bulan_dari', f.filterBulanDari);
        if (f.filterBulanSampai)params.set('bulan_sampai', f.filterBulanSampai);
        if (f.filterTipe)       params.set('tipe', f.filterTipe);
        if (f.filterStatus)     params.set('status', f.filterStatus);
        if (f.filterRel)        params.set('filter_rel', f.filterRel);
        if (f.filterSearch)     params.set('cari', f.filterSearch);
        const sep = baseUrl.includes('?') ? '&' : '?';
        return baseUrl + sep + params.toString();
    },

    async addUnit(nama, csrfToken) {
        const clean = (nama || '').trim();
        if (!clean) return null;
        try {
            const res = await fetch('/backoffice/kas-satuan/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ nama: clean })
            });
            if (res.ok) {
                return await res.json();
            }
        } catch (e) {}
        return { success: true, unit: clean, units: null };
    }
};

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
            return window.DHSKasHelper.parseRupiah(this.scopeObj.hargaSatuanDisplay);
        },

        get calcTotal() {
            const v = parseFloat(this.scopeObj.volume) || 0;
            return Math.round(v * this.calcHarga);
        },

        get calcTotalHarga() {
            if (this.paymentMode === 'cicil') {
                const h = window.DHSKasHelper.parseRupiah(this.totalHargaDisplay);
                return h > 0 ? h : this.calcTotal;
            }
            return this.calcTotal;
        },

        get calcBayarSekarang() {
            return window.DHSKasHelper.parseRupiah(this.bayarSekarangDisplay);
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
            if (mode === 'lunas' && this.scopeObj.type === 'piutang') {
                this.scopeObj.type = 'masuk';
            }
            if (mode === 'cicil') {
                if (!this.totalHargaDisplay && this.calcTotal > 0) {
                    this.totalHargaDisplay = window.DHSKasHelper.formatNumber(this.calcTotal);
                } else if (!this.totalHargaDisplay && this.selectedProgramFee > 0) {
                    this.totalHargaDisplay = window.DHSKasHelper.formatNumber(this.selectedProgramFee);
                }
                if (this.totalHargaDisplay) {
                    this.scopeObj.hargaSatuanDisplay = this.totalHargaDisplay;
                    this.scopeObj.volume = 1;
                }
            }
        },

        setTotalHarga(val) {
            this.totalHargaDisplay = window.DHSKasHelper.formatNumber(val);
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
            const res = await window.DHSKasHelper.addUnit(clean, csrfToken);
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
                    alert('Nominal cicilan (Rp ' + window.DHSKasHelper.formatNumber(this.calcBayarSekarang) + ') tidak boleh melebihi sisa tagihan piutang (Rp ' + window.DHSKasHelper.formatNumber(sisa) + ').');
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
                    alert('Total Biaya Program harus lebih dari Rp 0.');
                    return;
                }
                if (this.calcBayarSekarang > this.calcTotalHarga) {
                    e.preventDefault();
                    alert('Nominal yang dibayar sekarang tidak boleh melebihi Total Biaya Program.');
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
                        this.totalHargaDisplay = window.DHSKasHelper.formatNumber(this.calcTotal);
                    } else if (!this.totalHargaDisplay && this.selectedProgramFee > 0) {
                        this.totalHargaDisplay = window.DHSKasHelper.formatNumber(this.selectedProgramFee);
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
</script>

