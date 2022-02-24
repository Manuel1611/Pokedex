@extends('base.base')

@section('content')

<div class="container" style="margin-top: 100px; margin-bottom: 20px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: white; box-shadow: 0 0 15px 0 red">
                @if (Session::has('message'))
                    <div class="alert alert-{{ session()->get('type') }}" style="padding: 10px; margin: 20px; text-align: center" role="alert">
                      {{ session()->get('message') }}
                    </div>
                @endif
                <div class="card-header" style="text-align: center; text-transform: uppercase; font-size: 2em; color: black; margin-top: 30px;">Edita a<br>{{$pokemon->name}}</div>
                <div class="my-welcomebar" style="background-color: black !important; margin-top: 30px"></div>
                <div class="card-body">
                    <a class="my-goback" href="{{url('pokemon')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path></svg>
                    </a>
                    <form method="POST" action="{{ url('pokemon/' . $pokemon->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="name" style="color: black">Nombre</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" minlength="2" maxlength="25"
                            style="background-color: #ccc; color: black !important" name="name" value="{{ old('name', $pokemon->name) }}" required autocomplete="off">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="idprimarytype" style="color: black">Tipo primario</label>
                            <select class="form-control" style="background-color: #ccc; color: black !important" id="idprimarytype" name="idprimarytype" required>
                                <option value="" @if(old('idprimarytype') == '') selected @endif disabled>&nbsp;</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ $type->id == $pokemon->idprimarytype ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                
                            @error('idprimarytype')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="idsecondarytype" style="color: black">Tipo secundario</label>
                            <select class="form-control" style="background-color: #ccc; color: black !important" id="idsecondarytype" name="idsecondarytype">
                                <option value="" @if(old('idsecondarytype') == '') selected @endif>&nbsp;</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ $type->id == $pokemon->idsecondarytype ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                
                            @error('idsecondarytype')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="idability" style="color: black">Habilidad</label>
                            <select class="form-control" style="background-color: #ccc; color: black !important" id="idability" name="idability" required>
                                <option value="" @if(old('idability') == '') selected @endif disabled>&nbsp;</option>
                                @foreach($abilities as $ability)
                                    <option value="{{ $ability->id }}" {{ $ability->id == $pokemon->idability ? 'selected' : '' }}>{{ $ability->name }}</option>
                                @endforeach
                            </select>
                
                            @error('idability')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="description" style="color: black">Descripción</label>
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" minlength="2" maxlength="200"
                            style="background-color: #ccc; color: black !important" name="description" value="{{ old('description', $pokemon->description) }}" required autocomplete="off">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="region" style="color: black">Región</label>
                            <select class="form-control" style="background-color: #ccc; color: black !important" id="region" name="region" required>
                                <option value="" @if(old('region') == '') selected @endif disabled>&nbsp;</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region }}" @if(old('region', $pokemon->region) == $region) selected @endif>{{ $region }}</option>
                                @endforeach
                            </select>
                
                            @error('region')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="height" style="color: black">Altura (Metros)</label>
                            <input id="height" type="text" class="form-control @error('height') is-invalid @enderror" min="0" step="0.1" max="99999999"
                            style="background-color: #ccc; color: black !important" name="height" value="{{ old('height', $pokemon->height) }}" required autocomplete="off">
                            @error('height')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="weight" style="color: black">Peso (Kg)</label>
                            <input id="weight" type="text" class="form-control @error('weight') is-invalid @enderror" min="0" step="0.1" max="99999999"
                            style="background-color: #ccc; color: black !important" name="weight" value="{{ old('weight', $pokemon->weight) }}" required autocomplete="off">
                            @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="my-lrinpcon" style="margin-top: 30px">
                            <label for="myinputfile" style="color: black">Imagen</label>
                            <div class="parent-div" style="margin-bottom: 25px">
                                @foreach($images as $image)
                                    @if($image->idpokemon == $pokemon->id)
                                        <div class="btn-upload" id="btn-upload" data-url= "{{ asset('storage/images/' . $pokemon->id . '/' . $image->myname) }}"></div>
                                    @endif
                                @endforeach
                                <input class="myinputfile" id="myinputfile" style="margin-bottom: 25px" type="file" name="photo" accept="image/*" />
                            </div>
                        </div>
                        
                        <div style="display: flex; justify-content: center; margin-bottom: 50px; margin-top: 25px">
                            <button type="submit" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none">
                                Editar Pokémon
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ url('assets/js/showImgEdit.js') }}" defer></script>
@endsection