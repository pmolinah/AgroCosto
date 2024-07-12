<?php

namespace App\Http\Livewire\Devolucion;

use Livewire\Component;
use App\Models\campo;
use App\Models\empresa;
use App\Models\User;
use App\Models\vehiculo;
use App\Models\envase;
use App\Models\color;
use App\Models\devoluciontraspaso;
use App\Models\devoluciontraspasodetalle;
use App\Models\envaseempresa;
use App\Models\desgloseenvasecampo;
use App\Models\cuentaenvase;
use App\Models\detallecuentaenvase;
use Illuminate\Support\Facades\Session;
class DevolucionEnvases extends Component
{
    public $visible=false;
    public $fechaGuia,$campo_id,$campoID,$exportadora_id,$NumGuiaRec;
    public $rutDestino,$destino,$direccionDestino,$comunaDestino,$emailDestino,$giroDestino,$conductor_id,$vehiculo_id,$observacion;
    public $seleccion=1;
    public $visibleCampo=true;
    public $visibleExportadora=false;
    public $destinoType;
    public $Cantidad,$envase_id,$color_id;
    public $nDevTras;
    public $saldoNegativo=0;

    public $devoluciontraspasoparaDetalle=array();

    public function SeleccionCampo_id(){
        $campo=campo::where('id',$this->campo_id)->get();
        foreach($campo as $campo){
            $this->NombreCampo=$campo->campo;
            $this->DireccionCampo=$campo->direccion;
        }
    }
    public function SeleccionTipo(){
  
        if($this->seleccion==1){
            $this->visibleCampo=true;
            $this->visibleExportadora=false;
        }elseif($this->seleccion==2){
            $this->visibleCampo=false;
            $this->visibleExportadora=true;
        }
    }
    public function SeleccionCampoID(){
        $campo=campo::where('id',$this->campoID)->get();
        foreach($campo as $campo){
            $this->rutDestino=$campo->rut;
            $this->destino=$campo->campo;
            $this->direccionDestino=$campo->direccion;
            $this->comunaDestino=$campo->comuna->comuna;
            $this->emailDestino="N/A";
            $this->giroDestino="N/A";
        }
    }
    public function SeleccionExportadora_id(){
        $exportadora=empresa::where('id',$this->exportadora_id)->get();
        foreach($exportadora as $exp){
            $this->rutDestino=$exp->rut;
            $this->destino=$exp->razon_social;
            $this->direccionDestino=$exp->direccion;
            $this->comunaDestino=$exp->comuna->comuna;
            $this->emailDestino=$exp->email;
            $this->giroDestino=$exp->giro;
        }
    }
    public function AgregarDetalleCampo(){
        if($this->fechaGuia==NULL || $this->campo_id==NULL || $this->campoID==NULL  || $this->conductor_id==NULL || $this->vehiculo_id==NULL){
            $this->dispatchBrowserEvent('ErrorFaltanDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }


        $this->destinoType='campo';
        $devoluciontraspaso=devoluciontraspaso::where('destino_id',$this->campoID)->where('destino_type',$this->destinoType)->where('fecha',$this->fechaGuia)->where('campo_id',$this->campo_id)->where('emitida',NULL)->count();
        //dd($devoluciontraspaso);
        if($devoluciontraspaso<1){
            $dev=devoluciontraspaso::create([
                'campo_id' => $this->campo_id,
                'destino_id' => $this->campoID,
                'destino_type' => $this->destinoType, 
                'fecha' => $this->fechaGuia,
                'conductor_id' => $this->conductor_id,
                'vehiculo_id' => $this->vehiculo_id, 
                'tipo' => $this->seleccion,       
                'observacion' => $this->observacion,
            ]);
            $dev->update(['numero'=>$dev->id+1000]);
            $this->NumGuiaRec=$dev->id+1000;
            
        }else{
            $devoluciontraspaso=devoluciontraspaso::where('destino_id',$this->campoID)->where('destino_type',$this->destinoType)->where('fecha',$this->fechaGuia)->where('campo_id',$this->campo_id)->where('emitida',NULL)->get();
            foreach($devoluciontraspaso as $num){
                $this->NumGuiaRec=$num->numero;

            }
        }
        $this->visible=true;
        $this->devoluciontraspasoparaDetalle=devoluciontraspaso::with('devoluciontraspasodetalle')->where('destino_id',$this->campoID)->where('destino_type',$this->destinoType)->where('fecha',$this->fechaGuia)->where('campo_id',$this->campo_id)->where('emitida',NULL)->get();

    }
    public function AgregarDetalleExportadora(){
        if($this->conductor_id==NULL || $this->vehiculo_id==NULL){
            $this->dispatchBrowserEvent('ErrorCampoVacio', [
                'title' => 'Error, Falta Vehículo o Conductor.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
        $this->destinoType='empresa';

        $devoluciontraspaso=devoluciontraspaso::where('destino_id',$this->exportadora_id)->where('destino_type',$this->destinoType)->where('fecha',$this->fechaGuia)->where('campo_id',$this->campo_id)->where('emitida',NULL)->count();
        //dd($devoluciontraspaso);
        if($devoluciontraspaso<1){
            $dev=devoluciontraspaso::create([
                'campo_id' => $this->campo_id,
                'destino_id' => $this->exportadora_id,
                'destino_type' => $this->destinoType, 
                'fecha' => $this->fechaGuia,
                'conductor_id' => $this->conductor_id,
                'vehiculo_id' => $this->vehiculo_id, 
                'tipo' => $this->seleccion,       
                'observacion' => $this->observacion,
                'NombreDestino'=>$this->destino,
            ]);
            $dev->update(['numero'=>$dev->id+1000]);
            $this->NumGuiaRec=$dev->id+1000;
            
        }else{
            $devoluciontraspaso=devoluciontraspaso::where('destino_id',$this->exportadora_id)->where('destino_type',$this->destinoType)->where('fecha',$this->fechaGuia)->where('campo_id',$this->campo_id)->where('emitida',NULL)->get();
            foreach($devoluciontraspaso as $num){
                $this->NumGuiaRec=$num->numero;

            }
        }
        $this->visible=true;
        $this->devoluciontraspasoparaDetalle=devoluciontraspaso::with('devoluciontraspasodetalle')->where('destino_id',$this->exportadora_id)->where('destino_type',$this->destinoType)->where('fecha',$this->fechaGuia)->where('campo_id',$this->campo_id)->where('emitida',NULL)->get();

    }

    public function AgregarLinea(){
        if($this->Cantidad==NULL || $this->envase_id==NULL || $this->color_id==NULL){
            $this->dispatchBrowserEvent('ErrorFaltanDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
        if($this->seleccion==1){
            $this->destinoType='campo';
            $this->destino=$this->campoID;
        }else{
            $this->destinoType='empresa';
        
            $this->destino=$this->exportadora_id;
        }
   
        $this->devoluciontraspasoparaDetalle=devoluciontraspaso::with('devoluciontraspasodetalle')->where('destino_id',$this->destino)->where('destino_type',$this->destinoType)->where('fecha',$this->fechaGuia)->where('campo_id',$this->campo_id)->where('emitida',NULL)->get();
        foreach($this->devoluciontraspasoparaDetalle as $devolucion){
            $this->nDevTras = $devolucion->id;
        }
        devoluciontraspasodetalle::create([
            'devoluciontraspaso_id'=>$this->nDevTras,
            'envase_id'=>$this->envase_id,
            'color_id'=>$this->color_id,
            'cantidadEnvases'=>$this->Cantidad,
        ]);
        $this->devoluciontraspasoparaDetalle=devoluciontraspaso::with('devoluciontraspasodetalle')->where('destino_id',$this->destino)->where('destino_type',$this->destinoType)->where('fecha',$this->fechaGuia)->where('campo_id',$this->campo_id)->where('emitida',NULL)->get();
        
    }
    public function QuitarLinea($id){
        devoluciontraspasodetalle::where('id',$id)->delete();
        if($this->seleccion==1){
            $this->destinoType='campo';
        }else{
            $this->destinoType='empresa';
        }
        $this->devoluciontraspasoparaDetalle=devoluciontraspaso::with('devoluciontraspasodetalle')->where('destino_id',$this->destino)->where('destino_type',$this->destinoType)->where('fecha',$this->fechaGuia)->where('campo_id',$this->campo_id)->where('emitida',NULL)->get();
    }
    public function generarGuiaDevolucionTraspaso(){
        if($this->seleccion==1){
            $this->destinoType='campo';
            $detalleDevolucionTraspasos=devoluciontraspaso::with('devoluciontraspasodetalle')->where('campo_id',$this->campo_id)->where('destino_id',$this->campoID)->where('destino_type',$this->destinoType)->where('fecha',$this->fechaGuia)->where('emitida',NULL)->get();
            foreach($detalleDevolucionTraspasos as $detalleDevolucionTraspaso){
                foreach($detalleDevolucionTraspaso->devoluciontraspasodetalle as $detalleDevolucion){
                    $buscacuentaEmpresaEnvia=envaseempresa::where('campo_id',$this->campo_id)->where('envase_id',$detalleDevolucion->envase_id)->count();
                    if($buscacuentaEmpresaEnvia>0){
                        envaseempresa::where('campo_id',$this->campo_id)->where('envase_id',$detalleDevolucion->envase_id)->decrement('stock',$detalleDevolucion->cantidadEnvases);
                            $envaseEmpresaCuenta=envaseempresa::where('campo_id',$this->campo_id)->where('envase_id',$detalleDevolucion->envase_id)->get();
                            foreach($envaseEmpresaCuenta as $EmpresaCuentaID){
                                $buscarEnvaseColor=desgloseenvasecampo::where('envaseempresa_id',$EmpresaCuentaID->id)->where('color_id',$detalleDevolucion->color_id)->count();
                                if($buscarEnvaseColor>0){//color del que envía
                                    desgloseenvasecampo::where('envaseempresa_id',$EmpresaCuentaID->id)->where('color_id',$detalleDevolucion->color_id)->decrement('stock',$detalleDevolucion->cantidadEnvases);
                                    $buscaCuentaRecibe=envaseempresa::where('campo_id',$this->campoID)->where('envase_id',$detalleDevolucion->envase_id)->count();
                                    if($buscaCuentaRecibe>0){ //busqueda de la cuenta de la empresa que recibe
                                        $buscaCuentaRecibe=envaseempresa::where('campo_id',$this->campoID)->where('envase_id',$detalleDevolucion->envase_id)->increment('stock',$detalleDevolucion->cantidadEnvases);
                                            $cuentaEmpresaRecibeID=envaseempresa::where('campo_id',$this->campoID)->where('envase_id',$detalleDevolucion->envase_id)->get();
                                            foreach($cuentaEmpresaRecibeID as $CuentaEnvaseRecibeID){
                                                $buscaColorEmpresaRecibe=desgloseenvasecampo::where('envaseempresa_id',$CuentaEnvaseRecibeID->id)->where('color_id',$detalleDevolucion->color_id)->count();
                                                if($buscaColorEmpresaRecibe>0){
                                                    desgloseenvasecampo::where('envaseempresa_id',$CuentaEnvaseRecibeID->id)->where('color_id',$detalleDevolucion->color_id)->increment('stock',$detalleDevolucion->cantidadEnvases);
                                                }else{
                                                    desgloseenvasecampo::create([
                                                        'envaseempresa_id'=>$CuentaEnvaseRecibeID->id,
                                                        'color_id'=>$detalleDevolucion->color_id,
                                                        'stock'=>$detalleDevolucion->cantidadEnvases,
                                                    ]);
                                                }
                                            }
                                    }else{
                                        $creacionCuentaEmpresaRecibe=envaseempresa::create([
                                            'campo_id'=>$this->campoID,
                                            'envase_id'=>$detalleDevolucion->envase_id,
                                            'stock'=>$detalleDevolucion->cantidadEnvases,
                                        ]);
                                        desgloseenvasecampo::create([
                                            'envaseempresa_id'=>$creacionCuentaEmpresaRecibe->id,
                                            'color_id'=>$detalleDevolucion->color_id,
                                            'stock'=>$detalleDevolucion->cantidadEnvases,
                                        ]);
                                    }
                                }else{
                                    $this->saldoNegativo=0;
                                    $this->saldoNegativo = $this->saldoNegativo - $detalleDevolucion->cantidadEnvases;
                                    //dd($detalleDevolucion->color_id);
                                        desgloseenvasecampo::create([
                                        'envaseempresa_id'=>$EmpresaCuentaID->id,
                                        'color_id'=>$detalleDevolucion->color_id,
                                        'stock'=>$this->saldoNegativo,
                                    ]);
                                    $buscacuentaEmpresaRecibe=envaseempresa::where('campo_id',$this->campoID)->where('envase_id',$detalleDevolucion->envase_id)->count();
                                    if($buscacuentaEmpresaRecibe>0){
                                        $buscacuentaEmpresaRecibeID=envaseempresa::where('campo_id',$this->campoID)->where('envase_id',$detalleDevolucion->envase_id)->get();
                                        // envaseempresa::where('campo_id',$this->campoID)->where('envase_id',$detalleDevolucion->envase_id)->increment('stock',$detalleDevolucion->cantidadEnvases);
                                        foreach($buscacuentaEmpresaRecibeID as $CuentaEmpresaRecibeEnvaseID){
                                            $buscaColorEmpresaRecibe=desgloseenvasecampo::where('envaseempresa_id',$CuentaEmpresaRecibeEnvaseID->id)->where('color_id',$detalleDevolucion->color_id)->count();
                                            if($buscaColorEmpresaRecibe>0){
                                                desgloseenvasecampo::where('envaseempresa_id',$CuentaEmpresaRecibeEnvaseID->id)->where('color_id',$detalleDevolucion->color_id)->increment('stock',$detalleDevolucion->cantidadEnvases);
                                                envaseempresa::where('campo_id',$this->campoID)->where('envase_id',$detalleDevolucion->envase_id)->increment('stock',$detalleDevolucion->cantidadEnvases);
                                            }else{
                                                envaseempresa::where('campo_id',$this->campoID)->where('envase_id',$detalleDevolucion->envase_id)->increment('stock',$detalleDevolucion->cantidadEnvases);
                                                $this->saldoNegativo=0;
                                                $this->saldoNegativo = $this->saldoNegativo - $detalleDevolucion->cantidadEnvases;
                                                desgloseenvasecampo::create([
                                                    'envaseempresa_id'=>$CuentaEmpresaRecibeEnvaseID->id,
                                                    'color_id'=>$detalleDevolucion->color_id,
                                                    'stock'=>$detalleDevolucion->cantidadEnvases,
                                                ]);
                                            }
                                        }
                                    }
                                }
                            }
                    }else{
                        $this->saldoNegativo=0;
                        $this->saldoNegativo = $this->saldoNegativo - $detalleDevolucion->cantidadEnvases;
                        $creacionCuentaEmpresa=envaseempresa::create([
                            'campo_id'=>$this->campo_id,
                            'envase_id'=>$detalleDevolucion->envase_id,
                            'stock'=>$this->saldoNegativo,
                        ]);
                        desgloseenvasecampo::create([
                            'envaseempresa_id'=>$creacionCuentaEmpresa->id,
                            'color_id'=>$detalleDevolucion->color_id,
                            'stock'=>$this->saldoNegativo,
                        ]);
                    }
                }
            }
            
            foreach ($detalleDevolucionTraspasos as $Actualizar) {
                $Actualizar->update(['observacion'=>$this->observacion,'emitida'=>1]);        
            }   
            Session::flash('success', 'Devolción Realizada Correctamente..');
            return redirect()->route('Devolucion.Envases');
        }else{
            //creacion de guia de devolcion a exportadoras
            $this->destinoType='empresa';
            $detalleDevolucionTraspasoss=devoluciontraspaso::with('devoluciontraspasodetalle')->where('campo_id',$this->campo_id)->where('destino_id',$this->exportadora_id)->where('destino_type',$this->destinoType)->where('fecha',$this->fechaGuia)->where('emitida',NULL)->get();
           
            foreach($detalleDevolucionTraspasoss as $detalleDevolucionTraspasos){
                foreach($detalleDevolucionTraspasos->devoluciontraspasodetalle as $detalleDevolucionTraspaso){
               
                    $cuentaCampoEnvia=envaseempresa::where('campo_id',$this->campo_id)->where('envase_id',$detalleDevolucionTraspaso->envase_id)->count();
                    if($cuentaCampoEnvia>0){
                        $descuentoempresaenvase=envaseempresa::where('campo_id',$this->campo_id)->where('envase_id',$detalleDevolucionTraspaso->envase_id)->decrement('stock',$detalleDevolucionTraspaso->cantidadEnvases);

                    }else{
                        envaseempresa::create([
                            'campo_id'=>$this->campo_id,
                            'envase_id'=>$detalleDevolucionTraspaso->envase_id,
                            'stock'=>0,
                        ]);
                    }
                    $buscarCuentaEnvaseRecibe=cuentaenvase::where('empresa_id',$this->exportadora_id)->where('envase_id',$detalleDevolucionTraspaso->envase_id)->count();
                    if($buscarCuentaEnvaseRecibe>0){
                        cuentaenvase::where('empresa_id',$this->exportadora_id)->where('envase_id',$detalleDevolucionTraspaso->envase_id)->decrement('saldo',$detalleDevolucionTraspaso->cantidadEnvases);
                        $cuentaEnvaseIDrecibe=cuentaenvase::where('empresa_id',$this->exportadora_id)->where('envase_id',$detalleDevolucionTraspaso->envase_id)->get();
                        foreach($cuentaEnvaseIDrecibe as $cuentaEnvaseIDrecibe){
                            $detalleCuentaEnvaseRecibe=detallecuentaenvase::where('cuentaenvase_id',$cuentaEnvaseIDrecibe->id)->where('color_id',$detalleDevolucionTraspaso->color_id)->count();
                            if($detalleCuentaEnvaseRecibe>0){
                                detallecuentaenvase::where('cuentaenvase_id',$cuentaEnvaseIDrecibe->id)->where('color_id',$detalleDevolucionTraspaso->color_id)->decrement('stock',$detalleDevolucionTraspaso->cantidadEnvases);
                            }else{
                                 detallecuentaenvase::create([   
                                    'cuentaenvase_id'=>$cuentaEnvaseIDrecibe->id,    
                                    'color_id'=>$detalleDevolucionTraspaso->color_id,
                                    'stock'=>0,
                                    ]);
                            }  
                        }
                    }else{
                        $cuentaIDnueva=cuentaenvase::create([
                            'empresa_id'=>$this->exportadora_id,
                            'envase_id'=>$detalleDevolucionTraspaso->envase_id,
                            'saldo'=>0,
                            'campo_id'=>$this->campo_id,
                        ]);
                        detallecuentaenvase::create([
                            'cuentaenvase_id'=>$cuentaIDnueva->id,
                            'color_id'=>$detalleDevolucionTraspaso->color_id,
                            'stock'=>0
                        ]);
                    }
                }
            }
        }
        $detalleDevolucionTraspasos->update(['observacion'=>$this->observacion,'emitida'=>1]);           
                Session::flash('success', 'Devolción Realizada Correctamente..');
                return redirect()->route('Devolucion.Envases');
               
        }
                             
    public function render()
    {
        $campos=campo::all();
        $exportadoras=empresa::where('tipo_id',4)->get();
        $conductores=User::where('tipo_id',6)->get();
        $vehiculos=vehiculo::all();
        $envases=envase::all();
        $colores=color::all();
        return view('livewire.devolucion.devolucion-envases',compact('campos','exportadoras','conductores','vehiculos','envases','colores'));
    }
}
