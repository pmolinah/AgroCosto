<div>
    <div class="text-left w-full rounded-xl border border-gray-200 bg-white py-2 px-2 shadow-md shadow-neutral-800">
        <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
            <div>Entrega de Materiales</div>
        </div>
        <div class="mt-2">
            <div class="flex max-h-[600px] w-full flex-col overflow-y-scroll">
                {{-- inicio guia --}}
                <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-200">
                    <div class="col-span-2 font-bold p-2 mt-1 text-gray-700">
                        Entrega de Bodega
                    </div>
                    <div class="col-span-1 p-2 mt-1 ml-2 text-gray-700">
                        Fecha
                    </div>
                    <div class="text-center  col-span-2 ">
                        <input type="date" wire:model.defer="fecha"
                            class="text-gray-700 h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                    </div>

                    <div class="col-span-3 p-2 ml-4">
                        <select wire:model.defer="tarea_id" wire:change="SeleccionTarea"
                            class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccione Tareas</option>
                            @foreach ($tareas as $tarea)
                                <option value="{{ $tarea->id }}">{{ $tarea->id }}</option>
                            @endforeach
                            {{-- @foreach ($tareas as $tarea)
                                @foreach ($tarea->detalletarea as $detalle)
                                    @if ($detalle->estado == null)
                                        <option value="{{ $detalle->item_id }}">{{ $detalle->item->nombre }}</option>
                                    @endif
                                @endforeach
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="col-span-3 p-2 ml-4">
                        <select wire:model.defer="egresoID" wire:change="SeleccionEgreso"
                            class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Lista Despacho sin Emitir</option>
                            @foreach ($despachosSinEmitir as $despachos)
                                <option value="{{ $despachos->id }}">{{ $despachos->id }}</option>
                            @endforeach
                            {{-- @foreach ($tareas as $tarea)
                                @foreach ($tarea->detalletarea as $detalle)
                                    @if ($detalle->estado == null)
                                        <option value="{{ $detalle->item_id }}">{{ $detalle->item->nombre }}</option>
                                    @endif
                                @endforeach
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                {{-- detalle de tarea --}}
                <div class="col-span-12 text-center">
                    Detalle de Tarea Seleccionada
                </div>
                <div class="col-span-12 text-center">

                    <table class="mt-3 border-2text-left">
                        <thead class="w-full mt-3 border-2">
                            <tr class="mt-3 border-2 bg-gray-300">
                                <td class="w-24 font-bold text-center mt-3 border-2">Producto</td>
                                <td class="w-48 font-bold text-center mt-3 border-2">Ingrediente Activo</td>
                                <td class="w-24 font-bold text-center mt-3 border-2">dosis.ml.gm.un</td>
                                <td class="w-24 font-bold text-center mt-3 border-2">U/M</td>
                                <td class="w-10 font-bold text-center mt-3 border-2">+</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalleTarea as $detalle)
                                <tr class="border-2">
                                    <td class="text-center w-48 font-bold border-2">
                                        <input type="text" class="text-center" value="{{ $detalle->item->nombre }}">
                                    </td>
                                    <td class="w-48 font-bold text-center border-2">
                                        <input type="text" class="text-center"
                                            value="{{ $detalle->item->ingredienteActivo }}">
                                    </td>
                                    <td class="text-center w-24 font-bold  border-2">
                                        <input type="text" class="text-center" value="{{ $detalle->dosis }}">
                                    </td>
                                    <td class="text-center w-24 font-bold  border-2">
                                        @if ($detalle->unidadMedida == 0)
                                            N/A
                                        @elseif($detalle->unidadMedida == 1)
                                            LITRO
                                        @elseif($detalle->unidadMedida == 2)
                                            KILO
                                        @elseif($detalle->unidadMedida == 3)
                                            UNIDAD
                                        @else
                                            METROS
                                        @endif
                                    </td>
                                    <td class="text-center w-10 font-bold text-center border-2">
                                        @if ($visible)
                                            <a href="#" type="button" wire:click="AgregarLinea">
                                                <i class="fa-solid fa-plus text-primary-800"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- fin detalle tarea --}}
                <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 shadow-2xl p-5">
                    {{-- <div class="col-span-4 text-right mt-2 p-1">

                    </div> --}}
                    <div class="col-span-1 text-left mt-2 p-1">
                        Egreso N° <input type="hidden" wire:model.defer="egresobodega_id">
                    </div>
                    <div class="col-span-6 font-bold text-primary-800 text-left">
                        <input type="number" wire:model.defer="egresobodega_id" value="{{ $egresobodega_id }}"
                            class="text-right uppercase h-10 border mt-1 rounded px-4 bg-gray-200">
                    </div>
                    <div class="col-span-4">

                    </div>

                    <div class="col-span-12">
                    </div>

                    <div class="col-span-1 mt-7 p-1">
                        <label class="p-1 font-medium">Solicitante</label>
                    </div>
                    <div class="col-span-8 mt-6">
                        <select wire:model.defer="solicitante_id" wire:change="SeleccionTarea"
                            class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccionar</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-span-6 mt-3">
                        <button type="button" wire:click="GrabarDocumento"
                            class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600 shadow-lg shadow-neutral-600">
                            Guardar para añadir Detalle
                        </button>
                    </div>
                    <div class="col-span-6 text-right mt-3">
                        <button type="button" wire:click="GrabarDocumento"
                            class="bg-red-700 text-white  py-2 px-4 rounded hover:bg-gray-600 shadow-lg shadow-neutral-600">
                            Eliminar Solicitud
                        </button>
                    </div>
                    <div class="text-center col-span-12 mt-1">
                        <h6 class="col-span-2 font-bold p-2 mt-1">Detalle Entrega de Materiales</h6>{{ $precio }}
                    </div>
                    <div class="col-span-12">
                        <table class="mt-3 border-2text-left">
                            <thead class="w-full mt-3 border-2">
                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-48 font-bold mt-3 border-2">Bodega</td>
                                    <td class="w-48 font-bold mt-3 border-2"><label class="mr-20">Detalle</label>
                                        <a href="#" wire:click="BuscarxFiltro">
                                            <i class="fa-solid fa-magnifying-glass inline-block p-1 ml-1"></i>
                                        </a>
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">U/Med</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">Cont/Env</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">stock</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">ML/GR/UN</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">ML/GR/UN</td>
                                    <td class="w-10 font-bold text-center mt-3 border-2">+/-</td>
                                </tr>
                                <tr class="mt-3 border-2">
                                    <td class="text-center w-48 font-bold mt-3 border-2">
                                        <select wire:model.defer="bodega_id" wire:change="cambioBodega"
                                            class="inline-block w-72 rounded-md border-0 py-1.5 text-center text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Bodega Egreso</option>
                                            @foreach ($bodegas as $bodega)
                                                <option value="{{ $bodega->id }}">{{ $bodega->bodega }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    {{-- seleccion de id del inventario del item --}}
                                    <td class="w-auto font-bold mt-3 border-2">
                                        <select wire:model.defer="item_id" wire:change="CambiaSeleccionItem"
                                            class="inline-block w-72 rounded-md border-0 py-1.5 text-center text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Selecione Items</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->item->nombre }}, F.venc
                                                    {{ $item->vencimiento }}</option>
                                            @endforeach
                                        </select>
                                        {{-- fin --}}
                                        {{-- nuevo modal --}}
                                        <x-modal wire:model="visibleItem" maxWidth="2xl">
                                            <div class="p-2 overflow-x-auto bg-neutral-200">
                                                Buscar Item
                                                <div class="items-center mt-4 md:mt-0">

                                                    <input type="text" placeholder="Filtrar" wire:model="filtro"
                                                        class="m-2 block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                                                </div>
                                                <table class="min-w-full">
                                                    <thead class="bg-gray-50 bg-gray-500">
                                                        <tr>
                                                            <th scope="col"
                                                                class=" text-sm font-normal text-gray-500 text-white">
                                                                Añadir
                                                            </th>
                                                            <th scope="col"
                                                                class="px-12  text-sm font-normal text-gray-500 text-white">
                                                                Item
                                                            </th>
                                                            <th scope="col"
                                                                class="px-12  text-sm font-normal text-gray-500 text-white">
                                                                Codigo
                                                            </th>
                                                            <th scope="col"
                                                                class="px-4  text-sm font-normal text-gray-500 text-white">
                                                                Tipo
                                                            </th>
                                                            <th scope="col"
                                                                class="px-4  text-sm font-normal text-gray-500 text-white">
                                                                Clasificacion</th>
                                                            <th scope="col"
                                                                class="px-4  text-sm font-normal text-gray-500 text-white">
                                                                Categoria</th>
                                                            <th scope="col"
                                                                class="px-4  text-sm font-normal text-gray-500 text-white">
                                                                Unidad/Medida</th>
                                                            <th scope="col"
                                                                class="px-4  text-sm font-normal text-gray-500 text-white">
                                                                Marca</th>
                                                            <th scope="col"
                                                                class="px-4  text-sm font-normal text-gray-500 text-white">
                                                                Ingrediente/Activo</th>
                                                            {{-- <th scope="col"
                                                                class="px-4  text-sm font-normal text-gray-500 text-white">
                                                                Presentacion</th>
                                                            <th scope="col"
                                                                class="px-4  text-sm font-normal text-gray-500 text-white">
                                                                Contenido</th> --}}
                                                            <th scope="col"
                                                                class="px-4  text-sm font-normal text-gray-500 text-white">
                                                                Capacidad</th>
                                                            <th scope="col"
                                                                class="px-4  text-sm font-normal text-gray-500 text-white">
                                                                Etiqueta</th>
                                                            <th scope="col"
                                                                class="px-4  text-sm font-normal text-gray-500 text-white">
                                                                Stock/Minimo</th>
                                                            <th scope="col"
                                                                class="px-4  text-sm font-normal text-gray-500 text-white">
                                                                Observacion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-gray-700 text-white">
                                                        @foreach ($itemsInventario as $item)
                                                            <tr>
                                                                <td class="text-center text-yellow-300">
                                                                    <a href="#" {{-- wire:click="Seleccion({{ $item->id }})"><i --}}
                                                                        wire:click="Seleccion({{ json_encode(['cod' => $item->QrBarra, 'id' => $item->id, 'um' => $item->unidadMedida, 'pres' => $item->presentacion, 'bod' => $item->bodega_id]) }})"><i
                                                                            class="fa-solid fa-plus"></i></a>
                                                                </td>
                                                                <td class="px-4 text-sm font-medium whitespace-nowrap">
                                                                    {{ $item->item->nombre }}
                                                                </td>
                                                                <td class="px-4 text-sm font-medium whitespace-nowrap">
                                                                    {{ $item->item->QrBarra }}
                                                                </td>
                                                                <td class="px-4 text-sm font-medium whitespace-nowrap">
                                                                    @if ($item->tipo_id == 1)
                                                                        <option value="{{ $item->tipo_id }}">
                                                                            Insumo</option>
                                                                    @elseif($item->tipo_id == 2)
                                                                        <option value="{{ $item->tipo_id }}">
                                                                            Equipos</option>
                                                                    @elseif($item->tipo_id == 3)
                                                                        <option value="{{ $item->tipo_id }}">
                                                                            Productos
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $item->tipo_id }}">
                                                                            Suministros
                                                                        </option>
                                                                    @endif
                                                                </td>
                                                                <td class="px-4 text-sm font-medium whitespace-nowrap">
                                                                    @if ($item->clasificacion_id == 0)
                                                                        <option value="{{ $item->clasificacion_id }}">
                                                                            N/A</option>
                                                                    @elseif($item->clasificacion_id == 1)
                                                                        <option value="{{ $item->clasificacion_id }}">
                                                                            Riesgo Bajo
                                                                        </option>
                                                                    @elseif($item->clasificacion_id == 3)
                                                                        <option value="{{ $item->clasificacion_id }}">
                                                                            Riesgo Medio
                                                                        </option>
                                                                    @elseif($item->clasificacion_id == 4)
                                                                        <option value="{{ $item->clasificacion_id }}">
                                                                            Riesgo Alto
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $item->clasificacion_id }}">
                                                                            Riesgo Quimico
                                                                        </option>
                                                                    @endif
                                                                </td>
                                                                <td class="px-4 text-sm font-medium whitespace-nowrap">
                                                                    @if ($item->categoria_id == 1)
                                                                        <option value="{{ $item->categoria_id }}">
                                                                            Quimicos
                                                                        </option>
                                                                    @elseif($item->categoria_id == 2)
                                                                        <option value="{{ $item->categoria_id }}">
                                                                            Cosecha</option>
                                                                    @elseif($item->categoria_id == 3)
                                                                        <option value="{{ $item->categoria_id }}">
                                                                            EPP</option>
                                                                    @elseif($item->categoria_id == 4)
                                                                        <option value="{{ $item->categoria_id }}">
                                                                            Herramientas
                                                                        </option>
                                                                    @elseif($item->categoria_id == 5)
                                                                        <option value="{{ $item->categoria_id }}">
                                                                            Combustibles
                                                                        </option>
                                                                    @elseif($item->categoria_id == 6)
                                                                        <option value="{{ $item->categoria_id }}">
                                                                            Vehiculo
                                                                        </option>
                                                                    @elseif($item->categoria_id == 7)
                                                                        <option value="{{ $item->categoria_id }}">
                                                                            Riego</option>
                                                                    @else
                                                                        <option value="{{ $item->categoria_id }}">
                                                                            Materia prima
                                                                        </option>
                                                                    @endif
                                                                </td>
                                                                <td class="px-4 text-sm font-medium whitespace-nowrap">
                                                                    @if ($item->unidadMedida == 0)
                                                                        <option value="{{ $item->unidadMedida }}">
                                                                            N/A</option>
                                                                    @elseif($item->unidadMedida == 1)
                                                                        <option value="{{ $item->unidadMedida }}">
                                                                            LITRO</option>
                                                                    @elseif($item->unidadMedida == 2)
                                                                        <option value="{{ $item->unidadMedida }}">
                                                                            KILO</option>
                                                                    @elseif($item->unidadMedida == 3)
                                                                        <option value="{{ $item->unidadMedida }}">
                                                                            UNIDAD</option>
                                                                    @else
                                                                        <option value="{{ $item->unidadMedida }}">
                                                                            METROS</option>
                                                                    @endif
                                                                </td>
                                                                <td class="px-4 text-sm font-medium whitespace-nowrap">
                                                                    {{ $item->item->marca }}
                                                                </td>
                                                                <td class="px-4 text-sm font-medium whitespace-nowrap">
                                                                    {{ $item->item->ingredienteActivo }}
                                                                </td>
                                                                <td
                                                                    class="px-12 text-sm font-medium whitespace-nowrap">
                                                                    {{ $item->item->capacidad }}
                                                                </td>

                                                                <td class="px-4 text-sm whitespace-nowrap">
                                                                    {{ $item->item->etiqueta }}
                                                                </td>


                                                                <td class="px-4 text-sm whitespace-nowrap">
                                                                    {{ $item->item->stockMinimo }}
                                                                </td>

                                                                <td class="px-4 text-sm whitespace-nowrap">
                                                                    {{ $item->item->observacion }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </x-modal>
                                        {{-- fin modal nuevo --}}
                                        {{-- fin tabla --}}
                                        {{-- fin filtro --}}
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        <select wire:model.defer="unidadMedida"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option value="0">L/K/U/M</option>
                                            <option value="1">
                                                LITRO</option>
                                            <option value="2">
                                                KILO</option>
                                            <option value="3">
                                                UNIDAD</option>
                                            <option value="4">
                                                METROS</option>
                                        </select>
                                    </td>
                                    <input type="hidden" value={{ $precio }} wire:model.defer="precio">
                                    <td class="w-48 font-bold text-center mt-3 border-2">
                                        <input type="text" wire:model.defer="contenido"
                                            class="w-full uppercase w-24 h-7">
                                    </td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">
                                        <input type="text" wire:model.defer="cantidad"
                                            class="w-full uppercase w-24 h-7">
                                    </td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">
                                        <input type="text" wire:model.defer="contenidoTotal"
                                            class="w-full uppercase w-24 h-7">
                                    </td>
                                    <td class="w-24 font-bold  mt-3 border-2">
                                        <input type="number" wire:model.defer="detalleEntrega"
                                            class="uppercase w-24 h-7 text-right">
                                    </td>
                                    <td class="w-10 font-bold text-center mt-3 border-2 p-2">
                                        @if ($visible)
                                            <a href="#" type="button" wire:click="AgregarLinea">
                                                <i class="fa-solid fa-plus text-primary-800"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lineaDetalle as $detalleEgreso)
                                    <tr>
                                        <td class="border-2">{{ $detalleEgreso->bodega->bodega }}</td>
                                        <td class="border-2">{{ $detalleEgreso->inventario->item->nombre }}</td>
                                        <td class="border-2">
                                            @if ($detalleEgreso->inventario->item->unidadMedida == 0)
                                                N/A
                                            @elseif($detalleEgreso->inventario->item->unidadMedida == 1)
                                                LITRO
                                            @elseif($detalleEgreso->inventario->item->unidadMedida == 2)
                                                KILO
                                            @elseif($detalleEgreso->inventario->item->unidadMedida == 3)
                                                UNIDAD
                                            @else
                                                METROS
                                            @endif
                                        </td>
                                        <td class="border-2">{{ $detalleEgreso->inventario->contenido }}</td>
                                        <td class="border-2">{{ $detalleEgreso->inventario->cantidad }}</td>
                                        <td class="border-2">{{ $detalleEgreso->inventario->contenidoTotal }}</td>
                                        <td class="border-2">{{ $detalleEgreso->detalleEntrega }}</td>
                                        <td class="border-2"><a href="#"><i
                                                    class="fa-solid fa-trash text-red-800"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-span-12 text-center">
                        <div class="text-center col-start-4 col-span-5 mb-8 shadow-lg">
                            <label class="font-bold">Observación Max 100 Caractéres,(Opcional)</label>
                            <textarea wire:model.defer="observacion" rows="1"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        <div class="col-start-1 text-left col-span-5">
                            <button type="button" wire:click="generarEgreso"
                                class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600">
                                Generar Guía de Despacho de Materiales
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
