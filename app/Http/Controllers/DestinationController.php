<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->destinations();

        // Search by destination name, country, or city
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('destination_name', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by tag
        if ($request->filled('tag')) {
            $query->where('tag', 'like', "%{$request->tag}%");
        }

        // Sort by
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');

        if (in_array($sortBy, ['destination_name', 'country', 'travel_date', 'budget', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $destinations = $query->get();

        // Get unique tags for filter dropdown
        $tags = Auth::user()->destinations()
            ->whereNotNull('tag')
            ->distinct()
            ->pluck('tag');

        // Calculate Statistics (always from all user's destinations, not filtered)
        $allDestinations = Auth::user()->destinations;

        $stats = [
            'total' => $allDestinations->count(),
            'completed' => $allDestinations->where('status', 'Completed')->count(),
            'noted' => $allDestinations->where('status', 'Noted')->count(),
            'countries' => $allDestinations->unique('country')->count(),
            'total_budget' => $allDestinations->sum('budget'),
            'avg_budget' => $allDestinations->avg('budget'),
            'upcoming' => $allDestinations->where('travel_date', '>=', now())->count(),
        ];

        return view('destinations.index', compact('destinations', 'tags', 'stats'));
    }

    public function create()
    {
        return view('destinations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_name' => 'required|max:150',
            'country' => 'required|max:100',
            'city' => 'nullable|max:100',
            'description' => 'nullable',
            'travel_date' => 'nullable|date',
            'budget' => 'nullable|numeric',
            'tag' => 'nullable|max:50',
            'status' => 'required|in:Noted,Completed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('destinations', 'public');
            $validated['image'] = $imagePath;
            $validated['image_type'] = $request->file('image')->getMimeType();
        }

        Destination::create($validated);

        return redirect()->route('destinations.index')
            ->with('success', 'Destination added successfully!');
    }

    public function show(Destination $destination)
    {
        if ($destination->user_id !== Auth::id()) {
            abort(403);
        }

        return view('destinations.show', compact('destination'));
    }

    public function edit(Destination $destination)
    {
        if ($destination->user_id !== Auth::id()) {
            abort(403);
        }

        return view('destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        if ($destination->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'destination_name' => 'required|max:150',
            'country' => 'required|max:100',
            'city' => 'nullable|max:100',
            'description' => 'nullable',
            'travel_date' => 'nullable|date',
            'budget' => 'nullable|numeric',
            'tag' => 'nullable|max:50',
            'status' => 'required|in:Noted,Completed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        // Handle image removal
        if ($request->has('remove_image') && $request->remove_image) {
            if ($destination->image) {
                Storage::disk('public')->delete($destination->image);
                $validated['image'] = null;
                $validated['image_type'] = null;
            }
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($destination->image) {
                Storage::disk('public')->delete($destination->image);
            }

            $imagePath = $request->file('image')->store('destinations', 'public');
            $validated['image'] = $imagePath;
            $validated['image_type'] = $request->file('image')->getMimeType();
        }

        $destination->update($validated);

        return redirect()->route('destinations.index')
            ->with('success', 'Destination updated successfully!');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete image if exists
        if ($destination->image) {
            Storage::disk('public')->delete($destination->image);
        }

        $destination->delete();

        return redirect()->route('destinations.index')
            ->with('success', 'Destination deleted successfully!');
    }
}