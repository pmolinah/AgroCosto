<?php

namespace App\Http\Livewire\Cuentas;

use Livewire\Component;
use App\Models\banco;
use App\Models\concepto;
use App\Models\empresa;
use App\Models\campo;
use App\Models\cuartel;
use App\Models\cuenta;
use App\Models\movimiento;
use App\Models\bodega;
use App\Models\detallemovimiento;
use App\Models\item;
use App\Models\ingresobodega;
use App\Models\detingresobodega;
use App\Models\inventario;
class Conciliacion extends Component
{
    public $entidad,$contacto,$email,$totalAbonos=0,$totalCargos=0,$totalAbonosPendiente=0,$totalCargosPendiente=0;
    public $concepto,$entidad_id,$cuenta,$saldo_inicial,$det,$ite,$can,$pre,$tot,$movimiento_id,$items=[],$bodegas=[];
    public $buscarBanco_id,$fechai,$fechaf,$empresa_id,$campo_id,$actualizarDocumento,$actualizarFormaPago,$actualizarImporte,$actualizarFecha,$actualizarConcepto,$actualizarCliente,$actualizarTipo,$actualizarID,$actualizarCuenta;
    public $bancoIngresos=[],$cuentaIngresos=[],$bancoIngresos_id,$cuentaIngresos_id,$conceptoIngreso_id,$cliente_id,$tipo_id,$formapago_id,$ndocumento,$importe,$fecha,$cuartel_id;
    public $entidades=[],$conceptos=[],$cuentas=[],$movimientos=[],$detalleMovimientoActualizar;
    public $empresas=[],$campos=[],$cuarteles=[],$cantidadCuarteles=[],$detalleMovimiento=[];
    public $buscarBancos=[],$buscarCuentas=[],$buscarCuenta_id,$prorroteo,$montoProrroteo=0,$campoyCuarteles=0;
    public $item_id,$unidadMedida,$presentacion,$contenido,$cantidad,$precio,$vencimiento,$bodega_id,$total;

    public function saveEntidad(){
        banco::create([
            'banco'=>$this->entidad,
            'contacto'=>$this->contacto,
            'mail'=>$this->email,
        ]);
    }
    public function saveConcepto(){
        concepto::create([
            'concepto'=>$this->concepto,

        ]);
    }
    public function saveCuenta(){
        cuenta::create([
            'banco_id'=>$this->entidad_id,
            'cuenta'=>$this->cuenta,
            'saldo_inicial'=>$this->saldo_inicial,
            'saldo_real'=>$this->saldo_inicial,
        ]);

    }
    public function buscarBancoCambio(){
        $this->buscarCuentas=cuenta::where('banco_id',$this->buscarBanco_id)->get();
    }
    public function bancoIngresoCambio(){
        $this->cuentaIngresos=cuenta::where('banco_id',$this->bancoIngresos_id)->get();
    }
    public function cambioEmpresa(){
        $this->campos=campo::where('empresa_id',$this->empresa_id)->get();
    }
    public function cambioCampo(){
        $this->cuarteles=cuartel::where('campo_id',$this->campo_id)->get();
    }
    public function modalDetalleMovimiento($id){
        // dd($id);
        // $this->detalleMovimiento=detallemovimiento::where('movimiento_id',$id)->get();
        // dd($this->detalleMovimiento);
        $this->ite="";
        $this->can="";
        $this->pre="";
        $this->items=item::all();
        $this->movimiento_id=$id;
        $this->detalleMovimiento = detallemovimiento::where('movimiento_id',$id)->get(); // Carga los datos
        $this->emit('openModal');
    }
    public function ActualizarMovimiento($id){
        movimiento::where('id',$id)->update(['formapago_id'=>$this->actualizarFormaPago,'ndocumento'=>$this->actualizarDocumento,'importe'=>$this->actualizarImporte,'estado'=>1]);
        if($this->actualizarTipo==1){
            cuenta::where('id',$this->actualizarCuenta)->increment('saldo_real',$this->actualizarImporte);
        }else{
            cuenta::where('id',$this->actualizarCuenta)->decrement('saldo_real',$this->actualizarImporte);
        }
        $this->buscarMovimientos();
        $this->dispatchBrowserEvent('GuardadoCorrecto', [
            'title' => 'Error, Faltan Datos.',
            'icon'=>'error',
            'iconColor'=>'blue',
        ]);
        return back();
    }
    public function closeModal()
    {
        $this->emit('closeModal');
    }
    public function modalActualizacionDetalleMovimiento($id){
        $this->detalleMovimientoActualizar=movimiento::where('id',$id)->first();
        $this->actualizarFecha=$this->detalleMovimientoActualizar->fecha;
        $this->actualizarConcepto=$this->detalleMovimientoActualizar->concepto->concepto;
        $this->actualizarCliente=$this->detalleMovimientoActualizar->cliente->razon_social;
        $this->actualizarTipo=$this->detalleMovimientoActualizar->tipo_id;
        $this->actualizarFormaPago=$this->detalleMovimientoActualizar->formapago_id;
        $this->actualizarDocumento=$this->detalleMovimientoActualizar->ndocumento;
        $this->actualizarImporte=$this->detalleMovimientoActualizar->importe;
        $this->actualizarID=$this->detalleMovimientoActualizar->id;
        $this->actualizarCuenta=$this->detalleMovimientoActualizar->cuenta_id;
        $this->emit('openModalActualizar');
    }
    public function sumaDetalle(){
        // dd($this->movimiento_id);
        $saveDetalle=detallemovimiento::create([
            'movimiento_id'=>$this->movimiento_id,
            'item_id'=>$this->item_id,
            'cantidad'=>$this->cantidad,
            'precio'=>$this->precio,
            'presentacion'=>$this->presentacion,
            //'lineaInventario'=>$this->lineaInventario,
            'contenido'=>$this->contenido,
            'vencimiento'=>$this->vencimiento,
            'bodega_id'=>$this->bodega_id,

        ]);

        //falta crear la factura o guia de ingreso 
        $datosMovimiento=movimiento::where('id',$this->movimiento_id)->first();
        $buscarIngresoBodega=ingresobodega::where('fecha',$datosMovimiento->fecha)->where('proveedor_id',$datosMovimiento->cliente_id)->where('numero',$datosMovimiento->ndocumento)->where('tipoDocumento_id',$datosMovimiento->formapago_id)->first();
        if($buscarIngresoBodega){
            $detingresobodega=detingresobodega::create([
                'ingresobodega_id'=>$buscarIngresoBodega->id,
                'bodega_id'=>$this->bodega_id,
                'NumFacGuia'=>$datosMovimiento->numero,
                'item_id'=>$this->item_id,
                'cantidad'=>$this->cantidad,
                'contenido'=>$this->contenido,
                'presentacion'=>$this->presentacion,
                'precioUnitario'=>$this->precio,
                'vencimiento'=>$this->vencimiento,
            ]);

            
        //se agrega al inventario //
        if($this->unidadMedida==1 || $this->unidadMedida==2){
            $this->total=$this->cantidad*($this->contenido*1000);
        }elseif($this->unidadMedida==3){
            $this->total=$this->cantidad*$this->contenido;
        }else{
            $this->total=$this->cantidad*($this->contenido*100);
        }
        $item=item::where('id',$this->item_id)->first();
        $this->pivote=$datosMovimiento->ndocumento.'-'.$datosMovimiento->cliente_id.'-'.$datosMovimiento->formapago_id;
        $inventario=inventario::create([
            'item_id'=>$this->item_id,
            'bodega_id'=>$this->bodega_id,
            'cantidad'=>$this->cantidad,
            'contenido'=>$this->contenido,
            'contenidoTotal'=>$this->total,
            'utilizado'=>0,
            'presentacion'=>$this->presentacion,
            'precioUnitario'=>$this->precio,
            'stockMinimo'=>$item->stockMinimo,
            'pivote'=>$this->pivote,
            'vencimiento'=>$this->vencimiento,
            'ingresobodega_id'=>$buscarIngresoBodega->id,                                 //id de la factura de ingreso
            'lineaFactura_id'=>$detingresobodega->id,    // linea de detalle de la factura de ingreso
            'resto'=>$this->total,
        ]);
        detallemovimiento::where('id',$saveDetalle->id)->update(['lineaInventario_id'=>$inventario->id,'lineaDerIngresoBodega_id'=>$detingresobodega->id]);
        // fin ingreso inventario //
            
        }else{
            $this->pivote=$datosMovimiento->ndocumento.'-'.$datosMovimiento->cliente_id.'-'.$datosMovimiento->formapago_id;
            $ingresoBodega=ingresobodega::create([
                'fecha'=>$datosMovimiento->fecha,
                'tipoDocumento_id'=>$datosMovimiento->formapago_id,
                'proveedor_id'=>$datosMovimiento->cliente_id,
                'numero'=>$datosMovimiento->ndocumento,
                'campo_id'=>$datosMovimiento->campo_id,
                'total'=>$datosMovimiento->importe,
                'pivote'=>$this->pivote,
                'emitida'=>1,
            ]);
            $detingresobodega=detingresobodega::create([
                'ingresobodega_id'=>$ingresoBodega->id,
                'bodega_id'=>$this->bodega_id,
                'NumFacGuia'=>$this->ndocumento,
                'item_id'=>$this->item_id,
                'cantidad'=>$this->cantidad,
                'contenido'=>$this->contenido,
                'presentacion'=>$this->presentacion,
                'precioUnitario'=>$this->precio,
                'vencimiento'=>$this->vencimiento,
            ]);

             //se agrega al inventario //
            if($this->unidadMedida==1 || $this->unidadMedida==2){
                $this->total=$this->cantidad*($this->contenido*1000);
            }elseif($this->unidadMedida==3){
                $this->total=$this->cantidad*$this->contenido;
            }else{
                $this->total=$this->cantidad*($this->contenido*100);
            }
            $item=item::where('id',$this->item_id)->first();
            $inventario=inventario::create([
                'item_id'=>$this->item_id,
                'bodega_id'=>$this->bodega_id,
                'cantidad'=>$this->cantidad,
                'contenido'=>$this->contenido,
                'contenidoTotal'=>$this->total,
                'utilizado'=>0,
                'presentacion'=>$this->presentacion,
                'precioUnitario'=>$this->precio,
                'stockMinimo'=>$item->stockMinimo,
                'pivote'=>$this->pivote,
                'vencimiento'=>$this->vencimiento,
                'ingresobodega_id'=>$ingresoBodega->id,                                 //id de la factura de ingreso
                'lineaFactura_id'=>$detingresobodega->id,                               // linea de detalle de la factura de ingreso
                'resto'=>$this->total,
            ]);
            detallemovimiento::where('id',$saveDetalle->id)->update(['lineaInventario_id'=>$inventario->id,'lineaDerIngresoBodega_id'=>$detingresobodega->id]);
        // fin ingreso inventario //
        }




        $this->detalleMovimiento = detallemovimiento::where('movimiento_id',$this->movimiento_id)->get(); // Carga los datos
        $this->emit('openModal');
    }
    public function eliminaSumaDetalle($id){
        $detallemovimiento=detallemovimiento::where('id',$id)->first();
        inventario::where('id',$detallemovimiento->lineaInventario_id)->delete();
        detingresobodega::where('id',$detallemovimiento->lineaDerIngresoBodega_id)->delete();
        detallemovimiento::where('id',$id)->delete();
        $this->detalleMovimiento = detallemovimiento::where('movimiento_id',$this->movimiento_id)->get(); // Carga los datos
        $this->emit('openModal');
    }
    public function EjecutarLinea(){
        // dd($this->prorroteo);
        if($this->empresa_id==null || $this->campo_id==null || $this->cantidadCuarteles==null || $this->fecha==null || $this->cuentaIngresos_id==null || $this->cliente_id==null || $this->tipo_id==null || $this->importe==null){
            $this->dispatchBrowserEvent('ErrorFaltanDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
        $this->campoyCuarteles=count($this->cantidadCuarteles);
        $this->montoProrroteo=$this->importe/$this->campoyCuarteles;

        foreach($this->cantidadCuarteles as $cuartelID){
            $mov=movimiento::create([
                'empresa_id'=>$this->empresa_id,
                'campo_id'=>$this->campo_id,
                'cuartel_id'=>$cuartelID,
                'fecha'=>$this->fecha,
                'cuenta_id'=>$this->cuentaIngresos_id,
                'concepto_id'=>$this->conceptoIngreso_id,
                'cliente_id'=>$this->cliente_id,
                'formapago_id'=>$this->formapago_id,
                'tipo_id'=>$this->tipo_id,
                'ndocumento'=>$this->ndocumento,
                'importe'=>$this->importe,
                'prorroteo'=>$this->campoyCuarteles,
                'montoProrroteo'=>$this->montoProrroteo,
                'estado'=>1,
            ]);
        }
        if($this->tipo_id==1){
            cuenta::where('id',$this->cuentaIngresos_id)->increment('saldo_real',$this->importe);
        }else{
            cuenta::where('id',$this->cuentaIngresos_id)->decrement('saldo_real',$this->importe);
        }
        $this->movimientos=movimiento::where('created_at',$mov->created_at)->get();
    }
    public function GrabarLineaPendiente(){
        $this->campoyCuarteles=count($this->cantidadCuarteles);
        $this->montoProrroteo=$this->importe/$this->campoyCuarteles;

        foreach($this->cantidadCuarteles as $cuartelID){
            $mov=movimiento::create([
                'empresa_id'=>$this->empresa_id,
                'campo_id'=>$this->campo_id,
                'cuartel_id'=>$cuartelID,
                'fecha'=>$this->fecha,
                'cuenta_id'=>$this->cuentaIngresos_id,
                'concepto_id'=>$this->conceptoIngreso_id,
                'cliente_id'=>$this->cliente_id,
                'formapago_id'=>$this->formapago_id,
                'tipo_id'=>$this->tipo_id,
                'ndocumento'=>$this->ndocumento,
                'importe'=>$this->importe,
                'prorroteo'=>$this->campoyCuarteles,
                'montoProrroteo'=>$this->montoProrroteo,
                'estado'=>2,
            ]);
            $this->movimientos=movimiento::where('created_at',$mov->created_at)->get();
        }
    }
    public function buscarMovimientos(){
        $this->movimientos = Movimiento::where('cuenta_id', $this->buscarCuenta_id)->whereBetween('fecha', [$this->fechai, $this->fechaf])->get();
        $this->totalCargos = Movimiento::where('cuenta_id', $this->buscarCuenta_id)->whereBetween('fecha', [$this->fechai, $this->fechaf])->where('tipo_id',2)->where('estado',1)->sum('montoProrroteo');
        $this->totalAbonos = Movimiento::where('cuenta_id', $this->buscarCuenta_id)->whereBetween('fecha', [$this->fechai, $this->fechaf])->where('tipo_id',1)->where('estado',1)->sum('montoProrroteo');
        $this->totalCargosPendiente = Movimiento::where('cuenta_id', $this->buscarCuenta_id)->whereBetween('fecha', [$this->fechai, $this->fechaf])->where('tipo_id',2)->where('estado',2)->sum('montoProrroteo');
        $this->totalAbonosPendiente = Movimiento::where('cuenta_id', $this->buscarCuenta_id)->whereBetween('fecha', [$this->fechai, $this->fechaf])->where('tipo_id',1)->where('estado',2)->sum('montoProrroteo');
    }
    public function eliminaLineaCargoAbono($id){
        $movimiento=movimiento::find($id);
        // dd($movimiento->detallemovimiento()->count());
        if($movimiento->detallemovimiento()->count()>0){
            $this->dispatchBrowserEvent('ErrorTieneDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }else{
            movimiento::find($id)->delete();
            $this->movimientos = Movimiento::where('cuenta_id', $this->buscarCuenta_id)->whereBetween('fecha', [$this->fechai, $this->fechaf])->get();
            $this->totalCargos = Movimiento::where('cuenta_id', $this->buscarCuenta_id)->whereBetween('fecha', [$this->fechai, $this->fechaf])->where('tipo_id',2)->sum('montoProrroteo');
        $this->totalAbonos = Movimiento::where('cuenta_id', $this->buscarCuenta_id)->whereBetween('fecha', [$this->fechai, $this->fechaf])->where('tipo_id',1)->sum('montoProrroteo');
            $this->dispatchBrowserEvent('EliminarRegistro', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
    }
    public function CambiaSeleccionItem(){

        $ItemSeleccion=item::where('id',$this->item_id)->first();
        // $this->item_id=$ItemSeleccion['id'];
        $this->unidadMedida=$ItemSeleccion->unidadMedida;
        $this->emit('openModal');
        // $this->presentacion=$ItemSeleccion->presentacion;
        // $this->QrBarra=$ItemSeleccion->QrBarra;                             // falta realizar la busqueda de proveedor para mostrar y despues buscar factura ingresada con proveedor mas fecha
        // $this->reset(['cantidad','precio','total']);
    }
    public function render()
    {
        $this->entidades=banco::all();
        $this->conceptos=concepto::all();
        $this->empresas=empresa::all();
        $this->cuentas=cuenta::all();
        $this->bodegas=bodega::all();
        $this->buscarBancos=banco::all();
        $this->buscarCuentas=cuenta::where('banco_id',$this->buscarBanco_id)->get();
        $this->bancoIngresos=banco::all();
    
        // $this->cuentaIngresos=cuenta::where('banco_id',$this->bancoIngresos_id)->get();
        return view('livewire.cuentas.conciliacion');
    }
}