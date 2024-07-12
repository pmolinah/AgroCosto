<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planestimada extends Model
{
    use HasFactory;

    protected $fillable = [
        'planificacionEstimada',
        'fechaInicio',
        'fechaFinal',
        'cumplida',
        'cantidad',
        'especie_id',
        'responsable_id',
        'campo_id',
        'cuartel_id',
        'KilosActuales',
    ];

    public function especie(){
        return $this->belongsTo(especie::class);
    }
    public function responsable(){
        return $this->belongsTo(User::class);
    }
    public function campo(){
        return $this->belongsTo(campo::class);
    }
    public function cuartel(){
        return $this->belongsTo(cuartel::class);
    }
}
