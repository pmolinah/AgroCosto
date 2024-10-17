<?php

namespace App\Http\Livewire\Actividades;

use Livewire\Component;
use App\Models\tipocosto;
use App\Models\tipoactividad;
use App\Models\actividad;
class ParametrosActividades extends Component
{
    public $tipocoastos=[];
    public $tipoactividades=[];
    public $tipo,$referencia,$unidadMedida,$medida,$tipocosto_id;
    public function guardarTipo(){
        if($this->tipo==NULL || $this->referencia==NULL || $this->unidadMedida==NULL || $this->tipocosto_id==NULL){
            $this->dispatchBrowserEvent('ErrorFaltanDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
        tipoactividad::create([
            'tipo'=>$this->tipo,
            'unidadMedida'=>$this->unidadMedida,
            'medida'=>$this->medida,
            'referencia'=>$this->referencia,
            'tipocosto_id'=>$this->tipocosto_id,
        ]);
        $this->dispatchBrowserEvent('GuardadoCorrecto', [
            'title' => 'Error, Faltan Datos.',
            'icon'=>'error',
            'iconColor'=>'blue',
        ]);
        return back();
    }
    public function EliminarTipoActividad($id){
        $verificarForaneo=tipoactividad::where('id',$id)->first();
        if($verificarForaneo->actividad()->exists()){
            $this->dispatchBrowserEvent('ErrorTieneDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
    }
    public function render()
    {
        $this->tipocostos=tipocosto::all();
        $this->tipoactividades=tipoactividad::all();
        return view('livewire.actividades.parametros-actividades');
    }
}
