<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CierreInicioTemporadaController extends Controller
{
    public function CierreInicioTemporada(){
        return view('CierreInicioTemporada.CierreInicioTemporada');
    }
}
