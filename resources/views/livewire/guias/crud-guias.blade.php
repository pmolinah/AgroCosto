<div>
    <div class="w-full rounded-xl border border-gray-200 bg-white py-2 px-2 shadow-md shadow-neutral-800">
        <div class="flex items-center px-2 text-base font-medium text-gray-700">
            <div class="mt-3">Guia de Despacho</div>

            <div class="col-span-3 font-bold p-2 mt-3 text-gray-700">
                <select wire:model.defer="guiasSinEmitir_id" wire:change="guiasSinEmitir"
                    class="text-gray-700 block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option>Guías sin Emitir</option>
                    @foreach ($guias as $guia)
                    <option value="{{ $guia->id }}">{{ $guia->numero}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-4">
            </div>
            <div class="col-span-3  mt-1 p-1 mr-2">
                <button type="button" wire:click="limpiarFormulario"
                    class="ml-1 inline-block rounded bg-gray-700 text-white w-full py-2 px-4 rounded hover:bg-gray-300">
                    Limpiar Formulario
                </button>
            </div>
        </div>
        <div class="mt-2">
            <div class="flex max-h-[600px] w-full flex-col overflow-y-scroll">
                {{-- inicio guia --}}
                <!-- <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 mt-3 shadow-2xl">
                    <div class="col-span-2 font-bold p-2 mt-3 text-gray-700">
                        Guía de Despacho.
                    </div> -->



                <!-- <div class="text-center col-span-2 p-2">
                        <input type="date" wire:model="fechafinal"
                            class="text-gray-700 h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                    </div> -->


                <!-- </div> -->
                <hr
                    class="my-2 h-0 border border-t-0 border-solid border-neutral-700 opacity-25 dark:border-neutral-200" />

                <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-50 shadow-2xl p-2">
                    <div class="col-span-12 font-bold text-primary-800 text-left ml-2">
                        Guia N° {{$guia_id}}
                    </div>
                    <div class="col-span-1 p-2 mt-3 text-left text-gray-700">
                        Fecha
                    </div>
                    <div class="text-center col-span-2 p-2 text-gray-700">
                        <input type="date" wire:model.defer="fecha" value="{{$fecha}}"
                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                    </div>
                    <div class="col-span-1 p-2 mt-3 text-left text-gray-700">
                        Tipo
                    </div>
                    <div class="col-span-2 mt-2 p-2 text-gray-700">
                        <select wire:model.defer="tipo"
                            class="text-gray-700 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Tipo Documento</option>
                            <option value="1">Guía</option>
                            <option value="2">Factura</option>
                        </select>
                    </div>
                    <div class="col-span-1 p-2 mt-3 text-left text-gray-700">
                        Número
                    </div>
                    <div class="text-center col-span-2 p-2 text-gray-700">
                        <input type="number" wire:model.defer="numero"
                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                    </div>
                    <div class="col-span-3">
                    </div>
                    <div class="col-span-2 text-left mt-2 p-1">
                        <label class="p-1 font-medium">Empresa</label>
                    </div>
                    <div class="col-span-9 mt-1 ">
                        <select wire:model.defer="campo_id" wire:change="seleccionEmpresa"
                            class="text-gray-700 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccionar Empresa</option>
                            @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2 text-left mt-2 p-1">
                        <label class="p-1 font-medium">Campo</label>
                    </div>
                    <div class="col-span-9 mt-1 ">
                        <select wire:model.defer="campoxCuentaEnvase_id"
                            class="text-gray-700 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccionar Campo</option>
                            @foreach ($campoLista as $campocuenta)
                            <option value="{{ $campocuenta->id }}">{{ $campocuenta->campo }}
                            </option>
                            @endforeach
                        </select>

                    </div>
                    <!-- <div class="col-span-6">
                    </div> -->
                    <div class="col-span-2 text-left mt-2 p-1">
                        <label class="p-1 font-medium">Dirección</label>
                    </div>
                    <div class="col-span-4 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                            value="{{$direccionCampo}}">
                    </div>
                    <div class="col-span-6">
                    </div>
                    <!-- <div class="col-span-2 text-right mt-2 p-1">
                        <label class="p-1 font-medium">Fecha</label>
                    </div>
                    <div class="col-span-4 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                            value="{{ date('Y-m-d H:i:s') }}">
                    </div> -->
                    {{-- datos exportadora --}}
                    <div class="col-span-12 grid grid-cols-12 border-2 m-2 rounded-md p-1">
                        <div class="col-span-12 p-2 ml-4 mt-2 ">
                            <select wire:model.defer="empresa_id" wire:change="seleccionCliente"
                                class="text-gray-700 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option>Seleccionar Cliente</option>
                                @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-1 mt-7 p-1 text-left">
                            <label class="p-1 font-medium">Rut</label>
                        </div>
                        <div class="col-span-1 mt-6">
                            <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                                value="{{$rutCliente}}">
                        </div>
                        <div class="col-span-1 mt-7 p-1">
                            <label class="p-1 font-medium">Exportadora</label>
                        </div>
                        <div class="col-span-4 mt-6">
                            <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                                value="{{$razonSocial}}">
                        </div>
                        <div class="col-span-1 mt-7 p-1">
                            <label class="p-1 font-medium">Dirección</label>
                        </div>
                        <div class="col-span-4 mt-6">
                            <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                                value="{{$direccionCliente}}">
                        </div>
                        <div class="col-span-1 mt-2 p-1 text-left">
                            <label class="p-1 font-medium">Comuna</label>
                        </div>
                        <div class="col-span-4 mt-1">
                            <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                                value="{{$comunaCliente}}">
                        </div>
                        <div class="col-span-1 mt-2 p-1">
                            <label class="p-1 font-medium">Email</label>
                        </div>
                        <div class="col-span-6 mt-1">
                            <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                                value="{{$emailCliente}}">
                        </div>
                        <div class="col-span-1 mt-2 p-1 text-left">
                            <label class="borp-1 font-medium">Giro</label>
                        </div>
                        <div class="col-span-5 mt-1">
                            <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                                value="{{$giroCliente}}">
                        </div>
                        <div class="col-span-1 mt-2 p-1 text-left">
                            <label class="borp-1 font-medium">CodSag</label>
                        </div>
                        <div class="col-span-5 mt-1">
                            <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200"
                                value="">
                        </div>
                    </div>
                    <div
                        class="col-span-6 p-2 ml-1 mt-2 h-10 bg-gray-100 flex border border-gray-200 rounded items-center mt-1">
                        <select wire:model.defer="conductor_id"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 w-full bg-transparent">
                            <option>Seleccionar Conductor</option>
                            @foreach ($conductores as $conductor)
                            <option value="{{ $conductor->id }}">{{ $conductor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div
                        class="col-span-6 p-2 ml-1 mt-2 h-10 bg-gray-100 flex border border-gray-200 rounded items-center mt-1">
                        <select wire:model.defer="vehiculo_id"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 w-full bg-transparent">
                            <option>Seleccionar Vehículo</option>
                            @foreach ($vehiculos as $vehiculo)
                            <option value="{{ $vehiculo->id }}">{{ $vehiculo->patente }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($deshabilitarCrear)
                    <div class="col-span-3  mt-1 p-1 mr-2">
                        <button type="button" wire:click="CrearGuia"
                            class="ml-1 inline-block rounded bg-gray-700 text-white w-full py-2 px-4 rounded hover:bg-gray-300">
                            Crear Guía Despacho
                        </button>
                    </div>
                    @endif

                    @if ($visible)

                    <div class="text-center font-bold col-span-12 mt-2">
                        Cosecha en Bodega
                    </div>
                    <div class="col-span-6 grid grid-cols-12 border-2 border-green-800 p-1">
                        <div class="text-center col-span-8 mt-3">
                            <select wire:model.defer="envase_id"
                                class="text-gray-700 block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option>Seleccionar Envase por Tarja</option>
                                @foreach ($almacenamientos as $almacenamiento)
                                <option value="{{ $almacenamiento->id }}">{{ $almacenamiento->tarjaenvase }},
                                    Fecha Cosecha:{{ $almacenamiento->fechaCosecha }},
                                    Especie:{{ $almacenamiento->especie->especie }},
                                    Variedad:{{ $almacenamiento->especie->variedad->variedad }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-4  mt-1 p-1 mr-2">
                            <button type="button" wire:click="agregarBins"
                                class="ml-1 inline-block rounded bg-green-700 text-white py-2 px-4 rounded hover:bg-gray-300">
                                Agregar Envase
                            </button>
                        </div>
                    </div>
                    <div class="text-center col-span-12 mt-2">
                        <h6 class="text-primary-800">Detalle Kilos</h6>
                    </div>
                    <div class="col-span-12 text-left">
                        <table class="border-dotted w-full mt-3 border-2 ">
                            <thead class=" w-full mt-2 border-2 ">
                                <tr class=" mt-2 border-2 bg-gray-300">
                                    <td class="font-bold mt-2 border-2">Especie</td>
                                    <td class="font-bold text-center mt-2 border-2">Tarja/Envase</td>
                                    <td class="font-bold text-center mt-2border-2">Kilos</td>
                                    <td class="font-bold text-center mt-2border-2">-</td>

                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $sum=0;
                                $suma=0;
                                 @endphp
                                @foreach ($detalleguias as $detalleguia)
                                <tr>
                                    <td class="w-96 w-full mt-3 border-2">
                                        {{ $detalleguia->planificacioncosecha->plantacion->especie->especie }},
                                        Especie.:{{ $detalleguia->planificacioncosecha->plantacion->especie->variedad->variedad }}
                                        <input type="hidden"
                                            value="{{ $detalleguia->planificacioncosecha->plantacion->especie_id }}"
                                            wire:model.defer="especie_id">
                                    </td>
                                    <td class="text-center w-64 w-full mt-3 border-2">
                                        {{ $detalleguia->tarjaenvase }}</td>
                                    <td class="text-center w-24 w-full mt-3 border-2">
                                        {{ $detalleguia->kilos }}</td>
                                        <td class="text-center w-24 w-full mt-3 border-2">
                                           <a href="#" wire:click="eliminarEnvase({{$detalleguia->id}},{{$detalleguia->guia_id}},{{$detalleguia->color_id}})"><i class="fa-solid fa-trash text-red-700"></i></a>
                                        </td>
                                       
                                </tr>
                                @php $sum = $sum + $detalleguia->kilos @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-span-10"></div>
                    <div class="mt-3 col-span-1 border-2 text-left">Total</div>
                    <div class="text-center mt-3 col-span-1 border-2">{{ $sum }}
                        <input type="hidden" value="{{ $sum }}" wire:model.defer="cantidadkilos">
                    </div>

                    <div class="text-center col-span-12 mt-4">
                        <h6 class="text-gray-800">Detalle Envases</h6>
                    </div>
                    <div class="col-span-8">
                        <table class="w-full mt-3 border-2">
                            <thead class="w-full mt-3 border-2">
                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="font-bold  mt-3 border-2 text-left">Envase</td>
                                    <td class="font-bold text-center mt-3 border-2 w-28">Color</td>
                                    <td class="font-bold text-center mt-3 border-2">Cantidad</td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detalleenvases as $detalleenvase)
                                <tr>
                                    <td class="w-96 w-full mt-3 border-2 text-left">
                                        {{$detalleenvase->planificacioncosecha->envase->envase}}
                                        <input type="hidden" value="" wire:model.defer="envase_id">
                                    </td>
                                    <td class="text-center w-64 w-full mt-3 border-2">
                                    {{$detalleenvase->color->color}}
                                    </td>
                                    <td class="text-center w-24 w-full mt-3 border-2">
                                    {{$detalleenvase->stock}}
                                    </td>
                                </tr>
                                @php $suma = $suma + $detalleenvase->stock @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-span-6"></div>
                    <div class="mt-3 col-span-1 border-2 text-left">Total</div>
                    <div class="text-center mt-3 col-span-1 border-2">{{ $suma }}

                        <input type="hidden" value="" wire:model.defer="cantidadEnvases">
                    </div>

                </div>

                <div class="grid grid-cols-12 mt-8">
                    <div class="col-span-12 mb-8 shadow-lg text-left">
                        <label class="font-bold">Observación Max 100 Caractéres,(Opcional)</label>
                        <textarea wire:model.defer="observacion" rows="1"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                    <div class="col-span-3 mr-2">
                        <button type="button" wire:click="generarGuiaDespacho"
                            class="bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600">
                            Generar Guía
                        </button>
                    </div>
                    <div class="col-span-3">
                        <a href="">
                            <button type="button" wire:click="editarGuia"
                                class="mb-2 block w-full rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                Editar Cosecha
                            </button>
                        </a>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
    <script>
    window.addEventListener('GuiaDespachoOK', function(e) {
        Swal.fire({
            icon: 'success',
            title: 'Guía Generada...',
            text: '{{ Session::get('
            success ') }}',
            timer: 8000,
            showConfirmButton: false
        });
    });
    </script>
</div>