<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallecuentaenvase extends Model
{
    use HasFactory;

    protected $fillable = [
        'cuentaenvase_id',
        'color_id',
        'stock',
    ];

    public function cuentaenvase(){
        return $this->belongsTo(cuentaenvase::class);
    }
    public function color(){
        return $this->belongsTo(color::class);
    }
}
