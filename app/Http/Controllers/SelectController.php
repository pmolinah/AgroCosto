<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\campo;
use App\Models\cuartel;
use App\Models\especie;
use App\Models\plantacion;
use App\Models\color;

class SelectController extends Controller
{
    public $MatrizDatosCuartel=array();
    public $MatrizDatosPlantacion=array();
    
    public function CambioEmpresa($id){
        return $campos=campo::where('empresa_id',$id)->get();
    }

    public function CambioCampo($id){
        return $campos=cuartel::where('campo_id',$id)->get();
    }

    public function CambioEmpresaPlan($id){
        return $campos=campo::where('empresa_id',$id)->get();
    }

    public function CambioCampoPlan($id){
        return $campos=cuartel::where('campo_id',$id)->get();
    }

    public function CambioCuatel($id){
        return $campos=cuartel::where('id',$id)->get();
         
    }

    public function CambioCuartelPlan($id){
        //return $id;
        $plantaciones=plantacion::where('cuartel_id',$id)->get();
        foreach($plantaciones as $plantacion)
        {
        //    $this->MatrizDatosPlantacion[0]=$plantacion->cuartel->observaciones;
           $this->MatrizDatosPlantacion[1]=$plantacion->especie->especie;
           $this->MatrizDatosPlantacion[2]=$plantacion->cantidadPlantas;
           $this->MatrizDatosPlantacion[3]=$plantacion->cantidadPlantada;
           $this->MatrizDatosPlantacion[4]=$plantacion->cuartel->capataz->name;
           $this->MatrizDatosPlantacion[5]=$plantacion->cuartel->campo->adm->name;
           $this->MatrizDatosPlantacion[6]=$plantacion->especie->variedad->variedad;
           $this->MatrizDatosPlantacion[7]=$plantacion->id;
           $this->MatrizDatosPlantacion[8]=$plantacion->cuartel->superficie;



            return $this->MatrizDatosPlantacion;
        } 
    }


    public function CambioEspecie($id){
        return $campos=especie::where('id',$id)->get();
         
    }

    public function CambioCuatelPlanificacion($id){
        $plantacion=plantacion::where('cuartel_id')->get();
        foreach($plantacion as $plantacion){
            $this->MatrizDatosCuartel[0]=$plantacion->especie->especie;
            $this->MatrizDatosCuartel[1]=$plantacion->especie->variedad;
            $this->MatrizDatosCuartel[2]=$plantacion->cantidadPlantas;
            $this->MatrizDatosCuartel[3]=$plantacion->cantidadPlantada;
            
        }
        return $this->MatrizDatosCuartel;
    }
    
    public function RecuperarColor($id){
        $colores=color::where('id',$id)->get();
        foreach($colores as $color){
            return($color->color);
        };
    }
}
