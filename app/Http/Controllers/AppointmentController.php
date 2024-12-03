<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patients;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Show Appointment Creation Form
    public function create(Request $request)
    {
        // Fetch doctors
        $doctors = User::where('role', 'Doctor')->get();
        
        // Fetch patient data if patient_id is provided
        $patient = null;
        if ($request->has('patient_id') && $request->patient_id) {
            $patient = Patients::where('patient_id', $request->patient_id)->first();
        }

        // Return the appointment creation view with doctors and the fetched patient
        return view('admin.appointments.create', compact('doctors', 'patient'));
    }

    // Store the appointment details
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'patient_id' => 'required|exists:patients,patient_id',  // Ensure patient exists
        ]);

        // Fetch the patient by patient_id
        $patient = Patients::where('patient_id', $request->patient_id)->first();

        // If the patient is not found, return an error
        if (!$patient) {
            return redirect()->back()->with('error', 'Patient not found.');
        }

        // Create the appointment
        Appointment::create([
            'patient_id' => $patient->id,  // Use the patient's ID (not patient_id)
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'status' => 'scheduled', // Default status is scheduled
        ]);

        return redirect()->route('appointments.create')->with('success', 'Appointment scheduled successfully!');
    }
}
