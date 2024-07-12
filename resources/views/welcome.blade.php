<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ccampos</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <!-- Styles -->

    <!-- component -->
    <link href="https://fonts.googleapis.com/css?family=Opens+Sans:300,400,700,900&display=swap" rel="stylesheet">
</head>



<!-- component -->
<div class="w-full">
    <nav class="bg-gray-100 shadow-lg">
        <div class="md:flex items-center justify-between py-2 px-8 md:px-12">
            <div class="flex justify-between items-center">
                <div class="text-xl font-bold text-gray-500 md:text-3xl"> 
                    {{-- <img src="{{ asset('storage/logoAgroplanner.png') }}" width="100" height="50"> --}}
                    AGROPLANNER ASESORIAS SPA.
                {{-- <a href="#" class="ml-2 text-orange-600">Comercial Caro Hnos. SpA</a> --}}
                </div>
                <div class="md:hidden">
                    <button type="button"
                        class="block text-gray-800 hover:text-gray-700 focus:text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                            <path class="hidden"
                                d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z" />
                            <path
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row hidden md:block -mx-2">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-orange-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-orange-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in, Sistema Ccampos</a>

                    <!-- @if (Route::has('register'))
    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
    @endif -->
                @endauth
                {{-- <a href="#" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">About</a>
                <a href="#" class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Contact</a> --}}
            </div>
        </div>
    </nav>
    <div class="flex bg-white" style="height:460px;">
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
            <div>
                <h2 class="text-3xl font-semibold text-gray-800 md:text-4xl">Administre y Controle sus Campos con <span
                        class="text-green-600">AgroPlanner.</span></h2>
                <p class="mt-2 text-sm text-gray-500 md:text-base">sistema enfocado a la gestión de Campos, Cuarteles y
                    especies para el desarrollo y manejo de sus cosechas</p>
                {{-- <div class="flex justify-center lg:justify-start mt-6">
                    <a class="px-4 py-3 bg-gray-900 text-gray-200 text-xs font-semibold rounded hover:bg-gray-800"
                        href="#">Comocer Más</a>
                    {{-- <a class="mx-4 px-4 py-3 bg-gray-300 text-gray-900 text-xs font-semibold rounded hover:bg-gray-400" href="#">Learn More</a> -}}
                </div> --}}
            </div>
        </div>
        <div class="hidden lg:block lg:w-1/2" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
            <div class="h-full relative" style="background-image: url('{{ asset('storage/logoAgrogesFondo.png') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-black opacity-25"></div>
    <!-- Contenido adicional dentro del div -->
</div>

        </div>
         {{-- <div class="hidden lg:block lg:w-1/2" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
            <div class="h-full w-full object-cover  bg-no-repeat  bg-cover"
                style="background-image: url({{ asset('storage/logoAgroges.png') }})">
                {{-- <div class="h-full bg-black opacity-25"></div> -}}
            </div>
        </div> --}}

    </div>
    <!-- component -->
    <div class="flex items-end w-full bg-white">

        <footer class="w-full text-gray-700 bg-gray-100 body-font">
            <div
                class="container flex flex-col flex-wrap px-5 py-18 p-5 mx-auto md:items-center lg:items-start md:flex-row md:flex-no-wrap">
                <div class="flex-shrink-0 w-64 mx-auto text-center md:mx-0 md:text-left">
                    <a class="flex items-center justify-center font-medium text-gray-900 title-font md:justify-start">
                      
                    </a>
                    <p class="mt-2 text-sm text-gray-500">Desarrollo de sistemas!</p>
                    <div class="mt-4">
                        <span class="inline-flex justify-center mt-2 sm:ml-auto sm:mt-0 sm:justify-start">
                            <a class="text-gray-500 cursor-pointer hover:text-gray-700">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                            </a>
                            <a class="ml-3 text-gray-500 cursor-pointer hover:text-gray-700">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    class="w-5 h-5" viewBox="0 0 24 24">
                                    <path
                                        d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                                    </path>
                                </svg>
                            </a>
                            <a class="ml-3 text-gray-500 cursor-pointer hover:text-gray-700">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5">
                                    </rect>
                                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                                </svg>
                            </a>
                            <a class="ml-3 text-gray-500 cursor-pointer hover:text-gray-700">
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path stroke="none"
                                        d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                                    </path>
                                    <circle cx="4" cy="4" r="2" stroke="none"></circle>
                                </svg>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="flex flex-wrap flex-grow mt-10 -mb-10 text-center md:pl-20 md:mt-0 md:text-left">
                    <div class="w-full px-4 lg:w-1/4 md:w-1/2">
                        <h2 class="mb-3 text-sm font-medium tracking-widest text-gray-900 uppercase title-font">Empresa
                        </h2>
                        <nav class="mb-10 list-none">
                            <li class="mt-3">
                                <a class="text-gray-500 cursor-pointer hover:text-gray-900">Misión</a>
                            </li>
                            <li class="mt-3">
                                <a class="text-gray-500 cursor-pointer hover:text-gray-900">Visión</a>
                            </li>

                        </nav>
                    </div>
                    <div class="w-full px-4 lg:w-1/4 md:w-1/2">
                        <h2 class="mb-3 text-sm font-medium tracking-widest text-gray-900 uppercase title-font">Suporte
                        </h2>
                        <nav class="mb-10 list-none">
                            <li class="mt-3">
                                <a class="text-gray-500 cursor-pointer hover:text-gray-900">Contactenos</a>
                            </li>


                        </nav>
                    </div>
                    {{-- <div class="w-full px-4 lg:w-1/4 md:w-1/2">
                    <h2 class="mb-3 text-sm font-medium tracking-widest text-gray-900 uppercase title-font">Platform
                    </h2>
                    <nav class="mb-10 list-none">
                        <li class="mt-3">
                            <a class="text-gray-500 cursor-pointer hover:text-gray-900">Terms &amp; Privacy</a>
                        </li>
                        <li class="mt-3">
                            <a class="text-gray-500 cursor-pointer hover:text-gray-900">Pricing</a>
                        </li>
                      
                    </nav>
                </div> --}}
                    {{-- <div class="w-full px-4 lg:w-1/4 md:w-1/2">
                    <h2 class="mb-3 text-sm font-medium tracking-widest text-gray-900 uppercase title-font">Contact</h2>
                    <nav class="mb-10 list-none">
                        <li class="mt-3">
                            <a class="text-gray-500 cursor-pointer hover:text-gray-900">Send a Message</a>
                        </li>
                        <li class="mt-3">
                            <a class="text-gray-500 cursor-pointer hover:text-gray-900">Request a Quote</a>
                        </li>
                      
                    </nav>
                </div> --}}
                </div>
            </div>
            <div class="bg-gray-300">
                <div class="container px-5 py-2 mx-auto">
                    <p class="text-sm text-gray-700 capitalize xl:text-center">© 2023 All rights reserved </p>
                </div>
            </div>
        </footer>

    </div>
</div>

</html>
