<div>
    <div class="grid grid-cols-2">
        <div class="col-span-1 bg-white p-3 ml-5 rounded-md shadow-lg mt-5">
            <!-- busqueda -->
            <div class="col-span-6 p-1 text-center">
                <label>Informe Contable por año</label>
                <table class="mt-1 border-2 w-full text-center">
                    <thead class="w-full mt-3 border-2">
                        <tr class="mt-3 border-2 bg-gray-300">
                            <td class="w-28 font-bold mt-3 border-2 px-6">Año</td>
                            <td class="w-1 text-sm font-bold mt-3 border-2"> <i class="fa-solid fa-search"></i></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="mt-3 border-2">
                            <td class="w-28 font-bold mt-3 border-2 ">
                                <select wire:model.defer="busquedaporfecha"
                                    class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option>Año</option>
                                    <option value="2024">2024</option>
                                </select>
                            </td>
                            <td class="w-1 font-bold mt-3 border-2">
                                <a href="#" wire:click="obtenerMovimientosPorAno">
                                    <i class="fa-solid fa-search"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-span-2">
            <div class="flex max-h-[700px] w-full flex-col overflow-y-scroll">
                <div class="overflow-hidden rounded-lg border border-gray-500 shadow-md m-5 p-3 bg-white">
                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-700">
                        <thead class="bg-gray-50">
                            <tr>
                                <th>Cuartel</th>
                                <th>Concepto</th>
                                @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                                'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $mes)
                                <th class="text-blue-500">{{ $mes }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($datosAgrupados))
                            @foreach ($datosAgrupados as $cuartelData)
                            @foreach ($cuartelData['conceptos'] as $conceptoData)
                            <tr>
                                <td>{{ $cuartelData['cuartelNombre'] }}</td>
                                <td>{{ $conceptoData['conceptoNombre'] }}</td>
                                @foreach ($conceptoData['meses'] as $total)
                                <td>{{ $total }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                            @endforeach
                            @else
                            <tr>
                                <!-- <td colspan="14" class="text-center">No se encontraron datos</td> -->
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total</th>
                                @foreach ($totalesMensuales as $totalMes)
                                <th>{{ $totalMes }}</th>
                                @endforeach
                                <th>Total Anual</th>
                                <th>{{ $totalAnual }}</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>

    </div>
</div>