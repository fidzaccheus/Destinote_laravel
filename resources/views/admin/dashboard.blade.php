@extends('layouts.app')

@section('title', 'Admin Dashboard - Destinote')

@section('content')
    <div class="container-fluid py-5"
        style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh;">
        <div class="container">
            <!-- Header -->
            <div class="mb-4">
                <h1 class="display-5 fw-bold mb-2">
                    <i class="bi bi-shield-fill text-danger"></i> Admin Dashboard
                </h1>
                <p class="text-muted">Manage users, destinations, and view system statistics</p>
            </div>

            <!-- Quick Stats -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0 bg-primary text-white">
                        <div class="card-body text-center py-3">
                            <i class="bi bi-people-fill fs-2 mb-2"></i>
                            <h3 class="h2 fw-bold mb-1">{{ $stats['total_users'] }}</h3>
                            <p class="mb-0 small">Total Users</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0 bg-success text-white">
                        <div class="card-body text-center py-3">
                            <i class="bi bi-check-circle-fill fs-2 mb-2"></i>
                            <h3 class="h2 fw-bold mb-1">{{ $stats['verified_users'] }}</h3>
                            <p class="mb-0 small">Verified Users</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0 bg-info text-white">
                        <div class="card-body text-center py-3">
                            <i class="bi bi-geo-alt-fill fs-2 mb-2"></i>
                            <h3 class="h2 fw-bold mb-1">{{ $stats['total_destinations'] }}</h3>
                            <p class="mb-0 small">Total Destinations</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0 bg-warning text-white">
                        <div class="card-body text-center py-3">
                            <i class="bi bi-cash-stack fs-2 mb-2"></i>
                            <h3 class="h2 fw-bold mb-1">₱{{ number_format($stats['total_budget'], 0) }}</h3>
                            <p class="mb-0 small">Total Budget</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Destination Stats -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm border-0"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="card-body text-center text-white py-3">
                            <i class="bi bi-check-circle fs-3 mb-2"></i>
                            <h4 class="h3 fw-bold mb-1">{{ $stats['completed_destinations'] }}</h4>
                            <p class="mb-0 small">Completed Destinations</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm border-0"
                        style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <div class="card-body text-center text-white py-3">
                            <i class="bi bi-bookmark fs-3 mb-2"></i>
                            <h4 class="h3 fw-bold mb-1">{{ $stats['noted_destinations'] }}</h4>
                            <p class="mb-0 small">Noted Destinations</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <a href="{{ route('admin.users') }}" class="text-decoration-none">
                        <div class="card shadow-sm border-0 hover-shadow">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-people text-primary" style="font-size: 3rem;"></i>
                                <h5 class="mt-3 mb-0">Manage Users</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.destinations') }}" class="text-decoration-none">
                        <div class="card shadow-sm border-0 hover-shadow">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-geo-alt text-info" style="font-size: 3rem;"></i>
                                <h5 class="mt-3 mb-0">Manage Destinations</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.reports') }}" class="text-decoration-none">
                        <div class="card shadow-sm border-0 hover-shadow">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-graph-up text-success" style="font-size: 3rem;"></i>
                                <h5 class="mt-3 mb-0">View Reports</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Top Countries -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="bi bi-flag-fill text-primary"></i> Top Countries
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Country</th>
                                            <th class="text-end">Destinations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($topCountries as $country)
                                            <tr>
                                                <td>{{ $country->country }}</td>
                                                <td class="text-end">
                                                    <span class="badge bg-primary">{{ $country->count }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center text-muted">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="bi bi-person-plus-fill text-success"></i> Recent Users
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th class="text-end">Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentUsers as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td><small>{{ $user->email }}</small></td>
                                                <td class="text-end">
                                                    <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No users yet</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Destinations -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="bi bi-clock-history text-info"></i> Recent Destinations
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Destination</th>
                                    <th>User</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th class="text-end">Added</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentDestinations as $destination)
                                    <tr>
                                        <td>{{ $destination->destination_name }}</td>
                                        <td>{{ $destination->user->name }}</td>
                                        <td>{{ $destination->country }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $destination->status === 'Completed' ? 'bg-success' : 'bg-warning' }}">
                                                {{ $destination->status }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <small class="text-muted">{{ $destination->created_at->diffForHumans() }}</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No destinations yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-shadow {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection