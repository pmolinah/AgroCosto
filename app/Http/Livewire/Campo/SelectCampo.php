<?php

namespace App\Http\Livewire\Campo;

use Livewire\Component;
use App\Models\campo;
use App\Models\comuna;
use App\Models\User;

class SelectCampo extends Component
{
    public $selectedId = '';
    public $open=false;
    public $selectedIdCampo,$SelectCampo;

    protected $listeners = ['selectedIdUpdated'];

    public function selectedIdUpdated($value)
    {
        $this->selectedId = $value;
    }
    
    public function render()
    {
        $campos=campo::with('cuartel')->where('empresa_id',$this->selectedId)->get();
        return view('livewire.campo.select-campo',compact('campos'));
    }

    public function create(){

    }
}
