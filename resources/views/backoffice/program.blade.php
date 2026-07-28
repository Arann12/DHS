@extends('backoffice.layouts.app')
@section('title', 'Editor Academy & Program')
@section('page-title', 'Editor Lengkap Halaman Academy & Program')

@section('content')
<div x-data="academyCompleteData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh data Halaman Academy & Program berhasil disimpan.
    </div>

    {{-- Hero Section --}}
    <div class="bo-card" style="margin-bottom:20px;">
        <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Hero Section — Halaman Akademi</h2>
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
            <input type="text" class="bo-input" x-model="hero.bgImage" placeholder="URL gambar atau upload">
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
                        <h2 style="font-family:'Playfair Display',serif;font-size:20px;color:#2B2494;margin:0 0 4px;">
                            <input type="text" class="bo-input" style="font-family:'Playfair Display',serif;font-size:20px;color:#2B2494;border:none;padding:0;background:transparent;font-weight:700;" x-model="cat.name" placeholder="Nama Kategori">
                        </h2>
                        <p style="font-size:13px;color:#8A8478;margin:0;">Pengaturan deskripsi & daftar kursus</p>
                    </div>
                    <button class="btn-primary" style="padding:6px 14px;font-size:12.5px;" @click="addCourse(cat.id)">
                        <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Kursus
                    </button>
                </div>

                {{-- Panel Description --}}
                <div style="padding:16px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;margin-bottom:24px;">
                    <div class="form-group">
                        <label class="bo-label">Subtitle / Sub-header</label>
                        <input type="text" class="bo-input" x-model="cat.subtitle">
                    </div>
                    <div class="form-group">
                        <label class="bo-label">Deskripsi Kategori</label>
                        <textarea class="bo-textarea" rows="3" x-model="cat.desc"></textarea>
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="bo-label">Peluang Kerja Lulusan</label>
                        <input type="text" class="bo-input" x-model="cat.careers">
                    </div>
                </div>

                {{-- Courses List Grid --}}
                <h3 style="font-size:15px;font-weight:700;color:#2B2494;margin-bottom:14px;">Daftar Kursus / Modul</h3>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <template x-for="(course, idx) in cat.courses" :key="idx">
                        <div style="padding:16px;background:#fff;border-radius:12px;border:1.5px solid #eee;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
                                <span class="badge badge-blue" x-text="course.country || 'UMUM'"></span>
                                <button class="btn-icon danger" style="width:28px;height:28px;" @click="cat.courses.splice(idx,1)">
                                    <span class="material-icons-round" style="font-size:16px;">delete</span>
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="bo-label" style="font-size:11px;">Nama Kursus / Program</label>
                                <input type="text" class="bo-input" style="padding:7px;font-weight:700;" x-model="course.title">
                            </div>
                            <div class="form-group">
                                <label class="bo-label" style="font-size:11px;">Negara / Badge</label>
                                <input type="text" class="bo-input" style="padding:7px;" x-model="course.country" placeholder="🇩🇪 JERMAN / 🇮🇩 BALI">
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

    {{-- Global Save --}}
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;">
        <button class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveAll()">
            <span class="material-icons-round" style="font-size:20px;">save</span>
            Simpan Seluruh Data Academy & Program
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
        activeCat: @json($categories->first() ? $categories->first()->id : null),
        hero: @json($academyHero),
        categories: @json($catData),

        addCourse(catId) {
            const cat = this.categories.find(c => c.id === catId);
            if (!cat) return;
            const title = prompt('Judul Program Baru:');
            if (!title) return;
            const formData = new FormData();
            formData.append('category_id', catId);
            formData.append('title', title);
            formData.append('_token', '{{ csrf_token() }}');
            fetch('/backoffice/program/store', { method: 'POST', body: formData })
                .then(r => r.ok ? location.reload() : alert('Gagal menambah program.'));
        },

        deleteCourse(courseId) {
            if (!confirm('Hapus program ini dari database?')) return;
            fetch(`/backoffice/program/${courseId}/delete`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ id: courseId })
            }).then(r => r.ok ? location.reload() : alert('Gagal menghapus program.'));
        },

        saveAll() {
            const token = '{{ csrf_token() }}';
            const promises = [];

            // 0. Save hero to about_pages (academy_hero key)
            promises.push((() => {
                const fd = new FormData();
                fd.append('sections[academy_hero][title]', 'Akademi Hero');
                fd.append('sections[academy_hero][content][title]', this.hero.title || '');
                fd.append('sections[academy_hero][content][subtitle]', this.hero.subtitle || '');
                fd.append('sections[academy_hero][content][bgImage]', this.hero.bgImage || '');
                return fetch('/backoffice/about-us/update', { method: 'POST', body: fd, headers: { 'X-CSRF-TOKEN': token } });
            })());

            // 1. Save each category (subtitle, desc, careers) to program_categories
            this.categories.forEach(cat => {
                const fd = new FormData();
                fd.append('category_name', cat.name);
                fd.append('subtitle', cat.subtitle || '');
                fd.append('description', cat.desc || '');
                fd.append('career_opportunities', cat.careers || '');
                fd.append('_token', token);
                promises.push(fetch('/backoffice/program-category/' + cat.id + '/update', { method: 'POST', body: fd }));
            });

            // 2. Save each program/course update
            this.categories.forEach(cat => {
                cat.courses.forEach(course => {
                    if (!course.id) return; // skip new unsaved courses
                    const fd = new FormData();
                    fd.append('title', course.title || '');
                    fd.append('description', course.desc || '');
                    fd.append('country_badge', course.country || '');
                    fd.append('duration', course.duration || '');
                    fd.append('is_active', course.is_active ? '1' : '0');
                    fd.append('thumbnail_url', course.img || '');
                    fd.append('_token', token);
                    promises.push(fetch('/backoffice/program/' + course.id + '/update', { method: 'POST', body: fd }));
                });
            });

            Promise.all(promises).then(() => {
                this.saved = true;
                setTimeout(() => this.saved = false, 3500);
                location.reload();
            }).catch(() => alert('Gagal menyimpan data.'));
        }
    };
}
</script>
@endpush

