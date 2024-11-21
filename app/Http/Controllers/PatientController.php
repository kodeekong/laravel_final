<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PatientController extends Controller
{
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




