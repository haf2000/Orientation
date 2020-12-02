@extends('layouts.app',['pageSlug' => 'welcome page'])

@section('content')
         
            <div class="header py-7 py-lg-8">
                <div class="container">
                    <div class="header-body text-center mb-7">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 justify-content-center" style="font-family: 'Montserrat';">
                                <h1 class="text-white" style="font-size: 70px;font-weight: bolder;">{{ __('Bienvenue !') }}</h1>
                    
                                <p class="text-white">
                                    {{ __('Orient est une application web utilisée par le service de gestion des orientations L2-L3, comme elle vous permet de consulter vos résultats d\'orientation en tant qu\'étudiant.') }}
                                </p>
                                <br>
                               <div class="row justify-content-center text-center">
                                 <a href="{{ route('login') }}" style="width: 50%;">
                                     <button type="submit" class="btn btn-primary btn-lg btn-block mb-3 text-center" style="background:  rgba(185,147,214,1);font-weight: normal;">{{ __('Connectez-vous !') }}</button>

                                 </a>  
                               </div>
                                       
                                                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
@endsection
