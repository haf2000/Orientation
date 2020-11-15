@extends('layouts.app')

@section('content')
    <div class="col-lg-5 col-md-6 ml-auto mr-auto mt-n1">
        <form class="form" method="post" action="{{ route('login') }}">
            @csrf

            <div class="card card-login card-white">
                <div class="card-header">
                   <!-- <img src="{{ asset('black') }}/img/card-primary.png" alt="">-->
                    <br><br><br><br>
                </div>
                <div class="card-body">
                    <p class="text-dark text-center mb-2"><strong>Connexion</strong></p>
                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input type="password" placeholder="{{ __('Mot de passe') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                </div>
                <div class="card-footer">
                    
                        <button type="submit" class="btn btn-primary btn-lg btn-block mb-3 text-center" style="background:  rgba(185,147,214,1);font-weight: normal;">{{ __('Se connecter') }}</button>

                    <div class="pull-left">
                        <h6>
                            <a href="{{ route('register') }}" class="link footer-link">{{ __('Créer un compte') }}</a>
                        </h6>
                    </div>
                    <div class="pull-right">
                        <h6>
                            <a href="{{ route('password.request') }}" class="link footer-link">{{ __('mot de passe oublié ?') }}</a>
                        </h6>
                    </div>
                </div>
            </div>
        </form>
    </div>
   
@endsection
