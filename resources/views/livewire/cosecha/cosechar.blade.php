<div>
    <form action="{{ route('Cosecha.store') }}" method="post">
        @CSRF
        @foreach ($planificacion as $planificacionDatos)
            <input type="hidden" value="{{ $planificacionDatos->id }}" name="planificacionCosecha_id">
            <div class="grid grid-cols-2">
                {{-- columna 1 --}}
                <div class="text-left col-span-1 mr-5 border-2 shadow-xl bg-white rounded-lg p-2">
                    <div class="flex">
                        <div class="w-1/5 px-2">
                            <label for="username"
                                class="block text-sm font-medium leading-6 text-gray-900">Contratista</label>
                            <select
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                id="contratista_id" wire:model.defer="contratista_id"> <!-- name="contratista_id" -->
                                <option>Seleccione Contratista</option>
                                @foreach ($planificacionDatos->contraistaxplanificacion as $contratista)
                                    <option value="{{ $contratista->contratista_id }}">
                                        {{ $contratista->contratista->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/5 px-2">
                            <label for="username"
                                class="block text-sm font-medium leading-6 text-gray-900">Exportadora</label>
                            <select
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                id="expoID" wire:model.defer="exportadoraID"> <!-- name="contratista_id" -->
                                <option>Seleccione Exportadora</option>
                                @foreach ($planificacionDatos->exportadoraxplanificacion as $exportadora)
                                    <option value="{{ $exportadora->empresa_id }}">
                                        {{ $exportadora->empresa->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/5 px-2">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Tarja
                                Env.</label>
                            <input type="text" wire:model.defer="tarjaenvase"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="w-1/5 px-2">
                            <label for="username"
                                class="block text-sm font-medium leading-6 text-gray-900">Kilos</label>
                            <input type="text" wire:model.defer="kilos"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="w-1/5 px-2 mt-6">
                            <button type="button" wire:click="agregarKilos" id="agregarKilos-dehabilitado"
                                class="inline-block rounded bg-success-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                Añadir
                            </button>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $planificacionDatos->id }}"
                        wire:model.defer="planificacioncosecha_id">
                    {{-- tabla --}}
                    <div class="mt-3 mb-1">
                        <table class="border-2">
                            <thead class="border-2">
                                <tr class="border-2 bg-gray-300">
                                    <td class="w-24 border-2 mt-3">Contratista</td>
                                    <td class="w-24 border-2 mt-3">
                                        Exportadora&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td class="w-full border-2 mt-3">Tarja/Env.</td>
                                    <td class="w-full border-2 mt-3">&nbsp;&nbsp;&nbsp;Kilos&nbsp;&nbsp;&nbsp;</td>
                                    <td class="w-full border-2 mt-3">Eliminar</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalleCo as $cosecha)
                                    <tr>
                                        <td class="w-full mt-3 border-2">
                                            {{ $cosecha->empresa->razon_social }}</td>
                                        <td class="w-full mt-3 border-2">
                                            {{ $cosecha->exportadora->razon_social }}</td>
                                        <td class="w-full mt-3 border-2  text-center">
                                            {{ $cosecha->tarjaenvase }}.</td>
                                        <td class="w-full mt-3 border-2  text-center">
                                            {{ $cosecha->kilos }}
                                            <input type="hidden" name="KilosDetalleCosecha[]"
                                                value="{{ $cosecha->kilos }}">
                                        </td>
                                        <td class="w-full mt-3 border-2"><button type="button"
                                                wire:click="ElimnarRegistro({{ $cosecha->id }})"
                                                class="inline-block rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- fin tabla --}}
                    {{ $detalleCo->links() }}
                </div>
                {{-- columna 2 --}}

                {{-- inicio form --}}
                <div class="text-left col-span-1 mr-5 shadow-xl bg-white rounded-lg p-2">
                    <div class="sm:col-span-1 md:col-span-6">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Datos Planificación
                            Cosecha
                        </h2>
                    </div>
                    <div class="flex">
                        <div class="px-2">
                            <label for="username"
                                class="block text-sm font-medium leading-6 text-gray-900">Fecha</label>
                            <input type="text" name="region" value="{{ date('d-m-Y') }}"
                                class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="px-2">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Fecha
                                Inicial</label>
                            <input type="text" name="region" value="{{ $planificacionDatos->fechai }}"
                                class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="px-2">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Fecha
                                Final</label>
                            <input type="text" name="region" value="{{ $planificacionDatos->fechaf }}"
                                class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="px-2">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Semana
                                ISO</label>
                            <input type="text" value="{{ date('W') }}"
                                class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="px-2">
                            <label for="username"
                                class="block text-sm font-medium leading-6 text-gray-900">Campo</label>
                            <input type="hidden" wire:model.defer="CampoID">
                            <input type="text" value="{{ $planificacionDatos->cuartel->campo->campo }}"
                                class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="px-2">
                            <label for="username"
                                class="block text-sm font-medium leading-6 text-gray-900">Cuartel</label>
                            <input type="hidden" value="{{ $CuartelID }}" wire:model.defer="CuartelID">
                            <input type="text" value="{{ $planificacionDatos->cuartel->observaciones }}"
                                class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="px-2">
                            <label for="username"
                                class="block text-sm font-medium leading-6 text-gray-900">Especie</label>
                            <input type="hidden" value="{{ $EspecieID }}" wire:model.defer="EspecieID">
                            <input type="text" value="{{ $planificacionDatos->plantacion->especie->especie }}"
                                class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div
                        class="w-full mt-2 rounded-xl border border-gray-200 bg-white py-2 px-2 shadow-md shadow-gray-100">
                        {{-- <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
                        <div>Detalle Cosecha</div>
                    </div> --}}
                        <div class="mt-2">
                            <div class="flex max-h-[230px] w-full flex-col overflow-y-scroll">
                                {{-- tabla --}}
                                <div class="w-full">
                                    <h2 class="text-base font-semibold leading-7 text-gray-900 mt-2">Datos Contratista
                                    </h2>
                                    <table class="w-full border-2">
                                        <thead class="w-full mt-3 border-2">
                                            <tr class=" w-full mt-3 border-2 bg-gray-300">
                                                <td class="w-full mt-3 border-2">Contrastista</td>
                                                <td class="w-full mt-3 border-2">Trato/Cos.</td>
                                                <td class="w-full mt-3 border-2">Kilos/Actuales</td>
                                                <td class="w-full mt-3 border-2">Costo/Total</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($planificacionDatos->contraistaxplanificacion as $contratista)
                                                <tr>
                                                    <td class="w-full mt-3 border-2">
                                                        {{ $contratista->contratista->razon_social }}</td>
                                                    <td class="w-full mt-3 border-2">
                                                        {{ $contratista->tratoxcosecha }}</td>
                                                    <td class="w-full mt-3 border-2">
                                                        {{ $contratista->kilos }}</td>
                                                    <td class="w-full mt-3 border-2">
                                                        {{ $contratista->costototal }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{-- fin tabla --}}
                                {{-- tabla --}}
                                <div class="w-full">
                                    <h2 class="text-base font-semibold leading-7 text-gray-900 mt-1">Datos Empresas
                                        Exportadoras
                                    </h2>
                                    <table class="w-full border-2">
                                        <thead class="w-full mt-3 border-2">
                                            <tr class="w-full mt-3 border-2 bg-gray-300">
                                                <td class="w-full mt-3 border-2">Exportadora</td>
                                                {{-- <td class="border-dotted w-full mt-3 border-2 border-sky-500">Trato/Cos.</td> --}}
                                                <td class="w-full mt-3 border-2">Kilos/Sol.</td>
                                                <td class="w-full mt-3 border-2">Tipo/Env.</td>
                                                <td class="w-full mt-3 border-2">Stock/Env.</td>
                                                <td class="w-full mt-3 border-2">
                                                    Kilos/Reales/Asig.</td>
                                                <td class="w-full mt-3 border-2">Env./Reales</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $total=0; @endphp
                                            @foreach ($planificacionDatos->exportadoraxplanificacion as $exportadora)
                                                <tr>
                                                    <td class="w-full mt-3 border-2">
                                                        {{ $exportadora->empresa->razon_social }}</td>
                                                    {{-- <td class="border-dotted w-full mt-3 border-2 border-sky-500">1543</td> --}}
                                                    <td class="w-full mt-3 border-2">
                                                        {{ $exportadora->kilosSolicitados }}</td>
                                                    <td class="w-full mt-3 border-">
                                                        {{ $exportadora->cuentaenvase->envase->envase }}</td>
                                                    <td class="w-full mt-3 border-2">
                                                        {{ $exportadora->cuentaenvase->saldo }}

                                                    </td>
                                                    <input type="hidden" name="exportadora_id[]"
                                                        value="{{ $exportadora->id }}">
                                                    <td class="w-full mt-3 border-2"><input type="text"
                                                            name="valores[]"
                                                            value="{{ $exportadora->KilosRecolectados }}"
                                                            id="kilosExpo{{ $exportadora->id }}"
                                                            class="w-full border-2"></td>
                                                    <td class="w-full mt-3 border-2"><input type="text"
                                                            name="bines[]"
                                                            value="{{ $exportadora->envasesUtilizadosReales }}"
                                                            class="w-full border-2"></td>
                                                </tr>
                                                @php $total = $total + $exportadora->kilosSolicitados @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{-- fin tabla --}}
                                <h2 class="text-base font-semibold leading-7 text-gray-900 mt-3">Envases
                                    Utilizados, Color y Cantidad x Exportadora
                                </h2>
                                {{-- detalle de bines y colores utilizados --}}
                                <div class="flex">
                                    <div class="px-2 w-2/5 mt-6">
                                        <select
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                            id="expoID" wire:model.defer="exportadoraIDDetalle">
                                            <!-- name="contratista_id" -->
                                            <option>Seleccione Exportadora</option>
                                            @foreach ($planificacionDatos->exportadoraxplanificacion as $exportadora)
                                                <option value="{{ $exportadora->id }}">
                                                    {{ $exportadora->empresa->razon_social }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="px-2 w-1/5 text-center">
                                        <label for="username"
                                            class="block text-sm font-medium leading-6 text-gray-900">
                                            Cantidad</label>
                                        <input type="text" wire:model.defer="cantidadDetalle"
                                            class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                    <div class="px-2 w-1/5 mt-6">
                                        <select
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                            id="expoID" wire:model.defer="coloresDDetalle">
                                            <!-- name="contratista_id" -->
                                            <option>Color Envase</option>
                                            @foreach ($colores as $color)
                                                <option value="{{ $color->id }}">
                                                    {{ $color->color }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="px-2 mt-5 w-1/5">
                                        <button type="button" wire:click="agregarDetalleEnvase"
                                            class="inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                            Añadir
                                        </button>
                                    </div>
                                </div>
                                {{-- fin --}}
                                {{-- tabla --}}
                                <div class="w-full">
                                    <table id="tablaDetalle" class="w-full mt-3 border-2">
                                        <thead class="w-full mt-3 border-2">
                                            <tr class="w-full mt-3 border-2 bg-secondary-100">
                                                <td class="w-full mt-3 border-2">Exportadora</td>

                                                <td class="w-full mt-3 border-2">Cantidad</td>
                                                <td class="w-full mt-3 border-2">Color</td>
                                                <td class="w-full mt-3 border-2">Quitar</td>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($planificacionDatos->exportadoraxplanificacion as $exportador)
                                                @foreach ($exportador->desgloseenvase as $desglose)
                                                    {{-- {{$exportador->id }},{{$desglose->exportadoraxplanificacion_id}} --}}
                                                    @if ($exportador->id == $desglose->exportadoraxplanificacion_id)
                                                        <tr class="w-full mt-3 border-2 bg-neutral-50">
                                                            <td class="w-full mt-3 border-2">
                                                                {{ $desglose->exportadoraxplanificacion->empresa->razon_social }}
                                                            </td>

                                                            <td class="w-full mt-3 border-2">
                                                                {{ $desglose->stock }}</td>
                                                            <td class="w-full mt-3 border-2">
                                                                {{ $desglose->color->color }}</td>
                                                            <td class="w-full mt-3 border-2">
                                                                <button type="button"
                                                                    wire:click="ElimnarDetalleEnvase( {{ $desglose->id }})"
                                                                    class="inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </button>
                                                            </td>
                                                            </td>

                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div>

                            {{-- fin tabla --}}
                            <h2 class="text-base font-semibold leading-7 text-gray-900 mt-3">Datos del Proceso de
                                Cosecha
                            </h2>
                            <div class="flex">
                                <div class="w-1/2 px-2">
                                    <label for="username"
                                        class="block text-sm font-medium leading-6 text-gray-900">Capataz</label>
                                    <input type="text" name="region"
                                        value="{{ $planificacionDatos->plantacion->cuartel->capataz->name }}"
                                        class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <div class="w-1/2 px-2">
                                    <label for="username"
                                        class="block text-sm font-medium leading-6 text-gray-900">Envase/Campo
                                    </label>
                                    <input type="text" name="region"
                                        value="{{ $planificacionDatos->envase->envase }}"
                                        class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                            </div>
                            <div class="flex">
                                <div class="w-1/2 px-2">
                                    <label for="username"
                                        class="block text-sm font-medium leading-6 text-gray-900">Cosechado/Actual
                                    </label>
                                    <input type="text" id="cosechaActual" name="cosechaActual"
                                        wire:model.defer="cosechaActual"
                                        class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <div class="w-1/2 px-2">
                                    <label for="username"
                                        class="block text-sm font-medium leading-6 text-gray-900">Cosecha/Solicitada
                                    </label>
                                    <input type="text" name="region" value="{{ $total }}"
                                        class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <div class="m-2">
                                <button type="submit" onclick="validarDatos()"
                                    class="bg-gray-700 text-white py-2 w-full px-4 rounded hover:bg-gray-600">
                                    Cierre de Cosecha
                                </button>
                            </div>
        @endforeach
    </form>
    <script>
        function validarDatos() {
            var totalCosechaReal = 0;
            $('input[name^="valores["]').each(function(index, elemento) {
                // Acceder al valor de cada campo de entrada
                var valor = $(elemento).val();
                if (valor === "" || valor === null || valor === undefined || valor === "0") {
                    alert('No puede Existir una Exportadora con 0 kilos');
                    event.preventDefault();
                }
                totalCosechaReal = parseFloat(totalCosechaReal) + parseFloat(valor);
            });
            $('input[name^="bines["]').each(function(index, elemento) {
                // Acceder al valor de cada campo de entrada
                var valor = $(elemento).val();
                if (valor === "" || valor === null || valor === undefined || valor === "0") {
                    alert('Debe Distribuir Envases utilizados');
                    event.preventDefault();
                }
                totalCosechaReal = parseFloat(totalCosechaReal) + parseFloat(valor);
            });
            $('input[name^="KilosDetalleCosecha["]').each(function(index, elemento) {
                // Acceder al valor de cada campo de entrada
                var valor = $(elemento).val();
                if (valor === "" || valor === null || valor === undefined || valor === "0") {
                    alert('No Existe Cosecha');
                    event.preventDefault();
                }
                totalCosechaReal = parseFloat(totalCosechaReal) + parseFloat(valor);
            });

        }
        window.addEventListener('KilosCompletados', function(e) {
            Swal.fire({
                icon: 'success',
                title: 'kilos Completados...',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('sumaDetalleEnvases', function(e) {
            Swal.fire({
                icon: 'success',
                title: 'Enases Agregados...',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('KilosEliminados', function(e) {
            Swal.fire({
                icon: 'warning',
                title: 'Éxito, Registro Eliminado...',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('EliminacionDetalleEnvase', function(e) {
            Swal.fire({
                icon: 'warning',
                title: 'Éxito, Registro Eliminado...',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('cierreCosechas', function(e) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito, Cosecha cerrada...',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
    </script>
</div>
