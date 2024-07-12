<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallegreso extends Model
{
    use HasFactory;
    protected $fillable=[
        'egresobodega_id',
        'bodega_id',
        'inventario_id',
        'tarea_id',
        // 'contenido',
        // 'contenidoTotal',
        // 'stock',
        'detalleEntrega',
        'costo',
    ];
    public function egresobodega(){
        return $this->belongsTo(egresobodega::class);
    }
    public function bodega(){
        return $this->belongsTo(bodega::class);
    }
    public function inventario(){
        return $this->belongsTo(inventario::class);
    }
}
