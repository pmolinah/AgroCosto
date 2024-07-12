<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\empresa;
use App\Models\especie;
use App\Models\User;
use App\Models\planestimada;
use App\Models\detallecosecha;
use Illuminate\Support\Facades\Session;

class PlanEstimadoController extends Controller
{
    
    public function index(){
        $estimadas=planestimada::all();
        foreach($estimadas as $estimada){
            $sumaKilos=detallecosecha::whereBetween('created_at',[$estimada->fechaInicio,$estimada->fechaFinal])->where('especie_id',$estimada->especie_id)->sum('kilos');
            $actKilos=planestimada::where('id',$estimada->id)->update(['KilosActuales'=>$sumaKilos]);
        }
        $PlanEstimadosAct=planestimada::all();
        return view('PlanEstimado.index',compact('PlanEstimadosAct'));
    }
    
    public function createPlan(){
        $empresas=empresa::where('tipo_id',1)->get();
        $especies=especie::all();
        $administrador=User::where('tipo_id',1)->get();
        return view('PlanEstimado.create',compact('empresas','especies','administrador'));
    }

    public function store(Request $request){
 
        $existe=planestimada::whereBetween('fechaInicio', [$request->fechaInicio, $request->fechaFinal])->where('especie_id',$request->especie_id)->orWhereBetween('fechaFinal', [$request->fechaInicio, $request->fechaFinal])->where('especie_id',$request->especie_id)->count();
        if($existe>0){
             Session::flash('error', 'Planificación Estimada ya Existe...');
        return back();
        }else{
            planestimada::create([
                'planificacionEstimada'=>$request->observacion,
                'fechaInicio'=>$request->fechaInicio,
                'fechaFinal'=>$request->fechaFinal,
                'cumplida'=>0,
                'especie_id'=>$request->especie_id,
                'responsable_id'=>$request->responsable_id,
                'cantidad'=>$request->cantidad,
                'campo_id'=>$request->campo_id,
                'cuartel_id'=>$request->cuartel_id
            ]);
            Session::flash('success', 'Planificación Estimada Guardada...');
            return back();
        }
       
    }
}
