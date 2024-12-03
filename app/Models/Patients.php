<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'admission_date',
        'group',
        'user_id', // Make sure user_id is included in fillable attributes
    ];

    // Define the relationship where a patient belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class); // A patient belongs to a user
    }
}
