<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Profile - Destinote</title>
</head>

<body>
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
                    <li class="nav-item"><a class="nav-link text-black px-3" href="{{ route('destinations.index') }}">My
                            Destinations</a></li>
                    <li class="nav-item"><a class="nav-link text-black px-3 active"
                            href="{{ route('profile.edit') }}">Profile</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3 pe-5">
                    <span class="text-black fw-semibold">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-5"
        style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Header -->
                    <div class="mb-4">
                        <h1 class="display-5 fw-bold mb-2">
                            <i class="bi bi-person-circle text-info"></i> Profile Settings
                        </h1>
                        <p class="text-muted">Manage your account information</p>
                    </div>

                    <!-- Success Message -->
                    @if(session('status') === 'profile-updated')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>Profile updated successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Update Profile Information -->
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-body p-5">
                            <h5 class="fw-bold mb-4"><i class="bi bi-person-fill text-primary"></i> Profile Information
                            </h5>
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PATCH')

                                <!-- Name -->
                                <div class="mb-4">
                                    <label for="name" class="form-label fw-semibold">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                        class="form-control @error('email') is-invalid @enderror" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn fw-semibold" id="start-journey-btn">
                                    <i class="bi bi-check-circle me-2"></i>Update Profile
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-body p-5">
                            <h5 class="fw-bold mb-4"><i class="bi bi-lock-fill text-warning"></i> Update Password</h5>

                            @if(session('status') === 'password-updated')
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle-fill me-2"></i>Password updated successfully!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                @method('PUT')

                                <!-- Current Password -->
                                <div class="mb-4">
                                    <label for="current_password" class="form-label fw-semibold">Current
                                        Password</label>
                                    <input type="password" name="current_password" id="current_password"
                                        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                        required>
                                    @error('current_password', 'updatePassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold">New Password</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                        required>
                                    @error('password', 'updatePassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-semibold">Confirm
                                        Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-warning fw-semibold">
                                    <i class="bi bi-shield-check me-2"></i>Update Password
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="card shadow-lg border-0 border-danger mb-4">
                        <div class="card-body p-5">
                            <h5 class="fw-bold mb-3 text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Delete
                                Account</h5>
                            <p class="text-muted mb-4">Once your account is deleted, all of its resources and data will
                                be permanently deleted.</p>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteAccountModal">
                                <i class="bi bi-trash me-2"></i>Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger fw-bold">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Are you sure you want to delete your account? This action cannot be undone.</p>
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3">
                            <label for="password_delete" class="form-label fw-semibold">Confirm your password</label>
                            <input type="password" name="password" id="password_delete"
                                class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                placeholder="Enter your password" required>
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-secondary flex-fill"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger flex-fill">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-dark text-center py-4" style="background-color: #EDEFF0;">
        <div class="container">
            <p class="mb-0">&copy; 2025 Destinote. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>