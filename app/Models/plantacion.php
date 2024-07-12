<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plantacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'especie_id',
        'cuartel_id',
        'cantidadPlantas',
        'fechaPlantacion',
        'contratista_id',
        'cantidadPlantada',
        'observacion',
        'pivote',
    ];

    public function cuartel(){
        return $this->belongsTo(cuartel::class);
    }

    public function especie(){
        return $this->belongsTo(especie::class);
    }

}
