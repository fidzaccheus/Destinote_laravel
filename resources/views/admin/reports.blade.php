@extends('layouts.app')

@section('title', 'Reports - Admin')

@section('content')
    <div class="container-fluid py-5"
        style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh;">
        <div class="container">
            <!-- Header -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="display-5 fw-bold mb-2">
                            <i class="bi bi-graph-up text-success"></i> System Reports
                        </h1>
                        <p class="text-muted">Comprehensive analytics and statistics</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>

            <!-- User Statistics -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">
                        <i class="bi bi-people-fill text-primary"></i> User Statistics
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded text-center">
                                <h3 class="fw-bold text-primary mb-1">{{ $userStats['total_users'] }}</h3>
                                <small class="text-muted">Total Users</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded text-center">
                                <h3 class="fw-bold text-success mb-1">{{ $userStats['verified_users'] }}</h3>
                                <small class="text-muted">Verified Users</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded text-center">
                                <h3 class="fw-bold text-info mb-1">{{ $userStats['users_this_month'] }}</h3>
                                <small class="text-muted">This Month</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded text-center">
                                <h3 class="fw-bold text-warning mb-1">{{ $userStats['users_this_week'] }}</h3>
                                <small class="text-muted">This Week</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Destination Statistics -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">
                        <i class="bi bi-geo-alt-fill text-info"></i> Destination Statistics
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded text-center">
                                <h3 class="fw-bold text-primary mb-1">{{ $destStats['total_destinations'] }}</h3>
                                <small class="text-muted">Total Destinations</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded text-center">
                                <h3 class="fw-bold text-success mb-1">{{ $destStats['completed'] }}</h3>
                                <small class="text-muted">Completed</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded text-center">
                                <h3 class="fw-bold text-warning mb-1">{{ $destStats['noted'] }}</h3>
                                <small class="text-muted">Noted</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded text-center">
                                <h3 class="fw-bold text-info mb-1">{{ $destStats['destinations_this_month'] }}</h3>
                                <small class="text-muted">This Month</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Most Active Users & Popular Countries -->
            <div class="row mb-4">
                <!-- Most Active Users -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="bi bi-star-fill text-warning"></i> Most Active Users
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th class="text-end">Destinations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($activeUsers as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    {{ $user->name }}
                                                    @if($user->is_admin)
                                                        <span class="badge bg-danger ms-1">Admin</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <span class="badge bg-primary">{{ $user->destinations_count }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Countries -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="bi bi-flag-fill text-primary"></i> Popular Countries
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Country</th>
                                            <th class="text-end">Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($popularCountries as $index => $country)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $country->country }}</td>
                                                <td class="text-end">
                                                    <span class="badge bg-info">{{ $country->count }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popular Tags -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="bi bi-tags-fill text-success"></i> Popular Tags
                    </h5>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse($popularTags as $tag)
                            <span class="badge bg-info fs-6 px-3 py-2">
                                {{ $tag->tag }} <span class="badge bg-light text-dark ms-1">{{ $tag->count }}</span>
                            </span>
                        @empty
                            <p class="text-muted mb-0">No tags available</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Monthly Trends -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="bi bi-graph-up-arrow text-success"></i> Monthly Destination Trends
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th class="text-end">Destinations Added</th>
                                    <th class="text-end">Growth</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($monthlyTrends as $index => $trend)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($trend->month . '-01')->format('F Y') }}</td>
                                        <td class="text-end">
                                            <span class="badge bg-primary">{{ $trend->count }}</span>
                                        </td>
                                        <td class="text-end">
                                            @if($index > 0 && isset($monthlyTrends[$index - 1]))
                                                @php
                                                    $prevCount = $monthlyTrends[$index - 1]->count;
                                                    $growth = $prevCount > 0 ? (($trend->count - $prevCount) / $prevCount) * 100 : 0;
                                                @endphp
                                                @if($growth > 0)
                                                    <span class="text-success">
                                                        <i class="bi bi-arrow-up"></i> {{ number_format($growth, 1) }}%
                                                    </span>
                                                @elseif($growth < 0)
                                                    <span class="text-danger">
                                                        <i class="bi bi-arrow-down"></i> {{ number_format(abs($growth), 1) }}%
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">No data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection