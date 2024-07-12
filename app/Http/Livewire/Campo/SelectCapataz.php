<?php

namespace App\Http\Livewire\Campo;

use Livewire\Component;
use App\Models\User;

class SelectCapataz extends Component
{
    public $selectedOptionCapataz;

    public function SelectCapataz(){
        $this->emit('SelectCapatazId',$this->selectedOptionCapataz);
    }
    
    public function render()
    {
        $capataz=User::where('tipo_id',2)->get();
        return view('livewire.campo.select-capataz',compact('capataz'));
    }
}
