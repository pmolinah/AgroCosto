<?php

namespace App\Http\Livewire\Parametros;
use Livewire\Component;
use App\Models\variedad;
use App\Models\envase;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Session;

class CrudEnvase extends Component
{
    use WithPagination;
    
    public $envase,$tara,$capacidad,$observacion,$envaseEditar,$edit_id;
    public $open_editEnvase=false;
    public $search;

    protected $rules=[
        'variedad.variedad'=>'required',
        'variedad.observacion'=>'required',
    ];

    public function Limpiar(){
        $this->reset(['envase','observacion']);
        $this->open_editEnvase=false;
    }
    
    public function GuardarEnvase(){
        // $this->validate();
        envase::create([
            'envase'=>$this->envase,
            'tara'=>$this->tara,
            'capacidad'=>$this->capacidad,
            'observacion'=>$this->observacion,
        ]);
        $this->reset(['envase','tara','capacidad','observacion']);

        $this->dispatchBrowserEvent('Guardar', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EliminarEnvase($id){
        envase::where('id',$id)->delete();
        $this->dispatchBrowserEvent('Eliminar', [
            'title' => 'Registro Eliminado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EditarEnvase(envase $envase){
        $this->envase=$envase->envase;
        $this->tara=$envase->tara;
        $this->capacidad=$envase->capacidad;
        $this->observacion=$envase->observacion;
        $this->edit_idEnvase=$envase->id;
        $this->open_editEnvase=true;
    }

    public function ActualizarEnvase(){
        envase::where('id',$this->edit_idEnvase)->update(['envase'=>$this->envase,'tara'=>$this->tara,'capacidad'=>$this->capacidad,'observacion'=>$this->observacion]);
        $this->open_editEnvase=false;
        $this->dispatchBrowserEvent('Actualizar', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
        $this->reset(['envase','tara','capacidad','observacion']);
    }
    
    public function render()
    {
        $envases=envase::where('envase','like','%'.$this->search.'%')->paginate(3);
        return view('livewire.parametros.crud-envase',compact('envases'));
    }
}
