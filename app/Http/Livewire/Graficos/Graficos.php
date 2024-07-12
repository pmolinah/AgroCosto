<?php

namespace App\Http\Livewire\Graficos;

use App\Models\User;
use App\Models\especie;
use App\Models\campo;
use App\Models\detallecosecha;
use Carbon\Carbon;
use Livewire\Component;


class Graficos extends Component
{
    public $campoEspecie;
    public $especieEspecie;
    public $semanaEspecie;
    public $labels = [];
    public $label = [];
    public $data = [];
    public $f=0,$c=0;
    public $detalleEspecieSemanados=[];
    public $detalleEspecieSemanatres=[];
    public $detalleEspecieSemana=[];
    public $numeroSemana;
    public $datasets;
    
    public function mount(){
        $this->numeroSemana = Carbon::now()->weekOfYear;
        $this->semanaEspecie=$this->numeroSemana;
    }
    
    public function KilosXSemanaCampo(){
        $this->detalleEspecieSemana = [];
        $this->f = 0;
        $this->c = 0;
        $especies = especie::all();
        foreach ($especies as $especie) {
            $suma = detallecosecha::whereRaw('WEEK(created_at) = ?', [$this->semanaEspecie])
                ->where('especie_id', $especie->id)
                ->sum('kilos');
            if ($suma > 0) {
                $this->detalleEspecieSemana[$this->f]['especie'] = $especie->especie;
                $this->detalleEspecieSemana[$this->f]['kilos'] = $suma;
                $this->f++;
            }
        }
    
        $this->labels = [];
        $this->datasets = [];
        $legendLabels = [];
    
        foreach ($this->detalleEspecieSemana as $detalle) {
            $this->labels[] = $detalle['especie'];
            $legendLabels[] = $detalle['especie'];
            $this->datasets[] = $detalle['kilos'];
        }
    
        $this->emit('updateChart', $this->labels, $this->datasets, $legendLabels);
    }
    public function render()
    {
        
        $especies=especie::all();
        $campos=campo::all();
        return view('livewire.graficos.graficos',compact('especies','campos'));
    }
}
