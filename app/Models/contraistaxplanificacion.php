<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contraistaxplanificacion extends Model
{
    use HasFactory;

    protected $fillable=[
        'planificacioncosecha_id',
        'contratista_id',
        'tratoxcosecha',
    ];

    public function planificacioncosecha()
    {
        return $this->belongsTo(planificacioncosecha::class);
    }
    public function contratista(){
        return $this->belongsTo(empresa::class);
    }
    
}
