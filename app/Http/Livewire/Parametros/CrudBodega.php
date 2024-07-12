<?php

namespace App\Http\Livewire\Parametros;
use Livewire\Component;
use App\Models\variedad;
use App\Models\envase;
use Livewire\WithPagination;
use App\Models\bodega;
use App\Models\empresa;
use App\Models\campo;
use App\Models\User;
use App\Models\item;
use App\Models\inventario;
use Illuminate\Support\Facades\Session;
use Livewire\WithFileUploads;
class CrudBodega extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $bodega,$campoxbodega,$campo_id,$campoId,$campo_nombre,$encargado_id,$observacion,$bodegaEditar,$edit_id;
    public $campoBodega=array();
    public $campoLista=[];
    public $encargado=array();
    public $open_editBodega=false;
    public $search;
    public $selectedId;
    public $campos=array();
    public $empresa_id;
    public $nombre,$QrBarra,$marca,$ingredienteActivo,$etiqueta;
    public int $tipo_id,$clasificacion_id,$categoria_id,$unidadMedida,$stockMinimo;
    public float $presentacion,$contenido,$capacidad;


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
        $this->reset(['bodega','observacion']);
        $this->open_editBodega=false;
    }

    public function GuardarBodega(){
        // $this->validate();
        bodega::create([
            'bodega'=>$this->bodega,
            'campo_id'=>$this->campo_id,
            'encargado_id'=>$this->encargado_id,
            'observacion'=>$this->observacion,
        ]);
        $this->reset(['bodega','observacion']);

        $this->dispatchBrowserEvent('Guardar', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EliminarBodega($id){
        bodega::where('id',$id)->delete();
        $this->dispatchBrowserEvent('Eliminar', [
            'title' => 'Registro Eliminado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EliminarItem($id){
        item::where('id',$id)->delete();
        $this->dispatchBrowserEvent('Eliminar', [
            'title' => 'Registro Eliminado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EditarBodega($bodega){


        $this->campoBodega=bodega::where('id',$bodega)->get();
        //$encargado=User::all();
        foreach($this->campoBodega as $this->campoxbodega)
        {
            $this->edit_idBodega=$this->campoxbodega->id;
            $this->bodega=$this->campoxbodega->bodega;
            $this->campoId=$this->campoxbodega->campo_id;
            $this->campo_nombre=$this->campoxbodega->campo->campo;
            $this->encargado_id=$this->campoxbodega->encargado_id;
            $this->observacion=$this->campoxbodega->observacion;

        }
        $this->open_editBodega=true;
    }

    public function ActualizarBodega(){
        bodega::where('id',$this->edit_idBodega)->update(['bodega'=>$this->bodega,'campo_id'=>$this->campo_id,'encargado_id'=>$this->encargado_id,'observacion'=>$this->observacion]);
        $this->open_ediBodega=false;
        $this->dispatchBrowserEvent('Actualizar', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }
    public function SeleccionPropietario(){
        $this->campoLista=campo::where('empresa_id',$this->empresa_id)->get();
    }
    public function render()
    {
        $bodegas=bodega::where('bodega','like','%'.$this->search.'%')->paginate(2);
        $items=item::paginate(2);
        $empresas=empresa::where('tipo_id',1)->get();
        $encargados=User::where('tipo_id',5)->get();
        $inventarios =inventario::select('item_id', 'bodega_id', \DB::raw('MAX(stockMinimo) as stockMinimo'), \DB::raw('SUM(cantidad) as suma_cantidad'))
        ->groupBy('item_id', 'bodega_id')
        ->get();
    
        return view('livewire.parametros.crud-bodega',compact('bodegas','empresas','encargados','items','inventarios'));
    }
}
