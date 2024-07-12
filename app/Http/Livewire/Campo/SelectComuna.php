<?php

namespace App\Http\Livewire\Campo;

use Livewire\Component;
use App\Models\comuna;

class SelectComuna extends Component
{
    public $selectedId;
    public $comuna_id,$selectedOptionComuna;
    public $comuna=array();

   
   public function SelectComuna(){
        $this->emit('SelectComunaId',$this->selectedOptionComuna);
        
   }



    
    public function render()
    {
        $this->comuna=comuna::all();
        $comunas=$this->comuna;
        return view('livewire.campo.select-comuna',compact('comunas'));
     
    }

    

       
}
