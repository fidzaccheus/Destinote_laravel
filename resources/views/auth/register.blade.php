<x-guest-layout>
    <div class="container-fluid py-5"
        style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <!-- Header -->
                            <div class="text-center mb-4">
                                <h1 class="h3 fw-bold mb-2">Create Account</h1>
                                <p class="text-muted">Join Destinote and start planning your dream destinations</p>
                            </div>

                            <!-- Register Form -->
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">
                                        <i class="bi bi-person-fill text-primary"></i> Full Name
                                    </label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required autofocus autocomplete="name"
                                        placeholder="John Doe">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="bi bi-envelope-fill text-primary"></i> Email Address
                                    </label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required autocomplete="username"
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
                                        autocomplete="new-password" placeholder="Minimum 8 characters">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-semibold">
                                        <i class="bi bi-lock-fill text-primary"></i> Confirm Password
                                    </label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        required autocomplete="new-password" placeholder="Re-enter your password">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-person-plus me-2"></i>Create Account
                                    </button>
                                </div>

                                <!-- Login Link -->
                                <div class="text-center">
                                    <span class="text-muted small">Already have an account?</span>
                                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                        Log in here
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