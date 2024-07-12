<?php

namespace App\Http\Livewire\Parametros;

use Livewire\Component;
use App\Models\empresa;
use App\Models\insumo;
use Livewire\WithPagination;
use App\Models\User;
class CrudProducto extends Component
{
    use WithPagination;

    public $insumo,$marca,$medida,$contenido,$proveedor_id,$costo,$tipo,$campoxinsumo,$campo_id,$campoId,$proveedor_nombre,$encargado_id,$observacion,$insumoEditar,$edit_id;
    public $campoinsumo=array();
    public $encargado=array();
    public $open_editInsumo=false;
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
        $this->reset(['insumo','observacion']);
        $this->open_editInsumo=false;
    }

    public function GuardarInsumo(){
        // $this->validate();
        insumo::create([
            'insumo'=>$this->insumo,
            'proveedor_id'=>$this->proveedor_id,
            'marca'=>$this->marca,
            'contenido'=>$this->contenido,
            'medida'=>$this->medida,
            'tipo'=>$this->tipo,
            'costo'=>$this->costo,
            'observacion'=>$this->observacion,
        ]);
        $this->reset(['insumo','observacion']);

        $this->dispatchBrowserEvent('Guardar', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EliminarInsumo($id){
        insumo::where('id',$id)->delete();
        $this->dispatchBrowserEvent('Eliminar', [
            'title' => 'Registro Eliminado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EditarInsumo($insumo){


        $this->campoinsumo=insumo::where('id',$insumo)->get();
        //$encargado=User::all();
        foreach($this->campoinsumo as $this->campoxinsumo)
        {
            $this->edit_idinsumo=$this->campoxinsumo->id;
            $this->proveedor_nombre=$this->campoxinsumo->proveedor->razon_social;
            $this->insumo=$this->campoxinsumo->insumo;
            $this->marca=$this->campoxinsumo->marca;
            $this->costo=$this->campoxinsumo->costo;
            $this->proveedor_id=$this->campoxinsumo->proveedor_id;
            $this->medida=$this->campoxinsumo->medida;
            $this->tipo=$this->campoxinsumo->tipo;
            $this->contenido=$this->campoxinsumo->contenido;
            $this->observacion=$this->campoxinsumo->observacion;

        }
        $this->open_editInsumo=true;
    }

    public function ActualizarInsumo(){
        insumo::where('id',$this->edit_idinsumo)->update(['insumo'=>$this->insumo,'marca'=>$this->marca,'proveedor_id'=>$this->proveedor_id,'observacion'=>$this->observacion,'costo'=>$this->costo,'tipo'=>$this->tipo,'medida'=>$this->medida,'contenido'=>$this->contenido]);
        $this->open_ediinsumo=false;
        $this->dispatchBrowserEvent('Actualizar', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
 
    }

    public function render()
    {
        $insumos=insumo::where('insumo','like','%'.$this->search.'%')->paginate(3);
        
        $empresas=empresa::where('tipo_id',2)->get();
        $encargados=User::where('tipo_id',5)->get();
        return view('livewire.parametros.crud-producto',compact('insumos','empresas','encargados'));
    }
}
