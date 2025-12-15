<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color: #D2D4D8;">
    <div class="container-fluid px-5">
        <a class="navbar-brand fw-bold fs-3" href="{{ route('home') }}">
            <img src="{{ asset('images/destinote_logo.png') }}" alt="Destinote Logo" width="40" height="40"
                class="d-inline-block align-text-top">
            Destinote
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav mx-auto fs-5">
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-black px-3 {{ request()->routeIs('destinations.*') ? 'active' : '' }}"
                            href="{{ route('destinations.index') }}">
                            My Destinations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black px-3 {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                            href="{{ route('profile.edit') }}">
                            Profile
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-black px-3" href="{{ route('home') }}">Home</a>
                    </li>
                @endauth
            </ul>
            <div class="d-flex align-items-center gap-3 pe-5">
                @auth
                    <span class="text-black fw-semibold">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>