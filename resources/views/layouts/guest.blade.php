<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Destinote - Dream it. Note it. Live it.')</title>

    <!-- Vite Assets -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>

<body>
    <!-- Guest Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #D2D4D8;">
        <div class="container-fluid px-5">
            <a class="navbar-brand fw-bold fs-3" href="{{ route('home') }}">
                <img src="{{ asset('images/destinote_logo.png') }}" alt="Destinote Logo" width="40" height="40"
                    class="d-inline-block align-text-top">
                Destinote
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex align-items-center gap-3">
                    @if (Route::has('login') && !Auth::check())
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                    @endif
                    @if (Route::has('register') && !Auth::check())
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="text-dark text-center py-4" style="background-color: #EDEFF0;">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Destinote. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>