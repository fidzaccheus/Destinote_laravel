<x-guest-layout>
    <div class="container-fluid py-5"
        style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-md-5 col-lg-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <!-- Header -->
                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    <i class="bi bi-shield-check text-warning" style="font-size: 3rem;"></i>
                                </div>
                                <h1 class="h3 fw-bold mb-2">Secure Area</h1>
                                <p class="text-muted small">
                                    This is a secure area. Please confirm your password before continuing.
                                </p>
                            </div>

                            <!-- Form -->
                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <!-- Password -->
                                <div class="mb-4">
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

                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check-circle-fill me-2"></i>Confirm
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