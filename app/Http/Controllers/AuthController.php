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

    // Attempt to authenticate the user
    if (Auth::attempt($credentials)) {
        // Get the authenticated user
        $user = auth()->user();

        // Check the role of the user and redirect accordingly
        if ($user->role === 'Patient') {
            return redirect()->route('patient.home')->with('success', 'Patient login successful!');
        }

        // Default redirect for other roles
        return redirect()->route('dashboard')->with('success', 'Login successful!');
    }

    // If authentication fails, return back with an error
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
    // Validate the request inputs
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

    if ($user->role === 'Patient') {
        Patients::create([
            'user_id' => $user->id,
            'patient_id' => rand(10000, 99999), 
            'admission_date' => now(), 
            'group' => 'general', 
        ]);
    }

    if (in_array($user->role, ['Doctor', 'Caregiver', 'Supervisor'])) {
        $roleId = $user->id; 

        Roster::create([
            'date' => now(), 
            'supervisor_id' => $user->role === 'Supervisor' ? $roleId : null, 
            'doctor_id' => $user->role === 'Doctor' ? $roleId : null, 
            'caregiver_ids' => $user->role === 'Caregiver' ? json_encode([$roleId]) : null,
        ]);
        $rosterData = [
            'date' => now(), 
        ];

        if ($user->role === 'Supervisor') {
            $rosterData['supervisor_id'] = $roleId;
        }

        if ($user->role === 'Doctor') {
            $rosterData['doctor_id'] = $roleId;
        }

        if ($user->role === 'Caregiver') {
            $rosterData['caregiver_ids'] = $roleId;
        }

        Roster::create($rosterData);
    }

    auth()->login($user);

    return redirect()->route('dashboard')->with('success', 'Registration successful!');
}


}
?>
