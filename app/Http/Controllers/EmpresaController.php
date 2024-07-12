<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\empresa;
use App\Models\tipo;
use App\Models\comuna;
use Illuminate\Support\Facades\Session;
class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $comu=array();
    public function index()
    {
        $Empresas=empresa::all();
        return view('Empresa.index',compact('Empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comunas=comuna::all();
        $tipo=Tipo::all();
        return view('Empresa.create',compact('comunas','tipo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $empresa=empresa::create($request->all());
        Session::flash('success', 'Empresa Guardada Correctamente...');
        return back();
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
    public function edit(empresa $Empresa)
    {
       //dd($Empresa);
        $comunas=Comuna::all();
        // $comu = Comuna::pluck('comuna', 'id')->toArray();
        $tipos=Tipo::all();
        return view('Empresa.edit',compact('Empresa','comunas','tipos'));//,'comu'
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, empresa $empresa)
    {
        $empresa->update($request->all());
        Session::flash('success', 'Empresa Actualizado Correctamente...');
        return redirect()->route('Empresa.edit',$empresa->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function verificarRut($rut){
      
        $existeEmpresa=empresa::where('rut',$rut)->count();
        if($existeEmpresa>0){
            return 1;
        }else{
            return 0;
        }
    }
}
