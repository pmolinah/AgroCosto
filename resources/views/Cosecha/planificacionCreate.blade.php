<x-dashBoard>
    <div class="py-2">
        <div class="sm:col-span-1 md:col-span-12">
            <h1 class="text-center mb-1 mt-0 text-xl font-medium ">
                Formulario de Planificación de Cosecha.
            </h1>
        </div>

        <form action="{{ route('Planificacion.store') }}" method="post">
            @CSRF
            <div class="grid sm:grid-cols-1 md:grid-cols-12 gap-3">{{-- inicio 12 espacios --}}
                <div
                    class="sm:col-span-1 md:col-span-6 grid sm:grid-cols-1 md:grid-cols-6 p-2 bg-neutral-100 mt-2 shadow-xl rounded-lg">
                    <div class="sm:span-col-1 md:col-span-6">
                        <h3 class="sm:col-span-1 md:col-span-6 text-center font-medium">
                            Datos de la Cosecha
                        </h3>
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 mt-1 text-left">
                        Propietario
                    </div>

                    <div
                        class="col-span-5 p-2 ml-1 mt-2 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center mt-1">
                        <select id="empresaPlan_id" required
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            name="empresa_id">
                            <option value="" class="text-secondary">Seleccionar</option>
                            @foreach ($empresasC as $empresa)
                            <option class="text-primary" value="{{ $empresa->id }}">
                                {{ $empresa->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Campo
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <select id="campoPlan_id" required
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent" name="campo_id">
                            <option value="" class="text-secondary">Seleccionar</option>
                        </select>
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Cuartel
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <select id="cuartelPlan_id" required
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            name="cuartel_id">
                            <option value="" class="text-secondary">Seleccionar</option>
                        </select>
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Especie
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" disabled
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            id="especie_id" />
                        <input type="hidden" id="plantacion_id" name="plantacion_id">
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Variedad
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" disabled
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent" id="variedad" />
                    </div>
                    <div class="sm:col-span-3 md:col-span-3 p-2 text-left">
                        <label>Cantidad Maxima en Cuartel</label>
                    </div>
                    <div
                        class="col-start-4 col-span-3 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" disabled
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            id="CantidadMaxima" />
                    </div>
                    <div class="sm:col-span-3 md:col-span-3 p-2 text-left">
                        Cantidad Plantada
                    </div>
                    <div
                        class="col-start-4 col-span-3 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" disabled
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            id="CantidadPlantada" />
                    </div>

                    <div class="sm:col-span-3 md:col-span-3 p-2 text-left">
                        Fecha Inicio
                    </div>
                    <div
                        class="col-start-4 col-span-3 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="date" name="fechai" required
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent" />

                    </div>
                    <div class="sm:col-span-3 md:col-span-3 p-2 text-left">
                        Fecha Final
                    </div>
                    <div
                        class="col-start-4 col-span-3 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="date" name="fechaf" required
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent" />
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        kilos Solicitados
                    </div>

                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" name="kilosSolicitados" 
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent" />
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Envase
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <select id="envase_id" required
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            name="envase_id">
                            <option value="" class="text-secondary">Seleccionar</option>
                            @foreach ($envases as $envase)
                            <option class="text-primary" value="{{ $envase->id }}">
                                {{ $envase->envase }}, Kilos:{{ $envase->capacidad }},
                                Tara:{{ $envase->tara }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Stock
                    </div>

                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" id="stock" disabled
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent" />
                    </div>

                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Capataz
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" disabled
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent" id="Capataz" />
                    </div>
                </div>
                {{-- segunda columna --}}
                <div
                    class="sm:col-span-1 md:col-span-6 grid sm:grid-cols-1 md:grid-cols-6 bg-neutral-100 mt-2 shadow-xl rounded-lg p-2">
                    <div class="sm:col-span-1 md:col-span-6 bg-neutral-100">
                        <h3 class="text-center font-medium font-bold">
                            Datos de Contratista
                        </h3>
                    </div>

                    <div class="sm:col-span-1 text-left  md:col-span-1">
                        Contratista
                    </div>
                    <div class="col-span-5 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <select id="contratista_id"
                            class="px-4  appearance-none outline-none text-gray-800 bg-transparent" name="empresa_id">
                            <option class="text-secondary">Seleccionar</option>
                            @foreach ($empresasE as $empresa)
                            <option class="text-primary" value="{{ $empresa->id }}">
                                {{ $empresa->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-left  md:col-span-1">
                        Trato $
                    </div>
                    <div class="col-span-1  ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" id="tratoxcosecha" name="tratoxcosecha"
                            class="soloNumeros px-4  appearance-none outline-none text-gray-800 bg-transparent" />
                    </div>
                    <div class="md:col-span-2">
                        <button type="button" id="AgregarContratista"
                            class="bg-gray-700 text-white  py-2 px-4  rounded hover:bg-gray-600">
                            Añadir Contratista
                        </button>
                    </div>
                    <div class="text-center  md:col-span-6">
                        <div>
                            <div class="flex flex-col md:col-span-6">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                        <div class="overflow-hidden">
                                            <div
                                                class="w-full rounded-xl border border-gray-200 bg-white py-2 px-2 shadow-md shadow-gray-100">
                                                <div class="flex max-h-[100px] w-full flex-col overflow-y-scroll">
                                                    <table class="min-w-full text-left text-sm font-light" id="grilla2">
                                                        <thead
                                                            class="border-b text-neutral-50 font-medium dark:border-neutral-500 bg-neutral-500">
                                                            <tr>
                                                                <th scope="col" class="px-6 py-1">id</th>
                                                                <th scope="col" class="px-6 py-1">Contratista</th>
                                                                <th scope="col" class="px-6 py-1">TratoxCosecha
                                                                </th>
                                                                <th scope="col" class="px-6 py-1">Eliminar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-warning-200">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> {{-- fin 12 espacios --}}
                
                    {{-- <div class="text-center sm:span-col-1 md:col-span-6 m-5">
                            <button type="button"
                                class="inline-block rounded bg-danger-900 px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                Limpiar Formulario
                            </button>
                        </div> --}}
                    <div class="text-center sm:span-col-1 md:col-span-6 m-1">
                        <button type="submit" id="btnGbr"
                            class="inline-block rounded bg-success-900 px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                            Guardar Planificación
                        </button>
                    </div>
        </form>
  
</x-dashBoard>