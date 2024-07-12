<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guiarecepciondetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'guiarecepcion_id',
        'cantidadEnvase',
        'envase_id',
        'color_id',
        'observacion_id',
        'especie_id',
        'kilos',
    ];  

    public function guiarecepcion(){
        return $this->belongsTo(guiarecepcion::class);
    }
    public function envase(){
        return $this->belongsTo(envase::class);
    }
    public function color(){
        return $this->belongsTo(color::class);
    }
    public function especie(){
        return $this->belongsTo(especie::class);
    }
    public function observacion(){
        return $this->belongsTo(observacion::class);
    }

}
