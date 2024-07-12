<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aplicaciontarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'detalletarea_id',
        'dosificador_id',
        'aplicador_id',
        'fecha',
    ];

    public function aplicador(){
        return $this->belongsTo(user::class);
    }
    public function dosificador(){
        return $this->belongsTo(user::class);
    }
    public function detalletarea(){
        return $this->belongsTo(detalletarea::class);
    }
    
}
