<nav class="fixed w-full z-50 bg-background-light/90 backdrop-blur-md border-b border-black/5 py-5 px-8 md:px-16 flex justify-between items-center transition-colors">
    <a class="font-serif font-bold text-2xl tracking-wider text-text-light" href="/">DHS</a>
    
    <div class="hidden md:flex space-x-8 text-sm font-medium">
        <!-- Underline active route with DHS Red (#D62828) as per DESIGN.md -->
        <a class="hover:text-primary transition-colors {{ Request::is('/') ? 'border-b-2 border-primary text-primary pb-1' : 'text-text-light' }}" href="/">Beranda</a>
        <a class="hover:text-primary transition-colors {{ Request::is('tentang-kami') ? 'border-b-2 border-primary text-primary pb-1' : 'text-text-light' }}" href="/tentang-kami">Tentang Kami</a>
        <a class="hover:text-primary transition-colors {{ Request::is('akademi') ? 'border-b-2 border-primary text-primary pb-1' : 'text-text-light' }}" href="/akademi">Akademi</a>
        <a class="hover:text-primary transition-colors {{ Request::is('berita') ? 'border-b-2 border-primary text-primary pb-1' : 'text-text-light' }}" href="/berita">Berita</a>
        <a class="hover:text-primary transition-colors {{ Request::is('faq') ? 'border-b-2 border-primary text-primary pb-1' : 'text-text-light' }}" href="/faq">FAQ</a>
    </div>
    
    <div class="flex items-center space-x-4 text-text-light">
        <button class="text-sm font-medium flex items-center hover:text-primary transition-colors">
            <span class="material-icons text-lg mr-1">language</span> ID
        </button>
        <button class="md:hidden focus:outline-none">
            <span class="material-icons">menu</span>
        </button>
    </div>
</nav>
