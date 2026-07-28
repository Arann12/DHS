@extends('backoffice.layouts.app')
@section('title', 'Editor About Us')
@section('page-title', 'Editor Lengkap Halaman About Us')

@section('content')
<div x-data="aboutUsCompleteData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh perubahan Halaman About Us berhasil disimpan.
    </div>

    {{-- Tabs --}}
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

    {{-- TAB 1: HERO --}}
    <div x-show="activeTab === 'hero'">
        <div class="bo-card" style="max-width:750px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">1. Hero Banner About Us</h2>
            <div class="form-group">
                <label class="bo-label">Judul Utama H1</label>
                <input type="text" class="bo-input" x-model="hero.title">
            </div>
            <div class="form-group">
                <label class="bo-label">Sub-label / Category</label>
                <input type="text" class="bo-input" x-model="hero.subtitle">
            </div>
            <div class="form-group">
                <label class="bo-label">Gambar Banner</label>
                <div style="display:flex;align-items:flex-start;gap:14px;">
                    <div style="width:140px;height:80px;border-radius:10px;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
                         @click="$store.imageUpload.open(url => { hero.bgImage = url })">
                        <template x-if="hero.bgImage">
                            <img :src="hero.bgImage" style="width:100%;height:100%;object-fit:cover;">
                        </template>
                        <template x-if="!hero.bgImage">
                            <span class="material-icons-round" style="color:#aaa;font-size:28px;">add_photo_alternate</span>
                        </template>
                    </div>
                    <div>
                        <button type="button" class="btn-secondary" style="font-size:12px;padding:7px 14px;"
                                @click="$store.imageUpload.open(url => { hero.bgImage = url })">
                            <span class="material-icons-round" style="font-size:16px;vertical-align:middle;">edit</span> Ganti Gambar
                        </button>
                        <button type="button" x-show="hero.bgImage" class="btn-danger" style="font-size:11px;padding:5px 10px;margin-top:6px;"
                                @click="hero.bgImage = ''">
                            <span class="material-icons-round" style="font-size:13px;">delete</span> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB 2: TAGLINE / INTRO --}}
    <div x-show="activeTab === 'intro'">
        <div class="bo-card" style="max-width:800px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">2. Tagline & Intro</h2>
            <div class="form-group">
                <label class="bo-label">Label Overline</label>
                <input type="text" class="bo-input" x-model="intro.label">
            </div>
            <div class="form-group">
                <label class="bo-label">Judul Tagline (H2)</label>
                <input type="text" class="bo-input" x-model="intro.headline">
            </div>
            <div class="form-group">
                <label class="bo-label">Paragraf 1</label>
                <textarea class="bo-textarea" rows="3" x-model="intro.p1"></textarea>
            </div>
            <div class="form-group">
                <label class="bo-label">Paragraf 2</label>
                <textarea class="bo-textarea" rows="3" x-model="intro.p2"></textarea>
            </div>
            <div class="form-group">
                <label class="bo-label">Teks Kutipan Samping (Quote)</label>
                <textarea class="bo-textarea" rows="2" x-model="intro.quote"></textarea>
            </div>
        </div>
    </div>

    {{-- TAB 3: VISI MISI CORE VALUES --}}
    <div x-show="activeTab === 'vision'">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
            <div style="display:flex;flex-direction:column;gap:20px;">
                <div class="bo-card">
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="bo-label">Section Label</label>
                            <input type="text" class="bo-input" x-model="vision.sectionLabel" placeholder="Tujuan Kami">
                        </div>
                        <div class="form-group">
                            <label class="bo-label">Section Title</label>
                            <input type="text" class="bo-input" x-model="vision.sectionTitle" placeholder="Visi, Misi & Core Values">
                        </div>
                    </div>
                </div>
                <div class="bo-card">
                    <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">
                        <input type="text" class="bo-input" style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;border:none;padding:0;background:transparent;" x-model="vision.visiLabel" placeholder="Visi">
                    </h2>
                    <textarea class="bo-textarea" rows="3" x-model="vision.visi"></textarea>
                </div>
                <div class="bo-card">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                        <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0;">
                            <input type="text" class="bo-input" style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;border:none;padding:0;background:transparent;width:120px;" x-model="vision.misiLabel" placeholder="Misi">
                        </h2>
                        <button class="btn-primary" style="padding:6px 12px;font-size:12px;" @click="vision.misi.push('')">
                            <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Item
                        </button>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        <template x-for="(m, idx) in vision.misi" :key="idx">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <input type="text" class="bo-input" x-model="vision.misi[idx]">
                                <button class="btn-icon danger" style="width:30px;height:30px;" @click="vision.misi.splice(idx,1)">
                                    <span class="material-icons-round" style="font-size:16px;">close</span>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Core Values</h2>
                <div style="display:flex;flex-direction:column;gap:14px;">
                    <template x-for="(val, idx) in vision.coreValues" :key="idx">
                        <div style="padding:12px;background:#fafafa;border-radius:10px;border:1.5px solid #eee;">
                            <input type="text" class="bo-input" style="padding:6px;font-weight:700;margin-bottom:6px;" x-model="val.title">
                            <textarea class="bo-textarea" style="min-height:50px;padding:6px;" x-model="val.desc"></textarea>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB 4: TIMELINE SEJARAH --}}
    <div x-show="activeTab === 'timeline'">
        <div class="bo-card" style="max-width:850px;">
            <div class="form-grid-2" style="margin-bottom:20px;">
                <div class="form-group">
                    <label class="bo-label">Section Label</label>
                    <input type="text" class="bo-input" x-model="timelineSectionLabel" placeholder="Perjalanan Kami">
                </div>
                <div class="form-group">
                    <label class="bo-label">Section Title</label>
                    <input type="text" class="bo-input" x-model="timelineSectionTitle" placeholder="Sejarah & Milestone">
                </div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0;">Milestone Timeline</h2>
                <button class="btn-primary" style="padding:6px 12px;font-size:12px;" @click="timeline.push({year:'', title:'', desc:''})">
                    <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Milestone
                </button>
            </div>

            <div style="display:flex;flex-direction:column;gap:14px;">
                <template x-for="(item, idx) in timeline" :key="idx">
                    <div style="padding:14px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;">
                        <div style="display:flex;gap:12px;margin-bottom:8px;">
                            <input type="text" class="bo-input" style="width:100px;font-weight:700;padding:6px;" x-model="item.year" placeholder="Tahun">
                            <input type="text" class="bo-input" style="flex:1;font-weight:700;padding:6px;" x-model="item.title" placeholder="Judul Milestone">
                            <button class="btn-icon danger" style="width:32px;height:32px;" @click="timeline.splice(idx,1)">
                                <span class="material-icons-round" style="font-size:16px;">delete</span>
                            </button>
                        </div>
                        <textarea class="bo-textarea" style="min-height:50px;padding:6px;" x-model="item.desc" placeholder="Deskripsi milestone..."></textarea>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- TAB 5: PESAN DIREKTUR & KEPEMIMPINAN --}}
    <div x-show="activeTab === 'leadership'">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Kata Sambutan Direktur</h2>
                <div class="form-group">
                    <label class="bo-label">Paragraf 1</label>
                    <textarea class="bo-textarea" rows="3" x-model="director.p1"></textarea>
                </div>
                <div class="form-group">
                    <label class="bo-label">Paragraf 2</label>
                    <textarea class="bo-textarea" rows="3" x-model="director.p2"></textarea>
                </div>
                <div class="form-group">
                    <label class="bo-label">Foto Direktur</label>
                    <div style="display:flex;align-items:flex-start;gap:12px;">
                        <div style="width:80px;height:80px;border-radius:50%;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
                             @click="$store.imageUpload.open(url => { director.photo = url })">
                            <template x-if="director.photo">
                                <img :src="director.photo" style="width:100%;height:100%;object-fit:cover;">
                            </template>
                            <template x-if="!director.photo">
                                <span class="material-icons-round" style="color:#aaa;font-size:24px;">person</span>
                            </template>
                        </div>
                        <div>
                            <button type="button" class="btn-secondary" style="font-size:12px;padding:6px 12px;"
                                    @click="$store.imageUpload.open(url => { director.photo = url })">
                                <span class="material-icons-round" style="font-size:15px;vertical-align:middle;">edit</span> Ganti
                            </button>
                            <button type="button" x-show="director.photo" class="btn-danger" style="font-size:11px;padding:4px 8px;margin-top:4px;"
                                    @click="director.photo = ''">
                                <span class="material-icons-round" style="font-size:13px;">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 16px;">Profil Tim Kepemimpinan</h2>
                <div class="form-group">
                    <label class="bo-label">Nama Lengkap & Gelar</label>
                    <input type="text" class="bo-input" x-model="leader.name">
                </div>
                <div class="form-group">
                    <label class="bo-label">Jabatan</label>
                    <input type="text" class="bo-input" x-model="leader.title">
                </div>
                <div class="form-group">
                    <label class="bo-label">Bio / Deskripsi Singkat</label>
                    <textarea class="bo-textarea" rows="3" x-model="leader.bio"></textarea>
                </div>
                <div class="form-group">
                    <label class="bo-label">Foto Profil</label>
                    <div style="display:flex;align-items:flex-start;gap:12px;">
                        <div style="width:80px;height:80px;border-radius:50%;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
                             @click="$store.imageUpload.open(url => { leader.photo = url })">
                            <template x-if="leader.photo">
                                <img :src="leader.photo" style="width:100%;height:100%;object-fit:cover;">
                            </template>
                            <template x-if="!leader.photo">
                                <span class="material-icons-round" style="color:#aaa;font-size:24px;">person</span>
                            </template>
                        </div>
                        <div>
                            <button type="button" class="btn-secondary" style="font-size:12px;padding:6px 12px;"
                                    @click="$store.imageUpload.open(url => { leader.photo = url })">
                                <span class="material-icons-round" style="font-size:15px;vertical-align:middle;">edit</span> Ganti
                            </button>
                            <button type="button" x-show="leader.photo" class="btn-danger" style="font-size:11px;padding:4px 8px;margin-top:4px;"
                                    @click="leader.photo = ''">
                                <span class="material-icons-round" style="font-size:13px;">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB 6: BOTTOM CTA --}}
    <div x-show="activeTab === 'cta'">
        <div class="bo-card" style="max-width:700px;">
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">6. CTA Bottom Banner</h2>
            <div class="form-group">
                <label class="bo-label">Judul Banner H2</label>
                <input type="text" class="bo-input" x-model="cta.title">
            </div>
            <div class="form-group">
                <label class="bo-label">Deskripsi Banner</label>
                <textarea class="bo-textarea" rows="3" x-model="cta.desc"></textarea>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="bo-label">Tombol 1 Teks</label>
                    <input type="text" class="bo-input" x-model="cta.btn1Text">
                </div>
                <div class="form-group">
                    <label class="bo-label">Tombol 1 URL</label>
                    <input type="text" class="bo-input" x-model="cta.btn1Url" placeholder="/akademi">
                </div>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="bo-label">Tombol 2 Teks</label>
                    <input type="text" class="bo-input" x-model="cta.btn2Text">
                </div>
                <div class="form-group">
                    <label class="bo-label">Tombol 2 URL</label>
                    <input type="text" class="bo-input" x-model="cta.btn2Url" placeholder="/cara-mendaftar">
                </div>
            </div>
        </div>
    </div>

    {{-- Global Save --}}
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;">
        <button class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveAll()" :disabled="saving">
            <span class="material-icons-round" style="font-size:20px;" x-text="saving ? 'hourglass_empty' : 'save'"></span>
            <span x-text="saving ? 'Menyimpan...' : 'Simpan Seluruh Perubahan Halaman About Us'"></span>
        </button>
    </div>
</div>
@endsection

@php
    $decode = function($key) use ($sections) {
        if (!isset($sections[$key])) return [];
        $c = $sections[$key]->section_content;
        return is_array($c) ? $c : (json_decode($c, true) ?? []);
    };
    $heroData     = $decode('hero');
    $introData    = $decode('intro');
    $visionData   = $decode('vision');
    $timelineData = $decode('timeline');
    $directorData = $decode('director');
    $leaderData   = $decode('leader');
    $ctaData      = $decode('cta');

    $heroJson = [
        'title'    => $heroData['title'] ?? 'Membangun Pemimpin Hospitality Masa Depan',
        'subtitle' => $heroData['subtitle'] ?? 'INSTITUSI & WARISAN',
        'bgImage'  => $heroData['bgImage'] ?? '',
    ];
    $introJson = [
        'label'    => $introData['label'] ?? 'TENTANG DHS',
        'headline' => $introData['headline'] ?? 'Transforming Into Excellent',
        'p1'       => $introData['p1'] ?? '',
        'p2'       => $introData['p2'] ?? '',
        'quote'    => $introData['quote'] ?? '',
    ];
    $visionJson = [
        'sectionLabel' => $visionData['sectionLabel'] ?? 'Tujuan Kami',
        'sectionTitle' => $visionData['sectionTitle'] ?? 'Visi, Misi & Core Values',
        'visiLabel'    => $visionData['visiLabel'] ?? 'Visi',
        'misiLabel'    => $visionData['misiLabel'] ?? 'Misi',
        'visi'         => $visionData['visi'] ?? '',
        'misi'         => $visionData['misi'] ?? [],
        'coreValues'   => $visionData['coreValues'] ?? [],
    ];
    $timelineSectionLabel = $timelineData['sectionLabel'] ?? 'Perjalanan Kami';
    $timelineSectionTitle = $timelineData['sectionTitle'] ?? 'Sejarah & Milestone';
    $timelineJson = $timelineData['items'] ?? [];
    $directorJson = [
        'p1'    => $directorData['p1'] ?? '',
        'p2'    => $directorData['p2'] ?? '',
        'photo' => $directorData['photo'] ?? '',
    ];
    $leaderJson = [
        'name'  => $leaderData['name'] ?? '',
        'title' => $leaderData['title'] ?? '',
        'bio'   => $leaderData['bio'] ?? '',
        'photo' => $leaderData['photo'] ?? '',
    ];
    $ctaJson = [
        'title'    => $ctaData['title'] ?? '',
        'desc'     => $ctaData['desc'] ?? '',
        'btn1Text' => $ctaData['btn1Text'] ?? '',
        'btn1Url'  => $ctaData['btn1Url'] ?? '/akademi',
        'btn2Text' => $ctaData['btn2Text'] ?? '',
        'btn2Url'  => $ctaData['btn2Url'] ?? '/cara-mendaftar',
    ];
@endphp

@push('scripts')
<script>
function aboutUsCompleteData() {
    return {
        saved: false,
        saving: false,
        activeTab: 'hero',
        tabs: [
            { id:'hero',       label:'1. Hero Banner',   icon:'wallpaper' },
            { id:'intro',      label:'2. Tagline & Intro', icon:'auto_stories' },
            { id:'vision',     label:'3. Visi & Misi & Values', icon:'stars' },
            { id:'timeline',   label:'4. Sejarah Timeline', icon:'timeline' },
            { id:'leadership', label:'5. Pesan & Leadership', icon:'record_voice_over' },
            { id:'cta',        label:'6. Bottom CTA', icon:'call_to_action' },
        ],
        hero: @json($heroJson),
        intro: @json($introJson),
        vision: @json($visionJson),
        timelineSectionLabel: '{{ $timelineSectionLabel }}',
        timelineSectionTitle: '{{ $timelineSectionTitle }}',
        timeline: @json($timelineJson),
        director: @json($directorJson),
        leader: @json($leaderJson),
        cta: @json($ctaJson),
        saveAll() {
            if (this.saving) return;
            this.saving = true;
            const sections = {
                hero: { title: 'Hero Banner', content: { title: this.hero.title, subtitle: this.hero.subtitle, bgImage: this.hero.bgImage } },
                intro: { title: 'Tagline & Intro', content: { label: this.intro.label, headline: this.intro.headline, p1: this.intro.p1, p2: this.intro.p2, quote: this.intro.quote } },
                vision: { title: 'Visi Misi Core Values', content: { sectionLabel: this.vision.sectionLabel, sectionTitle: this.vision.sectionTitle, visiLabel: this.vision.visiLabel, misiLabel: this.vision.misiLabel, visi: this.vision.visi, misi: this.vision.misi, coreValues: this.vision.coreValues } },
                timeline: { title: 'Sejarah Timeline', content: { sectionLabel: this.timelineSectionLabel, sectionTitle: this.timelineSectionTitle, items: this.timeline } },
                director: { title: 'Pesan Direktur', content: { p1: this.director.p1, p2: this.director.p2, photo: this.director.photo } },
                leader: { title: 'Tim Kepemimpinan', content: { name: this.leader.name, title: this.leader.title, bio: this.leader.bio, photo: this.leader.photo } },
                cta: { title: 'Bottom CTA', content: { title: this.cta.title, desc: this.cta.desc, btn1Text: this.cta.btn1Text, btn1Url: this.cta.btn1Url, btn2Text: this.cta.btn2Text, btn2Url: this.cta.btn2Url } }
            };
            const token = document.querySelector('meta[name="csrf-token"]').content;
            fetch('/backoffice/about-us/update', {
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
