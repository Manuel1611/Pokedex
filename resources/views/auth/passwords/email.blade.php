@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: white; box-shadow: 0 0 15px 0 red">
                <div style="background: url({{url('assets/images/darkrai.png')}}) center center no-repeat; background-size: contain;" class="auth-pokemon"></div>
                <div class="card-header" style="text-align: center; text-transform: uppercase; font-size: 2em; color: black; margin-top: 30px;">Restablecer<br>contraseña</div>
                <div class="my-welcomebar" style="background-color: black !important; margin-top: 30px"></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert" style="padding: 15px !important; text-align: center">
                            Tu mensaje se ha enviado correctamente. Comprueba tu bandeja de entrada
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="email" style="color: black">Correo electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            style="background-color: #ccc; color: black !important" name="email" value="{{ old('email') }}" required autocomplete="off">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div style="display: flex; justify-content: center; margin-bottom: 100px; margin-top: 30px">
                            <button type="submit" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none">
                                Enviar mensaje
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection