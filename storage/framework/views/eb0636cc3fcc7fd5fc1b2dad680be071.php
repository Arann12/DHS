
<?php $__env->startSection('title', 'Editor Academy & Program'); ?>
<?php $__env->startSection('page-title', 'Editor Lengkap Halaman Academy & Program'); ?>

<?php $__env->startSection('content'); ?>
<div x-data="academyCompleteData()">

    
    <div x-show="saved" x-transition style="display:none;background:#d1fae5;border:1.5px solid #6ee7b7;border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-weight:600;font-size:14px;">
        <span class="material-icons-round">check_circle</span> Seluruh data Halaman Academy & Program berhasil disimpan (demo).
    </div>

    
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
                                <input type="text" class="bo-input" style="padding:7px;" x-model="course.country" placeholder="ðŸ‡©ðŸ‡ª JERMAN / ðŸ‡®ðŸ‡© BALI">
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

    
    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7eb;">
        <button class="btn-primary" style="padding:12px 28px;font-size:15px;" @click="saveAll()">
            <span class="material-icons-round" style="font-size:20px;">save</span>
            Simpan Seluruh Data Academy & Program
        </button>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<?php
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
?>

<script>
function academyCompleteData() {
    return {
        saved: false,
        activeCat: <?php echo json_encode($categories->first() ? $categories->first()->id : null, 15, 512) ?>,
        categories: <?php echo json_encode($catData, 15, 512) ?>,

        addCourse(catId) {
            const cat = this.categories.find(c => c.id === catId);
            if (!cat) return;
            const title = prompt('Judul Program Baru:');
            if (!title) return;
            const formData = new FormData();
            formData.append('category_id', catId);
            formData.append('title', title);
            formData.append('_token', '<?php echo e(csrf_token()); ?>');
            fetch('/backoffice/program/store', { method: 'POST', body: formData })
                .then(r => r.ok ? location.reload() : alert('Gagal menambah program.'));
        },

        deleteCourse(courseId) {
            if (!confirm('Hapus program ini dari database?')) return;
            fetch(`/backoffice/program/${courseId}/delete`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                body: JSON.stringify({ id: courseId })
            }).then(r => r.ok ? location.reload() : alert('Gagal menghapus program.'));
        },

        saveAll() {
            this.saved = true;
            setTimeout(() => this.saved = false, 3500);
        }
    };
}
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('backoffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/backoffice/program.blade.php ENDPATH**/ ?>