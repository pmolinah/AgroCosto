<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class campo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'campo',
        'direccion',
        'comuna_id',
        'adm_id',
        'superficie',
        'empresa_id',
        'rut',
        'codigoSag',
    ];
    public function empresa(){
        return $this->belongsTo(empresa::class);
    }

    public function adm(){
        return $this->belongsTo(User::class);
    }


    public function cuartel(){
        return $this->hasMany(cuartel::class);
    }
   
    public function comuna(){
        return $this->belongsTo(comuna::class);
    }
    public function certificacionasignada(){

        return $this->hasMany(certificacionasignada::class);
    }
    public function devoluciontraspaso(){   
        return $this->hasMany(devoluciontraspaso::class, 'destino_id')->where('destino_type', 'campo');
    }
}
