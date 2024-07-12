<div>
    <div class=" p-2 rounded-2 bg-white">
     <div class="w-full rounded-xl border border-gray-200 bg-white py-2 mt-2 px-2 shadow-xl">
        <div class="mt-2">
            <div class="flex max-h-[450px] w-full flex-col overflow-y-scroll">
        <div id="accordionExample5" hidden>
            <div class="rounded-t-lg border border-neutral-200 bg-white dark:border-neutral-600 ">
                <h2 class="mb-0" id="headingOne5">
                    <button
                        class="group relative flex w-full items-center rounded-t-[15px] border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]"
                        type="button" data-te-collapse-init data-te-target="#collapseOne5" aria-expanded="true"
                        aria-controls="collapseOne5">
                        Accordion Item #1
                        <span
                            class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </button>
                </h2>
                <div id="collapseOne5" class="!visible" data-te-collapse-item data-te-collapse-show
                    aria-labelledby="headingOne5">
                    <div class="px-5 py-4">

                    </div>
                </div>
            </div>

        </div>
        <div id="accordionExample5">
            @foreach ($campos as $campo)
                {{-- acordeon --}}

                <div class="border p-1  border-neutral-200 bg-white border-neutral-600 dark:bg-white rounded-lg">
                    <h2 class="mb-0" id="headingTwo5">
                        <button
                            class="group relative flex w-full items-center rounded-lg border-0 p-1 bg-neutral-400 text-black font-bold"
                            type="button" data-te-collapse-init data-te-collapse-collapsed
                            data-te-target="#collapsed<?php echo $campo->id; ?>" aria-expanded="false"
                            aria-controls="collapseTwo5">
                            {{ $campo->campo }}
                            
                            <span
                                class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </button>
                    </h2>
                    <div id="collapsed<?php echo $campo->id; ?>" class="!visible hidden" data-te-collapse-item
                        aria-labelledby="headingTwo5">
                        
                        <div class="px-2 py-4 text-left">
                            {{-- campos --}}
                            {!! Form::model($campo, ['route' => ['Campo.update', $campo->id], 'method' => 'PUT']) !!}
                            @csrf
                            <div class="grid gap-2 grid-cols-5 xs:grid-cols-1 bg-white rounded-lg p-2 text-left">
                                <div class="">
                                    Codigo SAG,
                                </div>
                                <div class="">
                                    {{ Form::text('codigoSag', null, ['class' => 'h-10 border rounded px-4 w-full bg-gray-50', 'required']) }}
                                </div>
                                <div class="">
                                    Rut,
                                </div>
                                <div class="">
                                    {{ Form::text('rut', null, ['class' => 'h-10 border  rounded px-4 w-full bg-gray-50', 'required']) }}
                                </div>
                                
                                <div class="">
                                    Campo
                                </div>
                                <div clas="">
                                    {{ Form::text('campo', null, ['class' => 'h-10 border rounded px-4 w-full bg-gray-50', 'required']) }}
                                </div>
                                <div class="">
                                    Dirección
                                </div>
                                <div clas="">
                                    {{ Form::text('direccion', null, ['class' => 'h-10 border rounded px-4 w-full bg-gray-50', 'required']) }}
                                </div>
                                <div class="">
                                    Superficie en Ha
                                </div>
                                <div clas="">
                                    {{ Form::text('superficie', null, ['class' => 'h-10 border  rounded px-4 w-full bg-gray-50', 'required']) }}
                                </div>
                                <div class="">
                                    Comuna
                                </div>
                                <div clas="">
                                    
                                        {{ Form::select('comuna_id', $comunas->pluck('comuna', 'id')->all(), null, ['class' => 'h-10 border rounded px-4 w-full bg-gray-50']) }}
                                    
                                </div>
                                <div class="">
                                    Administrador
                                </div>
                                <div clas="">
                                        {{ Form::select('comuna_id', $administradores->pluck('name', 'id')->all(), null, ['class' => ' h-10 border rounded px-4 w-full bg-gray-50']) }}
                                </div>
                                {{-- fin campos --}}
                                {{-- Botones --}}
                                <div class=" mt-2">
                                    {{ Form::submit('Actualizar Campo', ['class' => 'w-full mb-2 bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600']) }}
                                    {!! Form::close() !!}
                              
                                    <button type="button" wire:click="EliminarCampo({{$campo->id}})"
                                        class=" w-full bg-red-800 text-white  py-2 px-4 w-full rounded hover:bg-gray-600">
                                        Eliminar Campo
                                    </button>
                                </div>
                            </div>
                            {{-- fin botones --}}
                        </div>
                    </div>
                </div>

                {{-- fin --}}
            @endforeach
        </div>
        </div>
        </div>
        </div>
    </div>
     <script>
                window.addEventListener('Guardar', function(e) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito, Registro Guardado...',
                        text: '{{ Session::get('success') }}',
                        timer: 5000,
                        showConfirmButton: false
                    });
                });
                window.addEventListener('Eliminar', function(e) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Éxito, Registro Eliminado...',
                        text: '{{ Session::get('success') }}',
                        timer: 5000,
                        showConfirmButton: false
                    });
                });
                window.addEventListener('Actualizar', function(e) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito, Registro Actualizado...',
                        text: '{{ Session::get('success') }}',
                        timer: 5000,
                        showConfirmButton: false
                    });
                });
            </script>
</div>
