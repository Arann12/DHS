<?php $__env->startSection('title', 'Navigasi & Menu'); ?>
<?php $__env->startSection('page-title', 'Navigasi & Menu'); ?>

<?php $__env->startSection('content'); ?>
<div x-data="navigasiData()">
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Menu navigasi berhasil disimpan (demo).
    </div>

    <div class="bo-grid-sidebar" style="display:grid;grid-template-columns:1fr 380px;gap:24px;align-items:start;">

        
        <div class="bo-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#0F2440;margin:0;">Menu Navigasi</h2>
                <button class="btn-primary" style="padding:8px 14px;font-size:12.5px;" @click="addMenu()">
                    <span class="material-icons-round" style="font-size:16px;">add</span>
                    Tambah Menu
                </button>
            </div>
            <p style="font-size:13px;color:#718096;margin:0 0 20px;">Gunakan tombol ↑↓ untuk mengatur urutan. Label harus konsisten dengan judul (H1) halaman tujuan.</p>

            <div style="display:flex;flex-direction:column;gap:10px;">
                <template x-for="(item, idx) in menus" :key="idx">
                    <div style="display:flex;align-items:center;gap:12px;padding:14px 16px;background:#fafafa;border-radius:12px;border:1.5px solid #eee;">
                        <span class="material-icons-round" style="color:#ccc;flex-shrink:0;">drag_indicator</span>
                        <div style="display:flex;align-items:center;gap:10px;flex:1;min-width:0;">
                            <div style="flex:1;">
                                <label class="bo-label" style="font-size:11px;">Label Menu</label>
                                <input type="text" class="bo-input" style="padding:7px 11px;" x-model="item.label">
                            </div>
                            <div style="flex:1;">
                                <label class="bo-label" style="font-size:11px;">URL / Path</label>
                                <input type="text" class="bo-input" style="padding:7px 11px;" x-model="item.url">
                            </div>
                        </div>
                        <div style="display:flex;flex-direction:column;gap:4px;flex-shrink:0;">
                            <button class="btn-icon" style="width:28px;height:28px;" @click="moveUp(idx)" :disabled="idx===0" :style="idx===0?'opacity:0.3;':''">
                                <span class="material-icons-round" style="font-size:15px;">arrow_upward</span>
                            </button>
                            <button class="btn-icon" style="width:28px;height:28px;" @click="moveDown(idx)" :disabled="idx===menus.length-1" :style="idx===menus.length-1?'opacity:0.3;':''">
                                <span class="material-icons-round" style="font-size:15px;">arrow_downward</span>
                            </button>
                        </div>
                        <button class="btn-icon danger" style="flex-shrink:0;" @click="removeMenu(idx)">
                            <span class="material-icons-round" style="font-size:17px;">delete</span>
                        </button>
                    </div>
                </template>
            </div>

            <div style="margin-top:20px;">
                <button class="btn-primary" @click="save()">
                    <span class="material-icons-round" style="font-size:18px;">save</span>
                    Simpan Menu
                </button>
            </div>
        </div>

        
        <div style="display:flex;flex-direction:column;gap:18px;">
            
            <div class="bo-card" style="position:sticky;top:88px;">
                <h3 style="font-family:'Playfair Display',serif;font-size:16px;color:#0F2440;margin:0 0 14px;">Preview Navbar</h3>
                <div style="border-radius:12px;overflow:hidden;box-shadow:0 4px 16px rgba(0,0,0,0.1);">
                    <div style="background:#0F2440;padding:12px 18px;display:flex;align-items:center;justify-content:space-between;">
                        <div style="color:#fff;font-family:'Playfair Display',serif;font-size:14px;font-weight:700;">DHS</div>
                        <div style="display:flex;gap:14px;flex-wrap:wrap;">
                            <template x-for="item in menus" :key="item.label">
                                <div style="font-size:11.5px;color:rgba(255,255,255,0.78);cursor:pointer;" x-text="item.label"></div>
                            </template>
                        </div>
                    </div>
                </div>

                <hr class="divider">

                
                <h3 style="font-family:'Playfair Display',serif;font-size:15px;color:#0F2440;margin:0 0 12px;">Checklist Konsistensi (DESIGN.md)</h3>
                <div style="display:flex;flex-direction:column;gap:8px;">
                    <template x-for="item in menus" :key="item.label">
                        <div style="display:flex;align-items:center;gap:10px;padding:8px 12px;border-radius:8px;" :style="item.label ? 'background:#f0fdf4;' : 'background:#fff7ed;'">
                            <span class="material-icons-round" style="font-size:16px;" :style="item.label ? 'color:#16a34a;' : 'color:#f59e0b;'" x-text="item.label ? 'check_circle' : 'warning'"></span>
                            <div>
                                <div style="font-size:12.5px;font-weight:600;" x-text="item.label || '(kosong)'"></div>
                                <div style="font-size:11px;color:#718096;" x-text="item.url || 'URL belum diisi'"></div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function navigasiData() {
    <?php
        $menuData = $menus->map(fn($m) => ['id' => $m->id, 'label' => $m->menu_label, 'url' => $m->menu_url])->values();
    ?>
    return {
        saved: false,
        menus: <?php echo json_encode($menuData, 15, 512) ?>,
        addMenu() { this.menus.push({ label:'', url:'' }); },
        removeMenu(idx) { this.menus.splice(idx, 1); },
        moveUp(idx) {
            if (idx === 0) return;
            [this.menus[idx-1], this.menus[idx]] = [this.menus[idx], this.menus[idx-1]];
            this.menus = [...this.menus];
        },
        moveDown(idx) {
            if (idx === this.menus.length - 1) return;
            [this.menus[idx], this.menus[idx+1]] = [this.menus[idx+1], this.menus[idx]];
            this.menus = [...this.menus];
        },
        save() {
            const fd = new FormData();
            fd.append('_token', '<?php echo e(csrf_token()); ?>');
            this.menus.forEach((item, idx) => {
                fd.append('menus[' + idx + '][menu_label]', item.label || '');
                fd.append('menus[' + idx + '][menu_url]', item.url || '');
                fd.append('menus[' + idx + '][display_order]', idx + 1);
            });
            // Note: no dedicated bulk-update endpoint exists yet; store/update per-item or add one
            // For now, persist via individual calls
            const promises = this.menus.map((item, idx) => {
                if (item.id) {
                    return fetch(`/backoffice/navigasi/${item.id}/update`, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Content-Type': 'application/json' },
                        body: JSON.stringify({ menu_label: item.label, menu_url: item.url, display_order: idx + 1 })
                    });
                } else if (item.label) {
                    return fetch('/backoffice/navigasi/store', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Content-Type': 'application/json' },
                        body: JSON.stringify({ menu_label: item.label, menu_url: item.url, menu_type: 'header' })
                    });
                }
                return Promise.resolve();
            });
            Promise.all(promises).then(() => {
                this.saved = true;
                setTimeout(() => this.saved = false, 3000);
            }).catch(() => alert('Gagal menyimpan menu.'));
        }
    };
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backoffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/backoffice/navigasi.blade.php ENDPATH**/ ?>