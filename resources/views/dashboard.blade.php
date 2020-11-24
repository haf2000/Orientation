@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
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
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>
@endpush
