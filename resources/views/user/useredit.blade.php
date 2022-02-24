@extends('base.base')

@section('content')
<div class="container" style="margin-top: 130px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: white; box-shadow: 0 0 15px 0 red">
                @if (Session::has('message'))
                    <div class="alert alert-danger" style="padding: 10px; margin: 20px; text-align: center" role="alert">
                      {{ session()->get('message') }}
                    </div>
                @endif
                <div style="background: url({{url('assets/images/ditto.png')}}) center center no-repeat; background-size: contain;" class="auth-pokemon"></div>
                <div class="card-body">
                    <form method="POST" id="fuseredit" action="{{ route('user.userupdate') }}">
                        @csrf
                        @method('put')

                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="name" style="color: black">Nombre</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" minlength="2" maxlength="15"
                            style="background-color: #ccc; color: black !important" name="name" value="{{ old('name', auth()->user()->name) }}" required autocomplete="off">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="email" style="color: black">Correo electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" minlength="5" maxlength="40"
                            style="background-color: #ccc; color: black !important" name="email" value="{{ old('email', auth()->user()->email) }}" required autocomplete="off">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="oldpassword" style="color: black">Contraseña anterior</label>
                            <input id="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" minlength="8"
                            style="background-color: #ccc; color: black !important" name="oldpassword">
                            @error('oldpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="password" style="color: black">Contraseña</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" minlength="8"
                            style="background-color: #ccc; color: black !important" name="password" autocomplete="off">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="password-confirm" style="color: black">Repetir contraseña</label>
                            <input id="password-confirm" type="password" class="form-control" minlength="8" style="background-color: #ccc; color: black !important" name="password_confirmation" autocomplete="off">
                        </div>
                        
                        <div style="display: flex; justify-content: center; margin-bottom: 100px; margin-top: 30px">
                            <button type="submit" id="userupdatebtn" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none">
                                Editar perfil
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection