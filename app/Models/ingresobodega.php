<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingresobodega extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'tipoDocumento_id',
        'proveedor_id',
        'numero',
        'campo_id',
        'total',
        'pivote',
        'observacion',
    ];

    public function detingresobodega(){
        return $this->hasMany(detingresobodega::class);
    }
    public function proveedor(){
        return $this->belongsTo(empresa::class);
    }
    public function campo(){
        return $this->belongsTo(campo::class);
    }
}
