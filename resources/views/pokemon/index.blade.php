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

  <div class="my-filter-container">
    <div style="display: flex">
      <div class="ordenar-por">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="m13.061 4.939-2.122 2.122L15.879 12l-4.94 4.939 2.122 2.122L20.121 12z"></path><path d="M6.061 19.061 13.121 12l-7.06-7.061-2.122 2.122L8.879 12l-4.94 4.939z"></path></svg>
        <div>
          &nbsp;Ordenar por...
        </div>
      </div>
      <div style="display: flex">
        <a class="my-filter-btn" href="{{ route('pokemon', $orderidasc) }}">Número</a>
        <a class="my-filter-btn" href="{{ route('pokemon', $ordernameasc) }}">A-Z</a>
        <a class="my-filter-btn" href="{{ route('pokemon', $ordernamedesc) }}">Z-A</a>
      </div>
    </div>
      
      <div class="filtertype-container" style="margin-left: 15px">
        <form id="formType" action="{{ $rutaSearch ?? '' }}" method="get">
          <select class="form-control" style="background-color: #969696; color: white !important; width: 150px; appearance: none;" id="filtertype" name="filtertype">
            <option value="0" @if ($appendData['filtertype'] == 0) selected @endif>Todos</option>
            @foreach($types as $type)
                <option value="{{ $type->id }}" @if ($appendData['filtertype'] == $type->id) selected @endif>{{ $type->name }}</option>
            @endforeach
          </select>
        @isset($appendData)
            @foreach($appendData as $name => $value)
              @if($name != 'filtertype')
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
              @endif
            @endforeach
          @endisset
        </form>
      </div>
      
      <div style="display: flex; align-items: center">
        <div class="ordenar-por">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="m13.061 4.939-2.122 2.122L15.879 12l-4.94 4.939 2.122 2.122L20.121 12z"></path><path d="M6.061 19.061 13.121 12l-7.06-7.061-2.122 2.122L8.879 12l-4.94 4.939z"></path></svg>
          <div>
            &nbsp;Busca un Pokémon...
          </div>
        </div>
        <form action="{{ $rutaSearch ?? '' }}" method="get">
          <input value="{{ $appendData['search'] ?? '' }}" name="search" type="text" class="my-searchinput" autocomplete="off">
           @isset($appendData)
            @foreach($appendData as $name => $value)
              @if($name != 'search')
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
              @endif
            @endforeach
          @endisset
          <button class="my-search-submit" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path></svg>
          </button>
        </form>
      </div>
  </div>
@if(count($pokemons) > 0)
<div class="indexpokemon-container" style="margin-bottom: 50px">
  @foreach($pokemons as $pokemon)
    <div class="indexpokemon-inner">
      @if(auth()->user()->rol == 'Admin' || auth()->user()->rol == 'Entrenador')
        <a class="my-tableeditlinkpokemon" href="{{ url('pokemon/' . $pokemon->id . '/edit') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="rgba(255, 255, 255)" class="bi bi-pencil-fill" viewBox="0 0 16 16">
              <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg>
        </a>
        
        <div data-name="{{ $pokemon->name }}" data-url="{{ url('pokemon/' . $pokemon->id) }}" class="my-tableeditlinkpokemon2 btnToDeletePokemon" style="margin-left: 5px; cursor: pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M5 11h14v2H5z"></path></svg>
        </div>
      @endif
      <a class="indexpokemon-imgcontainer" href="{{url('pokemon/' . $pokemon->id)}}">
        @foreach($images as $image)
          @if($image->idpokemon == $pokemon->id)
            <div style="width: 260px; height: 260px; background: url({{url(asset('storage/images/' . $pokemon->id . '/' . $image->myname))}}) center center no-repeat; background-size: contain;"></div>
          @endif
        @endforeach  
      </a>
      <div class="indexpokemon-typecontainer">
        <div class="indexpokemon-name">
          {{$pokemon->name}}
        </div>
        <div>
            @if($pokemon->idsecondarytype == null)
              <div>
                @foreach($types as $type)
                  @if($pokemon->idprimarytype == $type->id)
                    <div class="my-typecolor-container" style="background-color: {{$type->color}}; color: black;">{{ $type->name }}</div>
                    @break
                  @endif
                @endforeach
              </div>
            @else
              <div class="indexpokemon-types">
                @foreach($types as $type)
                  @if($pokemon->idprimarytype == $type->id)
                    <div class="my-typecolor-container" style="background-color: {{$type->color}}; color: black">{{ $type->name }}</div>
                  @endif
                  @if($pokemon->idsecondarytype == $type->id)
                    <div class="my-typecolor-container" style="background-color: {{$type->color}}; color: black">{{ $type->name }}</div>
                  @endif
                @endforeach
              </div>
            @endif
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="my-pag-container">
  {{ $pokemons->onEachSide(1)->links() }}
</div>

@else
  <div class="my-therearenopokemon">
    No hay ningún Pokémon disponible para mostrar...
  </div>
@endif

@endsection

@section('js')

    <script defer src="{{ url('assets/js/deletePokemon.js') }}"></script>
    
@endsection