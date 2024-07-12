<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temporadaexpo extends Model
{
    use HasFactory;
    protected $fillable=[
        'cuentaenvase_id',
        'empresa_id',
        'envase_id',
        'observacion',
        'saldo',
        'campo_id',
    ];

    public function empresa(){
        return $this->belongsTo(empresa::class);
    }
    public function cuentaenvase(){
        return $this->belongsTo(cuentaenvase::class);
    }
    public function detalletemporadaexpo(){
        return $this->hasMany(detalletemporadaexpo::class);
    }
}
