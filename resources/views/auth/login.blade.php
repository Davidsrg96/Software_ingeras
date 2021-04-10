@extends('layouts.app')

<<<<<<< HEAD
@section('cuerpo')
    <div class="content">
        <div class="container">
            <div class="col-md-12 ml-auto mr-auto">
                <div class="header bg-gradient-primary py-10 py-lg-2 pt-lg-12">
                    <div class="container">
                        <div class="header-body text-center mb-7">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-md-9">
                                    <p class="text-lead text-light mt-3 mb-0">
                                        @include('alerts.migrations_check')
                                    </p>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ml-auto mr-auto">
                <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card card-login card-plain">
                        <div class="card-header ">
                            <div class="logo-container">
                                <img src="{{ asset('assets/img/now-logo.png') }}" alt="">
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="input-group no-border form-control-lg {{ $errors->has('email') ? ' has-danger' : '' }}">
                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="now-ui-icons users_circle-08"></i>
                                    </div>
                                </span>
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Correo') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <div class="input-group no-border form-control-lg {{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="now-ui-icons objects_key-25"></i>
                                    </div>
                                </div>
                                <input placeholder="Password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Contraseña') }}" type="password" required>
                            </div>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="card-footer ">
                            <button  type = "submit" class="btn btn-primary btn-round btn-lg btn-block mb-3">{{ __('Acceder') }}</button>
                            <div class="pull-right">
                                <h6>
                                    <a href="{{ route('password.request') }}" class="link footer-link">{{ __('¿Olvido la Contraseña?') }}</a>
                                </h6>                
                            </div>
                        </div>
                    </div>
                </form>
=======
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
>>>>>>> parent of 2c803cf (modificaciones)
            </div>
        </div>
    </div>
</div>
@endsection
