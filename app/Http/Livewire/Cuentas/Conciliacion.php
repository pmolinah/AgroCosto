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
use App\Models\detallemovimiento;
use App\Models\item;
class Conciliacion extends Component
{
    public $entidad,$contacto,$email,$totalAbonos=0,$totalCargos=0,$totalAbonosPendiente=0,$totalCargosPendiente=0;
    public $concepto,$entidad_id,$cuenta,$saldo_inicial,$det,$ite,$can,$pre,$tot,$movimiento_id,$items=[];
    public $buscarBanco_id,$fechai,$fechaf,$empresa_id,$campo_id,$actualizarDocumento,$actualizarFormaPago,$actualizarImporte,$actualizarFecha,$actualizarConcepto,$actualizarCliente,$actualizarTipo,$actualizarID,$actualizarCuenta;
    public $bancoIngresos=[],$cuentaIngresos=[],$bancoIngresos_id,$cuentaIngresos_id,$conceptoIngreso_id,$cliente_id,$tipo_id,$formapago_id,$ndocumento,$importe,$fecha,$cuartel_id;
    public $entidades=[],$conceptos=[],$cuentas=[],$movimientos=[],$detalleMovimientoActualizar;
    public $empresas=[],$campos=[],$cuarteles=[],$cantidadCuarteles=[],$detalleMovimiento=[];
    public $buscarBancos=[],$buscarCuentas=[],$buscarCuenta_id,$prorroteo,$montoProrroteo=0,$campoyCuarteles=0;

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
        detallemovimiento::create([
            'movimiento_id'=>$this->movimiento_id,
            'item_id'=>$this->ite,
            'cantidad'=>$this->can,
            'precio'=>$this->pre,
        ]);
        $this->detalleMovimiento = detallemovimiento::where('movimiento_id',$this->movimiento_id)->get(); // Carga los datos
        $this->emit('openModal');
    }
    public function eliminaSumaDetalle($id){

        detallemovimiento::where('id',$id)->delete();
        $this->detalleMovimiento = detallemovimiento::where('movimiento_id',$this->movimiento_id)->get(); // Carga los datos
        $this->emit('openModal');
    }
    public function EjecutarLinea(){
        // dd($this->prorroteo);
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
    public function render()
    {
        $this->entidades=banco::all();
        $this->conceptos=concepto::all();
        $this->empresas=empresa::all();
        $this->cuentas=cuenta::all();
        $this->buscarBancos=banco::all();
        $this->buscarCuentas=cuenta::where('banco_id',$this->buscarBanco_id)->get();
        $this->bancoIngresos=banco::all();
        // $this->cuentaIngresos=cuenta::where('banco_id',$this->bancoIngresos_id)->get();
        return view('livewire.cuentas.conciliacion');
    }
}