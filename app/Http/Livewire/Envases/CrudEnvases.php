<?php

namespace App\Http\Livewire\Envases;

use Livewire\Component;
use App\Models\envase;
use App\Models\empresa;
use App\Models\campo;
use App\Models\envaseempresa;
use Livewire\WithPagination;




class CrudEnvases extends Component
{
    use WithPagination;
    public $campo_id,$campoID;
    public $campo_id_aux;
    public $envase_id;
    public $stock;
    public $modal=false;
    public $envaseNom,$empresaNom,$enID,$caID;

    
    public function agregarEnvase(){
        envaseempresa::create([
            'campo_id'=>$this->campoID,
            'envase_id'=>$this->envase_id,
            'stock'=>$this->stock,
        ]);

        $this->dispatchBrowserEvent('GuardarEmnvaseEmpresa', [
            'title' => 'Registro Guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
        
    }

    public function EliminarCuentaEmpresa($camp,$envas){
 
        envaseempresa::where('campo_id',$camp)->where('envase_id',$envas)->delete();
        $this->dispatchBrowserEvent('EliminarEmnvaseEmpresa', [
            'title' => 'Registro Elimimado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);

        $envase_campo=envaseempresa::where('campo_id',$this->campo_id)->get();
    }

    public function cambioCampo(){
           $this->campo_id_aux=$this->campo_id;
           $campo_nom=campo::where('id',$this->campo_id_aux)->get();
           foreach($campo_nom as $nom){
                $this->campo_id_aux=$nom->campo;
                $this->campoID=$nom->id;
           }
           $envase_campo=envaseempresa::where('campo_id',$this->campo_id)->get();

    }

    public function EditarCuentaEmpresa($campo_ID,$envase_ID){
        $cuentaempresa=envaseempresa::where('campo_id',$campo_ID)->where('envase_id',$envase_ID)->get();
     

        foreach($cuentaempresa as $cee){
            $this->envaseNom=$cee->envase->envase;
            $this->empresaNom=$cee->campo->empresa->razon_social;
            $this->stock=$cee->stock;
            $this->enID=$cee->envase_id;
            $this->caID=$cee->campo_id;
        }
        $this->modal=true;
    }

    public function ActualizarCuentaEmpresa($campo_ID,$envase_ID){
        envaseempresa::where('campo_id',$campo_ID)->where('envase_id',$envase_ID)->update(['stock'=>$this->stock]);
        $this->dispatchBrowserEvent('ActualizarEnvaseEmpresa', [
            'title' => 'Registro Elimimado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
        $cuentaempresa=envaseempresa::where('campo_id',$campo_ID)->where('envase_id',$envase_ID)->get();
    }

    public function Limpiar(){
        $this->modal=false;
        $this->reset=(['caID','enID','stock']);
    }
     

  
    public function render()
    {
     
        $envase=envase::all();
        $envase_campo=envaseempresa::where('campo_id',$this->campo_id)->paginate(5);
        $empresas=empresa::where('tipo_id',1)->get();
        return view('livewire.envases.crud-envases',compact('envase','envase_campo','empresas'));
    }
}
