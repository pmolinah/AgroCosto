<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class desgloseenvase extends Model
{
    use HasFactory;

    protected $fillable=[
        'exportadoraxplanificacion_id',
        'planificacioncosecha_id',
        'stock',
        'color_id',
        'tarjaEnvase',
        'guia_id',
    ];

   
    public function color(){
        return $this->belongsTo(color::class);
    }

    public function exportadoraxplanificacion(){
        return $this->belongsTo(empresa::class);
    }

    public function planificacioncosecha(){
        return $this->belongsTo(planificacioncosecha::class);
    }
    public function guia(){
        return $this->belongsTo(guia::class);
    }
}