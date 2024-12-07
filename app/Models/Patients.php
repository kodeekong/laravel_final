<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'admission_date',
        'group',
        'user_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function appointments()
    {
    return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function prescriptions()
{
    return $this->hasMany(Prescriptions::class);
}

}