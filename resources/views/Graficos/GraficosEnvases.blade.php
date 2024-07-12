<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resumen de Envase por Campo y Exportadora') }}
        </h2>
        
    </x-slot>
    <!-- Add Item Ml -->
   
    <div class="grid grid-cols-12 gap-5 bg-white overflow-hidden shadow-xl sm:rounded-lg">
       
        
                
                <!-- contenido -->
                <div class="col-span-8 m-2 shadow-xl ">
                    Exportadoras
                    @livewire('graficos.grafico-envase-bar')
                    Campos
                    @livewire('graficos.grafico-envase-bar-campo')
                </div>
                <div class="col-span-4 m-2 shadow-xl border-dashed border-2 border-sky-500">
                 @livewire('graficos.grafico-envase-radar-exportadora')       
                 {{-- @livewire('graficos.grafico-envase-radar-exportadora')           --}}
                 </div> 
             {{--     {{--    {{-- <div class="col-span-4 m-2 shadow-xl">
                    @livewire('graficos.grafico-torta')
                </div> --}}
               {{--   <div class="col-span-12 m-2 shadow-xl">
                    @livewire('graficos.grafico-lineal')
                </div> --}}
                <!-- contenido -->
       
    </div>
</x-app-layout>