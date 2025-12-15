<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>My Destinations - Destinote</title>
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
                    <li class="nav-item"><a class="nav-link text-black px-3"
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
            <!-- Header Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="display-4 fw-bold mb-2">
                                <i class="bi bi-geo-alt-fill text-info"></i> My Destinations
                            </h1>
                            <p class="text-muted fs-5">Track and manage your dream travel destinations</p>
                        </div>
                        <a href="{{ route('destinations.create') }}" class="btn btn-lg fw-semibold"
                            id="start-journey-btn">
                            <i class="bi bi-plus-circle me-2"></i>Add Destination
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0 bg-primary text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-globe display-4 mb-3"></i>
                            <h3 class="display-5 fw-bold">{{ $stats['total'] }}</h3>
                            <p class="mb-0">Total Destinations</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0 bg-success text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-check-circle-fill display-4 mb-3"></i>
                            <h3 class="display-5 fw-bold">{{ $stats['completed'] }}</h3>
                            <p class="mb-0">Completed</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0 bg-warning text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-bookmark-fill display-4 mb-3"></i>
                            <h3 class="display-5 fw-bold">{{ $stats['noted'] }}</h3>
                            <p class="mb-0">Noted (Dreaming)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0 bg-info text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-flag-fill display-4 mb-3"></i>
                            <h3 class="display-5 fw-bold">{{ $stats['countries'] }}</h3>
                            <p class="mb-0">Countries</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Budget Statistics -->
            @if($stats['total'] > 0)
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="card-body text-center text-white">
                                <i class="bi bi-cash-stack display-5 mb-3"></i>
                                <h4 class="display-6 fw-bold">₱{{ number_format($stats['total_budget'], 2) }}</h4>
                                <p class="mb-0">Total Budget</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0"
                            style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            <div class="card-body text-center text-white">
                                <i class="bi bi-calculator display-5 mb-3"></i>
                                <h4 class="display-6 fw-bold">₱{{ number_format($stats['avg_budget'], 2) }}</h4>
                                <p class="mb-0">Average Budget</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0"
                            style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <div class="card-body text-center text-white">
                                <i class="bi bi-calendar-check display-5 mb-3"></i>
                                <h4 class="display-6 fw-bold">{{ $stats['upcoming'] }}</h4>
                                <p class="mb-0">Upcoming Trips</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Search & Filter Section -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('destinations.index') }}" method="GET">
                        <div class="row g-3">
                            <!-- Search Box -->
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-search text-primary"></i> Search
                                </label>
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search by name, country, or city..." value="{{ request('search') }}">
                            </div>

                            <!-- Status Filter -->
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-flag-fill text-success"></i> Status
                                </label>
                                <select name="status" class="form-select">
                                    <option value="">All</option>
                                    <option value="Noted" {{ request('status') === 'Noted' ? 'selected' : '' }}>Noted
                                    </option>
                                    <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>
                                        Completed</option>
                                </select>
                            </div>

                            <!-- Tag Filter -->
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-tag-fill text-info"></i> Tag
                                </label>
                                <select name="tag" class="form-select">
                                    <option value="">All Tags</option>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag }}" {{ request('tag') === $tag ? 'selected' : '' }}>{{ $tag }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sort By -->
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-sort-down text-warning"></i> Sort By
                                </label>
                                <select name="sort" class="form-select">
                                    <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>
                                        Date Added</option>
                                    <option value="destination_name" {{ request('sort') === 'destination_name' ? 'selected' : '' }}>Name</option>
                                    <option value="country" {{ request('sort') === 'country' ? 'selected' : '' }}>Country
                                    </option>
                                    <option value="travel_date" {{ request('sort') === 'travel_date' ? 'selected' : '' }}>
                                        Travel Date</option>
                                    <option value="budget" {{ request('sort') === 'budget' ? 'selected' : '' }}>Budget
                                    </option>
                                </select>
                            </div>

                            <!-- Sort Order -->
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-arrow-down-up text-secondary"></i> Order
                                </label>
                                <select name="order" class="form-select">
                                    <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>Descending
                                    </option>
                                    <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>Ascending
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel-fill me-2"></i>Apply Filters
                            </button>
                            <a href="{{ route('destinations.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-2"></i>Clear
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Count -->
            @if(request()->hasAny(['search', 'status', 'tag']))
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    Found <strong>{{ $destinations->count() }}</strong> destination(s)
                    @if(request('search'))
                        matching "<strong>{{ request('search') }}</strong>"
                    @endif
                </div>
            @endif

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Destinations Grid -->
            @if($destinations->count() > 0)
                <div class="row g-4">
                    @foreach($destinations as $destination)
                        <div class="col-md-6 col-lg-4">
                            <div class="card destination-card h-100 shadow-sm">
                                @if($destination->image)
                                    <img src="{{ asset('storage/' . $destination->image) }}" class="card-img-top"
                                        alt="{{ $destination->destination_name }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-gradient d-flex align-items-center justify-content-center"
                                        style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <i class="bi bi-image text-white" style="font-size: 4rem; opacity: 0.5;"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h5 class="card-title fw-bold mb-0">{{ $destination->destination_name }}</h5>
                                        <span
                                            class="badge {{ $destination->status === 'Completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ $destination->status }}
                                        </span>
                                    </div>

                                    <p class="text-muted mb-2">
                                        <i class="bi bi-geo-alt-fill text-info"></i>
                                        {{ $destination->city ? $destination->city . ', ' : '' }}{{ $destination->country }}
                                    </p>

                                    @if($destination->travel_date)
                                        <p class="text-muted mb-2">
                                            <i class="bi bi-calendar-event text-primary"></i>
                                            {{ date('M d, Y', strtotime($destination->travel_date)) }}
                                        </p>
                                    @endif

                                    @if($destination->budget)
                                        <p class="text-muted mb-2">
                                            <i class="bi bi-cash text-success"></i>
                                            ₱{{ number_format($destination->budget, 2) }}
                                        </p>
                                    @endif

                                    @if($destination->tag)
                                        <span class="badge bg-info text-white">
                                            <i class="bi bi-tag-fill"></i> {{ $destination->tag }}
                                        </span>
                                    @endif

                                    @if($destination->description)
                                        <p class="card-text text-secondary mt-3">
                                            {{ Str::limit($destination->description, 100) }}
                                        </p>
                                    @endif
                                </div>

                                <div class="card-footer bg-transparent border-0 d-flex gap-2 pb-3">
                                    <a href="{{ route('destinations.show', $destination) }}"
                                        class="btn btn-sm btn-info text-white flex-fill">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="{{ route('destinations.edit', $destination) }}"
                                        class="btn btn-sm btn-warning flex-fill">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('destinations.destroy', $destination) }}" method="POST"
                                        class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="btn btn-sm btn-danger w-100">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="row justify-content-center mt-5">
                    <div class="col-md-6 text-center">
                        <div class="card shadow-lg border-0 p-5">
                            <i class="bi bi-map display-1 text-muted mb-4"></i>
                            <h3 class="mb-3">No Destinations Yet</h3>
                            <p class="text-muted mb-4">Start building your travel bucket list by adding your first
                                destination!</p>
                            <a href="{{ route('destinations.create') }}" class="btn btn-lg fw-semibold"
                                id="start-journey-btn">
                                <i class="bi bi-plus-circle me-2"></i>Add Your First Destination
                            </a>
                        </div>
                    </div>
                </div>
            @endif
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