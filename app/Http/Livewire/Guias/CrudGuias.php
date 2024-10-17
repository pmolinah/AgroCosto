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
use App\Models\almacenamiento;
use App\Models\empresa;
use App\Models\campo;
use Illuminate\Support\Facades\Session;
use DateTime;
class CrudGuias extends Component
{
    public $guias=[],$detalleguias,$envaseDesglose;
    public $empresa_id,$campoxCuentaEnvase_id,$campoLista=[];
    public $empresa,$negativo=0,$descuentoReal=0;
    public $empresas=[];
    public $saldoNegativo=0;
    public $fecha;
    public $fechafinal;
    public $cosechasCerradas=array();
    public $clientes=[],$almacenamiento=[],$detalleenvases=[];
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
    public $soloFecha;
    public $numeroGuia=0;
    public $conductor_id;
    public $vehiculo_id;
    public $Diferencia=0,$deshabilitarCrear=true;

    public $rutCliente,$razonSocial,$direccionCliente,$comunaCliente,$emailCliente,$giroCliente;
    public $direccionCampo,$campo_id,$numero,$tipo,$cliente_id,$guiasSinEmitir_id,$guia_id;
    

    public function mount()
    {
        $this->fechaActual = new DateTime();
        $this->soloFecha = new DateTime();
    }
    public function limpiarFormulario(){
        $this->fecha='';
        $this->tipo='';
        $this->numero='';
        $this->campo_id='';
        $this->empresa_id='';
        $this->direccionCliente='';
        $this->rutCliente='';
        $this->empresa='';
        $this->razonSocial='';
        $this->comunaCliente='';
        $this->emailCliente='';
        $this->giroCliente='';
        $this->conductor_id='';
        $this->vehiculo_id='';
        $this->direccionCampo='';
        $this->guiasSinEmitir_id='';
        $this->guia_id='';
        // $this->detalleenvases=[]
    }
    // public function CargarInformacion(){
    //     $this->exportadoraxplanificacion=exportadoraxplanificacion::with('desgloseenvase')->where('id',$this->exportadorxplanificacionID)->where('KilosRecolectados','!=',NULL)->get();
    //     foreach($this->exportadoraxplanificacion as $expxcos){
    //         $this->detalleCosecha=detallecosecha::where('planificacioncosecha_id',$expxcos->planificacioncosecha_id)->where('exportadora_id',$expxcos->empresa_id)->get();
    //     }
    //     $this->visible=true;
    // }
    public function CrearGuia(){
        $this->visible=true;
        if($this->fecha==null || $this->campo_id==null || $this->empresa_id==null || $this->numero==null || $this->tipo==null || $this->conductor_id==null || $this->vehiculo_id==null || $this->campoxCuentaEnvase_id==NULL){
            $this->dispatchBrowserEvent('ErrorFaltanDatos', [
                'title' => 'Error, Falta Vehículo o Conductor.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
        $save=guia::create([
            'fecha'=>$this->fecha,
            'empresa_id'=>$this->campo_id,
            'cliente_id'=>$this->empresa_id,
            'numero'=>$this->numero,
            'tipo'=>$this->tipo,
            'conductor_id'=>$this->conductor_id,
            'vehiculo_id'=>$this->vehiculo_id,
            'campo_id'=>$this->campoxCuentaEnvase_id,
        ]);
        // $this->guia_id=$this->numero;
        $this->numero=$this->numero;
        $this->guia_id=$save->id;
        $this->dispatchBrowserEvent('GuardadoCorrecto', [
            'title' => 'Error, Falta Vehículo o Conductor.',
            'icon'=>'error',
            'iconColor'=>'blue',
        ]);
        return back();
        
       
    }
    public function seleccionCliente(){
        $this->empresa=empresa::where('id',$this->empresa_id)->first();
        $this->rutCliente=$this->empresa->rut;
        $this->razonSocial=$this->empresa->razon_social;
        $this->direccionCliente=$this->empresa->direccion;
        $this->comunaCliente=$this->empresa->comuna->comuna;
        $this->emailCliente=$this->empresa->email;
        $this->giroCliente=$this->empresa->giro;
    }
    public function seleccionEmpresa(){
        $this->empresa=empresa::where('id',$this->campo_id)->first();
        $this->direccionCampo=$this->empresa->direccion;
        $this->campoLista=campo::where('empresa_id',$this->campo_id)->get();
    }
    public function agregarBins(){
        $almacenamientoEnvase=almacenamiento::where('id',$this->envase_id)->first();
        $buscarTarja=desgloseenvase::where('tarjaEnvase',$almacenamientoEnvase->tarjaenvase)->first();
        if($buscarTarja){
            $this->dispatchBrowserEvent('ErrorYaExiste', [
                'title' => 'Error, Falta Vehículo o Conductor.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
        $buscaEnvase=desgloseenvase::where('guia_id',$this->guia_id)->where('color_id',$almacenamientoEnvase->color_id)->first();
        if($buscaEnvase){
            $buscaEnvase=desgloseenvase::where('guia_id',$this->guia_id)->where('color_id',$almacenamientoEnvase->color_id)->increment('stock',1);
        }else{
        desgloseenvase::create([
            'guia_id'=>$this->guia_id,
            'planificacioncosecha_id'=>$almacenamientoEnvase->planificacioncosecha_id,
            'stock'=>1,
            'exportadoraxplanificacion_id'=>$this->empresa_id,
            'color_id'=>$almacenamientoEnvase->color_id,
            'tarjaEnvase'=>$almacenamientoEnvase->tarjaenvase,
        ]);
        }
        detalleguia::create([
             'guia_id'=>$this->guia_id,
             'planificacioncosecha_id'=>$almacenamientoEnvase->planificacioncosecha_id,
             'color_id'=>$almacenamientoEnvase->color_id,
             'especie_id'=>$almacenamientoEnvase->especie_id,
             'kilos'=>$almacenamientoEnvase->kilos,
             'tarjaenvase'=>$almacenamientoEnvase->tarjaenvase,
             'almacenamiento_id'=>$almacenamientoEnvase->id,
        ]);
        $almacenamientoEnvase=almacenamiento::where('id',$this->envase_id)->update(['fechaSalida'=>$this->soloFecha->format('Y-m-d')]);
        $this->almacenamientos=almacenamiento::where('fechaSalida',NULL)->get();
        $this->detalleguias=detalleguia::where('guia_id',$this->guia_id)->get();
        $this->detalleenvases=desgloseenvase::where('guia_id',$this->guia_id)->get();
        $this->dispatchBrowserEvent('GuardadoCorrecto', [
            'title' => 'Error, Falta Vehículo o Conductor.',
            'icon'=>'error',
            'iconColor'=>'blue',
        ]);
        return back();
    }
    public function eliminarEnvase($id,$guia_id,$color_id){
        $almID=detalleguia::where('id',$id)->first();
        $this->detalleguias=detalleguia::where('id',$id)->delete();
        $almacenamientoEnvase=almacenamiento::where('id',$almID->almacenamiento_id)->update(['fechaSalida'=>NULL]);
        $buscaEnvase=desgloseenvase::where('guia_id',$guia_id)->where('color_id',$color_id)->first();
        if($buscaEnvase){
            if($buscaEnvase->stock>1){
                $buscaEnvase=desgloseenvase::where('guia_id',$guia_id)->where('color_id',$color_id)->decrement('stock',1);
            }else{
                $buscaEnvase=desgloseenvase::where('guia_id',$guia_id)->where('color_id',$color_id)->delete();
            }
        }

        $this->dispatchBrowserEvent('EliminarRegistro', [
            'title' => 'Error, Falta Vehículo o Conductor.',
            'icon'=>'error',
            'iconColor'=>'blue',
        ]);
        return back();
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
        // $desgloseenvases=desgloseenvase::where('guia_id',$this->guia_id)->first();
        // $this->envaseDesglose=$desgloseenvases->planificacioncosecha->envase_id;
            $desgloseenvasesCosecha=desgloseenvase::where('guia_id',$this->guia_id)->get(); //detaelle de envases usados en la cosecha
            foreach($desgloseenvasesCosecha as $desEnvCos){
                $cuentaEnvaseCliente=cuentaenvase::where('empresa_id',$this->empresa_id)->where('campo_id',$this->campoxCuentaEnvase_id)->where('envase_id',$desEnvCos->planificacioncosecha->envase_id)->first();
                if($cuentaEnvaseCliente){ //si tiene cuenta verifico si tiene el detalle
                    $detalleEnvaseCliente=detallecuentaenvase::where('cuentaenvase_id',$cuentaEnvaseCliente->id)->where('color_id',$desEnvCos->color_id)->first();
                    if($detalleEnvaseCliente){ //si tiene el color
                        detallecuentaenvase::where('cuentaenvase_id',$cuentaEnvaseCliente->id)->where('color_id',$desEnvCos->color_id)->decrement('stock',$desEnvCos->stock);
                        if($detalleEnvaseCliente->stock > $desEnvCos->stock || $detalleEnvaseCliente->stock == $desEnvCos->stock ){ //si tiene suficiente para descontar
                            cuentaenvase::where('empresa_id',$this->empresa_id)->where('campo_id',$this->campoxCuentaEnvase_id)->where('envase_id',$desEnvCos->planificacioncosecha->envase_id)->decrement('saldo',$desEnvCos->stock);
                            envaseempresa::where('campo_id',$this->campoxCuentaEnvase_id)->where('envase_id',$desEnvCos->planificacioncosecha->envase_id)->decrement('stock',$desEnvCos->stock);
                        }else{ //si tiene menos para ser descontado
                            $this->descuentoReal = $detalleEnvaseCliente->stock - $desEnvCos->stock;
                            // dd($this->descuentoReal);
                            if($this->descuentoReal<0){
                                detallecuentaenvase::where('cuentaenvase_id',$cuentaEnvaseCliente->id)->where('color_id',$desEnvCos->color_id)->update(['stock'=>$this->descuentoReal]);
                                cuentaenvase::where('empresa_id',$this->empresa_id)->where('campo_id',$this->campoxCuentaEnvase_id)->where('envase_id',$desEnvCos->planificacioncosecha->envase_id)->update(['saldo'=>$this->descuentoReal]);
                                envaseempresa::where('campo_id',$this->campoxCuentaEnvase_id)->where('envase_id',$desEnvCos->planificacioncosecha->envase_id)->decrement('stock',$detalleEnvaseCliente->stock);
                            }else{
                                cuentaenvase::where('empresa_id',$this->empresa_id)->where('campo_id',$this->campoxCuentaEnvase_id)->where('envase_id',$desEnvCos->planificacioncosecha->envase_id)->decrement('saldo',$this->descuentoReal);
                                detallecuentaenvase::where('cuentaenvase_id',$cuentaEnvaseCliente->id)->where('color_id',$desEnvCos->color_id)->decrement('stock',$this->descuentoReal);
                            }
                        }
                    }else{
                        $this->descuentoReal=$desEnvCos->stock * -1;
                        // dd($this->descuentoReal);
                        detallecuentaenvase::create([
                            'cuentaenvase_id'=>$cuentaEnvaseCliente->id,
                            'color_id'=>$desEnvCos->color_id,
                            'stock'=>$this->descuentoReal,
                        ]);
                    }
                }else{  //sino tiene cuenta de envases el cliente, creo la cuneta y su detalle

                    $cuentaClienteNueva=cuentaenvase::create([
                        'empresa_id'=>$this->empresa_id,
                        'campo_id'=>$this->campoxCuentaEnvase_id,
                        'envase_id'=>$desEnvCos->planificacioncosecha->envase_id,
                        'saldo'=>0,
                        'observacion'=>'Creacion de Cuenta por no existir al despachar',
                    ]);
                    $this->negativo = $this->negativo - $desEnvCos->stock;
                    // dd($this->negativo);
                    detallecuentaenvase::create([
                        'cuentaenvase_id'=>$cuentaClienteNueva->id,
                        'color_id'=>$desEnvCos->color_id,
                        'stock'=>$this->negativo,
                    ]);
                }
            }
            // dd($cuentaEnvases);
            // $exportadoraxpla=detallecuentaenvase::where('cuentaenvase_id',$cuentaEnvases->id)->first();
            // foreach($desgloseenvases as $desgloseenvase){
            //    $detallecuentaEnvases=detallecuentaenvase::where('cuentaenvase_id',$exportadoraxpla->cuentaenvase_id)->where('color_id',$desgloseenvase->color_id)->count();// busca si tiene la cuenta envase y color
            //    $stockColor=detallecuentaenvase::where('cuentaenvase_id',$exportadoraxpla->cuentaenvase_id)->where('color_id',$desgloseenvase->color_id)->first(); 
            //    //$this->diferencia=$stockColor->stock - $desgloseenvase->stock;           
            //    //si tiene cuanta corriente la empresa y ademas el envase y color, le descuenta
            //     if($detallecuentaEnvases>0){
            //         if($stockColor->stock >= $desgloseenvase->stock){ //si con lo que tiene le alcanza para descontar, descuenta, puede quedar en cero
            //             $detallecuentaEnvases=detallecuentaenvase::where('cuentaenvase_id',$exportadoraxpla->cuentaenvase_id)->where('color_id',$desgloseenvase->color_id)->decrement('stock',$desgloseenvase->stock);
            //             $cuentaEnvase=cuentaenvase::where('id',$exportadoraxpla->cuentaenvase_id)->decrement('saldo',$desgloseenvase->stock);
            //             $Campodescuentos=envaseempresa::where('campo_id',$exportadoraxpla->cuentaenvase->campo_id)->where('envase_id',$exportadoraxpla->cuentaenvase->envase_id)->decrement('stock',$desgloseenvase->stock);
            //             //foreach($Campodescuentos as $campoDes){
            //                 //$campoDetalleDescuento=desgloseenvasecampo::where('color_id',$desgloseenvase->color_id)->where('envaseempresa_id',$campoDes->id)->decrement('stock',$desgloseenvase->stock);
            //             //}
            //         }else{
            //             $detallecuentaEnvases=detallecuentaenvase::where('cuentaenvase_id',$exportadoraxpla->cuentaenvase_id)->where('color_id',$desgloseenvase->color_id)->decrement('stock',$desgloseenvase->stock);
            //             $cuentaEnvase=cuentaenvase::where('id',$exportadoraxpla->cuentaenvase_id)->decrement('saldo',$stockColor->stock);
                        
            //             $this->diferencia=$desgloseenvase->stock - $stockColor->stock;

            //             $campodescuento=envaseempresa::where('campo_id',$exportadoraxpla->cuentaenvase->campo_id)->where('envase_id',$exportadoraxpla->cuentaenvase->envase_id)->decrement('stock',$desgloseenvase->stock);
                        
            //             $Campodescuentos=envaseempresa::where('campo_id',$exportadoraxpla->cuentaenvase->campo_id)->where('envase_id',$exportadoraxpla->cuentaenvase->envase_id)->get();
            //             foreach($Campodescuentos as $campoDes){
            //                 $campoDetalleDescuento=desgloseenvasecampo::where('color_id',$desgloseenvase->color_id)->where('envaseempresa_id',$campoDes->id)->decrement('stock',$this->diferencia);
            //             }
            //         }
            //     }else{
            //         $this->diferencia=$desgloseenvase->stock - $stockColor->stock;
            //         $campodescuento=envaseempresa::where('campo_id',$exportadoraxpla->cuentaenvase->campo_id)->where('envase_id',$exportadoraxpla->cuentaenvase->envase_id)->decrement('stock',$desgloseenvase->stock);
            //         $Campodescuentos=envaseempresa::where('campo_id',$exportadoraxpla->cuentaenvase->campo_id)->where('envase_id',$exportadoraxpla->cuentaenvase->envase_id)->get();
            //         foreach($Campodescuentos as $campoDes){
            //             $campoDetalleDescuento=desgloseenvasecampo::where('color_id',$desgloseenvase->color_id)->where('envaseempresa_id',$campoDes->id)->decrement('stock',$this->diferencia);
            //         }
            //         $this->saldoNegativo=0;
            //         $this->saldoNegativo=$this->saldoNegativo - $desgloseenvase->stock;
            //         $this->saldoNegativo=0;
            //         $this->saldoNegativo=$this->saldoNegativo - $desgloseenvase->stock;
            //         detallecuentaenvase::create([
            //             'cuentaenvase_id'=>$exportadoraxpla->cuentaenvase_id,
            //             'color_id'=>$desgloseenvase->color_id,
            //             'stock'=>$this->saldoNegativo,
            //         ]);
            //     }
            // }
        // }

        guia::where('id',$this->guia_id)->update(['emitida'=>1]);
        $this->fecha='';
        $this->tipo='';
        $this->numero='';
        $this->campo_id='';
        $this->empresa_id='';
        $this->direccionCliente='';
        $this->rutCliente='';
        $this->empresa='';
        $this->razonSocial='';
        $this->comunaCliente='';
        $this->emailCliente='';
        $this->giroCliente='';
        $this->conductor_id='';
        $this->vehiculo_id='';
        $this->direccionCampo='';
        $this->guiasSinEmitir_id='';
        $this->guia_id='';
        $this->dispatchBrowserEvent('GuardadoCorrecto', [
            'title' => 'Error, Falta Vehículo o Conductor.',
            'icon'=>'error',
            'iconColor'=>'blue',
        ]);
        return back();
    }
    public function guiasSinEmitir(){
        $guiaSinEmitir=guia::where('id',$this->guiasSinEmitir_id)->first();
        // dd($guiaSinEmitir->fecha);
        $this->fecha=$guiaSinEmitir->fecha;
        $this->tipo=$guiaSinEmitir->tipo;
        $this->numero=$guiaSinEmitir->numero;
        $this->campo_id=$guiaSinEmitir->empresa_id;
        $this->direccionCampo=$guiaSinEmitir->empresa->direccion;
        $this->empresa_id=$guiaSinEmitir->cliente_id;

        $this->rutCliente=$guiaSinEmitir->cliente->rut;
        $this->razonSocial=$guiaSinEmitir->cliente->razon_social;
        $this->direccionCliente=$guiaSinEmitir->cliente->direccion;
        $this->comunaCliente=$guiaSinEmitir->cliente->comuna->comuna;
        $this->emailCliente=$guiaSinEmitir->cliente->email;
        $this->giroCliente=$guiaSinEmitir->cliente->giro;
        $this->conductor_id=$guiaSinEmitir->conductor_id;
        $this->vehiculo_id=$guiaSinEmitir->vehiculo_id;
        $this->deshabilitarCrear=false;
        $this->visible=true;
        $this->guia_id=$guiaSinEmitir->id;
        $this->campoxCuentaEnvase_id=$guiaSinEmitir->campo_id;
    }    

    public function render()
    {
    
        // $planificacioncosecha=planificacioncosecha::with('exportadoraxplanificacion.desgloseenvase','contraistaxplanificacion','detallecosecha')->whereBetween('updated_at', [$this->fechainicial . ' 00:00:00', $this->fechafinal . ' 23:59:59'])->where('finalizada','!=',NULL)->get();
        $this->clientes=empresa::where('tipo_id',4)->get();
        $this->empresas=empresa::where('tipo_id',1)->get();
        $this->campoLista=campo::where('empresa_id',$this->campo_id)->get();
        $this->almacenamientos=almacenamiento::where('fechaSalida',NULL)->get();
        $this->guias=guia::where('emitida',NULL)->get();
        $this->detalleguias=detalleguia::where('guia_id',$this->guia_id)->get();
        $this->detalleenvases=desgloseenvase::where('guia_id',$this->guia_id)->get();
        $vehiculos=vehiculo::all();
        $conductores=User::where('tipo_id',6)->get();          
        return view('livewire.guias.crud-guias',compact('conductores','vehiculos'));
    }
}
