<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devoluciontraspasodetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'devoluciontraspaso_id',
        'envase_id',
        'color_id',
        'cantidadEnvases',
    ];
    public function devoluciontraspaso(){
        return $this->belongsTo(devoluciontraspaso::class);
    }
    public function envase(){
        return $this->belongsTo(envase::class);
    }
    public function color(){
        return $this->belongsTo(color::class);
    }
}
