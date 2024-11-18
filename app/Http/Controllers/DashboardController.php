<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // This constructor ensures that only authenticated users can access the dashboard
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();
        
        // Return the dashboard view with user info
        return view('auth.dashboard', compact('user'));
    }
}
?>