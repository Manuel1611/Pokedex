@extends('base.base')

@section('content')
<!-- Start logout modal--> 
<div id="my-deleteTypecontainer" class="my-logoutcontainer">
  <div class="my-logoutcontainer-inner">
    <div class="my-logoutcontainer-text">
      <div style="margin-top: 40px; padding-left: 25px; padding-right: 25px; text-align: center">¿Estás seguro que quieres eliminar el tipo <span id="deleteType" style="text-transform: lowercase;"></span>?</div>
        <br>
        <div style="padding-left: 25px; padding-right: 25px; text-align: center"><span style="text-transform: uppercase;
            font-size: 1.1em; color: #f55142; font-weight: 500">¡Atención!</span><br>Esta acción borrará todos los Pokémon que tengan el tipo <span id="deleteTypePokemon" style="text-transform: lowercase;"></span> como primario</div>
    </div>
    <div class="my-logoutcontainer-btns" style="margin-bottom: 30px">
      <div id="my-deleteTypebtn-cancelar" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none; width: 150px; padding-left: 20px; padding-right: 20px; cursor: pointer; background-color: #8a8a8a">
        <div>Cancelar</div>
      </div>
      <form id="modalDeleteTypeForm" action="" method="post">
            @method('delete')
            @csrf
      </form>
      <button id="my-deleteTypebtn-aceptar" form="modalDeleteTypeForm" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none; width: 150px; padding-left: 20px; padding-right: 20px; cursor: pointer; background-color: #db1a09">
        <div>Eliminar</div>
      </button>
    </div>
  </div>
</div>
<!-- End logout modal-->

<div class="container" style="margin-top: 150px; margin-bottom: 50px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: white; box-shadow: 0 0 15px 0 red">
                <div class="card-header" style="text-align: center; text-transform: uppercase; font-size: 2em; color: black; margin-top: 30px;">Lista de tipos</div>
                <div class="my-welcomebar" style="background-color: black !important; margin-top: 30px"></div>
                <div class="card-body">
                    <a class="my-addnewuser" href="{{url('pokemontype/create')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="rgba(255, 255, 255, 1)" class="bi bi-plus-lg" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                        </svg>
                    </a>
                    @if(count($types) != 0)
                    <div class="my-userlisttable">
                        <div class="my-userlisttable-title">
                            <div class="my-userlisttable-title1">
                                Tipo
                            </div>
                            <div class="my-userlisttable-title4">
                                &nbsp;
                            </div>
                        </div>
                            @foreach($types as $type)
                            <div class="my-userlisttable-content-fortype">
                                <div class="my-typecolor-container" style="background-color: {{$type->color}}">{{ $type->name }}</div>
                                <div style="display: flex">
                                    <a class="my-tableeditlink2" href="{{ url('pokemontype/' . $type->id . '/edit') }}" style="margin-right: 5px; margin-left: 15px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="rgba(255, 255, 255)" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                          <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                    <div data-name="{{ $type->name }}" data-url="{{ url('pokemontype/' . $type->id) }}" class="my-tableeditlink3 btnToDeleteType" style="margin-left: 5px; cursor: pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M5 11h14v2H5z"></path></svg>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                    @else
                    <div style="text-align: center; color: black; margin-top: 50px; margin-bottom: 50px; font-size: 1.05em">
                        <div>No hay tipos para mostrar. Prueba a añadir alguno...</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    <script defer src="{{ url('assets/js/deleteType.js') }}"></script>
    
@endsection