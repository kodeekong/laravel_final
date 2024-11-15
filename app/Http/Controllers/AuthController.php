<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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

    // Handle login form submission
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Redirect to dashboard after successful login
            return redirect()->route('dashboard')->with('success', 'Log in successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout()
    {
        Auth::logout();  // Log the user out
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
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
            'emergency_contact' => $request->emergency_contact
        ]);
        
        auth()->login($user);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}

?>

