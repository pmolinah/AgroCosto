<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoactividad extends Model
{
    use HasFactory;
    protected $fillable =[
        'tipo',
        'unidadMedida',
        'medida',
        'referencia',
        'tipocosto_id'
    ];

    public function tipocosto(){
        return $this->belongsto(tipocosto::class);

    }
}
