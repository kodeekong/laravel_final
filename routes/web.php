<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientAdditionalController;
use App\Http\Controllers\AdminController;


// Route to display the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Home route (if needed)
Route::get('/home', [AuthController::class, 'showHome'])->name('home');
Route::post('/home', [AuthController::class, 'home']);

// Registration routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Dashboard route, protected by auth middleware
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Admin and Supervisor role-based routes for additional patient info
Route::middleware(['auth', 'role:admin|supervisor'])->group(function () {
    //Approvals
    Route::get('/admin/approvals', [AdminController::class, 'showApprovals'])->name('admin.approvals');
    Route::post('/admin/approvals/{user}/approve', [AdminController::class, 'approveUser'])->name('admin.approvals.approve');
    Route::post('/admin/approvals/{user}/reject', [AdminController::class, 'rejectUser'])->name('admin.approvals.reject');
    // Admin Report Route
    Route::get('/admin/report.index', [AdminReportController::class, 'showReport'])->name('admin.report');

    // Route to show the form (with or without patient_id)
    Route::get('/admin/additional_info/{patient_id?}', [PatientAdditionalController::class, 'showAdditionalInfoForm'])->name('admin.additional_info');

    // Route to update the patient's additional information
    Route::post('/admin/{patient_id}/additional_info', [PatientAdditionalController::class, 'updateAdditionalInfo']);

});

// Route::middleware(['auth', 'role:Admin,Supervisor'])->group(function () {
//     Route::get('/admin/approvals', [AdminController::class, 'showApprovals'])->name('admin.approvals');
//     Route::post('/admin/approvals/{user}/approve', [AdminController::class, 'approveUser'])->name('admin.approvals.approve');
//     Route::post('/admin/approvals/{user}/reject', [AdminController::class, 'rejectUser'])->name('admin.approvals.reject');
// });
