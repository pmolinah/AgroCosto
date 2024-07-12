<x-dashBoard>
    <form action="{{ route('User.update') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="container text-left max-w-screen-lg mx-auto">
            <h2 class="font-semibold text-xl text-gray-600">Formulario Registro de Usuarios</h2>
            <p class="text-gray-500">Administrador, Capataz, Conductor, Bodeguero...</p>
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-20">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-600">
                        <p class="font-medium text-lg">Información</p>
                        <p>Campos con (*) son obligatorios.</p>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                            <div class="md:col-span-4">
                                <label for="full_name">Nombre.(*)</label>
                                <input type="text" required name="name"
                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                    value="{{ $user->name }}" />
                            </div>
                            <div class="md:col-span-6">
                                <label for="email">Email .(*)</label>
                                <input type="text" name="email" name="email" id="email"
                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ $user->email }}"
                                    placeholder="email@domain.com" />
                            </div>

                            <div class="md:col-span-4">
                                <label for="state">Tipo Usuario .(*)</label>
                                <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                    {{-- <input name="state" id="state" placeholder="State" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" /> --}}
                                    <select name="tipo_id" id="tipo"
                                        class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent"
                                        required>
                                        <option value="{{ $user->tipo_id }}">{{ $user->tipo->tipousuario }}</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}">{{ $tipo->tipousuario }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="md:col-span-6 ">
                                <label for="full_name">Rol Usuario. (*)</label>
                                <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                    <select
                                        class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent"
                                        required name="rol">
                                        <option value="{{ $roleId }}">{{ $roleDescription }}</option>
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->id }}">{{ $rol->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="md:col-span-3">
                                <label for="full_name">Password . (*)</label>
                                <input type="text" id="password" required name="password"
                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
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
        {{-- <!-- nuevos usuarios -->
        @if (Session::has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ Session::get('success') }}',
                    timer: 5000,
                    showConfirmButton: false
                });
            </script>
        @endif --}}
    </form>
</x-dashBoard>
