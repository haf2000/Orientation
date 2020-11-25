@extends('layouts.app', ['pageSlug' => 'stat2'])

@section('content')

   
      <div class="row">
        <div class="col-lg-5">
              <div class="card card-chart">
                      <div class="card-header">
                          <div class="row">
                     <div class="col-sm-12 text-left">
                      <h5 class="card-category">Département GP</h5>
                <h4 class="card-title">Nombre de places disponibles pour chaque section</h4>                                                           
                     </div>

                          </div>
                           <div class="row"></div>
                      </div>
                      <div class="card-body">
                  <div class="chart-area">
                        <canvas id="chartPie"></canvas>
                    </div>
              </div>



              </div>
        </div>
         
        <div class="col-lg-7">
                <div class="card card-chart">
              <div class="card-header">
                <div class="row">
                 <div class="col-sm-12 text-left">
                  <h5 class="card-category">Département GP</h5>
                  <h4 class="card-title">Nombre de places disponibles pour chaque section</h4>                     
                 </div>

              </div>
                <div class="row">
                      <!-- <div class="col-sm- text-left">
                      </div> -->
                        <div class="col-sm-12">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                            <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                <input type="radio" name="options" checked>
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Section C</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-single-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="1">
                                <input type="radio" class="d-none d-sm-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Section D</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-gift-2"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="2">
                                <input type="radio" class="d-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Section E</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-tap-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="3">
                                <input type="radio" class="d-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Section F</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-tap-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="4">
                                <input type="radio" class="d-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Section G</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-tap-02"></i>
                                </span>
                            </label>
                            </div>
              </div>
              </div>
              
              <div class="card-body">
                  <div class="chart-area">
                        <canvas id="chartBig1"></canvas>
                    </div>
              </div>
        </div> </div>
        </div> 
      </div>

<!-- ----------------------------------------------- -->
    <div class="row">

        <div class="col-lg-7">
                <div class="card card-chart">
              <div class="card-header">
                <div class="row">
                 <div class="col-sm-12 text-left">
                  <h5 class="card-category">Département GP</h5>
                  <h4 class="card-title">Détail de l'orientation par ordre de voeux</h4>                     
                 </div>

              </div>
                <div class="row">
                      <!-- <div class="col-sm- text-left">
                      </div> -->
                        <div class="col-sm-12">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                            <label class="btn btn-sm btn-simple active" id="5" style="color: #1f8ef1;border-color: #1f8ef1;" >
                                <input type="radio" name="options" checked>
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">GP</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-single-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-simple" id="6" style="color: #1f8ef1;border-color: #1f8ef1;">
                                <input type="radio" class="d-none d-sm-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">RP</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-gift-2"></i>
                                </span>
                            </label>
                                                      
                            </div>
                        </div>
              </div>
              
              <div class="card-body">
                  <div class="chart-area">
                        <canvas id="chartVoeux"></canvas>
                    </div>
              </div>
        </div> </div>
        </div> 
        <div class="col-lg-5">
              <div class="card card-chart">
                      <div class="card-header">
                          <div class="row">
                     <div class="col-sm-12 text-left">
                      <h5 class="card-category">Département GP</h5>
<!--                 <h4 class="card-title">Moyenne corrigée min-max</h4>                     
 -->
                                         
                     </div>

                          </div>
                      </div>
                      <div class="card-body">
                  <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="color: #00f2c3;">
                                     Section   
                                    </th>
                                    <th style="color: #00f2c3;">
                                      Min mc 
                                    </th>
                                     <th style="color: #00f2c3;">
                                      Max mc
                                    </th>                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                    <td>
                                    C
                                    </td>
                                    <td>
                                {{ $resultat['A']['min'] }}
                                    </td>
                                    <td>
                                {{ $resultat['A']['max'] }}
                                    </td>
                                </tr>
                                 <tr>
                                    
                                    <td>
                                    D
                                    </td>
                                    <td>
                                                       
                             {{ $resultat['B']['min'] }}

                                    </td>
                                    <td>
                             {{ $resultat['B']['max'] }}                                        
                                    </td>
                                </tr>
                                 <tr>
                                    
                                    <td>
                                    E
                                    </td>
                                    <td>
                             {{ $resultat['C']['min'] }}

                                    </td>
                                    <td>
                                 {{ $resultat['C']['max'] }}
 
                                    </td>
                                </tr>
                                 <tr>
                                    
                                    <td>
                                    F
                                    </td>
                                    <td>
                             {{ $resultat['D']['min'] }}

                                    </td>
                                    <td>
                                 {{ $resultat['D']['max'] }}

                                    </td>
                                </tr> 
                                <tr>
                                    
                                    <td>
                                    G
                                    </td>
                                    <td>
                             {{ $resultat['E']['min'] }}

                                    </td>
                                    <td>
                            {{ $resultat['E']['max'] }}

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                      </div>



              </div>
        </div>
   
      </div>

@endsection
      
@push('js')
     
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script type="text/javascript">
        $(function(){

    var chart_labels = ['GP', 'RP'];
    var chart_data = [{!! $places_dispo_spec_section['A']['L3GP'] !!},{!! $places_dispo_spec_section['A']['L3RP'] !!}];

    gradientBarChartConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 0,
            suggestedMax: 50,
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }],

        xAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }]
      }
    };
    var ctx = document.getElementById("chartBig1").getContext('2d');

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
    gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
    gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors
    var config = {
      type: 'bar',
      responsive: true,
      legend: {
        display: false
      },
      data: {
        labels: chart_labels,
        datasets: [{
          label: "Le nombre de places disponibles",
          fill: true,
          backgroundColor: gradientStroke,
          borderColor: '#d346b1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: '#d346b1',
          pointBorderColor: 'rgba(255,255,255,0)',
          pointHoverBackgroundColor: '#d346b1',
          pointBorderWidth: 20,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
          data: chart_data,
        }]
      },
      options: gradientBarChartConfiguration
    };

    var myChartData = new Chart(ctx, config);


    $("#0").click(function() {
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });
    $("#1").click(function() {
      var chart_data = [{!! $places_dispo_spec_section['B']['L3GP'] !!},{!! $places_dispo_spec_section['B']['L3RP'] !!}];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });

    $("#2").click(function() {
      var chart_data = [{!! $places_dispo_spec_section['C']['L3GP'] !!},{!! $places_dispo_spec_section['C']['L3RP'] !!}];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });
    $("#3").click(function() {
      var chart_data = [{!! $places_dispo_spec_section['D']['L3GP'] !!},{!! $places_dispo_spec_section['D']['L3RP'] !!}];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });
    $("#4").click(function() {
      var chart_data = [{!! $places_dispo_spec_section['E']['L3GP'] !!},{!! $places_dispo_spec_section['E']['L3RP'] !!}];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });
        });
    </script>

    <script type="text/javascript">
        $(function(){ 
          
         
         var total_GP = {!! $places_dispo_spec_section['A']['L3GP'] !!}+{!! $places_dispo_spec_section['B']['L3GP'] !!}+{!! $places_dispo_spec_section['C']['L3GP'] !!}+{!! $places_dispo_spec_section['D']['L3GP'] !!}+{!! $places_dispo_spec_section['E']['L3GP'] !!};  

          var total_RP = {!! $places_dispo_spec_section['A']['L3RP'] !!}+{!! $places_dispo_spec_section['B']['L3RP'] !!}+{!! $places_dispo_spec_section['C']['L3RP'] !!}+{!! $places_dispo_spec_section['D']['L3RP'] !!}+{!! $places_dispo_spec_section['E']['L3RP'] !!};

       

    var ctx = document.getElementById("chartPie").getContext('2d');
   
     var config = {
    type: 'doughnut',
    data: {
      labels: ['GP','RP'],
      datasets: [
        {

          label: "Nombre de places disponibles dans chaque spécialité",
          backgroundColor: ["#d346b1", "#00f2c3"],
          data: [total_GP,total_RP],
          borderWidth : 2,
          borderColor : "#f5f6f6",

        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Nombre de places disponibles dans chaque spécialité',
      }
    }
};
    

    var myChartData = new Chart(ctx, config);
});
    </script>
<!-- --------------------------------------------------------- -->
<!-- --------------------------------------------------------- -->
<!-- --------------------------------------------------------- -->

 <script type="text/javascript">
        $(function(){

    var chart_labels = ['Choix 1', 'Choix 2','Sans'];
    var chart_data = [{!! $data_voeux['GP']['choix1'] !!},{!! $data_voeux['GP']['choix2'] !!},{!! $data_voeux['GP']['sans'] !!}];

    gradientBarChartConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 0,
            suggestedMax: 150,
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }],

        xAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }]
      }
    };
    var ctx = document.getElementById("chartVoeux").getContext('2d');

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
    gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
    gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors

    var config = {
      type: 'bar',
      responsive: true,
      legend: {
        display: false
      },
      data: {
        labels: chart_labels,
        datasets: [{
          label: "Le nombre de voeux par spécialité",
          fill: true,
          backgroundColor: gradientStroke,
          borderColor: '#1f8ef1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: '#1f8ef1',
          pointBorderColor: 'rgba(255,255,255,0)',
          pointHoverBackgroundColor: '#d346b1',
          pointBorderWidth: 20,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
          data: chart_data,
        }]
      },
      options: gradientBarChartConfiguration
    };

    var myChartData = new Chart(ctx, config);


    $("#5").click(function() {
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });
    $("#6").click(function() {
      var chart_data = [{!! $data_voeux['RP']['choix1'] !!},{!! $data_voeux['RP']['choix2'] !!},{!! $data_voeux['RP']['sans'] !!}];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });   
        });
    </script>
<!-- --------------------------------------------------------- -->
<!-- --------------------------------------------------------- -->
<!-- --------------------------------------------------------- -->

    <script>
        //$(document).ready(function() {
         // demo.initDashboardPageCharts();
       // });
    </script>
@endpush
