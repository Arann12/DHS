@extends('backoffice.layouts.app')
@section('title', 'Editor Halaman Dokumen — ' . $doc['title'])
@section('page-title', 'Editor Konten Halaman ' . $doc['title'])

@section('content')
<div x-data="dokumenEditData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh konten halaman sertifikasi berhasil disimpan ke database.
    </div>

    {{-- Top Action Bar --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <div>
            <a href="/backoffice/dokumen-sertifikasi" class="btn-secondary" style="padding:6px 12px;font-size:12.5px;margin-bottom:6px;display:inline-flex;">
                <span class="material-icons-round" style="font-size:16px;">arrow_back</span> Kembali ke Daftar Dokumen
            </a>
            <h2 style="font-family:'Playfair Display',serif;font-size:20px;color:#0F2440;margin:4px 0 0;">{{ $doc['title'] }}</h2>
        </div>
        <div style="display:flex;gap:10px;">
            <a href="/dokumen/{{ $type }}" target="_blank" class="btn-secondary" style="padding:9px 16px;font-size:13px;">
                <span class="material-icons-round" style="font-size:18px;">open_in_new</span> Lihat Website
            </a>
            <button type="button" class="btn-primary" style="padding:9px 20px;font-size:13px;" @click="saveDoc()" :disabled="saving">
                <span class="material-icons-round" x-text="saving ? 'hourglass_empty' : 'save'"></span>
                <span x-text="saving ? 'Menyimpan...' : 'Simpan Konten'"></span>
            </button>
        </div>
    </div>

    {{-- Tabs Navigation --}}
    <div style="display:flex;gap:8px;overflow-x:auto;padding-bottom:12px;margin-bottom:24px;border-bottom:1px solid #e5e7eb;scrollbar-width:none;">
        <template x-for="tab in tabs" :key="tab.id">
            <button type="button" @click="activeTab = tab.id"
                :class="activeTab === tab.id ? 'btn-primary' : 'btn-secondary'"
                style="padding:8px 14px;font-size:12.5px;white-space:nowrap;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:16px;" x-text="tab.icon"></span>
                <span x-text="tab.label"></span>
            </button>
        </template>
    </div>

    {{-- TAB 1: INFORMASI UTAMA --}}
    <div x-show="activeTab === 'info'">
        <div class="bo-card" style="max-width:850px;">
            <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 20px;">1. Informasi & Header Halaman</h3>
            
            <div class="bo-grid-2" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div style="grid-column:1/-1;">
                    <label class="bo-label">Judul Dokumen / Sertifikasi</label>
                    <input type="text" class="bo-input" x-model="doc.title">
                </div>
                <div>
                    <label class="bo-label">Badge Tag (Misal: Wajib STCW 2010)</label>
                    <input type="text" class="bo-input" x-model="doc.badge">
                </div>
                <div>
                    <label class="bo-label">Kategori Dokumen</label>
                    <input type="text" class="bo-input" x-model="doc.category">
                </div>
                <div>
                    <label class="bo-label">Peruntukan Kru / Pemohon</label>
                    <input type="text" class="bo-input" x-model="doc.peruntukan">
                </div>
                <div>
                    <label class="bo-label">Estimasi Waktu Proses</label>
                    <input type="text" class="bo-input" x-model="doc.waktu">
                </div>
                <div>
                    <label class="bo-label">Biaya / Jenis Layanan</label>
                    <input type="text" class="bo-input" x-model="doc.biaya">
                </div>
                <div style="grid-column:1/-1;">
                    <label class="bo-label">Nama Material Icon (Misal: anchor, card_travel, security)</label>
                    <input type="text" class="bo-input" x-model="doc.icon">
                </div>
                <div style="grid-column:1/-1;">
                    <label class="bo-label">Gambar Hero Background Halaman Dokumen</label>
                    <div style="display:flex;gap:10px;align-items:center;">
                        <input type="text" class="bo-input" style="padding:7px 10px;font-size:13px;" x-model="doc.hero_image" placeholder="URL Gambar / Klik tombol Pilih Gambar untuk upload (public/uploads/dokumen)">
                        <button type="button" class="btn-secondary" style="padding:7px 14px;font-size:12.5px;white-space:nowrap;display:flex;align-items:center;gap:4px;" @click="$store.imageUpload.open(url => doc.hero_image = url, 'dokumen')">
                            <span class="material-icons-round" style="font-size:16px;">cloud_upload</span> Pilih / Upload Gambar
                        </button>
                    </div>
                    <template x-if="doc.hero_image">
                        <div style="margin-top:8px;">
                            <img :src="doc.hero_image" style="max-height:110px;border-radius:8px;border:1px solid #ddd;">
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB 2: DESKRIPSI & KEUNGGULAN --}}
    <div x-show="activeTab === 'desc'">
        <div class="bo-card" style="max-width:850px;">
            <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 20px;">2. Deskripsi & Keunggulan Utama</h3>
            
            <div class="form-group" style="margin-bottom:24px;">
                <label class="bo-label">Deskripsi Lengkap Sertifikasi / Dokumen</label>
                <textarea class="bo-textarea" style="min-height:130px;font-size:13.5px;" x-model="doc.description"></textarea>
            </div>

            <div style="border-top:1px solid #eee;padding-top:20px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                    <div>
                        <h4 style="margin:0;font-size:15px;color:#0F2440;font-weight:700;">Keunggulan & Fitur Utama (Key Features)</h4>
                        <p style="font-size:12px;color:#718096;margin:2px 0 0;">Point keunggulan yang tampil dengan centang pada halaman public.</p>
                    </div>
                    <button type="button" class="btn-primary" style="padding:5px 12px;font-size:12px;" @click="doc.key_features.push('Keunggulan baru')">
                        <span class="material-icons-round" style="font-size:15px;">add</span> Tambah Point
                    </button>
                </div>

                <div style="display:grid;gap:10px;">
                    <template x-for="(feat, idx) in doc.key_features" :key="idx">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span class="material-icons-round" style="color:#16a34a;font-size:18px;">check_circle</span>
                            <input type="text" class="bo-input" style="padding:8px 12px;font-size:13px;" x-model="doc.key_features[idx]">
                            <button type="button" class="btn-icon danger" style="width:32px;height:32px;" @click="doc.key_features.splice(idx, 1)">
                                <span class="material-icons-round" style="font-size:16px;">close</span>
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB 3: PERSYARATAN & PROSEDUR --}}
    <div x-show="activeTab === 'requirements'">
        <div style="display:grid;gap:24px;max-width:900px;">
            
            {{-- Persyaratan --}}
            <div class="bo-card">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                    <div>
                        <h3 style="font-family:'Playfair Display',serif;font-size:17px;color:#0F2440;margin:0 0 4px;">3A. Persyaratan Berkas Dokumen</h3>
                        <p style="font-size:12px;color:#718096;margin:0;">Syarat-syarat yang harus disiapkan pemohon.</p>
                    </div>
                    <button type="button" class="btn-primary" style="padding:5px 12px;font-size:12px;" @click="doc.syarat.push('Persyaratan baru')">
                        <span class="material-icons-round" style="font-size:15px;">add</span> Tambah Syarat
                    </button>
                </div>

                <div style="display:grid;gap:10px;">
                    <template x-for="(syr, idx) in doc.syarat" :key="idx">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span style="font-size:12px;font-weight:700;color:#718096;width:24px;" x-text="idx + 1 + '.'"></span>
                            <input type="text" class="bo-input" style="padding:8px 12px;font-size:13px;" x-model="doc.syarat[idx]">
                            <button type="button" class="btn-icon danger" style="width:32px;height:32px;" @click="doc.syarat.splice(idx, 1)">
                                <span class="material-icons-round" style="font-size:16px;">close</span>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Prosedur --}}
            <div class="bo-card">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                    <div>
                        <h3 style="font-family:'Playfair Display',serif;font-size:17px;color:#0F2440;margin:0 0 4px;">3B. Tahapan Alur & Prosedur</h3>
                        <p style="font-size:12px;color:#718096;margin:0;">Langkah-langkah proses dari pendaftaran hingga penerbitan.</p>
                    </div>
                    <button type="button" class="btn-primary" style="padding:5px 12px;font-size:12px;" @click="doc.proses.push('Tahapan prosedur baru')">
                        <span class="material-icons-round" style="font-size:15px;">add</span> Tambah Tahapan
                    </button>
                </div>

                <div style="display:grid;gap:10px;">
                    <template x-for="(prs, idx) in doc.proses" :key="idx">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span style="font-size:12px;font-weight:700;color:#1A365D;width:24px;" x-text="'Langkah ' + (idx + 1)"></span>
                            <input type="text" class="bo-input" style="padding:8px 12px;font-size:13px;" x-model="doc.proses[idx]">
                            <button type="button" class="btn-icon danger" style="width:32px;height:32px;" @click="doc.proses.splice(idx, 1)">
                                <span class="material-icons-round" style="font-size:16px;">close</span>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

        </div>
    </div>

    {{-- TAB 4: FAQ HALAMAN --}}
    <div x-show="activeTab === 'faq'">
        <div class="bo-card" style="max-width:850px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <div>
                    <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">4. FAQ (Pertanyaan yang Sering Diajukan)</h3>
                    <p style="font-size:12.5px;color:#718096;margin:0;">Daftar pertanyaan dan jawaban khusus untuk dokumen sertifikasi ini.</p>
                </div>
                <button type="button" class="btn-primary" style="padding:6px 14px;font-size:12.5px;" @click="doc.faq.push({ q:'Pertanyaan baru?', a:'Jawaban resmi...' })">
                    <span class="material-icons-round" style="font-size:16px;">add</span> Tambah FAQ
                </button>
            </div>

            <div style="display:grid;gap:14px;">
                <template x-for="(fItem, idx) in doc.faq" :key="idx">
                    <div style="background:#fafafa;border:1.5px solid #eee;border-radius:12px;padding:16px;position:relative;">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
                            <span style="font-size:12px;font-weight:700;color:#1A365D;" x-text="'FAQ #' + (idx + 1)"></span>
                            <button type="button" class="btn-icon danger" style="width:28px;height:28px;" @click="doc.faq.splice(idx, 1)">
                                <span class="material-icons-round" style="font-size:15px;">close</span>
                            </button>
                        </div>
                        <div style="display:grid;gap:10px;">
                            <div>
                                <label class="bo-label" style="font-size:11px;">Pertanyaan (Q)</label>
                                <input type="text" class="bo-input" style="padding:8px 12px;font-weight:600;" x-model="fItem.q">
                            </div>
                            <div>
                                <label class="bo-label" style="font-size:11px;">Jawaban (A)</label>
                                <textarea class="bo-textarea" style="min-height:70px;padding:8px 12px;" x-model="fItem.a"></textarea>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- TAB 5: PREVIEW HALAMAN --}}
    <div x-show="activeTab === 'preview'">
        <div class="bo-card" style="max-width:850px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <div>
                    <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">5. Preview Konten Halaman</h3>
                    <p style="font-size:13px;color:#718096;margin:0;">Ringkasan tampilan informasi dokumen yang tersimpan di sistem.</p>
                </div>
                <a href="/dokumen/{{ $type }}" target="_blank" class="btn-secondary" style="padding:8px 14px;font-size:12.5px;">
                    <span class="material-icons-round" style="font-size:16px;">open_in_new</span> Buka Website Asli
                </a>
            </div>

            <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:14px;padding:24px;">
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
                    <span class="badge badge-blue" x-text="doc.badge"></span>
                    <span style="font-size:12px;color:#718096;" x-text="doc.category"></span>
                </div>
                <h3 style="font-family:'Playfair Display',serif;font-size:22px;color:#0F2440;margin:0 0 10px;" x-text="doc.title"></h3>
                <p style="font-size:13.5px;color:#475569;line-height:1.6;margin-bottom:20px;" x-text="doc.description"></p>

                <div style="margin-bottom:20px;">
                    <h4 style="font-size:13px;font-weight:700;color:#0F2440;margin:0 0 8px;">Keunggulan Utama:</h4>
                    <div style="display:grid;gap:6px;">
                        <template x-for="feat in doc.key_features" :key="feat">
                            <div style="font-size:12.5px;color:#334155;display:flex;align-items:center;gap:8px;">
                                <span class="material-icons-round" style="color:#16a34a;font-size:16px;">check_circle</span>
                                <span x-text="feat"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <div style="border-top:1px solid #e2e8f0;padding-top:16px;display:flex;gap:12px;">
                    <a href="/layanan?doc={{ $type }}" target="_blank" class="btn-primary">
                        Ajukan Dokumen Ini Online
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Global Save Footer --}}
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
        <button type="button" class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveDoc()" :disabled="saving">
            <span class="material-icons-round" style="font-size:20px;" x-text="saving ? 'hourglass_empty' : 'save'"></span>
            <span x-text="saving ? 'Menyimpan...' : 'Simpan Seluruh Konten Halaman'"></span>
        </button>
        <a href="/dokumen/{{ $type }}" target="_blank" class="btn-secondary" style="padding:12px 20px;font-size:13px;display:flex;align-items:center;gap:6px;text-decoration:none;">
            <span class="material-icons-round" style="font-size:18px;">open_in_new</span>
            Lihat Halaman di Website Public
        </a>
    </div>

</div>
@endsection

@push('scripts')
<script>
function dokumenEditData() {
    return {
        saved: false,
        saving: false,
        activeTab: 'info',
        tabs: [
            { id:'info',         label:'1. Informasi Utama',      icon:'info' },
            { id:'desc',         label:'2. Deskripsi & Keunggulan', icon:'article' },
            { id:'requirements', label:'3. Persyaratan & Prosedur', icon:'checklist' },
            { id:'faq',          label:'4. FAQ Halaman',          icon:'quiz' },
            { id:'preview',      label:'5. Preview Halaman',      icon:'visibility' }
        ],
        doc: @json($doc),

        saveDoc() {
            this.saving = true;

            fetch('/backoffice/dokumen-sertifikasi/{{ $type }}/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ doc: this.doc })
            })
            .then(res => res.json())
            .then(data => {
                this.saving = false;
                if (data.success) {
                    this.saved = true;
                    setTimeout(() => this.saved = false, 4000);
                } else {
                    alert('Gagal menyimpan konten dokumen.');
                }
            })
            .catch(() => {
                this.saving = false;
                alert('Terjadi kesalahan koneksi saat menyimpan.');
            });
        }
    };
}
</script>
@endpush
