<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'supervisor_id', 'doctor_id', 'caregiver1_id', 'caregiver2_id', 'caregiver3_id', 'caregiver4_id'];

    // Relationships
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function caregiver()
    {
        return $this->belongsTo(User::class, 'caregiver_ids');
    }
}
