 <div>
 <div class="w-full rounded-xl border border-gray-200 bg-white py-2 px-2 shadow-md shadow-neutral-800">
    <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
        <div>Guia de Traspaso a Campos y Devolucion a Exportadoras</div>
    </div>
    <div class="mt-2">
    <div class="flex max-h-[600px] w-full flex-col overflow-y-scroll">
    {{-- inicio guia --}}
     <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-50 shadow-2xl">
        <div class="flex items-center font-bold justify-between px-2 text-base font-medium text-gray-700">
            Guía para 
        </div>
        <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
            <select wire:model.defer="seleccion" wire:change="SeleccionTipo" class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option value=1>Traspaso a Campo</option>
                    <option value=2>Devolución a Exportadora</option>
                </select>
        </div>
        <div class="col-span-1 p-2 mt-2 ml-1">
            Fecha
        </div>
        <div class="text-center col-span-2 p-2 border-solid border-1 border-sky-500">
            <input type="date" wire:model="fechaGuia" class="mt-2 w-full">
        </div>
        <div class="col-span-3 p-2 ml-4 mt-1">
            <select wire:model.defer="campo_id" wire:change="SeleccionCampo_id" class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option>Seleccionar Origen</option>
                    @foreach ($campos as $campo)
                            <option value="{{ $campo->id}}">{{ $campo->campo }}</option>
                    @endforeach
            </select>
        </div>
        @if($visibleCampo)
            <div class="col-span-3 p-2 ml-4 mt-1">
                <select wire:model.defer="campoID" wire:change="SeleccionCampoID" class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option>Seleccionar Destino</option>
                        @foreach ($campos as $campo)
                                <option value="{{ $campo->id}}">{{ $campo->campo }}</option>
                        @endforeach
                      
                </select>
            </div>
        @endif
        @if($visibleExportadora)
            <div class="col-span-3 p-2 ml-4 mt-2">
                <select wire:model.defer="exportadora_id" wire:change="SeleccionExportadora_id" class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    <option>Seleccionar Destino</option>
                       
                        @foreach ($exportadoras as $exportadora)
                                <option value="{{ $exportadora->id}}">{{ $exportadora->razon_social }}</option>
                        @endforeach
                </select>
            </div>
        @endif
    </div>
        <hr class="my-2 h-0 border border-t-0 border-solid border-neutral-700 opacity-25 dark:border-neutral-200" />
                                
    <div class="grid sm:grid-cols-1 md:grid-cols-12 bg-neutral-100 shadow-2xl p-5">
                <div class="col-span-12 font-bold text-primary-800 text-right">
                    Guia N°..: {{$NumGuiaRec}}
                    <input type="hidden" wire:model.defer="NumGuiaRec" value="{{$NumGuiaRec}}">
                </div>
                <div class="col-span-6">
                </div>
                <div class="col-span-2 text-right mt-2 p-1">
                        <label class="p-1 font-medium">Campo</label>
                </div>
                <div class="col-span-4 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="" wire:model.defer="NombreCampo">
                </div>
                <div class="col-span-6">
                </div>
                <div class="col-span-2 text-right mt-2 p-1">
                        <label class="p-1 font-medium">Dirección</label>
                </div>
                <div class="col-span-4 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="" wire:model.defer="DireccionCampo">
                </div>
                <div class="col-span-6">
                </div>
                <div class="col-span-2 text-right mt-2 p-1">
                        <label class="p-1 font-medium">Fecha</label>
                </div>
                <div class="col-span-4 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="{{$fechaGuia}}" >
                </div>
                {{-- datos exportadora --}}
                 <div class="col-span-1 mt-8 p-1 text-left">
                        <label class="p-1 font-medium">Rut</label>
                </div>
                <div class="col-span-1 mt-7">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="{{$rutDestino}}">
                </div>
                <div class="col-span-1 mt-8 p-1">
                        <label class="p-1 font-medium">Destino</label>
                </div>
                <div class="col-span-4 mt-7">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="{{$destino}}">
                </div>
                 <div class="col-span-1 mt-8  p-1">
                        <label class="*-1 font-medium">Dirección</label>
                </div>
                <div class="col-span-4 mt-7">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="{{$direccionDestino}}">
                </div>
                 
                 <div class="col-span-1 mt-2 p-1 text-left">
                        <label class="p-1 font-medium">Comuna</label>
                </div>
                <div class="col-span-5 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="{{$comunaDestino}}">
                </div>
                 <div class="col-span-1 mt-2 p-1">
                        <label class="p-1 font-medium">Email</label>
                </div>
                <div class="col-span-5 mt-1">
                        <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="{{$emailDestino}}">
                </div>
                <div class="col-span-1 mt-2 p-1 text-left">
                    <label class="p-1 font-medium">Giro</label>
                </div>
                <div class="col-span-8 w-96 mt-1">
                    <input type="text" class="uppercase h-10 border mt-1 rounded px-4 w-full bg-gray-200" value="{{$giroDestino}}">
                </div>

               
                <div class="col-span-6 p-2 ml-1 mt-2 h-10 bg-gray-100 flex border border-gray-200 rounded items-center mt-1">
                        <select wire:model.defer="conductor_id" class="px-4 py-2 appearance-none outline-none text-gray-800 w-full bg-transparent">
                            <option>Seleccionar Conductor</option>
                            @foreach ($conductores as $conductor)
                                    <option value="{{ $conductor->id}}">{{ $conductor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-6 p-2 ml-1 mt-2 h-10 bg-gray-100 flex border border-gray-200 rounded items-center mt-1">
                        <select wire:model.defer="vehiculo_id" class="px-4 py-2 appearance-none outline-none text-gray-800 w-full bg-transparent">
                            <option>Seleccionar Vehículo</option>
                            @foreach ($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id}}">{{ $vehiculo->patente }}</option>
                            @endforeach
                        </select>
                    </div>
                @if($visibleCampo)
                    <div class="col-start-5  col-span-4  text-right mt-3 p-2">
                        <button type="button" wire:click="AgregarDetalleCampo" class="bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600">
                            Guardar y Agregar Detalle para Campos
                        </button>
                    </div>
                @endif
                @if($visibleExportadora)
                    <div class="col-start-5  col-span-4  text-right mt-3 p-2">
                        <button type="button" wire:click="AgregarDetalleExportadora" class="bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600">
                            Guardar y Agregar Detalle para Exportadora
                        </button>
                    </div>
                @endif
                 {{-- <div class="col-start-10  col-span-3  text-right mt-1 p-2">
                    <button type="button" wire:click="EliminarGuia" class="inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                        Eliminar Guía de Recepción
                    </button>
                </div> --}}
                <div class="text-center col-span-12 mt-4">
                    <h6 class="text-primary-800 text-xl leading-tight">Detalle</h6>
                </div>
                             
            @if($visible)                  
                <div class="col-start-3 col-span-8">
                     <table class="mt-3 border-2 text-center">
                            <thead class="w-full mt-3 border-2">
                                <tr class="mt-3 border-2 bg-gray-300">
                                    <td class="w-24 font-bold mt-3 border-2">Cant/Env.</td>
                                    <td class="w-96 font-bold mt-3 border-2">Detalle</td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">Color/Envase</td>
                                    
                                    <td class="w-24 font-bold text-center mt-3 border-2 p-2"><i class="fa-solid fa-trash"></i></td>
                                </tr>
                                <tr class="mt-3 border-2">
                                    <td class="text-center w-24 font-bold mt-3 border-2"><input type="number" wire:model.defer="Cantidad" class="uppercase w-24 h-7" value="" placeholder="Cantidad"></td>
                                    <td class="w-96 font-bold mt-3 border-2">
                                        <select wire:model.defer="envase_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Envase</option>
                                                @foreach ($envases as $envase)
                                                        <option value="{{ $envase->id}}">{{ $envase->envase }}</option>
                                                @endforeach
                                        </select>
                                    </td>
                                    <td class="w-48 font-bold text-center mt-3 border-2">
                                        <select wire:model.defer="color_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option>Color</option>
                                                @foreach ($colores as $color)
                                                        <option value="{{ $color->id}}">{{ $color->color }}</option>
                                                @endforeach
                                        </select>
                                          
                                    </td>
                                    
                                    <td class="w-24 font-bold text-center mt-3 border-2 p-2">
                                        <button type="button" wire:click="AgregarLinea" class="inline-block rounded bg-success-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($devoluciontraspasoparaDetalle as $devoluciontraspaso)
                                        @foreach ($devoluciontraspaso->devoluciontraspasodetalle as $detalle)
                                            
                                        <tr class="mt-3 border-2">
                                            <td class="font-bold text-center mt-3 border-2">{{$detalle->cantidadEnvases}}</td>
                                            <td class="font-bold text-center mt-3 border-2">{{$detalle->envase->envase}}</td>
                                           
                                            <td class="font-bold text-center mt-3 border-2">{{$detalle->color->color}}</td>
                                            <td class="font-bold text-center mt-3 border-2">
                                                 <button type="button" wire:click="QuitarLinea({{$detalle->id}})" class="inline-block rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                  
                                        @endforeach
                                    @endforeach
                            </tbody>
                        </table>
                </div>
            @endif
            <div class="col-span-12 text-center mt-3">
                <div class="text-center col-start-4 col-span-5 mb-8 shadow-lg">
                    <label class="font-bold">Observación Max 100 Caractéres(Opcional)</label>
                    <textarea wire:model.defer="observacion" rows="1"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
                <div class="col-start-1 col-span-5 text-left">
                    <button
                        type="button" wire:click="generarGuiaDevolucionTraspaso"
                        class="bg-gray-700 text-white py-3 px-5 rounded hover:bg-gray-600">
                        Generar Guía Devolución
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
                                            
                                       
                                    
                                            
                                         
                                            
                          
                                  
                              
                                   

                                        
                                           
                              

</div>
