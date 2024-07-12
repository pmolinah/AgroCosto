<div>
    {{-- caja creacion --}}
 
    <div class="space-y-2">
        <!-- Button trigger vertically centered modal-->
        <div class="grid sm:grid-cols-1 md:grid-cols-3 borde-neutral-800">
            <div class="mt-1">
                <button type="button"
                    class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600"
                    data-te-toggle="modal" data-te-target="#exampleModalCenterEspecie">
                    Agregar Nueva Especie
                </button>
            </div>
            <div class="">
                <h6 class="text-xl mt-3 mr-2 font-medium leading-tight">Filtrar</h6>
            </div>
            <div class="">
                <input type="text" wire:model="search"
                    class="h-10 border mt-1 rounded px-4 py-2 w-full bg-gray-200"
                    id="exampleFormControlInput1" />
            </div>
        </div>


        <!--Verically centered modal-->
        <div data-te-modal-init
            class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
            data-te-backdrop="static" data-te-keyboard="false" id="exampleModalCenterEspecie" tabindex="-1"
            aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
            <div data-te-modal-dialog-ref
                class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                <div
                    class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none bg-neutral-200">
                    <div
                        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-2 dark:border-opacity-50 bg-neutral-200">
                        <!--Modal title-->
                        <h5 class="text-xl font-medium leading-normal ">
                            Nueva Especie
                        </h5>
                        <!--Close button-->
                        <button type="button"
                            class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                            data-te-modal-dismiss aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!--Modal body-->
                    <div class="relative p-4 text-left">
                        Especie
                        <div class="relative mb-1" >
                            <input type="text" wire:model.defer="especie"
                                class="h-10 border mt-1 rounded px-4 py-2 w-full bg-gray-200" />

                        </div>
                    </div>
                    <div class="relative p-4 text-left">
                        Seleccione Variedad
                        {{-- select --}}
                        <select  wire:model.defer="variedad_id" class="text-neutral-900 w-full block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value=""> </option>
                            @foreach ($variedades as $variedad)
                                <option value="{{ $variedad->id }}">{{ $variedad->variedad }}</option>
                            @endforeach
                        </select>
                        {{-- select --}}
                    </div>
                    <div class="relative p-4 text-left">
                        Fecha de Cosecha de la Especie
                        <div class="relative mb-3" >
                            <input type="date" wire:model.defer="fechaCosecha"
                                class="h-10 border mt-1 rounded px-4 py-2 w-full bg-gray-200" />

                        </div>
                    </div>
                    <div class="grid sm:grid-cols-1 md:grid-cols-3">
                        <div class="mt-11 ml-4">Distancia Plantación</div>
                        <div class="relative p-4 text-center">
                        Sobre Hilera
                            <div class="relative mb-3" t>
                                <input type="text" wire:model.defer="metros2"
                                    class="h-10 border mt-1 rounded px-4 py-2 w-full bg-gray-200" />
                            </div>
                        </div>
                        <div class="relative p-4 text-center">
                        Entre Hilera
                            <div class="relative mb-3" >
                                <input type="text" wire:model.defer="distanciaPlanta"
                                    class="h-10 border mt-1 rounded px-4 py-2 w-full bg-gray-200" />
                            </div>
                        </div>
                    </div>
                           
                           

                    <div class="relative p-4 text-left">
                        Observación
                        <div class="relative mb-3">
                            <textarea wire:model.defer="observacion"
                                class="h-10 border mt-1 rounded px-4 py-2 w-full bg-gray-200"
                                rows="3"></textarea>

                        </div>
                    </div>


                    <!--Modal footer-->
                    <div
                        class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                        <button type="button" wire:click="Limpiar"
                            class="inline-block bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-600"
                            data-te-modal-dismiss >
                            Cerrar
                        </button>
                        <button type="button" wire:click="GuardarEspecie"
                            class="inline-block bg-gray-700 text-white font-bold py-2 px-4 rounded hover:bg-gray-600 ml-3"
                             data-te-modal-dismiss>
                            Guardar Especie
                        </button>
                    </div>
                </div>
            </div>
        </div>



        {{-- tabla --}}
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-xl m-1 bg-neutral-100 rounded-lg">
                        <table class="min-w-full text-center text-sm font-light ">
                            <thead
                                class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-600">
                                <tr>

                                    <th scope="col" class=" px-6 py-3">Especie</th>
                                    <th scope="col" class=" px-6 py-3">Variedad</th>
                                    <th scope="col" class="hidden sm:hidden md:block xl:block px-6 py-3">Observacion
                                    </th>
                                    <th scope="col" class=" px-6 py-3">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($especies as $especie)
                                    <tr class="border-b dark:border-neutral-500">

                                        <td class="whitespace-nowrap">{{ $especie->especie }}</td>
                                        <td class="whitespace-nowrap">{{ $especie->variedad->variedad }}</td>
                                        <td class="whitespace-nowrap hidden sm:hidden md:block xl:block  px-6 py-3 pt-7">
                                            {{ $especie->observacion }}</td>
                                        <td class="whitespace-nowrap  px-6 py-4">
                                            <div class="inline-block">
                                                <center><button type="button"
                                                        wire:click="EliminarEspecie({{ $especie->id }})"
                                                        class="mb-1 inline-block rounded bg-red-900 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i
                                                            class="far fa-trash-alt"></i></button>
                                                </center>
                                            </div>
                                            <div class="inline-block">
                                                <center><button type="button"
                                                        wire:click="EditarEspecie({{ $especie }})"
                                                        class="mb-1inline-block rounded bg-yellow-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i
                                                            class="far fa-edit"></i></button>
                                                </center>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $especies->links() }}
                
                </div>
            </div>
        </div>
        <!--Modal edicion  title-->
          
            
        <x-modal wire:model="open_edit_especie" @click.away="false">
            @foreach ($especieDB as $especieDB)
                <h5
                    class=" p-3 text-left font-medium leading-normal bg-neutral-200">

                    Edición de Especie 
                    {{-- {{$especieDB}} --}}
                </h5>
                <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
                <div class="relative p-4 text-left">
                    Especie <input type="hidden" wire:model.defer="edit_id">
                    <div class="relative" >
                        <input type="text" wire:model.defer="especie" value="{{$especie}}"
                            class="h-10 border mt-1 rounded px-4 py-2 w-full bg-gray-200" />

                    </div>
                </div>
                <div class="relative p-4 text-left">
                    Variedad
                    <select data-te-select-init data-te-select-filter="true" class="text-neutral-900 text-neutral-900 w-full block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"" wire:model.defer="variedad_id">
                        <option value="{{$especieDB->variedad_id}}">{{$especieDB->variedad->variedad}}</option>
                    @if(isset($variedades_especie))
                        @foreach ($variedades_especie as $variedades_especie)
                            @if($variedades_especie->id != $especieDB->variedad_id)
                                <option value="{{$variedades_especie->id}}">{{$variedades_especie->variedad}}</option>
                            @endif
                        @endforeach
                    @endif
                    </select>
                </div>
           

            {{-- selct pluck --}}
             <div data-te-select-init class="text-left grid sm:grid-cols-1 md:grid-cols-3">
                <div class="mt-11 ml-4">Distancia Plantación</div>
                 <div class="relative p-4 text-center">
                        Metros
                            <div class="relative mb-3" data-te-input-wrapper-init>
                                <input type="text" wire:model.defer="metros2"
                                    class="h-10 border mt-1 rounded px-4 py-2 w-full bg-gray-200" />
                            </div>
                        </div>
                        <div class="relative p-4  text-center">
                        Metros
                            <div class="relative mb-3" data-te-input-wrapper-init>
                                <input type="text" wire:model.defer="distanciaPlanta"
                                    class="h-10 border mt-1 rounded px-4 py-2 w-full bg-gray-200" />
                            </div>
                        </div>
             </div>
            
             <div class="relative p-4 text-left">
                Fecha Cosecha
                <div class="relative mb-3" data-te-input-wrapper-init>
                    <input type="date" wire:model.defer="fechaCosecha" 
                        class="h-10 border mt-1 rounded px-4 py-2 w-full bg-gray-200" />

                </div>
            </div>

            <div class="relative p-4 text-left">
                Observación
                <div class="relative mb-3" data-te-input-wrapper-init>
                    <textarea wire:model.defer="observacion" 
                        class="h-10 border mt-1 rounded px-4 py-2 w-full bg-gray-200"
                        rows="3"></textarea>

                </div>
            </div>
            <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
            <div class=" p-3">
                <button type="button" wire:click="ActualizarEspecie"
                    class="inline-block bg-gray-700 text-white font-bold ml-2 py-2 px-4 rounded hover:bg-gray-600"
                    data-te-ripple-init data-te-ripple-color="light" data-te-modal-dismiss>
                    Actualizar Especie
                </button>
                <button type="button" wire:click="Limpiar"
                    class="inline-block bg-gray-500 text-white font-bold ml-2 py-2 px-4 rounded hover:bg-gray-600 mr-3"
                    data-te-ripple-init data-te-ripple-color="light" data-te-modal-dismiss>
                    Cerrar
                </button>
              
            </div>
         @endforeach

        </x-modal>
        {{-- modal edicion --}}

        <script>
            window.addEventListener('GuardarEspecie', function(e) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito, Registro Guardado...',
                    text: '{{ Session::get('success') }}',
                    timer: 5000,
                    showConfirmButton: false
                });
            });
            window.addEventListener('EliminarEspecie', function(e) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Éxito, Registro Eliminado...',
                    text: '{{ Session::get('success') }}',
                    timer: 5000,
                    showConfirmButton: false
                });
            });
            window.addEventListener('ActualizarEspecie', function(e) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito, Registro Actualizado...',
                    text: '{{ Session::get('success') }}',
                    timer: 5000,
                    showConfirmButton: false
                });
            });
        </script>
        {{-- fin caja --}}
    </div>
</div>
