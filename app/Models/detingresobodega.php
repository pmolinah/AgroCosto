<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detingresobodega extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingresobodega_id',
        'item_id',
        'cantidad',
        'precioUnitario',
        'vencimiento',
        'bodega_id',
        'presentacion',
        'contenido',
    ];

    public function ingresobodega(){
        return $this->belongsTo(ingresobodega::class);
    }
    public function item(){
        return $this->belongsTo(item::class);
    }
    public function bodega(){
        return $this->belongsTo(bodega::class);
    }
}
