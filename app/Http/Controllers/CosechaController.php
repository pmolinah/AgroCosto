<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cosecha;
use App\Models\empresa;
use App\Models\envase;
use App\Models\User;
use App\Models\planificacioncosecha;
use App\Models\cuentaenvase;
use App\Models\envaseempresa;
use App\Models\exportadoraxplanificacion;
use Illuminate\Support\Facades\Session;
use App\Models\contraistaxplanificacion;
use App\Http\Livewire\Cosecha\Cosechar;
use App\Models\detallecosecha;
// use Barryvdh\DomPDF\Facade\Pdf;
use PDF; // at the top of the file

class CosechaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $expid=array();
    public $expki=array();
    public $mesCosecha=[];
    public $saldoCapacidad=array();
    public $planificacioncosecha_id;
    public $cuenEnv;
    public $cortedehoja=0;
    public $suma=0;
    public function index()
    {
        
        if(auth()->User()->tipo_id==1){
            $user=auth()->User()->id;
            $planificaciones = planificacioncosecha::whereHas('cuartel', function ($query) use ($user) {
            $query->where('capataz_id', $user);
            })->where('finalizada', '=', NULL)->get();
            // $planificaciones = planificacioncosecha::all();
        }else{
            $user = auth()->User()->id;
            $planificaciones = planificacioncosecha::whereHas('cuartel', function ($query) use ($user) {
            $query->where('capataz_id', $user);
            })->where('finalizada', '=', NULL)->get();
            $planificaciones=planificacioncosecha::where('finalizada',NULL)->get();
        }
        
       
        
        return view('Cosecha.index',compact('planificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function planificacion(){
        $planificacioncosechas=planificacioncosecha::with('contraistaxplanificacion')->get();

        
    
        return view('Cosecha.planificacionIndex',compact('planificacioncosechas'));
    }

    public function planificacionCreate(){
        $empresas=empresa::where('tipo_id',4)->get();
        $empresasC=empresa::where('tipo_id',1)->get();
        $empresasE=empresa::where('tipo_id',3)->get();
        $usuarios=User::all();
        $envases=envase::all();
        return view('Cosecha.planificacionCreate', compact('empresas','usuarios','envases','empresasC','empresasE'));
    }

    public function planificacionStore(Request $request){
        // dd($request);
        if(!isset($request->exportadora_id) || !isset($request->tratoxcosecha)){
            
            Session::flash('error', 'Faltan Datos...');
            return back();
        }
        
        $planificacioncosecha=planificacioncosecha::create([
            'fechai'=>$request->fechai,
            'fechaf'=>$request->fechaf,
            'cuartel_id'=>$request->cuartel_id,
            'envase_id'=>$request->envase_id,
            'kilos'=>$request->totalkilos,
            'plantacion_id'=>$request->plantacion_id,
        ]);
       
        $longitud = count($request->exportadora_id);
        //dd($request);
        for($i=0;$i<$longitud;$i++){
            //dd($request->envase_id);
            $cuentaEmpresa=cuentaenvase::where('empresa_id',$request->exportadora_id[$i])->where('envase_id',$request->envase_id)->get();
            if ($cuentaEmpresa->isEmpty())
            {
                $this->cuenEnv=0;
            }else{
                foreach($cuentaEmpresa as $cuentaEnvEmp){
                    $this->cuenEnv=$cuentaEnvEmp->id;
                }
            }
           
                //dd($this->cuenEnv);
                 exportadoraxplanificacion::create([
                'planificacioncosecha_id'=>$planificacioncosecha->id,
                'empresa_id'=>$request->exportadora_id[$i],
                'kilosSolicitados'=>$request->kilosexportadora[$i],
                'cuentaenvase_id'=>$this->cuenEnv,
                ]);
        };
    

        $longitud=count($request->id);
        for($i=0;$i<$longitud;$i++){
            contraistaxplanificacion::create([
                'planificacioncosecha_id'=>$planificacioncosecha->id,
                'contratista_id'=>$request->id[$i],
                'tratoxcosecha'=>$request->tratoxcosecha[$i],
            ]);
        }

        Session::flash('success', 'Planificación Guardada Correctamente...');
        return back();
    }

    public function planificacionEdit($id){
        $empresas=empresa::where('tipo_id',1)->get();
        $empresasC=empresa::where('tipo_id',3)->get();
        $empresasE=empresa::where('tipo_id',4)->get();
        $usuarios=User::all();
        $envases=envase::all();
        $planificacioncosecha=planificacioncosecha::with('exportadoraxplanificacion','contraistaxplanificacion')->where('id',$id)->get();
        return view('Cosecha.planificacionEdit', compact('empresas','usuarios','envases','planificacioncosecha','empresasC','empresasE'));
    }

    public function planificacionUpdate(Request $request){
        //dd($request);

        planificacioncosecha::where('id',$request->planificacioncosecha_id)->update(['fechai'=>$request->fechai,'fechaf'=>$request->fechaf,'envase_id'=>$request->envase_id,'kilos'=>$request->totalkilos]);
        exportadoraxplanificacion::where('planificacioncosecha_id',$request->planificacioncosecha_id)->delete();
        
        $longitud = count($request->exportadora_id);

        for($i=0;$i<$longitud;$i++){

            $cuentaEmpresa=cuentaenvase::where('empresa_id',$request->exportadora_id[$i])->where('envase_id',$request->envase_id)->get();
            if ($cuentaEmpresa->isEmpty())
            {
                $this->cuenEnv=0;
            }else{
                foreach($cuentaEmpresa as $cuentaEnvEmp){
                    $this->cuenEnv=$cuentaEnvEmp->id;
                }
            }
           
            exportadoraxplanificacion::create([
                'planificacioncosecha_id'=>$request->planificacioncosecha_id,
                'empresa_id'=>$request->exportadora_id[$i],
                'kilosSolicitados'=>$request->kilosexportadora[$i],
                'cuentaenvase_id'=>$this->cuenEnv,
            ]);
        }

        contraistaxplanificacion::where('planificacioncosecha_id',$request->planificacioncosecha_id)->delete();
        $longitud=count($request->id);
        for($i=0;$i<$longitud;$i++){
            contraistaxplanificacion::create([
                'planificacioncosecha_id'=>$request->planificacioncosecha_id,
                'contratista_id'=>$request->id[$i],
                'tratoxcosecha'=>$request->tratoxcosecha[$i],
            ]);
        }
        Session::flash('success', 'Planificación Actualizada Correctamente...');
        return back();


    }

    public function create()
    {
        return view('Cosecha.create');
    }

    public function cosechar($id){
       
        $planificacioncosecha_id=$id;
        return view('Cosecha.cosechar',compact('planificacioncosecha_id'));
    }
    /**
     * Store a newly created resource in storage.
     */
   public function StockEnvaseEmpresa($caID,$enID){
        return envaseempresa::where('campo_id',$caID)->where('envase_id',$enID)->get();
   }

   public function StockEnvaseExportadora($exID,$enID){
        $cee=cuentaenvase::where('empresa_id',$exID)->where('envase_id',$enID)->get();
        foreach($cee as $cc){
            $this->saldoCapacidad[0]=$cc->saldo;
            $this->saldoCapacidad[1]=$cc->envase->capacidad;
            return $this->saldoCapacidad;
        }
        
   }

    public function EliminarPlanificacionCosecha($id){
        planificacioncosecha::where('id',$id)->delete();
        return 0;
    }

    public function CosechaStore(Request $request){
        //dd($request);
        planificacioncosecha::where('id',$request->planificacionCosecha_id)->update(['finalizada'=>1,'kilosRealesCosechados'=>$request->cosechaActual]);
        $num=count($request->exportadora_id);
        //dd($num);
        for($i=0;$i<$num;$i++){
            //dd($request->exportadora_id[$i]);
            exportadoraxplanificacion::where('id',$request->exportadora_id[$i])->update(['KilosRecolectados'=>$request->valores[$i]]); //,'envasesUtilizadosReales'=>$request->bines[$i]
        };
        $user = auth()->User()->id;
        $planificaciones = planificacioncosecha::whereHas('cuartel', function ($query) use ($user) {
            $query->where('capataz_id', $user);
        })->where('finalizada', '=', NULL)->get();
        Session::flash('success', 'Cosecha Cerrada Correctamente...');
        return view('Cosecha.index',compact('planificaciones'));
    }

    public function indexCosechasCerradas(){
        
        $planificaciones = planificacioncosecha::with('exportadoraxplanificacion','contraistaxplanificacion')->where('finalizada', '=', 1)->get();
        return view('CosechasCerradas.index',compact('planificaciones'));
    }

    public function ReporteCosecha($planificacioncosecha_id){
        
        $planInf=planificacioncosecha::with('exportadoraxplanificacion','contraistaxplanificacion')->where('id',$planificacioncosecha_id)->get();
        foreach($planInf as $inf){

            PDF::SetTitle('Informe Cosecha');
            PDF::AddPage();
            // PDF::setPageFormat('letter');
            PDF::Write(0, 'Informe de Cosecha');
            PDF::Ln(6);
            PDF::Write(0, 'Fecha cierre de Cosecha: ');
            PDF::Write(0,$inf->updated_at);
            PDF::Ln(6);
            PDF::Write(0, '-------------------------------------------------------------------------------------------------------------------------------------');
            PDF::Ln(6);
            PDF::Write(0, 'Datos del Propietario');
            PDF::Ln(7);
            PDF::SetLineWidth(0.2);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            // PDF::Write(0, 'Empresa Principal - Campo                                                                              ');
            PDF::MultiCell(120, 6, 'Empresa Princioal', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, 'Rut', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Rut');
            PDF::Ln(4.5);
            PDF::SetFont('Helvetica', '', 12);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(120, 6, $inf->cuartel->campo->empresa->razon_social, 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, $inf->cuartel->campo->empresa->rut, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(0);
       
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(120, 6, 'Dirección', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, 'Teléfono', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Dirección                                                                                                           ');
            // PDF::Write(0, 'Teléfono');
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::SetFont('Helvetica', '', 12);
            PDF::MultiCell(120, 6, $inf->cuartel->campo->empresa->direccion, 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, $inf->cuartel->campo->empresa->telefono, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(100, 6, 'Propietario', 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(88, 6, 'E-mail', 1, 'L', 1, 0, '', '', true);
            // PDF::Write(0, 'Propietario                                                                                    ');
            // PDF::Write(0, 'Email');
            PDF::Ln(4.5);
            PDF::SetFont('Helvetica', '', 12);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(100, 6, $inf->cuartel->campo->empresa->nombre, 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(88, 6, $inf->cuartel->campo->empresa->email, 1, 'L', 1, 0, '', '', true);
            PDF::Ln(8);
            PDF::SetFont('Helvetica', '', 12);
            PDF::Write(0, 'Datos del Campo');
            PDF::Ln(7);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(120, 6, 'Campo', 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, 'Superficie', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Nombre del Campo                                                                                           ');
            // PDF::Write(0, 'Superficie');
            PDF::Ln(4.5);
            PDF::SetFont('Helvetica', '', 12);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(120, 6, $inf->cuartel->campo->campo, 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, $inf->cuartel->campo->superficie.' Ha', 1, 'C', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(120, 6, 'Dirección', 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, 'Rut', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Direccion                                                                                                            ');
            // PDF::Write(0, 'Rut');
            PDF::Ln(4.5);
            PDF::SetFont('Helvetica', '', 12);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(120, 6, $inf->cuartel->campo->direccion, 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, $inf->cuartel->campo->rut, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6, 'Comuna', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Comuna                                                                                           ');
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->cuartel->campo->comuna->comuna, 1, 'L', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6, 'Administrador', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Administrador                                                                                           ');
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->cuartel->campo->adm->name, 1, 'L', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6,'Capataz', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Capataz                                                                                           ');
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->cuartel->capataz->name, 1, 'L', 1, 0, '', '', true);

            // datos del cuartel y la especie
            PDF::Ln(8);
            PDF::SetFont('Helvetica', '', 12);
            PDF::Write(0, 'Datos del Cuartel y la Especie de la Cosecha');
            PDF::Ln(7);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(120, 6, 'Cuartel', 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, 'Superficie', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Nombre del Campo                                                                                           ');
            // PDF::Write(0, 'Superficie');
            PDF::Ln(4.5);
            PDF::SetFont('Helvetica', '', 12);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(120, 6, $inf->plantacion->cuartel->observaciones, 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, $inf->plantacion->cuartel->superficie.' Ha', 1, 'C', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6, 'Capataz', 1, 'L', 1, 0, '', '', true);
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->plantacion->cuartel->capataz->name, 1, 'L', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6, 'Email', 1, 'C', 1, 0, '', '', true);
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->plantacion->cuartel->capataz->email, 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Direccion                                                                                                            ');
            // PDF::Write(0, 'Rut');
            PDF::SetFont('Helvetica', '', 12);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6, 'Especie de la Cosecha', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Comuna                                                                                           ');
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->plantacion->especie->especie, 1, 'L', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6, 'Variedad de la Especie', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Administrador                                                                                           ');
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->plantacion->especie->variedad->variedad, 1, 'L', 1, 0, '', '', true);
            PDF::Ln(6);
            // PDF::SetFont('Helvetica', '', 10);
            // PDF::SetFillColor(155, 246, 234);
            // PDF::MultiCell(188, 6,'Capataz', 1, 'C', 1, 0, '', '', true);
            // // PDF::Write(0, 'Capataz                                                                                           ');
            // PDF::Ln(4.5);
            // PDF::SetFillColor(251, 255, 254);
            // PDF::MultiCell(188, 6, $inf->cuartel->campo->capataz->name, 1, 'L', 1, 0, '', '', true);
            
            PDF::Ln(8);

            // fin datos del cuartel y la especie
            PDF::Ln(8);
            PDF::SetFont('Helvetica', '', 12);
            PDF::Write(0, 'Datos de la Cosecha');
            PDF::Ln(7);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(62, 5, 'Fecha Inicio', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 5, 'Fecha Final', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 5, 'Fecha y Hora Cierre Cosecha', 1, 'C', 1, 0, '', '', true);
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::SetFont('Helvetica', '', 12);
            PDF::MultiCell(62, 6, $inf->fechai, 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 6, $inf->fechaf, 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 6, $inf->updated_at, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(5);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(62, 5, 'Kilos Totales Solicitados', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 5, 'Kilos Recolectados', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 5, 'Tipo de Envase', 1, 'C', 1, 0, '', '', true);
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::SetFont('Helvetica', '', 12);
            PDF::MultiCell(62, 6, $inf->kilos, 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 6, $inf->kilosRealesCosechados, 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 6, $inf->envase->envase, 1, 'C', 1, 0, '', '', true);
            
            // datos de la exportadora
                PDF::AddPage();
                PDF::Write(0, 'Datos de Exportadora(s)');
                PDF::Ln(7);
                PDF::SetLineWidth(0.2);
                PDF::SetFont('Helvetica', '', 10);
                PDF::SetFillColor(155, 246, 234);
                $this->cortedehoja=0;
                foreach($inf->exportadoraxplanificacion as $exp){
                
                
                    // PDF::Write(0, 'Empresa Principal - Campo                                                                              ');
                    PDF::MultiCell(120, 6, 'Exportadora', 1, 'C', 1, 0, '', '', true);
                    PDF::MultiCell(68, 6, 'Rut', 1, 'C', 1, 0, '', '', true);
                    // PDF::Write(0, 'Rut');
                    PDF::Ln(4.5);
                    PDF::SetFont('Helvetica', '', 12);
                    PDF::SetFillColor(251, 255, 254);
                    PDF::MultiCell(120, 6, $exp->empresa->razon_social, 1, 'L', 1, 0, '', '', true);
                    PDF::MultiCell(68, 6, $exp->empresa->rut, 1, 'C', 1, 0, '', '', true);
                    PDF::Ln(0);
            
                    PDF::Ln(6);
                    PDF::SetFont('Helvetica', '', 10);
                    PDF::SetFillColor(155, 246, 234);
                    PDF::MultiCell(120, 6, 'Dirección', 1, 'C', 1, 0, '', '', true);
                    PDF::MultiCell(68, 6, 'Teléfono', 1, 'C', 1, 0, '', '', true);
                    // PDF::Write(0, 'Dirección                                                                                                           ');
                    // PDF::Write(0, 'Teléfono');
                    PDF::Ln(4.5);
                    PDF::SetFillColor(251, 255, 254);
                    PDF::SetFont('Helvetica', '', 12);
                    PDF::MultiCell(120, 6, $exp->empresa->direccion, 1, 'L', 1, 0, '', '', true);
                    PDF::MultiCell(68, 6, $exp->empresa->telefono, 1, 'C', 1, 0, '', '', true);
                    PDF::Ln(6);
                    PDF::SetFont('Helvetica', '', 10);
                    PDF::SetFillColor(155, 246, 234);
                    PDF::MultiCell(100, 6, 'Propietario', 1, 'L', 1, 0, '', '', true);
                    PDF::MultiCell(88, 6, 'E-mail', 1, 'L', 1, 0, '', '', true);
                    // PDF::Write(0, 'Propietario                                                                                    ');
                    // PDF::Write(0, 'Email');
                    PDF::Ln(4.5);
                    PDF::SetFont('Helvetica', '', 12);
                    PDF::SetFillColor(251, 255, 254);
                    PDF::MultiCell(100, 6, $exp->empresa->nombre, 1, 'L', 1, 0, '', '', true);
                    PDF::MultiCell(88, 6, $exp->empresa->email, 1, 'L', 1, 0, '', '', true);
                    PDF::Ln(9);
                    PDF::Write(0, 'Datos para Envío a la Exportadora');
                    PDF::Ln(7);
                    
                    PDF::SetFont('Helvetica', '', 10);
                    PDF::SetFillColor(155, 246, 234);
                    PDF::MultiCell(62, 5, 'Kilos Solicitados en Planificación', 1, 'C', 1, 0, '', '', true);
                    PDF::MultiCell(63, 5, 'Kilos Recolectados', 1, 'C', 1, 0, '', '', true);
                    PDF::MultiCell(63, 5, 'Total de Envases Utilizados', 1, 'C', 1, 0, '', '', true);
                    PDF::Ln(4.5);
                    PDF::SetFillColor(251, 255, 254);
                    PDF::SetFont('Helvetica', '', 12);
                    PDF::MultiCell(62, 6, $exp->kilosSolicitados, 1, 'C', 1, 0, '', '', true);
                    PDF::MultiCell(63, 6, $exp->KilosRecolectados, 1, 'C', 1, 0, '', '', true);
                    PDF::MultiCell(63, 6, $exp->envasesUtilizadosReales, 1, 'C', 1, 0, '', '', true);
                    PDF::Ln(9);
                    $this->cortedehoja=$this->cortedehoja+1;
                    if($this->cortedehoja==3){
                        PDF::AddPage();
                        PDF::Write(0, 'Datos de Exportadora(s)');
                        PDF::Ln(7);
                        PDF::SetLineWidth(0.2);
                        PDF::SetFont('Helvetica', '', 10);
                        PDF::SetFillColor(155, 246, 234);
                        $this->cortedehoja=0;
                    }
                }
            // fin datos exportadora
             // datos de la contratista
             PDF::AddPage();
             PDF::Write(0, 'Datos de Contratista(s)');
             PDF::Ln(7);
             PDF::SetLineWidth(0.2);
             PDF::SetFont('Helvetica', '', 10);
             PDF::SetFillColor(155, 246, 234);
             $this->cortedehoja=0;
             foreach($inf->contraistaxplanificacion as $con){

             
                 // PDF::Write(0, 'Empresa Principal - Campo                                                                              ');
                 PDF::MultiCell(120, 6, 'Exportadora', 1, 'C', 1, 0, '', '', true);
                 PDF::MultiCell(68, 6, 'Rut', 1, 'C', 1, 0, '', '', true);
                 // PDF::Write(0, 'Rut');
                 PDF::Ln(4.5);
                 PDF::SetFont('Helvetica', '', 12);
                 PDF::SetFillColor(251, 255, 254);
                 PDF::MultiCell(120, 6, $con->contratista->razon_social, 1, 'L', 1, 0, '', '', true);
                 PDF::MultiCell(68, 6, $con->contratista->rut, 1, 'C', 1, 0, '', '', true);
                 PDF::Ln(0);
         
                 PDF::Ln(6);
                 PDF::SetFont('Helvetica', '', 10);
                 PDF::SetFillColor(155, 246, 234);
                 PDF::MultiCell(120, 6, 'Dirección', 1, 'C', 1, 0, '', '', true);
                 PDF::MultiCell(68, 6, 'Teléfono', 1, 'C', 1, 0, '', '', true);
                 // PDF::Write(0, 'Dirección                                                                                                           ');
                 // PDF::Write(0, 'Teléfono');
                 PDF::Ln(4.5);
                 PDF::SetFillColor(251, 255, 254);
                 PDF::SetFont('Helvetica', '', 12);
                 PDF::MultiCell(120, 6, $con->contratista->direccion, 1, 'L', 1, 0, '', '', true);
                 PDF::MultiCell(68, 6, $con->contratista->telefono, 1, 'C', 1, 0, '', '', true);
                 PDF::Ln(6);
                 PDF::SetFont('Helvetica', '', 10);
                 PDF::SetFillColor(155, 246, 234);
                 PDF::MultiCell(100, 6, 'Propietario', 1, 'L', 1, 0, '', '', true);
                 PDF::MultiCell(88, 6, 'E-mail', 1, 'L', 1, 0, '', '', true);
                 // PDF::Write(0, 'Propietario                                                                                    ');
                 // PDF::Write(0, 'Email');
                 PDF::Ln(4.5);
                 PDF::SetFont('Helvetica', '', 12);
                 PDF::SetFillColor(251, 255, 254);
                 PDF::MultiCell(100, 6, $con->contratista->nombre, 1, 'L', 1, 0, '', '', true);
                 PDF::MultiCell(88, 6, $con->contratista->email, 1, 'L', 1, 0, '', '', true);
                 PDF::Ln(9);
                 PDF::Write(0, 'Datos de Cosecha del Contratista');
                 PDF::Ln(7);
                 
                 PDF::SetFont('Helvetica', '', 10);
                 PDF::SetFillColor(155, 246, 234);
                 PDF::MultiCell(62, 5, 'Trato por Cosecha', 1, 'C', 1, 0, '', '', true);
                 PDF::MultiCell(63, 5, 'Kilos Recolectados', 1, 'C', 1, 0, '', '', true);
                 PDF::MultiCell(63, 5, 'Costo Total de la Operación', 1, 'C', 1, 0, '', '', true);
                 PDF::Ln(4.5);
                 PDF::SetFillColor(251, 255, 254);
                 PDF::SetFont('Helvetica', '', 12);
                 PDF::MultiCell(62, 6, $con->tratoxcosecha, 1, 'C', 1, 0, '', '', true);
                 PDF::MultiCell(63, 6, $con->kilos, 1, 'C', 1, 0, '', '', true);
                 PDF::MultiCell(63, 6, $con->costototal, 1, 'C', 1, 0, '', '', true);
                 PDF::Ln(4.5);
                 $this->cortedehoja=$this->cortedehoja+1;
                 if($this->cortedehoja==3){
                     PDF::AddPage();
                     PDF::Write(0, 'Datos de Contratista(s)');
                     PDF::Ln(7);
                     PDF::SetLineWidth(0.2);
                     PDF::SetFont('Helvetica', '', 10);
                     PDF::SetFillColor(155, 246, 234);
                     $this->cortedehoja=0;
                 }
             }
         // fin datos contratista

            PDF::Output('informe_cosecha.pdf');
        }
        
    }
    public function ReporteCosechaContratista($planificacioncosecha_id,$contratista_id){
        
        $planInf=planificacioncosecha::with('contraistaxplanificacion','detallecosecha')->where('id',$planificacioncosecha_id)->get();
        foreach($planInf as $inf){
            PDF::SetTitle('Informe Cosecha del Contratista');
            PDF::AddPage();
            // PDF::setPageFormat('letter');
            PDF::Write(0, 'Informe de Cosecha');
            PDF::Ln(6);
            PDF::Write(0, 'Fecha cierre de Cosecha: ');
            PDF::Write(0,$inf->updated_at);
            PDF::Ln(6);
            PDF::Write(0, '-------------------------------------------------------------------------------------------------------------------------------------');
            PDF::Ln(6);
            PDF::Write(0, 'Datos del Propietario');
            PDF::Ln(7);
            PDF::SetLineWidth(0.2);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            // PDF::Write(0, 'Empresa Principal - Campo                                                                              ');
            PDF::MultiCell(120, 6, 'Empresa Princioal', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, 'Rut', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Rut');
            PDF::Ln(4.5);
            PDF::SetFont('Helvetica', '', 12);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(120, 6, $inf->cuartel->campo->empresa->razon_social, 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, $inf->cuartel->campo->empresa->rut, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(0);
       
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(120, 6, 'Dirección', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, 'Teléfono', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Dirección                                                                                                           ');
            // PDF::Write(0, 'Teléfono');
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::SetFont('Helvetica', '', 12);
            PDF::MultiCell(120, 6, $inf->cuartel->campo->empresa->direccion, 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, $inf->cuartel->campo->empresa->telefono, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(100, 6, 'Propietario', 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(88, 6, 'E-mail', 1, 'L', 1, 0, '', '', true);
            // PDF::Write(0, 'Propietario                                                                                    ');
            // PDF::Write(0, 'Email');
            PDF::Ln(4.5);
            PDF::SetFont('Helvetica', '', 12);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(100, 6, $inf->cuartel->campo->empresa->nombre, 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(88, 6, $inf->cuartel->campo->empresa->email, 1, 'L', 1, 0, '', '', true);
            PDF::Ln(8);
            PDF::SetFont('Helvetica', '', 12);
            PDF::Write(0, 'Datos del Campo');
            PDF::Ln(7);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(120, 6, 'Campo', 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, 'Superficie', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Nombre del Campo                                                                                           ');
            // PDF::Write(0, 'Superficie');
            PDF::Ln(4.5);
            PDF::SetFont('Helvetica', '', 12);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(120, 6, $inf->cuartel->campo->campo, 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, $inf->cuartel->campo->superficie.' M2', 1, 'C', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(120, 6, 'Dirección', 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, 'Rut', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Direccion                                                                                                            ');
            // PDF::Write(0, 'Rut');
            PDF::Ln(4.5);
            PDF::SetFont('Helvetica', '', 12);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(120, 6, $inf->cuartel->campo->direccion, 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, $inf->cuartel->campo->rut, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6, 'Comuna', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Comuna                                                                                           ');
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->cuartel->campo->comuna->comuna, 1, 'L', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6, 'Administrador', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Administrador                                                                                           ');
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->cuartel->campo->adm->name, 1, 'L', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6,'Capataz', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Capataz                                                                                           ');
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->cuartel->capataz->name, 1, 'L', 1, 0, '', '', true);

            // datos del cuartel y la especie
            PDF::Ln(8);
            PDF::SetFont('Helvetica', '', 12);
            PDF::Write(0, 'Datos del Cuartel y la Especie de la Cosecha');
            PDF::Ln(7);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(120, 6, 'Cuartel', 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, 'Superficie', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Nombre del Campo                                                                                           ');
            // PDF::Write(0, 'Superficie');
            PDF::Ln(4.5);
            PDF::SetFont('Helvetica', '', 12);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(120, 6, $inf->plantacion->cuartel->observaciones, 1, 'L', 1, 0, '', '', true);
            PDF::MultiCell(68, 6, $inf->plantacion->cuartel->superficie.' M2', 1, 'C', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6, 'Capataz', 1, 'L', 1, 0, '', '', true);
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->plantacion->cuartel->capataz->name, 1, 'L', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6, 'Email', 1, 'C', 1, 0, '', '', true);
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->plantacion->cuartel->capataz->email, 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Direccion                                                                                                            ');
            // PDF::Write(0, 'Rut');
            PDF::SetFont('Helvetica', '', 12);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6, 'Especie de la Cosecha', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Comuna                                                                                           ');
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->plantacion->especie->especie, 1, 'L', 1, 0, '', '', true);
            PDF::Ln(6);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(188, 6, 'Variedad de la Especie', 1, 'C', 1, 0, '', '', true);
            // PDF::Write(0, 'Administrador                                                                                           ');
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::MultiCell(188, 6, $inf->plantacion->especie->variedad->variedad, 1, 'L', 1, 0, '', '', true);
            PDF::Ln(6);
          
            
            PDF::Ln(8);

            // fin datos del cuartel y la especie
            //datos de Cosecha
            PDF::Ln(8);
            PDF::SetFont('Helvetica', '', 12);
            PDF::Write(0, 'Datos de la Cosecha');
            PDF::Ln(7);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(62, 5, 'Fecha Inicio', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 5, 'Fecha Final', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 5, 'Fecha y Hora Cierre Cosecha', 1, 'C', 1, 0, '', '', true);
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::SetFont('Helvetica', '', 12);
            PDF::MultiCell(62, 6, $inf->fechai, 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 6, $inf->fechaf, 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 6, $inf->updated_at, 1, 'C', 1, 0, '', '', true);
            PDF::Ln(5);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(62, 5, 'Kilos Totales Solicitados', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 5, 'Kilos Recolectados', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 5, 'Tipo de Envase', 1, 'C', 1, 0, '', '', true);
            PDF::Ln(4.5);
            PDF::SetFillColor(251, 255, 254);
            PDF::SetFont('Helvetica', '', 12);
            PDF::MultiCell(62, 6, $inf->kilos, 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 6, $inf->kilosRealesCosechados, 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 6, $inf->envase->envase, 1, 'C', 1, 0, '', '', true);

            // datos de la contratista
            PDF::AddPage();
            PDF::Write(0, 'Datos de Contratista(s)');
            PDF::Ln(7);
            PDF::SetLineWidth(0.2);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            $this->cortedehoja=0;
      
            $contratista=contraistaxplanificacion::where('planificacioncosecha_id',$planificacioncosecha_id)->where('contratista_id',$contratista_id)->get();
            foreach($contratista as $con){

            
                // PDF::Write(0, 'Empresa Principal - Campo                                                                              ');
                PDF::MultiCell(120, 6, 'Exportadora', 1, 'C', 1, 0, '', '', true);
                PDF::MultiCell(68, 6, 'Rut', 1, 'C', 1, 0, '', '', true);
                // PDF::Write(0, 'Rut');
                PDF::Ln(4.5);
                PDF::SetFont('Helvetica', '', 12);
                PDF::SetFillColor(251, 255, 254);
                PDF::MultiCell(120, 6, $con->contratista->razon_social, 1, 'L', 1, 0, '', '', true);
                PDF::MultiCell(68, 6, $con->contratista->rut, 1, 'C', 1, 0, '', '', true);
                PDF::Ln(0);
        
                PDF::Ln(6);
                PDF::SetFont('Helvetica', '', 10);
                PDF::SetFillColor(155, 246, 234);
                PDF::MultiCell(120, 6, 'Dirección', 1, 'C', 1, 0, '', '', true);
                PDF::MultiCell(68, 6, 'Teléfono', 1, 'C', 1, 0, '', '', true);
                // PDF::Write(0, 'Dirección                                                                                                           ');
                // PDF::Write(0, 'Teléfono');
                PDF::Ln(4.5);
                PDF::SetFillColor(251, 255, 254);
                PDF::SetFont('Helvetica', '', 12);
                PDF::MultiCell(120, 6, $con->contratista->direccion, 1, 'L', 1, 0, '', '', true);
                PDF::MultiCell(68, 6, $con->contratista->telefono, 1, 'C', 1, 0, '', '', true);
                PDF::Ln(6);
                PDF::SetFont('Helvetica', '', 10);
                PDF::SetFillColor(155, 246, 234);
                PDF::MultiCell(100, 6, 'Propietario', 1, 'L', 1, 0, '', '', true);
                PDF::MultiCell(88, 6, 'E-mail', 1, 'L', 1, 0, '', '', true);
                // PDF::Write(0, 'Propietario                                                                                    ');
                // PDF::Write(0, 'Email');
                PDF::Ln(4.5);
                PDF::SetFont('Helvetica', '', 12);
                PDF::SetFillColor(251, 255, 254);
                PDF::MultiCell(100, 6, $con->contratista->nombre, 1, 'L', 1, 0, '', '', true);
                PDF::MultiCell(88, 6, $con->contratista->email, 1, 'L', 1, 0, '', '', true);
                PDF::Ln(9);
                PDF::Write(0, 'Datos de Cosecha del Contratista');
                PDF::Ln(7);
                
                PDF::SetFont('Helvetica', '', 10);
                PDF::SetFillColor(155, 246, 234);
                PDF::MultiCell(62, 5, 'Trato por Cosecha', 1, 'C', 1, 0, '', '', true);
                PDF::MultiCell(63, 5, 'Kilos Recolectados', 1, 'C', 1, 0, '', '', true);
                PDF::MultiCell(63, 5, 'Costo Total de la Operación', 1, 'C', 1, 0, '', '', true);
                PDF::Ln(4.5);
                PDF::SetFillColor(251, 255, 254);
                PDF::SetFont('Helvetica', '', 12);
                PDF::MultiCell(62, 6, $con->tratoxcosecha, 1, 'C', 1, 0, '', '', true);
                PDF::MultiCell(63, 6, $con->kilos, 1, 'C', 1, 0, '', '', true);
                PDF::MultiCell(63, 6, $con->costototal, 1, 'C', 1, 0, '', '', true);
                $this->cortedehoja=$this->cortedehoja+1;
                if($this->cortedehoja==3){
                    PDF::AddPage();
                    PDF::Write(0, 'Datos de Contratista(s)');
                    PDF::Ln(7);
                    PDF::SetLineWidth(0.2);
                    PDF::SetFont('Helvetica', '', 10);
                    PDF::SetFillColor(155, 246, 234);
                    $this->cortedehoja=0;
                }
                
            }
            // detalle de la cosecha del contratista
            $detalledecosecha=detallecosecha::where('planificacioncosecha_id',$planificacioncosecha_id)->where('empresa_id',$contratista_id)->get();
            // dd($contratista_id);
            PDF::Ln(8);
            PDF::SetFont('Helvetica', '', 12);
            PDF::Write(0, 'Datos de la Cosecha del Contratista');
            PDF::Ln(7);
            PDF::SetFont('Helvetica', '', 10);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(62, 5, 'Tarja del Envase', 1, 'C', 1, 0, '', '', true);
            PDF::MultiCell(63, 5, 'Kilos', 1, 'C', 1, 0, '', '', true);
            PDF::Ln(5);
            foreach($detalledecosecha as $detalle){

                //datos de Cosecha
            
                PDF::SetFillColor(251, 255, 254);
                PDF::SetFont('Helvetica', '', 12);
                PDF::MultiCell(62, 5, $detalle->tarjaenvase, 1, 'C', 1, 0, '', '', true);
                PDF::MultiCell(63, 5, $detalle->kilos, 1, 'C', 1, 0, '', '', true);
                PDF::Ln(5);
                $this->suma = $this->suma + $detalle->kilos;
               
            }
            PDF::Ln(7);
            PDF::SetFont('Helvetica', '', 17);
            PDF::SetFillColor(155, 246, 234);
            PDF::MultiCell(63, 5, 'Total Kilos Cosechados', 1, 'C', 1, 0, '', '', true);
            // PDF::Ln(6);
            PDF::SetFillColor(251, 255, 254);
            PDF::SetFont('Helvetica', '', 34);
            PDF::MultiCell(63, 5, $this->suma, 1, 'C', 1, 0, '', '', true);


            // fin detalle de la cosecha del contratista
        // fin datos contratista






            PDF::Output('informe_cosecha_contratista.pdf');
        }
    }

    public function EstimacionCosecha($id){
        $anio = 2023;
        $mesCosecha = [];
    
        for ($i = 1; $i <= 12; $i++) {
            $kilosPorMesAnio = detallecosecha::where('especie_id', $id)
                ->whereYear('created_at', $anio)
                ->whereMonth('created_at', $i)
                ->sum('kilos');
    
            $mesCosecha[] = $kilosPorMesAnio;
        }
    
        return response()->json(['data' => $mesCosecha]);
    }
    
}
