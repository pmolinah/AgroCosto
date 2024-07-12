<div>
    <div class="grid grid-cols-12">
        <div class="col-span-12 text-left shadow-lg shadow-neutral-500 rounded-lg">
            <div class="flex flex-col border rounded-lg overflow-hidden bg-white">
                <div class="grid grid-cols-1 sm:grid-cols-4">
                    <div
                        class="flex flex-col border-b sm:border-b-0 items-center p-8 sm:px-4 sm:h-full sm:justify-center">
                        <p class="text-2xl font-bold rounded-full text-center">Planificaciones Fitosanitarias</p>
                    </div>
                    <div class="flex flex-col sm:border-l col-span-3">
                        <div class="flex flex-col p-6 text-gray-600">
                            <div class="flex flex-row text-sm">
                                <div class="w-1/6">Propietario</div>
                                <div class="w-5/6">
                                    <select required class="w-56 px-4 border-2 text-gray-800 bg-transparent"
                                        wire:model.defer="empresa_id" wire:change="cambioEmpresa">
                                        <option class="text-secondary">Seleccionar</option>
                                        @foreach ($empresas as $empresa)
                                            <option class="text-primary" value="{{ $empresa->id }}">
                                                {{ $empresa->razon_social }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="flex flex-row text-sm text-left">
                                <div class="w-1/6">Campo</div>
                                <div class="w-5/6">
                                    <select required class="w-56 px-4 border-2 text-gray-800 bg-transparent"
                                        wire:model.defer="campo_id" name="campo_id" wire:change="cambioCampo">
                                        <option class="text-secondary">Seleccionar</option>
                                        @foreach ($campos as $campo)
                                            <option value="{{ $campo->id }}">{{ $campo->campo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-row text-sm">
                                <div class="w-1/6">Cuartel:</div>
                                <div class="w-5/6">
                                    <select id="cuartelPlan_id" required
                                        class="w-56 px-4 border-2 text-gray-800 bg-transparent"
                                        wire:change="cambioCuartel" wire:model.defer="cuartel_id" name="cuartel_id">
                                        <option value="" class="text-secondary">Seleccionar</option>
                                        @foreach ($cuarteles as $cuartel)
                                            <option value="{{ $cuartel->id }}">{{ $cuartel->observaciones }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="flex flex-col w-full relative bottom-0">
                            <div class="grid grid-cols-4 border-t divide-x bg-gray-50 dark:bg-transparent">
                                <a
                                    class="col-span-1 cursor-pointer uppercase text-xs flex flex-row items-center justify-center font-semibold">
                                    <div class="mr-2">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24"
                                            width="20px" fill="#0ed3cf">
                                            <path d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                        </svg> --}}
                                    </div>
                                    Superficie:&nbsp;&nbsp; {{ $superficie }}
                                </a>

                                <a
                                    class="col-span-2 cursor-pointer uppercase text-xs flex flex-row items-center justify-center font-semibold">
                                    <div class="mr-2">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24"
                                            width="20px" fill="#0ed3cf">
                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                            <path
                                                d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4z" />
                                        </svg> --}}
                                    </div>
                                    Especie {{$especie}}&nbsp;&nbsp;, Variedad {{$variedad}}
                                </a>
                                <a
                                    class="col-span-1 cursor-pointer uppercase text-xs flex flex-row items-center justify-center font-semibold">
                                    <div class="mr-2">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24"
                                            width="20px" fill="#0ed3cf">
                                            <path d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z" />
                                        </svg> --}}
                                    </div>
                                    Cant.Plantas {{$cantPlan}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-4 ">
            <!-- component -->
            <div class="flex mt-5 w-full flex-col gap-y-2 ">
                <div class="w-[350px] rounded-xl border border-gray-200 bg-white px-2 shadow-lg shadow-neutral-500 ">
                    <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
                        <div>Planificaciones del Cuartel</div>
                    </div>
                    <div class="mt-4">
                        <div class="flex max-h-[500px] flex-col overflow-y-scroll">
                            @foreach ($tareas as $tarea)
                                <button wire:click="DetalleTarea({{ $tarea->id }})"
                                    class="group flex items-center gap-x-5 rounded-md px-2.5 py-2 transition-all duration-75 hover:bg-green-100">
                                    <div
                                        class="flex h-12 w-12 items-center rounded-lg bg-gray-200 text-black group-hover:bg-green-200">
                                        <span
                                            class="tag w-full text-center text-2xl font-medium text-gray-700 group-hover:text-green-900">
                                            <svg class="mx-auto h-6 w-6" aria-hidden="true" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="flex flex-col items-start justify-between font-light text-gray-600">
                                        <p class="text-[15px]">{{ $tarea->item->nombre }}</p>
                                        <span
                                            class="text-xs font-light text-gray-400">Objetivo:&nbsp;{{ $tarea->objetivo }}</span>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-8">
            <div
                class="flex max-h-[500px] w-full flex-col overflow-y-scroll mt-5 shadow-neutral-600 rounded-lg">
                <div class="p-2">
                    {{-- <div class="w-full text-center">
                    Detalle Tarea
                </div> --}}
                    <table class="border-2 mt-1 w-full shadow-sm shadow-neutral-800">
                    <div class="w-full text-center">
                        Producto Utilizado <input type="hidden" wire:model.defer="detalletareaID"
                            value="{{ $detalletareaID }}">
                    </div>
                        <thead>
                            <tr class="text-center bg-neutral-300">
                                <td class="border-2 font-bold">Fecha</td>
                                <td class="border-2 font-bold">Objetivo</td>
                                <td class="border-2 font-bold">Producto</td>
                                <td class="border-2 font-bold">I.Activo</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-left">
                                <td>{{ $fechai }}</td>
                                <td>{{ $objetivo }}</td>
                                <td>{{ $producto }}</td>
                                <td>{{ $ingredienteActivo }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="border-2 mt-1 w-full shadow-sm shadow-neutral-800">
                    <div class="w-full text-center">
                        Dosis
                    </div>
                        <thead>
                            <tr class="text-center bg-neutral-300">
                                <td class="border-2 font-bold">Mojamiento</td>
                                <td class="border-2 font-bold">cc o gr</td>
                                <td class="border-2 font-bold">x 100l</td>
                                <td class="border-2 font-bold">UM</td>
                                <td class="border-2 font-bold">x Ha</td>
                                <td class="border-2 font-bold">Total Ha</td>
                                <td class="border-2 font-bold">L/Cuartel</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{ $mojamiento }}</td>
                                <td>{{ $dosis }}</td>
                                <td class="text-center">@php
                                    $div = 0;
                                    $div = $dosis / 1000;
                                    echo $div;
                                @endphp

                                </td>
                                <td>
                                    @if ($um == 0)
                                        N/A
                                    @elseif($um == 1)
                                        LITRO
                                    @elseif($um == 2)
                                        KILO
                                    @elseif($um == 3)
                                        UNIDAD
                                    @else
                                        METROS
                                    @endif
                                </td>
                                <td>
                                    @php
                                        echo ($mojamiento * $div) / 100;
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        echo $superficie * (($mojamiento * $div) / 100);
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        echo $mojamiento * $superficie;
                                    @endphp
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="w-full text-center">
                        Datos Aplicacion
                    </div>
                    <table class="border-2 mt-1 w-full shadow-sm shadow-neutral-800">
                        <thead>
                            <tr class="text-center bg-neutral-300">
                                <td class="border-2 font-bold">Forma.Aplicacion</td>
                                <td class="border-2 font-bold">Reingreso</td>
                                <td class="border-2 font-bold">Carencias</td>
                                {{-- <td class="border-2 font-bold">Aplicador</td>
                            <td class="border-2 font-bold">Dosificador</td> --}}
                                <td class="border-2 font-bold">F.Aplicacion</td>
                                <td class="border-2 font-bold">N° Orden</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{ $aplicacion }}</td>
                                <td>{{ $reingreso }}</td>
                                <td class="text-center">{{ $carencia }}</td>
                                {{-- <td>

                            </td>
                            <td>

                            </td> --}}
                                <td>
                                    {{ $frecuencia }}
                                </td>
                                <td>
                                    {{ $numero }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="w-full text-center">
                        Registro de Aplicaciones y Cierre de Tarea
                    </div>
                    <table class="border-2 mt-3 w-full shadow-sm shadow-neutral-800">
                        <thead>
                            <tr class="text-center bg-neutral-300">
                                <td class="border-2 font-bold">Dosificador</td>
                                <td class="border-2 font-bold">Aplicador</td>
                                <td class="border-2 font-bold">Fecha Apli.</td>
                                <td class="border-2 font-bold">Añadir/Apli.</td>
                                <td class="border-2 font-bold">Cierre</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>
                                    <select required class="w-full px-4 border-2 text-gray-800 bg-transparent"
                                        wire:model.defer="dosificador_id">
                                        <option class="text-secondary w-24">Seleccionar</option>
                                        @foreach ($usuarios as $usuario)
                                            <option class="text-primary" value="{{ $usuario->id }}">
                                                {{ $usuario->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select required class="w-full px-4 border-2 text-gray-800 bg-transparent"
                                        wire:model.defer="aplicador_id">
                                        <option class="text-secondary">Seleccionar</option>
                                        @foreach ($usuarios as $usuario)
                                            <option class="text-primary" value="{{ $usuario->id }}">
                                                {{ $usuario->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="w-24"><input type="date" wire:model.defer="fechaAplicacion"></td>
                                <td><a href="#" wire:click="sumarAplicacion"><i
                                            class="fa-solid fa-plus"></i></a></td>
                                <td class="w-24">
                                    <input type="checkbox" wire:model.defer="cierreTarea"
                                        class='mt-1 relative h-5 w-10 appearance-none rounded-[20px] bg-[#e0e5f2] outline-none transition duration-[0.5s] 
                        before:absolute before:top-[50%] before:h-4 before:w-4 before:translate-x-[2px] before:translate-y-[-50%] before:rounded-[20px]
                        before:bg-white before:shadow-[0_2px_5px_rgba(0,_0,_0,_.2)] before:transition before:content-[""]
                        checked:before:translate-x-[22px] hover:cursor-pointer checked:bg-brand-500 dark:checked:bg-brand-400'>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="border-2 mt-3 w-full shadow-sm shadow-neutral-800">
                        <thead>
                            <tr class="text-center bg-neutral-300">
                                <td class="border-2 font-bold">Dosificador</td>
                                <td class="border-2 font-bold">Aplicador</td>
                                <td class="border-2 font-bold">Fecha Apli.</td>
                                <td class="border-2 font-bold">Quitar Apli.</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aplicaciones as $aplicacion)
                                <tr class="text-center">
                                    <td>
                                        {{ $aplicacion->dosificador->name }}
                                    </td>
                                    <td>
                                        {{ $aplicacion->aplicador->name }}
                                    </td>
                                    <td>
                                        {{ $aplicacion->fecha }}
                                    </td>
                                    <td><a href="#" wire:click="EliminarAplicacion({{ $aplicacion->id }})"><i
                                                class="fa-solid fa-trash-can text-red-800"></i></a></td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
