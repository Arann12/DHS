<header id="bo-topbar">
    <div style="display:flex;align-items:center;gap:14px;">
        <button class="mobile-menu-btn" onclick="openSidebar()" title="Buka Menu">
            <span class="material-icons-round">menu</span>
        </button>
        <button class="desktop-toggle-btn" onclick="toggleSidebar()" title="Expand / Collapse Sidebar">
            <span class="material-icons-round" id="desktop-toggle-icon">menu</span>
        </button>
        <h1 class="page-title"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
    </div>
    <div class="topbar-right">
        <form action="/backoffice/logout" method="POST" onsubmit="return confirm('Yakin ingin logout?')" style="display:inline;">
            <?php echo csrf_field(); ?>
            <button type="submit" style="text-decoration:none;background:none;border:none;cursor:pointer;padding:0;">
                <div class="user-pill">
                    <div class="user-avatar"><?php echo e(strtoupper(substr($user['name'] ?? 'A', 0, 1))); ?></div>
                    <span class="user-name"><?php echo e($user['name'] ?? 'Admin'); ?></span>
                </div>
            </button>
        </form>
    </div>
</header>
<?php /**PATH D:\laragon\www\DHS\resources\views/backoffice/partials/topbar.blade.php ENDPATH**/ ?>