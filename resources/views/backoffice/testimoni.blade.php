@extends('backoffice.layouts.app')
@section('title', 'Testimoni')
@section('page-title', 'Testimoni')

@section('content')
<div x-data="testimoniData()">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <div class="bo-search">
            <span class="material-icons-round" style="font-size:18px;color:#8A8478;">search</span>
            <input type="text" placeholder="Cari testimoni..." x-model="search">
        </div>
        <button class="btn-primary" @click="openModal('add')">
            <span class="material-icons-round" style="font-size:18px;">add</span>
            Tambah Testimoni
        </button>
    </div>

    <div class="bo-card" style="padding:0;overflow:hidden;">
        <table class="bo-table">
            <thead>
                <tr>
                    <th style="width:70px;">Foto</th>
                    <th>Nama</th>
                    <th>Jabatan / Angkatan</th>
                    <th>Kutipan</th>
                    <th style="width:120px;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="item in filtered" :key="item.id">
                    <tr>
                        <td>
                            <div style="width:48px;height:48px;border-radius:50%;overflow:hidden;background:#eee;">
                                <img x-show="item.foto" :src="item.foto" style="width:100%;height:100%;object-fit:cover;">
                                <div x-show="!item.foto" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#0E06B4,#2B2494);">
                                    <span style="color:#fff;font-weight:700;font-size:16px;" x-text="item.nama.charAt(0).toUpperCase()"></span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:700;color:#1a1a2e;" x-text="item.nama"></div>
                        </td>
                        <td style="color:#8A8478;font-size:13px;" x-text="item.jabatan"></td>
                        <td style="max-width:300px;">
                            <div style="font-style:italic;color:#555;font-size:13px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;" x-text="'\"' + item.kutipan + '\"'"></div>
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
                    <td colspan="5" style="text-align:center;color:#8A8478;padding:40px;">Tidak ada testimoni ditemukan.</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    <div class="bo-modal-backdrop" x-show="modal.open" x-transition style="display:none;" @keydown.escape.window="modal.open=false">
        <div class="bo-modal" @click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
                <h3 style="margin:0;" x-text="modal.mode === 'add' ? 'Tambah Testimoni' : 'Edit Testimoni'"></h3>
                <button class="btn-icon" @click="modal.open=false"><span class="material-icons-round">close</span></button>
            </div>

            <div style="display:flex;align-items:flex-start;gap:20px;margin-bottom:18px;">
                <div>
                    <div style="width:80px;height:80px;border-radius:50%;overflow:hidden;background:#eee;cursor:pointer;position:relative;flex-shrink:0;"
                             @click="$store.imageUpload.open(url => { modal.form.foto = url })">
                            <img x-show="modal.form.foto" :src="modal.form.foto" style="width:100%;height:100%;object-fit:cover;">
                            <div x-show="!modal.form.foto" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;flex-direction:column;background:#fafafa;">
                                <span class="material-icons-round" style="font-size:24px;color:#ccc;">person</span>
                            </div>
                            <div style="position:absolute;inset:0;background:rgba(0,0,0,0.35);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity 0.2s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0">
                                <span class="material-icons-round" style="font-size:22px;color:#fff;">edit</span>
                            </div>
                        </div>
                    <div style="font-size:11px;color:#aaa;text-align:center;margin-top:6px;">Klik untuk<br>ganti foto</div>
                </div>
                <div style="flex:1;">
                    <div class="form-group">
                        <label class="bo-label">Nama Lengkap</label>
                        <input type="text" class="bo-input" x-model="modal.form.nama" placeholder="Nama alumnus/mitra industri">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Jabatan / Angkatan</label>
                        <input type="text" class="bo-input" x-model="modal.form.jabatan" placeholder="Contoh: Alumni 2018 Â· F&B Manager, Marriott Bali">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="bo-label">Isi Kutipan</label>
                <textarea class="bo-textarea" rows="4" x-model="modal.form.kutipan" placeholder="Tuliskan kutipan/testimoni yang inspiratif..."></textarea>
            </div>

            <hr class="divider">
            <div style="display:flex;gap:12px;justify-content:flex-end;">
                <button class="btn-secondary" @click="modal.open=false">Batal</button>
                <button class="btn-primary" @click="saveItem()">
                    <span class="material-icons-round" style="font-size:18px;">save</span>
                    <span x-text="modal.mode === 'add' ? 'Tambah Testimoni' : 'Simpan Perubahan'"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- Confirm Delete --}}
    <div class="bo-modal-backdrop" x-show="confirmDelete.open" x-transition style="display:none;">
        <div class="bo-modal" style="max-width:400px;" @click.stop>
            <div style="text-align:center;margin-bottom:20px;">
                <div style="width:56px;height:56px;border-radius:50%;background:rgba(225,0,1,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <span class="material-icons-round" style="font-size:28px;color:#E10001;">delete_forever</span>
                </div>
                <h3 style="margin:0 0 8px;">Hapus Testimoni?</h3>
                <p style="font-size:14px;color:#8A8478;margin:0;">Testimoni ini akan dihapus permanen.</p>
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
@endsection

@php
    $testimoniList = $testimonials->map(function($t) {
        return [
            'id'      => $t->id,
            'nama'    => $t->name,
            'jabatan' => trim(($t->position ?? '') . ($t->company ? ', ' . $t->company : '')),
            'kutipan' => $t->quote,
            'foto'    => $t->photo_url,
            'rating'  => $t->rating,
            'featured'=> (bool)$t->is_featured,
            'active'  => (bool)$t->is_active,
        ];
    })->values();
@endphp

@push('scripts')
<script>
function testimoniData() {
    return {
        search: '',
        items: @json($testimoniList),
        modal: { open:false, mode:'add', form:{}, editId:null },
        confirmDelete: { open:false, targetId:null },

        get filtered() {
            if (!this.search) return this.items;
            const q = this.search.toLowerCase();
            return this.items.filter(i => (i.nama||'').toLowerCase().includes(q) || (i.jabatan||'').toLowerCase().includes(q));
        },

        openModal(mode, item = null) {
            this.modal.mode = mode;
            this.modal.editId = item ? item.id : null;
            this.modal.form = item ? { ...item } : { nama:'', jabatan:'', kutipan:'', foto:null, rating:5, featured:false };
            this.modal.open = true;
        },
        saveItem() {
            if (!this.modal.form.nama.trim()) return alert('Nama tidak boleh kosong.');
            const fd = new FormData();
            fd.append('name',        this.modal.form.nama);
            fd.append('position',    this.modal.form.jabatan || '');
            fd.append('quote',       this.modal.form.kutipan || '');
            fd.append('rating',      this.modal.form.rating || 5);
            fd.append('is_featured', this.modal.form.featured ? '1' : '0');
            fd.append('_token',      '{{ csrf_token() }}');

            // Handle foto: convert base64 data URL to File if needed
            if (this.modal.form.foto) {
                if (this.modal.form.foto.startsWith('data:')) {
                    fd.append('photo', dataURLtoFile(this.modal.form.foto, 'foto.png'));
                } else {
                    fd.append('photo_url', this.modal.form.foto);
                }
            }

            const url = this.modal.mode === 'add'
                ? '/backoffice/testimoni/store'
                : `/backoffice/testimoni/${this.modal.editId}/update`;
            fetch(url, { method:'POST', body: fd })
                .then(r => r.ok ? location.reload() : alert('Gagal menyimpan.'));
        },
        deleteItem(id) { this.confirmDelete.targetId = id; this.confirmDelete.open = true; },
        confirmDeleteItem() {
            fetch(`/backoffice/testimoni/${this.confirmDelete.targetId}/delete`, {
                method:'POST',
                headers:{ 'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}' },
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

