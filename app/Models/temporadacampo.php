<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temporadacampo extends Model
{
    use HasFactory;
    protected $fillable = [
        'envaseempresa_id',
        'campo_id',
        'envase_id',
        'stock',
    ];

    public function envaseempresa(){
        return $this->belongsTo(envaseempresa::class);
    }
    public function campo(){
        return $this->belongsTo(campo::class);
    }

    public function envase(){
        return $this->belongsTo(envase::class);
    }
    public function detalletemporadacampo(){
        return $this->hasMany(detalletemporadacampo::class);
    }
}
