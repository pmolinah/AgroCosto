<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class egresobodega extends Model
{
    use HasFactory;
    protected $fillable=[
        'bodeguero_id',
        'solicitante_id',
        'fecha',
        'tarea_id',
        'observacion',
        'numero',
        'emitida',
    ];
    public function bodeguero(){
        return $this->belongsTo(user::class);
    }
    public function solicitante(){
        return $this->belongsTo(user::class);
    }
    public function detallegreso(){
        return $this->hasMany(detallegreso::class);
    }
}
