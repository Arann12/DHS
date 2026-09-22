@extends('backoffice.layouts.app')
@section('title', 'Editor Program — ' . $program->title)
@section('page-title', 'Editor Konten Program: ' . $program->title)

@section('content')
<div x-data="programEditData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh konten program berhasil disimpan ke database.
    </div>

    {{-- Alert Error --}}
    <div x-show="errorMsg" x-transition style="display:none;background:#fee2e2;border:1.5px solid #fca5a5;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#991b1b;font-weight:600;font-size:14px;">
        <span class="material-icons-round">error</span> <span x-text="errorMsg"></span>
    </div>

    {{-- Top Action Bar --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <div>
            <a href="/backoffice/program" class="btn-secondary" style="padding:6px 12px;font-size:12.5px;margin-bottom:6px;display:inline-flex;align-items:center;gap:4px;text-decoration:none;">
                <span class="material-icons-round" style="font-size:16px;">arrow_back</span> Kembali ke Daftar Program
            </a>
            <h2 style="font-family:'Playfair Display',serif;font-size:22px;color:#0F2440;margin:4px 0 0;">{{ $program->title }}</h2>
        </div>
        <div style="display:flex;gap:10px;align-items:center;">
            <a href="/program/{{ $program->slug }}" target="_blank" class="btn-secondary" style="padding:9px 16px;font-size:13px;display:inline-flex;align-items:center;gap:6px;text-decoration:none;">
                <span class="material-icons-round" style="font-size:18px;">open_in_new</span> Lihat Website
            </a>
            <button type="button" class="btn-primary" style="padding:9px 22px;font-size:13px;" @click="save()" :disabled="saving">
                <span class="material-icons-round" x-text="saving ? 'hourglass_empty' : 'save'"></span>
                <span x-text="saving ? 'Menyimpan...' : 'Simpan Konten Program'"></span>
            </button>
        </div>
    </div>

    {{-- Tabs Navigation --}}
    <div style="display:flex;gap:8px;overflow-x:auto;padding-bottom:12px;margin-bottom:24px;border-bottom:1px solid #e5e7eb;scrollbar-width:none;">
        <template x-for="tab in tabs" :key="tab.id">
            <button type="button" @click="activeTab = tab.id"
                :class="activeTab === tab.id ? 'btn-primary' : 'btn-secondary'"
                style="padding:8px 16px;font-size:12.5px;white-space:nowrap;flex-shrink:0;display:inline-flex;align-items:center;gap:6px;">
                <span class="material-icons-round" style="font-size:16px;" x-text="tab.icon"></span>
                <span x-text="tab.label"></span>
            </button>
        </template>
    </div>

    {{-- ═══ TAB 1: INFORMASI UTAMA & HEADER ═══ --}}
    <div x-show="activeTab === 'info'">
        <div class="bo-card" style="max-width:900px;">
            <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 20px;">1. Informasi Utama & Pengaturan Hero</h3>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">
                <div style="grid-column:1/-1;">
                    <label class="bo-label">Judul Lengkap Program <span style="color:#C53030;">*</span></label>
                    <input type="text" class="bo-input" style="font-size:15px;font-weight:600;" x-model="form.title" placeholder="Contoh: Program 1 Tahun + Ausbildung Jerman">
                </div>

                <div>
                    <label class="bo-label">Kategori Program</label>
                    <select class="bo-input" x-model="form.category_id">
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="bo-label">Badge Negara / Spesialisasi (Tag)</label>
                    <input type="text" class="bo-input" x-model="form.country_badge" placeholder="Contoh: JERMAN / KAPAL PESIAR / BALI">
                </div>

                <div>
                    <label class="bo-label">Durasi Studi</label>
                    <input type="text" class="bo-input" x-model="form.duration" placeholder="Contoh: 2 Tahun / 1 Tahun / 6 Bulan">
                </div>

                <div>
                    <label class="bo-label">Estimasi Biaya Pendidikan (Opsional)</label>
                    <input type="text" class="bo-input" x-model="form.tuition_fee" placeholder="Contoh: Rp 12.000.000 / semester">
                </div>

                <div>
                    <label class="bo-label">Urutan Tampil (Display Order)</label>
                    <input type="number" class="bo-input" x-model="form.display_order" min="0" placeholder="0">
                </div>

                <div>
                    <label class="bo-label">URL Brosur / Prospektus (PDF/Link)</label>
                    <input type="text" class="bo-input" x-model="form.brochure_url" placeholder="https://... atau /uploads/...">
                </div>

                <div style="grid-column:1/-1;background:#fafafa;padding:16px;border-radius:12px;border:1.5px solid #eee;display:flex;gap:24px;flex-wrap:wrap;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13.5px;font-weight:600;color:#1F2937;">
                        <input type="checkbox" x-model="form.is_active" style="width:18px;height:18px;accent-color:#059669;">
                        <span>Program Aktif (Tampil di Website Publik)</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13.5px;font-weight:600;color:#1F2937;">
                        <input type="checkbox" x-model="form.is_featured" style="width:18px;height:18px;accent-color:#d97706;">
                        <span>Featured Program (Tampil di Beranda Utama)</span>
                    </label>
                </div>

                <div style="grid-column:1/-1;">
                    <label class="bo-label">Gambar Thumbnail & Background Hero Program</label>
                    <div style="display:flex;gap:12px;align-items:flex-start;">
                        <div style="width:180px;height:105px;border-radius:10px;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
                             @click="$store.imageUpload.open(url => { form.thumbnail_url = url }, 'program')">
                            <template x-if="form.thumbnail_url">
                                <img :src="form.thumbnail_url" style="width:100%;height:100%;object-fit:cover;">
                            </template>
                            <template x-if="!form.thumbnail_url">
                                <div style="text-align:center;color:#aaa;">
                                    <span class="material-icons-round" style="font-size:32px;display:block;">add_photo_alternate</span>
                                    <span style="font-size:11px;">Upload</span>
                                </div>
                            </template>
                        </div>
                        <div style="flex:1;">
                            <div style="display:flex;gap:8px;margin-bottom:8px;">
                                <button type="button" class="btn-secondary" style="font-size:12px;padding:7px 14px;display:inline-flex;align-items:center;gap:4px;"
                                        @click="$store.imageUpload.open(url => { form.thumbnail_url = url }, 'program')">
                                    <span class="material-icons-round" style="font-size:16px;">cloud_upload</span> Pilih / Upload Gambar
                                </button>
                                <button type="button" x-show="form.thumbnail_url" class="btn-danger" style="font-size:11px;padding:5px 10px;"
                                        @click="form.thumbnail_url = ''">
                                    <span class="material-icons-round" style="font-size:14px;">delete</span> Hapus
                                </button>
                            </div>
                            <input type="text" class="bo-input" x-model="form.thumbnail_url" placeholder="Atau paste URL gambar publik di sini" style="font-size:12px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ TAB 2: DESKRIPSI & PROFIL ═══ --}}
    <div x-show="activeTab === 'desc'">
        <div class="bo-card" style="max-width:900px;">
            <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 10px;">2. Deskripsi & Profil Program</h3>
            <p style="font-size:13px;color:#718096;margin:0 0 20px;">Teks ini ditampilkan pada Card Utama 'Deskripsi & Profil Program' di halaman detail.</p>

            <div class="form-group">
                <label class="bo-label">Deskripsi Lengkap Program</label>
                <textarea class="bo-textarea" rows="8" style="font-size:14px;line-height:1.6;" x-model="form.description"
                          placeholder="Jelaskan secara lengkap mengenai tujuan program, keunggulan lulusan, prospek kerja internasional, dan metode perkuliahan..."></textarea>
            </div>
        </div>
    </div>

    {{-- ═══ TAB 3: KURIKULUM & MATERI ═══ --}}
    <div x-show="activeTab === 'curriculum'">
        <div class="bo-card" style="max-width:900px;">
            <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 6px;">3. Materi & Kurikulum Pelatihan</h3>
            <p style="font-size:13px;color:#718096;margin:0 0 20px;">Daftar mata kuliah, modul praktek, dan kompetensi yang dipelajari selama masa studi. Setiap baris baru akan ditampilkan sebagai item tersendiri.</p>

            <div class="form-group">
                <label class="bo-label">Daftar Modul / Mata Kuliah</label>
                <textarea class="bo-textarea" rows="10" style="font-size:14px;line-height:1.7;font-family:inherit;" x-model="form.curriculum"
                          placeholder="Contoh:&#10;• Pengantar Industri Pariwisata & Perhotelan Modern&#10;• Operasional Dapur Profesional (Food Production & Culinary Art)&#10;• Food & Beverage Service & Mixology Bar&#10;• Housekeeping & Room Management Standar Internasional&#10;• Front Office Operation & Reservation System&#10;• Bahasa Asing Khusus Maritim & Hospitality (English & Deutsch)&#10;• On the Job Training (OJT) 6 Bulan di Hotel Bintang 5 / Kapal Pesiar"></textarea>
            </div>
        </div>
    </div>

    {{-- ═══ TAB 4: PERSYARATAN & FASILITAS ═══ --}}
    <div x-show="activeTab === 'requirements'">
        <div style="display:grid;gap:24px;max-width:900px;">
            
            {{-- Persyaratan --}}
            <div class="bo-card">
                <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 6px;">4A. Persyaratan Pendaftaran</h3>
                <p style="font-size:13px;color:#718096;margin:0 0 16px;">Kriteria dan dokumen kelengkapan calon peserta didik. Jika kosong, sistem otomatis menampilkan kriteria standar.</p>

                <div class="form-group" style="margin-bottom:0;">
                    <textarea class="bo-textarea" rows="8" style="font-size:14px;line-height:1.7;" x-model="form.requirements"
                              placeholder="Contoh:&#10;• Pria / Wanita, usia minimal 17 tahun&#10;• Lulusan SMA / SMK / MA / Kejar Paket C sederajat&#10;• Sehat jasmani & rohani serta bebas narkoba&#10;• Memiliki minat dan motivasi tinggi di bidang perhotelan&#10;• Menyerahkan fotokopi KTP, KK, Akta Kelahiran, Ijazah & Pas Foto terbaru"></textarea>
                </div>
            </div>

            {{-- Fasilitas --}}
            <div class="bo-card">
                <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 6px;">4B. Fasilitas & Sarana Pendukung</h3>
                <p style="font-size:13px;color:#718096;margin:0 0 16px;">Fasilitas laboratorium, bahan praktik, dan peralatan yang disediakan untuk program ini.</p>

                <div class="form-group" style="margin-bottom:0;">
                    <textarea class="bo-textarea" rows="6" style="font-size:14px;line-height:1.7;" x-model="form.facilities"
                              placeholder="Contoh:&#10;• Kitchen Laboratory lengkap berstandar hotel bintang 5&#10;• Bar & Restaurant Praktek Modern&#10;• Mock-up Hotel Suite Room & Front Office System&#10;• Free Seragam Praktek, Modul Pembelajaran & Bahan Lab"></textarea>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══ TAB 5: PREVIEW & ZONA BERBAHAYA ═══ --}}
    <div x-show="activeTab === 'preview'">
        <div class="bo-card" style="max-width:900px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
                <div>
                    <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">5. Ringkasan & Preview Program</h3>
                    <p style="font-size:13px;color:#718096;margin:0;">Preview ringkas tampilan data program yang tersimpan di sistem.</p>
                </div>
                <a href="/program/{{ $program->slug }}" target="_blank" class="btn-secondary" style="padding:8px 14px;font-size:12.5px;display:inline-flex;align-items:center;gap:6px;text-decoration:none;">
                    <span class="material-icons-round" style="font-size:16px;">open_in_new</span> Buka Halaman Asli di Website
                </a>
            </div>

            <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:16px;padding:24px;margin-bottom:24px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;flex-wrap:wrap;">
                    <span class="badge badge-blue" x-text="form.country_badge || 'PROGRAM DHS'"></span>
                    <span style="font-size:12px;color:#64748b;font-weight:600;" x-text="'Durasi: ' + (form.duration || 'Standar')"></span>
                    <template x-if="form.is_featured">
                        <span style="font-size:11px;background:#fef3c7;color:#92400e;padding:2px 8px;border-radius:9999px;font-weight:700;">★ Featured</span>
                    </template>
                </div>
                <h3 style="font-family:'Playfair Display',serif;font-size:22px;color:#0F2440;margin:0 0 12px;" x-text="form.title"></h3>
                <p style="font-size:13.5px;color:#475569;line-height:1.6;margin-bottom:16px;" x-text="form.description || 'Belum ada deskripsi.'"></p>

                <div style="border-top:1px solid #e2e8f0;padding-top:14px;display:flex;align-items:center;gap:12px;font-size:12px;color:#64748b;">
                    <span>URL Slug: <strong>/program/{{ $program->slug }}</strong></span>
                </div>
            </div>

            {{-- Danger Zone --}}
            <div style="padding:18px;background:#fff5f5;border-radius:14px;border:1.5px solid #fed7d7;">
                <h4 style="font-size:14px;font-weight:700;color:#991b1b;margin:0 0 6px;display:flex;align-items:center;gap:6px;">
                    <span class="material-icons-round" style="font-size:18px;">warning</span> Zona Berbahaya
                </h4>
                <p style="font-size:12.5px;color:#718096;margin:0 0 12px;">Menghapus program ini akan menghapusnya secara permanen dari basis data dan website.</p>
                <button type="button" class="btn-danger" style="font-size:13px;padding:8px 16px;" @click="delModal=true">
                    <span class="material-icons-round" style="font-size:16px;">delete_forever</span> Hapus Program Ini Permanen
                </button>
            </div>
        </div>
    </div>

    {{-- Global Save Footer --}}
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
        <button type="button" class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="save()" :disabled="saving">
            <span class="material-icons-round" style="font-size:20px;" x-text="saving ? 'hourglass_empty' : 'save'"></span>
            <span x-text="saving ? 'Menyimpan...' : 'Simpan Seluruh Konten Program'"></span>
        </button>
        <a href="/program/{{ $program->slug }}" target="_blank" class="btn-secondary" style="padding:12px 20px;font-size:13px;display:inline-flex;align-items:center;gap:6px;text-decoration:none;">
            <span class="material-icons-round" style="font-size:18px;">open_in_new</span>
            Lihat Halaman di Website Public
        </a>
    </div>

    {{-- Delete Confirm Modal --}}
    <div class="bo-modal-backdrop" x-show="delModal" x-transition style="display:none;" @keydown.escape.window="delModal=false">
        <div class="bo-modal" style="max-width:400px;" @click.stop>
            <div style="text-align:center;margin-bottom:20px;">
                <div style="width:56px;height:56px;border-radius:50%;background:rgba(197,48,48,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <span class="material-icons-round" style="font-size:28px;color:#C53030;">delete_forever</span>
                </div>
                <h3 style="margin:0 0 8px;font-family:'Playfair Display',serif;color:#0F2440;">Hapus Program?</h3>
                <p style="font-size:14px;color:#718096;margin:0;">Program <strong>{{ $program->title }}</strong> akan dihapus secara permanen.</p>
            </div>
            <div style="display:flex;gap:12px;justify-content:center;">
                <button type="button" class="btn-secondary" @click="delModal=false">Batal</button>
                <button type="button" class="btn-danger" @click="confirmDelete()">
                    <span class="material-icons-round" style="font-size:17px;">delete</span> Ya, Hapus
                </button>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function programEditData() {
    return {
        saved: false,
        saving: false,
        errorMsg: '',
        delModal: false,
        activeTab: 'info',
        tabs: [
            { id:'info',         label:'1. Informasi & Header', icon:'info' },
            { id:'desc',         label:'2. Deskripsi & Profil', icon:'article' },
            { id:'curriculum',   label:'3. Kurikulum & Materi', icon:'auto_stories' },
            { id:'requirements', label:'4. Persyaratan & Fasilitas', icon:'checklist' },
            { id:'preview',      label:'5. Preview Halaman',    icon:'visibility' }
        ],

        form: {
            title:         @json($program->title ?? ''),
            category_id:   @json((string)($program->category_id ?? '')),
            country_badge: @json($program->country_badge ?? ''),
            duration:      @json($program->duration ?? ''),
            tuition_fee:   @json($program->tuition_fee ?? ''),
            display_order: @json($program->display_order ?? 0),
            is_active:     @json((bool)$program->is_active),
            is_featured:   @json((bool)$program->is_featured),
            description:   @json($program->description ?? ''),
            curriculum:    @json($program->curriculum ?? ''),
            requirements:  @json($program->requirements ?? ''),
            facilities:    @json($program->facilities ?? ''),
            thumbnail_url: @json($program->thumbnail_url ?? ''),
            brochure_url:  @json($program->brochure_url ?? ''),
        },

        save() {
            if (this.saving) return;
            if (!this.form.title.trim()) {
                this.errorMsg = 'Judul program tidak boleh kosong.';
                setTimeout(() => this.errorMsg = '', 4000);
                return;
            }
            this.saving = true;
            this.errorMsg = '';
            fetch('/backoffice/program/{{ $program->id }}/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(this.form)
            })
            .then(r => r.json())
            .then(data => {
                this.saving = false;
                if (data.success !== false) {
                    this.saved = true;
                    setTimeout(() => this.saved = false, 3500);
                } else {
                    this.errorMsg = 'Gagal: ' + (data.message || JSON.stringify(data.errors || data));
                    setTimeout(() => this.errorMsg = '', 8000);
                }
            })
            .catch(() => {
                this.saving = false;
                this.errorMsg = 'Terjadi kesalahan jaringan.';
                setTimeout(() => this.errorMsg = '', 8000);
            });
        },

        confirmDelete() {
            this.delModal = false;
            fetch('/backoffice/program/{{ $program->id }}/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ id: {{ $program->id }} })
            })
            .then(() => { window.location.href = '/backoffice/program'; })
            .catch(() => { this.errorMsg = 'Gagal menghapus program.'; });
        }
    };
}
</script>
@endpush