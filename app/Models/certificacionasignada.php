<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certificacionasignada extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificacion_id',
        'fechaInicio',
        'fechaTermino',
        'fechaExtencion',
        'fechaProrroga',
        'observacion',
        'rutaDocumento',
        'campo_id',
        'documento',
        'casaCertificadora',
        'alertaTempranaCaducidad',
    ];

    public function campo(){
        return $this->belongsTo(campo::class);
    }
    public function certificacion(){
        return $this->belongsTo(certificacion::class);
    }
    public function cuartel(){
        return $this->belongsTo(cuartel::class);
    }

}
