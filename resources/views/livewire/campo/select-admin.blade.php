<div>
    <select class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" wire:model="selectedOptionAdmin" wire:change="SelectAdmin">{{-- data-te-select-init data-te-select-filter="true" --}}
        <option class="text-secondary">Seleccione Administrador</option>
        @foreach ($administrador as $administrador)
            <option value="{{ $administrador->id }}">{{ $administrador->name }}</option>
        @endforeach
    </select>
</div>
