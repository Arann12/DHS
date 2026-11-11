@extends('backoffice.layouts.app')
@section('title', 'Berita & Artikel')
@section('page-title', 'Berita & Artikel')

@section('content')
<div x-data="beritaData()">

    {{-- Hero Image Panel --}}
    <div class="bo-card" style="margin-bottom:24px;" x-data="heroImageBerita()">
        {{-- Header --}}
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;">
            <span class="material-icons-round" style="font-size:22px;color:#C53030;">image</span>
            <div>
                <h3 style="margin:0;font-size:15px;font-weight:700;color:#1A365D;">Gambar Hero — Halaman Berita</h3>
                <p style="margin:0;font-size:12px;color:#718096;">Gambar latar belakang pada bagian hero di halaman Berita &amp; Artikel publik.</p>
            </div>
        </div>

        {{-- Preview Area --}}
        <div style="position:relative;width:100%;height:180px;border-radius:12px;overflow:hidden;background:#1A365D;margin-bottom:16px;">
            <img :src="heroUrl" x-show="heroUrl"
                 style="width:100%;height:100%;object-fit:cover;opacity:0.8;"
                 x-on:error="heroUrl = ''">
            <div x-show="!heroUrl"
                 style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:8px;">
                <span class="material-icons-round" style="font-size:44px;color:rgba(255,255,255,0.25);">image_not_supported</span>
                <span style="font-size:12px;color:rgba(255,255,255,0.4);">Belum ada gambar — menggunakan gambar default</span>
            </div>
            <div x-show="heroUrl" style="position:absolute;bottom:10px;right:12px;pointer-events:none;">
                <span style="background:rgba(0,0,0,0.5);color:#fff;font-size:10px;font-weight:600;padding:3px 10px;border-radius:20px;letter-spacing:0.05em;text-transform:uppercase;">Preview</span>
            </div>
        </div>

        {{-- URL Input --}}
        <div style="margin-bottom:14px;">
            <label class="bo-label">URL Gambar Hero</label>
            <input type="text" class="bo-input" x-model="heroUrl"
                   placeholder="https://... atau kosongkan untuk gunakan gambar default"
                   @keyup.enter="save()">
            <div style="font-size:11px;color:#aaa;margin-top:5px;">Gambar disimpan di folder <code>uploads/hero/berita/</code></div>
        </div>

        {{-- Action Buttons --}}
        <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
            <button class="btn-primary" style="gap:8px;" @click="openPicker()" :disabled="saving">
                <span class="material-icons-round" style="font-size:18px;">upload</span>
                Upload / Pilih Gambar
            </button>
            <button class="btn-primary" style="background:#276749;gap:8px;" @click="save()" :disabled="saving">
                <span class="material-icons-round" style="font-size:18px;" x-text="saving ? 'hourglass_empty' : 'save'"></span>
                <span x-text="saving ? 'Menyimpan...' : 'Simpan Gambar Hero'"></span>
            </button>
            <button x-show="heroUrl" class="btn-danger" style="gap:6px;" @click="clear()" :disabled="saving">
                <span class="material-icons-round" style="font-size:16px;">delete</span>
                Hapus Gambar
            </button>
        </div>

        {{-- Toast --}}
        <div x-show="toast" x-transition style="display:none;margin-top:14px;padding:11px 16px;border-radius:8px;font-size:13px;font-weight:600;display:flex;align-items:center;gap:8px;"
             :style="toastType==='success' ? 'background:#f0fff4;color:#276749;border:1px solid #c6f6d5;' : 'background:#fff5f5;color:#9b2c2c;border:1px solid #fed7d7;'">
            <span class="material-icons-round" style="font-size:18px;" x-text="toastType==='success' ? 'check_circle' : 'error'"></span>
            <span x-text="toastMsg"></span>
        </div>
    </div>

    {{-- Toolbar --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <div style="display:flex;align-items:center;gap:10px;">
            <div class="bo-search">
                <span class="material-icons-round" style="font-size:18px;color:#718096;">search</span>
                <input type="text" placeholder="Cari berita..." x-model="search">
            </div>
            <select class="bo-select" style="width:auto;" x-model="filterStatus">
                <option value="">Semua Status</option>
                <option value="Dipublikasikan">Dipublikasikan</option>
                <option value="Draft">Draft</option>
                <option value="Archived">Archived</option>
            </select>
        </div>
        <button class="btn-primary" @click="openModal('add')">
            <span class="material-icons-round" style="font-size:18px;">add</span>
            Tambah Berita
        </button>
    </div>

    {{-- Table --}}
    <div class="bo-card" style="padding:0;overflow:hidden;">
        <div style="overflow-x:auto;">
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
                            <div style="font-weight:700;color:#1A365D;font-size:13.5px;" x-text="item.judul"></div>
                        </td>
                        <td><span class="badge badge-blue" x-text="item.kategori"></span></td>
                        <td style="color:#718096;font-size:13px;" x-text="item.tanggal"></td>
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
                    <td colspan="6" style="text-align:center;color:#718096;padding:40px;">Tidak ada berita ditemukan.</td>
                </tr>
            </tbody>
        </table>
        </div>
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
            <div class="bo-grid-3" style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px;margin-bottom:18px;">
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
                <label class="bo-label">Excerpt / Ringkasan</label>
                <textarea class="bo-textarea" rows="2" x-model="modal.form.excerpt" placeholder="Ringkasan singkat artikel untuk tampilan listing..."></textarea>
            </div>
            <div class="form-group">
                <label class="bo-label">Konten / Isi Artikel</label>
                <div id="summernote-konten"></div>
            </div>
            <div class="form-group">
                <label class="bo-label">Thumbnail</label>
                <div style="display:flex;align-items:flex-start;gap:14px;">
                    <div style="width:140px;height:80px;border-radius:10px;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
                         @click="$store.imageUpload.open(url => { modal.form.thumbnail = url }, 'uploads/berita')">
                        <template x-if="modal.form.thumbnail">
                            <img :src="modal.form.thumbnail" style="width:100%;height:100%;object-fit:cover;">
                        </template>
                        <template x-if="!modal.form.thumbnail">
                            <span class="material-icons-round" style="color:#aaa;font-size:28px;">add_photo_alternate</span>
                        </template>
                    </div>
                    <div>
                        <button type="button" class="btn-secondary" style="font-size:12px;padding:7px 14px;"
                                @click="$store.imageUpload.open(url => { modal.form.thumbnail = url }, 'uploads/berita')">
                            <span class="material-icons-round" style="font-size:16px;">edit</span> Ganti Thumbnail
                        </button>
                        <button type="button" x-show="modal.form.thumbnail" class="btn-danger" style="font-size:11px;padding:5px 10px;margin-top:6px;"
                                @click="modal.form.thumbnail = null">
                            <span class="material-icons-round" style="font-size:13px;">delete</span> Hapus
                        </button>
                        <div style="font-size:11px;color:#aaa;margin-top:6px;">16:9 disarankan — URL atau upload</div>
                    </div>
                </div>
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
                <div style="width:56px;height:56px;border-radius:50%;background:rgba(197,48,48,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <span class="material-icons-round" style="font-size:28px;color:#C53030;">delete_forever</span>
                </div>
                <h3 style="margin:0 0 8px;">Hapus Berita?</h3>
                <p style="font-size:14px;color:#718096;margin:0;">Berita ini akan dihapus permanen dari sistem.</p>
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
function heroImageBerita() {
    return {
        heroUrl: @json($heroImage ?? ''),
        saving: false,
        toast: false,
        toastMsg: '',
        toastType: 'success',

        openPicker() {
            Alpine.store('imageUpload').open(url => { this.heroUrl = url; }, 'uploads/hero/berita');
        },

        save() {
            this.saving = true;
            const fd = new FormData();
            fd.append('hero_image', this.heroUrl || '');
            fd.append('_token', '{{ csrf_token() }}');
            fetch('/backoffice/berita/hero/update', { method: 'POST', body: fd })
                .then(r => r.json())
                .then(data => {
                    this.saving = false;
                    if (data.success) {
                        this.showToast('Gambar hero Berita berhasil disimpan!', 'success');
                    } else {
                        this.showToast('Gagal menyimpan gambar.', 'error');
                    }
                })
                .catch(() => {
                    this.saving = false;
                    this.showToast('Terjadi kesalahan. Coba lagi.', 'error');
                });
        },

        clear() {
            this.heroUrl = '';
            this.save();
        },

        showToast(msg, type) {
            this.toastMsg = msg;
            this.toastType = type;
            this.toast = true;
            setTimeout(() => { this.toast = false; }, 3500);
        }
    };
}

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

            this.$nextTick(() => {
                if ($('#summernote-konten').summernote) {
                    $('#summernote-konten').summernote('destroy');
                }
                $('#summernote-konten').summernote({
                    height: 300,
                    lang: 'id-ID',
                    placeholder: 'Tulis isi artikel di sini...',
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
                if (item && item.konten) {
                    $('#summernote-konten').summernote('code', item.konten);
                }
            });
        },

        saveItem() {
            if (!this.modal.form.judul.trim()) return alert('Judul berita tidak boleh kosong.');
            const formData = new FormData();
            formData.append('title',       this.modal.form.judul);
            formData.append('category',    this.modal.form.kategori.toLowerCase());
            formData.append('excerpt',     this.modal.form.excerpt || '');
            formData.append('content',     $('#summernote-konten').summernote('code') || '');
            formData.append('status',      this.modal.form.status === 'Dipublikasikan' ? 'dipublikasikan' : 'draft');
            formData.append('is_featured', this.modal.form.is_featured ? '1' : '0');
            formData.append('_token',      '{{ csrf_token() }}');

            // Handle thumbnail: convert base64 data URL to File if needed
            if (this.modal.form.thumbnail) {
                if (this.modal.form.thumbnail.startsWith('data:')) {
                    formData.append('thumbnail', dataURLtoFile(this.modal.form.thumbnail, 'thumbnail.png'));
                } else {
                    formData.append('thumbnail_url', this.modal.form.thumbnail);
                }
            }

            const url = this.modal.mode === 'add'
                ? '/backoffice/berita/store'
                : `/backoffice/berita/${this.modal.editId}/update`;

            fetch(url, { method: 'POST', body: formData, headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
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

