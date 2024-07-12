<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bodega extends Model
{
    use HasFactory;

    protected $fillable = [
        'campo_id',
        'encargado_id',
        'observacion',
        'bodega',
       
    ];

    public function campo(){
        return $this->belongsTo(campo::class);
    }
}
