<div>
    <select data-te-select-init data-te-select-filter="true" wire:model="selectedOptionCapataz" wire:change="SelectCapataz">{{-- data-te-select-init data-te-select-filter="true" --}}
        <option class="text-secondary">Seleccione Capataz</option>
        @foreach ($capataz as $capataz)
            <option class="text-primary" value="{{ $capataz->id }}">{{ $capataz->name }}</option>
        @endforeach
    </select>
</div>
