<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    use HasFactory;
    protected $table = 'terminal';
    protected $fillable = [
        'terminal_code',
        'nm_terminal'
    ];
}
