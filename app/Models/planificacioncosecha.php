<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planificacioncosecha extends Model
{
    use HasFactory;

    protected $fillable=[
        'fechai',
        'fechaf',
        'kilos',
        'envase_id',
        'cuartel_id',
        'plantacion_id',
    ];

  
    public function cuartel(){
        return $this->belongsTo(cuartel::class);
    }
    public function plantacion(){
        return $this->belongsTo(plantacion::class);
    }
 
    public function contraistaxplanificacion()
    {
        return $this->hasMany(contraistaxplanificacion::class);
    }

    public function exportadoraxplanificacion()
    {
        return $this->hasMany(exportadoraxplanificacion::class);
    }
    public function detallecosecha()
    {
        return $this->hasMany(detallecosecha::class);
    }

    public function envase(){
        return $this->belongsTo(envase::class);
    }
}
