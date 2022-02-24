@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: white; box-shadow: 0 0 15px 0 red">
                <div style="background: url({{url('assets/images/rayquaza.png')}}) center center no-repeat; background-size: contain;" class="auth-pokemon"></div>
                <div class="card-header" style="text-align: center; text-transform: uppercase; font-size: 2em; color: black; margin-top: 30px;">Restablecer contraseña</div>
                <div class="my-welcomebar" style="background-color: black !important; margin-top: 30px"></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="email" style="color: black">Correo electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            style="background-color: #ccc; color: black !important" name="email" value="{{ $email ?? old('email') }}" required autocomplete="off">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="password" style="color: black">Contraseña</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            style="background-color: #ccc; color: black !important" name="password" required autocomplete="off">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="password-confirm" style="color: black">Repetir contraseña</label>
                            <input id="password-confirm" type="password" class="form-control" style="background-color: #ccc; color: black !important" name="password_confirmation" required autocomplete="off">
                        </div>
                        
                        <div style="display: flex; justify-content: center; margin-bottom: 100px; margin-top: 30px">
                            <button type="submit" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none">
                                Restablecer
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection