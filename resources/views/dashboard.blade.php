@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')

    
      
    

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
                                    <th style="color: #00f2c3;">
                                        Nom du fichier à exporter
                                    </th>
                                    <th class="text-center" style="color: #00f2c3;">
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
                                    <th style="color: #00f2c3;">
                                        Nom du fichier à exporter
                                    </th>
                                    <th class="text-center" style="color: #00f2c3;">
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
      
