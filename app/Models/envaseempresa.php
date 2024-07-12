<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class envaseempresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'campo_id',
        'envase_id',
        'stock',
    ];

    public function campo(){
        return $this->belongsTo(campo::class);
    }

    public function envase(){
        return $this->belongsTo(envase::class);
    }

    public function desgloseenvasecampo(){
        return $this->hasMany(desgloseenvasecampo::class);
    }
    public function temporadacampo(){
        return $this->hasMany(temporadacampo::class);
    }
}
