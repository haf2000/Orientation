@extends('layouts.app', ['page' => __('Génie Mécanique'), 'pageSlug' => 'gm'])

@section('content')


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
                     @php

                     @endphp

                </div>
                <div class="card-footer">
                    
                        <button type="submit" class="btn btn-primary btn-lg btn-block mb-3 text-center" style="background:  rgba(185,147,214,1);font-weight: normal;">{{ __('Effectuer le traitement') }}</button>

                 </div>
            </div>
        </form>

  <a href="#" rel="modal:close" style="font-size: 20px;">Fermer</a>
  
</div>
    <!-- ----------------------------MODAL 2------------------------------------- -->
    <!-- ----------------------------MODAL 3------------------------------------- -->
    <!-- ----------------------------MODAL 4------------------------------------- -->
    <!-- ----------------------------MODAL 5------------------------------------- -->



<br>
<hr style="background-color: rgba(255,255,255,0.4);">
<!-- ------------------------------------------------------------------    -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
@endsection

