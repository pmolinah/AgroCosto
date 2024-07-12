<div>
    <div class="grid sm:grid-cols-1 md:grid-cols-2">
        <div class="p-5 shadow-2xl ml-1 mr-5  border-dotted border-2 border-sky-500">
            {{-- inicio form --}}
        <form action="{{route('cuentacorriente.store')}}" method="post">
        @CSRF
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Asignación de Envases a Exportadoras</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Ingreso de Stock de Envases por tipo.</p>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-6">
                            <label for="country"
                                class="block text-sm font-medium leading-6 text-gray-900">Exportadora.</label>
                            <div class="mt-2">
                                <select wire:model.defer="empresa_id" id="exportadora_id" name="exportadora_id"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option>Seleccione Exportadora</option>
                                    @foreach ($exportadoras as $exportadora)
                                        <option value="{{ $exportadora->id }}">{{ $exportadora->razon_social }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="country"
                                class="block text-sm font-medium leading-6 text-gray-900">Envase.</label>
                            <div class="mt-2">
                                <select id="country" name="envase_id" wire:model.defer="envase_id"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option>Seleccione Envase</option>
                                    @foreach ($envase as $envase)
                                        <option value="{{ $envase->id }}">{{ $envase->envase }}, Carga:
                                            {{ $envase->capacidad }}K, Tara: {{ $envase->tara }}K</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Saldo
                                Inicial del Envase y desgloce
                            </label>
                            <div class="mt-2 ">
                                <input type="text" name="saldo" wire:model.defer="saldo" id="saldoInicial" disabled
                                    class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="col-span-3">

                        </div>
                        {{-- desgloce envases --}}
                        <label for="first-name"
                            class="block text-sm font-medium leading-6 mt-1 text-gray-900">Cantidad</label>
                        <input type="text" id="cantidadColor"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <select id="color_id"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccionar Color</option>
                            @foreach ($colores as $color )
                                <option value="{{$color->id}}">{{$color->color}}</option>
                            @endforeach
                        <select>
                        <button id="btnsumarenvase"
                            class="rounded-md bg-indigo-600 w-full px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Agregar
                        </button>
                        <div class="col-span-6">
                         <table class="w-full text-center text-sm font-light" id="grillaColor">
                            <thead
                                class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                                <tr>
                                    <th scope="col" class=" px-2 py-2">Cantidad</th>
                                    <th scope="col" class=" px-2 py-2">Color</th>
                                    <td class="whitespace-nowrap  px-2 py-2">Quitar</td>
                                </tr>
                            </thead>
                            <tbody>
                                                                                              
                            </tbody>
                        </table>
                        </div>
                               {{-- fin desgloce --}}
                                <div class="col-span-full">
                                    <label for="about"
                                        class="block text-sm font-medium leading-6 text-gray-900">Observaciones</label>
                                    <div class="mt-2">
                                        <textarea id="about" name="observacion" rows="3" wire:model.defer="observacion"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                    <p class="mt-3 text-sm leading-6 text-gray-600">Máximo 100 Carácteres.
                                    </p>
                                </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                {{-- <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button> --}}
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Agregar
                    Envases a Cuenta Corriente de la EXportadora.</button>
            </div>
            {{-- fin form --}}
        </div>
        <div class="border-solid border-2 border-neutral-900 shadow-2xl">
            <table class="w-full text-center text-sm font-light">
                <thead
                    class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                    <tr>
                        {{-- <th scope="col" class=" px-6 py-4">Id</th> --}}
                        <th scope="col" class=" px-6 py-4">Exportadora</th>
                        <th scope="col" class=" px-6 py-4">Tipo Envase</th>
                        <th scope="col" class=" px-6 py-4">Stock</th>
                        <th scope="col" class=" px-6 py-4">Elimitar</th>
                        <th scope="col" class=" px-6 py-4">Editar</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($cuentaenvases as $cuentaenvase)
                        <tr class="border-b dark:border-neutral-500">
                            {{-- <td class="whitespace-nowrap  px-6 py-4 font-medium">{{ $cuentaenvase->id }}</td> --}}
                            <td class="whitespace-nowrap  px-6 py-4">{{ $cuentaenvase->empresa->razon_social }}</td>
                            <td class="whitespace-nowrap  px-6 py-4">{{ $cuentaenvase->envase->envase }}</td>
                            <td class="whitespace-nowrap  px-6 py-4">{{ $cuentaenvase->saldo }}</td>


                            <td class="whitespace-nowrap  px-6 py-4">
                                <center><button type="button" wire:click="EliminarCuenta({{ $cuentaenvase->id }})"
                                        class="mb-1 inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i
                                            class="far fa-trash-alt"></i></button>
                                </center>
                            </td>
                            <td class="whitespace-nowrap  px-6 py-4">
                                <center><button type="button" wire:click="EditarCuenta({{ $cuentaenvase->id }})"
                                        class="mb-1inline-block rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i
                                            class="far fa-edit"></i></button>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!--Modal edicion  title-->


        <x-modal wire:model="modal" @click.away="false">

            <h5 class=" p-3 text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200 dark:bg-info-900">

                Edición de Cuenta de Envases
                {{-- {{$especieDB}} --}}
            </h5>
            <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
            <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                Exportadora

                <select data-te-select-init data-te-select-filter="true"
                    class="text-neutral-900 text-neutral-900 w-full block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6""
                    wire:model.defer="exportadora_id">


                    @foreach ($exportadoras as $exportadora)
                        <option value="{{ $exportadora->id }}">{{ $exportadora->razon_social }}</option>
                    @endforeach

                </select>
            </div>

            <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
            <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                Envases
                <select data-te-select-init data-te-select-filter="true"
                    class="text-neutral-900 text-neutral-900 w-full block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6""
                    wire:model.defer="envaseID">
                    <option value="{{ $envaseID }}">{{ $envaseNombre }}</option>

                    @foreach ($envEdit as $envases)
                        @if ($envases->id != $envase->envaseID)
                            <option value="{{ $envases->id }}">{{ $envases->envase }}</option>
                        @endif
                    @endforeach

                </select>
            </div>
        </form>

            {{-- selct pluck --}}

            <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                Saldo
                <div class="relative mb-3" data-te-input-wrapper-init>
                    <input type="number" wire:model.defer="saldo"
                        class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                </div>
            </div>

            <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                Observación
                <div class="relative mb-3" data-te-input-wrapper-init>
                    <textarea wire:model.defer="observacion"
                        class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        rows="3"></textarea>

                </div>
            </div>
            <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
            <div class="dark:bg-info-900 p-3">
                <button type="button" wire:click="ActualizarCuenta({{ $cuentaID }})"
                    class="ml-1 inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                    data-te-ripple-init data-te-ripple-color="light" data-te-modal-dismiss>
                    Actualizar Cuenta de Envases,
                </button>
                <button type="button" wire:click="Limpiar"
                    class="ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                    data-te-ripple-init data-te-ripple-color="light" data-te-modal-dismiss>
                    Cerrar
                </button>

            </div>


        </x-modal>
        {{-- modal edicion --}}
    </div>
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
        window.addEventListener('EliminarCuenta', function(e) {
            Swal.fire({
                icon: 'warning',
                title: 'Éxito, Registro Eliminado...',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('ActualizarCuenta', function(e) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito, Registro Actualizado...',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
    </script>
</div>
