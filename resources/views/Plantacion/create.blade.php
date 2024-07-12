<x-dashBoard>
    <div class="py-2">
        <div class=" ml-5">
            <h1 class="text-left text-xl font-medium ">
                Formulario de Plantación de Especies
            </h1>
        </div>
        <form action="{{ route('Plantacion.store') }}" method="post">
            @CSRF
            {{-- grid de fondo completo --}}
            <div class="grid xs:grid-cols-1 md:lg:xl:grid-cols-12 gap-3 p-5">
                {{-- inicio --}}
                <div class="col-span-4 text-left rounded-lg bg-white p-1 shadow-lg">
                    <div class="font-bold px-6 py-1 text-neutral-900 bg-neutral-300">
                        1.-Propietario.
                    </div>
                    <div class="">
                        <select class="text-neutral-900 p-2 border-2" required id="empresa_id" name="empresa_id">
                            <option value="" class="">Seleccionar</option>
                            @foreach ($empresas as $empresa)
                                <option class="" value="{{ $empresa->id }}">
                                    {{ $empresa->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- fin --}}
                {{-- inicio --}}
                <div class="col-span-4 text-left rounded-lg bg-white p-1 shadow-lg">
                    <div class="font-bold px-6 py-1 text-neutral-900 bg-neutral-300">
                        2.- Campo
                    </div>
                    <div class="">
                        <select class="text-neutral-900 p-2 border-2" required id="campo_id" name="campo_id">
                        </select>
                        </h5>
                    </div>
                </div>
                {{-- fin --}}
                {{-- inicio --}}
                <div class="col-span-4 text-left rounded-lg bg-white p-1 shadow-lg">
                    <div class="font-bold px-6 py-1 text-neutral-900 bg-neutral-300">
                        3.- Seleccione Cuartel
                    </div>
                    <div class="">
                        <select class="text-neutral-900 p-2 border-2" required id="cuartel_id" name="cuartel_id">
                        </select>
                        </h5>
                    </div>
                </div>
                {{-- fin --}}
                {{-- informacion de la plantaciones --}}
                <div class="text-left col-span-6 bg-white shadow-lg p-2 rounded-lg">
                    <label class="block text-sm font-medium leading-6 text-neutral-900 font-bold">Responsable</label>
                    <div class="mt-2 text-neutral-900">
                        <select name="contratista_id" required class="text-neutral-900 border-2 p-2" id="empresa_id">
                            <option value=""><label
                                    class="block text-sm font-medium leading-6 text-neutral-900">Seleccionar</label>
                            </option>
                            @foreach ($administrador as $administrador)
                                <option value="{{ $administrador->id }}"><label
                                        class="block text-sm font-medium leading-6 text-neutral-900 font-bold">{{ $administrador->name }}</label>
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-left col-span-6 bg-white shadow-lg p-2 rounded-lg">
                    <div class="mt-2">
                        <label
                            class="block text-sm font-medium leading-6 text-neutral-900 font-bold">Observaciones</label>
                        <textarea id="about" name="observacion" rows="2" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                </div>
                <div class="col-span-12 text-center p-4">
                    <h2 class="text-base font-semibold leading-7 text-neutral-900">
                        Caracteristicas de la Plantación
                    </h2>
                    <div class="">
                        <label class="text-sm font-medium leading-6 text-neutral-900 font-bold text-center">Superficie
                            de Cuartel</label>
                        <div class="mt-2">
                            <input type="text" name="superficiecuartel" id="superficiecuartel" disabled
                                class="text-center rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
                <div class="col-span-6 bg-white rounded-lg shadow-lg text-left p-2">
                    <div>
                        <label class="text-neutral-900">Seleccionar</label>
                    </div>
                    <select name="especie_id" required class="text-neutral-900  border-2 p-2" id="especie_id">
                        <option value=""><label class="">
                                Especie</label></option>
                        @foreach ($especies as $especie)
                            <option value="{{ $especie->id }}"><label class="">Especie: {{ $especie->especie }},
                                    Variedad: {{ $especie->variedad->variedad }}</label>
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 bg-white rounded-lg shadow-lg text-left p-2">
                    <label class="block text-sm font-medium leading-6 text-neutral-900 font-bold text-center">Fecha
                        Plantación</label>
                    <div class="mt-2">
                        <input type="date" name="fechaPlantacion" required
                            class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="col-span-2 bg-white rounded-lg shadow-lg text-left p-2">
                    <label class="block text-sm font-medium leading-6 text-neutral-900 font-bold text-center">Cantidad
                        Plantas Máxima</label>
                    <div class="mt-2">
                        <input type="text" name="cantidadPlantasDisabled" id="cantidadPlantasDisabled" disabled
                            class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <input type="hidden" name="cantidadPlantas" id="cantidadPlantas"
                            class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="col-span-2 bg-white rounded-lg shadow-lg text-left p-2">
                    <label class=" block text-sm font-medium leading-6 text-neutral-900 font-bold text-center">Cantidad
                        Plantada </label>
                    <div class="mt-2">
                        <input type="text" name="cantidadPlantada" id="cantidadPlantada" required
                            class="soloNumeros text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="col-span-3 bg-white rounded-lg shadow-lg text-left p-2">
                    <button type="submit"
                        class="bg-gray-700 text-white w-full py-2 px-4 mb-1 rounded hover:bg-gray-600 ">Guardar
                        Plantación</button>
                </div>
            </div>
        </form>
    </div>
</x-dashBoard>
