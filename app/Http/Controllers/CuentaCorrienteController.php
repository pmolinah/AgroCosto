<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\empresa;
use App\Models\envase;
use App\Models\color;
use App\Models\cuentaenvase;
use App\Models\desgloseenvase;
use App\Models\desgloseenvasecampo;
use App\Models\envaseempresa;
use App\Models\detallecuentaenvase;

use Illuminate\Support\Facades\Session;

class CuentaCorrienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $colorMatriz=array();
    public $cuentaEnvID;
    public $colorCantidad=array();
    public $num=0;
    public $stockExpo=0;
    public $saldoEmpr=0;
    public $sumaEnvases=0;     
    public $empresaenvaseID;  

    public function index()
    {
        $exportadoras=empresa::where('tipo_id',4)->get();
        $empresas=empresa::where('tipo_id',1)->get();
        $envase=envase::all();
        $envaseCampo=envase::all();
        $colores=color::all();
        $cuentaenvases=cuentaenvase::all();
        $cuentaExportadoras=cuentaenvase::all();
        $envaseempresa=envaseempresa::with('desgloseenvasecampo')->get();
        
        return view('CuentaCorriente.index',compact('exportadoras','envase','colores','cuentaenvases','empresas','envaseCampo','envaseempresa','cuentaExportadoras'));
        
    }
    public function indexExportadoras()
    {
        $exportadoras=empresa::where('tipo_id',4)->get();
        $empresas=empresa::where('tipo_id',1)->get();
        $envase=envase::all();
        $envaseCampo=envase::all();
        $colores=color::all();
        $cuentaenvases=cuentaenvase::all();
        $envaseempresa=envaseempresa::with('desgloseenvasecampo')->get();
        
        return view('CuentaCorriente.indexExportadora',compact('exportadoras','envase','colores','cuentaenvases','empresas','envaseCampo','envaseempresa'));
        
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
        
        //verificacion si el campo tiene cuenta corriente creada con el tipo de envase
        $campo=envaseempresa::where('campo_id',$request->campo_id)->where('envase_id',$request->envase_id)->count();
        if($campo>0){
            $campo=envaseempresa::where('campo_id',$request->campo_id)->where('envase_id',$request->envase_id)->get();
            foreach($campo as $empresaenvase){
                $this->empresaenvaseID =  $empresaenvase->id;
            }
        }else{
            $envEmp=envaseempresa::create([
                'campo_id'=>$request->campo_id,
                'envase_id'=>$request->envase_id,
                'stock'=>0,
            ]);
            $this->empresaenvaseID = $envEmp->id;
        }
        //verificacion si tiene cuentacorriente de ese envase el exportador
        $siCuentaExiste=cuentaenvase::where('empresa_id',$request->exportadora_id)->where('envase_id',$request->envase_id)->where('campo_id',$request->campo_id)->count();
        if($siCuentaExiste>0)
        {
            $siCuentaExiste=cuentaenvase::where('empresa_id',$request->exportadora_id)->where('envase_id',$request->envase_id)->where('campo_id',$request->campo_id)->get();
            foreach($siCuentaExiste as $cuenta){
                $this->stockExpo=$cuenta->stock;
                $this->cuentaEnvID=$cuenta->id;
            }
        }else{
            $cuentaEnvase=cuentaenvase::create([
                'empresa_id'=>$request->exportadora_id,
                'envase_id'=>$request->envase_id,
                'observacion'=>$request->observacion,
                'campo_id'=>$request->campo_id,
                'saldo'=>0,
            ]);
            $this->cuentaEnvID=$cuentaEnvase->id;
        }

        $this->colorMatriz=$request->colores_nom;
        $this->colorCantidad=$request->CantidadEnvaseColor;
     
        $this->num=count($this->colorMatriz); // cantidad de de colores segun variedad enviada
   
        //detalle de desgloseenvasecampos - detallecuentaenvase 
        for($i=0;$i<$this->num;$i++){
            $color=color::where('color',$this->colorMatriz[$i])->get(); //recupero el color_id
            foreach($color as $colorID){
                $validacionDesgloseExportadora=detallecuentaenvase::where('cuentaenvase_id',$this->cuentaEnvID)->where('color_id',$colorID->id)->count();
                if($validacionDesgloseExportadora>0){
                    detallecuentaenvase::where('cuentaenvase_id',$this->cuentaEnvID)->where('color_id',$colorID->id)->increment('stock',$this->colorCantidad[$i]);
                    cuentaenvase::where('empresa_id',$request->exportadora_id)->where('envase_id',$request->envase_id)->where('campo_id',$request->campo_id)->increment('saldo',$this->colorCantidad[$i]);
                    envaseempresa::where('id',$this->empresaenvaseID)->increment('stock',$this->colorCantidad[$i]);
                }else{
                    cuentaenvase::where('empresa_id',$request->exportadora_id)->where('envase_id',$request->envase_id)->where('campo_id',$request->campo_id)->increment('saldo',$this->colorCantidad[$i]);
                    envaseempresa::where('id',$this->empresaenvaseID)->increment('stock',$this->colorCantidad[$i]);
                    $SaveCuenta=detallecuentaenvase::create([
                        'cuentaenvase_id'=>$this->cuentaEnvID,
                        'stock'=>$this->colorCantidad[$i],
                        'color_id'=>$colorID->id,
                    ]);
                }

             
            }
        }
       
        Session::flash('success', 'Cuenta Corriente iniciada Correctamente');
        return redirect()->route('CuentaCorrienteExportadoras.index');
    }

    public function storeCampo(Request $request){
        $cuentacampoexiste=envaseempresa::where('campo_id',$request->campo_id)->where('envase_id',$request->envase_id)->count();
            if($cuentacampoexiste<1){
                    $cuenta=envaseempresa::create([
                        'campo_id'=>$request->campo_id,
                        'envase_id'=>$request->envase_id,
                        'observacion'=>$request->observacionDos,
                        'stock'=>0,
                    ]);
                    $this->colorMatriz=$request->colores_nomDos;
                    $this->colorCantidad=$request->CantidadEnvaseColorDos;
                    $this->num=count($this->colorMatriz);
                    for($i=0;$i<$this->num;$i++){
                        $color=color::where('color',$this->colorMatriz[$i])->get();
                        foreach($color as $colorID){
                            $SaveCuenta=desgloseenvasecampo::create([
                                'envaseempresa_id'=>$cuenta->id,
                                'stock'=>$this->colorCantidad[$i],
                                'color_id'=>$colorID->id,
                            ]);
                            $this->sumaEnvases=$this->sumaEnvases + $this->colorCantidad[$i]; 
                        }
                    }
                    $cuenta->update(['stock'=>$this->sumaEnvases]); 
            }else{
                $cuentacampoexiste=envaseempresa::where('campo_id',$request->campo_id)->where('envase_id',$request->envase_id)->get();
                    $this->colorMatriz=$request->colores_nomDos;
                    $this->colorCantidad=$request->CantidadEnvaseColorDos;
                foreach($cuentacampoexiste as $empresaID){
                    $this->num=count($this->colorMatriz);
                    for($i=0;$i<$this->num;$i++){
                            $color=color::where('color',$this->colorMatriz[$i])->get();
                           foreach($color as $colorID){
                                $desgloseenvasecampo=desgloseenvasecampo::where('envaseempresa_id',$empresaID->id)->where('color_id',$colorID->id)->count();
                                if($desgloseenvasecampo>0){
                                    $desgloseenvasecampo=desgloseenvasecampo::where('envaseempresa_id',$empresaID->id)->where('color_id',$colorID->id)->increment('stock',$this->colorCantidad[$i]);
                                    $cuentaenvasuma=envaseempresa::where('id',$empresaID->id)->increment('stock',$this->colorCantidad[$i]);
                                }else{
                                    $SaveCuenta=desgloseenvasecampo::create([
                                        'envaseempresa_id'=>$empresaID->id,
                                        'stock'=>$this->colorCantidad[$i],
                                        'color_id'=>$colorID->id,
                                    ]);
                                    $cuentaenvasuma=envaseempresa::where('id',$empresaID->id)->increment('stock',$this->colorCantidad[$i]);
                                }
                            }
                    }
                }
            }
            Session::flash('success', 'Cuenta Corriente iniciada Correctamente');
            return redirect()->route('CuentaCorriente.index');
        }
       
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy($id)
    {
        $cuenta = cuentaenvase::find($id);
        $cuenta->desgloseenvase()->delete(); 
        $cuenta->delete();
    }

    public function destroyCampo($id)
    {
        $cuenta = envaseempresa::find($id);
        $cuenta->desgloseenvasecampo()->delete(); 
        $cuenta->delete();
    }
}
