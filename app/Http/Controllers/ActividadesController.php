<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    public function RegistroActividad(){
        return view('actividades.actividades');
    }
    public function ParametrosActividades(){
        return view('actividades.parametrosActividades');
    }
}
