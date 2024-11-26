<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PatientAdditionalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);  // Ensures only admin can access
    }

    // Show the form to update or add additional information for an existing patient
    public function showAdditionalInfoForm(Request $request, $patient_id = null)
    {
        $patient = null;

        // Fetch the patient only if patient_id is provided
        if ($request->has('patient_id') && $request->patient_id) {
            $patient = Patients::where('patient_id', $request->patient_id)->first();
        }

        // Pass both patient and user data to the view
        return view('admin.additional_info', compact('patient'));
    }

    // Handle the form submission for updating additional patient information
    public function updateAdditionalInfo(Request $request, $patient_id)
    {
        // Validate incoming data (admission_date and group are the only editable fields)
        $request->validate([
            'admission_date' => 'required|date',
            'group' => 'nullable|string|max:255',
        ]);

        // Retrieve the patient by ID (using the patient_id from the URL)
        $patient = Patients::where('patient_id', $patient_id)->first();

        // If patient is not found, redirect with an error
        if (!$patient) {
            return redirect()->route('admin.additional_info')->with('error', 'Patient not found');
        }

        // Update the patient's additional information
        $patient->admission_date = $request->admission_date;
        $patient->group = $request->group;

        // Save the changes back to the database
        $patient->save();  // This commits the changes

        // Redirect back to the form with a success message
        return redirect()->route('admin.additional_info', ['patient_id' => $patient->patient_id])
                         ->with('success', 'Patient information updated successfully!');
    }
}