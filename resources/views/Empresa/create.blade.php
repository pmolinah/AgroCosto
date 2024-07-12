<x-dashBoard>
<form action="{{ route('Empresa.store') }}" method="post">
    @CSRF
  <div class="container text-left max-w-screen-lg mx-auto">
    <div>
      <h2 class="font-semibold text-xl text-gray-600">Formulario Registro de Empresas</h2>
      <p class="text-gray-500">Propietarios, Contratistas, Exportadoras, Proveedores</p>

      <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-20 shadow-neutral-900">
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
          <div class="text-gray-600">
            <p class="font-medium text-lg">Datos</p>
            <p>Campos con (*) son obligatorios.</p>
          </div>
        
          <div class="lg:col-span-2">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
            <div class="md:col-span-1">
                <label for="full_name">Rut.(*)<label>
                <input type="text" id="rut" required name="rut" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
              </div>
              <div class="md:col-span-5">
                <label for="full_name">Razón Social.(*)</label>
                <input type="text" required name="razon_social" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
              </div>
              <div class="md:col-span-6">
                <label for="full_name">Propietario.(*)</label>
                <input type="text" required name="nombre" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
              </div>

              <div class="md:col-span-6">
                <label for="email">Email .(*)</label>
                <input type="text" name="email" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="email@domain.com" />
              </div>

              <div class="md:col-span-3">.(*)
                <label for="address">Dirección</label>
                <input type="text" name="direccion" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
              </div>

              <div class="md:col-span-3">
                <label for="city">Comuna.(*)</label>
                    <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                        <select name="comuna_id" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent">
                            <option>Seleccione Comuna</option>
                            @foreach ($comunas as $comuna)
                                <option value="{{ $comuna->id }}">{{ $comuna->comuna }}</option>
                            @endforeach
                        </select>
                </div>
              </div>

              <div class="md:col-span-2">
                <label for="country">Teléfono</label>
                <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                  <input name="telefono" placeholder="Telefonos" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                  {{-- <button tabindex="-1" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-red-600">
                    <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                  </button>
                  <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-blue-600">
                    <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                  </button> --}}
                </div>
              </div>

              <div class="md:col-span-4">
                <label for="state">Tipo Empresa .(*)</label>
                    <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                    {{-- <input name="state" id="state" placeholder="State" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" /> --}}
                        <select  name="tipo_id" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" required>
                            <option>Seleccionar Tipo Empresa</option>
                            @foreach ($tipo as $tipos)
                                <option value="{{ $tipos->id }}">{{ $tipos->tipo }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="md:col-span-6">
                <label for="full_name">Giro</label>
                <input type="text" name="giro" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
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
                  <button type="submit" class="bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600">Guardar Información</button>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
</form>

    {{-- <a href="https://www.buymeacoffee.com/dgauderman" target="_blank" class="md:absolute bottom-0 right-0 p-4 float-right">
      <img src="https://www.buymeacoffee.com/assets/img/guidelines/logo-mark-3.svg" alt="Buy Me A Coffee" class="transition-all rounded-full w-14 -rotate-45 hover:shadow-sm shadow-lg ring hover:ring-4 ring-white">
    </a> --}}
  </div>


    {{-- <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8 border-solid border-2 border-sky-500 p-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('Empresa.store') }}" method="post">
                    @CSRF
                    <div class="grid grid-cols-6 gap-2 mx-auto p-5 overflow-hidden bg-secondary-100 shadow-2xl border-solid border-2 border-sky-500">
                        <!-- contenido -->

                        <div class="relative mb-3">
                            Rut
                            <input type="text" class="w-full border-solid border-2 border-sky-500 p-1"  id="rut" required name="rut"
                                class=" m-2 peer block min-h-[auto] rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-800 peer-focus:text-neutral-50 data-[te-input-state-active]:placeholder:opacity-800 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />
                            <label
                                class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Rut
                            </label>
                        </div>
                        <div class="relative mb-3 col-span-5">Razón Social 
                            <input type="text" required name="razon_social" class="w-full border-solid border-2 border-sky-500 p-1"
                                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />
                           
                        </div>
                        <div class="relative mb-3 col-span-3">
                        Dirección
                            <input type="text" name="direccion" class="w-full border-solid border-2 border-sky-500 p-1"
                                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />
                          
                        </div>
                        <div class="relative mb-3 col-span-3">
                        Comuna
                            <select name="comuna_id" class="w-full border-solid border-2 border-sky-500 p-1.5">
                                <option></option>
                                @foreach ($comunas as $comuna)
                                    <option value="{{ $comuna->id }}">{{ $comuna->comuna }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="relative mb-3 col-span-2" >
                            Propietario
                            <input type="text" <div class="md:col-span-5">
                <label for="full_name">Razón Social.(*)</label>
                <input type="text" required name="razon_social" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
              </div> class="w-full border-solid border-2 border-sky-500 p-1"
                                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />
                           
                        </div>
                        <div class="relative mb-3 col-span-2" >
                            Telefonos
                            <input type="text" name="telefono" class="w-full border-solid border-2 border-sky-500 p-1"
                                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />
                          
                        </div>
                        <div class="relative mb-3 col-span-2">
                        Tipo Empresa
                            <select  name="tipo_id" class="w-full border-solid border-2 border-sky-500 p-1.5">
                                <option></option>
                                @foreach ($tipo as $tipos)
                                    <option value="{{ $tipos->id }}">{{ $tipos->tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="relative mb-3 col-span-3" >
                        Email
                            <input type="email" name="email" class="w-full border-solid border-2 border-sky-500 p-1"
                                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />
                           
                        </div>
                        <div class="relative mb-3 col-span-3" >
                        Giro
                            <input type="text" name="giro" class="w-full border-solid border-2 border-sky-500 p-1"
                                class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />
                           
                        </div>
                        <div class=" mt-5">
                            <button type="submit"
                                class="mb-2 block w-full rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                Guardar Empresa
                            </button>
                        </div>
                        <!-- contenido -->
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
</x-dashBoard>
