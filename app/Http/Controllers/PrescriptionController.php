<?php
namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Prescriptions;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PrescriptionController extends Controller
{
    // Create a new prescription for a patient
    public function store(Request $request, $patient_id)
    {
        // Validate the incoming data
        $request->validate([
            'comment' => 'required|string',
            'morning_med' => 'nullable|string',
            'afternoon_med' => 'nullable|string',
            'night_med' => 'nullable|string',
        ]);

        // Get today's date and check if the appointment is today
        $appointment = Appointments::where('patient_id', $patient_id)
                                  ->where('doctor_id', auth()->user()->id)
                                  ->where('date', Carbon::today())
                                  ->first();

        if (!$appointment) {
            return redirect()->back()->withErrors(['error' => 'Cannot create prescription, appointment is not today.']);
        }

        // Create the prescription if the appointment is today
        Prescriptions::create([
            'patient_id' => $patient_id,
            'doctor_id' => auth()->user()->id,
            'comment' => $request->comment,
            'morning_med' => $request->morning_med,
            'afternoon_med' => $request->afternoon_med,
            'night_med' => $request->night_med,
        ]);

        return redirect()->route('doctor.viewPatient', $patient_id)->with('success', 'Prescription added successfully');
    }

}