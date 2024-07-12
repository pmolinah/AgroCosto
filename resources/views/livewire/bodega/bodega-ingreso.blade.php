<div>
    <div class="text-left w-full rounded-xl border border-gray-200 bg-white py-2 px-2 shadow-md shadow-neutral-800">
        <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
            <div>Ingreso Item, Factura o Guia de Despacho.</div>
        </div>
        <div class="mt-2">
            <div class="flex max-h-[600px] w-full flex-col overflow-y-scroll">
                {{-- inicio guia --}}
                <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 shadow-2xl">
                    <div class="col-span-2 font-bold p-2 mt-3 text-gray-700">
                        Factura/Guía Recepción a Bodega
                    </div>
                    <div class="col-span-1 p-2 mt-3 ml-2 text-gray-700">
                        Fecha
                    </div>
                    <div class="text-center col-span-2 p-2">
                        <input type="date" wire:model.defer="fechaGuia"
                            class="text-gray-700 h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                    </div>
                    <div class="col-span-3 p-2 ml-4 mt-2">
                        <select wire:model.defer="tipoDocumento_id"
                            class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Tipo Documento</option>
                            <option value="1">Guia Despacho</option>
                            <option value="2">Factura</option>
                        </select>
                    </div>
                    <div class="col-span-3 p-2 ml-4 mt-2">
                        <select wire:model.defer="proveedor_id" wire:change="SeleccionProveedor_id"
                            class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccionar Proveedor</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr
                    class="my-2 h-0 border border-t-0 border-solid border-neutral-700 opacity-25 dark:border-neutral-200" />
                <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 shadow-2xl p-5">
                    <div class="col-span-4 text-right mt-2 p-1">

                    </div>
                    <div class="col-span-2 text-right mt-2 p-1">
                        Factura/Guia N° <input type="hidden" wire:model.defer="ingresobodega_id">
                    </div>
                    <div class="col-span-6 font-bold text-primary-800 text-left">
                        <input type="number" wire:model.defer="NumFacGuia"
                            class="text-right uppercase h-10 border mt-1 rounded px-4 bg-gray-200">
                    </div>
                    <div class="col-span-4">

                    </div>
                    <div class="col-span-2 text-right mt-2 p-1">
                        <label class="p-1 font-medium">Propietario</label>
                    </div>
                    <div class="col-span-6 mt-1">
                        <select class="text-gray-700 h-10 border mt-1 rounded px-4 w-full bg-gray-50" name="empresa_id"
                            wire:model.defer="empresa_id" wire:change="SeleccionPropietario">
                            <option>Seleccione Propietario</option>
                            @foreach ($empresas as $empresa)
                                <option class="text-primary" value="{{ $empresa->id }}">
                                    Rut:{{ $empresa->rut }},Razón Social:{{ $empresa->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-4">
                    </div>
                    <div class="col-span-2 text-right mt-2 p-1">
                        <label class="p-1 font-medium">Campo</label>
                    </div>
                    <div class="col-span-6 mt-1">
                        <select class="text-gray-700 h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                            wire:model.defer="campo_id" wire:change="SeleccionCampo">
                            <option>Seleccionar Campo</option>
                            @foreach ($campoLista as $campo)
                                <option value="{{ $campo->id }}">{{ $campo->campo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12">
                    </div>
                    {{-- datos exportadora --}}
                    <div class="col-span-1 mt-7 p-1 text-left">
                        <label class="p-1 font-medium">Rut</label>
                    </div>
                    <div class="col-span-1 mt-6">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                            wire:model.defer="rut" value="">
                    </div>
                    <div class="col-span-1 mt-7 p-1">
                        <label class="p-1 font-medium">Proveedor.</label>
                    </div>
                    <div class="col-span-4 mt-6">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                            wire:model.defer="razon_social">
                    </div>
                    <div class="col-span-1 mt-8 p-1">
                        <label class="p-1 font-medium">Dirección</label>
                    </div>
                    <div class="col-span-4 mt-6">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                            wire:model.defer="direccion">
                    </div>
                    <div class="col-span-1 mt-2 p-1 text-left">
                        <label class="p-1 font-medium">Comuna</label>
                    </div>
                    <div class="col-span-4 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                            wire:model.defer="comuna">
                    </div>
                    <div class="col-span-1 mt-2 p-1">
                        <label class="p-1 font-medium">Email</label>
                    </div>
                    <div class="col-span-6 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                            wire:model.defer="email">
                    </div>
                    <div class="col-span-1 mt-2 p-1 text-left">
                        <label class="p-1 font-medium">Giro</label>
                    </div>
                    <div class="col-span-6 w-96 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                            wire:model.defer="giro">
                    </div>
                    <div class="col-span-5 mt-1">
                        <button type="button" wire:click="GrabarDocumento"
                            class="bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600 shadow-lg shadow-neutral-600">
                            Guardar Factura y Agregar Detalle
                        </button>
                    </div>
                    <div class="text-center col-span-12 mt-1">
                        <h6 class="col-span-2 font-bold p-2 mt-1">Detalle</h6>
                    </div>
                    <div class="col-span-12">
                        <table class="mt-3 border-2text-left">
                            <thead class="w-full mt-3 border-2">
                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-24 font-bold mt-3 border-2">Bodega</td>
                                    <td class="w-auto font-bold mt-3 border-2"><label class="mr-20">Detalle</label>
                                        <a href="#" wire:click="BuscarxFiltro">
                                            <i class="fa-solid fa-magnifying-glass inline-block p-1 ml-1"></i>
                                        </a>
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">U./Medida</td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">Presentacion</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">Contenido</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">Cant.</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">Precio/Unitario</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">Vencimiento</td>
                                    {{-- <td class="w-24 font-bold text-center mt-3 border-2">Fecha</td> --}}
                                    <td class="w-10 font-bold text-center mt-3 border-2">+/-</td>
                                    {{-- <td class="w-24 font-bold text-center mt-3 border-2 p-2"><i
                                            class="fa-solid fa-trash"></i></td> --}}
                                </tr>
                                <tr class="mt-3 border-2">
                                    <td class="text-center w-24 font-bold mt-3 border-2">
                                        <select wire:model.defer="bodega_id"
                                            class="inline-block w-24 rounded-md border-0 py-1.5 text-center text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Bodega</option>
                                            @foreach ($bodegas as $bodega)
                                                <option value="{{ $bodega->id }}">{{ $bodega->bodega }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="w-auto font-bold mt-3 border-2">
                                        <select wire:model.defer="item_id" wire:change="CambiaSeleccionItem"
                                            class="inline-block w-72 rounded-md border-0 py-1.5 text-center text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Items</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                            @endforeach
                                        </select>
                                        {{-- fin --}}
                                        {{-- nuevo modal --}}
                                        <x-modal wire:model="visibleItem" maxWidth="2xl">
                                            <div class="p-2 overflow-x-auto">
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
                                                        @foreach ($ItemsBuscador as $item)
                                                            <tr>
                                                                <td class="text-center text-yellow-300">
                                                                    <a href="#" {{-- wire:click="Seleccion({{ $item->id }})"><i --}}
                                                                        wire:click="Seleccion({{ json_encode(['cod' => $item->QrBarra, 'id' => $item->id, 'um' => $item->unidadMedida, 'pres' => $item->presentacion]) }})"><i
                                                                            class="fa-solid fa-plus"></i></a>
                                                                </td>
                                                                <td class="px-4 text-sm font-medium whitespace-nowrap">
                                                                    {{ $item->nombre }}
                                                                </td>
                                                                <td class="px-4 text-sm font-medium whitespace-nowrap">
                                                                    {{ $item->QrBarra }}
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
                                                                    {{ $item->marca }}
                                                                </td>
                                                                <td class="px-4 text-sm font-medium whitespace-nowrap">
                                                                    {{ $item->ingredienteActivo }}
                                                                </td>
                                                                {{-- <td
                                                                    class="px-12 text-sm font-medium whitespace-nowrap">
                                                                    {{ $item->presentacion }}
                                                                </td>
                                                                <td
                                                                    class="px-12 text-sm font-medium whitespace-nowrap">
                                                                    {{ $item->contenido }}
                                                                </td> --}}
                                                                <td
                                                                    class="px-12 text-sm font-medium whitespace-nowrap">
                                                                    {{ $item->capacidad }}
                                                                </td>

                                                                <td class="px-4 text-sm whitespace-nowrap">
                                                                    {{ $item->etiqueta }}
                                                                </td>


                                                                <td class="px-4 text-sm whitespace-nowrap">
                                                                    {{ $item->stockMinimo }}
                                                                </td>

                                                                <td class="px-4 text-sm whitespace-nowrap">
                                                                    {{ $item->observacion }}
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
                                    <td class="w-48 font-bold text-center mt-3 border-2">
                                        <input type="text" wire:model.defer="presentacion"
                                            class="w-full uppercase w-24 h-7">
                                    </td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">
                                        <input type="text" wire:model.defer="contenido"
                                            class="w-full uppercase w-24 h-7">
                                    </td>
                                    <td class="w-24 font-bold  mt-3 border-2">
                                        <input type="number" wire:model.defer="cantidad"
                                            class="uppercase w-24 h-7 text-right">


                                    </td>
                                    <td class="w-24font-bold mt-3 border-2">
                                        <input type="number" wire:model.defer="precio" wire:change="ObtenerTotal"
                                            class="uppercase w-24 h-7 text-right">


                                    </td>
                                    {{-- <td class="text-center w-24 font-bold mt-3 border-2"><input type="number"
                                            wire:model.defer="total" class="uppercase w-24 h-7 text-right"></td> --}}
                                    <td class="text-center w-28 font-bold mt-3 border-2"><input type="date"
                                            wire:model.defer="vencimiento" class="uppercase w-28 h-7 text-right"></td>
                                    <td class="w-10 font-bold text-center mt-3 border-2 p-2">
                                        @if ($visibleDetalle)
                                            <a href="#" type="button" wire:click="AgregarLinea">
                                                <i class="fa-solid fa-plus text-primary-800"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalleIngresos as $detalleIngreso)
                                    <tr class="mt-3 border-2">
                                        <td class="font-bold text-center mt-3 border-2">
                                            {{ $detalleIngreso->bodega->bodega }}
                                        </td>
                                        <td class="font-bold text-center mt-3 border-2">
                                            {{ $detalleIngreso->item->nombre }}
                                        </td>

                                        <td class="font-bold text-center mt-3 border-2">

                                            @if ($detalleIngreso->item->unidadMedida == 0)
                                                N/A
                                            @elseif($detalleIngreso->item->unidadMedida == 1)
                                                LITRO
                                            @elseif($detalleIngreso->item->unidadMedida == 2)
                                                KILO
                                            @elseif($detalleIngreso->item->unidadMedida == 3)
                                                UNIDAD
                                            @else
                                                METROS
                                            @endif
                                        </td>
                                        <td class="font-bold text-center mt-3 border-2">
                                            {{ $detalleIngreso->presentacion }}
                                        </td>
                                        <td class="font-bold text-center mt-3 border-2">
                                            {{ $detalleIngreso->contenido }}
                                        </td>
                                        <td class="font-bold text-center mt-3 border-2">
                                            {{ $detalleIngreso->cantidad }}
                                        </td>
                                        <td class="font-bold text-center mt-3 border-2">
                                            {{ $detalleIngreso->precioUnitario }}
                                        </td>
                                        <td class="font-bold text-center mt-3 border-2">
                                            {{ $detalleIngreso->vencimiento }}
                                        </td>

                                        <td class="font-bold text-center mt-3 border-2">
                                            <a href="#" type="button"
                                                wire:click="QuitarLinea({{ $detalleIngreso->id }},{{ $detalleIngreso->item_id }})">

                                                <i class="fa-solid fa-trash text-red-800"></i>
                                            </a>
                                        </td>
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
                            <button type="button" wire:click="generarGuiaIngresoBodega"
                                class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600">
                                Generar Guía de Recepción e Ingreso a Bodega
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
