<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certificacionasignadacuartel extends Model
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
        'cuartel_id',
        'documento',
        'casaCertificadora',
        'alertaTempranaCaducidad',
        'codigoCertificacion',
    ];

    public function certificacion(){
        return $this->belongsTo(certificacion::class);
    }
    public function cuartel(){
        return $this->belongsTo(cuartel::class);
    }
}
