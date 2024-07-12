<div>
    <div class="ml-5 inline-block ">Kilos x Semana, Por Campos
        <select wire:model.defer="semanaEspecieCampo" wire:change="KilosXSemanaCampo">
            <option></option>
            @for ($i = 1; $i < 53; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <div class="text-center col-span-3 border-2 border-transparent rounded-lg ">
        <canvas id="myChartpie" class="m-1" width="50" height="200"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('myChartpie').getContext('2d');
        var myChartPie = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [],
                datasets: [{
                    label: ['Grafico de kilos x Campo Semanal'],

                    data: [1, 1, 1, 1, 1, 1],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'right',
                    },

                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                maintainAspectRatio: false, // Desactivar la relación de aspecto
                responsive: true,
            }
        })
        //actualizaciones
        document.addEventListener('livewire:load', function() {
            Livewire.on('updateChartPie', function(labels, data, label) {
                // Limpiar datos antiguos
                myChartPie.data.label = [];
                myChartPie.data.labels = [];
                myChartPie.data.datasets[0].data = [];

                // Llenar con nuevos datos
                myChartPie.data.labels = label;
                myChartPie.data.labels = labels;
                myChartPie.data.datasets[0].data = data;

                // Actualizar el gráfico
                myChartPie.update();
            })
        })
        //fin
    </script>
</div>
