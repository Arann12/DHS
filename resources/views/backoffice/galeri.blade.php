@extends('backoffice.layouts.app')
@section('title', 'Galeri')
@section('page-title', 'Galeri Foto')

@section('content')
<div x-data="galeriData()">

    {{-- Upload Bar --}}
    <div class="bo-card" style="margin-bottom:20px;">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;">
            <div>
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 4px;">Galeri Foto</h2>
                <p style="font-size:13px;color:#8A8478;margin:0;" x-text="'Total: ' + items.length + ' foto'"></p>
            </div>
            <div style="display:flex;gap:10px;align-items:center;">
                <label style="cursor:pointer;">
                    <div class="btn-primary">
                        <span class="material-icons-round" style="font-size:18px;">upload</span>
                        Upload Foto Baru
                    </div>
                    <input type="file" accept="image/*" multiple @change="handleUpload($event)" style="display:none;">
                </label>
            </div>
        </div>

        {{-- Upload Zone --}}
        <div style="margin-top:16px;border:2px dashed #e0e0e0;border-radius:14px;padding:32px;text-align:center;background:#fafafa;cursor:pointer;transition:border-color 0.2s;"
             @dragover.prevent="dragOver = true"
             @dragleave="dragOver = false"
             @drop.prevent="handleDrop($event)"
             :style="dragOver ? 'border-color:#0E06B4;background:#eef0ff;' : ''">
            <span class="material-icons-round" style="font-size:42px;color:#ccc;display:block;margin-bottom:8px;">cloud_upload</span>
            <div style="font-size:14px;color:#8A8478;">Drag & drop foto ke sini, atau klik tombol <strong>Upload</strong> di atas</div>
            <div style="font-size:12px;color:#bbb;margin-top:6px;">JPG, PNG, WebP — maks 5MB per foto</div>
        </div>
    </div>

    {{-- Grid --}}
    <div x-show="items.length > 0" style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;">
        <template x-for="(item, idx) in items" :key="item.id">
            <div style="border-radius:14px;overflow:hidden;background:#fff;box-shadow:0 2px 12px rgba(0,0,0,0.07);position:relative;group;" class="galeri-item">
                <div style="aspect-ratio:4/3;overflow:hidden;background:#eee;">
                    <img :src="item.src" style="width:100%;height:100%;object-fit:cover;transition:transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                </div>
                <div style="padding:10px 12px;display:flex;align-items:center;justify-content:space-between;">
                    <div style="font-size:12px;color:#8A8478;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:120px;" x-text="item.name"></div>
                    <div style="display:flex;gap:6px;">
                        <button class="btn-icon" style="width:28px;height:28px;" @click="moveUp(idx)" :disabled="idx === 0" title="Pindah ke atas" :style="idx === 0 ? 'opacity:0.3;' : ''">
                            <span class="material-icons-round" style="font-size:15px;">arrow_upward</span>
                        </button>
                        <button class="btn-icon" style="width:28px;height:28px;" @click="moveDown(idx)" :disabled="idx === items.length-1" title="Pindah ke bawah" :style="idx === items.length-1 ? 'opacity:0.3;' : ''">
                            <span class="material-icons-round" style="font-size:15px;">arrow_downward</span>
                        </button>
                        <button class="btn-icon danger" style="width:28px;height:28px;" @click="deleteItem(item.id)" title="Hapus foto">
                            <span class="material-icons-round" style="font-size:15px;">delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <div x-show="items.length === 0" class="bo-card" style="text-align:center;padding:60px;color:#8A8478;">
        <span class="material-icons-round" style="font-size:48px;color:#ddd;display:block;margin-bottom:12px;">photo_library</span>
        <div style="font-size:16px;font-weight:600;margin-bottom:6px;">Belum ada foto di galeri</div>
        <div style="font-size:13px;">Upload foto pertama Anda menggunakan tombol di atas.</div>
    </div>

    {{-- Confirm Delete --}}
    <div class="bo-modal-backdrop" x-show="confirmDelete.open" x-transition style="display:none;">
        <div class="bo-modal" style="max-width:400px;" @click.stop>
            <div style="text-align:center;margin-bottom:20px;">
                <div style="width:56px;height:56px;border-radius:50%;background:rgba(225,0,1,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <span class="material-icons-round" style="font-size:28px;color:#E10001;">delete_forever</span>
                </div>
                <h3 style="margin:0 0 8px;">Hapus Foto?</h3>
                <p style="font-size:14px;color:#8A8478;margin:0;">Foto akan dihapus dari galeri.</p>
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

@push('scripts')
<script>
function galeriData() {
    return {
        dragOver: false,
        items: @json($galleries->map(fn($g) => [
            'id'    => $g->id,
            'src'   => $g->image_url,
            'name'  => $g->title ?: 'Foto Kampus',
            'order' => $g->display_order,
        ])),
        confirmDelete: { open:false, targetId:null },

        handleUpload(e) {
            Array.from(e.target.files).forEach(file => this.uploadFile(file));
            e.target.value = '';
        },
        handleDrop(e) {
            this.dragOver = false;
            Array.from(e.dataTransfer.files).filter(f => f.type.startsWith('image/')).forEach(f => this.uploadFile(f));
        },
        uploadFile(file) {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('_token', '{{ csrf_token() }}');
            fetch('/backoffice/galeri/store', { method: 'POST', body: formData })
                .then(r => r.ok ? location.reload() : alert('Gagal mengunggah foto.'));
        },
        deleteItem(id) { this.confirmDelete.targetId = id; this.confirmDelete.open = true; },
        confirmDeleteItem() {
            fetch(`/backoffice/galeri/${this.confirmDelete.targetId}/delete`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ id: this.confirmDelete.targetId })
            }).then(() => {
                this.items = this.items.filter(i => i.id !== this.confirmDelete.targetId);
                this.confirmDelete.open = false;
            });
        },
        moveUp(idx) {
            if (idx === 0) return;
            [this.items[idx-1], this.items[idx]] = [this.items[idx], this.items[idx-1]];
            this.items = [...this.items];
        },
        moveDown(idx) {
            if (idx === this.items.length - 1) return;
            [this.items[idx], this.items[idx+1]] = [this.items[idx+1], this.items[idx]];
            this.items = [...this.items];
        }
    };
}
</script>
@endpush

