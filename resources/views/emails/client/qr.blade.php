<!DOCTYPE html>
<html lang="en">
@php
    use App\Models\Event;
    use App\Models\HomeSection;
    use App\Models\Blog;
    use App\Models\Setting;

    $event = Event::first();
    $blogs = Blog::take(3)->get();
    $home_slider = HomeSection::where('is_active', true)->where('id', 1)->first();
    $locale = app()->getLocale();
    $settings = Setting::first();
@endphp

<head>
    <meta charset="UTF-8">
    <title>You're Invited</title>

    <!-- ✅ Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
            color: #000;
        }

        .hero-section {
            background:
                linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
                url('{{ asset($home_slider->media_path) }}') center center / cover no-repeat;
            height: 40vh;
            width: 100%;
            padding: 40px 30px 20px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: left;
        }

        .hero-content h1,
        .hero-content h2,
        .hero-content .event-info {
            color: #fff;
            margin: 0 0 10px;
        }

        .hero-content h1 {
            font-size: 36px;
            font-weight: 800;
            text-transform: uppercase;
            animation: slide-in 1s ease-out forwards;
        }

        .hero-content h2 {
            font-size: 22px;
        }

        .event-info {
            font-size: 15px;
            opacity: 0.9;
        }

        .invitation-content {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 30px;
            text-align: center;
        }

        .invitation-content p {
            font-size: 17px;
            line-height: 1.7;
            margin-bottom: 16px;
            color: #333;
        }

        .qr-code {
            margin-top: 30px;
            text-align: center;
        }

        .qr-code img {
            width: 200px;
            border-radius: 12px;
            border: 8px solid #fff;
            background: #fff;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.5);
        }

        .cta-btn {
            display: inline-block;
            margin-top: 25px;
            background: #E73701;
            color: #fff;
            padding: 12px 28px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 30px;
            text-decoration: none;
            transition: 0.3s;
        }

        .cta-btn:hover {
            background: #c32e00;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #888;
            margin: 40px 0 20px;
        }

        @media (max-width: 768px) {
            .hero-section {
                height: auto;
                padding-top: 20px;
            }

            .hero-content h1 {
                font-size: 28px;
            }

            .hero-content h2 {
                font-size: 18px;
            }

            .qr-code img {
                width: 160px;
            }
        }

        @keyframes slide-in {
            from { transform: translateX(-30px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* ✅ Social Icons */
        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .social-icons a {
            color: white;
            background-color: #333;
            padding: 10px;
            border-radius: 50%;
            font-size: 16px;
            transition: 0.3s;
            text-decoration: none;
        }

        .social-icons a:hover {
            background-color: #E73701;
        }
    </style>
</head>

<body>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <h1>You're Invited</h1>
        <h2>{{ $event->name_en ?? 'Join us to learn about the latest event trends' }}</h2>
        <div class="event-info">
            {{ \Carbon\Carbon::parse($event->event_date ?? now())->format('d M Y - h:i A') }}<br>
            {{ $event->location ?? 'Event Venue' }}
        </div>
    </div>
</div>

<!-- Invitation Content -->
<div class="invitation-content">
    <p>Dear {{ $client->name }},</p>
    <p>
        We're excited to invite you to our upcoming event on
        <strong>{{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}</strong>
        at <strong>{{ $event->location }}</strong>.
    </p>
    <p>
        Join industry leaders, marketers, and creators as we explore what's next in event planning and digital engagement.
    </p>
    <p>
        This invitation is personal and your QR code below will be required at the entrance.
    </p>

    <div class="qr-code">
        <img src="{{ $qrImageUrl }}" alt="QR Code">
    </div>

    <!-- ✅ Social Icons -->
    @php
        $socials = [
            'facebook' => 'fab fa-facebook-f',
            'twitter' => 'fab fa-twitter',
            'linkedin' => 'fab fa-linkedin-in',
            'youtube' => 'fab fa-youtube',
            'instagram' => 'fab fa-instagram',
            'x' => 'fab fa-x-twitter',
        ];
    @endphp

    @if($settings)
    <div class="social-icons">
        @foreach ($socials as $field => $icon)
            @if (!empty($settings->$field))
                <a href="{{ $settings->$field }}" target="_blank">
                    <i class="{{ $icon }}"></i>
                </a>
            @endif
        @endforeach
    </div>
    @endif
</div>

<!-- Footer -->
<div class="footer">
    &copy; {{ now()->year }} Smart Vision. All rights reserved.
</div>

</body>
</html>
