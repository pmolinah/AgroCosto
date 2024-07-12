<?php

namespace App\Http\Livewire\Bodega;

use Livewire\Component;
use App\Models\empresa;
use App\Models\ingresobodega;
class BodegaEdit extends Component
{
    public $fact_id,$factura_id;
    public $fechaGuia,$tipoDocumento_id,$NumFacGuia,$proveedor_id,$empresa_id,$rut,$razon_social,$comuna,$email,$giro;
    public $visibleDetalle=true;
    public function mount(){
        $this->fact_id=$this->factura_id;
    } 
    public function EliminarProducto($linea_id,$item_id_linea){
        dd($linea_id,$item_id_linea);
    }
    
    public function render()
    {
        $proveedores=empresa::where('tipo_id',2)->get();
        $empresas=empresa::where('tipo_id',1)->get();
        $documento=ingresobodega::where('id',$this->factura_id)->first();
        $documentoDetalle=ingresobodega::with('detingresobodega')->where('id',$this->factura_id)->get();
        //dd($documentoDetalle);
        $this->fechaGuia=$documento->fecha;
        $this->tipoDocumento_id=$documento->tipoDocumento_id;
        $this->proveedor_id=$documento->proveedor_id;
        $this->NumFacGuia=$documento->numero;
        $this->empresa_id=$documento->campo->empresa_id;
        //falta campo
        $this->rut=$documento->proveedor->rut;
        $this->razon_social=$documento->proveedor->razon_social;
        $this->direccion=$documento->proveedor->direccion;
        $this->razon_social=$documento->proveedor->razon_social;
        $this->comuna=$documento->proveedor->comuna->comuna;
        $this->email=$documento->proveedor->email;
        $this->giro=$documento->proveedor->giro;

        return view('livewire.bodega.bodega-edit',compact(['proveedores','empresas','documento','documentoDetalle']))->with('fact_id',$this->fact_id);
    }
}
