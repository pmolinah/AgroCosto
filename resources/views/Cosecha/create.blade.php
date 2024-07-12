<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movimiento de Cosecha') }}
        </h2>
    </x-slot>
    <!-- Add Item Ml -->

    <div class="py-5">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <div class="mx-auto w-3/5 overflow-hidden"> --}}
                <!-- contenido -->
                <!-- component -->
                <div class="px-1 md:lg:xl:px-5   border-t border-b py-10 bg-opacity-10" style="background-image: url('https://www.toptal.com/designers/subtlepatterns/uploads/dot-grid.png') ;">
                    <div class="grid sm:grid-cols-1 md:grid-cols-12 shadow-xl">
                        <div class="col-span-12 bg-neutral-100">
                            <h1 class="text-center mb-2 mt-0 text-5xl font-medium leading-tight text-primary">
                                Cosecha
                            </h1>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
