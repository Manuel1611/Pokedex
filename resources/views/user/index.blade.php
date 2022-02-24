@extends('base.base')

@section('content')
<div class="container" style="margin-top: 150px; margin-bottom: 50px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: white; box-shadow: 0 0 15px 0 red">
                <div class="card-header" style="text-align: center; text-transform: uppercase; font-size: 2em; color: black; margin-top: 30px;">Lista de usuarios</div>
                <div class="my-welcomebar" style="background-color: black !important; margin-top: 30px"></div>
                <div class="card-body">
                    <a class="my-addnewuser" href="{{url('user/create')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="rgba(255, 255, 255, 1)" class="bi bi-plus-lg" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                        </svg>
                    </a>
                    <div class="my-userlisttable">
                        <div class="my-userlisttable-title">
                            <div class="my-userlisttable-title1">
                                Nombre
                            </div>
                            <div class="my-userlisttable-title2">
                                Correo electrónico
                            </div>
                            <div class="my-userlisttable-titl3">
                                Rango
                            </div>
                            <div class="my-userlisttable-title4">
                                &nbsp;
                            </div>
                        </div>
                            @foreach($users as $user)
                            <div class="my-userlisttable-content">
                                <div class="my-userlisttable-title1">{{ $user->name }}</div>
                                <div class="my-userlisttable-title2">{{ $user->email }}</div>
                                <div class="my-userlisttable-title3">{{ $user->rol }}</div>
                                <div class="my-userlisttable-title4">
                                    @if($user->id != auth()->user()->id)
                                    <a class="my-tableeditlink" href="{{ url('user/' . $user->id . '/edit') }}" style="margin-right: 20px">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="rgba(255, 255, 255)" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                          <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection