<div>
    <div class="mr-5 inline-block">Kilos x Semana, Por Campos
        <select wire:model.defer="semanaEspecieCampoApxTorta" wire:change="KilosXSemanaCampoApxTorta">
            <option></option>
            @for ($i = 1; $i < 53; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <button class="inline-block" type="hidden" id="btnCharApxTorta" wire:click="KilosXSemanaCampoApxTorta"><i
                class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div id="chart"></div>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('updateChartPie', function(labels, data, label) {
                var options = {
                    series: data,
                    chart: {
                        width: 380,
                        type: 'pie',
                    },
                    labels: labels,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                    tooltip: {
                        y: {
                            formatter: function(value, {
                                series,
                                seriesIndex,
                                dataPointIndex,
                                w
                            }) {
                                return value + ' Kilos';
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            });
        });
    </script>
</div>
