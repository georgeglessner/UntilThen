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
                height: 100%;
                margin: 0;
                padding: 0;
            }
            body {
                min-height: 100vh;
                width: 100vw;
                box-sizing: border-box;
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                background: linear-gradient(120deg, #2563eb 0%, #60a5fa 100%);
                color: #fff;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow-x: hidden;
            }
            .hero-content {
                text-align: center;
                margin-top: -5vh;
            }
            .brand {
                font-size: 4rem;
                font-weight: 800;
                letter-spacing: -2px;
                margin-bottom: 1rem;
                color: #fff;
                text-shadow: 0 4px 32px rgba(37,99,235,0.15);
            }
            .tagline {
                font-size: 1.7rem;
                color: #e0e7ef;
                margin-bottom: 3rem;
                font-weight: 500;
                text-shadow: 0 2px 8px rgba(37,99,235,0.10);
            }
            .actions {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
                align-items: center;
                margin-bottom: 2.5rem;
            }
            .btn {
                display: inline-block;
                padding: 1.25rem 3rem;
                font-size: 1.25rem;
                font-weight: 700;
                border-radius: 1rem;
                border: none;
                cursor: pointer;
                transition: background 0.2s, color 0.2s, box-shadow 0.2s, transform 0.2s;
                box-shadow: 0 4px 24px rgba(37,99,235,0.13);
            }
            .btn-primary {
                background: linear-gradient(90deg, #fff 0%, #e0e7ef 100%);
                color: #2563eb;
                letter-spacing: 0.5px;
            }
            .btn-primary:hover {
                background: #fff;
                color: #1d4ed8;
                transform: translateY(-2px) scale(1.03);
            }
            .btn-outline {
                background: transparent;
                color: #fff;
                border: 2px solid #fff;
                margin: 0 0.5rem;
            }
            .btn-outline:hover {
                background: #fff;
                color: #2563eb;
            }
            .auth-links {
                display: flex;
                justify-content: center;
                gap: 1rem;
                margin-top: 2rem;
            }
            @media (max-width: 600px) {
                .brand { font-size: 2.2rem; }
                .tagline { font-size: 1.1rem; }
                .btn { font-size: 1rem; padding: 1rem 1.5rem; }
            }
        </style>
    </head>
    <body>
        <div class="hero-content">
            <div class="brand">UntilThen</div>
            <div class="tagline">Events made simple</div>
            <div class="actions">
                <a href="/events/create" class="btn btn-primary">Create Event</a>
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