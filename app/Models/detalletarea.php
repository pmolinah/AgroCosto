<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalletarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'tarea_id',
        'item_id',
        'cuartel_id',
        'estado',
        'objetivo',
        'dosis',
        'fechai',
        'fechaf',
        'diasentreAplicacion',
        'fechasAplicacion',
        'reingreso',
        'mojamiento',
        'equipo_id',
        'carencia',
    ];

    public function tarea(){
        return $this->belongsTo(tarea::class);
    }
    public function item(){
        return $this->belongsTo(item::class);
    }
    public function equipo(){
        return $this->belongsTo(item::class);
    }
    public function cuartel(){
        return $this->belongsTo(cuartel::class);
    }
    public function aplicaciontarea(){
        return $this->hasMany(aplicaciontarea::class);
    }
}
