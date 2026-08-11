@extends('backoffice.layouts.app')
@section('title', 'Editor Academy & Program')
@section('page-title', 'Editor Lengkap Halaman Academy & Program')

@section('content')
<div x-data="academyCompleteData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh data Halaman Academy & Program berhasil disimpan.
    </div>

    {{-- Alert Error --}}
    <div x-show="errorMsg" x-transition style="background:#fee2e2;border:1.5px solid #fca5a5;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#991b1b;font-weight:600;font-size:14px;">
        <span class="material-icons-round">error</span> <span x-text="errorMsg"></span>
    </div>

    {{-- Hero Section --}}
    <div class="bo-card" style="margin-bottom:20px;">
        <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0 0 16px;">Hero Section � Halaman Akademi</h2>
        <div class="form-group">
            <label class="bo-label">Judul Utama (H1)</label>
            <input type="text" class="bo-input" x-model="hero.title" placeholder="Program Vokasi & Kursus">
        </div>
        <div class="form-group">
            <label class="bo-label">Subjudul</label>
            <input type="text" class="bo-input" x-model="hero.subtitle" placeholder="Program Akademik & Pelatihan">
        </div>
        <div class="form-group" style="margin-bottom:0;">
            <label class="bo-label">Gambar Latar Hero</label>
            <div style="display:flex;align-items:flex-start;gap:14px;">
                <div style="width:180px;height:100px;border-radius:10px;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
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
                            <span class="material-icons-round" style="font-size:16px;vertical-align:middle;">upload</span> Upload / Pilih Gambar
                        </button>
                        <button type="button" x-show="hero.bgImage" class="btn-danger" style="font-size:11px;padding:5px 10px;"
                                @click="hero.bgImage = ''">
                            <span class="material-icons-round" style="font-size:13px;">delete</span> Hapus
                        </button>
                    </div>
                    <input type="text" class="bo-input" x-model="hero.bgImage" placeholder="Atau paste URL gambar di sini" style="font-size:12px;">
                </div>
            </div>
        </div>
    </div>

    {{-- Category Tabs --}}
    <div style="display:flex;gap:8px;overflow-x:auto;padding-bottom:12px;margin-bottom:24px;border-bottom:1px solid #e5e7eb;scrollbar-width:none;">
        <template x-for="cat in categories" :key="cat.id">
            <button type="button" @click="activeCat = cat.id"
                :class="activeCat === cat.id ? 'btn-primary' : 'btn-secondary'"
                style="padding:8px 14px;font-size:12.5px;white-space:nowrap;flex-shrink:0;">
                <span class="material-icons-round" style="font-size:16px;">school</span>
                <span x-text="cat.name"></span>
            </button>
        </template>
    </div>

    {{-- Active Category Panel --}}
    <div class="bo-card" style="max-width:950px;">
        <template x-for="cat in categories" :key="cat.id">
            <div x-show="activeCat === cat.id">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                    <div>
                        <h2 style="font-family:'Playfair Display',serif;font-size:20px;color:#0F2440;margin:0 0 4px;">
                            <input type="text" class="bo-input" style="font-family:'Playfair Display',serif;font-size:20px;color:#0F2440;border:none;padding:0;background:transparent;font-weight:700;" x-model="cat.name" placeholder="Nama Kategori">
                        </h2>
                        <p style="font-size:13px;color:#718096;margin:0;">Pengaturan deskripsi & daftar kursus</p>
                    </div>
                    <button class="btn-primary" style="padding:6px 14px;font-size:12.5px;" @click="addCourse(cat.id)">
                        <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Kursus
                    </button>
                </div>

                {{-- Panel Description --}}
                <div style="padding:16px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;margin-bottom:24px;">
                    <p style="font-size:11px;color:#718096;margin:0 0 14px;font-weight:600;">
                        <span class="material-icons-round" style="font-size:14px;vertical-align:middle;">edit</span> Edit Sidebar � data di bawah ini tampil di panel kiri halaman Akademi
                    </p>
                    <div class="form-group">
                        <label class="bo-label">Nama Kategori <span style="color:#718096;font-weight:400;font-size:11px;">� Teks merah & judul besar di sidebar</span></label>
                        <input type="text" class="bo-input" x-model="cat.name" placeholder="Contoh: Program Internasional">
                    </div>
                    <div class="form-group">
                        <label class="bo-label">Subtitle / Sub-header <span style="color:#718096;font-weight:400;font-size:11px;">� Teks kecil di bawah judul</span></label>
                        <input type="text" class="bo-input" x-model="cat.subtitle" placeholder="Contoh: Diploma Vokasi">
                    </div>
                    <div class="form-group">
                        <label class="bo-label">Deskripsi Kategori <span style="color:#718096;font-weight:400;font-size:11px;">� Paragraf penjelasan di sidebar</span></label>
                        <textarea class="bo-textarea" rows="3" x-model="cat.desc" placeholder="Deskripsi singkat tentang kategori program ini..."></textarea>
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Peluang Kerja Lulusan <span style="color:#718096;font-weight:400;font-size:11px;">� Teks di bawah garis pemisah</span></label>
                        <input type="text" class="bo-input" x-model="cat.careers" placeholder="Contoh: Hotel Bintang 5, Kapal Pesiar, Restoran Internasional">
                    </div>
                </div>

                {{-- Courses List Grid --}}
                <h3 style="font-size:15px;font-weight:700;color:#0F2440;margin-bottom:14px;">Daftar Kursus / Modul</h3>
                <div class="bo-grid-2" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <template x-for="(course, idx) in cat.courses" :key="idx">
                        <div style="padding:16px;background:#fff;border-radius:12px;border:1.5px solid #eee;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
                                <span class="badge badge-blue" x-text="course.country || 'UMUM'"></span>
                                <button class="btn-icon danger" style="width:28px;height:28px;" @click="deleteCourse(course.id)">
                                    <span class="material-icons-round" style="font-size:16px;">delete</span>
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="bo-label" style="font-size:11px;">Nama Kursus / Program</label>
                                <input type="text" class="bo-input" style="padding:7px;font-weight:700;" x-model="course.title">
                            </div>
                            <div class="form-group">
                                <label class="bo-label" style="font-size:11px;">Negara / Badge</label>
                                <input type="text" class="bo-input" style="padding:7px;" x-model="course.country" placeholder="???? JERMAN / ???? BALI">
                            </div>
                            <div class="form-group">
                                <label class="bo-label" style="font-size:11px;">Deskripsi Kursus</label>
                                <textarea class="bo-textarea" style="min-height:60px;padding:7px;" x-model="course.desc"></textarea>
                            </div>
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label class="bo-label" style="font-size:11px;">Durasi</label>
                                    <input type="text" class="bo-input" style="padding:7px;" x-model="course.duration" placeholder="6 Bulan / 1 Tahun">
                                </div>
                                <div class="form-group">
                                    <label class="bo-label" style="font-size:11px;">Status</label>
                                    <select class="bo-input" style="padding:7px;" x-model="course.is_active">
                                        <option :value="true">Aktif</option>
                                        <option :value="false">Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="bo-label" style="font-size:11px;">Gambar Thumbnail</label>
                                <div style="display:flex;align-items:flex-start;gap:8px;">
                                    <div style="width:70px;height:46px;border-radius:8px;overflow:hidden;border:1.5px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fff;"
                                         @click="$store.imageUpload.open(url => { course.img = url })">
                                        <template x-if="course.img">
                                            <img :src="course.img" style="width:100%;height:100%;object-fit:cover;">
                                        </template>
                                        <template x-if="!course.img">
                                            <span class="material-icons-round" style="color:#bbb;font-size:18px;">image</span>
                                        </template>
                                    </div>
                                    <button type="button" class="btn-secondary" style="font-size:11px;padding:4px 10px;"
                                            @click="$store.imageUpload.open(url => { course.img = url })">
                                        Ganti
                                    </button>
                                    <button type="button" x-show="course.img" class="btn-danger" style="font-size:11px;padding:4px 8px;"
                                            @click="course.img = ''">
                                        <span class="material-icons-round" style="font-size:13px;">delete</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </div>

    {{-- Modal Tambah Kursus --}}
    <div class="bo-modal-backdrop" x-show="addModal.open" x-transition style="display:none;" @keydown.escape.window="addModal.open=false">
        <div class="bo-modal" style="max-width:480px;" @click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <h3 style="margin:0;font-family:'Playfair Display',serif;color:#0F2440;">Tambah Kursus Baru</h3>
                <button class="btn-icon" @click="addModal.open=false"><span class="material-icons-round">close</span></button>
            </div>
            <div class="form-group">
                <label class="bo-label">Judul Program / Kursus <span style="color:#C53030;">*</span></label>
                <input type="text" class="bo-input" x-model="addModal.title" placeholder="Contoh: Diploma Perhotelan Internasional" @keydown.enter="submitAddCourse()">
            </div>
            <p style="font-size:12px;color:#718096;margin:0 0 16px;">
                Kategori: <strong x-text="addModal.catName"></strong> � Program akan langsung aktif setelah ditambahkan.
            </p>
            <div style="display:flex;gap:12px;justify-content:flex-end;">
                <button class="btn-secondary" @click="addModal.open=false">Batal</button>
                <button class="btn-primary" @click="submitAddCourse()" :disabled="!addModal.title.trim()">
                    <span class="material-icons-round" style="font-size:18px;">add</span> Tambah
                </button>
            </div>
        </div>
    </div>

    {{-- Modal Hapus Kursus --}}
    <div class="bo-modal-backdrop" x-show="delModal.open" x-transition style="display:none;" @keydown.escape.window="delModal.open=false">
        <div class="bo-modal" style="max-width:400px;" @click.stop>
            <div style="text-align:center;margin-bottom:20px;">
                <div style="width:56px;height:56px;border-radius:50%;background:rgba(197,48,48,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <span class="material-icons-round" style="font-size:28px;color:#C53030;">delete_forever</span>
                </div>
                <h3 style="margin:0 0 8px;">Hapus Kursus?</h3>
                <p style="font-size:14px;color:#718096;margin:0;">Program <strong x-text="delModal.title"></strong> akan dihapus permanen dari database.</p>
            </div>
            <div style="display:flex;gap:12px;justify-content:center;">
                <button class="btn-secondary" @click="delModal.open=false">Batal</button>
                <button class="btn-danger" @click="confirmDeleteCourse()">
                    <span class="material-icons-round" style="font-size:17px;">delete</span> Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    {{-- Global Save --}}
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;">
        <button class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveAll()" :disabled="saving">
            <span class="material-icons-round" style="font-size:20px;" x-text="saving ? 'hourglass_empty' : 'save'"></span>
            <span x-text="saving ? 'Menyimpan...' : 'Simpan Seluruh Data Academy & Program'"></span>
        </button>
    </div>
</div>
@endsection

@push('scripts')
@php
$academyHeroRecord = \App\Models\AboutPage::where('section_key', 'academy_hero')->first();
$academyHero = $academyHeroRecord
    ? (is_array($academyHeroRecord->section_content) ? $academyHeroRecord->section_content : json_decode($academyHeroRecord->section_content ?? '[]', true) ?? [])
    : [];

$catData = $categories->map(function($cat) {
    return [
        'id'      => $cat->id,
        'key'     => $cat->category_key,
        'name'    => $cat->category_name,
        'subtitle'=> $cat->subtitle ?? '',
        'desc'    => $cat->description ?? '',
        'careers' => $cat->career_opportunities ?? '',
        'courses' => $cat->programs->map(function($p) {
            return [
                'id'      => $p->id,
                'title'   => $p->title,
                'country' => $p->country_badge ?? '',
                'desc'    => $p->description ?? '',
                'duration'=> $p->duration ?? '',
                'img'     => $p->thumbnail_url ?? '',
                'is_active' => (bool)$p->is_active,
            ];
        })->values()
    ];
})->values();
@endphp

<script>
function academyCompleteData() {
    return {
        saved: false,
        saving: false,
        errorMsg: '',
        activeCat: @json($categories->first() ? $categories->first()->id : null),
        hero: @json($academyHero),
        categories: @json($catData),

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
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ category_id: catId, title: this.addModal.title.trim() })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success !== false) location.reload();
                else { this.errorMsg = 'Gagal menambah program: ' + (data.message || ''); setTimeout(() => this.errorMsg = '', 5000); }
            })
            .catch(() => { this.errorMsg = 'Terjadi kesalahan jaringan.'; setTimeout(() => this.errorMsg = '', 5000); });
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
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ id: id })
            }).then(r => r.json()).then(() => location.reload()).catch(() => { this.errorMsg = 'Gagal menghapus program.'; setTimeout(() => this.errorMsg = '', 5000); });
        },

        saveAll() {
            if (this.saving) return;
            this.saving = true;
            this.errorMsg = '';
            const token = '{{ csrf_token() }}';
            const jsonHeaders = { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' };
            const promises = [];

            // 0. Save hero to about_pages (academy_hero key)
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

            // 1. Save each category to program_categories
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

            // 2. Save each program/course update
            this.categories.forEach(cat => {
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
@endpush

