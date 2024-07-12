<x-dashBoard>
    <div class="grid grid-cols-12 gap-1 p-5 mb-5 overflow-hidden sm:rounded-lg">
       
        <div class="col-span-8 grid grid-cols-12">
            <div class="col-span-6 m-1 bg-white rounded-lg shadow-lg shadow-neutral-800">
                @livewire('graficos.apex-barra-apilada')
            </div>
            <div class="col-span-6 m-1 bg-white rounded-lg shadow-lg shadow-neutral-800">
                @livewire('graficos.grafico-lineal')
            </div>

            <div class="col-span-6 m-1 bg-white rounded-lg shadow-lg shadow-neutral-800">
                @livewire('graficos.grafico-envase-bar')
            </div>  {{--@livewire('graficos.graficos') --}}

             <div class="col-span-6 m-1 bg-white rounded-lg shadow-lg shadow-neutral-800">
                @livewire('graficos.grafico-envase-bar-campo')
            </div>{{-- @livewire('graficos.grafico-radial')
            <div class="col-span-3 m-1 bg-white rounded-lg shadow-lg shadow-neutral-800">
                @livewire('graficos.grafico-torta')
            </div>
            <div class="col-span-3 m-1 bg-white rounded-lg shadow-lg shadow-neutral-800">
                @livewire('graficos.apex-torta')
            </div> --}}
        </div>
        
        <div class="col-span-4">
            @livewire('graficos.especie-xanio')
        </div>
    </div>
</x-dashBoard>
