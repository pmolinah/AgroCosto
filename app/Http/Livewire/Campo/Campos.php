<?php

namespace App\Http\Livewire\Campo;

use Livewire\Component;
use App\Models\campo;

class Campos extends Component
{
    public $selectedId = '';

    protected $listeners = ['selectedIdUpdated'];

    public function selectedIdUpdated($value)
    {
        $this->selectedId = $value;
    }

    public function render()
    {
         $campos=campo::with('cuartel')->where('empresa_id',$this->selectedId)->get();
        return view('livewire.campo.campos',compact('campos'));
    }

 
}
