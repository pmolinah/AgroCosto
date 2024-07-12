<?php

namespace App\Http\Livewire\Tarea;

use Livewire\Component;
use App\Models\empresa;
use App\Models\inventario;
use App\Models\item;
use App\Models\user;
use App\Models\tarea;
use App\Models\campo;
use App\Models\cuartel;
use App\Models\plantacion;
use App\Models\detalletarea;
class CrearTarea extends Component
{
    public $item_id,$ingredienteActivo,$tareaID;
    public $visible=false;
    public $Numero=0;
    public $tareaEliminarID;
    public $empresas=[];
    public $campos=[];
    public $cuarteles=[];
    public $superficie;
    public $especie,$fechaf,$fechai,$dosis,$objetivo;
    public $mojamiento,$reingreso,$diasAplicacion;
    public $variedad,$carencias;
    public $detalleTarea=[];
    public $empresa_id,$campo_id,$cuartel_id,$responsable_id,$administrador_id,$observacion,$equipo_id;

    public function CambioItem(){
        $buscarItem=item::where('id',$this->item_id)->first();
        // dd($buscarItem);
        $this->ingredienteActivo=$buscarItem->ingredienteActivo;
    }
    public function CambioTareas(){
        //dd($this->tareaID);
        $tarea=tarea::where('id',$this->tareaID)->first();
        $this->empresa_id=$tarea->campo->empresa_id;
        $this->campos=campo::where('empresa_id',$this->empresa_id)->get();
        $this->campo_id=$tarea->campo_id;
        $this->cuarteles=cuartel::where('campo_id',$this->campo_id)->get();
        $this->cuartel_id=$tarea->cuartel_id;
        $this->Numero=$this->tareaID;
        $this->tareaEliminarID=$this->tareaID;
        $plantacion=plantacion::where('cuartel_id',$tarea->cuartel_id)->first();
        $this->especie=$plantacion->especie->especie;
        $this->variedad=$plantacion->especie->variedad->variedad;
        $this->superficie=$tarea->cuartel->superficie;
        $this->administrador_id=$tarea->administrador_id;
    }
    public function cambioCampo(){
        $this->cuarteles=cuartel::where('campo_id',$this->campo_id)->get();
    }
    public function cambioEmpresa(){
        $this->campos=campo::where('empresa_id',$this->empresa_id)->get();
    }
    public function GuardarOrdenVerDetalle(){
        $this->responsable_id=auth()->User()->id;
       $guardarTarea=tarea::create([
            'campo_id'=>$this->campo_id,
            'cuartel_id'=>$this->cuartel_id,
            'responsable_id'=>$this->responsable_id,
            'administrador_id'=>$this->administrador_id,
      
       ]);
       $this->Numero=$guardarTarea->id;
       $this->tareaEliminarID=$guardarTarea->id;
       $this->dispatchBrowserEvent('GuardadoCorrecto',[
        'title' => 'Registro guardado correctamente.',
        'icon'=>'success',
        'iconColor'=>'blue',
    ]);
    }
    public function eliminarTarea(){
        tarea::where('id',$this->tareaEliminarID)->delete();
        $user = auth()->User()->id;
        $tareas=tarea::where('emitida',NULL)->where('responsable_id',$user)->get();
        $this->dispatchBrowserEvent('EliminarRegistro', [
            'title' => 'Registro Eliminado.',
            'icon'=>'info',
            'iconColor'=>'blue',
        ]);
        
    }
    public function AgregarLinea(){
        $detalletarea=detalletarea::create([
            'tarea_id'=>$this->tareaEliminarID,
            'item_id'=>$this->item_id,
            'cuartel_id'=>$this->cuartel_id,
            'objetivo'=>$this->objetivo,
            'dosis'=>$this->dosis,
            'fechai'=>$this->fechai,
            'fechaf'=>$this->fechaf,
            'diasentreAplicacion'=>$this->diasAplicacion,
            'reingreso'=>$this->reingreso,
            'mojamiento'=>$this->mojamiento,
            'equipo_id'=>$this->equipo_id,
            'carencia'=>$this->carencias,
        ]);
        $this->dispatchBrowserEvent('GuardadoCorrecto',[
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
        return back();
    }
    public function generarTarea(){
        tarea::where('id',$this->tareaEliminarID)->update(['emitida'=>1,'observacion'=>$this->observacion]);
        $this->dispatchBrowserEvent('GuardadoCorrecto',[
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
        return redirect()->route('Tarea.crear');
    }
    public function render()
    {
        $inventario=$resultados = inventario::select('item_id')->groupBy('item_id')->distinct('item_id')->get();
        // $empresasC=empresa::where('tipo_id',1)->get();
        $equipos=item::where('tipo_id',2)->get();
        $administradores=user::where('tipo_id',1)->get();
        if(auth()->check()){
            $user = auth()->User()->id;
        }else{
            logout();
            
        }
             
        $tareas=tarea::where('emitida',NULL)->where('responsable_id',$user)->get();
        $this->empresas=empresa::where('tipo_id',1)->get();
        $this->detalleTarea=detalletarea::where('tarea_id',$this->Numero)->get();
        return view('livewire.tarea.crear-tarea',compact('inventario','equipos','administradores','tareas'))->with('empresas',$this->empresas,'detalleTarea',$this->detalleTarea);
    }
}
