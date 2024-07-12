<?php

namespace App\Http\Livewire\Graficos;

use Livewire\Component;
use App\Models\envaseempresa;
use App\Models\envase;

class GraficoEnvaseBarCampo extends Component
{
    public $labels=[];
    public $valor=55;
    
   
    public function DatosCampo(){
        $envases = envase::all();
        foreach ($envases as $envase) {
            $this->labels[] = $envase->envase;
        }
        $cuentasExportadoras = envaseempresa::all();
       // Inicializa el array $dataSets fuera del bucle
        $this->dataSets = [];
        foreach ($cuentasExportadoras as $exportadora) {
            $envases = envase::all();
            $data = [];
            foreach ($envases as $envase) {
                if ($exportadora->envase_id == $envase->id) {
                    $data[] = $exportadora->stock;
                } else {
                    $data[] = 0;
                }
            }
            $this->dataSets[] = [
                'name' => $exportadora->campo->campo,
                'data' => $data,
            ];
        }
         $this->emit('updateChartVarCampo', $this->labels, $this->dataSets);   
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
        return view('livewire.graficos.grafico-envase-bar-campo');
    }
}
