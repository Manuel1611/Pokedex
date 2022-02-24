@extends('base.base')
@section('content')

<!-- Start logout modal--> 
<div id="my-deleteAbilitycontainer" class="my-logoutcontainer">
  <div class="my-logoutcontainer-inner">
    <div class="my-logoutcontainer-text">
      <div style="margin-top: 40px; padding-left: 25px; padding-right: 25px; text-align: center">¿Estás seguro que quieres eliminar la habilidad <span id="deleteAbility"></span>?</div>
        <br>
        <div style="padding-left: 25px; padding-right: 25px; text-align: center"><span style="text-transform: uppercase;
            font-size: 1.1em; color: #f55142; font-weight: 500">¡Atención!</span><br>Esta acción borrará todos los Pokémon con la habilidad <span id="deleteAbilityPokemon"></span></div>
    </div>
    <div class="my-logoutcontainer-btns" style="margin-bottom: 30px">
      <div id="my-deleteAbilitybtn-cancelar" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none; width: 150px; padding-left: 20px; padding-right: 20px; cursor: pointer; background-color: #8a8a8a">
        <div>Cancelar</div>
      </div>
      <form id="modalDeleteAbilityForm" action="" method="post">
            @method('delete')
            @csrf
      </form>
      <button id="my-deleteAbilitybtn-aceptar" form="modalDeleteAbilityForm" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none; width: 150px; padding-left: 20px; padding-right: 20px; cursor: pointer; background-color: #db1a09">
        <div>Eliminar</div>
      </button>
    </div>
  </div>
</div>
<!-- End logout modal-->

<div class="container" style="margin-top: 140px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="my-goback" style="bottom: 40px !important" href="{{url('pokemonability')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path></svg>
            </a>
            @if(auth()->user()->rol != 'Usuario')
                <a class="my-goedit-fromshow" style="bottom: 40px !important" href="{{ url('pokemonability/' . $ability->id . '/edit') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="rgba(255, 255, 255)" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                      <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                    </svg>
                </a>
                <div data-name="{{ $ability->name }}" data-url="{{ url('pokemonability/' . $ability->id) }}" class="my-godelete-fromshow btnToDeleteAbility" style="cursor: pointer; bottom: 40px !important">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M5 11h14v2H5z"></path></svg>
                </div>
            @endif
            <div class="card" style="background-color: white; box-shadow: 0 0 15px 0 red">
                <div class="card-header" style="text-align: center; text-transform: uppercase; font-size: 2em; color: black; margin-top: 30px;">Habilidad {{$ability->name}}</div>
                <div style="margin: 5px auto; color: black; font-size: 1.05em">Información sobre la habilidad</div>
                <div class="my-welcomebar" style="background-color: black !important; margin-top: 30px"></div>
                <div class="card-body">
                    <div class="my-showseparator">
                        <div style="display: flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg>
                            &nbsp;&nbsp;<label style="color: black">Efecto en combate</label>
                        </div>
                        <div style="color: black; font-size: 1.05em" class="my-showinfo-container">
                            {{$ability->battleeffect}}
                        </div>
                    </div>
                    <div class="my-showseparator">
                        <div style="display: flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg>
                            &nbsp;&nbsp;<label style="color: black">Efecto fuera de combate</label>
                        </div>
                        <div style="color: black; font-size: 1.05em" class="my-showinfo-container">
                            @if($ability->outsideeffect != null)
                                {{$ability->outsideeffect}}
                            @else
                                Ninguno
                            @endif
                        </div>
                    </div>
                    @if(count($pokemons) > 0)
                        <div class="my-showseparator">
                            <div style="display: flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg>
                                &nbsp;&nbsp;<label style="color: black">Pokémon con Habilidad {{$ability->name}}</label>
                            </div>
                            <div class="showability-pokemon">
                                @foreach($pokemons as $pokemon)
                                    @if($pokemon->idability == $ability->id)
                                        @foreach($images as $image)
                                            @if($image->idpokemon == $pokemon->id)
                                                <a class="showability-pokemoncontainer" href="{{url('pokemon/' . $pokemon->id)}}">
                                                    <div style="background: url({{url(asset('storage/images/' . $pokemon->id . '/' . $image->myname))}}) center center no-repeat; background-size: contain;
                                                    width: 100px; height: 100px"></div>
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    <script defer src="{{ url('assets/js/deleteAbility.js') }}"></script>
    
@endsection