<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissedActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name', 
        'doctor_name', 
        'appointment_date', 
        'caregiver_name',
        'morning_medicine',
        'afternoon_medicine',
        'night_medicine',
        'breakfast',
        'lunch',
        'dinner',
    ];
}