<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap');

    .mobile-only-page {
        display: none;
    }

    @media (max-width: 767.98px) {
        .mobile-only-page {
            display: block;
        }

        #typed-title { font-size: 32px; }

        .company-row {
            flex-direction: row !important;
            align-items: center !important;
            gap: 10px;
        }

        .company-card-wrapper {
            padding: 10px 12px !important;
        }

        .company-image-desktop {
            display: none !important;
        }

        .company-image-mobile {
            display: block !important;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FFE986, #C48127);
            padding: 3px;
            flex-shrink: 0;
        }

        .company-image-mobile-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            background: white;
        }

        .company-image-mobile-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .company-content h4 {
            font-size: 16px !important;
            margin-bottom: 4px;
        }

        .company-content p,
        .company-content a {
            font-size: 13px;
            margin-bottom: 2px;
        }

        .vote-btn {
            font-size: 13px !important;
            padding: 6px 18px !important;
            white-space: nowrap;
        }
    }

    @media (min-width: 768px) {
        .company-image-mobile {
            display: none !important;
        }
    }

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

  
    @keyframes blink-caret {
        0%, 100% { border-color: transparent; }
        50% { border-color: #FFE986; }
    }
    .typing-effect-container {
    font-size: 36px;
    font-weight: bold;
    background: linear-gradient(90deg, #FFE986 0%, #C48127 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    border-right: 3px solid #FFE986;
    padding-right: 5px;
    width: fit-content;
    margin: 0 auto;
    animation: blink-caret 0.8s step-end infinite;
}

.typing-effect-container.done {
    animation: none;
    border-right: none;
}

@keyframes blink-caret {
    from, to { border-color: transparent; }
    50% { border-color: #FFE986; }
}
</style>

    @php $locale = app()->getLocale(); @endphp
<div class="mobile-only-page">

    <section class="section bg-default arallax-container mb-5">
        <div class="parallax-content section-lg context-dark text-center" style="background-color: #000;">
              <div class="section-title text-center mb-5 mt-5">
 
 <h2 class="section-title__title">
                <span id="typingTextw" class="typing-effect-container"></span>
            </h2>
</div>
            <div class="row justify-content-end mt-3 mb-4 px-4">
                <div class="col-md-4 search-container">
                    <input type="text" id="searchInput" class="form-control" placeholder="{{ __('Search by name, description...') }}">
                </div>
            </div>

            <div id="companiesWrapper">
                @foreach ($companies as $company)
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card mb-3 p-3 shadow wow fadeInUp company-card-wrapper"
                             style="border: 2px solid #3c2a1e; background: linear-gradient(90deg, #3c2a1e 0%, #1a120b 70%); color: white; border-radius: 10px;">
                            <div class="d-flex flex-md-row flex-column company-row">
                                {{-- صورة Desktop --}}
                                <div class="company-image-desktop me-3 d-none d-md-block">
                                    <div style="width: 160px; height: 160px; border-radius: 50%; overflow: hidden;">
                                        <img src="{{ asset($company->image) }}" alt="{{ $company->name_en }}"
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </div>

                                {{-- صورة Mobile --}}
                                <div class="company-image-mobile me-2">
                                    <div class="company-image-mobile-inner">
                                        <img src="{{ asset($company->image) }}" alt="{{ $company->name_en }}">
                                    </div>
                                </div>

                                {{-- المحتوى --}}
                                <div class="company-content text-start flex-grow-1">
                                    <h4 class="text-white">{{ $company->name_en }}</h4>
                                    <div class="mb-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @php
                                                $class = $company->stars >= $i ? 'fas fa-star' : ($company->stars >= ($i - 0.5) ? 'fas fa-star-half-alt' : 'far fa-star');
                                            @endphp
                                            <i class="{{ $class }} text-warning"></i>
                                        @endfor
                                    </div>
                                    @if($company->category)
                                        <p class="fw-bold text-white">{{ $company->category }}</p>
                                    @endif
                                    @if($company->regulation)
                                        <p style="color:white;">Regulation: {{ $company->regulation }}</p>
                                    @endif
                                    @if ($company->link)
                                        <a href="{{ $company->link }}" target="_blank" style="color: white;">
                                            Visit Website
                                        </a>
                                    @endif
                                </div>

                                {{-- زر التصويت --}}
                                <div class="ms-auto mt-2 mt-md-0">
                                    <a href="{{ route('web.company_details', $company->id) }}" class="btn vote-btn"
                                       style="background: linear-gradient(90deg, #FFE986 0%, #C48127 100%);
                                              color: white;
                                              font-size: 18px;
                                              padding: 8px 25px;
                                              border: none;">
                                        {{ __('Vote') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    
</div>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const target = document.getElementById("typingTextw");
    const text = "Voting";
    let index = 0;
    let isAnimated = false;

    function typeChar() {
        if (index < text.length) {
            target.textContent += text.charAt(index);
            index++;
            setTimeout(typeChar, 150);
        } else {
            // ✅ بعد الانتهاء: إزالة المؤشر
            target.classList.add("done");
        }
    }

    function isInViewport(el) {
        const rect = el.getBoundingClientRect();
        return rect.top < window.innerHeight && rect.bottom >= 0;
    }

    function handleScroll() {
        if (!isAnimated && isInViewport(target)) {
            isAnimated = true;
            typeChar();
        }
    }

    window.addEventListener("scroll", handleScroll);
});
</script>