<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\plantacion;
use App\Models\User;
use App\Models\empresa;
use App\Models\especie;
use App\Models\variedad;
use Illuminate\Support\Facades\Session;

class PlantacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $pivote;

    public function index()
    {
        $plantaciones=plantacion::all();
        return view('Plantacion.index', compact('plantaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $administrador=User::where('id',1)->get();
        $empresas=empresa::all();
        $especies=especie::all();
        $variedades=variedad::all();
        return view('Plantacion.create',compact('administrador','empresas','especies','variedades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        $this->pivote=$request->empresa_id.$request->campo_id.$request->cuartel_id;
        //dd($this->pivote);
        $plantacion=plantacion::where('pivote',$this->pivote)->get();
        if ($plantacion->count() > 0) {
            Session::flash('error', 'Cuartel ya se Encuenbtra Plantado...');
            return back();
        }
        $plantacion = plantacion::create($request->all());
        $plantacion->update(['pivote'=>$this->pivote]);

        Session::flash('success', 'Rol Guardado Correctamente...');
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
        $res=plantacion::where('id',$id)->delete();
        return $res;
    }
}
