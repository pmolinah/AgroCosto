<?php

namespace App\Http\Livewire\Parametros;

use Livewire\Component;
use App\Models\empresa;
use App\Models\tarea;
use Livewire\WithPagination;
use App\Models\User;

class CrudTarea extends Component
{
    use WithPagination;

    public $Tarea,$marca,$medida,$contenido,$proveedor_id,$costo,$tipo,$campoxTarea,$campo_id,$campoId,$proveedor_nombre,$encargado_id,$observacion,$TareaEditar,$edit_id;
    public $campoTarea=array();
    public $encargado=array();
    public $open_editTarea=false;
    public $search;
    public $selectedId;
    public $campos=array();
    public $empresa_id;

    protected $listeners=['SelectEncargadoId'];

    public function SelectEmpresaxCampo(){
        $this->campos=campo::where('empresa_id',$this->empresa_id)->get();
    }

    public function SelectEncargadoId($EncargadoId){

        $this->selectedId=$EncargadoId;
       }

    protected $rules=[
        'variedad.variedad'=>'required',
        'variedad.observacion'=>'required',
    ];

    public function Limpiar(){
        $this->reset(['Tarea','observacion']);
        $this->open_editTarea=false;
    }

    public function GuardarTarea(){
        // $this->validate();
        tarea::create([
            'tarea'=>$this->Tarea,
            'costo'=>$this->costo,
            // 'marca'=>$this->marca,
            // 'contenido'=>$this->contenido,
            // 'medida'=>$this->medida,
            // 'tipo'=>$this->tipo,
            // 'costo'=>$this->costo,
            'observacion'=>$this->observacion,
        ]);
        $this->reset(['Tarea','observacion']);

        $this->dispatchBrowserEvent('Guardar', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EliminarTarea($id){
        tarea::where('id',$id)->delete();
        $this->dispatchBrowserEvent('Eliminar', [
            'title' => 'Registro Eliminado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EditarTarea($Tarea){


        $this->campoTarea=tarea::where('id',$Tarea)->get();
        //$encargado=User::all();
        foreach($this->campoTarea as $this->campoxTarea)
        {
            $this->edit_idTarea=$this->campoxTarea->id;
        
            $this->Tarea=$this->campoxTarea->tarea;
        
            $this->costo=$this->campoxTarea->costo;
           
        
            $this->observacion=$this->campoxTarea->observacion;

        }
        $this->open_editTarea=true;
    }

    public function ActualizarTarea(){
        tarea::where('id',$this->edit_idTarea)->update(['Tarea'=>$this->Tarea,'costo'=>$this->costo,'observacion'=>$this->observacion]);
        $this->open_ediTarea=false;
        $this->dispatchBrowserEvent('Actualizar', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
 
    }

    public function render()
    {
        $Tareas=Tarea::where('Tarea','like','%'.$this->search.'%')->paginate(3);
        
        $empresas=empresa::where('tipo_id',2)->get();
        $encargados=User::where('tipo_id',5)->get();
        return view('livewire.parametros.crud-tarea',compact('Tareas','empresas','encargados'));
    }
}
