<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'verified_users' => User::whereNotNull('email_verified_at')->count(),
            'total_destinations' => Destination::count(),
            'completed_destinations' => Destination::where('status', 'Completed')->count(),
            'noted_destinations' => Destination::where('status', 'Noted')->count(),
            'total_budget' => Destination::sum('budget'),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentDestinations = Destination::with('user')->latest()->take(10)->get();

        // Top destinations by country
        $topCountries = Destination::select('country', DB::raw('count(*) as count'))
            ->groupBy('country')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentDestinations', 'topCountries'));
    }

    public function users()
    {
        $users = User::withCount('destinations')->latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users-edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'boolean',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function toggleUserStatus(User $user)
    {
        // Toggle a custom is_active field or use a soft delete approach
        $user->email_verified_at = $user->email_verified_at ? null : now();
        $user->save();

        $status = $user->email_verified_at ? 'activated' : 'deactivated';
        return back()->with('success', "User {$status} successfully!");
    }

    public function destinations(Request $request)
    {
        $query = Destination::with('user');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('destination_name', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $destinations = $query->latest()->paginate(20);
        return view('admin.destinations', compact('destinations'));
    }

    public function deleteDestination(Destination $destination)
    {
        // Delete image if exists
        if ($destination->image) {
            Storage::disk('public')->delete($destination->image);
        }

        $destination->delete();

        return back()->with('success', 'Destination deleted successfully!');
    }

    public function reports()
    {
        // User statistics
        $userStats = [
            'total_users' => User::count(),
            'verified_users' => User::whereNotNull('email_verified_at')->count(),
            'users_this_month' => User::whereMonth('created_at', now()->month)->count(),
            'users_this_week' => User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
        ];

        // Destination statistics
        $destStats = [
            'total_destinations' => Destination::count(),
            'completed' => Destination::where('status', 'Completed')->count(),
            'noted' => Destination::where('status', 'Noted')->count(),
            'destinations_this_month' => Destination::whereMonth('created_at', now()->month)->count(),
        ];

        // Most active users
        $activeUsers = User::withCount('destinations')
            ->orderByDesc('destinations_count')
            ->take(10)
            ->get();

        // Popular destinations by country
        $popularCountries = Destination::select('country', DB::raw('count(*) as count'))
            ->groupBy('country')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        // Popular tags
        $popularTags = Destination::select('tag', DB::raw('count(*) as count'))
            ->whereNotNull('tag')
            ->groupBy('tag')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        // Monthly destination trends
        $monthlyTrends = Destination::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('count(*) as count')
        )
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();

        return view('admin.reports', compact(
            'userStats',
            'destStats',
            'activeUsers',
            'popularCountries',
            'popularTags',
            'monthlyTrends'
        ));
    }
}