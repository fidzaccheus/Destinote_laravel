@extends('layouts.app')

@section('title', 'Manage Users - Admin')

@section('content')
    <div class="container-fluid py-5"
        style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh;">
        <div class="container">
            <!-- Header -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="display-5 fw-bold mb-2">
                            <i class="bi bi-people-fill text-primary"></i> Manage Users
                        </h1>
                        <p class="text-muted">View and manage all registered users</p>
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

            <!-- Users Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Destinations</th>
                                    <th>Verified</th>
                                    <th>Admin</th>
                                    <th>Joined</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary text-white me-2">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <strong>{{ $user->name }}</strong>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $user->destinations_count }}</span>
                                        </td>
                                        <td>
                                            @if($user->email_verified_at)
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle"></i> Yes
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="bi bi-x-circle"></i> No
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->is_admin)
                                                <span class="badge bg-danger">
                                                    <i class="bi bi-shield-fill"></i> Admin
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $user->created_at->format('M d, Y') }}</small>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @if($user->email_verified_at)
                                                    <button type="submit" class="btn btn-sm btn-warning"
                                                        onclick="return confirm('Deactivate this user?')" title="Deactivate User">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-sm btn-success" title="Activate User">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-5">
                                            <i class="bi bi-people" style="font-size: 3rem;"></i>
                                            <p class="mt-2">No users found</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($users->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
@endsection