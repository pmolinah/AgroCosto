<div>
    <div class="grid sm:grid-cols-1 md:grid-cols-12 gap-5 mt-10 mb-20">
        <div class="p-5 mt-5 rounded-lg bg-white col-span-6 grid grid-cols-12 shadow-lg">
            <div class="text-left col-span-12">
                Cuartel
            </div>
            <div class="col-span-12">
                <input type="text" wire:model.defer="observaciones"
                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
            </div>
            <div class="text-left col-span-12">
                Código SAG
            </div>
            <div class="col-span-6">
                <input type="text" wire:model.defer="codigoSag"
                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
            </div>
            <div class="text-left col-span-12">
                Empresa
            </div>
            <div class="text-left col-span-12 h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                <select class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" 
                    id="empresa_id" name="empresa_id">
                    <option>Seleccione Propietario</option>
                    @foreach ($empresas as $empresa)
                        <option class="text-primary" value="{{ $empresa->id }}">
                            Rut:{{ $empresa->rut }},Razón Social:{{ $empresa->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-left col-span-12">
                Campo
            </div>
            <div class="col-span-12 h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                <select
                    class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent"
                    id="campo_id" name="campo_id" wire:model.defer="campo_id">
                    <option>Seleccionar Campo
                </select>
            </div>
            <div class="text-left col-span-12">
                Capataz
            </div>
            <div class="col-span-12 h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                <select
                    class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent"
                    wire:model.defer='capataz_id'>
                    <option value=" ">Seleccione Capataz.</option>
                    @foreach ($capataz as $capataz)
                        <option value="{{ $capataz->id }}">{{ $capataz->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-left col-span-12">
                Superficie en Hectáreas
            </div>
            <div class="col-span-3">
                    <input type="number" wire:model.defer="superficie"
                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
            </div>
            <div class="col-span-12 mt-5">
                <button type="button" wire:click="GuardarCuartel"
                    class="bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600">
                    Guardar Cuartel
                </button>
            </div>
        </div>




        <!--Modal title-->
    <x-modal wire:model="open_editCuartel">
        <div class="text-left grid grid-cols-12 p-5">
            <div class="col-span-12">
                Edición de Cuartel {{$cuartel_id}}
            <hr/>
            </div>
            <input type="hidden" wire:model.defer="cuartel_id">
            <div class="col-span-12 mt-3">
                Cuartel 
            </div>
            <div class="col-span-12">
                <input type="text" wire:model.defer="observaciones"
                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />

            </div>
            <div class="col-span-12">
                Código SAG
            </div>
            <div class="col-span-5">
                <input type="text" wire:model.defer="codigoSag"
                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
            </div>
            <div class="col-span-12">
                Capataz Actual
            </div>
            <div class="col-span-12 h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                <select wire:model.defer="capatazID"
                    class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent">
                        <option value="{{ $capatazID }}">{{ $capatazNombre }} , {{ $capatazID }}  </option>
                    @foreach ($capatazEncargado as $capatazEncargado)
                        <option  value="{{ $capatazEncargado->id }}">{{ $capatazEncargado->name }} ,{{ $capatazEncargado->id }},{{$capataz_id}}</option>
                        
                    @endforeach
                </select>
            </div>
            <div class="col-span-12">
                Campo Actual
            </div>
            <div class="col-span-12 h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                <select wire:model.defer="campoID"
                    class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent">
                    <option value="{{ $campoID }}">{{ $campoNombre }}  , {{ $campoID }} </option>
                    @foreach ($campos as $campo)
                        <option  value="{{ $campo->id }}">{{ $campo->campo }}   </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12">
                superficie 
            </div>
            <div class="col-span-3">
                <input type="text" wire:model.defer="superficie"
                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
            </div>
            

            <div class="col-span-12 mt-3">
            <hr/>
                <button type="button" wire:click="ActualizarCuartel({{ $cuartel_id }})"
                    class="mt-3 bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600">
                    
                    Actualizar Cuartel
                </button>
            </div>
        </div>
    </x-modal>



        <div class="col-span-6 grid grid-cols-12 bg-white mt-5 p-3 rounded-lg shadow-lg">
            <div class="text-left col-span-12 mb-3">
                
                <div class="w-44 inline-block h-10 bg-gray-50 border border-gray-200 rounded items-center mt-1 p-1">
                    <select wire:model.defer="empresaID" wire:change="SeleccionEmpresa" class="px-4 appearance-none outline-none text-gray-800 bg-transparent">
                        <option>Seleccione Empresa</option>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}</option>
                        @endforeach
                    <select>
                </div>

                <div class="w-44 inline-block h-10 bg-gray-50 border border-gray-200 rounded items-center mt-1 p-1">
                    <select wire:model.defer="campoID" wire:change="SeleccionCampo" class="px-4 appearance-none outline-none text-gray-800  bg-transparent">
                        <option>Seleccione Campo</option>
                        @foreach ($campos as $campo)
                            <option value="{{ $campo->id }}">{{ $campo->campo }}</option>
                        @endforeach
                    <select>
                </div>
                <table class="items-center  w-full mt-3  border border-gray-300">
                    <thead class="bg-neutral-200">
                        <tr> 
                            {{-- <th class="p-2 border border-gray-400">Propietario</th> --}}
                            <th class="p-2 border border-gray-400">Campo</th>
                            <th class="p-2  border border-gray-400">Cuartel</th>
                            {{-- <th class="p-2 border border-gray-400">Capataz</th> --}}
                            <th class="p-2 border border-gray-400">Superficie</th>
                            {{-- <th class="p-2 border border-gray-400">Certificado</th> --}}
                            <th class="p-2 text-center border border-gray-400">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="border  border-gray-200">
                        @foreach ($cuarteles as $cuartel)
                            <tr class="bg-primary-50 p-2 rounded hover:bg-sky-100 rounded-lg mb-2 mt-0 text-base font-medium leading-tight text-primary shadow-md ">
                                <input type="hidden" wire:model.defer="campoID" value="{{ $cuartel->campo_id}}">
                                {{-- <td class="p-2 border border-gray-400 ">{{ $cuartel->campo->empresa->razon_social }} --}}
                                <td class="p-2 border border-gray-400 ">{{ $cuartel->campo->campo }}</td>
                                <td class="p-2 border border-gray-400 "> {{ $cuartel->observaciones }}</td>
                                {{-- <td class="p-2 border border-gray-400 ">{{ $cuartel->capataz->name }}- --}}
                                <td class="p-2 border border-gray-400 ">{{ $cuartel->superficie }}</td>
                                {{-- <td class="p-2 border border-gray-400 ">{{ $cuartel->certificado }} --}}
                                <td class="p-2 border border-gray-400 ">
                                    <div class="grid grid-cols-2 text-center ">
                                        <div class="text-danger-900"><button type="button" wire:click="EliminarCuartel({{ $cuartel->id }})"
                                                class="inline-block rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                                <i class="fa-solid fa-trash"></i>
                                            </button></div>
                                        <div class="text-danger-900"><button type="button" wire:click="EditarCuartel({{$cuartel->id}})"
                                                class="bg-gray-700 text-white  py-2 px-4  rounded hover:bg-gray-600">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    <script>
        window.addEventListener('GuardarCuartel', function(e) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito, Registro Guardado...',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('EliminarCuartel', function(e) {
            Swal.fire({
                icon: 'warning',
                title: 'Éxito, Registro Eliminado...',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('ActualizarCuartel', function(e) {
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
