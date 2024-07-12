<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guiarecepcion extends Model
{
    use HasFactory;
protected $fillable =[
    'campo_id',
    'empresa_id',
    'numero',
    'fecha',
    'vehiculo_id',
    'conductor_id',
    'observacion',
    'emitida',
];

public function guiarecepciondetalle(){
    return $this->hasMany(guiarecepciondetalle::class);
}
public function campo(){
    return $this->belongsTo(campo::class);
}
public function empresa(){
    return $this->belongsTo(empresa::class);
}
public function conductor(){
    return $this->belongsTo(User::class);
}
public function vehiculo(){
    return $this->belongsTo(vehiculo::class);
}


}
