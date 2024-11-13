<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'users'; // Explicitly define the table name

    use Notifiable;
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
}

