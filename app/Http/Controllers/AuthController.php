<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
        // Validate the incoming request
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
            'family_code' => 'nullable|string',
            'relation_to_emergency' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
        ]);
    
        // Create the user in the `users` table
        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
            'family_code' => $validatedData['family_code'],
            'relation_to_emergency' => $validatedData['relation_to_emergency'],
            'emergency_contact' => $validatedData['emergency_contact'],
        ]);
    
        // After user creation, if the user is a "Patient", create the associated patient record using DB::table()
        if ($user->role == 'Patient') {
            // Insert patient record using DB facade
            DB::table('patients')->insert([
                'user_id' => $user->id, // Link this patient to the user
                'patient_id' => uniqid('P'), // Generate a unique patient ID
                'admission_date' => now(), // Set admission date to now
                'group' => 'Default Group', // Set group or this can be dynamic
            ]);
    
            // Log patient creation (optional)
            \Log::info('Patient created for User ID: ' . $user->id);
        }
    
        // Log the user creation (optional)
        \Log::info('User created with ID: ' . $user->id);
    
        // Log the user in
        auth()->login($user);
    
        // Redirect to the login page with success message
        return redirect()->route('login')->with('success', 'Registration successful!');

{
    // Validate the request inputs
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:15',
        'date_of_birth' => 'required|date',
        'password' => 'required|string|min:4|confirmed', // Password confirmation
        'role' => 'required|string|in:Patient,Family Member,Admin,Supervisor,Doctor',
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

    // After creating the user, check if the user is a Patient
    if ($user->role === 'Patient') {
        // Insert into the patients table
        Patients::create([
            'user_id' => $user->id,
            'patient_id' => 'P' . Str::upper(Str::random(5)), // Generate unique patient ID
            'admission_date' => now(), // Set current date as admission date (you can adjust this)
            'group' => 'general', // Or you can leave this null or based on your logic
        ]);
    }
    

}

?>

