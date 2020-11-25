@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <!-- <div class="row">
        <div class="col-12">
            <div class="card card-chart">


                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Total Shipments</h5>
                            <h2 class="card-title">Performance</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                            <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                <input type="radio" name="options" checked>
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Accounts</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-single-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="1">
                                <input type="radio" class="d-none d-sm-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-gift-2"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="2">
                                <input type="radio" class="d-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-tap-02"></i>
                                </span>
                            </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartBig1"></canvas>
                    </div>
                </div>
            </div>




        </div>
    </div> -->
      <div class="row">
        <div class="col-lg-5">
              <div class="card card-chart">
                      <div class="card-header">
                          <div class="row">
                     <div class="col-sm-12 text-left">
                      <h5 class="card-category">Département GM</h5>
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
                  <h5 class="card-category">Département GM</h5>
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
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Section H</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-single-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="1">
                                <input type="radio" class="d-none d-sm-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Section I</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-gift-2"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="2">
                                <input type="radio" class="d-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Section J</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-tap-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="3">
                                <input type="radio" class="d-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Section K</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-tap-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="4">
                                <input type="radio" class="d-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Section L</span>
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





    <div class="row">
        <div class="col-lg-4">


            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Nombre de places par section dans chaque spécialité</h5>
                    <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> 457 à orienter</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLinePurple"></canvas>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Nombre de places par section dans chaque spécialité</h5>
                    <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> 457 à orienter</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="CountryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Completed Tasks</h5>
                    <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> 12,100K</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLineGreen"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">


        <div class="col-lg-12 col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Fichiers contenant le résultat d'orientation du département Génie Mécanique </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Nom du fichier à exporter
                                    </th>
                                    <th class="text-center">
                                        Exporter
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                    <td>
                                    Génie_Mécanique_Section_H
                                    </td>
                                    <td class="text-center">
 <a href="{{ route('exportGMH') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                    Génie_Mécanique_Section_I
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportGMI') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                    Génie_Mécanique_Section_J
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportGMJ') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                    Génie_Mécanique_Section_K
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportGMK') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    
</td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                    Génie_Mécanique_Section_L
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportGML') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td>

                                </tr>

                                <tr>
                                   <td>
                                    Génie_Mécanique_Spécialité_Eerg
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportEnerg') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td> 

                                </tr>
                                <tr>
                                   <td>
                                    Génie_Mécanique_Spécialité_GM
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportGM') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td> 

                                </tr>
                                <tr>
                                   <td>
                                    Génie_Mécanique_Spécialité_CM
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportCM') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td> 

                                </tr>

                                <tr>
                                   <td>
                                    Génie_Mécanique_Complet
                                    </td>
                                    <td class="text-center">
                                    <a href="{{ route('exportGMTotal') }}"><i class="tim-icons icon-cloud-download-93"></i></a>   
                                    </td> 

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr style="background-color: rgba(255,255,255,0.4);">
               <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Fichiers contenant le résultat d'orientation du département Génie Procédés </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Nom du fichier à exporter
                                    </th>
                                    <th class="text-center">
                                        Exporter
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                    <td>
                                    Génie_Procédés_Section_C
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportGPC') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                    Génie_Procédés_Section_D
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportGPD') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                    Génie_Procédés_Section_E
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportGPE') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                    Génie_Procédés_Section_F
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportGPF') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                    Génie_Procédés_Section_G
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportGPG') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td>

                                </tr>

                                <tr>
                                   <td>
                                    Génie_Procédés_Spécialité_GP
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportGP') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td> 

                                </tr>
                                <tr>
                                   <td>
                                    Génie_Procédés_Spécialité_RP
                                    </td>
                                    <td class="text-center">
<a href="{{ route('exportRP') }}"><i class="tim-icons icon-cloud-download-93"></i></a>                                    </td> 

                                </tr>
                                

                                <tr>
                                   <td>
                                    Génie_Procédés_Complet
                                    </td>
                                    <td class="text-center">
                                      <a href="{{ route('exportGPTotal') }}"><i class="tim-icons icon-cloud-download-93"></i></a>   
                                    </td> 

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
      
@push('js')
     
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script type="text/javascript">
        $(function(){


    var chart_labels = ['Energ', 'GM', 'CM'];
    var chart_data = [{!! $places_dispo_spec_section['A']['L3E'] !!},{!! $places_dispo_spec_section['A']['L3GM'] !!},{!! $places_dispo_spec_section['A']['L3CM'] !!}];

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
      var chart_data = [{!! $places_dispo_spec_section['B']['L3E'] !!},{!! $places_dispo_spec_section['B']['L3GM'] !!},{!! $places_dispo_spec_section['B']['L3CM'] !!}];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });

    $("#2").click(function() {
      var chart_data = [{!! $places_dispo_spec_section['C']['L3E'] !!},{!! $places_dispo_spec_section['C']['L3GM'] !!},{!! $places_dispo_spec_section['C']['L3CM'] !!}];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });
    $("#3").click(function() {
      var chart_data = [{!! $places_dispo_spec_section['D']['L3E'] !!},{!! $places_dispo_spec_section['D']['L3GM'] !!},{!! $places_dispo_spec_section['D']['L3CM'] !!}];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });
    $("#4").click(function() {
      var chart_data = [{!! $places_dispo_spec_section['E']['L3E'] !!},{!! $places_dispo_spec_section['E']['L3GM'] !!},{!! $places_dispo_spec_section['E']['L3CM'] !!}];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });
        });



    </script>

    <script type="text/javascript">
        $(function(){ 
          
         
         var total_L3E = {!! $places_dispo_spec_section['A']['L3E'] !!}+{!! $places_dispo_spec_section['B']['L3E'] !!}+{!! $places_dispo_spec_section['C']['L3E'] !!}+{!! $places_dispo_spec_section['D']['L3E'] !!}+{!! $places_dispo_spec_section['E']['L3E'] !!};

          var total_L3GM = {!! $places_dispo_spec_section['A']['L3GM'] !!}+{!! $places_dispo_spec_section['B']['L3GM'] !!}+{!! $places_dispo_spec_section['C']['L3GM'] !!}+{!! $places_dispo_spec_section['D']['L3GM'] !!}+{!! $places_dispo_spec_section['E']['L3GM'] !!};

          var total_L3CM = {!! $places_dispo_spec_section['A']['L3CM'] !!}+{!! $places_dispo_spec_section['B']['L3CM'] !!}+{!! $places_dispo_spec_section['C']['L3CM'] !!}+{!! $places_dispo_spec_section['D']['L3CM'] !!}+{!! $places_dispo_spec_section['E']['L3CM'] !!};

    var ctx = document.getElementById("chartPie").getContext('2d');
   
     var config = {
    type: 'doughnut',
    data: {
      labels: ['Energ','GM','CM'],
      datasets: [
        {

          label: "Nombre de places disponibles dans chaque spécialité",
          backgroundColor: ["#d346b1", "#00f2c3","#1d8cf8"],
          data: [total_L3E,total_L3GM,total_L3CM],
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
    <script>
        //$(document).ready(function() {
         // demo.initDashboardPageCharts();
       // });
    </script>
@endpush
