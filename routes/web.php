<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegistrationWindowController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Company routes
    Route::middleware('role:company')->group(function () {
        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    });

    // Student routes
    Route::post('/jobs/{job}/apply', [JobApplicationController::class, 'store'])->name('jobs.apply');
    Route::post('/jobs/{job}/save', [SavedJobController::class, 'store'])->name('jobs.save');
    Route::delete('/jobs/{job}/save', [SavedJobController::class, 'destroy'])->name('jobs.unsave');
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
});

Route::middleware(['auth', 'role:superadmin,admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/companies', [AdminController::class, 'manageCompanies'])->name('admin.companies');
    Route::post('/companies/{user}/approve', [AdminController::class, 'approveCompany'])->name('admin.companies.approve');
    Route::post('/companies/{user}/reject', [AdminController::class, 'rejectCompany'])->name('admin.companies.reject');
    Route::resource('registration-windows', RegistrationWindowController::class);
});

require __DIR__ . '/auth.php';
