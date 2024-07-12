<div>
     <div>
        {{-- caja creacion --}}

        <div class="space-y-2">
            <!-- Button trigger vertically centered modal-->
            <div class="grid sm:grid-cols-1 md:grid-cols-3 borde-neutral-800">
                <div class="">
                    <button type="button"
                        class="inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                        data-te-toggle="modal" data-te-target="#exampleModalCenterTarea" data-te-ripple-init
                        data-te-ripple-color="light">
                        Agregar Nueva Tarea
                    </button>
                </div>
                <div class="">
                    <h6 class="text-3xl  font-medium leading-tight">Buscar Tarea</h6>
                </div>
                <div class="">

                    <input type="text" wire:model="search"
                        class="  peer block min-h-[auto]  rounded bg-info-300 px-3 py-[0.32rem] leading-[1.6] transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]"
                        id="exampleFormControlInput1" />
                </div>
            </div>


            <!--Verically centered modal-->
            <div data-te-modal-init
                class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                data-te-backdrop="static" data-te-keyboard="false" id="exampleModalCenterTarea" tabindex="-1"
                aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                <div data-te-modal-dialog-ref
                    class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                    <div
                        class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-info-900">
                        <div
                            class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                            <!--Modal title-->
                            <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200">

                                Nueva Tarea
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
                        <div class="relative p-4 text-neutral-50">
                            Tarea
                            <div class="relative mb-3" data-te-input-wrapper-init>
                                <input type="text" wire:model.defer="Tarea"
                                    class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                            </div>
                        </div>
                         <div class="relative p-4 text-neutral-50">
                            Costo
                            <div class="relative mb-3" data-te-input-wrapper-init>
                                <input type="text" wire:model.defer="costo"
                                    class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                            </div>
                        </div>
                         {{-- <div class="relative p-4 text-neutral-50">
                            Unidad de Medida
                            <div class="relative mb-3" data-te-input-wrapper-init>
                                <input type="text" wire:model.defer="medida"
                                    class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                            </div>
                        </div>
                         <div class="relative p-4 text-neutral-50">
                            Contenido
                            <div class="relative mb-3" data-te-input-wrapper-init>
                                <input type="text" wire:model.defer="contenido"
                                    class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                            </div>
                        </div>
                         <div class="relative p-4 text-neutral-50">
                            Costo
                            <div class="relative mb-3" data-te-input-wrapper-init>
                                <input type="text" wire:model.defer="costo"
                                    class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                            </div>
                        </div>
                         <div class="relative p-4 text-neutral-50">
                            Tipo
                            <div class="relative mb-3" data-te-input-wrapper-init>
                                <input type="text" wire:model.defer="tipo"
                                    class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                            </div>
                        </div>

                        <div class="relative p-4 text-neutral-50">
                            <select wire:model.defer="proveedor_id"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                id="proveedor_id" name="proveedor_id">

                                <option class="text-neutral-900">Seleccione Proveedor</option>
                                @foreach ($empresas as $empresa)
                                    <option class="text-primary" value="{{ $empresa->id }}">
                                        {{ $empresa->nombre }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        {{-- <div class="relative p-4 text-neutral-900">
                            <select
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                id="campo_id" name="campo_id" wire:model.defer="campo_id">


                            </select>
                        </div> --}}
                        {{-- <div class="relative p-4 text-neutral-90">
                            <div class="bg-info-900 w-full">

                                <select
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                    wire:model.defer='encargado_id'>

                                    <option class="text-secondary" value=" ">Seleccione Encargado.</option>
                                    @foreach ($encargados as $encargado)
                                        <option class="text-primary" value="{{ $encargado->id }}">
                                            {{ $encargado->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="relative p-4 text-neutral-50">
                            Observación
                            <div class="relative mb-3" data-te-input-wrapper-init>
                                <textarea wire:model.defer="observacion"
                                    class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                    rows="3"></textarea>

                            </div>
                        </div>


                        <!--Modal footer-->
                        <div
                            class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                            <button type="button" wire:click="Limpiar"
                                class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                                data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                                Cerrar
                            </button>
                            <button type="button" wire:click="GuardarTarea"
                                class="ml-1 inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                data-te-ripple-init data-te-ripple-color="light" data-te-modal-dismiss>
                                Guardar Tarea
                            </button>
                        </div>
                    </div>
                </div>
            </div>



            {{-- tabla --}}
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-xl m-1">
                            <table class="min-w-full text-center text-sm font-light ">
                                <thead
                                    class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                                    <tr>

                                        <th scope="col" class=" px-6 py-4">Tarea</th>
                                        <th scope="col" class=" px-6 py-4">Costo</th>
                                  
                                        <th scope="col" class="hidden sm:hidden md:block xl:block px-6 py-4">   Observacion</th>
                                         
                                        <th scope="col" class=" px-6 py-4">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Tareas as $Tarea)
                                        <tr class="border-b dark:border-neutral-500">

                                            <td class="whitespace-nowrap">{{ $Tarea->tarea }}</td>
                                            <td class="whitespace-nowrap">{{ $Tarea->costo }}</td>
                                     
                                            <td
                                                class="whitespace-nowrap hidden sm:hidden md:block xl:block  px-6 py-11">
                                                {{ $Tarea->observacion }}</td>

                                            <td class="whitespace-nowrap  px-6 py-4">
                                                <center><button type="button"
                                                        wire:click="EliminarTarea({{ $Tarea->id }})"
                                                        class="mb-1 inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i
                                                            class="far fa-trash-alt"></i></button>
                                                </center>
                                                <center><button type="button"
                                                        wire:click="EditarTarea({{ $Tarea->id }})"
                                                        class="mb-1inline-block rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i
                                                            class="far fa-edit"></i></button>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $Tareas->links() }}
                    </div>
                </div>
            </div>
            <!--Modal title-->
            <x-modal wire:model="open_editTarea" >
                <h5
                    class=" p-3 text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200 dark:bg-info-900">

                    Edición de Tarea
                </h5>
                <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
                <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                    Tarea <input type="hidden" wire:model.defer="edit_idTarea">
                    <div class="relative mb-3" data-te-input-wrapper-init>
                        <input type="text" wire:model.defer="Tarea"
                            class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                    </div>
                </div>

                 <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                    Costo
                    <div class="relative mb-3" data-te-input-wrapper-init>
                        <input type="text" wire:model.defer="costo"
                            class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                    </div>
                </div>
              
                 <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                    Observacion 
                    <div class="relative mb-3" data-te-input-wrapper-init>
                        <input type="text" wire:model.defer="observacion"
                            class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                    </div>
                </div>


                <div class="relative p-4 bg-info-900">

                </div>

             
                <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
                <div class="dark:bg-info-900 p-3">
                    <button type="button" wire:click="ActualizarTarea"
                        class="ml-1 inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                        data-te-ripple-init data-te-ripple-color="light" data-te-modal-dismiss>
                        Actualizar Tarea
                    </button>
                    <button type="button" wire:click="Limpiar"
                        class="ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                        data-te-ripple-init data-te-ripple-color="light" data-te-modal-dismiss>
                        Cerrar
                    </button>
                </div>


            </x-modal>
            {{-- modal --}}

            <script>
                window.addEventListener('Guardar', function(e) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito, Registro Guardado...',
                        text: '{{ Session::get('success') }}',
                        timer: 5000,
                        showConfirmButton: false
                    });
                });
                window.addEventListener('Eliminar', function(e) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Éxito, Registro Eliminado...',
                        text: '{{ Session::get('success') }}',
                        timer: 5000,
                        showConfirmButton: false
                    });
                });
                window.addEventListener('Actualizar', function(e) {
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
</div>
