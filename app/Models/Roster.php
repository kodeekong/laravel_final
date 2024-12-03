<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    protected $fillable = ['date', 'supervisor_id', 'doctor_id', 'caregiver_ids'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function caregivers()
    {
        return $this->hasMany(User::class, 'id', 'caregiver_ids');
    }
}

