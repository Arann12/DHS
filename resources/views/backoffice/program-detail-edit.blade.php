@extends('backoffice.layouts.app')
@section('title', 'Editor Halaman Detail — ' . ($doc['title'] ?? 'Program'))
@section('page-title', 'Editor Konten Halaman ' . ($doc['title'] ?? 'Program'))

@section('content')
<div x-data="programDetailEditData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh konten halaman program berhasil disimpan ke database.
    </div>

    {{-- Alert Error --}}
    <div x-show="errorMsg" x-transition style="display:none;background:#fee2e2;border:1.5px solid #fca5a5;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#991b1b;font-weight:600;font-size:14px;">
        <span class="material-icons-round">error</span> <span x-text="errorMsg"></span>
    </div>

    {{-- Top Action Bar --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <div>
            <a href="/backoffice/program-detail" class="btn-secondary" style="padding:6px 12px;font-size:12.5px;margin-bottom:6px;display:inline-flex;align-items:center;gap:4px;text-decoration:none;">
                <span class="material-icons-round" style="font-size:16px;">arrow_back</span> Kembali ke Daftar Program
            </a>
            <h2 style="font-family:'Playfair Display',serif;font-size:22px;color:#0F2440;margin:4px 0 0;">{{ $doc['title'] ?? $program->title }}</h2>
        </div>
        <div style="display:flex;gap:10px;align-items:center;">
            <a href="/program/{{ $slug }}" target="_blank" class="btn-secondary" style="padding:9px 16px;font-size:13px;display:inline-flex;align-items:center;gap:6px;text-decoration:none;">
                <span class="material-icons-round" style="font-size:18px;">open_in_new</span> Lihat Website
            </a>
            <button type="button" class="btn-primary" style="padding:9px 22px;font-size:13px;" @click="saveDoc()" :disabled="saving">
                <span class="material-icons-round" x-text="saving ? 'hourglass_empty' : 'save'"></span>
                <span x-text="saving ? 'Menyimpan...' : 'Simpan Konten Halaman'"></span>
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

    {{-- ═══ TAB 1: HEADER & SPESIFIKASI ═══ --}}
    <div x-show="activeTab === 'header'">
        <div class="bo-card" style="max-width:900px;">
            <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 20px;">1. Header, Hero Section & Quick Specs Bar</h3>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">
                <div style="grid-column:1/-1;">
                    <label class="bo-label">Judul Utama Program (H1)</label>
                    <input type="text" class="bo-input" style="font-size:15px;font-weight:600;" x-model="doc.title">
                </div>

                <div>
                    <label class="bo-label">Kategori Program (Badge Kiri)</label>
                    <input type="text" class="bo-input" x-model="doc.category" placeholder="Program Internasional / Vokasi 2 Tahun">
                </div>

                <div>
                    <label class="bo-label">Badge Negara / Tag (Badge Kanan)</label>
                    <input type="text" class="bo-input" x-model="doc.country_badge" placeholder="JERMAN / BALI / KAPAL PESIAR">
                </div>

                <div>
                    <label class="bo-label">Quick Specs: Durasi Studi</label>
                    <input type="text" class="bo-input" x-model="doc.duration" placeholder="2 Tahun / 1 Tahun / 6 Bulan">
                </div>

                <div>
                    <label class="bo-label">Quick Specs: Sertifikasi</label>
                    <input type="text" class="bo-input" x-model="doc.sertifikasi" placeholder="Resmi DHS & Industri">
                </div>

                <div>
                    <label class="bo-label">Quick Specs: Status Akreditasi</label>
                    <input type="text" class="bo-input" x-model="doc.status_akreditasi" placeholder="Terakreditasi / Resmi Kemnaker">
                </div>

                <div>
                    <label class="bo-label">Teks Tombol CTA Hero</label>
                    <input type="text" class="bo-input" x-model="doc.cta_text" placeholder="Daftar Program Ini Online">
                </div>

                <div>
                    <label class="bo-label">Estimasi Biaya Pendidikan (Opsional)</label>
                    <input type="text" class="bo-input" x-model="doc.tuition_fee" placeholder="Rp 12.000.000 / semester">
                </div>

                <div>
                    <label class="bo-label">URL Brosur / Prospektus (PDF/Link)</label>
                    <input type="text" class="bo-input" x-model="doc.brochure_url" placeholder="https://... atau /uploads/...">
                </div>

                <div style="grid-column:1/-1;">
                    <label class="bo-label">Gambar Hero Background & Thumbnail Program</label>
                    <div style="display:flex;gap:12px;align-items:flex-start;">
                        <div style="width:180px;height:105px;border-radius:10px;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
                             @click="$store.imageUpload.open(url => { doc.hero_image = url }, 'program')">
                            <template x-if="doc.hero_image">
                                <img :src="doc.hero_image" style="width:100%;height:100%;object-fit:cover;">
                            </template>
                            <template x-if="!doc.hero_image">
                                <div style="text-align:center;color:#aaa;">
                                    <span class="material-icons-round" style="font-size:32px;display:block;">add_photo_alternate</span>
                                    <span style="font-size:11px;">Upload</span>
                                </div>
                            </template>
                        </div>
                        <div style="flex:1;">
                            <div style="display:flex;gap:8px;margin-bottom:8px;">
                                <button type="button" class="btn-secondary" style="font-size:12px;padding:7px 14px;display:inline-flex;align-items:center;gap:4px;"
                                        @click="$store.imageUpload.open(url => { doc.hero_image = url }, 'program')">
                                    <span class="material-icons-round" style="font-size:16px;">cloud_upload</span> Pilih / Upload Gambar
                                </button>
                                <button type="button" x-show="doc.hero_image" class="btn-danger" style="font-size:11px;padding:5px 10px;"
                                        @click="doc.hero_image = ''">
                                    <span class="material-icons-round" style="font-size:14px;">delete</span> Hapus
                                </button>
                            </div>
                            <input type="text" class="bo-input" x-model="doc.hero_image" placeholder="Atau paste URL gambar publik di sini" style="font-size:12px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ TAB 2: DESKRIPSI & 4 AKTIVITAS ═══ --}}
    <div x-show="activeTab === 'activities'">
        <div style="display:grid;gap:24px;max-width:900px;">

            {{-- Card 1: Deskripsi & Profil --}}
            <div class="bo-card">
                <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 16px;">Card 1: Deskripsi & Profil Program</h3>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                    <div>
                        <label class="bo-label">Judul Card</label>
                        <input type="text" class="bo-input" x-model="doc.desc_title" placeholder="Deskripsi & Profil Program">
                    </div>
                    <div>
                        <label class="bo-label">Subjudul Card</label>
                        <input type="text" class="bo-input" x-model="doc.desc_subtitle" placeholder="Gambaran umum kurikulum dan fokus pembelajaran.">
                    </div>
                </div>

                <div class="form-group">
                    <label class="bo-label">Paragraf 1 (Gambaran Utama)</label>
                    <textarea class="bo-textarea" rows="4" style="font-size:13.5px;line-height:1.6;" x-model="doc.description" placeholder="Paragraf penjelasan pertama..."></textarea>
                </div>

                <div class="form-group" style="margin-bottom:0;">
                    <label class="bo-label">Paragraf 2 (Peluang Kerja & Kurikulum Global)</label>
                    <textarea class="bo-textarea" rows="3" style="font-size:13.5px;line-height:1.6;" x-model="doc.desc_p2" placeholder="Paragraf penjelasan kedua..."></textarea>
                </div>
            </div>

            {{-- Card 2: 4 Box Aktivitas & Kegiatan Pembelajaran --}}
            <div class="bo-card">
                <div style="margin-bottom:18px;">
                    <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">Card 2: Aktivitas & Kegiatan Pembelajaran (4 Box)</h3>
                    <p style="font-size:12.5px;color:#718096;margin:0;">Edit 4 kotak aktivitas pembelajaran yang tampil di bagian tengah halaman.</p>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
                    <div>
                        <label class="bo-label">Judul Card Aktivitas</label>
                        <input type="text" class="bo-input" x-model="doc.activities_title" placeholder="Aktivitas & Kegiatan Pembelajaran">
                    </div>
                    <div>
                        <label class="bo-label">Subjudul Card</label>
                        <input type="text" class="bo-input" x-model="doc.activities_subtitle" placeholder="Rincian kegiatan praktik dan pelatihan selama masa studi.">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <template x-for="(act, idx) in doc.activities" :key="idx">
                        <div style="background:#fafafa;border:1.5px solid #eee;border-radius:14px;padding:16px;">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <div :style="'width:34px;height:34px;border-radius:10px;background:' + (act.color || '#4f46e5') + ';display:flex;align-items:center;justify-content:center;color:#fff;'">
                                        <span class="material-icons-round" style="font-size:20px;" x-text="act.icon || 'science'"></span>
                                    </div>
                                    <span style="font-size:12.5px;font-weight:700;color:#0F2440;" x-text="'Box #' + (idx + 1)"></span>
                                </div>
                                <input type="color" x-model="act.color" style="width:28px;height:28px;border:none;border-radius:6px;cursor:pointer;" title="Pilih Warna Box">
                            </div>

                            <div style="display:grid;gap:10px;">
                                <div>
                                    <label class="bo-label" style="font-size:11px;">Material Icon (science, flight_takeoff, translate, record_voice_over)</label>
                                    <input type="text" class="bo-input" style="padding:6px 10px;font-size:12px;" x-model="act.icon">
                                </div>
                                <div>
                                    <label class="bo-label" style="font-size:11px;">Judul Aktivitas</label>
                                    <input type="text" class="bo-input" style="padding:6px 10px;font-size:13px;font-weight:700;" x-model="act.title">
                                </div>
                                <div>
                                    <label class="bo-label" style="font-size:11px;">Deskripsi Singkat</label>
                                    <textarea class="bo-textarea" style="min-height:55px;padding:6px 10px;font-size:12px;" x-model="act.desc"></textarea>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══ TAB 3: 5 MANFAAT & BENEFIT ═══ --}}
    <div x-show="activeTab === 'benefits'">
        <div class="bo-card" style="max-width:900px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
                <div>
                    <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">Card 3: Manfaat & Benefit yang Didapatkan</h3>
                    <p style="font-size:13px;color:#718096;margin:0;">Daftar keunggulan, sertifikat, jaminan penyaluran kerja, dan fasilitas yang didapat peserta.</p>
                </div>
                <button type="button" class="btn-primary" style="padding:6px 14px;font-size:12.5px;" @click="doc.benefits.push({ title:'Benefit Baru', desc:'Penjelasan keuntungan eksklusif...' })">
                    <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Poin Benefit
                </button>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
                <div>
                    <label class="bo-label">Judul Card Benefit</label>
                    <input type="text" class="bo-input" x-model="doc.benefits_title" placeholder="Manfaat & Benefit yang Didapatkan">
                </div>
                <div>
                    <label class="bo-label">Subjudul Card</label>
                    <input type="text" class="bo-input" x-model="doc.benefits_subtitle" placeholder="Keunggulan dan fasilitas eksklusif bagi setiap peserta program.">
                </div>
            </div>

            <div style="display:grid;gap:14px;">
                <template x-for="(ben, idx) in doc.benefits" :key="idx">
                    <div style="background:#fafafa;border:1.5px solid #eee;border-radius:14px;padding:16px;">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div style="width:24px;height:24px;border-radius:50%;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12px;">
                                    <span class="material-icons-round" style="font-size:15px;">check</span>
                                </div>
                                <span style="font-size:12.5px;font-weight:700;color:#0F2440;" x-text="'Poin Benefit #' + (idx + 1)"></span>
                            </div>
                            <button type="button" class="btn-icon danger" style="width:28px;height:28px;" @click="doc.benefits.splice(idx, 1)" title="Hapus Benefit">
                                <span class="material-icons-round" style="font-size:16px;">close</span>
                            </button>
                        </div>

                        <div style="display:grid;gap:10px;">
                            <div>
                                <label class="bo-label" style="font-size:11px;">Judul Benefit (Tebal)</label>
                                <input type="text" class="bo-input" style="padding:7px 12px;font-size:13px;font-weight:700;" x-model="ben.title" placeholder="Misal: Penyaluran Kerja & Kerjasama 50+ Hotel Bintang 5">
                            </div>
                            <div>
                                <label class="bo-label" style="font-size:11px;">Penjelasan / Detail Benefit</label>
                                <textarea class="bo-textarea" style="min-height:55px;padding:7px 12px;font-size:12.5px;" x-model="ben.desc" placeholder="Detail penjelasan keuntungan yang didapatkan peserta..."></textarea>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- ═══ TAB 4: KURIKULUM & PERSYARATAN ═══ --}}
    <div x-show="activeTab === 'curriculum'">
        <div style="display:grid;gap:24px;max-width:900px;">

            {{-- Card 4: Kurikulum --}}
            <div class="bo-card">
                <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 16px;">Card 4: Materi & Kurikulum Pelatihan</h3>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                    <div>
                        <label class="bo-label">Judul Card</label>
                        <input type="text" class="bo-input" x-model="doc.curriculum_title" placeholder="Materi & Kurikulum Pelatihan">
                    </div>
                    <div>
                        <label class="bo-label">Subjudul Card</label>
                        <input type="text" class="bo-input" x-model="doc.curriculum_subtitle" placeholder="Modul keahlian yang dipelajari selama masa studi.">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:0;">
                    <label class="bo-label">Daftar Modul & Materi (Setiap baris tampil sebagai poin tersendiri)</label>
                    <textarea class="bo-textarea" rows="8" style="font-size:13.5px;line-height:1.7;" x-model="doc.curriculum"
                              placeholder="• Pengantar Industri Pariwisata & Perhotelan Modern&#10;• Operasional Dapur Profesional&#10;• Food & Beverage Service & Mixology Bar&#10;• Housekeeping & Room Management Standar Internasional&#10;• Front Office Operation & Reservation System&#10;• Bahasa Asing Khusus Maritim & Hospitality (English & Deutsch)&#10;• On the Job Training (OJT) 6 Bulan"></textarea>
                </div>
            </div>

            {{-- Card 5: Persyaratan Pendaftaran --}}
            <div class="bo-card">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:12px;">
                    <div>
                        <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">Card 5: Persyaratan Pendaftaran</h3>
                        <p style="font-size:12.5px;color:#718096;margin:0;">Syarat administrasi dan kriteria calon pendaftar.</p>
                    </div>
                    <button type="button" class="btn-primary" style="padding:5px 12px;font-size:12px;" @click="doc.requirements.push('Persyaratan baru...')">
                        <span class="material-icons-round" style="font-size:15px;">add</span> Tambah Syarat
                    </button>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                    <div>
                        <label class="bo-label">Judul Card</label>
                        <input type="text" class="bo-input" x-model="doc.requirements_title" placeholder="Persyaratan Pendaftaran">
                    </div>
                    <div>
                        <label class="bo-label">Subjudul Card</label>
                        <input type="text" class="bo-input" x-model="doc.requirements_subtitle" placeholder="Kelengkapan administrasi dan kriteria calon peserta.">
                    </div>
                </div>

                <div style="display:grid;gap:10px;">
                    <template x-for="(req, idx) in doc.requirements" :key="idx">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span class="material-icons-round" style="color:#059669;font-size:18px;">check_circle</span>
                            <input type="text" class="bo-input" style="padding:8px 12px;font-size:13px;" x-model="doc.requirements[idx]">
                            <button type="button" class="btn-icon danger" style="width:32px;height:32px;" @click="doc.requirements.splice(idx, 1)">
                                <span class="material-icons-round" style="font-size:16px;">close</span>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Card 6: Fasilitas --}}
            <div class="bo-card">
                <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 16px;">Card 6: Fasilitas & Sarana Pendukung</h3>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="bo-label">Fasilitas Laboratorium & Sarana Kampus</label>
                    <textarea class="bo-textarea" rows="5" style="font-size:13.5px;line-height:1.7;" x-model="doc.facilities"
                              placeholder="• Kitchen Laboratory lengkap berstandar hotel bintang 5&#10;• Bar & Restaurant Praktek Modern&#10;• Mock-up Hotel Suite Room & Front Office System&#10;• Free Seragam Praktek, Modul Pembelajaran & Bahan Lab"></textarea>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══ TAB 5: SIDEBAR & PREVIEW ═══ --}}
    <div x-show="activeTab === 'sidebar'">
        <div style="display:grid;gap:24px;max-width:900px;">

            {{-- Pengaturan Sidebar --}}
            <div class="bo-card">
                <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 18px;">Pengaturan Sidebar Kanan (Pendaftaran & Helpdesk)</h3>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                    <div>
                        <label class="bo-label">Label Status Gelombang</label>
                        <input type="text" class="bo-input" x-model="doc.sidebar_gelombang" placeholder="Pendaftaran Gelombang Baru">
                    </div>
                    <div>
                        <label class="bo-label">Subjudul Kuota</label>
                        <input type="text" class="bo-input" x-model="doc.sidebar_kuota" placeholder="Kuota terbatas untuk setiap gelombang pelatihan.">
                    </div>
                    <div>
                        <label class="bo-label">Nomor Telepon Kampus</label>
                        <input type="text" class="bo-input" x-model="doc.sidebar_phone" placeholder="(0361) 222-123">
                    </div>
                    <div>
                        <label class="bo-label">Nomor WhatsApp Admisi</label>
                        <input type="text" class="bo-input" x-model="doc.sidebar_wa" placeholder="+62 81 246 319966">
                    </div>
                </div>

                <div style="background:#0F2440;color:#fff;border-radius:12px;padding:16px;">
                    <div style="font-size:13px;font-weight:700;color:#fcd34d;margin-bottom:10px;">Box Kontak Admisi Gelap</div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:10px;">
                        <div>
                            <label class="bo-label" style="color:#cbd5e1;font-size:11px;">Judul Box Helpdesk</label>
                            <input type="text" class="bo-input" style="background:rgba(255,255,255,0.1);color:#fff;border-color:rgba(255,255,255,0.2);" x-model="doc.sidebar_helpdesk_title">
                        </div>
                        <div>
                            <label class="bo-label" style="color:#cbd5e1;font-size:11px;">Subjudul Helpdesk</label>
                            <input type="text" class="bo-input" style="background:rgba(255,255,255,0.1);color:#fff;border-color:rgba(255,255,255,0.2);" x-model="doc.sidebar_helpdesk_sub">
                        </div>
                    </div>
                    <div>
                        <label class="bo-label" style="color:#cbd5e1;font-size:11px;">Teks Penjelasan Helpdesk</label>
                        <textarea class="bo-textarea" rows="2" style="background:rgba(255,255,255,0.1);color:#fff;border-color:rgba(255,255,255,0.2);font-size:12px;" x-model="doc.sidebar_helpdesk_desc"></textarea>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Preview --}}
            <div class="bo-card">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                    <div>
                        <h3 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 4px;">Live Preview Ringkas</h3>
                        <p style="font-size:13px;color:#718096;margin:0;">Ringkasan tampilan halaman yang tersimpan.</p>
                    </div>
                    <a href="/program/{{ $slug }}" target="_blank" class="btn-secondary" style="padding:8px 14px;font-size:12.5px;display:inline-flex;align-items:center;gap:6px;text-decoration:none;">
                        <span class="material-icons-round" style="font-size:16px;">open_in_new</span> Buka Website
                    </a>
                </div>

                <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:14px;padding:20px;">
                    <div style="display:flex;gap:10px;align-items:center;margin-bottom:10px;">
                        <span class="badge badge-blue" x-text="doc.category"></span>
                        <span style="font-size:11px;font-weight:700;background:#0F2440;color:#fff;padding:2px 8px;border-radius:6px;" x-text="doc.country_badge"></span>
                    </div>
                    <h3 style="font-family:'Playfair Display',serif;font-size:20px;color:#0F2440;margin:0 0 8px;" x-text="doc.title"></h3>
                    <p style="font-size:13px;color:#475569;line-height:1.6;margin-bottom:12px;" x-text="doc.description"></p>
                    <div style="font-size:11.5px;color:#64748b;">
                        Durasi: <strong x-text="doc.duration"></strong> | Sertifikasi: <strong x-text="doc.sertifikasi"></strong> | Status: <strong x-text="doc.status_akreditasi"></strong>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Global Save Footer --}}
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
        <button type="button" class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveDoc()" :disabled="saving">
            <span class="material-icons-round" style="font-size:20px;" x-text="saving ? 'hourglass_empty' : 'save'"></span>
            <span x-text="saving ? 'Menyimpan...' : 'Simpan Seluruh Konten Halaman Program'"></span>
        </button>
        <a href="/program/{{ $slug }}" target="_blank" class="btn-secondary" style="padding:12px 20px;font-size:13px;display:inline-flex;align-items:center;gap:6px;text-decoration:none;">
            <span class="material-icons-round" style="font-size:18px;">open_in_new</span>
            Lihat Halaman di Website Public
        </a>
    </div>

</div>
@endsection

@push('scripts')
<script>
function programDetailEditData() {
    return {
        saved: false,
        saving: false,
        errorMsg: '',
        activeTab: 'header',
        tabs: [
            { id:'header',      label:'1. Header & Spesifikasi',  icon:'info' },
            { id:'activities',  label:'2. Deskripsi & 4 Aktivitas', icon:'sports_score' },
            { id:'benefits',    label:'3. 5 Manfaat & Benefit',    icon:'card_giftcard' },
            { id:'curriculum',  label:'4. Kurikulum & Syarat',     icon:'auto_stories' },
            { id:'sidebar',     label:'5. Sidebar & Preview',      icon:'tune' }
        ],

        doc: @json($doc),

        saveDoc() {
            if (this.saving) return;
            this.saving = true;
            this.errorMsg = '';

            fetch('/backoffice/program-detail/{{ $slug }}/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
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
                    this.errorMsg = 'Gagal menyimpan: ' + (data.message || 'Terjadi kesalahan.');
                    setTimeout(() => this.errorMsg = '', 8000);
                }
            })
            .catch(() => {
                this.saving = false;
                this.errorMsg = 'Terjadi kesalahan koneksi saat menyimpan.';
                setTimeout(() => this.errorMsg = '', 8000);
            });
        }
    };
}
</script>
@endpush