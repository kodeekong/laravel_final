<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'emp_id',
        'role',
        'salary'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
