@php
    use App\Models\Setting;
    $setting = Setting::first();
@endphp

<section class="luxury-banner-section">
    <!-- طبقة الخلفية الشفافة -->
    <div class="banner-overlay"></div>

    <!-- طبقة الجسيمات الذهبية -->
    <div class="gold-particles" id="gold-particles"></div>

    <!-- المحتوى الرئيسي -->
    <div class="luxury-container">
        <!-- العداد الزمني الذهبي -->
        <div class="gold-countdown-wrapper">
            <h3 class="countdown-title">COUNTDOWN TO EVENT</h3>
            <div class="gold-countdown-grid">
                <div class="countdown-box">
                    <div class="countdown-number" id="days">00</div>
                    <div class="countdown-label">DAYS</div>
                </div>
                <div class="countdown-separator">:</div>
                <div class="countdown-box">
                    <div class="countdown-number" id="hours">00</div>
                    <div class="countdown-label">HOURS</div>
                </div>
                <div class="countdown-separator">:</div>
                <div class="countdown-box">
                    <div class="countdown-number" id="minutes">00</div>
                    <div class="countdown-label">MINUTES</div>
                </div>
                <div class="countdown-separator">:</div>
                <div class="countdown-box">
                    <div class="countdown-number" id="seconds">00</div>
                    <div class="countdown-label">SECONDS</div>
                </div>
            </div>
        </div>

        <!-- عنوان الحدث -->
        <h1 class="luxury-event-title">{{ $event->name_en ?? 'PREMIUM EVENT' }}</h1>

        <!-- معلومات الحدث -->
        <div class="event-info-grid">
            <div class="info-item">
                <i class="fas fa-calendar-alt gold-icon"></i>
                <div class="info-text">
                    <p class="info-label">DATE & TIME</p>
                    <p class="info-value">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('F jS, Y - h:i A') }}</p>
                </div>
            </div>
            <div class="info-item">
                <i class="fas fa-map-marker-alt gold-icon"></i>
                <div class="info-text">
                    <p class="info-label">LOCATION</p>
                    <p class="info-value">{{ $event->location ?? 'Venue Name' }}</p>
                </div>
            </div>
        </div>

        <!-- زر Become Sponsor -->
        <a href="{{ route('web.becomesponsor') }}" class="gold-sponsor-btn thm-btn">
            <span>BECOME A SPONSOR</span>
            <div class="btn-ripple"></div>
            <div class="btn-shine"></div>
        </a>
    </div>

    <!-- مؤشر التمرير -->
    <div class="gold-scroll-indicator">
        <div class="scroll-line"></div>
    </div>
</section>

<!-- الخطوط والأيقونات -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- مكتبة الجسيمات -->
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

<style>
:root {
    --gold-primary: #D4AF37;
    --gold-secondary: #FFD700;
    --gold-dark: #B8860B;
    --black-primary: #121212;
    --black-secondary: #1E1E1E;
    --white: #FFFFFF;
    --transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.luxury-banner-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--black-primary);
    color: var(--white);
    font-family: 'Montserrat', sans-serif;
    overflow: hidden;
}

.banner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(18, 18, 18, 0.85);
    z-index: 1;
}

.gold-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
}

.luxury-container {
    position: relative;
    z-index: 3;
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
    padding: 160px 20px;
}

/* تصميم العداد الزمني */
.gold-countdown-wrapper {
    margin-bottom: 20px;
}

.countdown-title {
    font-size: 18px;
    font-weight: 500;
    letter-spacing: 4px;
    color: var(--gold-primary);
    margin-bottom: 30px;
    text-transform: uppercase;
    position: relative;
    display: inline-block;
}

.countdown-title:after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
}

.gold-countdown-grid {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-top: 40px;
}

.countdown-box {
    background: rgba(30, 30, 30, 0.7);
    border: 1px solid var(--gold-dark);
    border-radius: 12px;
    width: 120px;
    height: 140px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    transition: var(--transition);
}

.countdown-box:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2);
    border-color: var(--gold-primary);
}

.countdown-box:before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(212, 175, 55, 0.1), transparent);
    transform: rotate(45deg);
    transition: var(--transition);
}

.countdown-box:hover:before {
    left: 100%;
    top: 100%;
}

.countdown-number {
    font-family: 'Playfair Display', serif;
    font-size: 60px;
    font-weight: 700;
    color: var(--gold-primary);
    line-height: 1;
    margin-bottom: 5px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    transition: var(--transition);
}

.countdown-label {
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--gold-secondary);
}

.countdown-separator {
    font-size: 40px;
    color: var(--gold-primary);
    margin: 0 5px;
    align-self: flex-end;
    padding-bottom: 30px;
}

/* عنوان الحدث */
.luxury-event-title {
    font-family: 'Playfair Display', serif;
    font-size: 72px;
    font-weight: 700;
    margin: 10px 0;
    color: var(--white);
    position: relative;
    display: inline-block;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
}

.luxury-event-title:after {
    content: '';
    position: absolute;
    bottom: -20px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: var(--gold-primary);
}

/* معلومات الحدث */
.event-info-grid {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin: 35px 0;
    flex-wrap: wrap;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 20px;
    background: rgba(30, 30, 30, 0.7);
    border-left: 3px solid var(--gold-primary);
    padding: 20px 30px;
    max-width: 350px;
    width: 100%;
    text-align: left;
    transition: var(--transition);
}

.info-item:hover {
    transform: translateY(-5px);
    background: rgba(30, 30, 30, 0.9);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

.gold-icon {
    font-size: 24px;
    color: var(--gold-primary);
    width: 50px;
    height: 50px;
    background: rgba(212, 175, 55, 0.1);
    border-radius: 50%;
    display: flex !important;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.info-label {
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--gold-primary);
    margin-bottom: 8px;
}

.info-value {
    font-size: 16px;
    font-weight: 500;
    color: var(--white);
    margin: 0;
}

/* Btn Became A Sponsor */
.gold-sponsor-btn:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
    opacity: 0;
    z-index: -1;
    transition: all 0.3s ease;
}

.gold-sponsor-btn:hover:before {
    opacity: 0.3;
}

.btn-ripple {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    opacity: 0;
}

.gold-sponsor-btn:hover .btn-ripple {
    animation: ripple 1s ease-out;
}

.btn-shine {
    position: absolute;
    top: -50%;
    left: -50%;
    width: 50%;
    height: 200%;
    background: linear-gradient(
        to bottom,
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0.3) 50%,
        rgba(255, 255, 255, 0) 100%
    );
    transform: rotate(45deg);
    animation: shine 3s infinite;
}

@keyframes ripple {
    0% { width: 0; height: 0; opacity: 0.5; }
    100% { width: 500px; height: 500px; opacity: 0; }
}

@keyframes shine {
    0% { left: -50%; }
    100% { left: 150%; }
}

/* مؤشر التمرير */
.gold-scroll-indicator {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    z-index: 3;
}

.scroll-line {
    width: 2px;
    height: 50px;
    background: linear-gradient(to bottom, var(--gold-primary), transparent);
    position: relative;
    overflow: hidden;
}

.scroll-line:after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 15px;
    background: var(--gold-primary);
    animation: scrollAnimation 2s infinite;
}

@keyframes scrollAnimation {
    0% { top: -15px; }
    100% { top: 50px; }
}

/* تأثيرات الأرقام */
@keyframes flipNumber {
    0% { transform: rotateX(0deg); }
    50% { transform: rotateX(90deg); }
    100% { transform: rotateX(0deg); }
}

.flip {
    animation: flipNumber 0.5s ease-in-out;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .countdown-box {
        width: 100px;
        height: 120px;
    }

    .countdown-number {
        font-size: 50px;
    }

    .luxury-event-title {
        font-size: 60px;
    }
}

@media (max-width: 992px) {
    .countdown-box {
        width: 80px;
        height: 100px;
    }

    .countdown-number {
        font-size: 40px;
    }

    .countdown-separator {
        font-size: 30px;
        padding-bottom: 20px;
    }

    .luxury-event-title {
        font-size: 50px;
    }

    .info-item {
        max-width: 300px;
    }
}

@media (max-width: 768px) {
    .gold-countdown-grid {
        flex-wrap: wrap;
        gap: 10px;
    }

    .countdown-box {
        width: calc(50% - 10px);
        height: 100px;
    }

    .countdown-separator {
        display: none;
    }

    .luxury-event-title {
        font-size: 42px;
    }

    .event-info-grid {
        flex-direction: column;
        align-items: center;
    }

    .info-item {
        max-width: 100%;
    }
}

@media (max-width: 576px) {
    .countdown-number {
        font-size: 36px;
    }

    .luxury-event-title {
        font-size: 36px;
    }

    .gold-sponsor-btn {
        padding: 15px 30px;
        font-size: 14px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // تهيئة جسيمات الذهب
    if (document.getElementById('gold-particles')) {
        particlesJS('gold-particles', {
            particles: {
                number: { value: 60, density: { enable: true, value_area: 800 } },
                color: { value: "#D4AF37" },
                shape: { type: "circle" },
                opacity: { value: 0.5, random: true },
                size: { value: 4, random: true },
                line_linked: { enable: true, distance: 150, color: "#D4AF37", opacity: 0.3, width: 1 },
                move: { enable: true, speed: 2, direction: "none", random: true, straight: false, out_mode: "out" }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: { enable: true, mode: "repulse" },
                    onclick: { enable: true, mode: "push" }
                }
            }
        });
    }

    // العداد الزمني
    function updateCountdown() {
        const eventDate = new Date("{{ \Carbon\Carbon::parse($event->event_date)->format('Y/m/d H:i:s') }}").getTime();
        const now = new Date().getTime();
        const distance = eventDate - now;

        if (distance < 0) {
            clearInterval(countdownTimer);
            document.querySelector('.gold-countdown-grid').innerHTML = '<div class="countdown-ended">The Event Has Started!</div>';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // تطبيق تأثير الفليب عند تغيير الأرقام
        if (days !== currentDays) {
            document.getElementById('days').classList.add('flip');
            setTimeout(() => {
                document.getElementById('days').textContent = formatTime(days);
                document.getElementById('days').classList.remove('flip');
            }, 250);
        }

        if (hours !== currentHours) {
            document.getElementById('hours').classList.add('flip');
            setTimeout(() => {
                document.getElementById('hours').textContent = formatTime(hours);
                document.getElementById('hours').classList.remove('flip');
            }, 250);
        }

        if (minutes !== currentMinutes) {
            document.getElementById('minutes').classList.add('flip');
            setTimeout(() => {
                document.getElementById('minutes').textContent = formatTime(minutes);
                document.getElementById('minutes').classList.remove('flip');
            }, 250);
        }

        if (seconds !== currentSeconds) {
            document.getElementById('seconds').classList.add('flip');
            setTimeout(() => {
                document.getElementById('seconds').textContent = formatTime(seconds);
                document.getElementById('seconds').classList.remove('flip');
            }, 250);
        }

        currentDays = days;
        currentHours = hours;
        currentMinutes = minutes;
        currentSeconds = seconds;
    }

    function formatTime(time) {
        return time < 10 ? `0${time}` : time;
    }

    let currentDays = 0, currentHours = 0, currentMinutes = 0, currentSeconds = 0;
    const countdownTimer = setInterval(updateCountdown, 1000);
    updateCountdown(); // التشغيل الأولي
});
</script>
