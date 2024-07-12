<div>
    <div class="ml-5 "><button class="hidden" id="miBotonCampo" wire:click="DatosCampo">Envases por Campo</button></div>
    <div id="CharBarEnvCampo"></div>

</div>
<script>
var options = {
          series: [{
          name: '',
          data: []
        }, {
          name: '',
          data: []
        }, {
          name: '',
          data: []
        }, {
          name: '',
          data: []
        }, {
          name: '',
          data: []
        }],
          chart: {
          type: 'bar',
          width: "100%",
          height: 260,
          stacked: true,
          stackType: '100%'
        },
        plotOptions: {
          bar: {
            horizontal: true,
          },
        },
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        title: {
          text: 'Cuenta Corriente de Campos por tipo de Envase'
        },
        xaxis: {
          categories: [2008, 2009, 2010, 2011, 2012, 2013, 2014],
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + ",Env."
            }
          }
        },
        fill: {
          opacity: 1
        
        },
        legend: {
          position: 'top',
          horizontalAlign: 'left',
          offsetX: 40
        },
        tooltip: {
        y: {
            formatter: function (val) {
                return val + ".Envases";
            }
        }
    }
        };

        var chartCampo = new ApexCharts(document.querySelector("#CharBarEnvCampo"), options);
        chartCampo.render();



    document.addEventListener('livewire:load', function () {
        document.getElementById('miBotonCampo').click();
        Livewire.on('updateChartVarCampo', function (labels, dataSets) {
            // Actualiza el gráfico con los nuevos datos
            options.xaxis.categories = labels;
            options.series = dataSets;

            chartCampo.updateSeries(options.series);
            chartCampo.updateOptions(options);
        });
    });
</script>