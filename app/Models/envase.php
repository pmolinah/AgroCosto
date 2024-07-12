<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class envase extends Model
{
    use HasFactory;

    protected $fillable = [
        'envase',
        'tara',
        'capacidad',
        'observacion',
        
    ];
}
