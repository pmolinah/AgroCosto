<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class insumo extends Model
{
    use HasFactory;

    protected $fillable = [
        'insumo',
        'proveedor_id',
        'marca',
        'tipo',
        'contenido',
        'medida',
        'observacion',
        'costo',
    ];

    public function proveedor(){
        return $this->belongsTo(empresa::class);
    }
}
