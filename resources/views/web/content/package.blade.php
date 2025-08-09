@extends('web.layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp

<!-- ✅ CSS الجديد للصفحة -->
<style>
    :root {
        --gold-primary: #D4AF37;
        --gold-secondary: #FFD700;
        --gold-light: #FFE986;
        --gold-dark: #B8860B;
        --black-primary: #121212;
        --black-secondary: #1E1E1E;
        --white: #FFFFFF;
        --transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    /* تصميم الهيدر */
    .page-header {
        background: var(--black-primary);
        position: relative;
        overflow: hidden;
    }

    .page-header:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), transparent);
    }

    .page-header__inner {
        text-align: center;
        padding: 70px 0;
        position: relative;
        z-index: 1;
    }

    /* تأثير الكتابة الآلية */
    #typed-title {
        display: inline-block;
        font-family: 'Playfair Display', serif;
        font-size: 72px;
        font-weight: 700;
        color: var(--gold-primary);
        position: relative;
        margin: 0;
    }

    #typed-title:after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: var(--gold-primary);
    }

    /* تصميم الباقات */
    .packages-container {
        background: var(--black-secondary);
        padding: 80px 0;
    }

    .packages-container .container .row {
      row-gap: 10px
    }

    .package-card {
        background: rgba(30, 30, 30, 0.8);
        border: 1px solid rgba(212, 175, 55, 0.3);
        border-radius: 12px;
        padding: 40px 30px;
        height: 100%;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        margin-bottom: 30px;
    }

    .package-card:hover {
        transform: translateY(-10px);
        border-color: var(--gold-primary);
        box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2);
    }

    .package-card:before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(212, 175, 55, 0.1), transparent);
        transform: rotate(45deg);
        transition: var(--transition);
    }

    .package-card:hover:before {
        left: 100%;
        top: 100%;
    }

    .package-header {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
    }

    .package-icon {
        width: 60px;
        height: 60px;
        background: rgba(212, 175, 55, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .package-icon i {
        color: var(--gold-primary);
        font-size: 24px;
    }

    .package-name {
        font-size: 24px;
        font-weight: 600;
        color: var(--white);
        margin: 0;
    }

    .package-title {
        font-size: 18px;
        color: var(--gold-light);
        margin: 5px 0 0;
    }

    .package-features {
        list-style: none;
        padding: 0;
        margin: 30px 0;
    }

    .package-feature {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .feature-icon {
        color: var(--gold-primary);
        margin-right: 15px;
        font-size: 14px;
        margin-top: 3px;
    }

    .feature-text {
        color: var(--white);
        line-height: 1.6;
        flex: 1;
    }

    .package-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 30px;
        background: linear-gradient(135deg, var(--gold-dark), var(--gold-primary));
        color: var(--black-primary);
        border: none;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .package-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        color: var(--black-primary);
    }

    .package-btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
        opacity: 0;
        transition: var(--transition);
    }

    .package-btn:hover:before {
        opacity: 1;
    }

    .package-btn span {
        position: relative;
        z-index: 1;
    }

    /* تأثيرات الحركة */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .package-card {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
    }

    /* التكيف مع الشاشات الصغيرة */
    @media (max-width: 1199px) {
        #typed-title {
            font-size: 60px;
        }
    }

    @media (max-width: 991px) {
        .page-header__inner {
            padding: 80px 0;
        }

        #typed-title {
            font-size: 48px;
        }

        .package-card {
            padding: 30px 20px;
        }
    }

    @media (max-width: 767px) {
        .page-header__inner {
            padding: 60px 0;
        }

        #typed-title {
            font-size: 36px;
        }

        .package-icon {
            width: 50px;
            height: 50px;
        }

        .package-name {
            font-size: 20px;
        }
    }

    @media (max-width: 575px) {
        #typed-title {
            font-size: 28px;
        }

        .packages-container {
            padding: 60px 0;
        }
    }
</style>

<!-- ✅ هيكل الصفحة المعدل -->
<section class="page-header">
    <div class="container">
        <div class="page-header__inner">
            <h2 id="typed-title"></h2>
        </div>
    </div>
</section>

<section class="packages-container">
    <div class="container">
        <div class="row">
            @foreach ($packages as $index => $package)
                <div class="col-xl-4 col-lg-4 col-md-6" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="package-card">
                        <div class="package-header">
                            <div class="package-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div>
                                <h3 class="package-name">{{ $package->name_en }}</h3>
                                <p class="package-title">{{ $package->title_en }}</p>
                            </div>
                        </div>

                        @if($package->description_en)
                            <ul class="package-features">
                                @foreach (explode("\n", $package->description_en) as $point)
                                    @if (trim($point))
                                        <li class="package-feature">
                                            <i class="fas fa-check feature-icon"></i>
                                            <p class="feature-text">{{ trim($point) }}</p>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif

                        <a href="{{ route('web.becomesponsor') }}" class="package-btn">
                            <span>Become Sponsor <i class="fas fa-arrow-right ms-2"></i></span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ✅ Scripts -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // تأثير الكتابة الآلية
    const text = "Choose Your Package";
    const el = document.getElementById("typed-title");
    let index = 0;
    let hasStarted = false;

    function typeWriter() {
        if (index < text.length) {
            el.innerHTML += text.charAt(index);
            index++;
            setTimeout(typeWriter, 100);
        } else {
            el.classList.add('finished');
        }
    }

    const observer = new IntersectionObserver(function (entries) {
        if (entries[0].isIntersecting && !hasStarted) {
            hasStarted = true;
            typeWriter();
        }
    }, { threshold: 0.5 });

    observer.observe(el);

    // تأثير ظهور الباقات بالتتابع
    const packageCards = document.querySelectorAll('.package-card');
    packageCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
});
</script>

<!-- خطوط جوجل -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

<!-- أيقونات Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
