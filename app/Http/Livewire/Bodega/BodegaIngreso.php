<?php

namespace App\Http\Livewire\Bodega;

use Livewire\Component;
use App\Models\item;
use App\Models\empresa;
use App\Models\campo;
use App\Models\bodega;
use App\Models\ingresobodega;
use App\Models\detingresobodega;
use App\Models\inventario;

use Illuminate\Support\Facades\Session;
class BodegaIngreso extends Component
{
    public $visible=true;
    public $campoLista=[];
    public $bodegas=[];
    public $detalleIngresos=[];
    public $vencimiento;
    public $filtro;
    public $item_id=0;
    public $QrBarra;
    public $total;
    public $cantidad;
    public $contenido;
    public $presentacion;
    public $precio;
    public $visibleDetalle=false;
    public $visibleItem=false;
    public $proveedor_id,$bodega_id,$ingresobodega_id;
    public $tipoDocumento_id,$fechaGuia,$NumFacGuia;
    public $empresa_id,$campo_id;
    public $rut,$razon_social,$direccion,$comuna,$email,$giro,$pivote,$observacion;

    // public $verificador="nada";

    public function Seleccion($info){
        $this->item_id=$info['id'];
        $this->unidadMedida=$info['um'];
        // $this->presentacion=$info['pres'];
        $this->QrBarra=$info['cod'];
        $this->reset(['cantidad','precio','total']);

    }
    public function BuscarxFiltro(){
        $this->visibleItem=true;
    }
    public function SeleccionPropietario(){
        $this->campoLista=campo::where('empresa_id',$this->empresa_id)->get();
    }
    public function SeleccionCampo(){
        $this->bodegas=bodega::where('campo_id',$this->campo_id)->get();
    }
    public function CambiaSeleccionItem(){

        $ItemSeleccion=item::where('id',$this->item_id)->first();
        // $this->item_id=$ItemSeleccion['id'];
        $this->unidadMedida=$ItemSeleccion->unidadMedida;
        // $this->presentacion=$ItemSeleccion->presentacion;
        $this->QrBarra=$ItemSeleccion->QrBarra;                             // falta realizar la busqueda de proveedor para mostrar y despues buscar factura ingresada con proveedor mas fecha
        $this->reset(['cantidad','precio','total']);
    }
    public function ObtenerTotal(){
        $this->total=($this->cantidad*$this->precio);
    }
    public function SeleccionProveedor_id(){
        $proveedor=empresa::where('id',$this->proveedor_id)->first();
        $this->rut=$proveedor->rut;
        $this->razon_social=$proveedor->razon_social;
        $this->direccion=$proveedor->direccion;
        $this->comuna=$proveedor->comuna->comuna;
        $this->email=$proveedor->email;
        $this->giro=$proveedor->giro;
    }
    public function GrabarDocumento(){
        //dd($this->NumFacGuia);
        if($this->NumFacGuia==null || $this->tipoDocumento_id==null || $this->proveedor_id==null || $this->empresa_id==null || $this->campo_id==null){
            $this->dispatchBrowserEvent('ErrorFaltanDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
      
        $this->visibleDetalle=true;
        $this->pivote=$this->NumFacGuia.'-'.$this->proveedor_id.'-'.$this->tipoDocumento_id;
        $buscaFactGuia=ingresobodega::where('pivote',$this->pivote)->first();
        
        if($buscaFactGuia!=null){
            //dd($buscaFactGuia->emitida);
            if($buscaFactGuia->emitida!=null){
                $this->dispatchBrowserEvent('ErrorYaExiste', [
                    'title' => 'Error, Registro ya existe, ya esta Emitida...',
                    'icon'=>'error',
                    'iconColor'=>'blue',
                ]);
                return redirect()->route('bodega.ingreso');
            }else{
            $this->dispatchBrowserEvent('ErrorYaExiste', [
                'title' => 'Error, Registro ya existe, no ingresada a Inventario...',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            $this->detalleIngresos=detingresobodega::where('ingresobodega_id',$buscaFactGuia->id)->get();
            $this->ingresobodega_id=$buscaFactGuia->id;
            return back();
            }
        }
        $ingresoBodega=ingresobodega::create([
            'fecha'=>$this->fechaGuia,
            'tipoDocumento_id'=>$this->tipoDocumento_id,
            'proveedor_id'=>$this->proveedor_id,
            'numero'=>$this->NumFacGuia,
            'campo_id'=>$this->campo_id,
            'total'=>0,
            'pivote'=>$this->pivote,
        ]);
        $this->dispatchBrowserEvent('GuardadoCorrecto', [
            'title' => 'Registro, Guardado.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
        $this->detalleIngresos=detingresobodega::where('ingresobodega_id',$ingresoBodega->id)->get();
        $this->ingresobodega_id=$ingresoBodega->id;
    }
    public function AgregarLinea(){
        if($this->NumFacGuia==null || $this->tipoDocumento_id==null || $this->proveedor_id==null || $this->empresa_id==null || $this->campo_id==null || $this->bodega_id==null || $this->item_id==null || $this->cantidad==null || $this->precio==null || $this->vencimiento==null){
            $this->dispatchBrowserEvent('ErrorFaltanDatos', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }
        $detingresobodega=detingresobodega::create([
            'ingresobodega_id'=>$this->ingresobodega_id,
            'bodega_id'=>$this->bodega_id,
            'NumFacGuia'=>$this->NumFacGuia,
            'item_id'=>$this->item_id,
            'cantidad'=>$this->cantidad,
            'contenido'=>$this->contenido,
            'presentacion'=>$this->presentacion,
            'precioUnitario'=>$this->precio,
            'vencimiento'=>$this->vencimiento,
        ]);
        $this->detalleIngresos=detingresobodega::where('ingresobodega_id',$this->ingresobodega_id)->get();
        $this->dispatchBrowserEvent('GuardadoCorrecto', [
            'title' => 'Registro, Guardado.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);

    }
    public function QuitarLinea($id){
        detingresobodega::where('id',$id)->delete();
        $this->detalleIngresos=detingresobodega::where('ingresobodega_id',$this->ingresobodega_id)->get();
        $this->dispatchBrowserEvent('EliminarRegistro', [
            'title' => 'Registro, Eliminado.',
            'icon'=>'info',
            'iconColor'=>'blue',
        ]);
    }
    public function generarGuiaIngresoBodega(){
        $detingresoBodega=detingresobodega::where('ingresobodega_id',$this->ingresobodega_id)->get();
        // dd($detingresoBodega);
        foreach($detingresoBodega as $detalleIngresoBodega ){
            $this->pivote=$detalleIngresoBodega->item_id.'-'.$detalleIngresoBodega->bodega_id.'-'.$detalleIngresoBodega->item->contenido.'-'.$detalleIngresoBodega->vencimiento.'-'.$detalleIngresoBodega->precioUnitario;
            $buscarEnInventario=inventario::where('pivote',$this->pivote)->count();
            if($buscarEnInventario > 0){
                $buscarEnInventario=inventario::where('pivote',$this->pivote)->get();
                $this->total=($detalleIngresoBodega->cantidad*$detalleIngresoBodega->item->contenido);
                $buscarEnInventario=inventario::where('pivote',$this->pivote)->increment('cantidad',$detalleIngresoBodega->cantidad);
                $buscarEnInventario=inventario::where('pivote',$this->pivote)->increment('contenidoTotal',$this->total);
                // $this->dispatchBrowserEvent('GuardadoCorrecto', [
                //     'title' => 'Registro, Guardado.',
                //     'icon'=>'success',
                //     'iconColor'=>'blue',
                // ]);
                // return redirect()->route('bodega.ingreso');
            }else{
                if($detalleIngresoBodega->item->unidadMedida==1 || $detalleIngresoBodega->item->unidadMedida==2){
                    $this->total=$detalleIngresoBodega->cantidad*($detalleIngresoBodega->contenido*1000);
                }elseif($detalleIngresoBodega->item->unidadMedida==3){
                    $this->total=$detalleIngresoBodega->cantidad*$detalleIngresoBodega->contenido;
                }else{
                    $this->total=$detalleIngresoBodega->cantidad*($detalleIngresoBodega->contenido*100);
                }
                    
                
                
                // $this->total=$detalleIngresoBodega->cantidad;
                inventario::create([
                    'item_id'=>$detalleIngresoBodega->item_id,
                    'bodega_id'=>$detalleIngresoBodega->bodega_id,
                    'cantidad'=>$detalleIngresoBodega->cantidad,
                    'contenido'=>$detalleIngresoBodega->contenido,
                    'contenidoTotal'=>$this->total,
                    'utilizado'=>0,
                    'presentacion'=>$detalleIngresoBodega->presentacion,
                    'precioUnitario'=>$detalleIngresoBodega->precioUnitario,
                    'stockMinimo'=>$detalleIngresoBodega->item->stockMinimo,
                    'pivote'=>$this->pivote,
                    'vencimiento'=>$detalleIngresoBodega->vencimiento,
                    'ingresobodega_id'=>$detalleIngresoBodega->ingresobodega_id,
                    'lineaFactura_id'=>$detalleIngresoBodega->id,
                ]);
              
            }
        }
        $this->dispatchBrowserEvent('GuardadoCorrecto', [
            'title' => 'Registro, Guardado.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
        ingresobodega::where('id',$this->ingresobodega_id)->update(['emitida'=>1,'observacion'=>$this->observacion]);
        return redirect()->route('bodega.ingreso');
    }
    public function render()
    {
        $ItemsBuscador=item::where('nombre','like','%'.$this->filtro.'%')->get();
        $items=item::all();
        $proveedores=empresa::where('tipo_id',2)->get();
        $empresas=empresa::where('tipo_id',1)->get();
        
        return view('livewire.bodega.bodega-ingreso',compact('items','ItemsBuscador','proveedores','empresas'));
    }
}
