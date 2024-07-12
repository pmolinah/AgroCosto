<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'campo_id',
        'cuartel_id',
        'responsable_id',
        'administrador_id',
        'observacion',
        'emitida',
    ];

    public function campo(){
        return $this->belongsTo(campo::class);
    }
    public function cuartel(){
        return $this->belongsTo(cuartel::class);
    }
    public function responsable(){
        return $this->belongsTo(user::class);
    }
    public function administrador(){
        return $this->belongsTo(user::class);
    }
    public function detalletarea(){
        return $this->hasMany(detalletarea::class);
    }
}
