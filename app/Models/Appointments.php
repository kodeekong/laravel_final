<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'doctor_id',
        'date',
        'status',
        'patient_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Roster::class, 'doctor_id');
    }
    
}


// use App\Models\Appointment;

// Appointments::create([
//     'patient_id' => 80622, // Ensure this patient_id exists in the patients table 
//     'doctor_id' => 39,  // Valid doctor ID 
//     'date' => '2024-12-03',
//     'status' => 'upcoming',
// ]);
