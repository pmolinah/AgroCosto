<?php

namespace App\Http\Livewire\Graficos;

use Livewire\Component;
use App\Models\envase;
use App\Models\color;
use App\Models\cuentaenvase;
use App\Models\envaseempresa;
use App\Models\detallecuentaenvase;
class GraficoEnvaseRadarExportadora extends Component
{
    public $labels=[];
    public $dataSets = [];

    
   
    public function DatosEnvaseColores(){
        $colores = color::all();
        foreach ($colores as $color) {
            $this->labels[] = $color->color;
        }
        $Envases = envase::all();
foreach ($Envases as $env) {
    $data = []; // Inicializa el array data para cada envase

    $colores = color::all();
    foreach ($colores as $color) {
        $totalColoresIguales = cuentaenvase::join('detallecuentaenvases', 'cuentaenvases.id', '=', 'detallecuentaenvases.cuentaenvase_id')
            ->where('cuentaenvases.envase_id', $env->id)
            ->where('detallecuentaenvases.color_id', $color->id)
            ->sum('detallecuentaenvases.stock');

        if ($totalColoresIguales > 0) {
            $data[] = $totalColoresIguales;
        } else {
            $data[] = 0; // Agrega 0 si no hay stock para ese color
        }
    }

    $this->dataSets[] = [
        'name' => $env->envase,
        'data' => $data,
    ];
}

$this->emit('updateChartRadarExpo', $this->labels, $this->dataSets); 
        //dd($totalColoresIguales );
        //
        // $cuentasExportadoras = envaseempresa::all();
        // Inicializa el array $dataSets fuera del bucle
        // $this->dataSets = [];
        // foreach ($cuentasExportadoras as $exportadora) {
        //     $envases = envase::all();
        //     $data = [];
        //     foreach ($envases as $envase) {
        //         if ($exportadora->envase_id == $envase->id) {
        //             $data[] = $exportadora->stock;
        //         } else {
        //             $data[] = 0;
        //         }
        //     }

        //     $this->dataSets[] = [
        //         'name' => $exportadora->campo->campo,
        //         'data' => $data,
        //     ];
        // }
        // $data[] = 0;
        // $this->dataSets[] = [
        //              'name' => 'Func',
        //              'data' => $data,
        //          ];
        //dd($this->dataSets);
        
        // $colores = color::all();
        // foreach ($colores as $color) {
        //      $this->labels[] = $color->color;
        //  }
        // $envases=envase::all();
        // foreach($envases as $envase){
        //     $buscarEnvaseCuenta=cuentaenvase::where('envase_id',$envase->id)->get();
        //     $colores=color::all();
        //     foreach($colores as $color){
        //         foreach($buscarEnvaseCuenta as $EnvasesCuenta){
        //             $detallexExportadora=detallecuentaenvase::where('cuentaenvase_id',$EnvasesCuenta->id)->where('color_id',$color->id)->count();
        //             if($detallexExportadora>0){
        //                 $detallexExportadora=detallecuentaenvase::where('cuentaenvase_id',$EnvasesCuenta->id)->where('color_id',$color->id)->get();
        //                 foreach($detallexExportadora as $expoEnvCol){
        //                     $this->dataSets[] = [
        //                         'name' => $color->id,
        //                         'data' => $expoEnvCol->stock,
        //                     ];
        //                 }
        //             }// }else{
        //             //     $this->dataSets[] = [
        //             //         'name' => $color->id,
        //             //         'data' => 0,
        //             //     ];
        //             // }
        //         }
        //     }

        // }
        //dd($this->dataSets);
        // $this->labels[] ='rojooo';
        // $this->dataSets[] = [
        //     'name' => 'pruebao',
        //    'data' => 34,
        // ];
        // //dd($this->dataSets);
        //  $this->emit('updateChartRadarExpo', $this->labels, $this->dataSets);   
    //     $cuentasExportadoras = cuentaenvase::with('detallecuentaenvase')->get();
    //    // Inicializa el array $dataSets fuera del bucle
    //     $this->dataSets = [];
    //     foreach ($cuentasExportadoras as $exportadora) {
    //         $envases = envase::all();
    //         $data = [];
    //         foreach ($envases as $envase) {
    //             if ($exportadora->envase_id == $envase->id) {
    //                 foreach($exportadora->detallecuentaenvase as $detalleColores){

    //                 }

    //                 $data[] = $exportadora->stock;
    //             } else {
    //                 $data[] = 0;
    //             }
    //         }
             
    //     }
    // $nuevosDatos = [
    //     ['name' => 'Nueva Serie 1', 'data' => [30]],
    //     ['name' => 'Nueva Serie 2', 'data' => [56]],
    //     // ... otras series de datos
    // ];
    // $this->emit('updateChartRadarExpo', $nuevosDatos);
    }
    
    public function render()
    {
        return view('livewire.graficos.grafico-envase-radar-exportadora');
    }
}
