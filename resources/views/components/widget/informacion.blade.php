<div>
  
    <!-- component -->
    <div class="flex flex-col">
    
        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <div class="flex items-start rounded-xl bg-white p-4 shadow shadow-neutral-900">
                <div class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

                <div class="ml-4">
                    <h2 class="font-semibold">Campos</h2>
                    <p class="mt-2 text-sm text-gray-500">{{ $campos }}</p>
                </div>
            </div>

            <div class="flex items-start rounded-xl bg-white p-4 shadow shadow-neutral-900">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-full border border-orange-100 bg-orange-50">
                    <i class="fa-solid fa-hashtag"></i>
                                        
                </div>

                <div class="ml-4">
                    <h2 class="font-semibold">Cuarteles</h2>
                    <p class="mt-2 text-sm text-gray-500">{{ $cuarteles }}</p>
                </div>
            </div>
            <div class="flex items-start rounded-xl bg-white p-4 shadow shadow-neutral-900">
                <div class="flex h-12 w-12 items-center justify-center rounded-full border border-red-100 bg-red-50">
                   <i class="fa-regular fa-lemon"></i>
                </div>

                <div class="ml-4">
                    <h2 class="font-semibold">Especies</h2>
                    <p class="mt-2 text-sm text-gray-500">{{ $especies }}</p>
                </div>
            </div>
            <div class="flex items-start rounded-xl bg-white p-4 shadow shadow-neutral-900">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-full border border-indigo-100 bg-indigo-50">
                   <i class="fa-solid fa-building"></i>
                                       
                </div>

                <div class="ml-4">
                    <h2 class="font-semibold">Empresas</h2>
                    <p class="mt-2 text-sm text-gray-500">{{ $contratistas }}</p>
                </div>
            </div>
        </div>
    </div>

</div>
