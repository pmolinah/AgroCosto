    <div>
    <select data-te-select-init data-te-select-filter="true" wire:model='selectedId'>{{-- data-te-select-init data-te-select-filter="true" --}}
        <option class="text-secondary" value=" ">Seleccione Administrador</option>
        @foreach ($administradores as $administrador)
            <option class="text-primary" value="{{ $administrador->id }}">{{ $administrador->name }}</option>
        @endforeach
    </select>
</div>

