<?php

namespace App\Models;

use App\Http\Controllers\PatientAdditionalController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $fillable = [
        'user_id', 
        'patient_id', 
        'admission_date', 
        'group'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

    