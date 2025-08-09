@extends('web.layouts.app')

@section('content')
@php
    $locale = app()->getLocale();
@endphp

<!-- Modern Multimedia Section with Elegant Design -->
<style>
    /* ====== Global Variables ====== */
    :root {
        --primary-gradient: linear-gradient(135deg, #FFE986 0%, #C48127 100%);
        --text-dark: #2D3748;
        --text-light: #EDF2F7;
        --card-bg: #FFFFFF;
        --section-spacing: 140px 0 80px;
        --transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    /* ====== Section Container ====== */
    .multimedia-section {
        padding: var(--section-spacing);
        background-color: transparent;
        position: relative;
        min-height: calc(100vh - 110px);
    }

    /* ====== Animated Header ====== */
    .section-header {
        text-align: center;
        margin-bottom: 80px;
        position: relative;
        padding: 70px 0 0;
    }

    .section-header::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    .typewriter-title {
        font-size: clamp(2.5rem, 5vw, 3.5rem);
        font-weight: 700;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
        position: relative;
        letter-spacing: 1px;
    }

    /* ====== Card Grid Layout ====== */
    .card-grid {
      display: flex;
      justify-content: center;
      align-items: center;
        padding: 0 20px;
    }

    /* ====== Individual Media Card ====== */
    .media-card {
        background: var(--card-bg);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: var(--transition);
        position: relative;
        z-index: 1;
    }

    .media-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--primary-gradient);
        opacity: 0;
        transition: var(--transition);
        z-index: -1;
    }

    .media-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .media-card:hover::before {
        opacity: 0.1;
    }

    /* ====== Card Image ====== */
    .card-media {
        height: 220px;
        overflow: hidden;
        position: relative;
    }

    .card-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .media-card:hover .card-media img {
        transform: scale(1.08);
    }

    /* ====== Card Content ====== */
    .card-body {
        padding: 25px;
        position: relative;
        text-align: center;
    }

    .card-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 12px;
        color: var(--text-dark);
        text-align: center;
        transition: var(--transition);
    }

    .media-card:hover .card-title {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .card-description {
        color: #718096;
        font-size: 0.95rem;
        line-height: 1.7;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* ====== Empty State ====== */
    .empty-state {
        grid-column: 1/-1;
        text-align: center;
        padding: 60px 20px;
    }

    .empty-icon {
        font-size: 3.5rem;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
    }

    /* ====== Responsive Adjustments ====== */
    @media (max-width: 992px) {
        .card-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .multimedia-section {
            padding: 100px 0 60px;
        }

        .card-media {
            height: 200px;
        }
    }

    @media (max-width: 576px) {
        .card-grid {
            grid-template-columns: 1fr;
        }

        .typewriter-title {
            font-size: 2.2rem;
        }
    }
</style>

<!-- Main Section Start -->
<section class="multimedia-section">
    <div class="container">
        <!-- Section Header with Typewriter Effect -->
        <div class="section-header">
            <h2 class="typewriter-title" id="typed-title"></h2>
        </div>

        <!-- Media Cards Grid -->
        <div class="card-grid">
            @foreach($multi_media_categories as $category)
            <div class="media-card">
                <!-- Card Media -->
                <div class="card-media">
                    <img src="{{ asset($category->logo) }}"
                         alt="{{ $category->{'name_' . $locale} }}"
                         loading="lazy">
                </div>

                <!-- Card Content -->
                <div class="card-body">
                    <a href="{{ route('web.multi_media.show',[$category->id]) }}" class="card-title">
                        {{ $category->{'name_' . $locale} ?? '' }}
                    </a>

                    <a href="{{ route('web.multi_media.show',[$category->id]) }}" class="card-description">
                        {{ $category->{'description_' . $locale} ?? '' }}
                    </a>
                </div>
            </div>
            @endforeach

            <!-- Empty State -->
            @if($multi_media_categories->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-film"></i>
                </div>
                <h3>{{ __('No multimedia categories available') }}</h3>
                <p>{{ __('Check back later for new content') }}</p>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- Main Section End -->

<!-- Typewriter Animation Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Configuration
        const typingSpeed = 120; // milliseconds per character
        const targetElement = document.getElementById("typed-title");
        const titleText = @json(__('Multi Media'));

        // Typewriter Effect Implementation
        let charIndex = 0;

        function typeCharacter() {
            if (charIndex < titleText.length) {
                targetElement.textContent += titleText.charAt(charIndex);
                charIndex++;
                setTimeout(typeCharacter, typingSpeed);
            }
        }

        // Initialize the effect
        typeCharacter();
    });
</script>
@endsection
