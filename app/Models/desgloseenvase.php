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
    ];

   
    public function color(){
        return $this->belongsTo(color::class);
    }

    public function exportadoraxplanificacion(){
        return $this->belongsTo(exportadoraxplanificacion::class);
    }

    public function planificacioncosecha(){
        return $this->belongsTo(planificacioncosecha::class);
    }
}
