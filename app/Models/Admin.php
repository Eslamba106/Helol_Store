<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    use HasFactory , Notifiable;

    protected $fillable = ['id', 'name', 'email', 'username', 'password', 'phone_number', 'suber_admin', 'status', 'created_at', 'updated_at'];

    
}
