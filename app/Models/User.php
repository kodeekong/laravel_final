<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'phone',
        'first_name',
        'last_name',
        'email',
        'date_of_birth',
        'family_code',
        'role',
        'relation_to_emergency',
        'emergency_contact',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function patients()
    {
        return $this->hasOne(Patients::class);
    }

    public function employee()
    {
        return $this->hasOne(Employees::class);
    }
}

