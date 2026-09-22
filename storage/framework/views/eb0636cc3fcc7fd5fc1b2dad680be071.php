<?php $__env->startSection('title', 'Editor Halaman Akademi & Program — DHS'); ?>
<?php $__env->startSection('page-title', 'Editor Lengkap Halaman Akademi & Program Studi'); ?>

<?php $__env->startSection('content'); ?>
<div x-data="academyCompleteData()">

    
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh data Halaman Akademi & Program berhasil disimpan.
    </div>

    
    <div x-show="errorMsg" x-transition style="display:none;background:#fee2e2;border:1.5px solid #fca5a5;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#991b1b;font-weight:600;font-size:14px;">
        <span class="material-icons-round">error</span> <span x-text="errorMsg"></span>
    </div>

    
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <div>
            <p style="font-size:13px;color:#64748b;margin:0;">
                Kelola seluruh konten, kategori durasi, daftar kursus, jalur beasiswa, dan dokumen sertifikasi di halaman <strong>/akademi</strong>.
            </p>
        </div>
        <div style="display:flex;gap:10px;align-items:center;">
            <a href="/akademi" target="_blank" class="btn-secondary" style="padding:8px 16px;font-size:12.5px;display:inline-flex;align-items:center;gap:6px;text-decoration:none;">
                <span class="material-icons-round" style="font-size:18px;">open_in_new</span> Lihat Website Publik
            </a>
            <button type="button" class="btn-primary" style="padding:8px 20px;font-size:13px;" @click="saveAll()" :disabled="saving">
                <span class="material-icons-round" style="font-size:18px;" x-text="saving ? 'hourglass_empty' : 'save'"></span>
                <span x-text="saving ? 'Menyimpan...' : 'Simpan Seluruh Data'"></span>
            </button>
        </div>
    </div>

    
    <div style="display:flex;gap:8px;overflow-x:auto;padding-bottom:12px;margin-bottom:24px;border-bottom:1px solid #e5e7eb;scrollbar-width:none;">
        <template x-for="tab in tabs" :key="tab.id">
            <button type="button" @click="activeTab = tab.id"
                :class="activeTab === tab.id ? 'btn-primary' : 'btn-secondary'"
                style="padding:8px 15px;font-size:12.5px;white-space:nowrap;flex-shrink:0;display:inline-flex;align-items:center;gap:6px;">
                <span class="material-icons-round" style="font-size:16px;" x-text="tab.icon"></span>
                <span x-text="tab.label"></span>
            </button>
        </template>
    </div>

    
    
    
    <div x-show="activeTab === 'hero'">
        <div class="bo-grid-2" style="display:grid;grid-template-columns:1.1fr 0.9fr;gap:24px;align-items:start;">
            
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 16px;">1. Pengaturan Hero Section</h2>
                <p style="font-size:12px;color:#64748b;margin:0 0 18px;line-height:1.5;">
                    Bagian atas halaman Akademi yang menampilkan banner visual, judul besar, dan sub-header pengantar.
                </p>

                <div class="form-group">
                    <label class="bo-label">Judul Utama (H1)</label>
                    <input type="text" class="bo-input" x-model="hero.title" placeholder="Program Vokasi & Kursus">
                </div>
                <div class="form-group">
                    <label class="bo-label">Subjudul (Teks Atas / Tagline)</label>
                    <input type="text" class="bo-input" x-model="hero.subtitle" placeholder="Program Akademik & Pelatihan">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="bo-label">Gambar Latar Hero</label>
                    <div style="display:flex;align-items:flex-start;gap:14px;">
                        <div style="width:160px;height:95px;border-radius:10px;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
                             @click="$store.imageUpload.open(url => { hero.bgImage = url })">
                            <template x-if="hero.bgImage">
                                <img :src="hero.bgImage" style="width:100%;height:100%;object-fit:cover;">
                            </template>
                            <template x-if="!hero.bgImage">
                                <span class="material-icons-round" style="color:#aaa;font-size:32px;">add_photo_alternate</span>
                            </template>
                        </div>
                        <div style="flex:1;">
                            <div style="display:flex;gap:8px;margin-bottom:8px;">
                                <button type="button" class="btn-secondary" style="font-size:12px;padding:7px 14px;"
                                        @click="$store.imageUpload.open(url => { hero.bgImage = url })">
                                    <span class="material-icons-round" style="font-size:16px;vertical-align:middle;">upload</span> Upload Gambar
                                </button>
                                <button type="button" x-show="hero.bgImage" class="btn-danger" style="font-size:11px;padding:5px 10px;"
                                        @click="hero.bgImage = ''">
                                    <span class="material-icons-round" style="font-size:13px;">delete</span> Hapus
                                </button>
                            </div>
                            <input type="text" class="bo-input" x-model="hero.bgImage" placeholder="Atau ketik path gambar (contoh: /image/hero_registration.jpg)" style="font-size:12px;">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="bo-card" style="background:#0F2440;color:#fff;position:relative;overflow:hidden;min-height:280px;display:flex;flex-direction:column;justify-content:center;text-align:center;padding:36px 24px;border-radius:16px;">
                <template x-if="hero.bgImage">
                    <img :src="hero.bgImage" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0.4;">
                </template>
                <div style="position:absolute;inset:0;background:linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.7));"></div>
                <div style="position:relative;z-index:2;">
                    <div style="font-size:10px;text-transform:uppercase;letter-spacing:0.18em;color:rgba(255,255,255,0.7);margin-bottom:10px;display:inline-flex;align-items:center;gap:6px;">
                        <span>Beranda</span>
                        <span class="material-icons-round" style="font-size:12px;">chevron_right</span>
                        <span style="color:#fff;font-weight:700;">Akademi</span>
                    </div>
                    <h1 style="font-family:'Playfair Display',serif;font-size:24px;font-weight:700;margin:0 0 10px;color:#fff;line-height:1.2;" x-text="hero.title || 'Program Vokasi & Kursus'"></h1>
                    <p style="font-size:11px;text-transform:uppercase;letter-spacing:0.2em;color:rgba(255,255,255,0.75);margin:0;" x-text="hero.subtitle || 'Program Akademik & Pelatihan'"></p>
                </div>
                <div style="position:absolute;bottom:10px;right:14px;z-index:2;font-size:9.5px;background:rgba(255,255,255,0.2);padding:3px 8px;border-radius:6px;backdrop-filter:blur(4px);">
                    Preview Banner Live
                </div>
            </div>
        </div>
    </div>

    
    
    
    <div x-show="activeTab === 'categories'">

        
        <div style="margin-bottom:20px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <span style="font-size:11px;font-weight:700;letter-spacing:0.12em;color:#0F2440;text-transform:uppercase;">
                    Pilih Kategori Durasi (Frontend Filter Tabs)
                </span>
                <span style="font-size:12px;color:#64748b;">
                    Klik salah satu tab di bawah untuk mengedit sidebar & kursus
                </span>
            </div>

            <div style="display:flex;gap:12px;overflow-x:auto;padding-bottom:10px;scrollbar-width:none;">
                <template x-for="cat in categories" :key="cat.id">
                    <button type="button" @click="activeCat = cat.id"
                        style="min-width:190px;padding:10px 14px;border-radius:14px;display:flex;align-items:center;gap:12px;cursor:pointer;transition:all 0.2s;text-align:left;border:1.5px solid;"
                        :style="activeCat === cat.id ? 'background:#0F2440;color:#fff;border-color:#0F2440;box-shadow:0 6px 16px rgba(15,36,64,0.25);' : 'background:#fff;color:#1e293b;border-color:#e2e8f0;'">
                        
                        
                        <div style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"
                             :style="activeCat === cat.id ? 'background:rgba(255,255,255,0.15);color:#fff;' : 'background:#f1f5f9;color:#0F2440;'">
                            <span class="material-icons-round" style="font-size:20px;" x-text="cat.icon"></span>
                        </div>

                        
                        <div style="min-width:0;flex:1;">
                            <div style="font-size:13px;font-weight:700;line-height:1.2;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" x-text="cat.name"></div>
                            <div style="font-size:10.5px;margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"
                                 :style="activeCat === cat.id ? 'color:rgba(255,255,255,0.7);' : 'color:#94a3b8;'"
                                 x-text="cat.tag || cat.subtitle"></div>
                        </div>

                        
                        <span style="font-size:10px;font-weight:700;padding:2px 6px;border-radius:6px;flex-shrink:0;"
                              :style="activeCat === cat.id ? 'background:rgba(255,255,255,0.2);color:#fff;' : 'background:#f1f5f9;color:#475569;'"
                              x-text="(cat.courses ? cat.courses.length : 0) + ' Kursus'">
                        </span>
                    </button>
                </template>
            </div>
        </div>

        
        <template x-for="cat in categories" :key="cat.id">
            <div x-show="activeCat === cat.id" class="space-y-6">

                
                <div class="bo-card" style="margin-bottom:20px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:16px;">
                        <div>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <span class="badge badge-blue" style="font-size:11px;" x-text="'Key: ' + cat.key"></span>
                                <span class="badge badge-green" x-text="(cat.courses ? cat.courses.length : 0) + ' Program Terdaftar'"></span>
                            </div>
                            <h2 style="font-family:'Playfair Display',serif;font-size:22px;color:#0F2440;margin:6px 0 2px;" x-text="cat.name"></h2>
                            <p style="font-size:12.5px;color:#64748b;margin:0;">Pengaturan panel samping (sidebar kiri) dan daftar kartu program untuk kategori ini.</p>
                        </div>
                        <div style="display:flex;gap:10px;">
                            <a :href="'/program?category=' + cat.key" target="_blank" class="btn-secondary" style="font-size:12px;padding:7px 14px;text-decoration:none;">
                                <span class="material-icons-round" style="font-size:16px;">visibility</span> Preview di Frontend
                            </a>
                            <button class="btn-primary" style="padding:7px 16px;font-size:12.5px;" @click="addCourse(cat.id)">
                                <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Program Baru
                            </button>
                        </div>
                    </div>

                    
                    <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:14px;padding:20px;">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:14px;color:#0F2440;">
                            <span class="material-icons-round" style="font-size:18px;color:#C53030;">view_sidebar</span>
                            <span style="font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;">Pengaturan Sidebar Kiri (Panel Informasi Kategori)</span>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="bo-label">Nama Kategori <span style="color:#64748b;font-weight:400;font-size:11px;">(Judul utama di sidebar)</span></label>
                                <input type="text" class="bo-input" x-model="cat.name" placeholder="Contoh: Program Internasional">
                            </div>
                            <div class="form-group">
                                <label class="bo-label">Subtitle / Sub-header <span style="color:#64748b;font-weight:400;font-size:11px;">(Teks kecil di bawah judul)</span></label>
                                <input type="text" class="bo-input" x-model="cat.subtitle" placeholder="Contoh: Germany · Australia">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="bo-label">Deskripsi Lengkap Kategori <span style="color:#64748b;font-weight:400;font-size:11px;">(Paragraf penjelasan di panel sidebar)</span></label>
                            <textarea class="bo-textarea" rows="3" x-model="cat.desc" placeholder="Deskripsi mengenai keunggulan, integrasi kurikulum, dan jaminan penempatan program kategori ini..."></textarea>
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label class="bo-label">Peluang Kerja Lulusan <span style="color:#64748b;font-weight:400;font-size:11px;">(Tampil di bawah garis pemisah sidebar)</span></label>
                            <input type="text" class="bo-input" x-model="cat.careers" placeholder="Contoh: Hotel Bintang 5 di Australia & Jerman, Kapal Pesiar Mewah Dunia, F&B Manager">
                        </div>
                    </div>
                </div>

                
                <div class="bo-card">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                        <div>
                            <h3 style="font-family:'Playfair Display',serif;font-size:18px;font-weight:700;color:#0F2440;margin:0 0 4px;">Daftar Kursus / Modul Program</h3>
                            <p style="font-size:12px;color:#64748b;margin:0;">Setiap program di bawah ini tampil dalam bentuk kartu interaktif di website utama dengan tautan ke halaman detail program.</p>
                        </div>
                        <span class="badge badge-blue" x-text="(cat.courses ? cat.courses.length : 0) + ' Modul'"></span>
                    </div>

                    <div class="bo-grid-2" style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">
                        <template x-for="(course, idx) in cat.courses" :key="idx">
                            <div style="background:#fff;border-radius:14px;border:1.5px solid #e2e8f0;box-shadow:0 2px 10px rgba(0,0,0,0.03);display:flex;flex-direction:column;justify-content:space-between;padding:18px;position:relative;">
                                
                                
                                <div>
                                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;gap:8px;">
                                        <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
                                            <span class="badge" :class="course.is_active ? 'badge-green' : 'badge-gray'" x-text="course.is_active ? 'Aktif' : 'Nonaktif'"></span>
                                            <template x-if="course.country">
                                                <span style="font-size:10.5px;font-weight:700;background:#0F2440;color:#fff;padding:2px 8px;border-radius:6px;" x-text="course.country"></span>
                                            </template>
                                        </div>
                                        <div style="display:flex;gap:4px;align-items:center;">
                                            <a :href="'/program/' + course.slug" target="_blank" class="btn-icon" style="width:28px;height:28px;text-decoration:none;" title="Lihat Tampilan Website">
                                                <span class="material-icons-round" style="font-size:16px;">open_in_new</span>
                                            </a>
                                            <button type="button" class="btn-icon danger" style="width:28px;height:28px;" @click="deleteCourse(course.id)" title="Hapus Kursus">
                                                <span class="material-icons-round" style="font-size:16px;">delete</span>
                                            </button>
                                        </div>
                                    </div>

                                    
                                    <div style="display:flex;gap:14px;margin-bottom:14px;">
                                        <div style="width:84px;height:64px;border-radius:8px;overflow:hidden;border:1px solid #cbd5e1;flex-shrink:0;cursor:pointer;position:relative;background:#f8fafc;display:flex;align-items:center;justify-content:center;"
                                             @click="$store.imageUpload.open(url => { course.img = url })" title="Klik untuk ganti gambar">
                                            <template x-if="course.img">
                                                <img :src="course.img" style="width:100%;height:100%;object-fit:cover;">
                                            </template>
                                            <template x-if="!course.img">
                                                <span class="material-icons-round" style="color:#94a3b8;font-size:24px;">image</span>
                                            </template>
                                            <span style="position:absolute;bottom:0;inset-x:0;background:rgba(15,36,64,0.75);color:#fff;font-size:9px;text-align:center;padding:1px 0;">Ganti</span>
                                        </div>

                                        <div style="flex:1;min-width:0;">
                                            <input type="text" class="bo-input" style="padding:6px 10px;font-size:13.5px;font-weight:700;margin-bottom:4px;" x-model="course.title" placeholder="Nama Program">
                                            <div style="font-size:11px;color:#64748b;display:flex;align-items:center;gap:4px;">
                                                <span class="material-icons-round" style="font-size:13px;">link</span>
                                                <span class="truncate" x-text="'/program/' + course.slug"></span>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="form-grid-2" style="margin-bottom:10px;">
                                        <div class="form-group" style="margin-bottom:0;">
                                            <label class="bo-label" style="font-size:10.5px;">Badge Negara / Tag</label>
                                            <input type="text" class="bo-input" style="padding:6px;font-size:11.5px;" x-model="course.country" placeholder="JERMAN / BALI / CRUISE">
                                        </div>
                                        <div class="form-group" style="margin-bottom:0;">
                                            <label class="bo-label" style="font-size:10.5px;">Durasi</label>
                                            <input type="text" class="bo-input" style="padding:6px;font-size:11.5px;" x-model="course.duration" placeholder="2 Tahun / 6 Bulan">
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom:10px;">
                                        <label class="bo-label" style="font-size:10.5px;">Deskripsi Singkat (Tampil di Kartu)</label>
                                        <textarea class="bo-textarea" style="min-height:50px;padding:6px;font-size:11.5px;" rows="2" x-model="course.desc" placeholder="Ringkasan isi pelatihan..."></textarea>
                                    </div>

                                    <div class="form-group" style="margin-bottom:14px;">
                                        <label class="bo-label" style="font-size:10.5px;">Status Tampil</label>
                                        <select class="bo-input" style="padding:6px;font-size:11.5px;" x-model="course.is_active">
                                            <option :value="true">Aktif (Tampil di Website)</option>
                                            <option :value="false">Nonaktif (Sembunyikan)</option>
                                        </select>
                                    </div>
                                </div>

                                
                                <div style="display:flex;gap:8px;padding-top:12px;border-top:1px solid #f1f5f9;margin-top:auto;">
                                    <a :href="'/backoffice/program-detail/' + course.slug" class="btn-primary" style="flex:1;justify-content:center;padding:7px 10px;font-size:11.5px;text-decoration:none;border-radius:8px;">
                                        <span class="material-icons-round" style="font-size:15px;">auto_stories</span> Edit 4 Box & Modul
                                    </a>
                                    <a :href="'/backoffice/program/' + course.id + '/edit'" class="btn-secondary" style="padding:7px 12px;font-size:11.5px;text-decoration:none;border-radius:8px;" title="Edit Parameter Program">
                                        <span class="material-icons-round" style="font-size:15px;">settings</span>
                                    </a>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </template>
    </div>

    
    
    
    <div x-show="activeTab === 'catalog'">
        <div class="bo-card" style="max-width:900px;">
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
                <div style="width:44px;height:44px;border-radius:12px;background:linear-gradient(135deg, #0F2440, #1e293b);color:#fbbf24;display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:24px;">grid_view</span>
                </div>
                <div>
                    <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0;">3. Hub Katalog Semua Program Studi DHS</h2>
                    <p style="font-size:12.5px;color:#64748b;margin:2px 0 0;">Section tautan global di bawah kartu kategori halaman Akademi yang mengarah ke katalog lengkap /program.</p>
                </div>
            </div>

            <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:14px;padding:24px;text-align:center;margin-bottom:20px;">
                <p style="font-size:12.5px;color:#475569;max-width:600px;margin:0 auto 16px;line-height:1.6;">
                    Di halaman Akademi publik, terdapat banner tombol elegan berikut yang mengajak calon mahasiswa melihat seluruh daftar katalog kursus DHS tanpa filter:
                </p>

                
                <div style="display:inline-flex;align-items:center;gap:16px;padding:14px 28px;border-radius:16px;background:linear-gradient(135deg, #0F2440 0%, #1e293b 100%);color:#fff;border:1px solid rgba(255,255,255,0.15);box-shadow:0 10px 25px -5px rgba(15,36,64,0.35);">
                    <span style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.1);color:#fbbf24;border:1px solid rgba(251,191,36,0.3);">
                        <span class="material-icons-round" style="font-size:20px;">grid_view</span>
                    </span>
                    <span style="font-size:14px;font-weight:600;letter-spacing:0.02em;">Lihat Semua Katalog Program DHS</span>
                    <span style="width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.15);">
                        <span class="material-icons-round" style="font-size:18px;">arrow_forward</span>
                    </span>
                </div>
            </div>

            <div style="display:flex;gap:12px;flex-wrap:wrap;">
                <a href="/backoffice/program-detail" class="btn-primary" style="padding:10px 20px;font-size:13px;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
                    <span class="material-icons-round" style="font-size:18px;">auto_stories</span> Kelola Halaman Program Detail
                </a>
                <a href="/program" target="_blank" class="btn-secondary" style="padding:10px 18px;font-size:13px;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                    <span class="material-icons-round" style="font-size:18px;">open_in_new</span> Buka Halaman /program Publik
                </a>
            </div>
        </div>
    </div>

    
    
    
    <div x-show="activeTab === 'beasiswa'">
        <div class="bo-card" style="margin-bottom:20px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:12px;">
                <div>
                    <span class="badge badge-red" style="font-size:10.5px;margin-bottom:4px;">Jalur Beasiswa</span>
                    <h2 style="font-family:'Playfair Display',serif;font-size:20px;color:#0F2440;margin:4px 0 2px;">4. Program Beasiswa DHS</h2>
                    <p style="font-size:12.5px;color:#64748b;margin:0;">Section di halaman Akademi yang menampilkan 3 skema beasiswa bagi calon profesional muda perhotelan.</p>
                </div>
                <div style="display:flex;gap:8px;">
                    <a href="/backoffice/layanan" class="btn-primary" style="font-size:12px;padding:7px 14px;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <span class="material-icons-round" style="font-size:16px;">folder_shared</span> Data Pendaftar Beasiswa
                    </a>
                    <a href="/layanan?type=beasiswa" target="_blank" class="btn-secondary" style="font-size:12px;padding:7px 12px;text-decoration:none;">
                        <span class="material-icons-round" style="font-size:16px;">open_in_new</span> Formulir Pengajuan
                    </a>
                </div>
            </div>

            
            <div class="bo-grid-3" style="display:grid;grid-template-columns:repeat(3, 1fr);gap:18px;margin-bottom:20px;">
                
                <div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:14px;padding:20px;display:flex;flex-direction:column;justify-content:space-between;">
                    <div>
                        <div style="width:42px;height:42px;border-radius:10px;background:rgba(197,48,48,0.1);color:#C53030;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
                            <span class="material-icons-round" style="font-size:22px;">emoji_events</span>
                        </div>
                        <h3 style="font-family:'Playfair Display',serif;font-size:16px;font-weight:700;color:#0F2440;margin:0 0 6px;">Beasiswa Prestasi</h3>
                        <p style="font-size:11.5px;color:#64748b;line-height:1.5;margin:0 0 12px;">Keringanan biaya pendidikan hingga 50% bagi siswa berprestasi akademik & non-akademik.</p>
                        <ul style="font-size:11px;color:#475569;margin:0;padding-left:16px;line-height:1.6;">
                            <li>Nilai rapor/ijazah ≥ 80</li>
                            <li>Piagam / sertifikat prestasi</li>
                            <li>Lulus wawancara tim DHS</li>
                        </ul>
                    </div>
                    <div style="margin-top:16px;padding-top:12px;border-top:1px solid #f1f5f9;">
                        <a href="/beasiswa/beasiswa-prestasi" target="_blank" class="btn-secondary" style="width:100%;justify-content:center;font-size:11.5px;padding:6px;text-decoration:none;">
                            <span class="material-icons-round" style="font-size:15px;">visibility</span> Halaman Informasi
                        </a>
                    </div>
                </div>

                
                <div style="background:#f0f7ff;border:1.5px solid #bfdbfe;border-radius:14px;padding:20px;display:flex;flex-direction:column;justify-content:space-between;">
                    <div>
                        <div style="width:42px;height:42px;border-radius:10px;background:rgba(26,54,93,0.12);color:#1A365D;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
                            <span class="material-icons-round" style="font-size:22px;">groups</span>
                        </div>
                        <h3 style="font-family:'Playfair Display',serif;font-size:16px;font-weight:700;color:#0F2440;margin:0 0 6px;">Beasiswa STT / Desa</h3>
                        <p style="font-size:11.5px;color:#64748b;line-height:1.5;margin:0 0 12px;">Khusus anggota Sekaa Teruna Teruni (STT) & utusan desa adat Bali untuk vokasi pariwisata.</p>
                        <ul style="font-size:11px;color:#475569;margin:0;padding-left:16px;line-height:1.6;">
                            <li>Rekomendasi Bendesa Adat</li>
                            <li>Aktif sebagai anggota STT</li>
                            <li>Warga Bali domisili Bali</li>
                        </ul>
                    </div>
                    <div style="margin-top:16px;padding-top:12px;border-top:1px solid rgba(0,0,0,0.06);">
                        <a href="/beasiswa/beasiswa-stt" target="_blank" class="btn-secondary" style="width:100%;justify-content:center;font-size:11.5px;padding:6px;text-decoration:none;background:#fff;">
                            <span class="material-icons-round" style="font-size:15px;">visibility</span> Halaman Informasi
                        </a>
                    </div>
                </div>

                
                <div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:14px;padding:20px;display:flex;flex-direction:column;justify-content:space-between;">
                    <div>
                        <div style="width:42px;height:42px;border-radius:10px;background:rgba(197,48,48,0.1);color:#C53030;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
                            <span class="material-icons-round" style="font-size:22px;">workspace_premium</span>
                        </div>
                        <h3 style="font-family:'Playfair Display',serif;font-size:16px;font-weight:700;color:#0F2440;margin:0 0 6px;">Beasiswa Khusus</h3>
                        <p style="font-size:11.5px;color:#64748b;line-height:1.5;margin:0 0 12px;">Bagi calon peserta didik dari keluarga kurang mampu dengan komitmen tinggi berkarir global.</p>
                        <ul style="font-size:11px;color:#475569;margin:0;padding-left:16px;line-height:1.6;">
                            <li>Surat keterangan tidak mampu</li>
                            <li>Esai motivasi & wawancara</li>
                            <li>Seleksi khusus tim DHS</li>
                        </ul>
                    </div>
                    <div style="margin-top:16px;padding-top:12px;border-top:1px solid #f1f5f9;">
                        <a href="/beasiswa/beasiswa-khusus" target="_blank" class="btn-secondary" style="width:100%;justify-content:center;font-size:11.5px;padding:6px;text-decoration:none;">
                            <span class="material-icons-round" style="font-size:15px;">visibility</span> Halaman Informasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
    
    <div x-show="activeTab === 'dokumen'">
        <div class="bo-card" style="margin-bottom:20px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:12px;">
                <div>
                    <span class="badge badge-blue" style="font-size:10.5px;margin-bottom:4px;">Layanan Pendampingan Resmi</span>
                    <h2 style="font-family:'Playfair Display',serif;font-size:20px;color:#0F2440;margin:4px 0 2px;">5. Layanan Pengurusan Dokumen Sertifikasi</h2>
                    <p style="font-size:12.5px;color:#64748b;margin:0;">Denpasar Hotel School mendampingi pengurusan 7 sertifikasi maritim wajib dan dokumen kerja kapal pesiar / luar negeri.</p>
                </div>
                <div style="display:flex;gap:8px;">
                    <a href="/backoffice/dokumen-sertifikasi" class="btn-primary" style="font-size:12px;padding:7px 14px;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <span class="material-icons-round" style="font-size:16px;">folder_special</span> Kelola Semua Dokumen CMS
                    </a>
                    <a href="/layanan?type=dokumen" target="_blank" class="btn-secondary" style="font-size:12px;padding:7px 12px;text-decoration:none;">
                        <span class="material-icons-round" style="font-size:16px;">open_in_new</span> Form Pengajuan Dokumen
                    </a>
                </div>
            </div>

            
            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(210px, 1fr));gap:14px;margin-bottom:16px;">
                <?php
                    $docItems = [
                        ['title' => 'Passport & Buku Pelaut', 'icon' => 'card_travel',   'slug' => 'passport',   'tag' => 'Imigrasi & Dephub'],
                        ['title' => 'BST (Basic Safety)',     'icon' => 'anchor',        'slug' => 'bst',        'tag' => 'STCW 2010'],
                        ['title' => 'SDSD (Security Duties)', 'icon' => 'security',      'slug' => 'sdsd',       'tag' => 'ISPS Code VI/6'],
                        ['title' => 'CCM (Crowd & Crisis)',   'icon' => 'groups',        'slug' => 'ccm',        'tag' => 'STCW V/2 Passenger'],
                        ['title' => 'SSAT (Security Aware)',  'icon' => 'verified_user', 'slug' => 'ssat',       'tag' => 'STCW VI/6 Security'],
                        ['title' => 'PSCRB (Survival Craft)', 'icon' => 'sailing',       'slug' => 'pscrb',      'tag' => 'Advanced Lifeboat'],
                        ['title' => 'C1/D Visa (US Seaman)',  'icon' => 'badge',         'slug' => 'c1d-visa',   'tag' => 'US Embassy Visa'],
                    ];
                ?>

                <?php $__currentLoopData = $docItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:12px;padding:16px;display:flex;flex-direction:column;justify-content:space-between;text-align:center;transition:border-color 0.2s;">
                    <div>
                        <div style="width:40px;height:40px;border-radius:10px;background:rgba(197,48,48,0.08);color:#C53030;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
                            <span class="material-icons-round" style="font-size:22px;"><?php echo e($doc['icon']); ?></span>
                        </div>
                        <h4 style="font-family:'Playfair Display',serif;font-size:13.5px;font-weight:700;color:#0F2440;margin:0 0 4px;line-height:1.3;"><?php echo e($doc['title']); ?></h4>
                        <span style="font-size:10px;font-weight:600;color:#94a3b8;display:block;margin-bottom:12px;"><?php echo e($doc['tag']); ?></span>
                    </div>

                    <div style="display:flex;gap:6px;padding-top:10px;border-top:1px solid #f1f5f9;">
                        <a href="/backoffice/dokumen-sertifikasi/<?php echo e($doc['slug']); ?>" class="btn-primary" style="flex:1;justify-content:center;font-size:11px;padding:5px 8px;text-decoration:none;border-radius:6px;">
                            <span class="material-icons-round" style="font-size:14px;">edit</span> Edit CMS
                        </a>
                        <a href="/dokumen/<?php echo e($doc['slug']); ?>" target="_blank" class="btn-secondary" style="padding:5px 8px;font-size:11px;text-decoration:none;border-radius:6px;" title="Lihat Halaman Publik">
                            <span class="material-icons-round" style="font-size:14px;">open_in_new</span>
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:12px 18px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                <div style="display:flex;align-items:center;gap:10px;font-size:12px;color:#475569;">
                    <span class="material-icons-round" style="font-size:20px;color:#0F2440;">info</span>
                    <span>Tiap dokumen memiliki editor mandiri untuk persyaratan berkas, alur pengurusan, dan biaya sertifikasi resmi.</span>
                </div>
                <a href="/backoffice/layanan-settings" class="btn-secondary" style="font-size:11.5px;padding:5px 12px;text-decoration:none;">
                    Kelola Opsi Form Layanan &rarr;
                </a>
            </div>
        </div>
    </div>

    
    
    
    <div x-show="activeTab === 'cta'">
        <div class="bo-card" style="max-width:850px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 16px;">6. Section Call To Action (Penutup Halaman)</h2>
            <p style="font-size:12.5px;color:#64748b;margin:0 0 20px;">Bagian paling bawah halaman Akademi yang mengajak pengunjung mendaftar langsung secara online.</p>

            <div style="background:#fafafa;border:1.5px solid #e2e8f0;border-radius:14px;padding:28px 24px;text-align:center;margin-bottom:20px;">
                <h3 style="font-family:'Playfair Display',serif;font-size:26px;color:#0F2440;margin:0 0 10px;">Mulai Karir Sukses Anda</h3>
                <p style="font-size:13.5px;color:#64748b;max-width:550px;margin:0 auto 20px;line-height:1.6;">
                    Denpasar Hotel School siap mengawal Anda menjadi profesional muda yang kompeten dan memiliki daya saing global. Gabung sekarang juga secara online.
                </p>
                <div style="display:inline-flex;align-items:center;gap:12px;padding:12px 28px;border-radius:10px;background:#C53030;color:#fff;font-size:12px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;">
                    <span>Pendaftaran Online</span>
                </div>
            </div>

            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a href="/backoffice/admisi" class="btn-primary" style="padding:9px 18px;font-size:12.5px;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                    <span class="material-icons-round" style="font-size:16px;">settings</span> Atur Formulir Pendaftaran
                </a>
                <a href="/backoffice/pendaftar" class="btn-secondary" style="padding:9px 18px;font-size:12.5px;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                    <span class="material-icons-round" style="font-size:16px;">how_to_reg</span> Lihat Data Pendaftar Masuk
                </a>
                <a href="/formulir-pendaftaran" target="_blank" class="btn-secondary" style="padding:9px 16px;font-size:12.5px;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                    <span class="material-icons-round" style="font-size:16px;">open_in_new</span> Buka Halaman Pendaftaran
                </a>
            </div>
        </div>
    </div>

    
    <div class="bo-modal-backdrop" x-show="addModal.open" x-transition style="display:none;" @keydown.escape.window="addModal.open=false">
        <div class="bo-modal" style="max-width:500px;" @click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <h3 style="margin:0;font-family:'Playfair Display',serif;color:#0F2440;">Tambah Kursus / Program Baru</h3>
                <button class="btn-icon" @click="addModal.open=false"><span class="material-icons-round">close</span></button>
            </div>
            <div class="form-group">
                <label class="bo-label">Nama Program Studi / Kursus <span style="color:#C53030;">*</span></label>
                <input type="text" class="bo-input" x-model="addModal.title" placeholder="Contoh: Tata Boga (Culinary Art) — 2 Tahun" @keydown.enter="submitAddCourse()">
            </div>
            <p style="font-size:12px;color:#64748b;margin:0 0 16px;">
                Kategori Tujuan: <strong x-text="addModal.catName"></strong>. Program akan langsung aktif dan dibuatkan slug otomatis.
            </p>
            <div style="display:flex;gap:12px;justify-content:flex-end;">
                <button class="btn-secondary" @click="addModal.open=false">Batal</button>
                <button class="btn-primary" @click="submitAddCourse()" :disabled="!addModal.title.trim()">
                    <span class="material-icons-round" style="font-size:18px;">add</span> Tambah Program
                </button>
            </div>
        </div>
    </div>

    
    <div class="bo-modal-backdrop" x-show="delModal.open" x-transition style="display:none;" @keydown.escape.window="delModal.open=false">
        <div class="bo-modal" style="max-width:420px;" @click.stop>
            <div style="text-align:center;margin-bottom:20px;">
                <div style="width:56px;height:56px;border-radius:50%;background:rgba(197,48,48,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <span class="material-icons-round" style="font-size:28px;color:#C53030;">delete_forever</span>
                </div>
                <h3 style="margin:0 0 8px;">Hapus Program?</h3>
                <p style="font-size:13.5px;color:#64748b;margin:0;">Program <strong x-text="delModal.title"></strong> akan dihapus permanen dari sistem.</p>
            </div>
            <div style="display:flex;gap:12px;justify-content:center;">
                <button class="btn-secondary" @click="delModal.open=false">Batal</button>
                <button class="btn-danger" @click="confirmDeleteCourse()">
                    <span class="material-icons-round" style="font-size:17px;">delete</span> Ya, Hapus Sekarang
                </button>
            </div>
        </div>
    </div>

    
    <div style="margin-top:32px;padding-top:20px;border-top:1px solid #e5e7eb;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div style="font-size:12.5px;color:#64748b;">
            💡 <em>Perubahan pada judul hero, deskripsi sidebar, durasi, dan nama kursus akan langsung diperbarui ke database.</em>
        </div>
        <button class="btn-primary" style="padding:12px 28px;font-size:14px;" @click="saveAll()" :disabled="saving">
            <span class="material-icons-round" style="font-size:20px;" x-text="saving ? 'hourglass_empty' : 'save'"></span>
            <span x-text="saving ? 'Menyimpan...' : 'Simpan Seluruh Data Akademi & Program'"></span>
        </button>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<?php
$academyHeroRecord = \App\Models\AboutPage::where('section_key', 'academy_hero')->first();
$academyHero = $academyHeroRecord
    ? (is_array($academyHeroRecord->section_content) ? $academyHeroRecord->section_content : json_decode($academyHeroRecord->section_content ?? '[]', true) ?? [])
    : [];

$catData = $categories->map(function($cat) {
    $catIcon = match($cat->category_key) {
        '1-tahun'              => 'school',
        '1-tahun-kapal-pesiar' => 'directions_boat',
        '2-tahun'              => 'workspace_premium',
        'internasional'        => 'public',
        'short-course','6-bulan' => 'bolt',
        'eksekutif'            => 'military_tech',
        default                => 'map'
    };
    $catSubtitle = match($cat->category_key) {
        '1-tahun'              => 'Vokasi Kilat',
        '1-tahun-kapal-pesiar' => 'Cruise Line Career',
        '2-tahun'              => 'Diploma Penuh',
        'internasional'        => 'Germany · Australia',
        'short-course','6-bulan' => 'Skill Intensif',
        'eksekutif'            => 'Spesialis Pro',
        default                => 'Program Pilihan'
    };

    return [
        'id'      => $cat->id,
        'key'     => $cat->category_key,
        'name'    => $cat->category_name,
        'subtitle'=> $cat->subtitle ?? $catSubtitle,
        'tag'     => $catSubtitle,
        'icon'    => $catIcon,
        'desc'    => $cat->description ?? '',
        'careers' => $cat->career_opportunities ?? '',
        'courses' => $cat->programs->map(function($p) {
            return [
                'id'        => $p->id,
                'slug'      => $p->slug,
                'title'     => $p->title,
                'country'   => $p->country_badge ?? '',
                'desc'      => $p->description ?? '',
                'duration'  => $p->duration ?? '',
                'img'       => $p->thumbnail_url ?? '',
                'is_active' => (bool)$p->is_active,
            ];
        })->values()
    ];
})->values();
?>

<script>
function academyCompleteData() {
    return {
        saved: false,
        saving: false,
        errorMsg: '',
        activeTab: 'categories',
        activeCat: <?php echo json_encode($categories->first() ? $categories->first()->id : null, 15, 512) ?>,
        hero: {
            title: <?php echo json_encode($academyHero['title'] ?? 'Program Vokasi & Kursus', 15, 512) ?>,
            subtitle: <?php echo json_encode($academyHero['subtitle'] ?? 'Program Akademik & Pelatihan', 15, 512) ?>,
            bgImage: <?php echo json_encode($academyHero['bgImage'] ?? '/image/hero_registration.jpg', 15, 512) ?>
        },
        categories: <?php echo json_encode($catData, 15, 512) ?>,
        tabs: [
            { id: 'hero',       label: '1. Hero Section',         icon: 'wallpaper' },
            { id: 'categories', label: '2. Kategori & Kursus',    icon: 'school' },
            { id: 'catalog',    label: '3. Hub Semua Program',    icon: 'grid_view' },
            { id: 'beasiswa',   label: '4. Jalur Beasiswa',       icon: 'emoji_events' },
            { id: 'dokumen',    label: '5. Dokumen Sertifikasi',  icon: 'verified' },
            { id: 'cta',        label: '6. CTA Pendaftaran',      icon: 'assignment' }
        ],

        addModal: { open: false, catId: null, catName: '', title: '' },
        delModal: { open: false, courseId: null, title: '' },

        addCourse(catId) {
            const cat = this.categories.find(c => c.id === catId);
            if (!cat) return;
            this.addModal.catId = catId;
            this.addModal.catName = cat.name;
            this.addModal.title = '';
            this.addModal.open = true;
        },

        submitAddCourse() {
            if (!this.addModal.title.trim()) return;
            const catId = this.addModal.catId;
            this.addModal.open = false;
            fetch('/backoffice/program/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ category_id: catId, title: this.addModal.title.trim() })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success !== false) location.reload();
                else { this.errorMsg = 'Gagal menambah program: ' + (data.message || ''); setTimeout(() => this.errorMsg = '', 5000); }
            })
            .catch(() => { this.errorMsg = 'Terjadi kesalahan jaringan saat menambah program.'; setTimeout(() => this.errorMsg = '', 5000); });
        },

        deleteCourse(courseId) {
            const cat = this.categories.find(c => c.courses.some(cr => cr.id === courseId));
            const course = cat ? cat.courses.find(cr => cr.id === courseId) : null;
            this.delModal.courseId = courseId;
            this.delModal.title = course ? course.title : '';
            this.delModal.open = true;
        },

        confirmDeleteCourse() {
            const id = this.delModal.courseId;
            this.delModal.open = false;
            fetch(`/backoffice/program/${id}/delete`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ id: id })
            }).then(r => r.json()).then(() => location.reload()).catch(() => { this.errorMsg = 'Gagal menghapus program.'; setTimeout(() => this.errorMsg = '', 5000); });
        },

        saveAll() {
            if (this.saving) return;
            this.saving = true;
            this.errorMsg = '';
            const token = '<?php echo e(csrf_token()); ?>';
            const jsonHeaders = { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' };
            const promises = [];

            // 1. Simpan hero ke about_pages (academy_hero key)
            promises.push(fetch('/backoffice/about-us/update', {
                method: 'POST',
                headers: jsonHeaders,
                body: JSON.stringify({
                    sections: {
                        academy_hero: {
                            title: 'Akademi Hero',
                            content: { title: this.hero.title || '', subtitle: this.hero.subtitle || '', bgImage: this.hero.bgImage || '' }
                        }
                    }
                })
            }));

            // 2. Simpan setiap kategori ke program_categories
            this.categories.forEach(cat => {
                promises.push(fetch('/backoffice/program-category/' + cat.id + '/update', {
                    method: 'POST',
                    headers: jsonHeaders,
                    body: JSON.stringify({
                        category_name: cat.name,
                        subtitle: cat.subtitle || '',
                        description: cat.desc || '',
                        career_opportunities: cat.careers || ''
                    })
                }));
            });

            // 3. Simpan setiap program/kursus
            this.categories.forEach(cat => {
                if (!cat.courses) return;
                cat.courses.forEach(course => {
                    if (!course.id) return;
                    promises.push(fetch('/backoffice/program/' + course.id + '/update', {
                        method: 'POST',
                        headers: jsonHeaders,
                        body: JSON.stringify({
                            title: course.title || '',
                            description: course.desc || '',
                            country_badge: course.country || '',
                            duration: course.duration || '',
                            is_active: course.is_active ? 1 : 0,
                            thumbnail_url: course.img || ''
                        })
                    }));
                });
            });

            Promise.all(promises).then(async responses => {
                const failed = [];
                for (const r of responses) {
                    if (!r.ok) {
                        let msg = 'HTTP ' + r.status;
                        try { const j = await r.json(); msg = j.message || j.error || JSON.stringify(j.errors || j); } catch(e) {}
                        failed.push(msg);
                    }
                }
                this.saving = false;
                if (failed.length === 0) {
                    this.saved = true;
                    setTimeout(() => this.saved = false, 3500);
                    location.reload();
                } else {
                    this.errorMsg = 'Gagal menyimpan: ' + failed[0];
                    setTimeout(() => this.errorMsg = '', 8000);
                }
            }).catch(err => {
                this.saving = false;
                this.errorMsg = 'Terjadi kesalahan: ' + err.message;
                setTimeout(() => this.errorMsg = '', 8000);
            });
        }
    };
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backoffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/backoffice/program.blade.php ENDPATH**/ ?>