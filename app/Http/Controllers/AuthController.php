<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patients;
use App\Models\Roster;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function showHome()
    {
        return view('auth.home');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showDashboard()
    {
        $user = auth()->user();
        return view('dashboard', compact('user'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'Log in successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    public function register(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:15',
        'date_of_birth' => 'required|date',
        'password' => 'required|string|min:4|confirmed',
        'role' => 'required|string|in:Patient,Family Member,Admin,Supervisor,Doctor',
        'family_code' => 'nullable|string|max:50',
        'relation_to_emergency' => 'nullable|string|max:255',
        'emergency_contact' => 'nullable|string|max:15',
    ]);

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'date_of_birth' => $request->date_of_birth,
        'password' => Hash::make($request->password),
        'family_code' => $request->family_code, 
        'role' => $request->role,
        'relation_to_emergency' => $request->relation_to_emergency, 
        'emergency_contact' => $request->emergency_contact, 
    ]);

    if ($user->role !== 'Patient') {
        $lastEmployee = Employees::orderBy('emp_id', 'desc')->first();
        $emp_id = $lastEmployee ? $lastEmployee->emp_id + 1 : 1000;
    
        $salary = match ($user->role) {
            'Doctor' => 100000,
            'Admin' => 60000,
            default => 40000,
        };
    
        Employees::create([
            'user_id' => $user->id,
            'role' => $request->role,
            'emp_id' => $emp_id,
            'salary' => $salary,
        ]);
    }
    

    if ($user->role === 'Patient') {
        Patients::create([
            'user_id' => $user->id,
            'patient_id' => rand(10000,99999), 
            'admission_date' => now(), 
            'group' => 'general', 
        ]);
    }

    if (in_array($user->role, ['Doctor', 'Caregiver', 'Supervisor'])) {
        Roster::create([
            'date' => now(), 
            'supervisor_id' => $user->role === 'Supervisor' ? $user->id : null, 
            'doctor_id' => $user->role === 'Doctor' ? $user->id : null,
            'caregiver_ids' => $user->role === 'Caregiver' ? json_encode([$user->id]) : null, 
        ]);
    }

    auth()->login($user);

    return redirect()->route('dashboard')->with('success', 'Registration successful!');
}

}
?>
