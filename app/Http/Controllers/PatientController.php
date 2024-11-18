<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * Display the form to create a new patient.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a new patient's data in the database.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'patient_id' => 'required|unique:patients,patient_id',
            'admission_date' => 'nullable|date',
            'group' => 'nullable|string|max:255',
        ]);

        // Create a new patient record
        Patient::create($validated);

        // Redirect back with success message
        return redirect()->route('patients.create')->with('success', 'Patient created successfully!');
    }
}
