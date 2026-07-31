@extends('backoffice.layouts.app')
@section('title', 'Footer')
@section('page-title', 'Pengaturan Footer')

@section('content')
<div x-data="footerData()">
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Pengaturan Footer berhasil disimpan ke database.
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">

        {{-- Kiri: Info Sekolah + Sosmed --}}
        <div style="display:flex;flex-direction:column;gap:20px;">
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#101340;margin:0 0 20px;">Informasi Sekolah</h2>
                <div class="form-group">
                    <label class="bo-label">Nama Sekolah</label>
                    <input type="text" class="bo-input" x-model="form.site_name">
                </div>
                <div class="form-group">
                    <label class="bo-label">Tagline</label>
                    <input type="text" class="bo-input" x-model="form.tagline">
                </div>
                <div class="form-group">
                    <label class="bo-label">Copyright</label>
                    <input type="text" class="bo-input" x-model="form.copyright">
                </div>
            </div>

            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#101340;margin:0 0 20px;">Kampus Denpasar</h2>
                <div class="form-group">
                    <label class="bo-label">Alamat</label>
                    <textarea class="bo-textarea" rows="2" x-model="form.address_denpasar"></textarea>
                </div>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="bo-label">No. Telepon/WA</label>
                        <input type="text" class="bo-input" x-model="form.phone_denpasar">
                    </div>
                    <div class="form-group">
                        <label class="bo-label">Email</label>
                        <input type="text" class="bo-input" x-model="form.email">
                    </div>
                </div>
            </div>

            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#101340;margin:0 0 20px;">Kampus Klungkung</h2>
                <div class="form-group">
                    <label class="bo-label">Alamat</label>
                    <textarea class="bo-textarea" rows="2" x-model="form.address_klungkung"></textarea>
                </div>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="bo-label">Telepon</label>
                        <input type="text" class="bo-input" x-model="form.phone_klungkung">
                    </div>
                    <div class="form-group">
                        <label class="bo-label">WA</label>
                        <input type="text" class="bo-input" x-model="form.wa_klungkung">
                    </div>
                </div>
            </div>

            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#101340;margin:0 0 20px;">Link Media Sosial</h2>
                <template x-for="(sosmed, key) in form.sosmed" :key="key">
                    <div class="form-group" style="display:flex;align-items:center;gap:12px;">
                        <div style="width:38px;height:38px;border-radius:10px;background:rgba(14,6,180,0.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span class="material-icons-round" style="font-size:20px;color:#1A1F6B;" x-text="sosmed.icon"></span>
                        </div>
                        <input type="text" class="bo-input" :placeholder="sosmed.platform + ' URL'" x-model="sosmed.url">
                    </div>
                </template>
            </div>
        </div>

        {{-- Kanan: Link Kolom + Extra --}}
        <div style="display:flex;flex-direction:column;gap:20px;">
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#101340;margin:0 0 20px;">Kolom "Eksplorasi"</h2>
                <template x-for="(link, idx) in form.exploreLinks" :key="idx">
                    <div style="display:flex;gap:10px;margin-bottom:10px;">
                        <input type="text" class="bo-input" style="flex:1;" placeholder="Label" x-model="link.label">
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
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#101340;margin:0 0 20px;">Kolom "Pendaftaran & Link"</h2>
                <template x-for="(link, idx) in form.admissionLinks" :key="idx">
                    <div style="display:flex;gap:10px;margin-bottom:10px;">
                        <input type="text" class="bo-input" style="flex:1;" placeholder="Label" x-model="link.label">
                        <input type="text" class="bo-input" style="flex:1;" placeholder="URL" x-model="link.url">
                        <button class="btn-icon danger" @click="form.admissionLinks.splice(idx,1)">
                            <span class="material-icons-round" style="font-size:17px;">close</span>
                        </button>
                    </div>
                </template>
                <button class="btn-secondary" style="width:100%;justify-content:center;padding:8px;font-size:12.5px;margin-top:4px;" @click="form.admissionLinks.push({label:'',url:''})">
                    <span class="material-icons-round" style="font-size:16px;">add</span> Tambah Link
                </button>
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
    const settings = @json($settings->mapWithKeys(fn($s) => [$s->setting_key => $s->setting_value])->toArray());
    return {
        saved: false,
        form: {
            site_name: settings.site_name ?? 'Denpasar Hotel School',
            tagline: settings.tagline ?? '"Transforming Into Excellent"',
            copyright: settings.copyright ?? '© 2026 Denpasar Hotel School.',
            address_denpasar: settings.address_denpasar ?? 'Jl. Sari Dana IV No. 1 Gatsu Barat, Denpasar 80116, Bali',
            phone_denpasar: settings.phone_denpasar ?? '+62 81 246 319966',
            email: settings.email ?? 'sahabat@dhs.or.id',
            address_klungkung: settings.address_klungkung ?? 'Jl. Raya Takmung No. 36, Klungkung 80752, Bali',
            phone_klungkung: settings.phone_klungkung ?? '+0366 5582998',
            wa_klungkung: settings.wa_klungkung ?? '+62 81 337 106480',
            sosmed: [
                { platform:'Instagram', icon:'photo_camera', key:'instagram_url', url: settings.instagram_url ?? '' },
                { platform:'Facebook',  icon:'thumb_up',     key:'facebook_url',  url: settings.facebook_url ?? '' },
                { platform:'YouTube',   icon:'play_circle',  key:'youtube_url',   url: settings.youtube_url ?? '' },
            ],
            exploreLinks: settings.explore_links ? JSON.parse(settings.explore_links) : [
                { label:'Beranda', url:'/' },
                { label:'Tentang DHS', url:'/tentang-kami' },
                { label:'Akademi', url:'/akademi' },
                { label:'Berita & Artikel', url:'/berita' },
            ],
            admissionLinks: settings.admission_links ? JSON.parse(settings.admission_links) : [
                { label:'Pendaftaran Online', url:'/formulir-pendaftaran' },
                { label:'Unduh Brosur Biaya', url:'https://linktr.ee/BiayaPendidikan_DHS' },
                { label:'FAQ', url:'/faq' },
                { label:'Karier', url:'/karier' },
            ],
        },
        save() {
            const fd = new FormData();
            fd.append('_token', '{{ csrf_token() }}');
            fd.append('settings[site_name]', this.form.site_name);
            fd.append('settings[tagline]', this.form.tagline);
            fd.append('settings[copyright]', this.form.copyright);
            fd.append('settings[address_denpasar]', this.form.address_denpasar);
            fd.append('settings[phone_denpasar]', this.form.phone_denpasar);
            fd.append('settings[email]', this.form.email);
            fd.append('settings[address_klungkung]', this.form.address_klungkung);
            fd.append('settings[phone_klungkung]', this.form.phone_klungkung);
            fd.append('settings[wa_klungkung]', this.form.wa_klungkung);
            this.form.sosmed.forEach(s => fd.append('settings[' + s.key + ']', s.url || ''));
            fd.append('settings[explore_links]', JSON.stringify(this.form.exploreLinks));
            fd.append('settings[admission_links]', JSON.stringify(this.form.admissionLinks));

            fetch('/backoffice/footer-cms/update', { method: 'POST', body: fd, headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                .then(r => r.ok ? location.reload() : alert('Gagal menyimpan footer.'));
        }
    };
}
</script>
@endpush
