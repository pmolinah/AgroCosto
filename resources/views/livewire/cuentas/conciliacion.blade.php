<div>
    <div class="w-full rounded-xl border border-gray-200 bg-white py-2 px-2 shadow-md shadow-neutral-800">

        <div class="">
            <div class="flex max-h-[700px] w-full flex-col overflow-y-scroll">
                {{-- inicio guia --}}
                <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 shadow-2xl p-3 mb-2">
                    {{-- tabla de resunmen --}}
                    <div class="col-span-6 p-1 text-center">
                        <label>Crear Entidades Bancarias</label>
                        <table class="mt-1 border-2 w-full text-center">
                            <thead class="w-full mt-3 border-2">

                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-28 font-bold mt-3 border-2 px-6">Ent/Banc</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">Contacto</td>
                                    <td class="w-24 font-bold mt-3 border-2">Email</td>

                                    <td class="w-1 text-sm font-bold mt-3 border-2">+/-</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="mt-3 border-2">
                                    <td class="w-28 font-bold mt-3 border-2 ">
                                        <input type="text" class=" w-full" wire:model.defer="entidad">
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2"><input type="text"
                                            class=" w-full" wire:model.defer="contacto"></td>

                                    <td class="w-24 font-bold mt-3 border-2"><input type="text" class=" w-full"
                                            wire:model.defer="email"></td>
                                    <td class="w-1 font-bold mt-3 border-2"><a href="#" wire:click="saveEntidad"
                                            class="">
                                            <i class="fa-solid fa-plus"></i>
                                        </a></td>
                                </tr>
                                <div class="flex max-h-[50px] w-full flex-col overflow-y-scroll">
                                    @foreach($entidades as $entidad)
                                    <tr class="mt-3 border-2">
                                        <td class="font-bold text-center mt-3 border-2">
                                            {{$entidad->banco}}
                                        </td>
                                        <td class="font-bold text-center mt-3 border-2">
                                            {{$entidad->contacto}}
                                        </td>
                                        <td class="font-bold text-center mt-3 border-2">
                                            {{$entidad->mail}}
                                        </td>

                                        <td class="w-1 font-bold text-center mt-3 border-2">
                                            <a href="#" wire:click="" class="">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </div>
                            </tbody>
                        </table>
                    </div>

                    {{-- fin tabla de resumen --}}
                    {{-- tabla de resunmen --}}
                    <div class="col-span-4 p-2 text-center">
                        <table class="mt-1 border-2 w-full">
                            <label>Lista de Cuentas</label>
                            <thead class="w-full mt-3 border-2">

                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-24 font-bold mt-3 border-2 px-6">Entidad/Bancaria</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">Cuenta</td>
                                    <td class="w-24 font-bold mt-3 border-2">Saldo.I</td>
                                    <td class="w-24 font-bold mt-3 border-2">S.Actual</td>
                                    <!-- <td class="w-24 font-bold mt-3 border-2">Cantidad</td>
                                    <td class="w-24 font-bold mt-3 border-2">Restante</td>
                                    <td class="w-24 font-bold mt-3 border-2">Valor</td> -->
                                    <td class="text-sm font-bold mt-3 border-2">+</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="mt-3 border-2 ">
                                    <td class="w-24 font-bold mt-3 border-2">
                                        <select wire:model.defer="entidad_id"
                                            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Entidad</option>
                                            @foreach($entidades as $entidad)
                                            <option value="{{$entidad->id}}">{{$entidad->banco}} </option>
                                            @endforeach

                                        </select>
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2"><input type="text"
                                            class=" w-full" wire:model.defer="cuenta"></td>
                                    <td class="w-24 font-bold mt-3 border-2"><input type="text" class=" w-full"
                                            wire:model.defer="saldo_inicial"></td>
                                    <td class="w-24 font-bold mt-3 border-2"><input type="text" class=" w-full"></td>
                                    <!-- <td class="w-24 font-bold mt-3 border-2"><input type="text" class="text-right w-24"
                                            wire:model.defer=""></td> -->
                                    <!-- <td class="w-24 font-bold mt-3 border-2">Costo/Un</td> -->
                                    <!-- <td class="w-24 font-bold mt-3 border-2"></td>
                                    <td class="w-24 font-bold mt-3 border-2"></td> -->
                                    <td class="text-sm font-bold mt-3 border-2"><a href="#"
                                            wire:click="saveCuenta">+</a></td>
                                </tr>
                                @foreach($cuentas as $cuenta)
                                <tr class="mt-3 border-2">
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        {{$cuenta->banco->banco}}
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        {{$cuenta->cuenta}}
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        {{$cuenta->saldo_inicial}}
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        {{$cuenta->saldo_real}}
                                    </td>
                                    <!-- <td class="w-24 font-bold text-center mt-3 border-2">
                                        </td>
                                        <td class="w-24 font-bold text-center mt-3 border-2">
                                        </td>
                                        <td class="w-24 font-bold text-center mt-3 border-2">
                                        </td> -->
                                    <td class="w-1 font-bold text-center mt-3 border-2">
                                        <a href="#" wire:click="" class="">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- fin cuantas -->
                    <div class="col-span-2 p-2 text-center">
                        <table class="mt-1 border-2 w-full">
                            <label>Crear Conceptos</label>
                            <thead class="w-full mt-3 border-2">

                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-24 font-bold mt-3 border-2 px-6">Concepto</td>
                                    <td class="text-sm font-bold mt-3 border-2">+</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="mt-3 border-2 ">
                                    <td class="w-24 font-bold mt-3 border-2">
                                        <input type="text" class=" w-full" wire:model.defer="concepto">
                                    </td>
                                    <!-- <td class="w-24 font-bold text-center mt-3 border-2"><input type="text"
                                    class=" w-full" wire:model.defer="cuenta"></td>
                                    <td class="w-24 font-bold mt-3 border-2"><input type="text" class=" w-full"
                                            wire:model.defer=""></td> -->
                                    <!-- <td class="w-24 font-bold mt-3 border-2"><input type="text" class="text-right w-24"
                                            wire:model.defer=""></td> -->
                                    <!-- <td class="w-24 font-bold mt-3 border-2">Costo/Un</td> -->
                                    <!-- <td class="w-24 font-bold mt-3 border-2"></td>
                                    <td class="w-24 font-bold mt-3 border-2"></td> -->
                                    <td class="text-sm font-bold mt-3 border-2"><a href="#"
                                            wire:click="saveConcepto">+</a></td>
                                </tr>
                                @foreach($conceptos as $concepto)
                                <tr class="mt-3 border-2">
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        {{$concepto->concepto}}
                                    </td>

                                    <td class="w-1 font-bold text-center mt-3 border-2">
                                        <a href="#" wire:click="" class="">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- fin cuantas -->

                </div>
                <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 shadow-2xl p-2 mb-2">
                    <div class="col-span-12 text-center m-2 font-bold">Centro de Costo</div>
                    <div class="col-span-4">
                        <select wire:model.defer="empresa_id" wire:change="cambioEmpresa"
                            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Propietario</option>
                            @foreach($empresas as $empresa)
                            <option value="{{$empresa->id}}">{{$empresa->razon_social}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-4">
                        <select wire:model.defer="campo_id" wire:change="cambioCampo"
                            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccionar Campo</option>
                            @foreach($campos as $campo)
                            <option value="{{$campo->id}}">{{$campo->campo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-4 text-left ml-5">
                        <!-- <select wire:model.defer="cuartel_id"
                            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Seleccionar Cuartel</option>
                            @foreach($cuarteles as $cuartel)
                            <option value="{{$cuartel->id}}">{{$cuartel->observaciones}}</option>
                            @endforeach
                        </select> -->
                        @foreach($cuarteles as $cuartel)
                        <label><input type="checkbox" value="{{$cuartel->id}}" wire:model.defer="cantidadCuarteles"
                                class="mr-5">{{$cuartel->observaciones}}</label><br />
                        @endforeach
                    </div>
                   
                  
                    {{-- <div class="col-start-10  col-span-3  text-right mt-1 p-2">
                    <button type="button" wire:click="" class="inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                        Eliminar Guía de Recepción
                    </button>
                </div> --}}

                </div>

                <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 shadow-2xl p-3">
                    <div class="text-center col-span-12 ">
                        <h6 class="col-span-2 font-bold p-2 ">Detalle Movimientos Cuentas Corrientes
                        </h6>
                    </div>
                    <!-- busqueda -->
                    {{-- tabla de resunmen --}}
                    <div class="col-span-6 p-1 text-center">
                        <label>Buscar Movimientos</label>
                        <table class="mt-1 border-2 w-full text-center">
                            <thead class="w-full mt-3 border-2">

                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-28 font-bold mt-3 border-2 px-6">Ent/Banc</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">Cuenta</td>
                                    <td class="w-24 font-bold mt-3 border-2">Fecha Inicial</td>
                                    <td class="w-24 font-bold mt-3 border-2">Fecha Final</td>

                                    <td class="w-1 text-sm font-bold mt-3 border-2"> <i class="fa-solid fa-search"></i>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="mt-3 border-2">
                                    <td class="w-28 font-bold mt-3 border-2 ">
                                        <select wire:model.defer="buscarBanco_id" wire:change="buscarBancoCambio"
                                            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Entidad</option>
                                            @foreach($buscarBancos as $buscarBanco)
                                            <option value="{{$buscarBanco->id}}">{{$buscarBanco->banco}} </option>
                                            @endforeach

                                        </select>
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        <select wire:model.defer="buscarCuenta_id"
                                            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Cuenta</option>
                                            @foreach($buscarCuentas as $buscarCuenta)
                                            <option value="{{$buscarCuenta->id}}">{{$buscarCuenta->cuenta}} </option>
                                            @endforeach

                                        </select>
                                    </td>

                                    <td class="w-24 font-bold mt-3 border-2"><input type="date" class=" w-full"
                                            wire:model.defer="fechai"></td>
                                    <td class="w-24 font-bold mt-3 border-2"><input type="date" class=" w-full"
                                            wire:model.defer="fechaf"></td>
                                    <td class="w-1 font-bold mt-3 border-2"><a href="#" wire:click="buscarMovimientos"
                                            class="">
                                            <i class="fa-solid fa-search"></i>
                                        </a></td>
                                </tr>
                              
                            </tbody>
                        </table>
                    </div>

                    {{-- fin tabla de resumen --}}
                    {{-- tabla de resunmen --}}
                    <div class="col-span-6 p-1 text-center">
                        <label>Resultados de Movimientos por periodos de fecha</label>
                        <table class="mt-1 border-2 w-full text-center">
                            <thead class="w-full mt-3 border-2">

                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-28 font-bold mt-3 border-2 px-6">Tipo</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">monto Ejecutado</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">monto Pendiente</td>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="mt-3 border-2">
                                    <td class="w-28 font-bold mt-3 border-2 ">
                                        Cargos
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        {{$totalCargos}}
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        {{$totalCargosPendiente}}
                                    </td>
                                   
                                </tr>
                                <tr class="mt-3 border-2">
                                    <td class="w-28 font-bold mt-3 border-2 ">
                                        Abonos
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        {{$totalAbonos}}
                                    </td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">
                                        {{$totalAbonosPendiente}}
                                    </td>

                                 
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>

                    {{-- fin tabla de resumen --}}

                    <!-- fin buswq -->
                    <!-- <div class="col-span-12">
                        <table class="mt-3 border-2text-left">
                            <thead class="w-full mt-3 border-2">

                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-24 font-bold mt-3 border-2">Tipo Act.</td>
                                    <td class="w-96 font-bold mt-3 border-2">Costo</td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">U/M</td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">Cantidad</td>
                                    <td class="w-96 font-bold text-center mt-3 border-2">.</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2"><div class=""></div></td>
                                    <td class="w-24 font-bold text-center mt-3 border-2 p-2"><i
                                            class="fa-solid fa-trash"></i></td>
                                </tr>
                                <tr class="mt-3 border-2">
                                    <td class="text-center w-24 font-bold mt-3 border-2"><input type="text"
                                            wire:model.defer="Cantidad" class="uppercase w-24 h-7" value=""
                                            placeholder="Cantidad"></td>
                                    <td class="w-96 font-bold mt-3 border-2">
                                        <select wire:model.defer="envase_id"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Envase</option>

                                            <option value="">
                                            </option>

                                        </select>
                                    </td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">
                                        <select wire:model.defer="color_id"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Color</option>

                                            <option value=""></option>

                                        </select>

                                    </td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">
                                        <select wire:model.defer="observacion" wire:change="cambioEspTotKil"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Observación</option>

                                            <option value="">
                                            </option>

                                        </select>
                                    </td>
                                    <td class="w-96 font-bold text-center mt-3 border-2">
                                        <select wire:model.defer="especie_id"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option value="NULL"></option>

                                            <option value="">
                                            </option>

                                        </select>


                                    </td>
                                    <td class="text-center w-24 font-bold text-center mt-3 border-2"><input type="text"
                                            wire:model.defer="kilos" class="uppercase w-24 h-7" value=""
                                            placeholder="Kilos"></td>
                                    <td class="w-24 font-bold text-center mt-3 border-2 p-2">
                                        <button type="button" wire:click="AgregarLinea"
                                            class="inline-block rounded bg-success-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>

                                <tr class="mt-3 border-2">
                                    <td class="font-bold text-center mt-3 border-2">
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        <button type="button" wire:click=""
                                            class="inline-block rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div> -->

                    {{-- tabla de resunmen --}}
                    <div class="col-span-12 p-1 text-center">
                        <label>Movimientos</label>
                        <table class="mt-1 border-2 w-full text-center">
                            <thead class="w-full mt-3 border-2">

                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-20 font-bold mt-3 border-2 px-6">Fecha</td>
                                    <td class="w-20 font-bold mt-3 border-2 px-6">Entidad</td>
                                    <td class="w-24 font-bold mt-3 border-2 ">Cuenta</td>
                                    <td class="w-24 font-bold text-center mt-3 border-2">Concepto</td>
                                    <td class="w-24 font-bold mt-3 border-2">Acre/Deudor</td>
                                    <td class="w-24 font-bold mt-3 border-2">Tipo Mov.</td>
                                    <td class="w-24 font-bold mt-3 border-2">Forma Pago</td>
                                    <td class="w-24 font-bold mt-3 border-2 whitespace-nowrap">N°Docum.</td>
                                    <td class="w-24 font-bold mt-3 border-2 whitespace-nowrap">Importe</td>
                                    <!-- <td class="text-sm font-bold mt-3 border-2">P</td> -->

                                    <td class="text-sm font-bold mt-3 border-2">Acción</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="mt-3 border-2">
                                    <td class="w-20 font-bold text-center mt-3 border-2"><input type="date"
                                            class=" w-20" wire:model.defer="fecha"></td>
                                    <td class="w-48 font-bold mt-3 border-2">
                                        <select wire:model.defer="bancoIngresos_id" wire:change="bancoIngresoCambio"
                                            class="w-20 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Entidad</option>
                                            @foreach($bancoIngresos as $bancoIngreso)
                                            <option value="{{$bancoIngreso->id}}">{{$bancoIngreso->banco}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="w-28 font-bold mt-3 border-2">
                                        <select wire:model.defer="cuentaIngresos_id"
                                            class="w-28 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Cuenta</option>
                                            @foreach($cuentaIngresos as $cuentaIngreso)
                                            <option value="{{$cuentaIngreso->id}}">{{$cuentaIngreso->cuenta}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="w-48 font-bold mt-3 border-2">
                                        <select wire:model.defer="conceptoIngreso_id" wire:change=""
                                            class="w-48 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Concepto</option>
                                            @foreach($conceptos as $concepto)
                                            <option value="{{$concepto->id}}">{{$concepto->concepto}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="w-24 font-bold mt-3 border-2">
                                        <select wire:model.defer="cliente_id"
                                            class="w-48 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Seleccionar</option>
                                            @foreach($empresas as $empresa)
                                            <option value="{{$empresa->id}}">{{$empresa->razon_social}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="w-24 font-bold mt-3 border-2">
                                        <select wire:model.defer="tipo_id"
                                            class="w-24 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Seleccionar</option>

                                            <option value="1">Abono</option>
                                            <option value="2">Cargo</option>

                                        </select>
                                    </td>
                                    <td class="w-24 font-bold mt-3 border-2">
                                        <select wire:model.defer="formapago_id"
                                            class="w-24 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Seleccionar</option>

                                            <option value="1">Efectivo</option>
                                            <option value="2">Transferencia</option>
                                            <option value="3">Cheque</option>
                                            <option value="4">Deposito</option>
                                            <option value="5">Pago Web</option>

                                        </select>
                                    </td>

                                    <td class="w-24 font-bold mt-3 border-2  whitespace-nowrap">

                                        <input type="text" class=" w-full" wire:model.defer="ndocumento">
                                    </td>

                                    <td class="w-24 font-bold mt-3 border-2  whitespace-nowrap">

                                        <input type="text" class=" w-20" wire:model.defer="importe">
                                    </td>
                                    <!-- <td class="text-sm font-bold mt-3 border-2 space-x-1">

                                        <input type="checkbox"  wire:model.defer="prorroteo">
                                    </td> -->
                                    <td class="w-24 font-bold mt-3 border-2  whitespace-nowrap">
                                        <!-- <a href="#" wire:click="" class="">
                                            <i class="fa-solid fa-plus"></i>
                                        </a> -->
                                        <button type="button" wire:click="EjecutarLinea"
                                            class="inline-block rounded bg-green-800 p-1 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                            Ej
                                        </button>
                                        <button type="button" wire:click="GrabarLineaPendiente"
                                            class="inline-block rounded bg-red-800 p-1 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                            Gr
                                        </button>
                                    </td>
                                </tr>
                                @foreach($movimientos as $movimiento)
                                <tr class="mt-3 border-2">
                                    <td class="font-bold text-center mt-3 border-2">{{$movimiento->fecha}}</td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{$movimiento->cuenta->banco->banco}}</td>
                                    <td class="font-bold text-center mt-3 border-2">{{$movimiento->cuenta_id}}</td>
                                    <td class="font-bold text-center mt-3 border-2">{{$movimiento->concepto->concepto}}
                                    </td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        {{$movimiento->cliente->razon_social}}</td>
                                    <td class="font-bold text-center mt-3 border-2">
                                        @if($movimiento->tipo_id==1)
                                        Abono
                                        @else
                                        Cargo
                                        @endif
                                    </td>
                                    <td class="text-sm font-bold mt-3 border-2">
                                        @if($movimiento->formapago_id==1)
                                        Efectivo
                                        @elseif($movimiento->formapago_id==2)
                                        Transferencia
                                        @elseif($movimiento->formapago_id==3)
                                        Cheque
                                        @else
                                        Deposito
                                        @endif

                                    </td>
                                    <td class="text-sm font-bold mt-3 border-2">{{$movimiento->ndocumento}}</td>
                                    <td class="text-sm font-bold mt-3 border-2">{{$movimiento->importe}} </td>
                                    <td class="text-sm font-bold mt-3 border-2"><a href="#"
                                            wire:click="eliminaLineaCargoAbono({{$movimiento->id}})"><i
                                                class="fa-solid fa-trash"></i></a>

                                        <!-- Botón para abrir el modal -->
                                        <!-- <a href="#" wire:click="modalDetalleMovimiento({{$movimiento->id}})" onclick="toggleModal()">
                                            <i class="fa-solid fa-plus"></i>
                                        </a> -->
                                         - <a href="#" wire:click="modalDetalleMovimiento({{ $movimiento->id }})">
                                            <i class="fa-solid fa-plus"></i>
                                        </a> 
                                        @if($movimiento->estado==2)
                                        <a href="#" class="text-red-500"
                                            wire:click="modalActualizacionDetalleMovimiento({{ $movimiento->id }})">
                                            <i class="fa-solid fa-rotate-right"></i>
                                        </a>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal ingreso detalle movimiento -->
                    <div id="modal"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
                        <div class="bg-white rounded-lg shadow-lg w-3/4">
                            <!-- Encabezado del Modal -->
                            <div class="px-4 py-3 border-b text-left">
                                <h2 class="text-xl font-semibold text-gray-700">Detalle del Movimiento cargado o abonado
                                    de la factura o guía</h2>
                            </div>
                            <!-- Contenido del Modal -->
                            <div class="p-4">
                                <!-- component -->
                                <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900">Detalle</th>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900">Cantidad
                                                </th>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900">Precio</th>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900">Total</th>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900 text-center">
                                                    Acciones
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="px-6 mb-3 font-medium text-gray-900">
                                                    <select wire:model.defer="ite"
                                                        class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                        <option>Seleccionar</option>
                                                        @foreach($items as $item)
                                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                                        @endforeach

                                                    </select>
                                                </th>
                                                <th scope="col" class="px-6  font-medium text-gray-900"><input
                                                        type="text" class=" w-20 border-2" wire:model.defer="can"></th>
                                                <th scope="col" class="px-6  font-medium text-gray-900"><input
                                                        type="text" class=" w-20 border-2" wire:model.defer="pre"></th>
                                                <th scope="col" class="px-6  font-medium text-gray-900"><input
                                                        type="text" class=" w-20 border-2" wire:model.defer="tot"></th>
                                                <th scope="col" class="px-6  font-medium text-gray-900 text-center"><a
                                                        href="#" wire:click="sumaDetalle"><i
                                                            class="fa-solid fa-plus"></i></a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                                            @if (isset($detalleMovimiento))
                                            @foreach($detalleMovimiento as $detalle)
                                            <tr class="hover:bg-gray-50">
                                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                                    {{$detalle->item->nombre}}
                                                </th>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                                        {{$detalle->cantidad}}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">{{$detalle->precio}}</td>
                                                <td class="px-6 py-4">
                                                    <div class="flex gap-2">
                                                        @php echo $detalle->precio*$detalle->cantidad @endphp
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <a href="#" wire:click="eliminaSumaDetalle( {{$detalle->id }})"><i
                                                            class="fa-solid fa-trash red-700 mr-5"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Pie de Modal con botones -->
                            <div class="flex justify-end px-4 py-3 border-t">
                                <button onclick="toggleModal()"
                                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">Salir</button>
                                <!-- <button
                                        class="px-4 py-2 ml-2 text-white bg-blue-600 rounded hover:bg-blue-700">Aceptar</button> -->
                            </div>
                        </div>
                    </div>
                    <!-- fin modal -->
                    <!-- Modal actualización datos del movimiento -->
                    <div id="modalActualizar"
                        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
                        <div class="bg-white rounded-lg shadow-lg w-3/4">
                            <!-- Encabezado del Modal -->
                            <div class="px-4 py-3 border-b text-left">
                                <h2 class="text-xl font-semibold text-gray-700">Actualización de Movimiento, Cuenta {{$this->actualizarCuenta}}</h2>
                            </div>

                            <!-- Contenido del Modal -->
                            <div class="p-4">
                                <!-- component -->
                                <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900">Fecha</th>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900">Concepto
                                                </th>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900">Acre/Deudor
                                                </th>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900">Tipo Mov.
                                                </th>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900">Forma Pago
                                                </th>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900">N°Docum.
                                                </th>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900">Importe</th>
                                                <th scope="col" class="px-6 py-2 font-medium text-gray-900 text-center">
                                                    Acciones
                                                </th>
                                            </tr>
                                          
                                        </thead>
                                        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                                        
                                            <tr class="hover:bg-gray-50">
                                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                                    {{$actualizarFecha}}
                                                </th>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                                        {{$actualizarConcepto}}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                                        {{$actualizarCliente}}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                                        @if($actualizarTipo==1)
                                                        Abono
                                                        @else
                                                        Cargo
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <select wire:model.defer="actualizarFormaPago"
                                                        class="w-24 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                        <option>Seleccionar</option>
                                                        <option value="1">Efectivo</option>
                                                        <option value="2">Transferencia</option>
                                                        <option value="3">Cheque</option>
                                                        <option value="4">Deposito</option>
                                                        <option value="5">Pago Web</option>
                                                    </select>
                                                </td>
                                                <td class="px-6 py-4"><input type="text" class=" w-20 border-2"
                                                        wire:model.defer="actualizarDocumento">
                                                </td>
                                                <td class="px-6 py-4"><input type="text" class=" w-20 border-2" 
                                                        wire:model.defer="actualizarImporte">
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <a href="#"
                                                        wire:click="ActualizarMovimiento( {{$actualizarID }})"><i class="fa-solid fa-rotate-right"></i></a>
                                                </td>
                                            </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Pie de Modal con botones -->
                            <div class="flex justify-end px-4 py-3 border-t">
                                <button onclick="toggleModalActualizar()"
                                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">Salir</button>
                                <!-- <button
                                        class="px-4 py-2 ml-2 text-white bg-blue-600 rounded hover:bg-blue-700">Aceptar</button> -->
                            </div>
                        </div>
                    </div>
                    <!-- fin modal -->
                    <script>
                    document.addEventListener('livewire:load', function() {
                        Livewire.on('openModal', () => {
                            document.getElementById('modal').classList.remove('hidden');
                        });
                    });
                    document.addEventListener('livewire:load', function() {
                        Livewire.on('openModalActualizar', () => {
                            document.getElementById('modalActualizar').classList.remove('hidden');
                        });
                    });

                    function toggleModal() {
                        document.getElementById('modal').classList.toggle('hidden');
                    }

                    function toggleModalActualizar() {
                        document.getElementById('modalActualizar').classList.toggle('hidden');
                    }
                    </script>
                    <!-- <script>
                    Livewire.on('closeModal', () => {
                        document.getElementById('modal').classList.add('hidden');
                    });
                    </script> -->
                    <!-- <script>
                    Livewire.on('closeModal', () => {
                        document.getElementById('modalActualizar').classList.add('hidden');
                    });
                    </script> -->
                </div>

            </div>
        </div>