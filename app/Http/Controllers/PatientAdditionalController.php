<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;

class PatientAdditionalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);  // Ensures only admin can access
    }

    // Show the form to input additional info (no patient selected yet)
    
    public function showAdditionalInfoForm($patient_id = null)
    {
        // If there's a patient_id, fetch the patient data
        $patient = null;
        if ($patient_id && $patient_id != 0) {
            $patient = Patients::where('patient_id', $patient_id)->first();
        }

        return view('admin.additional_info', compact('patient'));
    }



// Handle the form submission for updating additional patient information
    public function updateAdditionalInfo(Request $request, $patient_id)
    {
        // Validate incoming data
        $request->validate([
            'admission_date' => 'required|date',
            'group' => 'nullable|string|max:255',
        ]);

        // Find the patient by patient_id
        $patient = Patients::where('patient_id', $patient_id)->first();

        if (!$patient) {
            return redirect()->route('admin.additional_info')->with('error', 'Patient not found.');
        }

        // Update the patient's additional information
        $patient->admission_date = $request->input('admission_date');
        $patient->group = $request->input('group');
        $patient->save();

        return redirect()->route('admin.additional_info')->with('success', 'Patient information updated successfully!');
    }
}
