<?php

namespace App\Http\Livewire\Graficos;

use Livewire\Component;
use App\Models\cuentaenvase;
use App\Models\envase;
class GraficoEnvaseBar extends Component
{
    public $labels=[];
    public $valor=55;
    
    // public function mount()
    // {
    //     $this->Datos();
    // }
    
    public function Datos(){
        $envases = envase::all();
        foreach ($envases as $envase) {
            $this->labels[] = $envase->envase;
        }
        $cuentasExportadoras = cuentaenvase::all();
       // Inicializa el array $dataSets fuera del bucle
        $this->dataSets = [];
        foreach ($cuentasExportadoras as $exportadora) {
            $envases = envase::all();
            $data = [];
            foreach ($envases as $envase) {
                if ($exportadora->envase_id == $envase->id) {
                    $data[] = $exportadora->saldo;
                } else {
                    $data[] = 0;
                }
            }
            $this->dataSets[] = [
                'name' => $exportadora->empresa->razon_social,
                'data' => $data,
            ];
        }
         $this->emit('updateChartVar', $this->labels, $this->dataSets);   
            // ['name' => 'Exportadora 2', 'data' => [24, 25, 31]],
            // ['name' => 'Exportadora 3', 'data' => [14, 15, 11]],
            // // Otros conjuntos de datos
        
        //  $this->dataSets[] = [
        //         'name' => $exportadora->empresa->razon_social,
        //         'data' => $data,
        //     ];
       
    }
    public function render()
    {
       
        return view('livewire.graficos.grafico-envase-bar');
    }
}
