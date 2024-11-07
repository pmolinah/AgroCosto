<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallemovimiento extends Model
{
    use HasFactory;

    protected $fillable=[
        'item_id',
        'movimiento_id',
        'cantidad',
        'precio',
        'presentacion',
        'bodega_id',
        'contenido',
        'vencimiento',
        'lineaInventario_id'
    ];
    public function item(){
        return $this->belongsTo(item::class);
    }
    public function bodega(){
        return $this->belongsTo(bodega::class);
    }
}
