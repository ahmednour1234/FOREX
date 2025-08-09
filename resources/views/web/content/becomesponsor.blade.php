@extends('web.layouts.app')

@section('content')
<style>
    /* ====== Color Variables ====== */
    :root {
        --primary-gradient: linear-gradient(135deg, #E73701 0%, #000000 100%);
        --gold-gradient: linear-gradient(90deg, #FFE986 0%, #C48127 100%);
        --dark-bg: #0A0A0A;
        --input-bg: #1A1A1A;
        --text-light: #F5F5F5;
        --accent-color: #FFE986;
    }

    body {
        background: radial-gradient(circle at 70% 30%, #e798011a 0%, transparent 50%);
    }

    /* ====== Section Styling ====== */
    .sponsor-section {
        position: relative;
        min-height: calc(100vh - 110px);
    }

    /* ====== Header ====== */
    .page-header {
        background: transparent;
    }

    .section-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        background: var(--gold-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-align: center;
        font-family: 'Montserrat', sans-serif;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    /* ====== Form Container ====== */
    .form-container {
        background: rgba(26, 26, 26, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 233, 134, 0.1);
    }

    /* ====== Form Elements ====== */
    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        position: absolute;
        top: 12px;
        left: 24px;
        font-size: 14px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.6);
        pointer-events: none;
        transition: all 0.3s ease;
        transform-origin: left center;
    }

    .form-input {
        width: 100%;
        padding: 28px 24px 12px;
        background: var(--input-bg);
        border: 1px solid rgba(255, 233, 134, 0.3);
        border-radius: 12px;
        font-size: 16px;
        color: var(--text-light);
        transition: all 0.3s ease;
        height: 64px;
    }

    .form-input:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(255, 233, 134, 0.2);
    }

    .form-input:focus + .form-label,
    .form-input:not(:placeholder-shown) + .form-label {
        transform: translateY(-10px) scale(0.85);
        color: var(--accent-color);
    }

    /* ====== Phone Input Group ====== */
    .phone-group {
        display: flex;
        gap: 12px;
    }
    .phone-group .phone-input {
        flex-grow: 1;
    }

    .country-code {
        flex: 0 0 120px;
        position: relative;
    }

  .country-select {
    width: 100%;
    padding: 12px 16px;
    background: var(--input-bg);
    border: 1px solid rgba(255, 233, 134, 0.3);
    border-radius: 12px;
    font-size: 16px;
    color: var(--text-light);
    appearance: none;
    cursor: pointer;
    height: 64px;
    display: flex;
    align-items: center;
    }

    /* ====== Submit Button ====== */
    .submit-btn {
        width: 100%;
        padding: 18px;
        background: var(--gold-gradient);
        color: #1A1A1A;
        border: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255, 233, 134, 0.3);
    }

    /* ====== Error Styling ====== */
    .alert-danger {
        background: rgba(255, 68, 68, 0.2);
        border: 1px solid rgba(255, 68, 68, 0.5);
        color: #FF4444;
        padding: 16px;
        border-radius: 12px;
        margin-bottom: 30px;
        backdrop-filter: blur(5px);
    }

    /* ====== Responsive Adjustments ====== */
    @media (max-width: 768px) {
        .form-container {
            padding: 30px 20px;
        }

        .country-code {
            flex: 1;
        }

        .page-header {
            padding: 60px 0 30px;
        }

        #phone{
          height: 63px;
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 2.2rem;
        }

        .form-input {
            height: 56px;
            padding: 24px 20px 8px;
        }
    }
</style>

<!-- Header Section -->
<section class="page-header">
    <div class="container">
        <h1 class="section-title">Become Sponsor</h1>
    </div>
</section>

<!-- Sponsor Form Section -->
<section class="sponsor-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="form-container">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('web.register.store') }}" method="post" id="sponsor-form">
                        @csrf

                        <!-- Name Field -->
                        <div class="form-group">
                            <input class="form-input" id="name" type="text" name="name" placeholder=" " required>
                            <label class="form-label" for="name">Full Name</label>
                        </div>

                        <!-- Email Field -->
                        <div class="form-group">
                            <input class="form-input" id="email" type="email" name="email" placeholder=" " required>
                            <label class="form-label" for="email">Email Address</label>
                        </div>

                        <!-- Phone Field -->
                        <div class="form-group">
                            <div class="phone-group">
                                <div class="country-code">
                                    <select class="country-select" name="country_code" id="country_code" required>
                                        <option value="+971">UAE (+971)</option>
                                        <option value="+20">Egypt (+20)</option>
                                        <option value="+966">Saudi (+966)</option>
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
                                </div>
                                <div class="form-group phone-input">
                                    <input class="form-input" id="phone" type="tel" name="phone" placeholder=" " required>
                                    <label class="form-label" for="phone">Phone Number</label>
                                </div>
                            </div>
                            <small id="phone-error" class="text-danger d-none">Invalid phone number for selected country</small>
                        </div>

                        <!-- Job Title Field -->
                        <div class="form-group">
                            <input class="form-input" id="job" type="text" name="job" placeholder=" " required>
                            <label class="form-label" for="job">Job Title</label>
                        </div>

                        <!-- Company Name Field -->
                        <div class="form-group">
                            <input class="form-input" id="company_name" type="text" name="company_name" placeholder=" " required>
                            <label class="form-label" for="company_name">Company Name</label>
                        </div>

                        <input type="hidden" name="type" value="2">

                        <!-- Submit Button -->
                        <button class="submit-btn" type="submit">
                            Become a Sponsor
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("sponsor-form");
        const phoneInput = document.getElementById("phone");
        const countryCode = document.getElementById("country_code");
        const phoneError = document.getElementById("phone-error");

        const phonePatterns = {
            '+20': [/^(10|11|12|15)\d{8}$/],
            '+966': [/^5\d{8}$/],
            '+971': [/^(50|52|54|55|56)\d{7}$/],
            '+965': [/^[569]\d{7}$/],
            '+964': [/^7\d{9}$/],
            '+963': [/^9\d{8}$/],
            '+962': [/^7\d{8}$/],
            '+968': [/^9\d{7}$/],
            '+973': [/^3\d{7}$/],
            '+974': [/^3\d{7}$/],
            '+212': [/^[67]\d{8}$/],
            '+1': [/^\d{10}$/],
            '+44': [/^7\d{9}$/],
        };

        form.addEventListener("submit", function(e) {
            const code = countryCode.value;
            let phone = phoneInput.value.trim().replace(/\D/g, '');

            if (phone.startsWith(code.replace('+', ''))) {
                phone = phone.slice(code.replace('+', '').length);
            }

            const patterns = phonePatterns[code];
            let valid = false;

            if (patterns) {
                for (const pattern of patterns) {
                    if (pattern.test(phone)) {
                        valid = true;
                        break;
                    }
                }
            }

            if (!valid) {
                e.preventDefault();
                phoneError.classList.remove("d-none");
                phoneInput.classList.add("is-invalid");
            } else {
                phoneError.classList.add("d-none");
                phoneInput.classList.remove("is-invalid");
            }
        });
    });
</script>
@endsection
