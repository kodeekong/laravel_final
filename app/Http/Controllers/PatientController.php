<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patients;
use App\Models\User;
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

    public function index(Request $request)
    {
        // Start the query on the users table, joining with the patients table
        $query = \App\Models\User::where('role', 'Patient')
            ->join('patients', 'users.id', '=', 'patients.user_id') // Join with patients table to get `admission_date`
            ->select(
                'users.id',
                \DB::raw("CONCAT(users.first_name, ' ', users.last_name) as name"), // Combine first and last name
                \DB::raw("TIMESTAMPDIFF(YEAR, users.date_of_birth, CURDATE()) as age"), // Calculate age
                'users.emergency_contact',
                'users.relation_to_emergency',
                'patients.admission_date',
                'users.status' // Include status from the users table
            );
        
        // Apply filters based on user input
        if ($request->filled('name')) {
            $query->where(\DB::raw("CONCAT(users.first_name, ' ', users.last_name)"), 'like', '%' . $request->name . '%');
        }
        
        if ($request->filled('age')) {
            $query->where(\DB::raw("TIMESTAMPDIFF(YEAR, users.date_of_birth, CURDATE())"), $request->age);
        }
        
        if ($request->filled('emergency_contact')) {
            $query->where('users.emergency_contact', 'like', '%' . $request->emergency_contact . '%');
        }
        
        if ($request->filled('admission_date')) {
            $query->whereDate('patients.admission_date', $request->admission_date);
        }
        
        // Filter to only show approved patients based on the users' status field
        $patients = $query->where('users.status', 'approved')->paginate(10); // Filtering based on 'status' in the users table
        
        return view('admin.patients', compact('patients'));
    }
    
    
    

}
