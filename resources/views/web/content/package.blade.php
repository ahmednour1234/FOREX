@extends('web.layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp
<style>
    .package-item {
    box-shadow: 0 5px 15px rgba(128, 128, 128, 0.2); /* ظل رمادي */
    border-radius: 10px;
}
.pricing-modern-primary .pricing-modern-body {
    border-color: #f3f3f3;
}
  @media (max-width: 991.98px) {
        .breadcrumbs-custom {
            height: 350px !important; /* صورة أطول في الأجهزة الصغيرة */
            background-size: cover;
            background-position: center;
        }

        .breadcrumbs-custom-title {
            font-size: 28px;
            padding-top:150px;
        }
    }

    .breadcrumbs-custom {
        background-size: cover;
        background-position: center;
    }
</style>
<section class="breadcrumbs-custom bg-image context-dark"
         style="background-image: url({{ asset('web/assets/images/bg-breadcrumbs-01-1894x424.jpg') }});">
    <div class="container">
     
        <h3 class="breadcrumbs-custom-title">Pricing Table</h3>
    </div>
</section>

<section class="section section-lg bg-default text-center">
    <div class="container">
        <h4 class="font-weight-bold mb-5">{{ __('Packages') }}</h4>
        <div class="row row-30" id="package-container">
            @foreach ($packages as $key => $package)
                @php
                    $desc = $locale === 'ar' ? $package->description_ar : $package->description_en;
                    $listItems = array_filter(preg_split("/\r\n|\n|\r/", $desc));
                @endphp
<div class="col-sm-6 col-md-4 mb-4" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                    <div class="pricing-modern {{ $key == 1 ? 'pricing-modern-primary' : '' }}">
                        <div class="pricing-modern-header">
                            <p class="pricing-modern-price heading-3">
                                {{ $locale === 'ar' ? $package->name_ar : $package->name_en }}
                            </p>
                        </div>
                        <div class="pricing-modern-body">
                            <ul class="pricing-modern-list">
                                @foreach($listItems as $item)
                                    <li class="package-description">{{ $item }}</li>
                                @endforeach
                            </ul>
                            <a class="button button-primary" href="{{route('web.becomesponsor')}}" type="button" data-triangle=".button-overlay">
                                <span style="color:white;">{{ __('Become Sponsor') }}</span>
                                <span class="button-overlay"></span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .package-description {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        min-height: 40px;
    }
</style>

<script>
    let page = 2;
    let loading = false;

    window.addEventListener('scroll', function () {
        if (loading) return;

        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 300) {
            loading = true;

            fetch(`?page=${page}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    if (!response.ok) throw new Error('Network error');
                    return response.json();
                })
                .then(data => {
                    if (data.html.trim() !== '') {
                        document.getElementById('package-container')
                            .insertAdjacentHTML('beforeend', data.html);
                        page++;
                        loading = false;
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    loading = false;
                });
        }
    });
</script>
@endsection
