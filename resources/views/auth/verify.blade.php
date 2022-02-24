@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: white; box-shadow: 0 0 15px 0 red">
                <div class="card-header" style="text-align: center; text-transform: uppercase; font-size: 2em; color: black; margin-top: 30px;">Verifícate</div>
                <div class="my-welcomebar" style="background-color: black !important; margin-top: 30px; margin-bottom: 10px"></div>
                <div class="card-body" style="color: black">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert" style="padding: 15px !important; text-align: center">
                            Se te ha enviado un correo electrónico con toda la información
                        </div>
                    @endif
                    <div class="my-verifytext">Para tener acceso a la Pokédex debes verificar tu cuenta de correo electrónico. Comprueba que te haya llegado el mensaje de verificación y, de no ser así, prueba a solicitar uno nuevo.</div>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div style="width: 100%; height: fit-content; display: flex; justify-content: center; margin-top: 35px; margin-bottom: 35px">
                            <button type="submit" class="my-pulsaparaotro">Solicitar mensaje</button>
                        </div>
                    </form>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <div style="display: flex; width: 100%; justify-content: center">
                        <button form="logout-form" type="submit" style="cursor: pointer;" id="my-logoutbtn" class="my-volveratras">
                            Volver atrás
                        </button>
                    </div>
                    
                    <div style="display: flex; width: 425px; justify-content: space-between; margin: 0 auto; margin-bottom: 30px; margin-top: 30px">
                        <div style="background: url({{url('assets/images/unown1.png')}}) center center no-repeat; background-size: cover; width: 200px; height: 200px"></div>
                        <div style="background: url({{url('assets/images/unown2.png')}}) center center no-repeat; background-size: cover; width: 200px; height: 200px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection