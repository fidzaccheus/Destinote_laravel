<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard route that redirects based on role
Route::get('/dashboard', function () {
    if (Auth::user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('destinations.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('destinations', DestinationController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');
    Route::get('/destinations', [AdminController::class, 'destinations'])->name('destinations');
    Route::delete('/destinations/{destination}', [AdminController::class, 'deleteDestination'])->name('destinations.delete');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});

require __DIR__ . '/auth.php';