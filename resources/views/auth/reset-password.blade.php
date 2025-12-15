<x-guest-layout>
    <div class="container-fluid py-5"
        style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-md-5 col-lg-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <!-- Header -->
                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    <i class="bi bi-shield-lock-fill text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <h1 class="h3 fw-bold mb-2">Reset Password</h1>
                                <p class="text-muted small">Enter your new password below</p>
                            </div>

                            <!-- Form -->
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="bi bi-envelope-fill text-primary"></i> Email Address
                                    </label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $request->email) }}" required autofocus
                                        autocomplete="username">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="bi bi-lock-fill text-primary"></i> New Password
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
                                        class="form-control" required autocomplete="new-password"
                                        placeholder="Re-enter your password">
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check-circle-fill me-2"></i>Reset Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>