<div>
    <div class="mr-5 inline-block">Kilos x Semana, Por Cuarteles
        <select wire:model.defer="semanaEspecieCuartel" wire:change="KilosXSemanaCuartel">
            <option></option>
            @for ($i = 1; $i < 53; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select><button class="inline-block" type="hidden" id="btnCharCuartel" wire:click="KilosXSemanaCuartel"><i
                class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div class="border-solid border-2 border-transparent rounded-lg ">
        <canvas id="myChartdoughnut" width="50" height="200"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('myChartdoughnut').getContext('2d');
        var myChartRadial = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    label: ['Kilos de Cuarteles x Semana'],

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
                aspectRatio: 1, // Puedes ajustar este valor según tus necesidades
                responsive: true,
                height: 200,
            }
        })
        //actualizaciones
        document.addEventListener('livewire:load', function() {
            Livewire.on('updateChartRadial', function(labels, data, label) {
                // Limpiar datos antiguos
                myChartRadial.data.label = [];
                myChartRadial.data.labels = [];
                myChartRadial.data.datasets[0].data = [];

                // Llenar con nuevos datos
                myChartRadial.data.labels = label;
                myChartRadial.data.labels = labels;
                myChartRadial.data.datasets[0].data = data;

                // Actualizar el gráfico
                myChartRadial.update();
            })
        })
        //fin
    </script>
</div>
