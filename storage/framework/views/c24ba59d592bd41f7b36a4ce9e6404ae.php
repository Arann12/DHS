<?php $__env->startSection('title', 'Editor Logo DHS & Branding'); ?>
<?php $__env->startSection('page-title', 'Editor Lengkap Logo DHS & Branding'); ?>

<?php $__env->startSection('content'); ?>
<div x-data="brandingCompleteData()">

    
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh pengaturan Logo DHS & Branding berhasil disimpan.
    </div>

    <div style="display:grid;grid-template-columns:1fr 340px;gap:24px;align-items:start;">

        <div style="display:flex;flex-direction:column;gap:20px;">

            
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#2B2494;margin:0 0 20px;">1. File Logo DHS & Asset Branding</h2>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

                    
                    <div>
                        <label class="bo-label">Logo Utama (Header / Navy BG)</label>
                        <div style="display:flex;align-items:flex-start;gap:14px;">
                            <div style="width:120px;height:80px;border-radius:10px;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
                                 @click="$store.imageUpload.open(url => { logos.primary = url })">
                                <template x-if="logos.primary">
                                    <img :src="logos.primary" style="width:100%;height:100%;object-fit:contain;">
                                </template>
                                <template x-if="!logos.primary">
                                    <span class="material-icons-round" style="color:#aaa;font-size:30px;">add_photo_alternate</span>
                                </template>
                            </div>
                            <div>
                                <button type="button" class="btn-secondary" style="font-size:12px;padding:7px 14px;"
                                        @click="$store.imageUpload.open(url => { logos.primary = url })">
                                    <span class="material-icons-round" style="font-size:16px;vertical-align:middle;">edit</span> Ganti Logo
                                </button>
                                <button type="button" x-show="logos.primary" class="btn-danger" style="font-size:11px;padding:5px 10px;margin-top:6px;"
                                        @click="logos.primary = ''">
                                    <span class="material-icons-round" style="font-size:13px;">delete</span> Hapus
                                </button>
                                <div style="font-size:10px;color:#999;margin-top:6px;">PNG, JPG, SVG, WebP (Max 5MB)</div>
                            </div>
                        </div>
                    </div>

                    
                    <div>
                        <label class="bo-label">Favicon Website (Icon Tab)</label>
                        <div style="display:flex;align-items:flex-start;gap:14px;">
                            <div style="width:64px;height:64px;border-radius:10px;overflow:hidden;border:2px dashed #d1d5db;flex-shrink:0;cursor:pointer;display:flex;align-items:center;justify-content:center;background:#fafafa;"
                                 @click="$store.imageUpload.open(url => { logos.favicon = url })">
                                <template x-if="logos.favicon">
                                    <img :src="logos.favicon" style="width:100%;height:100%;object-fit:contain;">
                                </template>
                                <template x-if="!logos.favicon">
                                    <span class="material-icons-round" style="color:#aaa;font-size:24px;">image</span>
                                </template>
                            </div>
                            <div>
                                <button type="button" class="btn-secondary" style="font-size:12px;padding:7px 14px;"
                                        @click="$store.imageUpload.open(url => { logos.favicon = url })">
                                    <span class="material-icons-round" style="font-size:16px;vertical-align:middle;">edit</span> Ganti Favicon
                                </button>
                                <button type="button" x-show="logos.favicon" class="btn-danger" style="font-size:11px;padding:5px 10px;margin-top:6px;"
                                        @click="logos.favicon = ''">
                                    <span class="material-icons-round" style="font-size:13px;">delete</span> Hapus
                                </button>
                                <div style="font-size:10px;color:#999;margin-top:6px;">ICO, PNG (Max 2MB)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
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

    
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;">
        <button class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveAll()" :disabled="saving">
            <span class="material-icons-round" style="font-size:20px;" x-text="saving ? 'hourglass_empty' : 'save'"></span>
            <span x-text="saving ? 'Menyimpan...' : 'Simpan Seluruh Pengaturan Logo DHS & Branding'"></span>
        </button>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function brandingCompleteData() {
    return {
        saved: false,
        saving: false,
        logos: {
            primary: '<?php echo e($settings["logo_primary"]->setting_value ?? "/image/LogoDHS.png"); ?>',
            favicon: '<?php echo e($settings["logo_favicon"]->setting_value ?? "/favicon.ico"); ?>'
        },
        colors: [
            { key:'color_primary',   name:'DHS Royal Blue (Dominan)', value:'<?php echo e($settings["color_primary"]->setting_value ?? "#0010B8"); ?>' },
            { key:'color_navy',      name:'Dark Navy (Header/Sidebar)', value:'<?php echo e($settings["color_navy"]->setting_value ?? "#2B2494"); ?>' },
            { key:'color_secondary', name:'DHS Red (Aksen/Tombol)',     value:'<?php echo e($settings["color_secondary"]->setting_value ?? "#D62828"); ?>' },
            { key:'color_cream',     name:'DHS Cream (Background)',     value:'<?php echo e($settings["color_cream"]->setting_value ?? "#F6F2EA"); ?>' },
            { key:'color_beige',     name:'Warm Beige (Card/Section)',  value:'<?php echo e($settings["color_beige"]->setting_value ?? "#EFE7D8"); ?>' }
        ],
        fonts: {
            heading: '<?php echo e($settings["font_heading"]->setting_value ?? "Playfair Display, serif"); ?>',
            body: '<?php echo e($settings["font_body"]->setting_value ?? "Inter, sans-serif"); ?>'
        },
        saveAll() {
            if (this.saving) return; // Prevent double submit
            this.saving = true;

            const formData = new FormData();
            formData.append('_token', '<?php echo e(csrf_token()); ?>');

            // Append all color settings
            this.colors.forEach(c => formData.append(`settings[${c.key}]`, c.value));

            // Append font settings
            formData.append('settings[font_heading]', this.fonts.heading);
            formData.append('settings[font_body]', this.fonts.body);

            // Handle logo primary: if it's a base64 data URL, convert to File
            if (this.logos.primary) {
                if (this.logos.primary.startsWith('data:')) {
                    formData.append('logo_primary', dataURLtoFile(this.logos.primary, 'logo_primary.png'));
                } else {
                    // Also send URL as setting so backend can store it
                    formData.append('settings[logo_primary]', this.logos.primary);
                }
            }

            // Handle favicon: if it's a base64 data URL, convert to File
            if (this.logos.favicon) {
                if (this.logos.favicon.startsWith('data:')) {
                    formData.append('logo_favicon', dataURLtoFile(this.logos.favicon, 'favicon.png'));
                } else {
                    formData.append('settings[logo_favicon]', this.logos.favicon);
                }
            }

            // Send with proper headers
            fetch('/backoffice/branding/update', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(r => {
                if (r.ok) {
                    this.saved = true;
                    setTimeout(() => location.reload(), 1500);
                } else {
                    this.saving = false;
                    alert('Gagal menyimpan branding. Silakan coba lagi.');
                }
            })
            .catch(err => {
                this.saving = false;
                console.error('Error:', err);
                alert('Terjadi kesalahan saat menyimpan branding.');
            });
        }
    };
}
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('backoffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/backoffice/branding.blade.php ENDPATH**/ ?>