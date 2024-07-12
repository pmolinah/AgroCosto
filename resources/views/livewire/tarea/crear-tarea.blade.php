<div>
    <div class="w-full rounded-xl border border-gray-200 bg-white py-2 px-2 shadow-md shadow-neutral-800">
        <div class=" flex items-center justify-between px-2 text-base font-medium text-gray-700">
            <div class="text-center">Ordenes de Aplicacion de Fitosanitarios - Numero Orden :{{ $Numero }}
                <input type="hidden" value="{{ $Numero }}" wire:model.defer="tareaEliminarID">
            </div>
            <select required class="px-4 py-2 border-2 text-gray-800 bg-transparent" wire:change="CambioTareas"
                wire:model.defer="tareaID">
                <option value="" class="text-secondary">Ordenes sin Generar</option>
                @foreach ($tareas as $tarea)
                    <option class="text-primary" value="{{ $tarea->id }}">
                        {{ $tarea->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-2">
            <div class="flex max-h-[600px] w-full flex-col overflow-y-scroll">
                {{-- inicio guia --}}
                <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 p-3 gap-2">
                    {{-- <div class="col-span-12 text-center font-bold p-1 mt-2 text-gray-700">
                        Orden Fitosanitario
                    </div> --}}
                    <div class="col-span-4 text-left rounded-lg bg-white p-1 shadow-lg shadow-neutral-800">
                        <div class="font-bold px-6 text-neutral-900 bg-neutral-300">
                            Propietario.
                        </div>
                        <div class="w-full">
                            <select required class="px-4 py-2 border-2 text-gray-800 bg-transparent"
                                wire:model.defer="empresa_id" wire:change="cambioEmpresa">
                                <option value="" class="text-secondary">Seleccionar</option>
                                @foreach ($empresas as $empresa)
                                    <option class="text-primary" value="{{ $empresa->id }}">
                                        {{ $empresa->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- fin --}}
                    {{-- inicio --}}
                    <div class="col-span-4 text-left rounded-lg bg-white p-1 shadow-lg  shadow-neutral-800">
                        <div class="font-bold px-6 text-neutral-900 bg-neutral-300">
                            Campo,{{ $campo_id }}
                        </div>
                        <div class="">
                            <select required class="px-4 py-2 border-2 text-gray-800 bg-transparent"
                                wire:model.defer="campo_id" name="campo_id" wire:change="cambioCampo">
                                <option class="text-secondary">Seleccionar</option>
                                @foreach ($campos as $campo)
                                    <option value="{{ $campo->id }}">{{ $campo->campo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- fin --}}
                    {{-- inicio --}}
                    <div class="col-span-4 text-left rounded-lg bg-white p-1 shadow-lg  shadow-neutral-800">
                        <div class="font-bold px-6 text-neutral-900 bg-neutral-300">
                            Cuartel{{ $cuartel_id }}
                        </div>
                        <div class="">
                            <select id="cuartelPlan_id" required class="px-4 py-2 border-2 text-gray-800 bg-transparent"
                                wire:model.defer="cuartel_id" name="cuartel_id">
                                <option value="" class="text-secondary">Seleccionar</option>
                                @foreach ($cuarteles as $cuartel)
                                    <option value="{{ $cuartel->id }}">{{ $cuartel->observaciones }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- fin --}}
                    <div class="col-span-2 text-center p-4">
                        <div class="">
                            <label
                                class="text-sm font-medium leading-6 text-neutral-900 font-bold text-center">Superficie
                                Cuartel</label>
                            <div class="">
                                <input type="text" name="superficiecuartel" wire:model.defer="superficie" disabled
                                    id="superficie"
                                    class="text-center rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>

                    <div class="col-span-5 text-center p-4">
                        <div class="">
                            <label
                                class="text-sm font-medium leading-6 text-neutral-900 font-bold text-center">Especie</label>
                            <div
                                class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                                <input type="text" disabled
                                    class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                                    wire:model.defer="especie" id="especie_id" />
                                <input type="hidden" id="plantacion_id" name="plantacion_id">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-5 text-center p-4">
                        <div class="">
                            <label
                                class="text-sm font-medium leading-6 text-neutral-900 font-bold text-center">Variedad</label>
                            <div
                                class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                                <input type="text" disabled
                                    class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                                    wire:model.defer="variedad" id="variedad" />
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 text-center p-2">
                        <div class="">
                            <label
                                class="text-sm font-medium leading-6 text-neutral-900 font-bold text-center">Responsable
                                Tecnico</label>
                            <div
                                class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                                <input type="text" disabled
                                    class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                                    @if (auth()->check()) value="{{ Auth::user()->name }}"
                                    @else
                                        {{-- Código para mostrar cuando el usuario no está autenticado --}}
                                        Usuario no autenticado @endif />
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <select id="administrador_id" required wire:model.defer="administrador_id"
                            class="px-4 py-2 border-2 w-full mt-8 text-gray-800 bg-transparent">
                            <option value="" class="text-secondary">Seleccionar Administrador</option>
                            @foreach ($administradores as $administrador)
                                <option class="text-primary" value="{{ $administrador->id }}">
                                    {{ $administrador->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-6  text-right mt-1 p-2">
                        <button type="button" wire:click.prevent="GuardarOrdenVerDetalle"
                            class="bg-gray-800 text-white  py-2 px-4 rounded hover:bg-gray-600">
                            Guardar Tarea y Agregar Detalle
                        </button>
                    </div>
                    <div class="col-span-6  text-right mt-1 p-2">
                        <button type="button" wire:click.prevent="eliminarTarea"
                            class="bg-red-800 text-white  py-2 px-4 rounded hover:bg-gray-600">
                            Eliminar Tarea Completa, con Detalles.
                        </button>
                    </div>
                </div>

                <div class="text-center col-span-12 mt-1">
                    <h6 class="col-span-2 font-bold  mt-1 bg-neutral-200">Detalle</h6>
                </div>
                <div class="col-span-12 shadow-lg shadow-neutral-800 p-1 rounded-lg p-2">
                    <table class="mt-3 border-2 text-left">
                        <thead class="w-full mt-3 border-2">

                            <tr class="mt-3 border-2 bg-gray-300 text-center">
                                <td class="w-full font-bold mt-3 border-2">Producto</td>
                                <td class="w-24 font-bold mt-3 border-2">Ingred.Act.</td>
                                <td class="w-24 font-bold text-center mt-3 border-2">Objetivo</td>
                                <td class="w-24 font-bold text-center mt-3 border-2">Dos.,g/ml,1000</td>
                                <td class="w-24 font-bold text-center mt-3 border-2">F.inicio-F.final</td>
                                {{-- <td class="w-24 font-bold text-center mt-3 border-2">F.Final</td> --}}
                                <td class="w-24 font-bold text-center mt-3 border-2">Frec.Aplic.</td>
                                {{-- <td class="w-24 font-bold text-center mt-3 border-2">F.Estimadas</td> --}}
                                <td class="w-24 font-bold text-center mt-3 border-2">Reingreso</td>
                                <td class="w-24 font-bold text-center mt-3 border-2">Mojamiento</td>
                                <td class="w-24 font-bold text-center mt-3 border-2">Forma.Aplic.</td>
                                <td class="w-24 font-bold text-center mt-3 border-2">Carencia(Ej: CH-05,US-10)</td>
                                <td class="w-24 font-bold text-center mt-3 border-2 p-2"><i
                                        class="fa-solid fa-trash"></i></td>
                            </tr>
                            <tr class="mt-3 border-2 bg-neutral-200">
                                <td class="w-32 font-bold mt-3 border-2">
                                    <select wire:model.defer="item_id" wire:change="CambioItem"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option></option>
                                        @foreach ($inventario as $item)
                                            <option value="{{ $item->item_id }}">{{ $item->item->nombre }}</option>
                                        @endforeach

                                    </select>
                                </td>
                                <td class="text-center w-24 font-bold mt-3 border-2"><input type="text" disabled
                                        wire:model.defer="ingredienteActivo" class="uppercase w-24 h-7 border-2">
                                </td>
                                <td class="w-48 font-bold text-center mt-3 border-2">
                                    <input type="text" wire:model.defer="objetivo"
                                        class="uppercase w-24 h-7 border-2">
                                </td>
                                <td class="w-24 font-bold text-center mt-3 border-2">
                                    <input type="text" wire:model.defer="dosis"
                                        class="uppercase w-24 h-7 border-2">
                                </td>
                                <td class="w-24 font-bold text-center mt-3 border-2">
                                    <input type="date" wire:model.defer="fechai"
                                        class="uppercase w-24 h-7 border-2">
                                    <input type="date" wire:model.defer="fechaf" class="uppercase w-24 h-7">
                                </td>
                                {{-- <td class="text-center w-24 font-bold text-center mt-3 border-2">
                                </td> --}}
                                <td class="text-center w-24 font-bold text-center mt-3 border-2  border-2"><input
                                        type="text" wire:model.defer="diasAplicacion"
                                        class="uppercase w-24 h-7  border-2"></td>
                                {{--   <td class="text-center w-24 font-bold text-center mt-3 border-2"><input type="text"
                                        wire:model.defer="fechasEstimadas" class="uppercase w-24 h-7  border-2"></td> --}}
                                <td class="text-center w-24 font-bold text-center mt-3 border-2"><input type="text"
                                        wire:model.defer="reingreso" class="uppercase w-24 h-7  border-2"></td>
                                <td class="text-center w-24 font-bold text-center mt-3 border-2"><input type="text"
                                        wire:model.defer="mojamiento" class="uppercase w-24 h-7 border-2"></td>
                                <td class="w-96 font-bold mt-3 border-2">
                                    <select wire:model.defer="equipo_id"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option>Seleccionar</option>
                                        @foreach ($equipos as $equipo)
                                            <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>◘
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center w-24 font-bold text-center mt-3 border-2"><input type="text"
                                        wire:model.defer="carencias" class="uppercase w-24 h-7  border-2"></td>

                                <td class="w-24 font-bold text-center mt-3 border-2 p-2">

                                    <a href="#" wire:click="AgregarLinea">

                                        <i class="fa-solid fa-plus"></i>
                                    </a>

                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalleTarea as $detalle)
                                <tr class="mt-3 border-2">
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{ $detalle->item->nombre }}
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{ $detalle->item->ingredienteActivo }}
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{ $detalle->objetivo }}
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{ $detalle->dosis }}
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{ $detalle->fechai }},{{ $detalle->fechaf }}
                                    </td>
                                    {{-- <td class="font-bold text-center mt-3 border-2">
                                </td> --}}
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{ $detalle->diasentreAplicacion }}
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{ $detalle->reingreso }}
                                    </td>
                                    {{-- <td class="font-bold text-center mt-3 border-2">
                                </td> --}}
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{ $detalle->mojamiento }}
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{ $detalle->equipo->nombre }}
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{ $detalle->carencia }}
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        <a href="#" type="button"
                                            wire:click="QuitarLinea({{ $detalle->id }})">

                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-span-12 text-center m-2">
                    <div class="text-center col-start-4 col-span-5 mb-8 shadow-lg">
                        <label class="font-bold">Observación Max 100 Caractéres,(Opcional)</label>
                        <textarea wire:model.defer="observacion" rows="1"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                    <div class="col-start-1 text-left col-span-5">
                        <button type="button" wire:click="generarTarea"
                            class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600">
                            Generar Orden de Aplicacion
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
