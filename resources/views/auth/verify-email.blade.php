<x-guest-layout>
    <div class="container-fluid py-5"
        style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <!-- Header -->
                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    <i class="bi bi-envelope-check-fill text-success" style="font-size: 3rem;"></i>
                                </div>
                                <h1 class="h3 fw-bold mb-2">Verify Your Email</h1>
                                <p class="text-muted small">
                                    Thanks for signing up! Before getting started, please verify your email address by
                                    clicking on the link we just emailed to you. If you didn't receive the email, we'll
                                    gladly send you another.
                                </p>
                            </div>

                            <!-- Success Status -->
                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    A new verification link has been sent to your email address!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Actions -->
                            <div class="d-flex flex-column gap-3">
                                <!-- Resend Verification Email -->
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="bi bi-envelope-fill me-2"></i>Resend Verification Email
                                        </button>
                                    </div>
                                </form>

                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-outline-secondary">
                                            <i class="bi bi-box-arrow-right me-2"></i>Log Out
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Info Box -->
                            <div class="alert alert-info mt-4 mb-0" role="alert">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                <small>Check your spam folder if you don't see the email in your inbox.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>