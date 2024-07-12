<?php

namespace App\Http\Livewire\Parametros;

use Livewire\Component;
use App\Models\variedad;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;


class CrudVariedad extends Component
{
    use WithPagination;
    
    public $variedad,$observacion,$variedadEditar,$edit_id;
    public $open_edit=false;
    public $search;

    protected $rules=[
        'variedad.variedad'=>'required',
        'variedad.observacion'=>'required',
    ];

    public function Limpiar(){
        $this->reset(['variedad','observacion']);
        $this->open_edit=false;
    }
    
    public function GuardarVariedad(){
        // $this->validate();
    
        variedad::create([
            'variedad'=>$this->variedad,
            'observacion'=>$this->observacion,
        ]);
        $this->reset(['variedad','observacion']);

        $this->dispatchBrowserEvent('Guardar', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EliminarVariedad($id){
        variedad::where('id',$id)->delete();
        $this->dispatchBrowserEvent('Eliminar', [
            'title' => 'Registro Eliminado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EditarVariedad(variedad $variedad){
        $this->variedad=$variedad->variedad;
        $this->observacion=$variedad->observacion;
        $this->edit_id=$variedad->id;
        $this->open_edit=true;
    }

    public function ActualizarVariedad(){
        variedad::where('id',$this->edit_id)->update(['variedad'=>$this->variedad,'observacion'=>$this->observacion]);
        $this->open_edit=false;
        $this->dispatchBrowserEvent('Actualizar', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
        $this->reset(['variedad','observacion']);
        $this->open_edit=false;
        
    }
    
    public function render()
    {
        $variedades=variedad::where('variedad','like','%'.$this->search.'%')->paginate(3);
        return view('livewire.parametros.crud-variedad',compact('variedades'));
    }
}
