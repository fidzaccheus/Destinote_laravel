<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ $destination->destination_name }} - Destinote</title>
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
                    <li class="nav-item"><a class="nav-link text-black px-3" href="{{ route('destinations.index') }}">My Destinations</a></li>
                    <li class="nav-item"><a class="nav-link text-black px-3" href="{{ route('profile.edit') }}">Profile</a></li>
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

    <div class="container-fluid py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh;">
        <div class="container">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('destinations.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Destinations
                </a>
            </div>

            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Image Section -->
                    @if($destination->image)
                        <div class="card shadow-lg border-0 mb-4">
                            <img src="{{ asset('storage/' . $destination->image) }}" 
                                 class="card-img-top rounded-top" 
                                 alt="{{ $destination->destination_name }}"
                                 style="max-height: 400px; object-fit: cover;">
                        </div>
                    @endif
                    
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-body p-5">
                            <!-- Header with Status -->
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h1 class="display-4 fw-bold mb-3">{{ $destination->destination_name }}</h1>
                                    <p class="text-muted fs-5 mb-0">
                                        <i class="bi bi-geo-alt-fill text-info"></i> 
                                        {{ $destination->city ? $destination->city . ', ' : '' }}{{ $destination->country }}
                                    </p>
                                </div>
                                <span class="badge {{ $destination->status === 'Completed' ? 'bg-success' : 'bg-warning text-dark' }} fs-6 p-3">
                                    {{ $destination->status === 'Completed' ? '✅' : '📝' }} {{ $destination->status }}
                                </span>
                            </div>

                            <hr class="my-4">

                            <!-- Description -->
                            @if($destination->description)
                                <div class="mb-4">
                                    <h5 class="fw-bold mb-3"><i class="bi bi-card-text text-info"></i> Description</h5>
                                    <p class="text-secondary fs-5 lh-lg">{{ $destination->description }}</p>
                                </div>
                            @endif

                            <!-- Details Grid -->
                            <div class="row g-4 mt-4">
                                @if($destination->travel_date)
                                    <div class="col-md-6">
                                        <div class="p-4 bg-light rounded-3">
                                            <h6 class="fw-bold text-muted mb-2">
                                                <i class="bi bi-calendar-event text-warning"></i> Travel Date
                                            </h6>
                                            <p class="fs-5 mb-0">{{ date('F d, Y', strtotime($destination->travel_date)) }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($destination->budget)
                                    <div class="col-md-6">
                                        <div class="p-4 bg-light rounded-3">
                                            <h6 class="fw-bold text-muted mb-2">
                                                <i class="bi bi-cash text-success"></i> Budget
                                            </h6>
                                            <p class="fs-5 mb-0">₱{{ number_format($destination->budget, 2) }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($destination->tag)
                                    <div class="col-md-6">
                                        <div class="p-4 bg-light rounded-3">
                                            <h6 class="fw-bold text-muted mb-2">
                                                <i class="bi bi-tag-fill text-info"></i> Category
                                            </h6>
                                            <span class="badge bg-info text-white fs-6">{{ $destination->tag }}</span>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-6">
                                    <div class="p-4 bg-light rounded-3">
                                        <h6 class="fw-bold text-muted mb-2">
                                            <i class="bi bi-clock text-secondary"></i> Added On
                                        </h6>
                                        <p class="fs-6 mb-0">{{ $destination->created_at->format('F d, Y') }}</p>
                                        @if($destination->updated_at != $destination->created_at)
                                            <small class="text-muted">Updated: {{ $destination->updated_at->format('M d, Y') }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - Actions -->
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 sticky-top" style="top: 100px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4"><i class="bi bi-gear-fill text-secondary"></i> Actions</h5>
                            
                            <!-- Edit Button -->
                            <a href="{{ route('destinations.edit', $destination) }}" 
                               class="btn btn-warning w-100 mb-3 py-3 fw-semibold">
                                <i class="bi bi-pencil-square"></i> Edit Destination
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('destinations.destroy', $destination) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this destination?')"
                                        class="btn btn-danger w-100 py-3 fw-semibold">
                                    <i class="bi bi-trash"></i> Delete Destination
                                </button>
                            </form>

                            <hr class="my-4">

                            <!-- Quick Stats -->
                            <div class="text-center">
                                <div class="mb-3">
                                    <i class="bi bi-{{ $destination->status === 'Completed' ? 'check-circle-fill text-success' : 'clock-fill text-warning' }} display-1"></i>
                                </div>
                                <h6 class="text-muted">Status</h6>
                                <p class="fw-bold fs-5">{{ $destination->status }}</p>
                            </div>
                        </div>
                    </div>
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