@extends('backoffice.layouts.app')
@section('title', 'Berita & Artikel')
@section('page-title', 'Berita & Artikel')

@section('content')
<div x-data="beritaData()">

    {{-- Toolbar --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <div style="display:flex;align-items:center;gap:10px;">
            <div class="bo-search">
                <span class="material-icons-round" style="font-size:18px;color:#8A8478;">search</span>
                <input type="text" placeholder="Cari berita..." x-model="search">
            </div>
            <select class="bo-select" style="width:auto;" x-model="filterStatus">
                <option value="">Semua Status</option>
                <option value="Dipublikasikan">Dipublikasikan</option>
                <option value="Draft">Draft</option>
            </select>
        </div>
        <button class="btn-primary" @click="openModal('add')">
            <span class="material-icons-round" style="font-size:18px;">add</span>
            Tambah Berita
        </button>
    </div>

    {{-- Table --}}
    <div class="bo-card" style="padding:0;overflow:hidden;">
        <table class="bo-table">
            <thead>
                <tr>
                    <th style="width:80px;">Thumbnail</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal Publish</th>
                    <th>Status</th>
                    <th style="width:120px;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="item in filtered" :key="item.id">
                    <tr>
                        <td>
                            <div style="width:64px;height:48px;border-radius:8px;overflow:hidden;background:#eee;">
                                <img x-show="item.thumbnail" :src="item.thumbnail" style="width:100%;height:100%;object-fit:cover;">
                                <div x-show="!item.thumbnail" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                    <span class="material-icons-round" style="color:#ccc;font-size:20px;">image</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:700;color:#1a1a2e;font-size:13.5px;" x-text="item.judul"></div>
                        </td>
                        <td><span class="badge badge-blue" x-text="item.kategori"></span></td>
                        <td style="color:#8A8478;font-size:13px;" x-text="item.tanggal"></td>
                        <td>
                            <span :class="item.status === 'Dipublikasikan' ? 'badge badge-green' : 'badge badge-gray'" x-text="item.status"></span>
                        </td>
                        <td>
                            <div style="display:flex;gap:8px;justify-content:center;">
                                <button class="btn-icon" @click="openModal('edit', item)" title="Edit">
                                    <span class="material-icons-round" style="font-size:17px;">edit</span>
                                </button>
                                <button class="btn-icon danger" @click="deleteItem(item.id)" title="Hapus">
                                    <span class="material-icons-round" style="font-size:17px;">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
                <tr x-show="filtered.length === 0">
                    <td colspan="6" style="text-align:center;color:#8A8478;padding:40px;">Tidak ada berita ditemukan.</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Modal Add/Edit --}}
    <div class="bo-modal-backdrop" x-show="modal.open" x-transition style="display:none;" @keydown.escape.window="modal.open=false">
        <div class="bo-modal wide" @click.stop style="max-width:760px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
                <h3 style="margin:0;" x-text="modal.mode === 'add' ? 'Tambah Berita Baru' : 'Edit Berita'"></h3>
                <button class="btn-icon" @click="modal.open=false"><span class="material-icons-round">close</span></button>
            </div>

            <div class="form-group">
                <label class="bo-label">Judul Berita</label>
                <input type="text" class="bo-input" x-model="modal.form.judul" placeholder="Judul berita yang menarik...">
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px;margin-bottom:18px;">
                <div>
                    <label class="bo-label">Kategori</label>
                    <select class="bo-select" x-model="modal.form.kategori">
                        <option>Prestasi</option>
                        <option>Akademik</option>
                        <option>Kegiatan</option>
                        <option>Admisi</option>
                        <option>Alumni</option>
                        <option>Umum</option>
                    </select>
                </div>
                <div>
                    <label class="bo-label">Tanggal Publish</label>
                    <input type="date" class="bo-input" x-model="modal.form.tanggalRaw">
                </div>
                <div>
                    <label class="bo-label">Status</label>
                    <select class="bo-select" x-model="modal.form.status">
                        <option>Dipublikasikan</option>
                        <option>Draft</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="bo-label">Konten / Isi Artikel</label>
                <div style="border:1.5px solid #e0e0e0;border-radius:10px;overflow:hidden;">
                    {{-- Mock Rich Text Toolbar --}}
                    <div style="background:#fafafa;border-bottom:1px solid #eee;padding:8px 12px;display:flex;gap:8px;flex-wrap:wrap;">
                        <template x-for="tool in ['format_bold','format_italic','format_underlined','format_list_bulleted','format_list_numbered','link','image']">
                            <button type="button" style="width:30px;height:30px;border:none;background:none;cursor:pointer;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#666;transition:background 0.15s;" onmouseover="this.style.background='#eee'" onmouseout="this.style.background='none'">
                                <span class="material-icons-round" style="font-size:18px;" x-text="tool"></span>
                            </button>
                        </template>
                    </div>
                    <textarea class="bo-textarea" style="border:none;border-radius:0;min-height:160px;" x-model="modal.form.konten" placeholder="Tulis isi artikel di sini..."></textarea>
                </div>
                <div style="font-size:11.5px;color:#aaa;margin-top:5px;">*Rich text editor akan diintegrasikan saat koneksi ke backend.</div>
            </div>
            <div class="form-group">
                <label class="bo-label">Thumbnail</label>
                <div style="border:2px dashed #e0e0e0;border-radius:12px;padding:16px;text-align:center;cursor:pointer;background:#fafafa;"
                     @click="$refs.thumbInput.click()" :style="modal.form.thumbnail ? 'border-color:#0E06B4;' : ''">
                    <img x-show="modal.form.thumbnail" :src="modal.form.thumbnail" style="max-height:100px;width:100%;object-fit:cover;border-radius:8px;margin-bottom:8px;">
                    <div x-show="!modal.form.thumbnail">
                        <span class="material-icons-round" style="font-size:28px;color:#ccc;display:block;margin-bottom:4px;">add_photo_alternate</span>
                        <div style="font-size:12px;color:#8A8478;">Upload thumbnail (16:9 disarankan)</div>
                    </div>
                    <input type="file" x-ref="thumbInput" accept="image/*" @change="handleThumb($event)" style="display:none;">
                </div>
                <button x-show="modal.form.thumbnail" class="btn-danger" style="font-size:12px;padding:5px 10px;margin-top:8px;" @click="modal.form.thumbnail = null">
                    <span class="material-icons-round" style="font-size:14px;">delete</span> Hapus Thumbnail
                </button>
            </div>

            <hr class="divider">
            <div style="display:flex;gap:12px;justify-content:flex-end;">
                <button class="btn-secondary" @click="modal.open=false">Batal</button>
                <button class="btn-primary" @click="saveItem()">
                    <span class="material-icons-round" style="font-size:18px;">save</span>
                    <span x-text="modal.mode === 'add' ? 'Publikasikan' : 'Simpan Perubahan'"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- Confirm Delete --}}
    <div class="bo-modal-backdrop" x-show="confirmDelete.open" x-transition style="display:none;">
        <div class="bo-modal" style="max-width:420px;" @click.stop>
            <div style="text-align:center;margin-bottom:20px;">
                <div style="width:56px;height:56px;border-radius:50%;background:rgba(225,0,1,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <span class="material-icons-round" style="font-size:28px;color:#E10001;">delete_forever</span>
                </div>
                <h3 style="margin:0 0 8px;">Hapus Berita?</h3>
                <p style="font-size:14px;color:#8A8478;margin:0;">Berita ini akan dihapus permanen dari sistem.</p>
            </div>
            <div style="display:flex;gap:12px;justify-content:center;">
                <button class="btn-secondary" @click="confirmDelete.open=false">Batal</button>
                <button class="btn-danger" @click="confirmDeleteItem()">
                    <span class="material-icons-round" style="font-size:17px;">delete</span> Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>
@php
    $articlesData = $articles->map(function($a) {
        return [
            'id'         => $a->id,
            'judul'      => $a->title,
            'slug'       => $a->slug,
            'kategori'   => ucfirst($a->category),
            'tanggal'    => $a->created_at->format('d M Y'),
            'tanggalRaw' => $a->created_at->format('Y-m-d'),
            'status'     => $a->status === 'dipublikasikan' ? 'Dipublikasikan' : ($a->status === 'archived' ? 'Archived' : 'Draft'),
            'konten'     => $a->content ?? '',
            'excerpt'    => $a->excerpt ?? '',
            'thumbnail'  => $a->thumbnail_url,
            'is_featured'=> (bool)$a->is_featured,
        ];
    });
@endphp
@endsection

@push('scripts')
<script>
function beritaData() {
    return {
        search: '',
        filterStatus: '',
        items: @json($articlesData),
        modal: { open:false, mode:'add', form:{}, editId:null },
        confirmDelete: { open:false, targetId:null },

        get filtered() {
            return this.items.filter(i => {
                const matchSearch = !this.search || i.judul.toLowerCase().includes(this.search.toLowerCase());
                const matchStatus = !this.filterStatus || i.status === this.filterStatus;
                return matchSearch && matchStatus;
            });
        },

        openModal(mode, item = null) {
            this.modal.mode = mode;
            this.modal.editId = item ? item.id : null;
            this.modal.form = item
                ? { ...item }
                : { judul:'', kategori:'umum', tanggalRaw:'', status:'draft', konten:'', excerpt:'', thumbnail:null, is_featured: false };
            this.modal.open = true;
        },

        handleThumb(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = ev => this.modal.form.thumbnail = ev.target.result;
            reader.readAsDataURL(file);
        },

        saveItem() {
            if (!this.modal.form.judul.trim()) return alert('Judul berita tidak boleh kosong.');
            const formData = new FormData();
            formData.append('title',       this.modal.form.judul);
            formData.append('category',    this.modal.form.kategori.toLowerCase());
            formData.append('excerpt',     this.modal.form.excerpt || '');
            formData.append('content',     this.modal.form.konten || '');
            formData.append('status',      this.modal.form.status === 'Dipublikasikan' ? 'dipublikasikan' : 'draft');
            formData.append('is_featured', this.modal.form.is_featured ? '1' : '0');
            formData.append('_token',      '{{ csrf_token() }}');

            const thumbInput = document.querySelector('[x-ref="thumbInput"]');
            if (thumbInput && thumbInput.files[0]) {
                formData.append('thumbnail', thumbInput.files[0]);
            }

            const url = this.modal.mode === 'add'
                ? '/backoffice/berita/store'
                : `/backoffice/berita/${this.modal.editId}/update`;

            fetch(url, { method: 'POST', body: formData })
                .then(r => r.ok ? location.reload() : r.text().then(t => alert('Gagal menyimpan: ' + t)));
        },

        deleteItem(id) { this.confirmDelete.targetId = id; this.confirmDelete.open = true; },

        confirmDeleteItem() {
            fetch(`/backoffice/berita/${this.confirmDelete.targetId}/delete`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ id: this.confirmDelete.targetId })
            }).then(() => {
                this.items = this.items.filter(i => i.id !== this.confirmDelete.targetId);
                this.confirmDelete.open = false;
            });
        }
    };
}
</script>
@endpush

