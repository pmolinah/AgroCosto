<div>
    <div class="grid sm:grid-cols-1 md:grid-cols-2">
        <div class="p-5 shadow-2xl ml-1 mr-5  border-dotted border-2 border-sky-500">
            {{-- inicio form --}}


            <div class="">
                <div class="border-b border-gray-900/10">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Asignación de Envases a Campos de Empresa</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Ingreso de Stock de Envases por tipo.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-3 sm:grid-cols-6">
                        <div class="col-span-6">
                            <label for="country"
                                class="block text-sm font-medium leading-6 text-gray-900">Empresa Principal.</label>
                            <div class="mt-2">
                               
                                    <h5 class="text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                        
                                        <select  id="empresa_id" name="empresa_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                    <option>Seleccione Propietario</option>
                                                @foreach ($empresas as $empresa)
                                                    <option class="text-neutral-900" value="{{ $empresa->id }}">
                                                        {{ $empresa->nombre }}</option>
                                                @endforeach
                                        </select>
                                    </h5>
                                 
                                
                            </div>
                        </div>
                        <div class="col-span-6">
                         <label for="country"
                                class="block text-sm font-medium leading-6 text-gray-900">Campo</label>
                            <select id="campo_id" name="campo_id" wire:model.defer="campo_id" wire:change="cambioCampo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            
                            </select>
                        </div>
                         <div class="sm:col-span-3">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Campo Seleccionado
                                </label>
                            <div class="mt-2">
                                <input type="text" name="first-name" wire:model.defer="campo_id_aux" 
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                                Inicial del Envase
                                name</label>
                            <div class="mt-2">
                                <input type="text" name="first-name" wire:model.defer="stock"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                                            
                    </div>
                </div>

            
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                {{-- <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button> --}}
                <button wire:click="agregarEnvase"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Agregar
                    Envases a Cuenta Corriente de la Empresa.</button>
            </div>


            {{-- fin form --}}


        </div>
        <div class="border-solid border-2 border-neutral-900 shadow-2xl">


            <table class="w-full text-center text-sm font-light">
                <thead
                    class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                    <tr>
                        
                        <th scope="col" class=" px-6 py-4">Campo</th>
                        <th scope="col" class=" px-6 py-4">Tipo Envase</th>
                        <th scope="col" class=" px-6 py-4">Stock</th>
                        <th scope="col" class=" px-6 py-4">Elimitar</th>
                        <th scope="col" class=" px-6 py-4">Editar</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($envase_campo as $envase_campos)
                        <tr class="border-b dark:border-neutral-500">
                            {{-- <td class="whitespace-nowrap  px-6 py-4 font-medium">{{ $cuentaenvase->id }}</td> --}}
                            <td class="whitespace-nowrap  px-6 py-4">{{ $envase_campos->campo->campo}}</td>
                            <td class="whitespace-nowrap  px-6 py-4">{{ $envase_campos->envase->envase }}</td>
                            <td class="whitespace-nowrap  px-6 py-4">{{ $envase_campos->stock }}</td>


                            <td class="whitespace-nowrap  px-6 py-4">
                                <center><button type="button" wire:click="EliminarCuentaEmpresa({{ $envase_campos->campo_id }},{{ $envase_campos->envase_id }})"
                                        class="mb-1 inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i
                                            class="far fa-trash-alt"></i></button>
                                </center>
                            </td>
                            <td class="whitespace-nowrap  px-6 py-4">
                                <center><button type="button" wire:click="EditarCuentaEmpresa({{ $envase_campos->campo_id }},{{ $envase_campos->envase_id }})"
                                        class="mb-1inline-block rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i
                                            class="far fa-edit"></i></button>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
               {{ $envase_campo->links() }}
        </div>
        <!--Modal edicion  title-->


        <x-modal wire:model="modal" @click.away="false">
          
                <h5
                    class=" p-3 text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200 dark:bg-info-900">

                    Edición de Cuenta de Envases Campo.
                    {{-- {{$especieDB}} --}}
                </h5>
                <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
                <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                    Empresa
                   
                     <input type="text"wire:model.defer="empresaNom" disabled
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>

                <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
                <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                    Envase
                     <input type="text" name="first-name" wire:model.defer="envaseNom" disabled
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>


                {{-- selct pluck --}}
               
                <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                    Saldo Inicial
                    <div class="relative mb-3" data-te-input-wrapper-init>
                        <input type="number" wire:model.defer="stock"
                            class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                    </div>
                </div>

               
                <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
                <div class="dark:bg-info-900 p-3">
                    <button type="button" wire:click="ActualizarCuentaEmpresa({{$caID}},{{$enID}})"
                        class="ml-1 inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                        data-te-ripple-init data-te-ripple-color="light" data-te-modal-dismiss>
                        Actualizar Stock envase del Campo,
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
                window.addEventListener('GuardarEmnvaseEmpresa', function(e) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito, Registro Guardado...',
                        text: '{{ Session::get('success') }}',
                        timer: 5000,
                        showConfirmButton: false
                    });
                });
                window.addEventListener('EliminarEmnvaseEmpresa', function(e) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Éxito, Registro Eliminado...',
                        text: '{{ Session::get('success') }}',
                        timer: 5000,
                        showConfirmButton: false
                    });
                });
                window.addEventListener('ActualizarEnvaseEmpresa', function(e) {
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
