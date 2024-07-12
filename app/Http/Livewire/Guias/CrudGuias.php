<?php

namespace App\Http\Livewire\Guias;

use Livewire\Component;
use App\Models\guia;
use App\Models\detalleguia;
use App\Models\planificacioncosecha;
use App\Models\exportadoraxplanificacion;
use App\Models\detallecosecha;
use App\Models\desgloseenvase;
use App\Models\cuentaenvase;
use App\Models\detallecuentaenvase;
use App\Models\envaseempresa;
use App\Models\desgloseenvasecampo;
use App\Models\vehiculo;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use DateTime;
class CrudGuias extends Component
{
    public $guias;
    public $saldoNegativo=0;
    public $fechainicial;
    public $fechafinal;
    public $cosechasCerradas=array();
    public $exportadorxplanificacionID;
    public $exportadoraxplanificacion=array();
    public $detalleCosecha=array();
    public $visible=false;
    // campos para Guia
    public $planificacioncosecha_id;
    public $cantidadkilos=0;
    public $cantidadEnvases=0;
    public $observacion;
    public $envase_id=0;
    public $especie_id=0;
    public $fechaactual;
    public $numeroGuia=0;
    public $conductor_id;
    public $vehiculo_id;
    public $Diferencia=0;

    public function mount()
    {
        $this->fechaActual = new DateTime();
    }

    public function CargarInformacion(){
        $this->exportadoraxplanificacion=exportadoraxplanificacion::with('desgloseenvase')->where('id',$this->exportadorxplanificacionID)->where('KilosRecolectados','!=',NULL)->get();
        foreach($this->exportadoraxplanificacion as $expxcos){
            $this->detalleCosecha=detallecosecha::where('planificacioncosecha_id',$expxcos->planificacioncosecha_id)->where('exportadora_id',$expxcos->empresa_id)->get();
        }
        $this->visible=true;
    }

    public function generarGuiaDespacho(){
        
        //consulta por el conductor y el camion
        if($this->conductor_id==NULL || $this->vehiculo_id==NULL){
            $this->dispatchBrowserEvent('ErrorCampoVacio', [
                'title' => 'Error, Falta Vehículo o Conductor.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
        //creando la guia de despacho
        $exportPlan=exportadoraxplanificacion::with('desgloseenvase')->where('id',$this->exportadorxplanificacionID)->get();
        foreach ($exportPlan as $exportadoraxpla){
            $saveGuia=guia::create([
                'planificacioncosecha_id'=>$exportadoraxpla->planificacioncosecha_id,
                'empresa_id'=>$exportadoraxpla->empresa_id,
                'numero'=>0,
                'tipo'=>1,
                'cantidadKilos'=>$exportadoraxpla->KilosRecolectados,
                'cantidadEnvases'=>$exportadoraxpla->envasesUtilizadosReales,
                'fecha'=>$this->fechaActual,
                'observacion'=>$this->observacion,
                'envase_id'=>$exportadoraxpla->planificacioncosecha->envase_id,
                'conductor_id'=>$this->conductor_id,
                'vehiculo_id'=>$this->vehiculo_id,
            ]);
         
            $saveGuia->update(['numero' => $saveGuia->id+1000]);
            exportadoraxplanificacion::where('id',$this->exportadorxplanificacionID)->update(['guiaDespacho'=>$saveGuia->id+1000]);
            //fin
            //detalle de la guia de despacho
            $detalleCosechaExp=detallecosecha::where('planificacioncosecha_id',$this->exportadorxplanificacionID)->where('exportadora_id',$exportadoraxpla->empresa_id)->get();
            foreach($detalleCosechaExp as $detalleCosecha)
            {  
                    detalleguia::create([
                        'guia_id'=>$saveGuia->id,
                        'planificacioncosecha_id'=>$exportadoraxpla->planificacioncosecha_id,
                        'especie_id'=>$exportadoraxpla->planificacioncosecha->plantacion->especie_id,
                        'color_id'=>1,
                        'kilos'=>$detalleCosecha->kilos,
                        'observacion'=>$detalleCosecha->tarjaenvase,
                    ]);
            }
            //fin
            //proceso de descuento de envases en exportadora y campo, afecta sus cuentas corrientes
            //desglose de envases de la cosecha
            $desgloseenvases=desgloseenvase::where('exportadoraxplanificacion_id',$exportadoraxpla->id)->get(); //detaelle de envases usados en la cosecha
            foreach($desgloseenvases as $desgloseenvase){
               $detallecuentaEnvases=detallecuentaenvase::where('cuentaenvase_id',$exportadoraxpla->cuentaenvase_id)->where('color_id',$desgloseenvase->color_id)->count();// busca si tiene la cuenta envase y color
               $stockColor=detallecuentaenvase::where('cuentaenvase_id',$exportadoraxpla->cuentaenvase_id)->where('color_id',$desgloseenvase->color_id)->first(); 
               //$this->diferencia=$stockColor->stock - $desgloseenvase->stock;           
               //si tiene cuanta corriente la empresa y ademas el envase y color, le descuenta
                if($detallecuentaEnvases>0){
                    if($stockColor->stock >= $desgloseenvase->stock){ //si con lo que tiene le alcanza para descontar, descuenta, puede quedar en cero
                        $detallecuentaEnvases=detallecuentaenvase::where('cuentaenvase_id',$exportadoraxpla->cuentaenvase_id)->where('color_id',$desgloseenvase->color_id)->decrement('stock',$desgloseenvase->stock);
                        $cuentaEnvase=cuentaenvase::where('id',$exportadoraxpla->cuentaenvase_id)->decrement('saldo',$desgloseenvase->stock);
                        $Campodescuentos=envaseempresa::where('campo_id',$exportadoraxpla->cuentaenvase->campo_id)->where('envase_id',$exportadoraxpla->cuentaenvase->envase_id)->decrement('stock',$desgloseenvase->stock);
                        //foreach($Campodescuentos as $campoDes){
                            //$campoDetalleDescuento=desgloseenvasecampo::where('color_id',$desgloseenvase->color_id)->where('envaseempresa_id',$campoDes->id)->decrement('stock',$desgloseenvase->stock);
                        //}
                    }else{
                        $detallecuentaEnvases=detallecuentaenvase::where('cuentaenvase_id',$exportadoraxpla->cuentaenvase_id)->where('color_id',$desgloseenvase->color_id)->decrement('stock',$desgloseenvase->stock);
                        $cuentaEnvase=cuentaenvase::where('id',$exportadoraxpla->cuentaenvase_id)->decrement('saldo',$stockColor->stock);
                        
                        $this->diferencia=$desgloseenvase->stock - $stockColor->stock;

                        $campodescuento=envaseempresa::where('campo_id',$exportadoraxpla->cuentaenvase->campo_id)->where('envase_id',$exportadoraxpla->cuentaenvase->envase_id)->decrement('stock',$desgloseenvase->stock);
                        
                        $Campodescuentos=envaseempresa::where('campo_id',$exportadoraxpla->cuentaenvase->campo_id)->where('envase_id',$exportadoraxpla->cuentaenvase->envase_id)->get();
                        foreach($Campodescuentos as $campoDes){
                            $campoDetalleDescuento=desgloseenvasecampo::where('color_id',$desgloseenvase->color_id)->where('envaseempresa_id',$campoDes->id)->decrement('stock',$this->diferencia);
                        }
                    }
                }else{
                    $this->diferencia=$desgloseenvase->stock - $stockColor->stock;

                    $campodescuento=envaseempresa::where('campo_id',$exportadoraxpla->cuentaenvase->campo_id)->where('envase_id',$exportadoraxpla->cuentaenvase->envase_id)->decrement('stock',$desgloseenvase->stock);
                    
                    $Campodescuentos=envaseempresa::where('campo_id',$exportadoraxpla->cuentaenvase->campo_id)->where('envase_id',$exportadoraxpla->cuentaenvase->envase_id)->get();
                    foreach($Campodescuentos as $campoDes){
                        $campoDetalleDescuento=desgloseenvasecampo::where('color_id',$desgloseenvase->color_id)->where('envaseempresa_id',$campoDes->id)->decrement('stock',$this->diferencia);
                    }

                    $this->saldoNegativo=0;
                    $this->saldoNegativo=$this->saldoNegativo - $desgloseenvase->stock;
                    $this->saldoNegativo=0;
                    $this->saldoNegativo=$this->saldoNegativo - $desgloseenvase->stock;
                    detallecuentaenvase::create([
                        'cuentaenvase_id'=>$exportadoraxpla->cuentaenvase_id,
                        'color_id'=>$desgloseenvase->color_id,
                        'stock'=>$this->saldoNegativo,
                    ]);
                }
            }
        }
       
        Session::flash('success', 'Guia Guardada Correctamente...N°'.$saveGuia->id+1000);
        return redirect()->route('Guias.index');
    }
           

    public function render()
    {
    
        $planificacioncosecha=planificacioncosecha::with('exportadoraxplanificacion.desgloseenvase','contraistaxplanificacion','detallecosecha')->whereBetween('updated_at', [$this->fechainicial . ' 00:00:00', $this->fechafinal . ' 23:59:59'])->where('finalizada','!=',NULL)->get();
        $vehiculos=vehiculo::all();
        $conductores=User::where('tipo_id',6)->get();          
        return view('livewire.guias.crud-guias',compact('planificacioncosecha','conductores','vehiculos'));
    }
}
