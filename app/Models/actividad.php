<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actividad extends Model
{
    use HasFactory;
    protected $fillable=[
        'ejecutor_id',
        'observacion',
        'lugar_id',
        'fechai',
        'fechat',
        'dias',
        'responsable_id',
        'avances',
        'costo',
        'estado',
    ];

    public function ejecutor(){
        return $this->belongsTo(empresa::class);
    }
    public function lugar(){
        return $this->belongsTo(cuartel::class);
    }
}
