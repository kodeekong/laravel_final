<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Patients;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display the form to create a new patient.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a new patient's data in the database.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'patient_id' => 'required|unique:patients,patient_id',
            'admission_date' => 'nullable|date',
            'group' => 'nullable|string|max:255',
        ]);

        // Create a new patient record
        Patients::create($validated);

        // Redirect back with success message
        return redirect()->route('patients.create')->with('success', 'Patient created successfully!');
    }
    
    public function home()
    {
        $user = Auth::user(); 
        $today = now()->format('Y-m-d'); 

        $doctorName = $user->doctor->name ?? 'Not Assigned';
        $caregiverName = $user->caregiver->name ?? 'Not Assigned'; 

        return view('patient.home', [
            'patientId' => $user->id,
            'patientName' => $user->first_name . ' ' . $user->last_name,
            'date' => $today,
            'doctorName' => '',
            'doctorAppointment' => 'Not Scheduled',
            'caregiverName' => $caregiverName,
            'morningMedicine' => '',
            'afternoonMedicine' => '',
            'nightMedicine' => '',
            'breakfast' => '',
            'lunch' => '',
            'dinner' => '',
        ]);
    }
}
