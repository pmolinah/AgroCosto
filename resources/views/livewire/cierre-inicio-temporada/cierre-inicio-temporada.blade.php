<div>
    <!-- component -->
                
                    <div
                        class="grid grid-cols-1 md:lg:xl:grid-cols-1 group bg-white shadow-xl shadow-neutral-900 border p-5">
                        {{-- <div class="p-3 text-neutral-50">
                            <label class="ml-1 mb-3">Seleccione una Empresa para ver sus Campos y Cuarteles.</label>
                            @livewire('campo.select-empresa')
                        </div> --}}
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    {{-- <th>Rut</th> --}}
                                    <th>Campo/Exportadora</th>
                                    {{-- <th>Dirección</th>
                                    <th>Comuna</th> --}}
                                    <th>Envase</th>
                                    <th>Stock Actual x Color</th>
                                    <th>Cerrar Temporada</th>
                                    <th>Stock Temporadas x color</th>
                                    {{-- <th>Contratista/Ejecutor</th> --}}
                                    {{-- <th>Observacion</th> --}}
                                    {{-- <th>Eliminar</th>
                                    <th>Editar</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cuentasCampos as $cuentacampos )
                                    <tr >
                                        {{-- <td>{{$cuentacampos->campo->rut}}</td> --}}
                                         <td>{{$cuentacampos->campo->campo}}</td>
                                       {{-- <td>{{$cuentacampos->campo->direccion}}</td> --}}
                                        {{-- <td>{{$cuentacampos->campo->comuna->comuna}}</td> --}}
                                        <td>{{$cuentacampos->envase->envase}}</td>
                                        <td >
                                            <table class="shadow shadow-neutral-900">
                                                <thead>
                                                    <tr class="border-solid border-2 border-sky-500">
                                                        <td class="border-solid border-2 border-sky-500">Color</td>
                                                        <td class="border-solid border-2 border-sky-500">Cantidad</td>
                                                        
                                                    </tr>
                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach ($cuentacampos->desgloseenvasecampo as $detallecuenta )
                                                       
                                                        <tr class="border-solid border-2 border-sky-500">
                                                            <td class="border-solid border-2 border-sky-500">{{$detallecuenta->color->color}}</td>
                                                            <td class="border-solid border-2 border-sky-500">{{$detallecuenta->stock}}</td>
                                                           
                                                        </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="">
                                            <button
                                                type="button" wire:click="CierreTemporadaCampo({{$cuentacampos->id}})"
                                                class="bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600">
                                                <i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;&nbsp;&nbsp;Cerrar Temporada&nbsp;&nbsp;&nbsp; <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <table class="shadow shadow-neutral-900">
                                                <thead>
                                                    <tr class="border-solid border-2 border-sky-500">
                                                        <td class="border-solid border-2 border-sky-500">Fecha Cierre</td>
                                                        <td class="border-solid border-2 border-sky-500">Color</td>
                                                        <td class="border-solid border-2 border-sky-500">Cantidad</td>
                                                        <td class="border-solid border-2 border-sky-500"> <i class="fa-regular fa-trash-can"></i></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                         @foreach ($cuentacampos->temporadacampo as $temporadacampo )
                                                            @foreach ($temporadacampo->detalletemporadacampo as $detalletemporada )
                                                                
                                                            
                                                        
                                                  
                                                        
                                                        <tr class="border-solid border-2 border-sky-500">
                                                            <td class="border-solid border-2 border-sky-500">{{$temporadacampo->created_at}}</td>
                                                            <td class="border-solid border-2 border-sky-500">{{$detalletemporada->color->color}}</td>
                                                            <td class="border-solid border-2 border-sky-500">{{$detalletemporada->stock}}</td>
                                                        </tr>

                                                            @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>

                                    </tr>
                                @endforeach
                                @foreach ($cuentasExportadoras as $cuentaexportadora )
                                    <tr>
                                        {{-- <td>{{$cuentaexportadora->empresa->rut}}</td> --}}
                                        <td>{{$cuentaexportadora->empresa->razon_social}}</td>
                                        {{-- <td>{{$cuentaexportadora->empresa->direccion}}</td>
                                        <td>{{$cuentaexportadora->empresa->comuna->comuna}}</td> --}}
                                        <td>{{$cuentaexportadora->envase->envase}}</td>
                                        <td>
                                            <table class="shadow shadow-neutral-900">
                                                <thead>
                                                    <tr class="border-solid border-2 border-sky-500">
                                                        <td class="border-solid border-2 border-sky-500">Color</td>
                                                        <td class="border-solid border-2 border-sky-500">Cantidad</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($cuentaexportadora->detallecuentaenvase as $detallecuentaexportadora )
                                                        
                                                        <tr class="border-solid border-2 border-sky-500">
                                                            <td class="border-solid border-2 border-sky-500">{{$detallecuentaexportadora->color->color}}</td>
                                                            <td class="border-solid border-2 border-sky-500">{{$detallecuentaexportadora->stock}}</td>
                                                        </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="">
                                            <button
                                                type="button" wire:click="CierreTemporadaExpo({{$cuentaexportadora->id}})"
                                                class="bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600">
                                                <i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;&nbsp;&nbsp;Cerrar Temporada&nbsp;&nbsp;&nbsp; <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <table class="shadow shadow-neutral-900">
                                                <thead>
                                                    <tr class="border-solid border-2 border-sky-500">
                                                        <td class="border-solid border-2 border-sky-500">Fecha Cierre</td>
                                                        <td class="border-solid border-2 border-sky-500">Color</td>
                                                        <td class="border-solid border-2 border-sky-500">Cantidad</td>
                                                        <td class="border-solid border-2 border-sky-500"> <i class="fa-regular fa-trash-can"></i></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($cuentaexportadora->temporadaexpo as $temporadaexpo )
                                                        @foreach ($temporadaexpo->detalletemporadaexpo as $detalletemporada)
                                                            
                                                        
                                                        <tr class="border-solid border-2 border-sky-500">
                                                            <td class="border-solid border-2 border-sky-500">{{$temporadaexpo->created_at}}</td>
                                                            <td class="border-solid border-2 border-sky-500">{{$detalletemporada->color->color}}</td>
                                                            <td class="border-solid border-2 border-sky-500">{{$detalletemporada->stock}}</td>
                                                        </tr>

                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
       
</div>
