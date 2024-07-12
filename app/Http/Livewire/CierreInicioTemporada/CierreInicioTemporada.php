<?php

namespace App\Http\Livewire\CierreInicioTemporada;

use Livewire\Component;
use App\Models\cuentaenvase;
use App\Models\envaseempresa;
use App\Models\temporadaexpo;
use App\Models\temporadacampo;
use App\Models\detalletemporadaexpo;
use App\Models\detalletemporadacampo;
use Illuminate\Support\Facades\Session;
class CierreInicioTemporada extends Component
{
   public $observacion;
   
    public function CierreTemporadaCampo($envaseempresa_id){
    $cuentaEnvaseCampo=envaseempresa::with('desgloseenvasecampo')->where('id',$envaseempresa_id)->get();

    foreach($cuentaEnvaseCampo as $cuentaCampo){
        $temporadaCampos=temporadacampo::create([
            'envaseempresa_id'=>$cuentaCampo->id,
            'campo_id'=>$cuentaCampo->campo_id,
            'envase_id'=>$cuentaCampo->envase_id,
            'stock'=>$cuentaCampo->stock,
            
        ]);
        foreach($cuentaCampo->desgloseenvasecampo as $detalleEnvaseCampo){
            detalletemporadacampo::create([
                'temporadacampo_id'=>$temporadaCampos->id,
                'color_id'=>$detalleEnvaseCampo->color_id,
                'stock'=>$detalleEnvaseCampo->stock,
            ]);
        }
    }

    Session::flash('success', 'Cierre de Temporada Registrado...');
        return redirect()->route('CierreInicioTemporada.index');

   }
   public function CierreTemporadaExpo($cuentaenvase_id){
         $cuentaEnvase=cuentaenvase::with('detallecuentaenvase')->where('id',$cuentaenvase_id)->get();
         foreach($cuentaEnvase as $cuentaExpo){
             $temporadaexpos=temporadaexpo::create([
                 'cuentaenvase_id'=>$cuentaExpo->id,
                 'empresa_id'=>$cuentaExpo->empresa_id,
                 'envase_id'=>$cuentaExpo->envase_id,
                 'campo_id'=>$cuentaExpo->campo_id,
                 'saldo'=>$cuentaExpo->saldo,
                 'observacion'=>'Cierre de Temporada',
             ]);
             foreach($cuentaExpo->detallecuentaenvase as $detalleEnvaseExpo){
                 detalletemporadaexpo::create([
                     'temporadaexpo_id'=>$temporadaexpos->id,
                     'color_id'=>$detalleEnvaseExpo->color_id,
                     'stock'=>$detalleEnvaseExpo->stock,
                 ]);
            }
        }
            
            Session::flash('success', 'Cierre de Temporada Registrado...');
            return redirect()->route('CierreInicioTemporada.index');
   }
   
    public function render()
    {
        $cuentasExportadoras=cuentaenvase::with('detallecuentaenvase','temporadaexpo')->get();
        $cuentasCampos=envaseempresa::with('desgloseenvasecampo','temporadacampo')->get();
        return view('livewire.cierre-inicio-temporada.cierre-inicio-temporada',compact('cuentasExportadoras','cuentasCampos'));
    }
}
