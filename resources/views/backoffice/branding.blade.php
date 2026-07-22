@extends('backoffice.layouts.app')
@section('title', 'Editor Logo DHS & Branding')
@section('page-title', 'Editor Lengkap Logo DHS & Branding')

@section('content')
<div x-data="brandingCompleteData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh pengaturan Logo DHS & Branding berhasil disimpan (demo).
    </div>

    <div style="display:grid;grid-template-columns:1fr 340px;gap:24px;align-items:start;">

        <div style="display:flex;flex-direction:column;gap:20px;">

            {{-- Logo Variants --}}
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">1. File Logo DHS & Asset Branding</h2>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

                    {{-- Logo Utama --}}
                    <div>
                        <label class="bo-label">Logo Utama (Header / Navy BG)</label>
                        <div style="border:2px dashed #e0e0e0;border-radius:14px;padding:20px;text-align:center;background:#fafafa;cursor:pointer;"
                             @click="$refs.logoInput.click()">
                            <img x-show="logos.primary" :src="logos.primary" style="max-height:70px;max-width:100%;object-fit:contain;margin-bottom:8px;">
                            <div x-show="!logos.primary">
                                <span class="material-icons-round" style="font-size:32px;color:#ccc;">add_photo_alternate</span>
                                <div style="font-size:12px;color:#8A8478;">Upload Logo Utama</div>
                            </div>
                            <input type="file" x-ref="logoInput" accept="image/*" @change="uploadImg($event, logos, 'primary')" style="display:none;">
                        </div>
                    </div>

                    {{-- Favicon --}}
                    <div>
                        <label class="bo-label">Favicon Website (Icon Tab)</label>
                        <div style="border:2px dashed #e0e0e0;border-radius:14px;padding:20px;text-align:center;background:#fafafa;cursor:pointer;"
                             @click="$refs.favInput.click()">
                            <img x-show="logos.favicon" :src="logos.favicon" style="max-height:48px;max-width:48px;object-fit:contain;margin:0 auto 8px;display:block;">
                            <div x-show="!logos.favicon">
                                <span class="material-icons-round" style="font-size:32px;color:#ccc;">image</span>
                                <div style="font-size:12px;color:#8A8478;">Upload Favicon</div>
                            </div>
                            <input type="file" x-ref="favInput" accept="image/*" @change="uploadImg($event, logos, 'favicon')" style="display:none;">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Color Palette --}}
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 6px;">2. Palet Warna Resmi Logo DHS</h2>
                <p style="font-size:13px;color:#8A8478;margin:0 0 20px;">Sesuai panduan resmi DESIGN.md & warna logo asli.</p>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <template x-for="color in colors" :key="color.key">
                        <div style="display:flex;align-items:center;gap:12px;padding:12px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;">
                            <input type="color" :value="color.value" @input="color.value = $event.target.value" style="width:40px;height:40px;border:none;border-radius:8px;cursor:pointer;">
                            <div>
                                <div style="font-weight:700;font-size:13px;color:#1a1a2e;" x-text="color.name"></div>
                                <div style="font-size:12px;color:#8A8478;font-family:monospace;" x-text="color.value.toUpperCase()"></div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Typography & Font Family --}}
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">3. Font Tipografi</h2>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="bo-label">Font Headings (Judul)</label>
                        <input type="text" class="bo-input" x-model="fonts.heading">
                    </div>
                    <div class="form-group">
                        <label class="bo-label">Font Body (Teks Umum)</label>
                        <input type="text" class="bo-input" x-model="fonts.body">
                    </div>
                </div>
            </div>
        </div>

        {{-- Live Preview Branding --}}
        <div class="bo-card" style="position:sticky;top:88px;">
            <h3 style="font-family:'Playfair Display',serif;font-size:16px;color:#2B2494;margin:0 0 16px;">Preview Brand Color</h3>
            <div style="display:flex;flex-direction:column;gap:8px;">
                <template x-for="color in colors" :key="color.key">
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;border-radius:8px;color:#fff;font-weight:700;font-size:12px;"
                         :style="'background:' + color.value + ';color:' + (color.key === 'cream' || color.key === 'beige' ? '#1a1a2e' : '#fff')">
                        <span x-text="color.name"></span>
                        <span style="font-family:monospace;" x-text="color.value.toUpperCase()"></span>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- Global Save --}}
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;">
        <button class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveAll()">
            <span class="material-icons-round" style="font-size:20px;">save</span>
            Simpan Seluruh Pengaturan Logo DHS & Branding
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
function brandingCompleteData() {
    return {
        saved: false,
        logos: {
            primary: '/image/dhs-logo.png',
            favicon: '/favicon.ico'
        },
        colors: [
            { key:'blue',     name:'DHS Royal Blue (Dominan)', value:'#0010B8' },
            { key:'darkblue', name:'Dark Navy (Header/Sidebar)', value:'#2B2494' },
            { key:'red',      name:'DHS Red (Aksen/Tombol)',     value:'#DF1501' },
            { key:'cream',    name:'DHS Cream (Background)',     value:'#F6F2EA' },
            { key:'beige',    name:'Warm Beige (Card/Section)',  value:'#EFE7D8' },
            { key:'muted',    name:'Muted Gray (Subteks)',       value:'#8A8478' }
        ],
        fonts: {
            heading: 'Playfair Display, serif',
            body: 'Inter, sans-serif'
        },
        uploadImg(e, obj, prop) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = ev => obj[prop] = ev.target.result;
            reader.readAsDataURL(file);
        },
        saveAll() {
            this.saved = true;
            setTimeout(() => this.saved = false, 3500);
        }
    };
}
</script>
@endpush
