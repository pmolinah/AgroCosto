<?php

namespace App\Http\Livewire\Campo;

use Livewire\Component;
use App\Models\empresa;
use App\Models\campo;

class CreateCampo extends Component
{
    public $empresa_id;
    public $contnombus;
    public $SearchCampos;
    public function render()
    {
        $contnombus=empresa::where('id',$this->empresa_id)->get();
        $contnomb=empresa::all();
        $campos=campo::where('empresa_id',$this->SearchCampos)->get();
        $this->emit('filtroxempresa',$campos->id);
        return view('livewire.campo.create-campo',compact('contnomb','contnombus','campos'));
    }
}
