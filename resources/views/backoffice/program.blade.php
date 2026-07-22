@extends('backoffice.layouts.app')
@section('title', 'Editor Academy & Program')
@section('page-title', 'Editor Lengkap Halaman Academy & Program')

@section('content')
<div x-data="academyCompleteData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh data Halaman Academy & Program berhasil disimpan (demo).
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
                        <h2 style="font-family:'Playfair Display',serif;font-size:20px;color:#2B2494;margin:0 0 4px;" x-text="cat.name"></h2>
                        <p style="font-size:13px;color:#8A8478;margin:0;" x-text="'Pengaturan deskripsi & daftar kursus untuk ' + cat.name"></p>
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
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="bo-label" style="font-size:11px;">URL Gambar Thumbnail</label>
                                <input type="text" class="bo-input" style="padding:7px;" x-model="course.img">
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
<script>
function academyCompleteData() {
    return {
        saved: false,
        activeCat: 'internasional',
        categories: [
            {
                id: 'internasional',
                name: 'Program Internasional',
                subtitle: 'GLOBAL OPPORTUNITY',
                desc: 'DHS bekerjasama dengan The Hotel School Melbourne & Sydney dan TAFE Australia untuk menyalurkan peserta didik DHS yang berminat lanjut untuk melaksanakan pendidikan di luar negeri.',
                careers: 'Hotel Staff, Restaurant Staff, Instruktur LKP/LPK, Wirausaha.',
                courses: [
                    { title: 'Program 1 Tahun + Ausbildung Jerman', country: '🇩🇪 JERMAN', desc: 'Pelatihan intensif 1 tahun di kampus dilanjutkan program penempatan Ausbildung kerja di Jerman.', img: 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?auto=format&fit=crop&w=800&h=600&q=80' },
                    { title: 'Program 2 Tahun + 1 Semester TAFE Australia', country: '🇦🇺 AUSTRALIA', desc: 'Studi komprehensif di Bali dengan transfer kredit 1 semester di TAFE Australia.', img: 'https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?auto=format&fit=crop&w=800&h=600&q=80' },
                    { title: 'TAFE Australia Pathway', country: '🇦🇺 AUSTRALIA', desc: 'Program penyaluran langsung menuju perkuliahan TAFE di Australia.', img: 'https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?auto=format&fit=crop&w=800&h=600&q=80' },
                    { title: 'THS Australia Pathway', country: '🇦🇺 AUSTRALIA', desc: 'Jalur studi khusus berpartner dengan The Hotel School Sydney & Melbourne.', img: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&h=600&q=80' },
                    { title: 'Australia Short Course', country: '🇦🇺 AUSTRALIA', desc: 'Pelatihan praktis jangka pendek terfokus langsung di Australia.', img: 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&h=600&q=80' },
                    { title: 'Study Visit (Australia & Singapura)', country: '🇸🇬 SINGAPURA & 🇦🇺 AUSTRALIA', desc: 'Kunjungan edukasi dan familiarisasi hotel mewah langsung ke Australia atau Singapura.', img: 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=800&h=600&q=80' }
                ]
            },
            {
                id: '2-tahun',
                name: 'Vokasi 2 Tahun',
                subtitle: 'DIPLOMA EQUIVALENT',
                desc: 'Program studi vokasi 2 tahun komprehensif dengan fokus praktikum industri dan jaminan OJT di hotel bintang 4 & 5.',
                careers: 'Supervisor, Assistant Manager, Head Chef, F&B Manager.',
                courses: [
                    { title: 'Manajemen Perhotelan (2 Tahun)', country: '🇮🇩 INDONESIA', desc: 'Pelatihan manajemen operasional lengkap Front Office, Housekeeping, & F&B.', img: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&h=600&q=80' },
                    { title: 'Culinary Arts & Gastronomy (2 Tahun)', country: '🇮🇩 INDONESIA', desc: 'Seni memasak tingkat lanjut mencakup masakan internasional, pastry, & kitchen management.', img: 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=800&h=600&q=80' },
                    { title: 'F&B Management (2 Tahun)', country: '🇮🇩 INDONESIA', desc: 'Manajemen restoran, banquet, wine knowledge, & barista profesional.', img: 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&h=600&q=80' }
                ]
            },
            {
                id: '1-tahun',
                name: 'Vokasi 1 Tahun',
                subtitle: 'INTENSIVE DIPLOMA',
                desc: 'Program 1 tahun siap kerja (6 bulan praktikum kampus + 6 bulan OJT di hotel bintang lima).',
                careers: 'Hotel Staff, Bartender, Cook, Receptionist, Room Attendant.',
                courses: [
                    { title: 'Food & Beverage Service (1 Tahun)', country: '🇮🇩 INDONESIA', desc: 'Layanan restoran, lounge, bar, & banquet profesional.', img: 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&h=600&q=80' },
                    { title: 'Culinary Arts (1 Tahun)', country: '🇮🇩 INDONESIA', desc: 'Dasar hingga tingkat menengah tata boga kontinental & Asia.', img: 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=800&h=600&q=80' },
                    { title: 'Room Division (1 Tahun)', country: '🇮🇩 INDONESIA', desc: 'Kombinasi Front Office & Housekeeping untuk luxury resort.', img: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&h=600&q=80' }
                ]
            },
            {
                id: '1-tahun-kapal-pesiar',
                name: '1 Tahun Kapal Pesiar',
                subtitle: 'CRUISE LINE SPECIALIST',
                desc: 'Program khusus penyiapan tenaga kerja perhotelan kapal pesiar internasional.',
                careers: 'Cruise Ship Steward, Ship Cook, Cruise Bartender, Galley Utility.',
                courses: [
                    { title: 'Cruise Ship Hospitality (1 Tahun)', country: '🛳️ GLOBAL CRUISE', desc: 'Kurikulum standar marinir internasional STCW & Marlborough.', img: 'https://images.unsplash.com/photo-1548574505-5e239809ee19?auto=format&fit=crop&w=800&h=600&q=80' }
                ]
            },
            {
                id: '6-bulan',
                name: 'Short Course 6 Bulan',
                subtitle: 'SKILL CERTIFICATION',
                desc: 'Kursus singkat sertifikasi keahlian spesifik industri perhotelan.',
                careers: 'Barista, Junior Cook, Waiter, Housekeeping Attendant.',
                courses: [
                    { title: 'Barista & Coffee Art (6 Bulan)', country: '🇮🇩 INDONESIA', desc: 'Sertifikasi keahlian meracik kopi & latte art.', img: 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=800&h=600&q=80' }
                ]
            },
            {
                id: 'eksekutif',
                name: 'Program Eksekutif (6 Bln)',
                subtitle: 'EXECUTIVE ACCELERATION',
                desc: 'Program percepatan untuk profesional muda & calon pekerja kapal pesiar dengan fasilitas dokumen kerja.',
                careers: 'Executive Staff, Cruise Ship Crew.',
                courses: [
                    { title: 'Eksekutif Cruise Line (6 Bulan)', country: '🛳️ GLOBAL CRUISE', desc: 'Program 6 bulan kapal pesiar dengan gratis paspor & seaman book.', img: '/image/Kapal.jpg' }
                ]
            }
        ],
        addCourse(catId) {
            const cat = this.categories.find(c => c.id === catId);
            if (cat) cat.courses.push({ title: 'Program Baru', country: '🇮🇩 INDONESIA', desc: 'Deskripsi program...', img: '' });
        },
        saveAll() {
            this.saved = true;
            setTimeout(() => this.saved = false, 3500);
        }
    };
}
</script>
@endpush
