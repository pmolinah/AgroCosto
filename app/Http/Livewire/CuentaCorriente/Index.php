<?php

namespace App\Http\Livewire\CuentaCorriente;

use Livewire\Component;
use App\Models\envase;
use App\Models\empresa;
use App\Models\cuentaenvase;
use App\Models\color;

class Index extends Component
{
    public $envase=array();
    public $envEdit=array();
    public $envase_id,$empresa_id,$saldo=0,$observacion;
    public $exportadoras;
    public $cuentaenvases;
    public $modal=false;
    public $exportadora,$envaseID,$envaseNombre,$cuentaID;
    public $CantidadEnvaseColor=array();
    public $coloresNombres=array();

    public function guardarEnvase(){
        dd($this->CantidadEnvaseColor);
        cuentaenvase::create([
            'empresa_id'=>$this->empresa_id,
            'envase_id'=>$this->envase_id,
            'observacion'=>$this->observacion,
            'saldo'=>$this->saldo,
        ]);

        $this->dispatchBrowserEvent('Guardar', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EliminarCuenta($cuenta_id){
       cuentaenvase::where('id',$cuenta_id)->delete();
       $this->dispatchBrowserEvent('EliminarCuenta', [
        'title' => 'Registro guardado correctamente.',
        'icon'=>'success',
        'iconColor'=>'blue',
        ]);
        $this->cuentaenvases=cuentaenvase::all();
    }

    public function EditarCuenta($cuenta_id){
        $this->envEdit=envase::all();
        $cuentas=cuentaenvase::where('id',$cuenta_id)->get();
        foreach($cuentas as $cuenta){
            $this->cuentaID=$cuenta->id;
            $this->exportadora=$cuenta->empresa->razon_social;
            $this->envaseID=$cuenta->envase_id;
            $this->envaseNombre=$cuenta->envase->envase;
            $this->saldo=$cuenta->saldo;
            $this->observacion=$cuenta->observacion;
        };
        $this->modal=true;
    }

    public function ActualizarCuenta($cuenta_id){

        cuentaenvase::where('id',$cuenta_id)->update(['saldo'=>$this->saldo,'observacion'=>$this->observacion,'envase_id'=>$this->envaseID]);
        $this->dispatchBrowserEvent('ActualizarCuenta', [
            'title' => 'Registro Actualizado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
            ]);
            $this->cuentaenvases=cuentaenvase::all();
            $this->modal=false;
    }
    
    public function render()
    {
        $this->envase=envase::all();
        $this->exportadoras=empresa::where('tipo_id',4)->get();
        $this->cuentaenvases=cuentaenvase::all();
        $colores=color::all();
        return view('livewire.cuenta-corriente.index',compact('colores'));
    }
}
