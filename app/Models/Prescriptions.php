<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Prescriptions extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'patient_id',
        'doctor_id',
        'comment',
        'morning_med',
        'afternoon_med',
        'night_med',
    ];

    public function patient()
    {
        return $this->belongsTo(Patients::class,'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Rosters::class, 'doctor_id');
    }
}