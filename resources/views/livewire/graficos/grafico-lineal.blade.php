<div>
    <div class="inline-block">Semana Inicio <select wire:model.defer="semanaInicio">
            <option></option>
            @for ($i = 1; $i < 53; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <button type="button" id="btnSemISemF"  wire:click="KilosXSemanaEspecies"></button>
    <div class="inline-block">Semana Final <select wire:model.defer="semanaFin" wire:change="KilosXSemanaEspecies">
            <option></option>
            @for ($i = 1; $i < 53; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div class="col-span-5 ">
        <canvas id="myChartline" width="10" height="250"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('myChartline').getContext('2d');
        var myChartLine = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['', '', '', '', '', ''],
                datasets: [{
                    label: ['Grafico de Especies x Semana'],

                    data: [1, 1, 1, 1, 1, 1],
                    backgroundColor: [
                        //'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        //'rgba(255, 206, 86, 0.2)',
                        //'rgba(75, 192, 192, 0.2)',
                        //'rgba(153, 102, 255, 0.2)',
                        //'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        //'rgba(54, 162, 235, 1)',
                        //'rgba(255, 206, 86, 1)',
                        //'rgba(75, 192, 192, 1)',
                        //'rgba(153, 102, 255, 1)',
                        //'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)', // Color del fondo del punto
                    pointBorderColor: 'rgba(54, 162, 235, 1)', // Color del borde del punto
                    pointRadius: 5, // Tamaño del punto
                    pointHoverRadius: 7, // Tamaño del punto al pasar el mouse
                    pointLabelFontColor: 'rgba(54, 162, 235, 1)' // Color del texto de la etiqueta en el punto
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                },
                maintainAspectRatio: false, // Desactivar la relación de aspecto
                responsive: true,
            }
        })
        //actualizaciones
        document.addEventListener('livewire:load', function() {
            Livewire.on('updateChartLine', function(labels, dataSets) {
                // Limpiar datos antiguos
                myChartLine.data.labels = [];
                myChartLine.data.datasets = [];

                // Llenar con nuevos datos
                myChartLine.data.labels = labels;

                // Agregar múltiples conjuntos de datos (líneas)
                for (var especie in dataSets) {
                    if (dataSets.hasOwnProperty(especie)) {
                        myChartLine.data.datasets.push({
                            label: especie,
                            data: dataSets[especie],
                            borderColor: getBorderColor(myChartLine.data.datasets.length),
                            backgroundColor: getBackgroundColor(myChartLine.data.datasets.length),
                            borderWidth: 1,
                            fill: false,
                            pointRadius: 4, // Tamaño del punto
                            pointHoverRadius: 6, // Tamaño del punto al pasar el ratón
                            pointStyle: 'circle', // Estilo del punto
                        });
                    }
                }

                // Configurar opciones para mostrar tooltips
                myChartLine.options = {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                            },
                        }],
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return tooltipItem.yLabel +
                                    ' kilos'; // Personaliza la etiqueta del tooltip
                            },
                        },
                    },
                    maintainAspectRatio: true, // Desactivar la relación de aspecto
                    responsive: true,
                };

                // Actualizar el gráfico
                myChartLine.update();
                myChartLine.resize();
            });
        });

        // Funciones de ayuda para obtener colores únicos
        function getBorderColor(index) {
            var colors = [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ];

            return colors[index % colors.length];
        }

        function getBackgroundColor(index) {
            var colors = [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ];

            return colors[index % colors.length];
        }
        //fin
    </script>
   
</div>
