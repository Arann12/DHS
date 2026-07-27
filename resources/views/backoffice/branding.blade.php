@extends('backoffice.layouts.app')
@section('title', 'Editor Logo DHS & Branding')
@section('page-title', 'Editor Lengkap Logo DHS & Branding')

@section('content')
<style>
    [x-cloak] { display: none !important; }
</style>

{{-- Image Upload Modal Component --}}
<template x-teleport="body">
    <div x-data="imageUploadModal()" x-show="$store.imageUpload.isOpen" x-cloak
         style="position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5);z-index:9999;display:flex;align-items:center;justify-content:center;"
         @click.self="$store.imageUpload.close()">
        <div style="background:#fff;border-radius:16px;width:90%;max-width:600px;max-height:90vh;overflow:auto;padding:24px;box-shadow:0 20px 60px rgba(0,0,0,0.3);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                <h3 style="font-family:'Playfair Display',serif;font-size:20px;color:#2B2494;margin:0;">Pilih Gambar</h3>
                <button @click="$store.imageUpload.close()" style="background:none;border:none;cursor:pointer;font-size:24px;color:#999;">&times;</button>
            </div>

            {{-- Tab Navigation --}}
            <div style="display:flex;gap:8px;margin-bottom:20px;border-bottom:2px solid #e5e7eb;">
                <button @click="mode = 'url'" 
                        :style="mode === 'url' ? 'border-bottom:2px solid #2B2494;color:#2B2494;' : 'color:#999;'"
                        style="padding:10px 20px;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;font-weight:600;margin-bottom:-2px;">
                    <span class="material-icons-round" style="font-size:18px;vertical-align:middle;">link</span>
                    Via URL
                </button>
                <button @click="mode = 'upload'" 
                        :style="mode === 'upload' ? 'border-bottom:2px solid #2B2494;color:#2B2494;' : 'color:#999;'"
                        style="padding:10px 20px;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;font-weight:600;margin-bottom:-2px;">
                    <span class="material-icons-round" style="font-size:18px;vertical-align:middle;">upload_file</span>
                    Upload Lokal
                </button>
            </div>

            {{-- URL Input Tab --}}
            <div x-show="mode === 'url'" style="padding:10px 0;">
                <label style="display:block;font-weight:600;color:#2B2494;margin-bottom:8px;">URL Gambar</label>
                <input type="text" x-model="tempUrl" @keyup.enter="applyUrl()" 
                       placeholder="https://example.com/image.jpg"
                       style="width:100%;padding:12px;border:1.5px solid #e0e0e0;border-radius:8px;font-size:14px;margin-bottom:12px;">
                
                <div x-show="tempUrl" style="border:1.5px solid #e0e0e0;border-radius:8px;padding:12px;margin-bottom:16px;text-align:center;background:#fafafa;">
                    <img :src="tempUrl" @error="$el.src=''" style="max-height:200px;max-width:100%;border-radius:6px;object-fit:contain;">
                </div>

                <div style="display:flex;gap:10px;justify-content:flex-end;">
                    <button @click="$store.imageUpload.close()" class="btn-secondary" style="padding:10px 20px;">
                        Batal
                    </button>
                    <button @click="applyUrl()" class="btn-primary" style="padding:10px 20px;">
                        <span class="material-icons-round" style="font-size:18px;vertical-align:middle;">check</span>
                        Gunakan URL
                    </button>
                </div>
            </div>

            {{-- Upload Tab --}}
            <div x-show="mode === 'upload'" style="padding:10px 0;">
                <div @click="$refs.fileInput.click()" 
                     style="border:2px dashed #cbd5e1;border-radius:12px;padding:40px;text-align:center;cursor:pointer;background:#fafafa;transition:all 0.2s;"
                     @mouseenter="$el.style.borderColor='#2B2494'; $el.style.background='#f0f4ff'"
                     @mouseleave="$el.style.borderColor='#cbd5e1'; $el.style.background='#fafafa'">
                    <span class="material-icons-round" style="font-size:48px;color:#2B2494;display:block;margin-bottom:12px;">cloud_upload</span>
                    <div style="font-weight:600;color:#2B2494;margin-bottom:4px;">Klik untuk pilih gambar</div>
                    <div style="font-size:12px;color:#999;">atau drag & drop file gambar di sini</div>
                    <div style="font-size:11px;color:#999;margin-top:8px;">Format: JPG, PNG, GIF, WebP (Max 5MB)</div>
                </div>
                <input type="file" x-ref="fileInput" accept="image/*" @change="handleFileUpload($event)" style="display:none;">
                
                <div x-show="preview" style="border:1.5px solid #e0e0e0;border-radius:8px;padding:12px;margin-top:16px;text-align:center;background:#fff;">
                    <img :src="preview" style="max-height:200px;max-width:100%;border-radius:6px;object-fit:contain;">
                </div>
            </div>
        </div>
    </div>
</template>

<div x-data="brandingCompleteData()">

    {{-- Alert Success --}}
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh pengaturan Logo DHS & Branding berhasil disimpan.
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
            primary: '{{ $settings["logo_primary"]->setting_value ?? "/image/LogoDHS.png" }}',
            favicon: '{{ $settings["logo_favicon"]->setting_value ?? "/favicon.ico" }}'
        },
        colors: [
            { key:'color_primary',   name:'DHS Royal Blue (Dominan)', value:'{{ $settings["color_primary"]->setting_value ?? "#0010B8" }}' },
            { key:'color_navy',      name:'Dark Navy (Header/Sidebar)', value:'{{ $settings["color_navy"]->setting_value ?? "#2B2494" }}' },
            { key:'color_secondary', name:'DHS Red (Aksen/Tombol)',     value:'{{ $settings["color_secondary"]->setting_value ?? "#D62828" }}' },
            { key:'color_cream',     name:'DHS Cream (Background)',     value:'{{ $settings["color_cream"]->setting_value ?? "#F6F2EA" }}' },
            { key:'color_beige',     name:'Warm Beige (Card/Section)',  value:'{{ $settings["color_beige"]->setting_value ?? "#EFE7D8" }}' }
        ],
        fonts: {
            heading: '{{ $settings["font_heading"]->setting_value ?? "Playfair Display, serif" }}',
            body: '{{ $settings["font_body"]->setting_value ?? "Inter, sans-serif" }}'
        },
        uploadImg(e, obj, prop) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = ev => obj[prop] = ev.target.result;
            reader.readAsDataURL(file);
        },
        saveAll() {
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            this.colors.forEach(c => formData.append(`settings[${c.key}]`, c.value));
            formData.append('settings[font_heading]', this.fonts.heading);
            formData.append('settings[font_body]', this.fonts.body);

            const logoInput = document.querySelector('[x-ref="logoInput"]');
            if (logoInput && logoInput.files[0]) {
                formData.append('logo_primary', logoInput.files[0]);
            }

            fetch('/backoffice/branding/update', { method: 'POST', body: formData })
                .then(r => r.ok ? location.reload() : alert('Gagal menyimpan branding.'));
        }
    };
}
</script>
@endpush

