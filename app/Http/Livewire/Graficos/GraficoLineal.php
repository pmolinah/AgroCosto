<?php

namespace App\Http\Livewire\Graficos;

use Livewire\Component;
use App\Models\especie;
use App\Models\detallecosecha;
use Carbon\Carbon;
Carbon::setWeekStartsAt(Carbon::MONDAY);
class GraficoLineal extends Component
{
    public $semanaInicio;
    public $semanaFin;
    public $semana;

    
    public function mount(){
        
        $this->semana = Carbon::now()->weekOfYear;
        $this->semana = $this->semana;
        $this->semanaInicio = $this->semana - 1;
        $this->semanaFin = $this->semana + 1;
    }
    
    public function KilosXSemanaEspecies(){
        $especies = Especie::whereNotIn('id', [1])->get();
        $dataSets = [];
        $labels = [];
    
        for ($semana = $this->semanaInicio; $semana <= $this->semanaFin; $semana++) {
            $labels[] = "Semana". $semana+1;
    
            foreach ($especies as $especie) {
                $kilosPorSemana = detallecosecha::where('especie_id', $especie->id)
                    ->whereRaw('WEEK(created_at) = ?', [$semana])
                    ->sum('kilos');
    
                $dataSets[$especie->especie][] = $kilosPorSemana ?? 0; // Valor predeterminado de 0 si no hay datos.
            }
        }
    
        $this->emit('updateChartLine', $labels, $dataSets);
        //seleccion para mostrar dos años y comparar
        // $especies = especie::all();
        // $dataSets = [];
        // $labels = [];

        // // Obtener los datos para el primer año
        // $this->getYearData($this->semanaInicio, $this->semanaFin, $labels, $dataSets, $especies, 'Año 1');

        // // Obtener los datos para el segundo año (puedes cambiar los valores de $year1 y $year2 según sea necesario)
        // $this->getYearData($this->semanaInicio, $this->semanaFin, $labels, $dataSets, $especies, 'Año 2');

        // $this->emit('updateChartLine', $labels, $dataSets);
    }

    // private function getYearData($startWeek, $endWeek, &$labels, &$dataSets, $especies, $yearLabel) {
    //     for ($semana = $startWeek; $semana <= $endWeek; $semana++) {
    //         $labels[] = "Semana $semana";
    
    //         foreach ($especies as $especie) {
    //             $kilosPorSemana = detallecosecha::where('especie_id', $especie->id)
    //                 ->whereRaw('WEEK(created_at) = ?', [$semana])
    //                 ->sum('kilos');
    
    //             $dataSets[$yearLabel][$especie->especie][] = $kilosPorSemana ?? 0; // Valor predeterminado de 0 si no hay datos.
    //         }
    //     }
    // }
    public function render()
    {
        return view('livewire.graficos.grafico-lineal');
    }
}
