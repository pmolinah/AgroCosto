<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\guia;
use App\Models\campo;
use App\Models\guiarecepcion;
use App\Models\exportadoraxplanificacion;
use App\Models\detallecosecha;
use App\Models\envase;
use App\Models\color;
use App\Models\especie;
use App\Models\observacion;
use App\Models\guiarecepciondetalle;
use App\Models\devoluciontraspaso;
use App\Models\empresa;


use PDF;
class GuiasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $lineas=1;
    public $lineaNegativa=0;
    public $suma=0;
    public $matrizEspecieKilos=[];
    public $matrizEnvaseColor=[];
    public $i=0,$j=0;

    public function index()
    {
        return view('Guia.index');
    }

    public function GuiaRecepcion(){
       
        return view('Guia.CrudGuiasRecepcion');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $guias=guia::all();
        $guiasDevolucion=devoluciontraspaso::with('devoluciontraspasodetalle')->where('emitida',1)->get();
        $guiasRecepcion=guiarecepcion::where('emitida',1)->get();
        return view('Guia.GuiasShow',compact('guias','guiasRecepcion','guiasDevolucion'));
    }

    public function GuiaDespacho($guia_id){

        $DatosGuia=guia::where('id',$guia_id)->get();
        foreach($DatosGuia as $GuiaDespacho){

            PDF::SetTitle('Guía de Despacho');
            PDF::AddPage();
            // PDF::setPageFormat('letter');
            // PDF::Write(0, 'Guía de Despacho N°');
            PDF::SetFont('Helvetica', '', 8);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(50, 4, 'Guía de Despacho N°', 1, 'C', 1, 0, 108, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(40, 4, $GuiaDespacho->numero, 1, 'R', 1, 0, '', '', true);
            PDF::Ln(4);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(15, 4, 'Campo', 1, 'C', 1, 0, 108, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(75, 4, $GuiaDespacho->planificacioncosecha->cuartel->campo->campo, 1, 'R', 1, 0, '', '', true);
            PDF::Ln(4);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(15, 4, 'Drección', 1, 'C', 1, 0, 108, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(75, 4, $GuiaDespacho->planificacioncosecha->cuartel->campo->direccion, 1, 'R', 1, 0, '', '', true);
            PDF::Ln(4);

            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(15, 4, 'Comuna', 1, 'C', 1, 0, 108, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::SetFont('Helvetica', '', 7);
            PDF::MultiCell(75, 4, $GuiaDespacho->planificacioncosecha->cuartel->campo->comuna->comuna, 1, 'R', 1, 0, '', '', true);
         
            PDF::SetFont('Helvetica', '', 10);
            PDF::Ln(2);
            PDF::Write(0, '_______________________________________________________________________________________________');
            PDF::Ln(5);
            PDF::Write(0, 'Datos Cliente');
            PDF::Ln(5);
            PDF::SetFont('Helvetica', '', 8);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(13, 4, 'Rut', 1, 'L', 1, 0, 11, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(20, 4, $GuiaDespacho->planificacioncosecha->cuartel->campo->rut, 1, 'C', 1, 0, '', '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(20, 4, 'Razón Social', 1, 'L', 1, 0, 43, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(80, 4, $GuiaDespacho->empresa->razon_social, 1, 'C', 1, 0, '', '', true);
            PDF::SetFont('Helvetica', '', 8);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(14, 4, 'Teléfono', 1, 'L', 1, 0, 143, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(40, 4, $GuiaDespacho->empresa->telefono, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(4);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(13, 4, 'Comuna', 1, 'C', 1, 0, 11, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(90, 4, $GuiaDespacho->empresa->comuna->comuna, 1, 'C', 1, 0, '', '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(13, 4, 'Email', 1, 'C', 1, 0, 114, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(70, 4, $GuiaDespacho->empresa->email, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(4);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(13, 4, 'Giro', 1, 'C', 1, 0, 11, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(90, 4, $GuiaDespacho->empresa->giro, 1, 'C', 1, 0, '', '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(13, 4, 'C.SAG', 1, 'C', 1, 0, 114, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(70, 4, $GuiaDespacho->planificacioncosecha->cuartel->codigoSag, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(4);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(16, 4, 'Conductor', 1, 'C', 1, 0, 11, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(90, 4, $GuiaDespacho->conductor->name, 1, 'C', 1, 0, '', '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(13, 4, 'Patente', 1, 'C', 1, 0, 114, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(70, 4, $GuiaDespacho->vehiculo->patente, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(3);
            PDF::SetFont('Helvetica', '', 10);
            PDF::Write(0, '_______________________________________________________________________________________________');
            PDF::Ln(8);
            //titulo detalle
            PDF::SetFont('Helvetica', '', 8);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(8, 4, 'N', 1, 'C', 1, 0, 11, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(110, 4, 'Detalle Cosecha', 1, 'C', 1, 0, 19, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(40, 4, 'Tarja/Envase', 1, 'C', 1, 0, 129, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(28, 4, 'Kilos', 1, 'C', 1, 0, 169, '', true);
            PDF::Ln(4);
          
                    $detalleCosecha=detallecosecha::where('planificacioncosecha_id',$GuiaDespacho->planificacioncosecha_id)->where('exportadora_id',$GuiaDespacho->empresa_id)->get();
                    foreach($detalleCosecha as $detalle){
                       
                        PDF::SetFillColor(253, 254, 254);
                        PDF::MultiCell(8, 4, $this->lineas, 1, 'C', 1, 0, 11, '', true);
                        
                        PDF::SetFillColor(253, 254, 254);
                        PDF::MultiCell(110, 4, $GuiaDespacho->planificacioncosecha->plantacion->especie->especie.',  Variedad : '.$GuiaDespacho->planificacioncosecha->plantacion->especie->variedad->variedad, 1, 'L', 1, 0, 19, '', true);
                        
                        PDF::SetFillColor(253, 254, 254);
                        PDF::MultiCell(40, 4, $detalle->tarjaenvase, 1, 'C', 1, 0, '', '', true);

                        PDF::SetFillColor(253, 254, 254);
                        PDF::MultiCell(28, 4, $detalle->kilos, 1, 'C', 1, 0, '', '', true);
                        $this->lineas++;
                        $this->suma = $this->suma + $detalle->kilos;
                        PDF::Ln(4);
                    }
                PDF::Ln(4);  
                PDF::SetFillColor(229, 231, 233);
                PDF::MultiCell(40, 4, 'Total Kilos', 1, 'C', 1, 0, 129, '', true);  
                PDF::SetFillColor(253, 254, 254);
                PDF::MultiCell(28, 4, $this->suma, 1, 'C', 1, 0, 169, '', true);     
                PDF::Ln(10);
                 //titulo detalle envase
                PDF::SetFont('Helvetica', '', 8);
                PDF::SetFillColor(229, 231, 233);
                PDF::MultiCell(8, 4, 'N', 1, 'C', 1, 0, 11, '', true);
                PDF::SetFillColor(229, 231, 233);
                PDF::MultiCell(110, 4, 'Detalle Envase', 1, 'C', 1, 0, 19, '', true);
                PDF::SetFillColor(229, 231, 233);
                PDF::MultiCell(40, 4, 'Color', 1, 'C', 1, 0, 129, '', true);
                PDF::SetFillColor(229, 231, 233);
                PDF::MultiCell(28, 4, 'Cantidad', 1, 'C', 1, 0, 169, '', true);
                PDF::Ln(4);
                $this->lineas=1;
                $this->suma=0;
                $exportadoraxplanificacion=exportadoraxplanificacion::with('desgloseenvase')->where('planificacioncosecha_id',$GuiaDespacho->planificacioncosecha_id)->where('empresa_id',$GuiaDespacho->empresa_id)->get();
                foreach($exportadoraxplanificacion as $exporxplan){
                    foreach ($exporxplan->desgloseenvase as $detalleEnvase){

                        PDF::SetFillColor(253, 254, 254);
                        PDF::MultiCell(8, 4, $this->lineas, 1, 'C', 1, 0, 11, '', true);
                        
                        PDF::SetFillColor(253, 254, 254);
                        PDF::MultiCell(110, 4, $exporxplan->planificacioncosecha->envase->envase, 1, 'L', 1, 0, 19, '', true);
                        
                        PDF::SetFillColor(253, 254, 254);
                        PDF::MultiCell(40, 4, $detalleEnvase->color->color, 1, 'C', 1, 0, '', '', true);

                        PDF::SetFillColor(253, 254, 254);
                        PDF::MultiCell(28, 4, $detalleEnvase->stock, 1, 'C', 1, 0, '', '', true);
                        $this->lineas++;
                        $this->suma = $this->suma + $detalleEnvase->stock;
                        PDF::Ln(4);
                    }
                }

                PDF::Ln(4);  
                PDF::SetFillColor(229, 231, 233);
                PDF::MultiCell(40, 4, 'Total Envases', 1, 'C', 1, 0, 129, '', true);  
                PDF::SetFillColor(253, 254, 254);
                PDF::MultiCell(28, 4, $this->suma, 1, 'C', 1, 0, 169, '', true);     
                PDF::Ln(10);


            PDF::Output('Guia_despacho_numero'.$GuiaDespacho->numero.'pdf');
            
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function GuiaRecepcionEmitir($id)
    {
        $guiasRecepcion=guiarecepcion::with('guiarecepciondetalle')->where('id',$id)->get();
        foreach($guiasRecepcion as $guiaRecep){
            PDF::SetTitle('Guía de Recepción');
            PDF::AddPage();
            //PDF::setPageFormat('letter');
            PDF::Write(0, 'Guía de Recepción');
            PDF::SetFont('Helvetica', '', 8);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(50, 4, 'Guía de Recepción N°', 1, 'C', 1, 0, 108, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(40, 4, $guiaRecep->numero, 1, 'R', 1, 0, '', '', true);
            PDF::Ln(4);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(15, 4, 'Campo', 1, 'C', 1, 0, 108, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(75, 4, $guiaRecep->campo->campo, 1, 'R', 1, 0, '', '', true);
            PDF::Ln(4);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(15, 4, 'Drección', 1, 'C', 1, 0, 108, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(75, 4, $guiaRecep->campo->direccion, 1, 'R', 1, 0, '', '', true);
            PDF::Ln(4);

            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(15, 4, 'Comuna', 1, 'C', 1, 0, 108, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::SetFont('Helvetica', '', 7);
            PDF::MultiCell(75, 4, $guiaRecep->campo->comuna->comuna, 1, 'R', 1, 0, '', '', true);

            PDF::SetFont('Helvetica', '', 10);
            PDF::Ln(2);
            PDF::Write(0, '_______________________________________________________________________________________________');
            PDF::Ln(5);
            PDF::Write(0, 'Datos Exportadora');
            PDF::Ln(5);
            PDF::SetFont('Helvetica', '', 8);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(13, 4, 'Rut', 1, 'L', 1, 0, 11, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(20, 4, $guiaRecep->empresa->rut, 1, 'C', 1, 0, '', '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(20, 4, 'Razón Social', 1, 'L', 1, 0, 43, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(80, 4, $guiaRecep->empresa->razon_social, 1, 'C', 1, 0, '', '', true);
            PDF::SetFont('Helvetica', '', 8);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(14, 4, 'Teléfono', 1, 'L', 1, 0, 143, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(40, 4, $guiaRecep->empresa->telefono, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(4);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(13, 4, 'Comuna', 1, 'C', 1, 0, 11, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(90, 4, $guiaRecep->empresa->comuna->comuna, 1, 'C', 1, 0, '', '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(13, 4, 'Email', 1, 'C', 1, 0, 114, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(70, 4, $guiaRecep->empresa->email, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(4);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(13, 4, 'Giro', 1, 'C', 1, 0, 11, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(90, 4, $guiaRecep->empresa->giro, 1, 'C', 1, 0, '', '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(13, 4, 'Código', 1, 'C', 1, 0, 114, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(70, 4, $guiaRecep->empresa->email, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(4);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(16, 4, 'Conductor', 1, 'C', 1, 0, 11, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(90, 4, $guiaRecep->conductor->name, 1, 'C', 1, 0, '', '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(13, 4, 'Patente', 1, 'C', 1, 0, 114, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(70, 4, $guiaRecep->vehiculo->patente, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(3);
            PDF::SetFont('Helvetica', '', 10);
            PDF::Write(0, '_______________________________________________________________________________________________');
            PDF::Ln(8);

             //titulo detalle
            PDF::SetFont('Helvetica', '', 8);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(8, 4, 'C/E', 1, 'C', 1, 0, 11, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(60, 4, 'Detalle', 1, 'C', 1, 0, 19, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(20, 4, 'Color', 1, 'C', 1, 0, 79, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(20, 4, 'Observación', 1, 'C', 1, 0, 99, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(69, 4, 'Especie', 1, 'C', 1, 0, 119, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(9, 4, 'Kilos', 1, 'C', 1, 0, 188, '', true);
            PDF::Ln(4);

           
            foreach ($guiaRecep->guiarecepciondetalle as $detalle ){
                PDF::SetFillColor(253, 254, 254);
                PDF::MultiCell(8, 4, $detalle->cantidadEnvase, 1, 'C', 1, 0, 11, '', true);
                PDF::MultiCell(60, 4, $detalle->envase->envase, 1, 'L', 1, 0, '', '', true);
                PDF::MultiCell(20, 4, $detalle->color->color, 1, 'C', 1, 0, '', '', true);
                PDF::MultiCell(20, 4, $detalle->observacion->observacion, 1, 'C', 1, 0, '', '', true);
                PDF::MultiCell(69, 4, $detalle->especie->especie, 1, 'L', 1, 0, '', '', true);
                PDF::MultiCell(9, 4, $detalle->kilos, 1, 'L', 1, 0, '', '', true);
                PDF::Ln(4);
            }

            //cuenta de envases por color
            $this->guiarecepciondetalles=guiarecepcion::where('id',$id)->get();
            foreach($this->guiarecepciondetalles as $GuiaID){
                $this->guiaRepID=$GuiaID->id;
            }
            PDF::Ln(10);

            PDF::SetFont('Helvetica', '', 8);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(50, 4, 'Envase', 1, 'C', 1, 0, 11, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(31, 4, 'Color', 1, 'C', 1, 0, 61, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(11, 4, 'Suma', 1, 'C', 1, 0, 92, '', true);
            PDF::Ln(4);
            $envases=envase::all();
            foreach($envases as $envase){
                $colores=color::all();
                    foreach($colores as $color){
                        $detalleGuiaRecepcion=guiarecepciondetalle::where('guiarecepcion_id',$id)->where('envase_id',$envase->id)->where('color_id',$color->id)->count();
                        if($detalleGuiaRecepcion>0){
                            $suma=guiarecepciondetalle::where('guiarecepcion_id',$id)->where('envase_id',$envase->id)->where('color_id',$color->id)->sum('cantidadEnvase');
                            PDF::SetFillColor(253, 254, 254);
                            
                            PDF::MultiCell(50, 4, $envase->envase, 1, 'L', 1, 0, 11, '', true);
                            
                            PDF::MultiCell(31, 4, $color->color, 1, 'C', 1, 0, 61, '', true);
                          
                            PDF::MultiCell(11, 4, $suma, 1, 'C', 1, 0, 92, '', true);
                        }
                        PDF::Ln(4);
                        $this->lineaNegativa=$this->lineaNegativa-4;
                    }
            }
        // 
            PDF::Ln(-8);
            PDF::Ln($this->lineaNegativa);
            PDF::SetFont('Helvetica', '', 8);
            PDF::SetFillColor(229, 231, 233);
            PDF::Ln(4);
            PDF::MultiCell(50, 4, 'Especie', 1, 'C', 1, 0, 104, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(31, 4, 'Observación', 1, 'C', 1, 0, 154, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(12, 4, 'Kilos', 1, 'C', 1, 0, 185, '', true);
            PDF::Ln($this->lineaNegativa);
             //cuenta de frutas por especie
            $especies=especie::all();
            foreach($especies as $especie){
                $observaciones=observacion::all();
                    foreach($observaciones as $observacion){
                        $detalleGuiaRecepcionEspecie=guiarecepciondetalle::where('guiarecepcion_id',$id)->where('especie_id',$especie->id)->where('observacion_id',$observacion->id)->count();
                        if($detalleGuiaRecepcionEspecie>0){
                            $suma=guiarecepciondetalle::where('guiarecepcion_id',$id)->where('especie_id',$especie->id)->where('observacion_id',$observacion->id)->sum('kilos');
                            if($especie->especie!='N/A' || $observacion->observacion!='Vacio'){
                              
                                PDF::SetFillColor(253, 254, 254);
                            
                                PDF::MultiCell(50, 4, $especie->especie, 1, 'L', 1, 0, 104, '', true);
                                
                                PDF::MultiCell(31, 4, $observacion->observacion, 1, 'C', 1, 0, 154, '', true);
                              
                                PDF::MultiCell(12, 4, $suma, 1, 'C', 1, 0, 185, '', true);
                            }
                        }
                        PDF::Ln(4);
                        $this->i++;
                    }
            }
        //



            PDF::Output('Guia_recepcion_numero'.$guiaRecep->numero.'pdf');
            
        }
    }

    public function GuiaDevolucionEmitir($id){
        $guiasDevolucion=devoluciontraspaso::with('devoluciontraspasodetalle')->where('id',$id)->get();
        foreach($guiasDevolucion as $guiaDevTras){
            PDF::SetTitle('Guía de Devolución');
            PDF::AddPage();
            //PDF::setPageFormat('letter');
            PDF::Write(0, 'Guía de Devolución/Traspaso');
            PDF::SetFont('Helvetica', '', 8);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(50, 4, 'Guía de Devolución N°', 1, 'C', 1, 0, 108, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(40, 4, $guiaDevTras->numero, 1, 'R', 1, 0, '', '', true);
            PDF::Ln(4);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(15, 4, 'Campo', 1, 'C', 1, 0, 108, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(75, 4, $guiaDevTras->campo->campo, 1, 'R', 1, 0, '', '', true);
            PDF::Ln(4);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(15, 4, 'Drección', 1, 'C', 1, 0, 108, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::MultiCell(75, 4, $guiaDevTras->campo->direccion, 1, 'R', 1, 0, '', '', true);
            PDF::Ln(4);

            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(15, 4, 'Comuna', 1, 'C', 1, 0, 108, '', true);
            PDF::SetFillColor(253, 254, 254);
            PDF::SetFont('Helvetica', '', 7);
            PDF::MultiCell(75, 4, $guiaDevTras->campo->comuna->comuna, 1, 'R', 1, 0, '', '', true);

            PDF::SetFont('Helvetica', '', 10);
            PDF::Ln(2);
            PDF::Write(0, '_______________________________________________________________________________________________');
            PDF::Ln(5);
            
            if($guiaDevTras->destino_type=='empresa'){
                PDF::Write(0, 'Datos Exportadora Devolución');
                PDF::Ln(5);
                $campo=empresa::where('id',$guiaDevTras->destino_id)->get();
                foreach($campo as $datosCampo){
                    PDF::SetFont('Helvetica', '', 8);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(13, 4, 'Rut', 1, 'L', 1, 0, 11, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(20, 4, $datosCampo->rut, 1, 'C', 1, 0, '', '', true);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(20, 4, 'Razón Social', 1, 'L', 1, 0, 43, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(80, 4, $guiaDevTras->NombreDestino, 1, 'C', 1, 0, '', '', true);
                    PDF::SetFont('Helvetica', '', 8);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(14, 4, 'Teléfono', 1, 'L', 1, 0, 143, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(40, 4, $datosCampo->telefono, 1, 'C', 1, 0, '', '', true);
                    PDF::Ln(4);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(13, 4, 'Comuna', 1, 'C', 1, 0, 11, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(90, 4, $datosCampo->comuna->comuna, 1, 'C', 1, 0, '', '', true);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(13, 4, 'Email', 1, 'C', 1, 0, 114, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(70, 4, $datosCampo->email, 1, 'C', 1, 0, '', '', true);
                    PDF::Ln(4);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(13, 4, 'Giro', 1, 'C', 1, 0, 11, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(90, 4, $datosCampo->giro, 1, 'C', 1, 0, '', '', true);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(13, 4, 'Código', 1, 'C', 1, 0, 114, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(70, 4, "N/A", 1, 'C', 1, 0, '', '', true);
                    PDF::Ln(4);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(16, 4, 'Conductor', 1, 'C', 1, 0, 11, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(90, 4, $guiaDevTras->conductor->name, 1, 'C', 1, 0, '', '', true);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(13, 4, 'Patente', 1, 'C', 1, 0, 114, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(70, 4, $guiaDevTras->vehiculo->patente, 1, 'C', 1, 0, '', '', true);
                    PDF::Ln(3);
                    PDF::SetFont('Helvetica', '', 10);
                    PDF::Write(0, '_______________________________________________________________________________________________');
                    PDF::Ln(8);
                }
            }

            if($guiaDevTras->destino_type=='campo'){
                $campo=campo::where('id',$guiaDevTras->destino_id)->get();
                PDF::Write(0, 'Datos Campo Destino');
                PDF::Ln(5);
                foreach($campo as $datosCampo){
                    PDF::SetFont('Helvetica', '', 8);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(13, 4, 'Rut', 1, 'L', 1, 0, 11, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(20, 4, $datosCampo->rut, 1, 'C', 1, 0, '', '', true);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(20, 4, 'Campo', 1, 'L', 1, 0, 43, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(80, 4, $guiaDevTras->NombreDestino, 1, 'C', 1, 0, '', '', true);
                    PDF::SetFont('Helvetica', '', 8);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(14, 4, 'Teléfono', 1, 'L', 1, 0, 143, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(40, 4, "N/A", 1, 'C', 1, 0, '', '', true);
                    PDF::Ln(4);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(13, 4, 'Comuna', 1, 'C', 1, 0, 11, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(90, 4, $datosCampo->comuna->comuna, 1, 'C', 1, 0, '', '', true);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(13, 4, 'Email', 1, 'C', 1, 0, 114, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(70, 4, "N/A", 1, 'C', 1, 0, '', '', true);
                    PDF::Ln(4);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(13, 4, 'Giro', 1, 'C', 1, 0, 11, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(90, 4, "N/A", 1, 'C', 1, 0, '', '', true);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(13, 4, 'Código', 1, 'C', 1, 0, 114, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(70, 4, "N/A", 1, 'C', 1, 0, '', '', true);
                    PDF::Ln(4);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(16, 4, 'Conductor', 1, 'C', 1, 0, 11, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(90, 4, $guiaDevTras->conductor->name, 1, 'C', 1, 0, '', '', true);
                    PDF::SetFillColor(229, 231, 233);
                    PDF::MultiCell(13, 4, 'Patente', 1, 'C', 1, 0, 114, '', true);
                    PDF::SetFillColor(253, 254, 254);
                    PDF::MultiCell(70, 4, $guiaDevTras->vehiculo->patente, 1, 'C', 1, 0, '', '', true);
                    PDF::Ln(3);
                    PDF::SetFont('Helvetica', '', 10);
                    PDF::Write(0, '_______________________________________________________________________________________________');
                    PDF::Ln(8);
                }
            }
            //titulo Detalle
            PDF::SetFont('Helvetica', '', 8);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(50, 4, 'Envase', 1, 'C', 1, 0, 11, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(31, 4, 'Color', 1, 'C', 1, 0, 61, '', true);
            PDF::SetFillColor(229, 231, 233);
            PDF::MultiCell(14, 4, 'Cantidad', 1, 'C', 1, 0, 92, '', true);
            PDF::Ln(4);


            foreach($guiaDevTras->devoluciontraspasodetalle as $detalle){
                PDF::SetFillColor(253, 254, 254);
                            
                PDF::MultiCell(50, 4, $detalle->envase->envase, 1, 'L', 1, 0, 11, '', true);
                
                PDF::MultiCell(31, 4, $detalle->color->color, 1, 'C', 1, 0, 61, '', true);
              
                PDF::MultiCell(14, 4, $detalle->cantidadEnvases, 1, 'C', 1, 0, 92, '', true);
            }








             //titulo detalle

             PDF::Output('Guia_Devolucion/Traspaso_numero'.$guiaDevTras->numero.'pdf');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
