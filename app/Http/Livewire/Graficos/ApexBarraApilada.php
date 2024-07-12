<?php

namespace App\Http\Livewire\Graficos;
use App\Models\campo;
use App\Models\detallecosecha;
use App\Models\especie;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class ApexBarraApilada extends Component
{
    public $detalleSemanaCampo=[];
    public $semanaEspecieCampoPila,$semanaEspecie;
    public $label = [];
    public $labels = [];
    public $data = [];
    public $f=0,$c=0;
    public function mount(){
        $this->semanaEspecieCampoPila = Carbon::now()->weekOfYear;
        $this->semanaEspecie=($this->semanaEspecieCampoPila);
        $this->semanaEspecieCampoPila=$this->semanaEspecieCampoPila-1;
        
    }   

public function KilosXSemanaCampoxEspecie()
{
    $this->detalleSemanaCampo = [];
    $this->f = 0;
    $this->c = 0;
    $campos = campo::all();

    // Inicializar arreglos
    $this->labels = [];
    $this->data = [];

    foreach ($campos as $campo) {
        // Obtener información detallada por especie
        $detalles = detallecosecha::with('especie')
            ->select('especie_id', DB::raw('SUM(kilos) as total_kilos'))
            ->whereRaw('WEEK(created_at) = ?', [$this->semanaEspecieCampoPila])
            ->where('campo_id', $campo->id)
            ->groupBy('especie_id')
            ->get();

        // Inicializar arreglo de especies para el campo actual
        $especiesCampo = [];

        // Obtener las especies y kilos
        foreach ($detalles as $detalle) {
            $especiesCampo[] = [
                'nombre' => $detalle->especie->especie, // Ajustar aquí al nombre del campo correcto
                'kilos' => $detalle->total_kilos,
            ];
        }

        // Verificar si hay datos antes de agregar al arreglo
        if (!empty($especiesCampo)) {
            $this->labels[] = $campo->campo;
            $this->data[] = [
                'campo' => $campo->campo,
                'especies' => $especiesCampo,
            ];
        }
    }

    $this->emit('updateChartBarra', $this->data, $this->labels);
}

    
    public function render()
    {
        return view('livewire.graficos.apex-barra-apilada');
    }
}
