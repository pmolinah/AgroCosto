<div>
    <div class="grid grid-cols-12 gap-2 text-left">
        <div class="col-span-5  shadow-lg rounded-lg shadow-neutral-500">
            {{-- crud bodega nuevo --}}
            <div class="bg-white shadow rounded-lg">
                <div class="mb-4 flex items-center justify-between bg-neutral-200 p-1">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Bodegas</h3>
                        {{-- <span class="text-base font-normal text-gray-500">Cree Bodegas, Espacios acopio de
                            Items</span> --}}
                    </div>
                    <div class="flex-shrink-0">
                        <button type="button" class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600"
                            data-te-toggle="modal" data-te-target="#exampleModalCenterBodega" data-te-ripple-init
                            data-te-ripple-color="light">
                            <i class="far fa-plus"></i> </a>
                        </button>
                        <input type="text" wire:model="search" class="h-10 border mt-1 rounded px-4 bg-gray-50"
                            id="exampleFormControlInput1" placeholder="Buscar" />
                    </div>
                </div>
                <div class="flex flex-col mt-2">
                    <div class="overflow-x-auto rounded-lg">
                        <div class="align-middle inline-block min-w-full">
                            <div class="shadow overflow-hidden sm:rounded-lg p-1">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th scope="col"
                                                class="p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Bodega
                                            </th>
                                            <th scope="col"
                                                class="p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Ubicacion
                                            </th>
                                            <th scope="col"
                                                class="text-center p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Accion
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($bodegas as $Bodega)
                                            <tr class="border-b dark:border-neutral-500 hover:bg-neutral-100">

                                                <td class="p-1 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    {{ $Bodega->bodega }}</td>
                                                <td class="p-1 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    {{ $Bodega->campo->campo }}</td>
                                                {{-- <td class="whitespace-nowrap">{{ $Bodega->encargado_id }}</td> --}}
                                                {{-- <td
                                                    class="whitespace-nowrap hidden sm:hidden md:block xl:block  px-6 py-11">
                                                    {{ $Bodega->observacion }}</td> --}}

                                                <td
                                                    class="text-center p-1 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    <a href="#" wire:click="EliminarBodega({{ $Bodega->id }})">
                                                        <i class="far fa-trash"></i> </a>
                                                    <a href="#" wire:click="EditarBodega({{ $Bodega }})">
                                                        <i class="far fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-1">
                                    {{ $bodegas->links('pagination::tailwind') }}
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- fin --}}
        </div>
        <div class="col-span-7  shadow-lg rounded-lg shadow-neutral-500">
            {{-- crud bodega nuevo --}}
            <div class="bg-white shadow rounded-lg">
                <div class="mb-4 flex items-center justify-between bg-neutral-200 p-1">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Items</h3>
                        {{-- <span class="text-base font-normal text-gray-500">Cree Bodegas, Espacios acopio de
                            Items</span> --}}
                    </div>
                    <div class="flex-shrink-0">
                        <button type="button" class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600"
                            data-te-toggle="modal" data-te-target="#exampleModalCenterItems" data-te-ripple-init
                            data-te-ripple-color="light">
                            <i class="far fa-plus"></i>
                        </button>
                        <input type="text" wire:model="search" class="h-10 border mt-1 rounded px-4 bg-gray-50"
                            id="exampleFormControlInput1" placeholder="Buscar" />
                    </div>
                </div>
                <div class="flex flex-col mt-2">
                    <div class="overflow-x-auto rounded-lg">
                        <div class="align-middle inline-block min-w-full">
                            <div class="shadow overflow-hidden sm:rounded-lg p-1">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th scope="col"
                                                class="p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Item
                                            </th>
                                            <th scope="col"
                                                class="p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Tipo
                                            </th>
                                            <th scope="col"
                                                class="text-center p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Categoria
                                            </th>
                                            <th scope="col"
                                                class="text-center p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Clasificacion
                                            </th>
                                            <th scope="col"
                                                class="text-center p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($items as $item)
                                            <tr class="border-b dark:border-neutral-500 hover:bg-neutral-100">

                                                <td class="p-1 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    {{ $item->nombre }}</td>
                                                <td class="p-1 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    @if ($item->tipo_id == 1)
                                                        Insumo
                                                    @elseif($item->tipo_id == 2)
                                                        Equipos
                                                    @elseif($item->tipo_id == 3)
                                                        Productos
                                                    @else
                                                        Suministros
                                                    @endif

                                                <td class="p-1 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    @if ($item->categoria_id == 0)
                                                        N/A
                                                    @elseif($item->categoria_id == 1)
                                                        Quimicos
                                                    @elseif($item->categoria_id == 2)
                                                        Cosecha
                                                    @elseif($item->categoria_id == 3)
                                                        EPP
                                                    @elseif($item->categoria_id == 4)
                                                        Herramientas
                                                    @elseif($item->categoria_id == 5)
                                                        Combustibles
                                                    @elseif($item->categoria_id == 6)
                                                        Vehiculo
                                                    @elseif($item->categoria_id == 7)
                                                        Riego
                                                    @else
                                                        Materia Prima
                                                    @endif
                                                </td>
                                                <td class="p-1 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    @if ($item->clasificacion_id == 0)
                                                        N/A
                                                    @elseif($item->clasificacion_id == 1)
                                                        Riego Bajo
                                                    @elseif($item->clasificacion_id == 2)
                                                        Riego Medio
                                                    @elseif($item->clasificacion_id == 3)
                                                        Riego Alto
                                                    @elseif($item->clasificacion_id == 4)
                                                        Riesgo Quimico
                                                    @else
                                                        Combustibles
                                                    @endif
                                                </td>


                                                <td
                                                    class="text-center p-1 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    <a href="#" wire:click="EliminarItem({{ $item->id }})">
                                                        <i class="far fa-trash"></i> </a>
                                                    {{-- <a href="#" wire:click="EditarItem({{ $item->id }})">
                                                        <i class="far fa-edit"></i></a> --}}

                                                    {{-- <a href="#" wire:click="EditarItem({{ $item->id }})">
                                                        <i class="far fa-edit"></i>
                                                    </a> --}}
                                                    <a href="#" data-te-toggle="modal"
                                                        data-te-target="#exampleModalCenterItem{{ $item->id }}"
                                                        data-te-ripple-init>
                                                        <i class="far fa-edit"></i> </a>

                                                    {{-- formulario de edicion --}}
                                                    <form action="{{ route('item.update') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @CSRF
                                                        <!-- Button trigger vertically centered modal-->
                                                        <div
                                                            class="grid sm:grid-cols-1 md:grid-cols-3 borde-neutral-800">
                                                            <!--Verically centered modal-->
                                                            <div data-te-modal-init
                                                                class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                                                                data-te-backdrop="static" data-te-keyboard="false"
                                                                id="exampleModalCenterItem{{ $item->id }}"
                                                                tabindex="-1" aria-labelledby="exampleModalCenterTitle"
                                                                aria-modal="true" role="dialog">
                                                                <div data-te-modal-dialog-ref
                                                                    class="p-2 pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                                                                    <div
                                                                        class="pointer-events-auto relative flex w-full flex-col rounded-md  bg-neutral-100 bg-clip-padding text-current shadow-lg">
                                                                        <div
                                                                            class="flex  items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-1 dark:border-opacity-50">
                                                                            <!--Modal title-->
                                                                            <h5
                                                                                class="text-xl font-medium leading-normal">
                                                                                Edicion Item
                                                                                <input type="hidden"
                                                                                    value="{{ $item->id }}"
                                                                                    name="item_id">
                                                                            </h5>
                                                                            <!--Close button-->
                                                                            <button type="button"
                                                                                class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                                                                                data-te-modal-dismiss
                                                                                aria-label="Close">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    fill="none" viewBox="0 0 24 24"
                                                                                    stroke-width="1.5"
                                                                                    stroke="currentColor"
                                                                                    class="h-6 w-6">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        d="M6 18L18 6M6 6l12 12" />
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                        <!--Modal body-->
                                                                        <div class="text-left p-1 ml-2 mr-2">
                                                                            Codigo Barra o QR
                                                                            <div class="relative"
                                                                                data-te-input-wrapper-init>
                                                                                <input type="text" name="QrBarra"
                                                                                    value="{{ $item->QrBarra }}"
                                                                                    class="h-7 border rounded px-4 w-full bg-gray-50" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-left p-1 ml-2 mr-2">
                                                                            Nombre Item
                                                                            <div class="relative"
                                                                                data-te-input-wrapper-init>
                                                                                <input type="text" name="nombre"
                                                                                    value="{{ $item->nombre }}"
                                                                                    class="h-7 border rounded px-4 w-full bg-gray-50" />
                                                                            </div>
                                                                        </div>
                                                                        <div class=" p-1 text-neutral-900 ml-2 mr-2">
                                                                            <select
                                                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                                                                id="tipo_id" name="tipo_id">
                                                                                @if ($item->tipo_id == 1)
                                                                                    <option
                                                                                        value="{{ $item->tipo_id }}">
                                                                                        Insumo</option>
                                                                                @elseif($item->tipo_id == 2)
                                                                                    <option
                                                                                        value="{{ $item->tipo_id }}">
                                                                                        Equipos</option>
                                                                                @elseif($item->tipo_id == 3)
                                                                                    <option
                                                                                        value="{{ $item->tipo_id }}">
                                                                                        Productos</option>
                                                                                @else
                                                                                    <option
                                                                                        value="{{ $item->tipo_id }}">
                                                                                        Suministros</option>
                                                                                @endif
                                                                                <option class="text-neutral-900">
                                                                                    Seleccione Tipo Item</option>
                                                                                <option class="text-primary"
                                                                                    value="1">Insumo</option>
                                                                                <option class="text-primary"
                                                                                    value="2">Equipos</option>
                                                                                <option class="text-primary"
                                                                                    value="3">Productos</option>
                                                                                <option class="text-primary"
                                                                                    value="4">Suministros</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="text-left p-1 ml-2 mr-2">
                                                                            Marca
                                                                            <div class="relative"
                                                                                data-te-input-wrapper-init>
                                                                                <input type="text" name="marca"
                                                                                    value="{{ $item->marca }}"
                                                                                    class="h-7 border rounded px-4 w-full bg-gray-50" />
                                                                            </div>
                                                                        </div>
                                                                        <div class=" p-1 text-neutral-900 ml-2 mr-2">
                                                                            <select
                                                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                                                                name="unidadMedida">
                                                                                @if ($item->unidadMedida == 0)
                                                                                    <option
                                                                                        value="{{ $item->tipo_id }}">
                                                                                        N/A</option>
                                                                                @elseif($item->unidadMedida == 1)
                                                                                    <option
                                                                                        value="{{ $item->tipo_id }}">
                                                                                        LITRO</option>
                                                                                @elseif($item->unidadMedida == 2)
                                                                                    <option
                                                                                        value="{{ $item->unidadMedida }}">
                                                                                        KILO</option>
                                                                                @elseif($item->unidadMedida == 3)
                                                                                    <option
                                                                                        value="{{ $item->unidadMedida }}">
                                                                                        UNIDAD</option>
                                                                                @else
                                                                                    <option
                                                                                        value="{{ $item->unidadMedida }}">
                                                                                        METROS</option>
                                                                                @endif
                                                                                <option class="text-primary"
                                                                                    value="0">N/A</option>
                                                                                <option class="text-primary"
                                                                                    value="1">Litro</option>
                                                                                <option class="text-primary"
                                                                                    value="2">Kilo</option>
                                                                                <option class="text-primary"
                                                                                    value="3">Unidad</option>
                                                                                <option class="text-primary"
                                                                                    value="4">Metro</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="text-left p-1 ml-2 mr-2">
                                                                            Ingrediente Activo
                                                                            <div class="relative"
                                                                                data-te-input-wrapper-init>
                                                                                <input type="text"
                                                                                    value="{{ $item->ingredienteActivo }}"
                                                                                    name="ingredienteActivo"
                                                                                    class="h-7 border rounded px-4 w-full bg-gray-50" />
                                                                            </div>
                                                                        </div>
                                                                        {{-- <div class="text-left p-1 ml-2 mr-2">
                                                                            Presentacion
                                                                            <div class="relative"
                                                                                data-te-input-wrapper-init>
                                                                                <input type="text"
                                                                                    value="{{ $item->presentacion }}"
                                                                                    name="presentacion"
                                                                                    class="h-7 border rounded px-4 w-full bg-gray-50" />
                                                                            </div>
                                                                        </div> --}}
                                                                        {{-- <div class="text-left p-1 ml-2 mr-2">
                                                                            Presentacion Contenido en Unidad de Medida
                                                                            <div class="relative"
                                                                                data-te-input-wrapper-init>
                                                                                <input type="number" name="contenido"
                                                                                    value="{{ $item->contenido }}"
                                                                                    class="h-7 border rounded px-4 w-full bg-gray-50" />
                                                                            </div>
                                                                        </div> --}}
                                                                        <div class="text-left p-1 ml-2 mr-2">
                                                                            Capacidad(Equipos)
                                                                            <div class="relative"
                                                                                data-te-input-wrapper-init>
                                                                                <input type="text" name="capacidad"
                                                                                    value="{{ $item->capacidad }}"
                                                                                    class="h-7 border rounded px-4 w-full bg-gray-50" />
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class=" p-1 text-center text-neutral-900 ml-2 mr-2">
                                                                            <select
                                                                                class="inline-block w-56 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                                                                name="clasificacion_id">
                                                                                @if ($item->clasificacion_id == 0)
                                                                                    <option
                                                                                        value="{{ $item->clasificacion_id }}">
                                                                                        N/A</option>
                                                                                @elseif($item->clasificacion_id == 1)
                                                                                    <option
                                                                                        value="{{ $item->clasificacion_id }}">
                                                                                        Riesgo Bajo</option>
                                                                                @elseif($item->clasificacion_id == 3)
                                                                                    <option
                                                                                        value="{{ $item->clasificacion_id }}">
                                                                                        Riesgo Medio</option>
                                                                                @elseif($item->clasificacion_id == 4)
                                                                                    <option
                                                                                        value="{{ $item->clasificacion_id }}">
                                                                                        Riesgo Alto</option>
                                                                                @else
                                                                                    <option
                                                                                        value="{{ $item->clasificacion_id }}">
                                                                                        Riesgo Quimico</option>
                                                                                @endif

                                                                                <option class="text-primary"
                                                                                    value="0">N/A</option>
                                                                                <option class="text-primary"
                                                                                    value="1">Riesgo Bajo</option>
                                                                                <option class="text-primary"
                                                                                    value="2">Riesgo Medio
                                                                                </option>
                                                                                <option class="text-primary"
                                                                                    value="3">Riesgo Alto</option>
                                                                                <option class="text-primary"
                                                                                    value="4">Riesgo Quimico
                                                                                </option>
                                                                            </select>
                                                                            <select
                                                                                class="inline-block w-56 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                                                                name="categoria_id">
                                                                                @if ($item->categoria_id == 1)
                                                                                    <option
                                                                                        value="{{ $item->categoria_id }}">
                                                                                        Quimicos</option>
                                                                                @elseif($item->categoria_id == 2)
                                                                                    <option
                                                                                        value="{{ $item->categoria_id }}">
                                                                                        Cosecha</option>
                                                                                @elseif($item->categoria_id == 3)
                                                                                    <option
                                                                                        value="{{ $item->categoria_id }}">
                                                                                        EPP</option>
                                                                                @elseif($item->categoria_id == 4)
                                                                                    <option
                                                                                        value="{{ $item->categoria_id }}">
                                                                                        Herramientas</option>
                                                                                @elseif($item->categoria_id == 5)
                                                                                    <option
                                                                                        value="{{ $item->categoria_id }}">
                                                                                        Combustibles</option>
                                                                                @elseif($item->categoria_id == 6)
                                                                                    <option
                                                                                        value="{{ $item->categoria_id }}">
                                                                                        Vehiculo</option>
                                                                                @elseif($item->categoria_id == 7)
                                                                                    <option
                                                                                        value="{{ $item->categoria_id }}">
                                                                                        Riego</option>
                                                                                @else
                                                                                    <option
                                                                                        value="{{ $item->categoria_id }}">
                                                                                        Materia prima</option>
                                                                                @endif
                                                                                <option class="text-primary"
                                                                                    value="1">Quimicos</option>
                                                                                <option class="text-primary"
                                                                                    value="2">Cosecha</option>
                                                                                <option class="text-primary"
                                                                                    value="3">EPP</option>
                                                                                <option class="text-primary"
                                                                                    value="4">Herramientas
                                                                                </option>
                                                                                <option class="text-primary"
                                                                                    value="5">Combustibles
                                                                                </option>
                                                                                <option class="text-primary"
                                                                                    value="6">Vehiculo</option>
                                                                                <option class="text-primary"
                                                                                    value="7">Riego</option>
                                                                                <option class="text-primary"
                                                                                    value="8">Materia prima
                                                                                </option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="text-left p-1 ml-2 mr-2">
                                                                            Etiqueta Actual: <a
                                                                                href="../Archivos/Cargados/Etiquetas/{{ $item->tipo_id }}/{{ $item->etiqueta }}"target="_blank">{{ $item->etiqueta }}<i
                                                                                    class="far fa-search text-red-700"></i></a>
                                                                            <div class="relative"
                                                                                data-te-input-wrapper-init>
                                                                                <input type="file" name="file"
                                                                                    value="{{ $item->etiqueta }}"
                                                                                    class="h-7 border rounded px-4 w-full bg-gray-50" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-left p-1 ml-2 mr-2">
                                                                            Stok Minimo
                                                                            <div class="relative"
                                                                                data-te-input-wrapper-init>
                                                                                <input type="number"
                                                                                    name="stockMinimo"
                                                                                    value="{{ $item->stockMinimo }}"
                                                                                    class="h-7 border rounded px-4 w-full bg-gray-50" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-left p-1 ml-2 mr-2">
                                                                            Observación
                                                                            <div class="relative mb-3"
                                                                                data-te-input-wrapper-init>
                                                                                <textarea name="observacion"
                                                                                    class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                                                                    rows="2">{{ $item->observacion }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <!--Modal footer-->
                                                                        <div class=" m-3">
                                                                            <button type="button"
                                                                                class="bg-gray-400 text-white  py-2 px-4 rounded hover:bg-gray-900 ml-10 ml-2"
                                                                                data-te-modal-dismiss>
                                                                                Cerrar
                                                                            </button>

                                                                            <button type="submit"
                                                                                class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-900"
                                                                                data-te-modal-dismiss>
                                                                                Actualizar Item
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </form>
                                                    {{-- fin edicion --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-1">
                                    {{ $items->links('pagination::tailwind') }}
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- fin --}}
        </div>
        <div class="col-span-12 mt-5 shadow-lg rounded-lg shadow-neutral-500">
            {{-- crud bodega nuevo --}}
            <div class="bg-white shadow rounded-lg">
                <div class="mb-4 flex items-center justify-between bg-neutral-200 p-1">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Inventario</h3>
                        {{-- <span class="text-base font-normal text-gray-500">Cree Bodegas, Espacios acopio de
                            Items</span> --}}
                    </div>
                    <div class="flex-shrink-0">
                        {{-- <button type="button" class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600"
                            data-te-toggle="modal" data-te-target="#exampleModalCenterBodega" data-te-ripple-init
                            data-te-ripple-color="light">
                            Nueva Bodega
                        </button> --}}
                        <input type="text" wire:model="search" class="h-10 border mt-1 rounded px-4 bg-gray-50"
                            id="exampleFormControlInput1" placeholder="Buscar" />
                    </div>
                </div>
                <div class="flex flex-col mt-2">
                    <div class="overflow-x-auto rounded-lg">
                        <div class="align-middle inline-block min-w-full">
                            <div class="shadow overflow-hidden sm:rounded-lg p-1">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th scope="col"
                                                class="p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Item
                                            </th>
                                            <th scope="col"
                                                class="p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Bodega
                                            </th>
                                            <th scope="col"
                                                class="text-center p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Stock Real
                                            </th>
                                            <th scope="col"
                                                class="text-center p-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Stock Requerido
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($inventarios as $inventario)
                                            <tr class="border-b dark:border-neutral-500 hover:bg-neutral-100">

                                                <td class="p-1 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    {{ $inventario->item->nombre }}</td>
                                                <td class="p-1 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    {{ $inventario->bodega->bodega }}</td>
                                                {{-- <td class="whitespace-nowrap">{{ $Bodega->encargado_id }}</td> --}}
                                                {{-- <td
                                                    class="whitespace-nowrap hidden sm:hidden md:block xl:block  px-6 py-11">
                                                    {{ $Bodega->observacion }}</td> --}}
                                                <!-- component -->
                                                <td class="p-1 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    <div class="relative pt-1">

                                                        <div
                                                            class="overflow-hidden h-4  text-xs flex rounded bg-gray-200">
                                                            @php
                                                                $valor = 0;

                                                                $valor = ($inventario->suma_cantidad * 100) / $inventario->stockMinimo;
                                                            @endphp
                                                            <div>Stock:{{ $inventario->suma_cantidad }}</div>
                                                            <div style="width: 10%" class="text-left mx-2 text-bold">
                                                                {{ $valor }}%
                                                            </div>
                                                            @if ($valor < 45)
                                                                <div style="width: 10%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-100">
                                                                </div>
                                                            @elseif($valor > 44 && $valor < 65)
                                                                <div style="width: 10%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-100">
                                                                </div>
                                                                <div style="width: 15%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-300">
                                                                </div>
                                                            @elseif($valor > 64 && $valor < 85)
                                                                <div style="width: 10%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-100">
                                                                </div>
                                                                <div style="width: 15%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-300">
                                                                </div>
                                                                <div style="width: 20%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                                                </div>
                                                            @elseif($valor > 84 && $valor < 99)
                                                                <div style="width: 10%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-100">
                                                                </div>
                                                                <div style="width: 15%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-300">
                                                                </div>
                                                                <div style="width: 20%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                                                </div>
                                                                <div style="width: 25%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-700">
                                                                </div>
                                                            @elseif($valor > 99)
                                                                <div style="width: 10%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-100">
                                                                </div>
                                                                <div style="width: 15%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-300">
                                                                </div>
                                                                <div style="width: 20%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                                                </div>
                                                                <div style="width: 25%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-700">
                                                                </div>
                                                                <div style="width: 10%"
                                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-900">
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </td>
                                                <td
                                                    class="text-center p-1 whitespace-nowrap text-sm font-normal text-gray-900">
                                                    {{-- <a href="#"
                                                        wire:click="EliminarBodega({{ $Bodega->id }})">
                                                        <i class="far fa-trash"></i> </a>
                                                    <a href="#" wire:click="EditarBodega({{ $Bodega }})">
                                                        <i class="far fa-edit"></i></a> --}}
                                                    {{ $inventario->stockMinimo }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-1">
                                    {{ $bodegas->links('pagination::tailwind') }}
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- fin --}}
        </div>
    </div>
    <div>
        {{-- caja creacion modal y edicion --}}
        <div class="space-y-2">
            <!-- Button trigger vertically centered modal-->
            <div class="grid sm:grid-cols-1 md:grid-cols-3 borde-neutral-800">
                <!--Verically centered modal-->
                <div data-te-modal-init
                    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                    data-te-backdrop="static" data-te-keyboard="false" id="exampleModalCenterBodega" tabindex="-1"
                    aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                    <div data-te-modal-dialog-ref
                        class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                        <div
                            class="pointer-events-auto relative flex w-full flex-col rounded-md  bg-neutral-100 bg-clip-padding text-current shadow-lg">
                            <div
                                class="flex  items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                <!--Modal title-->
                                <h5 class="text-xl font-medium leading-normal">
                                    Nueva Bodega
                                </h5>
                                <!--Close button-->
                                <button type="button"
                                    class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                                    data-te-modal-dismiss aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <!--Modal body-->
                            <div class="text-left p-4">
                                Bodega
                                <div class="relative" data-te-input-wrapper-init>
                                    <input type="text" wire:model.defer="bodega"
                                        class="h-7 border rounded px-4 w-full bg-gray-50" />
                                </div>
                            </div>
                            <div class=" p-4 text-neutral-900">
                                <select
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                    id="empresa_id" name="empresa_id">

                                    <option class="text-neutral-900">Seleccione Empresa Principal</option>
                                    @foreach ($empresas as $empresa)
                                        <option class="text-primary" value="{{ $empresa->id }}">
                                            {{ $empresa->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="p-4 text-neutral-900">
                                <select
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                    name="campo_id" wire:model.defer="campo_id" id="campo_id">
                                    <option class="text-neutral-900">Seleccione Campo</option>
                                </select>
                            </div>
                            <div class=" p-4 text-neutral-90">
                                <select
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                    wire:model.defer='encargado_id'>

                                    <option class="text-secondary" value=" ">Seleccione Encargado.</option>
                                    @foreach ($encargados as $encargado)
                                        <option class="text-primary" value="{{ $encargado->id }}">
                                            {{ $encargado->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-left p-4">
                                Observación
                                <div class="relative mb-3" data-te-input-wrapper-init>
                                    <textarea wire:model.defer="observacion"
                                        class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        rows="3"></textarea>
                                </div>
                            </div>
                            <!--Modal footer-->
                            <div
                                class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                <button type="button" wire:click="Limpiar"
                                    class="bg-gray-400 text-white  py-2 px-4 rounded hover:bg-gray-900 ml-10"
                                    data-te-modal-dismiss>
                                    Cerrar
                                </button>

                                <button type="button" wire:click="GuardarBodega"
                                    class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-900"
                                    data-te-modal-dismiss>
                                    Guardar Bodega
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Modal title editar bodega-->
                <x-modal wire:model="open_editBodega" @click.away="false">
                    <h5 class="text-left p-3 text-xl font-medium leading-normal bg-neutral-200">

                        Edición de Bodega
                    </h5>
                    <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
                    <div class="relative p-4 text-left">
                        Bodega <input type="hidden" wire:model.defer="edit_idBodega">
                        <div class="relative mb-3" data-te-input-wrapper-init>
                            <input type="text" wire:model.defer="bodega"
                                class="h-7 border mt-1 rounded px-4 w-full bg-gray-50" />
                        </div>
                    </div>
                    <div class="p-4 text-left">
                        Propietario
                        <select wire:change="SelectEmpresaxCampo" wire:model="empresa_id"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option class="text-secondary" value=" ">Seleccione Propietario.</option>
                            @foreach ($empresas as $empresa)
                                <option class="text-primary" value="{{ $empresa->id }}">
                                    {{ $empresa->razon_social }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="p-4 text-left">
                        Campo Actual
                        <select wire:model.defer="campo_id"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option class="text-neutral-900" value="{{ $campoId }}">{{ $campo_nombre }}
                            </option>
                            @foreach ($campos as $campo)
                                <option class="text-primary" value="{{ $campo->id }}">{{ $campo->campo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="p-4 text-left">
                        Observacion <input type="hidden" wire:model.defer="observacion">
                        <div class="relative mb-3" data-te-input-wrapper-init>
                            <input type="text" wire:model.defer="bodega"
                                class="h-7 border mt-1 rounded px-4 w-full bg-gray-50" />
                        </div>
                    </div>
                    <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
                    <div class=" p-3">
                        <button type="button" wire:click="ActualizarBodega"
                            class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600" data-te-ripple-init
                            data-te-ripple-color="light" data-te-modal-dismiss>
                            Actualizar Bodega
                        </button>
                        <button type="button" wire:click="Limpiar"
                            class="ml-1 inline-block rounded bg-primary-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                            data-te-ripple-init data-te-ripple-color="light" data-te-modal-dismiss>
                            Cerrar
                        </button>
                    </div>
                </x-modal>
            </div>
        </div>
        {{-- fin caja --}}
        {{-- caja creacion modal de Items --}}
        <div class="">
            <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
                @CSRF
                <!-- Button trigger vertically centered modal-->
                <div class="grid sm:grid-cols-1 md:grid-cols-3 borde-neutral-800">
                    <!--Verically centered modal-->
                    <div data-te-modal-init
                        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                        data-te-backdrop="static" data-te-keyboard="false" id="exampleModalCenterItems"
                        tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                        <div data-te-modal-dialog-ref
                            class="p-2 pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                            <div
                                class="pointer-events-auto relative flex w-full flex-col rounded-md  bg-neutral-100 bg-clip-padding text-current shadow-lg">
                                <div
                                    class="flex  items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-1 dark:border-opacity-50">
                                    <!--Modal title-->
                                    <h5 class="text-xl font-medium leading-normal">
                                        Nuevo Item
                                    </h5>
                                    <!--Close button-->
                                    <button type="button"
                                        class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                                        data-te-modal-dismiss aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <!--Modal body-->
                                <div class="text-left p-1 ml-2 mr-2">
                                    Codigo Barra o QR
                                    <div class="relative" data-te-input-wrapper-init>
                                        <input type="text" name="QrBarra"
                                            class="h-7 border rounded px-4 w-full bg-gray-50" />
                                    </div>
                                </div>
                                <div class="text-left p-1 ml-2 mr-2">
                                    Nombre Item
                                    <div class="relative" data-te-input-wrapper-init>
                                        <input type="text" name="nombre"
                                            class="h-7 border rounded px-4 w-full bg-gray-50" />
                                    </div>
                                </div>
                                <div class=" p-1 text-neutral-900 ml-2 mr-2">
                                    <select
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                        id="tipo_id" name="tipo_id">
                                        <option class="text-neutral-900">Seleccione Tipo Item</option>
                                        <option class="text-primary" value="1">Insumo</option>
                                        <option class="text-primary" value="2">Equipos</option>
                                        <option class="text-primary" value="3">Productos</option>
                                        <option class="text-primary" value="4">Suministros</option>
                                    </select>
                                </div>
                                <div class="text-left p-1 ml-2 mr-2">
                                    Marca
                                    <div class="relative" data-te-input-wrapper-init>
                                        <input type="text" name="marca"
                                            class="h-7 border rounded px-4 w-full bg-gray-50" />
                                    </div>
                                </div>
                                <div class=" p-1 text-neutral-900 ml-2 mr-2">
                                    <select
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                        name="unidadMedida">
                                        <option class="text-neutral-900">Seleccione Unidad de Medida</option>
                                        <option class="text-primary" value="0">N/A</option>
                                        <option class="text-primary" value="1">Litro</option>
                                        <option class="text-primary" value="2">Kilo</option>
                                        <option class="text-primary" value="3">Unidad</option>
                                        <option class="text-primary" value="4">Metro</option>
                                    </select>
                                </div>
                                <div class="text-left p-1 ml-2 mr-2">
                                    Ingrediente Activo
                                    <div class="relative" data-te-input-wrapper-init>
                                        <input type="text" name="ingredienteActivo"
                                            class="h-7 border rounded px-4 w-full bg-gray-50" />
                                    </div>
                                </div>
                                {{-- <div class="text-left p-1 ml-2 mr-2">
                                    Presentacion
                                    <div class="relative" data-te-input-wrapper-init>
                                        <input type="text" name="presentacion"
                                            class="h-7 border rounded px-4 w-full bg-gray-50" />
                                    </div>
                                </div>
                                <div class="text-left p-1 ml-2 mr-2">
                                    Presentacion Contenido en Unidad de Medida
                                    <div class="relative" data-te-input-wrapper-init>
                                        <input type="number" name="contenido"
                                            class="h-7 border rounded px-4 w-full bg-gray-50" />
                                    </div>
                                </div> --}}
                                <div class="text-left p-1 ml-2 mr-2">
                                    Capacidad(Equipos)
                                    <div class="relative" data-te-input-wrapper-init>
                                        <input type="text" name="capacidad"
                                            class="h-7 border rounded px-4 w-full bg-gray-50" />
                                    </div>
                                </div>
                                <div class=" p-1 text-center text-neutral-900 ml-2 mr-2">
                                    <select
                                        class="inline-block w-56 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                        name="clasificacion_id">
                                        <option class="text-neutral-900">Seleccione Clasificacion</option>
                                        <option class="text-primary" value="0">N/A</option>
                                        <option class="text-primary" value="1">Riesgo Bajo</option>
                                        <option class="text-primary" value="2">Riesgo Medio</option>
                                        <option class="text-primary" value="3">Riesgo ALto</option>
                                        <option class="text-primary" value="4">Riesgo Quimico</option>
                                    </select>
                                    <select
                                        class="inline-block w-56 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                        name="categoria_id">
                                        <option class="text-neutral-900">Seleccione Categoria</option>
                                        <option class="text-primary" value="1">Quimicos</option>
                                        <option class="text-primary" value="2">Cosecha</option>
                                        <option class="text-primary" value="3">EPP</option>
                                        <option class="text-primary" value="4">Herramientas</option>
                                        <option class="text-primary" value="5">Combustibles</option>
                                        <option class="text-primary" value="6">Vehiculo</option>
                                        <option class="text-primary" value="7">Riego</option>
                                        <option class="text-primary" value="8">Materia prima</option>
                                    </select>
                                </div>

                                <div class="text-left p-1 ml-2 mr-2">
                                    Etiqueta
                                    <div class="relative" data-te-input-wrapper-init>
                                        <input type="file" name="file"
                                            class="h-7 border rounded px-4 w-full bg-gray-50" />
                                    </div>
                                </div>
                                <div class="text-left p-1 ml-2 mr-2">
                                    Stok Minimo
                                    <div class="relative" data-te-input-wrapper-init>
                                        <input type="number" name="stockMinimo"
                                            class="h-7 border rounded px-4 w-full bg-gray-50" />
                                    </div>
                                </div>
                                <div class="text-left p-1 ml-2 mr-2">
                                    Observación
                                    <div class="relative mb-3" data-te-input-wrapper-init>
                                        <textarea name="observacion"
                                            class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                            rows="2"></textarea>
                                    </div>
                                </div>
                                <!--Modal footer-->
                                <div class=" m-3">
                                    <button type="submit"
                                        class="bg-gray-400 text-white  py-2 px-4 rounded hover:bg-gray-900 ml-10 ml-2"
                                        data-te-modal-dismiss>
                                        Cerrar
                                    </button>

                                    <button type="submit"
                                        class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-900"
                                        data-te-modal-dismiss>
                                        Guardar Item
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
            {{-- fin guardar con modal --}}

        </div>
    </div>
    {{-- fin caja --}}
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
        window.addEventListener('Eliminar', function(e) {
            Swal.fire({
                icon: 'warning',
                title: 'Éxito, Registro Eliminado...',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('Actualizar', function(e) {
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
