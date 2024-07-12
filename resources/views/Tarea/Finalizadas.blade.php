<x-dashBoard>
    <div class="p-1 w-96 rounded-full bg-white shadow  mb-1 text-left"><i class="fa-solid fa-file mr-3 ml-3"></i>
        <label class="font-bold">Tareas Finalizadas</label>
    </div>
    <div class="flex max-h-[600px] w-full flex-col overflow-y-scroll shadow-lg shadow-neutral-500 mt-5 rounded-lg p-5">
        <div class="py-12">
            <div class="text-left m-1 rounded-lg">
                {{-- <div class="p-1 w-96 rounded-full bg-white shadow  mb-1"><i class="fa-solid fa-file mr-3 ml-3"></i>
                    <label class="font-bold">Tareas Finalizadas</label>
                </div> --}}
                <div
                    class="grid grid-cols-1 md:lg:xl:grid-cols-1 group bg-white shadow-xl shadow-lg border rounded-lg p-2">
                    {{-- <div class="p-3 text-neutral-50">
                            <label class="ml-1 mb-3">Seleccione una Empresa para ver sus Campos y Cuarteles.</label>
                            @livewire('campo.select-empresa')
                        </div> --}}

                    <table id="myTable" class="display p-2">
                        <thead>
                            <tr>
                                <th>Tarea N°</th>
                                <th>Fechas Inicio</th>
                                {{-- <th>Campo</th> --}}
                                <th>cuartel</th>
                                <th>objetivo</th>
                                <th>Detalle Aplicacion</th>
                                {{-- <th>Ver Guía</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalletareas as $tarea)
                                <tr>
                                    <td>{{ $tarea->tarea_id }}</td>
                                    <td>{{ $tarea->fechai }}</td>
                                    <td>{{ $tarea->cuartel->observaciones }}</td>
                                    <td>{{ $tarea->objetivo }}</td>
                                    <td>
                                        <table class="border-2 shadow-lg shadow-neutral-500">
                                            <thead class="bg-neutral-400">
                                                <tr>
                                                    <th class="border-2">N° Tarea</th>
                                                    <th class="border-2">Dosificador</th>
                                                    <th class="border-2">Aplicador</th>
                                                    <th class="border-2">Fecha</th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tarea->aplicaciontarea as $aplicacion)
                                                    <tr>
                                                        <td class="border-2">
                                                            T-{{ $aplicacion->detalletarea->tarea->id }}
                                                        </td>
                                                        <td class="border-2">{{ $aplicacion->dosificador->name }}</td>
                                                        <td class="border-2">{{ $aplicacion->aplicador->name }}</td>
                                                        <td class="border-2">{{ $aplicacion->fecha }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-dashBoard>
