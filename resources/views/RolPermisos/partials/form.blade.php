 <!--  nuevos rol -->
 
                        <form action="{{route('Rol.store')}}" method="post">
                            @csrf
                            
                            {{-- NUEVO FORMULARIO --}}
            <div class="container text-left max-w-screen-lg mx-auto mb-5">
                <h2 class="font-semibold text-xl text-gray-600">Formulario Creación de Roles</h2>
                <p class="text-gray-500">Roles para el uso de opciones del sistema según usuario</p>

                <div class="bg-white rounded shadow-lg p-2 px-4 md:p-8 ">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Datos</p>
                            <p>Campos con (*) son obligatorios.</p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-1">
                                    <label for="full_name">Rol.(*)<label>
                                            {{-- <input type="text" id="rol" required name="name"
                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                                value="" /> --}}
                                                {{ Form::text('name',null,['class'=>'h-10 border mt-1 rounded px-4 w-full bg-gray-50','required']) }}
                                </div>
                              
                                <div class="md:col-span-6">
                                    <label for="full_name">Descripción. (*)</label>
                                    {{-- <textarea type="text" name="description" rows="4" 
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""></textarea> --}}
                                        {{ Form::textarea('description',null,['class'=>'h-10 border mt-1 rounded px-4 w-full bg-gray-50','required']) }}
                                </div>
                                

                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">
                                        {{-- <button type="submit"
                                            class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Guardar
                                            Información</button> --}}
                                            {{ Form::submit('Actualizar Rol',['class'=>'bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600']) }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- permisos del rol nuevos --}}
            <!-- permisos -->


        <div class="w-1/2 inline-block mt-5 w-[49.8%] rounded-xl border border-gray-200 bg-white py-4 px-2 shadow-md shadow-gray-100">
            <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
                <div>Permisos Administrador</div>
             
            </div>
            <div class="mt-4">
                <div class="flex max-h-[200px] w-full flex-col overflow-y-scroll">
                 @foreach ($permissions as $permission)    
                    <div class="mt-4 flex items-center gap-3">
                        <label>
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class='relative h-5 w-10 appearance-none rounded-[20px] bg-[#e0e5f2] outline-none transition duration-[0.5s] 
                        before:absolute before:top-[50%] before:h-4 before:w-4 before:translate-x-[2px] before:translate-y-[-50%] before:rounded-[20px]
                        before:bg-white before:shadow-[0_2px_5px_rgba(0,_0,_0,_.2)] before:transition before:content-[""]
                        checked:before:translate-x-[22px] hover:cursor-pointer checked:bg-brand-500 dark:checked:bg-brand-400'
                                {{ $rol->hasPermissionTo($permission) ? 'checked' : '' }}>
                            {{ $permission->name }}
                        </label>
                        {{-- <input
                        type="checkbox" value="{{$permission->id}}"
                        class='relative h-5 w-10 appearance-none rounded-[20px] bg-[#e0e5f2] outline-none transition duration-[0.5s] 
                        before:absolute before:top-[50%] before:h-4 before:w-4 before:translate-x-[2px] before:translate-y-[-50%] before:rounded-[20px]
                        before:bg-white before:shadow-[0_2px_5px_rgba(0,_0,_0,_.2)] before:transition before:content-[""]
                        checked:before:translate-x-[22px] hover:cursor-pointer checked:bg-brand-500 dark:checked:bg-brand-400'
                        name="permission[]" id="checkbox{{$permission->id}}" /> --}}
                        {{-- {{ Form::checkbox('permissions[]',$permission->id,null,['class'=>''])}}
                        <label for="checkbox{{$permission->id}}" class="text-base font-medium text-neutral-700 ">
                            {{$permission->description}}
                        </label> --}}
                    </div>
                @endforeach
                  
                </div>
            </div>
        </div>

{{-- fin permisos --}}
<!-- permisos -->

        <div class="mb-20 w-1/2 inline-block mt-5 w-[49.8%] rounded-xl border border-gray-200 bg-white py-4 px-2 shadow-md shadow-gray-100">
            <div class="flex items-center justify-between px-2 text-base font-medium text-gray-700">
                <div>Permisos Producción</div>
              
            </div>
            <div class="mt-4">
                <div class="flex max-h-[200px] w-full flex-col overflow-y-scroll">
                 @foreach ($permissionsProd as $permissionprod)    
                    <div class="mt-4 flex items-center gap-3">
                        <input
                        type="checkbox" value="{{$permissionprod->id}}"
                        class='relative h-5 w-10 appearance-none rounded-[20px] bg-[#e0e5f2] outline-none transition duration-[0.5s] 
                        before:absolute before:top-[50%] before:h-4 before:w-4 before:translate-x-[2px] before:translate-y-[-50%] before:rounded-[20px]
                        before:bg-white before:shadow-[0_2px_5px_rgba(0,_0,_0,_.2)] before:transition before:content-[""]
                        checked:before:translate-x-[22px] hover:cursor-pointer checked:bg-brand-500 dark:checked:bg-brand-400'
                        name="permission[]" id="checkbox{{$permissionprod->id}}" />
                        <label for="checkbox{{$permissionprod->id}}" class="text-base font-medium text-neutral-700 ">
                            {{$permissionprod->description}}
                        </label>
                    </div>
                @endforeach
                  
                </div>
            </div>
        </div>
 </form>
{{-- fin permisos --}}

            {{-- fin permisos nuevo del rol --}}
                            {{-- FIN NUEVO FORMULARIO --}}
                                <!--rut-->
                                {{-- <div class="grid grid-cols-1">
                                    <div class="md:col-start-1 md:col-span-12 relative mb-3" data-te-input-wrapper-init> --}}
                                        <!-- <input id="rol" maxlength="50" type="text" name="name" required class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" aria-describedby="emailHelp123" placeholder="First name" /> -->
                                        {{-- {{ Form::text('name',null,['class'=>'peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0','required']) }} --}}
                                        <!-- <label for="emailHelp123" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary"> -->
                                        {{-- {{ Form::label('name','Nombre Perfil',['class'=>'pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary']) }} --}}
                                        <!-- </label> -->
                                    {{-- </div> --}}

                             
                                    {{-- <div class="md:col-start-1 md:col-span-12 relative mb-6" data-te-input-wrapper-init> --}}
                                        <!-- <textarea type="text" required class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                            id="description" name="description"
                                            placeholder=""></textarea> -->
                                            {{-- {{ Form::textarea('description',null,['class'=>'peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0','required']) }} --}}
                                        <!-- <label
                                            for="exampleInput125"
                                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200"
                                            >Descripción
                                        </label> -->
                                        {{-- {{ Form::label('description','Descripción del Perfil',['class'=>'pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200']) }} --}}
                                    {{-- </div>
                                    <div class="md:col-start-1 md:col-span-2"> --}}
                                        <!-- <button id="btn_sv" type="submit" class=" py-5 mb-5 inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]"
                                        data-te-ripple-init
                                        data-te-ripple-color="light">
                                        Actualizar Rol
                                        </button> -->
                                        {{-- {{ Form::submit('Actualizar Rol',['class'=>'py-5 mb-5 inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]']) }} --}}
                                    {{-- </div>
                                </div> --}}
                                <div>
                                    <!-- permisos -->
                                    <div class="bg-white rounded-lg p-5 pt-5">

                                     
                                        <div class="flex flex-col">
                                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                                <div class="overflow-hidden">
                                                    <table class="min-w-full text-left text-sm font-light">
                                                    <thead
                                                        class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-blue-800 text-neutral-50">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-4">Seleccionar Permisos de acceso</th>
                                                            <!-- <th scope="col" class="px-6 py-4">Permiso</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-700 text-neutral-50">
                                                            <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                                                        
                                                                @foreach($permissions as $permission)
                                                                <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
                                                                    <!-- <input                                                                                                                                     x                                                                                       x                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     x
                                                                        class="relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute c before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:checked:border-primary dark:checked:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
                                                                        type="checkbox"
                                                                        value="{{$permission->id}}"
                                                                        name="permission[]"
                                                                        id="checkboxDefault" /> -->
                                                                        {{-- {{ Form::checkbox('permissions[]',$permission->id,null,['class'=>'']) }} --}}
                                                                    <label
                                                                        class="inline-block pl-[0.15rem] hover:cursor-pointer"
                                                                        for="checkboxDefault">
                                                                       {{ $permission->description}}
                                                                    </label>
                                                                </div>
                                                                @endforeach

                                                            </td>
                                                            <!-- <td class="whitespace-nowrap px-6 py-4">xxx,</td> -->
                                                        </tr>
                                                    
                                                    </tbody>
                                                    </table>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- tabla -->
                                    </div>
                                    <!-- permisos -->
                                </div>
       

                            <!--Submit button-->
                        </form>
                    </div>
                    <!-- nuevos usuarios -->





<!-- <div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('name','Nombre Perfil') }}
</div> -->
<!-- <div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('name',null,['class'=>'form-control','required']) }}
</div>     -->
<!-- <div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('slug','URL (Una sola Palabra para describir el perfil') }}
</div> -->
<!-- <div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('slug',null,['class'=>'form-control','required']) }}
</div>   -->
<!-- <div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('description','Descripción del Perfil') }}
</div> -->
<!-- <div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::textarea('description',null,['class'=>'form-control','required']) }}
</div>   -->
<!-- <hr>
<h3> Permiso Especial</h3>
<div class="form-group">
    <label>{{ Form::radio('special','all-access')}} Acceso Total</label>
    <label>{{ Form::radio('special','no-access')}} Acceso Prohibido</label>
</div>
</hr>

<h3>Lista de Roles</h3> -->
<!-- <table class="table" id="tablaProyectos">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Seleccionar</th>
                                                        <th scope="col">Perfil</th>
                                                        <th scope="col">Detalle</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody> -->
                                                <!-- @foreach($permissions as $permission)
                                                    <tr>
                                                         <th scope="row">{{ Form::checkbox('permissions[]',$permission->id,null) }}</th> 
                                                        <td>{{ $permission->name }}</td>
                                                        <td>{{ $permission->description }}</td>
                                                    </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table> -->


<!--    
    <li>
        <label>
            {{ Form::checkbox('permissions[]',$permission->id,null) }}
            {{ $permission->name }},
            <em>{{ $permission->description }}</em>
        </label>
    </li> -->
  
<!-- <br/>
<br/>
@can('rolesprofiles.crud')
<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::submit('Guardar Perfil con sus Rol',['class'=>'btn btn-sm btn-primary']) }}
</div>
@endcan -->