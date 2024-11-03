<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historico extends Model
{
    use HasFactory;
    protected $fillable=[
        'cuenta_id',
        'saldo_inicial',
        'saldo_real',
        'fecha',
    ];
    public function cuenta(){
        return $this->belongsTo(cuenta::class);
    }
}
