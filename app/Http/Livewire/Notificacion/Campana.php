<?php

namespace App\Http\Livewire\Notificacion;

use Livewire\Component;
use App\Models\certificacionasignadacuartel;
use Carbon\Carbon;

class Campana extends Component
{
    public $AlertasCuarteles=[];
    public $i=0;
    public function render()
    {
        $fechaActual = Carbon::now();
        $certificacionesCuartel=certificacionasignadacuartel::all();
        foreach($certificacionesCuartel as $certificacion){
            $fechaInicial = Carbon::parse($certificacion->fechaTermino);
            $nuevaFecha = $fechaInicial->subDays($certificacion->alertaTempranaCaducidad);
            if ($nuevaFecha > $fechaActual) {
                // $fechasMostradas[] = $nuevaFecha->toDateTimeString();
                // $this->AlertasCuarteles[$i][0]=$certificacion->cuartel->observaciones;
                // $this->AlertasCuarteles[$i][1]=$certificacion->fechaTewrmino;
                // $this->AlertasCuarteles[$i][2]=$certificacion->certificacion->certificacion;

            } else {
                $this->AlertasCuarteles[$this->i][0]=$certificacion->cuartel->observaciones;
                $this->AlertasCuarteles[$this->i][1]=$certificacion->fechaTermino;
                $this->AlertasCuarteles[$this->i][2]=$certificacion->certificacion->certificacion;
                $this->i++;
                // $fechasMostradas[] = $fechaActual->toDateTimeString();
                
            }
        }
        return view('livewire.notificacion.campana')->with('NAlertasCuarteles', $this->i);
    }
}
