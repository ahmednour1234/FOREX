@extends('web.layouts.app')

@section('content')
<style>
    .form-section {
        padding: 0px 0;
        background: black;
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
        border: 1px solid #FFE986;
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

    .btn-square {
        padding: 14px 60px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        border-radius: 50px;
        cursor: pointer;
        border: none;
        background-color: #FFE986 ;
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
    }

    .phone-flex .code-select {
        flex: 1;
        height: 60px;
        border-radius: 50px;
        background-color: #fff;
        color: black;
        border: 1px solid #FFE986;
        font-weight: bold;
        text-align: center;
    }

    .phone-flex .phone-input {
        flex: 3;
        height: 60px;
        padding: 12px 20px;
        border: 1px solid #FFE986 ;
        border-radius: 50px;
        background-color: #fff;
        color: black;
        font-weight: bold;
    }

    @media (max-width: 767px) {
        .phone-flex {
            flex-direction: column;
        }

        .phone-flex .code-select,
        .phone-flex .phone-input {
            width: 100%;
        }
    }
      .pe-4 {
    padding-right: 7rem !important;
}
   @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap');

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
    background-clip: text;
    color: transparent;

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

        @media (max-width: 767.98px) {
            #typed-title {
                font-size: 32px;
            }
        }
  #typewriter-title {
    font-size: 48px;
    font-weight: 700;
    text-transform: capitalize;
    background: linear-gradient(90deg, #FFE986 0%, #C48127 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent;
    white-space: nowrap;
    overflow: hidden;
    border-right: 3px solid #FFE986;
    display: inline-block;
    animation: blink 0.75s step-end infinite;
}

@keyframes blink {
  50% { border-color: transparent; }
}
@media (max-width: 767px) {
        .phone-flex {
            flex-direction: row;
        }

        .phone-flex select,
        .phone-flex input {
            flex: 1;
            width: auto;
        }
    }

</style>
<section class="page-header">
   <div class="container">
        <div class="page-header__inner">
            <h2 id="typed-title"></h2>
        </div>
    </div>
</section>    
<section class="form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-7">
                @if ($errors->any())
                    <div class="alert alert-danger text-start">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('web.register.store') }}" method="post" id="sponsor-form">
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
                            <select class="code-select" name="country_code" id="country_code" required>
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
                            <input class="phone-input" id="phone" type="tel" name="phone" placeholder="Phone Number" required>
                        </div>
                        <small id="phone-error" class="text-danger d-none">Invalid phone number for selected country.</small>
                    </div>

                    <div class="form-wrap">
                        <input class="form-input" id="job" type="text" name="job" placeholder="Job Title" required>
                    </div>

                    <div class="form-wrap">
                        <input class="form-input" id="company_name" type="text" name="company_name" placeholder="Company Name" required>
                    </div>

                    <input type="hidden" name="type" value="2">

                    <div class="text-center">
                        <button class="thm-btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
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

        form.addEventListener("submit", function (e) {
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
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({
            duration: 1000,
            once: true
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const text = @json(__('Become Sponsor'));
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