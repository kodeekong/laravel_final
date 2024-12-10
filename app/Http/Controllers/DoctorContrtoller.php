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

        $completedAppointments = Appointments::with('patient.user')
                                            ->where('doctor_id', $doctor->id)
                                            ->where('date', '<', Carbon::today())
                                            ->get();


        $upcomingAppointments = Appointments::where('doctor_id', $doctor->id)
                                            ->where('date', '>=', Carbon::now())
                                            ->when($request->has('till_date'), function ($query) use ($request) {
                                                $query->where('date', '<=', $request->till_date);
                                            })
                                            ->with('patient')
                                            ->get();

        return view('doctor.home', compact('completedAppointments', 'upcomingAppointments'));
    }

    public function viewPatient($patient_id)
    {
        $patient = Patients::find($patient_id);
    
        if (!$patient) {
            abort(404, 'Patient not found');
        }
    
        $prescriptions = $patient->prescriptions()
                                 ->where('doctor_id', auth()->user()->id)
                                 ->get();
    
        return view('doctor.patient', compact('patient', 'prescriptions'));
    }
    
}
