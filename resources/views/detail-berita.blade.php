@extends('layouts.app')

@section('title', $article->title . ' — Denpasar Hotel School')

@section('content')
    <!-- Hero -->
    <section class="relative h-[50vh] min-h-[400px] flex items-center justify-center text-center overflow-hidden mb-12">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        @if($article->thumbnail_url)
        <img alt="{{ $article->title }}" class="absolute inset-0 w-full h-full object-cover" src="{{ $article->thumbnail_url }}">
        @else
        <img alt="News" class="absolute inset-0 w-full h-full object-cover" src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600&auto=format&fit=crop">
        @endif

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/">Beranda</a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <a class="hover:text-white transition-colors" href="/berita">Berita</a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold">{{ $article->category }}</span>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-6 leading-[1.1]">
                {{ $article->title }}
            </h1>
            <div class="flex items-center justify-center gap-4 text-white/80 text-sm">
                @if($article->author)
                <span>{{ $article->author->name }}</span>
                <span class="w-1 h-1 bg-white/40 rounded-full"></span>
                @endif
                <span>{{ $article->published_at?->format('d M Y') ?? $article->created_at->format('d M Y') }}</span>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <article class="max-w-[800px] mx-auto px-5 md:px-16 pb-20">
        {{-- Excerpt --}}
        @if($article->excerpt)
        <p class="text-lg text-muted-light leading-relaxed mb-8 font-medium border-l-4 border-primary pl-6">
            {{ $article->excerpt }}
        </p>
        @endif

        {{-- Content --}}
        <div class="prose prose-lg max-w-none text-text-light leading-relaxed">
            {!! $article->content !!}
        </div>

        {{-- Back Link --}}
        <div class="mt-16 pt-8 border-t border-black/10">
            <a href="/berita" class="inline-flex items-center gap-2 text-primary text-sm font-semibold hover:gap-3 transition-all">
                <span class="material-icons text-sm">arrow_back</span>
                Kembali ke Berita
            </a>
        </div>
    </article>

    {{-- Related Articles --}}
    @if($related->count() > 0)
    <section class="bg-dhs-cream/50 py-16 px-5 md:px-16 border-t border-black/5">
        <div class="max-w-[1280px] mx-auto">
            <h2 class="text-3xl font-serif text-text-light mb-10">Berita Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($related as $rel)
                <a href="/berita/{{ $rel->slug }}" class="group bg-white overflow-hidden shadow-sm flex flex-col hover:shadow-md transition-shadow">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $rel->title }}" src="{{ $rel->thumbnail_url ?? 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800' }}">
                    </div>
                    <div class="p-5">
                        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary">{{ $rel->category }}</span>
                        <h3 class="text-lg font-serif font-semibold text-text-light mt-2 group-hover:text-primary transition-colors line-clamp-2">{{ $rel->title }}</h3>
                        <p class="text-sm text-muted-light mt-2">{{ $rel->published_at?->format('d M Y') ?? '' }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
