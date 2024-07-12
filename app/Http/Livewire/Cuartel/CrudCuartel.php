<?php

namespace App\Http\Livewire\Cuartel;

use Livewire\Component;
use App\Models\cuartel;
use App\Models\empresa;
use App\Models\campo;
use App\Models\User;

class CrudCuartel extends Component
{
    public $campo_id='';
    public $empresaID,$campoID,$campoNombre,$capatazNombre,$capatazID,$codigoSag,$empresaIDUP,$campoIDUP;
    public $capataz_id,$observaciones,$superficie,$certificado;
    public $campos=array();
    public $cuarteles=array();
    public $cuartel=array();
    public $capatazEncargado=array();
    public $open_editCuartel=false;
    public $cuartel_id;


   public function SeleccionEmpresa(){
    $this->campos=campo::where('empresa_id',$this->empresaID)->get();
   }
    public function SeleccionCampo(){
        $this->cuarteles=cuartel::where('campo_id',$this->campoID)->get();
    }

    public function Limpiar(){

    }

    public function GuardarCuartel(){
        cuartel::create([
            'observaciones'=>$this->observaciones,
            'campo_id'=>$this->campo_id,
            'certificado'=>$this->certificado,
            'superficie'=>$this->superficie,
            'capataz_id'=>$this->capataz_id,
            'codigoSag'=>$this->codigoSag,
        ]);

        $this->cuarteles=cuartel::where('campo_id',$this->campo_id)->get();

        $this->dispatchBrowserEvent('GuardarCuartel', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);


    }

    public function EliminarCuartel($cuartell_id){
        cuartel::where('id',$cuartell_id)->delete();
        $this->dispatchBrowserEvent('EliminarCuartel', [
            'title' => 'Registro Elimkinado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
        $this->cuarteles=cuartel::where('campo_id',$this->campoID)->get();

    }

    public function EditarCuartel($cuarte_id){
        $this->cuarteles=cuartel::where('id',$cuarte_id)->get();
        foreach($this->cuarteles as $this->cuarteles){
            $this->campoID=$this->cuarteles->campo_id;
            $this->campoNombre=$this->cuarteles->campo->campo;
            $this->observaciones=$this->cuarteles->observaciones;
            $this->capatazNombre=$this->cuarteles->capataz->name;
            $this->capatazID=$this->cuarteles->capataz_id;
            $this->superficie=$this->cuarteles->superficie;
            $this->certificado=$this->cuarteles->certificado;
            $this->cuartel_id=$this->cuarteles->id;
            $this->empresaIDUP=$this->cuarteles->campo->empresa_id;
            $this->campo_id=$this->cuarteles->campo_id;
            $this->codigoSag=$this->cuarteles->codigoSag;
        }
        $this->capatazEncargado=User::where('tipo_id',2)->get();
        $this->cuarteles=cuartel::where('campo_id',$this->campoID)->get();
        $this->open_editCuartel=true;

    }

    public function cerrar(){
        $this->open_editCuartel=false;
    }

    public function ActualizarCuartel(){
        cuartel::where('id',$this->cuartel_id)->update(['observaciones'=>$this->observaciones,'campo_id'=>$this->campoID,'capataz_id'=>$this->capatazID,'superficie'=>$this->superficie,'certificado'=>$this->certificado,'codigoSag'=>$this->codigoSag]);
        $this->dispatchBrowserEvent('ActualizarCuartel', [
            'title' => 'Registro Actualizado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
        $this->reset(['superficie','observaciones','codigoSag']);
        $this->open_editCuartel=false;
        
    }

    public function render()
    {
        $empresas=empresa::where('tipo_id',1)->get();
        $capataz=User::where('tipo_id',2)->get();
        return view('livewire.cuartel.crud-cuartel',compact('empresas','capataz'));
    }
}
