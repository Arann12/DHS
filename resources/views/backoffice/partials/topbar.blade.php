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
        <a href="/backoffice/password" class="user-pill" title="Ganti Password">
            <div class="user-avatar">{{ strtoupper(substr($user['name'] ?? 'A', 0, 1)) }}</div>
            <span class="user-name">{{ $user['name'] ?? 'Admin' }}</span>
        </a>
        <button type="button" class="btn-icon" title="Logout" aria-label="Logout" onclick="openLogoutModal()">
            <span class="material-icons-round">logout</span>
        </button>
    </div>
</header>
