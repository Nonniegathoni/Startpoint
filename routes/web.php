<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ProgressReportController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Root URL with GET method (welcome page)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route (protected by auth)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile routes (protected by auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Opportunities routes
    Route::resource('opportunities', OpportunityController::class);
    
    // Applications routes
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/opportunities/{opportunity}/apply', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/opportunities/{opportunity}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/applications/{application}/withdraw', [ApplicationController::class, 'withdraw'])->name('applications.withdraw');
    
    // Admin/HR routes for application review
    Route::middleware(['auth', 'role:admin,hr_officer'])->group(function () {
        Route::post('/applications/{application}/review', [ApplicationController::class, 'review'])->name('applications.review');
    });
    
    // Assignments routes
    Route::resource('assignments', AssignmentController::class);
    Route::post('/assignments/{assignment}/assign-interns', [AssignmentController::class, 'assignInterns'])->name('assignments.assign-interns');
    
    // Progress Reports routes
    Route::resource('progress-reports', ProgressReportController::class);
    Route::post('/progress-reports/{progressReport}/review', [ProgressReportController::class, 'review'])->name('progress-reports.review');
    
    // Notifications routes
    Route::get('/notifications', function () {
        $notifications = auth()->user()->notifications()->latest()->paginate(20);
        return view('notifications.index', compact('notifications'));
    })->name('notifications.index');
    
    Route::patch('/notifications/{notification}/mark-read', function ($notification) {
        $notification = auth()->user()->notifications()->findOrFail($notification);
        $notification->markAsRead();
        return back()->with('success', 'Notification marked as read.');
    })->name('notifications.mark-read');
    
    // Reports and Analytics routes (Admin/HR only)
    Route::middleware(['auth', 'role:admin,hr_officer'])->group(function () {
        Route::get('/reports', function () {
            return view('reports.index');
        })->name('reports.index');
        
        Route::get('/analytics', function () {
            return view('analytics.index');
        })->name('analytics.index');
    });
    
    // Intern Management routes (HR only)
    Route::middleware(['auth', 'role:hr_officer'])->group(function () {
        Route::get('/interns', function () {
            return view('interns.index');
        })->name('interns.index');
        
        Route::get('/interns/create', function () {
            return view('interns.create');
        })->name('interns.create');
    });
});

// Authentication routes (login, register, password reset, etc.)
require __DIR__.'/auth.php';