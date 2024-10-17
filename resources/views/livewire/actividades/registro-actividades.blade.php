<div>
    <div class="w-full rounded-xl border border-gray-200 bg-white py-2 px-2 shadow-md shadow-neutral-800">
        <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
            <div>Lista de Actividades Vigentes Iniciadas<select wire:model.defer="SelecActividad_id"
                    wire:change="SeleccionActividad_id"
                    class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option></option>
                    @foreach( $actividades as $actividad)
                    <option value="{{$actividad->id}}">{{$actividad->observacion}}-{{$actividad->id}}</option>
                    @endforeach
                </select></div>
            <div class="col-span-6 p-2 ml-4 mt-2">

            </div>
        </div>
        <div class="mt-2">
            <div class="flex max-h-[600px] w-full flex-col overflow-y-scroll">
                {{-- inicio guia --}}
                <div
                    class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 shadow-2xl mb-1  border-2 border-gray-400 m-2">
                    <div class="col-span-1 font-bold p-2 mt-5 text-gray-900">
                        Actividad
                    </div>
                    <div class="col-span-3 p-2 mt-2 text-center ">
                        <input type="text" wire:model="observacion"
                            class="text-gray-700 h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                    </div>

                    <div class="col-span-1 p-2 mt-5 ml-2 text-gray-700">
                        Inicio
                    </div>
                    <div class="text-center col-span-2 p-2 mt-2 ">
                        <input type="date" wire:model.defer="fechai"
                            class="text-gray-700 h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                    </div>
                    <div class="col-span-1 p-2 mt-5 text-gray-700">
                        Termino
                    </div>
                    <div class="text-center col-span-2 p-2 mt-2 ">
                        <input type="date" wire:model.defer="fechat"
                            class="text-gray-700 h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                    </div>
                    <div class="text-center col-span-1 p-2 mt-3">
                        <button type="button" wire:click="generarActividad"
                            class="bg-green-700 text-white  py-2 px-4 rounded hover:bg-gray-600" @if($deshabilitarBoton)
                            disabled @endif>
                            Iniciar
                        </button>
                    </div>
                    <div class="text-center col-span-1 p-2 mt-3">
                        <button type="button" wire:click="limpiarFormulario"
                            class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600">
                            Nueva
                        </button>
                    </div>
                    <!-- <div class="col-span-3 p-2 ml-4 mt-2">
                        <select wire:model.defer="campo_id" wire:change="SeleccionCampo_id"
                            class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccionar Campo</option>
                          
                                <option value=""></option>
                           
                        </select>
                    </div> -->
                    <!-- <div class="col-span-3 p-2 ml-4 mt-2">
                        <select wire:model.defer="exportadora_id" wire:change="SeleccionExportadora_id"
                            class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccionar Empresa Exportadora</option>
                       
                                <option value=""></option>
                       
                        </select>
                    </div> -->

                </div>
                <!-- <hr class="my-2 h-0 border border-t-0 border-solid border-neutral-700 opacity-25 dark:border-neutral-200" /> -->


                <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 shadow-2xl p-3 mb-2">
                    <div class="col-span-1 font-bold text-primary-800 ">
                        Actividad N°.:
                    </div>
                    <div class="col-span-1 text-center font-bold text-primary-800 ">
                        <input type="text" class="text-right w-24" disabled value="{{$actividad_id}}">
                    </div>
                    <!-- <div class="col-span-2  ">
                        <label class="p-1 font-medium">Tipo Costo</label>
                    </div>
                    <div class="col-span-3 ">
                        <select wire:model.defer="tipocosto_id"
                            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Costo</option>
                            @foreach($tipoCosto as $tipocosto)
                            <option value="{{$tipocosto->id}}">{{$tipocosto->costo}}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <div class="col-span-2  ">
                        <label class="p-1 font-medium">Ejecutada:</label>
                    </div>
                    <div class="col-span-3 ">
                        <select wire:model.defer="ejecutor_id"
                            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccionar Empresa</option>
                            @foreach($empresas as $empresa)
                            <option value="{{$empresa->id}}">{{$empresa->razon_social}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-4">
                    </div>
                </div>
                <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 shadow-2xl p-2 mb-2">
                    <div class="col-span-12 text-center m-2 font-bold">Lugar de la Actividad</div>
                    <div class="col-span-4">
                        <select wire:model.defer="propietario_id" wire:change="SeleccionPropietario_id"
                            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Propietario</option>
                            @foreach($propietarios as $propietario)
                            <option value="{{$propietario->id}}">{{$propietario->razon_social}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-4">
                        <select wire:model.defer="campo_id" wire:change="SeleccionCampo_id"
                            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccionar Campo</option>
                            @foreach($campos as $campo)
                            <option value="{{$campo->id}}">{{$campo->campo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-4">
                        <select wire:model.defer="cuartel_id" wire:change="SeleccionCuartel_id"
                            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccionar Cuartel</option>
                            @foreach($cuarteles as $cuartel)
                            <option value="{{$cuartel->id}}">{{$cuartel->observaciones}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1 mt-2">
                        <label class="p-1 font-medium">Hectareas</label>
                    </div>
                    <div class="col-span-1 mt-2">
                        <label class="text-red-800 font-bold">{{$hectareas}}</label>
                    </div>
                    <div class="col-span-1 mt-2">
                        <label class="p-1 font-medium">Especie</label>
                    </div>
                    <div class="col-span-2 mt-2">
                        <label class="text-red-800 font-bold">{{$especie}}</label>
                    </div>
                    <div class="col-span-1 mt-2">
                        <label class="p-1 font-medium">Variedad</label>
                    </div>
                    <div class="col-span-2 mt-2">
                        <label class="text-red-800 font-bold">{{$variedad}}</label>
                    </div>
                    <div class="col-span-2 mt-2">
                        <label class="p-1 font-medium">Cantidad Plantada</label>
                    </div>
                    <div class="col-span-1 mt-2">
                        <label class="text-red-800 font-bold">{{$cantidadPlantada}}</label>
                    </div>



                    <!-- <div class="col-span-2 text-right mt-2 p-1">
                        <label class="p-1 font-medium">Dirección</label>
                    </div>
                    <div class="col-span-3 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value=""
                            wire:model.defer="DireccionCampo">
                    </div>
                    <div class="col-span-7">
                    </div>
                    <div class="col-span-2 text-right mt-2 p-1">
                        <label class="p-1 font-medium">Fecha</label>
                    </div>
                    <div class="col-span-3 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="">
                    </div> -->

                    {{-- datos exportadora --}}
                    <!-- <div class="col-span-1 mt-7 p-1 text-left">
                        <label class="p-1 font-medium">Rut</label>
                    </div>
                    <div class="col-span-1 mt-6">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="">
                    </div>
                    <div class="col-span-1 mt-7 p-1">
                        <label class="p-1 font-medium">Exportadora</label>
                    </div>
                    <div class="col-span-4 mt-6">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="">
                    </div>
                    <div class="col-span-1 mt-8 p-1">
                        <label class="p-1 font-medium">Dirección</label>
                    </div>
                    <div class="col-span-4 mt-6">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="">
                    </div>
                    <div class="col-span-1 mt-2 p-1 text-left">
                        <label class="p-1 font-medium">Comuna</label>
                    </div>
                    <div class="col-span-4 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="">
                    </div>
                    <div class="col-span-1 mt-2 p-1">
                        <label class="p-1 font-medium">Email</label>
                    </div>
                    <div class="col-span-6 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="">
                    </div>
                    <div class="col-span-1 mt-2 p-1 text-left">
                        <label class="p-1 font-medium">Giro</label>
                    </div>
                    <div class="col-span-8 w-96 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="">
                    </div>
                    <div
                        class="col-span-6 p-2 ml-1 mt-2 h-10 bg-gray-100 flex border border-gray-200 rounded items-center mt-1">
                        <select wire:model.defer="conductor_id"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 w-full bg-transparent">
                            <option>Seleccionar Conductor</option>

                            <option value=""></option>

                        </select>
                    </div>
                    <div
                        class="col-span-6 p-2 ml-1 mt-2 h-10 bg-gray-100 flex border border-gray-200 rounded items-center mt-1">

                        <select wire:model.defer="vehiculo_id"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 w-full bg-transparent">
                            <option>Seleccionar Vehículo</option>

                            <option value=""></option>

                        </select>
                    </div>
                    <div class="col-start-5  col-span-3  text-right mt-1 p-2">
                        <button type="button" wire:click="AgregarGuiaRecepcion"
                            class="bg-gray-500 text-white  py-2 px-4 w-full rounded hover:bg-gray-600">
                            Guardar para Agregar Detalle
                        </button>
                    </div> -->
                    {{-- <div class="col-start-10  col-span-3  text-right mt-1 p-2">
                    <button type="button" wire:click="EliminarGuia" class="inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                        Eliminar Guía de Recepción
                    </button>
                </div> --}}

                </div>
                @if($visible)
                <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 shadow-2xl p-3">
                    <div class="text-center col-span-12 ">
                        <h6 class="col-span-2 font-bold p-2 ">Detalle</h6>
                    </div>


                    <!-- <div class="col-span-12">
                        <table class="mt-3 border-2text-left">
                            <thead class="w-full mt-3 border-2">

                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-24 font-bold mt-3 border-2">Tipo Act.</td>
                                    <td class="w-96 font-bold mt-3 border-2">Costo</td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">U/M</td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">Cantidad</td>
                                    <td class="w-96 font-bold text-center mt-3 border-2">.</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2"><div class=""></div></td>
                                    <td class="w-24 font-bold text-center mt-3 border-2 p-2"><i
                                            class="fa-solid fa-trash"></i></td>
                                </tr>
                                <tr class="mt-3 border-2">
                                    <td class="text-center w-24 font-bold mt-3 border-2"><input type="text"
                                            wire:model.defer="Cantidad" class="uppercase w-24 h-7" value=""
                                            placeholder="Cantidad"></td>
                                    <td class="w-96 font-bold mt-3 border-2">
                                        <select wire:model.defer="envase_id"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Envase</option>

                                            <option value="">
                                            </option>

                                        </select>
                                    </td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">
                                        <select wire:model.defer="color_id"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Color</option>

                                            <option value=""></option>

                                        </select>

                                    </td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">
                                        <select wire:model.defer="observacion" wire:change="cambioEspTotKil"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Observación</option>

                                            <option value="">
                                            </option>

                                        </select>
                                    </td>
                                    <td class="w-96 font-bold text-center mt-3 border-2">
                                        <select wire:model.defer="especie_id"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option value="NULL"></option>

                                            <option value="">
                                            </option>

                                        </select>


                                    </td>
                                    <td class="text-center w-24 font-bold text-center mt-3 border-2"><input type="text"
                                            wire:model.defer="kilos" class="uppercase w-24 h-7" value=""
                                            placeholder="Kilos"></td>
                                    <td class="w-24 font-bold text-center mt-3 border-2 p-2">
                                        <button type="button" wire:click="AgregarLinea"
                                            class="inline-block rounded bg-success-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>

                                <tr class="mt-3 border-2">
                                    <td class="font-bold text-center mt-3 border-2">
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        <button type="button" wire:click=""
                                            class="inline-block rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div> -->

                    {{-- tabla de resunmen --}}
                    <div class="col-span-7 p-2 text-center">
                        <label>Lista de Trabajos a realizar</label>
                        <table class="mt-3 border-2 w-full text-center">
                            <thead class="w-full mt-3 border-2">

                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-24 font-bold mt-3 border-2 px-6">Tipo/Actividad</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">Un.Med.</td>
                                    <td class="w-24 font-bold mt-3 border-2">Cantidad</td>
                                    <td class="w-24 font-bold mt-3 border-2">Costo/Un</td>
                                    <td class="w-24 font-bold mt-3 border-2">Costo</td>

                                    <td class="w-1 font-bold mt-3 border-2 whitespace-nowrap">RE|TC|AV</td>
                                    <td class="text-sm font-bold mt-3 border-2">Agre.</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="mt-3 border-2">
                                    <td class="w-24 font-bold mt-3 border-2 px-6">
                                        <select wire:model.defer="tipoActividad_id"
                                            wire:change="SeleccionTipoActividad_id"
                                            class="w-24 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option> -Tipo Actividad- </option>
                                            @foreach($tipoActividads as $tipoActividad)
                                            <option value="{{$tipoActividad->id}}">{{$tipoActividad->tipo}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">{{$unidadMedida}}</td>
                                    <td class="w-24 font-bold mt-3 border-2"><input type="text" class="text-right w-24"
                                            wire:model.defer="cantidad"></td>
                                            <td class="w-24 font-bold mt-3 border-2"><input type="text" class="text-right w-24"
                                                 wire:model.defer="costoUnitario"    wire:change="Costo"></td>
                                    <td class="w-24 font-bold mt-3 border-2"><input type="text" class="text-right w-24"
                                            value="{{$costo}}" ></td>

                                    <td class="w-1 font-bold mt-3 border-2  whitespace-nowrap">
                                        @php
                                        if($referencia==1){
                                        $referencia='Empresa';
                                        }elseif($referencia==2){
                                        $referencia='Campo';
                                        }elseif($referencia==3){
                                        $referencia='Cuartel';
                                        }else{
                                        $referencia='Especie';
                                        }
                                        @endphp
                                        <label class="text-green-500">{{ substr($referencia, 0, 2) }}</label>|
                                        <label class="text-red-500">{{ substr($TCosto, 0, 2) }}</label>|
                                        <label class="text-blue-500">0.00</label>%
                                    </td>

                                    <td class="text-sm font-bold mt-3 border-2">
                                        <a href="#" wire:click="AgregarCosto" class="">
                                            <i class="fa-solid fa-plus"></i>
                                        </a>

                                    </td>
                                </tr>
                                @foreach($costoActividades as $costoActividad)
                                <tr class="mt-3 border-2">
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{$costoActividad->tipoactividad->tipo}}</td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        @if($costoActividad->tipoactividad->unidadMedida==1)
                                            Unidad
                                        @endif
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">{{ number_format($costoActividad->cantidad, 0, ',', '.') }}</td>
                                    <td class="font-bold text-center mt-3 border-2">{{ number_format($costoActividad->costoUnidad, 0, ',', '.') }}</td>
                                    <td class="font-bold text-center mt-3 border-2">{{ number_format($costoActividad->costo, 0, ',', '.') }}</td>
                                    @php
                                    $cantidad = $costoActividad->cantidad;
                                    $avance = $costoActividad->avance;
                                    $porcentaje = $cantidad > 0 ? ($avance / $cantidad) * 100 : 0;
                                    @endphp
                                    <td class="w-1 font-bold text-center mt-3 border-2  whitespace-nowrap">
                                    @php
                                        $ref="ok";
                                        if($costoActividad->tipoactividad->referencia==1){
                                            $ref='Empresa';
                                        }elseif($costoActividad->tipoactividad->referencia==2){
                                            $ref='Campo';
                                        }elseif($costoActividad->tipoactividad->referencia==3){
                                            $ref='Cuartel';
                                        }else{
                                            $ref='Especie';
                                        }
                                        @endphp
                                    <label class="text-green-500">{{ substr($ref, 0, 2) }}</label>|<label
                                            class="text-red-500">{{ substr($costoActividad->tipoactividad->tipocosto->costo, 0, 2) }}</label>|<label
                                            class="text-blue-500">{{ number_format($porcentaje, 2) }}</label>%
                                           
                                    </td>
                                    <!-- <td class="font-bold text-center mt-3 border-2">{{ substr($costoActividad->tipoactividad->referencia, 0, 1) }}
                                    </td> -->
                                    <td class="text-sm font-bold mt-3 border-2">
                                        <a href="#" wire:click="EliminarCosto({{$costoActividad->id}})" class="">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- fin tabla de resumen --}}
                    {{-- tabla de resunmen --}}
                    <div class="col-span-5 p-2 text-center">
                        <table class="mt-3 border-2 w-full">
                            <label>Lista de Trabajos Realizados</label>
                            <thead class="w-full mt-3 border-2">

                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-24 font-bold mt-3 border-2 px-6">Actividad</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">Uni./Med.</td>
                                    <td class="w-24 font-bold mt-3 border-2">Fecha</td>
                                    <td class="w-24 font-bold mt-3 border-2">Cantidad</td>
                                    <td class="w-24 font-bold mt-3 border-2">Restante</td>
                                    <td class="w-24 font-bold mt-3 border-2">Valor</td>
                                    <td class="text-sm font-bold mt-3 border-2">+</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="mt-3 border-2 ">
                                    <td class="w-24 font-bold mt-3 border-2 px-6">
                                        <select wire:model.defer="costoActividad_id" wire:change="SeleccionCosto"
                                            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Actividad</option>
                                            @foreach($costoActividades as $costoActividade)
                                            <option value="{{$costoActividade->id}}">
                                                {{$costoActividade->tipoactividad->tipo}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">{{$uniMed}}</td>
                                    <td class="w-24 font-bold mt-3 border-2"><input type="date" class="text-right w-24"
                                            wire:model.defer="fechaAvance"></td>
                                    <td class="w-24 font-bold mt-3 border-2"><input type="text" class="text-right w-24"
                                            wire:model.defer="cantAvance"></td>
                                    <!-- <td class="w-24 font-bold mt-3 border-2">Costo/Un</td> -->
                                    <td class="w-24 font-bold mt-3 border-2">{{$restante}}</td>
                                    <td class="w-24 font-bold mt-3 border-2">{{$valor}}</td>
                                    <td class="text-sm font-bold mt-3 border-2"><a href="#"
                                            wire:click="SumarAvance">+</a></td>
                                </tr>
                                @foreach($avanceactividades as $avanceactividad)
                                <tr class="mt-3 border-2">
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        {{$avanceactividad->costoactividad->tipoactividad->tipo}}</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        {{$avanceactividad->costoactividad->tipoactividad->unidadMedida}}</td>
                                        <td class="w-24 font-bold text-center mt-3 border-2">
                                        {{$avanceactividad->fechaAvance}}</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">{{$avanceactividad->ejecutado}}
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">{{ number_format($avanceactividad->restante, 0, ',', '.') }}
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">{{ number_format($avanceactividad->valor, 0, ',', '.') }}
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        <a href="#" wire:click="EliminarAvance({{$avanceactividad->id}})" class="">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>



                    <div class="col-span-12 text-center">
                        <div class="text-center col-start-4 col-span-5 mb-8 shadow-lg">
                            <label class="font-bold">Observación para cerrar Actividad</label>
                            <textarea wire:model.defer="observacion" rows="1"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        <div class="col-start-1 text-left col-span-5">
                            <button type="button" wire:click="cerrarActividades"
                                class="bg-orange-700 text-white  py-2 px-4 rounded hover:bg-gray-600">
                                Cerrar Actividad
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>