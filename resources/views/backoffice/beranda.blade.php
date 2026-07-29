@extends('backoffice.layouts.app')
@section('title', 'Editor Halaman Home')
@section('page-title', 'Editor Lengkap Halaman Home / Beranda')

@section('content')
<div x-data="berandaCompleteData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh perubahan Halaman Home berhasil disimpan.
    </div>

    {{-- Section Navigation Tabs --}}
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

    {{-- TAB 1: HERO SECTION --}}
    <div x-show="activeTab === 'hero'">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;align-items:start;">
            <div style="display:flex;flex-direction:column;gap:20px;">
                <div class="bo-card">
                    <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">1. Hero Section</h2>

                    <div class="form-group">
                        <label class="bo-label">Label Atas (Overline)</label>
                        <input type="text" class="bo-input" x-model="hero.overline">
                    </div>
                    <div class="form-group">
                        <label class="bo-label">Headline Utama (H1)</label>
                        <textarea class="bo-textarea" rows="2" x-model="hero.headline"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="bo-label">Teks Petunjuk Scroll</label>
                        <input type="text" class="bo-input" x-model="hero.scrollText">
                    </div>
                </div>

                <div class="bo-card">
                    <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">Tombol Action (CTA)</h2>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="bo-label">Teks Tombol 1</label>
                            <input type="text" class="bo-input" x-model="hero.cta1Text">
                        </div>
                        <div class="form-group">
                            <label class="bo-label">Link Tombol 1</label>
                            <input type="text" class="bo-input" x-model="hero.cta1Link">
                        </div>
                        <div class="form-group">
                            <label class="bo-label">Teks Tombol 2</label>
                            <input type="text" class="bo-input" x-model="hero.cta2Text">
                        </div>
                        <div class="form-group">
                            <label class="bo-label">Link Tombol 2</label>
                            <input type="text" class="bo-input" x-model="hero.cta2Link">
                        </div>
                    </div>
                </div>

                <div class="bo-card">
                    <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">Gambar Latar Hero</h2>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Gambar Latar</label>
                        <div style="display:flex;align-items:flex-start;gap:14px;">
                            <div style="width:140px;height:90px;border-radius:10px;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
                                 @click="$store.imageUpload.open(url => { hero.image = url })">
                                <template x-if="hero.image">
                                    <img :src="hero.image" style="width:100%;height:100%;object-fit:cover;">
                                </template>
                                <template x-if="!hero.image">
                                    <span class="material-icons-round" style="color:#aaa;font-size:30px;">add_photo_alternate</span>
                                </template>
                            </div>
                            <div>
                                <button type="button" class="btn-secondary" style="font-size:12px;padding:7px 14px;"
                                        @click="$store.imageUpload.open(url => { hero.image = url })">
                                    <span class="material-icons-round" style="font-size:16px;vertical-align:middle;">edit</span> Ganti Gambar
                                </button>
                                <button type="button" x-show="hero.image" class="btn-danger" style="font-size:11px;padding:5px 10px;margin-top:6px;"
                                        @click="hero.image = ''">
                                    <span class="material-icons-round" style="font-size:13px;">delete</span> Hapus
                                </button>
                                <div style="font-size:11px;color:#aaa;margin-top:6px;">JPG, PNG, WebP — URL atau upload</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Preview Hero --}}
            <div class="bo-card" style="position:sticky;top:88px;">
                <h3 style="font-family:'Playfair Display',serif;font-size:16px;color:#2B2494;margin:0 0 16px;">Preview Hero Section</h3>
                <div style="border-radius:14px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.15);background:#2B2494;color:#fff;padding:28px;text-align:center;position:relative;">
                    <div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;opacity:0.8;margin-bottom:12px;" x-text="hero.overline"></div>
                    <div style="font-family:'Playfair Display',serif;font-size:22px;font-weight:700;line-height:1.3;margin-bottom:20px;" x-text="hero.headline"></div>
                    <div style="display:flex;gap:10px;justify-content:center;">
                        <div style="padding:10px 18px;background:#0010B8;color:#fff;border-radius:6px;font-size:11px;font-weight:700;" x-text="hero.cta1Text"></div>
                        <div style="padding:10px 18px;background:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.4);color:#fff;border-radius:6px;font-size:11px;font-weight:700;" x-text="hero.cta2Text"></div>
                    </div>
                    <div style="font-size:10px;opacity:0.6;margin-top:20px;" x-text="hero.scrollText"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB 2: SEKILAS DHS --}}
    <div x-show="activeTab === 'about'">
        <div class="bo-card" style="max-width:800px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">2. Section Sekilas DHS (About Intro)</h2>

            <div class="form-group">
                <label class="bo-label">Label Sekilas DHS</label>
                <input type="text" class="bo-input" x-model="about.label">
            </div>
            <div class="form-group">
                <label class="bo-label">Judul Utama (H2)</label>
                <input type="text" class="bo-input" x-model="about.headline">
            </div>
            <div class="form-group">
                <label class="bo-label">Paragraf 1</label>
                <textarea class="bo-textarea" rows="3" x-model="about.p1"></textarea>
            </div>
            <div class="form-group">
                <label class="bo-label">Paragraf 2</label>
                <textarea class="bo-textarea" rows="3" x-model="about.p2"></textarea>
            </div>
            <div class="form-group">
                <label class="bo-label">Teks Catatan Bawah</label>
                <input type="text" class="bo-input" x-model="about.note">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="bo-label">Gambar Samping</label>
                <div style="display:flex;align-items:flex-start;gap:14px;">
                    <div style="width:120px;height:80px;border-radius:10px;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
                         @click="$store.imageUpload.open(url => { about.image = url })">
                        <template x-if="about.image">
                            <img :src="about.image" style="width:100%;height:100%;object-fit:cover;">
                        </template>
                        <template x-if="!about.image">
                            <span class="material-icons-round" style="color:#aaa;font-size:28px;">add_photo_alternate</span>
                        </template>
                    </div>
                    <div>
                        <button type="button" class="btn-secondary" style="font-size:12px;padding:7px 14px;"
                                @click="$store.imageUpload.open(url => { about.image = url })">
                            <span class="material-icons-round" style="font-size:16px;vertical-align:middle;">edit</span> Ganti Gambar
                        </button>
                        <button type="button" x-show="about.image" class="btn-danger" style="font-size:11px;padding:5px 10px;margin-top:6px;"
                                @click="about.image = ''">
                            <span class="material-icons-round" style="font-size:13px;">delete</span> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB 3: STANDAR VISIONER --}}
    <div x-show="activeTab === 'vision'">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
            <div style="display:flex;flex-direction:column;gap:20px;">
                <div class="bo-card">
                    <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Judul Section & Visi</h2>
                    <div class="form-group">
                        <label class="bo-label">Judul Section</label>
                        <input type="text" class="bo-input" x-model="vision.sectionTitle">
                    </div>
                    <div class="form-group">
                        <label class="bo-label">Label Visi</label>
                        <input type="text" class="bo-input" x-model="vision.visiLabel">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Teks Visi</label>
                        <textarea class="bo-textarea" rows="3" x-model="vision.visiText"></textarea>
                    </div>
                </div>

                <div class="bo-card">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                        <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0;">Poin-poin Misi</h2>
                        <button class="btn-primary" style="padding:6px 12px;font-size:12px;" @click="vision.misiItems.push('')">
                            <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Item
                        </button>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        <template x-for="(m, idx) in vision.misiItems" :key="idx">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <input type="text" class="bo-input" x-model="vision.misiItems[idx]">
                                <button class="btn-icon danger" style="width:30px;height:30px;" @click="vision.misiItems.splice(idx,1)">
                                    <span class="material-icons-round" style="font-size:16px;">close</span>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Core Values (4 Kartu)</h2>
                <div style="display:flex;flex-direction:column;gap:14px;">
                    <template x-for="(val, idx) in vision.coreValues" :key="idx">
                        <div style="padding:14px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;">
                            <div style="display:grid;grid-template-columns:120px 1fr;gap:10px;margin-bottom:8px;">
                                <input type="text" class="bo-input" style="padding:6px 8px;" x-model="val.icon" placeholder="Icon name">
                                <input type="text" class="bo-input" style="padding:6px 8px;font-weight:700;" x-model="val.title" placeholder="Judul">
                            </div>
                            <textarea class="bo-textarea" style="min-height:50px;padding:6px 8px;" x-model="val.desc" placeholder="Deskripsi"></textarea>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB 4: KEHIDUPAN KAMPUS --}}
    <div x-show="activeTab === 'campus'">
        <div class="bo-card" style="max-width:800px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">4. Section Kehidupan & Lingkungan Kampus</h2>
            <div class="form-group">
                <label class="bo-label">Judul Section</label>
                <input type="text" class="bo-input" x-model="campus.title">
            </div>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
                <template x-for="(foto, idx) in campus.fotos" :key="idx">
                    <div style="padding:12px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;">
                        <div style="font-size:12px;font-weight:700;color:#2B2494;margin-bottom:6px;" x-text="'Foto ' + (idx+1)"></div>
                        <div style="width:100%;height:70px;border-radius:8px;overflow:hidden;border:1.5px dashed #d1d5db;margin-bottom:8px;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fff;"
                             @click="$store.imageUpload.open(url => { campus.fotos[idx].src = url })">
                            <template x-if="foto.src">
                                <img :src="foto.src" style="width:100%;height:100%;object-fit:cover;">
                            </template>
                            <template x-if="!foto.src">
                                <span class="material-icons-round" style="color:#bbb;font-size:22px;">image</span>
                            </template>
                        </div>
                        <div style="display:flex;gap:6px;margin-bottom:8px;">
                            <button type="button" class="btn-secondary" style="font-size:11px;padding:4px 10px;flex:1;"
                                    @click="$store.imageUpload.open(url => { campus.fotos[idx].src = url })">
                                <span class="material-icons-round" style="font-size:14px;vertical-align:middle;">edit</span> Ganti
                            </button>
                            <button type="button" x-show="foto.src" class="btn-danger" style="font-size:11px;padding:4px 8px;"
                                    @click="foto.src = ''">
                                <span class="material-icons-round" style="font-size:13px;">delete</span>
                            </button>
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label" style="font-size:11px;">Alt Text</label>
                            <input type="text" class="bo-input" style="font-size:12px;padding:6px;" x-model="foto.alt">
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- TAB 5: AKADEMI UNGGULAN (3 CARDS) --}}
    <div x-show="activeTab === 'academy'">
        <div class="bo-card" style="max-width:900px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">5. Section Akademi Unggulan (3 Card Disciplines)</h2>
            <div class="form-grid-2" style="margin-bottom:20px;">
                <div class="form-group">
                    <label class="bo-label">Label Section</label>
                    <input type="text" class="bo-input" x-model="academy.label">
                </div>
                <div class="form-group">
                    <label class="bo-label">Judul Section (H2)</label>
                    <input type="text" class="bo-input" x-model="academy.headline">
                </div>
            </div>

            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
                <template x-for="(card, idx) in academy.cards" :key="idx">
                    <div style="padding:14px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;">
                        <div style="font-weight:700;color:#2B2494;margin-bottom:8px;" x-text="'Card ' + (idx+1)"></div>
                        <div class="form-group">
                            <label class="bo-label" style="font-size:11px;">Judul Program</label>
                            <input type="text" class="bo-input" style="padding:6px;font-weight:600;" x-model="card.title">
                        </div>
                        <div class="form-group">
                            <label class="bo-label" style="font-size:11px;">Deskripsi Singkat</label>
                            <textarea class="bo-textarea" style="min-height:60px;padding:6px;" x-model="card.desc"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="bo-label" style="font-size:11px;">Gambar Card</label>
                            <div style="display:flex;align-items:flex-start;gap:10px;">
                                <div style="width:80px;height:50px;border-radius:8px;overflow:hidden;border:1.5px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fff;"
                                     @click="$store.imageUpload.open(url => { academy.cards[idx].image = url })">
                                    <template x-if="card.image">
                                        <img :src="card.image" style="width:100%;height:100%;object-fit:cover;">
                                    </template>
                                    <template x-if="!card.image">
                                        <span class="material-icons-round" style="color:#bbb;font-size:18px;">image</span>
                                    </template>
                                </div>
                                <button type="button" class="btn-secondary" style="font-size:11px;padding:4px 10px;"
                                        @click="$store.imageUpload.open(url => { academy.cards[idx].image = url })">
                                    Ganti
                                </button>
                                <button type="button" x-show="card.image" class="btn-danger" style="font-size:11px;padding:4px 8px;"
                                        @click="card.image = ''">
                                    <span class="material-icons-round" style="font-size:13px;">delete</span>
                                </button>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label" style="font-size:11px;">Link Filter</label>
                            <input type="text" class="bo-input" style="padding:6px;" x-model="card.link">
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- TAB 6: FASILITAS KELAS DUNIA --}}
    <div x-show="activeTab === 'facilities'">
        <div class="bo-card" style="max-width:800px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">6. Section Fasilitas Kelas Dunia</h2>
            <div class="form-group">
                <label class="bo-label">Judul Section</label>
                <input type="text" class="bo-input" x-model="facilities.title">
            </div>

            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
                <template x-for="(fac, idx) in facilities.items" :key="idx">
                    <div style="padding:14px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;">
                        <div class="form-group">
                            <label class="bo-label" style="font-size:11px;">Label Fasilitas</label>
                            <input type="text" class="bo-input" style="padding:6px;font-weight:600;" x-model="fac.label">
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label" style="font-size:11px;">Gambar</label>
                            <div style="display:flex;align-items:flex-start;gap:10px;">
                                <div style="width:80px;height:50px;border-radius:8px;overflow:hidden;border:1.5px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fff;"
                                     @click="$store.imageUpload.open(url => { facilities.items[idx].image = url })">
                                    <template x-if="fac.image">
                                        <img :src="fac.image" style="width:100%;height:100%;object-fit:cover;">
                                    </template>
                                    <template x-if="!fac.image">
                                        <span class="material-icons-round" style="color:#bbb;font-size:18px;">image</span>
                                    </template>
                                </div>
                                <button type="button" class="btn-secondary" style="font-size:11px;padding:4px 10px;"
                                        @click="$store.imageUpload.open(url => { facilities.items[idx].image = url })">
                                    Ganti
                                </button>
                                <button type="button" x-show="fac.image" class="btn-danger" style="font-size:11px;padding:4px 8px;"
                                        @click="fac.image = ''">
                                    <span class="material-icons-round" style="font-size:13px;">delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- TAB 7: PESAN DIREKTUR --}}
    <div x-show="activeTab === 'director'">
        <div class="bo-card" style="max-width:700px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">7. Section Pesan Direktur</h2>
            <div class="form-group">
                <label class="bo-label">Label Overline</label>
                <input type="text" class="bo-input" x-model="director.label">
            </div>
            <div class="form-group">
                <label class="bo-label">Isi Pesan / Sambutan Direktur</label>
                <textarea class="bo-textarea" rows="6" x-model="director.message"></textarea>
            </div>
            <div class="form-group">
                <label class="bo-label">Nama Lengkap & Gelar Direktur</label>
                <input type="text" class="bo-input" x-model="director.name">
            </div>
            <div class="form-group">
                <label class="bo-label">Jabatan & Subtitle</label>
                <input type="text" class="bo-input" x-model="director.title">
            </div>
        </div>
    </div>

    {{-- TAB 8: BERITA & ARTIKEL (WAWASAN) --}}
    <div x-show="activeTab === 'news'">
        <div class="bo-card" style="max-width:850px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">8. Section Berita & Artikel (Wawasan)</h2>
            <div class="form-grid-2" style="margin-bottom:20px;">
                <div class="form-group">
                    <label class="bo-label">Label Overline</label>
                    <input type="text" class="bo-input" x-model="news.label">
                </div>
                <div class="form-group">
                    <label class="bo-label">Judul Section (H2)</label>
                    <input type="text" class="bo-input" x-model="news.title">
                </div>
            </div>

            <h3 style="font-size:14px;font-weight:700;color:#2B2494;margin-bottom:10px;">Artikel Utama (Featured)</h3>
            <div style="padding:14px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;margin-bottom:20px;">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="bo-label" style="font-size:11px;">Kategori</label>
                        <input type="text" class="bo-input" style="padding:6px;" x-model="news.featured.category">
                    </div>
                    <div class="form-group">
                        <label class="bo-label" style="font-size:11px;">Tanggal</label>
                        <input type="text" class="bo-input" style="padding:6px;" x-model="news.featured.date">
                    </div>
                </div>
                <div class="form-group">
                    <label class="bo-label" style="font-size:11px;">Judul Artikel Utama</label>
                    <input type="text" class="bo-input" style="padding:6px;font-weight:600;" x-model="news.featured.title">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="bo-label" style="font-size:11px;">Ringkasan / Excerpt</label>
                    <textarea class="bo-textarea" style="min-height:50px;padding:6px;" x-model="news.featured.excerpt"></textarea>
                </div>
            </div>

            <h3 style="font-size:14px;font-weight:700;color:#2B2494;margin-bottom:10px;">3 Artikel Samping</h3>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;">
                <template x-for="(art, idx) in news.smallArticles" :key="idx">
                    <div style="padding:12px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;">
                        <div class="form-group">
                            <label class="bo-label" style="font-size:11px;">Kategori</label>
                            <input type="text" class="bo-input" style="padding:5px;" x-model="art.category">
                        </div>
                        <div class="form-group">
                            <label class="bo-label" style="font-size:11px;">Judul</label>
                            <input type="text" class="bo-input" style="padding:5px;font-weight:600;" x-model="art.title">
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label" style="font-size:11px;">Tanggal</label>
                            <input type="text" class="bo-input" style="padding:5px;" x-model="art.date">
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- TAB 9: PARTNERSHIP PROGRAM (PP DHS) --}}
    <div x-show="activeTab === 'partners'">
        <div class="bo-card" style="max-width:800px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">9. Section Partnership Program (PP DHS)</h2>
            <div class="form-group">
                <label class="bo-label">Label Overline</label>
                <input type="text" class="bo-input" x-model="partner.label">
            </div>
            <div class="form-group">
                <label class="bo-label">Judul Section (H2)</label>
                <input type="text" class="bo-input" x-model="partner.title">
            </div>
            <div class="form-group">
                <label class="bo-label">Deskripsi Kemitraan Global</label>
                <textarea class="bo-textarea" rows="4" x-model="partner.desc"></textarea>
            </div>
        </div>
    </div>

    {{-- TAB 10: KONTAK & LOKASI KAMPUS --}}
    <div x-show="activeTab === 'contact'">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Kampus Denpasar</h2>
                <div class="form-group">
                    <label class="bo-label">Alamat Lengkap</label>
                    <textarea class="bo-textarea" rows="2" x-model="contact.denpasar.address"></textarea>
                </div>
                <div class="form-group">
                    <label class="bo-label">No. WhatsApp</label>
                    <input type="text" class="bo-input" x-model="contact.denpasar.wa">
                </div>
                <div class="form-group">
                    <label class="bo-label">Email Support</label>
                    <input type="text" class="bo-input" x-model="contact.denpasar.email">
                </div>
            </div>

            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Kampus Klungkung</h2>
                <div class="form-group">
                    <label class="bo-label">Alamat Lengkap</label>
                    <textarea class="bo-textarea" rows="2" x-model="contact.klungkung.address"></textarea>
                </div>
                <div class="form-group">
                    <label class="bo-label">Telepon</label>
                    <input type="text" class="bo-input" x-model="contact.klungkung.phone">
                </div>
                <div class="form-group">
                    <label class="bo-label">No. WhatsApp</label>
                    <input type="text" class="bo-input" x-model="contact.klungkung.wa">
                </div>
            </div>

            <div class="bo-card" style="grid-column:1/-1;">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Link Portal & Petunjuk Arah</h2>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="bo-label">Linktree URL</label>
                        <input type="text" class="bo-input" x-model="contact.links.linktree">
                    </div>

                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="bo-label">Google Maps — URL Embed Iframe</label>
                        <input type="text" class="bo-input" x-model="contact.links.googleMaps"
                               placeholder="https://www.google.com/maps/embed?pb=..."
                               @input="mapsPreviewKey++">
                        <p style="font-size:12px;color:#8A8478;margin-top:6px;line-height:1.6;">
                            💡 <strong>Cara mendapatkan URL embed:</strong>
                            Buka <a href="https://maps.google.com" target="_blank" style="color:#2B2494;">Google Maps</a>
                            → cari lokasi DHS → klik ikon <strong>Share</strong> 🔗
                            → pilih tab <strong>"Embed a map"</strong>
                            → klik <strong>"COPY HTML"</strong>
                            → ambil hanya bagian <code style="background:#f3f4f6;padding:1px 4px;border-radius:3px;">src="..."</code> dari kode iframe tersebut.
                        </p>
                        {{-- Live Preview --}}
                        <div style="margin-top:12px;border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;" x-show="contact.links.googleMaps">
                            <p style="font-size:11px;font-weight:600;color:#6b7280;padding:6px 10px;background:#f9fafb;margin:0;border-bottom:1px solid #e5e7eb;">PREVIEW PETA</p>
                            <template x-if="contact.links.googleMaps">
                                <iframe
                                    :src="contact.links.googleMaps"
                                    width="100%" height="300" style="border:0;display:block;"
                                    allowfullscreen loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </template>
                        </div>
                    </div>

                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="bo-label">Google Maps Directions URL <span style="font-weight:400;color:#8A8478;">(untuk tombol Petunjuk Arah)</span></label>
                        <input type="text" class="bo-input" x-model="contact.links.googleMapsDir"
                               placeholder="https://maps.google.com/?q=Denpasar+Hotel+School">
                        <p style="font-size:12px;color:#8A8478;margin-top:4px;">URL biasa dari Google Maps (bukan embed) — dipakai untuk tombol "Petunjuk Arah" yang membuka Maps di tab baru.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Save Button Global --}}
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;">
        <button class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveAll()" :disabled="saving">
            <span class="material-icons-round" style="font-size:20px;" x-text="saving ? 'hourglass_empty' : 'save'"></span>
            <span x-text="saving ? 'Menyimpan...' : 'Simpan Seluruh Perubahan Halaman Home'"></span>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
function berandaCompleteData() {
    return {
        saved: false,
        saving: false,
        activeTab: 'hero',
        tabs: [
            { id:'hero',       label:'1. Hero Section',       icon:'wallpaper' },
            { id:'about',      label:'2. Sekilas DHS',        icon:'auto_stories' },
            { id:'vision',     label:'3. Standar Visioner',   icon:'stars' },
            { id:'campus',     label:'4. Kehidupan Kampus',   icon:'photo_library' },
            { id:'academy',    label:'5. Akademi Unggulan',   icon:'school' },
            { id:'facilities', label:'6. Fasilitas Dunia',    icon:'apartment' },
            { id:'director',   label:'7. Pesan Direktur',     icon:'record_voice_over' },
            { id:'news',       label:'8. Berita & Artikel',   icon:'article' },
            { id:'partners',   label:'9. Kemitraan PP DHS',   icon:'handshake' },
            { id:'contact',    label:'10. Kontak & Lokasi',   icon:'place' },
        ],
        hero: {
            overline: 'DENPASAR HOTEL SCHOOL — PUSAT PELATIHAN VOKASI INTERNASIONAL DI BALI',
            headline: 'Membentuk Masa Depan Perhotelan Global',
            cta1Text: 'JELAJAHI PROGRAM',
            cta1Link: '/akademi',
            cta2Text: 'DAFTAR SEKARANG',
            cta2Link: '/cara-mendaftar',
            scrollText: 'Geser Untuk Scroll',
            image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBaJKFYExsjON0pHP43rfmOAIqTkD_R2sTlmKK5Y3CMDGPSja6oJ9DR5erhpkcJFaGwf8hwJZD58ClcpjuTPYEL5LyfjSjhB-t-AumWxxUO-avGgwTwc2wPhoyV6tw23si9SHWgb-5qyJtdTi6WaHdheSZI6A0nWVeXVQ69zkjhtBFvmGPvNvIy5vgQ3-jvlnbQ4bpVLKjjmedqgkXlfk0i_oXHtaIcsJSv5idQg1RZWqqLN8RrwIF70A'
        },
        about: {
            label: 'SEKILAS DHS',
            headline: 'Transformasi Menuju Unggul.',
            p1: 'Denpasar Hotel School (DHS) adalah lembaga pendidikan dan pelatihan bidang perhotelan yang mengusung pendidikan luar negeri dengan mengintegrasikan lembaga pendidikan dan pelatihan dengan dunia industri. DHS bernaung di bawah Yayasan Guna Widya Paramesthi.',
            p2: 'Lembaga ini didirikan untuk memberi kesempatan generasi muda Indonesia menjadi tenaga profesional bidang perhotelan, hospitality, kapal pesiar dan pariwisata, serta belajar sambil bekerja di luar negeri.',
            note: 'Mencetak SDM pariwisata yang unggul, kompeten, dan siap bersaing di tingkat global.',
            image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuA5jkBzd0EqrT-cphGIkzHYDH2a7dpxzv95e4cWzjIaFRYe8B3poCp2NncsdrneEW_ldLWrzvbO4JcdyzzGiQ-Mvb33B6kEHzU80DleUBPVkvlrCikONCi2W8yS5aMmee0S50iv_AYi1wUI-pnY1lPSKs2H7rnAXGxAPLvpZ9j5QBG9pWjHTb3FiXnNHZa6j5uJnKPdjulHepAKqk6Eb1zivof6CfMQt0IRObJoQROAn60P6jzRyfcrAQ'
        },
        vision: {
            sectionTitle: 'Standar Visioner.',
            visiLabel: 'VISI',
            visiText: 'Mentransformasi lulusan SMA, SMK, dan sederajat menjadi tenaga profesional di bidang perhotelan dan pariwisata yang mau dan mampu bersaing di tingkat global.',
            misiItems: [
                'Melaksanakan program pendidikan inovatif sesuai kebutuhan industri.',
                'Mengembangkan sumberdaya pendidikan dan pelatihan secara profesional.',
                'Memberikan kesempatan mahasiswa untuk belajar sambil bekerja di Australia, Jerman dan Asia Tenggara.'
            ],
            coreValues: [
                { icon:'verified',   title:'Integritas',     desc:'Membentuk insan pariwisata yang kompeten dan berdaya saing tinggi.' },
                { icon:'fact_check', title:'Tanggung Jawab', desc:'Menghasilkan lulusan yang sesuai kriteria dunia kerja masa depan.' },
                { icon:'star',       title:'Kualitas',        desc:'Berfokus pada penyediaan solusi dan kualitas pembelajaran terbaik.' },
                { icon:'public',     title:'Global Network',  desc:'Kesempatan kerja & belajar di Australia, Jerman & Asia Tenggara.' }
            ]
        },
        campus: {
            title: 'Kehidupan & Lingkungan Kampus',
            fotos: [
                { src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCbRFStu23zaKKqIJeoNTPdSOcPof73N6z-I-QsGizCu594Eha4Mz0SejvG2hnF6yR68hPeN7xD_S1jEZRkzyCBrs8vDdvREWF-3OAPOgH3qHLgtcUvnZe8Rn1IBJAWejpEp4WOENNj0cc7gOgDOekzGxeBw1_w1YoCEDF65kipejrZCRT_xlGbzjwQUJm4_CNr8F3jauVVHFX03WogUy7RZO30XkuqCSw4mJEZ3cNqvzP0L5HyEQTniA', alt: 'Siswa dalam seragam' },
                { src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDTY_0q-eeJ-lg9SUN09cLtSeVQR488pa_Xwag_o53lQzWT6mJR5WZs7yr6XbePzFxR3qxgiFvrEoNRgTdBGXSDDjwndYp88gIFAbcxGsNUdAZhXNledP3kFKkUXRYQkqkNW-yjqNZuHAtYEw1dMPKqJnAeTZFdyzrZPK3Opj_kuWb_k7Th8YmDJkdeDzKN1uwEyWzuDzSZ-ONuUd0TRqQTctN_cqSFal0SCwZhd6WmrTA8-CwwcCNwoQ', alt: 'Kolam Resort Simulasi' },
                { src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDV0lh3gGKxkEZoxy7owBdHzRVEZvkTUx_cLcTOGAorH2W5Hlj93QcVs4ZTcVZhy6ReTblju-pImR6huMYYKK3Ht_2BydhaglchgK_UjAw6j0_cBbtChI08T9-9SrN4y7LPA0hvtQx8P7Ro6tEHZJwQYTY1SK15KI-kaVZnE7hYSv9HI7UerrDb0fPLXglYz0YNzfv5YcT60EHMmhqSQ4yMT6QGwO7ZAyM-JwghKblh8sWSOMmwJGfTKA', alt: 'Praktikum Dapur Chef' }
            ]
        },
        academy: {
            label: 'AKADEMI UNGGULAN',
            headline: 'Disiplin & Pelatihan Profesional Kami',
            cards: [
                { title: 'Program Internasional', desc: 'Pendidikan luar negeri berpartner dengan TAFE Australia & The Hotel School, serta Ausbildung Jerman.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDXptvnod1HxEn1Bx6IezKWRBCwkykUPMcRW74guW5_55XXUaalkhFqPnoliMwG70kGUvZe7BZdcexnivnWW1-lK7WedS10yZF0nB7J_ZTIXnug_xa2_b0l7ZH3uXNLTJROPIqkEBqhJapvitg8WQoVxzwTyJuSq4r3rcPwfmvU8uPENXrzHnh0AbgLiOgwmys8JVmMCyf7XQYs5X0T0iaZxtDoi7jQJeSzDcGZwmF17aEOKwCkODnBOQ', link: '/akademi?filter=internasional' },
                { title: 'Vokasi 2 Tahun', desc: 'Jurusan Culinary Arts, Perhotelan, & F&B Service dengan jaminan OJT hotel bintang 4 & 5.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAxW5mY_zGD0HDOuwOrmrluxFe62YYnMPXOVLSqWRlgjb2vMXfJRycIhaY-CD9oObxiUpXDfsNqINeygV8X8D-cGXIgF1TsGf1oTPgW6_TY1GU8KeHFIgeVZgBDZxo-77h1BWpzJ4Z6JQaflVOHy1jq3aT80-6ua894112IvlKWSK8uWYLygVc8fO53xwVQEVcu7Od_VANVKjmstsZjgZrBxMmHgC8V-HwKbyyG_7PWWcGVDbWh2uLnNw', link: '/akademi?filter=2-tahun' },
                { title: 'Program Eksekutif', desc: 'Program singkat 6 bulan kapal pesiar (Cook, Steward, Bartender) dengan bonus gratis paspor & seaman book.', image: '/image/Kapal.jpg', link: '/akademi?filter=eksekutif' }
            ]
        },
        facilities: {
            title: 'FASILITAS KELAS DUNIA',
            items: [
                { label: 'DAPUR INDUSTRI', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAuTCak20mOeB9LQyn2XonJILtYY9k6DyYGKEQ_2nztbxQWXwrVPOL29MgalMVIKCAW04dx_vIrTJCd_XfZmfX9_9hbLrXB0cPP_Z2UsA4IYQswE7_qtBrSAXUCYqMucBYQEqjuiG38mvQaMG5r26TUh-29dvwJ_34-CjtOGQkO16jk6q2OBqzcfV9-nc_yifBoKLwOk3ZQgc4Y8cMYrRz7pnjfbDsJcv_KI3heB7aNsCudsGWesMK0CA' },
                { label: 'KAMAR SUITE SIMULASI', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCyOX_hVvTkAG09wnSm_vRW8D4osAWduBcFAjzCZ1wV4i4GPLit9wTP_i2XtVSYgamC--GK74WFus4JzhyZYBIq4uQo7edkXb7qbkbYZSD7tyTMmm-avYEYkfxEHRv3d-UVeXaNEwoeW8jpXjQnhYk1Ixp0oGDWNB4GRjOVwWJw9-VOBMkmWx-HYymiZmpE5WXj8wKO1j_zVtxaJ0IuVTJ7-kam2tSORas5a52dmUAOG2LK1tpKCHpOFg' },
                { label: 'BAR PELATIHAN', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDA-3TVgjqn3rAEEMHDMk4BdnH6XnDlEPUP2Nc_9LrVXk3EsldakTpUoLH42IgL4tS_sVrXfm3KbpdvDhxRTcJUyVrKQmhaPn_BBDJ0FQiIz9SJi62qfc9pDjuHpvzqiMNxJPWxI8ctpmx-Bz4jTY1IKMeJRtHAnb_9GJQUvK8bEsDw0ux1S4BVwNd1eC9utAz77RQgpUE8mrqmszl64keLmdWPNOJCyYE2gv5BmNUXFWMpsee-QQJ53A' }
            ]
        },
        director: {
            label: 'PESAN DIREKTUR',
            message: 'Halo sahabat excellent, Denpasar Hotel School hadir dengan sebuah komitmen untuk mengantarkan calon profesional muda menjadi SDM Indonesia yang unggul dan kompeten. Di Denpasar Hotel School, Anda akan dilatih oleh para praktisi yang telah berpengalaman di bidangnya masing-masing. Mari bergabung bersama kami, Denpasar Hotel School, kami siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global.',
            name: 'I Made Dwija Suastana, S.H., M.H.',
            title: 'DIREKTUR DENPASAR HOTEL SCHOOL — SALAM EXCELLENT!'
        },
        news: {
            label: 'WAWASAN',
            title: 'Berita & Artikel.',
            featured: {
                category: 'KEGIATAN',
                date: '12 SEP 2024',
                title: 'Kemitraan DHS dengan Kapal Pesiar Mewah 2026',
                excerpt: 'Denpasar Hotel School mengumumkan kemitraan eksklusif dengan tiga perusahaan kapal pesiar global...'
            },
            smallArticles: [
                { category: 'LOKAKARYA', date: '25 AGU 2024', title: 'Masterclass Kuliner bersama Chef Michelin' },
                { category: 'KARIER', date: '15 AGU 2024', title: 'Lulusan Memimpin Resort Butik di Asia' },
                { category: 'KEBERLANJUTAN', date: '05 AGU 2024', title: 'Inisiatif Kampus Hospitality Berkelanjutan' }
            ]
        },
        partner: {
            label: 'Kemitraan & Jaringan Global',
            title: 'Partnership Program (PP DHS)',
            desc: 'DHS berkomitmen penuh untuk mengintegrasikan pendidikan vokasi dengan dunia industri global. Program ini menjamin penempatan magang internasional (OJT) berkualitas dan penyaluran kerja langsung di hotel bintang 4 & 5 serta kapal pesiar mewah tanpa potongan agen fee (Zero Agent Fee).'
        },
        contact: {
            denpasar: {
                address: 'Jl. Sari Dana IV No. 1 Gatsu Barat, Denpasar 80116, Bali',
                wa: '+62 81 246 319966',
                email: 'sahabat@dhs.or.id'
            },
            klungkung: {
                address: 'Jl. Raya Takmung No. 36, Klungkung 80752, Bali',
                phone: '+0366 5582998',
                wa: '+62 81 337 106480'
            },
@php
    $contactSection = isset($sections['contact'])
        ? (is_array($sections['contact']->section_content)
            ? $sections['contact']->section_content
            : json_decode($sections['contact']->section_content ?? '{}', true))
        : [];
@endphp
            links: {
                linktree: '{{ addslashes($contactSection['linktree'] ?? 'https://linktr.ee/BiayaPendidikan_DHS') }}',
                googleMaps: '{{ addslashes($contactSection['google_maps'] ?? '') }}',
                googleMapsDir: '{{ addslashes($contactSection['google_maps_dir'] ?? 'https://maps.google.com/?q=Denpasar+Hotel+School') }}',
            }
        },
        saveAll() {
            if (this.saving) return;
            this.saving = true;
            const sections = {
                hero: {
                    title: 'Hero Section',
                    content: {
                        overline: this.hero.overline,
                        headline: this.hero.headline,
                        cta1_text: this.hero.cta1Text,
                        cta1_link: this.hero.cta1Link,
                        cta2_text: this.hero.cta2Text,
                        cta2_link: this.hero.cta2Link,
                        scroll_text: this.hero.scrollText,
                        background_image: this.hero.image
                    }
                },
                about: {
                    title: 'Sekilas DHS',
                    content: {
                        label: this.about.label,
                        headline: this.about.headline,
                        paragraph1: this.about.p1,
                        paragraph2: this.about.p2,
                        note: this.about.note,
                        image: this.about.image
                    }
                },
                vision: {
                    title: 'Visi & Misi',
                    content: {
                        sectionTitle: this.vision.sectionTitle,
                        visiLabel: this.vision.visiLabel,
                        vision_text: this.vision.visiText,
                        misiLabel: 'MISI',
                        misiItems: this.vision.misiItems,
                        coreValues: this.vision.coreValues
                    }
                },
                campus: {
                    title: 'Kehidupan Kampus',
                    content: { title: this.campus.title, fotos: this.campus.fotos }
                },
                academy: {
                    title: 'Akademi Unggulan',
                    content: { label: this.academy.label, headline: this.academy.headline, cards: this.academy.cards }
                },
                facilities: {
                    title: 'Fasilitas Kelas Dunia',
                    content: { title: this.facilities.title, items: this.facilities.items }
                },
                director: {
                    title: 'Pesan Direktur',
                    content: { label: this.director.label, message: this.director.message, name: this.director.name, title: this.director.title }
                },
                news: {
                    title: 'Berita & Artikel',
                    content: { label: this.news.label, title: this.news.title, featured: this.news.featured, smallArticles: this.news.smallArticles }
                },
                partner: {
                    title: 'Partnership Program',
                    content: { label: this.partner.label, title: this.partner.title, desc: this.partner.desc }
                },
                contact: {
                    title: 'Kontak & Lokasi',
                    content: {
                        denpasar_address: this.contact.denpasar.address,
                        denpasar_wa: this.contact.denpasar.wa,
                        denpasar_email: this.contact.denpasar.email,
                        klungkung_address: this.contact.klungkung.address,
                        klungkung_phone: this.contact.klungkung.phone,
                        klungkung_wa: this.contact.klungkung.wa,
                        linktree: this.contact.links.linktree,
                        google_maps: this.contact.links.googleMaps,
                        google_maps_dir: this.contact.links.googleMapsDir,
                    }
                }
            };
            const token = document.querySelector('meta[name="csrf-token"]').content;
            fetch('/backoffice/beranda/update', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ sections })
            })
            .then(r => r.json())
            .then(data => {
                this.saving = false;
                if (data.success) { this.saved = true; setTimeout(() => this.saved = false, 3500); }
                else alert('Gagal menyimpan: ' + (data.message || ''));
            })
            .catch(err => { this.saving = false; console.error(err); alert('Terjadi kesalahan saat menyimpan.'); });
        }
    };
}
</script>
@endpush
