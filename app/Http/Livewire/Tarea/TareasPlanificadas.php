<?php

namespace App\Http\Livewire\Tarea;

use Livewire\Component;
use App\Models\empresa;
use App\Models\campo;
use App\Models\cuartel;
use App\Models\user;
use App\Models\detalletarea;
use App\Models\plantacion;
use App\Models\aplicaciontarea;
class TareasPlanificadas extends Component
{
    public $empresas=[];
    public $cuarteles=[];
    public $tareas=[];
    public $aplicaciones=[];
    public $empresa_id,$campo_id,$cuartel_id,$cierreTarea,$detalletareaID,$aplicador_id,$fechaAplicacion,$dosificador_id;
    public $producto,$ingredienteActivo,$mojamiento,$objetivo,$fechai,$dosis,$um,$superficie,$especie, $variedad,$cantPlan,$aplicacion,$reingreso,$carencia,$numero,$frecuencia;
    public function cambioEmpresa(){
        $this->campos=campo::where('empresa_id',$this->empresa_id)->get();
    }
    public function cambioCampo(){
        $this->cuarteles=cuartel::where('campo_id',$this->campo_id)->get();
    }
    public function cambioCuartel(){
        $this->tareas=detalletarea::where('estado',NULL)->where('cuartel_id',$this->cuartel_id)->get();
        $datoCuartel=cuartel::where('id',$this->cuartel_id)->first();
        $this->superficie=$datoCuartel->superficie;
        $especie=plantacion::where('id',$this->cuartel_id)->first();
        // $this->especie=$especie->especie->especie;
        // $this->variedad=$especie->especie->variedad->variedad;
        // $this->cantPlan=$especie->cantidadPlantas;

    }
    public function DetalleTarea($id){
        $detalleTarea=detalletarea::where('id',$id)->first();
        $this->producto=$detalleTarea->item->nombre;
        $this->ingredienteActivo=$detalleTarea->item->ingredienteActivo;
        $this->mojamiento=$detalleTarea->mojamiento;
        $this->objetivo=$detalleTarea->objetivo;
        $this->fechai=$detalleTarea->fechai;
        $this->dosis=$detalleTarea->dosis;
        $this->um=$detalleTarea->item->unidadMedida;
        $this->aplicacion=$detalleTarea->equipo->nombre;
        $this->reingreso=$detalleTarea->reingreso;
        $this->carencia=$detalleTarea->carencia;
        $this->numero=$detalleTarea->tarea_id;
        $this->frecuencia=$detalleTarea->diasentreAplicacion;
        $this->detalletareaID=$detalleTarea->id;
        $this->aplicaciones=aplicaciontarea::where('detalletarea_id',$detalleTarea->id)->get();

    }
    public function sumarAplicacion(){
        if($this->cierreTarea){
            aplicaciontarea::create([
                'dosificador_id'=>$this->dosificador_id,
                'aplicador_id'=>$this->aplicador_id,
                'detalletarea_id'=>$this->detalletareaID,
                'fecha'=>$this->fechaAplicacion,
            ]);
            $this->tareas=detalletarea::where('id',$this->detalletareaID)->update(['estado'=>1]);
            $this->tareas=detalletarea::where('estado',NULL)->where('cuartel_id',$this->cuartel_id)->get();
            $this->dispatchBrowserEvent('CierreCorrecto', [
                'title' => 'Cierre Correcto...',
                'icon'=>'success',
                'iconColor'=>'blue',
            ]);
            $this->reset(['producto','ingredienteActivo','mojamiento','objetivo','fechai','dosis','um','aplicacion','reingreso','carencia','frecuencia','aplicaciones','dosificador_id','aplicador_id']);
        }else{
            aplicaciontarea::create([
                'dosificador_id'=>$this->dosificador_id,
                'aplicador_id'=>$this->aplicador_id,
                'detalletarea_id'=>$this->detalletareaID,
                'fecha'=>$this->fechaAplicacion,
            ]);
            $this->aplicaciones=aplicaciontarea::where('detalletarea_id',$this->detalletareaID)->get();
            $this->dispatchBrowserEvent('GuardadoCorrecto', [
                'title' => 'Cierre Correcto...',
                'icon'=>'success',
                'iconColor'=>'blue',
            ]);
        }
    }
    public function EliminarAplicacion($id){
        aplicaciontarea::where('id',$id)->delete();
        $this->aplicaciones=aplicaciontarea::where('detalletarea_id',$this->detalletareaID)->get();
    }
    public function render()
    {
        $this->empresas=empresa::where('tipo_id',1)->get();
        $this->campos=campo::where('empresa_id',$this->empresa_id)->get();
        $usuarios=user::all();
        return view('livewire.tarea.tareas-planificadas',compact('usuarios'))->with('empresas',$this->empresas,'campos',$this->campos,'tareas',$this->tareas);
    }
}
