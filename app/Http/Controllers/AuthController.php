<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patients;
use App\Models\Roster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function showHome(){
        return view('auth.home');
    }

    public function showLoginForm(){
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
        // Validate the request inputs
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'password' => 'required|string|min:4|confirmed', // Password confirmation
            'role' => 'required|string|in:Patient,Family Member,Admin,Supervisor,Doctor,Caregiver',
            'family_code' => 'nullable|string|max:50',
            'relation_to_emergency' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:15',
        ]);
    
        // Create the user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'password' => Hash::make($request->password),
            'family_code' => $request->family_code, // Only for Patients or Family Members
            'role' => $request->role,
            'relation_to_emergency' => $request->relation_to_emergency, // Only for Patients or Family Members
            'emergency_contact' => $request->emergency_contact, // Only for Patients or Family Members
        ]);
    
        // Add to the patients table if the user is a Patient
        if ($user->role === 'Patient') {
            Patients::create([
                'user_id' => $user->id,
                'patient_id' => 'P' . Str::upper(Str::random(5)), // Generate unique patient ID
                'admission_date' => now(), // Set current date as admission date
                'group' => 'general', // Or you can leave this null or based on your logic
            ]);
        }
    
        // Add the user to the rosters table if they are a Doctor, Caregiver, or Supervisor
        if (in_array($user->role, ['Doctor', 'Caregiver', 'Supervisor'])) {
            Roster::create([
                'date' => now(), // Set default date to now; you can adjust this
                'supervisor_id' => $user->role === 'Supervisor' ? $user->id : null, // Assign supervisor ID if Supervisor
                'doctor_id' => $user->role === 'Doctor' ? $user->id : null, // Assign doctor ID if Doctor
                'caregiver_ids' => $user->role === 'Caregiver' ? json_encode([$user->id]) : null, // Assign caregiver IDs if Caregiver
            ]);
        }
    
        // Log the user in after registration
        auth()->login($user);
    
        return redirect()->route('dashboard')->with('success', 'Registration successful!');
    }
    

}

?>

