<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PatientAdditionalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\DoctorContrtoller;
use App\Http\Controllers\RosterController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
    Route::get('/admin/report', [AdminReportController::class, 'showReport'])->name('admin.report');
    
    // Route to show the form (with or without patient_id)
    Route::get('admin/additional-info', [PatientAdditionalController::class, 'showAdditionalInfoForm'])->name('admin.additional_info');
    // Route to update the patient's additional information
    Route::post('admin/{patient_id}/additional-info', [PatientAdditionalController::class, 'updateAdditionalInfo'])->name('admin.update_additional_info');
    
        // Admin Approvals routes
    Route::get('/admin/approvals', [AdminController::class, 'showApprovals'])->name('admin.approvals');
    Route::post('/admin/approvals/{user}/approve', [AdminController::class, 'approveUser'])->name('admin.approvals.approve');
    Route::post('/admin/approvals/{user}/reject', [AdminController::class, 'rejectUser'])->name('admin.approvals.reject');
});
// Admin-specific roles management routes, protected by 'auth' and 'role:admin'
Route::prefix('admin')->name('admin.')
    ->middleware(['auth', 'admin']) // Ensure 'admin' middleware is applied here
    ->group(function () {
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::resource('admin/roles', RoleController::class);
    });
Route::middleware(['auth', 'role:Patient'])->group(function () {
    Route::get('/patient/home', [PatientController::class, 'home'])->name('patient.home');
});
            
// Patient Management Routes
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');
//Appointment routes
Route::middleware(['auth', 'role:Admin|Supervisor'])->group(function () {
    Route::get('appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('appointments/store', [AppointmentController::class, 'store'])->name('appointments.store');
});
//new roster routes
Route::get('roster', [RosterController::class, 'index'])->name('rosters.index');

// Admin/Supervisor only
Route::prefix('admin')->middleware(['auth', 'role:Admin|Supervisor'])->group(function () {
    Route::get('roster/create', [RosterController::class, 'create'])->name('admin.rosters.create');
    Route::post('roster', [RosterController::class, 'store'])->name('admin.rosters.store');
});
Route::get('/patients', function () {
    return view('patients');
})->name('patients');
Route::middleware(['auth', 'role:Admin|Supervisor|Doctor|Caregiver'])->group(function () {
    Route::get('/admin/patients', [PatientController::class, 'index'])->name('admin.patients.index');
});
// Employee Routes
Route::get('admin/employees', [EmployeeController::class, 'emp_index'])->name('admin.employees');
Route::post('admin/employees/update-salary', [EmployeeController::class, 'updateSalary'])->name('admin.employees.updateSalary');

Route::post('/prescriptions/{patient_id}', [PrescriptionController::class, 'store'])->name('prescriptions.store');

Route::middleware(['auth', 'role:Doctor'])->group(function () {
    // Doctor's Home Page
    Route::get('/doctor/home', [DoctorContrtoller::class, 'index'])->name('doctor.home');

    // Patient Prescription Page
    Route::get('/doctor/patient/{patient_id}', [DoctorContrtoller::class, 'viewPatient'])->name('doctor.viewPatient');

    // New Prescription for Patient
    Route::post('/doctor/patient/{patient_id}/prescription', [DoctorContrtoller::class, 'createPrescription'])->name('doctor.createPrescription');
});

Route::get('/payment', function () {
    return view('payment');
});

Route::get('/caregiver/home', function () {
    return view('caregiver.home');
})->name('caregiver.home');

Route::get('/family/home', function () {
    return view('family.home');
});
