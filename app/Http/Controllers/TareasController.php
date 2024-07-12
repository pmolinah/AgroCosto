<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\detalletarea;
class TareasController extends Controller
{
    public function CrearTarea(){
        return view('Tarea.CrearTarea');
    }
    public function TareasPlanificadas(){
        return view('Tarea.Planificadas');
    }
    public function TareasFinalizadas(){
        $detalletareas=detalletarea::where('estado',1)->get();
        return view('Tarea.Finalizadas',compact('detalletareas'));
    }
}
