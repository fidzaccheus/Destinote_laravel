@extends('layouts.app')

@section('title', 'Manage Destinations - Admin')

@section('content')
    <div class="container-fluid py-5"
        style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh;">
        <div class="container">
            <!-- Header -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="display-5 fw-bold mb-2">
                            <i class="bi bi-geo-alt-fill text-info"></i> Manage Destinations
                        </h1>
                        <p class="text-muted">View and moderate all user destinations</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Search & Filter -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.destinations') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-search text-primary"></i> Search
                                </label>
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search by destination, country, or user..."
                                    value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-flag-fill text-success"></i> Status
                                </label>
                                <select name="status" class="form-select">
                                    <option value="">All</option>
                                    <option value="Noted" {{ request('status') === 'Noted' ? 'selected' : '' }}>Noted</option>
                                    <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>
                                        Completed</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-funnel-fill me-2"></i>Apply Filters
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Destinations Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Destination</th>
                                    <th>User</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Budget</th>
                                    <th>Added</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($destinations as $destination)
                                    <tr>
                                        <td>
                                            @if($destination->image)
                                                <img src="{{ asset('storage/' . $destination->image) }}"
                                                    alt="{{ $destination->destination_name }}" class="rounded"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 60px;">
                                                    <i class="bi bi-image text-white"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $destination->destination_name }}</strong>
                                            @if($destination->city)
                                                <br><small class="text-muted">{{ $destination->city }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $destination->user->name }}</small>
                                            <br><small class="text-muted">{{ $destination->user->email }}</small>
                                        </td>
                                        <td>{{ $destination->country }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $destination->status === 'Completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                {{ $destination->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($destination->budget)
                                                ₱{{ number_format($destination->budget, 2) }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $destination->created_at->format('M d, Y') }}</small>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('destinations.show', $destination) }}"
                                                class="btn btn-sm btn-info text-white me-1" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.destinations.delete', $destination) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this destination?')" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-5">
                                            <i class="bi bi-geo-alt" style="font-size: 3rem;"></i>
                                            <p class="mt-2">No destinations found</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($destinations->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $destinations->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection