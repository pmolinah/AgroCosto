<?php

namespace App\Http\Livewire\Parametros;

use Livewire\Component;
use App\Models\User;
class SelectEncargado extends Component
{
    public $selectedId = '';

    public function SelectEncargado(){
        $this->emit('SelectEncargadoId',$this->selectedId);
    }
   
    public function render()
    {
        $encargados=User::where('tipo_id',5)->get();
        return view('livewire.parametros.select-encargado',compact('encargados'));
    }
}
