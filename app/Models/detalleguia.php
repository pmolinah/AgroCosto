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
        'tarjaenvase',
        'almacenamiento_id',
    ];
    public function guia(){
        return $this->belongsTo(guia::class);
    }
    public function planificacioncosecha(){
        return $this->belongsTo(planificacioncosecha::class);
    }
    public function almacenamiento(){
        return $this->belongsTo(almacenamiento::class);
    }
    public function especie(){
        return $this->belongsTo(especie::class);
    }
}


