<x-dashBoard>
    <!-- component -->
    <div class="w-full flex justify-center my-19 py-10">
        <div class="w-full ml-20 mr-20 mt-5">
            <div class="w-full flex flex-col md:flex-row rounded overflow-hidden shadow-xl">

                <div class="w-full md:w-1/4 h-auto">
                    <div class="top flex items-center px-5 h-10 bg-gray-700 text-white">
                        <div class="ml-3 flex flex-col ">
                            Configuraciones
                        </div>
                    </div>
                    <div class="bg-gray-400 w-full h-full sm:flex md:block">
                        <button id="button-1" onclick="showView(1)"
                            class="w-full flex justify-between items-center px-5 py-2 hover:bg-gray-500 cursor-pointer focus:outline-none">
                            <span><i class="fa-solid fa-leaf mr-3"></i>Variedad</span>
                        </button>
                        <button id="button-2" onclick="showView(2)"
                            class="w-full flex justify-between items-center px-5 py-2 hover:bg-gray-500 cursor-pointer focus:outline-none">
                            <span><i class="fa-solid fa-apple-whole mr-3"></i>Especie</span>
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24">
                                <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z"/>
                            </svg> --}}
                        </button>
                        <button id="button-3" onclick="showView(3)"
                            class="w-full flex justify-between items-center px-5 py-2 hover:bg-gray-500 cursor-pointer focus:outline-none">
                            <span><i class="fa-solid fa-box-open mr-3"></i>Envase</span>
                        </button>
                        {{-- <button id="button-4" onclick="showView(4)" class="w-full flex justify-between items-center px-5 py-2 hover:bg-gray-500 cursor-pointer focus:outline-none">
                            <span><i class="fa-solid fa-warehouse mr-3"></i>Bodega</span>
                            <span class="text-xs bg-gray-800 px-1 rounded text-white">4</span>
                        </button>
                         <button id="button-5" onclick="showView(5)" class="w-full flex justify-between items-center px-5 py-2 hover:bg-gray-500 cursor-pointer focus:outline-none">
                            <span><i class="fa-solid fa-dolly mr-3"></i>Insumos</span>
                        </button>
                        <button id="button-6" onclick="showView(6)" class="w-full flex justify-between items-center px-5 py-2 hover:bg-gray-500 cursor-pointer focus:outline-none">
                            <span><i class="fa-solid fa-list-check mr-3"></i>Tareas</span>
                            <span class="text-xs bg-gray-800 px-1 rounded text-white">4</span>
                        </button> --}}
                    </div>
                </div>


                <div class="w-full md:w-3/4">
                    <div class="top flex items-center px-5 h-10 bg-gray-600 text-white ">
                        <div id="title-1" class="hidden">
                            Variedades
                        </div>
                        <div id="title-2" class="hidden">
                            Especies
                        </div>
                        <div id="title-3" class="hidden">
                            Envases
                        </div>
                        {{-- <div id="title-4" class="hidden">
                            title-4
                        </div>
                        <div id="title-5" class="hidden">
                            title-5
                        </div>
                        <div id="title-6" class="hidden">
                            title-6
                        </div> --}}
                    </div>
                    <div class="w-full px-5 py-3 max-h-screen overflow-y-auto mb-10">
                        <div id="view-1" class="hidden">
                            Administrar Variedades
                            <hr class="my-2 border-gray-500">
                            @livewire('parametros.crud-variedad')
                            <hr class="my-2 border-gray-500">
                            {{-- Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita sequi quae dignissimos omnis aliquam, corrupti corporis.
                             Sequi esse voluptatem, deserunt aliquam, nemo minus neque cumque autem, dolorem provident porro recusandae. --}}
                        </div>
                        <div id="view-2" class="hidden">
                            Administrar Especies
                            <hr class="my-2 border-gray-500">
                            @livewire('parametros.crud-especie')
                        </div>
                        <div id="view-3" class="hidden">
                            Administrar Envases
                            <hr class="my-2 border-gray-500">
                            @livewire('parametros.crud-envase')
                        </div>
                        {{-- <div id="view-4" class="hidden">
                            view-4
                            <hr class="my-2 border-gray-500">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor ratione minima praesentium, unde maxime nisi maiores temporibus fugit!
                             Ducimus aliquam commodi autem minima repudiandae dolorum aut sit dolorem laudantium odit.
                        </div> --}}
                        {{-- <div id="view-5" class="hidden">
                            view-3
                        </div>
                        <div id="view-6" class="hidden">
                            view-4
                            <hr class="my-2 border-gray-500">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor ratione minima praesentium, unde maxime nisi maiores temporibus fugit!
                             Ducimus aliquam commodi autem minima repudiandae dolorum aut sit dolorem laudantium odit.
                        </div> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        var activeClasses = ["bg-gray-500", "border-l-4", "pl-4", "border-gray-700"];
        var lastId = null;
        showView(1)

        function showView(id) {
            if (id == null) return
            closeLast()
            document.getElementById('view-' + id).style.display = "block"
            document.getElementById('title-' + id).style.display = "block"
            document.getElementById('button-' + id).classList.add(...activeClasses)

            lastId = id;
        }

        function closeLast() {
            if (lastId == null) return

            document.getElementById('view-' + lastId).style.display = "none"
            document.getElementById('title-' + lastId).style.display = "none"
            document.getElementById('button-' + lastId).classList.remove(...activeClasses)
        }
    </script>

    {{-- @livewire('parametros.crud-variedad') --}}

    {{-- @livewire('parametros.crud-especie') -}}
              
                    {{-- @livewire('parametros.crud-envase') --}}

</x-dashBoard>
