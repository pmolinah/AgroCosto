<div>

    {{-- contenido 1 --}}

    <div class="grid sm:grid-cols-1 md:grid-cols-4 gap-4 p-2">

        <div
            class="bg-white text-neutral-600 text-left sm:col-span-1 md:col-span-2 grid grid-cols-2 mb-10 ml-2 mr-2 mt-8 mx-auto px-16 py-3 rounded-lg shadow-lg">

            <div class="col-span-2">
                <label>Empresa</label>
                @livewire('campo.select-empresa')
            </div>
            <div class="col-span-2  ">
                <label class="w-full">Código Sag</label>
            </div>
            <div class="col-span-2">
                <input type="text" wire:model.defer="codigoSag"
                    class="p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900"
                    placeholder="Código de Registro SAG">
            </div>
            <div class="col-span-2">
                <label>Nombre del Campo</label>
            </div>
            <div class="col-span-2 ">
                <input type="text" wire:model.defer="campo"
                    class="w-full p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900"
                    placeholder="Nombre del Campo o Agrícola">
            </div>
            <div class="col-span-2">
                <label>Rut, Ejemplo 12345678-9</label>
            </div>
            <div class="col-span-2">
                <input type="text" wire:model.defer="rut"
                    class=" p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900"
                    placeholder="Rut">
            </div>
            <div class="col-span-2">
                <label>Dirección</label>
            </div>
            <div class="col-span-2">
                <input type="text" wire:model.defer="direccion"
                    class="w-full p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900"
                    placeholder="Dirección del Campo o Agrícola">
            </div>

            <div class="col-span-2">
                <label>Superficie en Hectáreas</label>
            </div>
            <div class="col-span-2">
                <input type="number" wire:model.defer="superficie" min="1" max="50"
                    class="w-24 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900"
                    placeholder="Hectáreas">
            </div>
            <div class="col-span-2">
                <label>Comuna</label>
            </div>
            <div class="col-span-2 h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                @livewire('campo.select-comuna')
            </div>
            <div class="col-span-2">
                <label>Administrador</label>
            </div>
            <div class="col-span-2 h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                @livewire('campo.select-admin')
            </div>

            <div class="col-span-2 mt-2">
                <button wire:click.prevent="save"
                    class="bg-gray-700 text-white py-2 px-4 w-full rounded hover:bg-gray-600">Guardar Campo</button>
            </div>
            </form>
        </div>

        {{-- lista de campos de la empresa. --}}

        <div class="sm:col-span-1 md:col-span-2 bg-white mb-10 ml-2 mr-2 mt-8 mx-auto px-5 py-8 rounded-lg shadow-lg">
            <h2 class="text-center  tracking-wide">Lista de Campos Empresa</h2>
            @livewire('campo.lista-campos-edit')
        </div>

    </div>
    {{-- fin contenido --}
    {{-- fin --}}
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
    @endif
    @if (Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ Session::get('error') }}',
                timer: 5000,
                showConfirmButton: false
            });
        </script>
    @endif
    <script>
        window.addEventListener('swal', function(e) {

            Swal.fire({
                icon: 'success',
                title: 'Éxito, Campo Guardado...',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });

        });
    </script>

</div>
