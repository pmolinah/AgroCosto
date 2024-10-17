<?php

namespace App\Http\Livewire\Planificacion;

use Livewire\Component;
use App\Models\planificacioncosecha;
use App\Models\empresa;
use App\Models\exportadoraxplanificacion;
use App\Models\contraistaxplanificacion;
use App\Models\cuentaenvase;
class EditPlanificacion extends Component
{
   public $planificacioncosecha_id,$campo_id;
   public $exportadoraid,$contratista_id,$kiloSolicitados,$envase_id,$tratoxcosecha,$kilos;

   public function eliminarExportadora($id)
    {
        $registro = exportadoraxplanificacion::find($id);
        if ($registro) {
            $registro->delete();
            $this->dispatchBrowserEvent('EliminarRegistro', [
                'title' => 'Eliminación, de Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        } 
    }
     public function eliminarContratista($id)
     {
         $registro = contraistaxplanificacion::find($id);
         if ($registro) {
             $registro->delete();
             $this->dispatchBrowserEvent('EliminarRegistro', [
                'title' => 'Eliminación, de Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
         } 
    //     // Puedes emitir un evento para refrescar la lista si es necesario
    //     $this->emit('registroEliminadoo');
    }

    public function agregaExportadora(){
   
        $buscarExportadora=exportadoraxplanificacion::where('planificacioncosecha_id',$this->planificacioncosecha_id)->where('empresa_id',$this->exportadoraid)->first();
        if($buscarExportadora){
            // session()->flash('errorYaExiste', 'Registro ya existe.');
            // $this->emit('registroYaExiste');
            $this->dispatchBrowserEvent('ErrorYaExiste', [
                'title' => 'Error, Faltan Datos.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }else{
       
            $buscarCuenta=cuentaenvase::where('campo_id',$this->campo_id)->where('empresa_id',$this->exportadoraid)->where('envase_id',$this->envase_id)->first();
            if($buscarCuenta){
                exportadoraxplanificacion::create([
                    'planificacioncosecha_id'=>$this->planificacioncosecha_id,
                    'empresa_id'=>$this->exportadoraid,
                    'kilosSolicitados'=>$this->kiloSolicitados,
                    'cuentaenvase_id'=>$buscarCuenta->id,
                ]);
                $this->dispatchBrowserEvent('GuardadoCorrecto', [
                    'title' => 'Error, Faltan Datos.',
                    'icon'=>'error',
                    'iconColor'=>'blue',
                ]);
                return back();
            }else{
                $this->dispatchBrowserEvent('ErrorSinCuentacorriente', [
                    'title' => 'Error, Cuenta Corriente.',
                    'icon'=>'error',
                    'iconColor'=>'blue',
                ]);
                return back();
            }
        }
        //$this->emit('registroEliminado');
    }
    public function agregarContratista(){
        // dd($this->contratista_id);
        $buscarExportadora=contraistaxplanificacion::where('planificacioncosecha_id',$this->planificacioncosecha_id)->where('contratista_id',$this->contratista_id)->first();
        if($buscarExportadora){
            // session()->flash('errorYaExiste', 'Registro ya existe.');
            // $this->emit('registroYaExiste');
            $this->dispatchBrowserEvent('ErrorYaExiste', [
                'title' => 'Error, ya Existe.',
                'icon'=>'error',
                'iconColor'=>'blue',
            ]);
            return back();
        }else{
            contraistaxplanificacion::create([
                'planificacioncosecha_id'=>$this->planificacioncosecha_id,
                'contratista_id'=>$this->contratista_id,
                'tratoxcosecha'=>$this->tratoxcosecha,
                'kilos'=>$this->kilos,
            ]);
            $this->dispatchBrowserEvent('GuardadoCorrecto', [
                'title' => 'Correcto,Datos.',
                'icon'=>'success',
                'iconColor'=>'blue',
            ]);
            return back();
        }
    }

    public function render()
    {
        $exportadoras=empresa::where('tipo_id',4)->get();
        $contratistas=empresa::where('tipo_id',3)->get();
        $datosplanifdicacion=planificacioncosecha::with('exportadoraxplanificacion','contraistaxplanificacion')->where('id',$this->planificacioncosecha_id)->get();
        $datosplanifdicacionInfo=planificacioncosecha::with('exportadoraxplanificacion','contraistaxplanificacion')->where('id',$this->planificacioncosecha_id)->first();
        $this->campo_id=$datosplanifdicacionInfo->cuartel->campo_id;
        $this->envase_id=$datosplanifdicacionInfo->envase_id;
        return view('livewire.planificacion.edit-planificacion',compact(['datosplanifdicacion','exportadoras','contratistas']));
    }
}
