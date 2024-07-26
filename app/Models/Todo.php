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

    public function relatedPic1(){
        return $this->belongsTo(RelatedPic::class, 'id_relatedpic1', 'id_relatedpic');
    }

    public function relatedPic2(){
        return $this->belongsTo(RelatedPic::class, 'id_relatedpic2', 'id_relatedpic');
    }

    public function relatedPic3(){
        return $this->belongsTo(RelatedPic::class, 'id_relatedpic3', 'id_relatedpic');
    }


}
