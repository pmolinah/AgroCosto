<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuartel extends Model
{
    use HasFactory;

     
    protected $fillable = [
        'campo_id',
        'superficie',
        'observaciones',
        'capataz_id',
        'superficie',
        'certificado',
        'codigoSag',
    ];

    public function campo(){
        return $this->belongsTo(campo::class);
    }

    public function plantacion(){
        return $this->hasMany(plantacion::class);
    }

    public function capataz(){
        return $this->belongsTo(User::class);
    }
    public function certificacionasignadacuartel(){

        return $this->hasMany(certificacionasignadacuartel::class);
    }

}
