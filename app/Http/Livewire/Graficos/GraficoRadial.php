<?php

namespace App\Http\Livewire\Graficos;

use Livewire\Component;
use App\Models\cuartel;
use App\Models\detallecosecha;
use Carbon\Carbon;
class GraficoRadial extends Component
{
    public $detalleSemanaCuartel=[];
    public $semanaEspecieCuartel;
    public $label = [];
    public $labels = [];
    public $data = [];
    public $f=0,$c=0;

    public function mount(){
        $this->numeroSemana = Carbon::now()->weekOfYear;
        $this->semanaEspecieCuartel=$this->numeroSemana;
    }

    public function KilosXSemanaCuartel(){
        $this->detalleSemanaCuartel=[];
        $this->f=0;
        $this->c=0;
        $cuarteles=cuartel::all();
        foreach($cuarteles as $cuartel){
            $suma=detallecosecha::whereRaw('WEEK(created_at) = ?', [$this->semanaEspecieCuartel])->where('cuartel_id', $cuartel->id)->sum('kilos');
            if($suma>0){
                $this->detalleSemanaCuartel[$this->f][0]=$cuartel->observaciones;
                $this->detalleSemanaCuartel[$this->f][1]=$suma;
                $this->f++;
            }     
        }
        $this->labels = [];
        $this->data = [];
        $conteo=count($this->detalleSemanaCuartel);
        for($i=0;$i<$conteo;$i++){
            $this->label[] = $this->detalleSemanaCuartel[$i][0];
            $this->labels[] = $this->detalleSemanaCuartel[$i][0];
            $this->data [] = $this->detalleSemanaCuartel[$i][1];
        }
       
        $this->emit('updateChartRadial', $this->labels, $this->data,  $this->label);
    }
    public function render()
    {
        return view('livewire.graficos.grafico-radial');
    }
}
