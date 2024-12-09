<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roster;
use Illuminate\Http\Request;

class RosterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin|Supervisor']);  // Only Admin/Supervisor can access
    }

    // Display the form to create a new roster
    public function create()
    {
        // Fetch available users to populate dropdowns
        $supervisors = User::where('role', 'Supervisor')->get();
        $doctors = User::where('role', 'Doctor')->get();
        $caregivers = User::where('role', 'Caregiver')->get();

        return view('admin.roster.create', compact('supervisors', 'doctors', 'caregivers'));
    }

    // Store a newly created roster
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'date' => 'required|date',
            'supervisor_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'caregiver_ids' => 'nullable|array',
            'caregiver_ids.*' => 'exists:users,id',  // Ensure all caregiver IDs exist
        ]);

        // Store the roster
        Roster::create([
            'date' => $request->date,
            'supervisor_id' => $request->supervisor_id,
            'doctor_id' => $request->doctor_id,
            'caregiver_ids' => json_encode($request->caregiver_ids),  // Store caregiver IDs as a JSON array
        ]);

        return redirect()->route('admin.rosters.create')->with('success', 'Roster created successfully!');
    }

    // Display all rosters
    public function index(Request $request)
    {
        // Initialize query builder for Roster model
        $query = Roster::query();
    
        // Eager load relationships: supervisor, doctor
        $query->with(['supervisor', 'doctor']);
    
        // Add caregiver_ids field to the select query
        $query->addSelect(['caregiver_ids']);
    
        // Filter by date if passed
        if ($request->has('filter_date')) {
            $query->whereDate('date', $request->input('filter_date'));
        }
    
        // Fetch the rosters
        $rosters = $query->get();
    
        // Pass data to the view
        return view('rosterList', compact('rosters'));
    }
}

