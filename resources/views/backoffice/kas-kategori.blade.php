@extends('backoffice.layouts.app')

@section('title', 'Jenis Kas')
@section('page-title', 'Jenis Kas')

@section('content')
<div x-data="kasKategoriData()" x-init="init()">

    {{-- ── Flash Messages ──────────────────────────────────── --}}
    @if(session('success'))
    <div class="bo-card" style="border-left:4px solid #22c55e;margin-bottom:1.25rem;padding:.75rem 1rem;color:#166534;background:#f0fdf4;">
        {{ session('success') }}
    </div>
    @endif

    {{-- ── Header & Action Bar ─────────────────────────────── --}}
    <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.5rem;">
        <div style="display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;">
            <a href="/backoffice/kas" class="btn-secondary" style="padding:8px 14px;font-size:13px;">
                <span class="material-icons-round" style="font-size:16px;">arrow_back</span>
                Kembali ke Keuangan Umum
            </a>
            <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
                <span class="badge badge-green" style="font-size:12px;padding:6px 12px;">
                    <span x-text="countMasuk"></span> Jenis Pemasukan
                </span>
                <span class="badge badge-red" style="font-size:12px;padding:6px 12px;">
                    <span x-text="countKeluar"></span> Jenis Pengeluaran
                </span>
                <span class="badge" style="font-size:12px;padding:6px 12px;background:#ede9fe;color:#6d28d9;">
                    <span x-text="countUmum"></span> Jenis Umum
                </span>
            </div>
        </div>

        <button type="button" class="btn-primary" x-on:click="openModal('add', null)">
            <span class="material-icons-round" style="font-size:18px;">add</span>
            Tambah Jenis Kas
        </button>
    </div>

    {{-- ── Filter & Search Bar ─────────────────────────────── --}}
    <div class="bo-card" style="margin-bottom:1.5rem;padding:16px 20px;">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
            {{-- Search --}}
            <div class="bo-search" style="min-width:260px;flex:1;max-width:400px;">
                <span class="material-icons-round" style="font-size:18px;color:#718096;">search</span>
                <input type="text" placeholder="Cari nama jenis atau keterangan..." x-model="search">
            </div>

            {{-- Filter Tipe Tabs --}}
            <div style="display:flex;gap:6px;background:var(--bo-cream);padding:4px;border-radius:10px;flex-wrap:wrap;">
                <button type="button"
                        x-on:click="filterTipe = ''"
                        :style="filterTipe === '' ? 'background:#fff;color:var(--bo-blue);box-shadow:0 1px 4px rgba(0,0,0,0.08);' : 'background:transparent;color:#718096;'"
                        style="border:none;padding:7px 16px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.15s;">
                    Semua (<span x-text="items.length"></span>)
                </button>
                <button type="button"
                        x-on:click="filterTipe = 'masuk'"
                        :style="filterTipe === 'masuk' ? 'background:#fff;color:#16a34a;box-shadow:0 1px 4px rgba(0,0,0,0.08);' : 'background:transparent;color:#718096;'"
                        style="border:none;padding:7px 16px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.15s;">
                    Pemasukan (<span x-text="countMasuk"></span>)
                </button>
                <button type="button"
                        x-on:click="filterTipe = 'keluar'"
                        :style="filterTipe === 'keluar' ? 'background:#fff;color:#dc2626;box-shadow:0 1px 4px rgba(0,0,0,0.08);' : 'background:transparent;color:#718096;'"
                        style="border:none;padding:7px 16px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.15s;">
                    Pengeluaran (<span x-text="countKeluar"></span>)
                </button>
                <button type="button"
                        x-on:click="filterTipe = 'umum'"
                        :style="filterTipe === 'umum' ? 'background:#fff;color:#6d28d9;box-shadow:0 1px 4px rgba(0,0,0,0.08);' : 'background:transparent;color:#718096;'"
                        style="border:none;padding:7px 16px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.15s;">
                    Umum (<span x-text="countUmum"></span>)
                </button>
            </div>
        </div>
    </div>

    {{-- ── Table ───────────────────────────────────────────── --}}
    <div class="bo-card" style="padding:0;overflow:hidden;">
        <div style="overflow-x:auto;">
            <table class="bo-table" style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="width:50px;text-align:center;">#</th>
                        <th style="width:140px;text-align:center;">Tipe</th>
                        <th style="text-align:left;">Nama Jenis Transaksi</th>
                        <th style="text-align:left;">Keterangan / Deskripsi</th>
                        <th style="width:100px;text-align:center;">Status</th>
                        <th style="width:120px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-if="filtered.length === 0">
                        <tr>
                            <td colspan="6" style="text-align:center;padding:40px;color:#718096;">
                                <span class="material-icons-round" style="font-size:40px;color:#cbd5e1;display:block;margin-bottom:8px;">category</span>
                                Tidak ada jenis transaksi ditemukan.
                            </td>
                        </tr>
                    </template>
                    <template x-for="(item, idx) in filtered" :key="item.id">
                        <tr style="border-bottom:1px solid #f3f4f6;">
                            <td style="text-align:center;color:#718096;font-size:13px;" x-text="idx + 1"></td>
                            <td style="text-align:center;">
                                <span :class="item.type === 'masuk' ? 'badge badge-green' : (item.type === 'keluar' ? 'badge badge-red' : 'badge')"
                                      :style="item.type === 'umum' ? 'background:#ede9fe;color:#6d28d9;' : ''"
                                      x-text="item.type === 'masuk' ? 'Pemasukan' : (item.type === 'keluar' ? 'Pengeluaran' : 'Umum')"></span>
                            </td>
                            <td>
                                <div style="font-weight:700;color:var(--bo-blue);font-size:14px;" x-text="item.nama"></div>
                            </td>
                            <td>
                                <div style="color:#555;font-size:13px;" x-text="item.deskripsi || '-'"></div>
                            </td>
                            <td style="text-align:center;">
                                <span :class="item.is_active ? 'badge badge-green' : 'badge badge-gray'"
                                      x-text="item.is_active ? 'Aktif' : 'Nonaktif'"></span>
                            </td>
                            <td>
                                <div style="display:flex;gap:6px;justify-content:center;">
                                    <button type="button" class="btn-icon" x-on:click="openModal('edit', item)" title="Edit">
                                        <span class="material-icons-round" style="font-size:17px;">edit</span>
                                    </button>
                                    <button type="button" class="btn-icon danger" x-on:click="deleteItem(item.id)" title="Hapus">
                                        <span class="material-icons-round" style="font-size:17px;color:#ef4444;">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <div style="padding:12px 20px;font-size:12.5px;color:#718096;border-top:1px solid #f3f4f6;" x-show="filtered.length > 0">
            Menampilkan <strong x-text="filtered.length"></strong> dari <span x-text="items.length"></span> jenis transaksi
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         MODAL TAMBAH / EDIT (POPUP MODAL)
    ══════════════════════════════════════════════════════════ --}}
    <div class="bo-modal-backdrop"
         x-show="modal.open"
         x-transition
         style="display:none;"
         x-on:click.self="modal.open = false"
         @keydown.escape.window="modal.open = false">
        <div class="bo-modal" style="max-width:540px;width:95%;" x-on:click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <h3 style="margin:0;" x-text="modal.mode === 'add' ? 'Tambah Pilihan Jenis Kas' : 'Edit Pilihan Jenis Kas'"></h3>
                <button type="button" class="btn-icon" x-on:click="modal.open = false">
                    <span class="material-icons-round">close</span>
                </button>
            </div>

            <form x-on:submit.prevent="save()">
                <div class="form-group">
                    <label class="bo-label">Tipe Kas <span style="color:red">*</span></label>
                    <select class="bo-select" x-model="modal.form.type" required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="masuk">Pemasukan (Uang Masuk)</option>
                        <option value="keluar">Pengeluaran (Uang Keluar)</option>
                        <option value="umum">Umum (Operasional / Biaya Kantor)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="bo-label">Nama Jenis Transaksi <span style="color:red">*</span></label>
                    <input type="text" class="bo-input" x-model="modal.form.nama"
                           placeholder="Contoh: Pembayaran SPP / Uang Kuliah" maxlength="100" required>
                </div>

                <div class="form-group">
                    <label class="bo-label">Deskripsi / Keterangan</label>
                    <textarea class="bo-textarea" rows="2" x-model="modal.form.deskripsi"
                              placeholder="Keterangan singkat tentang jenis transaksi ini..."></textarea>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px;">
                    <div>
                        <label class="bo-label">Urutan Tampilan</label>
                        <input type="number" class="bo-input" x-model="modal.form.display_order" placeholder="0" min="0">
                    </div>
                    <div>
                        <label class="bo-label">Status</label>
                        <select class="bo-select" x-model="modal.form.is_active">
                            <option :value="1">Aktif</option>
                            <option :value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <hr class="divider" style="margin:20px 0;">

                <div style="display:flex;gap:12px;justify-content:flex-end;">
                    <button type="button" class="btn-secondary" x-on:click="modal.open = false">Batal</button>
                    <button type="submit" class="btn-primary">
                        <span class="material-icons-round" style="font-size:18px;">save</span>
                        <span x-text="modal.mode === 'add' ? 'Simpan' : 'Simpan Perubahan'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         MODAL KONFIRMASI HAPUS (POPUP MODAL)
    ══════════════════════════════════════════════════════════ --}}
    <div class="bo-modal-backdrop"
         x-show="deleteConfirm.open"
         x-transition
         style="display:none;"
         x-on:click.self="deleteConfirm.open = false"
         @keydown.escape.window="deleteConfirm.open = false">
        <div class="bo-modal" style="max-width:400px;width:95%;text-align:center;" x-on:click.stop>
            <div style="width:56px;height:56px;border-radius:50%;background:rgba(197,48,48,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <span class="material-icons-round" style="font-size:28px;color:#C53030;">delete_forever</span>
            </div>
            <h3 style="margin:0 0 8px;">Hapus Jenis Transaksi?</h3>
            <p style="font-size:14px;color:#718096;margin:0 0 20px;">Jenis transaksi ini tidak akan muncul lagi di pilihan dropdown form kas.</p>
            <div style="display:flex;gap:12px;justify-content:center;">
                <button type="button" class="btn-secondary" x-on:click="deleteConfirm.open = false">Batal</button>
                <button type="button" class="btn-danger" x-on:click="confirmDelete()">
                    <span class="material-icons-round" style="font-size:17px;">delete</span> Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    {{-- Hidden form for submissions --}}
    <form id="kategoriStoreForm" method="POST" action="/backoffice/kas-kategori/store" style="display:none;">
        @csrf
        <input type="hidden" name="type" id="k_store_type">
        <input type="hidden" name="nama" id="k_store_nama">
        <input type="hidden" name="deskripsi" id="k_store_deskripsi">
        <input type="hidden" name="display_order" id="k_store_order">
        <input type="hidden" name="is_active" id="k_store_active">
    </form>

    <form id="kategoriUpdateForm" method="POST" action="" style="display:none;">
        @csrf
        <input type="hidden" name="type" id="k_update_type">
        <input type="hidden" name="nama" id="k_update_nama">
        <input type="hidden" name="deskripsi" id="k_update_deskripsi">
        <input type="hidden" name="display_order" id="k_update_order">
        <input type="hidden" name="is_active" id="k_update_active">
    </form>

    <form id="kategoriDeleteForm" method="POST" action="" style="display:none;">
        @csrf
    </form>

</div>
@endsection

@push('scripts')
<script>
function kasKategoriData() {
    return {
        search: '',
        filterTipe: '',
        items: @json($categories),
        modal: {
            open: false,
            mode: 'add',
            form: {},
            editId: null
        },
        deleteConfirm: {
            open: false,
            targetId: null
        },

        init() {
            this.items = this.items.map(i => ({
                ...i,
                is_active: Boolean(i.is_active)
            }));
        },

        get countMasuk() {
            return this.items.filter(i => i.type === 'masuk').length;
        },

        get countKeluar() {
            return this.items.filter(i => i.type === 'keluar').length;
        },

        get countUmum() {
            return this.items.filter(i => i.type === 'umum').length;
        },

        get filtered() {
            return this.items.filter(i => {
                const matchTipe = !this.filterTipe || i.type === this.filterTipe;
                const q = (this.search || '').toLowerCase();
                const matchSearch = !q || (i.nama || '').toLowerCase().includes(q) || (i.deskripsi || '').toLowerCase().includes(q);
                return matchTipe && matchSearch;
            });
        },

        openModal(mode, item = null) {
            this.modal.mode = mode;
            this.modal.editId = item ? item.id : null;
            if (mode === 'add') {
                this.modal.form = {
                    type: this.filterTipe || 'masuk',
                    nama: '',
                    deskripsi: '',
                    display_order: this.items.length + 1,
                    is_active: 1
                };
            } else {
                this.modal.form = {
                    type: item.type,
                    nama: item.nama,
                    deskripsi: item.deskripsi || '',
                    display_order: item.display_order || 0,
                    is_active: item.is_active ? 1 : 0
                };
            }
            this.modal.open = true;
        },

        save() {
            const f = this.modal.form;
            if (!f.type || !f.nama.trim()) {
                alert('Tipe dan Nama Jenis tidak boleh kosong.');
                return;
            }

            if (this.modal.mode === 'add') {
                document.getElementById('k_store_type').value      = f.type;
                document.getElementById('k_store_nama').value      = f.nama.trim();
                document.getElementById('k_store_deskripsi').value = f.deskripsi || '';
                document.getElementById('k_store_order').value     = f.display_order || 0;
                document.getElementById('k_store_active').value    = f.is_active ? '1' : '0';
                document.getElementById('kategoriStoreForm').submit();
            } else {
                const form = document.getElementById('kategoriUpdateForm');
                form.action = '/backoffice/kas-kategori/' + this.modal.editId + '/update';
                document.getElementById('k_update_type').value      = f.type;
                document.getElementById('k_update_nama').value      = f.nama.trim();
                document.getElementById('k_update_deskripsi').value = f.deskripsi || '';
                document.getElementById('k_update_order').value     = f.display_order || 0;
                document.getElementById('k_update_active').value    = f.is_active ? '1' : '0';
                form.submit();
            }
        },

        deleteItem(id) {
            this.deleteConfirm.targetId = id;
            this.deleteConfirm.open = true;
        },

        confirmDelete() {
            const form = document.getElementById('kategoriDeleteForm');
            form.action = '/backoffice/kas-kategori/' + this.deleteConfirm.targetId + '/delete';
            form.submit();
        }
    };
}
</script>
@endpush

