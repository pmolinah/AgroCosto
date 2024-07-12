<div>

    <select class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" wire:model="selectedOptionComuna" wire:change="SelectComuna">{{-- data-te-select-init data-te-select-filter="true" --}}
        <option class="">Seleccione Comuna</option>
        @foreach ($comunas as $comuna)
            <option value="{{ $comuna->id }}">{{ $comuna->id }},{{ $comuna->comuna }}</option>
        @endforeach
    </select>

</div>
