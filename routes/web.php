<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientAdditionalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;



// Route to display the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes (not protected by auth)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route to the dashboard, protected by 'auth' middleware (accessible only to logged-in users)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Home route (accessible only to authenticated users)
Route::get('/home', [AuthController::class, 'showHome'])->name('home')->middleware('auth');
Route::post('/home', [AuthController::class, 'home'])->middleware('auth');

// Registration routes (accessible to anyone)
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Admin and Supervisor role-based routes, protected by 'auth' and role middleware
Route::middleware(['auth', 'role:Admin,Supervisor'])->group(function () {
    // Admin Report Route
    Route::get('/admin/report', [AdminReportController::class, 'index'])->name('admin.report');
    
    // Admin Approvals routes
    Route::get('/admin/approvals', [AdminController::class, 'showApprovals'])->name('admin.approvals');
    Route::post('/admin/approvals/{user}/approve', [AdminController::class, 'approveUser'])->name('admin.approvals.approve');
    Route::post('/admin/approvals/{user}/reject', [AdminController::class, 'rejectUser'])->name('admin.approvals.reject');

    // Route to show the form (with or without patient_id)
    Route::get('/admin/additional_info/{patient_id?}', [PatientAdditionalController::class, 'showAdditionalInfoForm'])->name('admin.additional_info');

    // Route to update the patient's additional information
    Route::post('/admin/{patient_id}/additional_info', [PatientAdditionalController::class, 'updateAdditionalInfo']);
});

// Admin-specific roles management routes, protected by 'auth' and 'role:admin'
Route::prefix('admin')->name('admin.')
    ->middleware(['auth', 'admin']) // Ensure 'admin' middleware is applied here
    ->group(function () {
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    });
