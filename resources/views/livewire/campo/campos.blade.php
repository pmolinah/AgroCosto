<div>
    <!-- component -->
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
        <thead class="bg-gray-300">
            <tr>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Propietario</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Campo</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Dirección</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Cuarteles</th>
                {{-- <th scope="col" class="px-6 py-4 font-medium text-gray-900">Modificar/Eliminar</th> --}}
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 border-t border-gray-100">

            @if (isset($campos))
                @foreach ($campos as $campo)
                    <tr class="hover:bg-gray-50">
                        <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                            <div class="relative h-10 w-10">
                               
                                <i class="fa-sharp fa-solid fa-building fa-2xl"></i>
                                <span
                                    class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                            </div>
                            <div class="text-sm">
                                <div class="font-medium text-gray-700">{{ $campo->empresa->razon_social }}</div>
                                <div class="text-gray-400">{{ $campo->empresa->email }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                {{ $campo->campo }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $campo->direccion }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                @foreach ($campo->cuartel as $cuarteles)
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                        {{ $cuarteles->observaciones }}
                                    </span>
                                @endforeach
                                {{-- <span
                  class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-600"
                >
                  Product
                </span>
                <span
                  class="inline-flex items-center gap-1 rounded-full bg-violet-50 px-2 py-1 text-xs font-semibold text-violet-600"
                >
                  Develop
                </span> --}}
                            </div>
                        </td>
                      
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{-- fin tabla campos --}}

</div>
