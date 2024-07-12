<div>
    <div class="ml-5 "><button class="hidden" id="miBotonExpoRadar" wire:click="DatosEnvaseColores">Envases por Campo</button></div>
    <div id="chartRadarExpoG"></div>
</div>
<script>
 var optionsRadar = {
          series: [{
          name: '',
          data: [],
        }, {
          name: '',
          data: [],
        }, {
          name: '',
          data: [],
        }],
          chart: {
          height: 290,
          type: 'radar',
          dropShadow: {
            enabled: true,
            blur: 1,
            left: 1,
            top: 1
          }
        },
        title: {
          text: 'Envases x Color de Exportadoras en Campos'
        },
        stroke: {
          width: 2
        },
        fill: {
          opacity: 0.1
        },
        markers: {
          size: 0
        },
        xaxis: {
          categories: []
        },
        tooltip: {
        y: {
            formatter: function (val) {
                return val + "%";
            }
        }
    }
        
        };

        var chartRadarExpo = new ApexCharts(document.querySelector("#chartRadarExpoG"), optionsRadar);
        chartRadarExpo.render();

        document.addEventListener('livewire:load', function () {
        document.getElementById('miBotonExpoRadar').click();
        Livewire.on('updateChartRadarExpo', function (labels, dataSets) {
            // Actualiza el gráfico con los nuevos datos
            optionsRadar.xaxis.categories = labels;
            optionsRadar.series = dataSets;

            chartRadarExpo.updateSeries(optionsRadar.series);
            chartRadarExpo.updateOptions(optionsRadar);
        });
    });
</script>