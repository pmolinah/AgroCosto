<div>
     <button type="button" wire:click="EditarEspecie({{ $especie }})"
                                                    class="mb-1inline-block rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i
                                                        class="far fa-edit"></i></button>
    <x-modal wire:model="open_edit_especie">
        @foreach ($especieDB as $especieDB)
            <h5 class=" p-3 text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200 dark:bg-info-900">

                Edición de Especie
                {{-- {{$especieDB}} --}}
            </h5>
            <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
            <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                Especie <input type="hidden" wire:model.defer="edit_id">
                <div class="relative mb-3" data-te-input-wrapper-init>
                    <input type="text" wire:model.defer="especie" value="{{ $especie }}"
                        class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                </div>
            </div>

            <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
            <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                Variedad
                <select data-te-select-init  class="text-neutral-900"
                    wire:model.defer="variedad_id">
                    <option value="{{ $especieDB->variedad_id }}">{{ $especieDB->variedad->variedad }}</option>
                    @if (isset($variedades_especie))
                        @foreach ($variedades_especie as $variedades_especie)
                            @if ($variedades_especie->id != $especieDB->variedad_id)
                                <option value="{{ $variedades_especie->id }}">{{ $variedades_especie->variedad }}
                                </option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>


            {{-- selct pluck --}}
            <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                Metros Cuadrados
                <div class="relative mb-3" data-te-input-wrapper-init>
                    <input type="text" wire:model.defer="metros2"
                        class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                </div>
            </div>
            <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                Metros Cuadrados
                <div class="relative mb-3" data-te-input-wrapper-init>
                    <input type="date" wire:model.defer="fechaCosecha"
                        class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" />

                </div>
            </div>

            <div class="relative p-4 text-neutral-50 dark:bg-info-900">
                Observación
                <div class="relative mb-3" data-te-input-wrapper-init>
                    <textarea wire:model.defer="observacion"
                        class="peer block min-h-[auto] w-full rounded border-0  px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-900 dark:placeholder:text-neutral-900 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        rows="3"></textarea>

                </div>
            </div>
            <hr class=" h-0.5 border-t-0 bg-neutral-50 opacity-100 dark:opacity-500" />
            <div class="dark:bg-info-900 p-3">
               
                <button type="button" wire:click="Limpiar"
                    class="ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                    data-te-ripple-init data-te-ripple-color="light" data-te-modal-dismiss>
                    Cerrar
                </button>

            </div>
        @endforeach

    </x-modal>
</div>
