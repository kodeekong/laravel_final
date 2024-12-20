<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{

    use HasFactory;

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
        return User::whereIn('id', json_decode($this->caregiver_ids ?? '[]'))->get();
    }

}

