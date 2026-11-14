@extends('backoffice.layouts.app')

@section('title', 'Kategori')
@section('page-title', 'Kategori')

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
            Tambah Kategori
        </button>
    </div>

    {{-- ── Filter & Search Bar ─────────────────────────────── --}}
    <div class="bo-card" style="margin-bottom:1.5rem;padding:16px 20px;">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
            {{-- Search --}}
            <div class="bo-search" style="min-width:260px;flex:1;max-width:400px;">
                <span class="material-icons-round" style="font-size:18px;color:#718096;">search</span>
                <input type="text" placeholder="Search kategori atau deskripsi..." x-model="search">
            </div>

            {{-- Filter Transaksi Tabs --}}
            <div style="display:flex;gap:6px;background:var(--bo-cream);padding:4px;border-radius:10px;flex-wrap:wrap;">
                <button type="button"
                        x-on:click="filterTipe = ''"
                        :style="filterTipe === '' ? 'background:#fff;color:var(--bo-blue);box-shadow:0 1px 4px rgba(0,0,0,0.08);' : 'background:transparent;color:#718096;'"
                        style="border:none;padding:7px 16px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;transition:all 0.15s;">
                    Semua Transaksi (<span x-text="items.length"></span>)
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
                        <th style="width:130px;text-align:center;">Transaksi</th>
                        <th style="text-align:left;">Nama Kategori</th>
                        <th style="text-align:left;">Keterangan / Deskripsi</th>
                        <th style="width:160px;text-align:center;">Bisa Cicil / DP</th>
                        <th style="width:90px;text-align:center;">Status</th>
                        <th style="width:110px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-if="filtered.length === 0">
                        <tr>
                            <td colspan="7" style="text-align:center;padding:40px;color:#718096;">
                                <span class="material-icons-round" style="font-size:40px;color:#cbd5e1;display:block;margin-bottom:8px;">category</span>
                                Tidak ada jenis kategori ditemukan.
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
                                <template x-if="item.type === 'masuk' || item.type === 'umum'">
                                    <button type="button"
                                            x-on:click="toggleCicil(item)"
                                            :title="item.bisa_cicil ? 'Klik untuk ubah menjadi: Hanya Lunas' : 'Klik untuk ubah menjadi: Bisa Cicil / DP'"
                                            :style="item.bisa_cicil ? 'background:#fef3c7;color:#92400e;border:1.5px solid #fde68a;' : 'background:#f1f5f9;color:#64748b;border:1.5px solid #e2e8f0;'"
                                            style="display:inline-flex;align-items:center;gap:6px;font-size:11.5px;padding:5px 12px;border-radius:20px;font-weight:700;cursor:pointer;transition:all 0.15s;outline:none;">
                                        <span class="material-icons-round" style="font-size:14px;"
                                              :style="item.bisa_cicil ? 'color:#d97706;' : 'color:#94a3b8;'"
                                              x-text="item.bisa_cicil ? 'check_circle' : 'lock'"></span>
                                        <span x-text="item.bisa_cicil ? 'Bisa Cicil / DP' : 'Hanya Lunas'"></span>
                                        <span class="material-icons-round" style="font-size:12px;opacity:0.5;">sync</span>
                                    </button>
                                </template>
                                <template x-if="item.type === 'keluar'">
                                    <span style="color:#cbd5e1;font-size:13px;">—</span>
                                </template>
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
            Menampilkan <strong x-text="filtered.length"></strong> dari <span x-text="items.length"></span> jenis kategori
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
                <h3 style="margin:0;" x-text="modal.mode === 'add' ? 'Tambah Kategori' : 'Edit Kategori'"></h3>
                <button type="button" class="btn-icon" x-on:click="modal.open = false">
                    <span class="material-icons-round">close</span>
                </button>
            </div>

            <form x-on:submit.prevent="save()">
                <div class="form-group">
                    <label class="bo-label">Transaksi <span style="color:red">*</span></label>
                    <select class="bo-select" x-model="modal.form.type" required>
                        <option value="">-- Pilih Transaksi --</option>
                        <option value="masuk">Pemasukan (Uang Masuk)</option>
                        <option value="keluar">Pengeluaran (Uang Keluar)</option>
                        <option value="umum">Umum (Operasional / Biaya Kantor)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="bo-label">Nama Kategori <span style="color:red">*</span></label>
                    <input type="text" class="bo-input" x-model="modal.form.nama"
                           placeholder="Contoh: Pembayaran SPP / Uang Kuliah" maxlength="100" required>
                </div>

                <div class="form-group">
                    <label class="bo-label">Deskripsi / Keterangan</label>
                    <textarea class="bo-textarea" rows="2" x-model="modal.form.deskripsi"
                              placeholder="Keterangan singkat tentang jenis transaksi ini..."></textarea>
                </div>

                {{-- Pengaturan Bisa Cicil / DP (Piutang) --}}
                <div class="form-group" x-show="modal.form.type === 'masuk' || modal.form.type === 'umum'" x-transition>
                    <div style="background:#fffcf0;border:1.5px solid #fde68a;border-radius:12px;padding:14px 16px;">
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
                            <div style="display:flex;align-items:flex-start;gap:10px;">
                                <div style="width:34px;height:34px;border-radius:9px;background:#fef3c7;color:#b45309;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                                    <span class="material-icons-round" style="font-size:19px;">payments</span>
                                </div>
                                <div>
                                    <div style="font-size:13.5px;font-weight:700;color:#92400e;">Izinkan Pembayaran Cicilan / DP (Piutang)</div>
                                    <div style="font-size:12px;color:#78350f;margin-top:2px;line-height:1.4;">
                                        Jika diaktifkan, kategori transaksi ini dapat dibayar sebagian / bertahap (DP) saat input kas, dan sisa nominalnya dicatat sebagai Uang di Lapangan.
                                    </div>
                                </div>
                            </div>
                            {{-- Switch Toggle --}}
                            <label style="position:relative;display:inline-block;width:48px;height:26px;flex-shrink:0;cursor:pointer;margin:0;">
                                <input type="checkbox" x-model="modal.form.bisa_cicil" style="opacity:0;width:0;height:0;">
                                <span style="position:absolute;cursor:pointer;top:0;left:0;right:0;bottom:0;border-radius:34px;transition:.3s;"
                                      :style="modal.form.bisa_cicil ? 'background:#16a34a;' : 'background:#cbd5e1;'">
                                    <span style="position:absolute;content:'';height:20px;width:20px;left:3px;bottom:3px;background:white;border-radius:50%;transition:.3s;box-shadow:0 1px 3px rgba(0,0,0,0.2);"
                                          :style="modal.form.bisa_cicil ? 'transform:translateX(22px);' : ''"></span>
                                </span>
                            </label>
                        </div>
                    </div>
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
            <h3 style="margin:0 0 8px;">Hapus Kategori?</h3>
            <p style="font-size:14px;color:#718096;margin:0 0 20px;">Kategori ini tidak akan muncul lagi di pilihan dropdown form transaksi kas.</p>
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
        <input type="hidden" name="bisa_cicil" id="k_store_bisa_cicil">
    </form>

    <form id="kategoriUpdateForm" method="POST" action="" style="display:none;">
        @csrf
        <input type="hidden" name="type" id="k_update_type">
        <input type="hidden" name="nama" id="k_update_nama">
        <input type="hidden" name="deskripsi" id="k_update_deskripsi">
        <input type="hidden" name="display_order" id="k_update_order">
        <input type="hidden" name="is_active" id="k_update_active">
        <input type="hidden" name="bisa_cicil" id="k_update_bisa_cicil">
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
                is_active: Boolean(i.is_active),
                bisa_cicil: Boolean(i.bisa_cicil)
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
                    is_active: 1,
                    bisa_cicil: (this.filterTipe === 'masuk' || !this.filterTipe) ? true : false
                };
            } else {
                this.modal.form = {
                    type: item.type,
                    nama: item.nama,
                    deskripsi: item.deskripsi || '',
                    display_order: item.display_order || 0,
                    is_active: item.is_active ? 1 : 0,
                    bisa_cicil: Boolean(item.bisa_cicil)
                };
            }
            this.modal.open = true;
        },

        save() {
            const f = this.modal.form;
            if (!f.type || !f.nama.trim()) {
                alert('Transaksi dan Nama Kategori tidak boleh kosong.');
                return;
            }

            if (this.modal.mode === 'add') {
                document.getElementById('k_store_type').value       = f.type;
                document.getElementById('k_store_nama').value       = f.nama.trim();
                document.getElementById('k_store_deskripsi').value  = f.deskripsi || '';
                document.getElementById('k_store_order').value      = f.display_order || 0;
                document.getElementById('k_store_active').value     = f.is_active ? '1' : '0';
                document.getElementById('k_store_bisa_cicil').value = f.bisa_cicil ? '1' : '0';
                document.getElementById('kategoriStoreForm').submit();
            } else {
                const form = document.getElementById('kategoriUpdateForm');
                form.action = '/backoffice/kas-kategori/' + this.modal.editId + '/update';
                document.getElementById('k_update_type').value       = f.type;
                document.getElementById('k_update_nama').value       = f.nama.trim();
                document.getElementById('k_update_deskripsi').value  = f.deskripsi || '';
                document.getElementById('k_update_order').value      = f.display_order || 0;
                document.getElementById('k_update_active').value     = f.is_active ? '1' : '0';
                document.getElementById('k_update_bisa_cicil').value = f.bisa_cicil ? '1' : '0';
                form.submit();
            }
        },

        async toggleCicil(item) {
            if (item.type === 'keluar') return;
            try {
                const res = await fetch('/backoffice/kas-kategori/' + item.id + '/toggle-cicil', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
                const data = await res.json();
                if (data.success) {
                    item.bisa_cicil = Boolean(data.bisa_cicil);
                }
            } catch(err) {
                console.error('Gagal mengubah pengaturan cicil:', err);
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
