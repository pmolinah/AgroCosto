<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class desgloseenvasecampo extends Model
{
    use HasFactory;

    protected $fillable=[
        'envaseempresa_id',
        'color_id',
        'stock',

    ];

    public function envaseempresa(){
        return $this->belongsTo(envaseempresa::class);
    }
    public function color(){
        return $this->belongsTo(color::class);
    }
}
