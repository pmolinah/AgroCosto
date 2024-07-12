<?php

namespace App\Http\Livewire\Graficos;

use Livewire\Component;
use App\Models\campo;
use App\Models\detallecosecha;
class GraficoTorta extends Component
{
    public $detalleSemanaCampo=[];
    public $semanaEspecieCampo;
    public $label = [];
    public $labels = [];
    public $data = [];
    public $f=0,$c=0;

    public function KilosXSemanaCampo(){
        $this->detalleSemanaCampo=[];
        $this->f=0;
        $this->c=0;
        $campos=campo::all();
        foreach($campos as $campo){
            $suma=detallecosecha::whereRaw('WEEK(created_at) = ?', [$this->semanaEspecieCampo])->where('campo_id', $campo->id)->sum('kilos');
            if($suma>0){
                $this->detalleSemanaCampo[$this->f][0]=$campo->campo;
                $this->detalleSemanaCampo[$this->f][1]=$suma;
                $this->f++;
            }     
        }
        $this->labels = [];
        $this->data = [];
        $conteo=count($this->detalleSemanaCampo);
        for($i=0;$i<$conteo;$i++){
            $this->label[] = $this->detalleSemanaCampo[$i][0];
            $this->labels[] = $this->detalleSemanaCampo[$i][0];
            $this->data [] = $this->detalleSemanaCampo[$i][1];
        }
       
        $this->emit('updateChartPie', $this->labels, $this->data,  $this->label);
    }
    
    public function render()
    {
        return view('livewire.graficos.grafico-torta');
    }
}
