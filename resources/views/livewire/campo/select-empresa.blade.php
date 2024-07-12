<div>
    <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
        <select  wire:model='selectedId' wire:change="SelectEmpresa" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent"
            id="SelectEmpresa">
            <option class="" value=" ">Seleccione Propietario.</option>
            @foreach ($contnomb as $contn)
                <option class="p-2" value="{{ $contn->id }}">{{ $contn->razon_social }}</option>
            @endforeach
        </select>
    </div>
</div>
