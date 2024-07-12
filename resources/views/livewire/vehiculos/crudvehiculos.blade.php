<div>
    <button type="button" wire:click="nuevoVehiculo"
        class="bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600">
        Nuevo Vehículos
    </button>

    <!-- tabla Usuarios -->
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b bg-neutral-400">
                            <tr class="font-light">
                                <th scope="col" class="px-6 py-4">
                                    <p class="text-neutral-800">#</p>
                                </th>
                                <th scope="col" class="px-6 py-4">Empresa.</th>
                                <th scope="col" class="px-6 py-4">Patente</th>
                                <th scope="col" class="px-6 py-4">Conductor</th>
                                <th scope="col" class="px-6 py-4">Editar</th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-200">
                                @foreach ($vehiculos as $vehiculo)
                                    <td class="whitespace-nowrap px-6 py-4">{{ $vehiculo->id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        {{ $vehiculo->empresa_id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $vehiculo->patente }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        {{ $vehiculo->conductor_id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <button type="button"
                                            class="inline-block rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#e4a11b] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(228,161,27,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)]">
                                            <a href="" class="btn btn-sm btn-warning"><i
                                                    class="fas fa-edit"></i>Editar </a>
                                        </button>
                                @endforeach
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- tabla usuarios -->
</div>
</div>


<x-modal wire:model="open_modal">
    <!--Modal body-->
    <h5 class="text-xl font-medium leading-normal text-neutral-800 ">
        Ingreso de Vehículos
    </h5>
    <div class="grid grid-cols-8 p-3">
        <div class="col-span-8 ml-2">
            <label>Patente, sin puntos ni guión</label>
        </div>
        <div class="col-span-8 ml-2">
            <input type="text" class="border-dotted border-2 border-sky-500" wire:model="patente">
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
        <div class="col-span-8 ml-2">
            <label>Marca</label>
        </div>
        <div class="col-span-8 ml-2">
            <input type="text" class=" w-full mr-5 border-dotted border-2 border-sky-500" wire:model.defer="marca">
        </div>
        <div class="col-span-8 ml-2">
            <label>Año</label>
        </div>
        <div class="col-span-8 ml-2">
            <input type="text" class="mr-5 border-dotted border-2 border-sky-500" wire:model.defer="anio">
        </div>
        <div class="col-span-8 ml-2">
            <label>Color</label>
        </div>
        <div class="col-span-8 ml-2">
            <input type="text" class=" w-full mr-5 border-dotted border-2 border-sky-500" wire:model.defer="color">
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

    <button type="button"
        class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
        data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
        Cerrar
    </button>
    <button type="button" wire:click="SaveVehiculo"
        class="ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
        Guardar Vehículo
    </button>

    <button type="button" wire:click="Limpiar"
        class="ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
        Cerrar
    </button>
</x-modal>
</div>
