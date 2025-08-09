@extends('web.layouts.app')

@section('content')
@php
    $locale = app()->getLocale(); // "en" أو "ar"
@endphp
    @foreach($home_sections as $section)
    @php
        $type = $section->id;
    @endphp

    @if ($type == 1) {{-- Home Slider --}}
        @include('web.content.sections.slider', ['section' => $section, 'event' => $event])
    @elseif ($type == 2) {{-- Promo Section --}}
        @include('web.content.sections.promo', ['section' => $section])
    @elseif ($type == 3) {{-- About --}}
        @include('web.content.sections.about', ['section' => $section, 'event' => $event])
    @elseif ($type == 9) {{-- Speakers --}}
        @include('web.content.sections.voting', ['section' => $section])
@elseif ($type == 6) {{-- Gallery --}}
        @include('web.content.sections.gallery', ['section' => $section, 'gallieries' => $gallieries])

    @endif
@endforeach
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const swiper = new Swiper(".gallerySwiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            navigation: {
                nextEl: ".button-next",
                prevEl: ".button-prev",
            },
            breakpoints: {
                320: { slidesPerView: 1 },
                576: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                992: { slidesPerView: 4 }
            }
        });

        // تفعيل lightgallery على الصور
        lightGallery(document.querySelector('.gallerySwiper .swiper-wrapper'), {
            selector: 'a[data-lightgallery="item"]',
            plugins: [lgZoom],
            speed: 500,
        });
    });
</script>
    <!-- Section Newsletter Sign Up-->
@endsection
