<header id="bo-topbar">
    <div style="display:flex;align-items:center;gap:14px;">
        <button class="mobile-menu-btn" onclick="openSidebar()" title="Buka Menu">
            <span class="material-icons-round">menu</span>
        </button>
        <button class="desktop-toggle-btn" onclick="toggleSidebar()" title="Expand / Collapse Sidebar">
            <span class="material-icons-round" id="desktop-toggle-icon">menu</span>
        </button>
        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
    </div>
    <div class="topbar-right">
        <button class="notif-btn" title="Notifikasi">
            <span class="material-icons-round" style="font-size:20px;">notifications_none</span>
        </button>
        <a href="/backoffice/logout" onclick="return confirm('Yakin ingin logout?')" style="text-decoration:none;">
            <div class="user-pill">
                <div class="user-avatar">{{ strtoupper(substr($user['name'] ?? 'A', 0, 1)) }}</div>
                <span class="user-name">{{ $user['name'] ?? 'Admin' }}</span>
            </div>
        </a>
    </div>
</header>
