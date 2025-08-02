<style>
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
<section class="section bg-default arallax-container mb-5">
    <div class="parallax-content section-lg context-dark text-center" style="background-color: #000;">
         <div class="section-title text-center mb-5 mt-5">
   <h2 class="section-title__title">
                <span id="typingText" class="typing-effect-container"></span>
            </h2>
</div>

        <!-- Search Box -->
        <div class="row justify-content-end mt-3 mb-4 px-4">
            <div class="col-md-4 search-container">
                <input type="text" id="searchInput" class="form-control" placeholder="{{ __('Search by name, description...') }}">
            </div>
        </div>

        <!-- Companies -->
        <div id="companiesWrapper">
            @foreach ($companies as $company)
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card mb-4 p-3 shadow wow fadeInUp" data-wow-delay="100ms"
                             style="border: 3px solid #3c2a1e; background: linear-gradient(90deg, #3c2a1e 0%, #1a120b 70%); color: white; padding: 10px 20px; border-radius: 8px; cursor: pointer;">

                            <div class="row g-3 align-items-center"
                                 style="background: linear-gradient(90deg, #3c2a1e 0%, #1a120b 70%); border: none; padding: 0px; border-radius: 12px;">

                                <!-- Image -->
                                <div class="col-md-3 text-center">
                                    <div style="
                                        width: 160px;
                                        height: 160px;
                                        border-radius: 50%;
                                        background: linear-gradient(135deg, #FFE986, #C48127);
                                        padding: 5px;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        margin: auto;
                                    ">
                                        <div style="
                                            width: 100%;
                                            height: 100%;
                                            border-radius: 50%;
                                            overflow: hidden;
                                            background: #fff;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                        ">
                                            <img src="{{ asset($company->image) }}" alt="{{ $company->name_en }}"
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>

                                <!-- Details -->
                                <div class="col-md-7 text-start">
                                    <h4 class="mb-2 text-white" style="font-size: 38px;">
                                        {{ $company->name_en }}
                                    </h4>

                                    <!-- Stars -->
                                    <div class="mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @php
                                                if ($company->stars >= $i) {
                                                    $class = 'fas fa-star';
                                                } elseif ($company->stars >= ($i - 0.5)) {
                                                    $class = 'fas fa-star-half-alt';
                                                } else {
                                                    $class = 'far fa-star';
                                                }
                                            @endphp
                                            <i class="{{ $class }} text-warning"></i>
                                        @endfor
                                    </div>

                                    @if($company->category)
                                        <p class="mb-1 fw-bold text-white">{{ $company->category }}</p>
                                    @endif

                                    @if($company->regulation)
                                        <p style="color:white;">Regulation: {{ $company->regulation }}</p>
                                    @endif

                                    @if ($company->link)
                                        <a href="{{ $company->link }}" target="_blank" class="d-inline-block mt-1" style="color: white;">
                                            Visit Website
                                        </a>
                                    @endif
                                </div>

                                <!-- Vote Button -->
                                <div class="col-md-2 d-flex align-items-start justify-content-end mt-3 mt-md-0 pe-4">
                                    <a href="{{ route('web.company_details', $company->id) }}" class="btn"
                                       style="background: linear-gradient(90deg, #FFE986 0%, #C48127 100%); color: white; font-size: 22px; padding: 10px 45px; border: none;">
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

<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const target = document.getElementById("typingText");
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