@extends('base.base')

@section('content')
<div class="container" style="margin-top: 210px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: white; box-shadow: 0 0 15px 0 red">
                <div style="background: url({{url('assets/images/thundurus.png')}}) center center no-repeat; background-size: contain;" class="auth-pokemon"></div>
                <div class="card-header" style="text-align: center; text-transform: uppercase; font-size: 2em; color: black; margin-top: 30px;">Crea un nuevo<br>tipo</div>
                <div class="my-welcomebar" style="background-color: black !important; margin-top: 30px"></div>
                <div class="card-body">
                    <a class="my-goback" href="{{url('pokemontype')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path></svg>
                    </a>
                    <form method="POST" action="{{ route('pokemontype.store') }}">
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
                            <label for="color" style="color: black">Color representativo</label>
                            <input id="color" type="color" class="form-control @error('color') is-invalid @enderror"
                            style="background-color: #ccc; color: black !important" name="color" value="{{ old('color') }}" required>
                            @error('color')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div style="display: flex; justify-content: center; margin-bottom: 50px; margin-top: 60px">
                            <button type="submit" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none">
                                Crear tipo
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection