@extends('layouts.app')

@section('title', 'Berita & Artikel — Denpasar Hotel School')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img alt="Hospitality Background" class="absolute inset-0 w-full h-full object-cover"
            src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600&auto=format&fit=crop">

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><span data-id="Berita" data-en="News">Berita</span></span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-8 leading-[1.1]">
                <span data-id="Berita &amp; Artikel" data-en="News &amp; Articles">Berita &amp; Artikel</span>
            </h1>

            <!-- Search Bar -->
            <form action="/berita" method="GET" class="w-full max-w-md mx-auto relative">
                <span class="material-icons absolute left-0 top-3 text-white/60">search</span>
                <input name="q" value="{{ request('q') }}"
                    class="w-full bg-transparent border-b border-white/40 focus:border-primary py-3 pl-8 pr-4 text-base text-white placeholder:text-white/60 transition-colors outline-none"
                    placeholder="Cari artikel..." type="text">
            </form>
        </div>
    </section>

    <!-- Category Filters -->
    <section class="bg-dhs-lightblue">
    <div class="max-w-[1280px] mx-auto px-5 md:px-16 py-12">
        <div class="flex flex-wrap gap-3">
            <a href="/berita"
                class="{{ !request('kategori') ? 'bg-primary text-white border-primary' : 'bg-white border-black/10 text-text-light hover:border-text-light' }} text-[0.7rem] uppercase tracking-[0.15em] font-semibold px-5 py-2 transition-colors border">
                Semua</a>
            @foreach(['Prestasi' => 'Prestasi Alumni', 'Partnership' => 'Partnership', 'Kampus' => 'Kampus', 'Akademik' => 'Akademik', 'Kegiatan' => 'Kegiatan', 'Alumni' => 'Alumni', 'Umum' => 'Umum'] as $catKey => $catLabel)
                <a href="/berita?kategori={{ $catKey }}"
                    class="{{ request('kategori') === $catKey ? 'bg-primary text-white border-primary' : 'bg-white border-black/10 text-text-light hover:border-text-light' }} text-[0.7rem] uppercase tracking-[0.15em] font-semibold px-5 py-2 transition-colors border">
                    {{ $catLabel }}</a>
            @endforeach
        </div>
    </div>
    </section>

    <!-- Featured Article -->
    @if($featured)
    <section class="max-w-[1280px] mx-auto px-5 md:px-16 pb-16">
        <a href="/berita/{{ $featured->slug }}" class="block group">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-0 bg-white overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                <div class="md:col-span-7 h-72 md:h-[420px] overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        alt="{{ $featured->title }}"
                        src="{{ $featured->thumbnail_url ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600' }}">
                </div>
                <div class="md:col-span-5 p-8 md:p-12 flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-[0.65rem] uppercase tracking-[0.15em] font-bold text-primary bg-primary/10 px-3 py-1 rounded">{{ $featured->category }}</span>
                        <span class="text-xs text-muted-light">{{ $featured->published_at?->format('d M Y') ?? '' }}</span>
                    </div>
                    <h2 class="text-[28px] md:text-[36px] leading-[1.2] font-semibold font-serif text-text-light mb-4 group-hover:text-primary transition-colors">
                        {{ $featured->title }}
                    </h2>
                    <p class="text-sm text-muted-light leading-relaxed line-clamp-4">
                        {!! strip_tags(Str::limit($featured->excerpt ?? $featured->content, 250)) !!}
                    </p>
                    <span class="mt-6 text-[0.65rem] uppercase tracking-[0.15em] font-bold text-primary flex items-center gap-2">
                        <span data-id="Baca Selengkapnya" data-en="Read More">Baca Selengkapnya</span> <span class="material-icons text-sm">arrow_forward</span>
                    </span>
                </div>
            </div>
        </a>
    </section>
    @endif

    <!-- Article Grid -->
    <section class="max-w-[1280px] mx-auto px-5 md:px-16 pt-4 pb-20">
        @if($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <div class="bg-white overflow-hidden shadow-sm flex flex-col group cursor-pointer hover:shadow-md transition-shadow border border-black/5">
                <a href="/berita/{{ $article->slug }}" class="flex flex-col flex-1">
                <div class="aspect-[16/10] overflow-hidden bg-gray-100">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        alt="{{ $article->title }}"
                        src="{{ $article->thumbnail_url ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800' }}">
                </div>
                <div class="p-5 flex flex-col gap-3 flex-1">
                    <div class="flex items-center gap-3">
                        <span class="text-[0.65rem] uppercase tracking-[0.15em] font-bold text-primary bg-primary/10 px-2.5 py-0.5 rounded">{{ $article->category }}</span>
                        <span class="text-xs text-muted-light">{{ $article->published_at?->format('d M Y') ?? '' }}</span>
                        <span class="text-xs text-muted-light flex items-center gap-1.5">
                            <span class="material-icons" style="font-size:14px;">visibility</span>
                            {{ number_format($article->views_count) }}
                        </span>
                    </div>
                    <h3 class="text-lg font-serif font-semibold text-text-light group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                        {{ $article->title }}
                    </h3>
                    <p class="text-sm text-muted-light line-clamp-2 leading-relaxed">{!! strip_tags(Str::limit($article->excerpt ?? $article->content, 120)) !!}</p>
                </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="mt-12">{{ $articles->withQueryString()->links() }}</div>
        @else
        <div class="text-center py-20 text-muted-light bg-white rounded-lg border border-black/5">
            <span class="material-icons text-5xl text-gray-300 block mb-4">article</span>
            <p class="text-lg"><span data-id="Belum ada artikel yang dipublikasikan." data-en="No articles published yet.">Belum ada artikel yang dipublikasikan.</span></p>
        </div>
        @endif
    </section>

@endsection
