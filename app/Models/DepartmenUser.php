<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmenUser extends Model
{
    use HasFactory;
    protected $table = 'departmens_users';
    protected $guarded = ['id'];

    public function departemen(){
        return $this->belongsTo(Departemen::class,'dep_code','dep_code');
    }

    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'nik', 'nik');
    }
}
