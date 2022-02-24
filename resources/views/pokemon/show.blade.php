@extends('base.base')
@section('content')

<!-- Start logout modal--> 
<div id="my-deletePokemoncontainer" class="my-logoutcontainer">
  <div class="my-logoutcontainer-inner">
    <div class="my-logoutcontainer-text">
      <div style="margin-top: 40px; padding-left: 25px; padding-right: 25px; text-align: center">¿Estás seguro que quieres eliminar a <span id="deletePokemon"></span>?</div>
    </div>
    <div class="my-logoutcontainer-btns" style="margin-bottom: 30px">
      <div id="my-deletePokemonbtn-cancelar" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none; width: 150px; padding-left: 20px; padding-right: 20px; cursor: pointer; background-color: #8a8a8a">
        <div>Cancelar</div>
      </div>
      <form id="modalDeletePokemonForm" action="" method="post">
            @method('delete')
            @csrf
      </form>
      <button id="my-deletePokemonbtn-aceptar" form="modalDeletePokemonForm" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none; width: 150px; padding-left: 20px; padding-right: 20px; cursor: pointer; background-color: #db1a09">
        <div>Eliminar</div>
      </button>
    </div>
  </div>
</div>
<!-- End logout modal-->

<div class="container" style="margin-top: 100px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="my-goback" style="bottom: 40px !important" href="{{url('pokemon')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path></svg>
            </a>
            @if(auth()->user()->rol != 'Usuario')
                <a class="my-goedit-fromshow" style="bottom: 40px !important" href="{{ url('pokemon/' . $pokemon->id . '/edit') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="rgba(255, 255, 255)" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                      <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                    </svg>
                </a>
                <div data-name="{{ $pokemon->name }}" data-url="{{ url('pokemon/' . $pokemon->id) }}" class="my-godelete-fromshow btnToDeletePokemon" style="cursor: pointer; bottom: 40px !important">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M5 11h14v2H5z"></path></svg>
                </div>
            @endif
            <div class="card" style="background-color: white; box-shadow: 0 0 15px 0 red">
                <div class="card-header" style="text-align: center; text-transform: uppercase; font-size: 2em; color: black; margin-top: 30px;">{{$pokemon->name}}</div>
                <div class="my-welcomebar" style="background-color: black !important; margin-top: 30px"></div>
                <div class="card-body">
                    <div style="width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; margin-top: 10px">
                        <div class="pokemonshow-imgcontainer">
                            @foreach($images as $image)
                                @if($image->idpokemon == $pokemon->id)
                                    <div style="background: url({{url(asset('storage/images/' . $pokemon->id . '/' . $image->myname))}}) center center no-repeat;
                                    background-size: contain; width: 300px; height: 300px;"></div>
                                @endif
                            @endforeach
                        </div>
                        <div style="color: black; font-size: 1.05em; width: 400px; margin-left: 0 !important; margin-top: 25px !important" class="my-showinfo-container">
                            {{$pokemon->description}}
                        </div>
                        <div style="margin-top: 15px; margin-bottom: 20px; color: black; font-size: 1.2em;">
                            Información
                        </div>
                        <div class="showpokemon-statscontainer">
                            <div>
                                <div>
                                    Altura
                                </div>
                                <div style="color: black">
                                    {{$pokemon->height}} m
                                </div>
                            </div>
                            <div>
                                <div>
                                    Peso
                                </div>
                                <div style="color: black">
                                    {{$pokemon->weight}} kg
                                </div>
                            </div>
                            <div style="margin-top: 20px">
                                <div>
                                    Región
                                </div>
                                <div style="color: black">
                                    {{$pokemon->region}}
                                </div>
                            </div>
                            <div style="margin-top: 20px">
                                <div>
                                    Habilidad
                                </div>
                                <div>
                                    @foreach($abilities as $ability)
                                        @if($pokemon->idability == $ability->id)
                                            <a style="color: black; width: 200px; text-decoration: underline" href="{{url('pokemonability/' . $ability->id)}}">
                                                {{$ability->name}}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 25px; margin-bottom: 20px; color: black; font-size: 1.2em;">
                            @if($pokemon->idsecondarytype == null)
                                Tipo
                            @else
                                Tipos
                            @endif
                        </div>
                        <div class="pokemonshow-typecontainer">
                            @foreach($types as $type)
                                @if($pokemon->idprimarytype == $type->id)
                                    <div class="my-typecolor-container" style="background-color: {{$type->color}}">
                                        {{$type->name}}
                                    </div>
                                @endif
                                @if($pokemon->idsecondarytype == $type->id)
                                    <div class="my-typecolor-container" style="background-color: {{$type->color}}">
                                        {{$type->name}}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    <script defer src="{{ url('assets/js/deletePokemon.js') }}"></script>
    
@endsection