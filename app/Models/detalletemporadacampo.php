<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalletemporadacampo extends Model
{
    use HasFactory;
    protected $fillable=[
        'temporadacampo_id',
        'color_id',
        'stock',

    ];

    public function temporadacampo(){
        return $this->belongsTo(temporadacampo::class);
    }
    public function color(){
        return $this->belongsTo(color::class);
    }
}
