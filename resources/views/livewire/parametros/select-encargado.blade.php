<div>
    <div class="bg-secondary-900">
        <select data-te-select-init data-te-select-filter="true" wire:model='selectedId' wire:change="SelectEncargado">
           
            <option class="text-secondary" value=" ">Seleccione Encargado.</option>
            @foreach ($encargados as $encargado)
                <option class="text-primary" value="{{ $encargado->id }}">{{ $encargado->name }}</option>
            @endforeach
        </select>
    </div>
</div>