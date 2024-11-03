<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movimiento extends Model
{
    use HasFactory;
    protected $fillable=[
        'cuenta_id',
        'empresa_id',
        'campo_id',
        'cuartel_id',
        'concepto_id',
        'tipo_id',
        'formapago_id',
        'fecha',
        'ndocumento',
        'estado',
        'importe',
        'cliente_id',
        'prorroteo',
        'montoProrroteo',
        
    ];
    public function cuenta(){
        return $this->belongsTo(cuenta::class);
    }
    public function concepto(){
        return $this->belongsTo(concepto::class);
    }
    public function cliente(){
        return $this->belongsTo(empresa::class);
    }
    public function detallemovimiento(){
        return $this->hasMany(detallemovimiento::class);
    }
}
