

<?php if($testimonials && $testimonials->count() > 0): ?>
<section class="testimonial-section" id="testimonial-section">
    <div class="container-custom">
        
        <div class="section-header text-center" data-reveal="fade-up">
            <p class="section-overline">TESTIMONI ALUMNI &amp; MITRA</p>
            <h2 class="section-title">Apa Kata Mereka</h2>
            <p class="section-subtitle">
                Pengalaman nyata dari alumni dan mitra industri yang telah berkembang bersama DHS
            </p>
        </div>

        
        <div class="testimonial-slider-wrapper" data-reveal="fade-up" data-delay="200">
            <div class="testimonial-slider" x-data="testimonialSlider(<?php echo e($testimonials->count()); ?>)" @touchstart="handleTouchStart($event)" @touchend="handleTouchEnd($event)">

                
                <div class="autoplay-progress">
                    <div class="autoplay-bar" :style="`width: ${progressPercent}%`"></div>
                </div>

                
                <div class="slider-track">
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $testi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="testimonial-card"
                         x-show="currentSlide === <?php echo e($index); ?>"
                         x-transition:enter="transition-enter"
                         x-transition:enter-start="transition-enter-start"
                         x-transition:enter-end="transition-enter-end"
                         x-transition:leave="transition-leave"
                         x-transition:leave-start="transition-leave-start"
                         x-transition:leave-end="transition-leave-end"
                    >
                        
                        <div class="big-quote">&ldquo;</div>

                        
                        <div class="testimonial-content">
                            <p class="testimonial-quote"><?php echo e($testi->quote); ?></p>
                        </div>

                        
                        <div class="testi-divider"></div>

                        
                        <div class="testimonial-author">
                            <div class="author-info">
                                <h4 class="author-name"><?php echo e($testi->name); ?></h4>
                                <?php if($testi->position): ?>
                                <p class="author-position"><?php echo e($testi->position); ?></p>
                                <?php endif; ?>
                                <?php if($testi->company): ?>
                                <p class="author-company"><?php echo e($testi->company); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        
                        <?php if($testi->rating): ?>
                        <div class="testimonial-rating">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <span class="star-icon <?php echo e($i <= $testi->rating ? 'filled' : 'empty'); ?>">&#9733;</span>
                            <?php endfor; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="slider-dots">
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $testi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button
                        type="button"
                        class="dot"
                        :class="{ 'active': currentSlide === <?php echo e($index); ?> }"
                        @click="goToSlide(<?php echo e($index); ?>)"
                        aria-label="Go to slide <?php echo e($index + 1); ?>"
                    ></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    .testimonial-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #1A1F6B 0%, #101340 100%);
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
        color: #C7A14D;
        margin-bottom: 12px;
    }

    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: #FFFFFF;
        margin-bottom: 12px;
        line-height: 1.2;
    }

    .section-subtitle {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.6);
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
        background: rgba(255,255,255,0.12);
        border-radius: 2px;
        margin-bottom: 32px;
        overflow: hidden;
    }

    .autoplay-bar {
        height: 100%;
        background: linear-gradient(90deg, #C7A14D, #DFC06A);
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
        color: #C7A14D;
        opacity: 0.15;
        margin-bottom: 20px;
        user-select: none;
        letter-spacing: -4px;
    }

    .testimonial-quote {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        line-height: 1.85;
        color: #1a1a2e;
        margin-bottom: 32px;
        font-style: italic;
    }

    .testi-divider {
        width: 40px;
        height: 2px;
        background: linear-gradient(90deg, #C7A14D, #DFC06A);
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
        color: #1A1F6B;
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
        color: #999;
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
        color: #C7A14D;
    }

    .star-icon.empty {
        color: rgba(255,255,255,0.2);
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
        background: rgba(255,255,255,0.18);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
    }

    .dot:hover {
        background: rgba(199,161,77,0.5);
        transform: scale(1.2);
    }

    .dot.active {
        background: #C7A14D;
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
        border: 2px solid rgba(255,255,255,0.25);
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.25s ease;
        z-index: 10;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .slider-arrow:hover {
        background: #C7A14D;
        border-color: #C7A14D;
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
<?php endif; ?>
<?php /**PATH D:\laragon\www\DHS\resources\views\components\testimonial-slider.blade.php ENDPATH**/ ?>