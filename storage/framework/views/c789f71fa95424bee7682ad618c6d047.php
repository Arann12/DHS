<?php $__env->startSection('title', 'Partner'); ?>
<?php $__env->startSection('page-title', 'Manajemen Partner & Mitra'); ?>

<?php $__env->startSection('content'); ?>
<div x-data="partnerData()">
    
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Data partner berhasil disimpan.
    </div>

    
    <div class="bo-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0;">Daftar Partner & Mitra</h2>
            <button class="btn-primary" @click="openModal('add')">
                <span class="material-icons-round" style="font-size:18px;">add</span> Tambah Partner
            </button>
        </div>

        <div style="overflow-x:auto;">
        <table class="bo-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kelompok</th>
                    <th>Tipe</th>
                    <th>Negara</th>
                    <th>Website</th>
                    <th>Aktif</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(item, idx) in items" :key="item.id">
                    <tr>
                        <td x-text="item.name" style="font-weight:600;"></td>
                        <td><span :class="'badge ' + (item.partner_group === 'mitra_industri' ? 'badge-green' : 'badge-blue')" x-text="item.partner_group === 'mitra_industri' ? 'Mitra Industri' : 'Partnership'"></span></td>
                        <td><span class="badge badge-blue" x-text="item.type"></span></td>
                        <td x-text="item.country || '-'"></td>
                        <td><a :href="item.website_url" target="_blank" x-text="item.website_url ? 'Link' : '-'" style="color:#1A365D;"></a></td>
                        <td><span :class="'badge ' + (item.is_active ? 'badge-green' : 'badge-gray')" x-text="item.is_active ? 'Aktif' : 'Nonaktif'"></span></td>
                        <td x-text="item.display_order"></td>
                        <td>
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
                    <td colspan="7" style="text-align:center;padding:40px;color:#718096;">Belum ada data partner.</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>

    
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
            <div class="form-group">
                <label class="bo-label">Logo Partner</label>
                <div style="display:flex;align-items:flex-start;gap:14px;">
                    <div style="width:90px;height:90px;border-radius:10px;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
                         @click="$refs.partnerLogoInput.click()">
                        <template x-if="modal.form.logo_url">
                            <img :src="modal.form.logo_url" style="width:100%;height:100%;object-fit:contain;">
                        </template>
                        <template x-if="!modal.form.logo_url">
                            <span class="material-icons-round" style="color:#aaa;font-size:28px;">add_business</span>
                        </template>
                    </div>
                    <div style="flex:1;">
                        <div style="display:flex;gap:8px;margin-bottom:8px;">
                            <button type="button" class="btn-secondary" style="font-size:12px;padding:6px 12px;"
                                    @click="$refs.partnerLogoInput.click()">
                                <span class="material-icons-round" style="font-size:15px;vertical-align:middle;">upload</span> Upload Logo
                            </button>
                            <button type="button" x-show="modal.form.logo_url" class="btn-danger" style="font-size:11px;padding:4px 8px;"
                                    @click="modal.form.logo_url = ''">
                                <span class="material-icons-round" style="font-size:13px;">delete</span> Hapus
                            </button>
                        </div>
                        <input type="text" class="bo-input" x-model="modal.form.logo_url" placeholder="Atau paste URL logo di sini" style="font-size:12px;">
                    </div>
                </div>
                <input type="file" x-ref="partnerLogoInput" accept="image/*" style="display:none;" @change="uploadLogo($event)">
            </div>
            <div style="display:flex;gap:20px;">
                <label style="display:flex;align-items:center;gap:6px;font-size:13px;">
                    <input type="checkbox" x-model="modal.form.is_active" style="accent-color:#1A365D;"> Aktif
                </label>
                <label style="display:flex;align-items:center;gap:6px;font-size:13px;">
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
<?php $__env->stopSection(); ?>

<?php
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
?>

<?php $__env->startPush('scripts'); ?>
<script>
function partnerData() {
    return {
        saved: false,
        items: <?php echo json_encode($partnerItems, 15, 512) ?>,
        modal: { open: false, mode: 'add', form: {}, editId: null },
        deleteConfirm: { open: false, targetId: null },
        _logoFile: null,

        openModal(mode, item = null) {
            this.modal.mode = mode;
            this.modal.editId = item ? item.id : null;
            this.modal.form = item ? { ...item } : {
                name: '', partner_group: 'mitra_industri', type: 'hotel', country: '', description: '',
                website_url: '', logo_url: '', is_active: true, is_featured: false
            };
            this._logoFile = null;
            this.modal.open = true;
        },

        uploadLogo(event) {
            const file = event.target.files[0];
            if (!file) return;
            if (file.size > 5 * 1024 * 1024) { alert('Ukuran file maksimal 5MB.'); return; }
            this._logoFile = file;
            this.modal.form.logo_url = URL.createObjectURL(file);
        },

        saveItem() {
            if (!this.modal.form.name.trim()) return alert('Nama partner wajib diisi.');
            const fd = new FormData();
            fd.append('_token', '<?php echo e(csrf_token()); ?>');
            fd.append('name', this.modal.form.name);
            fd.append('partner_group', this.modal.form.partner_group);
            fd.append('type', this.modal.form.type);
            fd.append('country', this.modal.form.country);
            fd.append('description', this.modal.form.description);
            fd.append('website_url', this.modal.form.website_url);
            fd.append('is_active', this.modal.form.is_active ? '1' : '0');
            fd.append('is_featured', this.modal.form.is_featured ? '1' : '0');

            if (this._logoFile) {
                fd.append('logo_file', this._logoFile);
            } else {
                fd.append('logo_url', this.modal.form.logo_url || '');
            }

            const url = this.modal.mode === 'add'
                ? '/backoffice/partner/store'
                : `/backoffice/partner/${this.modal.editId}/update`;

            fetch(url, { method: 'POST', body: fd })
                .then(r => r.ok ? location.reload() : r.text().then(t => alert('Gagal: ' + t)));
        },

        confirmDelete(id) { this.deleteConfirm.targetId = id; this.deleteConfirm.open = true; },
        confirmDeleteItem() {
            const fd = new FormData();
            fd.append('_token', '<?php echo e(csrf_token()); ?>');
            
            fetch(`/backoffice/partner/${this.deleteConfirm.targetId}/delete`, {
                method: 'POST',
                body: fd
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backoffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/backoffice/partner.blade.php ENDPATH**/ ?>