<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/Funciones.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @push('scripts')
        <script src="{{ asset('js/FuncionaesEmergentes.js') }}"></script>

    @endpush

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.0-web/css/fontawesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.0-web/css/brands.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.0-web/css/solid.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/css/main.ad49aa9b.css" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        #chartdiv {
        width: 100%;
        height: 500px;
        }
    </style>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>


    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <!-- Styles -->
    @livewireStyles
    <!-- @include('sweetalert::alert') -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script> --}}

    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".soloNumeros").on("input", function() {
                // Obtener el valor actual del campo
                var valor = $(this).val();

                // Verificar si el valor es NaN (no es un número)
                if (isNaN(valor)) {
                    alert("Por favor, ingrese solo números.");
                    // Puedes limpiar el campo o tomar alguna otra acción según tus necesidades
                    $(this).val('');
                }
            });
        });
    </script>
    <script>
        window.addEventListener('EliminarRegistro', function(e) {
            Swal.fire({
                icon: 'info',
                title: 'Registro Eliminado..',
                text: '{{ Session::get('info') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('ErrorYaExiste', function(e) {
            Swal.fire({
                icon: 'error',
                title: 'Registro ya existe..',
                text: '{{ Session::get('error') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('CierreCorrecto', function(e) {
            Swal.fire({
                icon: 'success',
                title: 'Tarea Cerrada Correctamente...',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('GuardadoCorrecto', function(e) {
            Swal.fire({
                icon: 'success',
                title: 'Registro Guardado..',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('ErrorCampoVacio', function(e) {
            Swal.fire({
                icon: 'error',
                title: 'Error, Falta Conductor o Vehículo..',
                text: '{{ Session::get('error') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('ErrorCampoVacioCosecha', function(e) {
            Swal.fire({
                icon: 'error',
                title: 'Error, Falta Datos, Revisar Contratista, Exportadora, Tarja o Kilos..',
                text: '{{ Session::get('error') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        window.addEventListener('ErrorFaltanDatos', function(e) {
            Swal.fire({
                icon: 'error',
                title: 'Error, Falta Datos..',
                text: '{{ Session::get('error') }}',
                timer: 5000,
                showConfirmButton: false
            });
        });
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true
            });
        });
        $(document).ready(function() {
            $('#myTable3').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable55').DataTable();
        });
    </script>
    <script>
        function EliminarSolicitudCliente(id) {
            //alert(id);
            $('#fila' + id).remove();
            var totalkilos = 0
            var KilosMatriz = [];
            var valor = $('#valoreskilos').val();
            $('#valoreskilos').each(function() {
                KilosMatriz.push($(this).val());
            });
            //alert(KilosMatriz);


            for (i = 0; i < KilosMatriz.length; i++) {
                totalkilos = parseFloat(totalkilos) + parseFloat(KilosMatriz[i]);
            }
            $('#totadekilos').val(totalkilos);
            Swal.fire(
                'Exportadora',
                'Exportadora Eliminada de la lista!',
                'success'
            )
        }



        function EliminarContratista(id) {
            //alert(id);
            $('#filas' + id).remove();
            Swal.fire(
                'Contratista',
                'Contratista Eliminado de la lista!',
                'success'
            )
        }
    </script>
    <script>
        function EliminarColorEnvase(id, cantidad) {
            //alert(cantidad);
            var saldoInicial = $('#saldoInicial').val();
            resta = parseInt(saldoInicial) - parseInt(cantidad);
            $('#saldoInicial').val(resta);
            $('#cantidadColor').val(0);
            $('#filaColor' + id).remove();

            Swal.fire(
                'Envase',
                'Envase  Eliminada de la lista!',
                'success'
            )
        }
    </script>
    <script>
        function EliminarColorEnvaseDos(idDos, cantidadDos) {
            //alert(cantidad);
            var saldoInicialDos = $('#saldoInicialDos').val();
            restaDos = parseInt(saldoInicialDos) - parseInt(cantidadDos);
            $('#saldoInicialDos').val(restaDos);
            $('#cantidadColorDos').val(0);
            $('#filaColorDos' + idDos).remove();

            Swal.fire(
                'Envase',
                'Envase  Eliminada de la lista!',
                'success'
            )
        }
    </script>

</head>

<body class="font-sans antialiased">

    <x-banner />

    <div class="text-right min-h-screen bg-gray-100">
        {{-- @livewire('navigation-menu') --}}

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl w-full  px-4 sm:px-6 lg:px-8">
                    {{ $header }}

                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ Session::get('success') }}',
                timer: 5000,
                showConfirmButton: false
            });
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ Session::get('error') }}',
                timer: 5000,
                showConfirmButton: false
            });
        </script>
    @endif
    @stack('modals')

    @livewireScripts
</body>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>


</html>
