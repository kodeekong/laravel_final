<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roster;
use Illuminate\Http\Request;

class RosterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin|Supervisor']);  
    }

    public function create()
    {
        $supervisors = User::where('role', 'Supervisor')->get();
        $doctors = User::where('role', 'Doctor')->get();
        $caregivers = User::where('role', 'Caregiver')->get();

        return view('admin.roster.create', compact('supervisors', 'doctors', 'caregivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'supervisor_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'caregiver_ids' => 'nullable|array',
            'caregiver_ids.*' => 'exists:users,id',  
        ]);

        // Store the roster
        Roster::create([
            'date' => $request->date,
            'supervisor_id' => $request->supervisor_id,
            'doctor_id' => $request->doctor_id,
            'caregiver_ids' => json_encode($request->caregiver_ids),  
        ]);

        return redirect()->route('admin.rosters.create')->with('success', 'Roster created successfully!');
    }

    public function index(Request $request)
    {
        $query = Roster::with(['supervisor', 'doctor', 'caregivers']);

        $query = Roster::query();
    
        $query->with(['supervisor', 'doctor']);
    
        $query->addSelect(['caregiver_ids']);

        if ($request->has('filter_date')) {
            $query->whereDate('date', $request->input('filter_date'));
        }
    
        // Fetch the rosters
        $rosters = $query->get();
        return view('rosterList', compact('rosters')); 

    }
}

