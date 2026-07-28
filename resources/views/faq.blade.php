@extends('layouts.app')

@section('title', 'FAQ — Denpasar Hotel School')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[75vh] min-h-[520px] flex items-center justify-center text-center overflow-hidden mb-16">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img alt="Hospitality Support" class="absolute inset-0 w-full h-full object-cover"
            src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80&w=1600&auto=format&fit=crop">

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><span data-id="FAQ" data-en="FAQ">FAQ</span></span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-8 leading-[1.1]">
                <span data-id="Pertanyaan yang Sering Diajukan" data-en="Frequently Asked Questions">Pertanyaan yang Sering Diajukan</span>
            </h1>

            <!-- Search Bar -->
            <div class="w-full max-w-2xl mx-auto relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-icons text-primary text-2xl">search</span>
                </div>
                <input id="faq-search"
                    class="w-full pl-12 pr-4 py-4 bg-white/95 backdrop-blur-sm border border-white/20 focus:outline-none focus:border-primary transition-all text-base text-text-light placeholder:text-muted-light shadow-lg rounded-sm"
                    placeholder="Cari pertanyaan..." type="text">
            </div>
        </div>
    </section>

    <!-- Category Filter -->
    <section class="border-y border-black/10 bg-dhs-cream">
        <div class="max-w-[1280px] mx-auto px-5 md:px-16 py-4">
            <div class="flex overflow-x-auto gap-4 md:justify-center">
                <button class="faq-cat-btn whitespace-nowrap px-6 py-2 bg-text-light text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold border border-text-light transition-colors active" data-cat="all">
                    <span data-id="Semua" data-en="All">Semua</span></button>
                @php
                    $categoryLabels = [
                        'akademi' => 'Akademi & Kurikulum',
                        'pendaftaran' => 'Pendaftaran & Seleksi',
                        'biaya' => 'Biaya & Pembayaran',
                        'kampus' => 'Kehidupan Kampus',
                        'umum' => 'Informasi Umum',
                        'karir' => 'Karier & Kerja',
                    ];
                @endphp
                @foreach($faqs->keys() as $cat)
                <button class="faq-cat-btn whitespace-nowrap px-6 py-2 bg-transparent text-text-light hover:bg-dhs-beige text-[0.7rem] uppercase tracking-[0.15em] font-semibold border border-transparent hover:border-black/20 transition-colors" data-cat="{{ $cat }}">
                    <span>{{ $categoryLabels[$cat] ?? ucfirst($cat) }}</span></button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ List from DB -->
    <section class="px-5 md:px-16 py-16 md:py-20 max-w-[1280px] mx-auto">
        <div class="max-w-3xl mx-auto space-y-16">
            @forelse($faqs as $category => $items)
            <div data-section="{{ $category }}">
                <h2 class="text-[32px] leading-[1.3] font-semibold font-serif text-text-light mb-8 pb-4 border-b border-black/10">
                    {{ $categoryLabels[$category] ?? ucfirst($category) }}
                </h2>
                <div class="space-y-4">
                    @foreach($items as $faq)
                    <div class="bg-white p-6 shadow-sm border border-transparent hover:border-black/10 transition-colors faq-item" data-question="{{ strtolower($faq->question) }}">
                        <button class="w-full flex justify-between items-center text-left focus:outline-none accordion-toggle">
                            <span class="text-[20px] font-semibold text-text-light pr-4">{{ $faq->question }}</span>
                            <span class="material-icons text-primary shrink-0 transition-transform duration-300 icon-indicator">add</span>
                        </button>
                        <div class="accordion-content overflow-hidden transition-all duration-300 max-h-0">
                            <div class="text-muted-light text-base leading-relaxed pt-4">{!! strip_tags($faq->answer, '<p><b><i><u><strong><em><ul><ol><li><a><br><h3><h4>') !!}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="text-center py-20 text-muted-light">
                <span class="material-icons text-5xl text-gray-300 block mb-4">help_outline</span>
                <p class="text-lg">Belum ada FAQ yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-dhs-beige py-20 md:py-24 px-5 md:px-16">
        <div class="max-w-4xl mx-auto text-center">
            <span class="material-icons text-primary text-5xl mb-6 block">support_agent</span>
            <h2 class="text-[40px] md:text-[48px] leading-[1.2] font-semibold font-serif text-text-light mb-6">
                <span data-id="Tidak Menemukan Jawaban yang Kamu Cari?" data-en="Didn't Find the Answer You Were Looking For?">Tidak Menemukan Jawaban yang Kamu Cari?</span>
            </h2>
            <p class="text-lg text-muted-light mb-10 max-w-2xl mx-auto leading-relaxed">
                <span data-id="Tim admisi kami siap membantu Anda secara langsung." data-en="Our admissions team is ready to assist you directly.">Tim admisi kami siap membantu Anda secara langsung.</span>
            </p>
            @php
                $helpdeskWA = $footerSettings['helpdesk_wa'] ?? '+62 81 246 319966';
                $helpdeskEmail = $footerSettings['helpdesk_email'] ?? 'sahabat@dhs.or.id';
                $waNumber = preg_replace('/[^0-9]/', '', $helpdeskWA);
                if (str_starts_with($waNumber, '62')) { $waNumber = $waNumber; }
                elseif (str_starts_with($waNumber, '0')) { $waNumber = '62' . substr($waNumber, 1); }
                else { $waNumber = '62' . $waNumber; }
            @endphp
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a class="inline-flex items-center justify-center px-8 py-4 bg-dhs-navy text-white text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-darknavy transition-colors w-full sm:w-auto min-w-[280px]"
                    href="https://wa.me/{{ $waNumber }}" target="_blank">
                    Hubungi Kami via WhatsApp ({{ $helpdeskWA }})
                </a>
                <a class="inline-flex items-center justify-center px-8 py-4 bg-transparent border border-dhs-navy text-dhs-navy text-[0.7rem] uppercase tracking-[0.15em] font-semibold hover:bg-dhs-navy hover:text-white transition-colors w-full sm:w-auto min-w-[280px]"
                    href="mailto:{{ $helpdeskEmail }}">
                    Kirim Pertanyaan via Email ({{ $helpdeskEmail }})
                </a>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Accordion
            const accordions = document.querySelectorAll('.accordion-toggle');
            accordions.forEach(acc => {
                acc.addEventListener('click', function () {
                    const content = this.nextElementSibling;
                    const icon = this.querySelector('.icon-indicator');
                    const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';
                    document.querySelectorAll('.accordion-content').forEach(c => c.style.maxHeight = '0px');
                    document.querySelectorAll('.icon-indicator').forEach(i => { i.textContent = 'add'; i.classList.remove('rotate-45'); });
                    if (!isOpen) {
                        content.style.maxHeight = content.scrollHeight + 'px';
                        icon.textContent = 'remove';
                    }
                });
            });

            // Category filter
            const catBtns = document.querySelectorAll('.faq-cat-btn');
            const sections = document.querySelectorAll('[data-section]');
            catBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    catBtns.forEach(b => { b.classList.remove('bg-text-light', 'text-white', 'border-text-light'); b.classList.add('bg-transparent', 'text-text-light', 'border-transparent'); });
                    btn.classList.remove('bg-transparent', 'text-text-light', 'border-transparent');
                    btn.classList.add('bg-text-light', 'text-white', 'border-text-light');
                    const cat = btn.dataset.cat;
                    sections.forEach(sec => { sec.style.display = (cat === 'all' || sec.dataset.section === cat) ? 'block' : 'none'; });
                });
            });

            // Search filter
            const searchInput = document.getElementById('faq-search');
            searchInput.addEventListener('input', function () {
                const q = this.value.toLowerCase();
                document.querySelectorAll('.faq-item').forEach(item => {
                    const question = item.dataset.question || '';
                    item.style.display = (!q || question.includes(q)) ? 'block' : 'none';
                });
            });
        });
    </script>
@endsection
