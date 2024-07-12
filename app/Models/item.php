<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo_id',
        'QrBarra',
        'marca',
        'unidadMedida',
        'ingredienteActivo',
        'presentacion',
        'contenido',
        'clasificacion_id',
        'categoria_id',
        'capacidad',
        'etiqueta',
        'stockMinimo',
        'observacion'
    ];
}
