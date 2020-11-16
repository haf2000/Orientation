@extends('layouts.app', ['page' => __('Génie Mécanique'), 'pageSlug' => 'gm'])

@section('content')
    <div class="row justify-content-center text-center">
    	<div  class="col-lg-4 card-body">
    	
    		<div class="btn btn-primary btn-lg btn-block mb-3 text-center" style="background: rgb(140,166,189);
background: radial-gradient(circle, rgba(140,166,189,1) 0%, rgba(185,147,214,1) 100%);font-weight: lighter;font-family: 'Montserrat';">
    	<br>		
          <h3><b> Section 1 (H) </b></h3>
    	<br>	
        
        </div>
    	</div>
    	<!-- ------------------------------------- -->
<div  class="col-lg-4 card-body">
    		<div class="btn btn-primary btn-lg btn-block mb-3 text-center" style="background: rgb(140,166,189);
background: radial-gradient(circle, rgba(140,166,189,1) 0%, rgba(185,147,214,1) 100%);">
    	<br>		
          <span><b> Section 2 (I) </b></span>
    	<br> 		
        
        </div>
    	</div>

    	<!-- ------------------------------------- -->
<div  class="col-lg-4 card-body">
    		<div class="btn btn-primary btn-lg btn-block mb-3 text-center" style="background: rgb(140,166,189);
background: radial-gradient(circle, rgba(140,166,189,1) 0%, rgba(185,147,214,1) 100%);">
    	<br>		
          <span><b> Section 3 (J) </b></span>
    	<br> 	
        
        </div>
    </div>
    	<!-- ------------------------------------- -->
<div  class="col-lg-4 card-body">
    		<div class="btn btn-primary btn-lg btn-block mb-3 text-center" style="background: rgb(140,166,189);
background: radial-gradient(circle, rgba(140,166,189,1) 0%, rgba(185,147,214,1) 100%);">
    	<br>		
          <span><b> Section 4 (K) </b></span>
    	<br>
        
        </div>
    	</div>
    	<!-- ------------------------------------- -->

    	<div  class="col-lg-4 card-body">
    		<div class="btn btn-primary btn-lg btn-block mb-3 text-center" style="background: rgb(140,166,189);
background: radial-gradient(circle, rgba(140,166,189,1) 0%, rgba(185,147,214,1) 100%);">
    	<br>		
          <span><b> Section 5 (L) </b></span>
    	<br> 	
        
        </div>
    	</div>

    	
     
    </div>

<hr style="background-color: rgba(255,255,255,0.6);">
    <!-- 
    <div class="card-body">
        <div class="alert alert-primary">
          <span>
            <b> Primary - </b> This is a regular notification made with ".alert-primary"</span>
        </div>


        <div class="alert alert-info">  
          <span>
            <b> Info - </b> This is a regular notification made with ".alert-info"</span>
        </div>


        <div class="alert alert-success">
             <span>
            <b> Success - </b> This is a regular notification made with ".alert-success"</span>
        </div>


        <div class="alert alert-warning">
            <span>
            <b> Warning - </b> This is a regular notification made with ".alert-warning"</span>
        </div>

        <div class="alert alert-danger">
          <span>
            <b> Danger - </b> This is a regular notification made with ".alert-danger"</span>
        </div>
      </div> -->


<!-- ------------------------------------------------------------------------------ -->
<!-- Modal HTML embedded directly into document -->
<div id="ex1" class="modal">
  <p>Thanks for clicking. That felt good.</p>
  <a href="#" rel="modal:close">Close</a>
</div>
<!-- Link to open the modal -->
<!-- ------------------------------------------------------------------------------ -->

<p><a href="#ex1" rel="modal:open">Open Modal</a></p>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
@endsection

