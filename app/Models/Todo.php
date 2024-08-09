<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'todo';
    protected $guarded = ['id'];


    protected $casts = [
        'relatedpic' => 'array',
    ];

    // Accessor untuk relatedpic
    public function getRelatedpicAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function departemen(){
        return $this->belongsTo(Departemen::class,'dep_code','dep_code');
    }
    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'pic', 'nik');
    }

     // Accessor to get related PIC names
     public function getRelatedPicNamesAttribute()
     {
         $relatedPicNiks = $this->relatedpic;
         $relatedPicNames = [];

         if ($relatedPicNiks) {
             $relatedPicNames = Karyawan::whereIn('nik', $relatedPicNiks)->pluck('nama', 'nik')->toArray();
         }

         return $relatedPicNames;
     }

}
