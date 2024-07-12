<x-guest-layout>
    {{-- <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Perdió su password?') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Ingresar') }}
                </x-button>
            </div>
        </form> 

    </x-authentication-card>--}}
                    {{-- <div
                        class="ml-20 mt-10 bg-neutral-100 p-3 rounded-full shadow-xl bg-no-repeat w-full h-full object-cover"  style="width: 450px; height: 200px; background-image: url('{{ asset('storage/logoComercialCaro.png') }}');">
                        {{-- <a class="py-2.375 text-sm mr-4 ml-4 whitespace-nowrap font-bold text-slate-700 lg:ml-0"
                            href="../pages/dashboard.html"> Comercial Caro Hmnos. SpA </a> --}}
                       
                        
               
                    {{-- </div>
   
       
                        <div class="grid grid-cols-12">
                            
                            <div
                                class="ml-20 col-span-4 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border">
                                <div class="text-center p-6 pb-0 mb-0 bg-transparent border-b-0 rounded-t-2xl">
                                    <h3
                                        class="relative z-10 font-bold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text">
                                        ADMINISTRACIÓN DE CAMPOS</h3>
                                    <p class="mb-0">Ingrese Correo y Contraseña</p>
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                </div>
                                    <div class=" p-6 mb-20">
                                        <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <label class="ml-5 mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
                                        <div class="ml-5 mb-4">
                                            <input id="email" type="email" name="email" :value="old('email')"
                                                required autofocus autocomplete="username"
                                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                                placeholder="Email" aria-label="Email" aria-describedby="email-addon" />
                                        </div>
                                        <label class="ml-5 mb-2 ml-1 font-bold text-xs text-slate-700">Password</label>
                                        <div class="ml-5 mb-4">
                                            <input id="password" type="password" name="password" required
                                                autocomplete="current-password"
                                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="password-addon" />
                                        </div>
                                        <div class="min-h-6 mb-0.5 block pl-12">
                                            <input id="rememberMe" type="checkbox" checked="" />
                                            <label
                                                class="mb-2 ml-1 font-normal cursor-pointer select-none text-sm text-slate-700"
                                                for="rememberMe">Recordar</label>
                                        </div>
                                        <div class="ml-5 text-center">
                                            <button type="submit"
                                                class="inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-green-600 to-cyan-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Ingresar
                                                al Sistema</button>
                                        </div>
                                        </form>

                                    </div>
                                    
                               
                            </div>
                        </div>
                   
                            <div
                                class="mt-18 absolute top-0 hidden w-3/5   -right-40 rounded-bl-xl md:block">
                                <div class="grid grid-cols-10 mt-20 h-full bg-no-repeat inline-block"  style="background-image: url('{{ asset('storage/bgf.png') }}'); max-width: 100%;">
                                    
                                    <div class="col-span-6 mt-20 pt-20 pb-20 pl-10 pr-10 text-justify backdrop-opacity-5 backdrop-invert bg-white/30 shadow-xl inline-block">
                                        <p class="pb-20">¿Por qué lo usamos?
                                            Es un hecho establecido hace demasiado tiempo que un lector se distraerá con
                                            el contenido del texto de un sitio mientras que mira su diseño. El punto de
                                            usar Lorem Ipsum es que tiene una distribución más o menos normal de las
                                            letras, al contrario de usar textos como por ejemplo "Contenido aquí,
                                            contenido aquí". Estos textos hacen parecerlo un español que se puede leer.
                                            Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum
                                            como su texto por defecto,</p>
                                            <x-validation-errors class="mb-4" />
                                    </div>
                                </div>
                            </div>
                  
     
   
    </body> --}} 
            <!-- component -->
<div class="py-20 mt-20 p-5 bg-neutral-100">
  <div class="flex bg-white p-5 rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
        <div class=" mt-20 p-5 bg-neutral-100 rounded-lg shadow-lg shadow-neutral-800 hidden lg:block lg:w-1/2 bg-cover" style="width: 450px; height: 300px; background-image: url('{{ asset('storage/logoAgroplanner.png') }}');"></div>
        <div class="w-full p-8 mb-5 lg:w-1/2">
            <h2 class="text-2xl font-semibold text-gray-700 text-center">AgroPlanner</h2>
            <p class="text-xl text-gray-600 text-center">Sistema Administración de Campos</p>
           
            <div class="mt-4 flex items-center justify-between">
                <span class="border-b w-1/5 lg:w-1/4"></span>
                <a href="#" class="text-xs text-center text-gray-500 uppercase">Login con Correo y contraseña</a>
                <span class="border-b w-1/5 lg:w-1/4"></span>
            </div>
            <form method="POST" action="{{ route('login') }}">
            @csrf
                    <div class="mt-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Dirección Email </label>
                        <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" id="email" type="email" name="email" :value="old('email')"
                                                required>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <a href="#" class="text-xs text-gray-500">Perdió su Password?</a>
                        </div>
                        <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" id="password" type="password" name="password" required type="password">
                    </div>
                    <div class="mt-8">
                        <button class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Ingresar</button>
                    </div>
            </form>
            <div class="mt-4 flex items-center justify-between">
                <span class="border-b w-1/5 md:w-1/4"></span>
                <a href="#" class="text-xs text-gray-500 uppercase">Campos</a>
                <span class="border-b w-1/5 md:w-1/4"></span>
            </div>
            <div> <x-validation-errors class="mb-4" /></div>
        </div>
    </div>
</div>
</x-guest-layout>
