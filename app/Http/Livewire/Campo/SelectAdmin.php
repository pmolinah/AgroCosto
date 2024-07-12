<?php

namespace App\Http\Livewire\Campo;

use Livewire\Component;
use App\Models\User;

class SelectAdmin extends Component
{
    public $selectedOptionAdmin;

    public function SelectAdmin(){
        $this->emit('SelectAdminId',$this->selectedOptionAdmin);
    }
    public function render()
    {
        $administrador=User::where('tipo_id',1)->get();
        return view('livewire.campo.select-admin',compact('administrador'));
    }
}
