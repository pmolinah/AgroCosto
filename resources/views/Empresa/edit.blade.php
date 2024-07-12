<x-dashBoard>

    <div class="grid grid-cols-12 py-5 px-5">
        <!-- edit rol formulario nuevo -->
        <div class="xs:col-start-1 xs:col-end-12 md:col-start-2 md:col-span-10 rounded-lg  p-6">



                     {!! Form::model($Empresa, ['route'=>['Empresa.update',$Empresa->id], 'method'=>'PUT']) !!}
                        @csrf

                        @include('Empresa.partials.form')

                    {!! Form::close() !!}
                    <!-- nuevos usuarios -->
                    

 
    
                <!-- </div> -->
            </div>
        </div>
    </div>
</x-dashBoard>

 <!-- Contenido formulario funcionando -->
 