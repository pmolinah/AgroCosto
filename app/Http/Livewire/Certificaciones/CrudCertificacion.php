<?php

namespace App\Http\Livewire\Certificaciones;

use Livewire\Component;
use App\Models\certificacion;
use App\Models\campo;
use App\Models\certificacionasignada;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CrudCertificacion extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $certificaciones=array();
    public $open_nuevo_certificacion=false;
    public $certificado;
    public $search,$edit_id=false;
    public $modal=false;
    public $certificado_id,$fechaInicio,$fechaTermino,$observacion,$archivo,$asignado_id,$rutaArchivo,$alerta,$campo_id,$casaCertificadora;

    public function Save(){
        certificacion::create(['certificacion'=>$this->certificado]);
        $this->reset(['certificado']);

        $this->dispatchBrowserEvent('GuardarCertificado', [
            'title' => 'Registro guardado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);

    }    

    public function EliminarCertificado($id){
        certificacionasignada::where('id',$id)->delete();
        $this->dispatchBrowserEvent('Eliminar', [
            'title' => 'Registro Eliminado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }
    public function EliminarnombreCertificado($id){
        certificacion::where('id',$id)->delete();
        $this->dispatchBrowserEvent('Eliminar', [
            'title' => 'Registro Eliminado correctamente.',
            'icon'=>'success',
            'iconColor'=>'blue',
        ]);
    }

    public function EditarCertificado(certificacion $certificacion){
        $this->certificado=$certificacion->certificacion;
        $this->edit_id=$certificacion->id;
        $this->open_edit=true;
    }

    public function AgregarCertificado($campo_id){
        $this->modal=true;
    }

    public function render()
    {
        $certificacionCampo=campo::all();
        $certificacion=certificacion::where('certificacion','like','%'.$this->search.'%')->paginate(3);
        return view('livewire.certificaciones.crud-certificacion',compact('certificacion','certificacionCampo'));
    }
}
