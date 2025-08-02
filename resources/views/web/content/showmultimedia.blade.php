@extends('web.layouts.app')

@section('content')
@php
    $locale = app()->getLocale();
@endphp

<section class="page-header">
    {{-- الخلفية الديناميكية --}}
    <div class="page-header__bg" style="background-image: url('{{ asset($about_section->media_path) }}');">
    </div>

    {{-- الأشكال --}}
    <div class="page-header__shape-1 float-bob-y">
        <img src="{{ asset('web/assets/images/shapes/page-header-shape-1.png') }}" alt="">
    </div>
    <div class="page-header__shape-2 float-bob-x">
        <img src="{{ asset('web/assets/images/shapes/page-header-shape-2.png') }}" alt="">
    </div>

    <div class="container">
        <div class="page-header__inner">
            <h2>{{ $multi_media_category->name_en }}</h2>
            <div class="thm-breadcrumb__box">
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                    <li><span class="icon-angle-right"></span></li>
                    <li>{{ $multi_media_category->name_en }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>   

<!-- Multimedia Section -->
<section class="section section-lg pt-5">
    <div class="container">

        <!-- Videos -->
        <div class="mb-5">
            <h3 class="text-primary text-center mb-4">{{ __('Videos') }}</h3>
            <div class="row justify-content-center g-4">
                @foreach($multimedias as $media)
                    @php
                        $videos = is_array($media->links) ? $media->links : json_decode($media->links ?? '[]', true);
                    @endphp
                    @foreach($videos as $link)
                        @php
                            preg_match('/v=([^\&]+)/', $link, $matches);
                            $videoId = $matches[1] ?? null;
                            $embedUrl = $videoId ? 'https://www.youtube.com/embed/' . $videoId : null;
                        @endphp
                        @if($embedUrl)
                        <div class="col-md-8 col-lg-6">
                            <iframe src="{{ $embedUrl }}" class="w-100 rounded shadow-sm"
                                    style="aspect-ratio: 16 / 9;" frameborder="0" allowfullscreen></iframe>
                        </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>

        <!-- Images -->
        <div>
            <h3 class="text-primary text-center mb-4">{{ __('Images') }}</h3>
            <div class="row justify-content-center g-4">
                @foreach($multimedias as $media)
                    @php
                        $images = is_array($media->images) ? $media->images : json_decode($media->images ?? '[]', true);
                    @endphp
                    @foreach($images as $image)
                        <div class="col-md-4 col-lg-3">
                            <a href="#" class="popup-trigger d-block" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ asset($image) }}">
                                <div class="image-wrapper rounded overflow-hidden">
                                    <img src="{{ asset($image) }}" class="img-fluid gallery-thumb" alt="image">
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

    </div>
</section>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-white border-0">
            <div class="modal-body text-center p-0">
                <img src="" class="img-fluid rounded w-100" id="popupImage" alt="popup image">
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .gallery-thumb {
        height: 250px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.3s ease;
    }

    .gallery-thumb:hover {
        transform: scale(1.03);
    }

    .image-wrapper {
        height: 250px;
        background: #f9f9f9;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .gallery-thumb,
        .image-wrapper {
            height: 180px;
        }
    }
</style>

<!-- Script -->
<script>
    const imageModal = document.getElementById('imageModal');
    imageModal.addEventListener('show.bs.modal', function (event) {
        const trigger = event.relatedTarget;
        const imageUrl = trigger.getAttribute('data-image');
        const modalImage = imageModal.querySelector('#popupImage');
        modalImage.src = imageUrl;
    });
</script>
@endsection
