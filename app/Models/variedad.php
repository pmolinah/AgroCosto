<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variedad extends Model
{
    use HasFactory;
    protected $fillable = [
        'variedad',
        'observacion',
       
    ];
}
