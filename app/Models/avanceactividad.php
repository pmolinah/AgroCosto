<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avanceactividad extends Model
{
    use HasFactory;
    protected $fillable =[
        'actividad_id',
        'costoactividad_id',
        'ejecutado',
        'restante',
        'fechaAvance',
        'valor',
    ];

    public function costoactividad(){
        return $this->belongsTo(costoactividad::class);
    }
}
