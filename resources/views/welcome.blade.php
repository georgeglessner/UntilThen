<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UntilThen</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        html, body {
            height: 100%; margin: 0; padding: 0;
        }
        body {
            min-height: 100vh; width: 100vw; box-sizing: border-box;
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: #fff;
            color: #222;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            text-align: center;
        }
        .brand {
            font-size: 3.5rem;
            font-weight: 900;
            letter-spacing: -2px;
            margin-bottom: 0.5rem;
            color: #2563eb;
            text-shadow: 0 4px 32px rgba(37,99,235,0.08);
        }
        .tagline {
            font-size: 1.5rem;
            color: #64748b;
            margin-bottom: 2.5rem;
            font-weight: 500;
            text-align: center;
        }
        .highlights {
            display: flex;
            flex-wrap: wrap;
            gap: 1.25rem;
            align-items: center;
            justify-content: center;
            width: 100%;
            margin-bottom: 2.5rem;
        }
        .highlight {
            background: #f1f5f9;
            color: #2563eb;
            border-radius: 1rem;
            padding: 1.1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 2px 12px rgba(37,99,235,0.04);
            justify-content: center;
        }
        .highlight .icon { font-size: 1.5rem; }
        .actions {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            align-items: center;
            width: 100%;
            margin-bottom: 2rem;
        }
        .btn {
            display: inline-block;
            padding: 1.25rem 3rem;
            font-size: 1.25rem;
            font-weight: 700;
            border-radius: 2rem;
            border: none;
            cursor: pointer;
            transition: background 0.18s, color 0.18s, box-shadow 0.18s, transform 0.18s;
            box-shadow: 0 4px 24px rgba(37,99,235,0.10);
            text-decoration: none;
            outline: none;
            margin: 0.25rem 0;
        }
        .btn-primary {
            background: linear-gradient(90deg, #2563eb 0%, #60a5fa 100%);
            color: #fff;
            letter-spacing: 0.5px;
            border: none;
            box-shadow: 0 6px 32px 0 rgba(37,99,235,0.18);
        }
        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(90deg, #1d4ed8 0%, #60a5fa 100%);
            color: #fff;
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 8px 36px 0 rgba(37,99,235,0.22);
        }
        .btn-outline {
            background: transparent;
            color: #2563eb;
            border: 2px solid #2563eb;
            margin: 0 0.5rem;
        }
        .btn-outline:hover, .btn-outline:focus {
            background: #2563eb;
            color: #fff;
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 8px 36px 0 rgba(37,99,235,0.10);
        }
        .auth-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
            width: 100%;
        }
        .logo {
            width: 64px;
            height: 64px;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 4px 24px #2563eb33);
        }
        @media (max-width: 600px) {
            .brand { font-size: 2.2rem; }
            .tagline { font-size: 1.1rem; }
            .btn { font-size: 1rem; padding: 1rem 1.5rem; }
            .logo { width: 48px; height: 48px; }
            .highlights { flex-direction: column; gap: 1rem; }
        }
    </style>
</head>
<body>
    <div class="flex flex-col items-center justify-center min-h-screen w-full relative z-10 px-4">
        <img src="/favicon.svg" alt="UntilThen Logo" class="logo">
        <div class="brand">UntilThen</div>
        <div class="tagline">Events made simple</div>
        <div class="highlights mt-8 mb-10">
            <div class="highlight"><span class="icon">🎉</span> Free & unlimited event creation</div>
            <div class="highlight"><span class="icon">⚡</span> Create and share events in seconds</div>
            <div class="highlight"><span class="icon">📋</span> Effortlessly track RSVPs</div>
            <div class="highlight"><span class="icon">📱</span> Mobile-friendly, beautiful invites</div>
            <div class="highlight"><span class="icon">🔒</span> Private & secure by default</div>
        </div>
        <div class="actions mb-6">
            <a href="/events/create" class="btn btn-primary">Create Your Event</a>
        </div>
        <div class="auth-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/events') }}" class="btn btn-outline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>
</html>