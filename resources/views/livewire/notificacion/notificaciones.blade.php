<div>
    <div class="p-3 text-center">
        <table class="shadow-lg shadow-neutral-500 p-1 rounded-lg">
            <thead>
                <tr class="bg-neutral-300 text-neutral-900 text-left">
                    <th class="border-2">Cuartel</th>
                    <th class="border-2">Fecha/Termino</th>
                    <th class="border-2">Certificacion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($AlertasCuarteles as $alerta)
                    <tr>
                        <th class="border-2">{{ $alerta[0] }}</th>
                        <th class="border-2">{{ $alerta[1] }}</th>
                        <th class="border-2">{{ $alerta[2] }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
