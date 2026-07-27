{{--
    Testimonial Slider Component with Autoplay

    Props:
    - $testimonials: Collection of testimonial objects
--}}

@if($testimonials && $testimonials->count() > 0)
<section class="testimonial-section" id="testimonial-section">
    <div class="container-custom">
        {{-- Section Header --}}
        <div class="section-header text-center" data-reveal="fade-up">
            <p class="section-overline">TESTIMONI ALUMNI &amp; MITRA</p>
            <h2 class="section-title">Apa Kata Mereka</h2>
            <p class="section-subtitle">
                Pengalaman nyata dari alumni dan mitra industri yang telah berkembang bersama DHS
            </p>
        </div>

        {{-- Slider Container --}}
        <div class="testimonial-slider-wrapper" data-reveal="fade-up" data-delay="200">
            <div class="testimonial-slider" x-data="testimonialSlider({{ $testimonials->count() }})">

                {{-- Progress Bar --}}
                <div class="autoplay-progress">
                    <div class="autoplay-bar" :style="`width: ${progressPercent}%`"></div>
                </div>

                {{-- Slider Track --}}
                <div class="slider-track">
                    @foreach($testimonials as $index => $testi)
                    <div class="testimonial-card"
                         x-show="currentSlide === {{ $index }}"
                         x-transition:enter="transition-enter"
                         x-transition:enter-start="transition-enter-start"
                         x-transition:enter-end="transition-enter-end"
                         x-transition:leave="transition-leave"
                         x-transition:leave-start="transition-leave-start"
                         x-transition:leave-end="transition-leave-end"
                    >
                        {{-- Large Quote Mark --}}
                        <div class="big-quote">&ldquo;</div>

                        {{-- Testimonial Content --}}
                        <div class="testimonial-content">
                            <p class="testimonial-quote">{{ $testi->quote }}</p>
                        </div>

                        {{-- Divider --}}
                        <div class="testi-divider"></div>

                        {{-- Author Info (text only, no photo) --}}
                        <div class="testimonial-author">
                            <div class="author-info">
                                <h4 class="author-name">{{ $testi->name }}</h4>
                                @if($testi->position)
                                <p class="author-position">{{ $testi->position }}</p>
                                @endif
                                @if($testi->company)
                                <p class="author-company">{{ $testi->company }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Rating Stars --}}
                        @if($testi->rating)
                        <div class="testimonial-rating">
                            @for($i = 1; $i <= 5; $i++)
                            <span class="star-icon {{ $i <= $testi->rating ? 'filled' : 'empty' }}">&#9733;</span>
                            @endfor
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>

                {{-- Navigation Dots --}}
                <div class="slider-dots">
                    @foreach($testimonials as $index => $testi)
                    <button
                        type="button"
                        class="dot"
                        :class="{ 'active': currentSlide === {{ $index }} }"
                        @click="goToSlide({{ $index }})"
                        aria-label="Go to slide {{ $index + 1 }}"
                    ></button>
                    @endforeach
                </div>

                {{-- Navigation Arrows --}}
                <button type="button" class="slider-arrow prev" @click="prevSlide()" aria-label="Previous testimonial">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>
                <button type="button" class="slider-arrow next" @click="nextSlide()" aria-label="Next testimonial">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </div>
        </div>
    </div>
</section>

<style>
    .testimonial-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #F6F2EA 0%, #EFE7D8 100%);
        position: relative;
        overflow: hidden;
    }

    .testimonial-section::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(14,6,180,0.06) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .testimonial-section::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(14,6,180,0.04) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .section-overline {
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #0E06B4;
        margin-bottom: 12px;
    }

    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 12px;
        line-height: 1.2;
    }

    .section-subtitle {
        font-size: 0.95rem;
        color: #888;
        max-width: 520px;
        margin: 0 auto 48px;
        line-height: 1.7;
    }

    .testimonial-slider-wrapper {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
    }

    /* Progress bar */
    .autoplay-progress {
        height: 3px;
        background: rgba(14,6,180,0.12);
        border-radius: 2px;
        margin-bottom: 32px;
        overflow: hidden;
    }

    .autoplay-bar {
        height: 100%;
        background: linear-gradient(90deg, #0E06B4, #4B45D4);
        border-radius: 2px;
        transition: width 0.1s linear;
    }

    .testimonial-slider {
        position: relative;
        padding: 0 60px;
    }

    .slider-track {
        position: relative;
        min-height: 360px;
    }

    .testimonial-card {
        background: #fff;
        border-radius: 20px;
        padding: 48px 44px 40px;
        box-shadow: 0 24px 64px rgba(0,0,0,0.07), 0 4px 16px rgba(14,6,180,0.05);
        text-align: center;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        border: 1px solid rgba(14,6,180,0.06);
    }

    /* Animated transitions */
    .transition-enter {
        transition: opacity 0.45s ease, transform 0.45s ease;
    }
    .transition-enter-start {
        opacity: 0;
        transform: translateX(40px);
    }
    .transition-enter-end {
        opacity: 1;
        transform: translateX(0);
    }
    .transition-leave {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    .transition-leave-start {
        opacity: 1;
        transform: translateX(0);
    }
    .transition-leave-end {
        opacity: 0;
        transform: translateX(-40px);
    }

    /* Large decorative quote */
    .big-quote {
        font-family: 'Playfair Display', serif;
        font-size: 100px;
        line-height: 0.6;
        color: #0E06B4;
        opacity: 0.12;
        margin-bottom: 20px;
        user-select: none;
        letter-spacing: -4px;
    }

    .testimonial-quote {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        line-height: 1.85;
        color: #2a2a3e;
        margin-bottom: 32px;
        font-style: italic;
    }

    .testi-divider {
        width: 40px;
        height: 2px;
        background: linear-gradient(90deg, #0E06B4, #4B45D4);
        margin: 0 auto 24px;
        border-radius: 1px;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .author-info {
        text-align: center;
    }

    .author-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: #0E06B4;
        margin: 0 0 4px;
        letter-spacing: 0.01em;
    }

    .author-position {
        font-size: 0.83rem;
        color: #666;
        margin: 0 0 2px;
        font-weight: 500;
    }

    .author-company {
        font-size: 0.77rem;
        color: #aaa;
        margin: 0;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        font-size: 0.68rem;
    }

    .testimonial-rating {
        display: flex;
        justify-content: center;
        gap: 4px;
        margin-top: 12px;
    }

    .star-icon {
        font-size: 20px;
    }

    .star-icon.filled {
        color: #F5A623;
    }

    .star-icon.empty {
        color: #e0e0e0;
    }

    /* Dots */
    .slider-dots {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 32px;
        position: relative;
        z-index: 2;
    }

    .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(14,6,180,0.18);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
    }

    .dot:hover {
        background: rgba(14,6,180,0.45);
        transform: scale(1.2);
    }

    .dot.active {
        background: #0E06B4;
        width: 28px;
        border-radius: 5px;
    }

    /* Arrows */
    .slider-arrow {
        position: absolute;
        top: calc(50% - 40px);
        transform: translateY(-50%);
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid rgba(14,6,180,0.25);
        color: #0E06B4;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.25s ease;
        z-index: 10;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .slider-arrow:hover {
        background: #0E06B4;
        border-color: #0E06B4;
        color: #fff;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 8px 24px rgba(14,6,180,0.25);
    }

    .slider-arrow.prev {
        left: 0;
    }

    .slider-arrow.next {
        right: 0;
    }

    .slider-arrow svg {
        flex-shrink: 0;
    }

    @media (max-width: 768px) {
        .testimonial-section {
            padding: 60px 0;
        }

        .testimonial-slider {
            padding: 0 16px;
        }

        .slider-track {
            min-height: 420px;
        }

        .testimonial-card {
            padding: 32px 24px 28px;
        }

        .testimonial-quote {
            font-size: 1rem;
        }

        .big-quote {
            font-size: 72px;
        }

        .slider-arrow {
            width: 38px;
            height: 38px;
            top: calc(50% - 20px);
        }

        .slider-arrow svg {
            width: 20px;
            height: 20px;
        }
    }
</style>
@endif
