<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuenta extends Model
{
    use HasFactory;
    protected $fillable =[
        'banco_id',
        'cuenta',
        'saldo_inicial',
        'saldo_real',
    ];
    public function banco(){
        return $this->belongsTo(banco::class);
    }
}
