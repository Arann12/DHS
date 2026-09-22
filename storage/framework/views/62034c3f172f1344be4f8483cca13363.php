
<?php $__env->startSection('title', 'Kelola Halaman Detail Program'); ?>
<?php $__env->startSection('page-title', 'Editor Halaman Detail Program & Pelatihan'); ?>

<?php $__env->startSection('content'); ?>
<div>

    
    <div style="margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;">
        <div>
            <h2 style="font-family:'Playfair Display',serif;font-size:20px;color:#0F2440;margin:0 0 4px;">Daftar Editor Halaman Program Detail</h2>
            <p style="font-size:13px;color:#718096;margin:0;">Pilih salah satu program studi di bawah untuk mengedit seluruh teks, aktivitas 4 box, 5 poin benefit, modul kurikulum, syarat, dan fasilitas yang tampil di website publik.</p>
        </div>
        <div class="badge badge-blue" style="padding:8px 16px;font-size:12px;"><?php echo e($programs->count()); ?> Program Aktif</div>
    </div>

    
    <div class="bo-grid-2" style="display:grid;grid-template-columns:repeat(auto-fill, minmax(360px, 1fr));gap:20px;">
        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bo-card" style="display:flex;flex-direction:column;justify-content:space-between;border-left:4px solid #C53030;position:relative;overflow:hidden;">
            <div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                    <span class="badge badge-blue" style="font-size:10.5px;"><?php echo e($prog->category ? $prog->category->category_name : 'Program DHS'); ?></span>
                    <?php if($prog->country_badge): ?>
                    <span style="font-size:11px;font-weight:700;background:#0F2440;color:#fff;padding:2px 8px;border-radius:6px;"><?php echo e($prog->country_badge); ?></span>
                    <?php endif; ?>
                </div>

                <h3 style="font-family:'Playfair Display',serif;font-size:17px;font-weight:700;color:#0F2440;margin:0 0 6px;"><?php echo e($prog->title); ?></h3>

                <p style="font-size:12.5px;color:#555;line-height:1.5;margin:0 0 14px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                    <?php echo e($prog->description ?: 'Program pendidikan vokasi perhotelan, kapal pesiar, dan kuliner Denpasar Hotel School.'); ?>

                </p>

                <div style="background:#f8fafc;border-radius:8px;padding:10px 12px;font-size:11.5px;color:#475569;margin-bottom:16px;display:flex;flex-direction:column;gap:4px;">
                    <div>⏱️ <strong>Durasi Studi:</strong> <?php echo e($prog->duration ?: '1 – 2 Tahun'); ?></div>
                    <div>🔗 <strong>URL Website:</strong> <code style="color:#0F2440;">/program/<?php echo e($prog->slug); ?></code></div>
                </div>
            </div>

            <div style="display:flex;align-items:center;gap:10px;border-top:1px solid #eee;padding-top:14px;margin-top:auto;">
                <a href="/backoffice/program-detail/<?php echo e($prog->slug); ?>" class="btn-primary" style="flex:1;justify-content:center;padding:8px 14px;font-size:12.5px;text-decoration:none;">
                    <span class="material-icons-round" style="font-size:16px;">edit</span> Edit Konten Halaman Ini
                </a>
                <a href="/program/<?php echo e($prog->slug); ?>" target="_blank" class="btn-secondary" style="padding:8px 12px;font-size:12.5px;text-decoration:none;" title="Lihat Tampilan Public">
                    <span class="material-icons-round" style="font-size:16px;">open_in_new</span>
                </a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backoffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/backoffice/program-detail-index.blade.php ENDPATH**/ ?>