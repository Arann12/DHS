<?php $__env->startSection('title', 'Pengaturan Warna Website'); ?>
<?php $__env->startSection('page-title', 'Color Palette Manager'); ?>

<?php $__env->startSection('content'); ?>
<div x-data="colorPaletteManager()">

    
    <?php if(session('success')): ?>
    <div style="background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    
    <div class="bo-card" style="margin-bottom:24px;background:linear-gradient(135deg, #F5F6F8 0%, #EBF0FA 100%);">
        <div style="display:flex;align-items:start;gap:16px;">
            <div style="width:50px;height:50px;background:#1A1F6B;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span class="material-icons-round" style="color:#fff;font-size:28px;">palette</span>
            </div>
            <div>
                <h3 style="margin:0 0 8px;font-family:'Playfair Display',serif;font-size:20px;color:#101340;">Kelola Palet Warna Website</h3>
                <p style="margin:0;color:#666;font-size:13.5px;line-height:1.6;">
                    Ubah skema warna utama website DHS secara real-time. Gunakan color picker atau masukkan kode HEX warna.
                </p>
            </div>
        </div>
    </div>

    
    <form method="POST" action="/backoffice/color-palette/update" @submit.prevent="submitForm">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="_method" value="POST">

        <div class="bo-card">
            <h3 style="margin:0 0 20px;font-family:'Playfair Display',serif;font-size:18px;color:#101340;border-bottom:2px solid #eee;padding-bottom:12px;">
                Warna Utama Website
            </h3>

            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(280px, 1fr));gap:20px;">
                <template x-for="(item, idx) in colors" :key="item.key">
                    <div class="color-item">
                        <input type="hidden" :name="'colors[' + idx + '][setting_key]'" :value="item.key">
                        <div style="display:flex;align-items:center;gap:12px;margin-bottom:10px;">
                            <div class="color-preview" :style="'background:' + item.value"></div>
                            <div style="flex:1;">
                                <label class="bo-label" style="margin-bottom:4px;" x-text="item.label"></label>
                                <p style="margin:0;font-size:11px;color:#888;" x-text="item.desc"></p>
                            </div>
                        </div>
                        <div style="display:flex;gap:8px;">
                            <input type="color" :value="item.value" @input="item.value = $event.target.value" style="width:60px;height:42px;border:2px solid #e0e0e0;border-radius:8px;cursor:pointer;">
                            <input type="text" x-model="item.value" :name="'colors[' + idx + '][setting_value]'"
                                class="bo-input" :placeholder="item.default"
                                style="flex:1;font-family:monospace;text-transform:uppercase;">
                        </div>
                    </div>
                </template>
            </div>

            
            <div style="margin-top:32px;padding-top:20px;border-top:2px solid #eee;display:flex;align-items:center;justify-content:space-between;gap:12px;">
                <button type="button" @click="resetToDefault()" class="btn-secondary">
                    <span class="material-icons-round" style="font-size:18px;">restart_alt</span>
                    Reset ke Warna Default
                </button>
                <button type="submit" class="btn-primary" :disabled="saving">
                    <span class="material-icons-round" style="font-size:18px;" x-show="!saving">save</span>
                    <span x-show="saving" style="width:16px;height:16px;border:2px solid rgba(255,255,255,0.3);border-top-color:#fff;border-radius:50%;animation:spin 0.6s linear infinite;display:inline-block;"></span>
                    <span x-text="saving ? 'Menyimpan...' : 'Simpan Perubahan'">Simpan Perubahan</span>
                </button>
            </div>
        </div>
    </form>

    
    <div class="bo-card" style="margin-top:24px;">
        <h3 style="margin:0 0 16px;font-family:'Playfair Display',serif;font-size:18px;color:#101340;">
            <span class="material-icons-round" style="vertical-align:middle;font-size:22px;margin-right:6px;">visibility</span>
            Preview Warna
        </h3>
        <p style="margin:0 0 20px;color:#666;font-size:13px;">
            Pratinjau bagaimana warna yang dipilih akan terlihat pada elemen website:
        </p>
        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:16px;">
            <div :style="'padding:20px;border-radius:12px;background:' + getColor('color_primary') + ';color:#fff;text-align:center;font-weight:600;'">
                Primary Button
            </div>
            <div :style="'padding:20px;border-radius:12px;background:' + getColor('color_secondary') + ';color:#fff;text-align:center;font-weight:600;'">
                Secondary Button
            </div>
            <div :style="'padding:20px;border-radius:12px;background:' + getColor('color_navy') + ';color:#fff;text-align:center;font-weight:600;'">
                Navy Element
            </div>
            <div :style="'padding:20px;border-radius:12px;background:' + getColor('color_cream') + ';border:2px solid #e0e0e0;text-align:center;font-weight:600;color:#333;'">
                Cream Background
            </div>
        </div>
    </div>
</div>

<style>
    .color-preview {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15), inset 0 0 0 1px rgba(0,0,0,0.1);
        flex-shrink: 0;
    }
    .color-item {
        padding: 16px;
        border: 2px solid #f0f0f0;
        border-radius: 12px;
        transition: all 0.2s;
    }
    .color-item:hover {
        border-color: #1A1F6B;
        box-shadow: 0 4px 12px rgba(14,6,180,0.1);
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<script>
function colorPaletteManager() {
    return {
        saving: false,
        colors: [
            { key: 'color_primary',   label: 'Primary Color (Navy)',  desc: 'Warna utama tombol & heading',       default: '#1A1F6B', value: '<?php echo e($colors["color_primary"]->setting_value ?? "#1A1F6B"); ?>' },
            { key: 'color_secondary', label: 'Secondary Color (Red)', desc: 'Warna aksen & highlight',            default: '#D4302A', value: '<?php echo e($colors["color_secondary"]->setting_value ?? "#D4302A"); ?>' },
            { key: 'color_navy',      label: 'Navy Color',            desc: 'Warna navy untuk elemen dekoratif',  default: '#101340', value: '<?php echo e($colors["color_navy"]->setting_value ?? "#101340"); ?>' },
            { key: 'color_cream',     label: 'Cream Background',      desc: 'Warna background section',           default: '#F5F6F8', value: '<?php echo e($colors["color_cream"]->setting_value ?? "#F5F6F8"); ?>' },
            { key: 'color_beige',     label: 'Beige Surface',         desc: 'Warna permukaan alternatif',         default: '#EBF0FA', value: '<?php echo e($colors["color_beige"]->setting_value ?? "#EBF0FA"); ?>' },
        ],

        getColor(key) {
            const item = this.colors.find(c => c.key === key);
            return item ? item.value : '#ccc';
        },

        submitForm(event) {
            this.saving = true;
            event.target.submit();
        },

        resetToDefault() {
            if (!confirm('Reset semua warna ke pengaturan default DHS?')) return;
            this.colors.forEach(item => {
                item.value = item.default;
            });
        }
    };
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backoffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views\backoffice\color-palette.blade.php ENDPATH**/ ?>