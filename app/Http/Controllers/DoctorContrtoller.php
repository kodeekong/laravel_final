<?php
namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Patients;
use App\Models\Prescriptions;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DoctorContrtoller extends Controller
{
    // Show the doctor's home page with completed and upcoming appointments
    public function index(Request $request)
    {
        $doctor = auth()->user();

        // Get completed appointments (appointments that have already happened)
        $completedAppointments = Appointments::where('doctor_id', $doctor->id)
                                             ->where('date', '<', Carbon::today())
                                             ->get();

        // Get upcoming appointments (appointments scheduled for today or in the future)
        $upcomingAppointments = Appointments::where('doctor_id', $doctor->id)
                                            ->where('date', '>=', Carbon::today())
                                            ->with('patient')  // Eager load the patient relationship
                                            ->get();

        // If there's a till_date filter, apply it to upcoming appointments
        if ($request->has('till_date')) {
            $upcomingAppointments = $upcomingAppointments->where('date', '<=', $request->input('till_date'));
        }

        return view('doctor.home', compact('completedAppointments', 'upcomingAppointments'));
    }

    // Show the specific patient's details and old prescriptions
    public function viewPatient($patient_id)
    {
        // Find the patient by ID
        $patient = Patients::findOrFail($patient_id);

        // Get the patient's prescriptions (if any)
        $prescriptions = Prescriptions::where('patient_id', $patient_id)
                                     ->where('doctor_id', auth()->user()->id)
                                     ->get();

        return view('doctor.patient', compact('patient', 'prescriptions'));
    }
}
