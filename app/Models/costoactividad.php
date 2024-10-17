<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costoactividad extends Model
{
    use HasFactory;
    protected $fillable = [
        'actividad_id',
        'costo',
        'tipoactividad_id',
        'cantidad',
        'costoUnidad',
        'avance',
        'tipocosto_id',
        'pivote',
    ];

    public function tipoactividad(){
        return $this->belongsTo(tipoactividad::class);
    }

    public function avanceactividad(){
        return $this->hasMany(avanceactividad::class);
    }
}
