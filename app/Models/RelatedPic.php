<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedPic extends Model
{
    use HasFactory;
    protected $table = 'relatedpic';
    protected $primaryKey = 'id_relatedpic';
    protected $fillable = [
        'nik',
        'nama',
    ];
}
