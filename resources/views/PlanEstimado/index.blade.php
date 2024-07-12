<x-dashBoard>
<style>
    .fixed-section {
        position: sticky;
        top: 0;
       
        z-index: 1000;
    }
</style>
<div class="flex max-h-[650px] w-full flex-col overflow-y-scroll shadow-lg shadow-neutral-500">
    <div class="grid grid-cols-1">
    
        <div class="col-span-12 rounded-lg p-5">
            <table class="text-left text-sm font-light shadow-lg shadow-neutral-600 rounded-lg mt-10 w-full">
                <thead class="border-b bg-white font-medium">
                    <tr class="font-light bg-gray-300">
                        {{-- <th scope="col" class="px-6 py-4">Observación</th> --}}
                        {{-- <th scope="col" class="px-4 py-2">Campo</th>
                        <th scope="col" class="px-4 py-2">Cuartel</th> --}}
                        <th scope="col" class="px-4 py-2">Especie</th>
                        <th scope="col" class="px-4 py-2">Kilos Planificados</th>
                        <th scope="col" class="px-4 py-2">Kilos cosechados del periodo</th>
                        <th scope="col" class="px-4 py-2">Periodo</th>
                        <th scope="col" class="px-4 py-4">Representación</th>
                        {{-- <th scope="col" class="px-6 py-4">Inhabilitar</th> --}}
                    </tr>
                </thead>

                <tbody>
                    @foreach ($PlanEstimadosAct as $planEstimada)
                        <tr class="border-b bg-neutral-100">
                            {{-- <td class="whitespace-nowrap px-6 py-4">
                                    {{ $planEstimada->planificacionEstimada }}</td> --}}
                            {{-- <td class="whitespace-nowrap px-10 py-4">
                                {{ $planEstimada->campo->campo }}</td>
                            <td class="whitespace-nowrap px-4 py-4">
                                {{ $planEstimada->cuartel->observaciones }}
                            </td> --}}
                            <td class="whitespace-nowrap px-4 py-4">
                                {{ $planEstimada->especie->especie }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4">
                                {{ $planEstimada->cantidad }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4">
                                {{ $planEstimada->KilosActuales }}
                            </td>
                             <td class="whitespace-nowrap px-4 py-4">
                                <label class="font-bold">Fecha Inicio:</label>{{ $planEstimada->fechaInicio }}&nbsp;&nbsp;&nbsp; <label class="font-bold">Fecha Final: </label>{{ $planEstimada->fechaFinal }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-8">
                                <!-- component -->
                                {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script> --}}

                                @if ($planEstimada->KilosActuales == 0)
                                    @php
                                        $porc = 0;
                                        $porcentajeArriba=0;
                                        $porc = intVal($porc);
                                    @endphp
                                @else
                                    @php
                                        if($planEstimada->KilosActuales>$planEstimada->cantidad){
                                            $porc = 100;
                                            $resta = $planEstimada->KilosActuales - $planEstimada->cantidad ; //resto de kilos demas cosechados
                                                        $porcentajeArriba = intVal(($resta *  100) / $planEstimada->cantidad);
                                                        
                                        }else{

                                            $porc = ($planEstimada->KilosActuales / $planEstimada->cantidad) * 100;
                                            $resta=$planEstimada->cantidad - $planEstimada->KilosActuales;
                                            $porcentajeArriba = intVal(($resta *  100) / $planEstimada->cantidad);
                                        $porc = intVal($porc);
                                        }

                                    @endphp
                                @endif
                               
                                {{-- grafico nuevo  --}}
                                    <div class="grid grid-cols-1">
                                        <div class="fixed-section bg-neutral-100">    
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
                                                    <div class="ml-5 text-left">
                                                        <p class="text-gray-600 sm:text-xl">
                                                        ,</br>  {{-- especie --}}
                                                        
                                                        @if($planEstimada->KilosActuales>$planEstimada->cantidad)
                                                                <span>{{ $porcentajeArriba }}% <i
                                                        class="fa-solid fa-arrow-up-wide-short text-green-800"></i></span>
                                                        @else
                                                        {{ $porcentajeArriba }} % <i class="fa-solid fa-arrow-down-wide-short text-red-800 animate-bounce"></i>
                                                        @endif
                                                        </p>
                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- fin --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
    {{-- </div> --}}
</div>
</x-dashBoard>
