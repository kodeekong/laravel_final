<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [AuthController::class, 'showHome'])->name('home');
Route::post('/home', [AuthController::class, 'home']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/home', [AuthController::class, 'showHome'])->name('home');
Route::post('/home', [AuthController::class, 'home']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/admin/missed-activities', [AdminReportController::class, 'index'])
    ->name('admin.report.index')
    ->middleware(['role:admin|supervisor']);  

Route::middleware(['auth', 'role:Admin,Supervisor'])->group(function () {
    Route::get('/admin/approvals', [AdminController::class, 'showApprovals'])->name('admin.approvals');
    Route::post('/admin/approvals/{user}/approve', [AdminController::class, 'approveUser'])->name('admin.approvals.approve');
    Route::post('/admin/approvals/{user}/reject', [AdminController::class, 'rejectUser'])->name('admin.approvals.reject');
});

Route::prefix('admin')->name('admin.')
    ->middleware(['auth', 'admin']) // Ensure 'admin' middleware is applied here
    ->group(function () {
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    });




