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

    matchesFilters(item, f) {
        // Tipe
        if (f.filterTipe && item.type !== f.filterTipe) return false;

        // Status
        const isPendingPiutang = !!(item.is_piutang && !item.piutang_lunas_at);
        if (f.filterStatus === 'piutang' && !isPendingPiutang) return false;
        if (f.filterStatus === 'lunas' && isPendingPiutang) return false;

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
</script>

