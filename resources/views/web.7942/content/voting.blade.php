@extends('web.layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap');

    .search-container .form-control {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .search-container .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .search-container .btn {
        background-color: #E73780;
        border: none;
    }

    .page-header__inner {
        text-align: center;
        padding: 60px 0;
    }

    #typed-title {
        display: inline-block;
        overflow: hidden;
        white-space: nowrap;
        border-right: 3px solid #FFE986;
        font-family: 'Montserrat', sans-serif;
        font-size: 60px;
        background: linear-gradient(90deg, #FFE986 0%, #C48127 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: blink-caret 0.75s step-end infinite;
    }

    #typed-title.finished {
        border-right: none;
        animation: none;
    }

    @keyframes blink-caret {
        0%, 100% { border-color: transparent; }
        50% { border-color: #FFE986; }
    }

    .section-title-responsive {
        font-size: 60px;
        width: 80%;
        max-width: 800px;
        font-weight: 800;
        background: linear-gradient(90deg, #fff, #fff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 0 auto 40px auto;
        line-height: 1.3;
    }

    @media (max-width: 1365px) {
        #typed-title { font-size: 60px; }
    }

    @media (max-width: 1023px) {
        #typed-title { font-size: 42px; }
    }

    @media (max-width: 767.98px) {
        #typed-title { font-size: 32px; }
        .section-title-responsive { font-size: 40px !important; }
    }

    .desktop-only { display: none; }
    .mobile-only-page { display: none; }

    @media (min-width: 768px) {
        .desktop-only { display: block; }
    }

    @media (max-width: 767.98px) {
        .mobile-only-page { display: block; }
    }
    .section-title{
        display: none !important;
    }
</style>

<section class="page-header">
    <div class="container">
        <div class="page-header__inner">
            <h2 id="typed-title"></h2>
        </div>
    </div>
</section>

@php $locale = app()->getLocale(); @endphp

<!-- Desktop Section -->
<div class="desktop-only">
    @include('web.content.partials.voting-desktop', ['companies' => $companies])
</div>

<!-- Mobile Section -->
<div class="mobile-only-page">
    @include('web.content.partials.voting-mobile', ['companies' => $companies])
</div>
<section class="section section-lg text-center" style="color: #fff; padding: 80px 0;">
    <div class="container">
        <div class="block-lg block-center">
            <h6 style="font-size: 20px; font-weight: 600; color: #FFE986; margin-bottom: 10px; letter-spacing: 1px;">
                Become a sponsor.
            </h6>
            <h2 class="section-title-responsive">
                Let’s become a part of our conference
            </h2>
            <a href="{{ route('web.becomesponsor') }}" class="btn btn-lg" style="
                padding: 14px 32px;
                font-size: 18px;
                font-weight: bold;
                color: #1a120b;
                background: linear-gradient(90deg, #FFE986, #C48127);
                border-radius: 50px;
                text-decoration: none;
                transition: all 0.3s ease-in-out;"
                onmouseover="this.style.background='white'; this.style.color='#1a120b'"
                onmouseout="this.style.background='linear-gradient(90deg, #FFE986, #C48127)'; this.style.color='#1a120b'">
                Become a Sponsor
            </a>
        </div>
    </div>
</section>
<script>
    document.getElementById('searchInput')?.addEventListener('input', function () {
        const search = this.value.toLowerCase();
        const items = document.querySelectorAll('.company-item');

        items.forEach(item => {
            const name = item.dataset.name || '';
            const desc = item.dataset.description || '';
            const cat = item.dataset.category || '';
            const reg = item.dataset.regulation || '';
            const match = [name, desc, cat, reg].some(field => field.includes(search));
            item.style.display = match ? 'flex' : 'none';
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const text = @json(__('Voting'));
        const target = document.getElementById("typed-title");
        let index = 0;

        function typeWriter() {
            if (index < text.length) {
                target.innerHTML += text.charAt(index);
                index++;
                setTimeout(typeWriter, 100);
            } else {
                target.classList.add('finished');
            }
        }

        typeWriter();
    });
</script>

@endsection
