<x-dashBoard>
    <div class="py-10 mt-20 mb-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-left m-1">
                <div class="p-1 w-48 rounded-full bg-white shadow"><i class="fa-solid fa-building mr-3 ml-3"></i><label
                        class="font-bold">Lista de Empresas</label></div>

            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mx-auto w-5/5 p-3 px-3 overflow-hidden">
                    @can('adm.crear.empresas')
                        <a href="{{ route('Empresa.create') }}">
                            <button type="button"
                                class="bg-gray-700 text-white font-bold py-2 px-4 rounded hover:bg-gray-600">
                                Nueva Empresa
                            </button>
                        @endcan
                    </a>
                    <!-- tabla Usuarios -->
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full text-left text-sm font-light">
                                        <thead
                                            class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-300">
                                            <tr class="font-light">
                                                <th scope="col" class="px-6 py-4">
                                                    <p class="text-neutral-700">#</p>
                                                </th>
                                                <th scope="col" class="px-6 py-4">Nombre</th>
                                                <th scope="col" class="px-6 py-4">Rut</th>
                                                <th scope="col" class="px-6 py-4">Razón Social</th>
                                                <th scope="col" class="px-6 py-4">Tipo Empresa</th>
                                                <th scope="col" class="px-6 py-4">Editar</th>
                                                {{-- <th scope="col" class="px-6 py-4">Inhabilitar</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Empresas as $empresa)
                                                <tr
                                                    class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-200">
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                        {{ $empresa->id }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{ $empresa->nombre }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{ $empresa->rut }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{ $empresa->razon_social }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4">{{ $empresa->tipo->tipo }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        @can('adm.editar.empresas')
                                                            <button type="button"
                                                                class="inline-block rounded bg-warning-700 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#e4a11b] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(228,161,27,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)]">
                                                                <a href="{{ route('Empresa.edit', $empresa->id) }}"
                                                                    class="btn btn-sm btn-warning"><i
                                                                        class="fas fa-edit"></i></a>
                                                            </button>
                                                        @endcan
                                                    </td>
                                                    {{-- <td class="whitespace-nowrap px-6 py-4">
                                                <button type="button" class="inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-700 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                                    Inhabilitar
                                                </button>
                                            </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tabla usuarios -->
                </div>
            </div>
        </div>
    </div>
</x-dashBoard>
