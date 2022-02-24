@extends('base.base')

@section('content')
<div class="container" style="margin-top: 110px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: white; box-shadow: 0 0 15px 0 red">
                <div style="background: url({{url('assets/images/mesprit.png')}}) center center no-repeat; background-size: contain;" class="auth-pokemon"></div>
                <div class="card-header" style="text-align: center; text-transform: uppercase; font-size: 2em; color: black; margin-top: 30px;">Crea una nueva<br>habilidad</div>
                <div class="my-welcomebar" style="background-color: black !important; margin-top: 30px"></div>
                <div class="card-body">
                    <a class="my-goback" href="{{url('pokemonability')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path></svg>
                    </a>
                    <form method="POST" action="{{ route('pokemonability.store') }}">
                        @csrf
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="name" style="color: black">Nombre</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" minlength="2" maxlength="15"
                            style="background-color: #ccc; color: black !important" name="name" value="{{ old('name') }}" required autocomplete="off">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="battleeffect" style="color: black">Efecto en combate</label>
                            <input id="battleeffect" type="text" class="form-control @error('battleeffect') is-invalid @enderror" minlength="2" maxlength="200"
                            style="background-color: #ccc; color: black !important" name="battleeffect" value="{{ old('battleeffect') }}" required autocomplete="off">
                            @error('battleeffect')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="outsideeffect" style="color: black">Efecto fuera de combate</label>
                            <input id="outsideeffect" type="text" class="form-control @error('outsideeffect') is-invalid @enderror" minlength="2" maxlength="200"
                            style="background-color: #ccc; color: black !important" name="outsideeffect" value="{{ old('outsideeffect') }}" autocomplete="off">
                            @error('outsideeffect')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div style="display: flex; justify-content: center; margin-bottom: 50px; margin-top: 60px">
                            <button type="submit" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none">
                                Crear habilidad
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection