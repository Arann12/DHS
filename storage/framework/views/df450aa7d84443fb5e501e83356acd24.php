<?php $__env->startSection('title', $article->title . ' — Denpasar Hotel School'); ?>

<?php $__env->startPush('styles'); ?>
<style>
#share-modal {
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease;
}
#share-modal.is-open {
    opacity: 1;
    visibility: visible;
}
#share-modal-content {
    transform: translateY(100%);
    transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
}
#share-modal.is-open #share-modal-content {
    transform: translateY(0);
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <section class="relative h-[50vh] min-h-[400px] flex items-center justify-center text-center overflow-hidden mb-12">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <?php if($article->thumbnail_url): ?>
        <img alt="<?php echo e($article->title); ?>" class="absolute inset-0 w-full h-full object-cover" src="<?php echo e($article->thumbnail_url); ?>">
        <?php else: ?>
        <img alt="News" class="absolute inset-0 w-full h-full object-cover" src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1600&auto=format&fit=crop">
        <?php endif; ?>

        <div class="relative z-20 px-6 max-w-5xl mx-auto pt-24 text-white" data-reveal="fade-up">
            <div class="mb-6 inline-flex items-center space-x-2 justify-center text-white/80 text-xs font-semibold uppercase tracking-wider">
                <a class="hover:text-white transition-colors" href="/"><span data-id="Beranda" data-en="Home">Beranda</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <a class="hover:text-white transition-colors" href="/berita"><span data-id="Berita" data-en="News">Berita</span></a>
                <span class="material-icons text-sm text-white/40">chevron_right</span>
                <span class="text-white font-bold"><?php echo e($article->category); ?></span>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-6 leading-[1.1]">
                <?php echo e($article->title); ?>

            </h1>
            <div class="flex items-center justify-center gap-4 text-white/80 text-sm">
                <?php if($article->author): ?>
                <span><?php echo e($article->author->name); ?></span>
                <span class="w-1 h-1 bg-white/40 rounded-full"></span>
                <?php endif; ?>
                <span><?php echo e($article->published_at?->format('d M Y') ?? $article->created_at->format('d M Y')); ?></span>
                <span class="w-1 h-1 bg-white/40 rounded-full"></span>
                <span class="flex items-center gap-1.5" id="views-count-display">
                    <span class="material-icons" style="font-size:16px;">visibility</span>
                    <span id="views-count-num"><?php echo e(number_format($article->views_count)); ?></span> views
                </span>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <article class="max-w-[800px] mx-auto px-5 md:px-16 pb-20">
        
        <?php if($article->excerpt): ?>
        <p class="text-lg text-muted-light leading-relaxed mb-8 font-medium border-l-4 border-primary pl-6">
            <?php echo e($article->excerpt); ?>

        </p>
        <?php endif; ?>

        
        <div class="prose prose-lg max-w-none text-text-light leading-relaxed">
            <?php echo $article->content; ?>

        </div>

        
        <div class="mt-10 pt-8 border-t border-black/10">
            <button onclick="openShareModal()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                <span class="material-icons" style="font-size:18px;">share</span>
                <span data-id="Bagikan Artikel" data-en="Share Article">Bagikan Artikel</span>
            </button>
        </div>

        
        <div class="mt-16 pt-8 border-t border-black/10">
            <a href="/berita" class="inline-flex items-center gap-2 text-primary text-sm font-semibold hover:gap-3 transition-all">
                <span class="material-icons text-sm">arrow_back</span>
                <span data-id="Kembali ke Berita" data-en="Back to News">Kembali ke Berita</span>
            </a>
        </div>
    </article>

    
    <div id="share-modal" style="position:fixed;inset:0;z-index:9998;opacity:0;visibility:hidden;transition:opacity 0.3s ease;">
        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.6);" onclick="closeShareModal()"></div>
        <div id="share-modal-content" style="position:absolute;bottom:0;left:0;right:0;background:#1a1a1a;border-radius:1.5rem 1.5rem 0 0;padding:2rem 1.5rem 2.5rem;transform:translateY(100%);transition:transform 0.35s cubic-bezier(0.4,0,0.2,1);">
            <div style="width:2.5rem;height:0.25rem;background:#4b5563;border-radius:9999px;margin:0 auto 1.5rem;"></div>
            <p style="color:#fff;text-align:center;font-size:0.875rem;font-weight:500;margin-bottom:1.75rem;">Bagikan artikel ini melalui</p>
            <div style="display:flex;justify-content:center;gap:1.25rem;flex-wrap:wrap;">

                
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url('/berita/' . $article->slug))); ?>" target="_blank" rel="noopener" style="display:flex;flex-direction:column;align-items:center;gap:0.5rem;text-decoration:none;">
                    <div style="width:3.5rem;height:3.5rem;border-radius:9999px;background:#1877F2;display:flex;align-items:center;justify-content:center;">
                        <svg width="28" height="28" fill="#fff" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </div>
                    <span style="color:#9ca3af;font-size:11px;">Facebook</span>
                </a>

                
                <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(url('/berita/' . $article->slug))); ?>&text=<?php echo e(urlencode($article->title)); ?>" target="_blank" rel="noopener" style="display:flex;flex-direction:column;align-items:center;gap:0.5rem;text-decoration:none;">
                    <div style="width:3.5rem;height:3.5rem;border-radius:9999px;background:#000;border:1px solid #374151;display:flex;align-items:center;justify-content:center;">
                        <svg width="24" height="24" fill="#fff" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </div>
                    <span style="color:#9ca3af;font-size:11px;">X</span>
                </a>

                
                <a href="https://wa.me/?text=<?php echo e(urlencode($article->title . ' — ' . url('/berita/' . $article->slug))); ?>" target="_blank" rel="noopener" style="display:flex;flex-direction:column;align-items:center;gap:0.5rem;text-decoration:none;">
                    <div style="width:3.5rem;height:3.5rem;border-radius:9999px;background:#25D366;display:flex;align-items:center;justify-content:center;">
                        <svg width="28" height="28" fill="#fff" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </div>
                    <span style="color:#9ca3af;font-size:11px;">WhatsApp</span>
                </a>

                
                <a href="https://social-plugins.line.me/lineit/share?url=<?php echo e(urlencode(url('/berita/' . $article->slug))); ?>" target="_blank" rel="noopener" style="display:flex;flex-direction:column;align-items:center;gap:0.5rem;text-decoration:none;">
                    <div style="width:3.5rem;height:3.5rem;border-radius:9999px;background:#00B900;display:flex;align-items:center;justify-content:center;">
                        <svg width="28" height="28" fill="#fff" viewBox="0 0 24 24"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                    </div>
                    <span style="color:#9ca3af;font-size:11px;">Line</span>
                </a>

                
                <a href="https://t.me/share/url?url=<?php echo e(urlencode(url('/berita/' . $article->slug))); ?>&text=<?php echo e(urlencode($article->title)); ?>" target="_blank" rel="noopener" style="display:flex;flex-direction:column;align-items:center;gap:0.5rem;text-decoration:none;">
                    <div style="width:3.5rem;height:3.5rem;border-radius:9999px;background:#2AABEE;display:flex;align-items:center;justify-content:center;">
                        <svg width="28" height="28" fill="#fff" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.479.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                    </div>
                    <span style="color:#9ca3af;font-size:11px;">Telegram</span>
                </a>

                
                <button onclick="copyArticleLink()" id="copy-link-btn" style="display:flex;flex-direction:column;align-items:center;gap:0.5rem;background:none;border:none;cursor:pointer;padding:0;">
                    <div style="width:3.5rem;height:3.5rem;border-radius:9999px;background:#555;display:flex;align-items:center;justify-content:center;">
                        <span class="material-icons" style="font-size:24px;color:#fff;">link</span>
                    </div>
                    <span id="copy-link-label" style="color:#9ca3af;font-size:11px;">Copy Link</span>
                </button>

            </div>
        </div>
    </div>

    
    <?php if($related->count() > 0): ?>
    <section class="bg-dhs-cream/50 py-16 px-5 md:px-16 border-t border-black/5">
        <div class="max-w-[1280px] mx-auto">
            <h2 class="text-3xl font-serif text-text-light mb-10"><span data-id="Berita Lainnya" data-en="Other News">Berita Lainnya</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="/berita/<?php echo e($rel->slug); ?>" class="group bg-white overflow-hidden shadow-sm flex flex-col hover:shadow-md transition-shadow">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?php echo e($rel->title); ?>" src="<?php echo e($rel->thumbnail_url ?? 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=800'); ?>">
                    </div>
                    <div class="p-5">
                        <span class="text-[0.7rem] uppercase tracking-[0.15em] font-semibold text-primary"><?php echo e($rel->category); ?></span>
                        <h3 class="text-lg font-serif font-semibold text-text-light mt-2 group-hover:text-primary transition-colors line-clamp-2"><?php echo e($rel->title); ?></h3>
                        <p class="text-sm text-muted-light mt-2"><?php echo e($rel->published_at?->format('d M Y') ?? ''); ?></p>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const articleUrl = '<?php echo e(url("/berita/" . $article->slug)); ?>';

// Share Modal — pindahkan ke body agar tidak terpengaruh overflow/clipping parent
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('share-modal');
    if (modal && modal.parentElement !== document.body) {
        document.body.appendChild(modal);
    }
});

function openShareModal() {
    const modal = document.getElementById('share-modal');
    const sheet = document.getElementById('share-modal-content');
    if (!modal || !sheet) return;
    // Tampilkan modal
    modal.style.opacity = '0';
    modal.style.visibility = 'visible';
    document.body.style.overflow = 'hidden';
    // Force reflow
    sheet.getBoundingClientRect();
    // Animasi masuk
    requestAnimationFrame(function() {
        modal.style.opacity = '1';
        sheet.style.transform = 'translateY(0)';
    });
}

function closeShareModal() {
    const modal = document.getElementById('share-modal');
    const sheet = document.getElementById('share-modal-content');
    if (!modal || !sheet) return;
    modal.style.opacity = '0';
    sheet.style.transform = 'translateY(100%)';
    document.body.style.overflow = '';
    setTimeout(function() {
        modal.style.visibility = 'hidden';
    }, 350);
}

// Tutup modal jika tekan tombol Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeShareModal();
});

// Copy Link
function copyArticleLink() {
    navigator.clipboard.writeText(articleUrl).then(() => {
        const label = document.getElementById('copy-link-label');
        const icon = document.querySelector('#copy-link-btn .material-icons');
        label.textContent = 'Tersalin!';
        label.classList.add('text-green-400');
        icon.textContent = 'check_circle';
        icon.classList.add('text-green-400');
        setTimeout(() => {
            label.textContent = 'Copy Link';
            label.classList.remove('text-green-400');
            icon.textContent = 'link';
            icon.classList.remove('text-green-400');
        }, 2000);
    }).catch(() => {
        const ta = document.createElement('textarea');
        ta.value = articleUrl;
        document.body.appendChild(ta);
        ta.select();
        document.execCommand('copy');
        document.body.removeChild(ta);
    });
}

// AJAX Polling: fetch latest views count every 30 seconds
const articleSlug = '<?php echo e($article->slug); ?>';
function fetchViews() {
    fetch('/berita/' + articleSlug + '/views')
        .then(r => r.json())
        .then(data => {
            if (data.views_count !== undefined) {
                const el = document.getElementById('views-count-num');
                if (el) el.textContent = Number(data.views_count).toLocaleString('id-ID');
            }
        })
        .catch(() => {});
}
setInterval(fetchViews, 30000);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\DHS\resources\views/detail-berita.blade.php ENDPATH**/ ?>