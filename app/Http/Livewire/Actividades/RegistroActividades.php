<?php

namespace App\Http\Livewire\Actividades;

use Livewire\Component;
use App\Models\actividad;
use App\Models\empresa;
use App\Models\campo;
use App\Models\cuartel;
use App\Models\plantacion;
use App\Models\tipoactividad;
use App\Models\costoactividad;
use App\Models\tipocosto;
use App\Models\avanceactividad;
use Illuminate\Support\Facades\Session;
class RegistroActividades extends Component
{
    public $actividades=[];
    public $empresas=[];
    public $propietarios=[];
    public $campos=[];
    public $cuarteles=[];
    public $tipoActividads=[];
    public $costoActividades=[];
    public $avanceactividades=[];
    public $tipoCosto=[];
    public $TCosto,$TCosto_id,$porcentaje;
    public $propietario_id,$campo_id,$cuartel_id,$ejecutor_id,$actividad_id=0;
    public $plantacion,$hectareas,$especie,$variedad,$cantidadPlantada,$tipoActividad_id,$unidadMedida,$referencia,$costoActividad_id,$SelecActividad_id,$tipocosto_id;
    public $observacion,$fechai,$fechat,$dias=0,$user;
    public $costo=0,$costoUnitario=0,$cantidad=0,$visible=false,$deshabilitarBoton=false;
    public $referencia_id,$fechaAvance,$valor;
    //variables de avances realizados
    public $uniMed,$cantAvance,$restante;
    public function SeleccionPropietario_id(){
   
        $this->campos=campo::where('empresa_id',$this->propietario_id)->get();
    }
    public function SeleccionCampo_id(){
        $this->cuarteles=cuartel::where('campo_id',$this->campo_id)->get();
    }
    public function SeleccionCuartel_id(){
        $this->plantacion=plantacion::where('cuartel_id',$this->cuartel_id)->first();
        $this->hectareas=$this->plantacion->cuartel->superficie;
        $this->especie=$this->plantacion->especie->especie;
        $this->variedad=$this->plantacion->especie->variedad->variedad;
        $this->cantidadPlantada=$this->plantacion->cantidadPlantada;
    }
    public function SeleccionTipoActividad_id(){
        $unidad=tipoactividad::where('id',$this->tipoActividad_id)->first();
        $this->unidadMedida=$unidad->unidadMedida;
        if($this->unidadMedida==1){
            $this->unidadMedida='Unidad';
        }
        
        if($unidad->referencia==1){
            $unidad->referencia='Empresa';
        }elseif($unidad->referencia==2){
            $unidad->referencia='Campo';
        }elseif($unidad->referencia==3){
            $unidad->referencia='Cuartel';
        }else{
            $unidad->referencia='Especie';
        }

        $this->referencia=$unidad->referencia;
        $this->TCosto=$unidad->tipocosto->costo;
        $this->TCosto_id=$unidad->tipocosto->id;
        if($unidad->cantidad>0){
            $this->porcentaje= ($unidad->avance / $unidad->cantidad) * 100;
        }else{
            $this->porcentaje=0.00;
        }
    }
    public function Costo(){
        // $this->costoUnitario=/$this->cantidad;
        $this->costo= $this->costoUnitario*$this->cantidad;
    }
    public function AgregarCosto(){
        if($this->actividad_id!=NULL && $this->tipoActividad_id!=NULL && $this->cantidad!=NULL && $this->costo!=NULL && $this->costoUnitario){
                $buscarPivote=costoactividad::where('pivote',$this->actividad_id.$this->tipoActividad_id)->first();
                if($buscarPivote){
                    $this->dispatchBrowserEvent('ErrorYaExiste', [
                        'title' => 'Registro no se puede Ingresar.',
                        'icon'=>'error',
                        'iconColor'=>'blue',
                    ]);
                    return back();
                }
                //dd($this->costoUnitario);
            costoactividad::create([
                'actividad_id'=>$this->actividad_id,
                'tipoactividad_id'=>$this->tipoActividad_id,
                'cantidad'=>$this->cantidad,
                'costo'=>$this->costo,
                'costoUnidad'=>$this->costoUnitario,
                'avance'=>0,
                'tipocosto_id'=>$this->TCosto_id,
                'pivote'=>$this->actividad_id.$this->actividad_id
            ]);
            $this->dispatchBrowserEvent('GuardadoCorrecto', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            $this->cantidad="";
            $this->costo="";
            $this->costoUnitario="";
            $this->tipoActividad_id="";
            $this->referencia="";
            $this->TCosto="";
            $this->porcentaje=0.0;
            $this->unidadMedida="";
            return back();
        }else{
            $this->dispatchBrowserEvent('ErrorFaltanDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
    }
    public function SeleccionActividad_id(){
        if($this->SelecActividad_id!=''){
            $this->actividad_id=$this->SelecActividad_id;
            $actividadActual=actividad::where('id',$this->actividad_id)->first();
            $this->ejecutor_id=$actividadActual->ejecutor_id;
            $this->observacion=$actividadActual->observacion;
            $this->fechai=$actividadActual->fechai;
            $this->fechat=$actividadActual->fechat;
            $this->propietario_id=$actividadActual->lugar->campo->empresa_id;
            $this->campos=campo::where('empresa_id',$this->propietario_id)->get();
            $this->campo_id=$actividadActual->lugar->campo_id;
            $this->cuarteles=cuartel::where('campo_id',$this->campo_id)->get();
            $this->cuartel_id=$actividadActual->lugar_id;
            $this->visible=true;
            $this->deshabilitarBoton=true;
        }
    }
    public function limpiarFormulario(){
        $this->actividad_id='';
        $this->ejecutor_id='';
        $this->observacion='';
        $this->fechai='';
        $this->fechat='';
        $this->propietario_id='';
        $this->campo_id='';
        $this->cuartel_id='';
        $this->tipoCosto=[];
        $this->campos=[];
        $this->cuarteles=[];
        $this->visible=false;
        $this->deshabilitarBoton=false;
    }
    public function generarActividad(){
        if($this->ejecutor_id!='' && $this->observacion!='' && $this->fechai!='' && $this->fechat!='' && $this->cuartel_id!='')
        {
            $this->user=auth()->id();
            $crearActividad=actividad::create([
            'ejecutor_id'=>$this->ejecutor_id,
            'observacion'=>$this->observacion,
            'lugar_id'=>$this->cuartel_id,
            'fechai'=>$this->fechai,
            'fechat'=>$this->fechat,
            'dias'=>$this->dias=0,
            'responsable_id'=>$this->user,
            'avances'=>0,
            'costo'=>0,
            //'estado'=>NULL,
            ]);
            $this->visible=true;
            $this->actividad_id=$crearActividad->id;
            $this->dispatchBrowserEvent('GuardadoCorrecto', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }else{
            $this->dispatchBrowserEvent('ErrorFaltanDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
    }
    public function EliminarCosto($id){
        
        $buscarCosto=costoactividad::where('id',$id)->first();
        if($buscarCosto->avanceactividad()->exists()){
            $this->dispatchBrowserEvent('ErrorTieneDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
        $buscarCosto->delete();
        $this->dispatchBrowserEvent('EliminarRegistro', [
            'title' => 'Error, Faltan Datos.',
            'icon'=>'error',
            'iconColor'=>'blue',
        ]);
        return back();
    }
    public function SeleccionCosto(){
        $costoActividadAvance=costoactividad::where('id',$this->costoActividad_id)->first();
        $this->uniMed=$costoActividadAvance->tipoactividad->unidadMedida;
        $this->restante=$costoActividadAvance->cantidad - $costoActividadAvance->avance;
    }

    public function SumarAvance(){
        if($this->cantAvance>$this->restante){
            $this->dispatchBrowserEvent('ErrorDiferencia', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
            
        }
        $SumaAvance=costoactividad::where('id',$this->costoActividad_id)->increment('avance',$this->cantAvance);
        $SumaAvance=costoactividad::where('id',$this->costoActividad_id)->first();
        
        $this->valor=$SumaAvance->costoUnidad*$this->cantAvance;
        avanceactividad::create([
            'actividad_id'=>$this->actividad_id,
            'costoactividad_id'=>$this->costoActividad_id,
            'ejecutado'=>$this->cantAvance,
            'restante'=>$this->restante-$this->cantAvance,
            'fechaAvance'=>$this->fechaAvance,
            'valor'=>$this->valor,
        ]);
        $this->valor='';
        $this->fechaAvance='';
        $this->cantAvance='';
        $this->costoActividad_id='';
        $this->uniMed='';

        $this->avanceactividades=avanceactividad::where('actividad_id',$this->actividad_id)->get();
        $this->dispatchBrowserEvent('GuardadoCorrecto', [
            'title' => 'Error, Faltan Datos.',
            'icon'=>'error',
            'iconColor'=>'blue',
        ]);
        return back();
    }    
    public function EliminarAvance($id){
        $ejecutado=avanceactividad::where('id',$id)->first();
        // dd($ejecutado->costoactividad_id);
        $SumaAvance=costoactividad::where('id',$ejecutado->costoactividad_id)->decrement('avance',$ejecutado->ejecutado);
        // dd($SumaAvance);
        $ejecutado->delete();
        $this->dispatchBrowserEvent('EliminarRegistro', [
            'title' => 'Error, Faltan Datos.',
            'icon'=>'error',
            'iconColor'=>'blue',
        ]);
        return back();
    }
    public function cerrarActividades(){
        
        actividad::where('id',$this->actividad_id)->update(['estado'=>1]);
        $this->actividad_id='';
        $this->ejecutor_id='';
        $this->observacion='';
        $this->fechai='';
        $this->fechat='';
        $this->propietario_id='';
        $this->campo_id='';
        $this->cuartel_id='';
        $this->tipoCosto=[];
        $this->campos=[];
        $this->cuarteles=[];
        $this->visible=false;
        $this->deshabilitarBoton=false;
        $this->dispatchBrowserEvent('GuardadoCorrecto', [
            'title' => 'Error, Faltan Datos.',
            'icon'=>'error',
            'iconColor'=>'blue',
        ]);
        return back();
    }
    public function render()
    {
        $this->actividades=actividad::where('estado',NULL)->get();
        $this->empresas=empresa::all();
        $this->propietarios=empresa::where('tipo_id',1)->get();
        $this->tipoActividads=tipoactividad::all();
        $this->tipoCosto=tipocosto::all();
        $this->costoActividades=costoactividad::where('actividad_id',$this->actividad_id)->get();
        $this->avanceactividades=avanceactividad::where('actividad_id',$this->actividad_id)->get();
        return view('livewire.actividades.registro-actividades');
    }
}
