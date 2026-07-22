@extends('backoffice.layouts.app')
@section('title', 'Footer')
@section('page-title', 'Pengaturan Footer')

@section('content')
<div x-data="footerData()">
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Footer berhasil disimpan (demo).
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">

        {{-- Kiri: Tentang + Sosmed --}}
        <div style="display:flex;flex-direction:column;gap:20px;">
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">Kolom Kiri — Tentang Sekolah</h2>
                <div class="form-group">
                    <label class="bo-label">Nama Sekolah (di Footer)</label>
                    <input type="text" class="bo-input" x-model="form.namaSekolah">
                </div>
                <div class="form-group">
                    <label class="bo-label">Deskripsi Singkat</label>
                    <textarea class="bo-textarea" rows="4" x-model="form.deskripsi"></textarea>
                </div>
                <div class="form-group">
                    <label class="bo-label">Alamat</label>
                    <textarea class="bo-textarea" rows="2" x-model="form.alamat"></textarea>
                </div>
            </div>

            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">Link Media Sosial</h2>
                <template x-for="(sosmed, key) in form.sosmed" :key="key">
                    <div class="form-group" style="display:flex;align-items:center;gap:12px;">
                        <div style="width:38px;height:38px;border-radius:10px;background:rgba(14,6,180,0.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span class="material-icons-round" style="font-size:20px;color:#0E06B4;" x-text="sosmed.icon"></span>
                        </div>
                        <input type="text" class="bo-input" :placeholder="sosmed.platform + ' URL'" x-model="sosmed.url">
                    </div>
                </template>
            </div>
        </div>

        {{-- Kanan: Link Kolom + Copyright --}}
        <div style="display:flex;flex-direction:column;gap:20px;">
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">Kolom "Explore"</h2>
                <template x-for="(link, idx) in form.exploreLinks" :key="idx">
                    <div style="display:flex;gap:10px;margin-bottom:10px;">
                        <input type="text" class="bo-input" style="flex:1;" placeholder="Label menu" x-model="link.label">
                        <input type="text" class="bo-input" style="flex:1;" placeholder="URL" x-model="link.url">
                        <button class="btn-icon danger" @click="form.exploreLinks.splice(idx,1)">
                            <span class="material-icons-round" style="font-size:17px;">close</span>
                        </button>
                    </div>
                </template>
                <button class="btn-secondary" style="width:100%;justify-content:center;padding:8px;font-size:12.5px;margin-top:4px;" @click="form.exploreLinks.push({label:'',url:''})">
                    <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Link
                </button>
            </div>

            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">Kolom "Admissions"</h2>
                <template x-for="(link, idx) in form.admissionsLinks" :key="idx">
                    <div style="display:flex;gap:10px;margin-bottom:10px;">
                        <input type="text" class="bo-input" style="flex:1;" placeholder="Label menu" x-model="link.label">
                        <input type="text" class="bo-input" style="flex:1;" placeholder="URL" x-model="link.url">
                        <button class="btn-icon danger" @click="form.admissionsLinks.splice(idx,1)">
                            <span class="material-icons-round" style="font-size:17px;">close</span>
                        </button>
                    </div>
                </template>
                <button class="btn-secondary" style="width:100%;justify-content:center;padding:8px;font-size:12.5px;margin-top:4px;" @click="form.admissionsLinks.push({label:'',url:''})">
                    <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Link
                </button>
            </div>

            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">Teks Copyright</h2>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="bo-label">Teks Copyright</label>
                    <input type="text" class="bo-input" x-model="form.copyright">
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top:20px;">
        <button class="btn-primary" @click="save()">
            <span class="material-icons-round" style="font-size:18px;">save</span>
            Simpan Pengaturan Footer
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
function footerData() {
    return {
        saved: false,
        form: {
            namaSekolah: 'Denpasar Hotel School',
            deskripsi: 'Sekolah vokasi hospitality terkemuka di Bali dengan lebih dari 35 tahun pengalaman mencetak profesional kelas dunia.',
            alamat: 'Jl. Nusa Indah No. 1, Denpasar, Bali 80234, Indonesia',
            sosmed: [
                { platform:'Instagram', icon:'photo_camera', url:'https://instagram.com/dhs_bali' },
                { platform:'Facebook',  icon:'thumb_up',     url:'https://facebook.com/dhs.bali' },
                { platform:'YouTube',   icon:'play_circle',  url:'https://youtube.com/@dhsbali' },
                { platform:'LinkedIn',  icon:'work',         url:'https://linkedin.com/school/dhs-bali' },
            ],
            exploreLinks: [
                { label:'Beranda', url:'/' },
                { label:'Tentang Kami', url:'/tentang-kami' },
                { label:'Akademi', url:'/akademi' },
                { label:'Berita', url:'/berita' },
                { label:'Karier', url:'/karier' },
            ],
            admissionsLinks: [
                { label:'Cara Mendaftar', url:'/cara-mendaftar' },
                { label:'Persyaratan', url:'/#contact-section' },
                { label:'Beasiswa', url:'/beasiswa' },
                { label:'Biaya Pendidikan', url:'/biaya' },
                { label:'FAQ', url:'/faq' },
            ],
            copyright: '© 2026 Denpasar Hotel School. All rights reserved.',
        },
        save() { this.saved = true; setTimeout(() => this.saved = false, 3000); }
    };
}
</script>
@endpush
