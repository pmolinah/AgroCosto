<?php

namespace App\Http\Livewire\Parametros;

use Livewire\Component;
use App\Models\especie;
use App\Models\variedad;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class CrudEspecie extends Component
{
   
    use WithPagination;
    
    public $especie,$observacion,$especieEditar,$edit_id;
    public $metros2,$distanciaPlanta,$variedad_id,$fechaCosecha;
    public $variedades_especie=array();
    public $especieDB=array();
    public $open_edit_especie=false;
    public $esp;
    public $search;

    protected $rules=[
        'especie.especie'=>'required',
        'especie.observacion'=>'required',
    ];

    public function Limpiar(){
        $this->reset(['especie','observacion']);
        $this->open_edit_especie=false;
    }
    
    public function GuardarEspecie(){
        // $this->validate();
        especie::create([
            'especie'=>$this->especie,
            'variedad_id'=>$this->variedad_id,
            'distanciaPlanta'=>$this->distanciaPlanta,
            'metros2'=>$this->metros2,
            'observacion'=>$this->observacion,
            'fechaCosecha'=>$this->fechaCosecha,
        ]);
        $this->reset(['especie','observacion','variedad_id','distanciaPlanta','metros2']);

        $this->dispatchBrowserEvent('GuardarEspecie', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }
    

    public function EliminarEspecie($id){
        especie::where('id',$id)->delete();
        $this->dispatchBrowserEvent('Eliminar', [
            'title' => 'Registro Eliminado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EditarEspecie($especie){

        $this->variedades_especie=variedad::all();
        $this->especieDB=especie::where('id',$especie)->get();
        foreach($this->especieDB as $this->esp)
        {
            $this->edit_id=$this->esp->id;
            $this->especie=$this->esp->especie;
            $this->observacion=$this->esp->observacion;
            $this->variedad_id=$this->esp->variedad_id;
            $this->metros2=$this->esp->metros2;
            $this->fechaCosecha=$this->esp->fechaCosecha;
            $this->distanciaPlanta=$this->esp->distanciaPlanta;

        }
        $this->open_edit_especie=true;
    }

    public function ActualizarEspecie(){
        especie::where('id',$this->edit_id)->update(['especie'=>$this->especie,'variedad_id'=>$this->variedad_id,'metros2'=>$this->metros2,'fechaCosecha'=>$this->fechaCosecha,'observacion'=>$this->observacion,'distanciaPlanta'=>$this->distanciaPlanta]);
        $this->open_edit_especie=false;
        $this->dispatchBrowserEvent('Actualizar', [
            'title' => 'Registro Actualizado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
        $this->reset(['especie','observacion']);
    }
    
    public function render()
    {
        $especies=especie::where('especie','like','%'.$this->search.'%')->paginate(3);
        $variedades=variedad::all();
        return view('livewire.parametros.crud-especie',compact('especies','variedades'));
    }
   
   
}
