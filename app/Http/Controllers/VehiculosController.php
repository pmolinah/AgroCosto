<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehiculosController extends Controller
{
    public function index(){
        return view('Vehiculos.index');
    }
}
