  @if ($gallery_section && $gallery_section->media_type === 'image')
    <section class="section bg-default mt-5 parallax-container mb-5">
        <div class="parallax-content section-lg context-dark text-center" style="background-color: #000;">
            <!-- العنوان -->
            <div class="section-title text-center mb-5">
                <div class="section-title__tagline-box mb-2">
                    <span class="section-title__tagline" style="color: #E73701; font-weight: bold;">
                        {{ $gallery_section->title[$locale] ?? '' }}
                    </span>
                </div>
                <h2 class="section-title__title" style="font-size: 36px; color: white;">
                    {{ $gallery_section->description[$locale] ?? '' }}
                </h2>
            </div>

            <!-- نسخة الديسكتوب: سلايدر -->
            <div class="position-relative d-none d-md-block">
                <div class="swiper gallerySwiper pt-4 pb-2">
                    <div class="swiper-wrapper">
                        @foreach ($gallieries as $gallery)
                            <div class="swiper-slide">
                                <a href="{{ asset($gallery->image) }}" data-lightgallery="item">
                                    <img src="{{ asset($gallery->image) }}"
                                         class="img-fluid rounded shadow-lg"
                                         alt="gallery"
                                         style="max-height: 400px; object-fit: cover;">
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>

                <!-- زر تحت السلايدر -->
                <div class="text-center pt-5 mt-3">
                    <a href="{{ route('web.gallery') }}"
                       class="thm-btn" style="text-decoration:none;"
                        <i class="fas fa-image me-2"></i> {{ __('More Gallery') }}
                    </a>
                </div>
            </div>

            <!-- نسخة الموبايل: Grid -->
            <div class="gallery-grid-mobile d-md-none row g-3 justify-content-center">
                @foreach ($gallieries as $gallery)
                    <div class="col-6">
                        <a href="{{ asset($gallery->image) }}" data-lightgallery="item" class="d-block">
                            <img src="{{ asset($gallery->image) }}" class="img-fluid rounded shadow" alt="gallery">
                        </a>
                    </div>
                @endforeach

                <div class="col-12 text-center pt-5 mt-4">
                    <a href="{{ route('web.gallery') }}"
                       class="thm-btn" style="text-decoration:none;"> 
                        <i class="fas fa-image me-2"></i> {{ __('More Gallery') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif
