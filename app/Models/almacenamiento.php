<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class almacenamiento extends Model
{
    use HasFactory;
    protected $fillable = [
        'planificacioncosecha_id',
        'empresa_id',
        'tarjaenvase',
        'kilos',
        'bodega_id',
        'pivote',
        'campo_id',
        'especie_id',
        'cuartel_id',
        'color_id',
        'fechaCosecha',
        'fechaSalida',
    ];

    public function planificacioncosecha(){
        return $this->belongsTo(planificacioncosecha::class);
    }
    public function color(){
        return $this->belongsTo(color::class);
    }
    public function empresa(){
        return $this->belongsTo(empresa::class);
    }
    public function bodega(){
        return $this->belongsTo(bodega::class);
    }

    public function especie(){
        return $this->belongsTo(especie::class);
    }
}
