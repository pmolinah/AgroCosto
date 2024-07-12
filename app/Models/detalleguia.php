<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleguia extends Model
{
    use HasFactory;
    protected $fillable = [
        'guia_id',
        'planificacioncosecha_id',
        'especie_id',
        'kilos',
        'observacion',
        'color_id',
    ];
}
