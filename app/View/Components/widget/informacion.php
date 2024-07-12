<?php

namespace App\View\Components\widget;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\campo;
use App\Models\cuartel;
use App\Models\especie;
use App\Models\empresa;

class informacion extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $campos=campo::all()->count();
        $cuarteles=cuartel::all()->count();
        $especies=especie::all()->count();
        $contratistas=empresa::all()->count();
       
        return view('components.widget.informacion',compact('campos','cuarteles','especies','contratistas'));
    }
}
