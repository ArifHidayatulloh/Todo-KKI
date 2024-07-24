<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'todo';
    protected $guarded = ['id'];

    public function terminal(){
        return $this->belongsTo(Terminal::class,'terminal_code','terminal_code');
    }
    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'pic', 'nik');
    }
    
    public function relatedpic(){
        return $this->belongsTo(RelatedPic::class,'id_relatedpic','id_relatedpic');
    }

}
