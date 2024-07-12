<x-dashBoard>
    <div class="py-12">
        <div class="text-left m-1 rounded-lg">
            <div class="p-1 w-52 rounded-full bg-white shadow  mb-1"><i class="fa-solid fa-file mr-3 ml-3"></i>
                <label class="font-bold">Lista Guías Finalizadas</label>
            </div>
            <div class="grid grid-cols-1 md:lg:xl:grid-cols-1 group bg-white shadow-xl shadowlg border rounded-lg p-5">
                {{-- <div class="p-3 text-neutral-50">
                            <label class="ml-1 mb-3">Seleccione una Empresa para ver sus Campos y Cuarteles.</label>
                            @livewire('campo.select-empresa')
                        </div> --}}

                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Tipo Guía</th>
                            <th>Guía N°</th>
                            <th>Fechas Emisión</th>
                            <th>Campo</th>
                            <th>Campo/Exportadora</th>
                            <th>Cuartel</th>
                            <th>Especie</th>
                            <th>Kilos Totales</th>
                            <th>Tipo Envase</th>
                            <th>Envases Totales</th>
                            {{-- <th>Observación</th> --}}
                            <th>Ver Guía</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guias as $guia)
                            <tr>
                                <td>Despacho</td>
                                <td>D-{{ $guia->numero }}</td>
                                <td>{{ $guia->fecha }}</td>
                                <td>{{ $guia->planificacioncosecha->cuartel->campo->campo }}</td>
                                <td>{{ $guia->empresa->razon_social }}</td>
                                <td>{{ $guia->planificacioncosecha->cuartel->observaciones }}</td>
                                <td>{{ $guia->planificacioncosecha->plantacion->especie->especie }}</td>
                                <td>{{ $guia->cantidadKilos }}</td>
                                <td>{{ $guia->envase->envase }}</td>
                                <td>{{ $guia->cantidadEnvases }}</td>
                                {{-- <td>{{ $guia->observacion }}</td> --}}

                                <td>
                                    <a href="{{ route('Guia.despacho', $guia->id) }}">
                                        <button type="button"
                                            class="inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-warning-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                            <!--&nbsp;&nbsp;&nbsp;</i> onclick="EditarCosecha({{ $guia->id }})" -->
                                        </button>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        @foreach ($guiasRecepcion as $guiaRecep)
                            <tr>
                                <td>Recepción</td>
                                <td>R-{{ $guiaRecep->numero }}</td>
                                <td>{{ $guiaRecep->updated_at }}</td>
                                <td>{{ $guiaRecep->campo->campo }}</td>
                                <td>{{ $guiaRecep->empresa->razon_social }}</td>
                                <td>N/A</td>
                                <td>
                                    @foreach ($guiaRecep->guiarecepciondetalle as $detalleRecepcion)
                                        {{ $especie = $detalleRecepcion->especie->especie }}</br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($guiaRecep->guiarecepciondetalle as $detalleRecepcion)
                                        {{ $especie = $detalleRecepcion->kilos }}</br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($guiaRecep->guiarecepciondetalle as $detalleRecepcion)
                                        {{ $especie = $detalleRecepcion->envase->envase }}</br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($guiaRecep->guiarecepciondetalle as $detalleRecepcion)
                                        {{ $especie = $detalleRecepcion->cantidadEnvase }}</br>
                                    @endforeach
                                </td>
                                {{-- <td>{{ $guiaRecep->observacion }}</td> --}}

                                <td>
                                    <a href="{{ route('Guia.RecepcionEmitir', $guiaRecep->id) }}">
                                        <button type="button"
                                            class="inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-warning-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        @foreach ($guiasDevolucion as $devolucionTraspaso)
                            <tr>
                                <td>Devolución Traspaso</td>
                                <td>TD-{{ $devolucionTraspaso->numero }}</td>
                                <td>{{ $devolucionTraspaso->updated_at }}</td>
                                <td>{{ $devolucionTraspaso->campo->campo }}</td>
                                <td>{{ $devolucionTraspaso->NombreDestino }}</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>
                                    @foreach ($devolucionTraspaso->devoluciontraspasodetalle as $devolucionTraspasoDetalles)
                                        <label>{{ $devolucionTraspasoDetalles->envase->envase }}</label>
                                        <label>{{ $devolucionTraspasoDetalles->envase->cantidadEnvases }}</label>
                                    @endforeach
                                </td>
                                <td>N/A</td>
                                <td>{{ $devolucionTraspaso->observacion }}</td>

                                <td>
                                    <a href="{{ route('Guia.DevolucionEmitir', $devolucionTraspaso->id) }}">
                                        <button type="button"
                                            class="inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-warning-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</x-dashBoard>
