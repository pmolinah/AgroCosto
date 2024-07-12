<x-dashBoard>

    <!-- component -->
    <form action="{{ route('Rol.store') }}" method="post">
        @csrf

        <div class="container text-left max-w-screen-lg mx-auto">
            <div>
                <h2 class="font-semibold text-xl text-gray-600">Formulario Creación de Roles</h2>
                <p class="text-gray-500">Roles para el uso de opciones del sistema según usuario</p>

                <div class="bg-white rounded shadow-lg p-2 px-4 md:p-8 ">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Datos</p>
                            <p>Campos con (*) son obligatorios.</p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-1">
                                    <label for="full_name">Rol.(*)<label>
                                            <input type="text" id="rol" required name="name"
                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                value="" />
                                </div>
                                {{-- <div class="md:col-span-5">
                                    <label for="full_name">Razón Social.(*)</label>
                                    <input type="text" required name="razon_social"
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                </div> --}}



                                <div class="md:col-span-6">
                                    <label for="full_name">Descripción. (*)</label>
                                    <textarea type="text" name="description" rows="4" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                        value=""></textarea>
                                </div>


                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">
                                        <button type="submit"
                                            class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Guardar
                                            Información</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- permisos -->


            <div
                class="w-1/2 inline-block mt-5 w-[49.8%] rounded-xl border border-gray-200 bg-white py-4 px-2 shadow-md shadow-gray-100">
                <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
                    <div>Permisos Administrador</div>

                </div>
                <div class="mt-4">
                    <div class="flex max-h-[200px] w-full flex-col overflow-y-scroll">
                        @foreach ($permissions as $permission)
                            <div class="mt-4 flex items-center gap-3">
                                <input type="checkbox" value="{{ $permission->id }}"
                                    class='relative h-5 w-10 appearance-none rounded-[20px] bg-[#e0e5f2] outline-none transition duration-[0.5s] 
                        before:absolute before:top-[50%] before:h-4 before:w-4 before:translate-x-[2px] before:translate-y-[-50%] before:rounded-[20px]
                        before:bg-white before:shadow-[0_2px_5px_rgba(0,_0,_0,_.2)] before:transition before:content-[""]
                        checked:before:translate-x-[22px] hover:cursor-pointer checked:bg-brand-500 dark:checked:bg-brand-400'
                                    name="permission[]" id="checkbox{{ $permission->id }}" />
                                <label for="checkbox{{ $permission->id }}"
                                    class="text-base font-medium text-neutral-700 ">
                                    {{ $permission->description }}
                                </label>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            {{-- fin permisos --}}
            <!-- permisos -->

            <div
                class="mb-20 w-1/2 inline-block mt-5 w-[49.8%] rounded-xl border border-gray-200 bg-white py-4 px-2 shadow-md shadow-gray-100">
                <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
                    <div>Permisos Producción</div>

                </div>
                <div class="mt-4">
                    <div class="flex max-h-[200px] w-full flex-col overflow-y-scroll">
                        @foreach ($permissionsProd as $permissionprod)
                            <div class="mt-4 flex items-center gap-3">
                                <input type="checkbox" value="{{ $permissionprod->id }}"
                                    class='relative h-5 w-10 appearance-none rounded-[20px] bg-[#e0e5f2] outline-none transition duration-[0.5s] 
                        before:absolute before:top-[50%] before:h-4 before:w-4 before:translate-x-[2px] before:translate-y-[-50%] before:rounded-[20px]
                        before:bg-white before:shadow-[0_2px_5px_rgba(0,_0,_0,_.2)] before:transition before:content-[""]
                        checked:before:translate-x-[22px] hover:cursor-pointer checked:bg-brand-500 dark:checked:bg-brand-400'
                                    name="permission[]" id="checkbox{{ $permissionprod->id }}" />
                                <label for="checkbox{{ $permissionprod->id }}"
                                    class="text-base font-medium text-neutral-700 ">
                                    {{ $permissionprod->description }}
                                </label>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
    </form>
    {{-- fin permisos --}}

</x-dashBoard>
