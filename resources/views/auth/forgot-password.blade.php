<x-guest-layout>
    <div class="container-fluid py-5"
        style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-md-5 col-lg-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <!-- Header -->
                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    <i class="bi bi-key-fill text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <h1 class="h3 fw-bold mb-2">Forgot Password?</h1>
                                <p class="text-muted small">
                                    No problem! Enter your email address and we'll send you a password reset link.
                                </p>
                            </div>

                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Form -->
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="bi bi-envelope-fill text-primary"></i> Email Address
                                    </label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required autofocus placeholder="your@email.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-send-fill me-2"></i>Email Password Reset Link
                                    </button>
                                </div>

                                <!-- Back to Login -->
                                <div class="text-center">
                                    <a href="{{ route('login') }}" class="text-decoration-none">
                                        <i class="bi bi-arrow-left me-1"></i>Back to Login
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>