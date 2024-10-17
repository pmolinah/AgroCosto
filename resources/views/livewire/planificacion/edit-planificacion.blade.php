<div>
    <div class="py-5">
        <div class="sm:col-span-1 md:col-span-12">
            <h1 class="text-center mb-1 mt-0 text-xl font-medium ">
                Formulario edición planificación de Cosechas <!-- {{$planificacioncosecha_id}}-->
            </h1>
        </div>
       
        @foreach ($datosplanifdicacion as $datos)
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

                    <div class="col-span-5 p-2 ml-1 mt-2 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center mt-1">
                   
                        <input type="text" disabled value="{{$datos->cuartel->campo->empresa->nombre}}"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            id="especie_id" />
    
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Campo
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                       <input type="text" disabled value="{{$datos->cuartel->campo->campo}}"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            id="especie_id" />
                            <input type="hidden" value="{{$campo_id}}">
                            <input type="hidden" value="{{$envase_id}}">
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Cuartel
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                       <input type="text" disabled value="{{$datos->cuartel->observaciones}}"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            id="especie_id" />
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Especie
                    </div>
                    <div 
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" disabled value="{{$datos->plantacion->especie->especie}}"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            id="especie_id" />
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Variedad
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" disabled value="{{$datos->plantacion->especie->variedad->variedad}}"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            id="especie_id" />
                    </div>
                    <div class="sm:col-span-3 md:col-span-3 p-2 text-left">
                        <label>Cantidad Maxima en Cuartel</label>
                    </div>
                    <div
                        class="col-start-4 col-span-3 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" disabled value="{{$datos->plantacion->cantidadPlantas}}"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            id="CantidadMaxima" />
                    </div>
                    <div class="sm:col-span-3 md:col-span-3 p-2 text-left">
                        Cantidad Plantada
                    </div>
                    <div
                        class="col-start-4 col-span-3 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" disabled value="{{$datos->plantacion->cantidadPlantada}}"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            id="CantidadPlantada" />
                    </div>

                    <div class="sm:col-span-3 md:col-span-3 p-2 text-left">
                        Fecha Inicio
                    </div>
                    <div
                        class="col-start-4 col-span-3 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="date" name="fechai" disabled value="{{$datos->fechai}}"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent" />

                    </div>
                    <div class="sm:col-span-3 md:col-span-3 p-2 text-left">
                        Fecha Final
                    </div>
                    <div
                        class="col-start-4 col-span-3 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="date" name="fechaf" disabled value="{{$datos->fechaf}}"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent" />
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Envase
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" disabled value="{{$datos->envase->envase}}"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            id="especie_id" />
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Administrador
                    </div>

                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" id="stock" disabled value="{{$datos->cuartel->campo->adm->name}}"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent" />
                    </div>

                    {{-- <div class="sm:col-span-1 md:col-span-2 bg-danger-100 p-2 mt-2">
                    Administrador
                </div>

                <div class="sm:col-span-1 md:col-span-4 bg-neutral-600 text-neutral-50 mt-2">
                    <input type="text"
                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        id="Administrador" />
                </div> --}}
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Capataz
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" disabled value="{{$datos->cuartel->capataz->name}}"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"id="Capataz" />
                            
                    </div>
                </div>
        @endforeach
                {{-- segunda columna --}}
                <div
                    class="sm:col-span-1 md:col-span-6 grid sm:grid-cols-1 md:grid-cols-6 bg-neutral-100 mt-2 shadow-xl rounded-lg p-2">

                    <div class="sm:span-col-1 md:col-span-6 mb-2">
                        <h3 class="sm:col-span-1 md:col-span-6 font-bold text-center font-medium">
                            Datos Exportadora
                        </h3>
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left">
                        Exportadora
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <select  wire:model.defer="exportadoraid"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent">
                           
                            <option class="text-secondary">Seleccionar</option>
                            @foreach($exportadoras as $exportadora)
                                <option class="text-primary" value="{{$exportadora->id}}">{{$exportadora->razon_social}},{{$exportadora->id}}
                                    </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-1 md:col-span-1 p-2 text-left mt-1">
                        Kilos
                    </div>
                    <div
                        class="col-span-1 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center mt-1">
                        <input type="text" id="nuevoskilos" name="nuevoskilos" wire:model.defer="kiloSolicitados"
                            class="soloNumeros px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent" />
                    </div>
                    <div class="sm:col-span-1 text-center md:col-span-4 mr-3">
                        <button type="button" wire:click="agregaExportadora"
                            class="bg-gray-700 text-white  py-2 px-4 w-full ml-3 mt-1 rounded hover:bg-gray-600"> <!--id="Agregar"-->
                            Añadir Exportadora
                        </button>
                    </div>
                    <div class="sm:col-span-1 text-center p-2 md:col-span-1">
                        <h3 class="text-red-800 font-medium leading-tight text-left">
                            Total
                        </h3>
                    </div>
                    <div class="sm:col-span-1 text-left mt-1 md:col-span-1">
                        <div
                            class="col-span-2 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                            <input type="number" name="totalkilos" disabled
                                class="py-2 appearance-none outline-none text-gray-800 bg-transparent"
                                id="totadekilos" />
                        </div>
                    </div>

                    <div class="flex flex-col sm:col-span-1 md:col-span-6 p-1">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <div
                                        class="w-full rounded-xl border border-gray-200 bg-white py-2 px-2 shadow-md shadow-gray-100">
                                        <div class="flex max-h-[100px] w-full flex-col overflow-y-scroll">
                                            <table class="min-w-full text-left text-sm font-light" id="">
                                                <thead
                                                    class="border-b text-neutral-50 font-medium dark:border-neutral-500 bg-neutral-500">
                                                    <tr>
                                                        {{-- <th scope="col" class="px-6 py-2 text-center hidden sm:hidden md:block xl:block"> id</th> --}}
                                                        <th scope="col" class="px-6 py-1 md:block xl:block">
                                                            Exportadora
                                                        </th>
                                                        <th scope="col" class="px-6 py-1 text-center">Kilos</th>
                                                        <th scope="col" class="px-6 py-1 text-center">Stock/Bins
                                                        </th>
                                                        <th scope="col" class="px-6 py-1 text-center">Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-700">
                                                @foreach($datosplanifdicacion as $planificacion)
                                                @foreach($planificacion->exportadoraxplanificacion as $exportadora)
                                                    <tr>
                                                        <th scope="col" class="px-6 py-1 md:block xl:block">
                                                        {{$exportadora->empresa->razon_social}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-1 text-center">{{$exportadora->kilosSolicitados}}</th>
                                                        <th scope="col" class="px-6 py-1 text-center">{{$exportadora->cuentaenvase->saldo}}
                                                        </th>
                                                        <th scope="col" class="px-6 py-1 text-center"><a href="#" onclick="confirmarEliminacionExportadora({{ $exportadora->id }})"><i class="fa-solid fa-trash"></i></a></th> <!--wire:click="eliminaExportadora({{$exportadora->id}})"-->
                                                    </tr>
                                                @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                

                    <div class="sm:col-span-1 md:col-span-6 bg-neutral-100">
                        <h3 class="sm:col-span-1 md:col-span-6 text-center font-medium">
                            Datos de Contratista
                        </h3>
                    </div>

                    <div class="sm:col-span-1 text-left p-2 md:col-span-1">
                        Contratista
                    </div>
                    <div
                        class="col-span-5 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <select wire:model.defer="contratista_id"
                            class="px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent"
                            name="empresa_id">
                        @foreach($contratistas as $contratista)
                            <option class="text-secondary">Seleccionar</option>
                    
                                <option class="text-primary" value="{{$contratista->id}}">{{$contratista->razon_social}}
                                  </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-1 text-left p-2 md:col-span-1">
                        Trato $
                    </div>
                    <div
                        class="col-span-1 p-2 ml-1 h-10 bg-gray-100 flex border-2 border-gray-300 rounded items-center">
                        <input type="text" wire:model.defer="tratoxcosecha"
                            class="soloNumeros px-4 py-2 appearance-none outline-none text-gray-800 bg-transparent" />
                    </div>
                    <div class="col-span-4  ml-1 w-full">
                        <button type="button" wire:click="agregarContratista"
                            class="bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600">
                            Añadir Contratista
                        </button>
                    </div>
                    <div class="sm:col-span-1 text-center p-2 md:col-span-6">
                        <div>
                            <div class="flex flex-col sm:col-span-1 md:col-span-6">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                        <div class="overflow-hidden">
                                            <div
                                                class="w-full rounded-xl border border-gray-200 bg-white py-2 px-2 shadow-md shadow-gray-100">
                                                <div class="flex max-h-[100px] w-full flex-col overflow-y-scroll">
                                                    <table class="min-w-full text-left text-sm font-light"
                                                        id="">
                                                        <thead
                                                            class="border-b text-neutral-50 font-medium dark:border-neutral-500 bg-neutral-500">
                                                            <tr>
                                                                <!-- <th scope="col" class="px-6 py-1">id</th> -->
                                                                <th scope="col" class="px-6 py-1">Contratista</th>
                                                                <th scope="col" class="px-6 py-1 text-center">TratoxCosecha</th>
                                                                <th scope="col" class="px-6 py-1 text-center">Eliminar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-700">
                                                            @foreach($datosplanifdicacion as $planificacion)
                                                                @foreach($planificacion->contraistaxplanificacion as $contratista)
                                                                    <tr>
                                                                        <!-- <th scope="col" class="px-6 py-1">id</th> -->
                                                                        <th scope="col" class="px-6 py-1">{{$contratista->contratista->razon_social}}</th>
                                                                        <th scope="col" class="px-6 py-1 text-center">{{$contratista->tratoxcosecha}}</th>
                                                                        <th scope="col" class="px-6 py-1 text-center"><a href="#" onclick="confirmarEliminacionContratista({{ $contratista->id }})"><i class="fa-solid fa-trash"></i></a></th>
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach        
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
                        <!-- <button type="submit" id="btnGbr"
                            class="inline-block rounded bg-success-900 px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                            Actualizar Planificación
                        </button> -->
        </form>
    </div> 
    <script>
        function confirmarEliminacionExportadora(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.eliminarExportadora(id);  // Llamada al método Livewire
                }
            })
        }
    </script>
     <script>
        function confirmarEliminacionContratista(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.eliminarContratista(id);  // Llamada al método Livewire
                }
            })
        }
    </script>

    @if(session('success'))
        <script>
            Swal.fire(
                'Eliminado!',
                '{{ session('success') }}',
                'success'
            )
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire(
                'Error!',
                '{{ session('error') }}',
                'error'
            )
        </script>
    @endif
    @if(session('errorYaExiste'))
        <script>
            Swal.fire(
                'Error!',
                '{{ session('errorYaExiste') }}',
                'error'
            )
        </script>
    @endif

</div>
