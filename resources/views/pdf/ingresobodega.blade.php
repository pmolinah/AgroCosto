<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guia de Recepcion</title>
    <style>
        body { font-family: Helvetica, sans-serif; font-size: 8pt; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 4px; text-align: left; }
        .table th { background-color: #E5E7EB; }
        .table tr:nth-child(even) { background-color: #FDFEFE; }
    </style>
</head>
<body>
    <h1>Documento Ingreso y Pesaje</h1>
    <h2>Fact/Guia de Recepcion</h2>
    
    <table class="table">
        <tr>
            <th>Tipo de Documento</th>
            <td>Proceso Control Pesaje I</td>
        </tr>
        <tr>
            <th>Número</th>
            <td>{{ $guiaRecep->id }}</td>
        </tr>
        <tr>
            <th>Rut cliente</th>
            <td>{{ $guiaRecep->cliente->rut }}</td>
        </tr>
        <tr>
            <th>nombre</th>
            <td>{{ $guiaRecep->cliente->cliente }}</td>
        </tr>
    </table>

    <h3>Datos del Ingreso</h3>
    <table class="table">
        <tr>
            <th>Fecha</th>
            <td>{{ $guiaRecep->fecha }}</td>
        </tr>
        <tr>
            <th>Hora Inicio</th>
            <td>{{ $guiaRecep->horaInicio }}</td>
        </tr>
        <tr>
            <th>Hora Termino</th>
            <td>{{ $guiaRecep->horaTermino }}</td>
        </tr>
        <tr>
            <th>Codigo CVS</th>
            <td>{{ $guiaRecep->codCVS }}</td>
        </tr>
        <tr>
            <th>Responsable</th>
            <td>{{ $guiaRecep->responsable->name }}</td>
        </tr>
    </table>

    <h3>Detalles de Ingreso</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Cant</th>
                <th>Envase</th>
                <th>Especie/Variedad.</th>
                <th>Peso Bruto</th>
                <th>Peso Neto</th>
                <th>Calibre</th>
                <th>Cod/Venta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guiaRecep->detcontrolingreso as $detalle)
            <tr>
                <td>{{ $detalle->cantidad }}</td>
                <td>{{ $detalle->envase->envase }},T:{{ $detalle->envase->tara }},C:{{ $detalle->envase->carga }}</td>
                <td>{{ $detalle->especie->especie }},V:{{ $detalle->especie->variedad->variedad }}</td>
                <td>{{ $detalle->pesobruto }}</td>
                <td>{{ $detalle->pesoneto }}</td>
                <td>{{ $detalle->calibre->calibre }}</td>
                <td>{{ $detalle->codVenta }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
