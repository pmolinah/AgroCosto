<x-app-layout>
    {{-- nuevo sidebar --}}
    <!-- component -->
    <style>
        /* This example part of kwd-dashboard see https://kamona-wd.github.io/kwd-dashboard/ */
        /* So here we will write some classes to simulate dark mode and some of tailwind css config in our project */
        nav {
    position: relative;
    z-index: 1000;
}
#chartdiv {
    width: 200px; /* Ajusta el ancho según sea necesario */
    height: 100px; /* Ajusta la altura según sea necesario */
}

        :root {
        }
        label {
            color: #34495e;
            /* Puedes cambiar a otro color seg�n tus preferencias */
        }
        .hover\:overflow-y-auto:hover {
            overflow-y: auto;
        }
    </style>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" :class="{ 'dark': isDark }" @resize.window="watchScreen()">
        <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-neutral-800">
                Cargando.....
            </div>
            <!-- Sidebar -->
            <!-- Backdrop -->
            <div x-show="isSidebarOpen" @click="isSidebarOpen = false" class="fixed inset-0 z-10 bg-neutral-800 lg:hidden"
                style="opacity: 0.5" aria-hidden="true"></div>

            <aside x-show="isSidebarOpen" x-transition:enter="transition-all transform duration-300 ease-in-out"
                x-transition:enter-start="-translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition-all transform duration-300 ease-in-out"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="-translate-x-full opacity-0" x-ref="sidebar"
                @keydown.escape="window.innerWidth <= 1024 ? isSidebarOpen = false : ''" tabindex="-1"
                class="fixed inset-y-0 z-10 flex flex-shrink-0 overflow-hidden bg-white border-r lg:static dark:border-neutral-800  focus:outline-none">
                <!-- Mini column -->
                <div class="flex flex-col flex-shrink-0 h-full px-2 py-4 border-r dark:border-neutral-800 bg-gray-300 hidden">
                    <!-- Brand -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('Ver.graficos') }}"
                            class="inline-block text-xl font-bold tracking-wider text-neutral-700 uppercase dark:text-light">
                            <img src="{{ asset('storage/logoAgrogesAjustado.png') }}"
                                class="bg-cover bg-center bg-auto w-14 rounded-lg shadow-lg shadow-neutral-800">
                        </a>
                    </div>
                    <div class="flex flex-col items-center justify-center flex-1 space-y-4">
                        <!-- Notification button -->
                        <button @click="openNotificationsPanel"
                            class="p-2 text-neutral-400 transition-colors duration-200 rounded-full bg-neutral-50 hover:text-neutral-600 hover:bg-neutral-100 hover:text-light dark:hover:bg-neutral-700 dark:bg-dark focus:outline-none focus:bg-neutral-100 dark:focus:bg-neutral-700 focus:ring-neutral-800">
                            
                            @livewire('notificacion.campana')
                        </button>
                        <!-- Settings button -->
                        <button @click="openSettingsPanel"
                            class=" p-2 text-neutral-400 transition-colors duration-200 rounded-full bg-neutral-50 hover:text-neutral-600 hover:bg-neutral-100 hover:text-light dark:hover:bg-neutral-700 dark:bg-dark focus:outline-none focus:bg-neutral-100 dark:focus:bg-neutral-700 focus:ring-neutral-800">
                            <span class="sr-only">Open settings panel</span>
                            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                    <!-- Mini column footer -->
                    <div class="relative flex items-center justify-center flex-shrink-0">
                        <!-- User avatar button -->
                        <div class="" x-data="{ open: false }">
                            <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                                type="button" aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
                                class="block transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
                                <span class="sr-only">User menu</span>
                                <i class="fa-regular fa-user fa-2xl"></i>
                            </button>
                            <!-- User dropdown menu -->
                            <div x-show="open" x-ref="userMenu" x-transition:enter="transition-all transform ease-out"
                                x-transition:enter-start="-translate-y-1/2 opacity-0"
                                x-transition:enter-end="translate-y-0 opacity-100"
                                x-transition:leave="transition-all transform ease-in"
                                x-transition:leave-start="translate-y-0 opacity-100"
                                x-transition:leave-end="-translate-y-1/2 opacity-0" @click.away="open = false"
                                @keydown.escape="open = false"
                                class="absolute w-56 py-1 mb-4 bg-white rounded-md shadow-lg min-w-max left-5 bottom-full ring-1 ring-black ring-opacity-5 bg-dark focus:outline-none"
                                tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu">
                                <a href="{{ route('profile.show') }}" role="menuitem"
                                    class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-neutral-600">
                                    @if (auth()->check())
                                        {{ auth()->user()->name }}
                                    @else
                                        {{-- Código para mostrar cuando el usuario no está autenticado --}}
                                        Usuario no autenticado
                                    @endif
                                    {{-- Cierre de la sesión, independientemente de si el usuario está autenticado o no --}}
                                    @if (auth()->check())
                                        {{-- Código adicional si el usuario está autenticado --}}
                                    @else
                                        {{-- modal session --}}
                                        <!-- Modal -->
                                        <div data-te-modal-init
                                            class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                                            id="staticBackdrop" data-te-backdrop="static" data-te-keyboard="false"
                                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div data-te-modal-dialog-ref
                                                class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
                                                <div
                                                    class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                                                    <div
                                                        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                                        <!--Modal title-->
                                                        <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
                                                            id="staticBackdropLabel">
                                                            Modal title
                                                        </h5>
                                                        <!--Close button-->
                                                        <button type="button"
                                                            class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                                                            data-te-modal-dismiss aria-label="Close">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="h-6 w-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <!--Modal body-->
                                                    <div data-te-modal-body-ref class="relative p-4">...</div>
                                                    <!--Modal footer-->
                                                    <div
                                                        class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                                        <button type="button"
                                                            class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                                                            data-te-modal-dismiss data-te-ripple-init
                                                            data-te-ripple-color="light">
                                                            Close
                                                        </button>
                                                        <button type="button"
                                                            class="ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                                            data-te-ripple-init data-te-ripple-color="light">
                                                            Understood
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- fin modal --}}
                                    @endif
                                    <a href="#" role="menuitem"
                                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-neutral-600">
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <x-dropdown-link href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                                {{ __('Salir') }}
                                            </x-dropdown-link>
                                        </form>
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar links -->
                <nav aria-label="Main"
                    class="bg-gradient-to-b from-gray-900 to-gray-900 h-screen flex-1 w-64 px-1 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto shadow-lg shadow-neutral-900" >
                    <!-- Dashboards links -->
                    @can('prod.menu.btn')
                        <div x-data="{ isActive: false, open: false }">
                            <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                            <a href="#" @click="$event.preventDefault(); open = !open"
                                class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                                :class="{ 'bg-neutral-600 bg-neutral-600': isActive || open }" role="button"
                                aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                <span aria-hidden="true" class="bg-white rounded-full p-1">
                                    {{-- <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg> --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32"><g fill="none"><path fill="#d3d3d3" d="M8 20H6v10h2zm18 0h-2v10h2z"/><path fill="#fcd53f" d="m3 12l4-4h5.52l1.98 1l2.96-1h5.06L24 9l3.48-1H28a1 1 0 0 1 1 1v2.52l-.5 2.98l.5 1.98V20a1 1 0 0 1-1 1h-3.52L22 20.5l-2.48.5h-5.04l-1.98-1l-2.98 1H4.49L4 18.5l-1-.974z"/><path fill="#533566" d="M7.475 8H4a1 1 0 0 0-1 1v3.475zm-3 13H4a1 1 0 0 1-1-1v-2.475L12.525 8h4.95zm10 0h-4.95l13-13h4.95zm10 0h-4.95L29 11.525v4.95z"/><path fill="#f8312f" d="M7.5 6A1.5 1.5 0 0 0 6 7.5V8h3v-.5A1.5 1.5 0 0 0 7.5 6m17 0A1.5 1.5 0 0 0 23 7.5V8h3v-.5A1.5 1.5 0 0 0 24.5 6"/></g></svg>
                                </span>
                                <span class="ml-2 text-sm"> Producción. </span>
                                <span class="ml-auto" aria-hidden="true">
                                    <!-- active class 'rotate-180' -->
                                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </a>
                            <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                                @can('prod.crear.despacho')
                                    <a href="{{ route('Guias.index') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Despacho&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                @endcan
                                @can('prod.crear.recepcion')
                                    <a href="{{ route('Guias.recepcion') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Recepción&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-arrow-left"></i>
                                    </a>
                                @endcan
                                @can('prod.crear.devtras')
                                    <a href="{{ route('Devolucion.Envases') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Traspaso/Devolucion&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-arrows-turn-to-dots"></i>
                                    </a>
                                @endcan
                                @can('prod.guias.finalizadas')
                                    <a href="{{ route('Guias.show') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Guías Emitidas&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-clipboard"></i>
                                    </a>
                                @endcan
                                <hr>
                                @can('adm.crear.planificacion')
                                    <a href="{{ route('Cosecha.planificacionCreate') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Planificaciones&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-calendar-days"></i>
                                    </a>
                                @endcan
                                @can('adm.ver.planificacion')
                                    <a href="{{ route('Cosecha.planificacion') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Ver Planificaciones&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-search"></i>
                                    </a>
                                @endcan
                                @can('adm.crear.plantacion')
                                    <a href="{{ route('Plantacion.create') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Plantaciones&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-tree"></i>
                                    </a>
                                @endcan
                                @can('adm.ver.plantacion')
                                    <a href="{{ route('Plantacion.index') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Ver Plantaciones&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-search"></i>
                                    </a>
                                @endcan
                                @can('adm.crear.cosechar')
                                    <hr>
                                    <a href="{{ route('Cosecha.index') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Ver Cosechas&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-apple-whole"></i>
                                    </a>
                                @endcan
                                @can('adm.ver.cosechas.finalizadas')
                                    <a href="{{ route('CosechasCerradas.index') }}" role="menuitem" {{-- class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400"> --}}
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Cosechas Realizadas&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-carrot"></i>
                                    </a>
                                @endcan
                                
                            </div>
                        </div>
                    @endcan
                    @can('Adm.menu.btn')
                        <!-- Components links -->
                        <div x-data="{ isActive: false, open: false }">
                            <!-- active classes 'bg-neutral-100 dark:bg-neutral-600' -->
                            <a href="#" @click="$event.preventDefault(); open = !open"
                                class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                                :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                                aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                <span aria-hidden="true" class="rounded-full bg-white p-1">
                                    {{-- <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg> --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32"><g fill="none"><path fill="#ff9c38" d="M8.25 22.504A11.472 11.472 0 0 0 4.543 30H8.25l.949-3.757zM13.75 30h4.5l1.671-5.035l-1.671-5.245a11.558 11.558 0 0 0-4.5 0l-1.221 5.245zm10-7.496l-1.337 3.739L23.75 30h3.707a11.471 11.471 0 0 0-3.707-7.496"/><path fill="#ff6723" d="M13.75 19.72c-.601.12-1.186.286-1.75.495l-.875 4.876L12 30h1.75zm4.5 0c.602.12 1.186.286 1.75.495l.906 4.876l-.906 4.9h-1.75zm-10 2.784A11.54 11.54 0 0 1 10 21.187l.916 4.365L10 29.99H8.25zM22 21.188a11.54 11.54 0 0 1 1.75 1.316v7.486H22l-.508-4.082z"/><path fill="#f1a11e" d="M21.443 8.245c-.307-.542.235-.918-.297-1.106a2.627 2.627 0 0 1-1.411-1.126c-.43-.72-1.207-.157-2.087-.157c-.337 0-.665-.97-.95-.845a1.53 1.53 0 0 1-1.249 0c-.296-.125-.614.845-.951.845c-.87 0-1.636-.584-2.066.115a2.77 2.77 0 0 1-1.442 1.168c-.563.198-.054 2.055-.054 2.055s-1.644.96-1.143 1.7c.174.272.276.595.276.919v4.35c0 .97.604 1.825 1.504 2.148l1.933.679v-7.74a2.22 2.22 0 0 0 .389-.522c.173-.303.276-.637.306-.96a2.346 2.346 0 0 0 1.861-.574c.43.365.973.595 1.576.595c.102 0 .194-.01.286-.021a2.51 2.51 0 0 0 .696 1.481V19l1.933-.678a2.266 2.266 0 0 0 1.504-2.149v-4.35c0-.323-.898-.647-.714-.918c.532-.772.58-1.805.1-2.66"/><path fill="#fcb100" d="M15.996 22.75c-1.104 0-1.996-.808-1.996-1.808V19.75h4v1.192c-.009.992-.9 1.808-2.004 1.808"/><path fill="black" d="M13 13.99a1.75 1.75 0 1 1-3.5 0a1.75 1.75 0 0 1 3.5 0m9.5 0a1.75 1.75 0 1 1-3.5 0a1.75 1.75 0 0 1 3.5 0"/><path fill="#ffc83d" d="M17.16 6h-2.338c-2.624 0-4.596 2.264-4.29 5.078l.394 6.23C11.202 19.43 12.948 21 15.01 21h1.993c2.061 0 3.807-1.58 4.084-3.691l.375-6.23C21.807 8.395 19.785 6 17.16 6"/><path fill="#fff" d="M12.01 13.68a1.483 1.483 0 0 1 2.904.08c.03.15-.1.29-.247.29h-2.371a.297.297 0 0 1-.286-.37m7.98 0a1.487 1.487 0 0 0-1.442-1.14c-.72 0-1.323.52-1.461 1.22c-.03.15.098.29.246.29h2.371c.188 0 .336-.18.286-.37"/><path fill="#7d4533" d="M12.73 13.79c0-.53.425-.96.949-.96c.523 0 .948.43.948.97c0 .08-.01.17-.02.25H12.77a.793.793 0 0 1-.04-.26m6.55 0c0-.53-.425-.96-.949-.96a.971.971 0 0 0-.968.96c0 .09.02.18.04.26h1.837c.03-.09.04-.17.04-.26"/><path fill="#000" d="M13.679 13.24c.296 0 .543.25.543.55c0 .09-.03.17-.069.26h-.958a.59.59 0 0 1-.06-.26c0-.3.248-.55.544-.55m4.652 0a.551.551 0 0 0-.543.55c0 .09.02.17.069.26h.958a.59.59 0 0 0 .06-.26c0-.3-.248-.55-.544-.55"/><path fill="#fff" d="M13.52 13.41c0 .094-.074.17-.167.17a.169.169 0 0 1-.168-.17c0-.094.075-.17.168-.17c.093 0 .168.076.168.17m4.682 0a.17.17 0 0 1-.168.17a.169.169 0 0 1-.168-.17c0-.094.075-.17.168-.17a.17.17 0 0 1 .168.17"/><path fill="#ed9200" d="m15.59 13.534l-.565 1.748c-.111.359.162.718.556.718h.838c.394 0 .667-.36.556-.718l-.566-1.748c-.131-.379-.697-.379-.818 0"/><path fill="#990839" d="M16.002 17.277a3.104 3.104 0 0 1-1.51-.387c-.145-.08-.31.092-.213.244c.368.59 1.007.986 1.723.986c.726 0 1.365-.397 1.723-.986c.087-.152-.068-.325-.213-.244a3.103 3.103 0 0 1-1.51.386"/><path fill="#fff478" d="M13.772 3h4.466C20.319 3 22 4.824 22 7.059V9.75h.246c.698 0 1.264.56 1.254 1.24c0 .68-.556 1.24-1.254 1.24H9.754c-.688 0-1.254-.55-1.254-1.24c0-.68.556-1.24 1.254-1.24H10V7.059C10 4.813 11.69 3 13.772 3M10 21.188c.63-.386 1.299-.713 2-.973V30h-2zm10-.973c.701.26 1.37.587 2 .973V30h-2z"/><path fill="#fcd53f" d="M16.952 2h-1.893C13.92 2 13 2.888 13 3.985V9.75h6V3.985C19.01 2.888 18.09 2 16.952 2"/></g></svg>
                                </span>
                                <span class="ml-2 text-sm"> Usuario y Roles </span>
                                <span aria-hidden="true" class="ml-auto">
                                    <!-- active class 'rotate-180' -->
                                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </a>
                            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Components">
                                @can('adm.crear.usuarios')
                                    <a href="{{ route('User.create') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Crear Usuarios&nbsp;&nbsp;&nbsp;<i class="fa-regular fa-plus"></i>
                                    </a>
                                @endcan
                                @can('adm.ver.usuarios')
                                    <a href="{{ route('User.index') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Ver Usuarios&nbsp;&nbsp;&nbsp;<i class="fa-regular fa-users"></i>
                                    </a>
                                @endcan
                                @can('adm.crear.roles')
                                    <a href="{{ route('Rol.create') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Roles y Permisos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i>

                                    </a>
                                @endcan
                                @can('adm.ver.roles')
                                    <a href="{{ route('RolePermisos.index') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Ver Roles/Permisos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-table-list"></i>
                                    </a>
                                @endcan
                               
                            </div>
                        </div>
                    @endcan
                    @can('Adm.emp.btn')
                        <!-- Pages links -->
                        <div x-data="{ isActive: false, open: false }">
                            <!-- active classes 'bg-neutral-100 dark:bg-neutral-600' -->
                            <a href="#" @click="$event.preventDefault(); open = !open"
                                class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                                :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                                aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                <span aria-hidden="true" class="bg-white rounded-full p-1">
                                   {{-- <i class="fa-solid fa-building ml-1 mr-1"></i> --}}
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 48 48"><path fill="#c5cae9" d="M42 42H6V9l18-7l18 7z"/><path fill="#9fa8da" d="M6 42h36v2H6z"/><path fill="#bf360c" d="M20 35h8v9h-8z"/><path fill="#1565c0" d="M31 27h6v5h-6zm-10 0h6v5h-6zm-10 0h6v5h-6zm20 8h6v5h-6zm-20 0h6v5h-6zm20-16h6v5h-6zm-10 0h6v5h-6zm-10 0h6v5h-6zm20-8h6v5h-6zm-10 0h6v5h-6zm-10 0h6v5h-6z"/></svg>
                                </span>
                                <span class="ml-2 text-sm"> Empresas </span>
                                <span aria-hidden="true" class="ml-auto">
                                    <!-- active class 'rotate-180' -->
                                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </a>
                            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">
                                @can('adm.crear.empresas')
                                    <a href="{{ route('Empresa.create') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Crear Empresa&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus ml-1 mr-1"></i>
                                    </a>
                                @endcan
                                @can('adm.ver.empresas')
                                    <a href="{{ route('Empresa.index') }}" role="menuitem"
                                        class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                        Ver Empresas&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-search ml-1 mr-1"></i>
                                    </a>
                                @endcan
                               
                            </div>
                        </div>
                    @endcan
                    <!-- Authentication links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        @can('Adm.cam.btn')
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true" class="bg-white rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 48 48"><g fill="#ff9800"><path d="m40.997 6.065l7 7l-7 6.999l-7-7z"/><path d="M36 8h10v10H36z"/></g><circle cx="41" cy="13" r="3" fill="#ffeb3b"/><path fill="#2e7d32" d="M16.5 18L0 42h33z"/><path fill="#4caf50" d="M33.6 24L19.2 42H48z"/></svg>
                                {{-- <i class="fa-solid fa-layer-group ml-1 mr-1"></i> --}}
                            </span>
                            <span class="ml-2 text-sm"> Campos </span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        @endcan
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <a href="{{ route('Campo.create') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Creación de Campos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        @can('Adm.cua.btn')
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true" class="bg-white rounded-full p-1">
                               {{-- <i class="fa-solid fa-hashtag ml-1 mr-1"></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 48 48"><path fill="#ff9500" d="M39 15c0-2.2-1.8-4-4-4h-6c-.7 0-1.1-.8-.7-1.4c.6-1 .9-2.2.6-3.5c-.4-2-1.9-3.6-3.8-4C21.8 1.4 19 3.9 19 7c0 1 .3 1.8.7 2.6c.4.6 0 1.4-.8 1.4h-6c-2.2 0-4 1.8-4 4v7c0 .7.8 1.1 1.4.7c1-.6 2.2-.9 3.5-.6c2 .4 3.6 1.9 4 3.8c.7 3.2-1.8 6.1-4.9 6.1c-1 0-1.8-.3-2.6-.7c-.5-.4-1.3 0-1.3.7v6c0 2.2 1.8 4 4 4h22c2.2 0 4-1.8 4-4z"/></svg>
                            </span>
                            <span class="ml-2 text-sm"> Cuarteles </span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        @endcan
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <a href="{{ route('Cuartel.create') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Crear Cuarteles&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i>
                            </a>
                            
                        </div>
                    </div>
                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        @can('Adm.cert.btn')
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true" class="bg-white rounded-full p-1">
                              {{-- <i class="fa-solid fa-medal ml-1 mr-1"></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 48 48"><g fill="#37474f"><path d="M9 20h30v13H9z"/><ellipse cx="24" cy="33" rx="15" ry="6"/></g><path fill="#78909c" d="M23.1 8.2L.6 18.1c-.8.4-.8 1.5 0 1.9l22.5 9.9c.6.2 1.2.2 1.8 0L47.4 20c.8-.4.8-1.5 0-1.9L24.9 8.2c-.6-.3-1.2-.3-1.8 0"/><g fill="#37474f"><path d="m43.2 20.4l-20-3.4c-.5-.1-1.1.3-1.2.8c-.1.5.3 1.1.8 1.2L42 22.2V37c0 .6.4 1 1 1s1-.4 1-1V21.4c0-.5-.4-.9-.8-1"/><circle cx="43" cy="37" r="2"/><path d="M46 40c0 1.7-3 6-3 6s-3-4.3-3-6s1.3-3 3-3s3 1.3 3 3"/></g></svg>
                            </span>
                            <span class="ml-2 text-sm"> Certificaciones</span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        @endcan
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <a href="{{ route('Certificacion.index') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Campos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-layer-group"></i>
                            </a>
                            <a href="{{ route('CertificacionCuartel.index') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Cuarteles&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-hashtag"></i>
                            </a>
                            
                        </div>
                    </div>
                    {{-- boton planificacion estimada --}}
                    <!-- Layouts links -->
                    {{-- @can('Adm.plan.est.btn') --}}
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        @can('Adm.est.prod.btn')
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true" class="bg-white rounded-full p-1">
                               {{-- <i class="fa-solid fa-paperclip"></i> --}}
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 48 48"><path fill="#90caf9" d="M39 16v7h-6v-7h-2v7h-6v-7h-2v7h-7v2h7v6h-7v2h7v6h-7v2h25V16zm0 9v6h-6v-6zm-14 0h6v6h-6zm0 8h6v6h-6zm8 6v-6h6v6z"/><path fill="#00bcd4" d="M40 8H8v32h8V16h24z"/><path fill="#0097a7" d="M7 7v34h10V17h24V7zm2 16v-6h6v6zm6 2v6H9v-6zm2-16h6v6h-6zm8 0h6v6h-6zM15 9v6H9V9zM9 39v-6h6v6zm30-24h-6V9h6z"/></svg>
                            </span>
                            <span class="ml-2 text-sm">Estimación Producción</span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        @endcan
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <a href="{{ route('Create.plan') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Planificar&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-paperclip"></i>
                            </a>
                            {{-- @endcan --}}
                            {{-- @can('prod.plan.estimada.ver') --}}
                            <a href="{{ route('PlanEstimado.index') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Ver Planificaciones&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-search"></i>
                            </a>
                          
                        </div>
                    </div>
                    {{-- fin boton --}}
                    {{-- @endcan --}}
                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        @can('Adm.reg.veh.btn')
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true" class="bg-white rounded-full p-1"> 
                               <!-- {{-- <i class="fa-solid fa-truck"></i> --}} -->
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 48 48"><path fill="#ffc107" d="M44 36H30V16c0-1.1.9-2 2-2h8c.6 0 1.2.3 1.6.8l6 7.7c.3.4.4.8.4 1.2V32c0 2.2-1.8 4-4 4"/><g fill="#9575cd"><path d="M8 36h22V13c0-2.2-1.8-4-4-4H4v23c0 2.2 1.8 4 4 4"/><path d="M0 9h10v2H0zm0 5h10v2H0zm0 5h10v2H0zm0 5h10v2H0z"/></g><path fill="#7e57c2" d="M4 11h16v2H4zm0 5h12v2H4zm0 5h8v2H4zm0 5h4v2H4z"/><g fill="#37474f"><circle cx="39" cy="36" r="5"/><circle cx="16" cy="36" r="5"/></g><g fill="#78909c"><circle cx="39" cy="36" r="2.5"/><circle cx="16" cy="36" r="2.5"/></g><path fill="#455a64" d="M44 26h-3.6c-.3 0-.5-.1-.7-.3l-1.4-1.4c-.2-.2-.4-.3-.7-.3H34c-.6 0-1-.4-1-1v-6c0-.6.4-1 1-1h5.5c.3 0 .6.1.8.4l4.5 5.4c.1.2.2.4.2.6V25c0 .6-.4 1-1 1"/></svg>
                            </span>
                            <span class="ml-2 text-sm"> Registro Vehículos</span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        @endcan
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <a href="{{ route('Vehiculos.index') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Registrar Vehículos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-truck"></i>
                            </a>
                            
                        </div>
                    </div>
                    {{-- boton planificacion estimada --}}
                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        @can('Adm.cont.bod.btn')
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true" class="bg-white rounded-full p-1"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><path fill="#cfd8dc" d="M5 19h38v19H5z"/><path fill="#b0bec5" d="M5 38h38v4H5z"/><path fill="#455a64" d="M27 24h12v18H27z"/><path fill="#e3f2fd" d="M9 24h14v11H9z"/><path fill="#1e88e5" d="M10 25h12v9H10z"/><path fill="#90a4ae" d="M36.5 33.5c-.3 0-.5.2-.5.5v2c0 .3.2.5.5.5s.5-.2.5-.5v-2c0-.3-.2-.5-.5-.5"/><g fill="#558b2f"><circle cx="24" cy="19" r="3"/><circle cx="36" cy="19" r="3"/><circle cx="12" cy="19" r="3"/></g><path fill="#7cb342" d="M40 6H8c-1.1 0-2 .9-2 2v3h36V8c0-1.1-.9-2-2-2m-19 5h6v8h-6zm16 0h-5l1 8h6zm-26 0h5l-1 8H9z"/><g fill="#ffa000"><circle cx="30" cy="19" r="3"/><path d="M45 19c0 1.7-1.3 3-3 3s-3-1.3-3-3s1.3-3 3-3z"/><circle cx="18" cy="19" r="3"/><path d="M3 19c0 1.7 1.3 3 3 3s3-1.3 3-3s-1.3-3-3-3z"/></g><path fill="#ffc107" d="M32 11h-5v8h6zm10 0h-5l2 8h6zm-26 0h5v8h-6zM6 11h5l-2 8H3z"/></svg>
                            </span>
                            <span class="ml-2 text-sm"> Control Bodega</span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        @endcan
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <a href="{{ route('bodega.ingreso') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Ingresos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-warehouse"></i>&nbsp;&nbsp;&nbsp;<i
                                    class="fa-solid fa-truck-ramp-box"></i>
                            </a>
                            <a href="{{ route('bodega.egreso') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Entregas&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-warehouse"></i>&nbsp;&nbsp;&nbsp;<i
                                    class="fa-solid fa-share-from-square"></i>
                            </a>
                            <a href="{{ route('Registros.bodega') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Registros Bodega&nbsp;&nbsp;&nbsp;<i
                                    class="fa-solid fa-warehouse"></i>&nbsp;&nbsp;&nbsp;<i
                                    class="fa-solid fa-search"></i>
                            </a>
                        </div>
                    </div>
                    {{-- boton tareas --}}
                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        @can('Adm.adm.tar.btn')
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true" class="bg-white rounded-full p-1"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><path fill="#3f51b5" d="m17.8 18.1l-7.4 7.3l-4.2-4.1L4 23.5l6.4 6.4l9.6-9.6zm0-13l-7.4 7.3l-4.2-4.1L4 10.5l6.4 6.4L20 7.3zm0 26l-7.4 7.3l-4.2-4.1L4 36.5l6.4 6.4l9.6-9.6z"/><path fill="#90caf9" d="M24 22h20v4H24zm0-13h20v4H24zm0 26h20v4H24z"/></svg>
                            </span>
                            <span class="ml-2 text-sm"> Administracion Tareas</span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        @endcan
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <a href="{{ route('Tarea.crear') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Crear&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i>
                            </a>
                            <a href="{{ route('bodega.egreso') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Listar&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-search"></i>
                            </a>
                            <a href="{{ route('Tareas.planificadas') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Tareas Planificadas&nbsp;&nbsp;&nbsp;<i class="fa-regular fa-calendar-days"></i>
                            </a>
                            <a href="{{ route('Tareas.finalizadas') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Tareas Realizadas&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-calendar-check"></i></i>
                            </a>
                        </div>
                    </div>
                    {{-- boton tareas --}}
                    {{-- boton Actividades --}}
                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        @can('Adm.fin.cost.btn')
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true" class="bg-white rounded-full p-1"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><path fill="#455a64" d="M36 4H26c0 1.1-.9 2-2 2s-2-.9-2-2H12C9.8 4 8 5.8 8 8v32c0 2.2 1.8 4 4 4h24c2.2 0 4-1.8 4-4V8c0-2.2-1.8-4-4-4"/><path fill="#fff" d="M36 41H12c-.6 0-1-.4-1-1V8c0-.6.4-1 1-1h24c.6 0 1 .4 1 1v32c0 .6-.4 1-1 1"/><g fill="#90a4ae"><path d="M26 4c0 1.1-.9 2-2 2s-2-.9-2-2h-7v4c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4z"/><path d="M24 0c-2.2 0-4 1.8-4 4s1.8 4 4 4s4-1.8 4-4s-1.8-4-4-4m0 6c-1.1 0-2-.9-2-2s.9-2 2-2s2 .9 2 2s-.9 2-2 2"/></g><path fill="#4caf50" d="m30.6 18.6l-9 9l-4.2-4.3l-2.5 2.5l6.8 6.7l11.4-11.4z"/></svg>
                            </span>
                            <span class="ml-2 text-sm">Actividades y Costos</span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        @endcan
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <a href="{{ route('Parametro.Actividad') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Parametros&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i>
                            </a>
                            <a href="{{ route('Registro.Actividad') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Crea/Asigna/Modifica&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-list"></i>
                            </a>
                            <a href="{{ route('Tareas.planificadas') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Resumen &nbsp;&nbsp;&nbsp;<i class="fa-regular fa-calendar-days"></i>
                            </a>
                            <!-- <a href="{{ route('Tareas.finalizadas') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Tareas Realizadas&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-calendar-check"></i></i>
                            </a> -->
                        </div>
                    </div>
                    {{-- boton actividades --}}
                    {{-- boton admin cuentas --}}
                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        @can('Adm.cuent.env.btn')
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true" class="bg-white rounded-full p-1"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><path fill="#4caf50" d="M40 14H8l3.8 28.3c.1 1 1 1.7 2 1.7h20.5c1 0 1.8-.7 2-1.7z"/><g fill="#81c784"><path d="M42 14H6v-3c0-2.2 1.8-4 4-4h28c2.2 0 4 1.8 4 4z"/><path d="M37.2 10H10.8l1.7-4.7c.3-.8 1-1.3 1.9-1.3h19.2c.8 0 1.6.5 1.9 1.3z"/></g><path fill="#e8f5e9" d="M28 28.5c1.2-1.1 2-2.7 2-4.5c0-3.3-2.7-6-6-6s-6 2.7-6 6c0 1.8.8 3.4 2 4.5c-1.2 1.1-2 2.7-2 4.5c0 3.3 2.7 6 6 6s6-2.7 6-6c0-1.8-.8-3.4-2-4.5M24 36c-1.7 0-3-1.3-3-3s1.3-3 3-3s3 1.3 3 3s-1.3 3-3 3m0-9c-1.7 0-3-1.3-3-3s1.3-3 3-3s3 1.3 3 3s-1.3 3-3 3"/></svg>
                            </span>
                            <span class="ml-2 text-sm">Cuentas Envases</span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        @endcan
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                            <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                            <a href="{{ route('CuentaCorriente.index') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Campos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-layer-group"></i>
                            </a>
                            <a href="{{ route('CuentaCorrienteExportadoras.index') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                Exportadoras&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-hashtag"></i>
                            </a>
                             
                      
                        </div>
                    </div>
                    {{-- boton cuentas--}}
                    {{-- boton env esp variedades --}}
                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        @can('Adm.conf.env.btn')
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true" class="bg-white rounded-full p-1"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><path fill="#607d8b" d="M39.6 27.2c.1-.7.2-1.4.2-2.2s-.1-1.5-.2-2.2l4.5-3.2c.4-.3.6-.9.3-1.4L40 10.8c-.3-.5-.8-.7-1.3-.4l-5 2.3c-1.2-.9-2.4-1.6-3.8-2.2L29.4 5c-.1-.5-.5-.9-1-.9h-8.6c-.5 0-1 .4-1 .9l-.5 5.5c-1.4.6-2.7 1.3-3.8 2.2l-5-2.3c-.5-.2-1.1 0-1.3.4l-4.3 7.4c-.3.5-.1 1.1.3 1.4l4.5 3.2c-.1.7-.2 1.4-.2 2.2s.1 1.5.2 2.2L4 30.4c-.4.3-.6.9-.3 1.4L8 39.2c.3.5.8.7 1.3.4l5-2.3c1.2.9 2.4 1.6 3.8 2.2l.5 5.5c.1.5.5.9 1 .9h8.6c.5 0 1-.4 1-.9l.5-5.5c1.4-.6 2.7-1.3 3.8-2.2l5 2.3c.5.2 1.1 0 1.3-.4l4.3-7.4c.3-.5.1-1.1-.3-1.4zM24 35c-5.5 0-10-4.5-10-10s4.5-10 10-10s10 4.5 10 10s-4.5 10-10 10"/><path fill="#455a64" d="M24 13c-6.6 0-12 5.4-12 12s5.4 12 12 12s12-5.4 12-12s-5.4-12-12-12m0 17c-2.8 0-5-2.2-5-5s2.2-5 5-5s5 2.2 5 5s-2.2 5-5 5"/></svg>
                            </span>
                            <span class="ml-2 text-sm">Conf. Envas.,Especie.,Varie.</span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        @endcan
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                            <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                            <a href="{{ route('Parametros.index') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                <i class="fa-solid fa-box"></i>&nbsp;&nbsp;&nbsp;<i
                                                class="fa-solid fa-apple-whole"></i>&nbsp;&nbsp;&nbsp;<i
                                                class="fa-solid fa-tag"></i>&nbsp;&nbsp;&nbsp;Envases,Especies,Variedades
                            </a>
                        </div>
                    </div>
                    {{-- boton cuentas--}}
                    {{-- boton cierres --}}
                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        @can('Adm.cier.temp.btn')
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true" class="bg-white rounded-full p-1"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><g fill="#1565c0"><path d="M46.1 24L33 35V13zM10 20h4v8h-4zm-6 0h4v8H4zm12 0h4v8h-4z"/><path d="M22 20h14v8H22z"/></g></svg>
                            </span>
                            <span class="ml-2 text-sm">Cierre Temp. Camp./Cuart.</span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        @endcan
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <a href="{{ route('CierreInicioTemporada.index') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                <i class="fa-solid fa-box-open"></i>&nbsp;&nbsp;&nbsp;Cierres de Temporada
                            </a>
                        </div>
                    </div>
                    <div class="text-center">
                         
                    {{-- boton cierres--}}
                                        <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        @can('Adm.bod.item.btn')
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true" class="bg-white rounded-full p-1"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><path fill="#90caf9" d="m36.9 13.8l-1.8-3.6L7.5 24l27.6 13.8l1.8-3.6L16.5 24z"/><path fill="#d81b60" d="M6 18h12v12H6z"/><path fill="#2196f3" d="M30 6h12v12H30zm0 24h12v12H30z"/></svg>
                            </span>
                            <span class="ml-2 text-sm">Bodega e Items</span>
                            <span aria-hidden="true" class="ml-auto">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        @endcan
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <a href="{{ route('BodegaItem.show') }}" role="menuitem"
                                class="block p-2 text-sm transition-colors duration-200 rounded-md text-gray-100 hover:text-orange-400">
                                <i class="fa-solid fa-box-open"></i>&nbsp;&nbsp;&nbsp;Crear Bodega/Items
                            </a>
                        </div>
                    </div>
                    <div class="text-center">
                         <button @click="openNotificationsPanel"
                            class="p-2 text-neutral-400 transition-colors duration-200 rounded-full bg-gray-900 hover:text-neutral-600 hover:bg-neutral-100 hover:text-light dark:hover:bg-neutral-700 dark:bg-dark focus:outline-none focus:bg-neutral-100 dark:focus:bg-neutral-700 focus:ring-neutral-800">
                            
                            @livewire('notificacion.campana')
                        </button>
                    {{-- boton cierres--}}
                    </div>
                </nav>
            </aside>
            <!-- Sidebars button -->
            <div class="fixed flex items-center space-x-4 top-5 right-10 lg:hidden">
                <button @click="isSidebarOpen = true; $nextTick(() => { $refs.sidebar.focus() })"
                    class="p-1 text-neutral-400 transition-colors duration-200 rounded-md bg-neutral-50 hover:text-neutral-600 hover:bg-neutral-100 hover:text-light dark:hover:bg-neutral-700 dark:bg-dark focus:outline-none focus:ring">
                    <span class="sr-only">Toggle main manu</span>
                    <span aria-hidden="true">
                        <svg x-show="!isSidebarOpen" class="w-8 h-8" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="isSidebarOpen" class="w-8 h-8" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </button>
            </div>
            {{-- fin --}}
            <!-- Main content -->
          <main class="flex-1 p-1 bg-white bg-cover bg-center h-screen" style="background-image: url('{{ asset('storage/fondo.png') }}');">
          
            <div class="bg-white bg-opacity-80 h-screen p-1">
            {{-- <main class="flex-1 p-1 bg-white bg-no-repeat bg-center bg-cover" style="background-image: url('{{ asset('storage/logoAgroges.png') }}');" > --}}
                {{ $slot }}
                <!-- component -->
                <!-- This is an example component -->
              
  
            
                <div class="text-right mt-2 mb-2 mr-2 fixed bottom-0 left-15 right-0">
                    <footer class="p-1 bg-gray-900 rounded-lg shadow md:flex md:items-center md:p-1 dark:bg-gray-800">
                        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a
                                href="https://flowbite.com" class="hover:underline" target="_blank">Comercial Caro
                                Hnos. SpA™</a>. All Rights Reserved.
                        </span>
                        <ul class="flex flex-wrap items-center mt-2 ml-2 sm:mt-0">
                            <li>
                                <a href="#"
                                    class="mr-4 text-sm text-white hover:underline md:mr-6 dark:text-white">Soporte</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="mr-4 text-sm text-white hover:underline md:mr-6 dark:text-white">Manual del
                                    Sistema
                                </a>
                            </li>
                            <li>
                                <div class="inline-block mr-4 text-sm text-gray-500 md:mr-6 dark:text-gray-400">
                                    @if (auth()->check())
                                        <label class="text-white">Usuario:</label>&nbsp;&nbsp;&nbsp;<label class="text-amber-300">{{ auth()->user()->name }}</label>
                                </div>
                                
                                <div class="inline-block mr-4 text-sm text-gray-500 md:mr-6 dark:text-gray-400">
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <a href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                                <div>
                                                    <span class="group relative">
                                                        <div class="absolute bottom-[calc(100%+0.5rem)] left-[50%] -translate-x-[50%] hidden group-hover:block w-auto">
                                                        <div class="bottom-full right-0 rounded bg-gray-900 border-2 px-4 py-1 text-xs text-white whitespace-nowrap">
                                                            Cerrar Sesión
                                                            <svg class="absolute left-0 top-full h-2 w-full text-black" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon class="fill-current" points="0,0 127.5,127.5 255,0" /></svg>
                                                        </div>
                                                        </div>
                                                        <span><i class="fa-solid fa-door-open text-green-500"></i></span>
                                                    </span>
                                                    </div>
                                                
                                                {{-- {{ __('Cerrar Sesión') }} --}}
                                            </a>
                                        </form>
                                </div>
                                <div class="inline block mt-1 mr-5">
                                    <span class="group relative">
                                        <div class="absolute bottom-[calc(100%+0.5rem)] left-[50%] -translate-x-[50%] hidden group-hover:block w-auto">
                                            <div class="bottom-full right-0 rounded bg-gray-900 border-2 px-4 py-1 text-xs text-white whitespace-nowrap">
                                                Gráficos
                                                <svg class="absolute left-0 top-full h-2 w-full text-black" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon class="fill-current" points="0,0 127.5,127.5 255,0" /></svg>
                                            </div>
                                        </div>
                                        <span class="mt-1"> <a href="{{ route('Ver.graficos') }}">
                                        <i class="fa-solid fa-chart-simple text-white mt-1"></i>
                                    </a></span>
                                    </span>
                                </div>
                                <!-- component -->
                            </li>
                            {{-- Código para mostrar cuando el usuario no está autenticado --}}
                            @else
                                <label class="text-white">Usuario:</label>&nbsp;&nbsp;&nbsp; no autenticado, <a href="/">Iniciar Sesión</a>
                            @endif
                        </ul>
                    </footer>
                </div>
                </div>
            </main>
            <!-- Panels -->
            <!-- Settings Panel -->
            <!-- Backdrop -->
            <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                x-show="isSettingsPanelOpen" @click="isSettingsPanelOpen = false"
                class="fixed inset-0 z-10 bg-neutral-800" style="opacity: 0.5" aria-hidden="true"></div>
            <!-- Panel -->
            <section x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                x-ref="settingsPanel" tabindex="-1" x-show="isSettingsPanelOpen"
                @keydown.escape="isSettingsPanelOpen = false"
                class="fixed inset-y-0 right-0 z-20 w-full max-w-xs bg-white shadow-xl  dark:text-light sm:max-w-md focus:outline-none"
                aria-labelledby="settinsPanelLabel">
                <div class="absolute left-0 p-2 transform -translate-x-full">
                    <!-- Close button -->
                    <button @click="isSettingsPanelOpen = false"
                        class="p-2 text-white rounded-md focus:outline-none focus:ring">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Panel content -->
                <div class="flex flex-col h-screen">
                    <!-- Panel header -->
                    <div
                        class="flex flex-col items-center justify-center flex-shrink-0 px-4 py-8 space-y-4 border-b dark:border-neutral-700">
                        <span aria-hidden="true" class="text-gray-500 dark:text-neutral-600">
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </span>
                        <h2 id="settinsPanelLabel" class="text-xl font-medium text-gray-900">
                            Configuración del Sistema</h2>
                    </div>
                    <!-- Content -->
                    <div class="flex-1 overflow-hidden hover:overflow-y-auto">
                        <!-- Theme -->
                        <div class="p-4 space-y-4 md:p-8">
                            <h6 class="mb-5 text-center text-lg font-medium text-gray-400">Menu
                                Administrador</h6>
                            <div class="flex flex-col">
                             
                                {{-- boton nuevo --}}
                                <!-- Layouts links -->
                                <div x-data="{ isActive: false, open: false }">
                                    <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                                    <a href="#" @click="$event.preventDefault(); open = !open"
                                        class="mb-2 flex items-center border-2 p-2 text-gray-900 transition-colors rounded-md w-full hover:bg-neutral-600 dark:hover:bg-neutral-900 hover:text-white"
                                        :class="{ 'bg-neutral-100 dark:bg-neutral-500': isActive || open }"
                                        role="button" aria-haspopup="true"
                                        :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                        <span aria-hidden="true">
                                           <i class="fa-solid fa-box ml-1 mr-1"></i>
                                        </span>
                                        <span class="ml-2 text-sm"> Cuentas Corrientes Envases</span>
                                        <span aria-hidden="true" class="ml-auto">
                                            <!-- active class 'rotate-180' -->
                                            <svg class="ml-5 w-4 h-4 transition-transform transform"
                                                :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div x-show="open" class="mt-2 space-y-2 px-7" role="menu"
                                        aria-label="Authentication">
                                        <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                        <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                        <a href="{{ route('CuentaCorriente.index') }}" role="menuitem"
                                            class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 hover:text-light hover:text-white hover:bg-gray-500">
                                            <i class="fa-solid fa-layer-group"></i>&nbsp;&nbsp;&nbsp;Campos
                                        </a>
                                        <a href="{{ route('CuentaCorrienteExportadoras.index') }}" role="menuitem"
                                            class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 hover:text-light hover:text-white hover:bg-gray-500">
                                            <i class="fa-solid fa-hashtag"></i>&nbsp;&nbsp;&nbsp;Exportadoras
                                        </a>
                                       
                                    </div>
                                </div>
                                {{-- fin boton nuevo --}}
                                {{-- boton nuevo --}}
                                <!-- Layouts links -->
                                <div x-data="{ isActive: false, open: false }">
                                    <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                                    <a href="#" @click="$event.preventDefault(); open = !open"
                                        class="flex items-center border-2 p-2 text-gray-900 transition-colors rounded-md w-full hover:bg-neutral-600 dark:hover:bg-neutral-900 hover:text-white"
                                        :class="{ 'bg-neutral-100 dark:bg-neutral-500': isActive || open }"
                                        role="button" aria-haspopup="true"
                                        :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                        <span aria-hidden="true">
                                           <i class="fa-solid fa-gear ml-1 mr-1"></i>
                                        </span>
                                        <span class="ml-2 text-sm"> configuración Envases, Especies, Variedades</span>
                                        <span aria-hidden="true" class="ml-auto">
                                            <!-- active class 'rotate-180' -->
                                            <svg class="ml-5 w-4 h-4 transition-transform transform"
                                                :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div x-show="open" class="mt-2 space-y-2 px-7" role="menu"
                                        aria-label="Authentication">
                                        <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                        <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                        <a href="{{ route('Parametros.index') }}" role="menuitem"
                                            class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 hover:text-light hover:text-white hover:bg-gray-500">
                                            <i class="fa-solid fa-box"></i>&nbsp;&nbsp;&nbsp;<i
                                                class="fa-solid fa-apple-whole"></i>&nbsp;&nbsp;&nbsp;<i
                                                class="fa-solid fa-tag"></i>&nbsp;&nbsp;&nbsp;Envases,Especies,Variedades
                                        </a>
                                       
                                    </div>
                                </div>
                                {{-- fin boton nuevo --}}
                                {{-- boton nuevo --}}
                                <!-- Layouts links -->
                                <div x-data="{ isActive: false, open: false }">
                                    <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                                    <a href="#" @click="$event.preventDefault(); open = !open"
                                        class="mb-2 flex items-center border-2 p-2 text-gray-900 transition-colors rounded-md w-full hover:bg-neutral-600 dark:hover:bg-neutral-900 hover:text-white"
                                        :class="{ 'bg-neutral-100 dark:bg-neutral-500': isActive || open }"
                                        role="button" aria-haspopup="true"
                                        :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                        <span aria-hidden="true">
                                           <i class="fa-solid fa-arrow-down-up-across-line"></i> Cierres de Temporada Campos/cuartel
                                        </span>
                                        <span class="ml-2 text-sm">Cierres de Temporada Campos/cuartel</span>
                                        <span aria-hidden="true" class="ml-auto">
                                            <!-- active class 'rotate-180' -->
                                            <svg class="ml-5 w-4 h-4 transition-transform transform"
                                                :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div x-show="open" class="mt-2 space-y-2 px-7" role="menu"
                                        aria-label="Authentication">
                                        <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                        <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                        <a href="{{ route('CierreInicioTemporada.index') }}" role="menuitem"
                                            class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 hover:text-light hover:text-white hover:bg-gray-500">
                                            <i class="fa-solid fa-box-open"></i>&nbsp;&nbsp;&nbsp;Cierres de Temporada
                                        </a>
                                        
                                    </div>
                                </div>
                                {{-- fin boton nuevo --}}
                                <!-- Layouts links -->
                                <div x-data="{ isActive: false, open: false }">
                                    <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                                    <a href="#" @click="$event.preventDefault(); open = !open"
                                        class="mb-2 flex items-center border-2 p-2 text-gray-900 transition-colors rounded-md w-full hover:bg-neutral-600 dark:hover:bg-neutral-900 hover:text-white"
                                        :class="{ 'bg-neutral-100 dark:bg-neutral-500': isActive || open }"
                                        role="button" aria-haspopup="true"
                                        :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                        <span aria-hidden="true">
                                           <i class="fa-solid fa-warehouse"></i>
                                        </span>
                                        <span class="ml-2 text-sm">Administracion Bodega e Items</span>
                                        <span aria-hidden="true" class="ml-auto">
                                            <!-- active class 'rotate-180' -->
                                            <svg class="ml-5 w-4 h-4 transition-transform transform"
                                                :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div x-show="open" class="mt-2 space-y-2 px-7" role="menu"
                                        aria-label="Authentication">
                                        <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                        <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                        <a href="{{ route('BodegaItem.show') }}" role="menuitem"
                                            class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 hover:text-light hover:text-white hover:bg-gray-500">
                                            <i class="fa-solid fa-warehouse"></i>&nbsp;&nbsp;&nbsp;Bodega e Items..
                                        </a>
                                      
                                    </div>
                                </div>
                                {{-- fin boton nuevo --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Notification panel -->
            <!-- Backdrop -->
            <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                x-show="isNotificationsPanelOpen" @click="isNotificationsPanelOpen = false"
                class="fixed inset-0 z-10 bg-neutral-800" style="opacity: 0.5" aria-hidden="true"></div>
            <!-- Panel -->
            <section x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                x-ref="notificationsPanel" x-show="isNotificationsPanelOpen"
                @keydown.escape="isNotificationsPanelOpen = false" tabindex="-1"
                aria-labelledby="notificationPanelLabel"
                class="fixed inset-y-0 z-20 w-full max-w-xs bg-white dark:text-light sm:max-w-md focus:outline-none">
                <div class="absolute right-0 p-2 transform translate-x-full">
                    <!-- Close button -->
                    <button @click="isNotificationsPanelOpen = false"
                        class="p-2 text-white rounded-md focus:outline-none focus:ring">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col h-screen" x-data="{ activeTabe: 'action' }">
                    <!-- Panel header -->
                    <div class="flex-shrink-0">
                        <div
                            class="flex items-center justify-between px-4 pt-4 border-b text-neutral-800 dark:border-neutral-800">
                            <h2 id="notificationPanelLabel" class="pb-4 font-semibold text">Notificationes</h2>
                            <div class="space-x-2 p-1">
                                <button @click.prevent="activeTabe = 'action'"
                                    class="px-px pb-4 transition-all duration-200 transform translate-y-px border-b focus:outline-none"
                                    :class="{
                                        'border-neutral-700 dark:border-neutral-600': activeTabe ==
                                            'action',
                                        'border-transparent': activeTabe != 'action'
                                    }">
                                    Notificaciones Pendientes
                                </button>
                               
                            </div>
                        </div>
                    </div>
                    <!-- Panel content (tabs) -->
                    <div class="flex-1 pt-4 overflow-y-hidden hover:overflow-y-auto">
                        <!-- Action tab -->
                        <div class="space-y-4" x-show.transition.in="activeTabe == 'action'">
                            <p class="px-4">
                                @livewire('notificacion.notificaciones')
                            </p>
                        </div>
                        <!-- User tab -->
                        <div class="space-y-4" x-show.transition.in="activeTabe == 'user'">
                            <p class="px-4">Debe Realizar cosecha !!</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Search panel -->
            <!-- Backdrop -->
            <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-show="isSearchPanelOpen"
                @click="isSearchPanelOpen = false" class="fixed inset-0 z-10 bg-neutral-800" style="opacity: 0.5"
                aria-hidden="ture"></div>
            <!-- Panel -->
            <section x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                x-show="isSearchPanelOpen" @keydown.escape="isSearchPanelOpen = false"
                class="fixed inset-y-0 z-20 w-full max-w-xs bg-white shadow-xl  dark:text-light sm:max-w-md focus:outline-none">
                <div class="absolute right-0 p-2 transform translate-x-full">
                    <!-- Close button -->
                    <button @click="isSearchPanelOpen = false"
                        class="p-2 text-white rounded-md focus:outline-none focus:ring">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <h2 class="sr-only">Search panel</h2>
                <!-- Panel content -->
                <div class="flex flex-col h-screen">
                    <!-- Panel header (Search input) -->
                    <div
                        class="relative flex-shrink-0 px-4 py-8 text-gray-400 border-b dark:border-neutral-800 dark:focus-within:text-light focus-within:text-gray-700">
                        <span class="absolute inset-y-0 inline-flex items-center px-4">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input x-ref="searchInput" type="text"
                            class="w-full py-2 pl-10 pr-4 border rounded-full dark:bg-dark dark:border-transparent dark:text-light focus:outline-none focus:ring"
                            placeholder="Search..." />
                    </div>
                    <!-- Panel content (Search result) -->
                    <div class="flex-1 px-4 pb-4 space-y-4 overflow-y-hidden h hover:overflow-y-auto">
                        <h3 class="py-2 text-sm font-semibold text-gray-600 dark:text-light">History</h3>
                        <p class="px=4">Search resault</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        const setup = () => {
            const getTheme = () => {
                if (window.localStorage.getItem('dark')) {
                    return JSON.parse(window.localStorage.getItem('dark'))
                }
                return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
            }
            const setTheme = (value) => {
                window.localStorage.setItem('dark', value)
            }
            return {
                loading: true,
                isDark: getTheme(),
                toggleTheme() {
                    this.isDark = !this.isDark
                    setTheme(this.isDark)
                },
                setLightTheme() {
                    this.isDark = false
                    setTheme(this.isDark)
                },
                setDarkTheme() {
                    this.isDark = true
                    setTheme(this.isDark)
                },
                watchScreen() {
                    if (window.innerWidth <= 1024) {
                        this.isSidebarOpen = false
                    } else if (window.innerWidth >= 1024) {
                        this.isSidebarOpen = true
                    }
                },
                isSidebarOpen: window.innerWidth >= 1024 ? true : false,
                toggleSidbarMenu() {
                    this.isSidebarOpen = !this.isSidebarOpen
                },
                isNotificationsPanelOpen: false,
                openNotificationsPanel() {
                    this.isNotificationsPanelOpen = true
                    this.$nextTick(() => {
                        this.$refs.notificationsPanel.focus()
                    })
                },
                isSettingsPanelOpen: false,
                openSettingsPanel() {
                    this.isSettingsPanelOpen = true
                    this.$nextTick(() => {
                        this.$refs.settingsPanel.focus()
                    })
                },
                isSearchPanelOpen: false,
                openSearchPanel() {
                    this.isSearchPanelOpen = true
                    this.$nextTick(() => {
                        this.$refs.searchInput.focus()
                    })
                },
            }
        }
    </script>
    {{-- script de gauge --}}
        <script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/radar-chart/
var chart = root.container.children.push(am5radar.RadarChart.new(root, {
  panX: false,
  panY: false,
  startAngle: 160,
  endAngle: 380
}));


// Create axis and its renderer
// https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Axes
var axisRenderer = am5radar.AxisRendererCircular.new(root, {
  innerRadius: -40
});

axisRenderer.grid.template.setAll({
  stroke: root.interfaceColors.get("background"),
  visible: true,
  strokeOpacity: 0.8
});

var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
  maxDeviation: 0,
  min: -40,
  max: 100,
  strictMinMax: true,
  renderer: axisRenderer
}));


// Add clock hand
// https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Clock_hands
var axisDataItem = xAxis.makeDataItem({});

var clockHand = am5radar.ClockHand.new(root, {
  pinRadius: am5.percent(20),
  radius: am5.percent(100),
  bottomWidth: 40
})

var bullet = axisDataItem.set("bullet", am5xy.AxisBullet.new(root, {
  sprite: clockHand
}));

xAxis.createAxisRange(axisDataItem);

var label = chart.radarContainer.children.push(am5.Label.new(root, {
  fill: am5.color(0xffffff),
  centerX: am5.percent(50),
  textAlign: "center",
  centerY: am5.percent(50),
  fontSize: "3em"
}));

axisDataItem.set("value", 45);
bullet.get("sprite").on("rotation", function () {
  var value = axisDataItem.get("value");
  var text = Math.round(axisDataItem.get("value")).toString();
  var fill = am5.color(0x000000);
  xAxis.axisRanges.each(function (axisRange) {
    if (value >= axisRange.get("value") && value <= axisRange.get("endValue")) {
      fill = axisRange.get("axisFill").get("fill");
    }
  })

  label.set("text", Math.round(value).toString());

  clockHand.pin.animate({ key: "fill", to: fill, duration: 500, easing: am5.ease.out(am5.ease.cubic) })
  clockHand.hand.animate({ key: "fill", to: fill, duration: 500, easing: am5.ease.out(am5.ease.cubic) })
});

// setInterval(function () {
//   axisDataItem.animate({
//     key: "value",
//     to: Math.round(Math.random() * 140 - 40),
//     duration: 500,
//     easing: am5.ease.out(am5.ease.cubic)
//   });
// }, 2000)

chart.bulletsContainer.set("mask", undefined);


// Create axis ranges bands
// https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Bands
var bandsData = [{
  title: "Unsustainable",
  color: "#ee1f25",
  lowScore: -40,
  highScore: -20
}, {
  title: "Volatile",
  color: "#f04922",
  lowScore: -20,
  highScore: 0
}, {
  title: "Foundational",
  color: "#fdae19",
  lowScore: 0,
  highScore: 20
}, {
  title: "Developing",
  color: "#f3eb0c",
  lowScore: 20,
  highScore: 40
}, {
  title: "Maturing",
  color: "#b0d136",
  lowScore: 40,
  highScore: 60
}, {
  title: "Sustainable",
  color: "#54b947",
  lowScore: 60,
  highScore: 80
}, {
  title: "High Performing",
  color: "#0f9747",
  lowScore: 80,
  highScore: 100
}];

am5.array.each(bandsData, function (data) {
  var axisRange = xAxis.createAxisRange(xAxis.makeDataItem({}));

  axisRange.setAll({
    value: data.lowScore,
    endValue: data.highScore
  });

  axisRange.get("axisFill").setAll({
    visible: true,
    fill: am5.color(data.color),
    fillOpacity: 0.8
  });

  axisRange.get("label").setAll({
    text: data.title,
    inside: true,
    radius: 15,
    fontSize: "0.9em",
    fill: root.interfaceColors.get("background")
  });
});


// Make stuff animate on load
chart.appear(1000, 100);

}); // end am5.ready()
</script>
    {{-- fin --}}
</x-app-layout>
