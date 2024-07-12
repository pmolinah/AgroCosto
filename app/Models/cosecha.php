<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cosecha extends Model
{
    use HasFactory;

    public function plantacion(){
        return $this->belongsTo(plantacion::class);
    }
}
