<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\plantacion;
use App\Models\cuartel;
use App\Models\campo;
use App\Models\certificacionasignada;
use App\Models\certificacionasignadacuartel;
use Illuminate\Support\Facades\Session;

class CertificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $cuartel_id;
    public function index()
    {
        
        $certificacionCampo=campo::with('certificacionasignada')->get();
        return view('Certificacion.index',compact('certificacionCampo'));
    }

    public function indexCertificacionCuartel(){
        $certificacionCuartel=cuartel::with('certificacionasignadaCuartel')->get();
        return view('Certificacion.indexCuarteles',compact('certificacionCuartel'));
        
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
        //dd($request);
        // $nombreArchivo = $request->file('file')->getClientOriginalName();

        if($request->hasFile('file')) {
                    
            $nombreFile = $request->file('file')->getClientOriginalName();
            $this->campo_id='Campo_'.$request->campo_id.'id';
            
            //no Upload path
            $destinationPath = 'Archivos/Cargados/Certificados/'.$this->campo_id."/";
    
            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Get file extension
           
            $extension = $request->file('file')->getClientOriginalExtension();
          
            // Valid extensions
            $validextensions = array("jpeg","jpg","png","pdf","JPG","rar","csv","CSV","XLSX","xlsx");
    
            // Check extension

            if(in_array(strtolower($extension), $validextensions)){
        

                $nombreFile = $nombreFile."_".$this->campo_id.".".$extension;
                $request->file('file')->move($destinationPath, $nombreFile); 
                certificacionasignada::create([
                    'certificacion_id'=>$request->certificado_id,
                    'fechaInicio'=>$request->fechaInicio,
                    'fechaTermino'=>$request->fechaTermino,
                    'observacion'=>$request->observacion,
                    'rutaDocumento'=>$destinationPath,
                    'campo_id'=>$request->campo_id,
                    'casaCertificadora'=>$request->casaCertificadora,
                    
                    'alertaTempranaCaducidad'=>$request->alerta,
                    'documento'=>$nombreFile,
                     ]);
            }
        Session::flash('success', 'Certificado Asignado');
        return back();

        }
    }
    public function storeCuartel(Request $request){
        //dd($request);
        if($request->hasFile('file')) {
                    
            $nombreFile = $request->file('file')->getClientOriginalName();
            $this->cuartel_id='Cuartel_'.$request->cuartel_id.'id';
            
            //no Upload path
            $destinationPath = 'Archivos/Cargados/CertificadosCuartel/'.$this->cuartel_id."/";
    
            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Get file extension
           
            $extension = $request->file('file')->getClientOriginalExtension();
          
            // Valid extensions
            $validextensions = array("jpeg","jpg","png","pdf","JPG","rar","csv","CSV","XLSX","xlsx");
    
            // Check extension

            if(in_array(strtolower($extension), $validextensions)){
    

                $nombreFile = $nombreFile."_".$this->cuartel_id.".".$extension;
                $request->file('file')->move($destinationPath, $nombreFile); 
                certificacionasignadacuartel::create([
                    'certificacion_id'=>$request->certificado_id,
                    'fechaInicio'=>$request->fechaInicio,
                    'fechaTermino'=>$request->fechaTermino,
                    'observacion'=>$request->observacion,
                    'rutaDocumento'=>$destinationPath,
                    'cuartel_id'=>$request->cuartel_id,
                    'casaCertificadora'=>$request->casaCertificadora,
                    'alertaTempranaCaducidad'=>$request->alerta,
                    'codigoCertificacion'=>$request->codigoCertificado,
                    'documento'=>$nombreFile,
                     ]);
            }
        Session::flash('success', 'Certificado Asignado');
        return back();

        }

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
    public function destroy(string $id)
    {
        //
    }
}
