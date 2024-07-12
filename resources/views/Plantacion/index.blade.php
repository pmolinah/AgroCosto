<x-dashBoard>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="pb-12 relative">
                <div class="inline-block absolute left-0 text-left p-1 w-52 rounded-full bg-white shadow"><i
                        class="fa-solid fa-tree mr-3 ml-3"></i>
                    <label class="font-bold">Lista Plantaciones</label>
                </div>
                <div class="inline-block absolute right-0">
                    @can('adm.crear.plantacion')
                        <a href="{{ route('Plantacion.create') }}">
                            <button type="button" class="bg-gray-700 text-white  py-2 px-4 mb-1 rounded hover:bg-gray-600">
                                Nueva Plantación
                            </button>
                        </a>
                    @endcan
                </div>
            </div>
            <div class="text-left grid grid-cols-1 md:lg:xl:grid-cols-1 group bg-white shadow-xl border rounded-lg p-5">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Fecha Plantación</th>
                            {{-- <th>Propietario</th> --}}
                            <th>Campo</th>
                            <th>Cuartel</th>
                            <th>Especie</th>
                            {{-- <th>Cantidad/Máxima/plantar</th> --}}
                            <th>Densidad de Plantación/Ha</th>
                            {{-- <th>Contratista/Ejecutor</th> --}}
                            <th>Observacion</th>
                            <th>Eliminar</th>
                            {{-- <th>Editar</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plantaciones as $Plantación)
                            <tr>
                                <td>{{ $Plantación->id }}</td>
                                <td>{{ $Plantación->fechaPlantacion }}</td>
                                {{-- <td>{{ $Plantación->cuartel->campo->empresa->nombre}}</td> --}}
                                <td>{{ $Plantación->cuartel->campo->campo }}</td>
                                <td>{{ $Plantación->cuartel->observaciones }}</td>
                                <td>{{ $Plantación->especie->especie }}</td>
                                {{-- <td>{{ $Plantación->cantidadPlantas }}</td> --}}
                                <td class="text-center">{{ $Plantación->cantidadPlantada }}</td>
                                {{-- <td>{{ $Plantación->contratista_id }}</td> --}}
                                <td>{{ $Plantación->observacion }}</td>
                                <td>
                                    @can('adm.eliminar.plantacion')
                                        <button type="button" onclick="EliminarPlantacion({{ $Plantación->id }})"
                                            class="inline-block rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    @endcan
                                </td>
                                {{-- <td>      
                                                    <button type="button" onclick="EliminarSolicitudCliente({{$Plantación->id}})" class="inline-block rounded bg-yellow-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-warning-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </button>
                                              

                                        </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>





            </div>


            <script>
                function EliminarPlantacion(id) {
                    $.get('/api/Eliminar/' + id + '/Plantacion', function(dato) {
                        if (dato == 1) {
                            Swal.fire(
                                'Plantacion',
                                'Plantacion Eliminado de la lista!',
                                'success'
                            )
                        }
                    });
                }
            </script>

        </div>
    </div>
</x-dashBoard>
