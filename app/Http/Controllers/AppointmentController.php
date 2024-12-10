<?php
namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Patients;
use App\Models\User;
use App\Models\Roster;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        $doctors = User::where('role', 'Doctor')->get();
        $rosters = \App\Models\Roster::with('doctor')->get();
        
        $patient = null;
        if ($request->has('patient_id') && $request->patient_id) {
            $patient = Patients::where('patient_id', $request->patient_id)->first();
        }

        return view('admin.appointments.create', compact('doctors', 'patient'));
    }

    public function store(Request $request)
{
    $request->validate([
        'doctor_id' => 'required|exists:rosters,doctor_id', 
        'date' => 'required|date|after_or_equal:today',      
        'patient_id' => 'required|exists:patients,patient_id', 
    ]);

    $patient = Patients::where('patient_id', $request->patient_id)->first();
    if (!$patient) {
        return redirect()->back()->with('error', 'Patient not found.');
    }

    $doctor = Roster::where('doctor_id', $request->doctor_id)->first();
    if (!$doctor) {
        return redirect()->back()->with('error', 'Doctor not found in the roster.');
    }

    Appointments::create([
        'patient_id' => $patient->patient_id,
        'doctor_id' => $doctor->doctor_id,
        'date' => $request->date, 
        'status' => 'upcoming',  
    ]);

    return redirect()->route('appointments.create')
                        ->with('success', 'Appointment scheduled successfully!');
}

}
