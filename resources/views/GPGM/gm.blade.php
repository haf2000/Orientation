@extends('layouts.app', ['page' => __('Génie Mécanique'), 'pageSlug' => 'gm'])

@section('content')
<div class="row" style="display: inline;">
  
<div class="card card-white">
                
                <div class="card-body">
                    <p class="text-dark text-center mb-2" style="text-align: left;"><strong>Importer la fiche de voeux</strong></p>
                     
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                   <p class="text-dark mb-2" style="text-align: left;"><strong>Fiche de voeux : </strong></p>
                <input type="file" name="file1" class="form-control">

                <br>
                <button type="submit" class="btn btn-success">Importer</button>
                
                   </form>

                </div>
               
            </div>

</div>
<hr style="background-color: rgba(255,255,255,0.4);">

 <!---------------------------------------------------------------------------->

<div class="row justify-content-center text-center">
<div class="font-icon-list col-lg-4 col-md-3 col-sm-4 col-xs-6 col-xs-6">
      <div class="font-icon-detail">
<p style="font-size: 18px;"><a href="#sec1" rel="modal:open">Section 1 (H)</a></p>
      </div>
    </div>
<!-- --------------------------------------------------------------- -->
<div class="font-icon-list col-lg-4 col-md-3 col-sm-4 col-xs-6 col-xs-6">
      <div class="font-icon-detail">
<p style="font-size: 18px;"><a href="#sec2" rel="modal:open">Section 2 (I)</a></p>
      </div>
    </div>
    <!-- ----------------------------------------------------------------- -->
<div class="font-icon-list col-lg-4 col-md-3 col-sm-4 col-xs-6 col-xs-6">
      <div class="font-icon-detail">
<p style="font-size: 18px;"><a href="#sec3" rel="modal:open">Section 3 (J)</a></p>
      </div>
    </div>
    <!-- ----------------------------------------------------------------- -->
<div class="font-icon-list col-lg-4 col-md-3 col-sm-4 col-xs-6 col-xs-6">
      <div class="font-icon-detail">
<p style="font-size: 18px;"><a href="#sec4" rel="modal:open">Section 4 (K)</a></p>
      </div>
    </div>
    <!-- ----------------------------------------------------------------- -->
<div class="font-icon-list col-lg-4 col-md-3 col-sm-4 col-xs-6 col-xs-6">
      <div class="font-icon-detail">
<p style="font-size: 18px;"><a href="#sec5" rel="modal:open">Section 5 (L)</a></p>
      </div>
    </div>

</div>
    <!-- ----------------------------MODAL 1------------------------------------- -->

<div id="sec1" class="modal" style="background-color: #fff;">
         
<form class="form" method="post" action="{{ route('login') }}">
            @csrf

            <div class="card card-login card-white">
                
                <div class="card-body">
                    <p class="text-dark text-center mb-2"><strong>Importer les fichiers excel nécessaires</strong></p>
                     
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <p class="text-dark mb-2" style="text-align: left;"><strong>PV de délibération L2 de cette année : </strong></p>
                <input type="file" name="file" class="form-control"><br>
                <!-- <p class="text-dark mb-2" style="text-align: left;"><strong>PV de délibération L3 de cette année : </strong></p>
                <input type="file" name="file2" class="form-control"> -->
                <br>
                <button type="submit" class="btn btn-success">Importer les 2 fichiers</button>
                
                   </form>

                </div>
                <div class="card-footer">
                   
  <a href="#" rel="modal:close" style="font-size: 15px;">Fermer</a> 
                    <!-- <button type="submit" class="btn btn-primary btn-lg btn-block mb-3 text-center" style="background:  rgba(185,147,214,1);font-weight: normal;">{{ __('Effectuer le traitement') }}</button> -->    

                 </div>
            </div>
        </form>

  
</div>
    <!-- ----------------------------MODAL 2------------------------------------- -->
    <!-- ----------------------------MODAL 3------------------------------------- -->
    <!-- ----------------------------MODAL 4------------------------------------- -->
    <!-- ----------------------------MODAL 5------------------------------------- -->



<br>
<hr style="background-color: rgba(255,255,255,0.4);">
<!-- ------------------------------------------------------------------    -->
<div class="row justify-content-center">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    
    <button type="submit" class="btn btn-primary btn-lg btn-block mb-3 text-center" style="background:  rgba(185,147,214,1);font-weight: normal;">{{ __('Effectuer le traitement') }}</button>
  </div>
  <div class="col-lg-4"></div>
</div>

<!-- ------------------------------------------------------------------    -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
@endsection

