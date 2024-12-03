<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Show Appointment Creation Form
    public function create(Request $request)
    {
     // Fetch doctors
        $doctors = User::where('role', 'Doctor')->get();

        // Return the appointment creation view with the patient and doctors
        return view('admin.appointments.create', compact('doctors'));
    }

    // Store the appointment details
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after_or_equal:today',
        ]);

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
