<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Karyawan extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'karyawan';
    protected $fillable = [
        'nik', 'nama', 'email', 'password', 'level',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    
}
