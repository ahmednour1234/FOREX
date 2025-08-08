@extends('web.layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp

<style>
    .form-section {
        padding: 60px 0;
        background: white;
    }

    .form-title {
        font-weight: bold;
        margin-bottom: 30px;
        font-size: 26px;
        text-align: center;
        background: linear-gradient(to right, #E73701, #000000);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .form-wrap {
        position: relative;
        margin-bottom: 20px;
    }

    .form-label {
        position: absolute;
        top: 10px;
        left: 20px;
        font-size: 13px;
        font-weight: bold;
        color: #888;
        pointer-events: none;
        transition: all 0.2s ease-in-out;
    }

    .form-input,
    .form-select {
        padding: 22px 20px 10px;
        border: 1px solid #E73701;
        border-radius: 50px;
        font-size: 14px;
        font-weight: bold;
        background-color: white;
        color: black;
        width: 100%;
        height: 70px;
        box-sizing: border-box;
        outline: none;
    }

    .btn-square {
        padding: 14px 60px;
        background: #E73701;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-square:hover {
        opacity: 0.9;
    }

    .alert-danger {
        font-size: 13px;
        border-radius: 6px;
        padding: 10px;
        background-color: #ff4444;
        color: #fff;
    }

    .phone-flex {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: nowrap;
    }

    .phone-flex select {
        flex: 0 0 30%;
        text-align: center;
        height: 70px;
        border-radius: 50px;
        background-color: #fff;
        color: black;
        border: 1px solid #E73701;
        appearance: none;
    }

    .phone-flex input {
        flex: 1;
        height: 70px;
    }

    @media (max-width: 767px) {
        .phone-flex {
            flex-direction: row; /* يُبقي الكود بجانب الرقم في الموبايل */
        }

        .phone-flex select,
        .phone-flex input {
            flex: 1;
            width: auto;
        }
    }
</style>

<section class="breadcrumbs-custom bg-image context-dark"
         style="background-image: url({{ asset('web/assets/images/bg-breadcrumbs-01-1894x424.jpg') }});">
    <div class="container text-center py-4">
        <h3 class="breadcrumbs-custom-title">Register Now</h3>
    </div>
</section>

<section class="form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-6">
                <h4 class="form-title">Register Now</h4>

                @if ($errors->any())
                    <div class="alert alert-danger text-start">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('web.register.store') }}" method="post" class="rd-form rd-form-centered">
                    @csrf

                    <div class="form-wrap">
                        <input class="form-input" id="full_name_en" type="text" name="name" placeholder="Full Name" required>
                    </div>

                    <div class="form-wrap">
                        <input class="form-input" id="email" type="email" placeholder="Email" name="email" required>
                    </div>

                    <div class="form-wrap">
                        <label class="form-label"></label>
                        <div class="phone-flex">
                            <select class="form-select" name="country_code" id="country_code" required>
                                <option value="+971">UAE (+971)</option>
                                <option value="+20">Egypt (+20)</option>
                                <option value="+966">Saudi Arabia (+966)</option>
                                <option value="+965">Kuwait (+965)</option>
                                <option value="+964">Iraq (+964)</option>
                                <option value="+963">Syria (+963)</option>
                                <option value="+962">Jordan (+962)</option>
                                <option value="+968">Oman (+968)</option>
                                <option value="+973">Bahrain (+973)</option>
                                <option value="+974">Qatar (+974)</option>
                                <option value="+212">Morocco (+212)</option>
                                <option value="+1">USA (+1)</option>
                                <option value="+44">UK (+44)</option>
                            </select>
                            <input class="form-input" id="phone" type="tel" name="phone" placeholder="Phone Number" required>
                        </div>
                        <small id="phone-error" class="text-danger d-none">Invalid phone number for selected country.</small>
                    </div>

                    <div class="form-wrap">
                        <input class="form-input" id="job_title" type="text" name="job" placeholder="Job Title" required>
                    </div>

                    <input type="hidden" name="type" value="1">

                    <div class="text-center">
                        <button class="btn-square" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<script>
    const phonePatterns = {
        '+20': [/^10/, /^11/, /^12/, /^15/],
        '+966': [/^5/],
        '+971': [/^50/, /^52/, /^54/, /^55/, /^56/],
        '+965': [/^5/, /^6/, /^9/],
        '+964': [/^7/],
        '+963': [/^9/],
        '+962': [/^7/],
        '+968': [/^9/],
        '+973': [/^3/],
        '+974': [/^3/],
        '+212': [/^6/, /^7/],
        '+1': [/^\d{10}$/],
        '+44': [/^7/],
    };

    document.querySelector('form').addEventListener('submit', function (e) {
        const code = document.getElementById("country_code").value;
        const phoneInput = document.getElementById("phone");
        const errorText = document.getElementById("phone-error");

        const rawPhone = phoneInput.value.trim().replace(/\D/g, '');
        const numberWithoutCode = rawPhone.startsWith(code.replace('+', '')) ?
            rawPhone.slice(code.length - 1) : rawPhone;

        const patterns = phonePatterns[code] || [];
        const isValid = patterns.some(p => p.test(numberWithoutCode));

        if (!isValid) {
            e.preventDefault();
            errorText.classList.remove('d-none');
            phoneInput.classList.add('is-invalid');
        } else {
            errorText.classList.add('d-none');
            phoneInput.classList.remove('is-invalid');
        }
    });
</script>
@endsection
