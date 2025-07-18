<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Root URL with GET method (welcome page)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route (protected by auth)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (protected by auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Add POST handler for root URL if needed
    Route::post('/', function () {
        // Handle POST request logic here
        return redirect('/dashboard'); // Example redirect
    });
});

// Authentication routes (login, register, password reset, etc.)
require __DIR__.'/auth.php';