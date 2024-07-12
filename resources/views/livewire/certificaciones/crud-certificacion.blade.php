<div>
    <form action="{{route('store.certificado')}}" method="post" enctype="multipart/form-data">
    @CSRF
    <div class="grid grid-cols-1 md:lg:xl:grid-cols-12 p-5">
            {{-- ingreso --}}
                <div class="col-span-6">
                    <!--Modal body-->
                    <div class="grid grid-cols-10 border-solid border-2 bg-white rounded-lg m-2 shadow-xl">
                    <div class="col-span-10 mt-2">
                        <h3 class="text-bold text-xl text-center a Campo">
                            Asignación de Certificados a Campo
                        </h3>
                    </div>
                        <div class="col-span-10 relative text-left p-2">
                            Nombre Certificación
                                    <select wire:model.defer="certificado_id" name="certificado_id" class="h-10 border rounded px-4 w-full bg-gray-50">
                                        <option></option>
                                        @foreach ($certificacion as $certificaciones)
                                            <option value="{{ $certificaciones->id }}">{{ $certificaciones->certificacion }}</option>
                                        @endforeach
                                    </select>
                        </div>
                        <div class="col-span-5 pl-2 text-left">
                            Fecha Inicio
                            <input type="date" wire:model.defer="fechaInicio" name="fechaInicio" class="h-10 border rounded px-4 w-full bg-gray-50">
                        </div>
                         <div class="col-span-5 pl-2 pr-2 text-left">
                            Fecha Termino
                            <input type="date" wire:model.defer="fechaTermino" name="fechaTermino" class="h-10 border  rounded px-4 w-full bg-gray-50">
                        </div>
                        <div class="col-span-10 pl-2 pr-2 text-left">
                            Campo
                            <select wire:model.defer="campo_id" name="campo_id"
                                class="h-10 border rounded px-4 w-full bg-gray-50">
                                <option></option>
                                @foreach ($certificacionCampo as $campo)
                                    <option value="{{ $campo->id }}">{{ $campo->campo }}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="col-span-10 pl-2 mr-2 text-left ">
                            Casa Certificadora
                            <input type="text" wire:model.defer="casaCertificadora" name="casaCertificadora" class="h-10 border rounded px-4 w-full bg-gray-50">
                        </div>
                         <div class="col-span-10 pl-2 mr-2 text-left">
                            Adjuntar Documento
                            <input type="file"  name="file" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                        </div>
                         <div class="col-span-10 pl-2 mr-2 text-left">
                            Alerta de Caducidad..(Días)
                            <input type="number" wire:model.defer="alerta" name="alerta" class="h-10 border rounded px-4 w-full bg-gray-50">
                        </div>
                        <div class="col-span-10 ml-2 mr-2 shadow-xl">
                            Observación Max 100 Caractéres
                            <textarea wire:model.defer="observacion" rows="2" name="observacion"
                            class="h-10 border rounded px-4 w-full bg-gray-50"></textarea>
                        </div>
                       
                    <div class="mt-4 col-span-10 mb-4">
                        <button type="submit" 
                            class="bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600"
                            data-te-modal-dismiss>
                            Asignar Certificado al Campo
                        </button>
                    </div>
                    </div>
                </div>
            {{-- ingreso --}}
        </form>
        <div class="col-span-6  p-2 m-2">
            {{-- caja creacion --}}
            <div class="space-y-1 bg-white rounded-lg shadow-xl">
                <!-- Button trigger vertically centered modal-->
                <div class="grid sm:grid-cols-1 md:grid-cols-3 borde-neutral-800">
                    <div class="col-span-2 p-2">
                        <button type="button"
                            class="bg-gray-700 text-white  py-2 px-4 w-full rounded hover:bg-gray-600"
                            data-te-toggle="modal" data-te-target="#exampleModalCenter">
                            Crear Certificado</button>
                        </button>
                    </div>
                    {{-- <div class="text-center">
                        <h6 class="text-xl text-bold ">Ingreso de Nombres de Certificaciones </h6>
                    </div> --}}
                    <div class="col-span-1 p-2">
                        <input type="text" wire:model="search"
                            class="w-32 border-solid border-2 p-2" placeholder="Buscar"/>
                    </div>
                </div>
                {{-- tabla --}}
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow-xl m-1">
                                <table class="min-w-full text-center text-sm font-light ">
                                    <thead
                                        class="border-2 p-2 bg-white dark:bg-neutral-300">
                                        <tr>

                                            <th scope="col" class=" px-6 py-2">Certificación</th>

                                            <th scope="col" class=" px-6 py-2">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($certificacion as $certificaciones)
                                            <tr class="border-2 rounde-lg bg-white">

                                                <td class="whitespace-nowrap">{{ $certificaciones->certificacion }}
                                                </td>
                                                <td class="whitespace-nowrap  px-6">
                                                    <center><button type="button"
                                                            wire:click="EliminarnombreCertificado({{ $certificaciones->id }})"
                                                            class="mb-1 inline-block rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                                            <i class="far fa-trash-alt"></i></button>
                                                    </center>
                                                    {{-- <center><button type="button"
                                                            wire:click="EditarCertificado({{ $certificaciones->id }})"
                                                            class="mb-1inline-block rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i
                                                                class="far fa-edit"></i></button>
                                                    </center> --}}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            {{ $certificacion->links() }}
                        </div>
                    </div>
                </div>
                <script>
                    window.addEventListener('GuardarCertificado', function(e) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito, Registro Guardado...',
                            text: '{{ Session::get('success') }}',
                            timer: 5000,
                            showConfirmButton: false
                        });
                    });
                    window.addEventListener('Eliminar', function(e) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Éxito, Registro Eliminado...',
                            text: '{{ Session::get('success') }}',
                            timer: 5000,
                            showConfirmButton: false
                        });
                    });
                    window.addEventListener('Actualizar', function(e) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito, Registro Actualizado...',
                            text: '{{ Session::get('success') }}',
                            timer: 5000,
                            showConfirmButton: false
                        });
                    });
                </script>
                {{-- fin caja --}}
            </div>
    <div class="w-full rounded-xl border border-gray-200 bg-white py-2 mt-2 px-2 shadow-xl">
        <div class="mt-2">
            <div class="flex max-h-[320x] w-full flex-col overflow-y-scroll">
                <div class="col-span-7 p-1 mt-3 shadow-xl bg-white rounded-lg">
                <div class="p-3 text-xl text-bold">
                    <h5>Listado de Campos</h5></label>
                </div>
                    <table class="min-w-full text-center text-sm font-light ">
                        <thead class="border-2 bg-neutral-300">
                            <tr>

                                <th class=" px-6 py-2">Campo</th>
                                <th class=" px-6 py-2">Sup./Ha</th>
                                <th class=" px-6 py-2">Certificado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($certificacionCampo as $campo)
                                <tr class="border-2">
                                    <td class="text-left border-2"><i class="fa-solid fa-layer-group"></i>&nbsp;&nbsp;&nbsp;{{ $campo->campo }}</td>
                                    <td>{{ $campo->superficie }}</td>
                                    <td  class="text-center">
                                    <center>
                                        <table>
                                            <thead>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                @foreach ($campo->certificacionasignada as $campoCertificacion)
                                                    <tr>
                                                        <th class="border-2">{{$campoCertificacion->certificacion->certificacion }}</th>
                                                        <th class="border-2 p-1"><a href="../{{$campoCertificacion->rutaDocumento}}{{$campoCertificacion->documento}}" target="_blank">
                                                                <button type="button" class="mb-1 inline-block rounded bg-success-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                                                        <i class="far fa-search">
                                                                </i></button>           
                                                            </a>           
                                                        </th>    
                                                        <th class="border-2 p-1">
                                                            <button type="button" wire:click="EliminarCertificado({{ $campoCertificacion->id }})"
                                                            class="mb-1 inline-block rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                                            <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </center>
                                    </td>

                                    {{-- <td>
                                        <button type="button" class="inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                            data-te-toggle="modal" data-te-target="#exampleModalCenteraaaa" data-te-ripple-init
                                            data-te-ripple-color="light"><i class="far fa-plus"></i></button>
                                        </button>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
             </div> 
        </div>
        
        {{-- modal cert --}}
        <!--Verically centered modal-->
        <div data-te-modal-init
            class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
            data-te-backdrop="static" data-te-keyboard="false" id="exampleModalCenteraaaa" tabindex="-1"
            aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
            <div data-te-modal-dialog-ref
                class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[700px]">
                
            </div>
        </div>
        {{-- modal --}}
        <!--Verically centered modal-->
                <div data-te-modal-init
                    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                    data-te-backdrop="static" data-te-keyboard="false" id="exampleModalCenter" tabindex="-1"
                    aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                    <div data-te-modal-dialog-ref
                        class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                        <div
                            class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg bg-white">
                            <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-2 dark:border-opacity-50 bg-neutral-300">
                                <!--Modal title-->
                                <h5 class="text-xl">
                                    Nuevo Certificado
                                </h5>
                                <!--Close button-->
                                <button type="button"
                                    class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                                    data-te-modal-dismiss aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!--Modal body-->
                            <div class="relative p-5">
                                Certificación
                                <div class="relative mb-3" data-te-input-wrapper-init>
                                    <input type="text" wire:model.defer="certificado"
                                        class="h-10 border rounded px-4 w-full bg-gray-50" />

                                </div>
                            </div>

                            <!--Modal footer-->
                            <div class=" p-2 flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                <div class="inline-block p-2">
                                    <button type="button"
                                        class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600"
                                        data-te-modal-dismiss>
                                        Cerrar
                                    </button>
                                </div>
                                <div class="inline-block p-2">
                                    <button type="button" wire:click="Save"
                                        class="bg-gray-700 text-white  py-2 px-4 rounded hover:bg-gray-600"
                                        data-te-modal-dismiss>
                                        Guardar Certificado
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- fin modal --}}
    </div>
