<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\empresa;
use App\Models\comuna;
use App\Models\User;
use App\Models\campo;
use Illuminate\Support\Facades\Session;

class CampoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empresas=empresa::all();
         
        return view('Campo.create', compact('empresas'));
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
    public function update(Request $request)
    {
      
        $act=campo::where('id',$request->id)->update(['campo'=>$request->campo,'direccion'=>$request->direccion,'superficie'=>$request->superficie,'comuna_id'=>$request->comuna_id]);
        Session::flash('success', 'Campo Actualizado Correctamente');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function organizacion(){
        return view('organizacion.index');
    }
}
