<?php
namespace App\Http\Livewire\Cuentas;

use App\Models\movimiento;
use Livewire\Component;

class Informecontable extends Component
{
    public $busquedaporfecha, $datosAgrupados = [];
    public $totalesMensuales = [];
    public $totalAnual = 0; // Nueva propiedad para el total anual
    public $labels = []; // Para los meses
    public $dataSets = []; // Para los datos del gráfico
    public function obtenerMovimientosPorAno()
    {
        $movimientos = movimiento::with('cuartel', 'concepto')
            ->selectRaw('cuartel_id, concepto_id, MONTH(fecha) as mes, SUM(montoProrroteo) as total_prorroteo')
            ->whereYear('fecha', $this->busquedaporfecha)
            ->where('tipo_id', 2) // Condición para el tipo_id
            ->groupBy('cuartel_id', 'concepto_id', 'mes')
            ->orderBy('cuartel_id')
            ->get();

        $this->datosAgrupados = $movimientos->isEmpty() ? [] : $movimientos->groupBy('cuartel_id')->map(function ($items) {
            $cuartelNombre = $items->first()->cuartel->observaciones ?? 'N/A';

            return [
                'cuartelNombre' => $cuartelNombre,
                'conceptos' => $items->groupBy('concepto_id')->map(function ($concepto) {
                    $conceptoNombre = $concepto->first()->concepto->concepto ?? 'N/A';

                    $meses = array_fill(1, 12, 0);
                    foreach ($concepto as $mov) {
                        $meses[$mov->mes] = $mov->total_prorroteo;
                    }

                    return [
                        'conceptoNombre' => $conceptoNombre,
                        'meses' => $meses,
                    ];
                }),
            ];
        });

        // Calcula el total mensual
        $this->totalesMensuales = array_fill(1, 12, 0);
        foreach ($movimientos as $movimiento) {
            $this->totalesMensuales[$movimiento->mes] += $movimiento->total_prorroteo;
        }
        // Calcula el total anual
        $this->totalAnual = array_sum($this->totalesMensuales);
    }
    
    public function render()
    {
        return view('livewire.cuentas.informecontable');
    }
}
