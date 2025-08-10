@extends('web.layouts.app')

@section('content')
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
        top: 12px;
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
        height: 80px;
        box-sizing: border-box;
        outline: none;
    }

    .form-input:focus,
    .form-input:not(:placeholder-shown),
    .form-select:focus {
        color: #000;
    }

    .form-wrap.focused .form-label,
    .form-wrap.filled .form-label {
        display: none;
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
        height: 80px;
        border-radius: 50px;
        background-color: #fff;
        color: black;
        border: 1px solid #E73701;
        appearance: none;
    }

    .phone-flex input {
        flex: 1;
        height: 80px;
    }

    @media (max-width: 767px) {
        .phone-flex {
            flex-direction: row;
            gap: 10px;
        }

        .phone-flex select,
        .phone-flex input {
            flex: 1;
            width: auto;
            font-size: 14px;
        }
    }
</style>

<section class="breadcrumbs-custom bg-image context-dark"
         style="background-image: url({{ asset('web/assets/images/bg-breadcrumbs-01-1894x424.jpg') }});">
    <div class="container text-center py-4">
        <h3 class="breadcrumbs-custom-title">Become Sponsor</h3>
    </div>
</section>

<section class="form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-7">
                <h4 class="form-title">Become Sponsor</h4>

                @if ($errors->any())
                    <div class="alert alert-danger text-start">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('web.register.store') }}" method="post">
                    @csrf

                    <div class="form-wrap">
                        <input class="form-input" id="name" type="text" name="name" placeholder="Full Name" required>
                    </div>

                    <div class="form-wrap">
                        <input class="form-input" id="email" type="email" name="email" placeholder="Email" required>
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
                            <input class="form-input" id="phone" type="tel" name="phone" placeholder="Phone" required>
                        </div>
                        <small id="phone-error" class="text-danger d-none">Invalid phone number for selected country.</small>
                    </div>

                    <div class="form-wrap">
                        <input class="form-input" id="job" type="text" name="job" placeholder="Job" required>
                    </div>

                    <div class="form-wrap">
                        <input class="form-input" id="company_name" type="text" name="company_name" placeholder="Company Name" required>
                    </div>

                    <input type="hidden" name="type" value="2">

                    <div class="text-center">
                        <button class="btn-square" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll('.form-input').forEach(input => {
            const wrap = input.closest('.form-wrap');

            const toggleLabel = () => {
                if (input.value.trim() !== '') {
                    wrap.classList.add('filled');
                } else {
                    wrap.classList.remove('filled');
                }
            };

            input.addEventListener('input', toggleLabel);
            input.addEventListener('focus', () => wrap.classList.add('focused'));
            input.addEventListener('blur', () => wrap.classList.remove('focused'));
            toggleLabel();
        });
    });

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
        const phone = document.getElementById("phone").value.trim().replace(/\D/g, '');
        const errorText = document.getElementById("phone-error");
        const phoneInput = document.getElementById("phone");

        const numberWithoutCode = phone.startsWith(code.replace('+', '')) ? 
            phone.slice(code.length - 1) : phone;

        const patterns = phonePatterns[code];
        let isValid = false;

        if (patterns) {
            for (let pattern of patterns) {
                if (pattern.test(numberWithoutCode)) {
                    isValid = true;
                    break;
                }
            }
        }

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
