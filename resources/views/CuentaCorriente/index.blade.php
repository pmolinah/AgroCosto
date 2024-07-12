<x-dashBoard>
    {{-- cuenta corriente de Campos --}}
    <form action="{{ route('CuenEnvaseCampo.store') }}" method="post">
        @CSRF
        <div class=" text-left grid sm:grid-cols-1 md:grid-cols-2">
            @can('adm.crear.cuentacorriente')
                <div class="bg-neutral-200 p-5 shadow-2xl ml-1 mr-5">
                    {{-- inicio form --}}
                    <div class="">
                        <div class="border-b border-gray-900/10">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Asignación de
                                Envases a Campos de Empresa</h2>
                            <p class="text-sm leading-6 text-gray-600">Ingreso de Stock de Envases
                                por tipo.</p>

                            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-6">
                                <div class="col-span-6">
                                    <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Empresa
                                        Principal.</label>
                                    <div class="mt-1">

                                        <h5 class="text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">

                                            <select id="empresa_id" name="empresa_id"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                <option>Seleccione Propietario</option>
                                                @foreach ($empresas as $empresa)
                                                    <option class="text-neutral-900" value="{{ $empresa->id }}">
                                                        {{ $empresa->razon_social }}</option>
                                                @endforeach
                                            </select>
                                        </h5>


                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="country"
                                        class="block text-sm font-medium leading-6 text-gray-900">Campo</label>
                                    <select id="campo_id" name="campo_id" wire:model.defer="campo_id"
                                        wire:change="cambioCampo"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">

                                    </select>
                                </div>

                                <div class="col-span-6">
                                    <label for="country"
                                        class="block text-sm font-medium leading-6 text-gray-900">Envase.</label>
                                    <div class="mt-1">
                                        <select id="country" name="envase_id"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Seleccione Envase</option>
                                            @foreach ($envaseCampo as $envase)
                                                <option value="{{ $envase->id }}">
                                                    {{ $envase->envase }}, Carga:
                                                    {{ $envase->capacidad }}K, Tara:
                                                    {{ $envase->tara }}K</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Saldo
                                        Inicial del Envase
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" disabled id="saldoInicialDos" value=0
                                            class="text-center block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div class="col-span-3">

                                </div>
                                {{-- desgloce envases --}}
                                <label for="first-name"
                                    class="mt-2 block text-sm font-medium leading-6  text-gray-900">Cantidad</label>
                                <div class="col-span-1">

                                    <input type="text" id="cantidadColorDos" onkeypress="return soloNumeros(event)"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <div class="col-span-2 mt-1">
                                    <select id="color_idDos"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option>Seleccionar Color</option>
                                        @foreach ($colores as $color)
                                            <option value="{{ $color->id }}">{{ $color->color }}
                                            </option>
                                        @endforeach
                                        <select>
                                </div>
                                <div class="col-span-2">
                                    <button id="btnsumarenvaseDos" type="button"
                                        class="rounded-md bg-primary-800 w-full px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Agregar
                                    </button>
                                </div>
                                <div class="col-span-6">
                                    {{-- caja con scroll --}}
                                    <!-- component -->
                                    <div class="flex  w-full flex-col items-center justify-center gap-y-2">
                                        <div
                                            class="w-[550px] rounded-xl border border-gray-200 bg-white py-2 px-2 shadow-md shadow-gray-100">
                                            <div
                                                class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
                                                <div>Resumen</div>
                                            </div>
                                            <div class="mt-2">
                                                <div class="flex max-h-[100px] w-full flex-col overflow-y-scroll">
                                                    <table class="w-full text-center text-sm font-light"
                                                        id="grillaColorDos">
                                                        <thead
                                                            class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-500">
                                                            <tr>
                                                                <th scope="col" class="border-2 px-2 py-2">
                                                                    Cantidad</th>
                                                                <th scope="col" class="border-2 px-2 py-2">Color
                                                                </th>
                                                                <td class="whitespace-nowrap border-2 px-2 py-2">
                                                                    Quitar</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- fin --}}

                                </div>
                                {{-- fin desgloce --}}
                                <div class="col-span-full">
                                    <label for="about"
                                        class="block text-sm font-medium leading-6 text-gray-900">Observaciones</label>
                                    <div class="mt-2">
                                        <textarea id="about" name="observacionDos" rows="1"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                    <p class="mt-1 text-sm leading-6 text-gray-600">Máximo
                                        100 Carácteres.
                                    </p>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="mt-3 flex items-center justify-end gap-x-6">
                        {{-- <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button> --}}
                        <button
                            class="ml-1 inline-block rounded bg-gray-700 text-white w-full py-2 px-4 rounded hover:bg-gray-300">Agregar
                            Envases a Cuenta Corriente de la Empresa.</button>
                    </div>
                    {{-- fin form --}}
                </div>
            @endcan
            <div class="border-solid border-2 bg-neutral-100 shadow-2xl">
                <table class="w-full text-center text-sm font-light ">
                    <thead
                        class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-500">
                        <tr class="border-solid ">
                            <th scope="col" class=" px-6 py-2 border-solid ">Campo.</th>
                            <th scope="col" class=" px-6 py-2 border-solid ">Tipo Envase</th>
                            <th scope="col" class=" px-6 py-2 border-solid ">Desglose de Envases</th>
                            <th scope="col" class=" px-6 py-2 border-solid ">Stock Consolidado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($envaseempresa as $empresaCampo)
                            <tr>
                                <th scope="col" class=" px-6 py-4 border-solid border-2 ">
                                    {{ $empresaCampo->campo->campo }}</th>
                                <th scope="col" class=" px-6 py-4 border-solid border-2 ">
                                    {{ $empresaCampo->envase->envase }}</th>
                                <th class="px-6 py-4 border-solid border-2">
                                    <table class="w-full border-solid border-2 shadow-lg">
                                        <thead>
                                            <tr class="border-solid border-2 bg-neutral-500 text-white">
                                                <th class="border-solid border-2">Color</th>
                                                <th class="border-solid border-2">Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $cant=0; @endphp
                                            @foreach ($empresaCampo->desgloseenvasecampo as $desgloseEnvase)
                                                <tr class="border-solid border-2 ">
                                                    <th class="border-solid border-2 ">
                                                        {{ $desgloseEnvase->color->color }}</th>
                                                    <th class="border-solid border-2">{{ $desgloseEnvase->stock }}
                                                    </th>
                                                    @php $cant = $cant + $desgloseEnvase->stock; @endphp
                                                </tr>
                                            @endforeach
                                            <tr class="border-solid border-2 ">
                                                <th class="border-solid border-2">-</th>
                                                <th class="border-solid border-2">-</th>
                                            </tr>
                                            <tr class="border-solid border-2">
                                                <th class="border-solid border-2 bg-neutral-500 text-white">Total
                                                    Envases Campo:</th>
                                                <th class="border-solid border-2">{{ $cant }}</th>
                                            <tr>
                                        </tbody>
                                    </table>
                                </th>
                                <th scope="col" class=" px-6 py-4 border-solid border-2">
                                    <table class="w-full border-solid border-2 shadow-lg">
                                        <thead>
                                            <tr>
                                                <th class="border-solid border-2 bg-neutral-500 text-white">Empresa
                                                </th>
                                                <th class="border-solid border-2 bg-neutral-500 text-white">Stock</th>
                                            <tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cuentaExportadoras as $cuentaExportadora)
                                                @if ($empresaCampo->campo->id == $cuentaExportadora->campo_id)
                                                    <tr>
                                                        <th class="border-solid border-2">
                                                            {{ $cuentaExportadora->empresa->razon_social }}</th>
                                                        <th class="border-solid border-2">
                                                            {{ $cuentaExportadora->saldo }}</th>
                                                        @php
                                                            $sum = 0;
                                                            $sum = $sum + $cuentaExportadora->saldo;
                                                        @endphp
                                                    </tr>
                                                @endif
                                            @endforeach
                                            <tr>
                                                <th class="border-solid border-2">Campo</th>

                                                <th>
                                                    @if (isset($sum))
                                                        {{ $empresaCampo->stock - $sum }}
                                                    @else
                                                        {{ $empresaCampo->stock }}
                                                    @endif
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="border-solid border-2 bg-neutral-500 text-white">Total Campo
                                                    </td>
                                                <th>{{ $empresaCampo->stock }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </th>
                                {{-- <th scope="col" class=" px-6 py-4 border-solid border-2 border-sky-500">
                                                         <center><button type="button" id="btnEliminarCampo"
                                                                data-valor="{{ $empresaCampo->id }}"
                                                                class="mb-1 inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i
                                                                    class="far fa-trash-alt"></i></button>
                                                        </center>
                                                    </th> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            window.addEventListener('GuardarEmnvaseEmpresa', function(e) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito, Registro Guardado...',
                    text: '{{ Session::get('success') }}',
                    timer: 5000,
                    showConfirmButton: false
                });
            });
            window.addEventListener('EliminarEmnvaseEmpresa', function(e) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Éxito, Registro Eliminado...',
                    text: '{{ Session::get('success') }}',
                    timer: 5000,
                    showConfirmButton: false
                });
            });
            window.addEventListener('ActualizarEnvaseEmpresa', function(e) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito, Registro Actualizado...',
                    text: '{{ Session::get('success') }}',
                    timer: 5000,
                    showConfirmButton: false
                });
            });
        </script>
        {{-- fin cuenta corriente de Campos --}}
    </form>
</x-dashBoard>
