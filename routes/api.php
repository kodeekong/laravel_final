<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;

// Authentication Routes
Route::get('/home', [AuthController::class, 'showHome'])->name('home');
Route::post('/home', [AuthController::class, 'home']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Dashboard Route (Requires Authentication)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Admin and Supervisor Routes (With Role Middleware)
Route::middleware(['auth', 'role:admin|supervisor'])->group(function () {
    Route::get('patients/{patient_id}/additional-info', [PatientAdditionalController::class, 'showAdditionalInfo'])->name('patients.additional_info');
    Route::post('patients/{patient_id}/additional-info', [PatientAdditionalController::class, 'updateAdditionalInfo']);
    
    // Route to access the missed activities report (with optional date filtering)
    Route::get('/admin/missed-activities', [AdminReportController::class, 'index'])
        ->name('admin.report.index')
        ->middleware(['role:admin|supervisor']);  // Apply middleware for roles
});

// Patient Management Routes
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');

// Employee Routes
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::post('/employees/update-salary', [EmployeeController::class, 'updateSalary'])->name('employees.updateSalary');
