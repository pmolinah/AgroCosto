<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DevolucionEnvaseController extends Controller
{
    public function Devolucion(){
        return view('Devolucion.devolucion');
    }
}
