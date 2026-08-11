@php
    $footerSettings = $footerSettings ?? [];
    $siteName = $siteName ?? 'Denpasar Hotel School';
    $tagline = $tagline ?? '"Transforming Into Excellent"';
    $addressDenpasar = $footerSettings['address_denpasar'] ?? 'Jl. Sari Dana IV No. 1 Gatsu Barat, Denpasar 80116, Bali';
    $addressKlungkung = $footerSettings['address_klungkung'] ?? 'Jl. Raya Takmung No. 36, Klungkung 80752, Bali';
    $phoneDenpasar = $footerSettings['phone_denpasar'] ?? '+62 81 246 319966';
    $phoneKlungkung = $footerSettings['phone_klungkung'] ?? '+0366 5582998';
    $waKlungkung = $footerSettings['wa_klungkung'] ?? '+62 81 337 106480';
    $email = $footerSettings['email'] ?? 'sahabat@dhs.or.id';
    $instagramUrl = $footerSettings['instagram_url'] ?? 'https://instagram.com/denpasarhotelschool';
    $facebookUrl = $footerSettings['facebook_url'] ?? '#';
    $youtubeUrl = $footerSettings['youtube_url'] ?? '#';
    $copyright = $footerSettings['copyright'] ?? '© 2026 DENPASAR HOTEL SCHOOL.';
    $exploreLinks = json_decode($footerSettings['explore_links'] ?? '[]', true);
    if (empty($exploreLinks)) {
        $exploreLinks = [
            ['label' => 'Beranda', 'url' => '/'],
            ['label' => 'Sekilas DHS', 'url' => '/tentang-kami'],
            ['label' => 'Akademi', 'url' => '/akademi'],
            ['label' => 'Berita & Artikel', 'url' => '/berita'],
        ];
    }
    $admissionLinks = json_decode($footerSettings['admission_links'] ?? '[]', true);
    if (empty($admissionLinks)) {
        $admissionLinks = [
            ['label' => 'Pendaftaran Online', 'url' => '/formulir-pendaftaran'],
            ['label' => 'FAQ', 'url' => '/faq'],
            ['label' => 'Karier', 'url' => '/karier'],
        ];
    }
@endphp

<footer class="bg-dhs-darknavy pt-16 pb-8 px-6 md:px-16 border-t border-white/10">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-16 text-white">
        <div class="md:col-span-2">
            <h2 class="text-3xl font-serif mb-4 tracking-wide">{{ $siteName }}</h2>
            <p class="text-xs uppercase tracking-widest text-dhs-gold font-bold mb-4">{{ $tagline }}</p>

            <div class="space-y-4 text-xs text-white/60 mb-6 leading-relaxed">
                <div>
                    <span class="font-bold text-white block" data-id="KAMPUS DENPASAR" data-en="DENPASAR CAMPUS">KAMPUS DENPASAR</span>
                    {{ $addressDenpasar }}<br>
                    WA: {{ $phoneDenpasar }} | Email: {{ $email }}
                </div>
                <div>
                    <span class="font-bold text-white block" data-id="KAMPUS KLUNGKUNG" data-en="KLUNGKUNG CAMPUS">KAMPUS KLUNGKUNG</span>
                    {{ $addressKlungkung }}<br>
                    Telp: {{ $phoneKlungkung }} | WA: {{ $waKlungkung }}
                </div>
            </div>

            <div class="flex space-x-4">
                <a class="w-10 h-10 rounded-full border border-white/15 flex items-center justify-center hover:bg-white/10 hover:text-dhs-gold transition-colors text-white/50" href="{{ $instagramUrl }}" target="_blank" title="Instagram">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a class="w-10 h-10 rounded-full border border-white/15 flex items-center justify-center hover:bg-white/10 hover:text-dhs-gold transition-colors text-white/50" href="{{ $facebookUrl }}" target="_blank" title="Facebook">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a class="w-10 h-10 rounded-full border border-white/15 flex items-center justify-center hover:bg-white/10 hover:text-dhs-gold transition-colors text-white/50" href="{{ $youtubeUrl }}" target="_blank" title="YouTube">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
                <a class="w-10 h-10 rounded-full border border-white/15 flex items-center justify-center hover:bg-white/10 hover:text-dhs-gold transition-colors text-white/50" href="mailto:{{ $email }}" title="Email Hubungi Kami">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </a>
            </div>
        </div>

        <div>
            <span class="label-text mb-6 block text-white" data-id="EKSPLORASI" data-en="EXPLORE">EKSPLORASI</span>
            <ul class="space-y-4 text-sm text-white/60">
                @foreach($exploreLinks as $link)
                <li><a class="hover:text-dhs-gold transition-colors" href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <span class="label-text mb-6 block text-white" data-id="PENDAFTARAN &amp; LINK" data-en="ADMISSIONS &amp; LINKS">PENDAFTARAN &amp; LINK</span>
            <ul class="space-y-4 text-sm text-white/60">
                @foreach($admissionLinks as $link)
                <li><a class="hover:text-dhs-gold transition-colors" href="{{ $link['url'] ?? '#' }}" {{ str_starts_with($link['url'] ?? '', 'http') ? 'target="_blank"' : '' }}>{{ $link['label'] ?? '' }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center pt-8 border-t border-white/10 text-[0.65rem] text-white/40 uppercase tracking-widest">
        <p>{{ $copyright }} <span data-id="DIRANCANG UNTUK KEUNGGULAN." data-en="CRAFTED FOR EXCELLENCE.">DIRANCANG UNTUK KEUNGGULAN.</span></p>
        <div class="flex space-x-6 mt-4 md:mt-0">
            <span class="text-white/40">Denpasar Hotel School</span>
        </div>
    </div>
</footer>
