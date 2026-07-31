@extends('backoffice.layouts.app')
@section('title', 'FAQ (Pertanyaan Umum)')
@section('page-title', 'FAQ (Pertanyaan Umum)')

@section('content')
<div x-data="faqData()">

    {{-- Toolbar --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <div style="display:flex;align-items:center;gap:10px;">
            <div class="bo-search">
                <span class="material-icons-round" style="font-size:18px;color:#8A8478;">search</span>
                <input type="text" placeholder="Cari pertanyaan..." x-model="search">
            </div>
            <select class="bo-select" style="width:auto;" x-model="filterKategori">
                <option value="">Semua Kategori</option>
                <option value="akademi">Akademi & Kurikulum</option>
                <option value="pendaftaran">Pendaftaran & Seleksi</option>
                <option value="biaya">Biaya & Pembayaran</option>
                <option value="kampus">Kehidupan Kampus</option>
                <option value="umum">Umum</option>
                <option value="karir">Karir</option>
            </select>
        </div>
        <button class="btn-primary" @click="openModal('add')">
            <span class="material-icons-round" style="font-size:18px;">add</span>
            Tambah Pertanyaan
        </button>
    </div>

    {{-- Table --}}
    <div class="bo-card" style="padding:0;overflow:hidden;">
        <table class="bo-table">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Pertanyaan</th>
                    <th>Kategori</th>
                    <th>Jawaban</th>
                    <th style="width:120px;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(item, idx) in filtered" :key="item.id">
                    <tr>
                        <td style="color:#8A8478;font-size:13px;" x-text="idx + 1"></td>
                        <td>
                            <div style="font-weight:700;color:#1a1a2e;" x-text="item.pertanyaan"></div>
                        </td>
                        <td><span class="badge badge-blue" x-text="formatCat(item.kategori)"></span></td>
                        <td style="max-width:320px;">
                            <div style="color:#555;font-size:13px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;" x-text="item.jawaban"></div>
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
                    <td colspan="5" style="text-align:center;color:#8A8478;padding:40px;">Tidak ada pertanyaan ditemukan.</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Modal Add/Edit --}}
    <div class="bo-modal-backdrop" x-show="modal.open" x-transition style="display:none;" @keydown.escape.window="modal.open=false">
        <div class="bo-modal wide" @click.stop style="max-width:640px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
                <h3 style="margin:0;" x-text="modal.mode === 'add' ? 'Tambah Pertanyaan FAQ' : 'Edit Pertanyaan FAQ'"></h3>
                <button class="btn-icon" @click="modal.open=false"><span class="material-icons-round">close</span></button>
            </div>

            <div class="form-group">
                <label class="bo-label">Pertanyaan</label>
                <input type="text" class="bo-input" x-model="modal.form.pertanyaan" placeholder="Contoh: Apakah ada jaminan kerja setelah lulus?">
            </div>

            <div class="form-group">
                <label class="bo-label">Kategori FAQ</label>
                <select class="bo-select" x-model="modal.form.kategori">
                    <option value="akademi">Akademi & Kurikulum</option>
                    <option value="pendaftaran">Pendaftaran & Seleksi</option>
                    <option value="biaya">Biaya & Pembayaran</option>
                    <option value="kampus">Kehidupan Kampus</option>
                    <option value="umum">Umum</option>
                    <option value="karir">Karir</option>
                </select>
            </div>

            <div class="form-group">
                <label class="bo-label">Jawaban</label>
                <div id="summernote-jawaban"></div>
            </div>

            <hr class="divider">
            <div style="display:flex;gap:12px;justify-content:flex-end;">
                <button class="btn-secondary" @click="modal.open=false">Batal</button>
                <button class="btn-primary" @click="saveItem()">
                    <span class="material-icons-round" style="font-size:18px;">save</span>
                    <span x-text="modal.mode === 'add' ? 'Simpan FAQ' : 'Simpan Perubahan'"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- Confirm Delete --}}
    <div class="bo-modal-backdrop" x-show="deleteConfirm.open" x-transition style="display:none;">
        <div class="bo-modal" style="max-width:400px;" @click.stop>
            <div style="text-align:center;margin-bottom:20px;">
                <div style="width:56px;height:56px;border-radius:50%;background:rgba(225,0,1,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <span class="material-icons-round" style="font-size:28px;color:#D4302A;">delete_forever</span>
                </div>
                <h3 style="margin:0 0 8px;">Hapus FAQ?</h3>
                <p style="font-size:14px;color:#8A8478;margin:0;">Pertanyaan ini akan dihapus dari halaman FAQ.</p>
            </div>
            <div style="display:flex;gap:12px;justify-content:center;">
                <button class="btn-secondary" @click="deleteConfirm.open=false">Batal</button>
                <button class="btn-danger" @click="confirmDeleteItem()">
                    <span class="material-icons-round" style="font-size:17px;">delete</span> Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@php
    $faqList = $faqs->map(function($f) {
        return [
            'id'         => $f->id,
            'pertanyaan' => $f->question,
            'jawaban'    => $f->answer,
            'kategori'   => $f->category,
            'active'     => (bool)$f->is_active,
        ];
    })->values();
@endphp

@push('scripts')
<script>
function faqData() {
    return {
        search: '',
        filterKategori: '',
        items: @json($faqList),
        modal: { open:false, mode:'add', form:{}, editId:null },
        deleteConfirm: { open:false, targetId:null },

        get filtered() {
            return this.items.filter(i => {
                const matchSearch = !this.search || (i.pertanyaan||'').toLowerCase().includes(this.search.toLowerCase()) || (i.jawaban||'').toLowerCase().includes(this.search.toLowerCase());
                const matchCat = !this.filterKategori || i.kategori === this.filterKategori;
                return matchSearch && matchCat;
            });
        },

        formatCat(cat) {
            const map = { akademi:'Akademi', pendaftaran:'Pendaftaran', biaya:'Biaya', kampus:'Kampus', umum:'Umum' };
            return map[cat] || cat;
        },

        openModal(mode, item = null) {
            this.modal.mode = mode;
            this.modal.editId = item ? item.id : null;
            this.modal.form = item ? { ...item } : { pertanyaan:'', kategori:'akademi', jawaban:'' };
            this.modal.open = true;

            setTimeout(() => {
                if ($('#summernote-jawaban').summernote) {
                    $('#summernote-jawaban').summernote('destroy');
                }
                $('#summernote-jawaban').summernote({
                    height: 200,
                    lang: 'id-ID',
                    placeholder: 'Tuliskan jawaban yang jelas dan rinci...',
                    toolbar: [
                        ['font', ['bold', 'italic', 'underline']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link']],
                    ]
                });
                if (item && item.jawaban) {
                    $('#summernote-jawaban').summernote('code', item.jawaban);
                }
            }, 300);
        },

        saveItem() {
            if (!this.modal.form.pertanyaan.trim()) return alert('Pertanyaan tidak boleh kosong.');
            const fd = new FormData();
            fd.append('question', this.modal.form.pertanyaan);
            fd.append('answer',   $('#summernote-jawaban').summernote('code') || '');
            fd.append('category', this.modal.form.kategori);
            fd.append('_token',   '{{ csrf_token() }}');

            const url = this.modal.mode === 'add'
                ? '/backoffice/faq/store'
                : `/backoffice/faq/${this.modal.editId}/update`;

            fetch(url, { method: 'POST', body: fd })
                .then(r => r.ok ? location.reload() : alert('Gagal menyimpan FAQ.'));
        },

        deleteItem(id) { this.deleteConfirm.targetId = id; this.deleteConfirm.open = true; },

        confirmDeleteItem() {
            fetch(`/backoffice/faq/${this.deleteConfirm.targetId}/delete`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ id: this.deleteConfirm.targetId })
            }).then(() => {
                this.items = this.items.filter(i => i.id !== this.deleteConfirm.targetId);
                this.deleteConfirm.open = false;
            });
        }
    };
}
</script>
@endpush

