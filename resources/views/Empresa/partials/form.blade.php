
                <!-- component -->
<form action="{{ route('Empresa.store') }}" method="post">
    @CSRF
  <div class="container text-left max-w-screen-lg mx-auto">
    <div>
      <h2 class="font-semibold text-xl text-gray-600">Formulario Registro de Empresas</h2>
      <p class="text-gray-500">Propietarios, Contratistas, Exportadoras, Proveedores</p>

      <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-20">
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
          <div class="text-gray-600">
            <p class="font-medium text-lg">Datos</p>
            <p>Campos con (*) son obligatorios.</p>
          </div>
        
          <div class="lg:col-span-2">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
            <div class="md:col-span-1">
                <label for="full_name">Rut.(*)<label>
                {{-- <input type="text" id="rut" required name="rut" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" /> --}}
                {{ Form::text('rut',null,['class'=>'h-10 border mt-1 rounded px-4 w-full bg-gray-50','required']) }}
              </div>
              <div class="md:col-span-5">
                <label for="full_name">Razón Social.(*)</label>
                {{-- <input type="text" required name="razon_social" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" /> --}}
                {{ Form::text('razon_social',null,['class'=>'h-10 border mt-1 rounded px-4 w-full bg-gray-50','required']) }}
              </div>
              <div class="md:col-span-6">
                <label for="full_name">Propietario.(*)</label>
                {{-- <input type="text" required name="nombre" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" /> --}}
                {{ Form::text('nombre',null,['class'=>'h-10 border mt-1 rounded px-4 w-full bg-gray-50','required']) }}
              </div>

              <div class="md:col-span-6">
                <label for="email">Email .(*)</label>
                {{-- <input type="text" name="email" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="email@domain.com" /> --}}
                {{ Form::text('email',null,['class'=>'h-10 border mt-1 rounded px-4 w-full bg-gray-50','required']) }}
              </div>

              <div class="md:col-span-3">.(*)
                <label for="address">Dirección</label>
                {{-- <input type="text" name="direccion" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" /> --}}
                {{ Form::text('direccion',null,['class'=>'h-10 border mt-1 rounded px-4 w-full bg-gray-50','required']) }}
              </div>

              <div class="md:col-span-3">
                <label for="city">Comuna.(*)</label>
                    <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                        {{-- <select name="comuna_id" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent">
                            <option>Seleccione Comuna</option>
                            @foreach ($comunas as $comuna)
                                <option value="{{ $comuna->id }}">{{ $comuna->comuna }}</option>
                            @endforeach
                        </select> --}}
                        {{ Form::select('comuna_id', $comunas->pluck('comuna', 'id')->all(), null, ['class' => 'px-4 appearance-none outline-none text-gray-800 w-full bg-transparent', 'attributes' => 'data-te-select-init'] ) }}
                </div>
              </div>

              <div class="md:col-span-2">
                <label for="country">Teléfono</label>
                <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                {{ Form::text('telefono',null,['class'=>'px-4 appearance-none outline-none text-gray-800 w-full bg-transparent','required']) }}
                  {{-- <input name="telefono" placeholder="Telefonos" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" /> --}}

                 
                </div>
              </div>

              <div class="md:col-span-4">
                <label for="state">Tipo Empresa .(*)</label>
                    <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                    {{-- <input name="state" id="state" placeholder="State" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" /> --}}
                        {{-- <select  name="tipo_id" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" required>
                            <option>Seleccionar Tipo Empresa</option>
                           
                        </select> --}}
                         {{ Form::select('tipo_id', $tipos->pluck('tipo', 'id')->all(), null, ['class' => 'px-4 appearance-none outline-none text-gray-800 w-full bg-transparent']) }}
                    </div>
            </div>
            <div class="md:col-span-6">
                <label for="full_name">Giro</label>
                {{-- <input type="text" name="giro" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" /> --}}
                {{ Form::text('giro',null,['class'=>'h-10 border mt-1 rounded px-4 w-full bg-gray-50','required']) }}
              </div>
           {{--     <div class="md:col-span-6">
                <label for="zipcode">Giro</label>
                <input type="text" name="zipcode" id="zipcode" class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="" value="" />
              </div>

              {{-- <div class="md:col-span-5">
                <div class="inline-flex items-center">
                  <input type="checkbox" name="billing_same" id="billing_same" class="form-checkbox" />
                  <label for="billing_same" class="ml-2">My billing address is different than above.</label>
                </div>
              </div> --}}

              {{-- <div class="md:col-span-2">
                <label for="soda">How many soda pops?</label>
                <div class="h-10 w-28 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                  <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-r border-gray-200 transition-all text-gray-500 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                  </button>
                  <input name="soda" id="soda" placeholder="0" class="px-2 text-center appearance-none outline-none text-gray-800 w-full bg-transparent" value="0" />
                  <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-500 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 fill-current" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </div> --}}
      
              <div class="md:col-span-5 text-right">
                <div class="inline-flex items-end">
                  <button type="submit" class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Guardar Información</button>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
</form>
{{--                 
                <div class="grid grid-cols-6 gap-2 mx-auto p-5 overflow-hidden bg-secondary-100 shadow-2xl">
                    <!-- contenido -->

                            <div class="relative mb-3" >
                                Rut
                                {{-- {{ Form::text('rut',null,['class'=>'','required']) }} --}

                            </div>
                            <div class="relative mb-3 col-span-5" >
                                Razón Social
                                    {{-- {{ Form::text('razon_social',null,['class'=>'w-full border-solid border-2 border-sky-500 p-1','required']) }} --}
                                   
                            </div>
                            <div class="relative mb-3 col-span-3">
                                Dirección
                                {{-- {{ Form::text('direccion',null,['class'=>'w-full border-solid border-2 border-sky-500 p-1','required']) }} --}
                                </div>
                            <div class="relative mb-3 col-span-3">
                              
                                 Comuna
                                {{-- {{ Form::select('comuna_id', $comunas->pluck('comuna', 'id')->all(), null, ['class' => 'w-full border-solid border-2 border-sky-500 p-1.5', 'attributes' => 'data-te-select-init'] ) }} --}
                            </div>
                            <div class="relative mb-3 col-span-2" >
                                Propietario
                                    {{-- {{ Form::text('nombre',null,['class'=>'w-full border-solid border-2 border-sky-500 p-1','required']) }} --}
                                    
                            </div>
                            <div class="relative mb-3 col-span-2" >
                              Teléfonos
                                    {{-- {{ Form::text('telefono',null,['class'=>'w-full border-solid border-2 border-sky-500 p-1','required']) }} --}
                                   
                            </div>
                            <div class="relative mb-3 col-span-2">
                               Tipo Empresa (Campo/Exportadora/Proveedor/Contratista...)
                                {{-- {{ Form::select('tipo_id', $tipos->pluck('tipo', 'id')->all(), null, ['class' => 'w-full border-solid border-2 border-sky-500 p-1']) }} --}
                            </div>
                            <div class="relative mb-3 col-span-3">
                                Email
                                     {{-- {{ Form::text('email',null,['class'=>'w-full border-solid border-2 border-sky-500 p-1','required']) }} --}
                            </div>
                              <div class="relative mb-3 col-span-3">
                                     Giro
                                     {{-- {{ Form::text('giro',null,['class'=>'w-full border-solid border-2 border-sky-500 p-1','required']) }} --}
                                   
                            </div>
                            <div class="mt-5">
                                <!-- <button
                                    type="submit"
                                    class="mb-2 block w-full rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                    Guardar Empresa
                                </button> --
                                {{ Form::submit('Actualizar Empresa',['class'=>'mb-2 block w-full rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]']) }}

                            </div>
                            <!- contenido --
                        </div>
                      </div> --}}