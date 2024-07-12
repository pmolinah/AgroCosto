<x-dashBoard>
    <div class="py-12">
        <div class="p-1 w-96 text-left rounded-full bg-white shadow"><i class="fa-solid fa-file mr-3 ml-3"></i>
            <label class="font-bold">Lista de cosechas programadas por realizar..</label>
        </div>
        <div class="text-left mt-10 bg-white shadow-lg rounded-lg p-3 sm:px-6 lg:px-8">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Fecha Cosecha Inicial</th>
                        <th>Fechas Cosecha Final</th>
                        <th>Campo</th>
                        <th>Cuartel</th>
                        <th>Especie</th>
                        <th>Kilos Totales</th>
                        {{-- <th>Contratista/Ejecutor</th> --}}
                        {{-- <th>Observacion</th> --}}
                        {{-- <th>Eliminar</th> --}}
                        <th>Cosechar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planificaciones as $planificacion)
                        <tr>
                            <td>{{ $planificacion->id }}{{ $planificacion->finalizada }}</td>
                            <td>{{ $planificacion->fechai }}</td>
                            <td>{{ $planificacion->fechaf }}</td>
                            <td>{{ $planificacion->cuartel->campo->campo }}</td>
                            <td>{{ $planificacion->cuartel->observaciones }}</td>
                            <td>{{ $planificacion->plantacion->especie->especie }}</td>
                            <td>{{ $planificacion->kilos }}</td>
                            {{-- <td>{{ $planificacion->cuartel_id}}</td> --}}
                            {{-- <th>Observacion</th> --}}
                            <td>
                                @can('adm.crear.cosechar')
                                    <a href="{{ route('Cosechar.cosecha', $planificacion->id) }}">
                                        <button type="button"
                                            class="inline-block rounded bg-success-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                            <i class="fa-solid fa-apple-whole">&nbsp;&nbsp;&nbsp;Cosechar</i>
                                        </button>
                                    </a>
                                @endcan
                            </td>
                            {{-- <td>
                                @can('adm.editar.cosechar')
                                    <button type="button" onclick="EditarCosecha({{ $planificacion->id }})"
                                        class="inline-block rounded bg-warning-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-warning-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                        <i class="fa-regular fa-pen-to-square">&nbsp;&nbsp;&nbsp;Editar</i>
                                    </button>
                                @endcan
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashBoard>
