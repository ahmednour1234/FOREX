@if ($section && $section->media_type === 'image')

<section class="section bg-default mt-5 pt-5 parallax-container section">
<div class="parallax-content section-lg context-dark text-center" style="background-color: #F4F3F2;">

    <div class="container">
        <h6 class="text-center" style="color:#E73701;">{{ $section->title[$locale] ?? '' }}</h6>
        <h3 class="text-center " style="color:black;">{{ $section->description[$locale] ?? '' }}</h3>

        {{-- نسخة الديسكتوب: Slider --}}
<div class="position-relative d-none d-md-block">
            <div class="swiper gallerySwiper mb-5 mt-5 pb-5 pt-5">
                <div class="swiper-wrapper">
                    @foreach ($gallieries as $gallery)
                        <div class="swiper-slide">
                            <a href="{{ asset($gallery->image) }}" data-lightgallery="item">
                                <img src="{{ asset($gallery->image) }}" class="img-fluid rounded shadow" alt="gallery">
                            </a>
                        </div>
                    @endforeach
                </div>
<!--{{-- زر السابق --}}-->
<!--<div class="swiper-button-prev">-->
<!--</div>-->

<!--{{-- زر التالي --}}-->
<!--<div class="swiper-button-next">-->
<!--</div>-->

            </div>
        </div>

        {{-- نسخة الموبايل: Grid --}}
        <div class="gallery-grid-mobile d-md-none">
            @foreach ($gallieries as $gallery)
                <a href="{{ asset($gallery->image) }}" data-lightgallery="item" class="gallery-item">
                    <img src="{{ asset($gallery->image) }}" alt="gallery">
                </a>
            @endforeach
        </div>

        {{-- زر عرض الكل --}}
        <div class="text-center">
            <a class="button button-secondary box-with-triangle-right wow fadeScale mt-2"
               href="{{ route('web.gallery') }}" data-triangle=".button-overlay">
                <span>More Gallery</span>
                <span class="button-overlay"></span>
            </a>
        </div>
    </div>
        </div>

</section>
@endif