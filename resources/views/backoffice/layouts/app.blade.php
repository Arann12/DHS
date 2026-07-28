<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Backoffice') — DHS Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Summernote CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/lang/summernote-id-ID.min.js"></script>

    <style>
        :root {
            --bo-blue:       #0E06B4;
            --bo-dark-blue:  #2B2494;
            --bo-red:        #E10001;
            --bo-cream:      #F6F2EA;
            --bo-beige:      #EFE7D8;
            --bo-gray:       #8A8478;
            --bo-text:       #1a1a2e;
            --sidebar-w:     260px;
            --topbar-h:      64px;
        }
        * { box-sizing: border-box; }
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bo-cream); color: var(--bo-text); margin: 0; min-height: 100vh; }

        /* SIDEBAR */
        #bo-sidebar { position: fixed; top: 0; left: 0; bottom: 0; width: var(--sidebar-w); background: linear-gradient(180deg, #1a1070 0%, var(--bo-dark-blue) 100%); display: flex; flex-direction: column; z-index: 100; transition: transform 0.3s cubic-bezier(0.4,0,0.2,1), width 0.3s cubic-bezier(0.4,0,0.2,1); overflow: hidden; }
        #bo-sidebar.collapsed { width: 72px; }
        .sidebar-logo { padding: 20px 20px 12px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid rgba(255,255,255,0.08); min-height: 72px; flex-shrink: 0; }
        .sidebar-logo-mark { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #0E06B4, #E10001); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 900; font-size: 13px; flex-shrink: 0; letter-spacing: -0.5px; }
        .sidebar-logo-img { width: 38px; height: 38px; border-radius: 10px; object-fit: cover; flex-shrink: 0; }
        .logo-text { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 13px; color: #fff; line-height: 1.3; white-space: nowrap; overflow: hidden; transition: opacity 0.2s, width 0.3s; flex: 1; min-width: 0; }
        #bo-sidebar.collapsed .logo-text { opacity: 0; width: 0; }

        .sidebar-nav { flex: 1; overflow-y: auto; padding: 10px 0; scrollbar-width: none; }
        .sidebar-nav::-webkit-scrollbar { display: none; }
        .nav-group-label { font-size: 9.5px; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.3); padding: 14px 20px 5px; white-space: nowrap; transition: opacity 0.2s; }
        #bo-sidebar.collapsed .nav-group-label { opacity: 0; }

        .nav-item { display: flex; align-items: center; gap: 13px; padding: 9px 18px; margin: 1px 10px; border-radius: 10px; color: rgba(255,255,255,0.62); text-decoration: none; font-size: 13px; font-weight: 500; white-space: nowrap; overflow: hidden; transition: background 0.2s, color 0.2s; cursor: pointer; }
        .nav-item:hover { background: rgba(255,255,255,0.1); color: #fff; }
        .nav-item.active { background: var(--bo-blue); color: #fff; box-shadow: 0 4px 16px rgba(14,6,180,0.45); }
        .nav-item .mat-icon { font-size: 19px; width: 19px; flex-shrink: 0; }
        .nav-label { overflow: hidden; transition: opacity 0.2s, width 0.2s; }
        #bo-sidebar.collapsed .nav-label { opacity: 0; width: 0; }
        #bo-sidebar.collapsed .nav-item { justify-content: center; padding: 10px 0; }

        .sidebar-footer { padding: 14px; border-top: 1px solid rgba(255,255,255,0.08); flex-shrink: 0; }

        /* TOPBAR */
        #bo-topbar { position: fixed; top: 0; left: var(--sidebar-w); right: 0; height: var(--topbar-h); background: #fff; border-bottom: 1px solid rgba(0,0,0,0.07); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; z-index: 90; transition: left 0.3s cubic-bezier(0.4,0,0.2,1); box-shadow: 0 2px 12px rgba(0,0,0,0.04); }
        #bo-topbar.collapsed { left: 72px; }
        .page-title { font-family: 'Playfair Display', serif; font-size: 19px; font-weight: 600; color: var(--bo-dark-blue); margin: 0; }
        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .notif-btn { width: 38px; height: 38px; border-radius: 50%; background: var(--bo-cream); border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--bo-dark-blue); transition: background 0.2s; }
        .notif-btn:hover { background: var(--bo-beige); }
        .user-pill { display: flex; align-items: center; gap: 10px; padding: 5px 14px 5px 5px; border-radius: 999px; background: var(--bo-cream); cursor: pointer; transition: background 0.2s; text-decoration: none; }
        .user-pill:hover { background: var(--bo-beige); }
        .user-avatar { width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--bo-blue), var(--bo-dark-blue)); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 13px; font-weight: 700; }
        .user-name { font-size: 13px; font-weight: 600; color: var(--bo-dark-blue); }

        /* MAIN */
        #bo-main { margin-left: var(--sidebar-w); margin-top: var(--topbar-h); padding: 32px; min-height: calc(100vh - var(--topbar-h)); transition: margin-left 0.3s cubic-bezier(0.4,0,0.2,1); }
        #bo-main.collapsed { margin-left: 72px; }

        /* SIDEBAR OVERLAY */
        #sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 99; }

        /* CARDS */
        .bo-card { background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 16px rgba(0,0,0,0.05); }

        /* BUTTONS */
        .btn-primary { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: var(--bo-blue); color: #fff; border: none; border-radius: 10px; font-size: 13.5px; font-weight: 600; cursor: pointer; text-decoration: none; transition: all 0.2s; font-family: 'Inter', sans-serif; }
        .btn-primary:hover { background: var(--bo-dark-blue); transform: translateY(-1px); box-shadow: 0 6px 18px rgba(14,6,180,0.3); }
        .btn-secondary { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: transparent; color: var(--bo-blue); border: 1.5px solid var(--bo-blue); border-radius: 10px; font-size: 13.5px; font-weight: 600; cursor: pointer; text-decoration: none; transition: all 0.2s; font-family: 'Inter', sans-serif; }
        .btn-secondary:hover { background: rgba(14,6,180,0.06); }
        .btn-danger { display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; background: transparent; color: var(--bo-red); border: 1.5px solid var(--bo-red); border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; font-family: 'Inter', sans-serif; }
        .btn-danger:hover { background: rgba(225,0,1,0.07); }
        .btn-icon { width: 34px; height: 34px; border-radius: 8px; background: var(--bo-cream); border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--bo-dark-blue); transition: background 0.2s; text-decoration: none; flex-shrink: 0; }
        .btn-icon:hover { background: var(--bo-beige); }
        .btn-icon.danger { color: var(--bo-red); }
        .btn-icon.danger:hover { background: rgba(225,0,1,0.08); }

        /* TABLE */
        .bo-table { width: 100%; border-collapse: collapse; }
        .bo-table th { text-align: left; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--bo-gray); padding: 12px 16px; border-bottom: 1.5px solid #eee; background: #fafafa; }
        .bo-table td { padding: 14px 16px; font-size: 13.5px; border-bottom: 1px solid #f0f0f0; vertical-align: middle; }
        .bo-table tr:last-child td { border-bottom: none; }
        .bo-table tr:hover td { background: #fafafa; }

        /* FORMS */
        .bo-label { display: block; font-size: 12.5px; font-weight: 600; color: #444; margin-bottom: 6px; }
        .bo-input { width: 100%; padding: 10px 14px; border: 1.5px solid #e0e0e0; border-radius: 10px; font-size: 14px; font-family: 'Inter', sans-serif; color: var(--bo-text); background: #fff; transition: border-color 0.2s, box-shadow 0.2s; outline: none; }
        .bo-input:focus { border-color: var(--bo-blue); box-shadow: 0 0 0 3px rgba(14,6,180,0.1); }
        .bo-select { width: 100%; padding: 10px 14px; border: 1.5px solid #e0e0e0; border-radius: 10px; font-size: 14px; font-family: 'Inter', sans-serif; color: var(--bo-text); background: #fff; outline: none; cursor: pointer; }
        .bo-select:focus { border-color: var(--bo-blue); box-shadow: 0 0 0 3px rgba(14,6,180,0.1); }
        .bo-textarea { width: 100%; padding: 10px 14px; border: 1.5px solid #e0e0e0; border-radius: 10px; font-size: 14px; font-family: 'Inter', sans-serif; color: var(--bo-text); background: #fff; transition: border-color 0.2s; outline: none; resize: vertical; min-height: 100px; }
        .bo-textarea:focus { border-color: var(--bo-blue); box-shadow: 0 0 0 3px rgba(14,6,180,0.1); }

        /* MODAL */
        .bo-modal-backdrop { position: fixed; inset: 0; background: rgba(0,0,0,0.45); z-index: 200; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .bo-modal { background: #fff; border-radius: 20px; padding: 32px; width: 100%; max-width: 560px; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
        .bo-modal.wide { max-width: 720px; }
        .bo-modal h3 { font-family: 'Playfair Display', serif; font-size: 20px; color: var(--bo-dark-blue); margin: 0 0 24px; }

        /* BADGES */
        .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
        .badge-blue { background: rgba(14,6,180,0.1); color: var(--bo-blue); }
        .badge-green { background: rgba(34,197,94,0.12); color: #16a34a; }
        .badge-gray { background: rgba(138,132,120,0.15); color: #666; }
        .badge-red { background: rgba(225,0,1,0.1); color: var(--bo-red); }

        /* SEARCH */
        .bo-search { display: flex; align-items: center; gap: 8px; background: var(--bo-cream); border: 1.5px solid transparent; border-radius: 10px; padding: 8px 14px; transition: border-color 0.2s; }
        .bo-search:focus-within { border-color: var(--bo-blue); background: #fff; }
        .bo-search input { border: none; background: transparent; outline: none; font-size: 13.5px; font-family: 'Inter', sans-serif; color: var(--bo-text); min-width: 0; }

        /* MOBILE & TOGGLE BUTTONS */
        .mobile-menu-btn { display: none; width: 38px; height: 38px; border-radius: 8px; background: var(--bo-cream); border: none; cursor: pointer; align-items: center; justify-content: center; color: var(--bo-dark-blue); }
        .desktop-toggle-btn { width: 38px; height: 38px; border-radius: 8px; background: var(--bo-cream); border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--bo-dark-blue); transition: background 0.2s; }
        .desktop-toggle-btn:hover { background: var(--bo-beige); }

        #bo-sidebar.collapsed .sidebar-logo { justify-content: center; padding: 16px 8px; }

        @media (max-width: 900px) {
            #bo-sidebar { transform: translateX(-100%); width: var(--sidebar-w) !important; }
            #bo-sidebar.mobile-open { transform: translateX(0); }
            #sidebar-overlay.visible { display: block; }
            #bo-topbar { left: 0 !important; }
            #bo-main { margin-left: 0 !important; }
            .mobile-menu-btn { display: flex !important; }
            .desktop-toggle-btn { display: none !important; }
        }
        @media (max-width: 600px) { #bo-main { padding: 20px 16px; } }

        /* UTILITY */
        .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .form-group { margin-bottom: 18px; }
        .divider { border: none; border-top: 1px solid #eee; margin: 24px 0; }
        @media (max-width: 640px) { .form-grid-2 { grid-template-columns: 1fr; } }
    </style>
    @stack('styles')
</head>

<body>
<div id="sidebar-overlay" onclick="closeSidebar()"></div>

@include('backoffice.partials.sidebar')

@include('backoffice.partials.topbar')

<main id="bo-main">
    @yield('content')
</main>

{{-- ═══════ GLOBAL IMAGE PICKER MODAL ═══════ --}}
<div id="image-picker-modal" x-data="imageUploadModal()" x-show="$store.imageUpload.isOpen" x-cloak
     class="bo-modal-backdrop"
     style="position:fixed;inset:0;z-index:9999;"
     @@click.self="$store.imageUpload.close()"
     @@keydown.escape.window="$store.imageUpload.isOpen && $store.imageUpload.close()">
    <div class="bo-modal" style="max-width:600px;" @@click.stop>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <h3 style="margin:0;">Pilih Gambar</h3>
            <button class="btn-icon" @@click="$store.imageUpload.close()">
                <span class="material-icons-round">close</span>
            </button>
        </div>

        <!-- Tab Navigation -->
        <div style="display:flex;gap:0;margin-bottom:20px;border-bottom:2px solid #e5e7eb;">
            <button @@click="mode = 'url'"
                    :style="mode === 'url' ? 'border-bottom:2px solid #2B2494;color:#2B2494;margin-bottom:-2px;' : 'color:#999;'"
                    style="padding:10px 20px;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;font-weight:600;transition:all 0.15s;">
                <span class="material-icons-round" style="font-size:18px;vertical-align:middle;">link</span>
                Via URL
            </button>
            <button @@click="mode = 'upload'"
                    :style="mode === 'upload' ? 'border-bottom:2px solid #2B2494;color:#2B2494;margin-bottom:-2px;' : 'color:#999;'"
                    style="padding:10px 20px;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;font-weight:600;transition:all 0.15s;">
                <span class="material-icons-round" style="font-size:18px;vertical-align:middle;">upload_file</span>
                Upload Lokal
            </button>
        </div>

        <!-- URL Tab -->
        <div x-show="mode === 'url'" style="padding:4px 0;">
            <label class="bo-label">URL Gambar</label>
            <input type="text" class="bo-input" x-model="tempUrl" @@keyup.enter="applyUrl()"
                   placeholder="https://example.com/image.jpg">

            <div x-show="tempUrl" style="border:1.5px solid #e0e0e0;border-radius:10px;padding:12px;margin-top:14px;text-align:center;background:#fafafa;">
                <img :src="tempUrl" @@error="$el.style.display='none'" style="max-height:200px;max-width:100%;border-radius:8px;object-fit:contain;">
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:16px;">
                <button @@click="$store.imageUpload.close()" class="btn-secondary" style="padding:9px 18px;">Batal</button>
                <button @@click="applyUrl()" class="btn-primary" style="padding:9px 18px;" :disabled="!tempUrl || !tempUrl.trim()">
                    <span class="material-icons-round" style="font-size:18px;">check</span>
                    Gunakan URL
                </button>
            </div>
        </div>

        <!-- Upload Tab -->
        <div x-show="mode === 'upload'" style="padding:4px 0;">
            <div @@click="$refs.globalFileInput.click()"
                 style="border:2px dashed #cbd5e1;border-radius:12px;padding:36px;text-align:center;cursor:pointer;background:#fafafa;transition:all 0.2s;"
                 @@mouseenter="$el.style.borderColor='#2B2494'; $el.style.background='#f0f4ff'"
                 @@mouseleave="$el.style.borderColor='#cbd5e1'; $el.style.background='#fafafa'">
                <span class="material-icons-round" style="font-size:44px;color:#2B2494;display:block;margin-bottom:10px;">cloud_upload</span>
                <div style="font-weight:600;color:#2B2494;margin-bottom:4px;">Klik untuk pilih gambar</div>
                <div style="font-size:12px;color:#999;">JPG, PNG, GIF, WebP, SVG — Maks 5MB</div>
            </div>
            <input type="file" x-ref="globalFileInput" accept="image/jpeg,image/png,image/gif,image/webp,image/svg+xml" @@change="handleFile($event)" style="display:none;">

            <div x-show="preview" style="border:1.5px solid #e0e0e0;border-radius:10px;padding:12px;margin-top:14px;text-align:center;background:#fff;">
                <img :src="preview" style="max-height:200px;max-width:100%;border-radius:8px;object-fit:contain;">
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:16px;">
                <button @@click="$store.imageUpload.close()" class="btn-secondary" style="padding:9px 18px;">Batal</button>
                <button @@click="applyUpload()" class="btn-primary" style="padding:9px 18px;" :disabled="!preview">
                    <span class="material-icons-round" style="font-size:18px;">check</span>
                    Gunakan Gambar
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>
<script>
    /* ═══════ GLOBAL IMAGE PICKER STORE ═══════ */
    document.addEventListener('alpine:init', () => {
        Alpine.store('imageUpload', {
            isOpen: false,
            callback: null,
            open(callback) {
                this.isOpen = true;
                this.callback = callback;
            },
            close() {
                this.isOpen = false;
                this.callback = null;
            },
            apply(value) {
                if (this.callback) this.callback(value);
                this.close();
            }
        });
    });

    function imageUploadModal() {
        return {
            mode: 'url',
            tempUrl: '',
            preview: '',
            applyUrl() {
                if (this.tempUrl && this.tempUrl.trim()) {
                    Alpine.store('imageUpload').apply(this.tempUrl.trim());
                    this.reset();
                }
            },
            handleFile(e) {
                const file = e.target.files[0];
                if (!file) return;
                const allowed = ['image/jpeg','image/png','image/gif','image/webp','image/svg+xml'];
                if (!allowed.includes(file.type)) {
                    alert('Tipe file tidak didukung. Gunakan JPG, PNG, GIF, WebP, atau SVG.');
                    return;
                }
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file maksimal 5MB.');
                    return;
                }
                const reader = new FileReader();
                reader.onload = (ev) => { this.preview = ev.target.result; };
                reader.readAsDataURL(file);
            },
            applyUpload() {
                if (this.preview) {
                    Alpine.store('imageUpload').apply(this.preview);
                    this.reset();
                }
            },
            reset() {
                this.tempUrl = '';
                this.preview = '';
                this.mode = 'url';
            }
        };
    }

    /* Helper: convert base64 data URL to File object */
    function dataURLtoFile(dataUrl, filename) {
        const arr = dataUrl.split(',');
        const mime = arr[0].match(/:(.*?);/)[1];
        const bstr = atob(arr[1]);
        let n = bstr.length;
        const u8arr = new Uint8Array(n);
        while (n--) u8arr[n] = bstr.charCodeAt(n);
        return new File([u8arr], filename, { type: mime });
    }
</script>
<script>
    const sidebar = document.getElementById('bo-sidebar');
    const topbar  = document.getElementById('bo-topbar');
    const main    = document.getElementById('bo-main');
    const overlay = document.getElementById('sidebar-overlay');
    let collapsed = localStorage.getItem('bo-sidebar-collapsed') === 'true';

    function applySidebarState() {
        if (window.innerWidth <= 900) return;
        sidebar.classList.toggle('collapsed', collapsed);
        topbar.classList.toggle('collapsed', collapsed);
        main.classList.toggle('collapsed', collapsed);

        const desktopIcon = document.getElementById('desktop-toggle-icon');
        if (desktopIcon) {
            desktopIcon.textContent = collapsed ? 'menu_open' : 'menu';
        }
    }

    function toggleSidebar() {
        collapsed = !collapsed;
        localStorage.setItem('bo-sidebar-collapsed', collapsed);
        applySidebarState();
    }

    function openSidebar() {
        sidebar.classList.add('mobile-open');
        overlay.classList.add('visible');
    }

    function closeSidebar() {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('visible');
    }

    applySidebarState();
    window.addEventListener('resize', applySidebarState);
</script>
@stack('scripts')
</body>
</html>
