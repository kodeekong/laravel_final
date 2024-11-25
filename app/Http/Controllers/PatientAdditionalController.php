<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;

class PatientAdditionalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);  // Ensures only admin can access
    }

    // Show the form to update or add additional information for an existing patient
    public function showAdditionalInfoForm($patient_id = null)
    {
        if ($patient_id) {
            // Retrieve the patient by ID
            $patient = Patients::find($patient_id);

            // If patient is not found, redirect with an error
            if (!$patient) {
                return redirect()->route('admin.additional_info')->with('error', 'Patient not found');
            }

            // Fetch the associated user for the patient
            $user = $patient->user; // Automatically fetch related user

            // Pass both patient and user data to the view
            return view('admin.additional_info', compact('patient', 'user'));
        } else {
            return view('admin.additional_info');
        }
    }

    // Handle the form submission for updating additional patient information
    public function updateAdditionalInfo(Request $request, $patient_id)
    {
        // Validate incoming data
        $request->validate([
            'admission_date' => 'required|date',
            'group' => 'nullable|string|max:255',
        ]);

        // Retrieve the patient by ID
        $patient = Patients::find($patient_id);

        if (!$patient) {
            return redirect()->route('admin.additional_info')->with('error', 'Patient not found');
        }

        // Update the patient's additional information
        $patient->admission_date = $request->admission_date;
        $patient->group = $request->group;

        // Save the changes
        $patient->save();

        // Redirect with success message
        return redirect()->route('admin.additional_info')->with('success', 'Patient information updated successfully!');
    }
}
