@if ($gallery_section && $gallery_section->media_type === 'image')
<!-- ✅ CSS الجديد للمعرض الفاخر -->
<style>
    :root {
        --gold-primary: #D4AF37;
        --gold-secondary: #FFD700;
        --gold-dark: #B8860B;
        --black-primary: #121212;
        --black-secondary: #1E1E1E;
        --white: #FFFFFF;
        --transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .premium-gallery {
        background: var(--black-primary);
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .gallery-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .gallery-subtitle {
        color: var(--gold-primary);
        font-weight: 600;
        font-size: 18px;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 15px;
        display: block;
        position: relative;
    }

    .gallery-subtitle:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
    }

    .gallery-title {
        color: var(--white);
        font-size: 42px;
        font-weight: 700;
        margin: 20px 0 0;
        font-family: 'Playfair Display', serif;
    }

    /* تصميم السلايدر الفاخر */
    .premium-gallery-slider {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 60px;
    }

    .gallery-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 500px;
        overflow: hidden;
        border-radius: 12px;
        position: relative;
    }

    .gallery-slide:after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(18,18,18,0.1), rgba(18,18,18,0.7));
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .gallery-slide:hover .gallery-image {
        transform: scale(1.05);
    }

    /* أزرار التنقل */
    .gallery-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 60px;
        height: 60px;
        background: rgba(212, 175, 55, 0.2);
        backdrop-filter: blur(5px);
        border: 1px solid var(--gold-primary);
        border-radius: 50%;
        color: var(--gold-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: var(--transition);
    }

    .gallery-nav-btn:hover {
        background: rgba(212, 175, 55, 0.4);
        transform: translateY(-50%) scale(1.1);
    }

    .gallery-nav-btn.prev {
        left: 0;
    }

    .gallery-nav-btn.next {
        right: 0;
    }

    .gallery-nav-btn i {
        font-size: 24px;
    }

    /* مؤشر الصور الصغيرة (للجوال) */
    .gallery-pagination {
        display: flex;
        justify-content: center;
        margin-top: 30px;
        gap: 10px;
    }

    .gallery-pagination-item {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        cursor: pointer;
        transition: var(--transition);
    }

    .gallery-pagination-item.active {
        background: var(--gold-primary);
        transform: scale(1.2);
    }

    /* زر المزيد */
    .gallery-more-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-top: 15px;
    }
    /* تأثيرات الحركة */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .gallery-header {
        animation: fadeIn 1s ease;
    }

    /* التكيف مع الشاشات الصغيرة */
    @media (max-width: 1199px) {
        .gallery-title {
            font-size: 36px;
        }

        .gallery-slide {
            height: 450px;
        }
    }

    @media (max-width: 991px) {
        .premium-gallery {
            padding: 60px 0;
        }

        .gallery-title {
            font-size: 32px;
        }

        .premium-gallery-slider {
            padding: 0 40px;
        }
    }

    @media (max-width: 767px) {
        .gallery-header {
            margin-bottom: 40px;
        }

        .gallery-title {
            font-size: 28px;
        }

        .gallery-subtitle {
            font-size: 16px;
            letter-spacing: 2px;
        }

        .gallery-slide {
            height: 350px;
        }

        .gallery-nav-btn {
            width: 50px;
            height: 50px;
        }

        .gallery-more-btn {
            padding: 12px 30px;
            font-size: 14px;
        }
    }

    @media (max-width: 575px) {
        .premium-gallery-slider {
            padding: 0 30px;
        }

        .gallery-slide {
            height: 300px;
        }

        .gallery-nav-btn {
            width: 40px;
            height: 40px;
        }

        .gallery-nav-btn i {
            font-size: 18px;
        }
    }
</style>

<!-- ✅ هيكل المعرض الفاخر -->
<section class="premium-gallery">
    <div class="container">
        <!-- العنوان -->
        <div class="gallery-header">
            <span class="gallery-subtitle">
                {{ $gallery_section->title[$locale] ?? 'GALLERY' }}
            </span>
            <h2 class="gallery-title">
                {{ $gallery_section->description[$locale] ?? 'Our Moments' }}
            </h2>
        </div>

        <!-- السلايدر -->
        <div class="premium-gallery-slider">
            <!-- زر السابق -->
            <button class="gallery-nav-btn prev">
                <i class="fas fa-chevron-left"></i>
            </button>

            <!-- الصورة الحالية -->
            <div class="gallery-slide">
                <img src="{{ asset($gallieries[0]->image) }}" class="gallery-image" alt="Gallery Image" id="currentSlide">
            </div>

            <!-- زر التالي -->
            <button class="gallery-nav-btn next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- مؤشر الصور (للجوال) -->
        <div class="gallery-pagination" id="galleryPagination">
            @foreach ($gallieries as $key => $gallery)
                <div class="gallery-pagination-item {{ $key === 0 ? 'active' : '' }}" data-index="{{ $key }}"></div>
            @endforeach
        </div>

        <!-- زر المزيد -->
        <div class="text-center">
            <a href="{{ route('web.gallery') }}" class="gallery-more-btn thm-btn">
                <span><i class="fas fa-image me-2"></i> {{ __('More Gallery') }}</span>
            </a>
        </div>
    </div>
</section>

<!-- ✅ Scripts للمعرض -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const images = @json($gallieries->pluck('image'));
    const currentSlide = document.getElementById('currentSlide');
    const prevBtn = document.querySelector('.gallery-nav-btn.prev');
    const nextBtn = document.querySelector('.gallery-nav-btn.next');
    const paginationItems = document.querySelectorAll('.gallery-pagination-item');

    let currentIndex = 0;

    // تحديث الصورة الحالية
    function updateSlide() {
        currentSlide.src = images[currentIndex];
        currentSlide.style.opacity = 0;

        setTimeout(() => {
            currentSlide.style.opacity = 1;
        }, 50);

        // تحديث مؤشر الصور
        paginationItems.forEach((item, index) => {
            item.classList.toggle('active', index === currentIndex);
        });
    }

    // الانتقال للصورة التالية
    function nextSlide() {
        currentIndex = (currentIndex + 1) % images.length;
        updateSlide();
    }

    // الانتقال للصورة السابقة
    function prevSlide() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateSlide();
    }

    // أحداث الأزرار
    nextBtn.addEventListener('click', nextSlide);
    prevBtn.addEventListener('click', prevSlide);

    // أحداث مؤشر الصور
    paginationItems.forEach(item => {
        item.addEventListener('click', function() {
            currentIndex = parseInt(this.dataset.index);
            updateSlide();
        });
    });

    // التمرير بالسحب على الجوال
    let touchStartX = 0;
    let touchEndX = 0;

    currentSlide.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, false);

    currentSlide.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, false);

    function handleSwipe() {
        if (touchEndX < touchStartX - 50) {
            nextSlide(); // سحب لليسار
        }
        if (touchEndX > touchStartX + 50) {
            prevSlide(); // سحب لليمين
        }
    }

    // التبديل التلقائي (اختياري)
    let autoSlideInterval = setInterval(nextSlide, 5000);

    currentSlide.parentElement.addEventListener('mouseenter', () => {
        clearInterval(autoSlideInterval);
    });

    currentSlide.parentElement.addEventListener('mouseleave', () => {
        autoSlideInterval = setInterval(nextSlide, 5000);
    });
});
</script>

<!-- خطوط جوجل -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

<!-- أيقونات Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endif
