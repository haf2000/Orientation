@extends('layouts.app', ['page' => __('Génie Mécanique'), 'pageSlug' => 'gm'])

@section('content')
<div class="row" style="display: inline;">
  
<div class="card card-white">
                 <div class="card-header">
                   @if (session('status'))
                <div class="alert alert-success" role="alert">
                   {{ session('status') }}
                   </div>
                 @endif

                 </div>
                <div class="card-body">
                    <p class="text-dark text-center mb-2" style="text-align: left;"><strong>Entrer la fiche de voeux et les PVs de délibération L3 de cette année</strong></p>
                     
                    <form action="{{ route('importFVGM') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                   <p class="text-dark mb-2" style="text-align: left;"><strong>Fiche de voeux : </strong></p>
                <input type="file" name="file2" class="form-control">

                <br>
                <button type="submit"  class="col-lg-4 btn btn-primary btn-lg btn-block mb-3 text-center" style="background:  rgba(185,147,214,1);font-weight: normal;">Importer la fiche de voeux</button>
                
                   </form>
                 
                  <hr style="background-color: rgba(0,0,0,0.6);">

                  <form action="{{ route('importL3GM') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                   <p class="text-dark mb-2" style="text-align: left;"><strong>PV L3GM :</strong></p>
                <input type="file" name="file1" class="form-control">

                <br>
                <button type="submit"  class="col-lg-4 btn btn-primary btn-lg btn-block mb-3 text-center" style="background:  rgba(185,147,214,1);font-weight: normal;" >Importer le PV L3GM</button>
                
                   </form>
                </div>
               
            </div>

</div>




<hr style="background-color: rgba(255,255,255,0.4);">
 <!---------------------------------------------------------------------------->
    <p style="text-align: center;">Entrer le PV de délibération L2 pour chaque section</p>
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
         
<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
           {{ csrf_field() }}

            <div class="card card-white">
                 <div class="card-header">
                   @if (session('status1'))
                <div class="alert alert-success" role="alert">
                   {{ session('status1') }}
                   </div>
                 @endif
                 </div>
                <div class="card-body">
                    <p class="text-dark text-center mb-2"><strong>Entrer le fichiers excel du PV L2</strong></p>
                     
                
                <p class="text-dark mb-2" style="text-align: left;"><strong>PV de délibération L2 de cette année : </strong></p>
                <input type="file" name="file01" class="form-control"><br>
                <br>
                <button class="btn btn-success">Importer le PV L2</button>
                
                </div>
                <div class="card-footer">
                   
  <a href="#" rel="modal:close" style="font-size: 15px;">Fermer</a> 
                   

                 </div>
            </div>
        </form>

  
</div>
    <!-- ----------------------------MODAL 2------------------------------------- -->

    <div id="sec2" class="modal" style="background-color: #fff;">
         
<form action="{{ route('import2') }}" method="POST" enctype="multipart/form-data">
           {{ csrf_field() }}

            <div class="card card-white">
                <div class="card-header">
                   @if (session('status2'))
                <div class="alert alert-success" role="alert">
                   {{ session('status2') }}
                   </div>
                 @endif
                 </div>
    <!-- ------------------------------------------------ -->
                <div class="card-body">
                    <p class="text-dark text-center mb-2"><strong>Entrer le fichiers excel du PV L2</strong></p>
                     
                
                <p class="text-dark mb-2" style="text-align: left;"><strong>PV de délibération L2 de cette année : </strong></p>
                <input type="file" name="file02" class="form-control"><br>
                <br>
                <button class="btn btn-success">Importer le PV L2</button>
                
                </div>
                <div class="card-footer">
                   
  <a href="#" rel="modal:close" style="font-size: 15px;">Fermer</a> 
                   

                 </div>
            </div>
        </form>

  
</div>
    <!-- ----------------------------MODAL 3------------------------------------- -->
<div id="sec3" class="modal" style="background-color: #fff;">
         
<form action="{{ route('import3') }}" method="POST" enctype="multipart/form-data">
           {{ csrf_field() }}

            <div class="card card-white">
                  <div class="card-header">
                   @if (session('status3'))
                <div class="alert alert-success" role="alert">
                   {{ session('status3') }}
                   </div>
                 @endif
                 </div>
                <div class="card-body">
                    <p class="text-dark text-center mb-2"><strong>Entrer le fichiers excel du PV L2</strong></p>
                     
                
                <p class="text-dark mb-2" style="text-align: left;"><strong>PV de délibération L2 de cette année : </strong></p>
                <input type="file" name="file03" class="form-control"><br>
                <br>
                <button class="btn btn-success">Importer le PV L2</button>
                
                </div>
                <div class="card-footer">
                   
  <a href="#" rel="modal:close" style="font-size: 15px;">Fermer</a> 
                   

                 </div>
            </div>
        </form>

  
</div>
    <!-- ----------------------------MODAL 4------------------------------------- -->
<div id="sec4" class="modal" style="background-color: #fff;">
         
<form action="{{ route('import4') }}" method="POST" enctype="multipart/form-data">
           {{ csrf_field() }}

            <div class="card card-white">
                 <div class="card-header">
                   @if (session('status4'))
                <div class="alert alert-success" role="alert">
                   {{ session('status4') }}
                   </div>
                 @endif
                 </div>
                <div class="card-body">
                    <p class="text-dark text-center mb-2"><strong>Entrer le fichiers excel du PV L2</strong></p>
                     
                
                <p class="text-dark mb-2" style="text-align: left;"><strong>PV de délibération L2 de cette année : </strong></p>
                <input type="file" name="file04" class="form-control"><br>
                <br>
                <button class="btn btn-success">Importer le PV L2</button>
                
                </div>
                <div class="card-footer">
                   
  <a href="#" rel="modal:close" style="font-size: 15px;">Fermer</a> 
                   

                 </div>
            </div>
        </form>

  
</div>
    <!-- ----------------------------MODAL 5------------------------------------- -->
<div id="sec5" class="modal" style="background-color: #fff;">
         
<form action="{{ route('import5') }}" method="POST" enctype="multipart/form-data">
           {{ csrf_field() }}

            <div class="card card-white">
                  <div class="card-header">
                   @if (session('status5'))
                <div class="alert alert-success" role="alert">
                   {{ session('status5') }}
                   </div>
                 @endif
                 </div>
                <div class="card-body">
                    <p class="text-dark text-center mb-2"><strong>Entrer le fichiers excel du PV L2</strong></p>
                     
                
                <p class="text-dark mb-2" style="text-align: left;"><strong>PV de délibération L2 de cette année : </strong></p>
                <input type="file" name="file05" class="form-control"><br>
                <br>
                <button class="btn btn-success">Importer le PV L2</button>
                
                </div>
                <div class="card-footer">
                   
  <a href="#" rel="modal:close" style="font-size: 15px;">Fermer</a> 
                   

                 </div>
            </div>
        </form>

  
</div>


<br>
<hr style="background-color: rgba(255,255,255,0.4);">
<!-- ------------------------------------------------------------------    -->
<div class="row justify-content-center text-center">
  <div class="col-lg-6">
    
    <a type="submit" class="btn btn-success" href="{{ route('traitement') }}">{{ __('Effectuer le traitement') }}</a>
  </div>
    <div class="col-lg-6">
    
    <a type="submit" class="btn btn-success" href="{{ route('refairetraitement') }}">{{ __('Refaire le traitement') }}</a>
  </div>


</div>

<!-- ------------------------------------------------------------------    -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
@endsection

