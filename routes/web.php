<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    UniversityController,
    CommentController,
    RatingController,
    UniversityPhotoController,
    AdminController,
    UserController
};
use App\Models\University;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// Welcome Route
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        $universities = Auth::check() ? University::all() : [];
        return view('dashboard', compact('universities'));
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // University Routes
    Route::resource('universities', UniversityController::class);
    Route::get('/universities/{university}/details', [UniversityController::class, 'showDetails'])->name('universities.details');
    Route::get('/universities/{university}/comments', [CommentController::class, 'getComments'])->name('universities.comments');

    // Comment and Rating Routes
    Route::resource('comments', CommentController::class);
    Route::resource('ratings', RatingController::class);
    Route::resource('university_photos', UniversityPhotoController::class);
});

// Admin Specific Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Authentication Routes
require __DIR__ . '/auth.php';
