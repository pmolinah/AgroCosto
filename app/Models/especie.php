<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especie extends Model
{
    use HasFactory;

    public function variedad(){
        return $this->belongsTo(variedad::class);
    }

    protected $fillable = [
        'especie',
        'variedad_id',
        'metros2',
        'distanciaPlanta',
        'observacion',
        'fechaCosecha',
       
    ];

}
