<!DOCTYPE html>
<html class="wide" lang="en">
    @php
    use App\Models\Setting;
    $setting = Setting::first();
@endphp
<head>
    <meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Top Trusted Fxbrokers</title>

<!-- favicons Icons -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset($setting->img) }}?v={{ time() }}" />
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset($setting->img) }}?v={{ time() }}" />
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset($setting->img) }}?v={{ time() }}" />
<link rel="manifest" href="{{ asset('web/assets/images/favicons/site.webmanifest') }}?v={{ time() }}" />
<meta name="description" content="eventflow HTML 5 Template" />

<!-- fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('web/assets/vendors/bootstrap/css/bootstrap.min.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/vendors/animate/animate.min.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/vendors/animate/custom-animate.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/vendors/fontawesome/css/all.min.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/vendors/jarallax/jarallax.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/vendors/odometer/odometer.min.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/vendors/swiper/swiper.min.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/vendors/eventflow-icons/style.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('web/assets/vendors/owl-carousel/owl.carousel.min.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/vendors/owl-carousel/owl.theme.default.min.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/vendors/bootstrap-select/css/bootstrap-select.min.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/vendors/nice-select/nice-select.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/vendors/jquery-ui/jquery-ui.css') }}?v={{ time() }}" />

<!-- Template styles -->
<link rel="stylesheet" href="{{ asset('web/assets/css/eventflow.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('web/assets/css/eventflow-responsive.css') }}?v={{ time() }}" />
<style>
    a{
    text-decoration: none;
}
body{
    color: white;
}
</style>
</head>
@php
  $event = \App\Models\Event::where('event_date', '>', now())->orderBy('event_date')->first();
    $setting = \App\Models\Setting::first();

  $whatsappNumber = $setting->phone; // رقم الواتساب
@endphp

 @php
  use Carbon\Carbon;
  $eventDate = \Carbon\Carbon::parse($event->event_date)->format('Y-m-d H:i:s');
@endphp
<style>
  .countdown-section, .countdown-section * {
    font-family: "Barlow", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
  }
   .container {
    width: 100%;
    padding-right: 55px;
    padding-left: 55px;
    margin-right: auto;
    margin-left: auto;
}
  

  .countdown-section {
    position: fixed;
    bottom: 0;
    width: 100%;
    background: linear-gradient(90deg, #FFE986 0%, #C48127 100%);
    color: black;
    padding: 15px 0;
    z-index: 9999;
  }

  .countdown-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
  }

  .countdown-text {
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    direction: ltr;
  }

  .countdown-timer span {
    margin: 0 5px;
  }

  .action-buttons {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: center;
  }

  .custom-button-white,
  .custom-button-red {
    padding: 10px 20px;
    font-size: 13px;
    font-weight: 700;
    border-radius: 8px;
    text-transform: uppercase;
    text-decoration: none;
    transition: 0.3s ease-in-out;
  }

  .custom-button-white {
    background-color: #ffffff;
    color: var(--e-global-color-primary, #000);
  }

  .custom-button-white:hover {
    background-color: var(--e-global-color-primary, #FFE986);
    color: #000;
  }

  .custom-button-red {
    background-color: var(--e-global-color-primary, #FFE986);
    color: black;
  }

  .custom-button-red:hover {
    background-color: #fff;
    color: var(--e-global-color-primary, #FFE986);
  }

  a {
    text-decoration: none;
  }

  #whatsapp-float {
    position: fixed;
    bottom: 90px;
    right: 15px;
    background-color: #1ebe5d;
    color: #1ebe5d;
    padding: 12px 14px;
    border-radius: 50%;
    font-size: 20px;
    z-index: 10000;
  }

  .custom-button-green {
    background-color: #25d366;
    color: white;
    padding: 10px 20px;
    font-size: 13px;
    font-weight: 700;
    border-radius: 8px;
    text-transform: uppercase;
    text-decoration: none;
    transition: 0.3s ease-in-out;
  }

  .custom-button-green:hover {
    background-color: #25d366;
    color: white;
  }

  .whatsapp-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border: 2px solid #25d366;
    background-color: #25d366;
    color: white;
    border-radius: 50%;
    font-size: 22px;
    transition: all 0.3s ease-in-out;
  }

  .whatsapp-icon:hover {
    background-color: #25d366;
    color: #fff;
    text-decoration: none;
  }

  @media (max-width: 767px) {
    .countdown-section {
      padding: 5px 0;
    }

    .countdown-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      gap: 20px;
      text-align: center;
    }

    .countdown-text {
      font-size: 13.5px;
      font-weight: bold;
      text-align: center;
      direction: ltr;
    }

    .action-buttons {
      display: flex;
      gap: 9px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .whatsapp-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 24px;
      height: 24px;
      background-color: transparent;
      color: #25d366;
      border-radius: 50%;
      font-size: 22px;
      transition: all 0.3s ease-in-out;
    }
    .container {
    width: 100%;
    padding-right: 0px;
    padding-left: 3px;
    margin-right: auto;
    margin-left: auto;
}
  }
 
</style>

<body class="body-bg-color-1">
    
  <!-- Preloader -->
 
  <!-- Main Page Content -->
    <div class="page-wrapper">
@if(session('toastr'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            toastr["{{ session('toastr.type') }}"]("{{ session('toastr.message') }}");
        });
    </script>
@endif

    {{-- Header --}}
    @include('web.layouts.header')

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('web.layouts.footer')

  </div>

 
  <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">

           
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->

       <!-- /.mobile-nav__top -->



        </div>
        <!-- /.mobile-nav__content -->
    </div>
    <!-- /.mobile-nav__wrapper -->

    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <!-- /.search-popup__overlay -->
        <div class="search-popup__content">
            <form action="#">
                <label for="search" class="sr-only">search here</label><!-- /.sr-only -->
                <input type="text" id="search" placeholder="Search Here..." />
                <button type="submit" aria-label="search submit" class="thm-btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <!-- /.search-popup__content -->
    </div>
    <!-- /.search-popup -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fas fa-arrow-up"></i></a>
<div class="countdown-section" id="countdownSection">
  <div class="container countdown-container">
    <div class="countdown-text">
      <span id="countdown-timer" class="countdown-timer"></span>
      <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="whatsapp-icon" aria-label="WhatsApp">
        <i class="bi bi-whatsapp"></i>
      </a>
    </div>

    <div class="action-buttons">
      <a href="{{ route('web.voting') }}" class="custom-button-white">
        {{ __('Voting') }}
      </a>
      <a href="{{ route('web.becomesponsor') }}" class="custom-button-red">
        {{ __('become_sponsor') }}
      </a>
    </div>
  </div>
</div>



{{-- ✅ سكربت العد التنازلي --}}
<script>
  const eventDate = new Date("{{ $eventDate }}").getTime();
  const countdownEl = document.getElementById("countdown-timer");

  function updateCountdown() {
    const now = new Date().getTime();
    const distance = eventDate - now;

    if (distance < 0) {
      countdownEl.innerHTML = "{{ __('event_started') }}";
      return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    countdownEl.innerHTML = `
      <span>${days} {{ __('days') }}</span> 
      <span>${hours} {{ __('hours') }}</span> 
      <span>${minutes} {{ __('minutes') }}</span> 
      <span>${seconds} {{ __('seconds') }}</span>
    `;
  }

  updateCountdown();
  setInterval(updateCountdown, 1000);
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    window.addEventListener('scroll', function () {
      const scrollTop = window.scrollY || document.documentElement.scrollTop;
      const windowHeight = window.innerHeight;
      const fullHeight = document.documentElement.scrollHeight;

      // هل المستخدم وصل إلى الأسفل؟
      if (scrollTop + windowHeight >= fullHeight - 10) {
        document.getElementById("countdownSection").style.display = "none";
      } else {
        // يرجعه إذا طلع فوق
        document.getElementById("countdownSection").style.display = "block";
      }
    });
  });
</script>

<!-- LightGallery -->
<link href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.umd.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lightGallery(document.getElementById('gallery-auto-scroll'), {
            selector: 'a[data-lightgallery="item"]',
            plugins: [lgZoom],
            speed: 500,
        });
    });
</script>
<!-- Vendor Scripts -->
<script src="{{ asset('web/assets/vendors/jquery/jquery-3.6.0.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/jarallax/jarallax.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/jquery-appear/jquery.appear.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/jquery-validate/jquery.validate.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/odometer/odometer.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/swiper/swiper.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/wnumb/wNumb.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/wow/wow.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/isotope/isotope.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/owl-carousel/owl.carousel.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/bootstrap-select/js/bootstrap-select.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/jquery-ui/jquery-ui.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/nice-select/jquery.nice-select.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/countdown/countdown.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/marque/marquee.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('web/assets/vendors/sidebar-content/jquery-sidebar-content.js') }}?v={{ time() }}"></script>

<!-- Template Script -->
<script src="{{ asset('web/assets/js/eventflow.js') }}?v={{ time() }}"></script>


</body>
</html>
