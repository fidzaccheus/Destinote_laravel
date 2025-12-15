<x-guest-layout>
    <div class="container-fluid py-5"
        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-md-5 col-lg-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <!-- Header -->
                            <div class="text-center mb-4">
                                <h1 class="h3 fw-bold mb-2">Welcome Back!</h1>
                                <p class="text-muted">Sign in to continue to Destinote</p>
                            </div>

                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Login Form -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="bi bi-envelope-fill text-primary"></i> Email Address
                                    </label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required autofocus autocomplete="username"
                                        placeholder="your@email.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="bi bi-lock-fill text-primary"></i> Password
                                    </label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" required
                                        autocomplete="current-password" placeholder="Enter your password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                    <label class="form-check-label" for="remember_me">
                                        Remember me
                                    </label>
                                </div>

                                <!-- Forgot Password Link -->
                                @if (Route::has('password.request'))
                                    <div class="mb-3 text-center">
                                        <a href="{{ route('password.request') }}" class="text-decoration-none small">
                                            Forgot your password?
                                        </a>
                                    </div>
                                @endif

                                <!-- Submit Button -->
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Log In
                                    </button>
                                </div>

                                <!-- Register Link -->
                                @if (Route::has('register'))
                                    <div class="text-center">
                                        <span class="text-muted small">Don't have an account?</span>
                                        <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                                            Register here
                                        </a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>