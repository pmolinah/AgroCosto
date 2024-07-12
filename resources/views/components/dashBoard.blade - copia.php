<x-app-layout>
    {{-- nuevo sidebar --}}
    <!-- component -->
    <style>
        /* This example part of kwd-dashboard see https://kamona-wd.github.io/kwd-dashboard/ */
        /* So here we will write some classes to simulate dark mode and some of tailwind css config in our project */
        :root {
            --light: #edf2f9;
            --dark: #152e4d;
            --darker: #12263f;
        }

        /*    .dark .dark\:text-light {
            color: var(--light);
        }

        .dark .dark\:bg-dark {
            background-color: var(--dark);
        }

        .dark .dark\:bg-darker {
            background-color: var(--darker);
        }

        .dark .dark\:text-gray-300 {
            color: #d1d5db;
        }

        .dark .dark\:text-neutral-500 {
            color: #6366f1;
        }

        .dark .dark\:text-neutral-100 {
            color: #e0e7ff;
        }

        .dark .dark\:hover\:text-light:hover {
            color: var(--light);
        }

        .dark .dark\:border-neutral-800 {
            border-color: #3730a3;
        }

        .dark .dark\:border-neutral-700 {
            border-color: #4338ca;
        }

        .dark .dark\:bg-neutral-600 {
            background-color: #4f46e5;
        }

        .dark .dark\:hover\:bg-neutral-2600:hover {
            background-color: #4f46e5;
        }

        .dark .dark\:border-neutral-500 {
            border-color: #6366f1;
        } */

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
                class="fixed inset-y-0 z-10 flex flex-shrink-0 overflow-hidden bg-white border-r lg:static dark:border-neutral-800 dark:bg-darker focus:outline-none">
                <!-- Mini column -->
                <div class="flex flex-col flex-shrink-0 h-full px-2 py-4 border-r dark:border-neutral-800 bg-gray-300">
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
                            class="p-2 text-neutral-400 transition-colors duration-200 rounded-full bg-neutral-50 hover:text-neutral-600 hover:bg-neutral-100 dark:hover:text-light dark:hover:bg-neutral-700 dark:bg-dark focus:outline-none focus:bg-neutral-100 dark:focus:bg-neutral-700 focus:ring-neutral-800">
                            {{-- <span class="sr-only">Open Notification panel</span>
                            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg> --}}
                            @livewire('notificacion.campana')
                        </button>

                        <!-- Search button -->
                        {{-- <button
                @click="openSearchPanel"
                class="p-2 text-neutral-400 transition-colors duration-200 rounded-full bg-neutral-50 hover:text-neutral-600 hover:bg-neutral-100 dark:hover:text-light dark:hover:bg-neutral-700 dark:bg-dark focus:outline-none focus:bg-neutral-100 dark:focus:bg-neutral-700 focus:ring-neutral-800"
              >
                <span class="sr-only">Open search panel</span>
                <svg
                  class="w-7 h-7"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  aria-hidden="true"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                  />
                </svg>
              </button> --}}

                        <!-- Settings button -->
                        <button @click="openSettingsPanel"
                            class=" p-2 text-neutral-400 transition-colors duration-200 rounded-full bg-neutral-50 hover:text-neutral-600 hover:bg-neutral-100 dark:hover:text-light dark:hover:bg-neutral-700 dark:bg-dark focus:outline-none focus:bg-neutral-100 dark:focus:bg-neutral-700 focus:ring-neutral-800">
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
                                class="absolute w-56 py-1 mb-4 bg-white rounded-md shadow-lg min-w-max left-5 bottom-full ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none"
                                tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu">
                                <a href="{{ route('profile.show') }}" role="menuitem"
                                    class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-neutral-600">
                                    @if (auth()->check())
                                        {{ Auth::user()->name }}
                                    @else
                                        {{-- Código para mostrar cuando el usuario no está autenticado --}}
                                        Usuario no autenticado
                                    @endif

                                    {{-- {{ Auth::user()->name }} --}}
                                </a>
                                {{-- <a
                    href="#"
                    role="menuitem"
                    class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-neutral-600"
                  >
                    Settings
                  </a> --}}
                                <a href="#" role="menuitem"
                                    class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-neutral-600">
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
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
                    class="bg-gray-400 flex-1 w-64 px-1 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto ">
                    <!-- Dashboards links -->
                    @can('prod.menu.btn')
                        <div x-data="{ isActive: false, open: false }">
                            <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                            <a href="#" @click="$event.preventDefault(); open = !open"
                                class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                                :class="{ 'bg-neutral-600 dark:bg-neutral-600': isActive || open }" role="button"
                                aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                <span aria-hidden="true">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm"> Producción </span>
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
                                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                @can('prod.crear.despacho')
                                    <a href="{{ route('Guias.index') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Despacho&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                @endcan
                                @can('prod.crear.recepcion')
                                    <a href="{{ route('Guias.recepcion') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Recepción&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-arrow-left"></i>
                                    </a>
                                @endcan
                                @can('prod.crear.devtras')
                                    <a href="{{ route('Devolucion.Envases') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Traspaso/Devolucion&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-arrows-turn-to-dots"></i>
                                    </a>
                                @endcan
                                @can('prod.guias.finalizadas')
                                    <a href="{{ route('Guias.show') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Guías Emitidas&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-clipboard"></i>
                                    </a>
                                @endcan
                                <hr>
                                @can('adm.crear.planificacion')
                                    <a href="{{ route('Cosecha.planificacionCreate') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Planificaciones&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-calendar-days"></i>
                                    </a>
                                @endcan
                                @can('adm.ver.planificacion')
                                    <a href="{{ route('Cosecha.planificacion') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Ver Planificaciones&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-search"></i>
                                    </a>
                                @endcan
                                @can('adm.crear.plantacion')
                                    <a href="{{ route('Plantacion.create') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Plantaciones&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-tree"></i>
                                    </a>
                                @endcan
                                @can('adm.ver.plantacion')
                                    <a href="{{ route('Plantacion.index') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Ver Plantaciones&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-search"></i>
                                    </a>
                                @endcan
                                @can('adm.crear.cosechar')
                                    <hr>
                                    <a href="{{ route('Cosecha.index') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Ver Cosechas&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-apple-whole"></i>
                                    </a>
                                @endcan
                                @can('adm.ver.cosechas.finalizadas')
                                    <a href="{{ route('CosechasCerradas.index') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
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
                                :class="{ 'bg-neutral-100 dark:bg-neutral-600': isActive || open }" role="button"
                                aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                <span aria-hidden="true">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
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
                                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                @can('adm.crear.usuarios')
                                    <a href="{{ route('User.create') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Crear Usuarios&nbsp;&nbsp;&nbsp;<i class="fa-regular fa-plus"></i>
                                    </a>
                                @endcan
                                @can('adm.ver.usuarios')
                                    <a href="{{ route('User.index') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Ver Usuarios&nbsp;&nbsp;&nbsp;<i class="fa-regular fa-users"></i>
                                    </a>
                                @endcan
                                @can('adm.crear.roles')
                                    <a href="{{ route('Rol.create') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Roles y Permisos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i>

                                    </a>
                                @endcan
                                @can('adm.ver.roles')
                                    <a href="{{ route('RolePermisos.index') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Ver Roles/Permisos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-table-list"></i>
                                    </a>
                                @endcan
                                {{-- <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                  Cards
                </a>
                <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                  Dropdowns
                </a>
                <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                  Forms
                </a>
                <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                  Lists
                </a>
                <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                  Modals
                </a> --}}
                            </div>
                        </div>
                    @endcan
                    @can('Adm.emp.btn')
                        <!-- Pages links -->
                        <div x-data="{ isActive: false, open: false }">
                            <!-- active classes 'bg-neutral-100 dark:bg-neutral-600' -->
                            <a href="#" @click="$event.preventDefault(); open = !open"
                                class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                                :class="{ 'bg-neutral-100 dark:bg-neutral-600': isActive || open }" role="button"
                                aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                <span aria-hidden="true">
                                    {{-- <svg
                    class="w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                    />
                  </svg> --}}<i class="fa-solid fa-building ml-1 mr-1"></i>

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
                                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                @can('adm.crear.empresas')
                                    <a href="{{ route('Empresa.create') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Crear Empresa&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus ml-1 mr-1"></i>
                                    </a>
                                @endcan
                                @can('adm.ver.empresas')
                                    <a href="{{ route('Empresa.index') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                        Ver Empresas&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-search ml-1 mr-1"></i>
                                    </a>
                                @endcan
                                {{-- <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                  Pricing
                </a>
                <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                  Kanban
                </a>
                <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                  Feed
                </a> --}}
                            </div>
                        </div>
                    @endcan
                    <!-- Authentication links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 dark:bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true">
                                {{-- <svg
                    class="w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg> --}}
                                <i class="fa-solid fa-layer-group ml-1 mr-1"></i>
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
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                            <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                            <a href="{{ route('Campo.create') }}" role="menuitem"
                                class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                Creación de Campos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i>

                            </a>
                            {{-- <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white"
                >
                  Ver Campos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-search"></i>
                </a>
                <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                >
                  Password Reset
                </a> --}}
                        </div>
                    </div>

                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 dark:bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true">
                                {{-- <svg
                    class="w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg> --}}<i class="fa-solid fa-hashtag ml-1 mr-1"></i>
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
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                            <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                            <a href="{{ route('Cuartel.create') }}" role="menuitem"
                                class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                Crear Cuarteles&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i>
                            </a>
                            {{-- <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                >
                  Mini + One Columns Sidebar
                </a> --}}
                        </div>
                    </div>
                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 dark:bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true">
                                {{-- <svg
                    class="w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg> --}}<i class="fa-solid fa-medal ml-1 mr-1"></i>
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
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                            <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                            <a href="{{ route('Certificacion.index') }}" role="menuitem"
                                class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                Campos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-layer-group"></i>
                            </a>
                            <a href="{{ route('CertificacionCuartel.index') }}" role="menuitem"
                                class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                Cuarteles&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-hashtag"></i>
                            </a>
                            {{-- <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                >
                  Mini + One Columns Sidebar
                </a> --}}
                        </div>
                    </div>
                    {{-- boton planificacion estimada --}}
                    <!-- Layouts links -->
                    {{-- @can('Adm.plan.est.btn') --}}
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 dark:bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true">
                                {{-- <svg
                    class="w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg> --}}<i class="fa-solid fa-paperclip"></i>
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
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                            <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                            {{-- @can('prod.plan.estimada.crear') --}}
                            <a href="{{ route('Create.plan') }}" role="menuitem"
                                class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                Planificar&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-paperclip"></i>
                            </a>
                            {{-- @endcan --}}
                            {{-- @can('prod.plan.estimada.ver') --}}
                            <a href="{{ route('PlanEstimado.index') }}" role="menuitem"
                                class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                Ver Planificaciones&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-search"></i>
                            </a>
                            {{-- @endcan --}}
                            {{-- <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                >
                  Mini + One Columns Sidebar
                </a> --}}
                        </div>
                    </div>
                    {{-- fin boton --}}
                    {{-- @endcan --}}
                    <!-- Layouts links -->
                    <div x-data="{ isActive: false, open: false }">
                        <!-- active & hover classes 'bg-neutral-100 dark:bg-neutral-600' -->
                        <a href="#" @click="$event.preventDefault(); open = !open"
                            class="flex items-center p-2 text-gray-100 transition-colors rounded-md dark:text-white hover:bg-neutral-600 dark:hover:bg-neutral-900"
                            :class="{ 'bg-neutral-100 dark:bg-neutral-600': isActive || open }" role="button"
                            aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true">
                                {{-- <svg
                    class="w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg> --}}<i class="fa-solid fa-truck"></i>
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
                        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                            <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                            <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                            <a href="{{ route('Vehiculos.index') }}" role="menuitem"
                                class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                Registrar Vehículos&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-truck"></i>
                            </a>
                            {{-- <a href="{{ route('CertificacionCuartel.index') }}" role="menuitem"
                                class="block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white">
                                Cuarteles&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-hashtag"></i>
                            </a> --}}
                            {{-- <a
                  href="#"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                >
                  Mini + One Columns Sidebar
                </a> --}}
                        </div>
                    </div>
                    {{-- boton planificacion estimada --}}
                </nav>
            </aside>

            <!-- Sidebars button -->
            <div class="fixed flex items-center space-x-4 top-5 right-10 lg:hidden">
                <button @click="isSidebarOpen = true; $nextTick(() => { $refs.sidebar.focus() })"
                    class="p-1 text-neutral-400 transition-colors duration-200 rounded-md bg-neutral-50 hover:text-neutral-600 hover:bg-neutral-100 dark:hover:text-light dark:hover:bg-neutral-700 dark:bg-dark focus:outline-none focus:ring">
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

            <!-- Main content -->
            <main class="flex-1 p-5 bg-neutral-300">

                {{ $slot }}
                {{-- <div
            class="flex flex-col items-center justify-center flex-1 h-full min-h-screen p-4 overflow-x-hidden overflow-y-auto"
          >
            <h1 class="mb-4 text-2xl font-semibold text-center md:text-3xl">Mini + One Columns Sidebar</h1>
            <div class="mb-4">
              <div class="relative flex p-1 space-x-1 bg-white shadow-md w-80 h-72 dark:bg-darker">
                <div class="w-6 h-full bg-gray-200 dark:bg-dark"></div>
                <div class="w-16 h-full bg-gray-200 dark:bg-dark"></div>
                <div class="flex-1 h-full bg-gray-100 dark:bg-dark"></div>
              </div>
            </div>
            <div>
              <p class="text-center">See full project</p>
              <a
                href="https://kamona-wd.github.io/kwd-dashboard/"
                target="_blank"
                class="text-base text-blue-600 hover:underline"
                >Live</a
              >
              <a
                href="https://github.com/Kamona-WD/kwd-dashboard"
                target="_blank"
                class="ml-4 text-base text-blue-600 hover:underline"
                >Github repo</a
              >
            </div>
          </div> --}}
                <!-- component -->
                <!-- This is an example component -->
                <div class="max-w-2xl text-right mt-2 mb-2 mr-2 fixed bottom-0 right-0">
                    <footer
                        class="p-1 bg-white rounded-lg shadow md:flex md:items-center md:justify-between md:p-3 dark:bg-gray-800">
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
                            {{-- <li>
				<a href="#" class="mr-4 text-sm text-gray-500 hover:underline md:mr-6 dark:text-gray-400">Licensing</a>
			</li> --}}
                            {{-- <li>
				<a href="#" class="text-sm text-gray-500 hover:underline dark:text-gray-400">Contact</a>
			</li> --}}
                        </ul>
                    </footer>
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
                class="fixed inset-y-0 right-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none"
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
                        <h2 id="settinsPanelLabel" class="text-xl font-medium text-gray-500 dark:text-light">
                            Configuración del Sistema</h2>
                    </div>
                    <!-- Content -->
                    <div class="flex-1 overflow-hidden hover:overflow-y-auto">
                        <!-- Theme -->
                        <div class="p-4 space-y-4 md:p-8">
                            <h6 class="mb-5 text-center text-lg font-medium text-gray-400 dark:text-light">Menu
                                Administrador</h6>
                            <div class="flex flex-col">
                                <!-- Light button -->
                                {{-- <button
                    @click="setLightTheme"
                    class="flex items-center justify-center px-4 py-2 space-x-4 transition-colors border rounded-md hover:text-gray-900 hover:border-gray-900 dark:border-neutral-600 dark:hover:text-neutral-100 dark:hover:border-neutral-500 focus:outline-none focus:ring focus:ring-neutral-400 dark:focus:ring-neutral-700"
                    :class="{ 'border-gray-900 text-gray-900 dark:border-neutral-500 dark:text-neutral-100': !isDark, 'text-gray-500 dark:text-neutral-500': isDark }"
                  >
                    <span>
                      <svg
                        class="w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                        />
                      </svg>
                    </span>
                    <span>Light</span>
                  </button> --}}

                                <!-- Dark button -->
                                {{-- <button
                    @click="setDarkTheme"
                    class="flex items-center justify-center px-4 py-2 space-x-4 transition-colors border rounded-md hover:text-gray-900 hover:border-gray-900 dark:border-neutral-600 dark:hover:text-neutral-100 dark:hover:border-neutral-500 focus:outline-none focus:ring focus:ring-neutral-400 dark:focus:ring-neutral-700"
                    :class="{ 'border-gray-900 text-gray-900 dark:border-neutral-500 dark:text-neutral-100': isDark, 'text-gray-500 dark:text-neutral-500': !isDark }"
                  >
                    <span>
                      <svg
                        class="w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                        />
                      </svg>
                    </span>
                    <span>Dark</span>
                  </button> --}}
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
                                            {{-- <svg
                    class="w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg> --}}<i class="fa-solid fa-box ml-1 mr-1"></i>
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
                                            class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white hover:bg-gray-500">
                                            <i class="fa-solid fa-layer-group"></i>&nbsp;&nbsp;&nbsp;Campos
                                        </a>
                                        <a href="{{ route('CuentaCorrienteExportadoras.index') }}" role="menuitem"
                                            class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white hover:bg-gray-500">
                                            <i class="fa-solid fa-hashtag"></i>&nbsp;&nbsp;&nbsp;Exportadoras
                                        </a>
                                        {{-- <a
                        href="#"
                        role="menuitem"
                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                     >
                        Mini + One Columns Sidebar
                     </a> --}}
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
                                            {{-- <svg
                           class="w-5 h-5"
                           xmlns="http://www.w3.org/2000/svg"
                           fill="none"
                           viewBox="0 0 24 24"
                           stroke="currentColor"
                           >
                           <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                           />
                           </svg> --}}<i class="fa-solid fa-gear ml-1 mr-1"></i>
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
                                            class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white hover:bg-gray-500">
                                            <i class="fa-solid fa-box"></i>&nbsp;&nbsp;&nbsp;<i
                                                class="fa-solid fa-apple-whole"></i>&nbsp;&nbsp;&nbsp;<i
                                                class="fa-solid fa-tag"></i>&nbsp;&nbsp;&nbsp;Envases,Especies,Variedades
                                        </a>
                                        {{-- <a
                           href="{{ route('CertificacionCuartel.index')}}"
                           role="menuitem"
                           class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white hover:bg-gray-500">
                           Exportadoras&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-hashtag"></i>
                        </a> --}}
                                        {{-- <a
                           href="#"
                           role="menuitem"
                           class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                        >
                           Mini + One Columns Sidebar
                        </a> --}}
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
                                            {{-- <svg
                    class="w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg> --}}<i class="fa-solid fa-arrow-down-up-across-line"></i>
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
                                            class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white hover:bg-gray-500">
                                            <i class="fa-solid fa-box-open"></i>&nbsp;&nbsp;&nbsp;Cierres de Temporada
                                        </a>
                                        {{-- <a
                        href="{{ route('CuentaCorrienteExportadoras.index')}}"
                        role="menuitem"
                        class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white hover:bg-gray-500">
                        <i class="fa-solid fa-hashtag"></i>&nbsp;&nbsp;&nbsp;Exportadoras
                     </a> --}}
                                        {{-- <a
                        href="#"
                        role="menuitem"
                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                     >
                        Mini + One Columns Sidebar
                     </a> --}}
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
                                            {{-- <svg
                    class="w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg> --}}<i class="fa-solid fa-warehouse"></i>
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
                                            class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white hover:bg-gray-500">
                                            <i class="fa-solid fa-warehouse"></i>&nbsp;&nbsp;&nbsp;Bodega e Items
                                        </a>
                                        {{-- <a
                        href="{{ route('CuentaCorrienteExportadoras.index')}}"
                        role="menuitem"
                        class="text-left block p-2 text-sm text-gray-300 transition-colors duration-200 rounded-md dark:text-gray-900 dark:hover:text-light hover:text-white hover:bg-gray-500">
                        <i class="fa-solid fa-hashtag"></i>&nbsp;&nbsp;&nbsp;Exportadoras
                     </a> --}}
                                        {{-- <a
                        href="#"
                        role="menuitem"
                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
                     >
                        Mini + One Columns Sidebar
                     </a> --}}
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
                class="fixed inset-y-0 z-20 w-full max-w-xs bg-white dark:bg-darker dark:text-light sm:max-w-md focus:outline-none">
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
                        <div class="flex items-center justify-between px-4 pt-4 border-b dark:border-neutral-800">
                            <h2 id="notificationPanelLabel" class="pb-4 font-semibold">Notificationes</h2>
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
                                {{-- <button @click.prevent="activeTabe = 'user'"
                                    class="px-px pb-4 transition-all duration-200 transform translate-y-px border-b focus:outline-none"
                                    :class="{
                                        'border-neutral-700 dark:border-neutral-600': activeTabe ==
                                            'user',
                                        'border-transparent': activeTabe != 'user'
                                    }">
                                    Información para el Usuario
                                </button> --}}
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
                            <!--  -->
                            <!-- Action tab content -->
                            <!--  -->
                        </div>

                        <!-- User tab -->
                        <div class="space-y-4" x-show.transition.in="activeTabe == 'user'">
                            <p class="px-4">Debe Realizar cosecha !!</p>
                            <!--  -->
                            <!-- User tab content -->
                            <!--  -->
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
                class="fixed inset-y-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none">
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
                        <!--  -->
                        <!-- Search content -->
                        <!--  -->
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.6.x/dist/component.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script> --}}

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
    {{-- fin nuevo sidebar --}}
    {{-- <x-slot name="header">
        <nav class="bg-white border-b border-gray-200 fixed z-40 w-full">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                            class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                            <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <a href="#" class="text-xl font-bold flex items-center lg:ml-2.5">
                            <img src="{{ asset('storage/logo-cc.png') }}" class="h-6 mr-2" alt="Windster Logo">
                            <span class="self-center whitespace-nowrap">Comercial Caro Hmnos. SpA</span>
                        </a>
                        {{-- boton guias  --}
                        <div class="ml-10 z-40 relative" data-te-dropdown-ref>
                            <a class="flex items-center whitespace-nowrap rounded bg-white px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-grey-600 shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-neutral-300 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-neutral-300 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-neutral-300 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                href="#" type="button" id="dropdownMenuButton2" data-te-dropdown-toggle-ref
                                aria-expanded="false" data-te-ripple-init data-te-ripple-color="light">
                                Movimientos y Guías
                                <span class="ml-2 w-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-5 w-5">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </a>
                            <ul class="absolute z-40 float-left mt-5 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-neutral-900 shadow-lg dark:bg-neutral-900 [&[data-te-dropdown-show]]:block"
                                aria-labelledby="dropdownMenuButton2" data-te-dropdown-menu-ref>
                                <li>
                                    <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-900 hover:bg-neutral-500 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                        href="#" data-te-dropdown-item-ref><i class="fa-solid fa-arrow-right"></i>&nbsp;&nbsp;&nbsp;Despacho</a>
                                </li>
                                <li>
                                    <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                        href="#" data-te-dropdown-item-ref><i class="fa-solid fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Recepción</a>
                                </li>
                                <li>
                                    <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                        href="#" data-te-dropdown-item-ref><i class="fa-solid fa-arrows-turn-to-dots"></i>&nbsp;&nbsp;&nbsp;Devolución/Traspasos</a>
                                </li>
                                <hr>
                                <li>
                                    <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                                        href="#" data-te-dropdown-item-ref>Guías Desp./Recep./Dev./Trasp.</a>
                                </li>
                            </ul>
                        </div>
                        {{-- fin boton guias --}}
    {{-- <form action="#" method="GET" class="hidden lg:block lg:pl-32">
                            <label for="topbar-search" class="sr-only">Search</label>
                            <div class="mt-1 relative lg:w-64">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" name="email" id="topbar-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full pl-10 p-2.5"
                                    placeholder="Search">
                            </div>
                        </form> --}
                    </div>
                    <div class="flex mr-10">
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Teams Dropdown -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="ml-3 relative">
                                    <x-dropdown align="right" width="60">
                                        <x-slot name="trigger">
                                            <span class="inline-flex rounded-md">

                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-2  text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                    {{ Auth::user()->currentTeam->name }}

                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </x-slot>

                                        <x-slot name="content">
                                            <div class="w-60">
                                                <!-- Team Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Manage Team') }}
                                                </div>

                                                <!-- Team Settings -->
                                                <x-dropdown-link
                                                    href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                    {{ __('Team Settings') }}
                                                </x-dropdown-link>

                                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                    <x-dropdown-link href="{{ route('teams.create') }}">
                                                        {{ __('Create New Team') }}
                                                    </x-dropdown-link>
                                                @endcan

                                                <!-- Team Switcher -->

                                                @if (Auth::user()->allTeams()->count() > 1)
                                                    <div class="border-t border-gray-200"></div>

                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        {{ __('Switch Teams') }}
                                                    </div>

                                                    @foreach (Auth::user()->allTeams() as $team)
                                                        <x-switchable-team :team="$team" />
                                                    @endforeach
                                                @endif
                                            </div>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            @endif

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <button
                                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                <img class="h-8 w-8 rounded-full object-cover"
                                                    src="{{ Auth::user()->profile_photo_url }}"
                                                    alt="{{ Auth::user()->name }}" />
                                            </button>
                                        @else
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                    {{ Auth::user()->name }}

                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </span>
                                        @endif
                                    </x-slot>

                                    <x-slot name="content">
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Administrar Cuenta') }}
                                        </div>

                                        <x-dropdown-link href="{{ route('profile.show') }}">
                                            {{ __('Perfil') }}
                                        </x-dropdown-link>

                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                                {{ __('API Tokens') }}
                                            </x-dropdown-link>
                                        @endif

                                        <div class="border-t border-gray-200"></div>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf

                                            <x-dropdown-link href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                                {{ __('Salir') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </x-slot>

    <!-- component -->
    <!-- This is an example component --
    <div>
        <div class="flex overflow-hidden bg-white pt-16">
            <aside id="sidebar"
                class="fixed hidden z-20 h-full top-0 left-0 pt-16 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75"
                aria-label="Sidebar">
                <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
                    <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                        <div class="flex-1 px-3 bg-white divide-y space-y-1">
                            <ul class="space-y-1 pb-2">
                            
                                <li>
                                    <a href="#"
                                        class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                                        <i class="fa-regular fa-home"></i>
                                        <span class="ml-4">Dashboard</span>
                                    </a>
                                </li>
                        
                                {{-- <li>
                                    <a href="#" 
                                        class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                                        <!-- component boton -->
                                        <div class="flex items-center justify-center">
                                            <div class="relative group">
                                                <button id="dropdown-button"
                                                    class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                                                    <span class="mr-2">Open Dropdown</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <div id="dropdown-menu"
                                                    class="hidden absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1">
                                                    <!-- Search input -->
                                                    <input id="search-input"
                                                        class="block w-full px-4 py-2 text-gray-800 border rounded-md  border-gray-300 focus:outline-none"
                                                        type="text" placeholder="Search items" autocomplete="off">
                                                    <!-- Dropdown content goes here -->
                                                    <a href="#"
                                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Uppercase</a>
                                                    <a href="#"
                                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Lowercase</a>
                                                    <a href="#"
                                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Camel
                                                        Case</a>
                                                    <a href="#"
                                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Kebab
                                                        Case</a>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- fin boton --}
                                    </a>
                                </li> --}}
    {{-- <li>
                                    <a href="#" target="_blank"
                                        class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                                        <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"
                                            fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                                            </path>
                                            <path
                                                d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                                            </path>
                                        </svg>
                                        <span class="ml-3 flex-1 whitespace-nowrap">Usuarios</span>
                                        <span
                                            class="bg-gray-200 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">Pro</span>
                                    </a>
                                </li> --}
                                <li>
                                    <a href="{{route('User.index')}}"
                                        class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                                        <i class="fa-regular fa-users"></i>
                                        <span class="ml-4">Usuarios</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('RolePermisos.index')}}"
                                        class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                                        <i class="fa-solid fa-table-list"></i><span class="ml-3 ">Roles y
                                            Permisos</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('Empresa.index')}}"
                                        class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                                        <i class="fa-solid fa-building"></i>
                                        <span class="ml-3">Empresas</span>
                                    </a>
                                </li>
                                 <li>
                                    <a href="{{route('Campo.create')}}"
                                        class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                                        <i class="fa-solid fa-layer-group"></i>
                                        <span class="ml-3">Crear Campos</span>
                                    </a>
                                </li>
                                 <li>
                                    <a href="{{route('Cuartel.create')}}"
                                        class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                                        <i class="fa-solid fa-hashtag"></i>
                                        <span class="ml-3">Crear Cuarteles</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('organizacion.index')}}"
                                        class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                                        <i class="fa-solid fa-search"></i>
                                        <span class="ml-3">Ver Campos/Cuarteles</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="space-y-2 pt-2">
                                <a href="{{route('Parametros.index')}}"
                                    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i class="fa-solid fa-sliders"></i>
                                    <span class="ml-4">Configuración</span>
                                </a>
                                <a href="{{route('CuentaCorriente.index')}}"
                                    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i class="fa-solid fa-inbox"></i>
                                    <span class="ml-3">Cuenta Envases</span>
                                </a>
                                <a href="#" target="_blank"
                                    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i class="fa-solid fa-tree"></i>
                                    <span class="ml-3">Plantaciones</span>
                                </a>
                                <a href="#" target="_blank"
                                    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <span class="ml-3">Planificación Cosechas</span>
                                </a>
                                <a href="#" target="_blank"
                                    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i class="fa-solid fa-apple-whole"></i>
                                    <span class="ml-3">Cosechar</span>
                                </a>
                                <a href="#" target="_blank"
                                    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i class="fa-solid fa-carrot"></i>
                                    <span class="ml-3">Cosechas Realizadas</span>
                                </a>
                                 <a href="#" target="_blank"
                                    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i
                                        class="fa-solid fa-layer-group"></i>
                                    <span class="ml-3">Certificaciones Campos</span>
                                </a>
                                 <a href="#" target="_blank"
                                    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i
                                        class="fa-solid fa-hashtag"></i>
                                    <span class="ml-3">Certificaciones Cuarteles</span>
                                </a>

                                {{-- <a href="#" target="_blank"
                                    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i class="fa-solid fa-arrow-right"></i>
                                    <span class="ml-3">Guías Despacho</span>
                                </a>
                                <a href="#" target="_blank"
                                    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i class="fa-solid fa-arrow-left"></i>
                                    <span class="ml-3">Guías Recepción</span>
                                </a>
                                <a href="#" target="_blank"
                                    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i class="fa-solid fa-arrows-turn-to-dots"></i>
                                    <span class="ml-3">Devolución Traspasos</span>
                                </a>
                                <a href="#" target="_blank"
                                    class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                                    <i class="fa-solid fa-apple-whole"></i>
                                    <span class="ml-3">Guías Desp/Recep/Dev</span>
                                </a> --}
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            
            <div id=" main-content" class=" h-full w-full bg-gray-300 relative overflow-y-auto lg:ml-64">
              <main class="p-2 ">  {{ $slot }} </main>
                {{-- 
            <div class="pt-6 px-4">
               <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                  <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                     <div class="flex items-center justify-between mb-4">
                        <div class="flex-shrink-0">
                           <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">$45,385</span>
                           <h3 class="text-base font-normal text-gray-500">Sales this week</h3>
                        </div>
                        <div class="flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                           12.5%
                           <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                           </svg>
                        </div>
                     </div>
                     <div id="main-chart"></div>
                  </div>
                  <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                     <div class="mb-4 flex items-center justify-between">
                        <div>
                           <h3 class="text-xl font-bold text-gray-900 mb-2">Latest Transactions</h3>
                           <span class="text-base font-normal text-gray-500">This is a list of latest transactions</span>
                        </div>
                        <div class="flex-shrink-0">
                           <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                        </div>
                     </div>
                     <div class="flex flex-col mt-8">
                        <div class="overflow-x-auto rounded-lg">
                           <div class="align-middle inline-block min-w-full">
                              <div class="shadow overflow-hidden sm:rounded-lg">
                                 <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                       <tr>
                                          <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                             Transaction
                                          </th>
                                          <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                             Date & Time
                                          </th>
                                          <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                             Amount
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                       <tr>
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                             Payment from <span class="font-semibold">Bonnie Green</span>
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                             Apr 23 ,2021
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                             $2300
                                          </td>
                                       </tr>
                                       <tr class="bg-gray-50">
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                             Payment refund to <span class="font-semibold">#00910</span>
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                             Apr 23 ,2021
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                             -$670
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                             Payment failed from <span class="font-semibold">#087651</span>
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                             Apr 18 ,2021
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                             $234
                                          </td>
                                       </tr>
                                       <tr class="bg-gray-50">
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                             Payment from <span class="font-semibold">Lana Byrd</span>
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                             Apr 15 ,2021
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                             $5000
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                             Payment from <span class="font-semibold">Jese Leos</span>
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                             Apr 15 ,2021
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                             $2300
                                          </td>
                                       </tr>
                                       <tr class="bg-gray-50">
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                             Payment from <span class="font-semibold">THEMESBERG LLC</span>
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                             Apr 11 ,2021
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                             $560
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                             Payment from <span class="font-semibold">Lana Lysle</span>
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                             Apr 6 ,2021
                                          </td>
                                          <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                             $1437
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                  <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                     <div class="flex items-center">
                        <div class="flex-shrink-0">
                           <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">2,340</span>
                           <h3 class="text-base font-normal text-gray-500">New products this week</h3>
                        </div>
                        <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                           14.6%
                           <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                           </svg>
                        </div>
                     </div>
                  </div>
                  <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                     <div class="flex items-center">
                        <div class="flex-shrink-0">
                           <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">5,355</span>
                           <h3 class="text-base font-normal text-gray-500">Visitors this week</h3>
                        </div>
                        <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                           32.9%
                           <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                           </svg>
                        </div>
                     </div>
                  </div>
                  <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                     <div class="flex items-center">
                        <div class="flex-shrink-0">
                           <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">385</span>
                           <h3 class="text-base font-normal text-gray-500">User signups this week</h3>
                        </div>
                        <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold">
                           -2.7%
                           <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                           </svg>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">
                  <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
                     <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold leading-none text-gray-900">Latest Customers</h3>
                        <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                        View all
                        </a>
                     </div>
                     <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200">
                           <li class="py-3 sm:py-4">
                              <div class="flex items-center space-x-4">
                                 <div class="flex-shrink-0">
                                    <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/neil-sims.png" alt="Neil image">
                                 </div>
                                 <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                       Neil Sims
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
                                       <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="17727a767e7b57607e7973646372653974787a">[email&#160;protected]</a>
                                    </p>
                                 </div>
                                 <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    $320
                                 </div>
                              </div>
                           </li>
                           <li class="py-3 sm:py-4">
                              <div class="flex items-center space-x-4">
                                 <div class="flex-shrink-0">
                                    <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/bonnie-green.png" alt="Neil image">
                                 </div>
                                 <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                       Bonnie Green
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
                                       <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d4b1b9b5bdb894a3bdbab0a7a0b1a6fab7bbb9">[email&#160;protected]</a>
                                    </p>
                                 </div>
                                 <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    $3467
                                 </div>
                              </div>
                           </li>
                           <li class="py-3 sm:py-4">
                              <div class="flex items-center space-x-4">
                                 <div class="flex-shrink-0">
                                    <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/michael-gough.png" alt="Neil image">
                                 </div>
                                 <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                       Michael Gough
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
                                       <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="57323a363e3b17203e3933242332257934383a">[email&#160;protected]</a>
                                    </p>
                                 </div>
                                 <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    $67
                                 </div>
                              </div>
                           </li>
                           <li class="py-3 sm:py-4">
                              <div class="flex items-center space-x-4">
                                 <div class="flex-shrink-0">
                                    <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/thomas-lean.png" alt="Neil image">
                                 </div>
                                 <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                       Thomes Lean
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
                                       <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="284d45494144685f41464c5b5c4d5a064b4745">[email&#160;protected]</a>
                                    </p>
                                 </div>
                                 <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    $2367
                                 </div>
                              </div>
                           </li>
                           <li class="pt-3 sm:pt-4 pb-0">
                              <div class="flex items-center space-x-4">
                                 <div class="flex-shrink-0">
                                    <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/lana-byrd.png" alt="Neil image">
                                 </div>
                                 <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                       Lana Byrd
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
                                       <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a2c7cfc3cbcee2d5cbccc6d1d6c7d08cc1cdcf">[email&#160;protected]</a>
                                    </p>
                                 </div>
                                 <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    $367
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                     <h3 class="text-xl leading-none font-bold text-gray-900 mb-10">Acquisition Overview</h3>
                     <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                           <thead>
                              <tr>
                                 <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Top Channels</th>
                                 <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Users</th>
                                 <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap min-w-140-px"></th>
                              </tr>
                           </thead>
                           <tbody class="divide-y divide-gray-100">
                              <tr class="text-gray-500">
                                 <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Organic Search</th>
                                 <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">5,649</td>
                                 <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                       <span class="mr-2 text-xs font-medium">30%</span>
                                       <div class="relative w-full">
                                          <div class="w-full bg-gray-200 rounded-sm h-2">
                                             <div class="bg-cyan-600 h-2 rounded-sm" style="width: 30%"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <tr class="text-gray-500">
                                 <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Referral</th>
                                 <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">4,025</td>
                                 <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                       <span class="mr-2 text-xs font-medium">24%</span>
                                       <div class="relative w-full">
                                          <div class="w-full bg-gray-200 rounded-sm h-2">
                                             <div class="bg-orange-300 h-2 rounded-sm" style="width: 24%"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <tr class="text-gray-500">
                                 <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Direct</th>
                                 <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">3,105</td>
                                 <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                       <span class="mr-2 text-xs font-medium">18%</span>
                                       <div class="relative w-full">
                                          <div class="w-full bg-gray-200 rounded-sm h-2">
                                             <div class="bg-teal-400 h-2 rounded-sm" style="width: 18%"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <tr class="text-gray-500">
                                 <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Social</th>
                                 <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">1251</td>
                                 <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                       <span class="mr-2 text-xs font-medium">12%</span>
                                       <div class="relative w-full">
                                          <div class="w-full bg-gray-200 rounded-sm h-2">
                                             <div class="bg-pink-600 h-2 rounded-sm" style="width: 12%"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <tr class="text-gray-500">
                                 <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Other</th>
                                 <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">734</td>
                                 <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                       <span class="mr-2 text-xs font-medium">9%</span>
                                       <div class="relative w-full">
                                          <div class="w-full bg-gray-200 rounded-sm h-2">
                                             <div class="bg-neutral-600 h-2 rounded-sm" style="width: 9%"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <tr class="text-gray-500">
                                 <th class="border-t-0 align-middle text-sm font-normal whitespace-nowrap p-4 pb-0 text-left">Email</th>
                                 <td class="border-t-0 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4 pb-0">456</td>
                                 <td class="border-t-0 align-middle text-xs whitespace-nowrap p-4 pb-0">
                                    <div class="flex items-center">
                                       <span class="mr-2 text-xs font-medium">7%</span>
                                       <div class="relative w-full">
                                          <div class="w-full bg-gray-200 rounded-sm h-2">
                                             <div class="bg-purple-500 h-2 rounded-sm" style="width: 7%"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </main> --}
                <footer
                    class="fixed bottom-0 right-0  bg-white md:flex md:items-center md:justify-between shadow rounded-lg p-1 md:p-6 xl:p-2 my-6 mx-4">
                    <ul class="flex items-center flex-wrap mb-6 md:mb-0">
                        <li><a href="#"
                                class="text-sm font-normal text-gray-500 hover:underline mr-4 md:mr-6">Terms and
                                conditions</a></li>
                        <li><a href="#"
                                class="text-sm font-normal text-gray-500 hover:underline mr-4 md:mr-6">Privacy
                                Policy</a></li>
                        <li><a href="#"
                                class="text-sm font-normal text-gray-500 hover:underline mr-4 md:mr-6">Licensing</a>
                        </li>
                        <li><a href="#"
                                class="text-sm font-normal text-gray-500 hover:underline mr-4 md:mr-6">Cookie
                                Policy</a></li>
                        <li><a href="#" class="text-sm font-normal text-gray-500 hover:underline">Contact</a>
                        </li>
                    </ul>
                    <div class="flex sm:justify-center space-x-6">
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <div class="ml-5 inline-block">
                        <p class="text-center text-sm text-gray-500 my-2">
                            &copy; 2022-2023 <a href="#" class="hover:underline" target="_blank">
                                ComercialCaroHnos</a>. All
                            rights reserved.
                        </p>
                    </div>
                    <div class="inline-block">
                        <img src="{{ asset('storage/logo-cc.png') }}" class="h-6 mr-2">
                    </div>
                </footer>
            </div>
        </div>
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="https://demo.themesberg.com/windster/app.bundle.js"></script>
    </div> --}}
</x-app-layout>
