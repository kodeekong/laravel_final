<?php
namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Patients;
use App\Models\Prescriptions;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DoctorContrtoller extends Controller
{
    public function index(Request $request)
    {
        $doctor = auth()->user();

        $completedAppointments = Appointments::where('doctor_id', $doctor->id)
                                             ->where('date', '<', Carbon::today())
                                             ->get();

        $upcomingAppointments = Appointments::where('doctor_id', $doctor->id)
                                            ->where('date', '>=', Carbon::today())
                                            ->with('patient')  
                                            ->get();

        if ($request->has('till_date')) {
            $upcomingAppointments = $upcomingAppointments->where('date', '<=', $request->input('till_date'));
        }

        return view('doctor.home', compact('completedAppointments', 'upcomingAppointments'));
    }

    public function viewPatient($patient_id)
    {
        $patient = Patients::findOrFail($patient_id);

        $prescriptions = Prescriptions::where('patient_id', $patient_id)
                                     ->where('doctor_id', auth()->user()->id)
                                     ->get();

        return view('doctor.patient', compact('patient', 'prescriptions'));
    }
}