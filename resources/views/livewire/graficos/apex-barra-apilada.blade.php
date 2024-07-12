<div>
    <div class="mr-5 inline-block">Kilos x Semana, Por Campos
        <select wire:model.defer="semanaEspecieCampoPila" wire:change="KilosXSemanaCampoxEspecie">
            <option></option>
            @for ($i = 1; $i < 53; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <button class="inline-block" type="hidden" id="btnCharPilaCampo" wire:click="KilosXSemanaCampoxEspecie"><i
                class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div id="chart-barra-pila" style="width: 100%; height: 250px;"></div>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('updateChartBarra', function(data, labels) {
                console.log('Etiquetas:', labels);
                console.log('Datos:', data);

                var seriesData = data.map(function(item) {
                    return item.especies.reduce(function(sum, especie) {
                        return sum + especie.kilos;
                    }, 0);
                });

                var options = {
                    series: data[0].especies.map(function(_, especieIndex) {
                        return {
                            name: data[0].especies[especieIndex].nombre,
                            data: data.map(function(item) {
                                return item.especies[especieIndex].kilos;
                            }),
                        };
                    }),
                    chart: {
                        type: 'bar',
                        height: 250,
                        stacked: true,
                        toolbar: {
                            show: true
                        },
                        zoom: {
                            enabled: true
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return val + " kilos";
                            }
                        }
                    },
                    xaxis: {
                        categories: labels,
                    },
                    tooltip: {
                        y: {
                            formatter: function(val, opts) {
                                var especieIndex = opts.dataPointIndex;
                                var especieNombre = data[especieIndex].especies[opts.seriesIndex]
                                    .nombre;
                                return val + " kilos - " + especieNombre;
                            }
                        },
                        title: {
                            formatter: function(val, opts) {
                                return ''; // Esto elimina el título del tooltip
                            }
                        },
                        marker: {
                            show: false // Esto elimina el marcador de color en el tooltip
                        }
                    },
                    // ... Resto de tus opciones ...
                };

                var chart = new ApexCharts(document.querySelector("#chart-barra-pila"), options);
                chart.render();
            });
        });
    </script>
    <script>
         window.onload = function() {
            var nombresBotones = ['btnCharPilaCampo','btnSemISemF'];
            for (var i = 0; i < nombresBotones.length; i++) {
                var boton = document.getElementById(nombresBotones[i]);
                {{-- alert('ok'); --}}
                boton.click();
            }
        };
    </script>



</div>
