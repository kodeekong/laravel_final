<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [AuthController::class, 'showHome'])->name('home');
Route::post('/home', [AuthController::class, 'home']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route to access the missed activities report (with optional date filtering)
Route::get('/admin/missed-activities', [AdminReportController::class, 'index'])
    ->name('admin.report.index')
    ->middleware(['role:admin|supervisor']);  // Apply middleware for roles

Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::post('/employees/update-salary', [EmployeeController::class, 'updateSalary'])->name('employees.updateSalary');