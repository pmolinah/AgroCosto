<div>

    <div class="space-y-2">
        <!-- Button trigger vertically centered modal-->
        <div class="grid sm:grid-cols-1 md:grid-cols-3 borde-neutral-800">
            <div class="mt-1">
                <button type="button" class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600"
                    data-te-toggle="modal" data-te-target="#exampleModalCenterEnvase">
                    Agregar Nuevo Envase
                </button>
            </div>
            <div class="">
                <h6 class="text-xl mt-3 mr-2 font-medium leading-tight">Filtrar</h6>
            </div>
            <div class="">
                <input type="text" wire:model="search" class="h-10 border mt-1 rounded px-4 py-2 w-full bg-gray-200"
                    id="exampleFormControlInput1" />
            </div>
        </div>


        <!--Verically centered modal-->
        <div data-te-modal-init
            class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
            data-te-backdrop="static" data-te-keyboard="false" id="exampleModalCenterEnvase" tabindex="-1"
            aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
            <div data-te-modal-dialog-ref
                class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                <div
                    class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none">
                    <div
                        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50 bg-neutral-200">
                        <!--Modal title-->
                        <h5 class="text-xl font-medium leading-normal bg-neutral-200">
                            Nueva Envase
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
                        Envase
                        <div class="relative mb-3">
                            <input type="text" wire:model.defer="envase"
                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />

                        </div>
                    </div>
                    <div class="relative p-4 text-left">
                        Capacidad
                        <div class="relative mb-3">
                            <input type="text" wire:model.defer="capacidad"
                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />

                        </div>
                    </div>
                    <div class="relative p-4 text-left">
                        Tara
                        <div class="relative mb-3">
                            <input type="text" wire:model.defer="tara"
                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />

                        </div>
                    </div>
                    <div class="relative p-4 text-left">
                        Observación
                        <div class="relative mb-3">
                            <textarea wire:model.defer="observacion" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" rows="3"></textarea>

                        </div>
                    </div>


                    <!--Modal footer-->
                    <div
                        class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                        <button type="button" wire:click="Limpiar" data-te-modal-dismiss
                            class="mr-3 inline-block bg-gray-700 text-white font-bold py-2 px-4 rounded hover:bg-gray-600">
                            Cerrar
                        </button>
                        <button type="button" wire:click="GuardarEnvase"
                            class="inline-block bg-gray-700 text-white font-bold py-2 px-4 rounded hover:bg-gray-600"
                            data-te-modal-dismiss>
                            Guardar Envase
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
                                    <th scope="col" class=" px-6 py-3">Envase</th>
                                    <th scope="col" class=" px-6 py-3">Tara</th>
                                    <th scope="col" class=" px-6 py-3">Capacidad</th>
                                    <th scope="col" class="hidden sm:hidden md:block xl:block px-6 py-3">Observacion
                                    </th>
                                    <th scope="col" class=" px-6 py-3">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($envases as $Envase)
                                    <tr class="border-b dark:border-neutral-500">

                                        <td class="whitespace-nowrap">{{ $Envase->envase }}</td>
                                        <td class="whitespace-nowrap">{{ $Envase->tara }}</td>
                                        <td class="whitespace-nowrap">{{ $Envase->capacidad }}</td>
                                        <td class="whitespace-nowrap hidden sm:hidden md:block xl:block  px-6 pt-5">
                                            {{ $Envase->observacion }}</td>

                                        <td class="whitespace-nowrap  px-6 py-4">
                                            <div class="inline-block">
                                                <center><button type="button"
                                                        wire:click="EliminarEnvase({{ $Envase->id }})"
                                                        class="mb-1 inline-block rounded bg-red-900 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i
                                                            class="far fa-trash-alt"></i></button>
                                                </center>
                                            </div>
                                            <div class="inline-block">
                                                <center><button type="button"
                                                        wire:click="EditarEnvase({{ $Envase }})"
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
                    {{ $envases->links() }}
                </div>
            </div>
        </div>
        <!--Modal title-->
        <x-modal wire:model="open_editEnvase" @click.away="false">
            <div class="bg-neutral-200">
                <h5 class="p-3 text-xl font-medium leading-normal text-neutral-800 text-left bg-neutral-300">
                    Edición de Envase
                </h5>
                <hr />
                <div class="text-left p-4">
                    Envase <input type="hidden" wire:model.defer="edit_idEnvase">
                    <div>
                        <input type="text" wire:model.defer="envase"
                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />

                    </div>
                </div>
                <div class="relative p-4 text-left">
                    Tara
                    <div>
                        <input type="text" wire:model.defer="tara"
                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                    </div>
                </div>
                <div class="relative p-4 text-left">
                    Capacidad
                    <div>
                        <input type="text" wire:model.defer="capacidad"
                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                    </div>
                </div>
                <div class="relative p-4 text-left">
                    Observación
                    <div>
                        <textarea wire:model.defer="observacion" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" rows="3"></textarea>

                    </div>
                </div>
                <div class="p-3">
                    <button type="button" wire:click="ActualizarEnvase"
                        class="bg-gray-700 text-white py-2 px-4 rounded hover:bg-gray-600" data-te-modal-dismiss>
                        Actualizar Envase
                    </button>
                    <button type="button" wire:click="Limpiar"
                        class="ml-1 inline-block rounded bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-300"
                        data-te-modal-dismiss>
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
