<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\campo;
use App\Models\empresa;
class devoluciontraspaso extends Model
{
    use HasFactory;

    protected $fillable = [
        'campo_id',
        'destino_id',
        'destino_type',
        'fecha',
        'conductor_id',
        'vehiculo_id',
        'tipo',
        'observacion',
        'numero',
        'emitida',
        'NombreDestino',
    ];

    public function campo()
    {
        return $this->belongsTo(campo::class);
    }
    public function destino()
    {
        return $this->morphTo('destino');
    }
    public function devoluciontraspasodetalle(){
        return $this->hasMany(devoluciontraspasodetalle::class);
    }

    public function obtenerNombreDestino()
    {
        $destino = $this->destino;

        if ($destino instanceof empresa) {
            return $destino->razon_social;
        } elseif ($destino instanceof campo) {
            return $destino->campo; 
        }

        return 'Sin Nombre'; // Maneja otros casos según tu lógica de negocio
    }

    public function conductor(){
        return $this->belongsTo(User::class);
    }
    public function vehiculo(){
        return $this->belongsTo(vehiculo::class);
    }



}
