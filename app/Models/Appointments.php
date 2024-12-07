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
        return $this->belongsTo(Patients::class, 'patient_id', 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Roster::class, 'doctor_id');
    }
}


