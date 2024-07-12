<?php

namespace App\Http\Livewire\AdministracionVehiculos;

use Livewire\Component;
use App\Models\vehiculo;
use App\Models\User;
use App\Models\empresa;
use Illuminate\Support\Facades\Session;

class Administracionvehiculos extends Component
{
    public $patente,$tipovehiculo_id,$empresa_id,$conductor_id,$color,$observacion,$marca,$anio,$vehID;
    public $open_modal=false;
    public $btnGuardar=false;
    public $btnActualizar=false;

    public function IngresarVehiculo(){
        $this->btnGuardar=true;
        $this->open_modal=true;
        $this->btnActualizar=false;
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
        Session::flash('success', 'Vehiculo Guardado con exito...');
        return redirect()->route('Vehiculos.index');
    }
    public function MostrarActualizar($id){
        $this->open_modal=true;
        $this->btnActualizar=true;
        $this->btnGuardar=false;
        $vehiculo=vehiculo::where('id',$id)->get();
        foreach($vehiculo as $vehiculo){
            $this->patente=$vehiculo->patente;
            $this->tipovehiculo_id=$vehiculo->tipovehiculo_id;
            $this->empresa_id=$vehiculo->empresa_id;
            $this->conductor_id=$vehiculo->conductor_id;
            $this->color=$vehiculo->color;
            $this->observacion=$vehiculo->observacion;
            $this->marca=$vehiculo->marca;
            $this->anio=$vehiculo->anio;
            $this->vehID=$vehiculo->id;
        }
    }
    public function ActualizarVehiculo(){
        vehiculo::where('id',$this->vehID)->update(['patente'=>$this->patente,'tipovehiculo_id'=>$this->tipovehiculo_id,'empresa_id'=>$this->empresa_id,'conductor_id'=>$this->conductor_id,'color'=>$this->color,'observacion'=>$this->observacion,'marca'=>$this->marca,'anio'=>$this->anio]);
        Session::flash('success', 'Vehiculo Actualizado con exito...');
        return redirect()->route('Vehiculos.index');
    }

    public function EliminarRegistro($id){
        $vehiculo=vehiculo::where('id',$id)->delete();
        Session::flash('error', 'Vehiculo eliminado con exito...');
        return redirect()->route('Vehiculos.index');
    }
    
    public function render()
    {
        $conductores=User::where('tipo_id',6)->get();
        $vehiculos=vehiculo::all();
        $empresas=empresa::all();
        return view('livewire.administracion-vehiculos.administracionvehiculos',compact('vehiculos','conductores','empresas'));
    }
}
