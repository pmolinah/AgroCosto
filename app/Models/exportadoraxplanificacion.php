<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exportadoraxplanificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'planificacioncosecha_id',
        'empresa_id',
        'kilosSolicitados',
        'empresa_id',
        'cuentaenvase_id',
        'envasesUtilizadosReales',
        'KilosRecolectados',
    ];

    public function empresa(){
        return $this->belongsTo(empresa::class);
    }
    public function planificacioncosecha()
    {
        return $this->belongsTo(planificacioncosecha::class);
    }
    public function cuentaenvase(){
        return $this->belongsTo(cuentaenvase::class);
    }
    public function desgloseenvase(){
        return $this->hasMany(desgloseenvase::class);
    }
}
