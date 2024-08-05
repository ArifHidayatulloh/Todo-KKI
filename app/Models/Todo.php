<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'todo';
    protected $guarded = ['id'];

    public function departemen(){
        return $this->belongsTo(Departemen::class,'dep_code','dep_code');
    }
    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'pic', 'nik');
    }

    public function pic1(){
        return $this->belongsTo(Karyawan::class, 'relatedpic1', 'nik');
    }
    public function pic2(){
        return $this->belongsTo(Karyawan::class, 'relatedpic2', 'nik');
    }
    public function pic3(){
        return $this->belongsTo(Karyawan::class, 'relatedpic3', 'nik');
    }
}
