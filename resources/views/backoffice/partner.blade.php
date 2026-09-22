@extends('backoffice.layouts.app')
@section('title', 'Partner')
@section('page-title', 'Manajemen Partner & Mitra')

@section('content')
<div x-data="partnerData()">
    {{-- Alert --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Data partner berhasil disimpan.
    </div>

    {{-- List Card --}}
    <div class="bo-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0;">Daftar Partner & Mitra</h2>
            <button class="btn-primary" @click="openModal('add')">
                <span class="material-icons-round" style="font-size:18px;">add</span> Tambah Partner
            </button>
        </div>

        <div style="overflow-x:auto;">
        <table class="bo-table">
            <thead>
                <tr>
                    <th style="width:75px;">Logo</th>
                    <th>Nama</th>
                    <th>Kelompok</th>
                    <th>Tipe</th>
                    <th>Negara</th>
                    <th>Website</th>
                    <th>Status</th>
                    <th>Urutan</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(item, idx) in items" :key="item.id">
                    <tr>
                        <td>
                            <template x-if="item.logo_url">
                                <div style="width:55px;height:40px;background:#ffffff;border:1px solid #e2e8f0;border-radius:8px;padding:3px;display:flex;align-items:center;justify-content:center;box-shadow:0 1px 2px rgba(0,0,0,0.04);">
                                    <img :src="item.logo_url" style="max-width:100%;max-height:100%;object-fit:contain;">
                                </div>
                            </template>
                            <template x-if="!item.logo_url">
                                <span style="font-size:11px;color:#94a3b8;font-style:italic;">No logo</span>
                            </template>
                        </td>
                        <td x-text="item.name" style="font-weight:600;"></td>
                        <td><span :class="'badge ' + (item.partner_group === 'mitra_industri' ? 'badge-green' : 'badge-blue')" x-text="item.partner_group === 'mitra_industri' ? 'Mitra Industri' : 'Partnership'"></span></td>
                        <td><span class="badge badge-blue" x-text="item.type"></span></td>
                        <td x-text="item.country || '-'"></td>
                        <td>
                            <template x-if="item.website_url">
                                <a :href="item.website_url" target="_blank" style="color:#1A365D;font-weight:500;display:inline-flex;align-items:center;gap:3px;">
                                    Link <span class="material-icons-round" style="font-size:13px;">open_in_new</span>
                                </a>
                            </template>
                            <template x-if="!item.website_url">
                                <span style="color:#94a3b8;">-</span>
                            </template>
                        </td>
                        <td><span :class="'badge ' + (item.is_active ? 'badge-green' : 'badge-gray')" x-text="item.is_active ? 'Aktif' : 'Nonaktif'"></span></td>
                        <td x-text="item.display_order"></td>
                        <td style="text-align:right;">
                            <button class="btn-icon" @click="openModal('edit', item)" title="Edit">
                                <span class="material-icons-round" style="font-size:18px;">edit</span>
                            </button>
                            <button class="btn-icon danger" @click="confirmDelete(item.id)" title="Hapus">
                                <span class="material-icons-round" style="font-size:18px;">delete</span>
                            </button>
                        </td>
                    </tr>
                </template>
                <tr x-show="items.length === 0">
                    <td colspan="9" style="text-align:center;padding:40px;color:#718096;">Belum ada data partner.</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>

    {{-- Modal Form --}}
    <div class="bo-modal-backdrop" x-show="modal.open" x-transition style="display:none;">
        <div class="bo-modal" style="max-width:550px;" @click.stop>
            <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 20px;" x-text="modal.mode === 'add' ? 'Tambah Partner Baru' : 'Edit Partner'"></h3>
            
            <div class="form-group">
                <label class="bo-label">Nama Partner <span style="color:#C53030;">*</span></label>
                <input type="text" class="bo-input" x-model="modal.form.name" placeholder="Nama perusahaan/partner">
            </div>

            <div class="form-group">
                <label class="bo-label">Kelompok <span style="color:#C53030;">*</span></label>
                <select class="bo-input" x-model="modal.form.partner_group">
                    <option value="mitra_industri">Mitra Industri (Hotel/Restoran/Kapal)</option>
                    <option value="partnership">Partnership (Pendidikan/Kerjasama)</option>
                </select>
            </div>

            <div class="form-group">
                <label class="bo-label">Tipe</label>
                <select class="bo-input" x-model="modal.form.type">
                    <option value="hotel">Hotel</option>
                    <option value="education">Pendidikan</option>
                    <option value="cruise">Kapal Pesiar</option>
                    <option value="restaurant">Restoran</option>
                    <option value="government">Pemerintah</option>
                    <option value="other">Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label class="bo-label">Negara</label>
                <input type="text" class="bo-input" x-model="modal.form.country" placeholder="Australia, Jerman, Indonesia...">
            </div>

            <div class="form-group">
                <label class="bo-label">Deskripsi</label>
                <textarea class="bo-textarea" rows="2" x-model="modal.form.description"></textarea>
            </div>

            <div class="form-group">
                <label class="bo-label">Website URL</label>
                <input type="text" class="bo-input" x-model="modal.form.website_url" placeholder="https://...">
            </div>

            {{-- Logo Partner with Universal Modal Image Picker --}}
            <div class="form-group">
                <label class="bo-label">Logo Partner</label>
                <div style="display:flex;align-items:flex-start;gap:14px;">
                    <div style="width:100px;height:100px;border-radius:12px;overflow:hidden;border:2px dashed #cbd5e1;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;padding:6px;transition:all 0.2s ease;"
                         @click="$store.imageUpload.open(url => { modal.form.logo_url = url }, 'uploads/partner')"
                         title="Klik untuk memilih atau mengunggah logo">
                        <template x-if="modal.form.logo_url">
                            <img :src="modal.form.logo_url" style="width:100%;height:100%;object-fit:contain;">
                        </template>
                        <template x-if="!modal.form.logo_url">
                            <div style="text-align:center;color:#94a3b8;">
                                <span class="material-icons-round" style="font-size:28px;display:block;margin:0 auto 2px;">add_photo_alternate</span>
                                <span style="font-size:10.5px;font-weight:600;">Upload Logo</span>
                            </div>
                        </template>
                    </div>

                    <div style="flex:1;">
                        <div style="display:flex;gap:8px;margin-bottom:8px;flex-wrap:wrap;">
                            <button type="button" class="btn-secondary" style="font-size:12px;padding:7px 14px;display:inline-flex;align-items:center;gap:5px;"
                                    @click="$store.imageUpload.open(url => { modal.form.logo_url = url }, 'uploads/partner')">
                                <span class="material-icons-round" style="font-size:16px;">cloud_upload</span> Upload / Pilih Logo
                            </button>
                            <button type="button" x-show="modal.form.logo_url" class="btn-danger" style="font-size:11.5px;padding:5px 10px;display:inline-flex;align-items:center;gap:4px;"
                                    @click="modal.form.logo_url = ''">
                                <span class="material-icons-round" style="font-size:14px;">delete</span> Hapus Logo
                            </button>
                        </div>
                        <input type="text" class="bo-input" x-model="modal.form.logo_url" placeholder="URL logo (/uploads/partner/... atau https://...)" style="font-size:12px;">
                        <span style="font-size:11px;color:#64748b;margin-top:4px;display:block;">Format: PNG, JPG, WEBP, SVG. Disarankan berlatar transparan.</span>
                    </div>
                </div>
            </div>

            <div style="display:flex;gap:20px;">
                <label style="display:flex;align-items:center;gap:6px;font-size:13px;cursor:pointer;">
                    <input type="checkbox" x-model="modal.form.is_active" style="accent-color:#1A365D;"> Aktif
                </label>
                <label style="display:flex;align-items:center;gap:6px;font-size:13px;cursor:pointer;">
                    <input type="checkbox" x-model="modal.form.is_featured" style="accent-color:#1A365D;"> Featured
                </label>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:20px;">
                <button class="btn-secondary" @click="modal.open = false">Batal</button>
                <button class="btn-primary" @click="saveItem()">
                    <span class="material-icons-round" style="font-size:18px;">save</span> Simpan
                </button>
            </div>
        </div>
    </div>

    {{-- Confirm Delete --}}
    <div class="bo-modal-backdrop" x-show="deleteConfirm.open" x-transition style="display:none;">
        <div class="bo-modal" style="max-width:400px;" @click.stop>
            <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 12px;">Hapus Partner?</h3>
            <p style="font-size:14px;color:#718096;margin-bottom:20px;">Data partner akan dihapus permanen.</p>
            <div style="display:flex;gap:12px;justify-content:flex-end;">
                <button class="btn-secondary" @click="deleteConfirm.open = false">Batal</button>
                <button class="btn-danger" @click="confirmDeleteItem()">
                    <span class="material-icons-round" style="font-size:17px;">delete</span> Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@php
    $partnerItems = $partners->map(fn($p) => [
        'id'           => $p->id,
        'name'         => $p->name,
        'type'         => $p->type ?? 'other',
        'partner_group' => $p->partner_group ?? 'mitra_industri',
        'country'      => $p->country ?? '',
        'description'  => $p->description ?? '',
        'website_url'  => $p->website_url ?? '',
        'logo_url'     => $p->logo_url ?? '',
        'is_active'    => (bool)$p->is_active,
        'is_featured'  => (bool)$p->is_featured,
        'display_order'=> $p->display_order,
    ])->values();
@endphp

@push('scripts')
<script>
function partnerData() {
    return {
        saved: false,
        items: @json($partnerItems),
        modal: { open: false, mode: 'add', form: {}, editId: null },
        deleteConfirm: { open: false, targetId: null },

        openModal(mode, item = null) {
            this.modal.mode = mode;
            this.modal.editId = item ? item.id : null;
            this.modal.form = item ? { ...item } : {
                name: '', partner_group: 'mitra_industri', type: 'hotel', country: '', description: '',
                website_url: '', logo_url: '', is_active: true, is_featured: false
            };
            this.modal.open = true;
        },

        saveItem() {
            if (!this.modal.form.name || !this.modal.form.name.trim()) {
                return alert('Nama partner wajib diisi.');
            }
            const fd = new FormData();
            fd.append('_token', '{{ csrf_token() }}');
            fd.append('name', this.modal.form.name.trim());
            fd.append('partner_group', this.modal.form.partner_group);
            fd.append('type', this.modal.form.type);
            fd.append('country', this.modal.form.country || '');
            fd.append('description', this.modal.form.description || '');
            fd.append('website_url', this.modal.form.website_url || '');
            fd.append('logo_url', this.modal.form.logo_url || '');
            fd.append('is_active', this.modal.form.is_active ? '1' : '0');
            fd.append('is_featured', this.modal.form.is_featured ? '1' : '0');

            const url = this.modal.mode === 'add'
                ? '/backoffice/partner/store'
                : `/backoffice/partner/${this.modal.editId}/update`;

            fetch(url, { 
                method: 'POST', 
                body: fd,
                headers: { 'Accept': 'application/json' }
            })
            .then(r => {
                if (r.ok) {
                    location.reload();
                } else {
                    r.text().then(t => alert('Gagal menyimpan: ' + t));
                }
            })
            .catch(err => alert('Terjadi kesalahan jaringan: ' + err));
        },

        confirmDelete(id) { 
            this.deleteConfirm.targetId = id; 
            this.deleteConfirm.open = true; 
        },

        confirmDeleteItem() {
            const fd = new FormData();
            fd.append('_token', '{{ csrf_token() }}');
            
            fetch(`/backoffice/partner/${this.deleteConfirm.targetId}/delete`, {
                method: 'POST',
                body: fd,
                headers: { 'Accept': 'application/json' }
            }).then(r => {
                if (r.ok) { 
                    location.reload(); 
                } else { 
                    r.json()
                        .then(j => alert('Gagal: ' + (j.message || j.error || 'Unknown error')))
                        .catch(() => r.text().then(t => alert('Gagal menghapus: ' + t)));
                }
            }).catch(() => alert('Terjadi kesalahan jaringan.'));
        }
    };
}
</script>
@endpush
