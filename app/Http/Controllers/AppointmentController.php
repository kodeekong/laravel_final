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
        // Fetch the patient based on the patient ID entered
        $patient = Patients::where('patient_id', $request->patient_id)->first();

        // If no patient is found, redirect with an error message
        if (!$patient) {
            return redirect()->back()->with('error', 'Patient not found.');
        }

        // Fetch doctors
        $doctors = User::where('role', 'Doctor')->get();

        // Return the appointment creation view with the patient and doctors
        return view('appointments.create', compact('patient', 'doctors'));
    }

    // Store the appointment details
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after_or_equal:today',
        ]);

        // Retrieve the patient by ID
        $patient = Patients::where('patient_id', $request->patient_id)->first();

        if (!$patient) {
            return redirect()->back()->with('error', 'Patient not found.');
        }

        // Create the appointment
        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'status' => 'scheduled', // Default status is scheduled
        ]);

        return redirect()->back()->with('success', 'Appointment scheduled successfully!');
    }
}
