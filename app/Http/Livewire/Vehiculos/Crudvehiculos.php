<?php

namespace App\Http\Livewire\Vehiculos;

use Livewire\Component;
use App\Models\vehiculo;
use App\Models\User;
use App\Models\empresa;
use Illuminate\Support\Facades\Session;

class Crudvehiculos extends Component
{
    public $patente,$tipovehiculo_id,$empresa_id,$conductor_id,$color,$observacion,$marca,$anio;
    public $open_modal=false;

    public function nuevoVehiculo(){
        $this->open_modal=true;
    }
   public function SaveVehiculo(){
        
        vehiculo::create([
            'patente'=>$this->patente,
            'tipovehiculo_id'=>$this->tipovehiculo_id,
            'empresa_id'=>$this->empresa_id,
            'conductor_id'=>$this->conductor_id,
            'color'=>$this->color,
            'observacion'=>$this->observacion,
            'marca'=>$this->marca,
            'anio'=>$this->anio,
            
        ]);
        // Session::flash('success', 'Vehiculo Guardado con exito...');
        // return redirect()->route('Vehiculos.index');

   }
    
    public function render()
    {
        $conductores=User::where('tipo_id',6)->get();
        $vehiculos=vehiculo::all();
        $empresas=empresa::all();
        return view('livewire.vehiculos.crudvehiculos',compact('vehiculos','conductores','empresas'));
    }
}
