<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalletemporadaexpo extends Model
{
    use HasFactory;

    protected $fillable = [
        'temporadaexpo_id',
        'color_id',
        'stock',
    ];

    public function temporadaexpo(){
        return $this->belongsTo(temporadaexpo::class);
    }
    public function color(){
        return $this->belongsTo(color::class);
    }
}
