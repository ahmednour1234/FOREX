@extends('web.layouts.app')

@section('content')
@php
    $locale = app()->getLocale();
@endphp

<style>
    /* ====== Modern Gallery Styles ====== */
    :root {
        --secondary-color: #FFE986;
        --dark-bg: #121212;
        --light-bg: #121212;
        --text-dark: #333;
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    /* ====== Hero Section ====== */
    .gallery-hero {
        position: relative;
        padding: 120px 0 80px;
        background-size: cover;
        background-position: center;
        color: white;
        overflow: hidden;
    }

    .gallery-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.7), rgba(0,0,0,0.3));
        z-index: 1;
    }

    .gallery-hero__content {
        position: relative;
        z-index: 2;
    }

    .gallery-hero h2 {
        background: -webkit-linear-gradient(#FFE986 , #C48127);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-top: 70px;
        color: #FFE986;
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .breadcrumb {
        display: flex;
        flex-wrap: wrap;
        padding: 0;
        margin-bottom: 0;
        list-style: none;
        background: transparent;
    }

    .breadcrumb-item a {
        color: var(--secondary-color);
        text-decoration: none;
        transition: var(--transition);
    }

    .breadcrumb-item a:hover {
        color: white;
    }

    .breadcrumb-item.active {
        color: rgba(255,255,255,0.8);
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.6);
        content: ">";
        padding: 0 10px;
    }

    /* ====== Gallery Sections ====== */
    .gallery-section {
        padding: 80px 0;
        background-color: var(--light-bg);
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 50px;
        text-align: center;
        position: relative;
        background: -webkit-linear-gradient(#FFE986 , #C48127);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--secondary-color);
        border-radius: 2px;
    }

    /* ====== Video Gallery ====== */
    .video-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 30px;
        margin-bottom: 80px;
    }

    .video-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: var(--transition);
    }

    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }

    .video-iframe {
        width: 100%;
        height: 250px;
        border: none;
        border-radius: 12px 12px 0 0;
    }

    .video-caption {
        padding: 20px;
        background: white;
        border-radius: 0 0 12px 12px;
    }

    /* ====== Image Gallery ====== */
    .image-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
    }

    .gallery-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: var(--transition);
        height: 250px;
    }

    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .gallery-item:hover .gallery-image {
        transform: scale(1.05);
    }

    /* ====== Modal ====== */
    .gallery-modal .modal-dialog {
        max-width: 90%;
        max-height: 90vh;
    }

    .gallery-modal .modal-content {
        background: transparent;
        border: none;
    }

    .gallery-modal .modal-body {
        padding: 0;
        text-align: center;
    }

    .gallery-modal img {
        max-height: 80vh;
        width: auto;
        max-width: 100%;
        border-radius: 8px;
    }

    /* ====== Responsive Adjustments ====== */
    @media (max-width: 992px) {
        .video-gallery {
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        }

        .image-gallery {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .gallery-hero {
            padding: 100px 0 60px;
        }

        .section-title {
            font-size: 2rem;
        }

        .video-gallery {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .video-iframe {
            height: 200px;
        }
    }

    @media (max-width: 576px) {
        .gallery-hero h2 {
            font-size: 2.2rem;
        }

        .image-gallery {
            grid-template-columns: 1fr;
        }

        .gallery-item {
            height: 200px;
        }
    }
</style>

<!-- Hero Section -->
<section class="gallery-hero">
    <div class="container">
        <div class="gallery-hero__content text-center">
            <h2>{{ $multi_media_category->name_en }}</h2>
        </div>
    </div>
</section>

<!-- Multimedia Gallery Section -->
<section class="gallery-section">
    <div class="container">
        <!-- Videos Section -->
        <h3 class="section-title">{{ __('Videos') }}</h3>
<div class="mb-5">
    <div class="row justify-content-center g-4">
        @foreach($multimedias as $media)
            @php
                $videos = is_array($media->links) ? $media->links : json_decode($media->links ?? '[]', true);
            @endphp

            @foreach($videos as $key => $link)
                @php
                    // استخراج ID من رابط YouTube سواء كان youtu.be أو youtube.com
                    if (str_contains($link, 'youtu.be')) {
                        preg_match('/youtu\.be\/([^?]+)/', $link, $matches);
                    } else {
                        preg_match('/v=([^&]+)/', $link, $matches);
                    }

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

        <!-- Images Section -->
        <h3 class="section-title">{{ __('Images') }}</h3>
        <div class="image-gallery">
            @foreach($multimedias as $media)
                @php
                    $images = is_array($media->images) ? $media->images : json_decode($media->images ?? '[]', true);
                @endphp
                @foreach($images as $image)
                <a href="#" class="gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal" data-image="{{ asset($image) }}">
                    <img src="{{ asset($image) }}" class="gallery-image" alt="Gallery Image">
                </a>
                @endforeach
            @endforeach
        </div>
    </div>
</section>

<!-- Image Modal -->
<div class="modal fade gallery-modal" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" id="modalImage" class="img-fluid" alt="Modal Image">
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize modal with clicked image
    document.addEventListener('DOMContentLoaded', function() {
        const galleryModal = document.getElementById('galleryModal');

        galleryModal.addEventListener('show.bs.modal', function(event) {
            const trigger = event.relatedTarget;
            const imageUrl = trigger.getAttribute('data-image');
            const modalImage = galleryModal.querySelector('#modalImage');
            modalImage.src = imageUrl;
        });

        // Close modal when clicking outside image
        galleryModal.addEventListener('click', function(e) {
            if (e.target === this) {
                bootstrap.Modal.getInstance(galleryModal).hide();
            }
        });
    });
</script>
@endsection
