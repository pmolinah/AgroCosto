<div>
    <!-- component -->
    
    <div class="col-span-4 w-full rounded-xl border border-gray-200 bg-white px-2 shadow-lg shadow-neutral-800 mb-2">
            @livewire('graficos.grafico-envase-radar-exportadora')  
        </div>
    <div class="w-full rounded-xl border border-gray-200 bg-white px-2 shadow-lg shadow-neutral-800">
        <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
            <div>Planificación Anual de Especies</div>
        </div>

        <div class="flex max-h-[265px] w-full flex-col overflow-y-scroll">
            <div class="grid grid-cols-4">
                @for ($i = 0; $i < count($estimadoEspecie); $i++)
                    @if ($estimadoEspecie[$i][0] != 'N/A')
                        <div class="col-span-4 inline-block relative">
                            @if ($estimadoEspecie[$i][2] == 0 || $estimadoEspecie[$i][1] == 0)
                                @php
                                    $porc = 0;
                                    $porcentajeArriba=0;
                                    $porc = intVal($porc);
                                @endphp
                            @else
                                @php
                                    if($estimadoEspecie[$i][2]>$estimadoEspecie[$i][1]){
                                        $porc=100;
                                    }
                                    if($estimadoEspecie[$i][2]<$estimadoEspecie[$i][1] && ($estimadoEspecie[$i][2]>$estimadoEspecie[$i][2]!=0)){
                                        $porc = ($estimadoEspecie[$i][2] / $estimadoEspecie[$i][1]) * 100;
                                        $porc = intVal($porc);
                                    }
                                    if($estimadoEspecie[$i][2]<$estimadoEspecie[$i][1]){

                                        $porc = ($estimadoEspecie[$i][2] / $estimadoEspecie[$i][1]) * 100;
                                            $resta=$estimadoEspecie[$i][1] - $estimadoEspecie[$i][2];
                                            $porcentajeArriba = intVal(($resta *  100) / $estimadoEspecie[$i][1]);
                                        $porc = intVal($porc);
                                    }
                                    
    
                                @endphp
                            @endif
                            <div class="m-7 flex items-center px-7 bg-white shadow-xl shadow-neutral-400 rounded-2xl h-20"
                                x-data="{ circumference: 50 * 2 * Math.PI, percent: {{ $porc }} }">
                                <div class="flex items-center justify-center overflow-hidden bg-white rounded-full">
                                    <svg class="w-28 h-28" x-cloak aria-hidden="true">
                                        <circle class="text-gray-300" stroke-width="5" stroke="currentColor" fill="transparent" r="50" cx="56" cy="56" />
                                        <circle class="@if ($porc < 50) text-red-700 @else text-blue-700 @endif" stroke-width="5"
                                            :stroke-dasharray="circumference" :stroke-dashoffset="circumference - percent / 100 * circumference"
                                            stroke-linecap="round" stroke="currentColor" fill="transparent" r="50" cx="56" cy="56" />
                                    </svg>
                                    <span class="absolute text-md text-bold @if ($porc < 50) text-red-700 @else text-blue-700 @endif"
                                        x-text="`${percent}%`"></span>
                                </div>

                                {{-- $this->estimadoEspecie[$this->i][1]=$sumarEstimado;
                                $this->estimadoEspecie[$this->i][2]=$sumaKilosCosechados; cantidad total cosechada actual--}}
                                <div class="ml-5 text-left">
                                    <p class="text-gray-600 sm:text-xl">
                                        {{ $estimadoEspecie[$i][0] }},</br>  {{-- especie --}}
                                        @if ($porc > 0)
                                            @if ($estimadoEspecie[$i][2] > $estimadoEspecie[$i][1])
                                                @php
                                                    $resta = $estimadoEspecie[$i][2] - $estimadoEspecie[$i][1]; //resto de kilos demas cosechados
                                                    $porcentajeArriba = intVal(($resta *  100) / $estimadoEspecie[$i][2]);
                                                @endphp
                                                {{-- {{ $porcentajeArriba }}% <i
                                                    class="fa-solid fa-arrow-up-wide-short text-green-800"></i> --}}
                                            @endif
                                        @endif
                                        {{-- {{ $porc }} --}}
                                        @if ($porc < 100 && $porc > 0)
                                            {{-- @if ($estimadoEspecie[$i][2] > $estimadoEspecie[$i][1]) --}}
                                            @php
                                                $resta = $estimadoEspecie[$i][1] - $estimadoEspecie[$i][2];

                                                $porcentajeArriba = intVal(($resta / $estimadoEspecie[$i][1]) * 100);
                                            @endphp
                                            {{-- {{ $porcentajeArriba }}%
                                            <i
                                                class="fa-solid fa-arrow-down-wide-short text-red-800 animate-bounce"></i> --}}
                                                 
                                            {{-- @endif --}}
                                        @endif
                                        @if($estimadoEspecie[$i][2]>$estimadoEspecie[$i][1])
                                                                <span>{{ $porcentajeArriba }}% <i
                                                        class="fa-solid fa-arrow-up-wide-short text-green-800"></i></span>
                                                        @else
                                                        {{ $porcentajeArriba }} % <i class="fa-solid fa-arrow-down-wide-short text-red-800 animate-bounce"></i>
                                                        @endif
                                    </p>
                                    <span
                                        class="text-xl font-medium @if ($porc < 50) text-red-700 @else text-blue-700 @endif hidden sm:block">Total:{{ $estimadoEspecie[$i][1] }}.K</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
</div>


