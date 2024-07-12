<?php

namespace App\Http\Livewire\Graficos;

use Livewire\Component;
use App\Models\especie;
use App\Models\detallecosecha;
use App\Models\planestimada;
use Carbon\Carbon;
class EspecieXanio extends Component
{
    public $estimadoEspecie=[];
    public $i=0;
    
    public function render()
    {
        $anioActual = Carbon::now()->year;
        $especies=especie::all();
        foreach($especies as $especie){
            $sumarEstimado=planestimada::where('especie_id',$especie->id)->whereYear('fechaInicio',$anioActual)->sum('cantidad');
            $sumaKilosCosechados=detallecosecha::where('especie_id',$especie->id)->whereYear('created_at',$anioActual)->sum('kilos');
            $this->estimadoEspecie[$this->i][0]=$especie->especie;
            $this->estimadoEspecie[$this->i][1]=$sumarEstimado;
            $this->estimadoEspecie[$this->i][2]=$sumaKilosCosechados;
            $this->estimadoEspecie[$this->i][3]=$especie->id;
            $this->i++;
        }

        $especies=especie::all();
        return view('livewire.graficos.especie-xanio',compact('especies'))->with('Estimado',$this->estimadoEspecie);
    }
}
