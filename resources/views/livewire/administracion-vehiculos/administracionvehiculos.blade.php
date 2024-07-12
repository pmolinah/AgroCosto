<div>
    <button type="button" wire:click="IngresarVehiculo"
        class="mt-20 bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600">
        Nuevo Vehículo
    </button>

    <!-- tabla Usuarios -->
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 rounded-lg">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8 rounded-lg">
                <div class="overflow-hidden rounded-lg">
                    <table class="min-w-full text-left text-sm font-light rounded-lg">
                        <thead class="border-b bg-neutral-400">
                            <tr class="font-light">

                                <th scope="col" class="px-6 py-2">Empresa</th>
                                <th scope="col" class="px-6 py-2">Patente</th>
                                <th scope="col" class="px-6 py-2">Conductor</th>
                                <th scope="col" class="px-6 py-2">Editar</th>
                                <th scope="col" class="px-6 py-2">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($vehiculos as $vehiculo)
                                <tr class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-200">
                                    <td class="whitespace-nowrap px-6 py-2">{{ $vehiculo->empresa->razon_social }} </td>
                                    <td class="whitespace-nowrap px-6 py-2">{{ $vehiculo->patente }} </td>
                                    <td class="whitespace-nowrap px-6 py-2"> {{ $vehiculo->conductor->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-2">
                                        <button type="button" wire:click="MostrarActualizar({{ $vehiculo->id }})"
                                            class="inline-block rounded bg-warning-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#e4a11b] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(228,161,27,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)]">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2">
                                        <button type="button" wire:click="EliminarRegistro({{ $vehiculo->id }})"
                                            class="inline-block rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#e4a11b] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(228,161,27,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)]">
                                            <i class="fas fa-trash"></i>

                                        </button>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- tabla usuarios -->
    <x-modal wire:model="open_modal">
        <!--Modal body-->
        <div class="text-left grid grid-cols-8 p-3">
            <div class="col-span-8 ml-2 mb-2">
                <h5 class="text-xl font-medium leading-normal text-neutral-800 ">
                    Ingreso de Vehículos
                </h5>
            </div>
            <div class="col-span-8 ml-2">
                <label>Patente, sin puntos ni guión</label>
            </div>
            <div class="col-span-8 ml-2">
                <input type="text" class="w-24 border-dotted border-2 border-sky-500" wire:model.defer="patente">

            </div>
            <div class="col-span-8 ml-2">
                <label>Empresa</label>
            </div>
            <div class="col-span-8 ml-2">
                <select wire:model.defer="empresa_id"
                    class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option></option>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-8 ml-2">
                <label>Conductor</label>
            </div>
            <div class="col-span-8 ml-2">
                <select wire:model.defer="conductor_id"
                    class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option></option>
                    @foreach ($conductores as $conductor)
                        <option value="{{ $conductor->id }}">{{ $conductor->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" wire:model.defer="vehID">
            <div class="col-span-8 ml-2">
                <label>Marca</label>
            </div>
            <div class="col-span-5 ml-2">
                <input type="text" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50  mr-5"
                    wire:model.defer="marca">
            </div>
            <div class="col-span-7 ml-2">
                <label>Año</label>
            </div>
            <div class="col-span-2 ml-2">
                <input type="text" class="w-24 mr-5 h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                    wire:model.defer="anio">
            </div>
            <div class="col-span-8 ml-2">
                <label>Color</label>
            </div>
            <div class="col-span-2 ml-2">
                <input type="text" class=" mr-5 h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                    wire:model.defer="color">
            </div>
            <div class="col-span-8 ml-2">
                <label>Tipo Vehívulo</label>
            </div>
            <div class="col-span-8 ml-2">
                <select wire:model.defer="tipovehiculo_id"
                    class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option value=""></option>
                    <option value="1">Automovil</option>
                    <option value="2">Camión</option>
                    <option value="3">Carro</option>
                    <option value="4">Rampla</option>
                </select>
            </div>

            <div class="col-span-8  ml-2 shadow-2xl">
                <label>Observación</label>
                <textarea wire:model.defer="observacion" rows="3"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>

        </div>
        <div class="m-3">
            @if ($btnGuardar)
                <button type="button" wire:click="SaveVehiculo"
                    class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600">
                    Guardar Vehículo
                </button>
            @endif
            @if ($btnActualizar)
                <button type="button" wire:click="ActualizarVehiculo"
                    class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600">
                    Actualizar Vehiculo
                </button>
            @endif
            <button type="button" wire:click="$set('open_modal',false)"
                class="bg-gray-900 text-white  py-2 px-4  rounded hover:bg-gray-500">
                Cerrar
            </button>
        </div>

    </x-modal>
</div>
