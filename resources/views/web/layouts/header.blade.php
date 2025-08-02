@php
    use App\Models\Setting;
    $setting = Setting::first();
@endphp

<style>
    /* الهيدر الأساسي شفاف */
    .main-header {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        background: transparent;
        z-index: 1000;
    }

    .main-header .main-menu__wrapper {
        background: transparent !important;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .main-menu__logo img,
    .main-menu__left .logo img {
        max-height: 100px;
        height: auto;
        width: auto;
        object-fit: contain;
    }

    .xs-sidebar-group .logo img {
        max-height: 150px !important;
        height: auto;
        width: auto;
        object-fit: contain;
    }

    /* Sticky header عند التمرير */
    .stricked-menu.stricky-fixed {
        background-color: #000 !important;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 9999;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .stricked-menu .main-menu__wrapper-inner {
        padding-top: 10px;
        padding-bottom: 10px;
    }
    /* شكل الهيدر عند التمرير */
header.main-header.is-sticky {
    position: fixed !important;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #000 !important;
    z-index: 9999;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}
@media (min-width: 992px) {
    .main-menu__left {
        padding-left: 90px;
    }
}

@media (min-width: 992px) and (max-width: 1199.98px) {
    .laptop-padding {
        padding-left: 90px;
    }
  
        .main-menu__wrapper-inner {
        padding: 0 90px;
    }
}

@media (min-width: 1200px) and (max-width: 1319px) {
    .main-menu__wrapper-inner {
        padding: 0 70px;
    }
}
</style>


<!-- ✅ JavaScript لتفعيل sticky header -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stickyHeader = document.querySelector(".stricked-menu");
        const triggerHeight = 100;

        window.addEventListener("scroll", function () {
            if (window.scrollY > triggerHeight) {
                stickyHeader.classList.add("stricky-fixed");
            } else {
                stickyHeader.classList.remove("stricky-fixed");
            }
        });
    });
</script>

<!-- ✅ سايدبار للموبايل -->
<div class="xs-sidebar-group info-group info-sidebar">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="#" class="close-side-widget">×</a>
            </div>

            <div class="sidebar-textwidget">
                <div class="sidebar-info-contents">
                    <div class="content-inner">
                        <div class="logo mb-4 text-center">
                            <a href="{{ route('web.home') }}">
                                <img src="{{ asset($setting->img) }}"
                                     alt="Logo"
                                     style="max-height: 60px; height: auto; width: auto; object-fit: contain; display: block; margin: 0 auto;">
                            </a>
                        </div>

                        <div class="content-box text-center">
                            <h4>{{ __('About Us') }}</h4>
                            <p>{{ $setting->about_us ?? __('We are a leading company specializing in...') }}</p>
                        </div>

                        <div class="form-inner mt-5">
                            <h4 class="text-center">{{ __('Get a Free Quote') }}</h4>

                            <form action="{{ route('web.contact') }}" method="POST" class="contact-form-validated">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="{{ __('Name') }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="{{ __('Email') }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="{{ __('Message...') }}" class="form-control" rows="4" required></textarea>
                                </div>
                                <div class="form-group message-btn text-center">
                                    <button type="submit" class="thm-btn form-inner__btn">{{ __('Submit Now') }}</button>
                                </div>
                            </form>
                            <div class="result mt-2 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ✅ الهيدر الرئيسي -->
<header class="main-header main-header-three">
    <nav class="main-menu main-menu-three">
        <div class="main-menu__wrapper">
            <div class="main-menu__wrapper-inner">
                <div class="main-menu__left">
                    <div class="logo">
                        <a href="{{ route('web.home') }}">
                            <img src="{{ asset($setting->img) }}" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="main-menu__right" >
                    <div class="main-menu__main-menu-box">
                        <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                        <ul class="main-menu__list">
                            <li><a href="{{ route('web.home') }}" style="text-decoration:none;">Home</a></li>
                            <li><a href="{{ route('web.about') }}" style="text-decoration:none;">About</a></li>
                            <li><a href="{{ route('web.packages') }}" style="text-decoration:none;">Packages</a></li>
                            <li><a href="{{ route('web.voting') }}" style="text-decoration:none;">Voting</a></li>
                            <li><a href="{{ route('web.prizes') }}" style="text-decoration:none;">Prizes</a></li>
                            <li><a href="{{ route('web.contact') }}" style="text-decoration:none;">Contact</a></li>
                            <li class="dropdown">
                                <a href="#" style="text-decoration:none;">More</a>
                                <ul>
                                    <li><a href="{{ route('web.multi_media') }}" style="text-decoration:none;">Multi Media</a></li>
                                    <li><a href="{{ route('web.luxury') }}" style="text-decoration:none;">Luxury FX Community</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="main-menu__btn-box">
                        <a href="{{ route('web.becomesponsor') }}" class="main-menu__btn thm-btn" style="text-decoration:none;">
                            Become Sponsor <span class="icon-arrow-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- ✅ الهيدر البديل (يظهر عند التمرير) -->
<div class="stricky-header stricked-menu main-menu main-menu-three">
    <div class="sticky-header__content">
        {{-- يتم نسخه تلقائيًا عبر JavaScript أو عبر CSS من الهيدر الأصلي --}}
    </div>
</div>


