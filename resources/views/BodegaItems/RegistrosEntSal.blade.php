<x-dashBoard>
    <div class="py-12">
        <div class="text-left m-1 rounded-lg">
            <div class="p-1 w-96 rounded-full bg-white shadow  mb-1"><i class="fa-solid fa-file mr-3 ml-3"></i>
                <label class="font-bold">Registro de Ingresos y Egresos a Bodegas</label>
            </div>
            <div class="grid grid-cols-1 md:lg:xl:grid-cols-1 group bg-white shadow-xl shadowlg border rounded-lg p-5">
                {{-- <div class="p-3 text-neutral-50">
                            <label class="ml-1 mb-3">Seleccione una Empresa para ver sus Campos y Cuarteles.</label>
                            @livewire('campo.select-empresa')
                        </div> --}}

                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Tipo Documento.</th>
                            <th>Guía N°</th>
                            <th>Fechas Emisión</th>
                            <th>Campo</th>
                            <th>proveedor</th>
                            {{-- <th>Observación</th> --}}
                            <th>Ver Guía</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ingresosBodega as $ingresoBodega)
                            <tr>
                                <td>
                                    @if ($ingresoBodega->tipoDocumento_id == 1)
                                        Guia/Despacho
                                    @else
                                        Factura
                                    @endif
                                </td>
                                <td>{{ $ingresoBodega->numero }}</td>
                                <td>{{ $ingresoBodega->fecha }}</td>
                                <td>{{ $ingresoBodega->campo->campo }}</td>
                                <td>{{ $ingresoBodega->proveedor->razon_social }}</td>

                                {{-- <td>{{ $guia->observacion }}</td> --}}

                                <td>
                                    <a href="{{ route('registro.bodega.ingreso', $ingresoBodega->id) }}">
                                        {{-- <button type="button"
                                            class="inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-warning-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                             --}}<i class="fa-solid fa-magnifying-glass"></i>
                                            <!--&nbsp;&nbsp;&nbsp;</i> onclick="EditarCosecha({{ $ingresoBodega->id }})"
                                        </button> -->
                                    </a>

                                </td>
                                <td>
                                    <a href="{{route('edit.ingreso.salida',$ingresoBodega->id)}}" ><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @foreach ($egresoBodega as $egreso)
                            <tr>
                                <td>
                                    Entrega Bodega
                                </td>
                                <td>{{ $egreso->id }}</td>
                                <td>{{ $egreso->fecha }}</td>
                                <td>{{ $egreso->bodeguero->name }}</td>
                                <td>{{ $egreso->solicitante->name }}</td>

                                {{-- <td>{{ $guia->observacion }}</td> --}}

                                <td>
                                    <a href="{{ route('registro.bodega.egreso', $egreso->id) }}">
                                        <button type="button"
                                            class="inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-warning-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                            <!--&nbsp;&nbsp;&nbsp;</i> onclick="EditarCosecha({{ $egreso->id }})" -->
                                        </button>
                                    </a>

                                </td>
                                  <td>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
</x-dashBoard>
