<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="bo-grid-4" style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:28px;">

        <div class="bo-card" style="border-left:4px solid #1A365D;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#718096;">Total Berita</div>
                <div style="width:40px;height:40px;border-radius:12px;background:rgba(197,48,48,0.1);display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:20px;color:#1A365D;">article</span>
                </div>
            </div>
            <div style="font-family:'Playfair Display',serif;font-size:34px;font-weight:700;color:#0F2440;line-height:1;"><?php echo e($stats['berita']); ?></div>
            <div style="font-size:12.5px;color:#718096;margin-top:6px;">Total artikel berita</div>
        </div>

        <div class="bo-card" style="border-left:4px solid #16a34a;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#718096;">Program Studi</div>
                <div style="width:40px;height:40px;border-radius:12px;background:rgba(22,163,74,0.1);display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:20px;color:#16a34a;">school</span>
                </div>
            </div>
            <div style="font-family:'Playfair Display',serif;font-size:34px;font-weight:700;color:#0F2440;line-height:1;"><?php echo e($stats['program']); ?></div>
            <div style="font-size:12.5px;color:#718096;margin-top:6px;">Total program aktif</div>
        </div>

        <div class="bo-card" style="border-left:4px solid #f59e0b;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#718096;">Pendaftar Baru</div>
                <div style="width:40px;height:40px;border-radius:12px;background:rgba(245,158,11,0.1);display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:20px;color:#f59e0b;">how_to_reg</span>
                </div>
            </div>
            <div style="font-family:'Playfair Display',serif;font-size:34px;font-weight:700;color:#0F2440;line-height:1;"><?php echo e($stats['pendaftar']); ?></div>
            <div style="font-size:12.5px;color:#718096;margin-top:6px;">Total formulir masuk</div>
        </div>

        <div class="bo-card" style="border-left:4px solid #C53030;padding:20px 24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#718096;">Pengguna Admin</div>
                <div style="width:40px;height:40px;border-radius:12px;background:rgba(197,48,48,0.1);display:flex;align-items:center;justify-content:center;">
                    <span class="material-icons-round" style="font-size:20px;color:#C53030;">manage_accounts</span>
                </div>
            </div>
            <div style="font-family:'Playfair Display',serif;font-size:34px;font-weight:700;color:#0F2440;line-height:1;"><?php echo e($stats['users']); ?></div>
            <div style="font-size:12.5px;color:#718096;margin-top:6px;">Admin aktif</div>
        </div>
    </div>

    <div class="bo-grid-sidebar" style="display:grid;grid-template-columns:1fr 360px;gap:20px;align-items:start;">

        
        <div class="bo-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <h2 style="font-family:'Playfair Display',serif;font-size:17px;color:#0F2440;margin:0;">Berita Terbaru</h2>
                <a href="/backoffice/berita" class="btn-secondary" style="padding:7px 14px;font-size:12.5px;">
                    <span class="material-icons-round" style="font-size:15px;">open_in_new</span>
                    Lihat Semua
                </a>
            </div>
            <table class="bo-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentBerita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div style="font-weight:600;color:#1A365D;"><?php echo e(Str::limit($item->title, 50)); ?></div>
                        </td>
                        <td><span class="badge badge-blue"><?php echo e(ucfirst($item->category)); ?></span></td>
                        <td style="color:#718096;font-size:13px;"><?php echo e($item->created_at->format('d M Y')); ?></td>
                        <td>
                            <span class="<?php echo e($item->status === 'dipublikasikan' ? 'badge badge-green' : 'badge badge-gray'); ?>">
                                <?php echo e(ucfirst($item->status)); ?>

                            </span>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" style="text-align:center;color:#718096;padding:20px;">Belum ada berita.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div style="display:flex;flex-direction:column;gap:18px;">

            
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:17px;color:#0F2440;margin:0 0 16px;">Aksi Cepat</h2>
                <div style="display:flex;flex-direction:column;gap:10px;">
                    <a href="/backoffice/berita" class="btn-primary" style="justify-content:flex-start;">
                        <span class="material-icons-round" style="font-size:18px;">add</span>
                        Tambah Berita
                    </a>
                    <a href="/backoffice/program" class="btn-secondary" style="justify-content:flex-start;">
                        <span class="material-icons-round" style="font-size:18px;">school</span>
                        Kelola Program
                    </a>
                    <a href="/backoffice/pendaftar" class="btn-secondary" style="justify-content:flex-start;">
                        <span class="material-icons-round" style="font-size:18px;">how_to_reg</span>
                        Data Pendaftar
                    </a>
                </div>
            </div>

            
            <div class="bo-card">
                <h2 style="font-family:'Playfair Display',serif;font-size:17px;color:#0F2440;margin:0 0 16px;">Aktivitas Terkini</h2>
                <div style="display:flex;flex-direction:column;gap:14px;">
                    <?php $__empty_1 = true; $__currentLoopData = $activities->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div style="display:flex;gap:12px;align-items:flex-start;">
                        <div style="width:32px;height:32px;border-radius:8px;background:rgba(197,48,48,0.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span class="material-icons-round" style="font-size:16px;color:#1A365D;">
                                <?php echo e($act->action === 'login' ? 'login' : ($act->action === 'create' ? 'add_circle' : ($act->action === 'delete' ? 'delete' : 'edit'))); ?>

                            </span>
                        </div>
                        <div>
                            <div style="font-size:13px;font-weight:600;color:#1A365D;">
                                <?php echo e($act->user ? $act->user->name : 'Sistem'); ?>

                                — <?php echo e(ucfirst($act->action)); ?>

                                <?php echo e($act->table_name ? '(' . $act->table_name . ')' : ''); ?>

                            </div>
                            <div style="font-size:12px;color:#718096;margin-top:2px;"><?php echo e(\Carbon\Carbon::parse($act->created_at)->diffForHumans()); ?></div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div style="color:#718096;font-size:13px;text-align:center;">Belum ada aktivitas.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backoffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/backoffice/dashboard.blade.php ENDPATH**/ ?>