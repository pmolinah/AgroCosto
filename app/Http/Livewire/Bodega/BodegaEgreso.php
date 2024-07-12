<?php

namespace App\Http\Livewire\Bodega;

use Livewire\Component;
use App\Models\detalletarea;
use App\Models\bodega;
use App\Models\tarea;
use App\Models\empresa;
use App\Models\user;
use App\Models\inventario;
use App\Models\egresobodega;
use App\Models\detallegreso;
class BodegaEgreso extends Component
{
    public $detalleTarea=[];
    public $lineaDetalle=[];
    public $despachosSinEmitir=[];
    public $visibleItem=false;
    public $items=[];
    public $user_id,$tarea_id,$fecha,$item_id,$egresoID,$observacion,$filtro;
    public $visible=false;
    public $solicitante_id,$rut_administrador,$bodega_id,$egresobodega_id,$bodeguero_id;
    public $unidadMedida,$cantidad,$contenidoTotal,$detalleEntrega,$contenido,$costoc,$precio,$precioUnitario;
    public $div,$ent,$resto,$suma,$contN,$cantN;
    public function cambioBodega(){
        $this->items=inventario::where('bodega_id',$this->bodega_id)->where('cantidad','>',0)->get();
    }
    public function BuscarxFiltro(){
        $this->visibleItem=true;
    }
    public function Seleccion($info){
        $this->bodega_id=$info['bod'];
        $this->items=inventario::where('bodega_id',$this->bodega_id)->get();
        $this->item_id=$info['id'];
        $this->unidadMedida=$info['um'];
        // $this->QrBarra=$info['cod'];
        // $this->reset(['cantidad','precio','total']);
    }
    public function SeleccionEgreso(){
        $egresosXhacer=egresobodega::where('id',$this->egresoID)->first();
        $this->fecha=$egresosXhacer->fecha;
        $this->egresobodega_id=$egresosXhacer->id;
        $this->solicitante_id=$egresosXhacer->solicitante_id;
        $this->lineaDetalle=detallegreso::where('egresobodega_id',$this->egresobodega_id)->get();
    }
    public function AgregarLinea(){
        
        if($this->unidadMedida==1 || $this->unidadMedida==2){
                $this->costo=($this->precio/$this->contenido);
                $this->costo = ($this->costo/1000);
                $this->costo=$this->costo*$this->detalleEntrega;
            }elseif($this->unidadMedida==3){
                $this->costo=($this->precio/$this->contenido);
                $this->costo = ($this->costo/100);
                $this->costo=($this->costo*$this->detalleEntrega);
            }else{
                $this->costo=($this->detalleEntrega*$this->precio);
            }
        $guardarLinea=detallegreso::create([
            'egresobodega_id'=>$this->egresobodega_id,
            'bodega_id'=>$this->bodega_id,
            'inventario_id'=>$this->item_id,
            'terea_id'=>$this->tarea_id,
            'detalleEntrega'=>$this->detalleEntrega,
            'costo'=>$this->costo,
        ]);
        $this->dispatchBrowserEvent('GuardadoCorrecto', [
            'title' => 'Registro, Guardado.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
        $this->lineaDetalle=detallegreso::where('egresobodega_id',$this->egresobodega_id)->get();
    }
    public function SeleccionTarea(){
        $this->detalleTarea=detalletarea::where('tarea_id',$this->tarea_id)->get();
    }
    public function GrabarDocumento(){
        if($this->solicitante_id==null || $this->fecha==null){
            $this->dispatchBrowserEvent('ErrorFaltanDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
        if(auth()->check()){
            $this->bodeguero_id=auth()->user()->id;
        }else{
            $this->bodeguero_id=0;
        }
        $this->visible=true;
        
        $grabarxDetalle=egresobodega::create([
            'bodeguero_id'=>$this->bodeguero_id,
            'fecha'=>$this->fecha,
            'tarea_id'=>$this->tarea_id,
            'solicitante_id'=>$this->solicitante_id,
        ]);
        $this->egresobodega_id=$grabarxDetalle->id;
        $this->dispatchBrowserEvent('GuardadoCorrecto', [
            'title' => 'Registro, Guardado.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }
    public function CambiaSeleccionItem(){
        $itenInventario=inventario::where('id',$this->item_id)->first();
        $this->unidadMedida=$itenInventario->item->unidadMedida;
        $this->cantidad=$itenInventario->cantidad;
        $this->contenidoTotal=$itenInventario->contenidoTotal;
        $this->contenido=$itenInventario->contenido;
        $this->precio=$itenInventario->precioUnitario;
    }
    public function generarEgreso(){
        $detalleEgreso=detallegreso::where('egresobodega_id',$this->egresobodega_id)->count();
        if($detalleEgreso<1 || $this->egresobodega_id==null || $this->solicitante_id==null){
            $this->dispatchBrowserEvent('ErrorFaltanDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
        $detalleEgreso=detallegreso::where('egresobodega_id',$this->egresobodega_id)->get();
            foreach($detalleEgreso as $detalle){
                $itemInventario=inventario::where('id',$detalle->inventario_id)->first();
                if($itemInventario->contenidoTotal<$detalle->detalleEntrega){
                    // $actualizaDetalleEgresoBodega=detallegresobodega::where('id',$detalle->id)->update(['entregada'=>3]);
                    // no hacer nada por falta de stock
                }else{
                    // $itemInventarioRebaja=inventario::where('id',$detalle->inventario_id)->decrement('contenidoTotal',$detalle->detalleEntrega);
                    if($itemInventario->item->unidadMedida==1 || $itemInventario->item->unidadMedida==2){
                        $this->suma=$detalle->detalleEntrega+$itemInventario->utilizado;
                        $this->contN=($itemInventario->contenido*1000);
                    
                        if($this->suma>$this->contN){
                            $this->ent=floor($this->suma/$this->contN);
                            $itemInventarioRebaja=inventario::where('id',$detalle->inventario_id)->decrement('cantidad',$this->ent);
                            $itemInventarioRebaja=inventario::where('id',$detalle->inventario_id)->update(['utilizado'=>($this->suma-($this->contN*$this->ent))]);
                        }elseif($this->suma==$this->contN){
                            $itemInventarioRebaja=inventario::where('id',$detalle->inventario_id)->decrement('cantidad',1);
                            $itemInventarioRebaja=inventario::where('id',$detalle->inventario_id)->update(['utilizado'=>0]);
                        }else{
                            $itemInventarioRebaja=inventario::where('id',$detalle->inventario_id)->update(['utilizado'=>($this->suma)]);
                        }
                        $actualizaDetalleEgresoBodega=detallegreso::where('id',$detalle->id)->update(['entregada'=>1]);

                    }
                    if($itemInventario->item->unidadMedida==4){
                        $this->suma=$detalle->detalleEntrega+$itemInventario->utilizado;
                        $this->contN=($itemInventario->contenido*100);
                        if($this->suma>$this->contN){
                            $this->ent=floor($this->suma/$this->contN);
                            $itemInventarioRebaja=inventario::where('id',$detalle->inventario_id)->decrement('cantidad',$this->ent);
                            $itemInventarioRebaja=inventario::where('id',$detalle->inventario_id)->update(['utilizado'=>($this->contN-$this->suma)]);
                        }elseif($this->suma==$this->contN){
                            $itemInventarioRebaja=inventario::where('id',$detalle->inventario_id)->decrement('cantidad',1);
                            $itemInventarioRebaja=inventario::where('id',$detalle->inventario_id)->update(['utilizado'=>0]);
                        }
                        $actualizaDetalleEgresoBodega=detallegreso::where('id',$detalle->id)->update(['entregada'=>1]);
                    }
                    if($itemInventario->item->unidadMedida==3){
                        $itemInventarioRebaja=inventario::where('id',$detalle->inventario_id)->decrement('cantidad',$detalle->detalleEntrega);
                        $actualizaDetalleEgresoBodega=detallegreso::where('id',$detalle->id)->update(['entregada'=>1]);
                    }
                }
            }
            egresobodega::where('id',$this->egresobodega_id)->update(['emitida'=>1]);
            $this->dispatchBrowserEvent('GuardadoCorrecto', [
                'title' => 'Registro, Guardado.',
                'icon'=>'success',
                'iconColor'=>'blue',
            ]);
            return redirect()->route('bodega.egreso');

    }
    public function render()
    {
        if(auth()->check()){
             $this->user_id=auth()->user()->id;

        }else{
            $user_id=0;
        }
        $bodegas=bodega::where('encargado_id',$this->user_id)->get();
        $tareas = tarea::whereHas('detalletarea', function ($query) {
        $query->whereNull('estado');})->distinct()->get();
        $users=user::all();
        $this->despachosSinEmitir=egresobodega::where('emitida',NULL)->get();
        $empresas=empresa::where('tipo_id',2)->get();
        // $itemsInventario = inventario::whereIn('bodega_id', $bodegas->pluck('id'))->get();
        $itemsInventario = Inventario::whereIn('bodega_id', $bodegas->pluck('id'))->join('items', 'inventarios.item_id', '=', 'items.id')
        ->where('items.nombre', 'like', "%$this->filtro%") ->get();
        return view('livewire.bodega.bodega-egreso',compact('tareas','empresas','bodegas','users','itemsInventario'))->with('detalleTarea',$this->detalleTarea,'items',$this->items,'despachosSinEmitir',$this->despachosSinEmitir);
    }
}
